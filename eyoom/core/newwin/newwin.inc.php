<?php
/**
 * core file : /eyoom/core/newwin/newwin.inc.php
 */
if (!defined('_EYOOM_')) exit;

if (!defined('_SHOP_')) {
    $pop_division = 'comm';
} else {
    $pop_division = 'shop';
}

if (G5_IS_MOBILE) {
    $pop_device = 'mobile';
} else {
    $pop_device = 'pc';
}

$sql = " select * from {$g5['new_win_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', '".$pop_device."' ) and nw_division IN ( 'both', '".$pop_division."' )
          order by nw_id asc ";
$result = sql_query($sql, false);

$newwin = array();

for ($i=0; $nw=sql_fetch_array($result); $i++) {
    // 이미 체크 되었다면 Continue
    if (isset($_COOKIE["hd_pops_{$nw['nw_id']}"]) && $_COOKIE["hd_pops_{$nw['nw_id']}"])
        continue;

    // 이윰빌더 팝업스킨의 경우 체크되었다면 모든 팝업 쿠키적용
    if (isset($_COOKIE['hd_pops_list']) && $_COOKIE['hd_pops_list']) break;

    $newwin[$i] = $nw;
}

if (is_array($newwin) && count((array)$newwin) > 0) {
    /**
     * 스킨파일 출력
     */
    ob_start();
    
    /**
     * 사용자 프로그램
     */
    @include_once(EYOOM_USER_PATH.'/newwin/newwin.inc.php');
    
    /**
     * 팝업스킨
     */
    include_once($eyoom_skin_path['newwin'].'/newwin.inc.html.php');
    
    /**
     * 스킨파일 출력
     */
    $newwin_contents = ob_get_contents();
    ob_end_clean();
}