<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhome_subscriber.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.myhome-follow .follow-heading {position:relative;height:60px;line-height:60px;background:#454545;color:#fff;font-size:1.125rem;padding:0 0 0 20px;margin-bottom:20px;margin-top:40px}
.myhome-follow .follow-heading .owner-photo {position:absolute;top:-30px;right:20px;overflow:hidden;width:60px;height:60px;border:4px solid #fff;border-radius:50%}
.myhome-follow .follow-heading .owner-photo img {display:block;max-width:100%;height:auto}
.myhome-follow .infinite-container {position:relative;overflow:hidden;padding-bottom:50px;margin-left:-10px;margin-right:-10px}
.myhome-follow .follow-item {position:relative;float:left;width:50%;padding-top:40px;padding-left:10px;padding-right:10px}
.myhome-follow .follow-item-box {position:relative;height:auto;padding:15px;background:#fff;border:1px solid #d5d5d5;margin-bottom:20px}
.myhome-follow .follow-photo {position:absolute;top:-40px;left:15px;overflow:hidden;width:80px;height:80px;border:5px solid #fff;border-radius:50%;box-shadow:0 0 1px rgba(0, 0, 0, 0.7);z-index:1}
.myhome-follow .follow-photo img {display:block;max-width:100%;height:auto}
.myhome-follow .follow-info {position:relative}
.myhome-follow .follow-info-heading {margin-left:90px;margin-bottom:15px}
.myhome-follow .follow-info-content {position:relative}
.myhome-follow .follow-info-content .margin-hr-15 {border-top:1px dotted #f2f2f2}
.myhome-follow .follow-name {line-height:20px}
.myhome-follow .follow-name a {color:#252525}
.myhome-follow .follow-lp {line-height:20px}
.myhome-follow .follow-sign {position:relative;color:#757575}
.myhome-follow .follow-sign strong {color:#252525}
.myhome-follow .follow-introduce {position:relative;color:#757575}
.myhome-follow .follow-introduce strong {color:#252525}
.myhome-follow .profile-btns {position:absolute;top:0;right:0}
#infscr-loading {text-align:center;z-index:100;position:absolute;left:50%;bottom:0;width:200px;margin-left:-100px;padding:8px 0;background:#000;opacity:0.8;color:#fff}
@media (max-width:767px) {
    .myhome-follow .follow-item {width:100%}
}
</style>

<div class="myhome-follow">
    <div class="follow-heading">
        <div class="owner-photo">
            <?php if ($user['mb_photo']) {  echo $user['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
        </div>
        <strong>
            구독회원
            <span class="m-l-5">[ <span class="text-blue"><?php if ($user['cnt_subscriber']) { ?><?php echo number_format($user['cnt_subscriber']); ?><?php } else { ?>0<?php } ?>명</span> ]</span>
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
                        <span class="follow-name float-start">
                            <?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?>
                        </span>
                        <span class="follow-lp float-end" style="font-size:.875rem">
                            레벨: <span class="m-r-5"><?php echo $list[$i]['level']; ?></span>
                            포인트: <span><?php echo number_format($list[$i]['mb_point']); ?></span>
                        </span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="margin-hr-10"></div>
                    <div class="follow-info-content">
                        <span class="display-block m-b-5">가입일 : <?php echo $eb->date_format('Y.m.d',$list[$i]['mb_datetime']); ?></span>
                        <span>
                            팔로워 : <span class="m-r-10"><?php echo number_format($list[$i]['follower']); ?></span>
                            팔로윙 : <span><?php echo number_format($list[$i]['subscriber']); ?></span>
                        </span>

                        <?php if ($config['cf_use_signature'] == '1') { ?>
                        <div class="margin-hr-10"></div>
                        <div class="follow-sign ellipsis">서명 : <?php if($list[$i]['mb_signature']) { ?><?php echo stripslashes($list[$i]['mb_signature']); ?><?php } else { ?><span class="text-light-gray">입력한 서명이 없습니다.</span><?php } ?></div>
                        <?php } ?>
                        <?php if ($config['cf_use_profile'] == '1') { ?>
                        <div class="margin-hr-10"></div>
                        <div class="follow-introduce ellipsis">소개 : <?php if($list[$i]['mb_profile']) { ?><?php echo stripslashes($list[$i]['mb_profile']); ?><?php } else { ?><span class="text-light-gray">입력한 소개가 없습니다.</span><?php } ?></div>
                        <?php } ?>

                        <?php if ($is_member) { ?>
                        <div id="follow_<?php echo $list[$i]['mb_id']; ?>" class="profile-btns">
                            <a href="javascript:;">
                            <?php if ($list[$i]['mb_id'] == $member['mb_id']) { ?>
                                <button type="button" class="btn-e btn-e-red">It's Me!<i class="fas fa-child m-l-5"></i></button>
                            <?php } else { ?>
                                <?php if (!$eb->follow_check($list[$i]['mb_id'])) { ?>
                                <button type="button" class="btn-e btn-e-teal follow_<?php echo $list[$i]['mb_id']; ?>" name="<?php echo $list[$i]['mb_id']; ?>" value="follow" title="친구맺기를 신청합니다."><i class="fas fa-check m-r-5"></i>팔로우</button>
                                <?php } else { ?>
                                <button type="button" class="btn-e btn-e-gray follow_<?php echo $list[$i]['mb_id']; ?>" name="<?php echo $list[$i]['mb_id']; ?>" value="unfollow" title="친구관계를 해제합니다."><i class="fas fa-times m-r-5"></i>팔로우 해제</button>
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
        <div class="text-center text-gray m-t-30">
            <i class="fas fa-exclamation-circle"></i> 구독회원이 없습니다.
        </div>
        <?php } ?>
    </div>
    <div id="infinite_pagination">
        <a class="next" href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&subscriber&page=<?php echo ($page+1); ?>"></a>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<script>
$(function(){
    var $container = $('.infinite-container');

    $container.infinitescroll({
        navSelector  : "#infinite_pagination",
        nextSelector : "#infinite_pagination .next",
        itemSelector : ".infinite-container .follow-item",
        loading: {
            finishedMsg: 'END',
            img: '<?php echo $eyoom_skin_url['mypage']; ?>/img/loading.gif'
        }
    },

    function( newElements ) {
        var $newElems = $( newElements ).css({ opacity: 0 });
        $newElems.animate({ opacity: 1 });
        $container.masonry( 'appended', $newElems, true );
    });

    $container.masonry({
        itemSelector: '.follow-item',
        percentPosition: true
    });
});
</script>
