<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_form_update&amp;smode=1';

require_once G5_EDITOR_LIB;

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

auth_check_menu($auth, $sub_menu, 'w');

$sql = " select count(*) as cnt from {$g5['group_table']} ";
$row = sql_fetch($sql);
if (!$row['cnt']) {
    alert('게시판그룹이 한개 이상 생성되어야 합니다.', './boardgroup_form.php');
}

$html_title = '게시판';

if (!isset($board['bo_device'])) {
    // 게시판 사용 필드 추가
    // both : pc, mobile 둘다 사용
    // pc : pc 전용 사용
    // mobile : mobile 전용 사용
    // none : 사용 안함
    sql_query(" ALTER TABLE  `{$g5['board_table']}` ADD  `bo_device` ENUM(  'both',  'pc',  'mobile' ) NOT NULL DEFAULT  'both' AFTER  `bo_subject` ", false);
}

if (!isset($board['bo_mobile_skin'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_mobile_skin` VARCHAR(255) NOT NULL DEFAULT '' AFTER `bo_skin` ", false);
}

if (!isset($board['bo_gallery_width'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_gallery_width` INT NOT NULL AFTER `bo_gallery_cols`,  ADD `bo_gallery_height` INT NOT NULL DEFAULT '0' AFTER `bo_gallery_width`,  ADD `bo_mobile_gallery_width` INT NOT NULL DEFAULT '0' AFTER `bo_gallery_height`,  ADD `bo_mobile_gallery_height` INT NOT NULL DEFAULT '0' AFTER `bo_mobile_gallery_width` ", false);
}

if (!isset($board['bo_mobile_subject_len'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_mobile_subject_len` INT(11) NOT NULL DEFAULT '0' AFTER `bo_subject_len` ", false);
}

if (!isset($board['bo_mobile_page_rows'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_mobile_page_rows` INT(11) NOT NULL DEFAULT '0' AFTER `bo_page_rows` ", false);
}

if (!isset($board['bo_mobile_content_head'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_mobile_content_head` TEXT NOT NULL AFTER `bo_content_head`, ADD `bo_mobile_content_tail` TEXT NOT NULL AFTER `bo_content_tail`", false);
}

if (!isset($board['bo_use_cert'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_use_cert` ENUM('','cert','adult') NOT NULL DEFAULT '' AFTER `bo_use_email` ", false);
}

if (!isset($board['bo_use_sns'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_use_sns` TINYINT NOT NULL DEFAULT '0' AFTER `bo_use_cert` ", false);

    $result = sql_query(" select bo_table from `{$g5['board_table']}` ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        sql_query(
            " ALTER TABLE `{$g5['write_prefix']}{$row['bo_table']}`
                    ADD `wr_facebook_user` VARCHAR(255) NOT NULL DEFAULT '' AFTER `wr_ip`,
                    ADD `wr_twitter_user` VARCHAR(255) NOT NULL DEFAULT '' AFTER `wr_facebook_user` ", false
        );
    }
}

$sql = " SHOW COLUMNS FROM `{$g5['board_table']}` LIKE 'bo_use_cert' ";
$row = sql_fetch($sql);
if (strpos($row['Type'], 'hp-') === false) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` CHANGE `bo_use_cert` `bo_use_cert` ENUM('','cert','adult','hp-cert','hp-adult') NOT NULL DEFAULT '' ", false);
}

if (!isset($board['bo_use_list_file'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_use_list_file` TINYINT NOT NULL DEFAULT '0' AFTER `bo_use_list_view` ", false);

    $result = sql_query(" select bo_table from `{$g5['board_table']}` ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        sql_query(
            " ALTER TABLE `{$g5['write_prefix']}{$row['bo_table']}`
                    ADD `wr_file` TINYINT NOT NULL DEFAULT '0' AFTER `wr_datetime` ", false
        );
    }
}

if (!isset($board['bo_mobile_subject'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_mobile_subject` VARCHAR(255) NOT NULL DEFAULT '' AFTER `bo_subject` ", false);
}

if (!isset($board['bo_use_captcha'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_use_captcha` TINYINT NOT NULL DEFAULT '0' AFTER `bo_use_sns` ", false);
}

if (!isset($board['bo_select_editor'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_select_editor` VARCHAR(50) NOT NULL DEFAULT '' AFTER `bo_use_dhtml_editor` ", false);
}

if (!isset($board['bo_point_target'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_point_target` VARCHAR(10) NOT NULL DEFAULT 'gnu' AFTER `bo_count_modify` ", false);
}

if (isset($eyoom_board['bo_use_summernote_mo'])) {
    sql_query(" ALTER TABLE `{$g5['eyoom_board']}` CHANGE `bo_use_summernote_mo` `bo_goto_url` VARCHAR(255) NULL", false);
    sql_query(" UPDATE `{$g5['eyoom_board']}` SET `bo_goto_url` = '' ", false);
}

if (!isset($board['bo_poll_level'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_poll_level` tinyint(4) NOT NULL DEFAULT '1' AFTER `bo_html_level` ", false);
}

/**
 * 회원당 하루 게시물 작성회수 설정 필드 추가
 */
if(!isset($board['bo_use_wrlimit'])) {
    sql_query(" ALTER TABLE `{$g5['board_table']}` ADD `bo_use_wrlimit` TINYINT NOT NULL DEFAULT '0' AFTER `bo_use_captcha` ", false);
}

$board_default = array(
'bo_mobile_subject'=>'',
'bo_device'=>'',
'bo_use_category'=>0,
'bo_category_list'=>'',
'bo_admin'=>'',
'bo_list_level'=>0,
'bo_read_level'=>0,
'bo_write_level'=>0,
'bo_reply_level'=>0,
'bo_comment_level'=>0,
'bo_link_level'=>0,
'bo_upload_level'=>0,
'bo_download_level'=>0,
'bo_html_level'=>0,
'bo_poll_level'=>0,
'bo_use_sideview'=>0,
'bo_select_editor'=>'',
'bo_use_rss_view'=>0,
'bo_use_good'=>0,
'bo_use_nogood'=>0,
'bo_use_name'=>0,
'bo_use_signature'=>0,
'bo_use_ip_view'=>0,
'bo_use_list_content'=>0,
'bo_use_list_file'=>0,
'bo_use_list_view'=>0,
'bo_use_email'=>0,
'bo_use_file_content'=>0,
'bo_use_cert'=>'',
'bo_write_min'=>0,
'bo_write_max'=>0,
'bo_comment_min'=>0,
'bo_comment_max'=>0,
'bo_use_sns'=>0,
'bo_order'=>0,
'bo_use_captcha'=>0,
'bo_content_head'=>'',
'bo_content_tail'=>'',
'bo_mobile_content_head'=>'',
'bo_mobile_content_tail'=>'',
'bo_insert_content'=>'',
'bo_sort_field'=>'',
);

for ($i = 0; $i <= 10; $i++) {
    $board_default['bo_'.$i.'_subj'] = '';
    $board_default['bo_'.$i] = '';
}

$board = array_merge($board_default, $board);

run_event('adm_board_form_before', $board, $w);

$required = "";
$readonly = "";
$sound_only = "";
$required_valid = "";
if ($w == '') {
    $html_title .= ' 생성';

    unset($eyoom_board);
    $eyoom_board['use_gnu_skin'] = 'n';
    $eyoom_board['bo_skin'] = 'basic';

    $required = 'required';
    $required_valid = 'alnum_';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $board['bo_count_delete'] = 1;
    $board['bo_count_modify'] = 1;
    $board['bo_read_point'] = $config['cf_read_point'];
    $board['bo_write_point'] = $config['cf_write_point'];
    $board['bo_comment_point'] = $config['cf_comment_point'];
    $board['bo_download_point'] = $config['cf_download_point'];

    $board['bo_gallery_cols'] = 4;
    $board['bo_gallery_width'] = 202;
    $board['bo_gallery_height'] = 150;
    $board['bo_mobile_gallery_width'] = 125;
    $board['bo_mobile_gallery_height'] = 100;
    $board['bo_table_width'] = 100;
    $board['bo_page_rows'] = $config['cf_page_rows'];
    $board['bo_mobile_page_rows'] = $config['cf_page_rows'];
    $board['bo_subject_len'] = 60;
    $board['bo_mobile_subject_len'] = 30;
    $board['bo_new'] = 24;
    $board['bo_hot'] = 100;
    $board['bo_image_width'] = 600;
    $board['bo_upload_count'] = 2;
    $board['bo_upload_size'] = 1048576;
    $board['bo_reply_order'] = 1;
    $board['bo_use_search'] = 1;
    $board['bo_skin'] = 'basic';
    $board['bo_mobile_skin'] = 'basic';
    $board['gr_id'] = $gr_id;
    $board['bo_use_secret'] = 0;
    $board['bo_include_head'] = '_head.php';
    $board['bo_include_tail'] = '_tail.php';
} elseif ($w == 'u') {
    $html_title .= ' 수정';

    if (!$board['bo_table']) {
        alert('존재하지 않은 게시판 입니다.');
    }

    if ($is_admin == 'group') {
        if ($member['mb_id'] != $group['gr_admin']) {
            alert('그룹이 틀립니다.');
        }
    }

    $readonly = 'readonly';
}

if ($is_admin != 'super') {
    $group = get_group($board['gr_id']);
    $is_admin = is_admin($member['mb_id']);
}

$g5['title'] = $html_title;

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_bo_basic' => '기본 설정',
    'anc_bo_auth' => '권한 설정',
    'anc_bo_function' => '기능 설정',
    'anc_bo_design' => '디자인/양식',
    'anc_bo_point' => '포인트 설정',
    'anc_bo_exfields' => '여분필드'
);

$board_auth = array(
    'list'      => '목록보기',
    'read'      => '글읽기',
    'write'     => '글쓰기',
    'reply'     => '글답변',
    'comment'   => '댓글쓰기',
    'link'      => '링크',
    'upload'    => '업로드',
    'download'  => '다운로드',
    'html'      => 'HTML 쓰기',
    'poll'      => '투표하기'
);
$i = 0;
foreach($board_auth as $key => $val) {
    $bo_auth[$i]['item'] = $key;
    $bo_auth[$i]['text'] = $val;
    $bo_auth[$i]['field'] = "bo_{$key}_level";
    $bo_auth[$i]['level'] = $board["bo_{$key}_level"];
    $i++;
}

/**
 * 이윰 게시판 스킨
 */
$bo_eyoom_skin = get_skin_dir('board',G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * 게시물 랜덤노출 기능 추가
 */
$bo_sort_fields = get_board_sort_fields($board);
$bo_sort_rand = array("rand()","랜덤");
$bo_sort_fields = $eb->insert_array($bo_sort_fields, 1, $bo_sort_rand);

// query string
$qstr .= $gr_id ? '&amp;gr_id='.$gr_id: '';
$qstr .= $bo_skin ? '&amp;bo_skin='.$bo_skin: '';
$qstr .= $bo_mobile_skin ? '&amp;bo_mobile_skin='.$bo_mobile_skin: '';
$qstr .= $bo_ex ? '&amp;bo_ex='.$bo_ex: '';
$qstr .= $bo_cate ? '&amp;bo_cate='.$bo_cate: '';
$qstr .= $bo_sideview ? '&amp;bo_sideview='.$bo_sideview: '';
$qstr .= $bo_dhtml ? '&amp;bo_dhtml='.$bo_dhtml: '';
$qstr .= $bo_secret ? '&amp;bo_secret='.$bo_secret: '';
$qstr .= $bo_good ? '&amp;bo_good='.$bo_good: '';
$qstr .= $bo_nogood ? '&amp;bo_nogood='.$bo_nogood: '';
$qstr .= $bo_file ? '&amp;bo_file='.$bo_file: '';
$qstr .= $bo_cont ? '&amp;bo_cont='.$bo_cont: '';
$qstr .= $bo_list ? '&amp;bo_list='.$bo_list: '';
$qstr .= $bo_sns ? '&amp;bo_sns='.$bo_sns: '';
$qstr .= $wmode ? '&amp;wmode=1': '';

/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="확인" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
if ($bo_table && $w && !$wmode) {
    $frm_submit .= ' <a href="'.G5_ADMIN_URL.'/?dir=board&amp;pid=board_copy&amp;bo_table='.$board['bo_table'].'&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="btn-e btn-e-lg btn-e-dark">게시판복사</a> <a href="'.get_eyoom_pretty_url($board['bo_table']).'" class="btn-e btn-e-lg btn-e-dark" target="_blank">게시판 바로가기</a> <a href="'.G5_ADMIN_URL.'/?dir=board&amp;pid=board_thumbnail_delete&amp;bo_table='.$board['bo_table'].'&amp;'.$qstr.'" onclick="return delete_confirm2(\"게시판 썸네일 파일을 삭제하시겠습니까?\");"  class="btn-e btn-e-lg btn-e-dark">게시판 썸네일 삭제</a>';
}
if (!$wmode) {
    $frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=board&amp;pid=board_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
}
$frm_submit .= '</div>';