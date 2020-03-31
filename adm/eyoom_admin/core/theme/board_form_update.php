<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

auth_check($auth[$sub_menu], 'w');

if ($w == 'u') check_demo();

check_admin_token();

$bo_table = $_POST['bo_table'];
$theme = $_POST['theme'];

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
 * 게시판 테이블에 익명글 관련 필드 추가
 */
if(!sql_query(" select wr_anonymous from {$write_table} limit 1 ", false)) {
    $sql = " alter table `{$write_table}`
        add `wr_anonymous` char(1) NOT NULL default '' after `wr_hit`,
        add `wr_bo_anonymous` char(1) NOT NULL default '' after `wr_anonymous`
    ";
    sql_query($sql, true);
}

/**
 * 새글 테이블에 익명글 관련 필드 추가
 */
if(!sql_query(" select wr_anonymous from {$g5['board_new_table']} limit 1 ", false)) {
    $sql = " alter table `{$g5['board_new_table']}`
        add `wr_anonymous` char(1) NOT NULL default '' after `wr_hit`,
        add `wr_bo_anonymous` char(1) NOT NULL default '' after `wr_anonymous`
    ";
    sql_query($sql, true);
}

$where = "bo_table='{$bo_table}' and bo_theme='{$theme}'";

$set = "
    use_shop_skin           = '{$_POST['use_shop_skin']}',
    use_gnu_skin            = '{$_POST['use_gnu_skin']}',
    bo_skin                 = '{$_POST['bo_skin']}',
    bo_use_point_explain    = '{$_POST['bo_use_point_explain']}',
    bo_cmtpoint_target      = '{$_POST['bo_cmtpoint_target']}',
    bo_firstcmt_point       = '{$_POST['bo_firstcmt_point']}',
    bo_firstcmt_point_type  = '{$_POST['bo_firstcmt_point_type']}',
    bo_bomb_point           = '{$_POST['bo_bomb_point']}',
    bo_bomb_point_type      = '{$_POST['bo_bomb_point_type']}',
    bo_bomb_point_limit     = '{$_POST['bo_bomb_point_limit']}',
    bo_bomb_point_cnt       = '{$_POST['bo_bomb_point_cnt']}',
    bo_lucky_point          = '{$_POST['bo_lucky_point']}',
    bo_lucky_point_type     = '{$_POST['bo_lucky_point_type']}',
    bo_lucky_point_ratio    = '{$_POST['bo_lucky_point_ratio']}',
    bo_use_exif             = '{$_POST['bo_use_exif']}',
    bo_exif_detail          = '" . serialize($_POST['bo_exif_detail']) . "',
    bo_use_adopt_point      = '{$_POST['bo_use_adopt_point']}',
    bo_adopt_minpoint       = '{$_POST['bo_adopt_minpoint']}',
    bo_adopt_maxpoint       = '{$_POST['bo_adopt_maxpoint']}',
    bo_adopt_ratio          = '{$_POST['bo_adopt_ratio']}',
    bo_write_limit          = '{$_POST['bo_write_limit']}',
    bo_use_profile_photo    = '{$_POST['bo_use_profile_photo']}',
    bo_sel_date_type        = '{$_POST['bo_sel_date_type']}',
    bo_use_hotgul           = '{$_POST['bo_use_hotgul']}',
    bo_use_anonymous        = '{$_POST['bo_use_anonymous']}',
    bo_use_infinite_scroll  = '{$_POST['bo_use_infinite_scroll']}',
    bo_use_cmt_best         = '{$_POST['bo_use_cmt_best']}',
    bo_use_list_image       = '{$_POST['bo_use_list_image']}',
    bo_use_video_photo      = '{$_POST['bo_use_video_photo']}',
    bo_use_good_member      = '{$_POST['bo_use_good_member']}',
    bo_use_nogood_member    = '{$_POST['bo_use_nogood_member']}',
    bo_use_extimg           = '{$_POST['bo_use_extimg']}',
    download_fee_ratio      = '{$_POST['download_fee_ratio']}',
    bo_use_yellow_card      = '{$_POST['bo_use_yellow_card']}',
    bo_use_rating           = '{$_POST['bo_use_rating']}',
    bo_use_rating_list      = '{$_POST['bo_use_rating_list']}',
    bo_use_rating_member    = '{$_POST['bo_use_rating_member']}',
    bo_use_rating_score     = '{$_POST['bo_use_rating_score']}',
    bo_use_rating_comment   = '{$_POST['bo_use_rating_comment']}',
    bo_rating_point         = '{$_POST['bo_rating_point']}',
    bo_use_tag              = '{$_POST['bo_use_tag']}',
    bo_use_automove         = '{$_POST['bo_use_automove']}',
    bo_use_addon_emoticon   = '{$_POST['bo_use_addon_emoticon']}',
    bo_use_addon_video      = '{$_POST['bo_use_addon_video']}',
    bo_use_addon_coding     = '{$_POST['bo_use_addon_coding']}',
    bo_use_addon_soundcloud = '{$_POST['bo_use_addon_soundcloud']}',
    bo_use_addon_map        = '{$_POST['bo_use_addon_map']}',
    bo_use_addon_cmtfile    = '{$_POST['bo_use_addon_cmtfile']}',
    bo_count_cmtfile        = '{$_POST['bo_count_cmtfile']}',
    bo_cmt_best_min         = '{$_POST['bo_cmt_best_min']}',
    bo_cmt_best_limit       = '{$_POST['bo_cmt_best_limit']}',
    bo_tag_level            = '{$_POST['bo_tag_level']}',
    bo_tag_limit            = '{$_POST['bo_tag_limit']}',
    bo_automove             = '" . serialize($_POST['bo_automove']). "',
    bo_blind_limit          = '{$_POST['bo_blind_limit']}',
    bo_blind_view           = '{$_POST['bo_blind_view']}',
    bo_blind_direct         = '{$_POST['bo_blind_direct']}'
