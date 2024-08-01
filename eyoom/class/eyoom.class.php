<?php
/**
 * eyoom class
 */

class eyoom extends qfile
{

    public function __construct() {
        global $g5, $eyoom, $theme, $config;

        $this->g5 = $g5;
        $this->member_path = G5_DATA_PATH . '/member';
        if ($eyoom) $this->eyoom = $eyoom;
        if ($theme) $this->theme = $theme;
        if ($config) $this->config = $config;
    }

    /**
     * 랜덤으로 숫자 생성
     */
    public function random_num($max_num) {
        mt_srand ((double) microtime() * 1000000);
        $num = mt_rand(0, $max_num);
        return $num;
    }

    /**
     * 특정위치에 배열값 추가
     * insert_array($src_array, $index, $add_array)
     */
    function insert_array($src_array, $idx, $add_array) {        
        $arr_front = array_slice($src_array, 0, $idx);
        $arr_end = array_slice($src_array, $idx);
        $arr_front[] = $add_array;
        return array_merge($arr_front, $arr_end);
    }

    /**
     * 브라우저 캐시 방지
     */
    public function eyoom_no_cache() {
        $gmnow = gmdate('D, d M Y H:i:s').' GMT';
        header('Expires: 0'); // rfc2616 - Section 14.21
        header('Last-Modified: ' . $gmnow);
        header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
        header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
        header('Pragma: no-cache'); // HTTP/1.0
    }

    /**
     * 메인페이지 설정
     */
    public function print_mainpage() {
        global $config, $eyoom, $eb, $bbs, $member, $user, $eyoomer, $levelset, $is_admin, $is_member, $eyoom_skin_path, $eyoom_skin_url;

        /**
         * 메인페이지에서 $g5 변수 허용
         */
        $g5 = $this->g5;

        /**
         * Super Global $_GET 변수처리
         */
        if (count($_GET) > 0 && !$_GET['theme']) {
            // 마이홈 주소 체계 - /?user_id&permit_string
            $permit = array('page','following','follower','friends','guest','subscriber');
            $index = false; $i=0;
            foreach ($_GET as $k => $v) {
                if ($i==0) { $dummy_id = $k; $i++; continue; } // 첫번째 변수는 dummy_id
                if (!in_array($k,$permit)) {
                    $index = true; // 허용하지 않은 키값은 무시하고 기본 홈으로
                    break;
                } else {
                    if ($v && $k=='page') ${$k} = (int)$v;
                    else $userpage = $k;
                }
                if ($i==2) break; // GET변수는 3개까지만 허용
                $i++;
            }
            if ($index || $dummy_id == 'home' || $dummy_id == 'auto_login' || $dummy_id == 'device' || $dummy_id == 'fbclid') {
                // 홈으로 이동
                $this->go_index_page();
            } else {
                include_once(G5_LIB_PATH.'/register.lib.php');

                // 사용자 아이디 유효성 체크
                if (empty_mb_id($dummy_id)) { $this->go_index_page(); exit; }
                if (valid_mb_id($dummy_id)) { $this->go_index_page(); exit; }
                if (count_mb_id($dummy_id)) { $this->go_index_page(); exit; }
                if (exist_mb_id($dummy_id)) {
                    $user = $this->get_user_info($dummy_id);

                    // 공개여부, 비회원여부, 공개하지 않았으나 마이홈으로 이동일 경우 등
                    if ($user['open_page']=='y' || ($user['mb_id'] == $member['mb_id'] && $user['mb_id']) ) {
                        include_once(EYOOM_CORE_PATH.'/mypage/myhome.php');
                    } else {
                        $msg = "회원이 아니거나 마이홈을 공개하지 않은 회원입니다.";
                        alert($msg, G5_URL);
                    }
                }
            }
        } else {
            include_once(EYOOM_PATH.'/main.php');
        }
    }

    /**
     * 메인페이지
     */
    private function go_index_page() {
        global $eyoom;

        include_once(EYOOM_PATH.'/main.php');
    }

    /**
     * 호스트명 추출
     */
    public function eyoom_host($url='') {
        if (!$url) $url = G5_URL;
        $info = parse_url($url);
        if ($info['query']) parse_str($info['query'], $query);
        $info['host'] = preg_replace('/www\./i','',$info['host']);
        $info['query'] = $query;
        return $info;
    }

