<?php
/**
 * core file : /eyoom/core/board/write.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 승인게시판 승인게시물 수정 불가
 */
if ($board['bo_use_approval'] && (!$is_admin && $w=='u' && $write['wr_approval'] == '1')) {
    alert("이미 승인된 게시물은 수정하실 수 없습니다.");
}

/**
 * 이윰빌더용 여분필드
 */
if ($w == 'u' || $w == 'r') {
    // 가변 변수로 $eb_1 .. $eb_10 까지 만든다.
    for ($i=1; $i<=10; $i++) {
        $vvar = "eb_".$i;
        $$vvar = $write['eb_'.$i];
    }
}

/**
 * 익명글인지 체크
 */
$bo_use_anonymous = $eyoom_board['bo_use_anonymous'];
if ($w == 'u') {
    // 익명글 체크사용
    $wr_anonymous_checked = $bo_use_anonymous == '1' && $write['wr_anonymous'] == '1' ? 'checked':'';
}

/**
 * 글등록 회수 제한이 있는지 체크
 */
if ($w=='' && $eyoom_board['bo_write_limit'] && !$is_admin) {
    if (!$is_member) {
        alert("본 게시판은 하루 글작성 회수제한이 있는 게시판으로 비회원은 글을 작성하실 수 없습니다.");
    } else {
        $wr_limit = sql_fetch("select count(*) as cnt from {$write_table} where wr_id = wr_parent and (mb_id = '{$member['mb_id']}' or wr_ip = '" . $_SERVER['REMOTE_ADDR'] . "') and wr_datetime between '" . date('Y-m-d') . " 00:00:00' and '" . date('Y-m-d') . " 23:59:59' ");
        if ($wr_limit['cnt'] >= $eyoom_board['bo_write_limit']) {
            alert("[{$board['bo_subject']}]에는 하루에 {$eyoom_board['bo_write_limit']}개의 글을 작성하실 수 있습니다.");
        }
    }
}

/**
 * eb_1에 작성자의 레벨정보 입력
 */
if ($is_member) {
    if ($w==''||$w=='r') {
        $eb_1 = $member['mb_level']."|".$eyoomer['level'];
    } else if ($w=='u') {
        $mb = $eb->get_user_info($write['mb_id']);
        $gnu_level = $mb['mb_level'];
        $eyoom_level = $mb['level'];
        $eb_1 = $gnu_level."|".$eyoom_level;
    }
}

/**
 * 채택게시판의 설정값 가져오기
 */
if (preg_match('/adopt/i',$eyoom_board['bo_skin']) && $eyoom_board['bo_use_adopt_point'] == '1') {
    $eb_6 = $eb->mb_unserialize($eb_6);
    $adopt_point = $eb_6['adopt_point'];
    $eb_6 = serialize($eb_6);
}

/**
 * 링크 정보
 */
for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) {
    $wr_link[$i]['link_val'] = $write['wr_link'.$i];
}

/**
 * $file 변수 중복 제거 후, 첨부파일 갯수 세팅
 */
$wr_file = array();
if (in_array($file, $eb->get_subdir_filename(G5_EXTEND_PATH))) unset($file);
for ($i=0; $is_file && $i<$file_count; $i++) {
    $wr_file[$i]['file'] = $file[$i]['file'];
    $wr_file[$i]['size'] = $file[$i]['size'];
    $wr_file[$i]['source'] = $file[$i]['source'];
    $wr_file[$i]['bf_content'] = $file[$i]['bf_content'];
}

/**
 * 태그 정보
 */
if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) {
    $tag_info = $eb->get_tag_info($bo_table, $wr_id);
    if ($tag_info['wr_tag']) {
        $write['wr_tag'] = $tag_info['wr_tag'];
        $wr_tags = explode(',', $tag_info['wr_tag']);
    }
}

/**
 * 확장필드
 */
