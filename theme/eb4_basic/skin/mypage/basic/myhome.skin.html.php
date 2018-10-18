<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.my-home .my-profile-box {position:relative}
.my-home .my-wallpaper {position:relative;overflow:hidden;height:350px;background:#d5d5d5}
.my-home .my-wallpaper:after {position:absolute;top:0;bottom:0;left:0;right:0;width:100%;height:100%;content:"";background:rgba(0,0,0,0.3)}
.my-home .my-wallpaper img {display:block;width:100% \9;max-width:100%;height:auto}
.my-home .my-wallpaper .img-thumbnail {padding:0;border:0}
.my-home .my-introduce {position:absolute;top:15px;left:20px}
.my-home .my-introduce h5 {position:relative;color:#fff;font-weight:bold;font-size:20px;margin-bottom:25px}
.my-home .my-introduce h5:after {content:"";display:block;position:absolute;bottom:-10px;left:0;width:15px;height:2px;background:#FDAB29}
.my-home .my-introduce h6 {color:#fff;font-size:12px}
.my-home .my-introduce p {color:#fff;font-size:12px;width:300px;margin-top:20px}
.my-home .my-photo {position:absolute;bottom:-20px;left:20px}
.my-home .my-photo .photo {position:relative;overflow:hidden;border:5px solid #fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.my-home .my-photo .photo img {height:80px;width:80px;background-color:#fff;background-size:cover}
.my-home .my-navbar {position:absolute;bottom:15px;left:0;width:100%;background:rgba(0,0,0,0.7);text-align:right;padding:5px 15px}
.my-home .my-navbar a {color:#fff;font-size:12px;margin-left:15px}
.my-home .my-navbar a:hover {text-decoration:underline}
.my-home .profile-btns {position:absolute;top:20px;right:20px}
.my-home .profile-btns .btn-likes {position:relative}
.my-home-wallpaper .cover-img {display:block;overflow:hidden;text-align:center;margin:10px auto 20px;max-height:361px;background-color:#fff}
.my-home-wallpaper .cover-img i {width:100%;height:250px;line-height:250px;color:#fff;font-size:64px;text-align:center;background:#d5d5d5}
.my-home-wallpaper .cover-img img {display:block;width:100% \9;max-width:100%;height:auto}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:584px) {
    .my-home .my-introduce {top:10px;left:15px}
    .my-home .my-introduce h5 {font-size:15px;margin-bottom:15px}
    .my-home .my-introduce h5:after {bottom:-5px;width:10px;height:1px}
    .my-home .my-introduce h6 {margin:5px 0}
    .my-home .my-introduce p {margin-top:10px;margin-bottom:5px}
    .my-home .my-photo {bottom:10px;left:10px}
    .my-home .my-photo .photo {border:2px solid #fff}
    .my-home .my-photo .photo img {height:40px;width:40px}
    .my-home .profile-btns {top:10px;right:10px}
    .my-home .my-wallpaper {height:215px}
}
<?php } ?>
</style>

<div class="my-home">
    <div class="tab-scroll-category">
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>

        <div id="tab-category">
            <div class="category-list">
                <span <?php if (!($userpage == 'following') && !($userpage == 'follower') && !($userpage == 'friends') && !($userpage == 'guest')) { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>"><?php if ($user['mb_id'] != $member['mb_id']) { ?>[ <strong class="color-indigo"><?php echo $user['mb_nick']; ?></strong> ] 님의 홈<?php } else { ?>마이홈<?php } ?></a></span>
                <span <?php if ($userpage == 'friends') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&friends">맞팔친구</a></span>
                <span <?php if ($userpage == 'follower') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower">팔로워</a></span>
                <span <?php if ($userpage == 'following') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&following">팔로윙</a></span>
                <?php if ($is_member) { ?>
                    <?php if ($user['mb_id'] != $member['mb_id']) { ?>
                <span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>">마이홈 바로가기</a></span>
                    <?php } ?>
                <?php } ?>
                <span class="fake-span"></span>
            </div>
            <div class="controls">
                <button class="btn prev"><i class="fas fa-caret-left"></i></button>
                <button class="btn next"><i class="fas fa-caret-right"></i></button>
            </div>
        </div>
        <div class="tab-category-divider"></div>
    </div>

    <?php if (!($userpage == 'following') && !($userpage == 'follower') && !($userpage == 'friends') && !($userpage == 'guest')) { ?>
    <?php /* 프로필 박스 시작 */ ?>
    <div class="my-profile-box">
        <div class="my-wallpaper">
            <?php if ($user['wallpaper']) echo $user['wallpaper']; ?>
        </div>
        <div class="my-introduce">
            <h5><?php echo $user['mb_nick']; ?></h5>
            <h6>- 방문자수 : <span><?php echo number_format($user['myhome_hit']); ?></span></h6>
            <h6>- 좋아요수 : <span><?php echo number_format($user['cnt_likes']); ?></span></h6>
            <?php if ($user['mb_signature']) { ?>
            <p><?php echo stripslashes($user['mb_signature']); ?></p>
            <?php } ?>
        </div>
        <div class="my-navbar">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&friends" <?php if ($userpage == 'friends') { ?>class="active"<?php } ?>>
                맞팔친구 <?php if ($user['cnt_friends']) { ?><?php echo number_format($user['cnt_friends']); ?><?php } else { ?>0<?php } ?>
            </a>
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower" <?php if ($userpage == 'follower') { ?>class="active"<?php } ?>>
                팔로워 <?php if ($user['cnt_follower']) { ?><?php echo number_format($user['cnt_follower']); ?><?php } else { ?>0<?php } ?>
            </a>
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&following" <?php if ($userpage == 'following') { ?>class="active"<?php } ?>>
                팔로윙 <?php if ($user['cnt_following']) { ?><?php echo number_format($user['cnt_following']); ?><?php } else { ?>0<?php } ?>
            </a>
        </div>
        <div class="my-photo">
            <div class="photo">
                <?php if ($user['mb_photo']) { echo $user['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
            </div>
        </div>

        <?php if ($is_member) { ?>
        <div class="profile-btns">
        <?php if ($user['mb_id'] != $member['mb_id']) { ?>
            <a href="javascript:void(0);" class="btn-e btn-e-dark btn-likes tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $user['mb_nick']; ?>님의 홈 추천"><i class="far fa-thumbs-up"></i> 좋아요<span id="like_count" class="badge badge-red rounded-3x"><?php echo $user['cnt_likes']; ?></span></a>
            <?php if (!$user['follow_token']) { ?>
            <button type="button" class="btn-e btn-e-yellow follow_<?php echo $user['mb_id']; ?>" name="<?php echo $user['mb_id']; ?>" value="follow" title="친구맺기를 신청합니다."><i class="fas fa-check"></i> 팔로우 하기</button>
            <?php } else { ?>
            <button type="button" class="btn-e btn-e-dark follow_<?php echo $user['mb_id']; ?>" name="<?php echo $user['mb_id']; ?>" value="unfollow" title="친구관계를 해제합니다."><i class="fas fa-times"></i> 언팔로우</button>
            <?php } ?>
        <?php } else { ?>
            <a href="#" class="btn-e btn-e-indigo" data-toggle="modal" data-target=".my-home-wallpaper" title="배경 이미지 변경">배경변경</a>
            <a href="<?php echo G5_URL; ?>/mypage/" class="btn-e btn-e-dark">마이페이지 <i class="fas fa-plus"></i></a>
        <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php /* 프로필 박스 끝 */ ?>
    <div class="margin-bottom-40"></div>
    <?php } ?>

    <?php /* 마이홈 컨텐츠 시작 */ ?>
    <div class="my-content">
        <?php
        switch($userpage) {
            default :
                /**
                 * 마이홈 박스
                 */
                include_once(EYOOM_CORE_PATH.'/mypage/myhomebox.php');

                /**
                 * 유저 게시물 가져오기
                 */
                include_once(EYOOM_CORE_PATH.'/mypage/myhome_posts.php');
                break;
            case "following":
                include_once(EYOOM_CORE_PATH.'/mypage/myhome_following.php');
                break;
            case "follower":
                include_once(EYOOM_CORE_PATH.'/mypage/myhome_follower.php');
                break;
            case "friends":
                include_once(EYOOM_CORE_PATH.'/mypage/myhome_friends.php');
                break;
        }
        ?>
    </div>
    <?php /* 마이홈 컨텐츠 끝 */ ?>
</div>

<?php /* 배경이미지 변경 모달 시작 */ ?>
<div class="modal fade my-home-wallpaper" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="wallpaper_photo" method="post" action="<?php echo EYOOM_CORE_URL; ?>/mypage/cover_update.php" enctype="multipart/form-data" class="eyoom-form">
            <input type="hidden" name="old_wallpaper" value="<?php echo $eyoomer['myhome_cover']; ?>">
            <input type="hidden" name="back_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"><i class="far fa-image color-grey"></i> <strong>마이홈 배경 이미지 변경</strong></h4>
            </div>
            <div class="modal-body">
                <div class="cover-img">
                    <?php if ($eyoomer['myhome_cover']) { echo $eyoomer['wallpaper']; } else { ?><i class="far fa-image"></i><?php } ?>
                </div>
                <div class="alert alert-info">
                    <p>커버이미지는 이미지(gif/jpg/png) 파일만 등록가능하며, 가로X세로 1024x640픽셀 사이즈로 업로드하세요.</p>
                </div>
                <label for="file" class="label">메인 커버이미지 선택</label>
                <div class="input input-file">
                    <div class="button"><input type="file" id="file" name="wallpaper" value="배경이미지선택" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
                </div>
                <?php if ($eyoomer['myhome_cover']) { ?>
                <label class="checkbox"><input type="checkbox" name="del_wallpaper" value="1"><i></i>배경이미지 삭제</label>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button class="btn-e btn-e-lg btn-e-red" type="submit" value="저장하기"><i class="fas fa-upload"></i> 저장하기</button>
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php /* 배경이미지 변경 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
$(function() {
    var $frame = $('#tab-category');
    var $wrap  = $frame.parent();
    $frame.sly({
        horizontal: 1,
        itemNav: 'centered',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        startAt: $frame.find('.active'),
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,
        prev: $wrap.find('.prev'),
        next: $wrap.find('.next')
    });
    var tabWidth = $('#tab-category').width();
    var categoryWidth = $('.category-list').width();
    if (tabWidth < categoryWidth) {
        $('.controls').show();
    }
});

$(function(){
    $(".btn-likes").click(function(){
        var mb_id = '<?php echo $user['mb_id']; ?>';
        var url = "<?php echo EYOOM_CORE_URL; ?>/mypage/likes.ajax.php";
        $.post(url, {'user':mb_id}, function(data) {
            if (data.result == 'yes') {
                swal({
                    title: "OK!",
                    text: "'좋아요 추천'이 되었습니다.",
                    confirmButtonColor: "#87BA00",
                    type: "success",
                    confirmButtonText: "확인"
                });
                var like_count = parseInt($("#like_count").text())+1;
                $("#like_count").text(like_count);
            } else if (data.result == 'no') {
                swal({
                    title: "알림!",
                    text: "이미 '좋아요 추천'을 하였습니다.",
                    confirmButtonColor: "#FF9500",
                    type: "warning",
                    confirmButtonText: "확인"
                });
            }
        },"json");
    });
});

// 팔로우
$(".profile-btns button").click(function(){
    var action = $(this).attr('value');
    var target = $(this).attr('name');
    if (!target) return;

    var url = "<?php echo EYOOM_CORE_URL; ?>/mypage/follow.ajax.php";
    $.post(url, {'action':action,'user':target}, function(data) {
        if(data.result == 'yes') {
            var botton = $(".follow_"+target);
            if (action == 'follow') {
                botton.removeClass('btn-e-yellow');
                botton.addClass('btn-e-dark');
                botton.attr('title','친구관계를 해제합니다.');
                botton.html('<i class="fas fa-times color-white"></i> 언팔로우');
                botton.attr('value','unfollow');
                swal({
                    title: "알림",
                    text: '해당 회원을 팔로우하였습니다.',
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
            }
            if (action == 'unfollow') {
                botton.removeClass('btn-e-dark');
                botton.addClass('btn-e-yellow');
                botton.attr('title','친구관계를 신청합니다.');
                botton.html('<i class="fas fa-check color-white"></i> 팔로우');
                botton.attr('value','follow');
                swal({
                    title: "알림",
                    text: '해당 회원을 팔로우 해제하였습니다.',
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
            }
        } else if (data.result == 'no'){
            swal({
                title: "알림",
                text: '소셜기능을 Off 시켜놓은 회원입니다.',
                confirmButtonColor: "#FDAB29",
                type: "warning",
                confirmButtonText: "확인"
            });
        }
    },"json");
});
</script>