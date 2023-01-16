<?php
/**
 * core file : /eyoom/core/shop/itemuse.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 쇼핑몰 코어 스킨경로
 */
if (!$skin_dir) {
    $skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;
}

/**
 * 고객선호도 별점수
 */
if (!isset($star_score)) {
    $star_score = get_star_image($it_id);
}

if( !isset($it) && !get_session("ss_tv_idx") ){
    if( !headers_sent() ){  //헤더를 보내기 전이면 검색엔진에서 제외합니다.
        echo '<meta name="robots" content="noindex, nofollow">';
    }
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
if (!function_exists('itemuse_page'))
{
    function itemuse_page($write_pages, $cur_page, $total_page, $url, $add="")
    {
        //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
        $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

        $str = '';
        if ($cur_page > 1) {
            $str .= '<a href="'.$url.'1'.$add.'" class="pg_page pg_start">처음</a>'.PHP_EOL;
        }

        $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
        $end_page = $start_page + $write_pages - 1;

        if ($end_page >= $total_page) $end_page = $total_page;

        if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="pg_page pg_prev">이전</a>'.PHP_EOL;

        if ($total_page > 1) {
            for ($k=$start_page;$k<=$end_page;$k++) {
                if ($cur_page != $k)
                    $str .= '<a href="'.$url.$k.$add.'" class="pg_page">'.$k.'</a><span class="sound_only">페이지</span>'.PHP_EOL;
                else
                    $str .= '<span class="sound_only">열린</span><strong class="pg_current">'.$k.'</strong><span class="sound_only">페이지</span>'.PHP_EOL;
            }
        }

        if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="pg_page pg_next">다음</a>'.PHP_EOL;

        if ($cur_page < $total_page) {
            $str .= '<a href="'.$url.$total_page.$add.'" class="pg_page pg_end">맨끝</a>'.PHP_EOL;
        }

        if ($str)
            return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
        else
            return "";
    }
}

$itemuse_list = G5_SHOP_URL."/itemuselist.php";
$itemuse_form = G5_SHOP_URL."/itemuseform.php?it_id=".$it_id;
$itemuse_formupdate = G5_SHOP_URL."/itemuseformupdate.php?it_id=".$it_id;

$sql_common = " from `{$g5['g5_shop_item_use_table']}` where it_id = '" . sql_real_escape_string($it_id) . "' and is_confirm = '1' ";

/**
 * 테이블의 전체 레코드수만 얻음
 */
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 레코드 구함

$sql = "select * $sql_common order by is_id desc limit $from_record, $rows ";
$result = sql_query($sql);

/**
 * 사용후기 스킨정보
 */
$itemuse_skin = $skin_dir.'/itemuse.skin.php';
if(!is_file($itemuse_skin)) {
    $itemuse_skin = G5_SHOP_SKIN_PATH.'/itemuse.skin.php';
}

include_once($itemuse_skin);