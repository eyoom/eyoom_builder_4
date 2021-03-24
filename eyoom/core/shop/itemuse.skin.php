<?php
/**
 * core file : /eyoom/core/shop/itemuse.skin.php
 */
if (!defined('_EYOOM_')) exit;

$thumbnail_width = 500;
$item_use = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $hash = md5($row['is_id'].$row['is_time'].$row['is_ip']);

    $item_use[$i]['mb_id']      = $row['mb_id'];
    $item_use[$i]['is_num']     = $total_count - ($page - 1) * $rows - $i;
    $item_use[$i]['is_star']    = get_star($row['is_score']);
    $item_use[$i]['is_name']    = get_text($row['is_name']);
    $item_use[$i]['is_subject'] = conv_subject($row['is_subject'],80,"…");
    $item_use[$i]['is_content'] = get_view_thumbnail(conv_content($row['is_content'], 1), $thumbnail_width);
    $item_use[$i]['is_time']    = substr($row['is_time'], 2, 8);
    $item_use[$i]['is_href']    = './itemuselist.php?bo_table=itemuse&amp;wr_id='.$row['wr_id'];
    $item_use[$i]['is_reply_name'] = !empty($row['is_reply_name']) ? get_text($row['is_reply_name']) : '';
    $item_use[$i]['is_reply_subject'] = !empty($row['is_reply_subject']) ? conv_subject($row['is_reply_subject'],80,"…") : '';
    $item_use[$i]['is_reply_content'] = !empty($row['is_reply_content']) ? get_view_thumbnail(conv_content($row['is_reply_content'], 1), $thumbnail_width) : '';
    $item_use[$i]['link_edit']  = $itemuse_form."&amp;is_id={$row['is_id']}&amp;w=u";
    $item_use[$i]['link_del']   = $itemuse_formupdate."&amp;is_id={$row['is_id']}&amp;w=d&amp;hash={$hash}";
    $item_use[$i]['is_thumb'] = get_itemuselist_thumbnail($it_id, $item_use[$i]['is_content'], 160, 160);
}
$use_cnt = count((array)$item_use);

$paging_itemuse = itemuse_page($config['cf_write_pages'], $page, $total_page, "./itemuse.php?it_id=$it_id&amp;page=", "");

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemuse.skin.html.php');