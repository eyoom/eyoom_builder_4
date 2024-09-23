<?php
/**
 * core file : /eyoom/core/board/write_update.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 이윰빌더용 여분필드
 */
for ($i=1; $i<=10; $i++) {
    $var = "eb_$i";
    $$var = "";
    if (isset($_POST['eb_'.$i]) && settype($_POST['eb_'.$i], 'string')) {
        $$var = trim($_POST['eb_'.$i]);
    }
}

/**
 * $write_table 에 적용할 변수 선언
 */
$up_set = array();
$up_set['eb_1'] = $eb_1 ? $eb->decrypt_aes($eb_1): ''; // 이윰 레벨정보 : "그누레벨|이윰레벨"
$up_set['eb_2'] = $eb_2 ? $eb->decrypt_aes($eb_2): ''; // 지뢰폭탄 정보
$up_set['eb_3'] = $eb_3 ? $eb->decrypt_aes($eb_3): ''; // 원본 이미지 정보
$up_set['eb_4'] = $eb_4 ? $eb->decrypt_aes($eb_4): ''; // 썸네일 이미지 정보, 동영상여부
$up_set['eb_5'] = $eb_5 ? $eb->decrypt_aes($eb_5): ''; // 신고, 블라인드 기능
$up_set['eb_6'] = $eb_6 ? $eb->decrypt_aes($eb_6): ''; // 채택포인트
$up_set['eb_7'] = $eb_7 ? $eb->decrypt_aes($eb_7): ''; // 별점 평가
$up_set['eb_8'] = $eb_8 ? $eb->decrypt_aes($eb_8): '';
$up_set['eb_9'] = $eb_9 ? $eb->decrypt_aes($eb_9): '';
$up_set['eb_10'] = $eb_10 ? $eb->decrypt_aes($eb_10): '';

/**
 * 승인게시판 상태변경 - 관리자일경우만 가능
 */
$sql_approval = '';
if ($board['bo_use_approval']) {
    $wr_approval = '0';
    if ($w=='u' && $is_admin) {
        $wr_approval = (int) clean_xss_tags(trim($_POST['wr_approval']));
    }

    $up_set['wr_approval'] = $wr_approval;
    $sql_approval = " wr_approval='{$wr_approval}', ";
}

/**
 * 게시물에 익명글 적용
 */
$bo_use_anonymous = $eyoom_board['bo_use_anonymous'];
if ($bo_use_anonymous == '1') {
    $up_set['wr_anonymous'] = $_POST['wr_anonymous'];
} else if ($bo_use_anonymous == '2') {
    $up_set['wr_anonymous'] = '1';
    $wr_bo_anonymous = '1';
} else {
    $up_set['wr_anonymous'] = '';
    $wr_bo_anonymous = '';
}

/**
 * 분류 및 익명글 최신글 적용하기
 */
$sql_wrip = '';
if ($w=='') {
    $sql_wrip = ", wr_ip='".$_SERVER['REMOTE_ADDR']."' ";
}
$sql = "update {$g5['board_new_table']} set ca_name='{$ca_name}', {$sql_approval} wr_anonymous='{$up_set['wr_anonymous']}', wr_bo_anonymous='{$wr_bo_anonymous}' {$sql_wrip} where wr_id='{$wr_id}' ";
sql_query($sql);

/**
 * 답변글에 대한 내글반응 적용하기
 */
if ($w == 'r') {
    $respond = array();
    $respond['type']        = 'reply';
    $respond['bo_table']    = $bo_table;
    $respond['pr_id']       = $_POST['wr_id'];
    $respond['wr_id']       = $wr_id;
    $respond['wr_subject']  = $wr_subject;
    $respond['wr_mb_id']    = $wr['mb_id'];
    if ($_POST['wr_anonymous'] == '1' || $bo_use_anonymous == '2') $anonymous = true;
    $eb->respond($respond);
}

/**
 * 업로드된 파일 정보 가져오기
 */
