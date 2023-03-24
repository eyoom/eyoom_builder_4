<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit.sub.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

//include_once(G5_LIB_PATH.'/visit.lib.php');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = G5_TIME_YMD;
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$qstr = "&amp;fr_date=".$fr_date."&amp;to_date=".$to_date;
$query_string = $qstr;

$pg_mode = array(
    'visit_list'    => '접속자',
    'visit_domain'  => '도메인',
    'visit_browser' => '브라우저',
    'visit_os'      => '운영체제',
    'visit_device'  => '접속기기',
    'visit_hour'    => '시간',
    'visit_week'    => '요일',
    'visit_date'    => '일',
    'visit_month'   => '월',
    'visit_year'    => '년',
    //'visit_graph'   => '그래프보기'
);

$visit_link = array();
foreach ($pg_mode as $vmode => $str) {
    $visit_link[$vmode] = G5_ADMIN_URL . '/?dir=member&amp;pid=' . $vmode . $query_string;
}

/**
 * 버전체크
 */
$device_view = false;
if(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
    $device_view = true;
}

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';