<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/basic/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="top:-22px;text-align:right">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
        </div>
    </div>
</div>
<?php }?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.basic-latest .nav-tabs {border-bottom:0}
.basic-latest .nav-tabs li {margin-bottom:20px}
.basic-latest .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.basic-latest .nav-tabs li:first-child:nth-last-child(2), .basic-latest .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.basic-latest .nav-tabs li:first-child:nth-last-child(3), .basic-latest .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.basic-latest .nav-tabs li:first-child:nth-last-child(4), .basic-latest .nav-tabs li:first-child:nth-last-child(4) ~ li {width:25%}
.basic-latest .nav-tabs li:first-child:nth-last-child(5), .basic-latest .nav-tabs li:first-child:nth-last-child(5) ~ li {width:20%}
.basic-latest .nav-tabs li:first-child:nth-last-child(6), .basic-latest .nav-tabs li:first-child:nth-last-child(6) ~ li {width:16.6666666667%}
.basic-latest .nav-tabs li:first-child:nth-last-child(7), .basic-latest .nav-tabs li:first-child:nth-last-child(7) ~ li {width:14.2857142857%}
.basic-latest .nav-tabs li:first-child:nth-last-child(8), .basic-latest .nav-tabs li:first-child:nth-last-child(8) ~ li {width:12.5%}
.basic-latest .nav-tabs li a {text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:7px 5px;font-size:13px}
.basic-latest .nav-tabs li:first-child a {margin-left:0}
.basic-latest .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.basic-latest .nav-tabs li.active a {z-index:1;background:#fff;font-weight:bold;color:#353535;border-bottom:0;padding:7px 5px 8px}
.basic-latest .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.basic-latest .tab-content {position:relative;padding:0}
.basic-latest .tab-content ul {margin-bottom:0}
.basic-latest .tab-content li {position:relative;padding:2px 0;font-size:13px}
.basic-latest .tab-content li.no-latest {width:100%}
.basic-latest .tab-content .basic-subj {position:relative;width:70%;padding-right:0;padding-left:0;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left}
.basic-latest .tab-content .basic-reply {display:inline-block;width:7px;height:12px;border-left:1px dotted #959595;border-bottom:1px dotted #959595;margin-right:3px}
.basic-latest .tab-content .basic-comment {display:inline-block;min-width:38px;padding:1px 3px;font-size:10px;font-weight:300;line-height:11px;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background-color:#757575;margin-right:3px}
.basic-latest .tab-content .basic-bo-subj {display:inline-block;min-width:60px;padding:1px 3px;font-size:10px;font-weight:300;line-height:11px;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background-color:#a5a5a5;margin-right:3px}
.basic-latest .tab-content .basic-member {position:relative;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;width:30%;float:left;text-align:right}
.basic-latest .tab-content .basic-photo img {width:17px;height:17px;margin-left:2px;display:inline-block}
.basic-latest .tab-content .basic-photo .basic-user-icon {width:17px;height:17px;line-height:17px;font-size:11px;text-align:center;background:#858585;color:#fff;margin-left:2px;display:inline-block}
.basic-latest .tab-content .basic-nick {font-size:13px;color:#959595}
.basic-latest .tab-content a:hover .basic-subj {color:#E52700;text-decoration:underline}
.basic-latest .tab-content a:hover .basic-nick {color:#000}
.basic-latest .tab-content li a[href*="#"] {cursor:not-allowed}
.basic-latest .tab-content li a[href*="#"]:hover .basic-subj {text-decoration:none}
.basic-latest .tab-content li .blind-subj {color:#a5a5a5}
</style>

<div class="headline-short">
    <h4>
        <?php if ($el_master['el_link']) { ?>
        <a href="<?php echo $el_master['el_link']; ?>" target="<?php echo $el_master['el_target']; ?>"><strong><?php echo $el_master['el_subject']; ?></strong></a>
        <?php } else { ?>
        <strong><?php echo $el_master['el_subject']; ?></strong>
        <?php } ?>
    </h4>
</div>

<div class="basic-latest">
    <ul class="nav nav-tabs eblatest-basic-tabs">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <li class="<?php if ($k==0) { ?>active<?php } else if ($el_count == ($k+1)) { ?>last<?php }?>"><a href="#basic-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>" data-toggle="tab" <?php if ($eb_latest['li_link']) { ?>data-href="<?php echo $eb_latest['li_link']; ?>" target="<?php echo $eb_latest['li_target']; ?>"<?php } ?> <?php if ($eb_latest['li_link']) { ?>class="cursor-pointer"<?php } ?>><?php echo $eb_latest['li_title']; ?></a></li>
        <?php }} ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="basic-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <div class="row">
                <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $i => $data) { ?>
                <?php if ($i % $depart_number[$k] == 0) { ?>
                <div class="col-sm-<?php echo 12/$el_item[$k]['li_depart']; ?>">
                    <ul class="list-unstyled">
                <?php } ?>
                        <li>
                            <a href="<?php echo $data['href']; ?>">
                                <div class="basic-subj <?php echo !G5_IS_MOBILE ? 'tooltips':''; ?>" <?php if (!G5_IS_MOBILE) { ?>data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?>"<?php } ?>>
                                    <?php if ($eb_latest['li_bo_subject'] == 'y') { ?>
                                    <span class="basic-bo-subj"><?php echo $data['bo_subject']; ?></span>
                                    <?php } ?>

                                    <?php if ($data['is_cmt']) { ?>
                                    <span class="basic-reply"></span>
                                    <?php } else { ?>
                                    <?php if ($data['wr_comment']) { ?>
                                    <span class="basic-comment">+<?php echo number_format($data['wr_comment']); ?></span>
                                    <?php } ?>
                                    <?php } ?>

                                    <?php if ($data['new']) { ?>
                                    <i class="far fa-check-circle color-red"></i>
                                    <?php } ?>

                                    <?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
                                    <span class="color-grey"><?php echo $data['ca_name']; ?> <b class="color-light-grey">|</b></span>
                                    <?php } ?>

                                    <?php echo $data['wr_subject']; ?>
                                </div>

                                <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>
                                <div class="basic-member">
                                    <span class="basic-nick"><?php echo $data['wr_name']; ?></span>
                                    <?php if ($eb_latest['li_photo'] == 'y') { ?>
                                    <span class="basic-photo">
                                        <?php if ($data['mb_photo']) { ?>
                                        <?php echo $data['mb_photo']; ?>
                                        <?php } else { ?>
                                        <span class="basic-user-icon"><i class="fas fa-user"></i></span>
                                        <?php } ?>
                                    </span>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                <?php if ( ( $i%$depart_number[$k] == $depart_number[$k]-1 ) ||
                            ( count((array)$eb_latest['list']) != $eb_latest['li_count'] && ($i%$depart_number[$k] != 0 && $i==count((array)$eb_latest['list'])-1 && $i%$depart_number[$k] == (count((array)$eb_latest['list'])%$depart_number[$k])-1) ) ||
                            ( $i == count((array)$eb_latest['list'])-1 )
                         ) {
                ?>
                    </ul>
                </div>
                <?php }}} else { ?>
                <p class="text-center color-grey font-size-12 margin-top-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php } ?>
            </div>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="adm-edit-btn btn-edit-mode hidden-xs hidden-sm" style="bottom:0">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark"><i class="far fa-edit"></i> EB최신글 아이템 설정</a>
            </div>
            <?php } ?>
        </div>
        <?php }} ?>

        <?php if ($el_default) { ?>
        <div class="tab-pane active in" id="basic-tlb-<?php echo time(); ?>-1">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li class="no-latest"><p class="text-center color-grey font-size-12 margin-top-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.eblatest-basic-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-basic-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-basic-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});
</script>
<?php } ?>