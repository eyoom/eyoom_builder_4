<?php
/**
 * @file    /adm/eyoom_admin/core/board/tag_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300710";

auth_check_menu($auth, $sub_menu, 'r');

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=tag_list';
$action_url2 = G5_ADMIN_URL . '/?dir=board&amp;pid=tag_list_update&amp;smode=1';

/**
 * 태그 테이블에서 태그 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_tag']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'tg_word'  :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (isset($_REQUEST['tg_dpmenu']))  {
    $tg_dpmenu = preg_match("/^(y|n)$/i", $tg_dpmenu) ? $tg_dpmenu : '';
    if ($tg_dpmenu) {
        $sql_search .= $tg_dpmenu == 'y' ? " and tg_dpmenu = 'y'" : '';
        $sql_search .= $tg_dpmenu == 'n' ? " and tg_dpmenu = 'n'" : '';
    
        $tg_dpmenu_yes = $tg_dpmenu == 'y' ? 'checked' : '';
        $tg_dpmenu_no = $tg_dpmenu == 'n' ? 'checked' : '';
    
        $qstr .= "&amp;tg_dpmenu={$tg_dpmenu}";
    } else {
        $tg_dpmenu_all = 'checked';
    }
} else {
    $tg_dpmenu_all = 'checked';
}

if (!$sst) {
    $sst = "tg_regdt";
    $sod = "desc";
    $sdt = "";
} else if($sst != 'tg_regdt') {
    $sdt = ", tg_regdt {$sod}";
}

$sql_order = " order by {$sst} {$sod} {$sdt}";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order}";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
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