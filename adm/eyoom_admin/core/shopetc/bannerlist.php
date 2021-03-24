<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/bannerlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500500";

auth_check_menu($auth, $sub_menu, "r");

$bn_position = (isset($_GET['bn_position']) && in_array($_GET['bn_position'], array('메인', '왼쪽'))) ? $_GET['bn_position'] : '';
$bn_device = (isset($_GET['bn_device']) && in_array($_GET['bn_device'], array('pc', 'mobile'))) ? $_GET['bn_device'] : 'both';
$bn_time = (isset($_GET['bn_time']) && in_array($_GET['bn_time'], array('ing', 'end'))) ? $_GET['bn_time'] : '';

$where = ' where ';
$sql_search = '';

if ( $bn_position ){
    $sql_search .= " $where bn_position = '$bn_position' ";
    $where = ' and ';
    $qstr .= "&amp;bn_position=$bn_position";
}

if ( $bn_device && $bn_device !== 'both' ){
    $sql_search .= " $where bn_device = '$bn_device' ";
    $where = ' and ';
    $qstr .= "&amp;bn_device=$bn_device";
}

if ( $bn_time ){
    $sql_search .= ($bn_time === 'ing') ? " $where '".G5_TIME_YMDHIS."' between bn_begin_time and bn_end_time " : " $where bn_end_time < '".G5_TIME_YMDHIS."' ";
    $where = ' and ';
    $qstr .= "&amp;bn_time=$bn_time";
}

$sql_common = " from {$g5['g5_shop_banner_table']} ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * from {$g5['g5_shop_banner_table']} $sql_search
        order by bn_order, bn_id desc
        limit $from_record, $rows  ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 테두리 있는지
    $bn_border  = $row['bn_border'];
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? 'target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
    if(file_exists($bimg)) {
        $size = @getimagesize($bimg);
        if($size[0] && $size[0] > 800)
            $width = 800;
        else
            $width = $size[0];

        $bn_img = "";
        $bn_img .= "<img src='".G5_DATA_URL."/banner/".$row['bn_id']."?".preg_replace('/[^0-9]/i', '', $row['bn_time'])."' class='img-responsive' alt='".get_text($row['bn_alt'])."'>";
    }

    switch($row['bn_device']) {
        case 'pc':
            $bn_device = 'PC';
            break;
        case 'mobile':
            $bn_device = '모바일';
            break;
        default:
            $bn_device = 'PC와 모바일';
            break;
    }

    $bn_begin_time = substr($row['bn_begin_time'], 2, 14);
    $bn_end_time   = substr($row['bn_end_time'], 2, 14);

    $list[$i] = $row;
    $list[$i]['bn_device'] = $bn_device;
    $list[$i]['bn_begin_time'] = $bn_begin_time;
    $list[$i]['bn_end_time'] = $bn_end_time;
    $list[$i]['bn_img'] = $bn_img;
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