<?php
/**
 * core file : /eyoom/core/shop/itemqa.skin.php
 */
if (!defined('_EYOOM_')) exit;

$thumbnail_width = 500;
$iq_num     = $total_count - ($page - 1) * $rows;
$item_qa = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $iq_name    = get_text($row['iq_name']);
    $iq_subject = conv_subject($row['iq_subject'],80,"…");

    $is_secret = false;
    if($row['iq_secret']) {
        $iq_subject .= ' <i class="fas fa-lock color-red"></i>';

        if($is_admin || $member['mb_id' ] == $row['mb_id']) {
            $iq_question = get_view_thumbnail(conv_content($row['iq_question'], 1), $thumbnail_width);
        } else {
            $iq_question = '비밀글로 보호된 문의입니다.';
            $is_secret = true;
        }
    } else {
        $iq_question = get_view_thumbnail(conv_content($row['iq_question'], 1), $thumbnail_width);
    }
    $iq_time    = substr($row['iq_time'], 2, 8);

    $hash = md5($row['iq_id'].$row['iq_time'].$row['iq_ip']);

    $iq_stats = '';
    $iq_style = '';
    $iq_answer = '';

    if ($row['iq_answer'])
    {
        $iq_answer = get_view_thumbnail(conv_content($row['iq_answer'], 1), $thumbnail_width);
        $iq_stats = '답변완료';
        $iq_style = 'sit_qaa_done';
        $is_answer = true;
    } else {
        $iq_stats = '답변전';
        $iq_style = 'sit_qaa_yet';
        $iq_answer = '답변이 등록되지 않았습니다.';
        $is_answer = false;
    }

    $item_qa[$i]['iq_name'] = $iq_name;
    $item_qa[$i]['iq_subject'] = $iq_subject;
    $item_qa[$i]['iq_time'] = $iq_time;
    $item_qa[$i]['iq_stats'] = $iq_stats;
    $item_qa[$i]['iq_style'] = $iq_style;
    $item_qa[$i]['iq_question'] = $iq_question;
    $item_qa[$i]['iq_answer'] = $iq_answer;
    $item_qa[$i]['is_secret'] = $is_secret;
    $item_qa[$i]['is_answer'] = $is_answer;
    $item_qa[$i]['mb_id'] = $row['mb_id'];
    $item_qa[$i]['link_edit']  = $itemqa_form."&amp;iq_id={$row['iq_id']}&amp;w=u";
    $item_qa[$i]['link_del']   = $itemqa_formupdate."&amp;iq_id={$row['iq_id']}&amp;w=d&amp;hash={$hash}";
    $item_qa[$i]['iq_num'] = $iq_num;
    $iq_num--;
}
$qa_cnt = count((array)$item_qa);

$paging_itemqa = itemqa_page($config['cf_write_pages'], $page, $total_page, "./itemqa.php?it_id=$it_id&amp;page=", "");

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/itemqa.skin.html.php');