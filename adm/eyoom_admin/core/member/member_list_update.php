<?php
/**
 * @file    /adm/eyoom_admin/core/member/member_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200100";

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check($auth[$sub_menu], 'w');

check_admin_token();

if ($_POST['act_button'] == "선택수정") {

    $rm = 0;
    $rc = 0;

    $leave_mb_id    = array();
    $recover_mb_id  = array();

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        // 대상 회원아이디
        $mb_id = $_POST['mb_id'][$k];

        $mb = get_member($mb_id);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
        } else {

            // 대상 그누레벨
            $mb_level = $_POST['mb_level'][$k] * 1;

            // 이전 그누레벨
            $mb_prev_level = $_POST['mb_prev_level'][$k] * 1;

            // 현재 이윰 레벨
            $level = $_POST['level'][$k] * 1;

            // 현재 이윰 레벨 경험치
            $level_point = $_POST['level_point'][$k] * 1;

            /**
             * 대상 그누레벨이 1이라면 회원탈퇴 처리
             */
            if ($mb_level == 1) {
                $leave_mb_id[$rm] = $mb_id;
                $rm++;
            } else if ($mb_level > 1) {
                /**
                 * 탈퇴된 계정을 정상 계정으로 부활
                 */
                if ($mb_prev_level == 1) {
                    $recover_mb_id[$rc] = $mb_id;
                    $rc++;
                }

                /**
                 * 이전 그누레벨과 대상 그누레벨의 차이
                 */
                $level_min_point['set_level'] = $eb->get_level_point_from_gnulevel($mb_level);
                $level_min_point['old_level'] = $eb->get_level_point_from_gnulevel($mb_prev_level);

                $eyoom_point = $level_point + ($level_min_point['set_level'] - $level_min_point['old_level']);
                $eyoom_level = $eb->get_eyoomlevel_from_point($eyoom_point);

                // 이윰 멤버 테이블에 적용
                $sql = "update {$g5['eyoom_member']} set level = '{$eyoom_level}', level_point = '{$eyoom_point}' where mb_id = '{$mb_id}' ";
                sql_query($sql);

                // 그누레벨 적용
                $sql = "update {$g5['member_table']} set mb_level = '{$mb_level}' where mb_id = '{$mb_id}' ";
                sql_query($sql);
            }

            // 해당 회원 자동 탈퇴처리
            if ($rm) {
                $sql = "update {$g5['member_table']} set mb_leave_date = '" . G5_TIME_YMDHIS ."' where find_in_set(mb_id, '".implode(',', $leave_mb_id)."') ";
                sql_query($sql);
            }

            // 해당 회원 자동 부활
            if ($rc) {
                $sql = "update {$g5['member_table']} set mb_leave_date = '' where find_in_set(mb_id, '".implode(',', $recover_mb_id)."') ";
                sql_query($sql);
            }

            if($_POST['mb_certify'][$k])
                $mb_adult = (int) $_POST['mb_adult'][$k];
            else
                $mb_adult = 0;

            $sql = " update {$g5['member_table']}
                        set mb_level = '".sql_real_escape_string($_POST['mb_level'][$k])."',
                            mb_intercept_date = '".sql_real_escape_string($_POST['mb_intercept_date'][$k])."',
                            mb_mailling = '".sql_real_escape_string($_POST['mb_mailling'][$k])."',
                            mb_sms = '".sql_real_escape_string($_POST['mb_sms'][$k])."',
                            mb_open = '".sql_real_escape_string($_POST['mb_open'][$k])."',
                            mb_certify = '".sql_real_escape_string($_POST['mb_certify'][$k])."',
                            mb_adult = '{$mb_adult}'
                        where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' ";
            sql_query($sql);
        }
    }
    $message = "선택한 회원 정보를 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $mb = get_member($_POST['mb_id'][$k]);

        if (!$mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
        } else if ($member['mb_id'] == $mb['mb_id']) {
            $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
        } else if (is_admin($mb['mb_id']) == 'super') {
            $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
        } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
            $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
        } else {
            // 회원자료 삭제
            member_delete($mb['mb_id']);
        }
    }
    $message = "선택한 회원를 삭제처리하였습니다.";
}

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);

alert($message, G5_ADMIN_URL . '/?dir=member&amp;pid=member_list&amp;'.$qstr);