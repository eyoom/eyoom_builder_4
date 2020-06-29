<?php
/**
 * file : /eyoom/inc/board.init.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * bo_table 변수 정의가 없다면 리턴
 */
if (!$bo_table) return;

/**
 * SNS용 이미지/제목/내용 추가 메타태그
 */
if (isset($wr_id) && $wr_id) {
	$og_meta = $eb->sns_open_graph();
	if ($og_meta) $config['cf_add_meta'] = $og_meta;
	unset($og_meta);
}

/**
 * DB에 입력된 정보가 없다면, 기본값 가져오기
 */
if (!$eyoom_board) $eyoom_board = $bbs->board_default($bo_table);

/**
 * 이윰 게시판 최초 설정으로 이윰빌더용 확장필드 추가
 */
if ($is_admin && !$board['bo_wr_eb']) $bbs->make_eb_fields($bo_table);

/**
 * 게시판 스킨
 */
$bo_skin = $eb->get_skin_dir('board', G5_PATH.'/theme/'.$theme.'/skin/');

/**
 * 게시물 자동 이동/복사를 위한 변수
 */
(array)$bo_automove = unserialize($eyoom_board['bo_automove']);

/**
 * EXIF정보보기 사용시
 */
if ($eyoom_board['bo_use_exif'] || $is_admin == 'super') {
	/**
	 * EXIF Class Object
	 */
	include_once(EYOOM_CLASS_PATH . '/exif.class.php');
	$exif = new exif;

	$exif_item = $exif->exif_item;
}

/**
 * 익명글쓰기 체크
 */
$is_anonymous = $eyoom_board['bo_use_anonymous'] == 1 ? true:false;

/**
 * 무한스크롤 기능을 사용하면 wmode를 활성화
 */
if ($eyoom_board['bo_use_infinite_scroll'] == 1) {
	$user_agent = $eb->user_agent();
	if($user_agent != 'ios') {
		$infinite_wmode = true;
		if($wmode) define('_WMODE_',true);
	} else {
		$eyoom_board['bo_use_infinite_scroll'] = 2;
	}
}

/**
 * 관심게시판
 */
$bo_favorite = $eyoomer['favorite'] ? unserialize($eyoomer['favorite']): array();

/**
 * 확장필드 체크
 */
$bo_extend = false;
if ($board['bo_ex_cnt'] > 0 && !defined('_EYOOM_IS_ADMIN_')) {
	/**
	 * 실제 확장필드 정보
	 */
	$ex_fields = $ex_sfl = array();
	$del_exboard = '';
	$sql = "SHOW COLUMNS FROM {$write_table} LIKE 'ex_%'";
	$res = sql_query($sql);
	for($i=0; $row=sql_fetch_array($res); $i++) {
		$ex_fields[$i] = $row['Field'];
	}

    $sql = "select * from {$g5['eyoom_exboard']} where bo_table = '{$bo_table}' ";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        if (!in_array($row['ex_fname'], $ex_fields)) {
            $del_exboard[$i] = " ex_no = '{$row['ex_no']}' ";
        }
        $exbo[$row['ex_fname']] = $row;

        /**
         * 확장필드 중 검색필드로 사용하는 필드 체크
         */
        if ($row['ex_use_search'] == 'y') {
            $ex_sfl[$row['ex_fname']] = get_text($row['ex_subject']);
        }
    }
    if (is_array($del_exboard)) {
        $del_where = implode(' or ', $del_exboard);
        $sql = "delete from {$g5['eyoom_exboard']} where {$del_where}";
        sql_query($sql);
    }
	if (isset($exbo) && is_array($exbo)) {
		$bo_extend = true;
	}
}

/**
 * 댓글 이미지 저장 필드가 있는 체크
 */
if (isset($eyoom_board['bo_use_addon_cmtimg'])) {
	// 댓글 이미지 필드를 댓글 파일첨부 필드로 명칭 변경 
	$sql = "alter table `{$g5['eyoom_board']}` change `bo_use_addon_cmtimg` `bo_use_addon_cmtfile` char(1) not null default '1';";
	sql_query($sql);
}

if (!isset($eyoom_board['bo_count_cmtfile'])) {
	// 댓글 첨부파일 개수 지정 필드 추가
	$sql = "alter table `{$g5['eyoom_board']}` add `bo_count_cmtfile` smallint(2) not null default '1' after `bo_use_addon_cmtfile`;";
	sql_query($sql);
}