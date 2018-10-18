<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/member_box.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 회원정보
 */
$meminfo = $mb ? $mb: get_member($mb_id);
$meminfo['mb_photo'] = $eb->mb_photo($mb_id);

/**
 * 해당 회원의 이윰회원 정보 가져오기
 */
$eyoomer = $eb->get_user_info($mb_id);
$lvinfo = $eb->eyoom_level_info($meminfo);
?>

<style>
.admin-member-box .my-info {position:relative;overflow:hidden;background:#FFF3E0;padding:10px;border:2px solid #b5b5b5;font-size:12px;border-radius:2px !important}
.admin-member-box .my-info .my-info-photo {position:relative;overflow:hidden;width:42px;height:42px;border:1px solid #c5c5c5;background:#fff;padding:1px;text-align:center;margin-right:10px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;float:left}
.admin-member-box .my-info .my-info-photo i {width:38px;height:38px;font-size:22px;line-height:38px;background:#757575;color:#fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-member-box .my-info .my-info-photo img {display:block;width:100% \9;max-width:100%;height:auto;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-member-box .my-info .my-info-nick {float:left;line-height:42px}
.admin-member-box .margin-hr-heading {height:1px;border-top:1px solid #ddd;margin:10px 0;clear:both}
.admin-member-box .my-career {position:relative}
.admin-member-box .my-career p {margin:2px 0}
.admin-member-box .service-block-e {padding:0;padding-left:20px;border-left:1px dotted #ccc}
.admin-member-box .service-block-e .service-in span {font-size:12px;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;padding-top:2px}
.admin-member-box .service-block-e .counter {display:inline}
.admin-member-box .my-page-follow p {padding:3px 0}
.admin-member-box .my-page-follow span.badge {min-width:80px;padding:3px 10px;text-align:right}
@media (max-width: 767px) {
    .admin-member-box .service-block-e {padding-left:0;border-left:0;border-top:1px solid #eee;padding-top:10px}
}
</style>

<div class="admin-member-box">
    <div class="my-info margin-bottom-30">
        <div class="my-info-photo">
            <?php
            if ($meminfo['mb_photo']) {
                echo $meminfo['mb_photo'];
            } else {
                echo '<span class="user_icon"><i class="fa fa-user"></i></span>';
            }
        ?>
        </div>
        <div class="my-info-nick">
            <?php echo $meminfo['mb_name']; ?> <?php if ($meminfo['mb_nick']) { echo '['.$meminfo['mb_nick'].']'; } ?> 님의
            <a href="#collapse-mybox" data-toggle="collapse"><u>활동정보 보기</u></a>
        </div>
        <div class="clearfix"></div>
        <div id="collapse-mybox" class="collapse">
            <div class="margin-hr-heading"></div>
            <div class="info-division">
                <div class="row">
                    <div class="col-sm-6 sm-margin-bottom-10">
                        <div class="my-career">
                            <p>&middot; <?php echo $levelset['gnu_name']; ?> : <span class="color-red"><?php echo number_format($meminfo['mb_point']); ?></span></p>
                            <p>&middot; 가입일 : <?php echo $meminfo['mb_datetime']; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="service-block-e">
                            <div class="margin-bottom-5"></div>
                            <div class="member-lv margin-bottom-5">
                                <div class="service-in pull-left">
                                    레벨 <span class="color-red"><?php echo $eyoomer['level']; ?></span>
                                </div>
                                <div class="service-in pull-right">
                                    <?php echo $levelset['eyoom_name']; ?> <span class="color-red"><?php echo number_format($eyoomer['level_point']); ?></span>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <span class="progress-info-left"><span class="font-size-11">진행률</span></span>
                            <span class="progress-info-right"><span class="font-size-11"><?php echo $lvinfo['ratio']; ?>%</span></span>
                            <div class="progress progress-e progress-xs progress-striped active">
                                <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lvinfo['ratio']; ?>%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="margin-hr-heading"></div>
            <div class="info-division">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="my-page-follow">
                            <p><span class="pull-left">&middot; 맞팔친구</span><span class="badge badge-yellow pull-right"><?php echo $eyoomer['cnt_friends'] ? number_format($eyoomer['cnt_friends']) : '0';?>명</span></p>
                            <div class="clearfix"></div>
                            <p><span class="pull-left">&middot; 팔로워</span><span class="badge badge-dark pull-right"><?php echo $eyoomer['cnt_follower'] ? number_format($eyoomer['cnt_follower']) : '0';?>명</span></p>
                            <div class="clearfix"></div>
                            <p><span class="pull-left">&middot; 팔로윙</span><span class="badge badge-dark pull-right"><?php echo $eyoomer['cnt_following'] ? number_format($eyoomer['cnt_following']) : '0';?>명</span></p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>