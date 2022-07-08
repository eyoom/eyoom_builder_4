<?php
/**
 * lib file : /eyoom/lib/brand.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_brand function
 * 브랜드 추출
 */
function eb_brand($skin_dir = 'basic') {
    global $g5, $br_cd;

    if (!$skin_dir) $skin_dir = 'basic';

    $sql = "select * from {$g5['eyoom_brand']} where (1) and br_open='y' order by br_sort asc ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        if ($row['br_img']) {
            $row['img_url'] = G5_DATA_URL.'/brand/'.$row['br_img'];
        }

        $list[$i] = $row;
    }

    $brand_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/brand/'.$skin_dir;
    $brand_skin_url = str_replace(G5_PATH, G5_URL,$brand_skin_path);

    ob_start();
    include_once ($brand_skin_path.'/brand.skin.html.php');
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}