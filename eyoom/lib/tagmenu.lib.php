<?php
/**
 * lib file : /eyoom/lib/tagmenu.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 태그메뉴 출력
 */
function eb_tagmenu($skin_dir='basic') {
    global $eyoom, $member, $g5, $theme, $shop_theme, $is_admin;

    /**
     * 숨기기 처리
     */
    if ($eyoom['use_tag_skin'] == 'n' || $member['mb_level'] < $eyoom['view_level_tag']) return;

    if (!$skin_dir) $skin_dir = 'basic';

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    $limit = $eyoom['tag_dpmenu_count'];
    if (!$limit) $limit = 20;

    $sort = $eyoom['tag_dpmenu_sort'];
    if (!$sort) $sort = 'regdt';

    switch($sort) {
        case 'regdt'    : $sql_order = 'tg_regdt desc'; break;
        case 'score'    : $sql_order = 'tg_score desc'; break;
        case 'regcnt'   : $sql_order = 'tg_regcnt desc'; break;
        case 'scnt'     : $sql_order = 'tg_scnt desc'; break;
        case 'random'   : $sql_order = 'rand()'; break;
    }

    $sql = " select * from {$g5['eyoom_tag']} where (1) and tg_theme = '" . sql_real_escape_string($theme) . "' and tg_dpmenu = 'y' order by {$sql_order} limit {$limit} ";
    $result = sql_query($sql);
    $list = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $list[$i] = $row;
        $list[$i]['tag'] = get_text($list[$i]['tg_word']);
        $list[$i]['href'] = G5_URL . '/tag/?tag=' . str_replace('&', '^', $list[$i]['tg_word']);
    }
    $cnt = count((array)$list);

    $tagmenu_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/tagmenu/'.$skin_dir;
    $tagmenu_skin_url = str_replace(G5_PATH, G5_URL, $tagmenu_skin_path);

    ob_start();
    include_once ($tagmenu_skin_path.'/tagmenu.skin.html.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}