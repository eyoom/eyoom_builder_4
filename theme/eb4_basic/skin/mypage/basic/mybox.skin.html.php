<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/mybox.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 레벨 진행바
 */
$lvinfo = $eb->eyoom_level_info($member);

$lvset = $eyoomer['mb_level'] . '|' . $eyoomer['level'];
$lv = $eb->level_info($lvset);
?>

<style>
.my-info {position:relative;margin-bottom:30px}
.my-info .info-title {position:relative;margin:0 0 10px}
.my-info .info-title-btn {text-align:right;padding-top:9px}
.my-info .info-box {position:relative;margin-bottom:30px;padding:15px;border:1px solid #e5e5e5;min-height:200px;}
.my-info .info-photo {position:absolute;top:15px;left:0;width:190px;height:190px;padding:0 15px;border-right:1px solid #f2f2f2}
.my-info .info-photo-circle {position:relative;overflow:hidden;width:100px;height:100px;margin:20px auto 20px;text-align:center;background-color:#a5a5a5;border:3px solid #fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;box-shadow:0 0 1px rgba(0,0,0,.3)}
.my-info .info-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.my-info .info-content {position:relative;margin-left:190px}
.my-info .info-follow {border-top:1px dotted #e5e5e5;padding-top:20px;margin-top:20px}
.my-info .info-follow p {padding:3px 0;font-size:12px}
.my-info .info-follow span.badge {padding:3px 10px;min-width:80px;text-align:right}
.my-info .info-box-bottom {position:relative;padding:15px;border:1px solid #e5e5e5;font-size:12px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 767px) {
    .my-info .info-title-name, .my-info .info-title-btn {text-align:center}
}
@media (max-width: 500px) {
    .my-info .info-photo {width:120px}
    .my-info .info-photo-circle {width:80px;height:80px;margin:30px auto 20px}
    .my-info .info-content {margin-left:120px}
}
<?php } ?>
</style>

<div class="my-info">
    <div class="info-title">
        <div class="row">
            <div class="col-sm-6 sm-margin-bottom-10">
                <h4 class="info-title-name">
                    <strong><?php if ($eyoomer['mb_nick']) { ?><?php echo $eyoomer['mb_nick']; ?><?php } else { ?><?php echo $eyoomer['mb_name']; ?><?php } ?></strong> <small>님의 페이지</small>
                </h4>
            </div>
            <div class="col-sm-6 sm-margin-bottom-20">
                <div class="info-title-btn">
                    <?php if ($eyoom['is_community_theme'] == 'y') { ?>
                    <a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>" class="btn-e btn-e-dark">마이홈</a>
                    <?php } ?>
                    <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn-e btn-e-dark">정보수정</a>
                    <?php if ($eyoom['use_shop_itemtype'] == 'y') { ?>
                    <a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="btn-e btn-e-red">쇼핑몰마이페이지</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="info-box">
        <div class="info-photo">
            <div class="info-photo-circle">
                <?php if ($eyoomer['mb_photo']) { ?><?php echo $eyoomer['mb_photo']; ?><?php } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
            </div>
            <a href="#" class="btn-e btn-e-default btn-e-block" data-toggle="modal" data-target=".profile-modal">사진 변경</a>
        </div>

        <div class="info-content">
            <div class="info-point">
                <div class="width-50 pull-left font-size-12">
                    <p class="margin-bottom-0"><?php echo $levelset['gnu_name']; ?> - <a <?php if (!G5_IS_MOBILE) { ?>href="javascript:void(0);" onclick="point_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"<?php } ?>><u>내역보기</u></span></p>
                    <p class="color-red font-size-13"><?php echo number_format($member['mb_point']); ?></p></a>
                </div>
                <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
                <div class="widht-50 pull-right font-size-12 text-right">
                    <p class="margin-bottom-0"><?php echo $levelset['eyoom_name']; ?></p>
                    <p class="color-red font-size-13"><?php echo number_format($eyoomer['level_point']); ?></p>
                </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
            <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
            <div class="info-statistics">
                <span class="progress-info-left">[레벨 <?php echo $eyoomer['level']; ?>] - 진행률</span>
                <span class="progress-info-right"><?php echo $lvinfo['ratio']; ?>%</span>
                <div class="progress progress-e progress-xs progress-striped active margin-top-5 margin-bottom-0">
                    <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="<?php echo $lvinfo['ratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $lvinfo['ratio']; ?>%">
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if ($eyoom['is_community_theme'] == 'y') { ?>
            <div class="info-follow">
                <p><span class="pull-left">&middot; 맞팔친구</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&friends"><span class="badge badge-yellow pull-right tooltips" data-placement="left" data-toggle="tooltip" data-original-title="맞팔친구"><?php if ($eyoomer['cnt_friends']) { ?><?php echo $eyoomer['cnt_friends']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
                <p><span class="pull-left">&middot; 팔로워</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&follower"><span class="badge badge-dark pull-right tooltips" data-placement="left" data-toggle="tooltip" data-original-title="팔로워"><?php if ($eyoomer['cnt_follower']) { ?><?php echo $eyoomer['cnt_follower']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
                <p><span class="pull-left">&middot; 팔로윙</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&following"><span class="badge badge-dark pull-right tooltips" data-placement="left" data-toggle="tooltip" data-original-title="팔로윙"><?php if ($eyoomer['cnt_following']) { ?><?php echo $eyoomer['cnt_following']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="info-box-bottom">
        - <strong>가입일</strong> : <?php echo $member['mb_datetime']; ?>
        <div class="margin-hr-10"></div>
        - <strong>이메일</strong> : <?php echo $member['mb_email']; ?>
        <?php if ($member['mb_homepage']) { ?>
        <div class="margin-hr-10"></div>
        - <strong>홈페이지</strong> : <a href="<?php echo $member['mb_homepage']; ?>" target="_blank"><?php echo $member['mb_homepage']; ?></a>
        <?php } ?>
        <?php if ($member['mb_tel']) { ?>
        <div class="margin-hr-10"></div>
        - <strong>전화번호</strong> : <?php echo $member['mb_tel']; ?>
        <?php } ?>
        <?php if ($member['mb_hp']) { ?>
        <div class="margin-hr-10"></div>
        - <strong>휴대폰</strong> : <?php echo $member['mb_hp']; ?>
        <?php } ?>
        <?php if ($member['mb_signature'] && $config['cf_use_signature'] == '1') { ?>
        <div class="margin-hr-10"></div>
        - <strong>서명</strong>
        <blockquote class="hero margin-top-10 margin-bottom-0">
            <p class="font-size-12"><?php echo stripslashes($member['mb_signature']); ?></p>
        </blockquote>
        <?php } ?>
        <?php if ($member['mb_profile'] && $config['cf_use_profile'] == '1') { ?>
        <div class="margin-hr-10"></div>
        - <strong>자기소개</strong>
        <blockquote class="hero margin-top-10 margin-bottom-0">
            <p class="font-size-12"><?php echo stripslashes($member['mb_profile']); ?></p>
        </blockquote>
        <?php } ?>
    </div>
</div>