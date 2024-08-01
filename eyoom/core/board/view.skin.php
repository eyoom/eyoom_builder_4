<?php
/**
 * core file : /eyoom/core/board/view.skin.php
 */
if (!defined('_EYOOM_')) exit;

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

/**
 * 신고처리 정보
 */
if ($eyoom_board['bo_use_yellow_card'] == '1') {
    $eb_5 = $eb->mb_unserialize($view['eb_5']);

    $mb_ycard = $bbs->mb_yellow_card($member['mb_id'],$bo_table, $wr_id);
    if ($eb_5['yc_blind'] == 'y') {
        if (!$is_admin && $member['mb_level'] < $eyoom_board['bo_blind_view']) {
            if (!$mb_ycard['mb_id']) {
                alert('이 게시물은 블라인드 처리된 게시물입니다.');
                exit;
            }
        }
    }

    /**
     * 신고건수 가져오기
     */
    $yc_count = $bbs->get_yellow_card_cnt($bo_table, $wr_id);
    if ($eb_5['yc_count'] != $yc_count) {
        $eb_5['yc_count'] = $yc_count;
    }

    // 바로 블라인드 처리할 수 있는 권한인지 체크
    if ($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
        $blind_direct = true;
    }
}

/**
 * 별점기능 사용여부
 */
if ($eyoom_board['bo_use_rating'] == '1') {
    $eb_7 = $eb->mb_unserialize($view['eb_7']);
    if (!$eb_7) $eb_7 = array();

    $mb_rating = $bbs->mb_rating($bo_table, $wr_id);
    $my_rating = $mb_rating[$member['mb_id']];
    $rating = $bbs->get_star_rating($eb_7);
}

/**
 * 채택게시판
 */
if (preg_match('/adopt/i',$eyoom_board['bo_skin'])) {
    $eb_6 = $eb->mb_unserialize($view['eb_6']);

    $adopt_cmt_id = $eb_6['adopt_cmt_id'];
    $adopt_point = $eb_6['adopt_point'];

    if ($eyoom_board['bo_use_adopt_point'] == '1' && $eyoom_board['bo_adopt_ratio'] > 0) {
        $real_adopt_point = ceil($adopt_point*(1-($eyoom_board['bo_adopt_ratio']/100)));
        $return_adopt_point = $adopt_point - $real_adopt_point;
    }

    $is_adoptable = false;
    if (!$adopt_cmt_id && (($is_member && $member['mb_id'] == $view['mb_id']) || $is_admin)) {
        $is_adoptable = true;
    }
}

/**
 * 이윰 경험치 적용 및 최신글, 인기태그용 히트수 업데이트
 */
$spv_name = 'spv_board_'.$bo_table.'_'.$wr_id;
if (!get_session($spv_name)) {
    if ($is_member) {
        if ($board['bo_point_target'] == 'eyoom' || $board['bo_point_target'] == 'all') {
            $read_point = $board['bo_read_point'];
        } else {
            $read_point = $levelset['read'];
        }

        if ($read_point) {
            $eb->level_point($read_point);
        }
    }
    set_session($spv_name, TRUE);

    // 이윰뉴 테이블에 wr_hit 적용
    $where = "wr_id = '{$wr_id}' ";
    $parent = sql_fetch("select wr_hit, wr_comment from {$write_table} where $where");
    sql_query("update {$g5['board_new_table']} set wr_hit = '{$parent['wr_hit']}', wr_comment = '{$parent['wr_comment']}' where $where and bo_table='{$bo_table}'");
    sql_query("update {$g5['eyoom_tag_write']} set wr_hit = '{$parent['wr_hit']}' where $where and bo_table='{$bo_table}' and tw_theme='" . sql_real_escape_string($theme) . "'");
}

/**
 * 첨부파일 정보 가져오기
 */
$view_file = array();
if ($view['file']['count']) {
    $cnt = 0;
    for ($i=0; $i<count((array)$view['file']); $i++) {
        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
            $view_file[$cnt] = $view['file'][$i];
            $cnt++;
        }
    }
}

/**
 * 링크 정보 가져오기
 */
$i=1;
$view_link = array();
if(isset($view['link']) && array_filter($view['link'])) {
    foreach ($view['link'] as $k => $v) {
        if (!$view['link'][$i]) continue;
        $view_link[$i]['link']  = cut_str($view['link'][$i], 70);
        $view_link[$i]['href']  = $view['link_href'][$i];
        $view_link[$i]['hit']   = $view['link_hit'][$i];
        $i++;
    }
}

/**
 * 파일 출력
 */
