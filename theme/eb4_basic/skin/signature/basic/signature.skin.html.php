<?php
/**
 * skin file : /theme/THEME_NAME/skin/signature/basic/signature.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.member-signature {position:relative;margin:30px 0;border:1px solid #d5d5d5;font-size:.9375rem;height:300px}
.member-signature .member-signature-profile {position:absolute;top:0;left:0;width:300px;height:300px;padding:10px;border-right:1px solid #d5d5d5}
.member-signature .color-light-gray {color:#a5a5a5}
.member-signature .signature-member {position:relative}
.member-signature .signature-photo {position:absolute;top:0;left:0}
.member-signature .signature-photo img {height:50px;width:50px;border-radius:50%}
.member-signature .signature-photo .signature-user-icon {font-size:50px;line-height:1;color:#757575}
.member-signature .signature-info {position:relative}
.member-signature .signature-info .sv_wrap > a {font-weight:400}
.member-signature .signature-info .signature-lv-icon {display:inline-block;margin-left:2px}
.member-signature .signature-statistics {position:relative;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;margin:10px -10px;padding:5px 10px;background:#fafafa}
.member-signature .signature-statistics .progress {background:#d5d5d5}
.member-signature .signature-profile .signature-profile-box {position:relative;border-bottom:1px solid #f2f2f2;padding-bottom:9px;margin-bottom:9px;font-size:.8125rem}
.member-signature .signature-profile .profile-title {position:absolute;top:0;left:0;width:60px}
.member-signature .signature-profile .profile-cont {position:relative;overflow:hidden;margin-left:65px;color:#757575}
.member-signature .signature-profile .profile-cont.cont-fixed {height:38px;overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical}
.member-signature .member-signature-latest {position:relative;margin-left:300px;height:300px}
.member-signature-latest .nav-tabs {border-bottom:0;margin-bottom:20px}
.member-signature-latest .nav-tabs li {width:50%}
.member-signature-latest .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #d5d5d5;padding:10px 5px;font-size:.9375rem;border-top:0}
.member-signature-latest .nav-tabs li:first-child a {margin-left:0;border-left:0}
.member-signature-latest .nav-tabs li:last-child a {border-right:0}
.member-signature-latest .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #d5d5d5}
.member-signature-latest .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.member-signature-latest .tab-content ul {margin:0;font-size:.9375rem;padding:0 20px}
.member-signature-latest .tab-content ul li {position:relative;margin:0 0 6px}
.member-signature-latest .tab-content ul li.active .signature-latest-subj {color:#ab0000}
.member-signature-latest .signature-latest-li {position:relative;margin-right:135px}
.member-signature-latest .signature-latest-boname {color:#959595;margin-right:3px}
.member-signature-latest .signature-latest-subj {color:#252525}
.member-signature-latest .signature-latest-li:hover .signature-latest-subj {text-decoration:underline}
.member-signature-latest .signature-latest-date {position:absolute;top:0;right:0;width:125px;text-align:right}
@media (max-width:767px) {
    .member-signature {height:auto}
    .member-signature .member-signature-profile {width:100%;border-right:0;border-bottom:1px solid #d5d5d5}
    .member-signature .member-signature-latest {margin-left:0;margin-top:300px}
    .member-signature .member-signature-latest .tab-content {margin-bottom:15px}
    .member-signature .member-signature-latest .tab-content ul {padding:0 10px}
}
</style>

<div class="member-signature">
    <div class="member-signature-profile">
        <div class="signature-member">
            <?php if ($config['cf_use_member_icon']) { ?>
            <div class="signature-photo">
                <?php if ($view['mb_photo']) { echo $view['mb_photo']; } else { ?><span class="signature-user-icon"><i class="fas fa-user-circle"></i></span><?php } ?>
            </div>
            <?php } ?>
            <div class="signature-info" <?php if($config['cf_use_member_icon']) { ?>style="margin-left:60px"<?php } ?>>
                <span><?php echo eb_nameview($view['mb_id'], $view['wr_name'], $view['wr_email'], $view['wr_homepage']); ?></span>
                <?php if ($lv['gnu_icon']) { ?>
                <span class="signature-lv-icon"><img src="<?php echo $lv['gnu_icon']; ?>" alt="레벨"></span>
                <?php } ?>
                <?php if ($levelset['use_eyoom_level'] != 'n') { // 이윰레벨을 사용하지 않음 ?>
                <?php if ($lv['eyoom_icon']) { ?>
                <span class="signature-lv-icon"><img src="<?php echo $lv['eyoom_icon']; ?>" alt="레벨"></span>
                <?php } ?>
                <span class="display-block m-t-5">회원등급 : <?php if ($user['mb_level'] == 10) { ?>최고관리자<?php } else { ?><?php echo $lvuser['gnu_name']; ?> / <?php echo $lvuser['name']; ?><?php } ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="signature-statistics">
            <div class="float-start f-s-12r">
                <span><?php echo $levelset['gnu_name']; ?></span> <strong><?php echo number_format($user['mb_point']); ?></strong>
            </div>
            <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
            <div class="float-end f-s-12r text-end">
                <span><?php echo $levelset['eyoom_name']; ?></span> <strong><?php echo number_format($user['level_point']); ?></strong>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
            <?php if ($levelset['use_eyoom_level'] != 'n') { ?>
            <div class="progress-info-wrap">
                <span class="progress-info-left"><span class="f-s-12r">[레벨 <strong><?php echo $lvuser['level']; ?></strong>] - 진행률</span></span>
                <span class="progress-info-right"><span class="f-s-12r"><?php echo $lvuser['ratio']; ?>%</span></span>
            </div>
            <div class="progress progress-e progress-xxs m-t-5 m-b-5">
                <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="<?php echo $lvuser['ratio']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $lvuser['ratio']; ?>%">
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="signature-profile">
            <div class="signature-profile-box">
                <div class="profile-title"><span>가입일</span></div>
                <div class="profile-cont"><i class="far fa-clock text-gray"></i> <?php echo $user['mb_datetime']; ?></div>
            </div>
            <?php if ($config['cf_use_signature'] == '1') { ?>
            <div class="signature-profile-box">
                <div class="profile-title"><span>서명</span></div>
                <div class="profile-cont cont-fixed" <?php if ($user['mb_signature']) { ?>title="<?php echo $user['mb_signature']; ?>"<?php } ?>>
                <?php if ($user['mb_signature']) { ?><?php echo $user['mb_signature']; ?><?php } else { ?><span class="color-light-gray"><i class="fa fa-exclamation-circle"></i> 미입력</span><?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php if ($config['cf_use_profile'] == '1') { ?>
            <div class="signature-profile-box bd-bottom-0">
                <div class="profile-title"><span>자기소개</span></div>
                <div class="profile-cont cont-fixed" <?php if ($user['mb_profile']) { ?>title="<?php echo $user['mb_profile']; ?>"<?php } ?>>
                <?php if ($user['mb_profile']) { ?><?php echo $user['mb_profile']; ?><?php } else { ?><span class="color-light-gray"><i class="fa fa-exclamation-circle"></i> 미입력</span><?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="member-signature-latest">
        <ul class="nav nav-tabs eb-signature-tabs">
            <li><a href="#signature-tlb-1" data-bs-toggle="tab" class="active">글쓴이의 최신글</a></li>
            <li><a href="#signature-tlb-2" data-bs-toggle="tab">글쓴이의 최신댓글</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane in active" id="signature-tlb-1">
                <?php if ($mb_write_cnt > 0) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($mb_write as $k => $li) { ?>
                    <li <?php echo $bo_table == $li['bo_table'] && $wr_id == $li['wr_id'] ? 'class="active"': ''; ?>>
                        <a href="<?php echo $li['href']; ?>">
                            <div class="signature-latest-li ellipsis">
                                <span class="signature-latest-boname">[<?php echo $li['bo_info']['bo_name']; ?>]</span>
                                <span class="signature-latest-subj"><?php echo get_text($li['wr_subject']); ?></span>
                            </div>
                            <div class="signature-latest-date"><i class="far fa-clock text-gray m-r-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <p class="text-center text-gray m-t-100"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php }?>
            </div>
            <div class="tab-pane in" id="signature-tlb-2">
                <?php if ($mb_cmt_cnt > 0) { ?>
                <ul class="list-unstyled">
                    <?php foreach ($mb_cmt as $k => $li) { ?>
                    <li>
                        <a href="<?php echo $li['href']; ?>">
                            <div class="signature-latest-li ellipsis">
                                <span class="signature-latest-boname">[<?php echo $li['bo_info']['bo_name']; ?>]</span>
                                <span class="signature-latest-subj"><?php echo get_text($li['wr_content']); ?></span>
                            </div>
                            <div class="signature-latest-date"><i class="far fa-clock text-gray m-r-5"></i><?php echo $eb->date_time('Y-m-d',$li['datetime']); ?></div>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } else { ?>
                <p class="text-center text-gray m-t-100"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
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