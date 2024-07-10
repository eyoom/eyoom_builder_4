<?php
/**
 * skin file : /theme/THEME_NAME/page/mbmemo.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div class="mbmemo-write">
    <div class="mbmemo-content">
        <form name="fmbmemoform" action="<?php echo $mbmemo_action_url; ?>" onsubmit="return fmbmemoform_submit(this);" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="mb_id" value="<?php echo $mbinfo['mb_id']; ?>">
        <div class="text-center m-b-20">
            <h5><strong><?php echo $mbinfo['mb_nick']; ?></strong> 님</h5>
            <p class="text-gray f-s-13r m-t-5"><?php echo $mbinfo['mb_id']; ?></p>
        </div>
        <section>
            <div class="cont-text-bg m-b-20">
                <p class="bg-info">메모내용 - 회원에 대한 특이사항을 메모하실 수 있습니다.</p>
            </div>
            <?php for ($i=0; $i<5; $i++) { $j=$i+1; ?>
            <label class="input">
                <i class="icon-prepend font-style-normal"><?php echo $j; ?></i>
                <input type="text" name="mm_memo[<?php echo $i; ?>]" value="<?php echo $mbmemo['mm_memo_'.$j]; ?>" id="mm_memo_<?php echo $j; ?>" maxlength="100">
            </label>
            <?php } ?>
            <div class="note"><strong>Note:</strong> 메모는 반드시 입력하실 필요 없습니다.</div>
        </section>
        <div class="text-center m-t-30 m-b-30">
            <input type="submit" value="저장하기" id="btn_submit" class="btn-e btn-e-xl btn-e-navy">
        </div>
        </form>
    </div>
</div>
<script>
function fmbmemoform_submit(f) {
    return true;
}
</script>