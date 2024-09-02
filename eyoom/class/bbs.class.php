<?php
/**
 * bbs class
 */

class bbs extends eyoom
{
    public $g5;
    public $board;
    public $eyoom_board;

    public function __construct() {
        global $g5, $board, $eyoom_board;

        $this->g5 = $g5;
        $this->board = $board;
        $this->eyoom_board = $eyoom_board;

        /**
         * g5_board에 bo_wr_eb 필드추가
         */
        $this->check_bo_eb_fields();
    }

    /**
     * 이윰보드 설정값이 DB에 없는 상태에서 기본값 설정
     */
    public function board_default($bo_table) {
        global $theme;
        if ($bo_table) {
            $this->eyoom_board = array(
                'bo_table'                  => $bo_table,
                'bo_theme'                  => $theme,
                'bo_skin'                   => 'basic',
                'use_gnu_skin'              => 'n',
                'use_shop_skin'             => 'n',
                'bo_goto_url'               => '',
                'bo_sel_date_type'          => 1,
                'bo_use_hotgul'             => 0,
                'bo_use_anonymous'          => 0,
                'bo_use_infinite_scroll'    => 0,
                'bo_use_cmt_infinite'       => 0,
                'bo_use_cmt_best'           => 0,
                'bo_use_point_explain'      => 0,
                'bo_use_video_photo'        => 0,
                'bo_use_list_image'         => 0,
                'bo_use_good_member'        => 1,
                'bo_use_nogood_member'      => 0,
                'bo_use_yellow_card'        => 0,
                'bo_use_exif'               => 0,
                'bo_use_rating'             => 0,
                'bo_use_rating_list'        => 0,
                'bo_use_tag'                => 0,
                'bo_use_automove'           => 0,
                'bo_use_best'               => 0,
                'bo_use_addon_emoticon'     => 1,
                'bo_use_addon_video'        => 1,
                'bo_use_addon_coding'       => 0,
                'bo_use_addon_soundcloud'   => 0,
                'bo_use_addon_map'          => 0,
                'bo_use_addon_poll'         => 0,
                'bo_use_addon_cmtfile'      => 1,
                'bo_use_extimg'             => 0,
                'bo_use_adopt_point'        => 0,
                'bo_adopt_minpoint'         => 0,
                'bo_adopt_maxpoint'         => 0,
                'bo_adopt_ratio'            => 0,
                'bo_use_wrfixed'            => 0,
                'bo_wrfixed_type'           => '',
                'bo_wrfixed_point'          => 0,
                'bo_wrfixed_date'           => '',
                'bo_use_pointpost'          => 0,
                'bo_pointpost_point'        => 0,
                'bo_write_limit'            => 0,
                'bo_cmt_best_min'           => 10,
                'bo_cmt_best_limit'         => 5,
                'bo_tag_level'              => 2,
                'bo_tag_limit'              => 10,
                'bo_automove'               => '',
                'bo_best'                   => '',
                'bo_exif_detail'            => '',
                'bo_blind_limit'            => 5,
                'bo_blind_view'             => 10,
                'bo_blind_direct'           => 10,
                'bo_cmtpoint_target'        => 1,
                'bo_firstcmt_point'         => 0,
                'bo_firstcmt_point_type'    => 1,
                'bo_bomb_point'             => 0,
                'bo_bomb_point_type'        => 1,
                'bo_bomb_point_limit'       => 10,
                'bo_bomb_point_cnt'         => 1,
                'bo_lucky_point'            => 0,
                'bo_lucky_point_type'       => 1,
                'bo_lucky_point_ratio'      => 1,
                'download_fee_ratio'        => 0,
            );
            return $this->eyoom_board;

        } else {
            return false;
        }
    }

    /**
     * 이윰보드 설정정보
     */
    public function board_info($bo_table, $theme='') {
        $sql = "select a.*,b.bo_subject,c.gr_subject from {$this->g5['eyoom_board']} as a left join {$this->g5['board_table']} as b on a.bo_table = b.bo_table left join {$this->g5['group_table']} as c on b.gr_id = c.gr_id where a.bo_table='{$bo_table}' limit 1";
        return sql_fetch($sql);
    }

    /**
     * 특정 그룹에 소속된 게시판
     */
    public function group_bo_table($gr_id) {
        $gr_id = preg_replace('/[^a-z0-9_]/i', '', $gr_id);
        $result = sql_query("select bo_table from {$this->g5['board_table']} where (1) and gr_id = '" . sql_real_escape_string($gr_id) . "' ");
        $bo_table = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bo_table[$i] = $row['bo_table'];
        }

