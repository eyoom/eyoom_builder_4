<?php
/**
 * @file    inc/admin.sub.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 다중관리자 권한이 있을 경우만 실행
 */
if ((isset($mg_auth) && $mg_auth) || $member['mb_id'] == $config['cf_admin']) {
    ;
} else {
    return;
}

/**
 * menu100 : 환경설정
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('config', $mg_auth)) {
    if (isset($menu['menu100'])) {
        unset($menu['menu100']);
        $menu['menu100'] = array(
            array('100000', '환경설정', G5_ADMIN_URL . '/config_form.php', 'config'),
            array('100100', '기본환경설정', G5_ADMIN_URL . '/config_form.php', 'cf_basic'),
            array('100200', '관리권한설정', G5_ADMIN_URL . '/auth_list.php', 'cf_auth'),
            array('100250', '다중관리자설정', G5_ADMIN_URL . '/multi_manager.php', 'cf_manager'),
            array('100280', '테마설정', G5_ADMIN_URL . '/theme.php', 'cf_theme', 1),
            array('100290', '메뉴설정', G5_ADMIN_URL . '/menu_list.php', 'cf_menu', 1),
            array('100300', '메일 테스트', G5_ADMIN_URL . '/sendmail_test.php', 'cf_mailtest'),
            array('100310', '팝업레이어관리', G5_ADMIN_URL . '/newwinlist.php', 'scf_poplayer'),
            array('100990', '공사중 설정', G5_ADMIN_URL . '/countdown.php', 'cf_countdown'),
            array('100800', '세션파일 일괄삭제', G5_ADMIN_URL . '/session_file_delete.php', 'cf_session', 1),
            array('100900', '캐시파일 일괄삭제', G5_ADMIN_URL . '/cache_file_delete.php', 'cf_cache', 1),
            array('100910', '캡챠파일 일괄삭제', G5_ADMIN_URL . '/captcha_file_delete.php', 'cf_captcha', 1),
            array('100920', '썸네일파일 일괄삭제', G5_ADMIN_URL . '/thumbnail_file_delete.php', 'cf_thumbnail', 1),
            array('100500', 'phpinfo()', G5_ADMIN_URL . '/phpinfo.php', 'cf_phpinfo'),
        );
    
        if (version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) {
            $menu['menu100'][] = array('100510', 'Browscap 업데이트', G5_ADMIN_URL . '/browscap.php', 'cf_browscap');
            $menu['menu100'][] = array('100520', '접속로그 변환', G5_ADMIN_URL . '/browscap_convert.php', 'cf_visit_cnvrt');
        }
    
        $menu['menu100'][] = array('100410', 'DB업그레이드', G5_ADMIN_URL . '/dbupgrade.php', 'db_upgrade');
        $menu['menu100'][] = array('100400', '부가서비스', G5_ADMIN_URL . '/service.php', 'cf_service');
    }
} else {
    unset($menu['menu100']);
}

/**
 * menu200 : 회원관리
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('member', $mg_auth)) {
    if (isset($menu['menu200'])) {
        unset($menu['menu200']);
        $menu['menu200'] = array(
            array('200000', '회원관리', G5_ADMIN_URL . '/member_list.php', 'member'),
            array('200100', '회원관리', G5_ADMIN_URL . '/member_list.php', 'mb_list'),
            array('200150', '상담신청관리', G5_ADMIN_URL . '/counsel_list.php', 'cs_list'),
            array('200300', '회원메일발송', G5_ADMIN_URL . '/mail_list.php', 'mb_mail'),
            array('200400', '회원로그인기록', G5_ADMIN_URL . '/login_history.php', 'mb_login'),
            array('200800', '접속자집계', G5_ADMIN_URL . '/visit_list.php', 'mb_visit', 1),
            array('200810', '접속자검색', G5_ADMIN_URL . '/visit_search.php', 'mb_search', 1),
            array('200820', '접속자로그삭제', G5_ADMIN_URL . '/visit_delete.php', 'mb_delete', 1),
            array('200710', '이윰레벨설정', G5_ADMIN_URL . '/level_config.php', 'eyb_level'),
            array('200200', '포인트관리', G5_ADMIN_URL . '/point_list.php', 'mb_point'),
            array('200990', '포인트 압축하기', G5_ADMIN_URL . '/point_compress.php', 'mb_point_compress'),
            array('200900', '투표관리', G5_ADMIN_URL . '/poll_list.php', 'mb_poll')
        );
    }
} else {
    unset($menu['menu200']);
}

/**
 * menu300 : 게시판관리
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('board', $mg_auth)) {
    if (isset($menu['menu300'])) {
        unset($menu['menu300']);
        $menu['menu300'] = array(
            array('300000', '게시판관리', G5_ADMIN_URL . '/board_list.php', 'board'),
            array('300100', '게시판관리', G5_ADMIN_URL . '/board_list.php', 'bbs_board'),
            array('300200', '게시판그룹관리', G5_ADMIN_URL . '/boardgroup_list.php', 'bbs_group'),
            array('300120', '게시물통합관리', G5_ADMIN_URL . '/bbs_list.php', 'bbs_list'),
            array('300900', '상단고정게시물관리', G5_ADMIN_URL . '/wrfixed_list.php', 'wrfixed_list'),
            array('300300', '인기검색어관리', G5_ADMIN_URL . '/popular_list.php', 'bbs_poplist', 1),
            array('300400', '인기검색어순위', G5_ADMIN_URL . '/popular_rank.php', 'bbs_poprank', 1),
            array('300500', '1:1문의설정', G5_ADMIN_URL . '/qa_config.php', 'qa'),
            array('300600', '내용관리', G5_ADMIN_URL . '/contentlist.php', 'scf_contents', 1),
            array('300700', 'FAQ관리', G5_ADMIN_URL . '/faqmasterlist.php', 'scf_faq', 1),
            array('300820', '글,댓글 현황', G5_ADMIN_URL . '/write_count.php', 'scf_write_count'),
            array('300710', '태그관리', G5_ADMIN_URL . '/tag_list.php', 'bbs_tag')
        );
    }
} else {
    unset($menu['menu300']);
}

/**
 * menu330 : 웹마스터 도구
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('seo', $mg_auth)) {
    if (isset($menu['menu330'])) {
        unset($menu['menu330']);
        $menu['menu330'] = array(
            array('330000', '검색엔진최적화', G5_ADMIN_URL . '/meta_seo.php', 'seo_meta'),
            array('330100', '메타태그관리', G5_ADMIN_URL . '/meta_seo.php', 'seo_meta'),
            // array('330200', 'Sitemap.xml', G5_ADMIN_URL . '/sitemap.php', 'seo_sitemap'),
            // array('330300', 'RSS피드', G5_ADMIN_URL . '/rss_feed.php', 'seo_ress'),
        );
    }
} else {
    unset($menu['menu330']);
}

/**
 * menu350 : 소모임관리
 */
