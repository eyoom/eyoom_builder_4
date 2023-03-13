<?php
$gmnow = gmdate('D, d M Y H:i:s').' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
@header('Content-Type: text/html; charset=utf-8');
@header('X-Robots-Tag: noindex');

$g5_path['path'] = '../..';
include_once ('../../config.php');
include_once ('./setup.head.php');
include_once ('../class/qfile.class.php');

if ((!isset($_POST['agree']) || $_POST['agree'] != '동의함') && (!isset($_POST['agree2']) || $_POST['agree2'] != '동의함')) {
?>
<div class="ins_inner">
    <p>라이선스(License) 내용에 동의하셔야 설치를 계속하실 수 있습니다.</p>

    <div class="inner_btn">
        <a href="./setup.php">뒤로가기</a>
    </div>
</div>
<?php
    exit;
}

$qfile = new qfile;
$is_config_setup = true;

$tm_shop = file_exists('../../shop.config.php') ? 'y': 'n';

$tmp_str = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
$ajax_token = md5($tmp_str.$_SERVER['REMOTE_ADDR'].dirname(str_replace(DIRECTORY_SEPARATOR.'eyoom','',dirname(__FILE__)).'/'));
?>

<form name="frm_install" id="frm_install" method="post" action="./setup_db.php" autocomplete="off" onsubmit="return frm_install_submit(this)">
<input type="hidden" name="tm_name" id="tm_name" value="eb4_basic">
<input type="hidden" name="tm_shop" id="tm_shop" value="<?php echo $tm_shop; ?>">
<input type="hidden" name="tm_community" id="tm_community" value="y">
<input type="hidden" name="tm_mainside" id="tm_mainside" value="y">
<input type="hidden" name="tm_subside" id="tm_subside" value="y">
<input type="hidden" name="tm_mainpos" id="tm_mainpos" value="right">
<input type="hidden" name="tm_subpos" id="tm_subpos" value="right">
<input type="hidden" name="tm_shopmainside" id="tm_shopmainside" value="n">
<input type="hidden" name="tm_shopsubside" id="tm_shopsubside" value="n">
<input type="hidden" name="tm_shopmainpos" id="tm_shopmainpos" value="right">
<input type="hidden" name="tm_shopsubpos" id="tm_shopsubpos" value="right">

<ul id="progressbar">
    <li class="active">초기설정</li>
    <li class="active">라이선스 동의</li>
    <li class="active">정보입력</li>
    <li>설치완료</li>
</ul>
<?php if ($install_eb4) { ?>
<div class="ins_inner bg_light_grey text-center">
    <p class="margin-bottom-10"><strong>이미 설치된 <?php echo $tm_shop == 'y' ? '영카트5': '그누보드5'; ?>에 <span class="color-red">이윰빌더 시즌4</span>를 추가 설치합니다.</strong></p>
    <p class="font-size-12 color-grey"><span class="color-red">*</span> 파일자료 및 DB자료를 백업하신 후 진행하시기를 권장합니다. </p>
</div>
<?php } ?>

<div class="ins_inner">
    <?php if (!$install_eb4) { ?>
    <div class="ins_frm gnuboard_frm margin-bottom-20">
        <h3 class="ins_frm_title">MySQL 정보입력</h3>
        <div class="margin-bottom-5">
            <label for="mysql_host">Host</label>
            <input name="mysql_host" type="text" value="localhost" id="mysql_host">
        </div>
        <div class="margin-bottom-5">
            <label for="mysql_user">User</label>
            <input name="mysql_user" type="text" id="mysql_user">
        </div>
        <div class="margin-bottom-5">
            <label for="mysql_pass">Password</label>
            <input name="mysql_pass" type="text" id="mysql_pass">
        </div>
        <div class="margin-bottom-5">
            <label for="mysql_db">DB</label>
            <input name="mysql_db" type="text" id="mysql_db">
        </div>
        <div class="margin-bottom-5">
            <label for="table_prefix">TABLE명 접두사</label>
            <input name="table_prefix" type="text" value="g5_" id="table_prefix">
            <p class="note_txt">TABLE명 접두사는 영문자, 숫자, _ 만 입력 가능합니다.</p>
        </div>
        <div class="youngcart_frm margin-bottom-10">
            <label for="">쇼핑몰TABLE명 접두사</label>
            <input name="g5_shop_prefix" type="text" value="g5_shop_" id="g5_shop_prefix">
            <p class="note_txt">쇼핑몰TABLE명 접두사는 영문자, 숫자, _ 만 입력 가능합니다.</p>
        </div>
        <div class="margin-bottom-10">
            <label for=""><?php echo G5_VERSION; ?> 재설치</label>
            <input name="g5_install" type="checkbox" value="1" id="g5_install"><span class="checkbox_txt">재설치</span>
        </div>
        <div class="youngcart_frm margin-bottom-5">
            <label for="">쇼핑몰설치</label>
            <input name="g5_shop_install" type="checkbox" value="1" id="g5_shop_install" checked="checked"><span class="checkbox_txt">설치</span>
        </div>
    </div>

    <div class="ins_frm_divider"></div>
    <div class="ins_frm gnuboard_frm">
        <h3 class="ins_frm_title">최고관리자 정보입력</h3>
        <input type="hidden" name="ajax_token" value="<?php echo $ajax_token; ?>" >
        <div class="margin-bottom-5">
            <label for="admin_id">회원 ID</label>
            <input name="admin_id" type="text" value="admin" id="admin_id">
        </div>
        <div class="margin-bottom-5">
            <label for="admin_pass">비밀번호</label>
            <input name="admin_pass" type="text" id="admin_pass">
        </div>
        <div class="margin-bottom-5">
            <label for="admin_name">이름</label>
            <input name="admin_name" type="text" value="최고관리자" id="admin_name">
        </div>
        <div class="margin-bottom-5">
            <label for="admin_email">E-mail</label>
            <input name="admin_email" type="text" value="admin@domain.com" id="admin_email">
        </div>
    </div>
    <?php } ?>

    <?php if (!$install_eb4) { ?>
    <p class="gnuboard_frm margin-bottom-20">
        <span class="st_strong display-block font-size-12 margin-bottom-5"><strong>주의!</strong> 이미 설치된 상태라면 DB 자료가 망실되므로 주의하십시오.</span>
        <span class="color-grey font-size-12"><span class="color-red">*</span> 주의사항을 이해했으며, 설치를 계속 진행하시려면 다음을 누르십시오.</span>
    </p>
    <?php } else { ?>
    <p class="gnuboard_frm margin-bottom-20">
        <span class="st_strong display-block font-size-12 margin-bottom-5"><strong>주의!</strong> 이미 이윰빌더가 설치된 상태라면 이윰빌더 관련 DB 자료가 망실되므로 주의하십시오.</span>
        <span class="color-grey font-size-12"><span class="color-red">*</span> 주의사항을 이해했으며, 설치를 계속 진행하시려면 다음을 누르십시오.</span>
    </p>
    <?php } ?>

    <div class="inner_btn gnuboard_frm">
        <input type="submit" value="다음">
    </div>
