<?php
/**
 * lib file : /eyoom/lib/popular.lib.php
 */
if (!defined('_EYOOM_')) exit;

// 인기검색어 출력
// $skin_dir : 스킨 디렉토리
// $pop_cnt : 검색어 몇개
// $date_cnt : 몇일 동안
function eb_popular($skin_dir='basic', $pop_cnt=7, $date_cnt=3) {
    global $config, $g5, $eyoom, $member, $theme, $shop_theme, $is_admin;

    /**
     * 숨기기 처리
     */
    if ($eyoom['use_popular_skin'] == 'n' || $member['mb_level'] < $eyoom['view_level_popular']) return;

    if (!$skin_dir) $skin_dir = 'basic';

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    $date_gap = date('Y-m-d', G5_SERVER_TIME - ($date_cnt * 86400));
    $sql = " select pp_word, count(*) as cnt from {$g5['popular_table']} where pp_date between '$date_gap' and '".G5_TIME_YMD."' group by pp_word order by cnt desc, pp_word limit 0, $pop_cnt ";
    $result = sql_query($sql);
    $popular = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $popular[$i] = $row;
    }

    $popular_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/popular/'.$skin_dir;
    $popular_skin_url = str_replace(G5_PATH, G5_URL,$popular_skin_path);

    ob_start();
    include_once ($popular_skin_path.'/popular.skin.html.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}