<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemqalist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400660";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=itemqaformupdate&amp;smode=1';

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, "w");

$iq_id = isset($_REQUEST['iq_id']) ? preg_replace('/[^0-9]/', '', $_REQUEST['iq_id']) : 0;

$sql = " select *
           from {$g5['g5_shop_item_qa_table']} a
           left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
          where iq_id = '$iq_id' ";
$iq = sql_fetch($sql);
if (! (isset($iq['iq_id']) && $iq['iq_id'])) alert('등록된 자료가 없습니다.');

$mb_photo = $eb->mb_photo($iq['mb_id'], 'icon');
//$name = get_sideview($iq['mb_id'], get_text($iq['iq_name']), $iq['mb_email'], $iq['mb_homepage']);
$board['bo_use_sideview'] = 'y';
$name = eb_nameview($iq['mb_id'], get_text($iq['iq_name']), $iq['mb_email'], $iq['mb_homepage']);

$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca;

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=itemqalist&qstr=' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';