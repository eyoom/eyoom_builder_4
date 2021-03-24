<?php
/**
 * core file : /eyoom/core/shop/itemuselist.skin.php
 */
if (!defined('_EYOOM_')) exit;

$thumbnail_width = 500;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $num = $total_count - ($page - 1) * $rows - $i;
    $star = get_star($row['is_score']);

    $is_content = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);

    $row2 = sql_fetch(" select it_name from {$g5['g5_shop_item_table']} where it_id = '{$row['it_id']}' ");

    if ( !empty($row['is_reply_subject']) ) {     //사용후기 답변이 있다면
        $list[$i]['is_reply_content'] = get_view_thumbnail(conv_content($row['is_reply_content'], 1), $thumbnail_width);
    }
    
    $list[$i] = $row;
    $list[$i]['it_href'] = shop_item_url($row['it_id']);
    $list[$i]['it_id'] = $row['it_id'];
    $list[$i]['is_content'] = $row['is_content'];
    $list[$i]['is_tcontent'] = $is_content;
    $list[$i]['is_subject'] = $row['is_subject'];
    $list[$i]['is_name'] = $row['is_name'];
    $list[$i]['is_time'] = $row['is_time'];
    $list[$i]['it_name'] = $row2['it_name'];
    $list[$i]['star'] = $star;
}
$count = count((array)$list);

/**
 * 페이징
 */
$paging = $eb->set_paging('itemuselist', '', $qstr);

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemuselist.skin.html.php');