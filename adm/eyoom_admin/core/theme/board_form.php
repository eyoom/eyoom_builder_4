<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

if (isset($eyoom_board['bo_use_summernote_mo'])) {
    sql_query(" ALTER TABLE `{$g5['eyoom_board']}` CHANGE `bo_use_summernote_mo` `bo_goto_url` VARCHAR(255) NULL", false);
    sql_query(" UPDATE `{$g5['eyoom_board']}` SET `bo_goto_url` = '' ", false);
}

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=board_form_update&amp;smode=1';

/**
 * 이윰 게시판 테이블에 게시판 정보가 있는지 체크
 */
$tmp = sql_fetch("select bo_table, bo_skin, use_gnu_skin, bo_write_limit from {$g5['eyoom_board']} where bo_table='{$bo_table}' and bo_theme='{$this_theme}'",false);
if(!(isset($tmp) && $tmp['bo_table'])) {
    sql_query("insert into {$g5['eyoom_board']} set bo_table='{$bo_table}', gr_id='{$board['gr_id']}', bo_theme='{$this_theme}', bo_skin='basic', use_gnu_skin='n'");
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_bo_common'     => '기능설정',
    'anc_bo_blind'      => '신고/블라인드',
    'anc_bo_rating'     => '별점기능',
    'anc_bo_tag'        => '태그기능',
    'anc_bo_automove'   => '자동 이동/복사',
    'anc_bo_addon'      => '애드온기능',
    'anc_bo_cmtbest'    => '댓글베스트',
    'anc_bo_exif'       => '이미지 EXIF',
    'anc_bo_cmtpoint'   => '댓글포인트',
    'anc_bo_wrfixed'    => '게시물 상단고정'
);

/**
 * 채택 게시판 스킨용 탭메뉴
 */
if (preg_match('/adopt/i', $eyoom_board['bo_skin'])) {
    $pg_anchor['anc_bo_adopt'] = '채택기능';
}

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
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=board_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
if ($w == 'u') {
    $frm_submit .= !$wmode ? ' <a href="'.G5_BBS_URL.'/board.php?bo_table='.$board['bo_table'].'&amp;theme='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">게시판 바로가기</a> ': '';
}
$frm_submit .= '</div>';