if (isset($somo) && ($member['mb_id'] == $config['cf_admin'] || in_array('somoim', $mg_auth))) {
    if ($menu['menu350']) {
        unset($menu['menu350']);
        $menu['menu350'] = array(
            array('350000', '소모임 관리', G5_ADMIN_URL . '/config_form.php', 'somoim'),
            array('350100', '소모임 기본설정', G5_ADMIN_URL . '/config_form.php', 'somo_config'),
            array('350200', '정식 소모임 리스트', G5_ADMIN_URL . '/somo_list.php', 'somo_list'),
            array('350300', '미개설 신청 리스트', G5_ADMIN_URL . '/somo_apply.php', 'somo_apply'),
        );
    }
} else {
    unset($menu['menu350']);
}

/**
 * menu400 : 쇼핑몰관리
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('shop', $mg_auth)) {
    if (defined('G5_USE_SHOP') && G5_USE_SHOP && isset($menu['menu400'])) {
        unset($menu['menu400']);
        $menu['menu400'] = array(
            array('400000', '쇼핑몰관리', G5_ADMIN_URL . '/shop_admin/', 'shop_config'),
            array('400010', '쇼핑몰현황', G5_ADMIN_URL . '/shop_admin/', 'shop_index'),
            array('400100', '쇼핑몰설정', G5_ADMIN_URL . '/shop_admin/configform.php', 'scf_config'),
            array('400400', '주문내역', G5_ADMIN_URL . '/shop_admin/orderlist.php', 'scf_order', 1),
            array('400440', '개인결제관리', G5_ADMIN_URL . '/shop_admin/personalpaylist.php', 'scf_personalpay', 1),
            array('400200', '분류관리', G5_ADMIN_URL . '/shop_admin/categorylist.php', 'scf_cate'),
            array('400300', '상품관리', G5_ADMIN_URL . '/shop_admin/itemlist.php', 'scf_item'),
            array('400350', '브랜드관리', G5_ADMIN_URL . '/brandlist.php', 'brandlist'),
            array('400660', '상품문의', G5_ADMIN_URL . '/shop_admin/itemqalist.php', 'scf_item_qna'),
            array('400650', '사용후기', G5_ADMIN_URL . '/shop_admin/itemuselist.php', 'scf_ps'),
            array('400620', '상품재고관리', G5_ADMIN_URL . '/shop_admin/itemstocklist.php', 'scf_item_stock'),
            array('400610', '상품유형관리', G5_ADMIN_URL . '/shop_admin/itemtypelist.php', 'scf_item_type'),
            array('400500', '상품옵션재고관리', G5_ADMIN_URL . '/shop_admin/optionstocklist.php', 'scf_item_option'),
            array('400800', '쿠폰관리', G5_ADMIN_URL . '/shop_admin/couponlist.php', 'scf_coupon'),
            array('400810', '쿠폰존관리', G5_ADMIN_URL . '/shop_admin/couponzonelist.php', 'scf_coupon_zone'),
            array('400750', '추가배송비관리', G5_ADMIN_URL . '/shop_admin/sendcostlist.php', 'scf_sendcost', 1),
            array('400410', '미완료주문', G5_ADMIN_URL . '/shop_admin/inorderlist.php', 'scf_inorder', 1),
        );
    }
} else {
    unset($menu['menu400']);
}

/**
 * menu500 : 쇼핑몰현황/기타
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('shopetc', $mg_auth)) {
    if (defined('G5_USE_SHOP') && G5_USE_SHOP && isset($menu['menu500'])) {
        unset($menu['menu500']);
        $menu['menu500'] = array(
            array('500000', '쇼핑몰현황/기타', G5_ADMIN_URL . '/shop_admin/itemsellrank.php', 'shop_stats'),
            array('500110', '매출현황', G5_ADMIN_URL . '/shop_admin/sale1.php', 'sst_order_stats'),
            array('500100', '상품판매순위', G5_ADMIN_URL . '/shop_admin/itemsellrank.php', 'sst_rank'),
            array('500200', '구매랭킹', G5_ADMIN_URL . '/shop_admin/orderrank.php', 'ord_rank'),
            array('500120', '주문내역출력', G5_ADMIN_URL . '/shop_admin/orderprint.php', 'sst_print_order', 1),
            array('500400', '재입고SMS알림', G5_ADMIN_URL . '/shop_admin/itemstocksms.php', 'sst_stock_sms', 1),
            array('500300', '이벤트관리', G5_ADMIN_URL . '/shop_admin/itemevent.php', 'scf_event'),
            array('500310', '이벤트일괄처리', G5_ADMIN_URL . '/shop_admin/itemeventlist.php', 'scf_event_mng'),
            array('500500', '배너관리', G5_ADMIN_URL . '/shop_admin/bannerlist.php', 'scf_banner', 1),
            array('500140', '보관함현황', G5_ADMIN_URL . '/shop_admin/wishlist.php', 'sst_wish'),
            array('500210', '가격비교사이트', G5_ADMIN_URL . '/shop_admin/price.php', 'sst_compare', 1)
        );
    }
} else {
    unset($menu['menu500']);
}

/**
 * menu900 : SMS 관리
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('sms', $mg_auth)) {
    if (isset($menu['menu900'])) {
        unset($menu['menu900']);
        $menu["menu900"] = array(
            array('900000', 'SMS 관리', G5_SMS5_ADMIN_URL . '/config.php', 'sms5'),
            array('900100', 'SMS 기본설정', G5_SMS5_ADMIN_URL . '/config.php', 'sms5_config'),
            array('900200', '회원정보업데이트', G5_SMS5_ADMIN_URL . '/member_update.php', 'sms5_mb_update'),
            array('900300', '문자 보내기', G5_SMS5_ADMIN_URL . '/sms_write.php', 'sms_write'),
            array('900400', '전송내역-건별', G5_SMS5_ADMIN_URL . '/history_list.php', 'sms_history', 1),
            array('900410', '전송내역-번호별', G5_SMS5_ADMIN_URL . '/history_num.php', 'sms_history_num', 1),
            array('900500', '이모티콘 그룹', G5_SMS5_ADMIN_URL . '/form_group.php', 'emoticon_group'),
            array('900600', '이모티콘 관리', G5_SMS5_ADMIN_URL . '/form_list.php', 'emoticon_list'),
            array('900700', '휴대폰번호 그룹', G5_SMS5_ADMIN_URL . '/num_group.php', 'hp_group', 1),
            array('900800', '휴대폰번호 관리', G5_SMS5_ADMIN_URL . '/num_book.php', 'hp_manage', 1),
            array('900900', '휴대폰번호 파일', G5_SMS5_ADMIN_URL . '/num_book_file.php', 'hp_file', 1)
        );
    }
} else {
    unset($menu['menu900']);
}

/**
 * menu999 : 테마설정관리
 */
