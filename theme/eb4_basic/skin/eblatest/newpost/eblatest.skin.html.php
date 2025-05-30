<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/newpost/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:-25px;text-align:right">
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
.newpost-latest {position:relative;font-size:.9375rem;margin:0 0 30px}
.newpost-latest .nav-tabs {border:1px solid #e5e5e5;border-bottom:0}
.newpost-latest .nav-tabs li:first-child:nth-last-child(1) {width:100%;display:none}
.newpost-latest .nav-tabs li:first-child:nth-last-child(2), .newpost-latest .nav-tabs li:first-child:nth-last-child(2) ~ li {width:50%}
.newpost-latest .nav-tabs li:first-child:nth-last-child(3), .newpost-latest .nav-tabs li:first-child:nth-last-child(3) ~ li {width:33.3333%}
.newpost-latest .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:8px 5px;font-size:.9375rem;font-weight:500;border-top:0}
.newpost-latest .nav-tabs li:first-child a {margin-left:0;border-left:0}
.newpost-latest .nav-tabs li:last-child a {border-right:0}
.newpost-latest .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.newpost-latest .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.newpost-latest .nav-tabs li .cursor-pointer:hover {cursor:pointer}
.newpost-latest .tab-content {position:relative;border:1px solid #e5e5e5;border-top:0;padding:10px;background:#fff}
.newpost-latest .tab-content ul {margin-bottom:0}
.newpost-latest .tab-content li {position:relative;padding:3px 0}
.newpost-latest .tab-content li.no-latest {width:100%}
.newpost-latest .tab-content .newpost-subj {position:relative;width:100%;padding-right:5px;padding-left:0;display:block;font-size:1rem;font-weight:500;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;float:left}
.newpost-latest .tab-content .newpost-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.newpost-latest .tab-content .newpost-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.newpost-latest .tab-content .newpost-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.newpost-latest .tab-content .newpost-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.newpost-latest .tab-content .newpost-reply {display:inline-block;width:7px;height:12px;border-left:1px dotted #959595;border-bottom:1px dotted #959595;margin-right:3px}
.newpost-latest .tab-content .newpost-comment {display:block;position:absolute;top:0;right:5px;color:#f4511e;background:#fff;padding-left:5px}
.newpost-latest .tab-content .newpost-bo-subj {color:#959595;margin-right:3px}
.newpost-latest .tab-content .newpost-member {position:relative;display:block;white-space:nowrap;word-wrap:normal;overflow:hidden;width:35%;float:left;text-align:right;padding-right:22px}
.newpost-latest .tab-content .newpost-photo {position:absolute;top:0;right:0}
.newpost-latest .tab-content .newpost-photo img {position:absolute;top:2px;right:0;width:17px;height:17px}
.newpost-latest .tab-content .newpost-photo .newpost-user-icon {color:#959595;background-color:#fff}
.newpost-latest .tab-content .newpost-nick {color:#959595}
.newpost-latest .tab-content a:hover .newpost-subj {color:#000;text-decoration:underline}
.newpost-latest .tab-content a:hover .newpost-nick {color:#000}
.newpost-latest .tab-content li .blind-subj {color:#a5a5a5}
</style>

<div class="newpost-latest">
    <ul class="nav nav-tabs eblatest-newpost-tabs">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <li><a href="#newpost-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>" data-bs-toggle="tab" <?php if ($eb_latest['li_link']) { ?>data-href="<?php echo $eb_latest['li_link']; ?>" target="<?php echo $eb_latest['li_target']; ?>"<?php } ?> class="<?php if ($k==0) { ?>active<?php } else if ($el_count == ($k+1)) { ?>last<?php }?> <?php if ($eb_latest['li_link']) { ?>cursor-pointer<?php } ?>"><?php echo $eb_latest['li_title']; ?></a></li>
        <?php }} ?>
    </ul>
    <div class="tab-content">
        <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
        <div class="tab-pane <?php echo ($k==0) ? 'active': ''; ?> in" id="newpost-tlb-<?php echo $el_master['el_code']; ?>-<?php echo ($k+1); ?>">
            <ul class="list-unstyled">
                <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
                <li>
                    <a href="<?php echo $data['href']; ?>">
                        <div class="newpost-subj <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>width-65<?php } ?> <?php echo !G5_IS_MOBILE ? 'tooltips':''; ?>" <?php if (!G5_IS_MOBILE) { ?>data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $eb_latest['li_date_type'] == '1' ? $eb->date_time("{$eb_latest['li_date_kind']}",$data['wr_datetime']):  $eb->date_format("{$eb_latest['li_date_kind']}",$data['wr_datetime']); ?>"<?php } ?>>
                            <?php if ($eb_latest['li_bo_subject'] == 'y') { ?>
                            <span class="newpost-bo-subj"><?php echo $data['bo_subject']; ?></span>
                            <?php } ?>

                            <?php if ($data['is_cmt']) { ?>
                            <span class="newpost-reply"></span>
                            <?php } else { ?>
                            <?php if ($data['wr_comment']) { ?>
                            <span class="newpost-comment">+<?php echo number_format($data['wr_comment']); ?></span>
                            <?php } ?>
                            <?php } ?>

                            <?php if ($data['new']) { ?>
                            <span class="newpost-new-icon"><b></b></span>
                            <?php } ?>

                            <?php if ($eb_latest['li_ca_view'] == 'y' && $data['ca_name']) { ?>
                            <span class="text-gray"><?php echo $data['ca_name']; ?> -</span>
                            <?php } ?>

                            <?php echo $data['wr_subject']; ?>
                        </div>

                        <?php if ($eb_latest['li_mbname_view'] == 'y' && $data['wr_name']) { ?>
                        <div class="newpost-member">
                            <span class="newpost-nick"><?php echo $data['wr_name']; ?></span>
                            <?php if ($eb_latest['li_photo'] == 'y') { ?>
                            <span class="newpost-photo">
                                <?php if ($data['mb_photo']) { ?>
                                <?php echo $data['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="newpost-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <?php }} else { ?>
                <p class="text-center text-gray m-t-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p>
                <?php } ?>
            </ul>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="adm-edit-btn btn-edit-mode" style="bottom:0;text-align:right">
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
        <div class="tab-pane active in" id="newpost-tlb-<?php echo time(); ?>-1">
            <ul class="list-unstyled">
                <li class="no-latest"><p class="text-center text-gray= m-t-10"><i class="fas fa-exclamation-circle"></i> 최신글이 없습니다.</p></li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.eblatest-newpost-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    $('.eblatest-newpost-tabs li a').click(function (e) {
        return true;
    });

    $('.eblatest-newpost-tabs li a').on("click",function (e) {
        if ($(this).attr("data-href")) {
            window.location.href = $(this).attr("data-href");
        }
    });
});
</script>
<?php } ?>