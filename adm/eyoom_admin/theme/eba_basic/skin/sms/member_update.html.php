<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/member_update.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'member_update';
$g5_title = '회원정보업데이트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-member-update">
    <form name="fconfig" id="mb_update_form" method="post" action="<?php echo $action_url; ?>" enctype="multipart/form-data" class="eyoom-form" >

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $g5['title']; ?></strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-warning">
                    <i class="fas fa-info-circle"></i> 새로운 회원정보로 업데이트 합니다.<br>
                    <i class="fas fa-info-circle"></i> 실행 후 '완료' 메세지가 나오기 전에 프로그램의 실행을 중지하지 마십시오.
                </p>
            </div>
        </div>
        <div class="adm-form-cont">
            <p class="li-p-sq m-b-10">마지막 업데이트 일시 : <span id="datetime"><?php echo $sms5['cf_datetime']?></span></p>
            <div id="res_msg"></div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script>
(function($){
    $( "#mb_update_form" ).submit(function( e ) {
        e.preventDefault();
        $("#res_msg").html('업데이트 중입니다. 잠시만 기다려 주십시오...');
        var params = { mtype : 'json' };
        $.ajax({
            url: $(this).attr("action"),
            cache:false,
            timeout : 30000,
            dataType:"json",
            data:params,
            success: function(data) {
                if(data.error){
                    alert( data.error );
                    $("#res_msg").html("");
                } else {
                    $("#datetime").html( data.datetime );
                    $("#res_msg").html( data.res_msg );
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
        return false;
    });
})(jQuery);
</script>