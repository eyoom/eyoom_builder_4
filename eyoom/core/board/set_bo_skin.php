<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!$is_admin) exit;

$bo_table   = $_POST['bo_table'];
$skin       = $_POST['skin'];

if (!$bo_table) exit;
if (!$skin) exit;

/**
 * 이윰게시판 설정에서 쇼핑몰 스킨사용체크 필드 추가
 */
if(!sql_query(" select use_shop_skin from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}` add `use_shop_skin` enum('y','n') NOT NULL default 'n' after `use_gnu_skin` ";
    sql_query($sql, true);
}

/**
 * 채택게시판 설정 필드 추가
 */
if(!sql_query(" select bo_use_adopt_point from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_adopt_point` char(1) NOT NULL default '' after `bo_use_extimg`,
        add `bo_adopt_minpoint` int(7) NOT NULL default '0' after `bo_use_adopt_point`,
        add `bo_adopt_maxpoint` int(11) NOT NULL default '0' after `bo_adopt_minpoint`,
        add `bo_adopt_ratio` smallint(3) NOT NULL default '0' after `bo_adopt_maxpoint`
    ";
    sql_query($sql, true);
}

/**
 * 회원당 하루 게시물 작성회수 설정 필드 추가
 */
if(!sql_query(" select bo_write_limit from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_write_limit` smallint(3) NOT NULL default '0' after `bo_adopt_ratio`
    ";
    sql_query($sql, true);
}

/**
 * 별점 평가 기능 확장 & 추천회원 / 비추천회원 뷰페이지에서 보이기 설정 필드 추가
 */
if(!sql_query(" select bo_use_rating_member from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_rating_member` char(1) NOT NULL default '0' after `bo_use_rating_list`,
        add `bo_use_rating_score` char(1) NOT NULL default '0' after `bo_use_rating_member`,
        add `bo_use_rating_comment` char(1) NOT NULL default '0' after `bo_use_rating_score`,
        add `bo_rating_point` int(11) NOT NULL default '0' after `bo_use_rating_comment`,
        add `bo_use_good_member` char(1) NOT NULL default '1' after `bo_use_video_photo`,
        add `bo_use_nogood_member` char(1) NOT NULL default '0' after `bo_use_good_member`
    ";
    sql_query($sql, true);
}

if(!sql_query(" select bo_use_good_member from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_good_member` char(1) NOT NULL default '1' after `bo_use_video_photo`,
        add `bo_use_nogood_member` char(1) NOT NULL default '0' after `bo_use_good_member`
    ";
    sql_query($sql, true);
}

sql_query("update {$g5['eyoom_board']} set bo_skin = '{$skin}' where bo_table = '{$bo_table}' ");