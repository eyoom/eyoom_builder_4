<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

check_admin_token();

if (isset($_REQUEST['theme'])) {
    if (!is_array($_REQUEST['theme'])) {
        $theme = filter_var($_REQUEST['theme'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_]+$/i")
        ));
        $theme = preg_replace('/[^a-z0-9_]/i', '', trim($theme));
    }
} else {
    alert("잘못된 접근입니다.");
}

/**
 * 이윰게시판 설정에서 쇼핑몰 스킨사용체크 필드 추가
 */
if(!sql_query(" select use_shop_skin from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}` add `use_shop_skin` enum('y','n') NOT NULL default 'n' after `use_gnu_skin` ";
    sql_query($sql, true);
}

/**
 * 채택게시판 설정 필드 추가
 */
if(!sql_query(" select bo_use_adopt_point from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_adopt_point` char(1) NOT NULL default '' after `bo_use_extimg`,
        add `bo_adopt_minpoint` int(7) NOT NULL default '0' after `bo_use_adopt_point`,
        add `bo_adopt_maxpoint` int(11) NOT NULL default '0' after `bo_adopt_minpoint`,
        add `bo_adopt_ratio` smallint(3) NOT NULL default '0' after `bo_adopt_maxpoint`
    ";
    sql_query($sql, true);
}

/**
 * 회원당 하루 게시물 작성회수 설정 필드 추가
 */
if(!sql_query(" select bo_write_limit from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_write_limit` smallint(3) NOT NULL default '0' after `bo_adopt_ratio`
    ";
    sql_query($sql, true);
}

/**
 * 별점 평가 기능 확장 & 추천회원 / 비추천회원 뷰페이지에서 보이기 설정 필드 추가
 */
if(!sql_query(" select bo_use_rating_member from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_rating_member` char(1) NOT NULL default '0' after `bo_use_rating_list`,
        add `bo_use_rating_score` char(1) NOT NULL default '0' after `bo_use_rating_member`,
        add `bo_use_rating_comment` char(1) NOT NULL default '0' after `bo_use_rating_score`,
        add `bo_rating_point` int(11) NOT NULL default '0' after `bo_use_rating_comment`,
        add `bo_use_good_member` char(1) NOT NULL default '1' after `bo_use_video_photo`,
        add `bo_use_nogood_member` char(1) NOT NULL default '0' after `bo_use_good_member`
    ";
    sql_query($sql, true);
}

if(!sql_query(" select bo_use_good_member from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_good_member` char(1) NOT NULL default '1' after `bo_use_video_photo`,
        add `bo_use_nogood_member` char(1) NOT NULL default '0' after `bo_use_good_member`
    ";
    sql_query($sql, true);
}

/**
 * 게시물 상단고정 설정 필드 추가
 */
if(!sql_query(" select bo_use_wrfixed from {$g5['eyoom_board']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_board']}`
        add `bo_use_wrfixed` char(1) NOT NULL default '' after `bo_adopt_ratio`,
        add `bo_wrfixed_type` char(1) NOT NULL default '1' after `bo_use_wrfixed`,
        add `bo_wrfixed_point` int(7) NOT NULL default '1000' after `bo_wrfixed_type`,
        add `bo_wrfixed_date` smallint(3) NOT NULL default '5' after `bo_wrfixed_point`
    ";
    sql_query($sql, true);
}

// 게시물 상단고정 관리 테이블 없을 경우 생성
if (!sql_query(" DESC {$g5['eyoom_wrfixed']} ", false)) {
    sql_query(
        " CREATE TABLE IF NOT EXISTS `{$g5['eyoom_wrfixed']}` (
                    `bo_table` varchar(20) NOT NULL DEFAULT '',
                    `wr_id` int(11) NOT NULL DEFAULT '0',
                    `mb_id` varchar(30) NOT NULL,
                    `bf_wrfixed_point` int(11) NOT NULL DEFAULT '0',
                    `bf_wrfixed_date` smallint(3) NOT NULL DEFAULT '1',
                    `bf_open` enum('y','n') NOT NULL DEFAULT 'n',
                    `po_datetime` datetime NOT NULL,
                    `ex_datetime` datetime NOT NULL,
                    `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
                ) ",
        true
    );
}

/**
 * 게시물 자동 이동/복사
 */
$bo_use_automove = isset($_POST['bo_use_automove']) ? (int) $_POST['bo_use_automove'] : 0;
if ($bo_use_automove) {
    $post_bo_automove['count1'] = isset($_POST['bo_automove_count1']) ? clean_xss_tags(trim($_POST['bo_automove_count1'])) : '';
    $post_bo_automove['target1'] = isset($_POST['bo_automove_target1']) ? clean_xss_tags(trim($_POST['bo_automove_target1'])) : '';
    $post_bo_automove['action1'] = isset($_POST['bo_automove_action1']) ? clean_xss_tags(trim($_POST['bo_automove_action1'])) : '';
    $post_bo_automove['count2'] = isset($_POST['bo_automove_count2']) ? clean_xss_tags(trim($_POST['bo_automove_count2'])) : '';
    $post_bo_automove['target2'] = isset($_POST['bo_automove_target2']) ? clean_xss_tags(trim($_POST['bo_automove_target2'])) : '';
    $post_bo_automove['action2'] = isset($_POST['bo_automove_action2']) ? clean_xss_tags(trim($_POST['bo_automove_action2'])) : '';
    $post_bo_automove['count3'] = isset($_POST['bo_automove_count3']) ? clean_xss_tags(trim($_POST['bo_automove_count3'])) : '';
    $post_bo_automove['target3'] = isset($_POST['bo_automove_target3']) ? clean_xss_tags(trim($_POST['bo_automove_target3'])) : '';
    $post_bo_automove['action3'] = isset($_POST['bo_automove_action3']) ? clean_xss_tags(trim($_POST['bo_automove_action3'])) : '';
    $bo_automove = serialize($post_bo_automove);
} else {
    $bo_automove = '';
}

$use_shop_skin = isset($_POST['use_shop_skin']) ? clean_xss_tags($_POST['use_shop_skin'], 1, 1) : '';
$use_gnu_skin = isset($_POST['use_gnu_skin']) ? clean_xss_tags($_POST['use_gnu_skin'], 1, 1) : '';
$bo_skin = isset($_POST['bo_skin']) ? clean_xss_tags($_POST['bo_skin'], 1, 1) : '';
$bo_use_point_explain = isset($_POST['bo_use_point_explain']) ? (int) $_POST['bo_use_point_explain'] : 0;
$bo_cmtpoint_target = isset($_POST['bo_cmtpoint_target']) ? (int) $_POST['bo_cmtpoint_target'] : 1;
$bo_firstcmt_point = isset($_POST['bo_firstcmt_point']) ? (int) $_POST['bo_firstcmt_point'] : 0;
$bo_firstcmt_point_type = isset($_POST['bo_firstcmt_point_type']) ? (int) $_POST['bo_firstcmt_point_type'] : 1;
$bo_bomb_point = isset($_POST['bo_bomb_point']) ? (int) $_POST['bo_bomb_point'] : 0;
$bo_bomb_point_type = isset($_POST['bo_bomb_point_type']) ? (int) $_POST['bo_bomb_point_type'] : 1;
$bo_bomb_point_limit = isset($_POST['bo_bomb_point_limit']) ? (int) $_POST['bo_bomb_point_limit'] : 10;
$bo_bomb_point_cnt = isset($_POST['bo_bomb_point_cnt']) ? (int) $_POST['bo_bomb_point_cnt'] : 0;
$bo_lucky_point = isset($_POST['bo_lucky_point']) ? (int) $_POST['bo_lucky_point'] : 0;
$bo_lucky_point_type = isset($_POST['bo_lucky_point_type']) ? (int) $_POST['bo_lucky_point_type'] : 1;
$bo_lucky_point_ratio = isset($_POST['bo_lucky_point_ratio']) ? (int) $_POST['bo_lucky_point_ratio'] : 0;
$bo_use_exif = isset($_POST['bo_use_exif']) ? (int) $_POST['bo_use_exif'] : 0;
$bo_exif_detail = isset($_POST['bo_exif_detail']) ? serialize($_POST['bo_exif_detail'])  : '';
$bo_use_adopt_point = isset($_POST['bo_use_adopt_point']) ? (int) $_POST['bo_use_adopt_point'] : 0;
$bo_adopt_minpoint = isset($_POST['bo_adopt_minpoint']) ? (int) $_POST['bo_adopt_minpoint'] : 0;
$bo_adopt_maxpoint = isset($_POST['bo_adopt_maxpoint']) ? (int) $_POST['bo_adopt_maxpoint'] : 0;
$bo_adopt_ratio = isset($_POST['bo_adopt_ratio']) ? (int) $_POST['bo_adopt_ratio'] : 0;
$bo_use_wrfixed = isset($_POST['bo_use_wrfixed']) ? (int) $_POST['bo_use_wrfixed'] : 0;
$bo_wrfixed_type = isset($_POST['bo_wrfixed_type']) ? (int) $_POST['bo_wrfixed_type'] : 1;
$bo_wrfixed_point = isset($_POST['bo_wrfixed_point']) ? (int) $_POST['bo_wrfixed_point'] : 1000;
$bo_wrfixed_date = isset($_POST['bo_wrfixed_date']) ? (int) $_POST['bo_wrfixed_date'] : 5;
$bo_write_limit = isset($_POST['bo_write_limit']) ? (int) $_POST['bo_write_limit'] : 0;
$bo_sel_date_type = isset($_POST['bo_sel_date_type']) ? (int) $_POST['bo_sel_date_type'] : 1;
$bo_use_hotgul = isset($_POST['bo_use_hotgul']) ? (int) $_POST['bo_use_hotgul'] : 1;
$bo_use_anonymous = isset($_POST['bo_use_anonymous']) ? (int) $_POST['bo_use_anonymous'] : 0;
$bo_use_infinite_scroll = isset($_POST['bo_use_infinite_scroll']) ? (int) $_POST['bo_use_infinite_scroll'] : 2;
$bo_use_cmt_best = isset($_POST['bo_use_cmt_best']) ? (int) $_POST['bo_use_cmt_best'] : 0;
$bo_use_list_image = isset($_POST['bo_use_list_image']) ? (int) $_POST['bo_use_list_image'] : 0;
$bo_use_video_photo = isset($_POST['bo_use_video_photo']) ? (int) $_POST['bo_use_video_photo'] : 2;
$bo_use_good_member = isset($_POST['bo_use_good_member']) ? (int) $_POST['bo_use_good_member'] : 0;
$bo_use_nogood_member = isset($_POST['bo_use_nogood_member']) ? (int) $_POST['bo_use_nogood_member'] : 0;
$bo_use_extimg = isset($_POST['bo_use_extimg']) ? (int) $_POST['bo_use_extimg'] : 0;
$download_fee_ratio = isset($_POST['download_fee_ratio']) ? (int) $_POST['download_fee_ratio'] : 0;
$bo_use_yellow_card = isset($_POST['bo_use_yellow_card']) ? (int) $_POST['bo_use_yellow_card'] : 0;
$bo_use_rating = isset($_POST['bo_use_rating']) ? (int) $_POST['bo_use_rating'] : 2;
$bo_use_rating_list = isset($_POST['bo_use_rating_list']) ? (int) $_POST['bo_use_rating_list'] : 0;
$bo_use_rating_member = isset($_POST['bo_use_rating_member']) ? (int) $_POST['bo_use_rating_member'] : 0;
$bo_use_rating_score = isset($_POST['bo_use_rating_score']) ? (int) $_POST['bo_use_rating_score'] : 0;
$bo_use_rating_comment = isset($_POST['bo_use_rating_comment']) ? (int) $_POST['bo_use_rating_comment'] : 0;
$bo_rating_point = isset($_POST['bo_rating_point']) ? (int) $_POST['bo_rating_point'] : 0;
$bo_use_tag = isset($_POST['bo_use_tag']) ? (int) $_POST['bo_use_tag'] : 0;
$bo_use_addon_emoticon = isset($_POST['bo_use_addon_emoticon']) ? (int) $_POST['bo_use_addon_emoticon'] : 0;
$bo_use_addon_video = isset($_POST['bo_use_addon_video']) ? (int) $_POST['bo_use_addon_video'] : 0;
$bo_use_addon_coding = isset($_POST['bo_use_addon_coding']) ? (int) $_POST['bo_use_addon_coding'] : 0;
$bo_use_addon_soundcloud = isset($_POST['bo_use_addon_soundcloud']) ? (int) $_POST['bo_use_addon_soundcloud'] : 0;
$bo_use_addon_map = isset($_POST['bo_use_addon_map']) ? (int) $_POST['bo_use_addon_map'] : 0;
$bo_use_addon_poll = isset($_POST['bo_use_addon_poll']) ? (int) $_POST['bo_use_addon_poll'] : 0;
$bo_use_addon_cmtfile = isset($_POST['bo_use_addon_cmtfile']) ? (int) $_POST['bo_use_addon_cmtfile'] : 0;
$bo_count_cmtfile = isset($_POST['bo_count_cmtfile']) ? (int) $_POST['bo_count_cmtfile'] : 1;
$bo_cmt_best_min = isset($_POST['bo_cmt_best_min']) ? (int) $_POST['bo_cmt_best_min'] : 10;
$bo_cmt_best_limit = isset($_POST['bo_cmt_best_limit']) ? (int) $_POST['bo_cmt_best_limit'] : 5;
$bo_tag_level = isset($_POST['bo_tag_level']) ? (int) $_POST['bo_tag_level'] : 2;
$bo_tag_limit = isset($_POST['bo_tag_limit']) ? (int) $_POST['bo_tag_limit'] : 10;
$bo_blind_limit = isset($_POST['bo_blind_limit']) ? (int) $_POST['bo_blind_limit'] : 5;
$bo_blind_view = isset($_POST['bo_blind_view']) ? (int) $_POST['bo_blind_view'] : 10;
$bo_blind_direct = isset($_POST['bo_blind_direct']) ? (int) $_POST['bo_blind_direct'] : 10;
$bo_goto_url = isset($_POST['bo_goto_url']) ? $_POST['bo_goto_url'] : '';
if ($bo_goto_url) {
    $bo_goto_url = substr($bo_goto_url,0,1000);
    $bo_goto_url = trim(strip_tags($bo_goto_url));
    $bo_goto_url = preg_replace("#[\\\]+$#", "", $bo_goto_url);
}

$where = "bo_table='{$bo_table}' and bo_theme='{$theme}'";

$set = "
    use_shop_skin           = '{$use_shop_skin}',
    use_gnu_skin            = '{$use_gnu_skin}',
    bo_skin                 = '{$bo_skin}',
    bo_goto_url             = '{$bo_goto_url}',
    bo_use_point_explain    = '{$bo_use_point_explain}',
    bo_cmtpoint_target      = '{$bo_cmtpoint_target}',
    bo_firstcmt_point       = '{$bo_firstcmt_point}',
    bo_firstcmt_point_type  = '{$bo_firstcmt_point_type}',
    bo_bomb_point           = '{$bo_bomb_point}',
    bo_bomb_point_type      = '{$bo_bomb_point_type}',
    bo_bomb_point_limit     = '{$bo_bomb_point_limit}',
    bo_bomb_point_cnt       = '{$bo_bomb_point_cnt}',
    bo_lucky_point          = '{$bo_lucky_point}',
    bo_lucky_point_type     = '{$bo_lucky_point_type}',
    bo_lucky_point_ratio    = '{$bo_lucky_point_ratio}',
    bo_use_exif             = '{$bo_use_exif}',
    bo_exif_detail          = '{$bo_exif_detail}',
    bo_use_adopt_point      = '{$bo_use_adopt_point}',
    bo_adopt_minpoint       = '{$bo_adopt_minpoint}',
    bo_adopt_maxpoint       = '{$bo_adopt_maxpoint}',
    bo_adopt_ratio          = '{$bo_adopt_ratio}',
    bo_use_wrfixed          = '{$bo_use_wrfixed}',
    bo_wrfixed_type         = '{$bo_wrfixed_type}',
    bo_wrfixed_point        = '{$bo_wrfixed_point}',
    bo_wrfixed_date         = '{$bo_wrfixed_date}',
    bo_write_limit          = '{$bo_write_limit}',
    bo_sel_date_type        = '{$bo_sel_date_type}',
    bo_use_hotgul           = '{$bo_use_hotgul}',
    bo_use_anonymous        = '{$bo_use_anonymous}',
    bo_use_infinite_scroll  = '{$bo_use_infinite_scroll}',
    bo_use_cmt_best         = '{$bo_use_cmt_best}',
    bo_use_list_image       = '{$bo_use_list_image}',
    bo_use_video_photo      = '{$bo_use_video_photo}',
    bo_use_good_member      = '{$bo_use_good_member}',
    bo_use_nogood_member    = '{$bo_use_nogood_member}',
    bo_use_extimg           = '{$bo_use_extimg}',
    download_fee_ratio      = '{$download_fee_ratio}',
    bo_use_yellow_card      = '{$bo_use_yellow_card}',
    bo_use_rating           = '{$bo_use_rating}',
    bo_use_rating_list      = '{$bo_use_rating_list}',
    bo_use_rating_member    = '{$bo_use_rating_member}',
    bo_use_rating_score     = '{$bo_use_rating_score}',
    bo_use_rating_comment   = '{$bo_use_rating_comment}',
    bo_rating_point         = '{$bo_rating_point}',
    bo_use_tag              = '{$bo_use_tag}',
    bo_use_automove         = '{$bo_use_automove}',
    bo_use_addon_emoticon   = '{$bo_use_addon_emoticon}',
    bo_use_addon_video      = '{$bo_use_addon_video}',
    bo_use_addon_coding     = '{$bo_use_addon_coding}',
    bo_use_addon_soundcloud = '{$bo_use_addon_soundcloud}',
    bo_use_addon_map        = '{$bo_use_addon_map}',
    bo_use_addon_cmtfile    = '{$bo_use_addon_cmtfile}',
    bo_count_cmtfile        = '{$bo_count_cmtfile}',
    bo_cmt_best_min         = '{$bo_cmt_best_min}',
    bo_cmt_best_limit       = '{$bo_cmt_best_limit}',
    bo_tag_level            = '{$bo_tag_level}',
    bo_tag_limit            = '{$bo_tag_limit}',
    bo_automove             = '{$bo_automove}',
    bo_blind_limit          = '{$bo_blind_limit}',
    bo_blind_view           = '{$bo_blind_view}',
    bo_blind_direct         = '{$bo_blind_direct}'
";

$sql = "update {$g5['eyoom_board']} set $set where $where";
sql_query($sql);

/**
 * 같은 그룹내 게시판 동일 옵션 적용
 */
$grp_fields = '';
if (is_checked('chk_grp_shop_skin'))        $grp_fields .= " , use_shop_skin = '{$use_shop_skin}' ";
if (is_checked('chk_grp_gnu_skin'))         $grp_fields .= " , use_gnu_skin = '{$use_gnu_skin}' ";
if (is_checked('chk_grp_bo_skin'))          $grp_fields .= " , bo_skin = '{$bo_skin}' ";
if (is_checked('chk_grp_date_type'))        $grp_fields .= " , bo_sel_date_type = '{$bo_sel_date_type}' ";
if (is_checked('chk_grp_hotgul'))           $grp_fields .= " , bo_use_hotgul = '{$bo_use_hotgul}' ";
if (is_checked('chk_grp_anonymous'))        $grp_fields .= " , bo_use_anonymous = '{$bo_use_anonymous}' ";
if (is_checked('chk_grp_infinite_scroll'))  $grp_fields .= " , bo_use_infinite_scroll = '{$bo_use_infinite_scroll}' ";
if (is_checked('chk_grp_cmt_best'))         $grp_fields .= " , bo_use_cmt_best = '{$bo_use_cmt_best}' ";
if (is_checked('chk_grp_point_explain'))    $grp_fields .= " , bo_use_point_explain = '{$bo_use_point_explain}' ";
if (is_checked('chk_grp_list_image'))       $grp_fields .= " , bo_use_list_image = '{$bo_use_list_image}' ";
if (is_checked('chk_grp_video_photo'))      $grp_fields .= " , bo_use_video_photo = '{$bo_use_video_photo}' ";
if (is_checked('chk_grp_good_member'))      $grp_fields .= " , bo_use_good_member = '{$bo_use_good_member}' ";
if (is_checked('chk_grp_nogood_member'))    $grp_fields .= " , bo_use_nogood_member = '{$bo_use_nogood_member}' ";
if (is_checked('chk_grp_yellow_card'))      $grp_fields .= " , bo_use_yellow_card = '{$bo_use_yellow_card}' ";
if (is_checked('chk_grp_exif'))             $grp_fields .= " , bo_use_exif = '{$bo_use_exif}' ";
if (is_checked('chk_grp_rating'))           $grp_fields .= " , bo_use_rating = '{$bo_use_rating}' ";
if (is_checked('chk_grp_rating_list'))      $grp_fields .= " , bo_use_rating_list = '{$bo_use_rating_list}' ";
if (is_checked('chk_grp_rating_member'))    $grp_fields .= " , bo_use_rating_member = '{$bo_use_rating_member}' ";
if (is_checked('chk_grp_rating_score'))     $grp_fields .= " , bo_use_rating_score = '{$bo_use_rating_score}' ";
if (is_checked('chk_grp_rating_comment'))   $grp_fields .= " , bo_use_rating_comment = '{$bo_use_rating_comment}' ";
if (is_checked('chk_grp_rating_point'))     $grp_fields .= " , bo_rating_point = '{$bo_rating_point}' ";
if (is_checked('chk_grp_use_tag'))          $grp_fields .= " , bo_use_tag = '{$bo_use_tag}' ";
if (is_checked('chk_grp_use_wrfixed'))      $grp_fields .= " , bo_use_wrfixed = '{$bo_use_wrfixed}' ";
if (is_checked('chk_grp_wrfixed_type'))     $grp_fields .= " , bo_wrfixed_type = '{$bo_wrfixed_type}' ";
if (is_checked('chk_grp_wrfixed_point'))    $grp_fields .= " , bo_wrfixed_point = '{$bo_wrfixed_point}' ";
if (is_checked('chk_grp_wrfixed_date'))     $grp_fields .= " , bo_wrfixed_date = '{$bo_wrfixed_date}' ";
if (is_checked('chk_grp_use_automove'))     $grp_fields .= " , bo_use_automove = '{$bo_use_automove}' ";
if (is_checked('chk_grp_addon_emoticon'))   $grp_fields .= " , bo_use_addon_emoticon = '{$bo_use_addon_emoticon}' ";
if (is_checked('chk_grp_addon_video'))      $grp_fields .= " , bo_use_addon_video = '{$bo_use_addon_video}' ";
if (is_checked('chk_grp_addon_coding'))     $grp_fields .= " , bo_use_addon_coding = '{$bo_use_addon_coding}' ";
if (is_checked('chk_grp_addon_soundcloud')) $grp_fields .= " , bo_use_addon_soundcloud = '{$bo_use_addon_soundcloud}' ";
if (is_checked('chk_grp_addon_map'))        $grp_fields .= " , bo_use_addon_map = '{$bo_use_addon_map}' ";
if (is_checked('chk_grp_addon_cmtfile'))    $grp_fields .= " , bo_use_addon_cmtfile = '{$bo_use_addon_cmtfile}', bo_count_cmtfile = '{$bo_count_cmtfile}' ";
if (is_checked('chk_grp_extimg'))           $grp_fields .= " , bo_use_extimg = '{$bo_use_extimg}' ";
if (is_checked('chk_grp_cmtbest_min'))      $grp_fields .= " , bo_cmt_best_min = '{$bo_cmt_best_min}' ";
if (is_checked('chk_grp_cmtbest_limit'))    $grp_fields .= " , bo_cmt_best_limit = '{$bo_cmt_best_limit}' ";
if (is_checked('chk_grp_tag_level'))        $grp_fields .= " , bo_tag_level = '{$bo_tag_level}' ";
if (is_checked('chk_grp_tag_limit'))        $grp_fields .= " , bo_tag_limit = '{$bo_tag_limit}' ";
if (is_checked('chk_grp_automove'))         $grp_fields .= " , bo_automove = '{$bo_automove}' ";
if (is_checked('chk_grp_exif_detail'))      $grp_fields .= " , bo_exif_detail = '{$bo_exif_detail}' ";
if (is_checked('chk_grp_blind_limit'))      $grp_fields .= " , bo_blind_limit = '{$bo_blind_limit}' ";
if (is_checked('chk_grp_blind_view'))       $grp_fields .= " , bo_blind_view = '{$bo_blind_view}' ";
if (is_checked('chk_grp_blind_direct'))     $grp_fields .= " , bo_blind_direct = '{$bo_blind_direct}' ";
if (is_checked('chk_grp_cmtpoint_target'))  $grp_fields .= " , bo_cmtpoint_target = '{$bo_cmtpoint_target}' ";
if (is_checked('chk_grp_download_ratio'))   $grp_fields .= " , download_fee_ratio = '{$download_fee_ratio}' ";
if (is_checked('chk_grp_firstcmt_point')) {
    $grp_fields .= " , bo_firstcmt_point        = '{$bo_firstcmt_point}' ";
    $grp_fields .= " , bo_firstcmt_point_type   = '{$bo_firstcmt_point_type}' ";
}
if (is_checked('chk_grp_bomb_point')) {
    $grp_fields .= " , bo_bomb_point            = '{$bo_bomb_point}' ";
    $grp_fields .= " , bo_bomb_point_type       = '{$bo_bomb_point_type}' ";
    $grp_fields .= " , bo_bomb_point_limit      = '{$bo_bomb_point_limit}' ";
    $grp_fields .= " , bo_bomb_point_cnt        = '{$bo_bomb_point_cnt}' ";
}
if (is_checked('chk_grp_lucky_point')) {
    $grp_fields .= " , bo_lucky_point           = '{$bo_lucky_point}' ";
    $grp_fields .= " , bo_lucky_point_type      = '{$bo_lucky_point_type}' ";
    $grp_fields .= " , bo_lucky_point_ratio     = '{$bo_lucky_point_ratio}' ";
}
if (is_checked('chk_grp_write_limit'))  $grp_fields .= " , bo_write_limit = '{$bo_write_limit}' ";

if ($grp_fields) {
    sql_query(" update {$g5['eyoom_board']} set bo_table = bo_table {$grp_fields} where gr_id = '{$gr_id}' and bo_theme='{$theme}' ");
}

// 모든 게시판 동일 옵션 적용
$all_fields = '';
if (is_checked('chk_all_shop_skin'))        $all_fields .= " , use_shop_skin = '{$use_shop_skin}' ";
if (is_checked('chk_all_gnu_skin'))         $all_fields .= " , use_gnu_skin = '{$use_gnu_skin}' ";
if (is_checked('chk_all_bo_skin'))          $all_fields .= " , bo_skin = '{$bo_skin}' ";
if (is_checked('chk_all_date_type'))        $all_fields .= " , bo_sel_date_type = '{$bo_sel_date_type}' ";
if (is_checked('chk_all_hotgul'))           $all_fields .= " , bo_use_hotgul = '{$bo_use_hotgul}' ";
if (is_checked('chk_all_anonymous'))        $all_fields .= " , bo_use_anonymous = '{$bo_use_anonymous}' ";
if (is_checked('chk_all_infinite_scroll'))  $all_fields .= " , bo_use_infinite_scroll = '{$bo_use_infinite_scroll}' ";
if (is_checked('chk_all_cmt_best'))         $all_fields .= " , bo_use_cmt_best = '{$bo_use_cmt_best}' ";
if (is_checked('chk_all_point_explain'))    $all_fields .= " , bo_use_point_explain = '{$bo_use_point_explain}' ";
if (is_checked('chk_all_list_image'))       $all_fields .= " , bo_use_list_image = '{$bo_use_list_image}' ";
if (is_checked('chk_all_video_photo'))      $all_fields .= " , bo_use_video_photo = '{$bo_use_video_photo}' ";
if (is_checked('chk_all_good_member'))      $all_fields .= " , bo_use_good_member = '{$bo_use_good_member}' ";
if (is_checked('chk_all_nogood_member'))    $all_fields .= " , bo_use_nogood_member = '{$bo_use_nogood_member}' ";
if (is_checked('chk_all_yellow_card'))      $all_fields .= " , bo_use_yellow_card = '{$bo_use_yellow_card}' ";
if (is_checked('chk_all_exif'))             $all_fields .= " , bo_use_exif = '{$bo_use_exif}' ";
if (is_checked('chk_all_rating'))           $all_fields .= " , bo_use_rating = '{$bo_use_rating}' ";
if (is_checked('chk_all_rating_list'))      $all_fields .= " , bo_use_rating_list = '{$bo_use_rating_list}' ";
if (is_checked('chk_all_rating_member'))    $all_fields .= " , bo_use_rating_member = '{$bo_use_rating_member}' ";
if (is_checked('chk_all_rating_score'))     $all_fields .= " , bo_use_rating_score = '{$bo_use_rating_score}' ";
if (is_checked('chk_all_rating_comment'))   $all_fields .= " , bo_use_rating_comment = '{$bo_use_rating_comment}' ";
if (is_checked('chk_all_rating_point'))     $all_fields .= " , bo_rating_point = '{$bo_rating_point}' ";
if (is_checked('chk_all_use_tag'))          $all_fields .= " , bo_use_tag = '{$bo_use_tag}' ";
if (is_checked('chk_all_use_wrfixed'))      $all_fields .= " , bo_use_wrfixed = '{$bo_use_wrfixed}' ";
if (is_checked('chk_all_wrfixed_type'))     $all_fields .= " , bo_wrfixed_type = '{$bo_wrfixed_type}' ";
if (is_checked('chk_all_wrfixed_point'))    $all_fields .= " , bo_wrfixed_point = '{$bo_wrfixed_point}' ";
if (is_checked('chk_all_wrfixed_date'))     $all_fields .= " , bo_wrfixed_date = '{$bo_wrfixed_date}' ";
if (is_checked('chk_all_use_automove'))     $all_fields .= " , bo_use_automove = '{$bo_use_automove}' ";
if (is_checked('chk_all_addon_emoticon'))   $all_fields .= " , bo_use_addon_emoticon = '{$bo_use_addon_emoticon}' ";
if (is_checked('chk_all_addon_video'))      $all_fields .= " , bo_use_addon_video = '{$bo_use_addon_video}' ";
if (is_checked('chk_all_addon_coding'))     $all_fields .= " , bo_use_addon_coding = '{$bo_use_addon_coding}' ";
if (is_checked('chk_all_addon_soundcloud')) $all_fields .= " , bo_use_addon_soundcloud = '{$bo_use_addon_soundcloud}' ";
if (is_checked('chk_all_addon_map'))        $all_fields .= " , bo_use_addon_map = '{$bo_use_addon_map}' ";
if (is_checked('chk_all_addon_cmtfile'))    $all_fields .= " , bo_use_addon_cmtfile = '{$bo_use_addon_cmtfile}', bo_count_cmtfile = '{$bo_count_cmtfile}' ";
if (is_checked('chk_all_extimg'))           $all_fields .= " , bo_use_extimg = '{$bo_use_extimg}' ";
if (is_checked('chk_all_cmtbest_min'))      $all_fields .= " , bo_cmt_best_min = '{$bo_cmt_best_min}' ";
if (is_checked('chk_all_cmtbest_limit'))    $all_fields .= " , bo_cmt_best_limit = '{$bo_cmt_best_limit}' ";
if (is_checked('chk_all_tag_level'))        $all_fields .= " , bo_tag_level = '{$bo_tag_level}' ";
if (is_checked('chk_all_tag_limit'))        $all_fields .= " , bo_tag_limit = '{$bo_tag_limit}' ";
if (is_checked('chk_all_automove'))         $all_fields .= " , bo_automove = '{$bo_automove}' ";
if (is_checked('chk_all_exif_detail'))      $all_fields .= " , bo_exif_detail = '{$bo_exif_detail}' ";
if (is_checked('chk_all_blind_limit'))      $all_fields .= " , bo_blind_limit = '{$bo_blind_limit}' ";
if (is_checked('chk_all_blind_view'))       $all_fields .= " , bo_blind_view = '{$bo_blind_view}' ";
if (is_checked('chk_all_blind_direct'))     $all_fields .= " , bo_blind_direct = '{$bo_blind_direct}' ";
if (is_checked('chk_all_cmtpoint_target'))  $all_fields .= " , bo_cmtpoint_target = '{$bo_cmtpoint_target}' ";
if (is_checked('chk_all_download_ratio'))   $all_fields .= " , download_fee_ratio = '{$download_fee_ratio}' ";
if (is_checked('chk_all_firstcmt_point'))   {
    $all_fields .= " , bo_firstcmt_point        = '{$bo_firstcmt_point}' ";
    $all_fields .= " , bo_firstcmt_point_type   = '{$bo_firstcmt_point_type}' ";
}
if (is_checked('chk_all_bomb_point')) {
    $all_fields .= " , bo_bomb_point            = '{$bo_bomb_point}' ";
    $all_fields .= " , bo_bomb_point_type       = '{$bo_bomb_point_type}' ";
    $all_fields .= " , bo_bomb_point_limit      = '{$bo_bomb_point_limit}' ";
    $all_fields .= " , bo_bomb_point_cnt        = '{$bo_bomb_point_cnt}' ";
}
if (is_checked('chk_all_lucky_point')) {
    $all_fields .= " , bo_lucky_point           = '{$bo_lucky_point}' ";
    $all_fields .= " , bo_lucky_point_type      = '{$bo_lucky_point_type}' ";
    $all_fields .= " , bo_lucky_point_ratio     = '{$bo_lucky_point_ratio}' ";
}
if (is_checked('chk_all_write_limit'))  $all_fields .= " , bo_write_limit = '{$bo_write_limit}' ";

if ($all_fields) {
    sql_query(" update {$g5['eyoom_board']} set bo_table = bo_table {$all_fields} where bo_theme='{$theme}' ");
}

$qstr = $wmode ? '&amp;wmode=1':'';
alert("정상적으로 적용하였습니다.", G5_ADMIN_URL . "/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table={$bo_table}&amp;{$qstr}");