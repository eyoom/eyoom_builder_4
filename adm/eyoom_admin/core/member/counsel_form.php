<?php
/**
 * @file    /adm/eyoom_admin/core/member/counsel_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200150";

$action_url1 = G5_ADMIN_URL . "/?dir=member&amp;pid=counsel_form_update&amp;smode=1";

auth_check_menu($auth, $sub_menu, 'w');

include_once(G5_EDITOR_LIB);

$cs_id = (int) clean_xss_tags(trim($_REQUEST['cs_id']));
if (!$cs_id) {
    alert("제대로 된 값이 넘어오지 않았습니다.");
}

// 문의분야
$counsel_part = explode(',', $config['cf_counsel_part']);

// 상담단계
$counsel_status = explode(',', $config['cf_counsel_status']);

$sql = "select * from {$g5['eyoom_counsel']} where cs_id = '{$cs_id}' ";
$cs = sql_fetch($sql);

$is_dhtml_editor = false;
$is_dhtml_editor_use = true;
$editor_content_js = '';
if(!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)
    $is_dhtml_editor_use = true;

// 모바일에서는 G5_IS_MOBILE_DHTML_USE 설정에 따라 DHTML 에디터 적용
if ($config['cf_editor'] && $is_dhtml_editor_use) {
    $is_dhtml_editor = true;
}
$editor_html = editor_html('cs_content', $cs['cs_content'], $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('cs_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('cs_content', $is_dhtml_editor);

$cs_file1 = unserialize($cs['cs_file1']);
$cs_file2 = unserialize($cs['cs_file2']);

$qstr .= $fr_date ? '&amp;fr_date='.$fr_date: '';
$qstr .= $to_date ? '&amp;to_date='.$to_date: '';

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=member&amp;pid=counsel_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';