<?php
/**
 * core file : /eyoom/core/qa/view.skin.php
 */
if (!defined('_EYOOM_')) exit;

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/**
 * 첨부파일 다운로드
 */
$files = array();
for ($i=0; $i<$view['download_count']; $i++) {
    $files[$i]['download_href'] = $view['download_href'][$i];
    $files[$i]['download_source'] = $view['download_source'][$i];
}

/**
 * 파일 출력
 */
$thumbs = array();
if ($view['img_count']) {
    for ($i=0; $i<$view['img_count']; $i++) {
        $thumbs[$i] = get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
    }
}

/**
 * 회원 이미지 / 답변자 이미지
 */
$view['mb_photo'] = $eb->mb_photo($view['mb_id'], 'img');
$answer['mb_photo'] = $eb->mb_photo($answer['mb_id'], 'img');

$option = '';
$option_hidden = '';

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/qa/view.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['qa'].'/view.skin.html.php');