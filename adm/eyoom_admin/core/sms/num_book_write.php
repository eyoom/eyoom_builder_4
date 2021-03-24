<?php
/**
 * @file    /adm/eyoom_admin/core/sms/num_book_write.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900800";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=num_book_update&amp;smode=1';

$colspan = 4;
$bk_no = isset($_REQUEST['bk_no']) ? (int) $_REQUEST['bk_no'] : 0;
$bg_no = isset($_REQUEST['bg_no']) ? (int) $_REQUEST['bg_no'] : 0;
$ap = isset($_REQUEST['ap']) ? clean_xss_tags($_REQUEST['ap'], 1, 1) : '';

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "휴대폰번호 ";

$exist_hplist = array();

if ($w == 'u' && is_numeric($bk_no)) {
    $write = sql_fetch("select * from {$g5['sms5_book_table']} where bk_no='$bk_no'");
    if (!$write)
        alert('데이터가 없습니다.');

    if ($write['mb_id']) {
        $res = sql_fetch("select mb_id from {$g5['member_table']} where mb_id='{$write['mb_id']}'");
        $write['mb_id'] = $res['mb_id'];
        $sql = "select mb_id from {$g5['member_table']} where mb_hp = '{$write['bk_hp']}' and mb_id <> '{$write['mb_id']}' and mb_hp <> '' ";
        $result = sql_query($sql);
        while($tmp = sql_fetch_array($result)){
            $exist_hplist[] = $tmp;
        }
        $exist_msg_1 = '(수정시 회원정보에 반영되지 않습니다.)';
        $exist_msg_2 = '(수정시 회원정보에 반영됩니다.)';
        $exist_msg = count($exist_hplist) ? $exist_msg_1 : $exist_msg_2;
    }
    $g5['title'] .= '수정';
}
else  {
    $write = array('bg_no' => (int) $bg_no);
    $g5['title'] .= '추가';
}

if (!is_numeric($write['bk_receipt']))
    $write['bk_receipt'] = 1;

$no_group = sql_fetch("select * from {$g5['sms5_book_group_table']} where bg_no = 1");

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= ' <a href="'.G5_ADMIN_URL.'/?dir=sms&amp;pid=num_book&amp;w=u&amp;bk_no='.$write['bk_no'].'" class="btn-e btn-e-lg btn-e-red">목록</a>' ;
$frm_submit .= '</div>';