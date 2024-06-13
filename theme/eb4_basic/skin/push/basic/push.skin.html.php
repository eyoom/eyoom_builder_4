<?php
/**
 * skin file : /theme/THEME_NAME/skin/push/basic/push.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.blind {display:none}
#eyoom-push:before,#eyoom-push:after {content:"";display:block;width:0;height:0;position:absolute}
#eyoom-push:before {border-left:44px solid transparent;border-right:0 solid transparent;border-top:45px solid #656565;bottom:-45px;right:20px}
#eyoom-push:after {border-left:30px solid transparent;border-right:0 solid transparent;border-top:33px solid #fff;bottom:-33px;right:25px}
#eyoom-push {position:fixed;width:300px;height:auto;padding:15px;bottom:50px;right:30px;background:#fff;border:5px solid #666;border-radius:15px !important;z-index:1010;-webkit-box-shadow:0 6px 12px rgba(0,0,0,.175);box-shadow:0 6px 12px rgba(0,0,0,.175)}
.push-headline {position:relative;border-bottom:1px solid #a5a5a5;padding-bottom:10px}
#eyoom-push h5 {margin:0;display:inline-block;font-weight:700;font-size:1rem}
#eyoom-push .close-push {display:block;width:20px;height:20px;line-height:20px;text-align:center;position:absolute;top:0;right:0;cursor:pointer}
#eyoom-push .message-box {padding:10px;margin:10px 0;background:#f8f8f8}
#eyoom-push .config-push {font-size:.6875rem;color:#959595}
</style>

<script>
$(function(){
    var push = '<?php echo $eyoom['push_reaction']; ?>';
    var tocken;
    if (push=='y') tocken = true;
    $.setPush = function() {
        if (tocken) { tocken = setInterval($.startPush, <?php echo $eyoom['push_time']; ?>);}
    }
    $.stopPush = function() {
        clearInterval(tocken);
    }
    $.startPush = function() {
        var url = "<?php echo EYOOM_CORE_URL; ?>/member/push_info.php";
        var mb_id = '<?php echo $member['mb_id']; ?>';
        $.post(url, {mb_id:mb_id}, function(data) {
            if (data) {
                var respond   = data.respond != null ? data.respond:null;
                var memo      = data.memo != null ? data.memo:null;
                var follow    = data.follow != null ? data.follow:null;
                var unfollow  = data.unfollow != null ? data.unfollow:null;
                var subscribe = data.subscribe != null ? data.subscribe:null;
                var unsubscribe  = data.unsubscribe != null ? data.unsubscribe:null;
                var likes     = data.likes != null ? data.likes:null;
                var guest     = data.guest != null ? data.guest:null;
                var levelup   = data.levelup != null ? data.levelup:null;
                var adopt     = data.adopt != null ? data.adopt:null;

                if (respond || memo || follow || unfollow || subscribe || unsubscribe || likes || guest || levelup || adopt) {
                    open_push(respond,memo,follow,unfollow,subscribe,unsubscribe,likes,guest,levelup,adopt);
                }
            }
        },"json");
    }
    $.setPush();
});
function open_push(respond,memo,follow,unfollow,subscribe,unsubscribe,likes,guest,levelup,adopt) {
    var msg, str;
    if (respond) {
        var rid = respond['val'];
        var nick = respond['nick'] ? respond['nick']: '익명';
        var type = respond['type'];
        var alarm = respond['alarm'];
        switch(type) {
            case 'reply': str = "내글에 답글을 달았습니다."; break;
            case 'cmt': str = "내글에 댓글을 남겼습니다."; break;
            case 'cmt_re': str = "댓글에 대댓글을 남겼습니다."; break;
            case 'good': str = "내글을 추천하였습니다."; break;
            case 'nogood': str = "내글을 비추천하였습니다."; break;
            case 'goodcmt': str = "내댓글에 공감하였습니다."; break;
            case 'nogoodcmt': str = "내댓글에 비공감하였습니다."; break;
        }
        msg = "<div class='push-message'><b>"+nick+"</b>님이 "+str+"</div><div><a href='<?php echo G5_URL; ?>/mypage/respond_chk.php?rid="+rid+"' onclick='close_push();'>[바로보기]</a></div>";
    } else if (memo) {
        var meid = memo['val'];
        var nick = memo['nick'];
        var alarm = memo['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 보낸 쪽지가 도착했습니다.</div><div><a <?php if (!G5_IS_MOBILE) { ?>href='javascript:close_push();' onclick='memo_modal();'<?php } else { ?>href='javascript:close_push();' class=\"win_memo\" onclick=\"window.open('<?php echo G5_BBS_URL; ?>/memo_view.php?me_id="+meid+"&kind=recv', 'win_memo', 'left=100,top=100,width=620,height=500,scrollbars=1');\"<?php } ?>>[쪽지보기]</a></div>";
    } else if (follow) {
        var userid = follow['val'];
        var nick = follow['nick'];
        var alarm = follow['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 나를 [follow]하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?"+userid+"' onclick='close_push();'>["+nick+"님 페이지 보기]</a></div>";
    } else if (unfollow) {
        var userid = unfollow['val'];
        var nick = unfollow['nick'];
        var alarm = unfollow['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 나를 [unfollow]하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?"+userid+"' onclick='close_push();'>["+nick+"님 페이지 보기]</a></div>";
    } else if (subscribe) {
        var userid = subscribe['val'];
        var nick = subscribe['nick'];
        var alarm = subscribe['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 내글을 [구독]시작하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?"+userid+"' onclick='close_push();'>["+nick+"님 페이지 보기]</a></div>";
    } else if (unsubscribe) {
        var userid = unsubscribe['val'];
        var nick = unsubscribe['nick'];
        var alarm = unsubscribe['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 내글을 [구독해제]하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?"+userid+"' onclick='close_push();'>["+nick+"님 페이지 보기]</a></div>";
    } else if (likes) {
        var userid = likes['val'];
        var nick = likes['nick'];
        var alarm = likes['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 마이홈을 [like]하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?"+userid+"' onclick='close_push();'>["+nick+"님 페이지 보기]</a></div>";
    } else if (guest) {
        var userid = guest['val'];
        var nick = guest['nick'];
        var alarm = guest['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 마이홈에 방명록을 작성하였습니다.</div><div><a href='<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>' onclick='close_push();'>[마이홈으로 이동]</a></div>";
    } else if (levelup) {
        var updown = levelup['val'];
        var level = levelup['nick'];
        var alarm = levelup['alarm'];
        if (updown == 'up') str = '축하합니다!<br><b>'+level+'레벨</b>로 레벨업하였습니다.'; else str = '죄송합니다!<br><b>'+level+'레벨</b>로 레벨다운되었습니다.';
        msg = "<div class='push-message'>"+str+"</div><div><a href='javascript:;' onclick='close_push();'>[닫기]</a></div>";
    } else if (adopt) {
        var str = adopt['val'];
        var val = str.split('|');
        var bo_table = val[0];
        var wr_id = val[1];
        var cmt_id = val[2];
        var nick = adopt['nick'];
        var alarm = adopt['alarm'];
        msg = "<div class='push-message'><b>"+nick+"</b>님이 내가 작성한 댓글을 채택하였습니다.</div><div><a href='<?php echo G5_BBS_URL; ?>/board.php?bo_table="+bo_table+"&wr_id="+wr_id+"#c_"+cmt_id+"' onclick='close_push();'>[채택글 보러가기]</a></div>";
    }

    $("#eyoom-push").removeClass('blind');
    $("#eyoom-push .message-box").html(msg);
    if (!alarm) {
        var url = "<?php echo EYOOM_CORE_URL; ?>/member/push_alarm.php";
        document.getElementById("pushHiddenfrm").contentWindow.location.href = url;
    }
}

function close_push() {
    var url = "<?php echo EYOOM_CORE_URL; ?>/member/push_confirm.php";
    document.getElementById("pushHiddenfrm").contentWindow.location.href = url;
    $("#eyoom-push").addClass('blind');
}
</script>

<div id="eyoom-push" class="blind">
    <div class="push-headline">
        <h5>알림</h5>
        <span onclick="close_push();" class="close-push"><i class="fas fa-times"></i></span>
    </div>
    <div class="message-box"></div>
    <div class="config-push"><i class="fa fa-exclamation-circle"></i> 푸시 메세지를 받고 싶지 않을 경우 <a href="<?php echo G5_URL; ?>/mypage/config.php">[환경설정]</a>에서 설정할 수 있습니다.</div>
</div>
<iframe name="pushHiddenfrm" id="pushHiddenfrm" class="blind"></iframe>