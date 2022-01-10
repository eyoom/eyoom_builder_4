<?php
@header('Content-Type: text/html; charset=utf-8');
@header('X-Robots-Tag: noindex');

$g5_path['path'] = '../..';
include_once ('../../config.php');
include_once ('./setup.head.php');

if ($exists_db_config && $exists_data_dir && $write_data_dir && $exists_eyoom_config) {
    // 필수 모듈 체크
    require_once('../../install/library.check.php');
?>
<form action="./setup.config.php" method="post" onsubmit="return frm_submit(this);">

<ul id="progressbar">
    <li class="active">초기설정</li>
    <li class="active">라이선스 동의</li>
    <li>정보입력</li>
    <li>설치완료</li>
</ul>

<h3 class="ins_inner_title">라이선스(License) 내용을 반드시 확인하십시오.</h3>

<div class="ins_inner">
    <p class="margin-bottom-15">
        <span class="color-red">*</span> 라이선스에 동의하시는 경우에만 설치가 진행됩니다.
    </p>

    <div class="ins_ta ins_license">
        <div id="ins_license" class="license_box"><?php echo nl2br(implode('', file('../../LICENSE.txt'))); ?></div>
    </div>

    <div id="ins_agree">
        <input type="checkbox" name="agree" value="동의함" id="agree">
        <label for="agree">동의합니다.</label>
    </div>
</div>

<h3 class="ins_inner_title">이윰빌더 라이선스(License)</h3>
<div class="ins_inner">
    <p class="margin-bottom-15">
        <span class="color-red">*</span> 이윰빌더 라이센스에 동의하셔야 설치가 진행됩니다.
    </p>
    <div class="ins_ta ins_license">
        <div class="license_box"><?php echo nl2br(implode('', file('../LICENSE.txt'))); ?></div>
    </div>

    <div id="ins_agree">
        <input type="checkbox" name="agree2" value="동의함" id="agree2">
        <label for="agree2">동의합니다.</label>
    </div>

    <div class="inner_btn">
        <input type="submit" value="다음">
    </div>
</div>

</form>

<script>
function frm_submit(f)
{
    if (!f.agree.checked) {
        alert("라이선스 내용에 동의하셔야 설치가 가능합니다.");
        return false;
    }
    if (!f.agree2.checked) {
        alert("이윰빌더 라이선스 내용에 동의하셔야 설치가 가능합니다.");
        return false;
    }
    return true;
}
</script>
<?php
}

include_once ('./setup.tail.php');
?>