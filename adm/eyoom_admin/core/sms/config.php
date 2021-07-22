<?php
/**
 * @file    /adm/eyoom_admin/core/sms/config.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900100";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=config_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "SMS 기본설정";

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

// 아이코드 토큰키 추가
if( ! isset($config['cf_icode_token_key']) ){
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_icode_token_key` VARCHAR(100) NOT NULL DEFAULT '' AFTER `cf_icode_server_port`; ";
    sql_query($sql, false);
    $config['cf_icode_token_key'] = '';
}

// 배열코드 초기화
$userinfo = array('payment'=>'', 'coin'=>'');

if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw'])
{
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}

if (!$config['cf_icode_id'])
    $config['cf_icode_id'] = 'sir_';

if (! (isset($sms5['cf_skin']) && $sms5['cf_skin']))
    $sms5['cf_skin'] = 'basic';

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';