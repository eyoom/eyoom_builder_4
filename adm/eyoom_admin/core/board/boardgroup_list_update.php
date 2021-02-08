<?php
/**
 * @file    /adm/eyoom_admin/core/board/boardgroup_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300200";

//print_r2($_POST); exit;

check_demo();

auth_check($auth[$sub_menu], 'w');

check_admin_token();

$post_chk = isset($_POST['chk']) ? (array) $_POST['chk'] : array();
$post_group_id = isset($_POST['group_id']) ? (array) $_POST['group_id'] : array();
$act_button = isset($_POST['act_button']) ? $_POST['act_button'] : '';

$count = count($post_chk);

if(!$count)
    alert($act_button.'할 게시판그룹을 1개이상 선택해 주세요.');

for ($i=0; $i<$count; $i++)
{
    $k     = $post_chk[$i];
    $gr_id = preg_replace('/[^a-z0-9_]/i', '', $post_group_id[$k]);

    $gr_subject = is_array($_POST['gr_subject']) ? strip_tags(clean_xss_attributes($_POST['gr_subject'][$k])) : '';
    $gr_admin = is_array($_POST['gr_admin']) ? strip_tags(clean_xss_attributes($_POST['gr_admin'][$k])) : '';

    if($act_button == '선택수정') {
        $sql = " update {$g5['group_table']}
                    set gr_subject    = '{$gr_subject}',
                        gr_device     = '".sql_real_escape_string($_POST['gr_device'][$k])."',
                        gr_admin      = '".sql_real_escape_string($_POST['gr_admin'][$k])."',
                        gr_use_access = '".sql_real_escape_string($_POST['gr_use_access'][$k])."',
                        gr_order      = '".sql_real_escape_string($_POST['gr_order'][$k])."'
                  where gr_id         = '{$gr_id}' ";
        if ($is_admin != 'super')
            $sql .= " and gr_admin    = '{$gr_admin}' ";
        sql_query($sql);
        $msg = "선택한 게시판그룹의 정보를 수정하였습니다.";

    } else if($act_button == '선택삭제') {
        $row = sql_fetch(" select count(*) as cnt from {$g5['board_table']} where gr_id = '$gr_id' ");
        if ($row['cnt'])
            alert("이 그룹에 속한 게시판이 존재하여 게시판 그룹을 삭제할 수 없습니다.\\n\\n이 그룹에 속한 게시판을 먼저 삭제하여 주십시오.", G5_ADMIN_URL . '/?dir=board&amp;pid=board_list&amp;sfl=gr_id&amp;stx='.$gr_id);

        // 그룹 삭제
        sql_query(" delete from {$g5['group_table']} where gr_id = '$gr_id' ");

        // 그룹접근 회원 삭제
        sql_query(" delete from {$g5['group_member_table']} where gr_id = '$gr_id' ");
        $msg = "선택한 게시판그룹을 삭제하였습니다.";
    }
}

run_event('admin_boardgroup_list_update', $act_button, $chk, $post_group_id, $qstr);

alert($msg, G5_ADMIN_URL . '/?dir=board&amp;pid=boardgroup_list&amp;'.$qstr);