<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_itemform_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$iw             = isset($_POST['iw']) ? clean_xss_tags(trim($_POST['iw'])) : '';
$li_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$li_no          = isset($_POST['li_no']) ? clean_xss_tags(trim($_POST['li_no'])) : '';
$el_code        = isset($_POST['el_code']) ? clean_xss_tags(trim($_POST['el_code'])) : '';
$li_state       = isset($_POST['li_state']) ? clean_xss_tags(trim($_POST['li_state'])) : '';
$li_sort        = isset($_POST['li_sort']) ? clean_xss_tags(trim($_POST['li_sort'])) : '';
$li_title       = isset($_POST['li_title']) ? clean_xss_tags(trim($_POST['li_title'])) : '';
$li_link        = isset($_POST['li_link']) ? $eb->filter_url($_POST['li_link']) : '';
$li_target      = isset($_POST['li_target']) ? clean_xss_tags(trim($_POST['li_target'])) : '';
$li_bo_table    = isset($_POST['li_bo_table']) ? clean_xss_tags(trim($_POST['li_bo_table'])) : '';
$li_ca_name     = isset($_POST['li_ca_name']) ? clean_xss_tags(trim($_POST['li_ca_name'])) : '';
$li_gr_id       = isset($_POST['li_gr_id']) ? clean_xss_tags(trim($_POST['li_gr_id'])) : '';
$li_include     = isset($_POST['li_include']) ? clean_xss_tags(trim($_POST['li_include'])) : '';
$li_exclude     = isset($_POST['li_exclude']) ? clean_xss_tags(trim($_POST['li_exclude'])) : '';
$li_count       = isset($_POST['li_count']) ? clean_xss_tags(trim($_POST['li_count'])) : '';
$li_depart      = isset($_POST['li_depart']) ? clean_xss_tags(trim($_POST['li_depart'])) : '';
$li_period      = isset($_POST['li_period']) ? clean_xss_tags(trim($_POST['li_period'])) : '';
$li_cut_subject = isset($_POST['li_cut_subject']) ? clean_xss_tags(trim($_POST['li_cut_subject'])) : '';
$li_type        = isset($_POST['li_type']) ? clean_xss_tags(trim($_POST['li_type'])) : '';
$li_img_view    = isset($_POST['li_img_view']) ? clean_xss_tags(trim($_POST['li_img_view'])) : '';
$li_img_width   = isset($_POST['li_img_width']) ? clean_xss_tags(trim($_POST['li_img_width'])) : '';
$li_img_height  = isset($_POST['li_img_height']) ? clean_xss_tags(trim($_POST['li_img_height'])) : '';
$li_content     = isset($_POST['li_content']) ? clean_xss_tags(trim($_POST['li_content'])) : '';
$li_cut_content = isset($_POST['li_cut_content']) ? clean_xss_tags(trim($_POST['li_cut_content'])) : '';
$li_bo_subject  = isset($_POST['li_bo_subject']) ? clean_xss_tags(trim($_POST['li_bo_subject'])) : '';
$li_ca_view     = isset($_POST['li_ca_view']) ? clean_xss_tags(trim($_POST['li_ca_view'])) : '';
$li_best        = isset($_POST['li_best']) ? clean_xss_tags(trim($_POST['li_best'])) : '';
$li_random      = isset($_POST['li_random']) ? clean_xss_tags(trim($_POST['li_random'])) : '';
$li_mbname_view = isset($_POST['li_mbname_view']) ? clean_xss_tags(trim($_POST['li_mbname_view'])) : '';
$li_photo       = isset($_POST['li_photo']) ? clean_xss_tags(trim($_POST['li_photo'])) : '';
$li_use_date    = isset($_POST['li_use_date']) ? clean_xss_tags(trim($_POST['li_use_date'])) : '';
$li_date_type   = isset($_POST['li_date_type']) ? clean_xss_tags(trim($_POST['li_date_type'])) : '';
$li_date_kind   = isset($_POST['li_date_kind']) ? clean_xss_tags(trim($_POST['li_date_kind'])) : '';
$li_view_level  = isset($_POST['li_view_leveliw']) ? clean_xss_tags(trim($_POST['li_view_level'])) : '';
$li_renew       = isset($_POST['li_renew']) ? clean_xss_tags(trim($_POST['li_renew'])) : '';

/**
 * 포함 게시판 테이블
 */
$in_tables = array();
$bo_include = explode(',', $li_include);
if (is_array($bo_include)) {
    foreach ($bo_include as $k => $bo_table) {
        $in_tables[$k] = trim($bo_table);
    }
}

/**
 * 그룹 게시판 테이블
 */
$gr_tables = array();
if ($li_gr_id) {
    $gr_tables = $bbs->group_bo_table($li_gr_id);
}

/**
 * 대상 테이블
 */
$li_table = $li_include || $li_gr_id ? array_merge($gr_tables, $in_tables): array();

/**
 * 단일 테이블 설정
 */
if ($li_bo_table) {
    $li_table[] = $li_bo_table;
}

/**
 * 대상 테이블이 없다면, 모든 게시판에서 추출을 의미 함
 */
if (count((array)$li_table) == 0) {
    $bo_info = $bbs->get_bo_subject();
    $li_table = array_keys($bo_info);
}

