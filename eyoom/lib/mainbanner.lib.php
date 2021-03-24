<?php
/**
 * lib file : /eyoom/lib/mainbanner.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_display_banner function
 * 쇼핑몰 메인 배너 추출
 */
function eb_display_banner($position, $skin='') {
    global $config, $g5;

    if (!$position) $position = '왼쪽';
    if (!$skin) $skin = 'boxbanner.skin.php';

    $skin_path = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR.'/'.$skin;

    if (file_exists($skin_path)) {
        // 접속기기
        $sql_device = " and ( bn_device = 'both' or bn_device = 'pc' ) ";

        // 배너 출력
        $sql = " select * from {$g5['g5_shop_banner_table']} where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time $sql_device and bn_position = '$position' order by bn_order, bn_id desc ";
        $result = sql_query($sql);
        $list = array();
        include $skin_path;
    } else {
        echo '<p>'.str_replace(G5_PATH.'/', '', $skin_path).'파일이 존재하지 않습니다.</p>';
    }
}