if ($bo_extend) {
    $ex_address = false;
    foreach ($exbo as $ex_fname => $exinfo) {
        unset($ex_required);
        if ($exinfo['ex_form'] == 'address') $ex_address = true;
        $ex_required = $exinfo['ex_required'] == 'y' ? ' required': '';
        $ex_value[$ex_fname] = $write[$ex_fname];

        switch($exinfo['ex_form']) {
            case 'text':
                $ex_write[$ex_fname] = '
<label for="'.$ex_fname.'" class="label">'.$exinfo['ex_subject'].'</label>
<label class="input">
    <input type="text" name="'.$ex_fname.'" id="'.$ex_fname.'" value="'.$ex_value[$ex_fname].'"'.$ex_required.'>
</label>
                ';
                break;

            case 'radio':
                $ex_write[$ex_fname] = '
<label class="label">'.$exinfo['ex_subject'].'</label>
<div class="inline-group">
                ';
                $ex_item = explode('|', $exinfo['ex_item_value']);
                if (is_array($ex_item)) {
                    foreach($ex_item as $key => $value) {
                        unset($chedked);
                        if ($value == $ex_value[$ex_fname]) $chedked = ' checked';
                        $ex_write[$ex_fname] .= '
    <label for="'.$ex_fname.'_'.($key+1).'" class="radio"><input type="radio" name="'.$ex_fname.'" id="'.$ex_fname.'_'.($key+1).'" value="'.$value.'"'.$chedked.'><i></i>'.$value.'</label>
                        ';
                    }
                }
                $ex_write[$ex_fname] .= '
</div>
                ';
                break;

            case 'checkbox':
                $ex_write[$ex_fname] = '
<label class="label">'.$exinfo['ex_subject'].'</label>
<div class="inline-group">
                ';
                $ex_item = explode('|', $exinfo['ex_item_value']);
                $ex_value_item = explode('^|^', $ex_value[$ex_fname]);
                if (is_array($ex_item)) {
                    foreach($ex_item as $key => $value) {
                        unset($chedked);
                        $ex_key = $ex_fname.'_'.($key+1);
                        if (in_array($value, $ex_value_item)) {
                            $chedked = ' checked';
                            $ex_value[$ex_key] = $value;
                        } else {
                            $ex_value[$ex_key] = '';
                        }
                        $ex_write[$ex_fname] .= '
    <label for="'.$ex_fname.'_'.($key+1).'" class="checkbox"><input type="checkbox" name="'.$ex_fname.'['.($key+1).']" id="'.$ex_fname.'_'.($key+1).'" value="'.$value.'"'.$chedked.'><i></i>'.$value.'</label>
                        ';
                    }
                }
                $ex_write[$ex_fname] .= '
</div>
                ';
                break;

            case 'select':
                $ex_write[$ex_fname] = '
<label class="label">'.$exinfo['ex_subject'].'</label>
<label class="select">
    <select name="'.$ex_fname.'" id="'.$ex_fname.'">
                ';
                $ex_item = explode('|', $exinfo['ex_item_value']);
                if (is_array($ex_item)) {
                    foreach($ex_item as $key => $value) {
                        unset($selected);
                        if ($value == $ex_value[$ex_fname]) $selected = ' selected';
                        $ex_write[$ex_fname] .= '
        <option value="'.$value.'"'.$selected.'>'.$value.'</option>
                        ';
                    }
                }
                $ex_write[$ex_fname] .= '
    </select>
    <i></i>
</label>
                ';
                break;

            case 'textarea':
                $var_editor = $ex_fname . '_editor_html';
                $$var_editor = editor_html($ex_fname, $ex_value[$ex_fname], $is_dhtml_editor);
                $editor_js .= get_editor_js($ex_fname, $is_dhtml_editor);
                $editor_js .= $exinfo['ex_required'] ? chk_editor_js($ex_fname, $is_dhtml_editor): '';

                $ex_write[$ex_fname] = '
<label class="label">'.$exinfo['ex_subject'].'</label>
<label class="textarea textarea-resizable">'.$$var_editor.'</label>
                ';
                break;

            case 'address':
                $address_info[$ex_fname] = explode('^|^', $ex_value[$ex_fname]);

                $ex_write[$ex_fname] = '
<div class="col col-12">
    <label class="label margin-left-5">'.$exinfo['ex_subject'].'</label>
</div>
<div class="col col-4">
    <label for="'.$ex_fname.'_zip" class="sound_only">우편번호</label>
    <label class="input">
        <i class="icon-append fa fa-question-circle"></i>
        <input type="text" name="'.$ex_fname.'[zip]" value="'.$address_info[$ex_fname][0].'" id="'.$ex_fname.'_zip"  size="5" maxlength="6">
        <b class="tooltip tooltip-top-right">우편번호 (주소 검색 버튼을 클릭하여 조회)</b>
    </label>
</div>
<div class="col col-4">
    <button type="button" onclick="win_zip(\'fwrite\', \''.$ex_fname.'[zip]\', \''.$ex_fname.'[addr1]\', \''.$ex_fname.'[addr2]\', \''.$ex_fname.'[addr3]\', \''.$ex_fname.'[addr_jibeon]\');" class="btn-e btn-e-indigo rounded address-search-btn">주소 검색</button>
</div>
<div class="clearfix margin-bottom-10"></div>
<div class="col col-12">
    <label class="input">
        <input type="text" name="'.$ex_fname.'[addr1]" value="'.$address_info[$ex_fname][1].'" id="'.$ex_fname.'_addr1"  size="50">
    </label>
    <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
</div>
<div class="clear"></div>
<div class="col col-6">
    <label class="input">
        <input type="text" name="'.$ex_fname.'[addr2]" value="'.$address_info[$ex_fname][2].'" id="'.$ex_fname.'_addr2" size="50">
    </label>
    <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
</div>
<div class="col col-6">
    <label class="input">
        <input type="text" name="'.$ex_fname.'[addr3]" value="'.$address_info[$ex_fname][3].'" id="'.$ex_fname.'_addr3" size="50" readonly="readonly">
    </label>
    <div class="note margin-bottom-10"><strong>Note:</strong> 참고항목</div>
</div>
<input type="hidden" name="'.$ex_fname.'[addr_jibeon]" value="'.$address_info[$ex_fname][4].'">
                ';
                break;
        }
    }
}