$result = sql_query(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
$wr_image = array();
for ($i=0; $row=sql_fetch_array($result);$i++) {
    if (!preg_match("/.(gif|jpg|jpeg|png|webp)$/i",$row['bf_file'])) continue;
    $wr_image['bf'][$i] = "/data/file/{$bo_table}/".$row['bf_file'];
}

/**
 * 내용중의 링크 이미지 정보 가져오기
 */
$matches = get_editor_image(stripslashes($wr_content),false);
if ($matches[1]) {
    foreach ($matches[1] as $k => $image) {
        $p = parse_url($image);
        $host = preg_replace('/www\./i','',$p['host']);
        $_host = preg_replace('/www\./i','',$_SERVER['HTTP_HOST']);

        $ex_url = '';
        if ($host != $_host) $ex_url = 'http://'.$host;
        $wr_image['url'][$k] = $ex_url . $p['path'];
    }
}

/**
 * 이미지 정보 eb_3
 */
if (count($wr_image)>0) {
    $up_set['eb_3'] = serialize($wr_image);
}

/**
 * 내용에서 코딩소스 제거
 */
if ($eyoom_board['bo_use_addon_coding'] == '1') {
    $wr_content = $bbs->remove_editor_code($wr_content);
}

/**
 * 내용에서 이모티콘 소스 제거
 */
if ($eyoom_board['bo_use_addon_emoticon'] == '1') {
    $wr_content = $bbs->remove_editor_emoticon($wr_content);
}

/**
 * 내용에서 사운드클라우드 소스 제거
 */
if ($eyoom_board['bo_use_addon_soundcloud'] == '1') {
    $wr_sound = '';
    $wr_sound = $bbs->get_editor_sound($wr_content);
    $wr_sound = serialize($wr_sound[1]);
    $wr_content = $bbs->remove_editor_sound($wr_content);
}

/**
 * 여유필드 eb_4 활용
 */
if ($eyoom_board['bo_use_addon_video'] == '1') {
    $eb_4 = $eb->mb_unserialize($eb_4);

    /**
     * 내용에서 동영상 정보 가져오기
     */
    $video_info = array();
    $video_info = $bbs->get_editor_video(strip_tags($wr_content));
    if ($video_info[1]) {
        $video_url = explode('|', $video_info[1][0]);

        $eb_4['is_video'] = true; // 비디오 내용이 있음
        $eb_4['thumb_src'] = $bbs->make_thumb_from_video($video_url, $bo_table, $wr_id, $board['bo_gallery_width'], $board['bo_gallery_height'] );
    } else {
        unset($eb_4['is_video'], $eb_4['thumb_src']);
    }

    /**
     * 내용에서 동영상소스 제거
     */
    $wr_content = $bbs->remove_editor_video($wr_content);

    /**
     * 여유필드 eb_4 시리얼라이즈
     */
    $up_set['eb_4'] = serialize($eb_4);
}

/**
 * 채택게시판 포인트
 */
if (preg_match('/adopt/i',$eyoom_board['bo_skin']) && $eyoom_board['bo_use_adopt_point'] && $_POST['adopt_point']) {
    $eb_6 = $eb->mb_unserialize($eb_6);
    $adopt_point = (int)clean_xss_tags($_POST['adopt_point']);
    if ($adopt_point > $member['mb_point']) {
        alert("채택 포인트는 보유하고 있는 포인트보다 높게 사용하실 수 없습니다.");
    }

    /**
     * 채텍포인트 적용
     */
    if (!$is_admin) {
        if ($w == '') {
            insert_point($member['mb_id'], $adopt_point*(-1), "{$board['bo_subject']}게시판 채택 포인트 설정 차감-".date('ymdhis'), $bo_table, $wr_id, "{$bo_table}-{$wr_id}-".date('ymdhis')." 채택게시판 글쓰기");
        } else if ($w == 'u' && $eb_6['adopt_point'] != $adopt_point) {
            $adopt_diff = (int)$adopt_point - (int)$eb_6['adopt_point'];
            insert_point($member['mb_id'], $adopt_diff*(-1), "{$board['bo_subject']}게시판 채택 포인트 재설정-".date('ymdhis'), $bo_table, $wr_id, "{$bo_table}-{$wr_id}-".date('ymdhis'));
        }
    }
    $eb_6['adopt_point'] = $adopt_point;

    /**
     * 여유필드 eb_6 시리얼라이즈
     */
    $up_set['eb_6'] = serialize($eb_6);
}

/**
 * 내용글에서 텍스트 추출
 */
$content = addslashes($bbs->text_abstract($wr_content, 300));

/**
 * 태그 정리
 */
if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1') {
    $del_tag    = get_text($_POST['del_tag']);
    $wr_tag     = get_text($_POST['wr_tag']);
    $del_tags   = explode(',', $del_tag);
    $wr_tags    = explode(',', $wr_tag);
    unset($wr_tag);
    if (is_array($wr_tags) && $_POST['wr_tag']) {
        if (!$del_tags) $del_tags = array();
        $i=0;
        foreach ($wr_tags as $_tag) {
            if (!in_array($_tag, $del_tags)) {
                $tag_array[$i] = $_tag;
                $i++;
            }
        }

        if (isset($tag_array) && is_array($tag_array)) {
            $wr_tag = implode(',', $tag_array);

            $tag_score = $w == 'u' ? 5: 20;
            foreach ($tag_array as $key => $_tag) {
                $info = sql_fetch("select tg_id, tg_regcnt, tg_score from {$g5['eyoom_tag']} where tg_theme = '" . sql_real_escape_string($theme) . "' and tg_word = '{$_tag}' ", false);
                $regcnt = $info['tg_regcnt'] + 1;
                if ($info['tg_id']) {
                    if ($w == 'u') $regcnt--;
                    $score = $info['tg_score'] + $tag_score + 1;
                    $tag_sql = "update {$g5['eyoom_tag']} set tg_score = '{$score}', tg_regcnt = '{$regcnt}' where tg_id = '{$info['tg_id']}'";
                } else {
                    $score = $tag_score + 10;
                    $tag_sql = "insert into {$g5['eyoom_tag']} set tg_theme = '" . sql_real_escape_string($theme) . "', tg_word = '{$_tag}', tg_regcnt = '1', tg_score = '{$score}', tg_regdt='".G5_TIME_YMDHIS."'";
                }
                sql_query($tag_sql, false);
            }
        }
    }
}

