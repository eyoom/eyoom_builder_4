<?php
/**
 * core file : /eyoom/core/shop/itemqalist.skin.php
 */
if (!defined('_EYOOM_')) exit;

$thumbnail_width = 500;
$num = $total_count - ($page - 1) * $rows;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $iq_subject = conv_subject($row['iq_subject'],50,"…");

    $is_secret = false;
    if ($row['iq_secret']) {
        $iq_subject .= ' <i class="fa fa-lock" aria-hidden="true"></i>';

        if ($is_admin || $member['mb_id' ] == $row['mb_id']) {
            $iq_question = get_view_thumbnail(conv_content($row['iq_question'], 1), $thumbnail_width);
        } else {
            $iq_question = '비밀글로 보호된 문의입니다.';
            $is_secret = true;
        }
    } else {
        $iq_question = get_view_thumbnail(conv_content($row['iq_question'], 1), $thumbnail_width);
    }

    $it_href = shop_item_url($row['it_id']);

    if ($row['iq_answer']) {
        $iq_answer = get_view_thumbnail(conv_content($row['iq_answer'], 1), $thumbnail_width);
        $iq_stats = '답변완료';
        $iq_style = 'sit_qaa_done';
        $is_answer = true;
    } else {
        $iq_stats = '답변대기';
        $iq_style = 'sit_qaa_yet';
        $iq_answer = '답변이 등록되지 않았습니다.';
        $is_answer = false;
    }
    
	$list[$i]['it_href'] = shop_item_url($row['it_id']);
	$list[$i]['it_id'] = $row['it_id'];
	$list[$i]['it_name'] = $row['it_name'];
	$list[$i]['iq_name'] = $row['iq_name'];
	$list[$i]['iq_time'] = $row['iq_time'];
	$list[$i]['iq_subject'] = $iq_subject;
	$list[$i]['iq_style'] = $iq_style;
	$list[$i]['iq_stats'] = $iq_stats;
	$list[$i]['iq_question'] = $iq_question;
	$list[$i]['is_secret'] = $is_secret;
	$list[$i]['iq_answer'] = $iq_answer;
	$num--;
}
$count = count((array)$list);

/**
 * 페이징
 */
$paging = $eb->set_paging('itemqalist', '', $qstr);

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemqalist.skin.html.php');