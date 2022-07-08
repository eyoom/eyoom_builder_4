<?php
/**
 * @file    /adm/eyoom_admin/core/member/point_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200200";

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$mb_id = isset($_POST['mb_id']) ? strip_tags(clean_xss_attributes($_POST['mb_id'])) : '';
$po_point = isset($_POST['po_point']) ? strip_tags(clean_xss_attributes($_POST['po_point'])) : 0;
$po_content = isset($_POST['po_content']) ? strip_tags(clean_xss_attributes($_POST['po_content'])) : '';
$expire = isset($_POST['po_expire_term']) ? preg_replace('/[^0-9]/', '', $_POST['po_expire_term']) : '';

$mb = get_member($mb_id);

if (!$mb['mb_id']) {
    alert('존재하는 회원아이디가 아닙니다.', G5_ADMIN_URL.'/?dir=member&amp;pid=point_list&amp;'.$qstr);
}

if (($po_point < 0) && ($po_point * (-1) > $mb['mb_point'])) {
    alert('포인트를 깎는 경우 현재 포인트보다 작으면 안됩니다.', G5_ADMIN_URL.'/?dir=member&amp;pid=point_list&amp;'.$qstr);
}

insert_point($mb_id, $po_point, $po_content, '@passive', $mb_id, $member['mb_id'] . '-' . uniqid(''), $expire);

alert("포인트 내역을 적용하였습니다.", G5_ADMIN_URL . '/?dir=member&amp;pid=point_list&amp;'.$qstr);