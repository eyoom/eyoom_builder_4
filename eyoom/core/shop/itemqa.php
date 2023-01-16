<?php
/**
 * core file : /eyoom/core/shop/itemqa.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 쇼핑몰 코어 스킨경로
 */
if (!$skin_dir) {
    $skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;
}

if( !isset($it) && !get_session("ss_tv_idx") ){
    if( !headers_sent() ){  //헤더를 보내기 전이면 검색엔진에서 제외합니다.
        echo '<meta name="robots" content="noindex, nofollow">';
    }
    /*
    if( !G5_IS_MOBILE ){    //PC 에서는 검색엔진 화면에 노출하지 않도록 수정
        return;
    }
    */
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 현재페이지, 총페이지수, 한페이지에 보여줄 행, URL
if (!function_exists('itemqa_page'))
{
    function itemqa_page($write_pages, $cur_page, $total_page, $url, $add="")
    {
        //$url = preg_replace('#&amp;page=[0-9]*(&amp;page=)$#', '$1', $url);
        $url = preg_replace('#&amp;page=[0-9]*#', '', $url) . '&amp;page=';

        $str = '';
        if ($cur_page > 1) {
            $str .= '<a href="'.$url.'1'.$add.'" class="qa_page qa_start">처음</a>'.PHP_EOL;
        }

        $start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
        $end_page = $start_page + $write_pages - 1;

        if ($end_page >= $total_page) $end_page = $total_page;

        if ($start_page > 1) $str .= '<a href="'.$url.($start_page-1).$add.'" class="qa_page pg_prev">이전</a>'.PHP_EOL;

        if ($total_page > 1) {
            for ($k=$start_page;$k<=$end_page;$k++) {
                if ($cur_page != $k)
                    $str .= '<a href="'.$url.$k.$add.'" class="qa_page">'.$k.'</a><span class="sound_only">페이지</span>'.PHP_EOL;
                else
                    $str .= '<span class="sound_only">열린</span><strong class="pg_current">'.$k.'</strong><span class="sound_only">페이지</span>'.PHP_EOL;
            }
        }

        if ($total_page > $end_page) $str .= '<a href="'.$url.($end_page+1).$add.'" class="qa_page pg_next">다음</a>'.PHP_EOL;

        if ($cur_page < $total_page) {
            $str .= '<a href="'.$url.$total_page.$add.'" class="qa_page pg_end">맨끝</a>'.PHP_EOL;
        }

        if ($str)
            return "<nav class=\"pg_wrap\"><span class=\"pg\">{$str}</span></nav>";
        else
            return "";
    }
}

$itemqa_list = G5_SHOP_URL."/itemqalist.php";
$itemqa_form = G5_SHOP_URL."/itemqaform.php?it_id=".$it_id;
$itemqa_formupdate = G5_SHOP_URL."/itemqaformupdate.php?it_id=".$it_id;

$sql_common = " from `{$g5['g5_shop_item_qa_table']}` where it_id = '" . sql_real_escape_string($it_id) . "' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select COUNT(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 5;
$total_page  = ceil($total_count / $rows); // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 레코드 구함

$sql = "select * $sql_common order by iq_id desc limit $from_record, $rows ";
$result = sql_query($sql);

/**
 * 상품문의 스킨정보
 */
$itemqa_skin = $skin_dir.'/itemqa.skin.php';
if(!is_file($itemqa_skin)) {
    $itemqa_skin = G5_SHOP_SKIN_PATH.'/itemqa.skin.php';
}

include_once($itemqa_skin);