<?php
/**
 * theme file : /theme/THEME_NAME/tail.sub.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<script>
$(function(){
    // 팔로우
    $("#follow button").click(function(){
        var action = $(this).attr('value');
        var target = $(this).attr('name');

        var url = "<?php echo EYOOM_CORE_URL; ?>/mypage/follow.ajax.php";
        $.post(url, {'action':action,'user':target}, function(data) {
            if(data.result == 'yes') {
                var botton = $(".follow_"+target);
                if (action == 'follow') {
                    botton.removeClass('btn-e-yellow');
                    botton.addClass('btn-e-dark');
                    botton.attr('title','친구관계를 해제합니다.');
                    botton.html('언팔로우 <i class="fas fa-times color-white"></i>');
                    botton.attr('value','unfollow');
                    swal({
                        title: "알림",
                        text: '해당 회원을 팔로우하였습니다.',
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                }
                if (action == 'unfollow') {
                    botton.removeClass('btn-e-dark');
                    botton.addClass('btn-e-yellow');
                    botton.attr('title','친구관계를 신청합니다.');
                    botton.html('팔로우 <i class="fas fa-smile color-white"></i>');
                    botton.attr('value','follow');
                    swal({
                        title: "알림",
                        text: '해당 회원을 팔로우 해제하였습니다.',
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                }
            } else if (data.result == 'no'){
                swal({
                    title: "알림",
                    text: '소셜기능을 Off 시켜놓은 회원입니다.',
                    confirmButtonColor: "#FF4848",
                    type: "warning",
                    confirmButtonText: "확인"
                });
            }
        },"json");
    });

    // 구독
    $("#subscribe button").click(function(){
        var action = $(this).attr('value');
        var target = $(this).attr('name');

        var url = "<?php echo EYOOM_CORE_URL; ?>/mypage/subscribe.ajax.php";
        $.post(url, {'action':action,'user':target}, function(data) {
            if(data.result == 'yes') {
                var botton = $(".subscribe_"+target);
                if (action == 'subscribe') {
                    botton.removeClass('btn-e-orange');
                    botton.addClass('btn-e-dark');
                    botton.attr('title','구독을 해제합니다.');
                    botton.html('구독해제 <i class="fas fa-times color-white"></i>');
                    botton.attr('value','unsubscribe');
                    swal({
                        title: "알림",
                        text: '해당 회원의 글을 구독신청 하였습니다.',
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                }
                if (action == 'unsubscribe') {
                    botton.removeClass('btn-e-dark');
                    botton.addClass('btn-e-yellow');
                    botton.attr('title','구독을 신청합니다.');
                    botton.html('구독하기 <i class="far fa-address-book color-white"></i>');
                    botton.attr('value','subscribe');
                    swal({
                        title: "알림",
                        text: '해당 회원의 글을 구독해제 하였습니다.',
                        confirmButtonColor: "#FF4848",
                        type: "warning",
                        confirmButtonText: "확인"
                    });
                }
            }
        },"json");
    });

});
</script>

<?php if ($is_admin == 'super') {  ?>
<?php if (isset($co_id) && $co_id) { ?>
<script>
$(function() {
    $(".ctt_admin a.btn_admin").attr('href', '<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=contentform&co_id=<?php echo $co_id?>&w=u');
});
</script>
<?php } ?>
<!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time; ?><br></div> -->
<?php }  ?>

<!-- ie6,7에서 사이드뷰가 게시판 목록에서 아래 사이드뷰에 가려지는 현상 수정 -->
<!--[if lte IE 7]>
<script>
$(function() {
    var $sv_use = $(".sv_use");
    var count = $sv_use.length;

    $sv_use.each(function() {
        $(this).css("z-index", count);
        $(this).css("position", "relative");
        count = count - 1;
    });
});
</script>
<![endif]-->

</body>
</html>