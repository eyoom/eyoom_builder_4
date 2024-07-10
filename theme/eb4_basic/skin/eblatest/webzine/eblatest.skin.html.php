<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/webzine/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-btn-l"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="ae-btn-r" title="새창 열기">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.webzine-latest {font-size:.9375rem;margin-bottom:30px}
.webzine-latest .nav-tabs {border:1px solid #e5e5e5;border-bottom:0;margin-bottom:20px}
.webzine-latest .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.webzine-latest .nav-tabs li:first-child:nth-last-child(2), .webzine-latest .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(3), .webzine-latest .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(4), .webzine-latest .nav-tabs li:first-child:nth-last-child(4) ~ li {width:25%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(5), .webzine-latest .nav-tabs li:first-child:nth-last-child(5) ~ li {width:20%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(6), .webzine-latest .nav-tabs li:first-child:nth-last-child(6) ~ li {width:16.6666666667%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(7), .webzine-latest .nav-tabs li:first-child:nth-last-child(7) ~ li {width:14.2857142857%}
.webzine-latest .nav-tabs li:first-child:nth-last-child(8), .webzine-latest .nav-tabs li:first-child:nth-last-child(8) ~ li {width:12.5%}
.webzine-latest .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:8px 5px;font-size:.9375rem;font-weight:500;border-top:0}
.webzine-latest .nav-tabs li:first-child a {margin-left:0;border-left:0}
.webzine-latest .nav-tabs li:last-child a {border-right:0}
.webzine-latest .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.webzine-latest .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.webzine-latest .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.webzine-latest .tab-content {position:relative;padding:0}
.webzine-latest .tab-pane {margin-left:-6px;margin-right:-6px}
.webzine-latest .webzine-item {position:relative;width:50%;padding-left:6px;padding-right:6px;float:left;margin-bottom:20px}
.webzine-latest .webzine-img {position:relative;overflow:hidden;border-radius:5px;float:left;width:49%}
.webzine-latest .img-box {position:relative;overflow:hidden;width:100%;background:#e5e5e5}
.webzine-latest .img-box:before {content:"";display:block;padding-top:55%}
.webzine-latest .img-box img {position:absolute;top:0;left:0;right:0;bottom:0}
.webzine-latest .img-box .no-image {position:absolute;top:50%;left:0;width:100%;text-align:center;margin-bottom:0;margin-top:-8px;color:#959595;font-size:.8125rem}
.webzine-latest .img-bo-subj {position:absolute;top:5px;left:5px;display:inline-block;padding:3px 10px;font-size:.8125rem;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background:#252525}
.webzine-latest .img-box .video-icon {position:absolute;top:50%;left:50%;color:#fff;width:40px;height:40px;line-height:40px;margin-top:-20px;margin-left:-20px;text-align:center;font-size:30px}
.webzine-latest .img-caption {color:#fff;font-size:.8125rem;position:absolute;left:0;bottom:-30px;display:block;z-index:1;background:rgba(0, 0, 0, 0.7);text-align:left;width:100%;height:30px;line-height:30px;margin-bottom:0;padding:0 5px}
.webzine-latest .img-caption span {margin-right:7px;color:#c5c5c5;font-size:.8125rem}
.webzine-latest .img-caption span i {color:#a5a5a5}
.webzine-latest .webzine-txt {position:relative;overflow:hidden;float:right;padding-left:11px;width:51%}
.webzine-latest .txt-subj {position:relative;margin:5px 0 10px}
.webzine-latest .txt-subj h5 {color:#000;font-size:1rem;font-weight:600;margin:0}
.webzine-latest .txt-subj h5 .webzine-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.webzine-latest .txt-subj h5 .webzine-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.webzine-latest .txt-subj h5 .webzine-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.webzine-latest .txt-subj h5 .webzine-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.webzine-latest .txt-subj .webzine-comment {display:block;position:absolute;top:-2px;right:0;color:#f4511e;background:#fff;padding-left:5px}
.webzine-latest .webzine-txt a:hover .txt-subj h5 {color:#000;text-decoration:underline}
.webzine-latest .txt-cont {position:relative;overflow:hidden;height:43px;font-size:.9375rem;color:#959595;margin-bottom:10px}
.webzine-latest .txt-photo img {width:17px;height:17px;margin-right:2px;display:inline-block}
.webzine-latest .txt-photo .txt-user-icon {color:#959595;margin-right:2px}
.webzine-latest .txt-nick {color:#959595}
.webzine-latest .txt-info {margin-top:5px;padding-top:5px;font-size:11px;text-align:right;color:#b5b5b5;border-top:1px solid #e5e5e5}
.webzine-latest .txt-info span {margin-left:5px}
@media (max-width:1199px) {
    .webzine-latest .img-box {height:85px}
    .webzine-latest .txt-cont {height:20px}
}
@media (max-width:767px) {
    .webzine-latest .webzine-item {width:100%}
    .webzine-latest .webzine-img {width:40%}
    .webzine-latest .img-box {height:90px}
    .webzine-latest .webzine-txt {width:60%}
}
</style>

<div class="headline-short">
    <h4>
        <?php if ($el_master['el_link']) { ?>
        <a href="<?php echo $el_master['el_link']; ?>" target="<?php echo $el_master['el_target']; ?>" class="text-black"><?php echo $el_master['el_subject']; ?></a>
        <?php } else { ?>
        <?php echo $el_master['el_subject']; ?>
        <?php } ?>
    </h4>
</div>

<div class="webzine-latest">
    <ul class="nav nav-tabs eblatest-webzine-tabs">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <li><a href="#webzine-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>" data-bs-toggle="tab" <?php if ($eb_latest['li_link']) { ?>data-href="<?php echo $eb_latest['li_link']; ?>" target="<?php echo $eb_latest['li_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($el_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_latest['li_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_latest['li_title']; ?></a></li>
        <?php }} ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="webzine-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
            <div class="webzine-item">
                <div class="webzine-img">
                    <a href="<?php echo $data['href']; ?>">
                        <div class="img-box">
                            <?php if ($data['wr_image']) { ?>
                            <img class="img-fluid" src="<?php echo $data['wr_image']; ?>" alt="">
                            <?php if ($eb_latest['li_bo_subject'] == 'y') { ?>
                            <span class="img-bo-subj"><?php echo $data['bo_subject']; ?></span>
                            <?php } ?>
                            <?php if ($data['is_video']) { ?><span class="video-icon"><i class="far fa-play-circle"></i></span><?php } ?>
                            <?php } else { ?>
                            <span class="no-image">No Image</span>
                            <?php } ?>
                            <?php if ($eb_latest['li_use_date'] == 'y') { ?>
                            <div class="img-caption">
                                <span><i class="far fa-clock m-r-5"></i><?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </a>
                </div>
                <div class="webzine-txt">
                    <a href="<?php echo $data['href']; ?>">
                        <div class="txt-subj">
                            <h5 class="ellipsis">
                                <?php if ($data['new']) { ?>
                                <span class="webzine-new-icon"><b></b></span>
                                <?php } ?>

                                <?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
                                <span class="text-gray"><?php echo $data['ca_name']; ?> <b class="text-light-gray">|</b></span>
                                <?php } ?>

                                <?php echo $data['wr_subject']; ?>
                            </h5>
                            <?php if ($data['wr_comment']) { ?>
                            <span class="webzine-comment">+<?php echo number_format($data['wr_comment']); ?></span>
                            <?php } ?>
                        </div>
                        <?php if ($eb_latest['li_content'] == 'y') { ?>
                        <p class="txt-cont"><?php echo $data['wr_content']; ?></p>
                        <?php } ?>

                        <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>
                        <span class="txt-photo">
                            <?php if ($eb_latest['li_photo'] == 'y') { ?>
                            <span class="txt-photo">
                                <?php if ($data['mb_photo']) { ?>
                                <?php echo $data['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="txt-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                            <span class="txt-nick"><?php echo $data['wr_name']; ?></span>
                        </span>
                        <?php } ?>

                        <?php if(0) { //히트수, 추천수, 비추천수 숨김 ?>
                        <div class="txt-info">
                            <span><i class="fas fa-eye"></i> <?php echo number_format($data['wr_hit']); ?></span>
                            <?php if ($data['wr_good']) { ?><span><i class="far fa-thumbs-up"></i> <?php echo number_format($data['wr_good']); ?></span><?php } ?>
                            <?php if ($data['wr_nogood']) { ?><span><i class="far fa-thumbs-down"></i> <?php echo number_format($data['wr_nogood']); ?></span><?php } ?>
                        </div>
                        <?php } ?>
                    </a>
                </div>
            </div>
            <?php }} else { ?>
            <p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
            <?php } ?>

            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="adm-edit-btn btn-edit-mode" style="bottom:0">
                <div class="btn-group">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="ae-item-btn"><i class="far fa-edit"></i> EB최신글 아이템 설정</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp" target="_blank" class="ae-btn-r" title="새창 열기">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <?php }} ?>

        <?php if ($el_default) { ?>
        <div class="tab-pane active in" id="webzine-tlb-<?php echo time(); ?>-1">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li class="no-latest"><p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.eblatest-webzine-tabs').each(function() {
        var childCount = $(this).find('li').length;
        if (childCount <= 1) {
            $(this).addClass('d-none');
        }
    });

    $('.eblatest-webzine-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-webzine-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-webzine-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});

$(function(){
    var duration = 120;
    var $img_cap = $('.webzine-latest .webzine-img');
    $img_cap.find('.img-box')
        .on('mouseover', function(){
            $(this).find('.img-caption').stop(true).animate({bottom: '0px'}, duration);
        })
        .on('mouseout', function(){
            $(this).find('.img-caption').stop(true).animate({bottom: '-30px'}, duration);
        });
});
</script>
<?php } ?>