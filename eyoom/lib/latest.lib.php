<?php
/**
 * lib file : /eyoom/lib/latest.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 익명 게시판
 */
$anonymous_table = $bbs->anonymous_table();

/**
 * eb_latest function
 * 최신글 추출
 */
function eb_latest ($el_code) {
    global $g5, $theme, $shop_theme, $eyoom, $member, $is_admin, $latest, $qfile, $eb, $config, $anonymous_table;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * EB최신글 경로
     */
    $eblatest_path = G5_DATA_PATH.'/eblatest/'.$theme;

    /**
     * 디렉토리가 없다면 생성하기
     */
    if (!is_dir($eblatest_path)) {
        $qfile->make_directory($eblatest_path);
    }

    /**
     * EB최신글 master 파일 경로
     */
    $master_file = $eblatest_path.'/el_master_'.$el_code.'.php';
    
    if (file_exists($master_file) && !is_dir($master_file)) {
        include($master_file);
    } else {
        /**
         * g5_eyoom_latest 테이블에서 정보 추출
         */
        $el_master = $latest->get_master($el_code);

        /**
         * 파일 캐시
         */
        $qfile->save_file('el_master', $master_file, $el_master);
    }

    /**
     * EB최신글 기본소스 출력 여부
     */
    $el_default = false;

    /**
     * EB최신글이 활성화 되어 있다면 아이템 정보를 가져오기
     */
    if ($el_master['el_state'] == '1' || ($is_admin && $el_master['el_skin'])) {
        /**
        * 스킨정보
        */
        $eblatest_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/eblatest/'.$el_master['el_skin'];
        $eblatest_skin_url = str_replace(G5_PATH, G5_URL, $eblatest_skin_path);

        /**
         * 회원레벨
         */
        $mb_level = $member['mb_level'] ? $member['mb_level']: 1;

        /**
         * 최신글 아이템 설정정보
         */
        $eblatest_item = $eblatest_path.'/el_item_'.$el_code.'.php';

        if (file_exists($eblatest_item) && !is_dir($eblatest_item)) {
            include($eblatest_item);
        } else {
            /**
             * g5_eyoom_latest_item 테이블에서 정보 추출
             */
            $el_item = $latest->save_item($el_code, $theme);
        }

        /**
         * new 표시 시간
         */
        $new_date = date("Y-m-d H:i:s", G5_SERVER_TIME - ($el_master['el_new'] * 3600));

        /**
         * 지정된 아이템의 게시물 가져오기
         */
        $el_count = count((array)$el_item);
        for ($i=0; $i<$el_count; $i++) {
            if ($el_item[$i]['li_state'] == '2' || $el_item[$i]['li_view_level'] > $member['mb_level']) {
                unset($el_item[$i]);
                continue;
            }

            /**
             * 최신글 아이템 레코드 고유번호
             */
            $li_no = $el_item[$i]['li_no'];

            /**
             * 게시물 분할
             */
            if (!$el_item[$i]['li_depart']) $el_item[$i]['li_depart'] = 1;
            $depart_number[$i] = $el_item[$i]['li_count'] / $el_item[$i]['li_depart'];

            /**
             * latest_row_file 파일
             */
            $latest_row_file = $eblatest_path.'/latest_'.$el_code.'_'.$li_no.'.php';
            if (file_exists($latest_row_file)) {
                /**
                 * 캐시 갱신 시간 체크
                 */
                $filectime = time() - filectime($latest_row_file);
                if ($filectime < $el_master['el_cache']) {
                    $is_timeover = false;
                } else {
                    $is_timeover = true;
                }

                /**
                 * 캐시 스위치온 체크
                 */
                $switch_on_file = $eblatest_path.'/switch_'.$el_code.'_'.$li_no.'.php';
                if (file_exists($switch_on_file)) { // 캐시 스위치온 파일이 존재할때만 캐시
                    if ($is_timeover) { // 설정한 캐시 시간을 초과했을 경우 캐시
                        $make_cache = true;
                    } else {
                        $make_cache = false;
                    }
                }

                /**
                 * 기간제 최신글의 경우, 스위치 오프에서도 설정기간이 지나면 캐시하도록 처리
                 */
                if ($el_item[$i]['li_period'] > 0 && $filectime > $el_item[$i]['li_period']*60*60*24) {
                    $make_cache = true;
                }

                /**
                 * 갱신시간 및 스위치온 조건이 맞다면 캐시 진행
                 * 기간제 설정이 된 최신글
                 */
                if ($make_cache) {
                    $latest->make_cache_data($el_code, $theme, $li_no);
                }

                /**
                 * 캐시파일 가져오기
                 */
                unset($latest_row);
                include $latest_row_file;

                /**
                 * 리스트 출력 레코드 가공하기
                 */
                $loop = &$el_item[$i]['list'];
                foreach ($latest_row as $k => $row) {
                    $loop[$k] = $row;

                    /**
                     * 제목을 일정 간격으로 자르기
                     */
                    $cut_subject = $el_item[$i]['li_cut_subject'] ? $el_item[$i]['li_cut_subject']: 300;

                    /**
                     * 제목이 없다면 댓글
                     */
                    $loop[$k]['is_cmt'] = false;
                    if ($row['wr_id'] != $row['wr_parent']) {
                        $loop[$k]['wr_subject'] = cut_str(preg_replace("/(\\n|\\r)/",'',stripslashes(htmlspecialchars_decode($row['wr_content']))), $cut_subject, '…');
                        $loop[$k]['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_id'],'#c_'.$row['wr_id']);
                        $loop[$k]['is_cmt'] = true;
                    } else {
                        $loop[$k]['wr_subject'] = conv_subject($row['wr_subject'], $cut_subject, '…');
                        $loop[$k]['href'] = get_eyoom_pretty_url($row['bo_table'],$row['wr_id']);
                    }

                    /**
                     * 내용 출력
                     */
                    if ($el_item[$i]['li_content'] == 'y') {
                        $loop[$k]['wr_content'] = preg_replace("/(\\n|\\r)/",'',stripslashes(htmlspecialchars_decode($row['wr_content'])));
                    }

                    /**
                     * NEW 표시
                     */
                    $loop[$k]['new'] = false;
                    if ($loop[$k]['wr_datetime'] >= $new_date) {
                        $loop[$k]['new'] = true;
                    }

                    /**
                     * 권한 체크
                     */
                    $loop[$k]['is_auth'] = true;
                    if ($member['mb_level'] < $row['bo_list_level']) {
                        $loop[$k]['wr_subject'] = '<span class=\'blind-subj\'>권한이 제한된 게시물입니다.</span>';
                        $loop[$k]['is_auth'] = false;
                    }

                    /**
                     * 비밀글 처리
                     */
                    $loop[$k]['is_secret'] = false;
                    if (preg_match('/secret/',$row['wr_option']) && (($is_member && $member['mb_id']!=$row['mb_id']) || !$is_member)) {
                        if (!$is_admin) {
                            $loop[$k]['wr_subject'] = '비밀글입니다.';
                        }
                        $loop[$k]['is_secret'] = true;
                    }

                    /**
                     * 익명글 처리
                     */
                    $loop[$k]['is_anonymous'] = false;
                    if ($row['wr_anonymous'] == '1' || in_array($row['bo_table'], $anonymous_table)) {
                        $loop[$k]['is_anonymous'] = true;
                        $loop[$k]['mb_photo'] = '';
                        $loop[$k]['mb_id'] = 'anonymous';
                        $loop[$k]['wr_name'] = $eyoom['anonymous_title'];
                        $loop[$k]['email'] = '';
                        $loop[$k]['homepage'] = '';
                        $loop[$k]['gnu_level'] = '';
                        $loop[$k]['gnu_icon'] = '';
                        $loop[$k]['eyoom_icon'] = '';
                        $loop[$k]['lv_gnu_name'] = '';
                        $loop[$k]['lv_name'] = '';
                    }

                    /**
                     * 블라인드 처리
                     */
                    $loop[$k]['is_blind'] = false;
                    $eb_4 = $eb->mb_unserialize($row['eb_4']);
                    if(!$eb_4) $eb_4 = array();
                    if($eb_4['yc_blind'] == 'y') {
                        if (!$is_admin) {
                            $loop[$k]['wr_subject'] = '<span class=\'blind-subj\'>이 게시물은 블라인드 처리된 글입니다.</span>';
                        }
                        $loop[$k]['is_blind'] = true;
                    }

                    /**
                     * 비밀글, 익명글, 블라인드글, 권한처리
                     */
                    if (($loop[$k]['is_secret'] || $loop[$k]['is_blind'] || !$loop[$k]['is_auth']) && !$is_admin) {
                        $loop[$k]['mb_id'] = '';
                        $loop[$k]['mb_nick'] = '';
                        $loop[$k]['wr_name'] = '';
                        $loop[$k]['wr_content'] = '';
                        $loop[$k]['wr_image'] = '';
                        $loop[$k]['href'] = '#';
                    } else {
                        /**
                         * 프로필 포토
                         */
                        if ($el_item[$i]['li_photo'] == 'y' && !$loop[$k]['is_anonymous']) {
                            $loop[$k]['mb_photo'] = $eb->mb_photo($row['mb_id'], 'icon');
                        }

                        /**
                         * 게시물에 동영상이 있는지 결정
                         */
                        $video = $eb->mb_unserialize($row['eb_4']);
                        $loop[$k]['is_video'] = $video['is_video'];

                        /**
                         * 썸네일 이미지가 없을 경우, 동영상 썸네일을 출력
                         */
                        if ($el_item[$i]['li_img_view'] == 'y' && !$loop[$k]['wr_image']) {
                            $loop[$k]['wr_image'] = $video['thumb_src'];
                        }

                        /**
                         * 별점기능
                         */
                        if($el_item[$i]['li_use_star'] == 'y') {
                            $rating = $eb->get_star_rating($eb_4);
                            $loop[$k]['star'] = $rating['star'];
                        }

                        /**
                         * 채택 게시판용
                         */
                        $loop[$k]['adopt_cmt_id'] = $eb_4['adopt_cmt_id'];
                    }
                }
            } else {
                /**
                 * latest_row_file 파일이 없다면 캐시파일 생성
                 */
                $latest->make_cache_data($el_code, $theme, $li_no);
            }
        }

        /**
         * EB최신글 기본소스 출력
         */
        if (!$el_item) $el_default = true;

        /**
         * 스킨 출력
         */
        include($eblatest_skin_path.'/eblatest.skin.html.php');
    }
}