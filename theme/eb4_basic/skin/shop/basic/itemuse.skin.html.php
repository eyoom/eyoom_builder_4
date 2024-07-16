<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/itemuse.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php /* ---------- 상품 사용후기 시작 ---------- */ ?>
<section class="shop-product-use">
    <h3 class="h-hidden">등록된 사용후기</h3>

    <div class="product-use-top">
        <?php if ($star_score) { ?>
        <h4>전체 평점</h4>
        <img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $star_score?>.png" alt="" width="100">
        <span class="li-divider"></span>
        총 <strong><?php echo $total_count; ?></strong> 건 사용후기
        <?php } ?>
        <div class="product-use-btn">
            <a href="<?php echo $itemuse_form; ?>" onclick="itemuse_modal(this.href); return false;" class="btn-e btn-e-md btn-e-navy">사용후기 쓰기</a>
            <a href="<?php echo $itemuse_list; ?>" class="btn-e btn-e-md btn-e-dark">더보기</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php if ($use_cnt > 0) { ?>
    <div class="product-use-wrap">
        <?php foreach ($item_use as $k => $info) { ?>
        <div class="product-use-list">
            <?php if ($info['is_thumb']) { ?>
            <div class="product-use-thumbnail"><?php echo $info['is_thumb']; ?></div>
            <?php } ?>
            <div class="product-use-title"><?php echo $info['is_subject']; ?></div>
            <button type="button" class="product-use-more">내용보기<i class="fas fa-caret-down m-l-5"></i></button>
            <div class="clearfix"></div> 
            <dl class="product-use-dl">
                <dt>평점<dt>
                <dd class="product-use-star"><img src="<?php echo G5_SHOP_URL; ?>/img/s_star<?php echo $info['is_star']; ?>.png" alt="별<?php echo $info['is_star']; ?>개" width="75"></dd>
                <dt>작성자</dt>
                <dd><i class="far fa-user-circle" aria-hidden="true"></i><?php echo $info['is_name']; ?></dd>
                <dt>작성일</dt>
                <dd><i class="far fa-clock" aria-hidden="true"></i><?php echo $info['is_time']; ?></dd>
            </dl>

            <div id="sit_use_con_<?php echo $k; ?>" class="product-use-cont">
                <div class="product-use-p">
                    <?php echo $info['is_content']; // 사용후기 내용 ?>
                </div>

                <?php if ($is_admin || $info['mb_id'] == $member['mb_id']) { ?>
                <div class="product-use-cmd">
                    <a href="<?php echo $info['link_edit']; ?>" class="btn-e btn-e-navy" onclick="itemuse_modal(this.href); return false;">수정</a>
                    <a href="<?php echo $info['link_del']; ?>" class="itemuse_delete btn-e btn-e-dark">삭제</a>
                </div>
                <?php } ?>

                <?php if( $info['is_reply_subject'] ){  //  사용후기 답변 내용이 있다면 ?>
                <div class="product-use-reply">
                    <div class="product-use-reply-icon">답변</div>
                    <div class="product-use-reply-title">
                        <?php echo $info['is_reply_subject']; // 답변 제목 ?>
                    </div>
                    <div class="product-use-reply-name">
                        <?php echo $info['is_reply_name']; // 답변자 이름 ?>
                    </div>
                    <div class="product-use-reply-p">
                        <?php echo $info['is_reply_content']; // 답변 내용 ?>
                    </div>
                </div>
                <?php } //end if ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?>
    <p class="text-center text-gray m-t-20 m-b-40"><i class="fas fa-exclamation-circle"></i> 사용후기가 없습니다.</p>
    <?php } ?>
</section>

<?php echo $paging_itemuse; ?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$(function(){
    $(".itemuse_delete").click(function(){
        if (confirm("정말 삭제 하시겠습니까?\n\n삭제후에는 되돌릴수 없습니다.")) {
            return true;
        } else {
            return false;
        }
    });

    $(".product-use-more").click(function(){
        var $con = $(this).siblings(".product-use-cont");
        if($con.is(":visible")) {
            $con.slideUp();
        } else {
            $(".product-use-cont:visible").hide();
            $con.slideDown(
                function() {
                    // 이미지 리사이즈
                    $con.viewimageresize2();
                }
            );
        }
    });

    $(".pg_page").click(function(){
        $("#itemuse").load($(this).attr("href"));
        return false;
    });
});
</script>
<?php /* ---------- 상품 사용후기 끝 ---------- */ ?>