/**
 * sql 조건문
 */
$where = '';
$where = "bo_table = '{$bo_table}' and wr_id = '{$wr_id}'";

/**
 * 공통 $set
 */
$common_set = array();
$common_set['bo_table']     = $bo_table;
$common_set['wr_id']        = $wr_id;
$common_set['wr_subject']   = $wr_subject;
$common_set['wr_content']   = $content;
$common_set['wr_option']    = "{$html},{$secret},{$mail}";
$common_set['eb_1']         = $up_set['eb_1'];
$common_set['eb_2']         = $up_set['eb_2'];
$common_set['eb_3']         = $up_set['eb_3'];
$common_set['eb_4']         = $up_set['eb_4'];
$common_set['eb_5']         = $up_set['eb_5'];
$common_set['eb_6']         = $up_set['eb_6'];
$common_set['eb_7']         = $up_set['eb_7'];
$common_set['eb_8']         = $up_set['eb_8'];
$common_set['eb_9']         = $up_set['eb_9'];
$common_set['eb_10']        = $up_set['eb_10'];
$cmset = '';
$cmset = $eb->make_sql_set($common_set);
unset($common_set);

/**
 * 태그
 */
if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && isset($wr_tag)) {

    // 태그 insert set
    $wr_nick = $member['mb_id'] ? $member['mb_nick'] : $wr_name;

    $ins_tag_set['tw_theme']    = $theme;
    $ins_tag_set['wr_tag']      = $wr_tag;
    $ins_tag_set['mb_id']       = $member['mb_id'];
    $ins_tag_set['mb_name']     = $wr_name;
    $ins_tag_set['mb_nick']     = $wr_nick;
    $ins_tag_set['mb_level']    = $member['mb_level'];
    $ins_tag_set['wr_hit']      = 0;
    $ins_tag_set['tw_datetime'] = G5_TIME_YMDHIS;

    $tagset = $eb->make_sql_set($ins_tag_set);

    $insert_tag = "insert into {$g5['eyoom_tag_write']} set {$cmset},{$tagset}";
    unset($ins_tag_set, $tagset);

    // 태그 update set
    $up_tag_set['tw_theme'] = $theme;
    $up_tag_set['wr_tag']   = $wr_tag;

    $uptagset = $eb->make_sql_set($up_tag_set);

    $update_tag = "update {$g5['eyoom_tag_write']} set {$cmset},{$uptagset} where {$where} and tw_theme='" . sql_real_escape_string($theme) . "' ";
    sql_query($update_tag, false);
    unset($up_tag_set, $uptagset);
}

