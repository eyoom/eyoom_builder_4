<?php
// 고객문의 메일 (관리자 메일로 발송)
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?php echo $cs_part;  ?> 메일</title>
</head>

<body style="background-color:#fff">

<div style="margin:30px auto;width:600px;background-color:#f2f2f2;padding:20px;">
    <div style="background-color:#17171b;padding:15px 30px 20px;margin-bottom:26px;">
        <h1 style="color:#fff;font-size:30px;font-weight:800;margin-bottom:20px;">
            <?php echo $cs_part;  ?> 메일
        </h1>
        <div style="text-align:right;color:#fff;font-size:15px;font-weight:400;">
            <?php echo $config['cf_title'] ?>
        </div>
    </div>
    <div>
        <h5 style="color:#000;font-size:20px;font-weight:700;margin-bottom:15px;"><?php echo $cs_subject ?></h5>
        <p style="color:#000;font-size:15px;font-weight:400;margin-bottom:5px;">▪︎ 문의분야 : <?php echo $cs_part; ?></p>
        <p style="color:#000;font-size:15px;font-weight:400;margin-bottom:5px;">▪︎ 회사명 : <?php echo $cs_company; ?></p>
        <p style="color:#000;font-size:15px;font-weight:400;margin-bottom:5px;">▪︎ 이름 : <?php echo $cs_name; ?></p>
        <p style="color:#000;font-size:15px;font-weight:400;margin-bottom:5px;">▪︎ 연락처 : <?php echo $cs_tel; ?></p>
        <p style="color:#000;font-size:15px;font-weight:400;margin-bottom:10px;">▪︎ 이메일 : <?php echo $cs_email; ?></p>
        <div>
            <p style="color:#000;font-size:15px;font-weight:700;margin-bottom:5px">[문의내용]</p>
            <p style="color:#000;font-size:15px;font-weight:400;"><?php echo $cs_content; ?></p>
        </div>
    </div>
</div>

</body>
</html>