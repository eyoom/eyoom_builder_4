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
.my-info .info-title {position:relative;margin:0 0 20px}
.my-info .info-title-name {font-size:1.25rem}
.my-info .info-title-btn {text-align:right}
.my-info .info-box {position:relative;padding:15px;border:1px solid #757575}
.my-info .info-photo {position:absolute;top:15px;left:0;width:190px;height:205px;padding:0 15px;border-right:1px solid #f2f2f2}
.my-info .info-photo-circle {position:relative;overflow:hidden;width:100px;height:100px;margin:15px auto;text-align:center;background-color:#a5a5a5;border:3px solid #fff;border-radius:50%;box-shadow:0 0 1px rgba(0,0,0,.3)}
.my-info .info-photo img {display:block;width:100% \9;max-width:100%;height:auto}
.my-info .info-content {position:relative;margin-left:190px}
.my-info .info-follow {border-top:1px dotted #e5e5e5;padding-top:20px;margin-top:20px}
.my-info .info-follow p {padding:3px 0}
.my-info .info-follow span.badge {padding:3px 10px;min-width:80px;text-align:right}
.my-info .info-box-bottom {position:relative;padding:15px;border:1px solid #757575;border-top:0;margin-bottom:30px}
.my-info .info-tab-menu {position:relative;margin-bottom:30px}
.my-info .info-tab-menu:after {content:"";display:block;clear:both}
.my-info .tab-menu-li {position:relative;width:25%;height:46px;line-height:46px;border:1px solid #757575;border-right:0;text-align:center;color:#252525;font-weight:700;float:left;-webkit-transition:all 0.1s ease-in-out;transition:all 0.1s ease-in-out}
.my-info .tab-menu-li:last-child {border-right:1px solid #757575}
.my-info .tab-menu-li a {position:absolute;top:0;bottom:0;left:0;right:0;color:#252525}
.my-info .tab-menu-li .btn-group {width:100%;height:46px}
.my-info .tab-menu-li .btn-group .dropdown-toggle {width:100%}
.my-info .tab-menu-li .btn-group .dropdown-menu {top:40px;margin:0;width:100%;border:1px solid rgba(0,0,0,.4)}
.my-info .tab-menu-li .btn-group .dropdown-menu li {position:relative}
.my-info .tab-menu-li .btn-group .dropdown-menu li a {position:relative;display:block;padding:0 10px;width:100%;height:40px;line-height:40px}
.scrap-iframe-modal .modal-body {padding:0}
@media (max-width: 1199px) {
    .my-info .info-title-name, .my-info .info-title-btn {text-align:center}
}
@media (max-width: 767px) {
    .my-info .tab-menu-li {font-size:.75rem}
    .my-info .tab-menu-li .btn-group .dropdown-menu {width:160px}
    .my-info .tab-menu-li .btn-group .dropdown-menu li a {font-size:.75rem;height:30px;line-height:30px}
}
@media (max-width: 576px) {
    .my-info .info-photo {width:120px}
    .my-info .info-photo-circle {width:80px;height:80px;margin:20px auto}
    .my-info .info-content {margin-left:120px}
}
</style>

<div class="my-info">
    <div class="info-title">
        <div class="row">
            <div class="col-xl-6 xl-m-b-10">
                <h4 class="info-title-name">
                    <strong><?php if ($eyoomer['mb_nick']) { ?><?php echo $eyoomer['mb_nick']; ?><?php } else { ?><?php echo $eyoomer['mb_name']; ?><?php } ?></strong> <span class="text-gray">님의 페이지</span>
                </h4>
            </div>

            <div class="col-xl-6">
                <div class="info-title-btn">
                    <?php if ($is_admin == 'super') { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/" class="btn-e btn-crimson">관리자</a>
                    <?php } ?>
                    <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn-e btn-dark">정보수정</a>
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="memo_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank"<?php } ?> class="btn-e btn-dark">쪽지함</a>
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="scrap_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/scrap.php" target="_blank"<?php } ?> class="btn-e btn-dark">스크랩</a>
                    <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn-e btn-gray">회원탈퇴</a>
                </div>
            </div>
        </div>
    </div>
    <div class="info-box">
        <div class="info-photo">
            <div class="info-photo-circle">
                <?php if ($eyoomer['mb_photo']) { ?><?php echo $eyoomer['mb_photo']; ?><?php } else { ?><img src="<?php echo $eyoom_skin_url['mypage']; ?>/img/user.jpg" alt="회원사진"><?php } ?>
            </div>
            <a href="#" class="btn-e btn-gray btn-e-block" data-bs-toggle="modal" data-bs-target=".profile-modal">사진 변경</a>
            <?php if ($eyoom['is_community_theme'] == 'y') { ?>
            <a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>" class="btn-e btn-e-md btn-crimson btn-e-block bd-r-0">마이홈<i class="fas fa-caret-right m-l-5"></i></a>
            <?php } ?>
        </div>
        <div class="info-content">
            <div class="info-point m-b-10">
                <div class="width-50 float-start">
                    <p><?php echo $levelset['gnu_name']; ?> - <a <?php if (!G5_IS_MOBILE) { ?>href="javascript:void(0);" onclick="point_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"<?php } ?>><u>내역보기</u></span></p>
                    <p class="text-crimson"><strong><?php echo number_format($member['mb_point']); ?></strong></p></a>
                </div>
                <div class="widht-50 float-end text-end">
                    <p><?php echo $levelset['eyoom_name']; ?></p>
                    <p class="text-crimson"><strong><?php echo number_format($eyoomer['level_point']); ?></strong></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="info-statistics">
                <div class="progress-info-wrap">
                    <span class="progress-info-left">[레벨 <?php echo $eyoomer['level']; ?>] - 진행률</span>
                    <span class="progress-info-right"><?php echo $lvinfo['ratio']; ?>%</span>
                </div>
                <div class="progress progress-e progress-xs m-t-5 m-b-0">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal" role="progressbar" aria-valuenow="<?php echo $lvinfo['ratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $lvinfo['ratio']; ?>%"></div>
                </div>
            </div>
            <div class="info-follow">
                <p><span class="float-start">- 맞팔친구</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&friends"><span class="badge badge-amber float-end tooltips" data-placement="left" data-toggle="tooltip" data-original-title="맞팔친구"><?php if ($eyoomer['cnt_friends']) { ?><?php echo $eyoomer['cnt_friends']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
                <p><span class="float-start">- 팔로워</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&follower"><span class="badge badge-dark float-end tooltips" data-placement="left" data-toggle="tooltip" data-original-title="팔로워"><?php if ($eyoomer['cnt_follower']) { ?><?php echo $eyoomer['cnt_follower']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
                <p><span class="float-start">- 팔로윙</span><a href="<?php echo G5_URL; ?>/?<?php echo $member['mb_id']; ?>&following"><span class="badge badge-dark float-end tooltips" data-placement="left" data-toggle="tooltip" data-original-title="팔로윙"><?php if ($eyoomer['cnt_following']) { ?><?php echo $eyoomer['cnt_following']; ?>명<?php } else { ?>0명<?php } ?></span></a></p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="info-box-bottom">
        - <span>가입일</span> : <?php echo $member['mb_datetime']; ?>
        <div class="margin-hr-10"></div>
        - <span>이메일</span> : <?php echo $member['mb_email']; ?>
        <?php if ($member['mb_homepage']) { ?>
        <div class="margin-hr-10"></div>
        - <span>홈페이지</span> : <a href="<?php echo $member['mb_homepage']; ?>" target="_blank"><?php echo $member['mb_homepage']; ?></a>
        <?php } ?>
        <?php if ($member['mb_tel']) { ?>
        <div class="margin-hr-10"></div>
        - <span>전화번호</span> : <?php echo $member['mb_tel']; ?>
        <?php } ?>
        <?php if ($member['mb_hp']) { ?>
        <div class="margin-hr-10"></div>
        - <span>휴대폰</span> : <?php echo $member['mb_hp']; ?>
        <?php } ?>
        <?php if ($member['mb_signature'] && $config['cf_use_signature'] == '1') { ?>
        <div class="margin-hr-10"></div>
        - <span>서명</span>
        <blockquote class="hero m-t-10 m-b-0">
            <p><?php echo stripslashes($member['mb_signature']); ?></p>
        </blockquote>
        <?php } ?>
        <?php if ($member['mb_profile'] && $config['cf_use_profile'] == '1') { ?>
        <div class="margin-hr-10"></div>
        - <span>자기소개</span>
        <blockquote class="hero m-t-10 m-b-0">
            <p><?php echo stripslashes($member['mb_profile']); ?></p>
        </blockquote>
        <?php } ?>
    </div>
</div>