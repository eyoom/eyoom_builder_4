<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/make_somoim_board.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350100";

if (!isset($sm_bo_table)) exit;

/**
 * 소모임 그룹 생성
 */
$sql = "select bo_table from {$g5['board_table']} where (1) order by bo_table limit 1 ";
$row = sql_fetch($sql);
$bo_table = $row['bo_table'];

$gr_subject = '소모임';

$sql = " select count(*) as cnt from {$g5['group_table']} where gr_id = '{$sm_bo_table}' ";
$row = sql_fetch($sql);
if (!$row['cnt']) {
    $sql = " insert into {$g5['group_table']} set gr_id = '{$sm_bo_table}', gr_subject = '{$gr_subject}' ";
    sql_query($sql);
}

/**
 * 소모임 신청 게시판 생성
 */
$target_table   = $sm_bo_table;
$target_subject = '소모임 신청';

$row = sql_fetch(" select count(*) as cnt from {$g5['board_table']} where bo_table = '$target_table' ");
if (!$row['cnt']) {
    // 게시판 테이블 생성
    $sql = get_table_define($g5['write_prefix'] . $bo_table);
    $sql = str_replace($g5['write_prefix'] . $bo_table, $g5['write_prefix'] . $target_table, $sql);
    sql_query($sql, false);

    // 게시판 정보
    $sql = " insert into {$g5['board_table']}
                set bo_table = '{$target_table}',
                    gr_id = '{$sm_bo_table}',
                    bo_subject = '$target_subject',
                    bo_device = 'both',
                    bo_admin = '',
                    bo_list_level = '1',
                    bo_read_level = '1',
                    bo_write_level = '2',
                    bo_reply_level = '2',
                    bo_comment_level = '2',
                    bo_upload_level = '2',
                    bo_download_level = '1',
                    bo_html_level = '2',
                    bo_link_level = '2',
                    bo_count_modify = '1',
                    bo_count_delete = '1',
                    bo_read_point = '0',
                    bo_write_point = '0',
                    bo_comment_point = '0',
                    bo_download_point = '0',
                    bo_use_category = '0',
                    bo_category_list = '',
                    bo_use_sideview = '1',
                    bo_use_file_content = '1',
                    bo_use_secret = '0',
                    bo_use_dhtml_editor = '1',
                    bo_use_rss_view = '1',
                    bo_use_good = '1',
                    bo_use_nogood = '0',
                    bo_use_name = '0',
                    bo_use_signature = '1',
                    bo_use_ip_view = '0',
                    bo_use_list_view = '0',
                    bo_use_list_content = '0',
                    bo_table_width = '100',
                    bo_subject_len = '60',
                    bo_mobile_subject_len = '30',
                    bo_page_rows = '20',
                    bo_mobile_page_rows = '20',
                    bo_new = '24',
                    bo_hot = '1000',
                    bo_image_width = '600',
                    bo_skin = 'basic',
                    bo_mobile_skin = 'basic',
                    bo_include_head = '_head.php',
                    bo_include_tail = '_tail.php',
                    bo_content_head = '',
                    bo_content_tail = '',
                    bo_mobile_content_head = '',
                    bo_mobile_content_tail = '',
                    bo_insert_content = '',
                    bo_gallery_cols = '4',
                    bo_gallery_width = '600',
                    bo_gallery_height = '0',
                    bo_mobile_gallery_width = '600',
                    bo_mobile_gallery_height = '0',
                    bo_upload_size = '1048576',
                    bo_reply_order = '1',
                    bo_use_search = '1',
                    bo_order = '0',
                    bo_notice = '',
                    bo_upload_count = '2',
                    bo_use_email = '0',
                    bo_use_cert = '',
                    bo_use_sns = '1',
                    bo_sort_field = '',
                    bo_ex_cnt = '0',
                    bo_1_subj = '',
                    bo_2_subj = '',
                    bo_3_subj = '',
                    bo_4_subj = '',
                    bo_5_subj = '',
                    bo_6_subj = '',
                    bo_7_subj = '',
                    bo_8_subj = '',
                    bo_9_subj = '',
                    bo_10_subj = '',
                    bo_1 = '',
                    bo_2 = '',
                    bo_3 = '',
                    bo_4 = '',
                    bo_5 = '',
                    bo_6 = '',
                    bo_7 = '',
                    bo_8 = '',
                    bo_9 = '',
                    bo_10 = '' ";
    sql_query($sql, false);
    
    /**
     * 이윰 게시판 테이블에 게시판 정보가 있는지 체크
     */
    $sql = "insert into {$g5['eyoom_board']} set bo_table='{$target_table}', gr_id='{$sm_bo_table}', bo_skin='somoim', use_gnu_skin='n'";
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

    delete_cache_latest($target_table);
}