$v_img_count = count((array)$view['file']);
$file_url = array();
if ($v_img_count) {
    $file_conts = "<div id=\"bo_v_img\">\n";

    for ($i=0; $i<=count((array)$view['file']); $i++) {
        if ($view['file'][$i]['view']) {
            unset($thumbnail, $matches);

            $thumbnail = $bbs->get_thumbnail($view['file'][$i]['view']);
            $file_conts .= $thumbnail;
            preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $thumbnail, $matches);

            $file_url[$i]['source'] = $view['file'][$i]['path'] . '/' . $view['file'][$i]['file'];
            $file_url[$i]['content'] = $view['file'][$i]['content'];
            $file_url[$i]['thumb'] = $matches[1][0];
        }
    }
    $file_conts .= "</div>\n";
}

/**
 * 게시판 내용 필터 적용
 */
$view_content = $bbs->board_content($view['content'], $bo_table, $wr_id);

/**
 * 익명글 기능
 */
$bo_use_anonymous = !$is_admin ? $eyoom_board['bo_use_anonymous']: false;
$is_anonymous = false;
if ($bo_use_anonymous == '1') {
    if ($view['wr_anonymous'] == '1') {
        $is_anonymous = true;
    } else {
        $is_anonymous = false;
    }
} else if ($bo_use_anonymous == '2') {
    $is_anonymous = true;
} else {
    $is_anonymous = false;
}

/**
 * 익명게시판에서 글작성자의 실제 아이디를 사용함
 */
$view['wr_mb_id'] = $view['mb_id'];

if ($is_anonymous) {
    $view['mb_photo'] = '';
    $view['mb_id'] = 'anonymous';
    $view['wr_name'] = $eyoom['anonymous_title'];
    $view['wr_email'] = '';
    $view['wr_homepage'] = '';
    $view['gnu_level'] = '';
    $view['gnu_icon'] = '';
    $view['eyoom_icon'] = '';
    $view['lv_gnu_name'] = '';
    $view['lv_name'] = '';
    unset($lvuser, $lv);

    $is_ip_view = false;
} else {
    /**
     * 글쓴이 정보를 가져옴
     */
    if ($view['mb_id']) {
        if (!$mb) $mb = get_member($view['mb_id']);
        $user = $eb->get_user_info($mb['mb_id'])+$mb;
        $lvuser = $eb->user_level_info($user);
    }

    /**
     * 작성자 프로필 사진
     */ 
    $view['mb_photo'] = $eb->mb_photo($view['mb_id']);

    /**
     * 작성자 레벨정보 가져오기
     */
    if ($view['eb_1']) {
        $lv = $eb->level_info($view['eb_1']);
    } else {
        $lv['gnu_level'] = '';
        $lv['gnu_icon'] = '';
        $lv['eyoom_icon'] = '';
        $lv['gnu_name'] = '';
        $lv['name'] = '';
    }
}

/**
 * 회원이라면
 */
if ($member['mb_id']) {
    /**
     * 추천 / 비추천
     */
    if ($board['bo_use_good'] || $board['bo_use_nogood']) {
        /**
         * 회원의 추천 / 비추천 정보
         */
        $goodinfo = $bbs->mb_goodinfo($member['mb_id'], $bo_table, $wr_id);
    }

    /**
     * 핀 설정 상태
     */
    $pininfo = $bbs->my_pininfo($member['mb_id'], $bo_table, $wr_id);
}

/**
 * 추천 회원 리스트
 */
if ($board['bo_use_good']) {
    $goods = $bbs->good_members('good', $bo_table, $wr_id);
    if (!$goods) $goods = array();
}

/**
 * 비추천 회원 리스트
 */
if ($board['bo_use_nogood']) {
    $nogoods = $bbs->good_members('nogood', $bo_table, $wr_id);
    if (!$nogoods) $nogoods = array();
}

$list_href = get_eyoom_pretty_url($bo_table,'',$qstr);
/**
 * Window Mode 사용시
 */
if ($wmode) {
    /**
     * 목록 출력을 강제로 막음
     */
    $board['bo_use_list_view'] = 0;

    /**
     * 일반 버튼들 wmode 적용하기
     */
    $add_query = '&wmode=1';
    $prev_href .= $prev_href ? $add_query:'';
    $next_href .= $next_href ? $add_query:'';
    $update_href .= $update_href ? $add_query:'';
    $delete_href .= $delete_href ? $add_query:'';
    $copy_href .= $copy_href ? $add_query:'';
    $move_href .= $move_href ? $add_query:'';
    $search_href .= $search_href ? $add_query:'';
    $reply_href .= $reply_href ? $add_query:'';
    $write_href .= $write_href ? $add_query:'';
    $list_href .= $list_href ? $add_query:'';
}

/**
 * eb_1에 작성자의 레벨정보 입력
 */
if ($is_member) $eb_1 = $member['mb_level']."|".$eyoomer['level'];

/**
 * 태그 정보
 */
