<?php
/**
 * skin file : /theme/THEME_NAME/skin/signature/basic/signature.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.member-signature {position:relative;margin:30px 0;border:1px solid #e5e5e5;border-top:3px solid #e5e5e5;font-size:12px;height:300px;box-sizing:content-box}
.member-signature .member-signature-profile {position:absolute;top:0;left:0;width:300px;height:300px;padding:10px;border-right:1px solid #e5e5e5}
.member-signature .color-light-grey {color:#b5b5b5}
.member-signature .signature-photo {position:relative;height:56px;width:56px;padding:2px;box-shadow:0 0 0 1px rgba(0, 0, 0, 0.1);background:#fff;border-radius:50% !important}
.member-signature .signature-photo img {height:52px;width:52px;background-color:#fff;background-size:cover;border-radius:50% !important}
.member-signature .signature-photo .signature-user-icon {height:52px;width:52px;text-align:center;line-height:52px;background:#757575;color:#fff;font-size:26px;text-align:center;display:inline-block;border-radius:50% !important}
.member-signature .signature-info {position:relative;padding-left:15px;<?php echo $eyoom_board['bo_use_profile_photo'] == 1 ? 'border-left:1px dotted #ddd;':''; ?>}
.member-signature .signature-info .signature-lv-icon {display:inline-block;margin-left:2px}
.member-signature .signature-statistics {position:relative;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;margin:10px -10px;padding:10px;background:#fafafa}
.member-signature .signature-statistics .progress {background:#d5d5d5}
.member-signature .signature-profile .signature-profile-box {position:relative}
.member-signature .signature-profile .profile-title {position:absolute;top:0;left:0;width:60px}
.member-signature .signature-profile .profile-cont {position:relative;overflow:hidden;margin-left:65px;color:#757575}
.member-signature .signature-profile .profile-cont.cont-fixed {height:36px}
.member-signature .member-signature-latest {position:relative;margin-left:300px;height:300px}
.member-signature-latest .nav-tabs {border-bottom:0}
.member-signature-latest .nav-tabs li {width:50%;margin-bottom:15px}
.member-signature-latest .nav-tabs li a {text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:7px 5px;font-size:13px;border-top:0}
.member-signature-latest .nav-tabs li:first-child a {margin-left:0;border-left:0}
.member-signature-latest .nav-tabs li:last-child a {border-right:0}
.member-signature-latest .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.member-signature-latest .nav-tabs li.active a {z-index:1;background:#fff;font-weight:bold;color:#353535;border-bottom:0;border-top:0;padding:7px 5px 8px}
.member-signature-latest .tab-content ul {margin:0;font-size:12px;padding:0 20px}
.member-signature-latest .tab-content ul li {position:relative;margin:5px 0 0;padding:0 0 5px;border-bottom:1px dotted #e5e5e5}
.member-signature-latest .tab-content ul li:last-child {border-bottom:0}
.member-signature-latest .tab-content ul li.active .signature-latest-subj {text-decoration:underline;color:#FF4848}
.member-signature-latest .signature-latest-li {position:relative;margin-right:100px}
.member-signature-latest .signature-latest-boname {color:#959595;margin-right:3px}
.member-signature-latest .signature-latest-subj {color:#252525}
.member-signature-latest .signature-latest-li:hover .signature-latest-subj {text-decoration:underline}
.member-signature-latest .signature-latest-date {position:absolute;top:0;right:0;width:90px;text-align:right;color:#757575}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:650px) {
    .member-signature {height:auto}
    .member-signature .member-signature-profile {width:100%;border-right:0;border-bottom:1px solid #e5e5e5}
    .member-signature .member-signature-latest {margin-left:0;margin-top:300px}
    .member-signature .member-signature-latest .tab-content {margin-bottom:15px}
}
<?php } ?>
</style>

<div class="member-signature">
    <div class="member-signature-profile">
        <?php if ($eyoom_board['bo_use_profile_photo'] == 1) { ?>
        <div class="width-30 pull-left">
            <div class="signature-member">
                <div class="signature-photo">
                    <?php if ($view['mb_photo']) { echo $view['mb_photo']; } else { ?><span class="signature-user-icon"><i class="fa fa-user"></i></span><?php } ?>
                </div>
            </div>
        </div>
        <div class="width-70 pull-right">
        <?php } else { ?>
        <div class="width-70 pull-left">
        <?php } ?>
            <div class="signature-info">
                <span class="font-size-13">- <?php echo eb_nameview($view['mb_id'], $view['wr_name'], $view['wr_email'], $view['wr_homepage']); ?></span>
                <?php if ($lv['gnu_icon']) { ?>
                <span class="signature-lv-icon"><img src="<?php echo $lv['gnu_icon']; ?>" alt="레벨"></span>
                <?php } ?>
                <?php if ($levelset['use_eyoom_level'] != 'n') { // 이윰레벨을 사용하지 않음 ?>
                <?php if ($lv['eyoom_icon']) { ?>
                <span class="signature-lv-icon"><img src="<?php echo $lv['eyoom_icon']; ?>" alt="레벨"></span>
                <?php } ?>
                <span class="display-block">- 회원등급 : <?php if ($user['mb_level'] == 10) { ?>최고관리자<?php } else { ?><?php echo $lvuser['gnu_name']; ?> / <?php echo $lvuser['name']; ?><?php } ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="signature-statistics">
            <div class="pull-left">
                <span><?php echo $levelset['gnu_name']; ?></span> <strong><?php echo number_format($user['mb_point']); ?></strong>
            </div>
            <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
            <div class="pull-right text-right">
                <span><?php echo $levelset['eyoom_name']; ?></span> <strong><?php echo number_format($user['level_point']); ?></strong>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
            <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
            <div class="margin-top-5">
                <span class="progress-info-left"><span class="font-size-11">[레벨 <strong><?php echo $lvuser['level']; ?></strong>] - 진행률</span></span>
                <span class="progress-info-right"><span class="font-size-11"><?php echo $lvuser['ratio']; ?>%</span></span>
                <div class="progress progress-e progress-xxs progress-striped active margin-top-5">
                    <div class="progress-bar progress-bar-indigo" role="progressbar" aria-valuenow="<?php echo $lvuser['ratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lvuser['ratio']; ?>%">
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="signature-profile">
            <div class="signature-profile-box">
                <div class="profile-title"><strong>가입일</strong> :</div>
                <div class="profile-cont"><i class="far fa-clock color-grey"></i> <?php echo $user['mb_datetime']; ?></div>
            </div>
            <?php if ($config['cf_use_signature'] == '1') { ?>
            <div class="margin-hr-5"></div>
            <div class="signature-profile-box">
                <div class="profile-title"><strong>서명</strong> : </div>
                <div class="profile-cont cont-fixed">
                <?php if ($user['mb_signature']) { ?><?php echo $user['mb_signature']; ?><?php } else { ?><span class="color-light-grey"><i class="fa fa-exclamation-circle"></i> 미입력</span><?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php if ($config['cf_use_profile'] == '1') { ?>
            <div class="margin-hr-5"></div>
            <div class="signature-profile-box">
                <div class="profile-title"><strong>자기소개</strong> : </div>
                <div class="profile-cont cont-fixed">
                <?php if ($user['mb_profile']) { ?><?php echo $user['mb_profile']; ?><?php } else { ?><span class="color-light-grey"><i class="fa fa-exclamation-circle"></i> 미입력</span><?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="member-signature-latest">
        <ul class="nav nav-tabs eb-signature-tabs">
            <li class="active"><a href="#signature-tlb-1" data-toggle="tab">글쓴이의 최신글</a></li>
            <li><a href="#signature-tlb-2" data-toggle="tab">글쓴이의 최신댓글</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane in active" id="signature-tlb-1">
                <?php if ($mb_write_cnt > 0) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($mb_write as $k => $li) { ?>
                    <li <?php echo $bo_table == $li['bo_table'] && $wr_id == $li['wr_id'] ? 'class="active"': ''; ?>>
                        <a href="<?php echo $li['href']; ?>">
                            <div class="signature-latest-li ellipsis">
                                <span class="signature-latest-boname"><?php echo $li['bo_info']['bo_name']; ?> -</span>
                                <span class="signature-latest-subj"><?php echo get_text($li['wr_subject']); ?></span>
                            </div>
                            <div class="signature-latest-date"><i class="far fa-clock color-grey margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <p class="text-center color-grey font-size-12 margin-top-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php }?>
            </div>
            <div class="tab-pane in" id="signature-tlb-2">
                <?php if ($mb_cmt_cnt > 0) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($mb_cmt as $k => $li) { ?>
                    <li>
                        <a href="<?php echo $li['href']; ?>">
                            <div class="signature-latest-li ellipsis">
                                <span class="signature-latest-boname"><?php echo $li['bo_info']['bo_name']; ?> -</span>
                                <span class="signature-latest-subj"><?php echo get_text($li['wr_content']); ?></span>
                            </div>
                            <div class="signature-latest-date"><i class="far fa-clock color-grey margin-right-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <p class="text-center color-grey font-size-12 margin-top-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<script>
$(document).ready(function() {
    $('.eb-signature-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });
});
</script>