<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemqa.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /* ----------  상품문의 목록 시작 ---------- */ ?>
<section class="shop-product-qa">
    <h3 class="h-hidden">등록된 상품문의</h3>

    <div class="product-qa-btn">
        <a href="<?php echo $itemqa_form; ?>" onclick="itemqa_modal(this.href); return false;" class="btn-e btn-e-md btn-e-navy">상품문의 쓰기</a>
        <a href="<?php echo $itemqa_list; ?>" class="btn-e btn-e-md btn-e-dark">더보기</a>
    </div>
    <div class="clearfix"></div>

    <?php if ($qa_cnt > 0) { ?>
    <div class="product-qa-wrap">
        <?php foreach ($item_qa as $k => $info) { ?>
        <div class="product-qa-list">
            <button type="button" class="product-qa-title"><span class="<?php echo $info['iq_style']; ?>"><?php echo $info['iq_stats']; ?></span><?php echo $info['iq_subject']; ?></button>
            <dl class="product-qa-dl">
                <dt>작성자</dt>
                <dd><?php echo $info['iq_name']; ?></dd>
                <dt>작성일</dt>
                <dd><i class="far fa-clock" aria-hidden="true"></i> <?php echo $info['iq_time']; ?></dd>
            </dl>

            <div class="clearfix"></div>

            <div id="sit_qa_con_<?php echo $k; ?>" class="product-qa-cont">
                <div class="product-qa-p">
                    <div class="product-qa-qaq">
                        <strong class="sound_only">문의내용</strong>
                        <span class="product-qa-alp">Q</span>
                        <?php echo $info['iq_question']; // 상품 문의 내용 ?>
                    </div>
                    <?php if(!$info['is_secret']) { ?>
                    <div class="product-qa-qaa">
                        <strong class="sound_only">답변</strong>
                        <span class="product-qa-alp">A</span>
                        <?php echo $info['iq_answer']; ?>
                    </div>
                    <?php } ?>
                </div>

                <?php if ($is_admin || ($info['mb_id'] == $member['mb_id'] && !$info['is_answer'])) { ?>
                <div class="product-qa-cmd">
                    <a href="<?php echo $info['link_edit']; ?>" class="btn-e btn-e-navy" onclick="itemqa_modal(this.href); return false;">수정</a>
                    <a href="<?php echo $info['link_del']; ?>" class="itemqa_delete btn-e btn-e-dark">삭제</a>
                </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?>
    <p class="text-center text-gray m-t-20 m-b-40"><i class="fas fa-exclamation-circle"></i> 상품문의가 없습니다.</p>
    <?php } ?>
</section>

<?php echo $paging_itemqa; ?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$(function(){
    $(".itemqa_delete").click(function(){
        return confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.");
    });

    $(".product-qa-title").click(function(){
        var $con = $(this).siblings(".product-qa-cont");
        if($con.is(":visible")) {
            $con.slideUp();
        } else {
            $(".product-qa-cont:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
        }
    });

    $(".qa_page").click(function(){
        $("#itemqa").load($(this).attr("href"));
        return false;
    });
});
</script>
<?php /* ---------- 상품문의 목록 끝 ---------- */ ?>