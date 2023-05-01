<?php
/**
 * core file : /eyoom/core/board/write_update.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 한줄 게시판이라면 목록으로 이동
 */
if (isset($_POST['bbs_no_view']) && $_POST['bbs_no_view'] == '1') {
    delete_cache_latest($bo_table);
    
    if ($file_upload_msg)
        alert($file_upload_msg, get_eyoom_pretty_url($bo_table,'',$qstr));
    else
        goto_url(get_eyoom_pretty_url($bo_table,'',$qstr));
}

/**
 * 리턴 URL이 입력되어 있다면
 */
if (isset($eyoom_board['bo_goto_url']) && $eyoom_board['bo_goto_url'] != '1' && $eyoom_board['bo_goto_url']) {
    $goto_url = substr($eyoom_board['bo_goto_url'],0,1000);
    $goto_url = trim(strip_tags($goto_url));
    $goto_url = preg_replace("#[\\\]+$#", "", $goto_url);
    
    if ($goto_url) {
        goto_url($goto_url);
    }
}

/**
 * 리스트 화면으로 리턴
 */
if ($_POST['golist'] == '1') {
    echo "
        <script>parent.document.location.href = '".get_eyoom_pretty_url($bo_table)."'</script>
    ";
    exit;
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/write_update.tail.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_update.tail.skin.php');