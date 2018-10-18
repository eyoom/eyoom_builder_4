<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/mypage.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php
/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<div class="my-page">
    <?php
    /**
     * 마이박스
     */
    $permit_mymain = array('timeline', 'favorite', 'followinggul', 'subscribe', 'goodpost', 'starpost', 'pinboard');
    if (!in_array($mymain, $permit_mymain)) {
        include_once($eyoom_skin_path['mypage'] . '/mybox.skin.html.php');
    }

    /**
     * 지정한 마이페이지 메인 출력
     */
    include_once(EYOOM_CORE_PATH.'/mypage/'.$mymain.'.php');
    ?>
</div>