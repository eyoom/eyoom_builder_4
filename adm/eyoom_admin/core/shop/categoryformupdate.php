<?php
/**
 * @file    /adm/eyoom_admin/core/shop/categoryformupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400200";

if ($file = $_POST['ca_include_head']) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (! $file_ext || ! in_array($file_ext, array('php', 'htm', 'html')) || !preg_match("/\.(php|htm[l]?)$/i", $file)) {
        alert("상단 파일 경로가 php, html 파일이 아닙니다.");
    }
}

if ($file = $_POST['ca_include_tail']) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (! $file_ext || ! in_array($file_ext, array('php', 'htm', 'html')) || !preg_match("/\.(php|htm[l]?)$/i", $file)) {
        alert("하단 파일 경로가 php, html 파일이 아닙니다.");
    }
}

if( isset($_POST['ca_id']) ){
    $ca_id = preg_replace('/[^0-9a-z]/i', '', $ca_id);
    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);

    if (($ca['ca_include_head'] !== $_POST['ca_include_head'] || $ca['ca_include_tail'] !== $_POST['ca_include_tail']) && function_exists('get_admin_captcha_by') && get_admin_captcha_by()){
        include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

        if (!chk_captcha()) {
            alert('자동등록방지 숫자가 틀렸습니다.');
        }
    }
}

if(!is_include_path_check($_POST['ca_include_head'], 1)) {
    alert('상단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

if(!is_include_path_check($_POST['ca_include_tail'], 1)) {
    alert('하단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

$check_keys = array('ca_skin_dir', 'ca_mobile_skin_dir', 'ca_skin', 'ca_mobile_skin', 'subca_skin', 'subca_mobile_skin'); 
foreach( $check_keys as $key ){
    if( isset($_POST[$key]) && (preg_match('#\.+(\/|\\\)#', $_POST[$key]) || preg_match('#\/data\/#i', $_POST[$key])) ){
        alert('스킨명 또는 경로에 포함시킬수 없는 문자열이 있습니다.');
    }
}

$check_str_keys = array('ca_name', 'ca_mb_id', 'ca_sell_email');
foreach( $check_str_keys as $key ){
    $$key = $_POST[$key] = strip_tags(clean_xss_attributes($_POST[$key]));
}

$ca_include_head = isset($_POST['ca_include_head']) ? preg_replace(array("#[\\\]+$#", "#(<\?php|<\?)#i"), "", substr($_POST['ca_include_head'], 0, 255)) : '';
$ca_include_tail = isset($_POST['ca_include_tail']) ? preg_replace(array("#[\\\]+$#", "#(<\?php|<\?)#i"), "", substr($_POST['ca_include_tail'], 0, 255)) : '';
$subca_include_head = isset($_POST['subca_include_head']) ? preg_replace(array("#[\\\]+$#", "#(<\?php|<\?)#i"), "", substr($_POST['subca_include_head'], 0, 255)) : '';
$subca_include_tail = isset($_POST['subca_include_tail']) ? preg_replace(array("#[\\\]+$#", "#(<\?php|<\?)#i"), "", substr($_POST['subca_include_tail'], 0, 255)) : '';

if ($file = $ca_include_head) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (!$file_ext || !in_array($file_ext, array('php', 'htm', 'html')) || !preg_match('/^.*\.(php|htm|html)$/i', $file)) {
        alert('상단 파일 경로의 확장자는 php, htm, html 만 허용합니다.');
    }
}

if ($file = $ca_include_tail) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (!$file_ext || !in_array($file_ext, array('php', 'htm', 'html')) || !preg_match('/^.*\.(php|htm|html)$/i', $file)) {
        alert('하단 파일 경로의 확장자는 php, htm, html 만 허용합니다.');
    }
}

if ($file = $subca_include_head) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (!$file_ext || !in_array($file_ext, array('php', 'htm', 'html')) || !preg_match('/^.*\.(php|htm|html)$/i', $file)) {
        alert('상단 파일 경로의 확장자는 php, htm, html 만 허용합니다.');
    }
}

if ($file = $subca_include_tail) {
    $file_ext = pathinfo($file, PATHINFO_EXTENSION);

    if (!$file_ext || !in_array($file_ext, array('php', 'htm', 'html')) || !preg_match('/^.*\.(php|htm|html)$/i', $file)) {
        alert('하단 파일 경로의 확장자는 php, htm, html 만 허용합니다.');
    }
}

if (!is_include_path_check($ca_include_head, 1)) {
    alert('상단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

if (!is_include_path_check($ca_include_tail, 1)) {
    alert('하단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

if (!is_include_path_check($subca_include_head, 1)) {
    alert('상단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

if (!is_include_path_check($subca_include_tail, 1)) {
    alert('하단 파일 경로에 포함시킬수 없는 문자열이 있습니다.');
}

if( function_exists('filter_input_include_path') ){
    $ca_include_head = filter_input_include_path($ca_include_head);
    $ca_include_tail = filter_input_include_path($ca_include_tail);
    $subca_include_head = filter_input_include_path($subca_include_head);
    $subca_include_tail = filter_input_include_path($subca_include_tail);
}

if ($w == "u" || $w == "d")
    check_demo();

auth_check_menu($auth, $sub_menu, "d");

check_admin_token();

if($_POST['ca_id'] === '1') $_POST['ca_id'] = '';

if ( $ca_id === 0 || (strlen($ca_id) == 1 && $ca_id == '0') ) $ca_id = '';

switch($_POST['mode']) {
    case "update":

        if($_POST['act_button'] == '분류생성') {

            if (!$_POST['subca_name']) {
                alert("분류명을 입력해 주세요.");
            }

            if (!$_POST['subca_skin']) {
                alert("출력스킨을 선택해 주세요.");
            }

            if (!$_POST['subca_mobile_skin']) {
                alert("모바일 출력스킨을 선택해 주세요.");
            }

            $len = strlen($ca_id);
            if ($len == 10)  alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

            $len2 = $len + 1;

            $sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from {$g5['g5_shop_category_table']} where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
            $row = sql_fetch($sql);

            $subid = base_convert((string)$row['max_subid'], 36, 10);
            $subid += 36;
            if ($subid >= 36 * 36) {
                //alert("분류를 더 이상 추가할 수 없습니다.");
                // 빈상태로
                $subid = "  ";
            }
            $subid = base_convert($subid, 10, 36);
            $subid = substr("00" . $subid, -2);
            $subid = $ca_id . $subid;

            $sublen = strlen($subid);

            $length = strlen($ca_id)+2;
            $where = " ca_id like '{$ca_id}%' and length(ca_id)=$length ";

            $sql = "select max(ca_order) as max from {$g5['g5_shop_category_table']} where $where";
            $row2 = sql_fetch($sql);
            $ca_order = $row2['max'] + 1;

            $p_subca_name = strip_tags(trim($_POST['subca_name']));
            $p_subca_name = str_replace(array("\r\n","\r","\n"), '', $p_subca_name);
            
            $set = "
                ca_id                   = '".sql_real_escape_string(strip_tags($subid))."',
                ca_order                = '".sql_real_escape_string(strip_tags($ca_order))."',
                ca_name                 = '".$p_subca_name."',
                ca_mb_id                = '".sql_real_escape_string(strip_tags($_POST['subca_mb_id']))."',
                ca_skin                 = '".sql_real_escape_string(strip_tags($_POST['subca_skin']))."',
                ca_mobile_skin          = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_skin']))."',
                ca_img_width            = '".sql_real_escape_string(strip_tags($_POST['subca_img_width']))."',
                ca_img_height           = '".sql_real_escape_string(strip_tags($_POST['subca_img_height']))."',
                ca_mobile_img_width     = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_img_width']))."',
                ca_mobile_img_height    = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_img_height']))."',
                ca_list_mod             = '".sql_real_escape_string(strip_tags($_POST['subca_list_mod']))."',
                ca_list_row             = '".sql_real_escape_string(strip_tags($_POST['subca_list_row']))."',
                ca_mobile_list_mod      = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_list_mod']))."',
                ca_mobile_list_row      = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_list_row']))."',
                ca_sell_email           = '".sql_real_escape_string(strip_tags($_POST['subca_sell_email']))."',
                ca_use                  = '".sql_real_escape_string(strip_tags($_POST['subca_use']))."',
                ca_stock_qty            = '".sql_real_escape_string(strip_tags($_POST['subca_stock_qty']))."',
                ca_explan_html          = '".sql_real_escape_string(strip_tags($_POST['subca_explan_html']))."',
                ca_head_html            = '".sql_real_escape_string(strip_tags($_POST['subca_head_html']))."',
                ca_tail_html            = '".sql_real_escape_string(strip_tags($_POST['subca_tail_html']))."',
                ca_mobile_head_html     = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_head_html']))."',
                ca_mobile_tail_html     = '".sql_real_escape_string(strip_tags($_POST['subca_mobile_tail_html']))."',
                ca_include_head         = '".sql_real_escape_string(strip_tags($subca_include_head))."',
                ca_include_tail         = '".sql_real_escape_string(strip_tags($subca_include_tail))."',
                ca_cert_use             = '".sql_real_escape_string(strip_tags($_POST['subca_cert_use']))."',
                ca_adult_use            = '".sql_real_escape_string(strip_tags($_POST['subca_adult_use']))."',
                ca_nocoupon             = '".sql_real_escape_string(strip_tags($_POST['subca_nocoupon']))."'
            ";
            $insert = "insert into {$g5['g5_shop_category_table']} set $set";
            sql_query($insert,false);
            run_event('shop_admin_category_updated', $ca_id);
        } else if ($_POST['act_button'] == '분류수정') {

            if (!$_POST['ca_name']) {
                alert("분류명을 입력해 주세요.");
            }

            $ca_order = $_POST['ca_order'] ? (int) $_POST['ca_order']: '';
            $ca_order_prev = $_POST['ca_order_prev'] ? (int) $_POST['ca_order_prev']: '';
            if (!$ca_order) alert("출력순서는 0보다 큰 자연수만 사용할 수 있습니다.");

            // 출력순서 중복값 예외처리
            if($ca_order != $ca_order_prev) {
                $_code = substr($ca_id,0,-2);
                if($_code) $where = " ca_id like '{$_code}%' and length(ca_id)='".strlen($ca_id)."' ";
                else $where = " length(ca_id)=2 ";

                if ($ca_order_prev > $ca_order) {
                    $where .= " and ca_order >= {$ca_order} and ca_order < {$ca_order_prev} ";
                    $sql = "update {$g5['g5_shop_category_table']} set ca_order = ca_order + 1 where $where ";
                } else if ($ca_order_prev < $_POST['ca_order']) {
                    $where .= " and ca_order <= {$ca_order} and ca_order > {$ca_order_prev} ";
                    $sql = "update {$g5['g5_shop_category_table']} set ca_order = ca_order - 1 where $where ";
                }
                sql_query($sql, false);
            }

            $p_ca_name = strip_tags(trim($_POST['ca_name']));
            $p_ca_name = str_replace(array("\r\n","\r","\n"), '', $p_ca_name);

            $set = "
                ca_order                = '".sql_real_escape_string(strip_tags($ca_order))."',
                ca_name                 = '".$p_ca_name."',
                ca_mb_id                = '".sql_real_escape_string(strip_tags($_POST['ca_mb_id']))."',
                ca_skin                 = '".sql_real_escape_string(strip_tags($_POST['ca_skin']))."',
                ca_mobile_skin          = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_skin']))."',
                ca_img_width            = '".sql_real_escape_string(strip_tags($_POST['ca_img_width']))."',
                ca_img_height           = '".sql_real_escape_string(strip_tags($_POST['ca_img_height']))."',
                ca_mobile_img_width     = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_img_width']))."',
                ca_mobile_img_height    = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_img_height']))."',
                ca_list_mod             = '".sql_real_escape_string(strip_tags($_POST['ca_list_mod']))."',
                ca_list_row             = '".sql_real_escape_string(strip_tags($_POST['ca_list_row']))."',
                ca_mobile_list_mod      = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_list_mod']))."',
                ca_mobile_list_row      = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_list_row']))."',
                ca_sell_email           = '".sql_real_escape_string(strip_tags($_POST['ca_sell_email']))."',
                ca_use                  = '".sql_real_escape_string(strip_tags($_POST['ca_use']))."',
                ca_stock_qty            = '".sql_real_escape_string(strip_tags($_POST['ca_stock_qty']))."',
                ca_explan_html          = '".sql_real_escape_string(strip_tags($_POST['ca_explan_html']))."',
                ca_head_html            = '".sql_real_escape_string(strip_tags($_POST['ca_head_html']))."',
                ca_tail_html            = '".sql_real_escape_string(strip_tags($_POST['ca_tail_html']))."',
                ca_mobile_head_html     = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_head_html']))."',
                ca_mobile_tail_html     = '".sql_real_escape_string(strip_tags($_POST['ca_mobile_tail_html']))."',
                ca_include_head         = '".sql_real_escape_string(strip_tags($ca_include_head))."',
                ca_include_tail         = '".sql_real_escape_string(strip_tags($ca_include_tail))."',
                ca_cert_use             = '".sql_real_escape_string(strip_tags($_POST['ca_cert_use']))."',
                ca_adult_use            = '".sql_real_escape_string(strip_tags($_POST['ca_adult_use']))."',
                ca_nocoupon             = '".sql_real_escape_string(strip_tags($_POST['ca_nocoupon']))."'
            ";

            $update = "update {$g5['g5_shop_category_table']} set $set where ca_id='{$_POST['ca_id']}' ";
            sql_query($update,false);
            run_event('shop_admin_category_updated', $ca_id);

            // 보이기, 감추기 서브에도 일괄적용
            if($_POST['ca_use'] == '0') {
                $sql = "update {$g5['g5_shop_category_table']} set ca_use = '{$_POST['ca_use']}' where ca_id like '{$_POST['ca_id']}%' ";
                sql_query($sql,false);
            }
        }

        $msg = "카테고리 설정을 적용하였습니다.";
        break;

    case "delete":
        if(!$ca_id) alert("잘못된 접근입니다.");
        $sql = "delete from {$g5['g5_shop_category_table']} where ca_id like '{$ca_id}%' ";
        sql_query($sql,false);
        run_event('shop_admin_category_deleted', $ca_id);

        $msg = "선택한 카테고리 및 하위 카테고리를 삭제하였습니다.";
        break;
}

?>
<meta charset="utf-8">
<body onload="fcategory_submit();">
<form name="fcategory" id="fcategory" method="post" action="<?php echo G5_ADMIN_URL . "/?dir=shop&pid=categorylist"; ?>">
<input type="hidden" name="id" value="<?php echo $ca_id; ?>">
<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
</form>
</body>
<script>
function fcategory_submit() {
    var f = document.fcategory;
    f.submit();
}
</script>