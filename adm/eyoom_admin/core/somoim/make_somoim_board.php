<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/make_somoim_board.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350100";

/**
 * 소모임 그룹 생성
 */
$gr_id = $sm_bo_table;
$gr_subject = '소모임';
$sql_common = " gr_subject = '{$gr_subject}' ";

$sql = " select count(*) as cnt from {$g5['group_table']} where gr_id = '{$gr_id}' ";
$row = sql_fetch($sql);
if (!$row['cnt']) {
    $sql = " insert into {$g5['group_table']} set gr_id = '{$gr_id}', {$sql_common} ";
    sql_query($sql);
}

/**
 * 소모임 신청 게시판 생성
 */
$sql = "select bo_table from {$g5['board_table']} where (1) order by bo_table limit 1 ";
$row = sql_fetch($sql);
$bo_table = $row['bo_table'];

$board = sql_fetch("select * from {$g5['board_table']} where bo_table = '{$bo_table}' ");
$target_table   = trim($sm_bo_table);
$target_subject = '소모임 신청';

$row = sql_fetch(" select count(*) as cnt from {$g5['board_table']} where bo_table = '$target_table' ");
if (!$row['cnt']) {
    // 게시판 테이블 생성
    $sql = get_table_define($g5['write_prefix'] . $bo_table);
    $sql = str_replace($g5['write_prefix'] . $bo_table, $g5['write_prefix'] . $target_table, $sql);
    sql_query($sql, false);
    
    $board['bo_notice'] = '';
    $board['bo_list_level'] = 1;
    $board['bo_read_level'] = 1;
    $board['bo_write_level'] = 2;
    $board['bo_reply_level'] = 2;
    $board['bo_comment_level'] = 2;
    $board['bo_upload_level'] = 2;
    $board['bo_download_level'] = 1;
    $board['bo_html_level'] = 2;
    $board['bo_link_level'] = 2;
    
    // 추천기능 사용
    $board['bo_use_good'] = 1;
    
    // 에디터 사용
    $board['bo_use_dhtml_editor'] = 1;
    
    // 포인트
    $board['bo_read_point'] = 0;
    $board['bo_write_point'] = 0;
    $board['bo_comment_point'] = 0;
    $board['bo_download_point'] = 0;

    // 게시판 정보
    $sql = " insert into {$g5['board_table']}
                set bo_table = '$target_table',
                    gr_id = '{$gr_id}',
                    bo_subject = '$target_subject',
                    bo_device = '{$board['bo_device']}',
                    bo_admin = '{$board['bo_admin']}',
                    bo_list_level = '{$board['bo_list_level']}',
                    bo_read_level = '{$board['bo_read_level']}',
                    bo_write_level = '{$board['bo_write_level']}',
                    bo_reply_level = '{$board['bo_reply_level']}',
                    bo_comment_level = '{$board['bo_comment_level']}',
                    bo_upload_level = '{$board['bo_upload_level']}',
                    bo_download_level = '{$board['bo_download_level']}',
                    bo_html_level = '{$board['bo_html_level']}',
                    bo_link_level = '{$board['bo_link_level']}',
                    bo_count_modify = '{$board['bo_count_modify']}',
                    bo_count_delete = '{$board['bo_count_delete']}',
                    bo_read_point = '{$board['bo_read_point']}',
                    bo_write_point = '{$board['bo_write_point']}',
                    bo_comment_point = '{$board['bo_comment_point']}',
                    bo_download_point = '{$board['bo_download_point']}',
                    bo_use_category = '{$board['bo_use_category']}',
                    bo_category_list = '{$board['bo_category_list']}',
                    bo_use_sideview = '{$board['bo_use_sideview']}',
                    bo_use_file_content = '{$board['bo_use_file_content']}',
                    bo_use_secret = '{$board['bo_use_secret']}',
                    bo_use_dhtml_editor = '{$board['bo_use_dhtml_editor']}',
                    bo_use_rss_view = '{$board['bo_use_rss_view']}',
                    bo_use_good = '{$board['bo_use_good']}',
                    bo_use_nogood = '{$board['bo_use_nogood']}',
                    bo_use_name = '{$board['bo_use_name']}',
                    bo_use_signature = '{$board['bo_use_signature']}',
                    bo_use_ip_view = '{$board['bo_use_ip_view']}',
                    bo_use_list_view = '{$board['bo_use_list_view']}',
                    bo_use_list_content = '{$board['bo_use_list_content']}',
                    bo_table_width = '{$board['bo_table_width']}',
                    bo_subject_len = '{$board['bo_subject_len']}',
                    bo_mobile_subject_len = '{$board['bo_mobile_subject_len']}',
                    bo_page_rows = '{$board['bo_page_rows']}',
                    bo_mobile_page_rows = '{$board['bo_mobile_page_rows']}',
                    bo_new = '{$board['bo_new']}',
                    bo_hot = '{$board['bo_hot']}',
                    bo_image_width = '{$board['bo_image_width']}',
                    bo_skin = '{$board['bo_skin']}',
                    bo_mobile_skin = '{$board['bo_mobile_skin']}',
                    bo_include_head = '{$board['bo_include_head']}',
                    bo_include_tail = '{$board['bo_include_tail']}',
                    bo_content_head = '".addslashes($board['bo_content_head'])."',
                    bo_content_tail = '".addslashes($board['bo_content_tail'])."',
                    bo_mobile_content_head = '".addslashes($board['bo_mobile_content_head'])."',
                    bo_mobile_content_tail = '".addslashes($board['bo_mobile_content_tail'])."',
                    bo_insert_content = '".addslashes($board['bo_insert_content'])."',
                    bo_gallery_cols = '{$board['bo_gallery_cols']}',
                    bo_gallery_width = '{$board['bo_gallery_width']}',
                    bo_gallery_height = '{$board['bo_gallery_height']}',
                    bo_mobile_gallery_width = '{$board['bo_mobile_gallery_width']}',
                    bo_mobile_gallery_height = '{$board['bo_mobile_gallery_height']}',
                    bo_upload_size = '{$board['bo_upload_size']}',
                    bo_reply_order = '{$board['bo_reply_order']}',
                    bo_use_search = '{$board['bo_use_search']}',
                    bo_order = '{$board['bo_order']}',
                    bo_notice = '{$board['bo_notice']}',
                    bo_upload_count = '{$board['bo_upload_count']}',
                    bo_use_email = '{$board['bo_use_email']}',
                    bo_use_cert = '{$board['bo_use_cert']}',
                    bo_use_sns = '{$board['bo_use_sns']}',
                    bo_sort_field = '{$board['bo_sort_field']}',
                    bo_ex_cnt = '{$board['bo_ex_cnt']}',
                    bo_1_subj = '".addslashes($board['bo_1_subj'])."',
                    bo_2_subj = '".addslashes($board['bo_2_subj'])."',
                    bo_3_subj = '".addslashes($board['bo_3_subj'])."',
                    bo_4_subj = '".addslashes($board['bo_4_subj'])."',
                    bo_5_subj = '".addslashes($board['bo_5_subj'])."',
                    bo_6_subj = '".addslashes($board['bo_6_subj'])."',
                    bo_7_subj = '".addslashes($board['bo_7_subj'])."',
                    bo_8_subj = '".addslashes($board['bo_8_subj'])."',
                    bo_9_subj = '".addslashes($board['bo_9_subj'])."',
                    bo_10_subj = '".addslashes($board['bo_10_subj'])."',
                    bo_1 = '".addslashes($board['bo_1'])."',
                    bo_2 = '".addslashes($board['bo_2'])."',
                    bo_3 = '".addslashes($board['bo_3'])."',
                    bo_4 = '".addslashes($board['bo_4'])."',
                    bo_5 = '".addslashes($board['bo_5'])."',
                    bo_6 = '".addslashes($board['bo_6'])."',
                    bo_7 = '".addslashes($board['bo_7'])."',
                    bo_8 = '".addslashes($board['bo_8'])."',
                    bo_9 = '".addslashes($board['bo_9'])."',
                    bo_10 = '".addslashes($board['bo_10'])."' ";
    sql_query($sql, false);
    
    /**
     * 이윰 게시판 테이블에 게시판 정보가 있는지 체크
     */
    $sql = "insert into {$g5['eyoom_board']} set bo_table='{$target_table}', gr_id='{$gr_id}', bo_theme='{$this_theme}', bo_skin='somoim', use_gnu_skin='n'";
    sql_query($sql, false);

    // 게시판 폴더 생성
    @mkdir(G5_DATA_PATH.'/file/'.$target_table, G5_DIR_PERMISSION);
    @chmod(G5_DATA_PATH.'/file/'.$target_table, G5_DIR_PERMISSION);
    
    // 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
    $board_path = G5_DATA_PATH.'/file/'.$target_table;
    $file = $board_path . '/index.php';
    $f = @fopen($file, 'w');
    @fwrite($f, '');
    @fclose($f);
    @chmod($file, G5_FILE_PERMISSION);
    
    delete_cache_latest($bo_table);
    delete_cache_latest($target_table);
}