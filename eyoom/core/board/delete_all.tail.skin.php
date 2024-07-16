<?php
/**
 * core file : /eyoom/core/board/delete_all.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

for ($i=count((array)$tmp_array)-1; $i>=0; $i--) {
    if ($is_admin == 'super') // 최고관리자 통과
        ;
    else if ($is_admin == 'group') { // 그룹관리자
        $mb = get_member($write['mb_id']);
        if ($member['mb_id'] == $group['gr_admin']) // 자신이 관리하는 그룹인가?
        {
            if ($member['mb_level'] >= $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
                ;
            else
                continue;
        }
        else
            continue;
    } else if ($is_admin == 'board') { // 게시판관리자이면
        $mb = get_member($write['mb_id']);
        if ($member['mb_id'] == $board['bo_admin']) // 자신이 관리하는 게시판인가?
            if ($member['mb_level'] >= $mb['mb_level']) // 자신의 레벨이 크거나 같다면 통과
                ;
            else
                continue;
        else
            continue;
    } else if ($member['mb_id'] && $member['mb_id'] == $write['mb_id']) { // 자신의 글이라면
        ;
    } else if ($wr_password && !$write['mb_id'] && sql_password($wr_password) == $write['wr_password']) { // 비밀번호가 같다면
        ;
    } else continue;   // 나머지는 삭제 불가

    /**
     * 태그글 작성 테이블에서 해당 글 삭제
     * 태그 사용여부와 상관없이 처리 - 태그사용 후, 사용안한 게시물들의 태그글도 삭제하기 위함
     */
    sql_query(" delete from {$g5['eyoom_tag_write']} where tw_theme = '" . sql_real_escape_string($theme) . "' and bo_table = '{$bo_table}' and wr_id = '{$tmp_array[$i]}' ", false);

    // 인기게시물 삭제
    sql_query(" delete from {$g5['eyoom_best']} where bo_table = '$bo_table' and wr_id = '{$tmp_array[$i]}' ");
}

/**
 * 최신글 캐시 스위치온
 */
$latest->make_switch_on($bo_table, $theme);

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/delete_all.tail.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/delete_all.tail.skin.php');