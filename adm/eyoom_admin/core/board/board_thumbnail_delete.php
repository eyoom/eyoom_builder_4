<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

auth_check_menu($auth, $sub_menu, 'w');

if (!$board['bo_table']) {
    alert('존재하지 않는 게시판입니다.');
}

$g5['title'] = $board['bo_subject'] . ' 게시판 썸네일 삭제';

$directory = G5_DATA_PATH . '/file/' . $bo_table;

$cnt=0;
$print_html = array();
if (is_dir($directory)) {
    $files = glob($dirname.'/thumb-*');
    if (is_array($files)) {
        foreach($files as $thumbnail) {
            $cnt++;
            @unlink($thumbnail);

            $print_html[$cnt] = $thumbnail;

            flush();
        }
    }
}