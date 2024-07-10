<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/profile.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.member-profile .profile-photo {position:relative;overflow:hidden;width:90px;height:90px;margin:10px auto 20px;text-align:center;background-color:#abacb5;border:5px solid #fff;border-radius:50%;box-shadow:0 0 1px rgba(0,0,0,.5)}
.member-profile .profile-photo img {display:block;max-width:100%;height:auto}
.member-profile .profile-greetings {border:1px solid #d5d5d5;padding:15px}
</style>

<div class="member-profile">
    <div class="profile-photo">
        <?php if ($mb_photo) { ?><?php echo $mb_photo; ?><?php } else { ?><img src="<?php echo EYOOM_THEME_URL; ?>/image/user.jpg"><?php } ?>
    </div>
    <h5 class="text-center m-b-30"><strong><?php echo $mb['mb_nick']; ?> 님의 프로필</strong></h5>
    <div class="table-list-eb">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>회원권한</th>
                    <td><?php echo $mb['mb_level'];?></td>
                </tr>
                <tr>
                    <th>포인트</th>
                    <td><?php echo number_format($mb['mb_point']); ?></td>
                </tr>
                <?php if ($mb_homepage) { ?>
                <tr>
                    <th>홈페이지</th>
                    <td><a href="<?php echo $mb_homepage; ?>" target="_blank"><?php echo $mb_homepage; ?></a></td>
                </tr>
                <?php } ?>
                <tr>
                    <th>회원가입일</th>
                    <td>
                        <?php if ($member['mb_level'] >= $mb['mb_level']) { ?>
                        <?php echo substr($mb['mb_datetime'],0,10); ?> (<?php echo number_format($mb_reg_after); ?>일)
                        <?php } else { ?>
                        알 수 없음
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>최종접속일</th>
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
    <h6 class="m-b-10"><strong>인사말</strong></h6>
    <div class="profile-greetings">
        <p><?php echo $mb_profile; ?></p>
    </div>
</div>