<?php
/**
 * core file : /eyoom/core/new/new.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 선택삭제으로 인해 셀합치기가 가변적으로 변함
 */
$colspan = 5;

if ($is_admin) $colspan++;

/**
 * 그룹정보 가져오기
 */
$sel_group = $eb->get_group();
$newlist = array();
for ($i=0; $i<count((array)$list); $i++) {
    $tmp_write_table = $g5['write_prefix'].$list[$i]['bo_table'];

    $num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;
    $gr_subject = cut_str($list[$i]['gr_subject'], 20);
    $bo_subject = cut_str($list[$i]['bo_subject'], 20);
    $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 80));

    unset($data);

    $data['num'] = $num;
    $data['gr_subject'] = $gr_subject;
    $data['bo_subject'] = $bo_subject;
    $data['wr_subject'] = $wr_subject;
    $data['bo_table']   = $list[$i]['bo_table'];
    $data['wr_id']      = $list[$i]['wr_id'];
    $data['gr_id']      = $list[$i]['gr_id'];
    $data['comment']    = $list[$i]['comment'];
    $data['href']       = $list[$i]['href'];
    $data['datetime2']  = $list[$i]['datetime2'];

    /**
     * 익명글 예외처리 - 댓글은 별도로 최신글에서 추출
     */
    if ($list[$i]['wr_id'] != $list[$i]['wr_parent']) {
        $row2 = sql_fetch(" select wr_anonymous, wr_bo_anonymous from {$g5['board_new_table']} where wr_id = '{$list[$i]['wr_id']}' and wr_parent = '{$list[$i]['wr_parent']}' ");
        $list[$i]['wr_anonymous'] = $row2['wr_anonymous'];
        $list[$i]['wr_bo_anonymous'] = $row2['wr_bo_anonymous'];
    }

    /**
     * 익명글 작성자
     */
    if ($list[$i]['wr_anonymous'] === '1' || $list[$i]['wr_bo_anonymous'] === '1') {
        $data['name'] = $eyoom['anonymous_title'];
    } else {
        $row = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$data['wr_id']}' ");
        $data['name'] = eb_nameview($row['mb_id'], $row['wr_name'], $row['wr_email'], $row['wr_homepage']);
    }

    $newlist[$i] = $data;
}
unset($list);

/**
 * 페이징
 */
$paging = $eb->set_paging('new', '', "&amp;gr_id={$gr_id}&amp;view={$view}&amp;mb_id={$mb_id}");

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/new/new.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['new'].'/new.skin.html.php');