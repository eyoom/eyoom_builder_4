<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/member_box.html.php
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

<div class="admin-member-box">
    <div class="my-info">
        <div class="my-info-photo">
            <?php
            if ($meminfo['mb_photo']) {
                echo $meminfo['mb_photo'];
            } else {
                echo '<span class="user_icon"><i class="fas fa-user-circle"></i></span>';
            }
        ?>
        </div>
        <div class="my-info-nick">
            <?php echo $meminfo['mb_name']; ?> <?php if ($meminfo['mb_nick']) { echo '['.$meminfo['mb_nick'].']'; } ?> 님의
            <a href="#collapse-mybox" data-bs-toggle="collapse"><u>활동정보 보기</u></a>
        </div>
        <div class="clearfix"></div>
        <div id="collapse-mybox" class="collapse">
            <div class="margin-hr-10"></div>
            <div class="info-division">
                <div class="row">
                    <div class="col-sm-6 sm-m-b-10">
                        <div class="my-career">
                            <p class="li-p-sq"><?php echo $levelset['gnu_name']; ?> : <span class="color-red"><?php echo number_format($meminfo['mb_point']); ?></span></p>
                            <p class="li-p-sq">가입일 : <?php echo $meminfo['mb_datetime']; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="progress-wrap">
                            <div class="progress-info-wrap">
                                <span class="progress-info-left">
                                    레벨 <span class="text-indigo"><?php echo $eyoomer['level']; ?></span>
                                </span>
                                <span class="progress-info-right">
                                    <?php echo $levelset['eyoom_name']; ?> <span class="text-indigo"><?php echo number_format($eyoomer['level_point']); ?></span>
                                </span>
                            </div>
                            <div class="progress-info-wrap">
                                <span class="progress-info-left f-s-13r">진행률</span>
                                <span class="progress-info-right f-s-13r"><?php echo $lvinfo['ratio']; ?>%</span>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:<?php echo $lvinfo['ratio']; ?>%" aria-valuenow="<?php echo $lvinfo['ratio']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="margin-hr-10"></div>
            <div class="info-division">
                <div class="my-page-follow">
                    <p class="li-p-sq">맞팔친구<span class="badge badge-indigo"><?php echo $eyoomer['cnt_friends'] ? number_format($eyoomer['cnt_friends']) : '0';?>명</span></p>
                    <p class="li-p-sq">팔로워<span class="badge badge-dark"><?php echo $eyoomer['cnt_follower'] ? number_format($eyoomer['cnt_follower']) : '0';?>명</span></p>
                    <p class="li-p-sq">팔로윙<span class="badge badge-dark"><?php echo $eyoomer['cnt_following'] ? number_format($eyoomer['cnt_following']) : '0';?>명</span></p>
                </div>
            </div>
        </div>
    </div>
</div>