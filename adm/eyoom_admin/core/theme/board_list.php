<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=board_list_update&amp;smode=1';

/**
 * eyoom_board 테이블 - 익명필드 기본값 변경
 */
$sql = "alter table {$g5['eyoom_board']} change `bo_use_anonymous` `bo_use_anonymous` char(1) null default '0' ";
sql_query($sql);

/**
 * 게시판 정보 가져오기
 */
$sql_common = " from {$g5['board_table']} as a left join {$g5['group_table']} as b on a.gr_id = b.gr_id ";
$sql_search = " where (1) ";
$sql_order = " order by a.gr_id, a.bo_table asc ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table" :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "a.gr_id, a.bo_table";
    $sod = "asc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$bo_table = array();

/**
 * 해당 게시판의 스킨정보
 */
$arr = get_skin_dir('board',G5_PATH.'/theme/'.$this_theme.'/skin');
$list = array();
for($i=0; $bbs=sql_fetch_array($result); $i++) {

    /**
     * 이윰 게시판 테이블에 게시판 정보가 있는지 체크
     */
    $tmp = sql_fetch("select bo_table, bo_skin, use_gnu_skin, bo_write_limit from {$g5['eyoom_board']} where bo_table='{$bbs['bo_table']}' and bo_theme='{$this_theme}'",false);
    if(! (isset($tmp) && $tmp['bo_table'])) {
        sql_query("insert into {$g5['eyoom_board']} set bo_table='{$bbs['bo_table']}', gr_id='{$bbs['gr_id']}', bo_theme='{$this_theme}', bo_skin='basic', use_gnu_skin='n'");
    }

    $list[$i]['bo_table'] = $bo_table[$i] = $bbs['bo_table'];
    $list[$i]['gr_subject'] = $bbs['gr_subject'];
    $list[$i]['bo_subject'] = $bbs['bo_subject'];
    $list[$i]['bo_skin'] = $tmp['bo_skin'] ? $tmp['bo_skin']:'basic';
    $list[$i]['use_gnu_skin'] = $tmp['use_gnu_skin'] ? $tmp['use_gnu_skin']:'n';
    $list[$i]['bo_write_limit'] = $tmp['bo_write_limit'];

    if(is_array($arr) && $arr) {
        $bo_skin_select = "<select name='bo_skin[$i]' id='bo_skin_{$i}' required>";
        for ($j=0; $j<count($arr); $j++) {
            if ($j == 0) $bo_skin_select .= "<option value=''>선택</option>";
            $skin_selected = str_replace('"', "'", get_selected($list[$i]['bo_skin'], $arr[$j]));
            $bo_skin_select .= "<option value='{$arr[$j]}'" . $skin_selected . ">".$arr[$j]."</option>";
        }
        $bo_skin_select .= '</select>';
    } else {
        $bo_skin_select = "없음";
    }
    $list[$i]['bo_skin_select'] = $bo_skin_select;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';