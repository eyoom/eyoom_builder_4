<?php
/**
 * core file : /eyoom/core/best/best.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 선택삭제으로 인해 셀합치기가 가변적으로 변함
 */
$colspan = 5;

if ($is_admin) $colspan++;

$bestlist = array();
for ($i=0; $i<count((array)$list); $i++) {
    $tmp_write_table = $g5['write_prefix'].$list[$i]['bo_table'];

    $num = ($page - 1) * $rows + $i + 1;
    $bo_subject = cut_str($list[$i]['bo_subject'], 20);
    $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 80));

    unset($data);

    $data['num'] = $num;
    $data['bo_subject'] = $bo_subject;
    $data['wr_subject'] = $wr_subject;
    $data['bo_table']   = $list[$i]['bo_table'];
    $data['wr_id']      = $list[$i]['wr_id'];
    $data['wr_hit']     = $list[$i]['wr_hit'];
    $data['wr_good']    = $list[$i]['wr_good'];
    $data['href']       = $list[$i]['href'];
    $data['datetime1']  = $list[$i]['datetime1'];
    $data['datetime2']  = $list[$i]['datetime2'];

    $row = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$data['wr_id']}' ");
    $data['name'] = eb_nameview($row['mb_id'], $row['wr_name'], $row['wr_email'], $row['wr_homepage']);

    $bestlist[$i] = $data;
}
unset($list);

/**
 * 페이징
 */
$paging = $eb->set_paging('best', '', "{$qstr}");

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/best/best.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['best'].'/best.skin.html.php');