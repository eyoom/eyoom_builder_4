<?php
/**
 * lib file : /eyoom/lib/outlogin.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_outlogin function
 * 최신글 추출
 */
function eb_outlogin ($skin_dir = 'basic') {
    global $g5, $theme, $shop_theme, $config, $member, $eyoom, $urlencode, $is_admin, $is_member;
    global $memo_not_read, $respond_not_read, $is_auth, $eyoomer, $eb, $levelset;

    /**
     * 숨기기 처리
     */
    if ($eyoom['use_outlogin_skin'] == 'n' || $member['mb_level'] < $eyoom['view_level_outlogin']) return;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * 닉네임 정보
     */
    if (array_key_exists('mb_nick', $member)) {
        $nick  = get_text(cut_str($member['mb_nick'], $config['cf_cut_name']));
    }

    /**
     * 포인트 정보
     */
    if (array_key_exists('mb_point', $member)) {
        $point = number_format($member['mb_point']);
    }

    /**
     * 아웃로그인 스킨폴더
     */
    $skin_dir = !$skin_dir ? 'basic': $skin_dir;
    $outlogin_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/outlogin/'.$skin_dir;
    $outlogin_skin_url = str_replace(G5_PATH, G5_URL, $outlogin_skin_path);

    /**
     * 경로 지정
     */
    $outlogin_url = login_url($urlencode);
    $outlogin_action_url = G5_HTTPS_BBS_URL.'/login_check.php';

    if ($is_member) {
        /**
         * 아웃로그인 스킨 - 로그인 상태
         */
        $outlogin_skin_file = 'outlogin.skin.2.html.php';

        /**
         * Eyoom Member 추가
         */
        if (!$eyoomer['mb_id']) {
            sql_query(" insert into {$g5['eyoom_member']} set mb_id = '{$member['mb_id']}' ");
        }

        $mb_scrap_cnt = isset($member['mb_scrap_cnt']) ? (int) $member['mb_scrap_cnt'] : '';

        /**
         * 프로필 사진 정보
         */
        $profile_photo = $eb->mb_photo($member['mb_id']);

        /**
         * 소셜정보
         */
        $eyoomer['cnt_friends']   = $eb->count_friends($member['mb_id']);
        $eyoomer['cnt_follower']  = $eb->count_follower($member['mb_id']);
        $eyoomer['cnt_following'] = $eb->count_following($member['mb_id']);

        /**
         * Eyoom 레벨
         */
        $lvinfo = $eb->eyoom_level_info($member);
        $lvset = $member['mb_level'] . '|' . $eyoomer['level'];
        $eyoom_level = $eb->level_info($lvset);

    } else {
        /**
         * 아웃로그인 스킨 - 로그아웃 상태
         */
        $outlogin_skin_file = 'outlogin.skin.1.html.php';
    }

    /**
     * 스킨파일 출력
     */
    ob_start();
    include_once ($outlogin_skin_path.'/'.$outlogin_skin_file);
    $content = ob_get_contents();
    ob_end_clean();

    return run_replace('outlogin_content', $content, $is_auth, $outlogin_url, $outlogin_action_url);
}