<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemuselist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400650";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=itemuseformupdate&amp;smode=1';

include_once(G5_EDITOR_LIB);

$is_id = isset($_GET['is_id']) ? preg_replace('/[^0-9]/', '', $_GET['is_id']) : 0;

auth_check_menu($auth, $sub_menu, "w");

$sql = " select *
           from {$g5['g5_shop_item_use_table']} a
           left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
           left join {$g5['g5_shop_item_table']} c on (a.it_id = c.it_id)
          where is_id = '$is_id' ";
$is = sql_fetch($sql);

if (!$is['is_id'])
    alert('등록된 자료가 없습니다.');

// 사용후기 의 답변 필드 추가
if (!isset($is['is_reply_subject'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_item_use_table']}`
                ADD COLUMN `is_reply_subject` VARCHAR(255) NOT NULL DEFAULT '' AFTER `is_confirm`,
                ADD COLUMN `is_reply_content` TEXT NOT NULL AFTER `is_reply_subject`,
                ADD COLUMN `is_reply_name` VARCHAR(25) NOT NULL DEFAULT '' AFTER `is_reply_content`
                ", true);
}

$mb_photo = $eb->mb_photo($is['mb_id'], 'icon');
//$name = get_sideview($is['mb_id'], get_text($is['is_name']), $is['mb_email'], $is['mb_homepage']);
$board['bo_use_sideview'] = 'y';
$name = eb_nameview($is['mb_id'], get_text($is['is_name']), $is['mb_email'], $is['mb_homepage']);

// 확인
$is_confirm_yes  =  $is['is_confirm'] ? 'checked="checked"' : '';
$is_confirm_no   = !$is['is_confirm'] ? 'checked="checked"' : '';

$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca;

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=shop&pid=itemuselist&qstr=' . $qstr . '" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';