/**
 * 활동내역
 */
if ($w == '' || $w == 'r') {
    if (isset($wr_tag)) $tag_query = $insert_tag;

    // 나의활동 포인트
    if ($board['bo_point_target'] == 'eyoom' || $board['bo_point_target'] == 'all') {
        $write_point = $board['bo_write_point'];
        $reply_point = $board['bo_write_point'];
    } else {
        $write_point = $levelset['write'];
        $reply_point = $levelset['reply'];
    }

    if ($write_point || $reply_point) {
        switch($w) {
            default  : $act_type = 'new'; $eb->level_point($write_point); break;
            case 'r' : $act_type = 'reply'; $eb->level_point($reply_point); break;
        }
    }
    $act_contents = array();
    $act_contents['bo_table'] = $bo_table;
    $act_contents['bo_name'] = $board['bo_subject'];
    $act_contents['wr_id'] = $wr_id;
    $act_contents['subject'] = $wr_subject;
    $act_contents['content'] = $content;
    $eb->insert_activity($member['mb_id'],$act_type,$act_contents);

} else if ($w == 'u') {

    // 태그 정보가 이미 있다면 업데이트
    if (isset($wr_tag)) {
        $tag_post = sql_fetch("select tw_id from {$g5['eyoom_tag_write']} where {$where} and tw_theme='" . sql_real_escape_string($theme) . "'");

        // 태그 작성 테이블에 글이 있다면 업데이트
        if ($tag_post['tw_id']) {
            $tag_query = $update_tag;
        } else {
            // 정말 새로 작성한 글이라면 새로 등록
            $tag_query = $insert_tag;
        }
    } else {
        // 태그 정보가 없다면 태그 포스트는 삭제
        $tag_query = "delete from {$g5['eyoom_tag_write']} where {$where} and tw_theme='" . sql_real_escape_string($theme) . "' ";
    }
}
if (isset($tag_query)) sql_query($tag_query, false);
unset($cmset, $tag_query, $insert_tag, $update_tag);

/**
 * 지뢰폭탄 포인트 심기
 */
if ($w == '' || $w == 'r') {
    if ($eyoom_board['bo_bomb_point'] > 0 && $eyoom_board['bo_bomb_point_limit'] > 0 && $eyoom_board['bo_bomb_point_cnt'] > 0) {
        for ($i=0;$i<$eyoom_board['bo_bomb_point_cnt'];$i++) {
            $bomb[$i] = $eb->random_num($eyoom_board['bo_bomb_point_limit']-1);
        }
        if (is_array($bomb)) {
            $up_set['eb_2'] = serialize($bomb);
        }
    }
}

/**
 * $up_set 대상이 있다면 원본 테이블에 적용
 */
if (count((array)$up_set) > 0 && is_array($up_set) ) {
    $j=0;
    $set = array();
    foreach ($up_set as $key => $val) {
        $set[$j] = " {$key} = '{$val}' ";
        $j++;
    }
    $sql = "update {$write_table} set " . implode(',', $set) ." where wr_id='{$wr_id}'";
    sql_query($sql, false);
}

/**
 * 확장필드
 */
