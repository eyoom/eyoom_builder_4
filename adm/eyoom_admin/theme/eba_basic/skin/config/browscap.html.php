<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/browscap.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'browscap';
$g5_title = 'Browscap 업데이트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
#processing {text-align:center;padding:100px 0}
.update_processing i {font-size:150px;margin-bottom:20px;color:#ab0000}
.check_processing i {font-size:150px;margin-bottom:20px;color:#00897b}
</style>

<div class="admin-browscap">
    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>Browscap 업데이트</strong></div>
        <div class="adm-form-cont">
            <div id="processing">
                <p class="m-b-20">Browscap 정보를 업데이트하시려면 아래 업데이트 버튼을 클릭해 주세요.</p>
                <button type="button" id="run_update" class="btn-e btn-e-lg btn-e-indigo">업데이트</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $("#run_update").on("click", function() {
        $("#processing").html("<div class='update_processing'><i class='las la-upload'></i></div><p>Browscap 정보를 업데이트 중입니다.</p>");

        $.ajax({
            url: "./browscap_update.php",
            async: true,
            cache: false,
            dataType: "html",
            success: function(data) {
                if(data != "") {
                    alert(data);
                    return false;
                }

                $("#processing").html("<div class='check_processing'><i class='lar la-check-circle'></i></div><p>Browscap 정보를 업데이트 했습니다.</p>");
            }
        });
    });
});
</script>