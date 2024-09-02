<?php
/**
 * file : /eyoom/inc/skin.path.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * Eyoom Core 스킨경로
 */
$board_skin_path    = EYOOM_CORE_PATH.'/board';
$member_skin_path   = EYOOM_CORE_PATH.'/member';
$new_skin_path      = EYOOM_CORE_PATH.'/new';
$best_skin_path     = EYOOM_CORE_PATH.'/best';
$search_skin_path   = EYOOM_CORE_PATH.'/search';
$connect_skin_path  = EYOOM_CORE_PATH.'/connect';
$faq_skin_path      = EYOOM_CORE_PATH.'/faq';
$qa_skin_path       = EYOOM_CORE_PATH.'/qa';
$respond_skin_path  = EYOOM_CORE_PATH.'/respond';
$mypage_skin_path   = EYOOM_CORE_PATH.'/mypage';
$page_skin_path     = EYOOM_CORE_PATH.'/page';
$tag_skin_path      = EYOOM_CORE_PATH.'/tag';
$shop_skin_path     = EYOOM_CORE_PATH.'/shop';

/**
 * Eyoom Skin 경로
 */
if (G5_IS_MOBILE) {
    $eyoom_skin_path['board']    = $thema->get_skin_path('board', $eyoom_board['bo_skin']);
    $eyoom_skin_url['board']     = $thema->get_skin_url('board', $eyoom_board['bo_skin']);
    $eyoom_skin_path['member']   = $thema->get_skin_path('member', $eyoom['mobile_member_skin']);
    $eyoom_skin_url['member']    = $thema->get_skin_url('member', $eyoom['mobile_member_skin']);
    $eyoom_skin_path['mypage']   = $thema->get_skin_path('mypage', $eyoom['mobile_mypage_skin']);
    $eyoom_skin_url['mypage']    = $thema->get_skin_url('mypage',  $eyoom['mobile_mypage_skin']);
    $eyoom_skin_path['new']      = $thema->get_skin_path('new', $eyoom['mobile_new_skin']);
    $eyoom_skin_url['new']       = $thema->get_skin_url('new', $eyoom['mobile_new_skin']);
    $eyoom_skin_path['best']     = $thema->get_skin_path('best', $eyoom['mobile_best_skin']);
    $eyoom_skin_url['best']      = $thema->get_skin_url('best', $eyoom['mobile_best_skin']);
    $eyoom_skin_path['search']   = $thema->get_skin_path('search', $eyoom['mobile_search_skin']);
    $eyoom_skin_url['search']    = $thema->get_skin_url('search', $eyoom['mobile_search_skin']);
    $eyoom_skin_path['connect']  = $thema->get_skin_path('connect', $eyoom['mobile_connect_skin']);
    $eyoom_skin_url['connect']   = $thema->get_skin_url('connect', $eyoom['mobile_connect_skin']);
    $eyoom_skin_path['faq']      = $thema->get_skin_path('faq', $eyoom['mobile_faq_skin']);
    $eyoom_skin_url['faq']       = $thema->get_skin_url('faq', $eyoom['mobile_faq_skin']);
    $eyoom_skin_path['qa']       = $thema->get_skin_path('qa', $eyoom['mobile_qa_skin']);
    $eyoom_skin_url['qa']        = $thema->get_skin_url('qa', $eyoom['mobile_qa_skin']);
    $eyoom_skin_path['newwin']   = $thema->get_skin_path('newwin', $eyoom['mobile_newwin_skin']);
    $eyoom_skin_url['newwin']    = $thema->get_skin_url('newwin', $eyoom['mobile_newwin_skin']);
    $eyoom_skin_path['tag']      = $thema->get_skin_path('tag', $eyoom['mobile_tag_skin']);
    $eyoom_skin_url['tag']       = $thema->get_skin_url('tag', $eyoom['mobile_tag_skin']);
    $eyoom_skin_path['signature']= $thema->get_skin_path('signature', $eyoom['mobile_signature_skin']);
    $eyoom_skin_url['signature'] = $thema->get_skin_url('signature', $eyoom['mobile_signature_skin']);
    $eyoom_skin_path['bbspoll']  = $thema->get_skin_path('bbspoll', $eyoom['mobile_bbspoll_skin']);
    $eyoom_skin_url['bbspoll']   = $thema->get_skin_url('bbspoll', $eyoom['mobile_bbspoll_skin']);
} else {
    $eyoom_skin_path['board']    = $thema->get_skin_path('board', $eyoom_board['bo_skin']);
    $eyoom_skin_url['board']     = $thema->get_skin_url('board', $eyoom_board['bo_skin']);
    $eyoom_skin_path['member']   = $thema->get_skin_path('member', $eyoom['member_skin']);
    $eyoom_skin_url['member']    = $thema->get_skin_url('member', $eyoom['member_skin']);
    $eyoom_skin_path['mypage']   = $thema->get_skin_path('mypage', $eyoom['mypage_skin']);
    $eyoom_skin_url['mypage']    = $thema->get_skin_url('mypage', $eyoom['mypage_skin']);
    $eyoom_skin_path['new']      = $thema->get_skin_path('new', $eyoom['new_skin']);
    $eyoom_skin_url['new']       = $thema->get_skin_url('new', $eyoom['new_skin']);
    $eyoom_skin_path['best']     = $thema->get_skin_path('best', $eyoom['best_skin']);
    $eyoom_skin_url['best']      = $thema->get_skin_url('best', $eyoom['best_skin']);
    $eyoom_skin_path['search']   = $thema->get_skin_path('search', $eyoom['search_skin']);
    $eyoom_skin_url['search']    = $thema->get_skin_url('search', $eyoom['search_skin']);
    $eyoom_skin_path['connect']  = $thema->get_skin_path('connect', $eyoom['connect_skin']);
    $eyoom_skin_url['connect']   = $thema->get_skin_url('connect', $eyoom['connect_skin']);
    $eyoom_skin_path['faq']      = $thema->get_skin_path('faq', $eyoom['faq_skin']);
    $eyoom_skin_url['faq']       = $thema->get_skin_url('faq', $eyoom['faq_skin']);
    $eyoom_skin_path['qa']       = $thema->get_skin_path('qa', $eyoom['qa_skin']);
    $eyoom_skin_url['qa']        = $thema->get_skin_url('qa', $eyoom['qa_skin']);
    $eyoom_skin_path['newwin']   = $thema->get_skin_path('newwin', $eyoom['newwin_skin']);
    $eyoom_skin_url['newwin']    = $thema->get_skin_url('newwin', $eyoom['newwin_skin']);
    $eyoom_skin_path['tag']      = $thema->get_skin_path('tag', $eyoom['tag_skin']);
    $eyoom_skin_url['tag']       = $thema->get_skin_url('tag', $eyoom['tag_skin']);
    $eyoom_skin_path['signature']= $thema->get_skin_path('signature', $eyoom['signature_skin']);
    $eyoom_skin_url['signature'] = $thema->get_skin_url('signature', $eyoom['signature_skin']);
    $eyoom_skin_path['bbspoll']  = $thema->get_skin_path('bbspoll', $eyoom['bbspoll_skin']);
    $eyoom_skin_url['bbspoll']   = $thema->get_skin_url('bbspoll', $eyoom['bbspoll_skin']);
}