";

$sql = "update {$g5['eyoom_board']} set $set where $where";
sql_query($sql);

/**
 * 같은 그룹내 게시판 동일 옵션 적용
 */
$grp_fields = '';
if (is_checked('chk_grp_shop_skin'))        $grp_fields .= " , use_shop_skin = '{$_POST['use_shop_skin']}' ";
if (is_checked('chk_grp_gnu_skin'))         $grp_fields .= " , use_gnu_skin = '{$_POST['use_gnu_skin']}' ";
if (is_checked('chk_grp_bo_skin'))          $grp_fields .= " , bo_skin = '{$_POST['bo_skin']}' ";
if (is_checked('chk_grp_profile_photo'))    $grp_fields .= " , bo_use_profile_photo = '{$_POST['bo_use_profile_photo']}' ";
if (is_checked('chk_grp_date_type'))        $grp_fields .= " , bo_sel_date_type = '{$_POST['bo_sel_date_type']}' ";
if (is_checked('chk_grp_hotgul'))           $grp_fields .= " , bo_use_hotgul = '{$_POST['bo_use_hotgul']}' ";
if (is_checked('chk_grp_anonymous'))        $grp_fields .= " , bo_use_anonymous = '{$_POST['bo_use_anonymous']}' ";
if (is_checked('chk_grp_infinite_scroll'))  $grp_fields .= " , bo_use_infinite_scroll = '{$_POST['bo_use_infinite_scroll']}' ";
if (is_checked('chk_grp_cmt_best'))         $grp_fields .= " , bo_use_cmt_best = '{$_POST['bo_use_cmt_best']}' ";
if (is_checked('chk_grp_point_explain'))    $grp_fields .= " , bo_use_point_explain = '{$_POST['bo_use_point_explain']}' ";
if (is_checked('chk_grp_list_image'))       $grp_fields .= " , bo_use_list_image = '{$_POST['bo_use_list_image']}' ";
if (is_checked('chk_grp_video_photo'))      $grp_fields .= " , bo_use_video_photo = '{$_POST['bo_use_video_photo']}' ";
if (is_checked('chk_grp_good_member'))      $grp_fields .= " , bo_use_good_member = '{$_POST['bo_use_good_member']}' ";
if (is_checked('chk_grp_nogood_member'))    $grp_fields .= " , bo_use_nogood_member = '{$_POST['bo_use_nogood_member']}' ";
if (is_checked('chk_grp_yellow_card'))      $grp_fields .= " , bo_use_yellow_card = '{$_POST['bo_use_yellow_card']}' ";
if (is_checked('chk_grp_exif'))             $grp_fields .= " , bo_use_exif = '{$_POST['bo_use_exif']}' ";
if (is_checked('chk_grp_rating'))           $grp_fields .= " , bo_use_rating = '{$_POST['bo_use_rating']}' ";
if (is_checked('chk_grp_rating_list'))      $grp_fields .= " , bo_use_rating_list = '{$_POST['bo_use_rating_list']}' ";
if (is_checked('chk_grp_rating_member'))    $grp_fields .= " , bo_use_rating_member = '{$_POST['bo_use_rating_member']}' ";
if (is_checked('chk_grp_rating_score'))     $grp_fields .= " , bo_use_rating_score = '{$_POST['bo_use_rating_score']}' ";
if (is_checked('chk_grp_rating_comment'))   $grp_fields .= " , bo_use_rating_comment = '{$_POST['bo_use_rating_comment']}' ";
if (is_checked('chk_grp_rating_point'))     $grp_fields .= " , bo_rating_point = '{$_POST['bo_rating_point']}' ";
if (is_checked('chk_grp_use_tag'))          $grp_fields .= " , bo_use_tag = '{$_POST['bo_use_tag']}' ";
if (is_checked('chk_grp_use_automove'))     $grp_fields .= " , bo_use_automove = '{$_POST['bo_use_automove']}' ";
if (is_checked('chk_grp_addon_emoticon'))   $grp_fields .= " , bo_use_addon_emoticon = '{$_POST['bo_use_addon_emoticon']}' ";
if (is_checked('chk_grp_addon_video'))      $grp_fields .= " , bo_use_addon_video = '{$_POST['bo_use_addon_video']}' ";
if (is_checked('chk_grp_addon_coding'))     $grp_fields .= " , bo_use_addon_coding = '{$_POST['bo_use_addon_coding']}' ";
if (is_checked('chk_grp_addon_soundcloud')) $grp_fields .= " , bo_use_addon_soundcloud = '{$_POST['bo_use_addon_soundcloud']}' ";
if (is_checked('chk_grp_addon_map'))        $grp_fields .= " , bo_use_addon_map = '{$_POST['bo_use_addon_map']}' ";
if (is_checked('chk_grp_addon_cmtfile'))    $grp_fields .= " , bo_use_addon_cmtfile = '{$_POST['bo_use_addon_cmtfile']}', bo_count_cmtfile = '{$_POST['bo_count_cmtfile']}' ";
if (is_checked('chk_grp_extimg'))           $grp_fields .= " , bo_use_extimg = '{$_POST['bo_use_extimg']}' ";
if (is_checked('chk_grp_cmtbest_min'))      $grp_fields .= " , bo_cmt_best_min = '{$_POST['bo_cmt_best_min']}' ";
if (is_checked('chk_grp_cmtbest_limit'))    $grp_fields .= " , bo_cmt_best_limit = '{$_POST['bo_cmt_best_limit']}' ";
if (is_checked('chk_grp_tag_level'))        $grp_fields .= " , bo_tag_level = '{$_POST['bo_tag_level']}' ";
if (is_checked('chk_grp_tag_limit'))        $grp_fields .= " , bo_tag_limit = '{$_POST['bo_tag_limit']}' ";
if (is_checked('chk_grp_automove'))         $grp_fields .= " , bo_automove = '" . serialize($_POST['bo_automove']) . "' ";
if (is_checked('chk_grp_exif_detail'))      $grp_fields .= " , bo_exif_detail = '" . serialize($_POST['bo_exif_detail']) . "' ";
if (is_checked('chk_grp_blind_limit'))      $grp_fields .= " , bo_blind_limit = '{$_POST['bo_blind_limit']}' ";
if (is_checked('chk_grp_blind_view'))       $grp_fields .= " , bo_blind_view = '{$_POST['bo_blind_view']}' ";
if (is_checked('chk_grp_blind_direct'))     $grp_fields .= " , bo_blind_direct = '{$_POST['bo_blind_direct']}' ";
if (is_checked('chk_grp_cmtpoint_target'))  $grp_fields .= " , bo_cmtpoint_target = '{$_POST['bo_cmtpoint_target']}' ";
if (is_checked('chk_grp_download_ratio'))   $grp_fields .= " , download_fee_ratio = '{$_POST['download_fee_ratio']}' ";
if (is_checked('chk_grp_firstcmt_point')) {
    $grp_fields .= " , bo_firstcmt_point        = '{$_POST['bo_firstcmt_point']}' ";
    $grp_fields .= " , bo_firstcmt_point_type   = '{$_POST['bo_firstcmt_point_type']}' ";
}
if (is_checked('chk_grp_bomb_point')) {
    $grp_fields .= " , bo_bomb_point            = '{$_POST['bo_bomb_point']}' ";
    $grp_fields .= " , bo_bomb_point_type       = '{$_POST['bo_bomb_point_type']}' ";
    $grp_fields .= " , bo_bomb_point_limit      = '{$_POST['bo_bomb_point_limit']}' ";
    $grp_fields .= " , bo_bomb_point_cnt        = '{$_POST['bo_bomb_point_cnt']}' ";
}
if (is_checked('chk_grp_lucky_point')) {
    $grp_fields .= " , bo_lucky_point           = '{$_POST['bo_lucky_point']}' ";
    $grp_fields .= " , bo_lucky_point_type      = '{$_POST['bo_lucky_point_type']}' ";
    $grp_fields .= " , bo_lucky_point_ratio     = '{$_POST['bo_lucky_point_ratio']}' ";
}
if (is_checked('chk_grp_write_limit'))  $grp_fields .= " , bo_write_limit = '{$_POST['bo_write_limit']}' ";

