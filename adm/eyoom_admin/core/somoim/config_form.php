<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/config_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350100";

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

if (!isset($sm_bo_table)) exit;

/**
 * 소모임 테이블 생성
 */
if(!sql_query(" DESC {$g5['eyoom_somoim']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['eyoom_somoim']}` (
                  `sm_id` varchar(20) NOT NULL,
                  `wr_id` int(11) NOT NULL,
                  `sm_subject` varchar(255) NOT NULL,
                  `sm_admin` varchar(255) NOT NULL,
                  `sm_category` varchar(255) NOT NULL,
                  `sm_introduce` varchar(255) NOT NULL,
                  `sm_score` int(11) NOT NULL DEFAULT '0',
                  `sm_ranking` mediumint(5) NOT NULL,
                  `sm_prev_ranking` mediumint(5) NOT NULL,
                  `sm_open` enum('y','n') NOT NULL DEFAULT 'y',
                  `sm_regdt` datetime NOT NULL
                ) ", false);
}

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=somoim&pid=config_form_update&smode=1";

/**
 * 소모임 테이블이 있는지 체크
 */
$sm_chk = sql_fetch("selec count(*) as cnt from {$g5['board_table']} where bo_table = '{$sm_bo_table}' ");

if (!$sm_chk['cnt']) {
    include_once (EYOOM_ADMIN_PATH."/core/somoim/make_somoim_board.php");
}

/**
 * 소모임 슬라이더
 */
$sm_chk = sql_fetch("select count(*) as cnt from {$g5['eyoom_slider']} where es_code='1668579550' ");
if (!$sm_chk['cnt']) {
    $sql = "INSERT INTO `g5_eyoom_slider` (`es_code`, `es_subject`, `es_theme`, `es_skin`, `es_text`, `es_ytplay`, `es_ytmauto`, `es_state`, `es_link`, `es_target`, `es_image`, `es_link_cnt`, `es_image_cnt`, `es_regdt`) VALUES 
            ('1668579550', '소모임 배너', '{$this_theme}', 'somoim_banner', '', '1', '2', 1, '', '', '', 1, 1, '".G5_TIME_YMDHIS."')";
    sql_query($sql);
    
    $ei_link[0] = G5_BBS_URL.'/board.php?bo_table=somoim';
    $ei_links = serialize($ei_link);
    $ei_taget[0] = '';
    $ei_tagets = serialize($ei_target);
    $ei_img[0] = "3fc6b8377e1ca5b283f9a91dc38c8c18.jpg";
    $ei_imgs = serialize($ei_img);
    $sql = "INSERT INTO `g5_eyoom_slider_item` (`es_code`, `ei_theme`, `ei_state`, `ei_sort`, `ei_title`, `ei_subtitle`, `ei_text`, `ei_link`, `ei_target`, `ei_img`, `ei_period`, `ei_start`, `ei_end`, `ei_clicked`, `ei_view_level`, `ei_regdt`) VALUES 
            ('1668579550', '{$this_theme}', '1', 1, '소모임 신청하기', '', '', '{$ei_links}', '{$ei_targets}', '{$ei_imgs}', '1', '', '', 0, 1, '".G5_TIME_YMDHIS."')";
    sql_query($sql);
    
    copy(G5_PATH.'/tmp/3fc6b8377e1ca5b283f9a91dc38c8c18.jpg', G5_DATA_PATH.'/ebslider/'.$this_theme.'/img/3fc6b8377e1ca5b283f9a91dc38c8c18.jpg');
    copy(G5_PATH.'/tmp/es_master_1668579550.php', G5_DATA_PATH.'/ebslider/'.$this_theme.'/es_master_1668579550.php');
    copy(G5_PATH.'/tmp/es_item_1668579550.php', G5_DATA_PATH.'/ebslider/'.$this_theme.'/es_item_1668579550.php');
}

/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="확인" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '/page/?pid=somoim" class="btn-e btn-e-lg btn-e-dark">소모임 메인</a> ';
$frm_submit .= '</div>';