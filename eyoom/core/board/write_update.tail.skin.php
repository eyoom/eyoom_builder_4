<?php
/**
 * core file : /eyoom/core/board/write_update.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * SQL injection 방어
 */
if (isset($config['cf_use_protect_sqli']) && $config['cf_use_protect_sqli']) {
    // 접속제한 테이블에 해당 아이피 추가
    $sql = "insert into {$this->g5['eyoom_prohibit']} set ph_ip = '" . $_SERVER['REMOTE_ADDR'] . "', ph_flag = 'sql', ph_regdt = '" . G5_TIME_YMDHIS . "' ";
    sql_query($sql);

    // 글작성 횟수 체크 및 아이피 제한
    $time_limit = date('Y-m-d H:i:s', time() - $config['cf_sqli_time_limit']);
    $row = sql_fetch("select count(*) as cnt from {$this->g5['eyoom_prohibit']} where ph_flag = 'sql' and ph_regdt > '{$time_limit}' ");
    if ($row['cnt'] > $config['cf_sqli_max_write']) {
        $this->add_intercept_ip($config['cf_intercept_ip'], $_SERVER['REMOTE_ADDR']);
    }

    // 등록일이 오늘이전이면 레코드 삭제
    $today = date('Y-m-d');
    sql_query("delete from {$this->g5['eyoom_prohibit']} where ph_flag = 'sql' and ph_regdt < '{$today}' ");
}

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