<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_skins.php
 */

include_once('./_common.php');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

/**
 * 스킨 디렉토리 정의
 */
$skin_dir = G5_PATH.'/theme/'.$this_theme.'/skin';
$skin_url = G5_URL.'/theme/'.$this_theme.'/skin';

/**
 * 스킨 디렉토리 읽어오기
 */
$ebcontents_skins = get_skin_dir('ebcontents', $skin_dir);
if (isset($ebcontents_skins) && is_array($ebcontents_skins)) {
    $i=0;
    $list = array();
    foreach ($ebcontents_skins as $k => $skin) {
        $list[$i]['ec_skin_name'] = $skin;
        $skin_img = $skin_dir.'/ebcontents/'.$skin.'/image/ec_skin_img.png';
        if (file_exists($skin_img)) {
            $list[$i]['ec_skin_img'] = $skin_url.'/ebcontents/'.$skin.'/image/ec_skin_img.png';
        }
        $i++;
    }
}