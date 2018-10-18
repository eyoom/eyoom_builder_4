<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/profile.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.member-profile .profile-photo {position:relative;overflow:hidden;width:90px;height:90px;margin:10px auto 20px;text-align:center;background-color:#abacb5;border:5px solid #fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;box-shadow:0 0 1px rgba(0,0,0,.3)}
.member-profile .profile-photo img {display:block;width:100% \9;max-width:100%;height:auto}
</style>

<div class="member-profile">
    <div class="profile-photo">
        <?php if ($mb_photo) { ?><?php echo $mb_photo; ?><?php } else { ?><img src="<?php echo EYOOM_THEME_URL; ?>/image/user.jpg"><?php } ?>
    </div>
    <h5 class="text-center margin-bottom-30"><strong><?php echo $mb['mb_nick']; ?> 님의 프로필</strong></h5>
    <div class="table-list-eb">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>회원권한:</th>
                    <td><?php echo $mb['mb_level'];?></td>
                </tr>
                <tr>
                    <th>포인트:</th>
                    <td><?php echo number_format($mb['mb_point']); ?></td>
                </tr>
                <?php if ($mb_homepage) { ?>
                <tr>
                    <th>홈페이지:</th>
                    <td><a href="<?php echo $mb_homepage; ?>" target="_blank"><?php echo $mb_homepage; ?></a></td>
                </tr>
                <?php } ?>
                <tr>
                    <th>회원가입일:</th>
                    <td>
                      <?php if ($member['mb_level'] >= $mb['mb_level']) { ?>
                      <?php echo substr($mb['mb_datetime'],0,10); ?> (<?php echo number_format($mb_reg_after); ?>일)
                      <?php } else { ?>
                      알 수 없음
                      <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>최종접속일:</th>
                    <td>
                      <?php if ($member['mb_level'] >= $mb['mb_level']) { ?>
                      <?php echo $mb['mb_today_login']; ?>
                      <?php } else { ?>
                      알 수 없음
                      <?php } ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h6><strong class="font-size-12">인사말</strong></h6>
    <div class="alert alert-info">
        <p><?php echo $mb_profile; ?></p>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
<![endif]-->