<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/browscap_convert.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
#processing {text-align:center;padding:100px;border:1px solid #d5d5d5;background:#fff}
</style>

<div class="admin-browscap-convert">
    <div class="adm-headline">
        <h3>접속로그 변환</h3>
    </div>

    <div id="processing">
        <p>접속로그 정보를 Browscap 정보로 변환하시려면 아래 업데이트 버튼을 클릭해 주세요.</p>
        <button type="button" id="run_update" class="btn-e btn-e-lg btn-e-green">업데이트</button>
    </div>
</div>

<script>
$(function() {
    $(document).on("click", "#run_update", function() {
        $("#processing").html("<div class='update_processing'></div><p>Browscap 정보로 변환 중입니다.</p>");

        $.ajax({
            method: "GET",
            url: "./browscap_converter.php",
            data: { rows: "<?php echo $rows; ?>" },
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