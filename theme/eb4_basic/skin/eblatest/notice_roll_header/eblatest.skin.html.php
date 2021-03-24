<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/notice_roll_header/eblatest.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="position-relative <?php if ($el_master['el_state'] == '2') { ?>eb-hidden-space<?php } ?>">
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:left;z-index:99">
        <div class="btn-group">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-red btn-e-split"><i class="far fa-edit"></i> EB최신글 마스터 설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_form&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;w=u" target="_blank" class="btn-e btn-e-xs btn-e-red btn-e-split-red dropdown-toggle" title="새창 열기">
                <i class="far fa-window-maximize"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>

<?php if (isset($el_master) && $el_master['el_state'] == '1') { // 보이기 상태에서만 출력 ?>
<style>
.notice-roll-header-wrap {position:relative;padding:0 10px;border:1px solid #e5e5e5;background:#fff;margin:0 15px}
.notice-roll-header {position:relative;overflow:hidden;height:35px}
.notice-roll-header .label {position:absolute;top:10px;left:0}
.notice-roll-header .label-red {background:#FF4948}
.notice-roll-header ul {position:absolute;width:100%;list-style:none;margin:0;padding:0}
.notice-roll-header ul li {position:relative;height:35px;box-sizing:content-box}
.notice-roll-header ul li a {line-height:36px;font-size:12px;margin-left:43px}
.notice-roll-header ul li span {line-height:36px;font-size:12px;margin-left:43px}
</style>

<div class="notice-roll-header-wrap">
    <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
    <div class="notice-roll-header">
        <span class="label label-red">공지</span>
        <ul>
            <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
            <li>
                <a href="<?php echo $data['href']; ?>" class="ellipsis">
                    <?php if ($data['new']) { ?><i class="far fa-check-circle color-red"></i><?php } ?>
                    <?php echo $data['wr_subject']; ?>
                </a>
            </li>
            <?php }} else { ?>
            <li><span class="color-grey ellipsis"><i class="fa fa-exclamation-circle"></i> 출력할 최신글이 없습니다.</span></li>
            <?php } ?>
        </ul>
    </div>
    <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
    <div class="adm-edit-btn btn-edit-mode" style="top:0;text-align:right">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=eblatest_itemform&amp;thema=<?php echo $theme; ?>&amp;el_code=<?php echo $el_master['el_code']; ?>&amp;li_no=<?php echo $eb_latest['li_no']; ?>&amp;w=u&amp;iw=u&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark margin-left-10"><i class="far fa-edit"></i> EB최신글 아이템 설정</a>
    </div>
    <?php } ?>
    <?php }} ?>

    <?php if ($el_default) { ?>
    <div class="notice-roll-header">
        <span class="label label-red">공지</span>
        <ul>
            <li><span class="color-grey ellipsis"><i class="fa fa-exclamation-circle"></i> 출력할 최신글이 없습니다.</span></li>
        </ul>
    </div>
    <?php } ?>
</div>

<script>
$(function() {
    var noticeRollUl = $('.notice-roll-header ul'),
        noticeRollLi = noticeRollUl.append(noticeRollUl.html()).children(),
        noticeRollHeight = $('.notice-roll-header').height() * -1,
        scrollSpeed = 600,
        timer,
        speed = 3000 + scrollSpeed;

    if (noticeRollLi.length > 2) {
        function sliderText() {
            var noticeRollFoucs = noticeRollUl.position().top / noticeRollHeight;

            noticeRollFoucs = (noticeRollFoucs + 1) % noticeRollLi.length;
            noticeRollUl.animate({
                top: noticeRollFoucs * noticeRollHeight
            }, scrollSpeed, function() {
                if (noticeRollFoucs == noticeRollLi.length / 2) {
                    noticeRollUl.css('top', 0);
                }
            });
            timer = setTimeout(sliderText, speed);
        }

        noticeRollLi.hover(function() {
            clearTimeout(timer);
        }, function() {
            timer = setTimeout(sliderText, speed);
        });

        timer = setTimeout(sliderText, speed);
    }
});
</script>
<?php } ?>