if ($grp_fields) {
    sql_query(" update {$g5['eyoom_board']} set bo_table = bo_table {$grp_fields} where gr_id = '{$_POST['gr_id']}' and bo_theme='{$theme}' ");
}

// 모든 게시판 동일 옵션 적용
$all_fields = '';
if (is_checked('chk_all_shop_skin'))        $all_fields .= " , use_shop_skin = '{$_POST['use_shop_skin']}' ";
if (is_checked('chk_all_gnu_skin'))         $all_fields .= " , use_gnu_skin = '{$_POST['use_gnu_skin']}' ";
if (is_checked('chk_all_bo_skin'))          $all_fields .= " , bo_skin = '{$_POST['bo_skin']}' ";
if (is_checked('chk_all_profile_photo'))    $all_fields .= " , bo_use_profile_photo = '{$_POST['bo_use_profile_photo']}' ";
if (is_checked('chk_all_date_type'))        $all_fields .= " , bo_sel_date_type = '{$_POST['bo_sel_date_type']}' ";
if (is_checked('chk_all_hotgul'))           $all_fields .= " , bo_use_hotgul = '{$_POST['bo_use_hotgul']}' ";
if (is_checked('chk_all_anonymous'))        $all_fields .= " , bo_use_anonymous = '{$_POST['bo_use_anonymous']}' ";
if (is_checked('chk_all_infinite_scroll'))  $all_fields .= " , bo_use_infinite_scroll = '{$_POST['bo_use_infinite_scroll']}' ";
if (is_checked('chk_all_cmt_best'))         $all_fields .= " , bo_use_cmt_best = '{$_POST['bo_use_cmt_best']}' ";
if (is_checked('chk_all_point_explain'))    $all_fields .= " , bo_use_point_explain = '{$_POST['bo_use_point_explain']}' ";
if (is_checked('chk_all_list_image'))       $all_fields .= " , bo_use_list_image = '{$_POST['bo_use_list_image']}' ";
if (is_checked('chk_all_video_photo'))      $all_fields .= " , bo_use_video_photo = '{$_POST['bo_use_video_photo']}' ";
if (is_checked('chk_all_good_member'))      $all_fields .= " , bo_use_good_member = '{$_POST['bo_use_good_member']}' ";
if (is_checked('chk_all_nogood_member'))    $all_fields .= " , bo_use_nogood_member = '{$_POST['bo_use_nogood_member']}' ";
if (is_checked('chk_all_yellow_card'))      $all_fields .= " , bo_use_yellow_card = '{$_POST['bo_use_yellow_card']}' ";
if (is_checked('chk_all_exif'))             $all_fields .= " , bo_use_exif = '{$_POST['bo_use_exif']}' ";
if (is_checked('chk_all_rating'))           $all_fields .= " , bo_use_rating = '{$_POST['bo_use_rating']}' ";
if (is_checked('chk_all_rating_list'))      $all_fields .= " , bo_use_rating_list = '{$_POST['bo_use_rating_list']}' ";
if (is_checked('chk_all_rating_member'))    $all_fields .= " , bo_use_rating_member = '{$_POST['bo_use_rating_member']}' ";
if (is_checked('chk_all_rating_score'))     $all_fields .= " , bo_use_rating_score = '{$_POST['bo_use_rating_score']}' ";
if (is_checked('chk_all_rating_comment'))   $all_fields .= " , bo_use_rating_comment = '{$_POST['bo_use_rating_comment']}' ";
if (is_checked('chk_all_rating_point'))     $all_fields .= " , bo_rating_point = '{$_POST['bo_rating_point']}' ";
if (is_checked('chk_all_use_tag'))          $all_fields .= " , bo_use_tag = '{$_POST['bo_use_tag']}' ";
if (is_checked('chk_all_use_automove'))     $all_fields .= " , bo_use_automove = '{$_POST['bo_use_automove']}' ";
if (is_checked('chk_all_addon_emoticon'))   $all_fields .= " , bo_use_addon_emoticon = '{$_POST['bo_use_addon_emoticon']}' ";
if (is_checked('chk_all_addon_video'))      $all_fields .= " , bo_use_addon_video = '{$_POST['bo_use_addon_video']}' ";
if (is_checked('chk_all_addon_coding'))     $all_fields .= " , bo_use_addon_coding = '{$_POST['bo_use_addon_coding']}' ";
if (is_checked('chk_all_addon_soundcloud')) $all_fields .= " , bo_use_addon_soundcloud = '{$_POST['bo_use_addon_soundcloud']}' ";
if (is_checked('chk_all_addon_map'))        $all_fields .= " , bo_use_addon_map = '{$_POST['bo_use_addon_map']}' ";
if (is_checked('chk_all_addon_cmtfile'))    $all_fields .= " , bo_use_addon_cmtfile = '{$_POST['bo_use_addon_cmtfile']}', bo_count_cmtfile = '{$_POST['bo_count_cmtfile']}' ";
if (is_checked('chk_all_extimg'))           $all_fields .= " , bo_use_extimg = '{$_POST['bo_use_extimg']}' ";
if (is_checked('chk_all_cmtbest_min'))      $all_fields .= " , bo_cmt_best_min = '{$_POST['bo_cmt_best_min']}' ";
if (is_checked('chk_all_cmtbest_limit'))    $all_fields .= " , bo_cmt_best_limit = '{$_POST['bo_cmt_best_limit']}' ";
if (is_checked('chk_all_tag_level'))        $all_fields .= " , bo_tag_level = '{$_POST['bo_tag_level']}' ";
if (is_checked('chk_all_tag_limit'))        $all_fields .= " , bo_tag_limit = '{$_POST['bo_tag_limit']}' ";
if (is_checked('chk_all_automove'))         $all_fields .= " , bo_automove = '" . serialize($_POST['bo_automove']) . "' ";
if (is_checked('chk_all_exif_detail'))      $all_fields .= " , bo_exif_detail = '" . serialize($_POST['bo_exif_detail']) . "' ";
if (is_checked('chk_all_blind_limit'))      $all_fields .= " , bo_blind_limit = '{$_POST['bo_blind_limit']}' ";
if (is_checked('chk_all_blind_view'))       $all_fields .= " , bo_blind_view = '{$_POST['bo_blind_view']}' ";
if (is_checked('chk_all_blind_direct'))     $all_fields .= " , bo_blind_direct = '{$_POST['bo_blind_direct']}' ";
if (is_checked('chk_all_cmtpoint_target'))  $all_fields .= " , bo_cmtpoint_target = '{$_POST['bo_cmtpoint_target']}' ";
if (is_checked('chk_all_download_ratio'))   $all_fields .= " , download_fee_ratio = '{$_POST['download_fee_ratio']}' ";
if (is_checked('chk_all_firstcmt_point'))   {
    $all_fields .= " , bo_firstcmt_point        = '{$_POST['bo_firstcmt_point']}' ";
    $all_fields .= " , bo_firstcmt_point_type   = '{$_POST['bo_firstcmt_point_type']}' ";
}
if (is_checked('chk_all_bomb_point')) {
    $all_fields .= " , bo_bomb_point            = '{$_POST['bo_bomb_point']}' ";
    $all_fields .= " , bo_bomb_point_type       = '{$_POST['bo_bomb_point_type']}' ";
    $all_fields .= " , bo_bomb_point_limit      = '{$_POST['bo_bomb_point_limit']}' ";
    $all_fields .= " , bo_bomb_point_cnt        = '{$_POST['bo_bomb_point_cnt']}' ";
}
if (is_checked('chk_all_lucky_point')) {
    $all_fields .= " , bo_lucky_point           = '{$_POST['bo_lucky_point']}' ";
    $all_fields .= " , bo_lucky_point_type      = '{$_POST['bo_lucky_point_type']}' ";
    $all_fields .= " , bo_lucky_point_ratio     = '{$_POST['bo_lucky_point_ratio']}' ";
}
if (is_checked('chk_all_write_limit'))  $all_fields .= " , bo_write_limit = '{$_POST['bo_write_limit']}' ";

if ($all_fields) {
    sql_query(" update {$g5['eyoom_board']} set bo_table = bo_table {$all_fields} where bo_theme='{$theme}' ");
}

$qstr = $wmode ? '&amp;wmode=1':'';
alert("정상적으로 적용하였습니다.", G5_ADMIN_URL . "/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table={$bo_table}&amp;{$qstr}");