    /**
     * 그누보드5/영카트5 루트폴더
     */
    public function g5_root($path) {
        $path = str_replace('\\', '/', $path);
        $tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $_SERVER['SCRIPT_NAME']);
        $document_root = str_replace($tilde_remove, '', $_SERVER['SCRIPT_FILENAME']);
        $output = str_replace($document_root, '', $path);
        $output = str_replace('extend', '', $output);
        return $output;
    }

    /**
     * 이윰빌더 최신 배포버전 가져오기
     */
    public function get_eyoom_version($eb_season='4') {
        $ch = curl_init();
        $url = "https://raw.githubusercontent.com/eyoom/";
        $url .= "eyoom_builder_{$eb_season}/master/eyoom/extend/eyoom{$eb_season}.version.php";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if(!curl_errno($ch)) {
            if (preg_match('/define\s*\(\s*\'EYOOM_VERSION\'\s*,\s*\'([0-9]+\.[0-9]+\.[0-9]+)\'\s*\)\s*;/', $result, $matches)) {
                return $matches[1];
            }
        } else {
            return EYOOM_VERSION;
        }
    }

    /**
     * 읽지 않은 쪽지수
     */
    public function check_memo_auth($member) {
        global $is_auth;

        if( isset($member['mb_memo_cnt']) ){
            $memo_not_read = $member['mb_memo_cnt'];
        } else {
            $memo_not_read = get_memo_not_read($member['mb_id']);
        }

        $is_auth = false;
        $sql = " select count(*) as cnt from {$this->g5['auth_table']} where mb_id = '{$member['mb_id']}' ";
        $row = sql_fetch($sql);
        if ($row['cnt'])
            $is_auth = true;

        return $memo_not_read;
    }

    /**
     * 내글반응 - 내글반응 등록 및 업데이트
     */
    public function respond($respond = array()) {
        global $member, $anonymous;

        if (!is_array($respond)) return;
        foreach ($respond as $key => $val) {
            if (!$val) return;
            ${$key} = $val;
        }
        if ($wr_mb_id == $member['mb_id']) return;

        /**
         * 익명글
         */
        if (!$anonymous) {
            $mb_id = $member['mb_id'];
            $mb_nick = $member['mb_nick'];
        } else {
            $mb_id = 'anonymous';
            $mb_nick = $eyoom['anonymous_title'];
        }

        $set = "
            bo_table    = '$bo_table',
            pr_id       = '$pr_id',
            wr_id       = '$wr_id',
            wr_cmt      = '$wr_cmt',
            wr_mb_id    = '$wr_mb_id',
            mb_id       = '" . $mb_id . "',
            mb_name     = '" . $mb_nick . "',
            re_type     = '$type',
            wr_subject  = '" . addslashes(get_text($wr_subject)) . "',
        ";
        $where = "
            wr_mb_id = '$wr_mb_id' and
            bo_table = '$bo_table' and
            pr_id = '$pr_id' and
            re_type = '$type'
        ";

        /**
         * 열람하지 않은 내글반응이 이미 있는지 체크
         */
        $row = sql_fetch(" select rid from {$this->g5['eyoom_respond']} where $where and re_chk <> '1' order by rid desc ", false);
        $rid = $row['rid'];

        if ($rid) {
            /**
             * 열람하지 않은 내글반응이 이미 있을 경우, 카운트만 올림
             */
            sql_query("update {$this->g5['eyoom_respond']} set re_cnt=re_cnt+1, regdt='".G5_TIME_YMDHIS."' where rid='{$rid}'", false);
        } else {
            /**
             * 내글 반응 등록
             */
            $insert = " insert into {$this->g5['eyoom_respond']} set $set regdt = '".G5_TIME_YMDHIS."' ";
            sql_query($insert, false);
            $rid = sql_insert_id();

            /**
             * 원본글 작성자의 반응글 적용
             */
            $row = sql_fetch("select mb_id from {$this->g5['eyoom_member']} where mb_id = '{$wr_mb_id}'", false);
            if ($row['mb_id']) {
                sql_query(" update {$this->g5['eyoom_member']} set respond = respond + 1 where mb_id = '{$wr_mb_id}' ", false);
            } else {
                sql_query(" insert into {$this->g5['eyoom_member']} set mb_id = '{$wr_mb_id}', respond=1", false);
            }
        }

        /**
         * 푸시등록
         */
        $user = sql_fetch("select onoff_push_respond from {$this->g5['eyoom_member']} where mb_id = '{$wr_mb_id}'");
        if ($user['onoff_push_respond'] == 'on') $this->set_push("respond",$rid,$wr_mb_id,$mb_nick,$type);

    }

    /**
     * 내글반응의 종류에 따라 출력될 메세지 결정
     */
    public function respond_mention($type,$name,$cnt) {
        switch($type) {
            case 'reply'    :
                $reinfo['type'] = '답글';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>개의 답글이 내글에 달렸습니다." : "<b>".$name."</b>님이 내글에 답글을 남겼습니다.";
                break;
            case 'good'     :
                $reinfo['type'] = '추천';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>명이 내글을 추천하였습니다." : "<b>".$name."</b>님이 내글을 추천하였습니다.";
                break;
            case 'nogood'   :
                $reinfo['type'] = '비추천';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>명이 내글을 비추천하였습니다." : "<b>".$name."</b>님이 내글을 비추천하였습니다.";
                break;
            case 'cmt'      :
                $reinfo['type'] = '댓글';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>개의 댓글이 내글에 달렸습니다." : "<b>".$name."</b>님이 내글에 댓글을 남겼습니다.";
                break;
            case 'cmt_re':
                $reinfo['type'] = '대댓글';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>개의 대댓글이 내댓글에 달렸습니다." : "<b>".$name."</b>님이 내댓글에 대댓글을 남겼습니다.";
                break;
            case 'goodcmt'  :
                $reinfo['type'] = '댓글공감';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>명이 내댓글에 공감합니다." : "<b>".$name."</b>님이 내댓글을 공감하였습니다.";
                break;
            case 'nogoodcmt'    :
                $reinfo['type'] = '댓글비공감';
                $reinfo['mention'] = $cnt > 0 ?  "<b>".$name."</b>님외 <b>".$cnt."</b>명이 내댓글에 비공감합니다." : "<b>".$name."</b>님이 내댓글을 비공감하였습니다.";
                break;
        }
        return $reinfo;
    }

    /**
     * 나의 활동 기록
     */
    public function insert_activity($mb_id, $type, $content) {
        $act_content = serialize($content);
        $sql = "
            insert into {$this->g5['eyoom_activity']} set
                mb_id = '{$mb_id}',
                act_type = '{$type}',
                act_contents = '{$act_content}',
                act_regdt = '".G5_TIME_YMDHIS."'
        ";
        sql_query($sql, false);
    }

    /**
     * 푸쉬 생성
     */
    public function set_push($item,$val,$target_id,$mb_name,$re_type='') {
        /**
         * 푸쉬파일 저장 경로
         */
        $push_path = $this->member_path.'/push/';
        parent::make_directory($push_path);

        /**
         * 푸쉬파일 저장
         */
        $push_file = $this->member_path.'/push/push.'.$target_id.'.php';
        $push[$item]['val'] = $val;
        $push[$item]['nick'] = $mb_name;
        $push[$item]['type'] = $re_type;
        parent::save_file('push',$push_file,$push);
    }

    /**
     * date 함수를 이용한 날짜 표시
     */
    public function date_format($format, $date) {
        // $time : 예) YYYY-mm-dd HH:ii:ss
        // $format : 예) Y-m-d H:i:s
        $time = strtotime($date);
        return date($format,$time);
    }

    /**
     * date 시간형식으로 출력
     */
    public function date_time($format, $date) {
        $time = strtotime($date);
        $time_gap = time() - $time;
        if ($time_gap < 60) return $time_gap.'초전';
        else if ($time_gap < 3600) return round($time_gap/60).'분전';
        else if ($time_gap < 86400) {
            $minute = round(($time_gap%3600)/60);
            return round($time_gap/3600).'시간 '.$minute.'분전';
        }
        else return date($format,$time);
    }

    /**
     * 게시판 그룹정보
     */
    public function get_group() {
        $sql = " select gr_id, gr_subject from {$this->g5['group_table']} order by gr_id ";
        $result = sql_query($sql);
        $group = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $group[$i]['gr_id']      = $row['gr_id'];
            $group[$i]['gr_subject'] = $row['gr_subject'];
        }
        if (count($group) > 0) return $group; else return false;
    }

    /**
     * 전체 게시판 정보
     */
    public function get_bo_subject() {
        $fields = 'a.bo_table, a.bo_subject, a.bo_list_level, a.bo_use_secret, a.bo_use_search, b.gr_subject, b.gr_id';
        $sql = "select {$fields} from {$this->g5['board_table']} as a left join {$this->g5['group_table']} as b on a.gr_id = b.gr_id where 1 order by b.gr_subject asc, a.bo_subject asc";
        $res = sql_query($sql, false);
        $bo_name = array();
        for ($i=0; $row=sql_fetch_array($res);$i++) {
            $bo_name[$row['bo_table']]['gr_id'] = $row['gr_id'];
            $bo_name[$row['bo_table']]['gr_name'] = $row['gr_subject'];
            $bo_name[$row['bo_table']]['bo_name'] = $row['bo_subject'];
            $bo_name[$row['bo_table']]['bo_list_level'] = $row['bo_list_level'];
            $bo_name[$row['bo_table']]['bo_use_secret'] = $row['bo_use_secret'];
            $bo_name[$row['bo_table']]['bo_use_search'] = $row['bo_use_search'];
        }
        return $bo_name;
    }

    /**
     * 전체 게시판
     */
    public function get_all_board_info() {
        $sql = "select * from {$this->g5['board_table']} where (1) order by bo_subject asc";

        $res = sql_query($sql, false);
        $board_info = array();
        for ($i=0; $row=sql_fetch_array($res);$i++) {
            $board_info[$i] = $row;
        }
        return $board_info;
    }

    /**
     * 전체 그룹
     */
    public function get_all_group_info() {
        $sql = "select * from {$this->g5['group_table']} where (1) order by gr_subject asc";

        $res = sql_query($sql, false);
        $group_info = array();
        for ($i=0; $row=sql_fetch_array($res);$i++) {
            $group_info[$i] = $row;
        }
        return $group_info;
    }

    /**
     * 회원 추가 정보
     */
    public function get_user_info($mb_id='') {
        if (!$mb_id) return false;
        $single = false;
        if (is_array($mb_id)) {
            $where = "find_in_set(a.mb_id,'".implode(',',$mb_id)."')";
        } else {
            $where = "a.mb_id = '{$mb_id}'";
            $single = true;
        }
        $fields = "a.mb_nick, a.mb_name, a.mb_level, b.level, a.mb_email, a.mb_homepage, a.mb_tel, a.mb_hp, a.mb_point, a.mb_datetime, a.mb_signature, a.mb_profile, b.* ";
        $sql_common = " from {$this->g5['member_table']} as a left join {$this->g5['eyoom_member']} as b on a.mb_id = b.mb_id ";
        $sql = "select " . $fields . $sql_common . ' where ' . $where . ' order by a.mb_today_login desc';

        if ($single) {
            $user = sql_fetch($sql, false);
            if ($user['mb_id']) {
                return $user;
            } else {
                /**
                 * eyoom 멤버로 등록이 안되어 있다면 등록 후, 등록한 정보를 넘겨줌
                 */
                $insert = "insert into {$this->g5['eyoom_member']} set mb_id = '{$mb_id}'";
                sql_query($insert, false);
                return $this->get_user_info($mb_id);
            }
        } else {
            $res = sql_query($sql, false);
            $userinfo = array();
            for ($i=0;$row=sql_fetch_array($res);$i++) {
                $userinfo[$i] = $row;
            }
            return $userinfo;
        }
    }

    /**
     * 팔로우 상태 체크
     */
    public function follow_check($mb_id) {
        global $member;

        if (!$mb_id) return false;
        $check = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_follow']} where fo_my_id = '{$member['mb_id']}' and fo_mb_id = '{$mb_id}' ");

        if ($check['cnt']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 팔로잉 회원 - 내가 팔로우한 회원
     */
    public function following_member($mb_id, $cnt = '') {
        $limit = $cnt ? " limit {$cnt} ": '';
        $sql = "select b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_follow']} as a left join {$this->g5['member_table']} as b on a.fo_mb_id = b.mb_id where a.fo_my_id = '{$mb_id}' {$limit} ";
        $result = sql_query($sql);

        $my_following = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $my_following[$i] = $row;
            $my_following[$i]['mb_photo'] = $this->mb_photo($row['mb_id']);
        }
        return $my_following;
    }

    /**
     * 팔로워 회원 - 나를 팔로우한 회원
     */
    public function follower_member($mb_id, $cnt = '') {
        $limit = $cnt ? " limit {$cnt} ": '';
        $sql = "select b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_follow']} as a left join {$this->g5['member_table']} as b on a.fo_my_id = b.mb_id where a.fo_mb_id = '{$mb_id}' {$limit} ";
        $result = sql_query($sql);

        $my_follower = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $my_follower[$i] = $row;
            $my_follower[$i]['mb_photo'] = $this->mb_photo($row['mb_id']);
        }
        return $my_follower;
    }

    /**
     * 맞팔친구 회원
     */
    public function friends_member($mb_id, $cnt = '') {
        $limit = $cnt ? " limit {$cnt} ": '';
        $sql = "select b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_follow']} as a left join {$this->g5['member_table']} as b on a.fo_mb_id = b.mb_id where a.fo_my_id = '{$mb_id}' and fo_friends = 'y' {$limit} ";
        $result = sql_query($sql);

        $my_friends = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $my_friends[$i] = $row;
            $my_friends[$i]['mb_photo'] = $this->mb_photo($row['mb_id']);
        }
        return $my_friends;
    }

    /**
     * 나를 구독한 회원
     */
    public function subscriber_member($mb_id, $cnt = '') {
        $limit = $cnt ? " limit {$cnt} ": '';
        $sql = "select b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_subscribe']} as a left join {$this->g5['member_table']} as b on a.sb_my_id = b.mb_id where a.sb_mb_id = '{$mb_id}' {$limit} ";
        $result = sql_query($sql);

        $my_subscriber = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $my_subscriber[$i] = $row;
            $my_subscriber[$i]['mb_photo'] = $this->mb_photo($row['mb_id']);
        }
        return $my_subscriber;
    }

    /**
     * 내가 팔로우한 회원수 - 팔로윙
     */
    public function count_following($mb_id) {
        $info = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_follow']} where fo_my_id = '{$mb_id}' ", false);
        return $info['cnt'];
    }

    /**
     * 나를 팔로우한 회원수 - 팔로워
     */
    public function count_follower($mb_id) {
        $info = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_follow']} where fo_mb_id = '{$mb_id}' ", false);
        return $info['cnt'];
    }

    /**
     * 서로 팔로우한 회원수 - 맞팔친구
     */
    public function count_friends($mb_id) {
        $info = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_follow']} where fo_my_id = '{$mb_id}' and fo_friends = 'y' ", false);
        return $info['cnt'];
    }

    /**
     * 나를 구독한 회원수
     */
    public function count_subscriber($mb_id) {
        $info = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_subscribe']} where sb_mb_id = '{$mb_id}' ", false);
        return $info['cnt'];
    }

    /**
     * 구독 상태 체크
     */
    function subscribe_check($mb_id) {
        global $member;

        if (!$mb_id) return false;
        $check = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_subscribe']} where sb_my_id = '{$member['mb_id']}' and sb_mb_id = '{$mb_id}' ");

        if ($check['cnt']) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 내가 구독 신청한 회원
     */
    public function subscribe_member() {
        global $member;

        $sql = "select b.mb_id, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_subscribe']} as a left join {$this->g5['member_table']} as b on a.sb_mb_id = b.mb_id where a.sb_my_id = '{$member['mb_id']}' ";
        $result = sql_query($sql);

        $my_subscribe = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $my_subscribe[$i] = $row;
        }

        return $my_subscribe;
    }

    /**
     * 회원 프로필 사진
     * $type : img or icon
     */
    public function mb_photo($mb_id, $type='img') {
        global $config;

        if (!$type) $type = 'img';
        if ($type == 'icon' && $config['cf_use_member_icon']) {
            $member_dir = G5_DATA_PATH.'/member/';
            $mb_dir = substr($mb_id,0,2);
            $mb_icon_dir = $member_dir.$mb_dir;
            if (!is_dir($mb_icon_dir)) {
                @mkdir($mb_icon_dir, G5_DIR_PERMISSION);
                @chmod($mb_icon_dir, G5_DIR_PERMISSION);
            }
            $icon_file = $mb_icon_dir.'/'.get_mb_icon_name($mb_id).'.gif';
            if (file_exists($icon_file)) {
                $icon_filemtile = (defined('G5_USE_MEMBER_IMAGE_FILETIME') && G5_USE_MEMBER_IMAGE_FILETIME) ? '?'.filemtime($icon_file) : '';
                $width = $config['cf_member_icon_width'];
                $height = $config['cf_member_icon_height'];
                $icon_file_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.get_mb_icon_name($mb_id).'.gif'.$icon_filemtile;
                $photo = '<img src="'.$icon_file_url.'" width="'.$width.'" height="'.$height.'">';
            } else {
                $photo = '<i class="fa fa-user"></i>';
            }
        } else if ($type == 'img') {
            $photo = get_member_profile_img($mb_id);
            if (preg_match("/no_profile/i", $photo)) {
                $photo = '';
                $src_path = G5_DATA_PATH.'/member/profile/';
                $permit = array('jpg', 'jpeg', 'gif','png');
    
                foreach ($permit as $val) {
                    $photo_name = $mb_id.'.'.$val;
                    $photo_file = $src_path.$photo_name;
    
                    /**
                     * 사진이 있다면 변수 넘김
                     */
                    if (file_exists($photo_file)) {
                        $src_photo['path'] = $src_path;
                        $src_photo['name'] = $photo_name;
                        $this->moveto_mb_photo($mb_id, $src_photo);
                        $photo = get_member_profile_img($mb_id);
                        break;
                    }
                }
    
                if (!$photo) {
                    $photo = $this->make_mb_default_photo($mb_id);
                }
            }
            
            if (!$photo) {
                $photo = '<i class="fa fa-user"></i>';
            }
        }
        
        return $photo;
    }
    
    /**
     * 기본으로 등록된 회원 이미지 랜덤 설정
     */
    public function make_mb_default_photo ($mb_id) {
        $src_path = EYOOM_MISC_PATH.'/member_icon/';
        
        $photo_file = array();
        $tmp = @dir($src_path);
        if ($tmp) {
            while ($entry = $tmp->read()) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                } else {
                    $photo_file[] = $entry;   
                }
            }
        }

        $pf_cnt = count($photo_file);
        if ($pf_cnt > 0) {
            $hash_key = $this->random_num(1000)%$pf_cnt;
            $photo_name = $photo_file[$hash_key];
            $src_photo['path'] = $src_path;
            $src_photo['name'] = $photo_name;
            $this->moveto_mb_photo ($mb_id, $src_photo);
            $photo = get_member_profile_img($mb_id);
        }

        return $photo;
    }

    /**
     * 그누보드 회원 이미지로 적용하기
     */
    private function moveto_mb_photo ($mb_id, $src_photo) {
        global $config;

        $src_path = $src_photo['path'];
        $src_name = $src_photo['name'];
        $image_regex = "/(\.(gif|jpe?g|png))$/i";
        $mb_photo_img = get_mb_icon_name($mb_id).'.gif';

        if( $config['cf_member_img_width'] && $config['cf_member_img_height'] ) {
            $mb_img_tmp_dir = G5_DATA_PATH.'/member_image/';
            $mb_icon_tmp_dir = G5_DATA_PATH.'/member/';
            $mb_img_dir = $mb_img_tmp_dir.substr($mb_id,0,2);
            $mb_icon_dir = $mb_icon_tmp_dir.substr($mb_id,0,2);
            if( !is_dir($mb_img_tmp_dir) ){
                @mkdir($mb_img_tmp_dir, G5_DIR_PERMISSION);
                @chmod($mb_img_tmp_dir, G5_DIR_PERMISSION);
            }
            if( !is_dir($mb_icon_tmp_dir) ){
                @mkdir($mb_icon_tmp_dir, G5_DIR_PERMISSION);
                @chmod($mb_icon_tmp_dir, G5_DIR_PERMISSION);
            }

            if (file_exists($src_path.$src_name) && preg_match($image_regex, $src_name) ) {
                @mkdir($mb_img_dir, G5_DIR_PERMISSION);
                @chmod($mb_img_dir, G5_DIR_PERMISSION);
                @mkdir($mb_icon_dir, G5_DIR_PERMISSION);
                @chmod($mb_icon_dir, G5_DIR_PERMISSION);

                $dest_img_path = $mb_img_dir.'/'.$mb_photo_img;
                $dest_icon_path = $mb_icon_dir.'/'.$mb_photo_img;

                if (file_exists($src_path.$src_name)) {
                    @copy($src_path.$src_name, $dest_img_path);
                    @chmod($dest_img_path, G5_FILE_PERMISSION);
                    
                    if (file_exists($dest_img_path)) {
                        $size = @getimagesize($dest_img_path);
                        if (!($size[2] === 1 || $size[2] === 2 || $size[2] === 3)) {
                            @unlink($dest_img_path);
                        } else {
                            /**
                             * 썸네일 라이브러리
                             */
                            @include_once(G5_LIB_PATH . '/thumbnail.lib.php');

                            $thumb_img = null;
                            if($size[2] === 2 || $size[2] === 3) {
                                //jpg 또는 png 파일 적용
                                $thumb_img = thumbnail($mb_photo_img, $mb_img_dir, $mb_img_dir, $config['cf_member_img_width'], $config['cf_member_img_height'], true, true);
                                if($thumb_img) {
                                    @unlink($dest_img_path);
                                    rename($mb_img_dir.'/'.$thumb_img, $dest_img_path);
                                }

                                // 회원아이콘 만들기
                                if (!file_exists($dest_icon_path)) {
                                    @copy($src_path.$src_name, $dest_icon_path);
                                    @chmod($dest_icon_path, G5_FILE_PERMISSION);

                                    $size2 = @getimagesize($dest_icon_path);
                                    if (!($size2[2] === 1 || $size2[2] === 2 || $size2[2] === 3)) {
                                        @unlink($dest_icon_path);
                                    } else if ($size2[0] > $config['cf_member_icon_width'] || $size2[1] > $config['cf_member_icon_height']) {
                                        $thumb_icon = null;
                                        if($size2[2] === 2 || $size2[2] === 3) {
                                            //jpg 또는 png 파일 적용
                                            $thumb_icon = thumbnail($mb_photo_img, $mb_icon_dir, $mb_icon_dir, $config['cf_member_icon_width'], $config['cf_member_icon_height'], true, true);
                                            if($thumb_icon) {
                                                @unlink($dest_icon_path);
                                                rename($mb_icon_dir.'/'.$thumb_icon, $dest_icon_path);
                                            }
                                        }
                                        if( !$thumb_icon ){
                                            // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                                            @unlink($dest_icon_path);
                                        }
                                    }
                                }
                            }
                            if( !$thumb_img ){
                                // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                                @unlink($dest_img_path);
                            }
                        }

                        sql_query("update {$this->g5['eyoom_member']} set photo = '".$mb_photo_img."' where mb_id='".$mb_id."'");
                    }
                }
            }
        }
    }

    /**
     * 회원 마이홈 커버이미지
     */
    private function myhome_cover($mb_id,$photo_filename='') {
        $photo = '';
        $dest_path = G5_DATA_PATH.'/member/cover/';
        $dest_url = G5_DATA_URL.'/member/cover/';
        $permit = array('jpg','gif','png');
        if ($photo_filename) {
            $photo_file = $dest_path.$photo_filename;
            if (file_exists($photo_file)) {
                $photo = '<img src="'.$dest_url.$photo_filename.'" alt="커버이미지">';
            }
        } else return false;
        return $photo;
    }

    /**
     * 회원 레벨 정보
     */
    public function eyoom_level_info($member) {
        global $eyoomer, $levelinfo, $levelset;

        $lvinfo = $levelinfo[$eyoomer['level']];
        $bar_len = $lvinfo['max'] - $lvinfo['min'];
        $lv_len = $eyoomer['level_point'] - $lvinfo['min'];
        $ratio = ($lv_len/$bar_len)*100;
        if ($ratio >= 100) {
            $eyoomer['level'] = $eyoomer['level']+1;
            $this->level_point(1);
            $lvinfo = $levelinfo[$eyoomer['level']];
            $bar_len = $lvinfo['max'] - $lvinfo['min'];
            $lv_len = $eyoomer['level_point'] - $lvinfo['min'];
            $ratio = ceil(($lv_len/$bar_len)*100);
        }
        $lvinfo = $levelinfo[$eyoomer['level']];
        $lvinfo['gnu_name'] = $levelset['gnu_alias_'.$member['mb_level']];
        $lvinfo['level'] = $eyoomer['level'];
        $lvinfo['ratio'] = ceil($ratio*100)/100;
        return $lvinfo;
    }

    /**
     * 레벨 포인트
     */
    public function level_point($point,$r_id='',$r_point=0) {
        global $eyoomer;
        if ($point) {
            $level_point = $eyoomer['level_point'];
            $point_sum = $level_point + $point;
            $level = $this->get_level_from_point($point_sum,$eyoomer['level']);

            $sql = "update {$this->g5['eyoom_member']} set level='{$level}', level_point='{$point_sum}' where mb_id='{$eyoomer['mb_id']}'";
            sql_query($sql, false);

            if ($r_id) {
                $sql = "update {$this->g5['eyoom_member']} set level_point=level_point+".$r_point." where mb_id='{$r_id}'";
                sql_query($sql, false);
            }
        } else return false;
    }

	/**
     * 그누레벨 자동업/다운
     */
	public function set_gnu_level($level) {
		global $g5, $member;
		$mb_level = $this->get_gnulevel_from_eyoomlevel($level);
		if($mb_level != $member['mb_level']) {
			sql_query("update {$g5['member_table']} set mb_level = '{$mb_level}' where mb_id='{$member['mb_id']}'");
		} else return false;
	}

	/** 
     * 이윰레벨에서 그누레벨 가져오기
     */
	private function get_gnulevel_from_eyoomlevel($level) {
		global $levelset;
		$gnulevel = array();
		for($i=2;$i<=$levelset['max_use_gnu_level'];$i++) {
			$lv_key = 'cnt_gnu_level_'.$i;
			$max = $levelset[$lv_key] + $gnulevel[$i-1];
			$gnulevel[$i] = $max;
		}
		foreach($gnulevel as $gnu_lv => $max_level) {
			if($level > $max_level) {
				if($gnu_lv == $levelset['max_use_gnu_level']) $mb_level = $gnu_lv;
				else $mb_level = $gnu_lv + 1;
			} else {
				$mb_level = $gnu_lv;
				break;
			}
		}
		return $mb_level;
	}

    /**
     * 포인트를 통한 레벨 가져오기
     */
    private function get_level_from_point($point,$level) {
        global $levelinfo;

        $lvinfo = $levelinfo[$level];
        if ($point > $lvinfo['max']) {
            $level++;
            // 만렙일 경우, 만렙을 유지
            $lvinfo = $levelinfo[$level];
            if (!$lvinfo['min']) $level--;
        }
        if ($point < $lvinfo['min']) $level--;
        return $level;
    }

    /**
     * 레벨포인트에 따른 조정된 eyoom레벨 가져오기
     */
    public function get_eyoom_level($point, $level) {
        $_level = $this->get_level_from_point($point,$level);
        if ($_level == $level) {
            return $_level;
        } else {
            return $this->get_eyoom_level($point, $_level);
        }
    }

    /**
     * eyoom레벨에서 최종 조정된 그누레벨 가져오기
     */
    public function get_gnu_level($level,$mb_level) {
        $_level = $this->get_gnulevel_from_eyoomlevel($level);
        if ($_level != $mb_level) {
            return $this->get_gnu_level($level,$_level);
        } else return $_level;
    }

    /**
     * 유저의 레벨정보
     */
    public function user_level_info($user) {
        global $levelinfo, $levelset;

        $lvinfo = $levelinfo[$user['level']];
        $bar_len = $lvinfo['max'] - $lvinfo['min'];
        $lv_len = $user['level_point'] - $lvinfo['min'];
        if (!$bar_len) $bar_len = 1;
        $ratio = ceil(($lv_len/$bar_len)*100);

        $lvinfo['gnu_name'] = $levelset['gnu_alias_'.$user['mb_level']];
        $lvinfo['level'] = $user['level'];
        $lvinfo['ratio'] = $ratio;
        return $lvinfo;
    }

    /**
     * $levels : "그누레벨|eyoom레벨" 형식
     */
    public function level_info($levels) {
        global $levelset, $levelinfo, $eyoom;
        if ($levels) {
            list($gnu_level,$eyoom_level,$anonymous) = explode('|',$levels);
            if ($anonymous == 'y') {
                $level['anonymous'] = true;
                return $level;
            } else {
                $level['gnu_name'] = $levelset['gnu_alias_'.$gnu_level];
                $level['name'] = $levelinfo[$eyoom_level]['name'];
                $level['gnu_level'] = $gnu_level;
                $level['eyoom_level'] = $eyoom_level;

                $icon_path = EYOOM_THEME_PATH.'/image/level_icon';
                $icon_dir = EYOOM_THEME_URL.'/image/level_icon';
                if ($eyoom['use_level_icon_gnu'] == 'y') {
                    if ($gnu_level == 10) $_gnu_level = 'admin';
                    else $_gnu_level = $gnu_level;
                    $gnu_path = $icon_path.'/gnuboard/'.$eyoom['level_icon_gnu'].'/'.$_gnu_level.'.gif';
                    if (file_exists($gnu_path)) $level['gnu_icon'] = $icon_dir.'/gnuboard/'.$eyoom['level_icon_gnu'].'/'.$_gnu_level.'.gif';
                }
                if ($eyoom['use_level_icon_eyoom'] == 'y') {
                    if ($gnu_level == 10) $_eyoom_level = 'admin';
                    else $_eyoom_level = $eyoom_level;
                    $eyoom_path = $icon_path.'/eyoom/'.$eyoom['level_icon_eyoom'].'/'.$_eyoom_level.'.gif';
                    if (file_exists($eyoom_path)) {
                        $level['eyoom_icon'] = $icon_dir.'/eyoom/'.$eyoom['level_icon_eyoom'].'/'.$_eyoom_level.'.gif';
                        $level['grade_icon'] = $icon_dir.'/grade/'.$eyoom['level_icon_eyoom'].'/g'.$_eyoom_level.'.gif';
                    }
                }
                return $level;
            }
        } else return false;
    }

    /**
     * 그누레벨에 해당하는 최소 eyoom레벨의 min 경험치를 계산합니다.
     */
    public function get_level_point_from_gnulevel($level) {
        global $levelset;

        $mgl = $levelset['max_use_gnu_level'];
        if ($level > $mgl) $level = $mgl;

        $cgl2 = $levelset['cnt_gnu_level_2'];
        $cgl3 = $levelset['cnt_gnu_level_3'];
        $cgl4 = $levelset['cnt_gnu_level_4'];
        $cgl5 = $levelset['cnt_gnu_level_5'];
        $cgl6 = $levelset['cnt_gnu_level_6'];
        $cgl7 = $levelset['cnt_gnu_level_7'];
        $cgl8 = $levelset['cnt_gnu_level_8'];
        $cgl9 = $levelset['cnt_gnu_level_9'];

        $clp = $levelset['calc_level_point'];
        $clr = $levelset['calc_level_ratio'];

        $lv = 1;
        for ($i=2;$i<=$level;$i++) {
            $cgl_varname = 'cgl'.$i;
            $cgl = $$cgl_varname;
            for ($j=0;$j<$cgl;$j++) {
                $min = $max;
                $max = $max + $clp*$clr*$lv/100;
                if ($j == 0) $out_point = $min;
                $lv++;
            }
        }
        return $out_point;
    }

    /**
     * 경험치 포인트로부터 이윰레벨을 계산합니다.
     */
    public function get_eyoomlevel_from_point($point) {
        global $levelinfo;

        foreach($levelinfo as $level => $info) {
            if ($point >= $info['min'] && $point < $info['max']) {
                $eyoom_level = $level;
                break;
            }
        }

        return $eyoom_level;
    }

    /**
     * 댓글쓰기 포인트
     */
    public function point_comment() {
        global $member, $eyoom_board, $cmt_amt, $board, $wr_id, $comment_id, $wr;

        unset($point);
        // 첫댓글 포인트
        if($eyoom_board['bo_firstcmt_point'] > 0 && !$cmt_amt && $member['mb_id'] != $wr['mb_id']) {
            $point['firstcmt'] = $eyoom_board['bo_firstcmt_point_type'] == 1 ? $this->random_num($eyoom_board['bo_firstcmt_point']-1)+1 : $eyoom_board['bo_firstcmt_point'];
            if($eyoom_board['bo_cmtpoint_target'] == '1') {
                insert_point($member['mb_id'], $point['firstcmt'], $board['bo_subject'].' wr_id='.$wr_id.' 게시물 첫 댓글 포인트', '@firstcmt', $member['mb_id'], $board['bo_subject'].'|'.$wr_id.'|'.$comment_id);
            } else if($eyoom_board['bo_cmtpoint_target'] == '2') {
                $this->level_point($point['firstcmt']);
            }
        }

        /**
         * 지뢰폭탄 포인트 - 게시판 여유필드 eb_2를 사용
         */
        if($eyoom_board['bo_bomb_point'] > 0 && $eyoom_board['bo_bomb_point_limit'] > 0 && $eyoom_board['bo_bomb_point_cnt'] > 0 && $wr['eb_2']) {
            $bomb = @$this->mb_unserialize($wr['eb_2']);
            if(is_array($bomb)) {
                foreach($bomb as $key => $val) {
                    if($val == $cmt_amt) {
                        $point['bomb'][$key] = $eyoom_board['bo_bomb_point_type'] == 1 ? $this->random_num($eyoom_board['bo_bomb_point']-1)+1 : $eyoom_board['bo_bomb_point'];
                        if($eyoom_board['bo_cmtpoint_target'] == '1') {
                            insert_point($member['mb_id'], $point['bomb'][$key], $board['bo_subject'].' wr_id='.$wr_id.' 게시물 지뢰폭탄 포인트', '@bomb', $member['mb_id'], $board['bo_subject'].'|'.$wr_id.'|'.$comment_id.'|'.$key);
                        } else if($eyoom_board['bo_cmtpoint_target'] == '2') {
                            $this->level_point($point['bomb'][$key]);
                        }
                    }
                }
            }
        }

        /**
         * 럭키 포인트
         */
        if($eyoom_board['bo_lucky_point'] > 0 && $eyoom_board['bo_lucky_point_ratio'] > 0) {
            $max = ceil(100/$eyoom_board['bo_lucky_point_ratio']);
            $random = $this->random_num($max-1);
            if($random%$max == 0) {
                $point['lucky'] = $eyoom_board['bo_lucky_point_type'] == 1 ? $this->random_num($eyoom_board['bo_lucky_point']-1)+1 : $eyoom_board['bo_lucky_point'];
                if($eyoom_board['bo_cmtpoint_target'] == '1') {
                    insert_point($member['mb_id'], $point['lucky'], $board['bo_subject'].' wr_id='.$wr_id.' 게시물 행운의 포인트', '@lucky', $member['mb_id'], $board['bo_subject'].'|'.$wr_id.'|'.$comment_id);
                } else if($eyoom_board['bo_cmtpoint_target'] == '2') {
                    $this->level_point($point['lucky']);
                }
            }
        }
        if(is_array($point)) return $point;
    }

    /**
     * 전화번호 하이픈 자동생성
     * 전화번호를 읽기 좋은 형식으로 리턴
     */
    public function get_phone_number($str) {
        /**
         * 숫자이외 제거 
         */
        $tel = preg_replace("/[^0-9]*/s", "", $str);

        if (substr($tel,0,2) =='02') { // 서울전화번호 체크
            return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3", $tel);
        } else if (
            substr($tel,0,2) =='15' || 
            substr($tel,0,2) =='16'|| 
            substr($tel,0,2) =='18'
        ) { // 지능망 정보 체크
            return preg_replace("/([0-9]{4})([0-9]{4})$/","\\1-\\2", $tel);  
        } else { // 휴대폰번호
            return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$tel);
        }
    }

    /**
     * md5 암호화
     * 출처 : https://yadolee.com/tip/874
     * shadow님의 운영하는 사이트에서 php8.0 오류가 패치된 함수를 그대로 발췌하였습니다.
     */
    public function encrypt_md5($buf, $key="password") {
        $key1 = pack("H*",md5($key));
        $ret_buf = $hex_data = '';
        while(isset($buf) && $buf) {
            $m = substr($buf, 0, 16);
            $buf = substr($buf, 16);

            $c = "";
            $limit = strlen($m);
            for($i=0;$i<$limit;$i++) $c .= $m[$i]^$key1[$i];
            $ret_buf .= $c;
            $key1 = pack("H*",md5($key.$key1.$m));
        }

        $len = strlen($ret_buf);
        for($i=0; $i<$len; $i++) $hex_data .= sprintf("%02x", ord(substr($ret_buf, $i, 1)));
        return($hex_data);
    }

    /**
     * md5 복호화
     * 출처 : https://yadolee.com/tip/874
     * shadow님의 운영하는 사이트에서 php8.0 오류가 패치된 함수를 그대로 발췌하였습니다.
     */
    public function decrypt_md5($hex_buf, $key="password") {
        $len = strlen($hex_buf);
        for ($i=0; $i<$len; $i+=2) $buf .= chr(hexdec(substr($hex_buf, $i, 2)));

        $key1 = pack("H*", md5($key));
        $ret_buf = '';
        while(isset($buf) && $buf) {
            $m = substr($buf, 0, 16);
            $buf = substr($buf, 16);

            $c = "";
            $limit = strlen($m);
            for($i=0;$i<$limit;$i++) $c .= $m[$i]^$key1[$i];

            $ret_buf .= $m = $c;
            $key1 = pack("H*",md5($key.$key1.$m));
        }
        return($ret_buf);
    }

    /**
     * AES 암호화
     */
    public function encrypt_aes($str, $key = '') {
        if( version_compare( PHP_VERSION, '5.3' , '<' ) ){
            return $this->encrypt_md5($str, $key);
        } else {
            if (!$key) $key = SALT_KEY;
            return base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, true, str_repeat(chr(0), 16)));
        }
    }

    /**
     * AES 복호화
     */
    public function decrypt_aes($str, $key = '') {
        if( version_compare( PHP_VERSION, '5.3' , '<' ) ){
            return $this->decrypt_md5($str, $key);
        } else {
            if (!$key) $key = SALT_KEY;
            return openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, true, str_repeat(chr(0), 16));
        }
    }

    /**
     * unserialize : return false 오류 처리
     */
    public function mb_unserialize($serial_str) {
        if( version_compare( PHP_VERSION, '5.3' , '<' ) ){
            $unserialize_arr = unserialize($serial_str);
            if ($unserialize_arr && is_array($unserialize_arr)) {
                return $unserialize_arr;
            } else {
                $serial_str = preg_replace_callback(
                    '/s:(\d+):"([\s\S]*?)";/',
                    array($this, 'replace_serial_callback'),
                    $serial_str
                );
            }
        } else {
            $serial_str = preg_replace_callback('/s:(\d+):"([\s\S]*?)";/', function($matches) {
                return 's:'.strlen($matches[2]).':"'.$matches[2].'";';
            }, $serial_str);
            return unserialize($serial_str);  
        }
    }
    
    /**
     * php 5.3 이하버전을 위한 시리얼 콜백 함수
     */
    private function replace_serial_callback($matches) {
        return 's:'.strlen($matches[2]).':"'.$matches[2].'";';
    }

    /**
     * 서브 디렉토리에서 php 파일정보 가져오기
     */
    public function get_subdir_filename($dir) {
        $filename = array();
        $tmp = dir($dir);
        while ($entry = $tmp->read()) {
            if (preg_match('/(\.php)$/i', $entry))
                $filename[] = $entry;
        }

        return $filename;
    }

    /**
     * URL로 부터 파일정보 가져오기
     */
    public function get_filename_from_url($url = '') {
        if (!$url) $url = $_SERVER['SCRIPT_NAME'];

        $file_tmp = explode('/',str_replace('\\','/',$url));
        $cnt = count($file_tmp);
        $path['dirname']    = $file_tmp[($cnt-2)];
        $path['filename']   = $file_tmp[($cnt-1)];

        return $path;
    }

    /**
     * 파일 후킹 - eyoom로 강제 파일 지정하기
     */
    public function exchange_file($path='') {
        global $use_eyoom_builder;

        /**
         * URL로 부터 경로 정보를 가져오기
         */
        if (!$path) $path = $this->get_filename_from_url();

        /**
         * 대상파일명
         */
        $target = array(
            'move'              => 'board',
            'move_update'       => 'board',
            'group'             => 'board',
            'sns_send'          => 'board',
            'new_delete'        => 'new',
            'memo_form_update'  => 'member',
            'register_email'    => 'member',
            'poll_result'       => 'poll',
        );

        /**
         * @return 변경하고자 하는 파일 경로
         */
        $tg_key = str_replace('.php','',$path['filename']);

        /**
         * 관리자모드일 경우
         */
        if ($tg_key == 'index' && defined('G5_IS_ADMIN') && $this->config['cf_eyoom_admin'] != 'n' && $use_eyoom_builder === true) {
            return EYOOM_ADMIN_PATH . '/index.php';
        } else {
            if (in_array($tg_key, array_keys($target))) {
                return EYOOM_CORE_PATH . '/' . $target[$tg_key] . '/' . $path['filename'];
            } else {
                return false;
            }
        }
    }

    /**
     * 공사중 화면 출력 체크
     */
    public function under_construction() {
        /**
         * 접속 URL
         */
        $fname = $this->get_filename_from_url();

        /**
         * 로그인 및 로그인 체크가 아니라면 공사중으로 처리
         */
        if ($fname['filename'] != 'login.php' && $fname['filename'] != 'login_check.php') {
            /**
             * 설정파일
             */
            $countdown_config_file = G5_DATA_PATH . '/eyoom.countdown.php';
            if (file_exists($countdown_config_file) && !is_dir($countdown_config_file)) {
                include_once($countdown_config_file);

                if ($countdown['cd_use'] == 'y') {
                    $cd_date = $this->mktime_countdown_date($countdown['cd_opendate']);
                    if (isset($cd_date['mktime']) && $cd_date['mktime'] > time()) {

                        /**
                        * 스킨정보
                        */
                        $countdown_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/countdown/'.$countdown['cd_skin'];
                        $countdown_skin_url = str_replace(G5_PATH, G5_URL, $countdown_skin_path);

                        /**
                         * 공사중 스킨 페이지 출력
                         */
                        include($countdown_skin_path.'/countdown.skin.html.php');
                        exit;
                    } else {
                        /**
                         * 시간이 지난 공사중 설정 OFF
                         */
                        $countdown['cd_use'] = 'n';

                        /**
                         * 설정파일 저장
                         */
                        $this->save_file('countdown', $countdown_config_file, $countdown);
                    }
                }
            }
        }
    }

    /**
     * 공사중 설정 시간 변환하여 리턴
     */
    public function mktime_countdown_date($cd_datetime) {

        if (strlen($cd_datetime) == 12) {
            $cd_date = array();
            $cd_date['year']    = substr($cd_datetime,0,4);
            $cd_date['month']   = substr($cd_datetime,4,2);
            $cd_date['day']     = substr($cd_datetime,6,2);
            $cd_date['hour']    = substr($cd_datetime,8,2);
            $cd_date['minute']  = substr($cd_datetime,10,2);
            $cd_date['mktime']  = mktime($cd_date['hour'], $cd_date['minute'], 0, $cd_date['month'], $cd_date['day'], $cd_date['year']);
            $cd_date['month_text'] = date('F', $cd_date['mktime']);

            return $cd_date;

        } else {
            return false;
        }
    }

    /**
     * 리스트용 페이징 설정정보
     */
    public function set_paging($folder, $no='', $id='', $qstr='') {
        global $config, $pid;

        if ($folder == 'admin') {
            $qstr = '&amp;'.$qstr;
            $url = G5_ADMIN_URL.'/?dir='.$no.'&amp;pid='.$id.$qstr;
        } else {
            $qstr = $qstr ? $qstr: $id;

            // 짧은 주소 사용
            if ($config['cf_bbs_rewrite']) {
                switch ($folder) {
                    case 'board':
                        $url = get_eyoom_pretty_url($no, '', $qstr);
                        break;
                    case 'mbmemo':
                    case 'respond':
                        $url = G5_URL.'/mypage/'.$folder.'.php?'.$qstr;
                        break;
                    case 'tag':
                        $url = G5_URL.'/tag/?'.$qstr;
                        break;
                    case 'tag_list':
                        $url = G5_URL.'/tag/list.php?'.$qstr;
                        break;
                    case 'survey':
                        $url = G5_URL.'/survey/?'.$qstr;
                        break;
                    case 'event':
                    case 'itemqalist':
                    case 'itemuselist':
                    case 'orderaddress':
                    case 'orderinquiry':
                    case 'personalpay':
                        $url = G5_SHOP_URL.'/'.$folder.'.php?'.$qstr;
                        break;
                    case 'itemlist':
                        $url = shop_category_url($no).'?'.$qstr;
                        break;
                    case 'itemtype':
                        $url = shop_type_url($no).'?'.$qstr;
                        break;
                    case 'itemsearch':
                        $url = G5_SHOP_URL.'/search.php?'.$qstr;
                        break;
                    case 'brand':
                        $url = G5_SHOP_URL.'/brand.php?'.$qstr;
                        break;
                    default:
                        if ($pid) {
                            $url = G5_URL.'/page/'.$folder.'?'.$qstr;
                        } else {
                            $url = G5_BBS_URL.'/'.$folder.'.php?'.$qstr;
                        }
                        break;
                }
            }
            // 짧은 주소 미사용
            else {
                switch ($folder) {
                    case 'board':
                        $url = G5_BBS_URL.'/board.php?bo_table='.$no.$qstr.'&amp;page=';
                        break;
                    case 'memo':
                        $url = G5_BBS_URL.'/memo.php?kind='.$no.$qstr.'&amp;page=';
                        break;
                    case 'mbmemo':
                    case 'respond':
                        $url = G5_URL.'/mypage/'.$folder.'.php?'.$qstr.'&amp;page=';
                        break;
                    case 'tag':
                        $url = G5_URL.'/tag/?'.$qstr.'&amp;page=';
                        break;
                    case 'survey':
                        $url = G5_URL.'/survey/?'.$qstr.'&amp;page=';
                        break;
                    case 'tag_list':
                        $url = G5_URL.'/tag/list.php?'.$qstr.'&amp;page=';
                        break;
                    case 'event':
                    case 'itemqalist':
                    case 'itemuselist':
                    case 'orderaddress':
                    case 'orderinquiry':
                    case 'personalpay':
                        $url = G5_SHOP_URL.'/'.$folder.'.php?'.$qstr.'&amp;page=';
                        break;
                    case 'itemlist':
                        $url = G5_SHOP_URL.'/list.php?ca_id='.$no.$qstr.'&amp;page=';
                        break;
                    case 'itemtype':
                        $url = G5_SHOP_URL.'/listtype.php?type='.$no.$qstr.'&amp;page=';
                        break;
                    case 'itemsearch':
                        $url = G5_SHOP_URL.'/search.php?'.$qstr.'&amp;page=';
                        break;
                    case 'brand':
                        $url = G5_SHOP_URL.'/brand.php?'.$qstr.'&amp;page=';
                        break;
                    default:
                        if ($pid) {
                            $url = G5_URL.'/page/?pid='.$folder.$qstr.'&amp;page=';
                        } else {
                            $url = G5_BBS_URL.'/'.$folder.'.php?'.$qstr.'&amp;page=';
                        }
                        break;
                }
            }
        }

        $pg_pages = G5_IS_MOBILE ? $this->config['cf_mobile_pages']: $this->config['cf_write_pages'];
        $paging['ptype'] = $folder;
        $paging['url'] = $url;
        $paging['qstr'] = $qstr;
        $paging['pages'] = $pg_pages;

        return $paging;
    }

    /**
     * 연관태그 정보 불러오기
     */
    public function get_rel_tag($tag) {
        global $theme;

        $org_tag = str_replace('^','&',$tag);
        $tags = explode('*', $org_tag);
        if (is_array($tags)) {
            $tag_query = " and tw_theme = '" . sql_real_escape_string($theme) . "' ";
            $i=0;
            foreach ($tags as $_tag) {
                $sch_tag[$i] = " ( INSTR(wr_tag, '".$_tag."') > 0 ) ";
                @sql_query("update {$this->g5['eyoom_tag']} set tg_scnt = tg_scnt+1, tg_score = tg_score+1 where tg_theme='" . sql_real_escape_string($theme) . "' and tg_word = '{$_tag}'");
                $i++;
            }
            $tag_query .= ' and ' . implode(' and ', (array)$sch_tag);
        }
        $sql = "select wr_tag from {$this->g5['eyoom_tag_write']} as a where (1) {$tag_query}";
        $res = sql_query($sql);
        for ($i=0;$row=sql_fetch_array($res);$i++) {
            $in_tag = explode(',', $row['wr_tag']);
            foreach ($in_tag as $_tag) {
                $in_tags[trim($_tag)] = true;
            }
        }

        if (isset($in_tags)) {

            ksort($in_tags);
            $i=0;
            foreach ($in_tags as $_tag => $val) {
                if (in_array($_tag, $tags)) continue;
                else if ($_tag) {
                    $rel_tags[$i]['tag'] = $_tag;
                    $rel_tags[$i]['href'] = G5_URL . "/tag/?tag=" . $tag . "*" . str_replace('&','^',$_tag);
                    $i++;
                }
            }
        }
        $output['tag_query']    = $tag_query;
        $output['rel_tags']     = $rel_tags;
        $output['count']        = count((array)$rel_tags);

        return $output;
    }

    /**
     * Device의 OS검색
     */
    public function user_agent() {
        $iPod    = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $iPhone  = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $iPad    = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        if ($iPad||$iPhone||$iPod) {
            return 'ios';
        } else if($android) {
            return 'android';
        } else {
            return 'pc';
        }
    }

    /**
     * sql set배열을 sql문으로 완성하기
     */
    public function make_sql_set($source = array()) {
        $i=0;
        foreach ($source as $key => $val) {
            $set[$i] = "{$key} = '{$val}'";
            $i++;
        }
        if(is_array($set)) {
            return implode(',', (array)$set);
        }
    }

    /**
     * 태그 정보 가져오기
     */
    public function get_tag_info($bo_table, $wr_id) {
        global $theme;
        $sql = " select * from {$this->g5['eyoom_tag_write']} where tw_theme='" . sql_real_escape_string($theme) . "' and bo_table='{$bo_table}' and wr_id='{$wr_id}' ";
        return sql_fetch($sql, false);
    }

    /**
     * 링크 검증
     */
    public function filter_url($url) {
        $url = substr($url,0,1000);
        $url = trim(strip_tags($url));
        $url = preg_replace("#[\\\]+$#", "", $url);
        return $url;
    }

    /**
     * 스킨경로를 얻는다
     */
    public function get_skin_dir($skin, $skin_path=G5_SKIN_PATH) {
        global $g5;

        $result_array = array();

        $dirname = $skin_path.'/'.$skin.'/';
        if(!is_dir($dirname))
            return;

        $handle = opendir($dirname);
        while ($file = readdir($handle)) {
            if($file == '.'||$file == '..') continue;

            if (is_dir($dirname.$file)) $result_array[] = $file;
        }
        closedir($handle);
        sort($result_array);

        return $result_array;
    }

    /**
     * 소셜 정보 가져오기
     */
    public function sns_open_graph () {
        global $config, $write, $board, $bo_table, $wr_id, $it_id, $ca_id, $gr_id, $seocfg;

        if ($it_id && !is_array($it_id)) {
            $it = sql_fetch("select * from {$this->g5['g5_shop_item_table']} where it_id = '" . sql_real_escape_string($it_id) . "'");
            $head_title = strip_tags(conv_subject($it['it_name'], 255)) . ' - ' . $config['cf_title'];
            $sns_image = $it['it_img1'] ? G5_DATA_URL . '/item/'.$it['it_img1']: '';
            $target_url = shop_item_url($it_id);
            $contents = cut_str(trim(str_replace(array("\r\n","\r","\n"),'',strip_tags(preg_replace("/\?/","",$it['it_explan'])))),200, '…');
        } else if ($ca_id) {
            $ca = sql_fetch("select * from {$this->g5['g5_shop_category_table']} where ca_id = '" . sql_real_escape_string($ca_id) . "' ");
            $head_title = strip_tags(conv_subject($ca['ca_name'], 255)) . ' - ' . $config['cf_title'];
            $target_url = shop_category_url($ca_id);
            $contents = $seocfg['mt_description'] ? $seocfg['mt_description']: $config['cf_title'];
        } else if ($bo_table) {
            /**
             * 게시판 썸네일 라이브러리
             */
            @include_once(G5_LIB_PATH.'/thumbnail.lib.php');
            if ($wr_id) {
                $og_title = strip_tags(conv_subject($write['wr_subject'], 255));
                $first_image = get_list_thumbnail($bo_table, $wr_id, 600, 0);
                $sns_image = $first_image['src'] ? $first_image['src']: '';
                $target_url = get_eyoom_pretty_url($bo_table,$wr_id);
                $contents = cut_str(trim(str_replace(array("\r\n","\r","\n"),'',strip_tags(preg_replace("/\?/","",$write['wr_content'])))),200, '…');
            } else {
                $og_title = $seocfg['mt_title'];
                $target_url = get_eyoom_pretty_url($bo_table);
                $contents = $seocfg['mt_description'] ? $seocfg['mt_description']: $config['cf_title'];
                $sns_image = $seocfg['mt_img_url'];
            }
            $head_title = $og_title . ' > ' . $board['bo_subject'] . ' - ' . $config['cf_title'];
        } else if ($gr_id) {
            $gr = sql_fetch("select * from {$this->g5['group_table']} where gr_id = '" . sql_real_escape_string($gr_id) . "' ");
            $head_title = strip_tags(conv_subject($gr['gr_subject'], 255)) . ' - ' . $config['cf_title'];
            $target_url = get_eyoom_pretty_url('group', $gr_id);
            $contents = $seocfg['mt_description'] ? $seocfg['mt_description']: $config['cf_title'];
        } else {
            $head_title = $seocfg['mt_title'] ? $seocfg['mt_title']: $config['cf_title'];
            $target_url = G5_URL.$_SERVER['REQUEST_URI'];
            $contents = $seocfg['mt_description'] ? $seocfg['mt_description']: $config['cf_title'];
            $sns_image = $seocfg['mt_img_url'];
        }

        if (!$sns_image) {
            if ($seocfg['mt_img_url']) {
                $sns_image = $seocfg['mt_img_url'];
            } else {
                $sns_image = EYOOM_THEME_URL.'/image/site_logo.png';
            }
        }

        if ($sns_image) {
            $sns_image_path = str_replace(G5_URL, G5_PATH, $sns_image);
            if (file_exists($sns_image_path) && !is_dir($sns_image_path)) {
                $sns_image_size = @getimagesize($sns_image_path);
                $sns_image_width = $sns_image_size[0];
                $sns_image_height = $sns_image_size[1];
            } else {
                $sns_image_width = '';
                $sns_image_height = '';
            }
        }

        $open_graph = '
<meta property="og:id" content="'.G5_URL.'" />
<meta property="og:url" content="'.$target_url.'" />
<meta property="og:type" content="website" />
<meta property="og:title" content="'.preg_replace('/"/','',$head_title).'" />
<meta property="og:locale" content="ko_KR" />
<meta property="og:site_name" content="'.$config['cf_title'].'" />
<meta property="og:description" content="'.$contents.'"/>
<meta property="og:image" content="'.$sns_image.'" />
<meta property="og:image:width" content="'.$sns_image_width.'" />
<meta property="og:image:height" content="'.$sns_image_height.'" />
        ';

        $twitter_meta_tag = '
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="'.preg_replace('/"/','',$head_title).'">
<meta name="twitter:site" content="'.$config['cf_title'].'">
<meta name="twitter:creator" content="'.$seocfg['mt_img_url'].'">
<meta name="twitter:image" content="'.$sns_image.'">
<meta name="twitter:description" content="'.$contents.'">
        ';

        $google_meta_tag = '
<meta itemprop="name" content="'.$config['cf_title'].'">
<meta itemprop="description" content="'.$contents.'">
<meta itemprop="image" content="'.$sns_image.'">
        ';

        $meta_tag = $open_graph . $twitter_meta_tag . $google_meta_tag;

        return $meta_tag;
    }
}