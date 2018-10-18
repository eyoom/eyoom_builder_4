<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_json.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * edit_mode 변수
 */
$edit_mode = $_POST['edit_mode'];

/**
 * $edit_mode : on 만 허용
 */
if ($edit_mode && $edit_mode != 'on') return;

/**
 * 편집모드 토글
 */
$eyoom_default['edit_mode'] = $edit_mode == 'on' ? '': 'on';

/**
 * 설정정보 업데이트
 */
$qfile->save_file('eyoom', $eyoom_config_file, $eyoom_default);