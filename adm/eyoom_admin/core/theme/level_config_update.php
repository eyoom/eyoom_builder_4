<?php
/**
 * @file    /adm/eyoom_admin/core/member/level_config_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999800";

auth_check($auth[$sub_menu], "w");

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 레벨 환경설정 및 포인터 설정 정보
 */
$levelset_config = G5_DATA_PATH.'/eyoom.levelset.php';
$levelset = $_POST['levelset'];

$levelset['max_use_gnu_level'] = $_POST['max_use_gnu_level'];
$levelset['cnt_gnu_level_2'] = $_POST['cnt_gnu_level_2'];
$levelset['cnt_gnu_level_3'] = $_POST['cnt_gnu_level_3'];
$levelset['cnt_gnu_level_4'] = $_POST['cnt_gnu_level_4'];
$levelset['cnt_gnu_level_5'] = $_POST['cnt_gnu_level_5'];
$levelset['cnt_gnu_level_6'] = $_POST['cnt_gnu_level_6'];
$levelset['cnt_gnu_level_7'] = $_POST['cnt_gnu_level_7'];
$levelset['cnt_gnu_level_8'] = $_POST['cnt_gnu_level_8'];
$levelset['cnt_gnu_level_9'] = $_POST['cnt_gnu_level_9'];
$levelset['calc_level_point'] = $_POST['calc_level_point'];
$levelset['calc_level_ratio'] = $_POST['calc_level_ratio'];

$qfile->save_file('levelset',$levelset_config,$levelset);

/**
 * 이윰레벨표 구성정보
 */
$levelinfo_config = G5_DATA_PATH.'/eyoom.levelinfo.php';
$lvlinfo = $_POST['levelinfo'];
foreach($lvlinfo as $level => $arr_level) {
    foreach($arr_level as $key => $val) {
        if($key == 'name') {
            if(!$val) $val = 'Level '.$level;
        }
        if($key == 'min') {
            if(!$val) $val = 0;
        }
        $levelinfo[$level][$key] = $val;
    }
}
$qfile->save_file('levelinfo',$levelinfo_config,$levelinfo,true);

$msg = "이윰레벨 설정을 적용하였습니다.";
alert($msg, G5_ADMIN_URL.'/?dir=theme&amp;pid=level_config');