if ($member['mb_id'] == $config['cf_admin'] || in_array('theme', $mg_auth)) {
    if (isset($menu['menu999'])) {
        unset($menu['menu999']);
        $menu['menu999'] = array (
            array('999000', '테마설정관리', G5_ADMIN_URL . '/eyoom_admin/theme_list.php', 'eyoom_theme'),
            array('999100', '테마관리', G5_ADMIN_URL . '/eyoom_admin/theme_list.php', 'eyb_theme'),
            array('999110', '기본정보', G5_ADMIN_URL . '/eyoom_admin/biz_info.php', 'eyb_bizinfo'),
            array('999120', '테마환경설정', G5_ADMIN_URL . '/eyoom_admin/config_form.php', 'eyb_config'),
            array('999300', '홈페이지메뉴설정', G5_ADMIN_URL . '/eyoom_admin/menu_list.php', 'eyb_menu'),
            array('999400', '쇼핑몰메뉴설정', G5_ADMIN_URL . '/eyoom_admin/shopmenu_list.php', 'eyb_shopmenu'),
            array('999500', 'EB상품추출관리', G5_ADMIN_URL . '/eyoom_admin/ebgoods_list.php', 'eyb_ebgoods'),
            array('999600', 'EB슬라이더관리', G5_ADMIN_URL . '/eyoom_admin/ebslider_list.php', 'eyb_ebslider'),
            array('999610', 'EB콘텐츠관리', G5_ADMIN_URL . '/eyoom_admin/ebcontents.php', 'eyb_ebcontents'),
            array('999620', 'EB최신글관리', G5_ADMIN_URL . '/eyoom_admin/eblatest_list.php', 'eyb_eblatest'),
            array('999630', 'EB배너관리', G5_ADMIN_URL . '/eyoom_admin/ebbanner_list.php', 'eyb_ebbanner')
        );
    }
} else {
    unset($menu['menu999']);
}