if ($bo_extend) {
    $j=0;
    $ex_set = array();
    foreach ($exbo as $ex_fname => $exinfo) {
        unset($ex_value);
        switch ($exinfo['ex_form']) {
            case 'text':
            case 'radio':
            case 'select':
                if (isset($_POST[$ex_fname]) && settype($_POST[$ex_fname], 'string')) {
                    $ex_value= trim($_POST[$ex_fname]);
                }
                break;
            case 'checkbox':
            case 'address':
                if (isset($_POST[$ex_fname]) && settype($_POST[$ex_fname], 'array')) {
                    $ex_value= implode('^|^', $_POST[$ex_fname]);
                }
                break;
            case 'textarea':
                if (isset($_POST[$ex_fname])) {
                    $ex_value = substr(trim($_POST[$ex_fname]),0,65536);
                    $ex_value = preg_replace("#[\\\]+$#", '', $ex_value);
                }

                if (substr_count($ex_value, '&#') > 50) {
                    alert("{$exinfo['ex_subject']}에 올바르지 않은 코드가 다수 포함되어 있습니다.");
                    exit;
                }
                break;
        }
        $ex_set[$j] = " {$ex_fname} = '{$ex_value}' ";
        $j++;
    }
    if (count($ex_set)>0) sql_query("update {$write_table} set " . implode(',', $ex_set) ." where wr_id='{$wr_id}'");
}

/**
 * 포인트게시글 : 유료스킨 전용
 */
if (preg_match("/pointpost/i", $eyoom_board['bo_skin']) && $eyoom_board['bo_use_pointpost'] && $eyoom_board['bo_pointpost_point']) {
    if (isset($_REQUEST['wr_point']) && $_REQUEST['wr_point']) {
        $wr_point = is_numeric($_REQUEST['wr_point']) ? (int) $_REQUEST['wr_point']: 0;
    } else {
        $wr_point = 0;
    }
    sql_query("update {$write_table} set wr_point = '{$wr_point}' where wr_id='{$wr_id}'");
}

/**
 * 투표 기능을 사용하고 투표가 활성화 된 상태
 */
if ($eyoom_board['bo_use_addon_poll'] == '1' && $wr_poll_use == '1') {
    $sql_poll_set = "
        wr_poll_use = '1',
        wr_poll_result = '{$wr_poll_result}',
        wr_poll_limit = '{$wr_poll_limit}',
        wr_poll_text = '{$wr_poll_text}',
        wr_poll_video = '{$wr_poll_video}'
    ";
    sql_query("update {$write_table} set {$sql_poll_set} where wr_id='{$wr_id}'");
}

/**
 * 최신글 캐시 스위치온
 */
if (!$eyoom_board['bo_use_scheduled']) {
    $latest->make_switch_on($bo_table, $theme);
} else {
    /**
     * 게시물 예약기능을 사용한다면
     */
    if (isset($_POST['wr_scheduled_date'])) $wr_scheduled_date = clean_xss_tags(trim($_POST['wr_scheduled_date']));
    if (isset($_POST['wr_scheduled_time'])) $wr_scheduled_time = clean_xss_tags(trim($_POST['wr_scheduled_time']));
    if ($wr_scheduled_date && $wr_scheduled_time) {
        sql_query("update {$write_table} set wr_opendate='{$wr_scheduled_date} {$wr_scheduled_time}:00' where wr_id='{$wr_id}'");
        $row = sql_fetch("select count(*) as cnt from {$g5['eyoom_scheduled']} where bo_table='{$bo_table}' and wr_id='{$wr_id}'");
        if ($row['cnt'] > 0) {
            sql_query("update {$g5['eyoom_scheduled']} set wr_opendate='{$wr_scheduled_date} {$wr_scheduled_time}:00' where bo_table='{$bo_table}' and wr_id='{$wr_id}'");
        } else {
            sql_query("insert into {$g5['eyoom_scheduled']} set bo_table='{$bo_table}', wr_id='{$wr_id}', wr_opendate='{$wr_scheduled_date} {$wr_scheduled_time}:00', tg_table='{$eyoom_board['bo_table_scheduled']}'");
        }
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/write_update.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_update.skin.php');

/**
 * 무한스크롤 리스트에서 뷰창을 띄웠을 경우
 */
$qstr .= $wmode ? $qstr.'&wmode=1':'';