        return $bo_table;
    }

    /**
     * 모든 그룹정보를 gr_id 값으로 추출
     */
    public function get_group() {
        $sql = "select * from {$this->g5['group_table']}  where (1) order by gr_id asc";
        $result = sql_query($sql);
        $group = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $group[$i] = $row['gr_id'];
        }

        return $group;
    }

    /**
     * 게시판 관리자 설정 URL
     */
    public function board_config_url($pid_handle='') {
        global $eyoom_board;

        if (!$pid_handle) return;

        $config_url = G5_ADMIN_URL;
        if ($eyoom_board['cf_eyoom_admin_theme'] == 'basic') {
            switch ($pid_handle) {
                case 'copy'     : $dir = 'board'; $pid = 'board_copy'; break;
                case 'basic'    : $dir = 'board'; $pid = 'board_form'; break;
                case 'addon'    : $dir = 'theme'; $pid = 'board_form'; break;; break;
                case 'extend'   : $dir = 'board'; $pid = 'board_extend'; break;
            }
        } else {
            switch ($pid_handle) {
                case 'copy'     : $dir = 'board'; $pid = 'board_copy'; break;
                case 'basic'    : $dir = 'board'; $pid = 'board_form'; break;
                case 'addon'    : $dir = 'board'; $pid = 'board_addon'; break;
                case 'extend'   : $dir = 'board'; $pid = 'board_extend'; break;
            }
        }
        $config_url .= "/?dir={$dir}&amp;pid={$pid}&amp;bo_table={$eyoom_board['bo_table']}";
        $config_url .= $pid_handle == 'basic' ? "&amp;w=u": "";
        $config_url .= "&amp;wmode=1";

        return $config_url;
    }

    /**
     * 이윰 게시판 최초 설정으로 이윰빌더용 확장필드 추가
     */
    public function make_eb_fields($bo_table) {
        global $is_admin;

        /**
         * 최고관리자일 경우만 허용
         */
        if ($is_admin != 'super') return;

        $write_table = $this->g5['write_prefix'] . $bo_table;
        if ($this->board && $this->board['bo_table'] && !sql_query(" select eb_1 from {$write_table} limit 1 ", false)) {
            $k = 1;
            $add_set = array();
            for ($i=0; $i<10; $i++) {
                $field_name = 'eb_' . $k;
                $after_field = $i==0 ? 'wr_10': 'eb_' . $i;
                $add_set[$i] = " add `{$field_name}` varchar(255) not null default '' after `{$after_field}`";
                $k++;
            }

            $add_fields = implode(',', $add_set);

            $sql = " alter table `{$write_table}` {$add_fields}";
            sql_query($sql, true);
        }
    }

    public function make_anonymous_fields($bo_table) {
        global $is_admin, $latest;

        /**
         * 최고관리자일 경우만 허용
         */
        if ($is_admin != 'super') return;

        $write_table = $this->g5['write_prefix'] . $bo_table;

        /**
         * g5_board_new 테이블에 wr_hit 및 wr_comment 필드 체크 후, 없다면 추가
         */
        if(!sql_query(" select wr_hit from {$this->g5['board_new_table']} limit 1 ", false)) {
            $sql = " alter table `{$this->g5['board_new_table']}`
                        add `wr_hit` int(11) NOT NULL default '0' after `mb_id`,
                        add `wr_comment` int(11) NOT NULL default '0' after `wr_hit`
            ";
            sql_query($sql, true);

            /**
             * 추가된 wr_id에 실제 히트수 업데이트
             */
            $latest->update_wr_id();
        }

        /**
         * 게시판 테이블에 익명글 관련 필드 추가
         */
        if(!sql_query(" select wr_anonymous from {$write_table} limit 1 ", false)) {
            $sql = " alter table `{$write_table}`
                add `wr_anonymous` char(1) NOT NULL default '' after `wr_hit`
            ";
            sql_query($sql, true);
        }

        /**
         * 새글 테이블에 익명글 관련 필드 추가
         */
        if(!sql_query(" select wr_bo_anonymous from {$this->g5['board_new_table']} limit 1 ", false)) {
            $sql = " alter table `{$this->g5['board_new_table']}`
                add `wr_anonymous` char(1) NOT NULL default '' after `wr_hit`,
                add `wr_bo_anonymous` char(1) NOT NULL default '' after `wr_anonymous`
            ";
            sql_query($sql, true);
        }
    }

    /**
     * 최신글 테이블에 카테고리 분류 필드 및 미승인 여부 필드 추가
     */
    public function add_ca_name_fields() {
        if(!sql_query(" select ca_name from {$this->g5['board_new_table']} limit 1 ", false)) {
            $sql = " alter table `{$this->g5['board_new_table']}`
                add `ca_name` varchar(255) NOT NULL default '' after `mb_id`,
                add `wr_approval` tinyint(4) NOT NULL default '1' after `ca_name`
            ";
            sql_query($sql, true);
        } 
    }

    /**
     * 승인기능을 사용하는 게시판이라면 게시판 테이블에 wr_approval 필드 추가
     */
    public function add_approval_field($bo_table) {
        global $is_admin;

        /**
         * 최고관리자일 경우만 허용
         */
        if ($is_admin != 'super') return;

        $write_table = $this->g5['write_prefix'] . $bo_table;

        if (!sql_query(" select wr_approval from {$write_table} limit 1 ", false)) {
            $sql = " alter table `{$write_table}` add `wr_approval` tinyint(4) NOT NULL default '1' after `wr_homepage` ";
            sql_query($sql, true);
        }
    }

    /**
     * 익명 게시판 배열로 가져오기
     */
    public function anonymous_table() {
        $sql = "select bo_table from `{$this->g5['eyoom_board']}` where bo_use_anonymous='2' ";
        $result = sql_query($sql);
        $bo_table = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $bo_table[$i] = $row['bo_table'];
        }
        return $bo_table;
    }

    /**
     * 이윰빌더 시즌4에서는 그누보드 여분필드를 사용하지 않고 eb_1 ~ eb_10을 활용
     */
    public function convert_to_eb_fields($bo_table) {
        /**
         * 대상 테이블
         */
        $write_table = $this->g5['write_prefix'] . $bo_table;

        /**
         * 치환하기
         */
        for ($i=1; $i<=10; $i++) {
            $eb_set[$i] = " eb_{$i} = wr_{$i} ";
            $wr_set[$i] = " wr_{$i} = '' ";
        }
        $eb_fields = implode(',', $eb_set);
        $wr_fields = implode(',', $wr_set);
        $sql = "update {$write_table} set {$eb_fields}, {$wr_fields}";
        sql_query($sql, true);

        /**
         * 치환이 완료되었다면 bo_wr_eb 필드값 1
         */
        sql_query("update {$this->g5['board_table']} set bo_wr_eb = '1' where bo_table = '{$bo_table}' ", false);
    }

    /**
     * 여분필드 옮겼는지 체크를 위한 필드 추가
     */
    private function check_bo_eb_fields() {
        if (!sql_query(" select bo_wr_eb from {$this->g5['board_table']} limit 1 ", false)) {
            $sql = " alter table `{$this->g5['board_table']}` add `bo_wr_eb` char(1) NOT NULL default '0' after `bo_sort_field` ";
            sql_query($sql, true);
        }
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

        // 익명글
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

        // 열람하지 않은 내글반응이 이미 있는지 체크
        $row = sql_fetch(" select rid from {$this->g5['eyoom_respond']} where $where and re_chk <> '1' order by rid desc ", false);
        $rid = $row['rid'];

        if ($rid) {
            // 열람하지 않은 내글반응이 이미 있을 경우, 카운트만 올림
            sql_query("update {$this->g5['eyoom_respond']} set re_cnt=re_cnt+1, regdt='".G5_TIME_YMDHIS."' where rid='{$rid}'", false);
        } else {
            // 내글 반응 등록
            $insert = " insert into {$this->g5['eyoom_respond']} set $set regdt = '".G5_TIME_YMDHIS."' ";
            sql_query($insert, false);
            $rid = sql_insert_id();

            // 원본글 작성자의 반응글 적용
            $row = sql_fetch("select mb_id from {$this->g5['eyoom_member']} where mb_id = '{$wr_mb_id}'", false);
            if ($row['mb_id']) {
                sql_query(" update {$this->g5['eyoom_member']} set respond = respond + 1 where mb_id = '{$wr_mb_id}' ", false);
            } else {
                sql_query(" insert into {$this->g5['eyoom_member']} set mb_id = '{$wr_mb_id}', respond=1", false);
            }
        }

        // 푸시등록
        $user = sql_fetch("select onoff_push_respond from {$this->g5['eyoom_member']} where mb_id = '{$wr_mb_id}'");
        if ($user['onoff_push_respond'] == 'on') parent::set_push("respond",$rid,$wr_mb_id,$mb_nick,$type);

    }

    /**
     * 게시판 내용 필터
     */
    public function board_content($content, $bo_table='', $wr_id='', $c_id='') {
        global $config;

        if ($bo_table) $this->bo_table = $bo_table;
        if ($wr_id) $this->wr_id = $wr_id;
        if ($c_id) $this->c_id = $c_id;

        /**
         * SyntaxHighlighter 처리하기
         */
        $this->content = $this->syntaxhighlighter($content);

        /**
         * 썸네일화하기
         */
        $this->content = $this->get_thumbnail($this->content);


        if (!($config['cf_editor'] == 'tuieditor' && $c_id == null)) {
            /**
             * 동영상
             */
            $this->content = preg_replace_callback('/{동영상\s*\:([^}]*)}/i', array($this,'video_content'), $this->content);

            /**
             * 이모티콘
             */
            $this->content = preg_replace_callback('/{이모티콘\s*\:([^}]*)}/i', array($this, 'emoticon_image'), $this->content);

            /**
             * 사운드클라우드
             */
            $this->content = preg_replace_callback('/{soundcloud\s*\:([^}]*)}/i', array($this, 'soundcloud_content'), $this->content);

            /**
             * 지도
             */
            $this->content = preg_replace_callback('/{지도\s*\:([^}]*)}/i', array($this, 'map_content'), $this->content);
        }

        return $this->content;
    }

    /**
     * 게시글 내용에서 텍스트만 추출
     */
    public function text_abstract($content, $length=300) {
        $content = preg_replace("#\\r#","",cut_str(str_replace('&nbsp;','',strip_tags(stripslashes($content))),$length,''));
        $content = preg_replace("#\\n#","",$content);
        $content = preg_replace("#\\t#","",$content);
        return $content;
    }

    /**
     * syntaxhighlighter 코드표시
     */
    public function syntaxhighlighter($content) {
        //$content = preg_replace('/{CODE\s*\:([^}]*)}/i',"<pre class=\"brush: \\1;\">",$content);
        $content = preg_replace('/{CODE\s*\:([^}]*)}/i',"<pre class=\" language-\\1 line-numbers code-toolbar\"><code class=\"language-\\1\">",$content);
        $content = preg_replace('/{\/CODE}/i',"</code></pre>",$content);
        $content = preg_replace_callback('/<pre[^>]*>(.*?)<\/pre>/s',array($this,'syntaxhighlighter_remove_tag'),$content);
        return $content;
    }

    /**
     * syntaxhighlighter 에서 불필요한 태그 정리
     */
    private function syntaxhighlighter_remove_tag($str) {
        $code = $str[0];
        $code = preg_replace('/(<BR>|<BR \/>|<BR\/>|<DIV>|<\/DIV>|<P>|<\/P>)/i','',$code);
        return $code;
    }

    /**
     * 내용중에 동영상 정보 추출하기
     */
    public function video_content($video_url) {
        $v_url = trim(strip_tags($video_url[1]));
        $v_url = preg_replace('/<a href="([^"]+)">.+/i', '$1', htmlspecialchars_decode($v_url));
        $v_url = trim(strip_tags($v_url));
        $video_url = preg_replace('/&#?[a-z0-9]+;/i','',htmlentities($v_url));
        $video_url = preg_replace('/nbsp;/i','',$video_url );
        $src = explode('|', $video_url);

        /**
         * 동영상 정보 가져오기
         */
        $video = $this->video_from_soruce($src);

        /**
         * 동영상 사이즈 기본값
         */
        if (!$video['width']) {
            $video['width'] = $this->board['bo_image_width'];
        }
        if (!$video['height']) {
            $video['height'] = 360;
        }

        /**
         * 동영상 정보를 컨텐츠에 업데이트
         */
        if (!$src[1] && $this->bo_table && $this->wr_id) {
            $video_info[0] = $v_url;
            $video_info[1] = $video['key1'];
            if ($video['key2']) {
                $video_info[2] = $video['key2'];
            }
            if ($video['key2'] && $video['key3']) {
                $video_info[3] = $video['key3'];
            }
            $video_query = implode('|', $video_info);

            /**
             * 대상 테이블
             */
            $write_table = $this->g5['write_prefix'] . $this->bo_table;

            /**
             * 로딩속도 개선을 위해 동영상 컨텐츠의 동영상 경로 업데이트
             */
            if ($this->content) {
                if ($this->c_id) {
                    $this->content = strip_tags(stripslashes($this->content));
                    $wr_id = $this->c_id;
                } else {
                    $this->content = stripslashes($this->content);
                    $wr_id = $this->wr_id;
                }

                $this->content = addslashes(str_replace($v_url, $video_query, $this->content));
                $wr_id = $this->c_id ? $this->c_id: $this->wr_id;
                $sql = "update {$write_table} set wr_content = '{$this->content}' where wr_id = '{$wr_id}' ";
                sql_query($sql);
            }
        }

        /**
         * 동영상 플레이 소스로 컨버팅
         */
        return $this->video_source($video);
    }

    /**
     * 경로로 부터 동영상정보 가져오기
     */
    private function video_from_soruce($src) {
        $url = $src[0];
        $video_url = trim(strip_tags($url));
        $video_url = preg_replace('/amp;/','&',$video_url);
        $info = $this->eyoom_host($video_url);
        $host = $info['host'];
        $query = $info['query'];
        $video['host'] = $host;

        /**
         * 동영상 key 추출하기
         */
        switch($host) {
            /**
             * Youtube
             */
            case 'youtube.com':
                if ($src[1]) {
                    $video['key1'] = $src[1];
                } else if ($query['v']) {
                    $video['key1'] = $query['v'];;
                } else {
                    $video['key1'] = str_replace('/embed/', '', $info['path']);
                }
                $video['key1'] = str_replace('/live/', '', $video['key1']);
                $video['key1'] = str_replace('/shorts/', '', $video['key1']);
                break;

            /**
             * Vimeo
             */
            case 'vimeo.com':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['imgkey'];
                }
                break;

            /**
             * Naver
             */
            case 'tvcast.naver.com':
            case 'tv.naver.com':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['imgsrc'];
                }
                break;

            /**
             * Ted
             */
            case 'ted.com':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $this->get_video_key($info);
                    $video['key2'] = $data['imgsrc'];
                }
                break;

            /**
             * Daum Kakao
             */
            case 'tvpot.daum.net':
            case 'tv.kakao.com':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['imgsrc'];
                }
                break;

            /**
             * Pandora
             */
            case 'channel.pandora.tv':
            case 'pan.best':
                if ($src[1] && $src[2] && $src[3]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                    $video['key3'] = $src[3];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['prgid'];
                    $video['key2'] = $data['userid'];
                    $video['key3'] = $data['imgsrc'];
                }
                break;

            /**
             * Dailymotion
             */
            case 'dailymotion.com':
            case 'dai.ly':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['imgsrc'];
                }
                break;

            /**
             * Facebook
             */
            case 'facebook.com':
                if ($query['video_id']) {
                    $video['key1'] = $query['video_id'];
                } else {
                    $video['key1'] = $query['v'];
                }
                if (!is_numeric($video['key1'])) $video = NULL;
                break;

            /**
             * Slideshare
             */
            case 'slideshare.net':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['imgsrc'];
                }
                break;

            /**
             * China : Youku
             */
            case 'youku.com':
            case 'v.youku.com':
                if ($src[1]) {
                    $video['key1'] = $src[1];
                } else {
                    $v_url = parse_url($video_url);
                    $tmp = explode('/',$v_url['path']);
                    $key = trim($tmp[count($tmp)-1]);
                    $key = str_replace('id_','',$key);
                    $video['key1'] = str_replace('.html','',$key);
                }
                break;
            case 'player.youku.com':
                if ($src[1]) {
                    $video['key1'] = $src[1];
                } else {
                    $tmp = explode('/',$video_url);
                    $video['key1'] = trim($tmp[count($tmp)-2]);
                }
                break;

            /**
             * China : Iqiyi
             */
            case 'player.video.qiyi.com':
                if ($src[1] && $src[2]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                } else {
                    $tmp = explode('/',$video_url);
                    $tmp_key = trim($tmp[count($tmp)-1]);
                    $tmp_key = explode('-', $tmp_key);
                    $tmp_key = $tmp_key[2];
                    $key = explode('=', $tmp_key);
                    $video['key1'] = $tmp[3];
                    $video['key2'] = $key[1];
                }
                break;
            case 'iqiyi.com':
                if ($src[1] && $src[2] && $src[3]) {
                    $video['key1'] = $src[1];
                    $video['key2'] = $src[2];
                    $video['key3'] = $src[3];
                } else {
                    $data = $this->get_video_use_curl($video_url, $host);
                    $video['key1'] = $data['vid'];
                    $video['key2'] = $data['tvid'];
                    $video['key3'] = $data['imgsrc'];
                }
                break;

            /**
             * Default
             */
            default:
                $video['key1'] = $this->get_video_key($info);
                break;
        }
        return $video;
    }

    /**
     * 동영상 키값 추출
     */
    private function get_video_key($info) {
        $tmp = explode('/', $info['path']);
        $video_key = trim($tmp[count($tmp)-1]);
        return $video_key;
    }

    /**
     * CURL를 활용한 동영상페이지 웹스크랩핑
     */
    private function get_video_use_curl($url, $host) {
        /**
         * 웹스크래핑
         */
        $output = $this->curl_web_scripping($url);

        switch($host) {
            /**
             * Vimeo
             */
            case 'vimeo.com':
                preg_match('/\<meta property=\"og:url\"\scontent=\"(?P<vid>[a-zA-Z0-9:\/\._]+)\"/i', $output, $scrapping);
                $out['vid'] = $this->get_video_key($this->eyoom_host($scrapping['vid']));
                preg_match('/\<meta property=\"og:image\"([^\<\>])*\>/i', $output, $scrapping);
                $temp1 = explode('=', htmlspecialchars($scrapping[0]));
                $temp2 = explode('/', urldecode($temp1[3]));
                $temp3 = explode('_', urldecode($temp2[4]));
                $out['imgkey'] = $temp3[0];
                return $out;
                break;

            /**
             * Naver
             */
            //<meta property="og:video:url" content='
            case 'tvcast.naver.com':
            case 'tv.naver.com':
                // <meta property="og:url" content='https://tv.naver.com/v/18588378'>
                preg_match('/\<meta property=\"og:url\"\scontent=\'(?P<vid>[a-zA-Z0-9:\/\._]+)\'/i', $output, $scrapping);
                $out['vid'] = $this->get_video_key($this->eyoom_host($scrapping['vid']));
                preg_match('/\<meta property=\"og:image\"\scontent=\'(?P<imgsrc>[a-zA-Z0-9:\/\._]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * Ted
             */
            case 'ted.com':
                preg_match('/\<meta property=\"og:image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9-:\/\._]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * Daum Kakao
             */
            case 'tvpot.daum.net':
            case 'tv.kakao.com':
                preg_match('/\<meta property=\"og:url\"\scontent=\"(?P<vid>[a-zA-Z0-9:\/\._]+)\"/i', $output, $scrapping);
                $out['vid'] = $this->get_video_key($this->eyoom_host($scrapping['vid']));
                preg_match('/\<meta property=\"og:image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9:\/\._]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * Pandora
             */
            case 'channel.pandora.tv':
            case 'pan.best':
                preg_match('/\<meta property=\"og:url\"\scontent=\"(?P<url>[a-zA-Z0-9:\/\._]+)\"/i', $output, $scrapping);
                $tmp = explode('/', $scrapping['url']);
                $out['prgid'] = trim($tmp[count($tmp)-1]);
                $out['userid'] = trim($tmp[count($tmp)-2]);
                preg_match('/\<meta property=\"og:image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9:\/\._\?\=%]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * Dailymotion
             */
            case 'dailymotion.com':
            case 'dai.ly':
                $out['vid'] = $this->get_video_key($this->eyoom_host($url));
                preg_match('/\<meta property=\"og:image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9:\/\._-]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * Slideshare
             */
            case 'slideshare.net':
                preg_match('/\<meta class=\"twitter_player\"([^\<\>])*\>/i', $output, $scrapping);
                $temp = explode('embed_code/',htmlspecialchars($scrapping[0]));
                $res  = explode('&quot;',$temp[1]);
                $out['vid'] = $res[0];
                preg_match('/\<meta class=\"twitter_image\"\svalue=\"(?P<imgsrc>[a-zA-Z0-9:\/\._-]+)/i', $output, $scrapping);
                $out['imgsrc'] = $scrapping['imgsrc'];
                return $out;
                break;

            /**
             * China : Iqiyi
             */
            case 'iqiyi.com':
            case 'player.video.qiyi.com':
                preg_match('/param\[\'tvid\'\](\s=\s)\"(?P<tvid>[\d]+)/i', $output, $scrapping);
                $out['tvid'] = $scrapping['tvid'];
                preg_match('/param\[\'vid\'\](\s=\s)\"(?P<vid>[0-9a-zA-Z]+)/i', $output, $scrapping);
                $out['vid'] = $scrapping['vid'];
                preg_match('/\<meta property=\"og:image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9:\/\._-]+)/i', $output, $scrapping);
                $imgsrc = str_replace('.jpg', '_220_124.jpg', $scrapping['imgsrc']);
                if (!$imgsrc){
                    preg_match('/\<meta itemprop=\"image\"\scontent=\"(?P<imgsrc>[a-zA-Z0-9:\/\._-]+)/i', $output, $scrapping);
                    $imgsrc = $scrapping['imgsrc'];
                }
                $out['imgsrc'] = $imgsrc;
                return $out;
                break;
        }
    }

    /**
     * 수집된 동영상 정보를 iframe source로 구현
     */
    private function video_source($video) {
        switch($video['host']) {
            case 'youtu.be':
            case 'youtube.com':
                $vlist = $video['key2'] ? '&list='.$video['key2'] : '';
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="//www.youtube.com/embed/'.$video['key1'].'?wmode=opaque&autohide=1'.$vlist.'" frameborder="0" allowfullscreen></iframe>';
                break;
            case 'tvcast.naver.com':
            case 'tv.naver.com':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="https://tv.naver.com/embed/'.$video['key1'].'" frameborder="no" scrolling="no" marginwidth="0" marginheight="0" allowfullscreen></iframe>';
                break;
            case 'vimeo.com':
                $source = '<iframe src="//player.vimeo.com/video/'.$video['key1'].'" width="'.$video['width'].'" height="'.$video['height'].'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                break;
            case 'ted.com':
                $source = '<iframe src="https://embed-ssl.ted.com/talks/'.$video['key1'].'.html" width="'.$video['width'].'" height="'.$video['height'].'" frameborder="0" scrolling="no" allowFullScreen></iframe>';
                break;
            case 'tvpot.daum.net':
            case 'tv.kakao.com':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="http://videofarm.daum.net/controller/video/viewer/Video.html?vid='.$video['key1'].'&play_loc=undefined&wmode=opaque" frameborder="0" scrolling="no"></iframe>';
                break;
            case 'channel.pandora.tv':
            case 'pan.best':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="http://channel.pandora.tv/php/embed.fr1.ptv?userid='.$video['key2'].'&prgid='.$video['key1'].'&skin=1&autoPlay=false&share=on" frameborder="0" allowfullscreen></iframe>';
                break;
            case 'dailymotion.com':
            case 'dai.ly':
                $source = '<iframe frameborder="0" width="'.$video['width'].'" height="'.$video['height'].'" src="http://www.dailymotion.com/embed/video/'.$video['key1'].'"></iframe>';
                break;
            case 'facebook.com':
                $source = '<iframe src="https://www.facebook.com/video/embed?video_id='.urlencode($video['key1']).'" width="'.$video['width'].'" height="'.$video['height'].'" frameborder="0"></iframe>';
                break;
            case 'slideshare.net':
                $source = '<iframe src="https://www.slideshare.net/slideshow/embed_code/'.$video['key1'].'" width="'.$video['width'].'" height="'.$video['height'].'" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen></iframe>';
                break;
            case 'sendvid.com':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="//sendvid.com/embed/'.$video['key1'].'" frameborder="0" allowfullscreen></iframe>';
                break;
            case 'youku.com':
            case 'v.youku.com':
            case 'player.youku.com':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="http://player.youku.com/embed/'.$video['key1'].'" frameborder="0" allowfullscreen></iframe>';
                break;
            case 'iqiyi.com':
            case 'player.video.qiyi.com':
                $source = '<iframe width="'.$video['width'].'" height="'.$video['height'].'" src="http://open.iqiyi.com/developer/player_js/coopPlayerIndex.html?vid='.$video['key1'].'&tvId='.$video['key2'].'" frameborder="0" allowfullscreen></iframe>';
                break;
        }
        if ($source) {
            $source = "<div class='responsive-video'>".$source."</div>";
            return $source;
        } else return false;
    }

    /**
     * URL로부터 동영상 이미지 경로를 찾기
     */
    public function get_imgurl_from_video($src) {
        $video = $this->video_from_soruce($src);
        $video_url = $src[0];

        switch($video['host']) {
            case 'youtu.be':
            case 'youtube.com':
                $path_name = mb_substr($video['key1'],0,11,"utf-8");
                /**
	             * maxresdefault.jpg (1260 X 720) : 사이즈가 너무 크고, 지원하지 않는 동영상이 많아 사용에 부적합
	             * hqdefault.jpg (480 X 360) : 썸네일 상하단에 검은띠가 있어 사용할 수 없음
	             * mqdefault.jpg (320 X 180) : 사이즈는 작으나 거의 모든 동영상에서 지원
	             */
                $video['img_url'] = "http://img.youtube.com/vi/{$path_name}/mqdefault.jpg";
                break;

            case 'vimeo.com':
                $video['img_url'] = "https://i.vimeocdn.com/video/{$video['key2']}.jpg";
                break;

            case 'tvcast.naver.com':
            case 'tv.naver.com':
                $video['img_url'] = $video['key2'];
                break;
            case 'ted.com':
                $video['img_url'] = $video['key2'];
                break;
            case 'tvpot.daum.net':
            case 'tv.kakao.com':
                $video['img_url'] = $video['key2'];
                break;
            case 'channel.pandora.tv':
            case 'pan.best':
                $video['img_url'] = $video['key3'];
                break;
            case 'dailymotion.com':
            case 'dai.ly':
                $video['img_url'] = $video['key2'];
                break;
            case 'slideshare.net':
                $video['img_url'] = $video['key2'];
                break;
            case 'sendvid.com':
                $video['img_url'] = "http://sendvid.com/{$video['key1']}.jpg";
                break;
            case 'youku.com':
            case 'v.youku.com':
            case 'player.youku.com':
                $video['img_url'] = "https://vthumb.ykimg.com/vi/{$video['key1']}/89/default.jpg";
                break;
            case 'iqiyi.com':
            case 'player.video.qiyi.com':
                $video['img_url'] = $video['key3'];
                break;
            default : $video['img_url'] = ''; break;
        }
        return $video;
    }

    /**
     * 동영상 URL를 이용하여 목록이미지 thumbnail 생성하기
     */
    public function make_thumb_from_video($src, $bo_table, $wr_id, $width, $height) {
        global $w;
        $src = preg_replace('/&nbsp;/', '', $src);

        $prefix = 'vlist';

        $video = $this->get_imgurl_from_video($src);
        $path = $this->get_filename_from_url($video['img_url']);
        $filename = $path['filename'];
        $thumb_info = '/file/' . $bo_table . '/' . $prefix . '_thumb_' . $wr_id . '_' . $filename;
        $vlist_thumb_path = G5_DATA_PATH . $thumb_info;
        $vlist_thumb_url = G5_DATA_URL . $thumb_info;

        if ($video['img_url']) {
            if ( file_exists($vlist_thumb_path) && $w != 'u') {
                return $vlist_thumb_url;
            } else {
                $local_image = G5_DATA_PATH . '/file/' . $bo_table . '/' . $prefix . '_img_' . $wr_id . '_' . $filename;

                if (file_exists($local_image)) {
                    return $this->make_thumb_list_image($prefix, $bo_table, $wr_id, $filename, $width, $height, $video['host']);
                } else {
                    $this->save_url_image($video['img_url'], $local_image);
                    return $this->make_thumb_list_image($prefix, $bo_table, $wr_id, $filename, $width, $height, $video['host']);
                }
            }
        } else return false;
    }

    /**
     * 외부 이미지 가져와서 썸네일화
     */
    public function make_thumb_from_extra_image($bo_table, $wr_id, $content, $width, $height) {
        global $w;

        if (!$content) return false;

        // 게시물 내용에서 이미지 추출
        $matchs = get_editor_image($content,false);
        if (!$matchs) return false;

        $prefix = 'extimg';

        $extra_img_url = $matchs[1][0];
        $extra_parse_url = parse_url($extra_img_url);
        $host = $extra_parse_url['host'];
        if ($host == $_SERVER['HTTP_HOST']) return false;

        $path = $this->get_filename_from_url($extra_img_url);
        $filename = $path['filename'];
        $thumb_info = '/file/' . $bo_table . '/' . $prefix . '_thumb_' . $wr_id . '_' . $filename;
        $list_thumb_path = G5_DATA_PATH . $thumb_info;
        $list_thumb_url = G5_DATA_URL . $thumb_info;

        if ($extra_img_url) {
            if ( file_exists($list_thumb_path) && $w != 'u') {
                return $list_thumb_url;
            } else {
                $local_image = G5_DATA_PATH . '/file/' . $bo_table . '/' . $prefix . '_img_' . $wr_id . '_' . $filename;
                if (file_exists($local_image)) {
                    return $this->make_thumb_list_image($prefix, $bo_table, $wr_id, $filename, $width, $height);
                } else {
                    $this->save_url_image($extra_img_url, $local_image);
                    return $this->make_thumb_list_image($prefix, $bo_table, $wr_id, $filename, $width, $height);
                }
            }
        } else return false;
    }

    /**
     * CURL로 웹소스 가져오기
     */
    private function curl_web_scripping($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    /**
     * 외부 이미지 로컬에 저장하기
     */
    public function save_url_image($url, $local_image) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $rawdata = curl_exec($ch);
        curl_close ($ch);

        if (file_exists($local_image)){
            unlink($local_image);
        }
        $fp = fopen($local_image,'x');
        fwrite($fp, $rawdata);
        fclose($fp);
    }

    /**
     * 다운로드된 비디오 이미지 파일을 썸네일화
     */
    public function make_thumb_list_image ($prefix, $bo_table, $wr_id, $filename, $width, $height, $host='') {

        $img_info = '/file/' . $bo_table . '/' . $prefix . '_img_' . $wr_id . '_' . $filename;
        $img = G5_DATA_PATH . $img_info;

        if (file_exists($img)) {
            $size = getimagesize($img);
            switch ($size['mime']) {
                case 'image/jpeg'   : $source = @imagecreatefromjpeg($img); $ext = 'jpg'; break;
                case 'image/gif'    : $source = @imagecreatefromgif($img); $ext = 'gif'; break;
                case 'image/png'    : $source = @imagecreatefrompng($img); $ext = 'png'; break;
            }

            $src_width = $size[0];
            $src_height = $size[1];

            if (!$height) {
                $height = $width*($src_height/$src_width);
            }

            if ($host != '') {
                switch ($host) {
                    case 'youku.com':
                    case 'v.youku.com':
                    case 'player.youku.com':
                        $src_width = $src_x = 448;
                        $src_height = 252;
                        $src_y = 0;
                        break;
                }
            } else {
                $src_x = 0;
                $src_y = 0;
            }

            $dest = @imagecreatetruecolor($width, $height);
            $out_file = G5_DATA_PATH . '/file/' . $bo_table . '/' . $prefix . '_thumb_' . $wr_id . '_' . $filename;
            $out_url = G5_DATA_URL . '/file/' . $bo_table . '/' . $prefix . '_thumb_' . $wr_id . '_' . $filename;
            @imagecopyresampled($dest, $source, 0, 0, $src_x, $src_y, $width , $height, $src_width, $src_height);
            @imagejpeg($dest, $out_file , 100);
            @imagedestroy($dest);
            @imagedestroy($source);
            @unlink($img);

            return $out_url;

        } else return false;
    }

    /**
     * 게시글보기 썸네일 생성
     */
    public function get_thumbnail($contents, $thumb_width=0) {
        global $config, $exif, $eyoom_board;

        /**
         * 게시판 추가설정 정보
         */
        if (!$this->eyoom_board) $this->eyoom_board = $eyoom_board;

        if (!$thumb_width) $thumb_width = $this->board['bo_image_width'];

        // $contents 중 img 태그 추출
        $matches = get_editor_image($contents, true);

        if(empty($matches))
            return $contents;

        $extensions = array(1=>'gif', 2=>'jpg', 3=>'png', 18=>'webp');

        for($i=0; $i<count($matches[1]); $i++) {

            $img = $matches[1][$i];
            $img_tag = isset($matches[0][$i]) ? $matches[0][$i] : '';
    
            preg_match("/src=[\'\"]?([^>\'\"]+[^>\'\"]+)/i", $img, $m);
            $src = isset($m[1]) ? $m[1] : '';
            preg_match("/style=[\"\']?([^\"\'>]+)/i", $img, $m);
            $style = isset($m[1]) ? $m[1] : '';
            preg_match("/width:\s*(\d+)px/", $style, $m);
            $width = isset($m[1]) ? $m[1] : '';
            preg_match("/height:\s*(\d+)px/", $style, $m);
            $height = isset($m[1]) ? $m[1] : '';
            preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $img, $m);
            $alt = isset($m[1]) ? get_text($m[1]) : '';
    
            // 이미지 path 구함
            $p = parse_url($src);
            if(strpos($p['path'], '/'.G5_DATA_DIR.'/') != 0)
                $data_path = preg_replace('/^\/.*\/'.G5_DATA_DIR.'/', '/'.G5_DATA_DIR, $p['path']);
            else
                $data_path = $p['path'];
    
            $srcfile = G5_PATH.$data_path;

            if(is_file($srcfile)) {
                // EXIF 정보
                if($this->eyoom_board['bo_use_exif']) {
                    $exif_info = $exif->get_exif_info($srcfile);
                }

                $size = @getimagesize($srcfile);
                if(empty($size))
                    continue;
    
                $file_ext = $extensions[$size[2]];
                if (!$file_ext) continue;

                // jpg 이면 exif 체크
                if($size[2] == 2 && function_exists('exif_read_data')) {
                    $degree = 0;
                    $_exif = @exif_read_data($srcfile);
                    if(!empty($_exif['Orientation'])) {
                        switch($_exif['Orientation']) {
                            case 8:
                                $degree = 90;
                                break;
                            case 3:
                                $degree = 180;
                                break;
                            case 6:
                                $degree = -90;
                                break;
                        }

                        // 세로사진의 경우 가로, 세로 값 바꿈
                        if($degree == 90 || $degree == -90) {
                            $tmp = $size;
                            $size[0] = $tmp[1];
                            $size[1] = $tmp[0];
                        }
                    }
                }

                // 원본 width가 thumb_width보다 작다면
                if($size[0] <= $thumb_width)
                    continue;

                // Animated GIF 체크
                $is_animated = false;
                if($file_ext === 'gif') {
                    $is_animated = is_animated_gif($srcfile);
    
                    if($replace_content = run_replace('thumbnail_is_animated_gif_content', '', $contents, $srcfile, $is_animated, $img_tag, $data_path, $size)){
    
                        $contents = $replace_content;
                        continue;
                    }
                }

                // 원본 width가 thumb_width보다 작다면
                if($size[0] <= $thumb_width)
                    continue;

                // 썸네일 높이
                $thumb_height = round(($thumb_width * $size[1]) / $size[0]);
                $filename = basename($srcfile);
                $filepath = dirname($srcfile);

                // 썸네일 생성
                if(!$is_animated)
                    $thumb_file = thumbnail($filename, $filepath, $filepath, $thumb_width, $thumb_height, false);
                else
                    $thumb_file = $filename;

                if($thumb_file) {
                    if ($width) {
                        $thumb_tag = '<img src="'.G5_URL.str_replace($filename, $thumb_file, $data_path).'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'"/>';
                    } else {
                        $thumb_tag = '<img src="'.G5_URL.str_replace($filename, $thumb_file, $data_path).'" alt="'.$alt.'"/>';
                    }

                    // $img_tag에 editor 경로가 있으면 원본보기 링크 추가
                    $img_tag = $matches[0][$i];
                    if(strpos($img_tag, G5_DATA_DIR.'/'.G5_EDITOR_DIR) && preg_match("/\.({$config['cf_image_extension']})$/i", $filename)) {
                        $imgurl = str_replace(G5_URL, "", $src);
                        $thumb_tag = '<a href="'.G5_BBS_URL.'/view_image.php?fn='.urlencode($imgurl).'" target="_blank" class="view_image">'.$thumb_tag.'</a>';
                    }
                } else {
                    if ($width) {
                        $thumb_tag = '<img src="'.G5_URL.$data_path.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'"/>';
                    } else {
                        $thumb_tag = '<img src="'.G5_URL.$data_path.'" alt="'.$alt.'"/>';
                    }
                    $img_tag = $matches[0][$i];
                }

                // EXIF 정보
                if($exif_info && $this->eyoom_board['bo_use_exif']) {
                    $thumb_tag .= $exif_info;
                }

                $contents = str_replace($img_tag, $thumb_tag, $contents);
            }
        }
        return $contents;
    }

    /**
     * 이모티콘 이미지
     */
    public function emoticon_image($emoticon) {
        global $theme;
        $dir = preg_replace('/([0-9]|_|-)/i','',$emoticon[1]);
        $path = EYOOM_THEME_URL.'/emoticon/'.$dir.'/';
        $output = "<img src='".$path.$emoticon[1].".gif' align='absmiddle' width='50' alt='이모티콘'>";
        return $output;
    }

    /**
     * 이모티콘 모두 가져오기
     */
    public function get_emoticon($dirname) {
        global $theme;
        $path = EYOOM_THEME_PATH.'/emoticon/'.$dirname;
        $url = EYOOM_THEME_URL.'/emoticon/'.$dirname;
        $files = glob($path.'/*.gif');
        foreach ($files as $k => $file) {
            $temp = explode('/',$file);
            $filename = $temp[(count((array)$temp)-1)];
            $emoticon[$k]['emoticon'] = substr($filename,0,-4);
            $emoticon[$k]['url'] = $url.'/'.$filename;
        }
        return $emoticon;
    }

    /**
     * 사운드클라우드 컨텐츠
     */
    public function soundcloud_content($source) {
        $src = trim(strip_tags($source[1]));
        $src = str_replace('\"', '', $src);

        if (!$src) return;
        $soundcloud = '';
        if (preg_match('/soundcloud.com/i', $src)) {
            $soundcloud = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$src.'"></iframe>'."\n";
        }
        $soundcloud = "<div style='margin:15px 0;'>".$soundcloud."</div>";
        return $soundcloud;
    }

    /**
     * 지도 컨텐츠
     */
    public function map_content($source) {
        global $eyoom;

        list($type, $address, $name, $subgps) = explode('^|^', $source[1]);

        if (!$subgps || $eyoom['use_map_content'] == 'n') return $address;
        else {
            $map_content = '';
            $map_hashkey = md5(time().parent::random_num(1000));

            $gps_number = preg_replace('/\(|\)/','',$subgps);
            list($gps_x,$gps_y) = explode(',',$gps_number);

            switch($type) {
                case '1': $map_type = 'google'; break;
                case '2': $map_type = 'naver'; break;
                case '3': $map_type = 'daum'; break;
                default : $map_type = 'google'; break;
            }
            $map_content = '<div class="map-content-wrap" data-map-type="'.$map_type.'" data-map-x="'.trim($gps_x).'" data-map-y="'.trim($gps_y).'" data-map-address="'.$address.'" data-map-name="'.$name.'"><div id="'.$map_hashkey.'"></div></div>';
        }

        return $map_content;
    }

    /**
     * 회원의 추천/비추천 정보 가져오기
     */
    public function mb_goodinfo($mb_id, $bo_table, $wr_id) {
        if(!$mb_id || !$bo_table || !$wr_id) return false;
        else {
            $sql = "select * from {$this->g5['board_good_table']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and mb_id='{$mb_id}' limit 1";
            $info = sql_fetch($sql,false);
            return $info;
        }
    }

    /**
     * 추천 / 비추천 회원 리스트
     */
    public function good_members($bg_flag, $bo_table, $wr_id) {
        $sql = "select *, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['board_good_table']} as a left join {$this->g5['member_table']} as b on a.mb_id = b.mb_id where bg_flag = '{$bg_flag}' and bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ";
        $result = sql_query($sql, false);
        $good_member = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $good_member[$i] = $row;
            $good_member[$i]['mb_photo'] = parent::mb_photo($row['mb_id']);
        }
        return $good_member;
    }

    /**
     * 핀설정 체크
     */
    public function my_pininfo($mb_id, $bo_table, $wr_id) {
        if(!$mb_id || !$bo_table || !$wr_id) return false;
        else {
            $sql = "select * from {$this->g5['eyoom_pin']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and mb_id='{$mb_id}' limit 1";
            $info = sql_fetch($sql,false);
            return $info;
        }
    }

    /**
     * 신고 내역
     */
    public function mb_yellow_card($mb_id, $bo_table, $wr_id) {
        if(!$mb_id || !$bo_table || !$wr_id) return false;
        else {
            $sql = "select * from {$this->g5['eyoom_yellowcard']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and mb_id='{$mb_id}' limit 1";
            $info = sql_fetch($sql,false);
            return $info;
        }
    }

    /**
     * 신고 갯수
     */
    public function get_yellow_card_cnt($bo_table, $wr_id) {
        $sql = "select count(*) as cnt from {$this->g5['eyoom_yellowcard']} where bo_table='{$bo_table}' and wr_id='{$wr_id}'";
        $info = sql_fetch($sql,false);
        return $info['cnt'];
    }

    /**
     * 별점 내역
     */
    public function mb_rating($bo_table, $wr_id) {
        if(!$bo_table || !$wr_id) return false;
        else {
            $sql = "select a.*, b.mb_name, b.mb_nick, b.mb_email, b.mb_homepage from {$this->g5['eyoom_rating']} as a left join {$this->g5['member_table']} as b on a.mb_id = b.mb_id where a.bo_table='{$bo_table}' and a.wr_id='{$wr_id}' order by a.rt_datetime desc";
            $result = sql_query($sql, false);
            $info = array();
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $info[$row['mb_id']] = $row;
                $info[$row['mb_id']]['mb_photo'] = parent::mb_photo($row['mb_id']);
            }
            return $info;
        }
    }

    /**
     * 별점 정보 가져오기
     */
    public function get_star_rating($info) {
        if(isset($info['rating_score']) && $info['rating_members'] > 0) {
            $rating['point'] = ceil(($info['rating_score']/$info['rating_members'])*10)/10;
            $rating['members'] = $info['rating_members'];
        } else {
            $rating['point'] = 0;
            $rating['members'] = 0;
        }
        return $rating;
    }

    /**
     * 별점 합산정보
     */
    public function get_star_summary($bo_table, $wr_id) {
        $sql = "select count(*) as cnt, sum(rating) as score from {$this->g5['eyoom_rating']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' ";
        $info = sql_fetch($sql);
        return $info;
    }

    public function get_editor_video($content) {
        if (!$content) return false;

        $pattern = '/{동영상\s*\:([^}]*)}/i';
        preg_match_all($pattern, $content, $matchs);
        return $matchs;
    }

    public function get_editor_sound($content) {
        if (!$content) return false;

        $pattern = '/{soundcloud\s*\:([^}]*)}/i';
        preg_match_all($pattern, $content, $matchs);
        return $matchs;
    }

    public function remove_editor_code($content) {
        $content = preg_replace('/\\n/','',$content);
        $content = preg_replace('/\s{2,}/','',$content);
        $content = preg_replace('/{CODE\s*\:(.*)}(.*?){\/CODE}/is','',$content);
        return $content;
    }

    public function remove_editor_video($content) {
        $content = preg_replace('/{동영상\s*\:(.*)}/i','',$content);
        return $content;
    }

    public function remove_editor_sound($content) {
        $content = preg_replace('/{soundcloud\s*\:(.*)}/i','',$content);
        return $content;
    }

    public function remove_editor_emoticon($content) {
        $content = preg_replace('/{이모티콘\s*\:(.*)}/i','',$content);
        return $content;
    }

    public function remove_editor_map($content) {
        $content = preg_replace('/{지도\s*\:(.*)}/i','',$content);
        return $content;
    }

    /**
     * 에디터로 업로드된 이미지 파일 삭제
     */
    public function delete_editor_image($content) {
        if (!$content) return false;

        // 게시물 내용에서 이미지 추출
        $matchs = get_editor_image($content,false);
        if (!$matchs) return false;

        for ($i=0; $i<count((array)$matchs[1]); $i++) {
            // 이미지 path 구함
            $imgurl = parse_url($matchs[1][$i]);
            $srcfile = $_SERVER['DOCUMENT_ROOT'].$imgurl['path'];
            $filename = preg_replace('/\.[^\.]+$/i', '', basename($srcfile));
            $filepath = dirname($srcfile);
            $files = glob($filepath.'/thumb-'.$filename.'*');
            if (is_array($files)) {
                foreach ($files as $filename)
                    @unlink($filename);
            }
            @unlink($srcfile);
        }
    }

    /**
     * 댓글에 첨부한 이미지 삭제
     */
    public function delete_comment_image($content,$bo_table) {
        if (!$content || !$bo_table) return false;

        $b_file = unserialize($content);
        foreach ($b_file as $key => $bf) {
            @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$bf['file']);
        }
    }

    /**
     * 게시글 추출시 불필요한 필드 제거
     */
    public function except_wr_fields() {
        $except = array(
            'wr_num',
            'wr_reply',
            'wr_is_comment',
            'wr_comment_reply',
            'wr_link1_hit',
            'wr_link2_hit',
            'wr_password',
            'wr_homepage',
            'wr_file',
            'wr_last',
            'wr_ip',
            'wr_facebook_user',
            'wr_twitter_user',
        );
        return $except;
    }

    /**
     * 회원의 최신글 / 최신댓글 추출
     */
    public function get_member_latest($mb_id, $count, $is_cmt=false) {
        global $member;

        /**
         * 목록보기 권한 체크
         */
        $bo_info = $this->list_possible_board($member['mb_level']);
        $bo_possible = $bo_info['bo_possible'];
        $board_info = $bo_info['board_info'];

        /**
         * 원글인지 댓글인지
         */
        $where = '1';
        if (!$is_cmt) {
            $where .= " and wr_id = wr_parent ";
        } else {
            $where .= " and wr_id <> wr_parent ";
        }

        /**
         * 목록보기 가능한 게시판
         */
        $where .= " and find_in_set(bo_table,'".implode(',',$bo_possible)."') ";

        /**
         * 익명게시물은 제외
         */
        $where .= " and wr_anonymous <> '1' and wr_bo_anonymous <> '1' ";

        $sql = "select * from {$this->g5['board_new_table']} where {$where} and mb_id = '{$mb_id}' order by bn_datetime desc limit $count ";
        $result = sql_query($sql, false);
        $k=0;
        $list = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            /**
             * 게시글 정보
             */
            $record = $this->board_latest_record($row, $board_info);
            if ($record) {
                $list[$k] = $record;
                $k++;
            }
        }
        return $list;
    }

    /**
     * 최신 게시글 추출
     */
    public function board_latest_record($row, $bo_info, $datetime='bn_datetime') {
        global $query_wmode, $anonymous_table;

        /**
         * 게시판 썸네일 라이브러리
         */
        @include_once(G5_LIB_PATH.'/thumbnail.lib.php');

        /**
         * 게시판 테이블
         */
        $write_table = $this->g5['write_prefix'] . $row['bo_table'];

        /**
         * 최신글 추출
         */
        $write = $this->get_write_except_fields(get_write($write_table, $row['wr_id']));

        /**
         * list 변수로 치환
         */
        $list = $write;
        $list['bo_table'] = $row['bo_table'];

        /**
         * 별점 평가글 및 추천/비추천글 원글만 출력
         */
        if (($row['rating'] || $row['bg_flag']) && !$list['wr_subject']) {
            return false;
        }
        
        /**
         * 비밀글의 댓글인지 체크
         */
        $list['is_secret_comment'] = false;
        if ($bo_info[$row['bo_table']]['bo_use_secret'] && !$list['wr_subject']) {
            $parent_write = get_write($write_table, $row['wr_parent']);
            if (preg_match("/secret/",$parent_write['wr_option'])) {
                $list['is_secret_comment'] = true;
            }
        }

        /**
         * 비밀글인지 체크
         */
        if ((preg_match("/secret/",$write['wr_option']) || $list['is_secret_comment']) && !$is_admin && $write['mb_id']!=$member['mb_id']) {
            $list['wr_subject'] = '비밀글입니다.';
            $list['wr_content'] = '비밀글입니다.';
            $list['href'] = "#";
            $list['secret'] = true;
        } else {
            /**
             * 회원포토
             */
            $list['mb_photo'] = parent::mb_photo($write['mb_id'], 'icon');

            /**
             * 별점
             */
            $list['star'] = $row['rating'] ? $row['rating']: '';

            /**
             * 추천 / 비추천
             */
            $list['is_good'] = $row['bg_flag'] ? $row['bg_flag']: '';

            /**
             * 내용 출력
             */
            $list['wr_content'] = $this->cut_filter_wr_content($write['wr_content'], 300);

            /**
             * 원글 및 댓글 링크 생성
             */
            if ($row['wr_parent']) {
                if ($row['wr_id'] == $row['wr_parent']) { // 원본글
                    $list['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_id'],$query_wmode);
                } else { // 댓글
                    $list['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_parent'],$query_wmode.'#c_'.$row['wr_id']);
                }
            } else {
                $list['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_id'],$query_wmode);
            }

            /**
             * 썸네일 이미지 생성
             */
            $thumb = get_list_thumbnail($row['bo_table'], $row['wr_id'], 300, 0);
            if ($thumb['src']) {
                $list['wr_image'] = $thumb['src'];
            } else if ($list['eb_4']) {
                $eb_4 = unserialize($list['eb_4']);

                if ($eb_4['thumb_src']) {
                    $list['is_video'] = $eb_4['is_video'];
                    $list['wr_image'] = $eb_4['thumb_src'];
                }
            }
        }

        /**
         * 익명글 처리
         */
        $list['is_anonymous'] = false;
        if ($row['wr_anonymous'] == '1' || in_array($row['bo_table'], $anonymous_table)) {
            $list['is_anonymous'] = true;
            $list['mb_photo'] = '';
            $list['mb_id'] = 'anonymous';
            $list['wr_name'] = $eyoom['anonymous_title'];
            $list['email'] = '';
            $list['homepage'] = '';
            $list['gnu_level'] = '';
            $list['gnu_icon'] = '';
            $list['eyoom_icon'] = '';
            $list['lv_gnu_name'] = '';
            $list['lv_name'] = '';
        }

        $list['datetime'] = $row[$datetime];
        $list['bo_info'] = $bo_info[$row['bo_table']];

        return $list;
    }

    /**
     * 게시글 데이터에서 예외필드 제거
     */
    public function get_write_except_fields($write) {
        $except = $this->except_wr_fields();

        if (is_array($write)) {
            foreach ($write as $key => $data) {
                if (in_array($key, $except)) continue;
                $list[$key] = $data;
            }
        }
        return $list;
    }

    /**
     * 열람 가능한 게시판
     */
    public function list_possible_board($mb_level) {
        /**
         * 게시판 전체 정보
         */
        $bo_info = parent::get_bo_subject();

        /**
         * 목록보기 권한이 있는 게시물만 리스트에 보이도록 처리
         */
        $data = array('bo_possible' => array(), 'board_info' => array());
        if (is_array($bo_info)) {
            $i=0;
            foreach ($bo_info as $bo_table => $info) {
                /**
                 * 리스트 보기 권한 체크
                 */
                if ($info['bo_list_level'] > $mb_level) {
                    continue;
                }
                
                /**
                 * 통합 검색 사용여부 체크
                 */
                if ($info['bo_use_search'] != 1) {
                    continue;
                }

                $data['bo_possible'][$i] = $bo_table;
                $data['board_info'][$bo_table] = $bo_info[$bo_table];
                $i++;
            }
        }
        return $data;
    }

    /**
     * 게시글 내용 필터
     */
    public function cut_filter_wr_content($wr_content, $length=300) {
        if (!$wr_content) return false;

        /**
         * 불필요한 소스 제거
         */
        $wr_content = strip_tags(preg_replace("/(<br>|<br \/>)/i", "\n\r", $wr_content));
        $wr_content = str_replace('$','',htmlspecialchars(trim($wr_content)));
        $wr_content = $this->remove_editor_code($wr_content);
        $wr_content = $this->remove_editor_video($wr_content);
        $wr_content = $this->remove_editor_sound($wr_content);
        $wr_content = $this->remove_editor_emoticon($wr_content);
        $wr_content = $this->remove_editor_map($wr_content);

        /**
         * 공백제거
         */
        $wr_content = str_replace('&amp;nbsp;', '', $wr_content);

        /**
         * 지정한 길이만큼 자르기
         */
        $wr_content = $length ? cut_str($wr_content, $length, '…'): $wr_content;

        return $wr_content;
    }

    /**
     * tuieditor viewer
     */
    public function tuieditor_viewer ($id) {
        global $config;

        $tuieditor_url = G5_EDITOR_URL.'/'.$config['cf_editor'];

        add_javascript('<script src="'.$tuieditor_url.'/js/toastui-editor-viewer.js"></script>',10);
        add_javascript('<script src="'.$tuieditor_url.'/js/toastui-custom-plugin.js"></script>',10);
        add_stylesheet('<link rel="stylesheet" href="'.$tuieditor_url.'/css/toastui-editor-viewer.min.css">',10);
        if ($_COOKIE['mode'] == 'dark') {
            add_stylesheet('<link rel="stylesheet" href="'.$tuieditor_url.'/css/toastui-editor-dark.min.css">',10);
        }

        $script = '';
        $script .= "<script>\n";
        $script .= "const text_{$id} = unescapeHTML(document.getElementById('".$id."').innerHTML);\n";
        $script .= "const Viewer_{$id} = toastui.Editor;\n";
        $script .= "const viewer_{$id} = new Viewer_{$id}({\n";
        $script .= "\tel: document.querySelector('#".$id."'),\n";
        $script .= "\tinitialValue: text_{$id},\n";
        $script .= $_COOKIE['mode'] == 'dark' ? "\ttheme: 'dark'\n": '';
        $script .= "}).setMarkdown(text_{$id});\n";
        $script .= "var content = document.getElementById('".$id."').innerHTML;\n";
        $script .= "var url = '".$tuieditor_url."/ajax.contents.php';\n";
        $script .= "$.post(url, {content:content}, function (data) {\n";
        $script .= "\t$('#".$id."').empty().html(data);\n";
        $script .= "});\n";
        $script .= "$('#".$id."').show();\n";
        $script .= "</script>\n";

        return $script;
    }

    /**
     * 게시물 상단고정 진행 함수
     */
    public function bo_wrfixed ($bo_table, $wr_id) {
        global $g5, $member, $theme, $is_admin;
        
        /**
         * 게시판 정보 가져오기
         */
        $eyoom_board = $this->board_info($bo_table);
        
        /**
         * 게시물 상위노출에 이미 있는지 체크
         */
        $sql = "select * from {$g5['eyoom_wrfixed']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and bf_open='y' order by bf_datetime desc limit 1";
        $row = sql_fetch($sql);
        
        if ($row) {
            $ex_time = get_exdatetime($eyoom_board['bo_wrfixed_date'], $row['ex_datetime']);
            $ex_datetime = date('Y-m-d H:i:s', $ex_time);
            $set = "
                bf_wrfixed_point = bf_wrfixed_point + {$eyoom_board['bo_wrfixed_point']},
                bf_wrfixed_date = bf_wrfixed_date + {$eyoom_board['bo_wrfixed_date']},
                ex_datetime = '{$ex_datetime}',
                bf_datetime = '" . G5_TIME_YMDHIS . "'
            ";
            $sql = "update {$g5['eyoom_wrfixed']} set {$set} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and bf_open='y' ";
            sql_query($sql);
            $msg = "게시물의 상단고정을 연장처리하였습니다.";
            return $msg;
        }

        /**
         * 게시물 상위노출 미승인 신청이 이미 있는지 체크
         */
        $sql = "select * from {$g5['eyoom_wrfixed']} where bo_table='{$bo_table}' and wr_id='{$wr_id}' and bf_open='n' order by bf_datetime desc limit 1";
        $row2 = sql_fetch($sql);
           
        if ($row2) {
            $msg = "이미 신청 진행중인 건이 존재합니다.";
            return $msg;
        } else {
            if ($eyoom_board['bo_wrfixed_type'] == '2' || $is_admin == 'super') {
                $bf_open = 'y';
                $ex_time = $this->get_exdatetime($eyoom_board['bo_wrfixed_date']);
                $ex_datetime = date('Y-m-d H:i:s', $ex_time);
                $po_datetime = G5_TIME_YMDHIS;
                $msg = "정상적으로 게시물을 상단고정 처리하였습니다.";
            } else {
                $bf_open = 'n';
                $ex_datetime = '';
                $po_datetime = '';
                $msg = "게시물의 상단고정을 요청했습니다. 관리자 승인 후 적용됩니다.";
            }
            $set = "
                bo_table = '{$bo_table}',
                wr_id = '{$wr_id}',
                mb_id = '{$member['mb_id']}',
                bf_wrfixed_point = '{$eyoom_board['bo_wrfixed_point']}',
                bf_wrfixed_date = '{$eyoom_board['bo_wrfixed_date']}',
                bf_open = '{$bf_open}',
                ex_datetime = '{$ex_datetime}',
                po_datetime = '" . $po_datetime . "',
                bf_datetime = '" . G5_TIME_YMDHIS . "'
            ";
            $sql = "insert into {$g5['eyoom_wrfixed']} set {$set} ";
            sql_query($sql);
            return $msg;
        }
    }

    /**
     * 상단고정 파기시간 계산하기
     */
    public function get_exdatetime ($day, $date='') {
        if (!$day) {
            return false;
        } else {
            if (!$date) {
                $datetime = time();
            } else {
                $datetime = strtotime($date);
            }
            
            return $datetime + (60*60*24) * $day;   
        }
    }
}