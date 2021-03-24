<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome_follower.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.myhome-follow .follow-heading {position:relative;height:40px;line-height:40px;background:#4B4B4D;color:#fff;font-size:16px;padding:0 0 0 20px;margin-bottom:20px;margin-top:40px}
.myhome-follow .follow-heading .owner-photo {position:absolute;top:-24px;right:20px;overflow:hidden;width:50px;height:50px;border:4px solid #fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.myhome-follow .follow-heading .owner-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.myhome-follow .infinite-container {position:relative;overflow:hidden;padding-bottom:50px;margin-left:-10px;margin-right:-10px}
.myhome-follow .follow-item {position:relative;float:left;width:50%;padding-top:40px;padding-left:10px;padding-right:10px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .myhome-follow .follow-item {width:100%}
}
<?php } ?>
.myhome-follow .follow-item-box {position:relative;height:auto;padding:15px;background:#fff;border:1px solid #e5e5e5;margin-bottom:20px}
.myhome-follow .follow-photo {position:absolute;top:-40px;left:15px;overflow:hidden;width:80px;height:80px;border:5px solid #fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;box-shadow: 0 0 1px rgba(0, 0, 0, 0.5)}
.myhome-follow .follow-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.myhome-follow .follow-info {position:relative}
.myhome-follow .follow-info-heading {margin-left:90px;margin-bottom:15px}
.myhome-follow .follow-info-content {position:relative}
.myhome-follow .follow-name {font-size:13px;font-weight:bold;line-height:20px}
.myhome-follow .follow-lp {font-size:12px;line-height:20px}
.myhome-follow .follow-sign {position:relative;overflow:hidden;padding:0 10px;background:#fff;border:1px dashed #e5e5e5;height:30px;line-height:30px;margin-top:10px}
.myhome-follow .follow-introduce {position:relative;overflow:hidden;padding:0 10px;background:#fff;border:1px dashed #e5e5e5;height:30px;line-height:30px;margin-top:10px}
.myhome-follow .profile-btns {position:absolute;top:0;right:0}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
</style>

<div class="myhome-follow">
    <div class="follow-heading">
        <div class="owner-photo">
            <?php if ($user['mb_photo']) { echo $user['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
        </div>
        <strong>
            <?php if ($user['mb_id'] == $member['mb_id']) { ?>나의 팔로워<?php } else { ?><?php echo $user['mb_nick']; ?> 님의 팔로워<?php } ?>
            <small class="font-normal margin-left-5">( <span class="color-green"><?php if ($user['cnt_follower']) { ?><?php echo number_format($user['cnt_follower']); ?><?php } else { ?>0<?php } ?>명</span> )</small>
        </strong>
    </div>
    <div class="infinite-container">
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        <div class="follow-item">
            <section class="follow-item-box">
                <div class="follow-photo">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $list[$i]['mb_id']; ?>" target="_blank">
                        <?php if ($list[$i]['mb_photo']) { echo $list[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                </div>
                <div class="follow-info">
                    <div class="follow-info-heading">
                        <span class="follow-name pull-left">
                            <?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?>
                        </span>
                        <span class="follow-lp pull-right">
                            레벨 : <span class="margin-right-5"><?php echo $list[$i]['level']; ?></span>
                            포인트 : <span><?php echo number_format($list[$i]['mb_point']); ?></span>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="margin-hr-10"></div>
                    <div class="follow-info-content">
                        <span class="font-size-12 display-block">가입일 : <?php echo $eb->date_format('Y.m.d',$list[$i]['mb_datetime']); ?></span>
                        <span class="font-size-12">
                            팔로워 : <span class="margin-right-10"><?php echo number_format($list[$i]['cnt_follower']); ?></span>
                            팔로윙 : <span><?php echo number_format($list[$i]['cnt_following']); ?></span>
                        </span>

                        <?php if ($config['cf_use_signature'] == '1') { ?>
                        <div class="follow-sign font-size-12"><b>서명</b> : <?php echo stripslashes($list[$i]['mb_signature']); ?></div>
                        <?php } ?>
                        <?php if ($config['cf_use_profile'] == '1') { ?>
                        <div class="follow-introduce font-size-12"><b>소개</b> : <?php echo stripslashes($list[$i]['mb_profile']); ?></div>
                        <?php } ?>

                        <?php if ($is_member) { ?>
                        <div id="follow_<?php echo $list[$i]['mb_id']; ?>" class="profile-btns">
                            <a href="javascript:;">
                            <?php if ($list[$i]['mb_id'] == $member['mb_id']) { ?>
                                <button type="button" class="btn-e btn-e-red">It's Me! <i class="fa fa-child"></i></button>
                            <?php } else { ?>
                                <?php if (!$eb->follow_check($list[$i]['mb_id'])) { ?>
                                <button type="button" class="btn-e btn-e-yellow follow_<?php echo $list[$i]['mb_id']; ?>" name="<?php echo $list[$i]['mb_id']; ?>" value="follow" title="친구맺기를 신청합니다."><i class="fa fa-check"></i> 팔로우</button>
                                <?php } else { ?>
                                <button type="button" class="btn-e btn-e-dark follow_<?php echo $list[$i]['mb_id']; ?>" name="<?php echo $list[$i]['mb_id']; ?>" value="unfollow" title="친구관계를 해제합니다."><i class="fa fa-times"></i> 팔로우 취소</button>
                                <?php } ?>
                                <div class="clearfix"></div>
                            <?php } ?>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </section>
        </div>
        <?php } ?>
        <?php if (count((array)$list) == 0) { ?>
        <div class="text-center color-grey font-size-14 margin-top-30">
            <i class="fa fa-exclamation-circle"></i> 팔로한 회원이 없습니다.
        </div>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower&page=<?php echo ($page+1); ?>"></a>
    </div>
</div>

<script type="text/javascript" src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/jquery.masonry.min.js"></script>
<script type="text/javascript" src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
$(function(){
    var $container = $('.infinite-container');

    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".infinite-container .follow-item",
        loading: {
            finishedMsg: 'END',
            img: './img/loading.gif'
        }
    },

    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.imagesLoaded(function(){
            $newElems.animate({ opacity: 1 });
        });
    });
});
</script>