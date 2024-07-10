<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/bestset/eblatest.skin.html.php
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
.basic-best {font-size:.9375rem;margin-bottom:30px}
.basic-best .nav-tabs {border:1px solid #e5e5e5;border-bottom:0;margin-bottom:20px}
.basic-best .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.basic-best .nav-tabs li:first-child:nth-last-child(2), .basic-best .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.basic-best .nav-tabs li:first-child:nth-last-child(3), .basic-best .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.basic-best .nav-tabs li:first-child:nth-last-child(4), .basic-best .nav-tabs li:first-child:nth-last-child(4) ~ li {width:25%}
.basic-best .nav-tabs li:first-child:nth-last-child(5), .basic-best .nav-tabs li:first-child:nth-last-child(5) ~ li {width:20%}
.basic-best .nav-tabs li:first-child:nth-last-child(6), .basic-best .nav-tabs li:first-child:nth-last-child(6) ~ li {width:16.6666666667%}
.basic-best .nav-tabs li:first-child:nth-last-child(7), .basic-best .nav-tabs li:first-child:nth-last-child(7) ~ li {width:14.2857142857%}
.basic-best .nav-tabs li:first-child:nth-last-child(8), .basic-best .nav-tabs li:first-child:nth-last-child(8) ~ li {width:12.5%}
.basic-best .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:8px 5px;font-size:.9375rem;font-weight:500;border-top:0}
.basic-best .nav-tabs li:first-child a {margin-left:0;border-left:0}
.basic-best .nav-tabs li:last-child a {border-right:0}
.basic-best .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.basic-best .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.basic-best .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.basic-best .tab-content {position:relative;padding:0}
.basic-best .tab-content ul {margin-bottom:0;margin-left:-15px;margin-right:-15px}
.basic-best .tab-content li {position:relative;padding:3px 15px}
.basic-best .tab-content li.no-latest {width:100%}
.basic-best .tab-content .txt-subj {position:relative;width:70%;padding-right:40px;padding-left:0;display:block;font-size:1rem;font-weight:500;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left}
.basic-best .tab-content .best-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.basic-best .tab-content .best-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.basic-best .tab-content .best-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.basic-best .tab-content .best-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.basic-best .tab-content .txt-comment {display:block;position:absolute;top:0;right:0;color:#f4511e;background:#fff;padding-left:5px}
.basic-best .tab-content .txt-bo-subj {color:#959595;margin-right:3px}
.basic-best .tab-content .txt-member {position:relative;display:block;white-space:nowrap;word-wrap:normal;overflow:hidden;width:30%;float:left;text-align:right;padding-right:22px}
.basic-best .tab-content .txt-photo {position:absolute;top:0;right:0}
.basic-best .tab-content .txt-photo img {position:absolute;top:2px;right:0;width:17px;height:17px}
.basic-best .tab-content .txt-photo .txt-user-icon {color:#959595;background-color:#fff}
.basic-best .tab-content .txt-nick {color:#959595}
.basic-best .tab-content a:hover .txt-subj {color:#000;text-decoration:underline}
.basic-best .tab-content a:hover .txt-nick {color:#000}
.basic-best .tab-content li a[href*="#"] {cursor:not-allowed}
.basic-best .tab-content li a[href*="#"]:hover .txt-subj {text-decoration:none}
.basic-best .tab-content li .blind-subj {color:#a5a5a5}
.basic-best .best-num {margin-right:5px}
.basic-best .best-num.best-num-1 {color:#cc2300}
.basic-best .best-num.best-num-2 {color:#f4511e}
.basic-best .best-num.best-num-3 {color:#f4511e}
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

<div class="basic-best">
    <ul class="nav nav-tabs eblatest-best-tabs">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <li><a href="#best-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>" data-bs-toggle="tab" <?php if ($eb_latest['li_link']) { ?>data-href="<?php echo $eb_latest['li_link']; ?>" target="<?php echo $eb_latest['li_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($el_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_latest['li_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_latest['li_title']; ?></a></li>
        <?php }} ?>

        <?php if ($el_default) { ?>
        <li><a href="#basic-tlb-<?php echo time(); ?>-1" data-bs-toggle="tab" class="active">월간인기글</a></li>
        <li><a href="#basic-tlb-<?php echo time(); ?>-2" data-bs-toggle="tab">주간인기글</a></li>
        <li><a href="#basic-tlb-<?php echo time(); ?>-3" data-bs-toggle="tab">일간인기글</a></li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="best-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <div class="row">
                <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $i => $data) { ?>
                <?php if ($i % $depart_number[$k] == 0) { ?>
                <div class="col-lg-<?php echo 12/$el_item[$k]['li_depart']; ?>">
                    <ul class="list-unstyled">
                <?php } ?>
                        <li>
                            <a href="<?php echo $data['href']; ?>">
                                <div class="txt-subj <?php echo !G5_IS_MOBILE ? 'tooltips':''; ?>" <?php if (!G5_IS_MOBILE) { ?>data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?>"<?php } ?>>
                                    <strong class="best-num <?php if ($i <= 2) { ?>best-num-<?php echo $i+1; ?><?php } ?>"><?php echo $i+1; ?>.</strong>
                                    <?php if ($eb_latest['li_bo_subject'] == 'y') { ?>
                                    <span class="txt-bo-subj"><?php echo $data['bo_subject']; ?></span>
                                    <?php } ?>

                                    <?php if ($data['is_cmt']) { ?>
                                    <span class="txt-reply"></span>
                                    <?php } ?>

                                    <?php if ($data['new']) { ?>
                                    <span class="best-new-icon"><b></b></span>
                                    <?php } ?>

                                    <?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
                                    <span class="text-gray"><?php echo $data['ca_name']; ?> -</span>
                                    <?php } ?>

                                    <?php if ($is_admin) { ?>
                                    <?php if ($data['is_secret']) { ?>
                                    <i class="fas fa-lock text-crimson"></i>
                                    <?php } ?>
                                    <?php if ($data['is_blind']) { ?>
                                    <i class="far fa-eye-slash text-crimson"></i>
                                    <?php } ?>
                                    <?php } ?>

                                    <?php echo $data['wr_subject']; ?>

                                    <?php if (!$data['is_cmt'] && $data['wr_comment']) { ?>
                                    <span class="txt-comment">+<?php echo number_format($data['wr_comment']); ?></span>
                                    <?php } ?>
                                </div>

                                <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>
                                <div class="txt-member">
                                    <span class="txt-nick"><?php echo $data['wr_name']; ?></span>
                                    <?php if ($eb_latest['li_photo'] == 'y') { ?>
                                    <span class="txt-photo">
                                        <?php if ($data['mb_photo']) { ?>
                                        <?php echo $data['mb_photo']; ?>
                                        <?php } else { ?>
                                        <span class="txt-user-icon"><i class="far fa-user-circle"></i></span>
                                        <?php } ?>
                                    </span>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                <?php if ( ( $i%$depart_number[$k] == $depart_number[$k]-1 ) || ( count((array)$eb_latest['list']) != $eb_latest['li_count'] && ($i%$depart_number[$k] != 0 && $i==count((array)$eb_latest['list'])-1 && $i%$depart_number[$k] == (count((array)$eb_latest['list'])%$depart_number[$k])-1) ) || ( $i == count((array)$eb_latest['list'])-1 ) ) { ?>
                    </ul>
                </div>
                <?php }}} else { ?>
                <p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php } ?>
            </div>
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
        <?php }} ?>

        <?php if ($el_default) { ?>
        <div class="tab-pane active in" id="best-tlb-<?php echo time(); ?>-1">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li class="no-latest"><p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane in" id="best-tlb-<?php echo time(); ?>-2">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li class="no-latest"><p class="text-center text-gray m-t-30 m-b-30"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane in" id="best-tlb-<?php echo time(); ?>-3">
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
    $('.eblatest-best-tabs').each(function() {
        var childCount = $(this).find('li').length;
        if (childCount <= 1) {
            $(this).addClass('d-none');
        }
    });

    $('.eblatest-best-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-best-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-best-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});
</script>
<?php } ?>