$view_tags = array();
if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1') {
    $tag_info = $eb->get_tag_info($bo_table, $wr_id);
    if ($tag_info['wr_tag']) {
        $wr_tags = explode(',', $tag_info['wr_tag']);
        $i=0;
        foreach ($wr_tags as $key => $_tag) {
            $view_tags[$i]['tag'] = $_tag;
            $view_tags[$i]['href'] = G5_URL . '/tag/?tag=' . str_replace('&', '^', $_tag);
            $i++;
        }
    }
}

/**
 * 게시물 조회수에 따른 자동 이동/복사
 * 관리자가 작성한 공지글은 제외하기
 */
$arr_notice = explode(',', trim($board['bo_notice']));
$is_automove = false;
if (!in_array($wr_id, $arr_notice)) {
    // 조회수가 일치하면 게시물 자동 이동/복사
    if ($eyoom_board['bo_use_automove'] && $bo_automove['count1'] && $bo_automove['target1'] && $bo_automove['action1'] && $bo_automove['count1'] <= $write['wr_hit']+1) {
        $sw = $bo_automove['action1'];
        $tg_table = $bo_automove['target1'];
        $is_automove = true;
    }
}

/**
 * 자동 이동/복사 실행
 */
if (($write['mb_id'] && $write['mb_id']!=$config['cf_admin'] && $write['mb_id']!=$board['bo_admin']) || !$write['mb_id']) {
    if ($is_automove && $write['wr_10'] != $tg_table) {
        define("G5_AUTOMOVE", true);

        $chk_bo_table = array($tg_table);
        $wr_id_list = $wr_id;

        $binfo = sql_fetch("select bo_subject from {$g5['board_table']} where bo_table = '{$tg_table}'");

        switch ($sw) {
            case 'copy': $act = '복사'; break;
            case 'move': $act = '이동'; break;
        }
        @include_once(EYOOM_CORE_PATH . "/board/move_update.php");
    }
}

/**
 * 인기게시물 등록
 * 조회수 조건을 사용하고 원글일 경우만 적용
 * 익명글은 제외
 */
if ($eyoom_board['bo_use_best']=='1' && $bo_best['use1'] == '1' && $bo_best['count1'] > 0 && $bo_best['count1'] <= $view['wr_hit'] && $wr_id == $view['wr_parent'] && !$view['wr_anonymous']) {
    $row = sql_fetch("select count(*) as cnt from {$g5['eyoom_best']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
    $chk_cnt = (int) $row['cnt'];
    if (!$chk_cnt) {
        $sql = "insert into {$g5['eyoom_best']} set 
                    bo_table='{$bo_table}',
                    wr_id='{$wr_id}',
                    wr_good='{$view['wr_good']}',
                    wr_hit='{$view['wr_hit']}',
                    mb_id='{$view['mb_id']}',
                    wr_datetime='{$view['wr_datetime']}',
                    bb_datetime='" . G5_TIME_YMDHIS . "'
                ";
        sql_query($sql);
    } else {
        /**
         * 인기게시글 조회수, 추천수 업데이트
         */
        $sql = "update {$g5['eyoom_best']} set wr_hit = '{$view['wr_hit']}', wr_good = '{$view['wr_good']}' where bo_table='{$bo_table}' and wr_id = '{$wr_id}'";
        sql_query($sql);
    }
}

/**
 * 확장필드
 */
$ex_view = array();
if ($bo_extend) {
    foreach ($exbo as $ex_fname => $exinfo) {
        unset($ex_value);

        $ex_view[$ex_fname]['title'] = $exinfo['ex_subject'];
        switch ($exinfo['ex_form']) {
            case 'text':
            case 'radio':
            case 'select':
                $ex_view[$ex_fname]['value'] = $view[$ex_fname];
                break;
            case 'checkbox':
                $ex_value = explode('^|^', $view[$ex_fname]);
                $ex_view[$ex_fname]['value'] = is_array($ex_value) ? implode(', ', $ex_value): $ex_value;
                break;
            case 'address':
                $ex_value = explode('^|^', $view[$ex_fname]);
                unset($ex_value[4]);
                $ex_view[$ex_fname]['value'] = $ex_view[$ex_fname]['address'] = is_array($ex_value) ? implode(' ', $ex_value): $ex_value;
                $ex_view[$ex_fname]['zip'] = $ex_value[0];
                $ex_view[$ex_fname]['addr1'] = $ex_value[1];
                $ex_view[$ex_fname]['addr2'] = $ex_value[2];
                $ex_view[$ex_fname]['addr3'] = $ex_value[3];
                break;
            case 'textarea':
                $ex_view[$ex_fname]['value'] = conv_content($view[$ex_fname], $html);
                break;
        }
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/view.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/view.skin.php');

/**
 * 이윰 테마파일 출력
 */
include_once($eyoom_skin_path['board'].'/view.skin.html.php');