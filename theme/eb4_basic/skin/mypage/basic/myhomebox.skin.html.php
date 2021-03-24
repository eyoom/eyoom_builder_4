<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/myhomebox.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.follow-panel {position:relative;margin-bottom:40px}
.follow-panel .nav-tabs {border-bottom:1px solid #e5e5e5}
.follow-panel .nav-tabs li {width:33.3333%}
.follow-panel .nav-tabs li a {text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:7px 5px;font-size:12px}
.follow-panel .nav-tabs li:first-child a {margin-left:0}
.follow-panel .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.follow-panel .nav-tabs li.active a {z-index:1;background:#fff;font-weight:bold;color:#353535;border-bottom:0}
.follow-panel .tab-content {position:relative;border:1px solid #e5e5e5;border-top:0;padding:10px;background:#fff}
.follow-panel .panel-default > .panel-heading {background:#fafafa}
.follow-panel .follow-list {list-style-type:none;padding:0;margin-bottom:0}
.follow-panel .follow-list li {position:relative;overflow:hidden;width:60px;height:60px;float:left;margin:3px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.follow-panel .follow-list li:after {position:absolute;top:0;left:0;width:100%;height:100%;content:"";background:rgba(0,0,0,0.5)}
.follow-panel .follow-list li img {display:block;width:100% \9;max-width:100%;height:auto}
.follow-panel .follow-list li span {display:inline-block;color:#fff;z-index:1;position:absolute;top:0;left:0;width:60px;line-height:60px;text-align:center;padding:0 5px;font-size:11px}
.follow-panel .follow-list li:hover:after {display:none}
.follow-panel .follow-list li:hover span {display:none}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:767px) {
    .follow-panel .follow-list li {width:50px;height:50px;margin:1px}
    .follow-panel .follow-list li span {width:50px;line-height:50px;font-size:11px}
}
<?php } ?>
</style>

<div class="follow-panel">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#myfriends" data-toggle="tab">
                맞팔친구 (<?php if ($user['cnt_friends']) { ?><?php echo number_format($user['cnt_friends']); ?><?php } else { ?>0<?php } ?>)
            </a>
        </li>
        <li>
            <a href="#myfollower" data-toggle="tab">
                팔로워 (<?php if ($user['cnt_follower']) { echo number_format($user['cnt_follower']); } else { ?>0<?php } ?>)
            </a>
        </li>
        <li>
            <a href="#myfollowing" data-toggle="tab">
                팔로윙 (<?php if ($user['cnt_following']) { echo number_format($user['cnt_following']); } else { ?>0<?php } ?>)
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="myfriends">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&friends" class="btn-e btn-e-xs btn-e-dark pull-right">
                맞팔친구 전체보기
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_friends); $i++) { ?>
                <li class="tooltips" type="button" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo $my_friends[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_friends[$i]['mb_id']; ?>">
                        <?php if ($my_friends[$i]['mb_photo']) { echo $my_friends[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_friends[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_friends) == 0) { ?>
                <div class="text-center color-grey"><i class="fa fa-exclamation-circle"></i> 맞팔친구가 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-pane fade in" id="myfollower">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&follower" class="btn-e btn-e-xs btn-e-dark pull-right">
                팔로워 전체보기
            </a>
            <div class="clearfix"></div>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_follower); $i++) { ?>
                <li class="tooltips" type="button" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo $my_follower[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_follower[$i]['mb_id']; ?>">
                        <?php if ($my_follower[$i]['mb_photo']) { echo $my_follower[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_follower[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_follower) == 0) { ?>
                <div class="text-center color-grey"><i class="fa fa-exclamation-circle"></i> 팔로워가 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
        <div class="tab-pane fade in" id="myfollowing">
            <a href="<?php echo G5_URL; ?>/?<?php echo $user['mb_id']; ?>&following" class="btn-e btn-e-xs btn-e-dark pull-right">
                팔로윙 전체보기
            </a>
            <ul class="follow-list clearfix">
                <?php for ($i=0; $i<count((array)$my_following); $i++) { ?>
                <li class="tooltips" type="button" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo $my_following[$i]['mb_nick']; ?>">
                    <a href="<?php echo G5_URL; ?>/?<?php echo $my_following[$i]['mb_id']; ?>">
                        <?php if ($my_following[$i]['mb_photo']) { echo $my_following[$i]['mb_photo']; } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
                    </a>
                    <span class="ellipsis"><?php echo $my_following[$i]['mb_nick']; ?></span>
                </li>
                <?php } ?>
                <?php if (count((array)$my_following) == 0) { ?>
                <div class="text-center color-grey"><i class="fa fa-exclamation-circle"></i> 팔로윙이 없습니다.</div>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>