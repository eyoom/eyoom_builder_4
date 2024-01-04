<?php
/**
 * @file    /adm/eyoom_admin/core/cpannel/layout_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

if (isset($_REQUEST['theme'])) {
    if (!is_array($_REQUEST['theme'])) {
        $theme = filter_var($_REQUEST['theme'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_]+$/i")
        ));
        $theme = preg_replace('/[^a-z0-9_]/i', '', trim($theme));
    } else {
        $theme = 'eb4_basic';
    }
} else {
    $theme = 'eb4_basic';
}

/**
 * $eyoom 변수파일 재정의
 */
unset($eyoom);
$eyoom_config_file = G5_DATA_PATH . '/eyoom.'.$theme.'.config.php';
include($eyoom_config_file);

foreach ($_POST as $key => $skin) {
    if ($key == 'token' || $key == 'theme') continue;
    $eyoom[$key] = $skin;
}

/**
 * 설정정보 업데이트
 */
$qfile->save_file('eyoom', $eyoom_config_file, $eyoom);

?>
<script>
parent.document.location.reload();
</script>