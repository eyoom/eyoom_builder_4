<?php
/**
 * @file    /adm/eyoom_admin/core/member/delete_spam_posts.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') {
    alert("접근권한이 없습니다.");
}

/**
 * 스팸글 작성 회원 아이디 체크
 */
$mb_id = clean_xss_tags(trim($_GET['mb_id']));
$mb_id = preg_replace('/[^a-zA-Z0-9_]/', '', $mb_id);
if (!$mb_id) {
    alert("잘못된 접근입니다.");
} else {
    $sql_where = "mb_id = '{$mb_id}'";

    // 2일전 포스팅 기간 설정
    $fr_date = date('Y-m-d', strtotime("-2 days"));
    $to_date = date('Y-m-d');
    $sql_period = " and (wr_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59') ";

    // 다중관리자 계정 예외처리
    $sql = "select mb_id from {$g5['eyoom_manager']} where 1 order by mb_id asc";
    $result = sql_query($sql);
    $_manager = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $_manager[$i] = $row['mb_id'];
    }

    if ($mb_id == $config['cf_admin'] || in_array($mb_id, $_manager)) {
        alert("관리자 계정으로 작성된 글은 삭제하실 수 없습니다.");
    }
}

/**
 * 전제 게시판에서 회원이 작성한 모든 글을 삭제
 */
$bo_info = $eb->get_all_board_info();
if (!$bo_info) $bo_info = array();
$bo_count = count($bo_info);
for ($i=0; $i<$bo_count; $i++) {
    $write_table = $g5['write_prefix'] . $bo_info[$i]['bo_table'];
    $sql = "select * from {$write_table} where {$sql_where} {$sql_period}";
    $result = sql_query($sql);
    for ($j=0; $row=sql_fetch_array($result); $j++) {
        // 원글이라면
        if (!$row['wr_is_comment'])
        {
            // 업로드된 파일이 있다면
            $sql2 = " select * from {$g5['board_file_table']} where bo_table = '{$bo_info[$i]['bo_table']}' and wr_id = '{$row['wr_id']}' ";
            $result2 = sql_query($sql2);
            while ($row2 = sql_fetch_array($result2)) {
                // 파일삭제
                $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_info[$i]['bo_table'].'/'.str_replace('../', '',$row2['bf_file']), $row2);
                if( file_exists($delete_file) ){
                    @unlink($delete_file);
                }

                // 썸네일삭제
                if(preg_match("/\.({$config['cf_image_extension']})$/i", $row2['bf_file'])) {
                    delete_board_thumbnail($bo_info[$i]['bo_table'], $row2['bf_file']);
                }
            }

            // 에디터 썸네일 삭제
            delete_editor_thumbnail($row['wr_content']);

            // 파일테이블 행 삭제
            sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_info[$i]['bo_table']}' and wr_id = '{$row['wr_id']}' ");
            $count_write++;
        }
        else
        {
            // 코멘트 포인트 삭제
            if (!delete_point($mb_id, $bo_info[$i]['bo_table'], $row['wr_id'], '댓글'))
                insert_point($mb_id, $bo_info[$i]['bo_comment_point'] * (-1), "{$bo_info[$i]['bo_subject']} {$row['wr_id']}-{$row['wr_id']} 댓글삭제");

            $count_comment++;
        }
    }

    // 게시글 삭제
    $sql = " delete from {$write_table} where {$sql_where} {$sql_period} ";
    sql_query($sql);
}

/**
 * 포인트 삭제
 */
$sql = " delete from {$g5['point_table']} where {$sql_where} and (po_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59')  ";
sql_query($sql, false);

/**
 * 최신글에서 삭제
 */
$sql = " delete from {$g5['board_new_table']} where {$sql_where} and (bn_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59')  ";
sql_query($sql, false);

/**
 * 최신글에서 삭제
 */
$sql = " delete from {$g5['eyoom_best']} where {$sql_where} and (bb_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59')  ";
sql_query($sql, false);

/**
 * 스크랩에서 삭제
 */
$sql = " delete from {$g5['scrap_table']} where {$sql_where} and (ms_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59')  ";
sql_query($sql, false);

/**
 * 회원 탈퇴 및 접근차단
 */
$sql = "update {$g5['member_table']} set mb_leave_date='".date('Ymd')."', mb_intercept_date='".date('Ymd')."' where {$sql_where} ";
sql_query($sql, false);

alert("정상적으로 해당 회원의 스팸글을 모두 삭제처리하였습니다.");