<?php
/**
 * core file : /eyoom/core/mypage/timeline.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 타임라인
 */
$bo_info = $bbs->get_bo_subject(); // 게시판 정보 가져오기
$where = '1';

switch ($eyoomer['view_timeline']) {
    case '2': $where .= " and wr_id = wr_parent "; break;
    case '3': $where .= " and wr_id <> wr_parent "; break;
}

/**
 * 제외 필드
 */
$except = array(
    'wr_num',
    'wr_reply',
    'wr_is_comment',
    'wr_comment_reply',
    'wr_link1_hit',
    'wr_link2_hit',
    'wr_password',
    'wr_homepage',
    'wr_file',
    'wr_last',
    'wr_ip',
    'wr_facebook_user',
    'wr_twitter_user',
);

$page = (int)$_GET['page'];
if (!$page) $page = 1;
if (!$page_rows) $page_rows = 20;
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

$sql = "select * from {$g5['board_new_table']} where $where and mb_id = '{$eyoomer['mb_id']}' order by bn_datetime desc limit $from_record, $page_rows";
$result = sql_query($sql, false);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    /**
     * 게시판 테이블
     */
    $write_table = $g5['write_prefix'] . $row['bo_table'];

    /**
     * 최신글 추출
     */
    $write = get_write($write_table, $row['wr_id']);

    if (is_array($write)) {
        foreach ($write as $key => $data) {
            if (in_array($key, $except)) continue;
            $_list[$key] = $data;
        }
    }
    $list[$i] = $_list;
    $list[$i]['bo_table'] = $row['bo_table'];

    /**
     * 썸네일 이미지 생성
     */
    $thumb = get_list_thumbnail($row['bo_table'], $row['wr_id'], 300, 0);
    if ($thumb['src']) {
        $list[$i]['wr_image'] = $thumb['src'];
    }

    /**
     * 내용 출력
     */
    $wr_content = $write['wr_content'];

    /**
     * 불필요한 소스 제거
     */
    $wr_content = $bbs->remove_editor_code($wr_content);
    $wr_content = $bbs->remove_editor_video($wr_content);
    $wr_content = $bbs->remove_editor_sound($wr_content);
    $wr_content = $bbs->remove_editor_emoticon($wr_content);
    $wr_content = $bbs->remove_editor_map($wr_content);

    $list[$i]['wr_content'] = cut_str(strip_tags(preg_replace("/(<br>|<br \/>)/i", "\n\r", $wr_content)), 300, '…');

    /**
     * 원글 링크 생성
     */
    if ($row['wr_id'] == $row['wr_parent']) { // 원본글
        $list[$i]['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_id'],$query_wmode);
    } else { // 댓글
        $list[$i]['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_parent'],$query_wmode.'#c_'.$row['wr_id']);
    }
    $list[$i]['datetime'] = $row['bn_datetime'];
    $list[$i]['bo_info'] = $bo_info[$row['bo_table']];
}
$timeline = count((array)$list);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/timeline.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/timeline.skin.html.php');