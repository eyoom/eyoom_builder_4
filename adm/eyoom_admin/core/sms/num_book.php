<?php
/**
 * @file    /adm/eyoom_admin/core/sms/num_book.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900800";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=num_book_multi_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$token = get_token();

$g5['title'] = "휴대폰번호 관리";

if ($page < 1) $page = 1;

$bg_no = isset($_REQUEST['bg_no']) ? preg_replace('/[^0-9]/i', '', $_REQUEST['bg_no']) : '';
$st = isset($_REQUEST['st']) ? preg_replace('/[^a-z0-9]/i', '', $_REQUEST['st']) : '';

$sql_korean = $sql_group = $sql_search = $sql_no_hp = '';

if (is_numeric($bg_no) && $bg_no)
    $sql_group = " and bg_no='$bg_no' ";
else
    $sql_group = "";

if ($st == 'all') {
    $sql_search = "and (bk_name like '%{$sv}%' or bk_hp like '%{$sv}%')";
} else if ($st == 'name') {
    $sql_search = "and bk_name like '%{$sv}%'";
} else if ($st == 'hp') {
    $sql_search = "and bk_hp like '%{$sv}%'";
} else {
    $sql_search = '';
}

$ap = isset($_GET['ap']) ? (int) $_GET['ap'] : 0;
$no_hp = isset($_GET['no_hp']) ? preg_replace('/[^0-9a-z_]/i', '', $_GET['no_hp']) : 0;

if ($ap > 0)
    $sql_korean = korean_index('bk_name', $ap-1);
else {
    $sql_korean = '';
    $ap = 0;
}

if ($no_hp == 'yes') {
    set_cookie('cookie_no_hp', 'yes', 60*60*24*365);
    $no_hp_checked = 'checked';
} else if ($no_hp == 'no') {
    set_cookie('cookie_no_hp', '', 0);
    $no_hp_checked = '';
} else {
    if (get_cookie('cookie_no_hp') == 'yes')
        $no_hp_checked = 'checked';
    else
        $no_hp_checked = '';
}

if ($no_hp_checked == 'checked')
    $sql_no_hp = "and bk_hp <> ''";

$total_res = sql_fetch("select count(*) as cnt from {$g5['sms5_book_table']} where 1 $sql_group $sql_search $sql_korean $sql_no_hp");
$total_count = $total_res['cnt'];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$vnum = $total_count - (($page-1) * $page_size);

$res = sql_fetch("select count(*) as cnt from {$g5['sms5_book_table']} where bk_receipt=1 $sql_group $sql_search $sql_korean $sql_no_hp");
$receipt_count = $res['cnt'];
$reject_count = $total_count - $receipt_count;

$res = sql_fetch("select count(*) as cnt from {$g5['sms5_book_table']} where mb_id='' $sql_group $sql_search $sql_korean $sql_no_hp");
$no_member_count = $res['cnt'];
$member_count = $total_count - $no_member_count;

$no_group = sql_fetch("select * from {$g5['sms5_book_group_table']} where bg_no = 1");

$group = array();
$qry = sql_query("select * from {$g5['sms5_book_group_table']} where bg_no>1 order by bg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

$line = 0;
$qry = sql_query("select * from {$g5['sms5_book_table']} where 1 $sql_group $sql_search $sql_korean $sql_no_hp order by bk_no desc limit $page_start, $page_size");
$i=0;
$list = array();
for ($i=0; $res = sql_fetch_array($qry); $i++)
{
    $bg = 'bg'.($line++%2);

    $tmp = sql_fetch("select bg_name from {$g5['sms5_book_group_table']} where bg_no='{$res['bg_no']}'");
    $group_name = $tmp['bg_name'];
    $list[$i] = $res;
    $list[$i]['vnum'] = $vnum;
    $list[$i]['group_name'] = $group_name;
    $vnum--;
    $i++;
}
$count = is_array($list) ? count($list): 0;

/**
 * 검색버튼
 */
$frm_submit1  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit1 .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit1 .= '</div>';

$frm_submit2  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit2 .= ' <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit2 .= ' <input type="submit" name="act_button" value="수신허용" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit2 .= ' <input type="submit" name="act_button" value="수신거부" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit2 .= ' <input type="submit" name="act_button" value="선택이동" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit2 .= ' <input type="submit" name="act_button" value="선택복사" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit2 .= ' <a href="'.G5_ADMIN_URL.'/?dir=sms&amp;pid=num_book_write&amp;page='.$page.'&amp;bg_no='.$bg_no.'" class="btn-e btn-e-lg btn-e-red">번호추가</a>' ;
$frm_submit2 .= '</div>';
