<?php
/**
 * core file : /eyoom/core/shop/personalpay.skin.php
 */
if (!defined('_EYOOM_')) exit;

$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$list_mod == 1) $sct_last = ' sct_last'; // 줄 마지막
        else if ($i%$list_mod == 0) $sct_last = ' sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = ' sct_clear';
    }
    
	$href = G5_SHOP_URL.'/personalpayform.php?pp_id='.$row['pp_id'].'&amp;page='.$page;
	$list[$i] = $row;
	$list[$i]['href'] = $href;
	$list[$i]['sct_last'] = $sct_last;
}
$count = count((array)$list);

/**
 * 페이징
 */
$paging = $eb->set_paging('personalpay', '', $qstr);

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/personalpay.skin.html.php');