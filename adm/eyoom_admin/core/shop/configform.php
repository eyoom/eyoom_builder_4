<?php
/**
 * @file    /adm/eyoom_admin/core/shop/configform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400100";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=configformupdate&amp;smode=1';

include_once(G5_EDITOR_LIB);

auth_check_menu($auth, $sub_menu, "r");

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

$userinfo = array('payment'=>'');
if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw']) {
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    //'anc_scf_info' => '사업자정보',
    'anc_scf_skin' => '스킨설정',
    'anc_scf_index' => '쇼핑몰 초기화면',
    //'anc_mscf_index' => '모바일 초기화면',
    'anc_scf_payment' => '결제설정',
    'anc_scf_delivery' => '배송설정',
    'anc_scf_etc' => '기타설정',
    'anc_scf_sms' => 'SMS설정',
);

// 무이자 할부 사용설정 필드 추가
if(!isset($default['de_card_noint_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_card_noint_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_card_use` ", true);
}

// 모바일 관련상품 설정 필드추가
if(!isset($default['de_mobile_rel_list_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_mobile_rel_list_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_rel_img_height`,
                    ADD `de_mobile_rel_list_skin` varchar(255) NOT NULL DEFAULT '' AFTER `de_mobile_rel_list_use`,
                    ADD `de_mobile_rel_img_width` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_rel_list_skin`,
                    ADD `de_mobile_rel_img_height` int(11) NOT NULL DEFAULT ' 0' AFTER `de_mobile_rel_img_width`", true);
}

// 신규회원 쿠폰 설정 필드 추가
if(!isset($default['de_member_reg_coupon_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_member_reg_coupon_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_tax_flag_use`,
                    ADD `de_member_reg_coupon_term` int(11) NOT NULL DEFAULT '0' AFTER `de_member_reg_coupon_use`,
                    ADD `de_member_reg_coupon_price` int(11) NOT NULL DEFAULT '0' AFTER `de_member_reg_coupon_term` ", true);
}

// 신규회원 쿠폰 주문 최소금액 필드추가
if(!isset($default['de_member_reg_coupon_minimum'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_member_reg_coupon_minimum` int(11) NOT NULL DEFAULT '0' AFTER `de_member_reg_coupon_price` ", true);
}

// lg 결제관련 필드 추가
if(!isset($default['de_pg_service'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_pg_service` varchar(255) NOT NULL DEFAULT '' AFTER `de_sms_hp` ", true);
}


// inicis 필드 추가
if(!isset($default['de_inicis_mid'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_inicis_mid` varchar(255) NOT NULL DEFAULT '' AFTER `de_kcp_site_key` ", true);
}

// 모바일 초기화면 이미지 줄 수 필드 추가
if(!isset($default['de_mobile_type1_list_row'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_mobile_type1_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_type1_list_mod`,
                    ADD `de_mobile_type2_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_type2_list_mod`,
                    ADD `de_mobile_type3_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_type3_list_mod`,
                    ADD `de_mobile_type4_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_type4_list_mod`,
                    ADD `de_mobile_type5_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_type5_list_mod` ", true);
}

// 모바일 관련상품 이미지 줄 수 필드 추가
if(!isset($default['de_mobile_rel_list_mod'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_mobile_rel_list_mod` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_rel_list_skin` ", true);
}

// 모바일 검색상품 이미지 줄 수 필드 추가
if(!isset($default['de_mobile_search_list_row'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_mobile_search_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_search_list_mod` ", true);
}

// PG 간펼결제 사용여부 필드 추가
if(!isset($default['de_easy_pay_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_easy_pay_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_iche_use` ", true);
}

// 이니시스 삼성페이 사용여부 필드 추가
if(!isset($default['de_samsung_pay_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_samsung_pay_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_easy_pay_use` ", true);
}

// 이니시스
if(!isset($default['de_inicis_cartpoint_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_inicis_cartpoint_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_samsung_pay_use` ", true);
}

// 이니시스 lpay 사용여부 필드 추가
if(!isset($default['de_inicis_lpay_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_inicis_lpay_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_samsung_pay_use` ", true);
}

// 이니시스 kakaopay 사용여부 필드 추가
if(!isset($default['de_inicis_kakaopay_use'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_inicis_kakaopay_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_inicis_lpay_use` ", true);
}

// 카카오페이 필드 추가
if(!isset($default['de_kakaopay_mid'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_kakaopay_mid` varchar(255) NOT NULL DEFAULT '' AFTER `de_tax_flag_use`,
                    ADD `de_kakaopay_key` varchar(255) NOT NULL DEFAULT '' AFTER `de_kakaopay_mid`,
                    ADD `de_kakaopay_enckey` varchar(255) NOT NULL DEFAULT '' AFTER `de_kakaopay_key`,
                    ADD `de_kakaopay_hashkey` varchar(255) NOT NULL DEFAULT '' AFTER `de_kakaopay_enckey`,
                    ADD `de_kakaopay_cancelpwd` varchar(255) NOT NULL DEFAULT '' AFTER `de_kakaopay_hashkey` ", true);
}

// 이니시스 웹결제 사인키 필드 추가
if(!isset($default['de_inicis_sign_key'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_inicis_sign_key` varchar(255) NOT NULL DEFAULT '' ", true);
}

// 네이버페이 필드추가
if(!isset($default['de_naverpay_mid'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_naverpay_mid` varchar(255) NOT NULL DEFAULT '' AFTER `de_kakaopay_cancelpwd`,
                    ADD `de_naverpay_cert_key` varchar(255) NOT NULL DEFAULT '' AFTER `de_naverpay_mid`,
                    ADD `de_naverpay_button_key` varchar(255) NOT NULL DEFAULT '' AFTER `de_naverpay_cert_key`,
                    ADD `de_naverpay_test` tinyint(4) NOT NULL DEFAULT '0' AFTER `de_naverpay_button_key`,
                    ADD `de_naverpay_mb_id` varchar(255) NOT NULL DEFAULT '' AFTER `de_naverpay_test`,
                    ADD `de_naverpay_sendcost` varchar(255) NOT NULL DEFAULT '' AFTER `de_naverpay_mb_id`", true);
}

// 유형별상품리스트 설정필드 추가
if(!isset($default['de_listtype_list_skin'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_listtype_list_skin` varchar(255) NOT NULL DEFAULT '' AFTER `de_mobile_search_img_height`,
                    ADD `de_listtype_list_mod` int(11) NOT NULL DEFAULT '0' AFTER `de_listtype_list_skin`,
                    ADD `de_listtype_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_listtype_list_mod`,
                    ADD `de_listtype_img_width` int(11) NOT NULL DEFAULT '0' AFTER `de_listtype_list_row`,
                    ADD `de_listtype_img_height` int(11) NOT NULL DEFAULT '0' AFTER `de_listtype_img_width`,
                    ADD `de_mobile_listtype_list_skin` varchar(255) NOT NULL DEFAULT '' AFTER `de_listtype_img_height`,
                    ADD `de_mobile_listtype_list_mod` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_listtype_list_skin`,
                    ADD `de_mobile_listtype_list_row` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_listtype_list_mod`,
                    ADD `de_mobile_listtype_img_width` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_listtype_list_row`,
                    ADD `de_mobile_listtype_img_height` int(11) NOT NULL DEFAULT '0' AFTER `de_mobile_listtype_img_width` ", true);
}

// 임시저장 테이블이 없을 경우 생성
if(!sql_query(" DESC {$g5['g5_shop_post_log_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['g5_shop_post_log_table']}` (
                  `log_id` int(11) NOT NULL AUTO_INCREMENT,   
                  `oid` bigint(20) unsigned NOT NULL,
                  `mb_id` varchar(255) NOT NULL DEFAULT '',
                  `post_data` text NOT NULL,
                  `ol_code` varchar(255) NOT NULL DEFAULT '',
                  `ol_msg` text NOT NULL,
                  `ol_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `ol_ip` varchar(25) NOT NULL DEFAULT '',
                  PRIMARY KEY (`log_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8; ", false);
}


// 현금영수증 발급 조건 추가
if(!isset($default['de_taxsave_types'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_default_table']}`
                    ADD `de_taxsave_types` set('account','vbank','transfer') NOT NULL DEFAULT 'account' AFTER `de_taxsave_use` ", true);
}

// 아이코드 토큰키 추가
if( ! isset($config['cf_icode_token_key']) ){
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_icode_token_key` VARCHAR(100) NOT NULL DEFAULT '' AFTER `cf_icode_server_port`; ";
    sql_query($sql, false);
}

// PG 간편결제 추가 ( NHN_KCP 네이버페이, 카카오페이 )
if( ! isset($default['de_easy_pay_services']) ){
    $sql = "ALTER TABLE `{$g5['g5_shop_default_table']}` 
            ADD COLUMN `de_easy_pay_services` VARCHAR(255) NOT NULL DEFAULT '' AFTER `de_easy_pay_use`; ";
    sql_query($sql, false);
}

// KG 이니시스 iniapi_key 추가
if( ! isset($default['de_inicis_iniapi_key']) ){
    $sql = "ALTER TABLE `{$g5['g5_shop_default_table']}` 
            ADD COLUMN `de_inicis_iniapi_key` VARCHAR(30) NOT NULL DEFAULT '' AFTER `de_inicis_sign_key`,
            ADD COLUMN `de_inicis_iniapi_iv` VARCHAR(30) NOT NULL DEFAULT '' AFTER `de_inicis_iniapi_key`; ";
    sql_query($sql, false);
}

// NICEPAY mid, key 추가
if (! isset($default['de_nicepay_mid'])) {
    $sql = "ALTER TABLE `{$g5['g5_shop_default_table']}` 
            ADD COLUMN `de_nicepay_mid` VARCHAR(20) NOT NULL DEFAULT '' AFTER `de_inicis_cartpoint_use`,
            ADD COLUMN `de_nicepay_key` VARCHAR(150) NOT NULL DEFAULT '' AFTER `de_nicepay_mid`; ";
    sql_query($sql, false);
}

if( function_exists('pg_setting_check') ){
    pg_setting_check(true);
}

if(!$default['de_kakaopay_cancelpwd']){
    $default['de_kakaopay_cancelpwd'] = '1111';
}

$account_checked = $vbank_checked = $transfer_checked = '';

if (strstr($default['de_taxsave_types'], 'account')) {
    $account_checked = 'checked="checked"';
}
if (strstr($default['de_taxsave_types'], 'vbank')) {
    $vbank_checked = 'checked="checked"';
}
if (strstr($default['de_taxsave_types'], 'transfer')) {
    $transfer_checked = 'checked="checked"';
}

/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="적용하기" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_SHOP_URL . '" class="btn-e btn-e-lg btn-e-dark">쇼핑몰</a> ': '';
$frm_submit .= '</div>';