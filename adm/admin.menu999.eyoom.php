<?php
/**
 * 이윰빌더를 사용하지 않는다면
 */
if ($use_eyoom_builder === false) return;

/**
 * 이윰테마관리 메뉴
 */
if ((!isset($config['cf_eyoom_admin']) || $config['cf_eyoom_admin'] == 'y')) {
    /**
     * 최고관리자 메뉴
     */
    if ($is_admin == 'super' || $is_auth) {
        $menu['menu999'] = array (
            array('999000', '테마설정관리', G5_ADMIN_URL.'/eyoom_admin/theme_list.php', 'eyoom_theme'),
            array('999100', '테마관리', G5_ADMIN_URL.'/eyoom_admin/theme_list.php', 'eyb_theme'),
            array('999110', '기본정보', G5_ADMIN_URL.'/eyoom_admin/biz_info.php', 'eyb_bizinfo'),
            array('999120', '테마환경설정', G5_ADMIN_URL.'/eyoom_admin/config_form.php', 'eyb_config'),
            array('999200', '게시판 추가설정', G5_ADMIN_URL.'/eyoom_admin/board_list.php', 'eyb_board'),
            array('999300', '홈페이지메뉴설정', G5_ADMIN_URL.'/eyoom_admin/menu_list.php', 'eyb_menu'),
            array('999400', '쇼핑몰메뉴설정', G5_ADMIN_URL.'/eyoom_admin/shopmenu_list.php', 'eyb_shopmenu'),
            array('999500', 'EB상품추출관리', G5_ADMIN_URL.'/eyoom_admin/ebgoods_list.php', 'eyb_ebgoods'),
            array('999600', 'EB슬라이더관리', G5_ADMIN_URL.'/eyoom_admin/ebslider_list.php', 'eyb_ebslider'),
            array('999610', 'EB콘텐츠관리', G5_ADMIN_URL.'/eyoom_admin/ebcontents.php', 'eyb_ebcontents'),
            array('999620', 'EB최신글관리', G5_ADMIN_URL.'/eyoom_admin/eblatest_list.php', 'eyb_eblatest'),
            array('999630', 'EB배너관리', G5_ADMIN_URL.'/eyoom_admin/ebbanner_list.php', 'eyb_ebbanner'),
            array('999700', '태그관리', G5_ADMIN_URL.'/eyoom_admin/tag_list.php', 'eyb_tag'),
            array('999800', '이윰레벨 환경설정', G5_ADMIN_URL.'/eyoom_admin/level_config.php', 'eyb_level')
        );

        /**
         * 환경설정 추가메뉴
         */
        array_push ($menu['menu100'],
            array('100990', '공사중 설정', G5_ADMIN_URL.'/countdown.php', 'cf_countdown')
        );

        /**
         * 회원관리 추가메뉴
         */
        array_push ($menu['menu200'],
            array('200990', '포인트 압축하기', G5_ADMIN_URL.'/point_compress.php', 'mb_point_compress')
        );

        /**
         * 상단고정 게시물 추가메뉴
         */
        array_push ($menu['menu300'],
            array('300900', '상단고정 게시물 관리', G5_ADMIN_URL.'/wrfixed_list.php', 'wrfixed_list')
        );

        /**
         * 쇼핑몰 브랜드관리
         */
        if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
            array_push ($menu['menu400'], 
                array('400350', '브랜드관리', G5_ADMIN_URL.'/brandlist.php', 'brandlist')
            );
        }

    } else {
        /**
         * 그외 고객관리자 메뉴
         */
        unset($menu); // 메뉴재설정을 위해 기존 메뉴 리셋
    }

} else {
    /**
     * 최고관리자가 아니라면 이윰관리자로 자동전환
     */
    if ($member['mb_id'] != $config['cf_admin'] && $is_admin == 'super') {
        $sql = "update `{$g5['config_table']}` set cf_eyoom_admin = 'y' ";
        sql_query($sql, false);
        goto_url(G5_ADMIN_URL, false);
    } else {
        $menu['menu999'] = array (
            array('999000', '이윰관리자모드', G5_ADMIN_URL.'/admin.mode.php?to=eyoom', 'eyoom_admin'),
            array('999100', '이윰관리자 바로가기', G5_ADMIN_URL.'/admin.mode.php?to=eyoom', 'eyoom_admin')
        );
    }
}