/**
 * GNUBOARD Skin 사용여부 체크
 */
if ($eyoom_board['use_gnu_skin'] == 'y') { // Eyoom 설정에서 그누보드 사용여부 체크
    if (G5_IS_MOBILE) {
        $board_skin_path    = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/board/'.$board['bo_mobile_skin'];
        $board_skin_url     = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/board/'.$board['bo_mobile_skin'];
    } else {
        $board_skin_path    = G5_SKIN_PATH.'/board/'.$board['bo_skin'];
        $board_skin_url     = G5_SKIN_URL .'/board/'.$board['bo_skin'];
    }
}
if ($eyoom['use_gnu_member'] == 'y') {
    if (G5_IS_MOBILE) {
        $member_skin_path   = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/member/'.$config['cf_mobile_member_skin'];
        $member_skin_url    = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/member/'.$config['cf_mobile_member_skin'];
    } else {
        $member_skin_path   = G5_SKIN_PATH.'/member/'.$config['cf_member_skin'];
        $member_skin_url    = G5_SKIN_URL .'/member/'.$config['cf_member_skin'];
    }
}
if ($eyoom['use_gnu_new'] == 'y') {
    if (G5_IS_MOBILE) {
        $new_skin_path      = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/new/'.$config['cf_mobile_new_skin'];
        $new_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/new/'.$config['cf_mobile_new_skin'];
    } else {
        $new_skin_path      = G5_SKIN_PATH.'/new/'.$config['cf_new_skin'];
        $new_skin_url       = G5_SKIN_URL .'/new/'.$config['cf_new_skin'];
    }
}
if ($eyoom['use_gnu_search'] == 'y') {
    if (G5_IS_MOBILE) {
        $search_skin_path   = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/search/'.$config['cf_mobile_search_skin'];
        $search_skin_url    = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/search/'.$config['cf_mobile_search_skin'];
    } else {
        $search_skin_path   = G5_SKIN_PATH.'/search/'.$config['cf_search_skin'];
        $search_skin_url    = G5_SKIN_URL .'/search/'.$config['cf_search_skin'];
    }
}
if ($eyoom['use_gnu_connect'] == 'y') {
    if (G5_IS_MOBILE) {
        $connect_skin_path  = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/connect/'.$config['cf_mobile_connect_skin'];
        $connect_skin_url   = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/connect/'.$config['cf_mobile_connect_skin'];
    } else {
        $connect_skin_path  = G5_SKIN_PATH.'/connect/'.$config['cf_connect_skin'];
        $connect_skin_url   = G5_SKIN_URL .'/connect/'.$config['cf_connect_skin'];
    }
}
if ($eyoom['use_gnu_faq'] == 'y') {
    if (G5_IS_MOBILE) {
        $faq_skin_path      = G5_MOBILE_PATH .'/'.G5_SKIN_DIR.'/faq/'.$config['cf_mobile_faq_skin'];
        $faq_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/faq/'.$config['cf_mobile_faq_skin'];
    } else {
        $faq_skin_path      = G5_SKIN_PATH.'/faq/'.$config['cf_faq_skin'];
        $faq_skin_url       = G5_SKIN_URL.'/faq/'.$config['cf_faq_skin'];
    }
}
if ($eyoom['use_gnu_qa'] == 'y') {
    if (G5_IS_MOBILE) {
        $qa_skin_path      = G5_MOBILE_PATH .'/'.G5_SKIN_DIR.'/qa/'.$qaconfig['qa_skin'];
        $qa_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/qa/'.$qaconfig['qa_skin'];
    } else {
        $qa_skin_path      = G5_SKIN_PATH.'/qa/'.$qaconfig['qa_skin'];
        $qa_skin_url       = G5_SKIN_URL.'/qa/'.$qaconfig['qa_skin'];
    }
}