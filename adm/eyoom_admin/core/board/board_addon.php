<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_addon.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

if (!$board) alert("잘못된 접근입니다.");

if ($eyoom_board['use_gnu_skin'] == 'y') {
    alert("게시판 확장기능은 그누보드스킨에서는 사용하실 수 없습니다.");
}

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_addon_update&amp;smode=1';

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_bo_blind'      => '신고',
    'anc_bo_rating'     => '별점',
    'anc_bo_tag'        => '태그',
    'anc_bo_automove'   => '자동이동',
    'anc_bo_best'       => '인기게시물',
    'anc_bo_wrfixed'    => '상단고정',
    'anc_bo_pointpost'  => '포인트게시글',
    'anc_bo_cmtpoint'   => '댓글포인트',
    'anc_bo_cmtbest'    => '댓글베스트',
    'anc_bo_addon'      => '애드온',
    'anc_bo_exif'       => 'EXIF',
    'anc_bo_adopt'      => '채택',
    'anc_bo_scheduled'  => '예약게시판',
);

/**
 * 이윰 게시판 스킨
 */
$bo_skin = get_skin_dir('board',G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * 태그 작성 레벨은 글쓰기 권한의 레벨과 같거나 높아야 함
 */
if(!isset($eyoom_board['bo_tag_level']) || $eyoom_board['bo_tag_level'] < $board['bo_write_level']) $eyoom_board['bo_tag_level'] = $board['bo_write_level'];

/**
 * EXIF 상세설정값
 */
if(!$eyoom_board['bo_exif_detail']) {
    $exif_detail = $exif->get_exif_default();
} else {
    $exif_detail = $eb->mb_unserialize(stripslashes($eyoom_board['bo_exif_detail']));
}

$i=0;
foreach($exif_item as $key => $val) {
    $exif_data[$i]['key']       = $key;
    $exif_data[$i]['entity']    = $val;
    $exif_data[$i]['item']      = $exif_detail[$key]['item'];
    $exif_data[$i]['use']       = $exif_detail[$key]['use'];
    $i++;
}

/**
 * 예약게시판 대상게시판 추출용
 */
$sql = " select bo_table, bo_subject from {$g5['board_table']} where (1) order by bo_table asc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $bo_tables[$i] = $row['bo_table'];
    $bo_subject[$i] = $row['bo_subject'];
}

/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="확인" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
if ($bo_table && !$wmode) {
    $frm_submit .= ' <a href="'.get_eyoom_pretty_url($board['bo_table']).'" class="btn-e btn-e-lg btn-e-dark" target="_blank">게시판 바로가기</a>';
}
if (!$wmode) {
    $frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=board&amp;pid=board_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
}
$frm_submit .= '</div>';
