<?php
/**
 * @file    /adm/eyoom_admin/core/config/config_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100100";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=config&pid=config_form_update&smode=1";

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

// https://github.com/gnuboard/gnuboard5/issues/296 이슈처리
$sql = " select * from {$g5['config_table']} limit 1";
$config = sql_fetch($sql);

if (!isset($config['cf_add_script'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_add_script` TEXT NOT NULL AFTER `cf_admin_email_name` ",
        true
    );
}

if (!isset($config['cf_mobile_new_skin'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_mobile_new_skin` VARCHAR(255) NOT NULL AFTER `cf_memo_send_point`,
                    ADD `cf_mobile_search_skin` VARCHAR(255) NOT NULL AFTER `cf_mobile_new_skin`,
                    ADD `cf_mobile_connect_skin` VARCHAR(255) NOT NULL AFTER `cf_mobile_search_skin`,
                    ADD `cf_mobile_member_skin` VARCHAR(255) NOT NULL AFTER `cf_mobile_connect_skin` ",
        true
    );
}

if (isset($config['cf_gcaptcha_mp3'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    CHANGE `cf_gcaptcha_mp3` `cf_captcha_mp3` VARCHAR(255) NOT NULL DEFAULT '' ",
        true
    );
} elseif (!isset($config['cf_captcha_mp3'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_captcha_mp3` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_mobile_member_skin` ",
        true
    );
}

if (!isset($config['cf_editor'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_editor` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_captcha_mp3` ",
        true
    );
}

if (!isset($config['cf_googl_shorturl_apikey'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_googl_shorturl_apikey` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_captcha_mp3` ",
        true
    );
}

if (!isset($config['cf_mobile_pages'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_mobile_pages` INT(11) NOT NULL DEFAULT '0' AFTER `cf_write_pages` ",
        true
    );
    sql_query(" UPDATE `{$g5['config_table']}` SET cf_mobile_pages = '5' ", true);
}

if (!isset($config['cf_facebook_appid'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_facebook_appid` VARCHAR(255) NOT NULL AFTER `cf_googl_shorturl_apikey`,
                    ADD `cf_facebook_secret` VARCHAR(255) NOT NULL AFTER `cf_facebook_appid`,
                    ADD `cf_twitter_key` VARCHAR(255) NOT NULL AFTER `cf_facebook_secret`,
                    ADD `cf_twitter_secret` VARCHAR(255) NOT NULL AFTER `cf_twitter_key` ",
        true
    );
}

// uniqid 테이블이 없을 경우 생성
if (!sql_query(" DESC {$g5['uniqid_table']} ", false)) {
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['uniqid_table']}` (
                  `uq_id` bigint(20) unsigned NOT NULL,
                  `uq_ip` varchar(255) NOT NULL,
                  PRIMARY KEY (`uq_id`)
                ) ",
        false
    );
}

if (!sql_query(" SELECT uq_ip from {$g5['uniqid_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE {$g5['uniqid_table']} ADD `uq_ip` VARCHAR(255) NOT NULL ");
}

// 임시저장 테이블이 없을 경우 생성
if (!sql_query(" DESC {$g5['autosave_table']} ", false)) {
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['autosave_table']}` (
                  `as_id` int(11) NOT NULL AUTO_INCREMENT,
                  `mb_id` varchar(20) NOT NULL,
                  `as_uid` bigint(20) unsigned NOT NULL,
                  `as_subject` varchar(255) NOT NULL,
                  `as_content` text NOT NULL,
                  `as_datetime` datetime NOT NULL,
                  PRIMARY KEY (`as_id`),
                  UNIQUE KEY `as_uid` (`as_uid`),
                  KEY `mb_id` (`mb_id`)
                ) ",
        false
    );
}

if (!isset($config['cf_admin_email'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_admin_email` VARCHAR(255) NOT NULL AFTER `cf_admin` ",
        true
    );
}

if (!isset($config['cf_admin_email_name'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_admin_email_name` VARCHAR(255) NOT NULL AFTER `cf_admin_email` ",
        true
    );
}

if (!isset($config['cf_cert_use'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_cert_use` TINYINT(4) NOT NULL DEFAULT '0' AFTER `cf_editor`,
                    ADD `cf_cert_ipin` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_use`,
                    ADD `cf_cert_hp` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_ipin`,
                    ADD `cf_cert_kcb_cd` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_hp`,
                    ADD `cf_cert_kcp_cd` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_kcb_cd`,
                    ADD `cf_cert_limit` INT(11) NOT NULL DEFAULT '0' AFTER `cf_cert_kcp_cd` ",
        true
    );
    sql_query(
        " ALTER TABLE `{$g5['member_table']}`
                    CHANGE `mb_hp_certify` `mb_certify` VARCHAR(20) NOT NULL DEFAULT '' ",
        true
    );
    sql_query(" update {$g5['member_table']} set mb_certify = 'hp' where mb_certify = '1' ");
    sql_query(" update {$g5['member_table']} set mb_certify = '' where mb_certify = '0' ");
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['cert_history_table']}` (
                  `cr_id` int(11) NOT NULL auto_increment,
                  `mb_id` varchar(255) NOT NULL DEFAULT '',
                  `cr_company` varchar(255) NOT NULL DEFAULT '',
                  `cr_method` varchar(255) NOT NULL DEFAULT '',
                  `cr_ip` varchar(255) NOT NULL DEFAULT '',
                  `cr_date` date NOT NULL DEFAULT '0000-00-00',
                  `cr_time` time NOT NULL DEFAULT '00:00:00',
                  PRIMARY KEY (`cr_id`),
                  KEY `mb_id` (`mb_id`)
                )",
        true
    );
}

if (!isset($config['cf_analytics'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_analytics` TEXT NOT NULL AFTER `cf_intercept_ip` ",
        true
    );
}

if (!isset($config['cf_add_meta'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_add_meta` TEXT NOT NULL AFTER `cf_analytics` ",
        true
    );
}

if (!isset($config['cf_syndi_token'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_syndi_token` VARCHAR(255) NOT NULL AFTER `cf_add_meta` ",
        true
    );
}

if (!isset($config['cf_syndi_except'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_syndi_except` TEXT NOT NULL AFTER `cf_syndi_token` ",
        true
    );
}

if (!isset($config['cf_sms_use'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_sms_use` varchar(255) NOT NULL DEFAULT '' AFTER `cf_cert_limit`,
                    ADD `cf_icode_id` varchar(255) NOT NULL DEFAULT '' AFTER `cf_sms_use`,
                    ADD `cf_icode_pw` varchar(255) NOT NULL DEFAULT '' AFTER `cf_icode_id`,
                    ADD `cf_icode_server_ip` varchar(255) NOT NULL DEFAULT '' AFTER `cf_icode_pw`,
                    ADD `cf_icode_server_port` varchar(255) NOT NULL DEFAULT '' AFTER `cf_icode_server_ip` ",
        true
    );
}

if (!isset($config['cf_mobile_page_rows'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_mobile_page_rows` int(11) NOT NULL DEFAULT '0' AFTER `cf_page_rows` ",
        true
    );
}

if (!isset($config['cf_cert_req'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_cert_req` tinyint(4) NOT NULL DEFAULT '0' AFTER `cf_cert_limit` ",
        true
    );
}

if (!isset($config['cf_faq_skin'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_faq_skin` varchar(255) NOT NULL DEFAULT '' AFTER `cf_connect_skin`,
                    ADD `cf_mobile_faq_skin` varchar(255) NOT NULL DEFAULT '' AFTER `cf_mobile_connect_skin` ",
        true
    );
}

// LG유플러스 본인확인 필드 추가
if (!isset($config['cf_lg_mid'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_lg_mid` varchar(255) NOT NULL DEFAULT '' AFTER `cf_cert_kcp_cd`,
                    ADD `cf_lg_mert_key` varchar(255) NOT NULL DEFAULT '' AFTER `cf_lg_mid` ",
        true
    );
}

if (!isset($config['cf_optimize_date'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_optimize_date` date NOT NULL default '0000-00-00' AFTER `cf_popular_del` ",
        true
    );
}

// 카카오톡링크 api 키
if (!isset($config['cf_kakao_js_apikey'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_kakao_js_apikey` varchar(255) NOT NULL DEFAULT '' AFTER `cf_googl_shorturl_apikey` ",
        true
    );
}

// SMS 전송유형 필드 추가
if (!isset($config['cf_sms_type'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_sms_type` varchar(10) NOT NULL DEFAULT '' AFTER `cf_sms_use` ",
        true
    );
}

// 접속자 정보 필드 추가
if (!sql_query(" select vi_browser from {$g5['visit_table']} limit 1 ")) {
    sql_query(
        " ALTER TABLE `{$g5['visit_table']}`
                    ADD `vi_browser` varchar(255) NOT NULL DEFAULT '' AFTER `vi_agent`,
                    ADD `vi_os` varchar(255) NOT NULL DEFAULT '' AFTER `vi_browser`,
                    ADD `vi_device` varchar(255) NOT NULL DEFAULT '' AFTER `vi_os` ",
        true
    );
}

//소셜 로그인 관련 필드 및 구글 리챕챠 필드 추가
if (!isset($config['cf_social_login_use'])) {
    sql_query(
        "ALTER TABLE `{$g5['config_table']}`
                ADD `cf_social_login_use` tinyint(4) NOT NULL DEFAULT '0' AFTER `cf_googl_shorturl_apikey`,
                ADD `cf_google_clientid` varchar(100) NOT NULL DEFAULT '' AFTER `cf_twitter_secret`,
                ADD `cf_google_secret` varchar(100) NOT NULL DEFAULT '' AFTER `cf_google_clientid`,
                ADD `cf_naver_clientid` varchar(100) NOT NULL DEFAULT '' AFTER `cf_google_secret`,
                ADD `cf_naver_secret` varchar(100) NOT NULL DEFAULT '' AFTER `cf_naver_clientid`,
                ADD `cf_kakao_rest_key` varchar(100) NOT NULL DEFAULT '' AFTER `cf_naver_secret`,
                ADD `cf_social_servicelist` varchar(255) NOT NULL DEFAULT '' AFTER `cf_social_login_use`,
                ADD `cf_payco_clientid` varchar(100) NOT NULL DEFAULT '' AFTER `cf_social_servicelist`,
                ADD `cf_payco_secret` varchar(100) NOT NULL DEFAULT '' AFTER `cf_payco_clientid`,
                ADD `cf_captcha` varchar(100) NOT NULL DEFAULT '' AFTER `cf_kakao_js_apikey`,
                ADD `cf_recaptcha_site_key` varchar(100) NOT NULL DEFAULT '' AFTER `cf_captcha`,
                ADD `cf_recaptcha_secret_key` varchar(100) NOT NULL DEFAULT '' AFTER `cf_recaptcha_site_key`
    ",
        true
    );
}

//소셜 로그인 관련 필드 카카오 클라이언트 시크릿 추가
if (!isset($config['cf_kakao_client_secret'])) {
    sql_query(
        "ALTER TABLE `{$g5['config_table']}`
                ADD `cf_kakao_client_secret` varchar(100) NOT NULL DEFAULT '' AFTER `cf_kakao_rest_key`
    ",
        true
    );
}

// 회원 이미지 관련 필드 추가
if (!isset($config['cf_member_img_size'])) {
    sql_query(
        "ALTER TABLE `{$g5['config_table']}`
                ADD `cf_member_img_size` int(11) NOT NULL DEFAULT '0' AFTER `cf_member_icon_height`,
                ADD `cf_member_img_width` int(11) NOT NULL DEFAULT '0' AFTER `cf_member_img_size`,
                ADD `cf_member_img_height` int(11) NOT NULL DEFAULT '0' AFTER `cf_member_img_width`
    ",
        true
    );

    $sql = " update {$g5['config_table']} set cf_member_img_size = 50000, cf_member_img_width = 60, cf_member_img_height = 60 ";
    sql_query($sql, false);

    $config['cf_member_img_size'] = 50000;
    $config['cf_member_img_width'] = 60;
    $config['cf_member_img_height'] = 60;
}

// 소셜 로그인 관리 테이블 없을 경우 생성
if (!sql_query(" DESC {$g5['social_profile_table']} ", false)) {
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['social_profile_table']}` (
                  `mp_no` int(11) NOT NULL AUTO_INCREMENT,
                  `mb_id` varchar(255) NOT NULL DEFAULT '',
                  `provider` varchar(50) NOT NULL DEFAULT '',
                  `object_sha` varchar(45) NOT NULL DEFAULT '',
                  `identifier` varchar(255) NOT NULL DEFAULT '',
                  `profileurl` varchar(255) NOT NULL DEFAULT '',
                  `photourl` varchar(255) NOT NULL DEFAULT '',
                  `displayname` varchar(150) NOT NULL DEFAULT '',
                  `description` varchar(255) NOT NULL DEFAULT '',
                  `mp_register_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  `mp_latest_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                  UNIQUE KEY `mp_no` (`mp_no`),
                  KEY `mb_id` (`mb_id`),
                  KEY `provider` (`provider`)
                ) ",
        true
    );
}

// 짧은 URL 주소를 사용 여부 필드 추가
if (!isset($config['cf_bbs_rewrite'])) {
    sql_query(
        " ALTER TABLE `{$g5['config_table']}`
                    ADD `cf_bbs_rewrite` tinyint(4) NOT NULL DEFAULT '0' AFTER `cf_link_target` ",
        true
    );
}

// 읽지 않은 메모 수 칼럼 추가
if (!isset($member['mb_memo_cnt'])) {
    sql_query(
        " ALTER TABLE `{$g5['member_table']}`
                ADD `mb_memo_cnt` int(11) NOT NULL DEFAULT '0' AFTER `mb_memo_call`",
        true
    );
}

// 스크랩 읽은 수 추가
if (!isset($member['mb_scrap_cnt'])) {
    sql_query(
        " ALTER TABLE `{$g5['member_table']}`
                ADD `mb_scrap_cnt` int(11) NOT NULL DEFAULT '0' AFTER `mb_memo_cnt`",
        true
    );
}

// 아이코드 토큰키 추가
if (!isset($config['cf_icode_token_key'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_icode_token_key` VARCHAR(100) NOT NULL DEFAULT '' AFTER `cf_icode_server_port`; ";
    sql_query($sql, false);
}
// 아이디/비밀번호 찾기에 본인확인 사용 여부 필드 추가
if (!isset($config['cf_cert_find'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_cert_find` TINYINT(4) NOT NULL DEFAULT '0' AFTER `cf_cert_use`; ";
    sql_query($sql, false);
}
// 간편인증 필드 추가
if (!isset($config['cf_cert_simple'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_cert_simple` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_hp`; ";
    sql_query($sql, false);
}
if (!isset($config['cf_cert_kg_cd'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}`
            ADD COLUMN `cf_cert_kg_cd` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_simple`; ";
    sql_query($sql, false);
}
if (!isset($config['cf_cert_kg_mid'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}`
            ADD COLUMN `cf_cert_kg_mid` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_cert_kg_cd`; ";
    sql_query($sql, false);
}
if (!isset($config['cf_cert_use_seed'])) {
    $sql = "ALTER TABLE `{$g5['config_table']}` 
            ADD COLUMN `cf_cert_use_seed` TINYINT(4) NOT NULL DEFAULT '1' AFTER `cf_cert_kg_mid`; ";
    sql_query($sql, false);
}
if (!$config['cf_faq_skin']) {
    $config['cf_faq_skin'] = "basic";
}
if (!$config['cf_mobile_faq_skin']) {
    $config['cf_mobile_faq_skin'] = "basic";
}

/**
 * 슬랙 토큰정보 필드 제거
 */
