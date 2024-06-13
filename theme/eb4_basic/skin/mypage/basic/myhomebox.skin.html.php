<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhomebox.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.follow-panel {position:relative;border:1px solid #d5d5d5;margin-bottom:30px}
.follow-panel .nav-tabs {border-bottom:0;margin-bottom:0}
.follow-panel .nav-tabs li {width:25%}
.follow-panel .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #d5d5d5;padding:10px 5px;font-size:.9375rem;border-top:0}
.follow-panel .nav-tabs li:first-child a {margin-left:0;border-left:0}
.follow-panel .nav-tabs li:last-child a {border-right:0}
.follow-panel .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #d5d5d5}
.follow-panel .nav-tabs li a.active {z-index:1;background:#fff;color:#353535;border-bottom:1px solid transparent}
.follow-panel .tab-pane {padding:20px;min-height:132px}
.follow-panel .follow-list {list-style-type:none;padding:0;margin-bottom:0}
.follow-panel .follow-list li {position:relative;overflow:hidden;width:60px;height:60px;float:left;margin:5px;border-radius:50%}
.follow-panel .follow-list li:after {position:absolute;top:0;left:0;width:100%;height:100%;content:"";background:rgba(0,0,0,0.5)}
.follow-panel .follow-list li img {display:block;max-width:100%;height:auto}
.follow-panel .follow-list li span {display:inline-block;color:#fff;z-index:1;position:absolute;top:0;left:0;width:60px;line-height:60px;text-align:center;padding:0 5px;font-size:11px}
.follow-panel .follow-list li:hover:after {display:none}
.follow-panel .follow-list li:hover span {display:none}
</style>

<div class="follow-panel">
    <ul class="nav nav-tabs follow-tabs">
        <li>
            <a href="#myfriends" data-bs-toggle="tab" class="active">
                맞팔친구 (<?php if ($user['cnt_friends']) { ?><?php echo number_format($user['cnt_friends']); ?><?php } else { ?>0<?php } ?>)
            </a>
        </li>
        <li>
            <a href="#myfollower" data-bs-toggle="tab">
                팔로워 (<?php if ($user['cnt_follower']) { echo number_format($user['cnt_follower']); } else { ?>0<?php } ?>)
            </a>
        </li>
        <li>
            <a href="#myfollowing" data-bs-toggle="tab">
                팔로잉 (<?php if ($user['cnt_following']) { echo number_format($user['cnt_following']); } else { ?>0<?php } ?>)
            </a>
        </li>
        <li>
            <a href="#subscriber" data-bs-toggle="tab">
                구독회원 (<?php if ($user['cnt_subscriber']) { echo number_format($user['cnt_subscriber']); } else { ?>0<?php } ?>)
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane in active" id="myfriends">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&friends" class="float-end">
                <u>맞팔친구 전체보기</u>
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_friends); $i++) { ?>
                <li class="tooltips" type="button" data-bs-placement="top" data-bs-toggle="tooltip" title="<?php echo $my_friends[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_friends[$i]['mb_id']; ?>">
                        <?php if ($my_friends[$i]['mb_photo']) { echo $my_friends[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_friends[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_friends) == 0) { ?>
                <div class="text-center text-gray m-t-15 m-b-30"><i class="fa fa-exclamation-circle"></i> 맞팔친구가 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-pane in" id="myfollower">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower" class="float-end">
                <u>팔로워 전체보기</u>
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_follower); $i++) { ?>
                <li class="tooltips" type="button" data-bs-placement="top" data-bs-toggle="tooltip" title="<?php echo $my_follower[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_follower[$i]['mb_id']; ?>">
                        <?php if ($my_follower[$i]['mb_photo']) { echo $my_follower[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_follower[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_follower) == 0) { ?>
                <div class="text-center text-gray m-t-15 m-b-30"><i class="fa fa-exclamation-circle"></i> 팔로워가 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-pane in" id="myfollowing">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&following" class="float-end">
                <u>팔로잉 전체보기</u>
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_following); $i++) { ?>
                <li class="tooltips" type="button" data-bs-placement="top" data-bs-toggle="tooltip" title="<?php echo $my_following[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_following[$i]['mb_id']; ?>">
                        <?php if ($my_following[$i]['mb_photo']) { echo $my_following[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_following[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_following) == 0) { ?>
                <div class="text-center text-gray m-t-15 m-b-30"><i class="fa fa-exclamation-circle"></i> 팔로잉이 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-pane in" id="subscriber">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&subscriber" class="float-end">
                <u>구독회원 전체보기</u>
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_subscriber); $i++) { ?>
                <li class="tooltips" type="button" data-bs-placement="top" data-bs-toggle="tooltip" title="<?php echo $my_subscriber[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_subscriber[$i]['mb_id']; ?>">
                        <?php if ($my_subscriber[$i]['mb_photo']) { echo $my_subscriber[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_subscriber[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_subscriber) == 0) { ?>
                <div class="text-center text-gray m-t-15 m-b-30"><i class="fa fa-exclamation-circle"></i> 구독회원이 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.follow-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });
});
</script>