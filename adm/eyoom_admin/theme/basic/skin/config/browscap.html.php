<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/browscap.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
#processing {text-align:center;padding:100px;border:1px solid #d5d5d5;background:#fff}
.update_processing i {font-size:150px;margin-bottom:30px;color:#FF6F52}
.check_processing i {font-size:150px;margin-bottom:30px;color:#B3D84E}
</style>

<div class="admin-browscap">
    <div class="adm-headline">
        <h3>Browscap 업데이트</h3>
    </div>

    <div id="processing">
        <p>Browscap 정보를 업데이트하시려면 아래 업데이트 버튼을 클릭해 주세요.</p>
        <button type="button" id="run_update" class="btn-e btn-e-lg btn-e-red">업데이트</button>
    </div>
</div>

<script>
$(function() {
    $("#run_update").on("click", function() {
        $("#processing").html("<div class='update_processing'></div><p>Browscap 정보를 업데이트 중입니다.</p>");

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

                $("#processing").html("<div class='check_processing'></div><p>Browscap 정보를 업데이트 했습니다.</p>");
            }
        });
    });
});
</script>