<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sly/tab_scroll_category.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.my-home .my-profile-box {position:relative}
.my-home .my-wallpaper {position:relative;overflow:hidden;height:350px;background:#959595}
.my-home .my-wallpaper img {display:block;max-width:100%;height:auto}
.my-home .my-wallpaper img:after {position:absolute;top:0;bottom:0;left:0;right:0;width:100%;height:100%;content:"";background:rgba(0,0,0,0.15)}
.my-home .my-wallpaper .img-thumbnail {padding:0;border:0}
.my-home .profile-btns {position:absolute;top:20px;right:20px}
.my-home .profile-btns .btn-likes {position:relative}
.my-home .my-introduce {position:absolute;top:20px;left:20px;color:#fff}
.my-home .my-introduce h5 {position:relative;font-weight:700;font-size:1.25rem;margin-bottom:25px}
.my-home .my-introduce h5:after {content:"";display:block;position:absolute;bottom:-10px;left:0;width:15px;height:2px;background:#ffb300}
.my-home .my-introduce h6 {margin-bottom:5px}
.my-home .my-introduce p {width:450px;margin-top:15px}
.my-home .my-photo {position:absolute;bottom:-20px;left:20px}
.my-home .my-photo .photo {position:relative;overflow:hidden;border:5px solid #fff;border-radius:50%}
.my-home .my-photo .photo img {height:80px;width:80px;background-color:#fff;background-size:cover}
.my-home .my-navbar {position:absolute;bottom:0;left:0;width:100%;background:rgba(0,0,0,0.7);text-align:right;padding:15px}
.my-home .my-navbar a {color:#fff;margin-left:15px}
.my-home .my-navbar a:hover {text-decoration:underline}
.my-home-wallpaper .cover-img {display:block;overflow:hidden;text-align:center;margin:0 auto;max-height:360px;background-color:#fff}
.my-home-wallpaper .cover-img i {width:100%;height:150px;line-height:150px;color:#fff;font-size:50px;text-align:center;background:#dadada}
.my-home-wallpaper .cover-img img {display:block;max-width:100%;height:auto}
@media (max-width:1399px) {
    .my-home .my-wallpaper {height:300px}
}
@media (max-width:1199px) {
    .my-home .my-wallpaper {height:250px}
}
@media (max-width:991px) {
    .my-home .my-wallpaper {height:auto}
    .my-home .my-wallpaper img:after {display:none}
    .my-home .my-introduce {position:relative;top:inherit;left:inherit;color:#252525;padding:15px 15px 70px;border-left:1px solid #d5d5d5;border-right:1px solid #d5d5d5}
    .my-home .my-introduce.border-top-1px {border-top:1px solid #d5d5d5}
}
@media (max-width:767px) {
    .my-home .my-introduce p {width:inherit}
}
@media (max-width:576px) {
    .my-home .profile-btns {top:10px;right:10px}
    .my-home .my-photo {bottom:-10px;left:10px}
    .my-home .my-photo .photo img {height:60px;width:60px}
}
</style>

<div class="my-home">
    <div class="container">
        <div class="tab-scroll-category">
            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>

            <div id="tab-category">
                <div class="category-list">
                    <span <?php if (!($userpage == 'following') && !($userpage == 'follower') && !($userpage == 'friends') && !($userpage == 'guest') && !($userpage == 'subscriber')) { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>"><?php if ($user['mb_id'] != $member['mb_id']) { ?>[ <strong class="color-indigo"><?php echo $user['mb_nick']; ?></strong> ] 님의 홈<?php } else { ?>마이홈<?php } ?></a></span>
                    <span <?php if ($userpage == 'friends') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&friends">맞팔친구</a></span>
                    <span <?php if ($userpage == 'follower') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower">팔로워</a></span>
                    <span <?php if ($userpage == 'following') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&following">팔로잉</a></span>
                    <span <?php if ($userpage == 'subscriber') { ?>class="active"<?php } ?>><a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&subscriber">구독회원</a></span>
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

        <?php if (!($userpage == 'following') && !($userpage == 'follower') && !($userpage == 'friends') && !($userpage == 'guest') && !($userpage == 'subscriber')) { ?>
        <?php /* 프로필 박스 시작 */ ?>
        <div class="my-profile-box">
            <div class="my-wallpaper">
                <?php if ($user['wallpaper']) echo $user['wallpaper']; ?>

                <?php if ($is_member) { ?>
                <div class="profile-btns">
                <?php if ($user['mb_id'] != $member['mb_id']) { ?>
                    <a href="javascript:void(0);" class="btn-e btn-dark btn-likes tooltips" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $user['mb_nick']; ?>님의 홈 추천"><i class="far fa-thumbs-up"></i> 좋아요<span id="like_count" class="badge badge-red"><?php echo $user['cnt_likes']; ?></span></a>
                    <?php if (!$user['follow_token']) { ?>
                    <button type="button" class="btn-e btn-indigo follow_<?php echo $user['mb_id']; ?>" name="<?php echo $user['mb_id']; ?>" value="follow" title="친구맺기를 신청합니다."><i class="fas fa-check"></i> 팔로우 하기</button>
                    <?php } else { ?>
                    <button type="button" class="btn-e btn-gray follow_<?php echo $user['mb_id']; ?>" name="<?php echo $user['mb_id']; ?>" value="unfollow" title="친구관계를 해제합니다."><i class="fas fa-times"></i> 언팔로우</button>
                    <?php } ?>
                <?php } else { ?>
                    <a href="#" class="btn-e btn-e-sm btn-e-navy" data-bs-toggle="modal" data-bs-target=".my-home-wallpaper" title="배경 이미지 변경">배경변경</a>
                    <a href="<?php echo G5_URL; ?>/mypage/" class="btn-e btn-e-sm btn-crimson">마이페이지<i class="fas fa-caret-right m-l-5"></i></a>
                <?php } ?>
                </div>
                <?php } ?>
            </div>
            <div class="my-introduce <?php if (!$user['wallpaper']) { ?>border-top-1px<?php } ?>">
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
                    팔로잉 <?php if ($user['cnt_following']) { ?><?php echo number_format($user['cnt_following']); ?><?php } else { ?>0<?php } ?>
                </a>
                <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&subscriber" <?php if ($userpage == 'subscriber') { ?>class="active"<?php } ?>>
                    구독회원 <?php if ($user['cnt_subscriber']) { ?><?php echo number_format($user['cnt_subscriber']); ?><?php } else { ?>0<?php } ?>
                </a>
            </div>
            <div class="my-photo">
                <div class="photo">
                    <?php if ($user['mb_photo']) { echo $user['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                </div>
            </div>
        </div>
        <?php /* 프로필 박스 끝 */ ?>
        <div class="m-b-40"></div>
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
                case "subscriber":
                    include_once(EYOOM_CORE_PATH.'/mypage/myhome_subscriber.php');
                    break;
            }
            ?>
        </div>
        <?php /* 마이홈 컨텐츠 끝 */ ?>
    </div>
</div>

<?php /* 배경이미지 변경 모달 시작 */ ?>
<div class="modal fade my-home-wallpaper" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form name="wallpaper_photo" method="post" action="<?php echo EYOOM_CORE_URL; ?>/mypage/cover_update.php" enctype="multipart/form-data" class="eyoom-form">
            <input type="hidden" name="old_wallpaper" value="<?php echo $eyoomer['myhome_cover']; ?>">
            <input type="hidden" name="back_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-image text-gray m-r-7"></i><strong>마이홈 배경 이미지 변경</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cover-img">
                    <?php if ($eyoomer['myhome_cover']) { echo $eyoomer['wallpaper']; } else { ?><i class="far fa-image"></i><?php } ?>
                </div>
                <?php if ($eyoomer['myhome_cover']) { ?>
                <label class="checkbox m-t-10"><input type="checkbox" name="del_wallpaper" value="1"><i></i>배경이미지 삭제</label>
                <?php } ?>
                <div class="m-b-20"></div>
                <div class="alert alert-info">
                    <p>커버이미지는 이미지(gif/jpg/png) 파일만 등록가능하며, 가로x세로 1400x520픽셀 사이즈로 업로드하세요.</p>
                </div>
                <label for="file" class="label">메인 커버이미지 선택</label>
                <div class="input">
                    <input type="file" class="form-control" id="file" name="wallpaper" value="배경이미지선택">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-e btn-e-lg btn-navy" type="submit" value="저장하기">저장하기</button>
                <button data-bs-dismiss="modal" class="btn-e btn-e-lg btn-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php /* 배경이미지 변경 모달 끝 */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/vendor_plugins.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sly/sly.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
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
                Swal.fire({
                    title: "OK!",
                    text: "'좋아요 추천'이 되었습니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "success",
                    confirmButtonText: "확인"
                });
                var like_count = parseInt($("#like_count").text())+1;
                $("#like_count").text(like_count);
            } else if (data.result == 'no') {
                Swal.fire({
                    title: "알림!",
                    text: "이미 '좋아요 추천'을 하였습니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "warning",
                    confirmButtonText: "확인"
                });
            }
        },"json");
    });
});

// 팔로우
$(document).on('click', '.profile-btns button', function() {
    var action = $(this).attr('value');
    var target = $(this).attr('name');
    if (!target) return;

    var url = "<?php echo EYOOM_CORE_URL; ?>/mypage/follow.ajax.php";
    $.post(url, {'action': action, 'user': target}, function(data) {
        if (data.result == 'yes') {
            var button = $(".follow_" + target);
            if (action == 'follow') {
                button.removeClass('btn-e-teal').addClass('btn-e-gray')
                    .attr('title', '팔로우를 해제합니다.')
                    .html('<i class="fas fa-times text-white m-r-5"></i>팔로우 해제')
                    .attr('value', 'unfollow');
                Swal.fire({
                    title: "알림",
                    text: '해당 회원을 팔로우하였습니다.',
                    confirmButtonColor: "#ab0000",
                    icon: "success",
                    confirmButtonText: "확인"
                });
            } else if (action == 'unfollow') {
                button.removeClass('btn-e-gray').addClass('btn-e-teal')
                    .attr('title', '팔로우를 신청합니다.')
                    .html('<i class="fas fa-check text-white m-r-5"></i>팔로우')
                    .attr('value', 'follow');
                Swal.fire({
                    title: "알림",
                    text: '해당 회원을 팔로우 해제하였습니다.',
                    confirmButtonColor: "#ab0000",
                    icon: "success",
                    confirmButtonText: "확인"
                });
            }
        } else if (data.result == 'no') {
            Swal.fire({
                title: "알림",
                text: '소셜기능을 Off 시켜놓은 회원입니다.',
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
        }
    }, "json");
});
</script>