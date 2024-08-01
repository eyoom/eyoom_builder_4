<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

auth_check_menu($auth, $sub_menu, 'w');

check_demo();

$ec_code             = isset($_POST['ec_code']) ? clean_xss_tags(trim($_POST['ec_code'])) : '';
$post_me_id          = isset($_POST['me_id']) ? clean_xss_tags(trim($_POST['me_id'])) : '';
$post_ec_theme       = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])) : '';
$post_ec_state       = isset($_POST['ec_state']) ? clean_xss_tags(trim($_POST['ec_state'])) : '';
$post_ec_name        = isset($_POST['ec_name']) ? clean_xss_tags(trim($_POST['ec_name'])) : '';
$post_ec_skin        = isset($_POST['ec_skin']) ? clean_xss_tags(trim($_POST['ec_skin'])) : '';
$post_ec_link_cnt    = isset($_POST['ec_link_cnt']) ? clean_xss_tags(trim($_POST['ec_link_cnt'])) : '';
$post_ec_image_cnt   = isset($_POST['ec_image_cnt']) ? clean_xss_tags(trim($_POST['ec_image_cnt'])) : '';
$post_ec_ext_cnt     = isset($_POST['ec_ext_cnt']) ? clean_xss_tags(trim($_POST['ec_ext_cnt'])) : '';
$post_ec_link        = isset($_POST['ec_link']) ? $eb->filter_url($_POST['ec_link']) : '';
$post_ec_target      = isset($_POST['ec_target']) ? clean_xss_tags(trim($_POST['ec_target'])) : '';
$post_ec_subject     = isset($_POST['ec_subject']) && is_array($_POST['ec_subject']) ? serialize($_POST['ec_subject']) : '';
$post_ec_text        = isset($_POST['ec_text']) && is_array($_POST['ec_text']) ? serialize($_POST['ec_text']) : '';

if ($post_me_id) {
    $sql_me_id = " and me_id = '{$post_me_id}' ";
    $meinfo = sql_fetch("select * from {$g5['eyoom_menu']} where (1) {$sql_me_id} ");
}

$sql_common = "
    ec_code = '{$ec_code}',
    ec_theme = '{$post_ec_theme}',
    me_id = '{$post_me_id}',
    me_code = '{$meinfo['me_code']}',
    ec_state = '{$post_ec_state}',
    ec_skin = '{$post_ec_skin}',
    ec_name = '{$post_ec_name}',
    ec_subject = '{$post_ec_subject}',
    ec_text = '{$post_ec_text}',
    ec_link_cnt = '{$post_ec_link_cnt}',
    ec_image_cnt = '{$post_ec_image_cnt}',
    ec_ext_cnt = '{$post_ec_ext_cnt}',
    ec_link = '{$post_ec_link}',
    ec_target = '{$post_ec_target}',
";

/**
 * 이미지 업로드
 */
$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

/**
 * 기존 파일정보
 */
if ($w == 'u') {
    $sql = "select ec_image, ec_file, ec_filename from {$g5['eyoom_contents']} where ec_code = '{$ec_code}' {$sql_me_id} limit 1";
    $ec = sql_fetch($sql);
    $ec_image = $ec['ec_image'];
    $ec_file = $ec['ec_file'];
    $ec_filename = $ec['ec_filename'];
}

/**
 * 디렉토리가 없다면 생성
 */
