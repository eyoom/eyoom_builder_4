<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (!isset($title)) $title = G5_VERSION." &amp; 이윰빌더 시즌4 설치";
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<title><?php echo $title;?></title>
<link rel="stylesheet" href="./setup.css">
</head>
<body>

<div id="setup_box">

<div id="ins_bar">
    <h1><?php echo $title;?></h1>
</div>

<?php
// data 폴더
$data_path = '../../' . G5_DATA_DIR;

/*************************************
 * 파일이 존재한다면 설치할 수 없음
 ************************************/
$exists_db_config = true;
$dbconfig_file = $data_path . '/' . G5_DBCONFIG_FILE;

if (file_exists($dbconfig_file) && !file_exists($data_path . '/eyoom.config.php')) {
    $install_eb4 = true; // 이윰빌더만 설치하기
    include $dbconfig_file;
} else {
    $install_eb4 = false;
}

if (file_exists($dbconfig_file) && file_exists($data_path . '/eyoom.config.php')) {
?>
<h3 class="ins_inner_title margin-bottom-10"><?php echo G5_VERSION; ?> 프로그램이 이미 설치되어 있습니다.</h3>

<div class="ins_inner">
    <p>프로그램이 이미 설치되어 있습니다.<br />새로 설치하시려면 다음 파일을 삭제 하신 후 새로고침 하십시오.</p>
    <ul>
        <li><?php echo $dbconfig_file ?></li>
    </ul>
</div>
<?php
    $exists_db_config = false;
}

/*************************************
 * data 디렉토리가 있는가?
 ************************************/
$exists_data_dir = true;
if (!is_dir($data_path))
{
?>
<ul id="progressbar">
    <li class="active">초기설정</li>
    <li>라이선스 동의</li>
    <li>정보입력</li>
    <li>설치완료</li>
</ul>

<h3 class="ins_inner_title">설치를 위해 아래 내용을 확인해 주십시오.</h3>

<div class="ins_inner">
    <p>
        <strong>루트 디렉토리에 아래로 <?php echo G5_DATA_DIR ?> 디렉토리를 생성하여 주십시오.</strong><br />
        (common.php 파일이 있는곳이 루트 디렉토리 입니다.)<br /><br />
        $> mkdir <?php echo G5_DATA_DIR ?><br /><br />
        윈도우의 경우 data 폴더를 하나 생성해 주시기 바랍니다.<br /><br />
        위 명령 실행후 브라우저를 <strong>새로고침</strong> 하십시오.
    </p>
</div>
<?php
    $exists_data_dir = false;
}

/*************************************
 * data 디렉토리에 파일 생성 가능한지 검사.
 ************************************/
$write_data_dir = true;
if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == 'cgi') {
        if (!(is_readable($data_path) && is_executable($data_path)))
        {
        ?>
<div class="ins_inner">
    <p>
        <strong><?php echo G5_DATA_DIR ?> 디렉토리의 퍼미션을 705로 변경하여 주십시오.</strong><br /><br />
        $> chmod 705 <?php echo G5_DATA_DIR ?> 또는 chmod uo+rx <?php echo G5_DATA_DIR ?><br /><br />
        위 명령 실행후 브라우저를 <strong>새로고침</strong> 하십시오.
    </p>
</div>
        <?php
            $write_data_dir = false;
            exit;
        }
    } else {
        if (!(is_readable($data_path) && is_writeable($data_path) && is_executable($data_path)))
        {
            if ($exists_data_dir) {
        ?>
<ul id="progressbar">
    <li class="active">초기설정</li>
    <li>라이선스 동의</li>
    <li>정보입력</li>
    <li>설치완료</li>
</ul>

<h3 class="ins_inner_title">설치를 위해 아래 내용을 확인해 주십시오.</h3>
        <?php
            }
        ?>

<div class="ins_inner">
    <p>
        <strong><?php echo G5_DATA_DIR ?> 디렉토리의 퍼미션을 707로 변경하여 주십시오.</strong><br /><br />
        $> chmod 707 <?php echo G5_DATA_DIR ?> 또는 chmod uo+rwx <?php echo G5_DATA_DIR ?><br /><br />
        위 명령 실행후 브라우저를 <strong>새로고침</strong> 하십시오.
    </p>
</div>
        <?php
            $write_data_dir = false;
        }
    }
}

/*************************************
 * eyoom 환경설정 파일 체크
 ************************************/
$exists_eyoom_config = true;
$eyoom_config_file  = $data_path . '/eyoom.config.php';
$levelset_config    = $data_path . '/eyoom.levelset.php';
$levelinfo_config   = $data_path . '/eyoom.levelinfo.php';

if (file_exists($eyoom_config_file)) {
?>
<h3 class="ins_inner_title margin-bottom-10">이윰빌더가 이미 설치되어 있습니다.</h3>

<div class="ins_inner">
    <p>새로 설치하시려면 다음 파일을 삭제 하신 후 새로고침 하십시오.</p>
    <ul>
        <li><?php echo $eyoom_config_file ?></li>
    </ul>
</div>

<div class="ins_inner">
    <p><b class="color-red">[알림]</b> 현재 페이지가 지속적으로 나온다면 브라우저의 쿠키를 삭제하시고 새로고침해 주세요.</p>
</div>

<div class="inner_btn margin-bottom-20">
    <a href="../../index.php" class="inner_abtn">메인페이지로 이동</a>
</div>

<?php
    $exists_eyoom_config = false;
}
?>
