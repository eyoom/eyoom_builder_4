<?php
/**
 * skin file : /theme/THEME_NAME/skin/eblatest/notice_roll_side/eblatest.skin.html.php
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
.notice-roll-side-wrap {position:relative;padding:0 10px;border:1px solid #e5e5e5;background:#fff;margin:0 0 30px}
.notice-roll-side {position:relative;overflow:hidden;height:50px}
.notice-roll-side .notice-icon {display:block;position:absolute;top:10px;left:0;width:30px;height:30px;line-height:30px;text-align:center;background-color:#3c3c3e;color:#fff;font-size:.8125rem;border-radius:50%}
.notice-roll-side ul {position:absolute;width:100%;list-style:none;margin:0;padding:0}
.notice-roll-side ul li {position:relative;height:50px;box-sizing:content-box}
.notice-roll-side ul li a {line-height:50px;margin-left:40px}
.notice-roll-side ul li a:hover {color:#000;text-decoration:underline}
.notice-roll-side ul li .notice-new-icon {position:relative;display:inline-block;width:18px;height:14px;background-color:#cc2300;margin-right:2px}
.notice-roll-side ul li .notice-new-icon:before {content:"";position:absolute;top:4px;left:5px;width:2px;height:6px;background-color:#fff}
.notice-roll-side ul li .notice-new-icon:after {content:"";position:absolute;top:4px;right:5px;width:2px;height:6px;background-color:#fff}
.notice-roll-side ul li .notice-new-icon b {position:absolute;top:3px;left:8px;width:2px;height:8px;background-color:#fff;transform:rotate(-60deg)}
.notice-roll-side ul li span {line-height:50px;margin-left:40px}
</style>

<div class="notice-roll-side-wrap">
    <?php if (is_array($el_item)) { foreach ($el_item as $k => $eb_latest) { ?>
    <div class="notice-roll-side">
        <span class="notice-icon"><i class="fas fa-bullhorn"></i></span>
        <ul>
            <?php if (count((array)$eb_latest['list']) > 0) { foreach ($eb_latest['list'] as $data) { ?>
            <li>
                <a href="<?php echo $data['href']; ?>" class="ellipsis">
                    <?php if ($data['new']) { ?><strong class="notice-new-icon"><b></b></strong><?php } ?>
                    <?php echo $data['wr_subject']; ?>
                </a>
            </li>
            <?php }} else { ?>
            <li><span class="text-gray ellipsis"><i class="fa fa-exclamation-circle"></i> 출력할 최신글이 없습니다.</span></li>
            <?php } ?>
        </ul>
    </div>

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
    <?php }} ?>

    <?php if ($el_default) { ?>
    <div class="notice-roll-side">
        <span class="notice-icon"><i class="fas fa-bullhorn"></i></span>
        <ul>
            <li><span class="text-gray ellipsis"><i class="fa fa-exclamation-circle"></i> 출력할 최신글이 없습니다.</span></li>
        </ul>
    </div>
    <?php } ?>
</div>

<script>
$(function() {
    var noticeRollUl = $('.notice-roll-side ul'),
        noticeRollLi = noticeRollUl.append(noticeRollUl.html()).children(),
        noticeRollHeight = $('.notice-roll-side').height() * -1,
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