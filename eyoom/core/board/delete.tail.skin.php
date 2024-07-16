<?php
/**
 * core file : /eyoom/core/board/delete.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 태그글 작성 테이블에서 해당 글 삭제
 * 태그 사용여부와 상관없이 처리 - 태그사용 후, 사용안한 게시물들의 태그글도 삭제하기 위함
 */
sql_query(" delete from {$g5['eyoom_tag_write']} where tw_theme = '" . sql_real_escape_string($theme) . "' and bo_table = '{$bo_table}' and wr_id = '{$write['wr_id']}' ", false);

/**
 * 상단고정 게시물 테이블에서 해당 글 삭제
 */
sql_query(" delete from {$g5['eyoom_wrfixed']} where bo_table = '{$bo_table}' and wr_id = '{$write['wr_id']}' ", false);

/**
 * 인기게시물 테이블에서 해당 글 삭제
 */
sql_query(" delete from {$g5['eyoom_best']} where bo_table = '{$bo_table}' and wr_id = '{$write['wr_id']}' ", false);

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/delete.tail.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/delete.tail.skin.php');

/**
 * 무한스크롤 모달창 닫기
 */
if ($wmode) {
    delete_cache_latest($bo_table);
    if ($wr_id) {
        echo "
        <script>window.parent.reload_board();</script>
        ";
    } else {
        echo "
        <script>window.parent.closeModal('{$write['wr_id']}');</script>
        ";
    }
    exit;
}