@mkdir(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/', G5_DIR_PERMISSION);

@mkdir(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/img/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/img/', G5_DIR_PERMISSION);

@mkdir(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/file/', G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/file/', G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 이미지 삭제
 */
if ($w == 'u') {
    $ebcontents_imgfile = G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/img/'.$del_image_name;
    if ($_POST['ec_image_del'] && file_exists($ebcontents_imgfile) && !is_dir($ebcontents_imgfile)) {
        @unlink($ebcontents_imgfile);
        $ec_image = '';
    }
}

/**
 * 이미지 업로드
 */
$file_upload_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['ec_image']) && $_FILES['ec_image']['tmp_name']) {
    $allowed_mimetype = ['image/jpeg', 'image/png', 'image/gif'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    $uploaded_file = $_FILES['ec_image']['tmp_name'];
    if ($uploaded_file) {
        $file_mimetype = mime_content_type($uploaded_file);
        $file_ext = $qfile->get_file_ext($_FILES['ec_image']['name']);
        if (in_array($file_mimetype, $allowed_mimetype) && in_array($file_ext, $allowed_ext)) {
            if (is_uploaded_file($uploaded_file)) {
                $file_name = md5(time().$_FILES['ec_image']['name']).".".$file_ext;
                $dest_path = G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/img/'.$file_name;
    
                move_uploaded_file($uploaded_file, $dest_path);
    
                if (file_exists($dest_path)) {
                    chmod($dest_path, G5_FILE_PERMISSION);
                    $ec_image = $file_name;
                }
            }
        } else {
            $file_upload_msg .= $_FILES['ec_image']['name'] . '은(는) jpg/gif/png 파일이 아닙니다.\\n';
            alert($file_upload_msg);
        }
    }
}

/**
 * EB컨텐츠 대표이미지 정보
 */
$sql_common .= " ec_image = '" . $ec_image . "', ";

/**
 * 첨부파일 삭제
 */
if ($w == 'u') {
    $ebcontents_file = G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/file/'.$del_file_name;
    if ($_POST['ec_file_del'] && file_exists($ebcontents_file) && !is_dir($ebcontents_file)) {
        @unlink($ebcontents_file);
        $ec_file = '';
        $ec_filename = '';
    }
}

/**
 * 첨부파일
 */
if (is_uploaded_file($_FILES['ec_file']['tmp_name'])) {
    $upload = new upload;
    $upfile = $upload->upload_file($_FILES['ec_file'], G5_DATA_PATH.'/ebcontents/'.$post_ec_theme.'/file/');
    $ec_file = $upfile['destfile'];
    $ec_filename = $upfile['filename'];
}

/**
 * EB컨텐츠 첨부파일
 */
$sql_common .= " ec_file = '" . $ec_file . "', ";
$sql_common .= " ec_filename = '" . $ec_filename . "', ";

if ($w == '') {
    $max = sql_fetch("select max(ec_sort) as snum from {$g5['eyoom_contents']} where me_id = '{$post_me_id}' ");
    $ec_sort = $max['snum'] + 1;
    $sql_common .= " ec_sort = '{$ec_sort}', ";
    sql_query(" insert into {$g5['eyoom_contents']} set {$sql_common} ec_regdt = '".G5_TIME_YMDHIS."'");
    $ec_no = sql_insert_id();
    $msg = "EB컨텐츠 마스터를 추가하였습다.";

} else if ($w == 'u') {
    $ec_sort = isset($_POST['ec_sort']) ? clean_xss_tags(trim($_POST['ec_sort'])): '';
    $sql_common .= " ec_sort = '{$ec_sort}', ";
    $sql = " update {$g5['eyoom_contents']} set {$sql_common} ec_regdt=ec_regdt where ec_code = '{$ec_code}' {$sql_me_id} ";
    sql_query($sql);
    $msg = "EB컨텐츠 마스터를 수정하였습니다.";

} else {
    alert('제대로 된 값이 넘어오지 않았습니다.');
}

/**
 * EB콘텐츠 경로
 */
$ebcontents_path = G5_DATA_PATH.'/ebcontents/'.$post_ec_theme;

/**
 * 디렉토리가 없다면 생성
 */
if (!is_dir($ebcontents_path)) {
    @mkdir($ebcontents_path, G5_DIR_PERMISSION);
    @chmod($ebcontents_path, G5_DIR_PERMISSION);
}

/**
 * EB최신글 master 파일 경로
 */
$master_file = $ebcontents_path.'/ec_master_'.$ec_code.'.php';

/**
 * g5_eyoom_contents 테이블에서 정보 추출
 */
$ec_master = sql_fetch("select * from {$g5['eyoom_contents']} where (1) and ec_code = '{$ec_code}' limit 1 ");

/**
 * 파일 캐시
 */
$qfile->save_file('ec_master', $master_file, $ec_master);

/**
 * 모달창 닫고 리로드하기
 */
echo "<script>alert('".$msg."'); window.parent.close_modal_and_reload('".$meinfo['me_code']."');</script>";
exit;
