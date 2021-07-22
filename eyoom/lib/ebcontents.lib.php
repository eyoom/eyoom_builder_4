<?php
/**
 * lib file : /eyoom/lib/ebcontents.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_contents function
 * 최신글 추출
 */
function eb_contents ($ec_code) {
    global $g5, $theme, $shop_theme, $eyoom, $member, $is_admin, $qfile, $config, $bbs, $bizinfo, $eb;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * EB콘텐츠 마스터 파일이 있는지 체크
     */
    $ebcontents_path = G5_DATA_PATH.'/ebcontents/'.$theme;
    $ebcontents_url = G5_DATA_URL.'/ebcontents/'.$theme;

    /**
     * 디렉토리가 없다면 생성하기
     */
    if (!is_dir($ebcontents_path)) {
        $qfile->make_directory($ebcontents_path);
    }

    $master_file = $ebcontents_path.'/ec_master_'.$ec_code.'.php';
    if (file_exists($master_file) && !is_dir($master_file)) {
        include($master_file);
    } else {
        $ec_master = sql_fetch("select * from {$g5['eyoom_contents']} where (1) and ec_code = '{$ec_code}' limit 1 ");

        /**
         * 설정파일 저장
         */
        $qfile->save_file('ec_master', $master_file, $ec_master);
    }

    /**
     * 스킨정보
     */
    $ec_skin = $ec_master['ec_skin'] ? $ec_master['ec_skin']: 'basic';

    /**
    * 스킨설정
    */
    $ebcontents_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/ebcontents/'.$ec_skin;
    $ebcontents_skin_url = str_replace(G5_PATH, G5_URL, $ebcontents_skin_path);
    
    /**
     * EB콘텐츠 기본소스 출력 여부
     */
    $ec_default = false;

    /**
     * EB콘텐츠가 활성화 되어 있다면 마스터 정보 및 아이템 정보를 가져오기
     */
    if ($ec_master['ec_state'] == '1') {
        /**
         * EB컨텐츠 마스터 타이틀
         */
        $ec_subject = $eb->mb_unserialize($ec_master['ec_subject']);
        if (is_array($ec_subject)) {
            foreach ($ec_subject as $k => $subject) {
                $key = 'ec_subject_'.($k+1);
                $ec_master[$key] = $subject;
            }
        }

        /**
         * EB컨텐츠 마스터 설명글
         */
        $ec_text = $eb->mb_unserialize($ec_master['ec_text']);
        if (is_array($ec_text)) {
            foreach ($ec_text as $k => $text) {
                $key = 'ec_text_'.($k+1);
                $ec_master[$key] = stripslashes($text);
            }
        }

        /**
         * EB컨텐츠 마스터 첨부 이미지
         */
        if ($ec_master['ec_image']) {
            $ec_master['ec_img_url'] = $ebcontents_url.'/img/'.$ec_master['ec_image'];
        }

        /**
         * EB컨텐츠 마스터 첨부파일
         */
        if ($ec_master['ec_file']) {
            $ec_master['ec_file_path'] = $ebcontents_path.'/file/'.$ec_master['ec_file'];
        }
        
        /**
         * 회원레벨
         */
        $mb_level = $member['mb_level'] ? $member['mb_level']: 1;

        /**
         * 콘텐츠 아이템
         */
        $ebcontents_item = $ebcontents_path.'/ec_item_'.$ec_code.'.php';
        if (file_exists($ebcontents_item) && !is_dir($ebcontents_item)) {
            include($ebcontents_item);

            if (is_array($ec_item)) {
                foreach ($ec_item as $i => $row) {
                    /**
                     * 허용 회원레벨보다 작다면
                     */
                    if ($mb_level < $row['ci_view_level']) continue;

                    $contents[$i] = $row;
                    
                    /**
                     * 타이틀
                     */
                    $ci_subject = &$contents[$i]['ci_subject'];
                    $ci_subject = $eb->mb_unserialize($row['ci_subject']);
                    if (is_array($ci_subject)) {
                        foreach ($ci_subject as $k => $subject) {
                            $subj_var = 'ci_subject_' . ($k+1);
                            $contents[$i][$subj_var] = $subject;
                        }
                    }
                    
                    /**
                     * 설명글
                     */
                    $ci_text = &$contents[$i]['ci_text'];
                    $ci_text = $eb->mb_unserialize($row['ci_text']);
                    if (is_array($ci_text)) {
                        foreach ($ci_text as $k => $text) {
                            $text_var = 'ci_text_' . ($k+1);
                            $contents[$i][$text_var] = stripslashes($text);
                        }
                    }
                    
                    /**
                     * 링크 정보
                     */
                    $link   = &$contents[$i]['link'];
                    $target = &$contents[$i]['target'];
                    $link   = $eb->mb_unserialize($row['ci_link']);
                    $target = $eb->mb_unserialize($row['ci_target']);

                    if (is_array($link)) {
                        foreach ($link as $k => $href) {
                            $href_var = 'href_' . ($k+1);
                            $target_var = 'target_' . ($k+1);
                            $contents[$i][$href_var] = $href;
                            $contents[$i][$target_var] = $target[$k];
                        }
                    }

                    /**
                     * 이미지 정보
                     */
                    $image  = &$contents[$i]['image'];
                    $image  = $eb->mb_unserialize($row['ci_img']);
                    if (is_array($image)) {
                        foreach ($image as $k => $filename) {
                            $img_var = 'img_' . ($k+1);
                            $src_var = 'src_' . ($k+1);
                            $img_url = $ebcontents_url . '/img/' . $filename;
                            $contents[$i][$img_var] = $filename;
                            $contents[$i][$src_var] = $img_url;
                        }
                    }
                    
                    /**
                     * Editor내용
                     */
                    if ($contents[$i]['ci_content']) {
                        $contents[$i]['ci_content'] = $bbs->board_content($contents[$i]['ci_content']);
                    }
                    
                }
            } else $ec_default = true;
        } else $ec_default = true;
    }

    /**
     * 스킨 출력
     */
    @include($ebcontents_skin_path.'/ebcontents.skin.html.php');
}