if (isset($config['cf_slack_token'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}` DROP `cf_slack_token`, DROP `cf_slack_channel`", true);
}

/**
 * 구글지도, 네이버지도, 다음지도 앱 API ID
 */
if (!isset($config['cf_map_google_id'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_map_google_id` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_syndi_except`,
                ADD `cf_map_naver_id` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_map_google_id`,
                ADD `cf_map_daum_id` VARCHAR(255) NOT NULL DEFAULT '' AFTER `cf_map_naver_id` ", true);
}

// 상담신청
if (!sql_query(" DESC {$g5['eyoom_counsel']} ", false)) {
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['eyoom_counsel']}` (
                `cs_id` int(11) UNSIGNED NOT NULL auto_increment,
                `mb_id` varchar(30) NOT NULL,
                `cs_part` varchar(20) NOT NULL,
                `cs_company` varchar(50) NOT NULL,
                `cs_name` varchar(30) NOT NULL,
                `cs_tel` varchar(20) NOT NULL,
                `cs_email` varchar(255) NOT NULL,
                `cs_subject` varchar(255) NOT NULL,
                `cs_content` text NOT NULL,
                `cs_file1` text NOT NULL,
                `cs_file2` text NOT NULL,
                `cs_memo` text NOT NULL,
                `cs_status` varchar(20) NOT NULL DEFAULT '',
                `cs_ip` varchar(255) NOT NULL,
                `cs_update` datetime NOT NULL,
                `cs_regdt` datetime NOT NULL,
                PRIMARY KEY  (`cs_id`)
                ) ",
        true
    );
}
if (!isset($config['cf_counsel_part'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_counsel_part` VARCHAR(255) NOT NULL DEFAULT '견적요청, 제품상담, 제휴상담, 기타' AFTER `cf_eyoom_admin_theme`,
                ADD `cf_counsel_status` VARCHAR(255) NOT NULL DEFAULT '대기, 접수, 진행, 완료' AFTER `cf_counsel_part`,
                ADD `cf_counsel_view` CHAR(1) NOT NULL DEFAULT '' AFTER `cf_counsel_status` ", true);

    $config['cf_counsel_part']      = '견적요청, 제품상담, 제휴상담, 기타';
    $config['cf_counsel_status']    = '대기, 접수, 진행, 완료';
    $config['cf_counsel_view']      = '';
}
if (!isset($config['cf_use_counsel'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_use_counsel` CHAR(1) NOT NULL DEFAULT '1' AFTER `cf_eyoom_admin_theme`,
                ADD `cf_counsel_sendmail` CHAR(1) NOT NULL DEFAULT '1' AFTER `cf_counsel_status`,
                ADD `cf_counsel_email` VARCHAR(255) NOT NULL DEFAULT '".$config['cf_admin_email']."' AFTER `cf_counsel_sendmail` ", true);

    $config['cf_use_counsel']       = 1;
    $config['cf_counsel_sendmail']  = 1;
    $config['cf_counsel_email']     = $config['cf_admin_email'];
}

/**
 * 이윰빌더 최신 배포버전 알림 on/off 필드추가
 */
if (!isset($config['cf_use_version_alarm'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_use_version_alarm` CHAR(1) NOT NULL DEFAULT '1' AFTER `cf_eyoom_admin_theme` ", true);
}

/**
 * 하루 게시물 작성수 제한 필드추가
 */
if (!isset($config['cf_write_limit'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_write_limit` CHAR(1) NOT NULL DEFAULT '1' AFTER `cf_use_version_alarm`,
                ADD `cf_write_limit_type` VARCHAR(10) NOT NULL DEFAULT '' AFTER `cf_write_limit` ", true);
}

if(!$config['cf_faq_skin']) $config['cf_faq_skin'] = "basic";
if(!$config['cf_mobile_faq_skin']) $config['cf_mobile_faq_skin'] = "basic";

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_cf_basic' => '기본환경',
    'anc_cf_board' => '게시판기본',
    'anc_cf_join' => '회원가입',
    'anc_cf_cert' => '본인확인',
    'anc_cf_counsel' => '상담신청',
    'anc_cf_url' => '짧은주소',
    'anc_cf_mail' => '메일환경설정',
    'anc_cf_sns' => 'SNS&amp;지도',
    'anc_cf_layout' => '레이아웃 추가설정',
    'anc_cf_sms' => 'SMS',
    'anc_cf_extra' => '여분필드',
);

/**
 * SMS 설정
 */
if (!$config['cf_icode_server_ip']) {
    $config['cf_icode_server_ip'] = '211.172.232.124';
}
if (!$config['cf_icode_server_port']) {
    $config['cf_icode_server_port'] = '7295';
}

$userinfo = array('payment' => '');
if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw']) {
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}

/**
 * 이윰 관리자모드 테마
 */
$cf_eyoom_admin_theme = get_skin_dir('theme', EYOOM_ADMIN_PATH);

/**
 * 위지윅 에디터
 */
$cf_editor  = get_skin_dir('', G5_EDITOR_PATH);

/**
 * 음성 캡챠
 */
$cf_captcha_mp3 = get_skin_dir('mp3', str_replace(array('recaptcha_inv', 'recaptcha'), 'kcaptcha', G5_CAPTCHA_PATH));

/**
 * _rewrite_config_form.php 영역
 */
{
    $is_use_apache = (stripos($_SERVER['SERVER_SOFTWARE'], 'apache') !== false);

    $is_use_nginx = (stripos($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false);

    $is_use_iis = !$is_use_apache && (stripos($_SERVER['SERVER_SOFTWARE'], 'microsoft-iis') !== false);

    $is_write_file = false;
    $is_apache_need_rules = false;
    $is_apache_rewrite = false;

    if (!($is_use_apache || $is_use_nginx || $is_use_iis)) {    // 셋다 아니면 다 출력시킨다.
        $is_use_apache = true;
        $is_use_nginx = true;
    }

    if ($is_use_nginx) {
        $is_write_file = false;
    }
    
    if ($is_use_apache) {
        $is_write_file = (is_writable(G5_PATH) || (file_exists(G5_PATH . '/.htaccess') && is_writable(G5_PATH . '/.htaccess'))) ? true : false;
        $is_apache_need_rules = check_need_rewrite_rules();
        $is_apache_rewrite = function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules());
    }

    $get_path_url = parse_url(G5_URL);

    $base_path = isset($get_path_url['path']) ? $get_path_url['path'] . '/' : '/';

    $short_url_arrs = array(
        '0' => array('label' => '사용안함', 'url' => G5_URL . '/board.php?bo_table=free&wr_id=123'),
        '1' => array('label' => '숫자', 'url' => G5_URL . '/free/123'),
        //'2' => array('label' => '글 이름', 'url' => G5_URL . '/free/안녕하세요/'),
    );
}

if (stripos($config['cf_image_extension'], "webp") !== false) {
    if (!function_exists("imagewebp")) {
        echo '<script>'.PHP_EOL;
        echo 'alert("이 서버는 webp 이미지를 지원하고 있지 않습니다.\n이미지 업로드 확장자에서 webp 확장자를 제거해 주십시오.\n제거하지 않으면 이미지와 관련된 오류가 발생할 수 있습니다.");'.PHP_EOL;
        echo 'document.getElementById("cf_image_extension").focus();'.PHP_EOL;
        echo '</script>'.PHP_EOL;
    }
}

/**
 * 버튼
 */
$frm_submit_fixed = ' <input type="submit" value="적용하기" class="admin-fixed-submit-btn btn-e btn-e-red" accesskey="s">' ;

$frm_submit  = ' <div class="confirm-bottom-btn text-center margin-top-30 margin-bottom-30 m-t-0 m-b-0"> ';
$frm_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">' ;
$frm_submit .= '</div>';