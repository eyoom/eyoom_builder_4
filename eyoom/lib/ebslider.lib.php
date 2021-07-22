<?php
/**
 * lib file : /eyoom/lib/ebslider.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_slider function
 * 최신글 추출
 */
function eb_slider ($es_code) {
    global $g5, $theme, $shop_theme, $eyoom, $member, $is_admin, $qfile, $config, $eb;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * EB슬라이더 마스터 파일이 있는지 체크
     */
    $ebslider_path = G5_DATA_PATH.'/ebslider/'.$theme;
    $ebslider_url = G5_DATA_URL.'/ebslider/'.$theme;

    /**
     * 디렉토리가 없다면 생성하기
     */
    if (!is_dir($ebslider_path)) {
        $qfile->make_directory($ebslider_path);
    }

    $master_file = $ebslider_path.'/es_master_'.$es_code.'.php';
    if (file_exists($master_file) && !is_dir($master_file)) {
        include($master_file);
    } else {
        $es_master = sql_fetch("select * from {$g5['eyoom_slider']} where (1) and es_code = '{$es_code}' limit 1 ");

        /**
         * 설정파일 저장
         */
        $qfile->save_file('es_master', $master_file, $es_master);
    }

    /**
     * 스킨정보
     */
    $es_skin = $es_master['es_skin'] ? $es_master['es_skin']: 'basic';

    /**
    * 스킨설정
    */
    $ebslider_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/ebslider/'.$es_skin;
    $ebslider_skin_url = str_replace(G5_PATH, G5_URL, $ebslider_skin_path);

    /**
     * EB슬라이더 기본소스 출력 여부
     */
    $es_default = false;

    /**
     * EB슬라이더가 활성화 되어 있다면 아이템 정보를 가져오기
     */
    if ($es_master['es_state'] == '1') {
        /**
         * EB슬라이더 마스터 첨부 이미지
         */
        if ($es_master['es_image']) {
            $es_master['es_img_url'] = $ebslider_url.'/img/'.$es_master['es_image'];
        }

        /**
         * 회원레벨
         */
        $mb_level = $member['mb_level'] ? $member['mb_level']: 1;

        /**
         * 동영상 아이템
         */
        $exist_video = false;
        $ebslider_ytitem = $ebslider_path.'/es_ytitem_'.$es_code.'.php';
        if (file_exists($ebslider_ytitem) && !is_dir($ebslider_ytitem)) {
            include($ebslider_ytitem);

            if (is_array($es_ytitem)) {
                $exist_video = true;

                foreach ($es_ytitem as $i => $row) {
                    // 허용 회원레벨보다 작다면
                    if ($mb_level < $row['ei_view_level']) continue;

                    $video[$i] = $row;
                }
             } else {
                $es_default = true;
            }
        }

        /**
         * EB슬라이더 아이템
         */
        $ebslider_item = $ebslider_path.'/es_item_'.$es_code.'.php';
        if (file_exists($ebslider_item) && !is_dir($ebslider_item)) {
            include($ebslider_item);

            if (is_array($es_item)) {
                foreach ($es_item as $i => $row) {
                    // 허용 회원레벨보다 작다면
                    if ($mb_level < $row['ei_view_level']) continue;

                    $slider[$i] = $row;

                    // 링크 정보
                    $link   = &$slider[$i]['link'];
                    $target = &$slider[$i]['target'];
                    $link   = $eb->mb_unserialize($row['ei_link']);
                    $target = $eb->mb_unserialize($row['ei_target']);

                    if (is_array($link)) {
                        foreach ($link as $k => $href) {
                            $href_var = 'href_' . ($k+1);
                            $target_var = 'target_' . ($k+1);
                            $slider[$i][$href_var] = $href;
                            $slider[$i][$target_var] = $target[$k];
                        }
                    }

                    // 이미지 정보
                    $image  = &$slider[$i]['image'];
                    $image  = $eb->mb_unserialize($row['ei_img']);
                    if (is_array($image)) {
                        foreach ($image as $k => $filename) {
                            $img_var = 'img_' . ($k+1);
                            $src_var = 'src_' . ($k+1);
                            $img_url = G5_DATA_URL.'/ebslider/' . $row['ei_theme'] . '/img/' . $filename;
                            $slider[$i][$img_var] = $filename;
                            $slider[$i][$src_var] = $img_url;
                        }
                    }
                }
            } else $es_default = true;
        } else $es_default = true;
    }

    /**
     * 스킨 출력
     */
    include($ebslider_skin_path.'/ebslider.skin.html.php');
}