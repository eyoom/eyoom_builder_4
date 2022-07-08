<?php
/**
 * core file : /eyoom/core/search/search.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 목록에서 썸네일 사용일 경우 썸네일 라이브러리 호출
 */
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/**
 * 그룹정보 가져오기
 */
$sel_group = $eb->get_group();

/**
 * 회원 사이드뷰 ON
 */
$board['bo_use_sideview'] = 'y';

/**
 * 익명 게시판
 */
$anonymous_table = $bbs->anonymous_table();

/**
 * 페이징
 */
$paging = $eb->set_paging('search', '', $search_query.'&amp;gr_id='.$gr_id.'&amp;srows='.$srows.'&amp;onetable='.$onetable);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/search/search.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['search'].'/search.skin.html.php');