/**
 * 다음 주소 검색 스크립트
 */
if ($eyoom_board['bo_use_addon_map'] == '1' || (isset($ex_address) && $ex_address)) {
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
}

/**
 * 투표기능
 */
if ($eyoom_board['bo_use_addon_poll'] == '1') {
    /**
     * 투표관련 필드 추가
     */
    if(!sql_query(" select wr_poll_result from {$write_table} limit 1 ", false)) {
        sql_query(" ALTER TABLE `{$write_table}`
                        ADD `wr_poll_use` char(1) NOT NULL DEFAULT '0' AFTER `wr_datetime`,
                        ADD `wr_poll_result` varchar(255) NOT NULL DEFAULT '' AFTER `wr_poll_use`,
                        ADD `wr_poll_limit` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `wr_poll_result`,
                        ADD `wr_poll_text` varchar(255) NOT NULL DEFAULT '' AFTER `wr_poll_limit`,
                        ADD `wr_poll_video` text NOT NULL AFTER `wr_poll_text` ", true);
    }

    /**
     * 투표타입 기본값 : text
     */
    $poll_type = 'text';
    if (isset($write['wr_poll_limit']) && $write['wr_poll_limit']) {
        /**
         * 투표타입 정의
         */
        if ($write['wr_poll_text'] != '') {
            $poll_type = 'text';
        } else if ($write['wr_poll_video'] != '') {
            $poll_type = 'video';
        } else if ($write['wr_poll_text'] == '' && $write['wr_poll_video'] == '') {
            $poll_type = 'image';
        }

        /**
         * 투표 마감일
         */
        list($poll_limit_date, $poll_limit_time) = explode(' ', $write['wr_poll_limit']);
        list($poll_limit_hour, $poll_limit_minute, $poll_limit_second) = explode(":", $poll_limit_time);
    } else {
        $poll_limit_date    = '';
        $poll_limit_time    = '';
        $poll_limit_hour    = '';
        $poll_limit_minute  = '';
        $poll_limit_second  = '';
    }
}

/**
 * 이윰 여분필드 변수값 암호화
 */
$eb_1 = $eb_1 ? $eb->encrypt_aes($eb_1): '';
$eb_2 = $eb_2 ? $eb->encrypt_aes($eb_2): '';
$eb_3 = $eb_3 ? $eb->encrypt_aes($eb_3): '';
$eb_4 = $eb_4 ? $eb->encrypt_aes($eb_4): '';
$eb_5 = $eb_5 ? $eb->encrypt_aes($eb_5): '';
$eb_6 = $eb_6 ? $eb->encrypt_aes($eb_6): '';
$eb_7 = $eb_7 ? $eb->encrypt_aes($eb_7): '';
$eb_8 = $eb_8 ? $eb->encrypt_aes($eb_8): '';
$eb_9 = $eb_9 ? $eb->encrypt_aes($eb_9): '';
$eb_10 = $eb_10 ? $eb->encrypt_aes($eb_10): '';

/**
 * 예약게시판 공개시간
 */
if ($eyoom_board['bo_use_scheduled'] == '1') {
    if ($write['wr_opendate']) {
        $wr_scheduled_date = substr($write['wr_opendate'], 0, 10);
        $wr_scheduled_time = substr($write['wr_opendate'], 11, 5);   
    }

    if ($eyoom_board['bo_table_scheduled']) {
        $bo = sql_fetch("select bo_table, bo_subject from {$g5['board_table']} where bo_table = '{$eyoom_board['bo_table_scheduled']}' ");
    }
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/write.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['board'].'/write.skin.html.php');
