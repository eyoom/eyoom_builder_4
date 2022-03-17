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
                    botton.removeClass('btn-e-indigo');
                    botton.addClass('btn-e-dark');
                    botton.attr('title','친구관계를 해제합니다.');
                    botton.html('언팔로우 <i class="fas fa-times text-white"></i>');
                    botton.attr('value','unfollow');
                    Swal.fire({
                        title: "알림",
                        text: '해당 회원을 팔로우하였습니다.',
                        confirmButtonColor: "#e53935",
                        icon: "success",
                        confirmButtonText: "확인"
                    });
                }
                if (action == 'unfollow') {
                    botton.removeClass('btn-e-dark');
                    botton.addClass('btn-e-indigo');
                    botton.attr('title','친구관계를 신청합니다.');
                    botton.html('팔로우');
                    botton.attr('value','follow');
                    Swal.fire({
                        title: "알림",
                        text: '해당 회원을 팔로우 해제하였습니다.',
                        confirmButtonColor: "#e53935",
                        icon: "success",
                        confirmButtonText: "확인"
                    });
                }
            } else if (data.result == 'no'){
                Swal.fire({
                    title: "알림",
                    text: '소셜기능을 Off 시켜놓은 회원입니다.',
                    confirmButtonColor: "#e53935",
                    icon: "warning",
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
                    botton.removeClass('btn-e-teal');
                    botton.addClass('btn-e-dark');
                    botton.attr('title','구독을 해제합니다.');
                    botton.html('구독해제 <i class="fas fa-times text-white"></i>');
                    botton.attr('value','unsubscribe');
                    Swal.fire({
                        title: "알림",
                        text: '해당 회원의 글을 구독신청 하였습니다.',
                        confirmButtonColor: "#e53935",
                        icon: "success",
                        confirmButtonText: "확인"
                    });
                }
                if (action == 'unsubscribe') {
                    botton.removeClass('btn-e-dark');
                    botton.addClass('btn-e-teal');
                    botton.attr('title','구독을 신청합니다.');
                    botton.html('구독하기');
                    botton.attr('value','subscribe');
                    Swal.fire({
                        title: "알림",
                        text: '해당 회원의 글을 구독해제 하였습니다.',
                        confirmButtonColor: "#e53935",
                        icon: "success",
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

</body>
</html>