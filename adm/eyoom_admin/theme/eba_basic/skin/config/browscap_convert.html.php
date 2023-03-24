<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/browscap_convert.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'browscap_convert';
$g5_title = '접속로그 변환';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
#processing {text-align:center;padding:100px 0}
.update_processing i {font-size:150px;margin-bottom:20px;color:#ab0000}
.check_processing i {font-size:150px;margin-bottom:20px;color:#00897b}
</style>

<div class="admin-browscap-convert">
    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>접속로그 변환</strong></div>
        <div class="adm-form-cont">
            <div id="processing">
                <p class="m-b-20">접속로그 정보를 Browscap 정보로 변환하시려면 아래 업데이트 버튼을 클릭해 주세요.</p>
                <button type="button" id="run_update" class="btn-e btn-e-lg btn-e-indigo">업데이트</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $(document).on("click", "#run_update", function() {
        $("#processing").html("<div class='update_processing'><i class='las la-exchange-alt'></i></div><p>Browscap 정보로 변환 중입니다.</p>");

        $.ajax({
            method: "GET",
            url: "<?php echo G5_ADMIN_URL; ?>/browscap_converter.php",
            data: {
                rows: "<?php echo strval($rows); ?>"
            },
            async: true,
            cache: false,
            dataType: "html",
            success: function(data) {
                $("#processing").html(data);
                $("#run_update").addClass("btn-e");
                $("#run_update").addClass("btn-e-lg");
                $("#run_update").addClass("btn-e-green");
            }
        });
    });
});
</script>