<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_list_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 게시판 여유필드 확장수 저장 필드 추가
 */
if(!sql_query(" select bo_ex_cnt from {$g5['board_table']} limit 1 ", false)) {
    $sql = " alter table `{$g5['board_table']}` add `bo_ex_cnt` int(5) NOT NULL default '0' after `bo_sort_field` ";
    sql_query($sql, true);
}

/**
 * 승인게시판 사용여부 필드 추가
 */
if(!sql_query(" select bo_use_approval from {$g5['board_table']} limit 1 ", false)) {
    $sql = " alter table `{$g5['board_table']}` add `bo_use_approval` tinyint(4) NOT NULL default '0' after `bo_ex_cnt` ";
    sql_query($sql, true);
}

/**
 * 게시물 새글 테이블에 아이피 필드 추가
 */
if(!sql_query(" select wr_ip from {$g5['board_new_table']} limit 1 ", false)) {
    $sql = " alter table `{$g5['board_new_table']}` add `wr_ip` varchar(255) NOT NULL after `mb_id` ";
    sql_query($sql, true);
}

$sql_common = " from {$g5['board_table']} a ";
$sql_search = " where (1) ";

if ($is_admin != "super") {
    $sql_common .= " , {$g5['group_table']} b ";
    $sql_search .= " and (a.gr_id = b.gr_id and b.gr_admin = '{$member['mb_id']}') ";
}

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "bo_table":
            $sql_search .= " ($sfl like '$stx%') ";
            break;
        case "a.gr_id":
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default:
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 그룹검색
if (isset($_REQUEST['grid'])) {
    if (!is_array($_REQUEST['grid'])) {
        $grid = filter_var($_REQUEST['grid'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_\.]+$/i")
        ));
        $grid = preg_replace('/[^a-z0-9_\.]/i', '', trim($grid));
    }
} else {
    $grid = '';
}

if ($grid) {
    $sql_search .= " and a.gr_id = '{$grid}' ";
    $qstr .= "&amp;grid={$grid}";
}

// 확장필드
$bo_ex = isset($_GET['bo_ex']) ? (int) $_GET['bo_ex']: '';
if ($bo_ex) {
    $bo_ex_val = $bo_ex-1 == 1 ? 1:'';
    $sql_search .= $bo_ex_val ? ' and a.bo_ex_cnt > 0 ': ' and a.bo_ex_cnt = 0 ';
    $qstr .= "&amp;bo_ex={$bo_ex}";
    if ($bo_ex == '1') {
        $bo_ex_no = 'checked';
    } else if ($bo_ex == '2') {
        $bo_ex_yes = 'checked';
    }
} else {
    $bo_ex_all = 'checked';
}

// 분류사용
$bo_cate = isset($_GET['bo_cate']) ? (int) $_GET['bo_cate']: '';
if ($bo_cate) {
    $bo_cate_val = $bo_cate-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_category = '{$bo_cate_val}' ";
    $qstr .= "&amp;bo_cate={$bo_cate}";
    if ($bo_cate == '1') {
        $bo_cate_no = 'checked';
    } else if ($bo_cate == '2') {
        $bo_cate_yes = 'checked';
    }
} else {
    $bo_cate_all = 'checked';
}

// 사이드 네임뷰
$bo_sideview = isset($_GET['bo_sideview']) ? (int) $_GET['bo_sideview']: '';
if ($bo_sideview) {
    $bo_sideview_val = $bo_sideview-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_sideview = '{$bo_sideview_val}' ";
    $qstr .= "&amp;bo_sideview={$bo_sideview}";
    if ($bo_sideview == '1') {
        $bo_sideview_no = 'checked';
    } else if ($bo_sideview == '2') {
        $bo_sideview_yes = 'checked';
    }
} else {
    $bo_sideview_all = 'checked';
}

// DHTML 사용
$bo_dhtml = isset($_GET['bo_dhtml']) ? (int) $_GET['bo_dhtml']: '';
if ($bo_dhtml) {
    $bo_dhtml_val = $bo_dhtml-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_dhtml_editor = '{$bo_dhtml_val}' ";
    $qstr .= "&amp;bo_dhtml={$bo_dhtml}";
    if ($bo_dhtml == '1') {
        $bo_dhtml_no = 'checked';
    } else if ($bo_dhtml == '2') {
        $bo_dhtml_yes = 'checked';
    }
} else {
    $bo_dhtml_all = 'checked';
}

// 비밀글 사용
$bo_secret = isset($_GET['bo_secret']) ? (int) $_GET['bo_secret']: '';
if ($bo_secret) {
    $bo_secret_val = $bo_secret-1;
    $sql_search .= " and a.bo_use_secret = '{$bo_secret_val}' ";
    $qstr .= "&amp;bo_secret={$bo_secret}";
    if ($bo_secret == '1') {
        $bo_secret_no = 'checked';
    } else if ($bo_secret == '2') {
        $bo_secret_chk = 'checked';
    } else if ($bo_secret == '3') {
        $bo_secret_yes = 'checked';
    }
} else {
    $bo_secret_all = 'checked';
}