/**
 * 최신글 대상 게시판은 유니크해야 함
 */
$li_table = array_unique($li_table);

/**
 * 제외 게시판 && Empty Value 배열 제거
 */
$ex_tables = array();
$bo_exclude = explode(',', $li_exclude);
if (is_array($bo_exclude)) {
    foreach ($bo_exclude as $k => $bo_table) {
        $ex_tables[$k] = trim($bo_table);
    }
}
$li_table = array_filter(array_diff($li_table, $ex_tables));

/**
 * 여러 게시판에서 추출한다면 분류 추출은 무시
 */
if (is_array($li_table) && count($li_table) > 1) {
    $li_ca_name = '';
}

/**
 * 최신글 대상 게시판 테이블
 */
$li_tables = implode(',', $li_table);

/**
 * 최신게시물 삭제일 조정 및 적용하기
 */
if ($li_renew == 'y' && is_array($li_table)) {
    $li_fields = "wr_id, wr_parent, wr_datetime, mb_id, ca_name, wr_approval, wr_hit, wr_comment";
    
    foreach ($li_table as $k => $_bo_table) {
        unset($wr_new);

        // 승인게시물 관련 필드 추가
        $bbs->add_approval_field($_bo_table);

        $write_table = $g5['write_prefix'] . $_bo_table;
        $sql = "select wr_id from {$g5['board_new_table']} where bo_table = '{$_bo_table}' ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $wr_new[$i] = $row['wr_id'];
        }
        
        $sql2 = "select {$li_fields} from {$write_table} where (TO_DAYS('".G5_TIME_YMDHIS."') - TO_DAYS(wr_datetime)) < '{$config['cf_new_del']}'";

        $result2 = sql_query($sql2);
        for ($i=0; $row2=sql_fetch_array($result2); $i++) {
            unset($upset, $insert);
            if (isset($wr_new) && is_array($wr_new) && in_array($row2['wr_id'], $wr_new)) continue;
            $upset = "
                bo_table = '{$_bo_table}',
                wr_id = '{$row2['wr_id']}',
                wr_parent = '{$row2['wr_parent']}',
                bn_datetime = '{$row2['wr_datetime']}',
                mb_id = '{$row2['mb_id']}',
                ca_name = '{$row2['ca_name']}',
                wr_approval = '{$row2['wr_approval']}',
                wr_hit = '{$row2['wr_hit']}',
                wr_comment = '{$row2['wr_comment']}'
            ";
            $insert = "insert into {$g5['board_new_table']} set {$upset}";
            sql_query($insert);
        }
    }
}

$sql_common = "
    el_code = '{$el_code}',
    li_theme = '{$li_theme}',
    li_state = '{$li_state}',
    li_sort = '{$li_sort}',
    li_title = '{$li_title}',
    li_link = '{$li_link}',
    li_target = '{$li_target}',
    li_bo_table = '{$li_bo_table}',
    li_ca_name = '{$li_ca_name}',
    li_gr_id = '{$li_gr_id}',
    li_include = '{$li_include}',
    li_exclude = '{$li_exclude}',
    li_tables = '{$li_tables}',
    li_count = '{$li_count}',
    li_depart = '{$li_depart}',
    li_period = '{$li_period}',
    li_cut_subject = '{$li_cut_subject}',
    li_type = '{$li_type}',
    li_img_view = '{$li_img_view}',
    li_img_width = '{$li_img_width}',
    li_img_height = '{$li_img_height}',
    li_content = '{$li_content}',
    li_cut_content = '{$li_cut_content}',
    li_bo_subject = '{$li_bo_subject}',
    li_ca_view = '{$li_ca_view}',
    li_best = '{$li_best}',
    li_random = '{$li_random}',
    li_mbname_view = '{$li_mbname_view}',
    li_photo = '{$li_photo}',
    li_use_date = '{$li_use_date}',
    li_date_type = '{$li_date_type}',
    li_date_kind = '{$li_date_kind}',
    li_view_level = '{$li_view_level}',
";

if ($iw == '') {
    $sql = "insert into {$g5['eyoom_latest_item']} set {$sql_common} li_regdt = '".G5_TIME_YMDHIS."'";
    sql_query($sql);
    $li_no = sql_insert_id();
    $msg = "EB최신글 아이템을 추가하였습니다.";

} else if ($iw == 'u') {
    $sql = " update {$g5['eyoom_latest_item']} set {$sql_common} li_regdt=li_regdt where li_no = '{$li_no}' ";
    sql_query($sql);
    $msg = "EB최신글 아이템을 정상적으로 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * 설정된 정보를 기준으로 최신글 파일 생성 - 캐쉬 기능
 */
$latest->save_item($el_code, $li_theme);

/**
 * 최신글 레코드 파일 생성
 */
$latest->make_cache_data($el_code, $li_theme, $li_no);

/**
 * 모달창 닫고 리로드하기
 */
if ($wmode) {
    echo "<script>window.parent.close_modal_and_reload();</script>";
    exit;
}

//alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_itemform&amp;el_code='.$el_code.'&amp;'.$qstr.'&amp;thema='.$li_theme.'&amp;w=u&amp;iw=u&amp;wmode=1&amp;li_no='.$li_no);