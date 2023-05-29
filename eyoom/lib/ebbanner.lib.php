<?php
/**
 * lib file : /eyoom/lib/ebbanner.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_banner function
 * 최신글 추출
 */
function eb_banner ($bn_code) {
    global $g5, $theme, $shop_theme, $eyoom, $member, $is_admin, $qfile, $config, $eb;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * EB배너 마스터 파일이 있는지 체크
     */
    $ebbanner_path = G5_DATA_PATH.'/ebbanner/'.$theme;
    $ebbanner_url = G5_DATA_URL.'/ebbanner/'.$theme;

    /**
     * 디렉토리가 없다면 생성하기
     */
    if (!is_dir($ebbanner_path)) {
        $qfile->make_directory($ebbanner_path);
    }

    $master_file = $ebbanner_path.'/bn_master_'.$bn_code.'.php';
    if (file_exists($master_file) && !is_dir($master_file)) {
        include($master_file);
    } else {
        $bn_master = sql_fetch("select * from {$g5['eyoom_banner']} where (1) and bn_code = '{$bn_code}' limit 1 ");

        /**
         * 설정파일 저장
         */
        $qfile->save_file('bn_master', $master_file, $bn_master);
    }

    /**
     * 스킨정보
     */
    $bn_skin = $bn_master['bn_skin'] ? $bn_master['bn_skin']: 'basic';

    /**
    * 스킨설정
    */
    $ebbanner_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/ebbanner/'.$bn_skin;
    $ebbanner_skin_url = str_replace(G5_PATH, G5_URL, $ebbanner_skin_path);

    /**
     * EB배너 기본소스 출력 여부
     */
    $bn_default = false;

    /**
     * EB배너가 활성화 되어 있다면 아이템 정보를 가져오기
     */
    if ($bn_master['bn_state'] == '1') {
        /**
         * EB배너 마스터 첨부 이미지
         */
        if ($bn_master['bn_image']) {
            $bn_master['bn_img_url'] = $ebbanner_url.'/img/'.$bn_master['bn_image'];
        }

        /**
         * 회원레벨
         */
        $mb_level = $member['mb_level'] ? $member['mb_level']: 1;

        /**
         * EB배너 아이템
         */
        $ebbanner_item = $ebbanner_path.'/bn_item_'.$bn_code.'.php';
        if (file_exists($ebbanner_item) && !is_dir($ebbanner_item)) {
            include($ebbanner_item);
            $this_date = date('Ymd');

            if (is_array($bn_item)) {
                $sql_where1 = " bn_code='{$bn_code}' and bi_state = '1' ";

                /**
                 * 날짜별 노출수
                 */
                $bs = sql_fetch("select * from {$g5['eyoom_banner_date']} where bs_date='".G5_TIME_YMD."' ");
                if (!$bs['bs_date']) {
                    $sql = "insert into {$g5['eyoom_banner_date']} set bs_date = '".G5_TIME_YMD."' ";
                    $result = sql_query($sql, FALSE);
                    $bs_expose = array();
                } else {
                    $bs_expose = unserialize($bs['bs_expose']);
                }

                foreach ($bn_item as $i => $row) {
                    unset($bi_img_path, $bi_img_url, $bi_query, $sql_where2, $sql_where3);

                    // 보이기 상태
                    if ($row['bi_state'] == '2') {
                        continue;
                    }

                    // 허용 회원레벨보다 작다면
                    if ($mb_level < $row['bi_view_level']) {
                        continue;
                    }

                    // 기간제 체크
                    if ($row['bi_period'] == '2') {
                        if ($row['bi_start'] > $this_date || $this_date > $row['bi_end']) {
                            continue;
                        }
                    }

                    $banner[$i] = $row;

                    if ($row['bi_type'] == 'intra') {
                        // 이미지 정보
                        $image  = &$banner[$i]['image'];
                        $image  = $eb->mb_unserialize($row['bi_img']);
                        if (is_array($image)) {
                            foreach ($image as $k => $filename) {
                                $img_var = 'img_' . ($k+1);
                                $src_var = 'src_' . ($k+1);
                                $img_url = G5_DATA_URL.'/ebbanner/' . $row['bi_theme'] . '/img/' . $filename;
                                $banner[$i][$img_var] = $filename;
                                $banner[$i][$src_var] = $img_url;
                            }
                        }

                        $bi_query = $eb->encrypt_md5("{$bn_code}|{$row['bi_no']}|{$_SERVER['REMOTE_ADDR']}|{$row['bi_link']}", SALT_KEY);
                        $banner[$i]['bi_href'] = G5_URL.'/page/ebbanner.php?biq='.$bi_query;
                    } else {
                        $banner[$i]['bi_script'] = stripslashes($row['bi_script']);
                        $sql_where2 .= " and bi_type = 'extra' ";
                    }

                    $sql_where3 = " and bi_no = '{$row['bi_no']}' ";

                    /**
                     * 노출수 업데이트
                     */
                    $sql2 = "update {$g5['eyoom_banner_item']} set bi_exposed=bi_exposed+1 where {$sql_where1} {$sql_where2} {$sql_where3} ";
                    sql_query($sql2);

                    /**
                     * 노출수 증가
                     */
                    $bs_expose[$row['bi_no']]++;
                }

                /**
                 * 노출수 날짜별 업데이트
                 */
                if (is_array($bs_expose)) {
                    $_bs_expose = serialize($bs_expose);
                    $sql = "update {$g5['eyoom_banner_date']} set bs_expose = '{$_bs_expose}' where bs_date = '".G5_TIME_YMD."'";
                    sql_query($sql);
                }
            } else $bn_default = true;
        } else $bn_default = true;
    }

    /**
     * 스킨 출력
     */
    include($ebbanner_skin_path.'/ebbanner.skin.html.php');
}