// 추천사용
$bo_good = isset($_GET['bo_good']) ? (int) $_GET['bo_good']: '';
if ($bo_good) {
    $bo_good_val = $bo_good-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_good = '{$bo_good_val}' ";
    $qstr .= "&amp;bo_good={$bo_good}";
    if ($bo_good == '1') {
        $bo_good_no = 'checked';
    } else if ($bo_good == '2') {
        $bo_good_yes = 'checked';
    }
} else {
    $bo_good_all = 'checked';
}

// 비추천사용
$bo_nogood = isset($_GET['bo_nogood']) ? (int) $_GET['bo_nogood']: '';
if ($bo_nogood) {
    $bo_nogood_val = $bo_nogood-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_nogood = '{$bo_nogood_val}' ";
    $qstr .= "&amp;bo_nogood={$bo_nogood}";
    if ($bo_nogood == '1') {
        $bo_nogood_no = 'checked';
    } else if ($bo_nogood == '2') {
        $bo_nogood_yes = 'checked';
    }
} else {
    $bo_nogood_all = 'checked';
}

// 목록에서 파일 사용
$bo_file = isset($_GET['bo_file']) ? (int) $_GET['bo_file']: '';
if ($bo_file) {
    $bo_file_val = $bo_file-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_list_file = '{$bo_file_val}' ";
    $qstr .= "&amp;bo_file={$bo_file}";
    if ($bo_file == '1') {
        $bo_file_no = 'checked';
    } else if ($bo_file == '2') {
        $bo_file_yes = 'checked';
    }
} else {
    $bo_file_all = 'checked';
}

// 목록에서 내용 사용
$bo_cont = isset($_GET['bo_cont']) ? (int) $_GET['bo_cont']: '';
if ($bo_cont) {
    $bo_cont_val = $bo_cont-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_list_content = '{$bo_cont_val}' ";
    $qstr .= "&amp;bo_cont={$bo_cont}";
    if ($bo_cont == '1') {
        $bo_cont_no = 'checked';
    } else if ($bo_cont == '2') {
        $bo_cont_yes = 'checked';
    }
} else {
    $bo_cont_all = 'checked';
}

// 전체목록보이기 사용
$bo_list = isset($_GET['bo_list']) ? (int) $_GET['bo_list']: '';
if ($bo_list) {
    $bo_list_val = $bo_list-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_list_view = '{$bo_list_val}' ";
    $qstr .= "&amp;bo_list={$bo_list}";
    if ($bo_list == '1') {
        $bo_list_no = 'checked';
    } else if ($bo_list == '2') {
        $bo_list_yes = 'checked';
    }
} else {
    $bo_list_all = 'checked';
}

// SNS 사용
$bo_sns = isset($_GET['bo_sns']) ? (int) $_GET['bo_sns']: '';
if ($bo_sns) {
    $bo_sns_val = $bo_sns-1 == 1 ? 1:'';
    $sql_search .= " and a.bo_use_sns = '{$bo_sns_val}' ";
    $qstr .= "&amp;bo_sns={$bo_sns}";
    if ($bo_sns == '1') {
        $bo_sns_no = 'checked';
    } else if ($bo_sns == '2') {
        $bo_sns_yes = 'checked';
    }
} else {
    $bo_sns_all = 'checked';
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
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    /**
     * 이윰 게시판 테이블에 게시판 정보가 있는지 체크
     */
    $tmp = sql_fetch("select bo_table, bo_skin, use_gnu_skin, bo_write_limit from {$g5['eyoom_board']} where bo_table='{$row['bo_table']}' limit 1",false);
    if(! (isset($tmp) && $tmp['bo_table'])) {
        sql_query("insert into {$g5['eyoom_board']} set bo_table='{$row['bo_table']}', gr_id='{$row['gr_id']}', bo_skin='basic', use_gnu_skin='n'");
    }

    $list[$i] = $row;
    $gr_select = str_replace('"', "'", get_group_select("gr_id[$i]", $row['gr_id']));
    $list[$i]['gr_select'] = preg_replace("/\\n/", "", $gr_select);

    $skin_select = str_replace('"', "'", get_skin_select('board', 'bo_skin_'.$i, "bo_skin[$i]", $row['bo_skin']));
    $list[$i]['skin_select'] = preg_replace("/\\n/", "", $skin_select);

    $mobile_skin_select = str_replace('"', "'", get_mobile_skin_select('board', 'bo_mobile_skin_'.$i, "bo_mobile_skin[$i]", $row['bo_mobile_skin']));
    $list[$i]['mobile_skin_select'] = preg_replace("/\\n/", "", $mobile_skin_select);

    $row2 = sql_fetch("select use_gnu_skin from {$g5['eyoom_board']} where bo_table='{$row['bo_table']}' ");
    $list[$i]['use_gnu_skin'] = $row2['use_gnu_skin'];
}
$bo_cnt = count($list);

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