<?php
/**
 * skin file : /theme/THEME_NAME/skin/poll/basic/poll.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.poll {position:relative;margin:0 0 25px}
.poll .poll-box {position:relative;padding:15px 10px;border:1px solid #e5e5e5;background:#fff}
.poll .poll-box h6 {font-size:13px;line-height:1.4}
</style>

<div class="poll">
    <form name="fpoll" action="<?php echo G5_BBS_URL; ?>/poll_update.php" onsubmit="return fpoll_submit(this);" method="post" class="eyoom-form">
    <input type="hidden" name="po_id" value="<?php echo $po_id; ?>">
    <input type="hidden" name="skin_dir" value="<?php echo $skin_dir; ?>">
    <section class="poll-box">
        <div class="headline-short">
            <h5><strong>설문조사</strong></h5>
            <?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
            <div class="headline-btn btn-edit-mode hidden-xs hidden-sm">
                <div class="btn-group">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=poll_form&amp;w=u&amp;po_id=<?php echo $po_id; ?>&amp;wmode=1" onclick="eb_admset_modal(this.href); return false;" class="btn-e btn-e-xs btn-e-dark btn-e-split"><i class="far fa-edit"></i> 설문설정</a>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=poll_form&amp;w=u&amp;po_id=<?php echo $po_id; ?>" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-split-dark dropdown-toggle" title="새창 열기">
                        <i class="far fa-window-maximize"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        <h6><strong><?php echo $po['po_subject']; ?></strong></h6>
        <div class="margin-hr-10"></div>
        <ul class="list-unstyled">
        <?php if (is_array($poll)) { ?>
            <?php foreach ($poll as $key => $po_item) { ?>
            <li>
                <label for="gb_poll_<?php echo $key; ?>" class="radio"><input type="radio" name="gb_poll" value="<?php echo $key; ?>" id="gb_poll_<?php echo $key; ?>"><i class="rounded-x"></i><span class="font-size-12"><?php echo $po_item['po_poll']; ?></span></label>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
        <div class="margin-hr-10"></div>
        <?php if ($po['po_point'] > 0) { ?>
        <p class="color-grey font-size-11"><i class="fas fa-exclamation-circle"></i> 설문 참여시 <strong class="color-red"><?php echo number_format($po['po_point']); ?></strong>포인트 획득</p>
        <?php } ?>
        <div class="text-right">
            <input type="submit" value="투표하기" class="btn-e bg-dark lighter">
            <a <?php if (!G5_IS_MOBILE) { ?>href="<?php echo G5_BBS_URL; ?>/poll_result.php?po_id=<?php echo $po_id; ?>&amp;skin_dir=<?php echo $skin_dir; ?>" onclick="poll_result(this.href); return false;"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/poll_result.php?po_id=<?php echo $po_id; ?>&amp;skin_dir=<?php echo $skin_dir; ?>" target="_blank"<?php } ?> class="btn-e btn-e-default">결과보기</a>
        </div>
    </section>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
function fpoll_submit(f) {
    <?php if ($member['mb_level'] < $po['po_level']) { ?>
    swal({
        html: true,
        title: "중요!",
        text: "권한 <strong class='color-red'><?php echo $po['po_level']; ?></strong> 이상의 회원만 투표에 참여할 수 있습니다.",
        confirmButtonColor: "#FF2900",
        type: "error",
        confirmButtonText: "확인"
    });
    return false;
    <?php } ?>
    var chk = false;
    for (i=0; i<f.gb_poll.length;i ++) {
        if (f.gb_poll[i].checked == true) {
            chk = f.gb_poll[i].value;
            break;
        }
    }
    if (!chk) {
        swal({
            title: "중요!",
            text: "투표하실 설문항목을 선택하세요.",
            confirmButtonColor: "#FF2900",
            type: "error",
            confirmButtonText: "확인"
        });
        return false;
    }
    var new_win = window.open("about:blank", "win_poll", "width=616,height=500,scrollbars=yes,resizable=yes");
    f.target = "win_poll";
    return true;
}
</script>