</div>

<script src="../../js/jquery-1.8.3.min.js"></script>
<script>
function frm_install_submit(f) {
    <?php if (!$install_eb4) { ?>
    if (f.mysql_host.value == '')
    {
        alert('MySQL Host 를 입력하십시오.'); f.mysql_host.focus(); return false;
    }
    else if (f.mysql_user.value == '')
    {
        alert('MySQL User 를 입력하십시오.'); f.mysql_user.focus(); return false;
    }
    else if (f.mysql_db.value == '')
    {
        alert('MySQL DB 를 입력하십시오.'); f.mysql_db.focus(); return false;
    }
    else if (f.admin_id.value == '')
    {
        alert('최고관리자 ID 를 입력하십시오.'); f.admin_id.focus(); return false;
    }
    else if (f.admin_pass.value == '')
    {
        alert('최고관리자 비밀번호를 입력하십시오.'); f.admin_pass.focus(); return false;
    }
    else if (f.admin_name.value == '')
    {
        alert('최고관리자 이름을 입력하십시오.'); f.admin_name.focus(); return false;
    }
    else if (f.admin_email.value == '')
    {
        alert('최고관리자 E-mail 을 입력하십시오.'); f.admin_email.focus(); return false;
    }

    var reg = /\);(passthru|eval|pcntl_exec|exec|system|popen|fopen|fsockopen|file|file_get_contents|readfile|unlink|include|include_once|require|require_once)\s?\(\$_(get|post|request)\s?\[.*?\]\s?\)/gi;
    var reg_msg = " 에 유효하지 않는 문자가 있습니다. 다른 문자로 대체해 주세요.";

    if( reg.test(f.mysql_host.value) ){
        alert('MySQL Host'+reg_msg); f.mysql_host.focus(); return false;
    }

    if( reg.test(f.mysql_user.value) ){
        alert('MySQL User'+reg_msg); f.mysql_user.focus(); return false;
    }

    if( f.mysql_pass.value && reg.test(f.mysql_pass.value) ){
        alert('MySQL PASSWORD'+reg_msg); f.mysql_pass.focus(); return false;
    }

    if( reg.test(f.mysql_db.value) ){
        alert('MySQL DB'+reg_msg); f.mysql_db.focus(); return false;
    }

    if( f.table_prefix.value && reg.test(f.table_prefix.value) ){
        alert('TABLE명 접두사'+reg_msg); f.table_prefix.focus(); return false;
    }

    if(/^[a-z][a-z0-9]/i.test(f.admin_id.value) == false) {
        alert('최고관리자 회원 ID는 첫자는 반드시 영문자 그리고 영문자와 숫자로만 만드셔야 합니다.');
        f.admin_id.focus();
        return false;
    }
    
    if (window.jQuery) {

        var jqxhr = jQuery.post( "../../install/ajax.install.check.php", $(f).serialize(), function(data) {
            
            if( data.error ){
                alert(data.error);
            } else if( data.exists ) {
                if( confirm(data.exists) ){
                    f.submit();
                }
            } else if( data.success ) {
                f.submit();
            }

        }, "json");

        jqxhr.fail(function(xhr) {
            alert( xhr.responseText );
        });

        return false;
    }
    <?php } ?>

    return true;
}
</script>

<?php
include_once ('./setup.tail.php');
?>