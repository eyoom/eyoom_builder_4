<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/item.info.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($default['de_rel_list_use']) { ?>
<?php /* ---------- 관련상품 시작 ---------- */ ?>
<section id="sit_rel">
    <h2>관련상품</h2>
    <?php echo $rel_list; ?>
</section>
<?php /* ---------- 관련상품 끝 ---------- */ ?>
<?php } ?>

<?php /* ---------- 상품 정보 시작 ---------- */ ?>
<section id="sit_inf">
    <h2 class="h-hidden">상품 정보</h2>
    <?php echo $shop->pg_anchor('sit_inf'); ?>

    <?php if ($it['it_basic']) { // 상품 기본설명 ?>
    <h3 class="h-hidden">상품 기본설명</h3>
    <blockquote class="hero">
        <p><?php echo $it['it_basic']; ?></p>
    </blockquote>
    <?php } ?>

    <?php if ($it['it_explan']) { // 상품 상세설명 ?>
    <h3 class="h-hidden">상품 상세설명</h3>
    <div id="sit_inf_explan">
        <?php echo conv_content($it['it_explan'], 1); ?>
    </div>
    <?php } ?>

    <?php if ($it['it_info_use'] == 1) { ?>
    <?php if ($it['it_info_value'] && is_array($item_info)) { ?>
    <h3 class="h-hidden">상품 정보 고시</h3>
    <div class="table-list-eb item-info-table">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="width-180px">항목</th>
                    <th>내용</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ii_info as $key => $ii) { ?>
                <tr>
                    <th scope="row"><?php echo $ii['title']; ?></th>
                    <td><?php echo $ii['value']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php } else if ($is_admin) { ?>
    <p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>
    <?php } ?>
    <?php } ?>

</section>
<?php /* ---------- 상품 정보 끝 ---------- */ ?>

<?php /* ---------- 사용후기 시작 ---------- */ ?>
<section id="sit_use">
    <h2 class="h-hidden">사용후기</h2>
    <?php echo $shop->pg_anchor('sit_use'); ?>

    <div id="itemuse"><?php include_once($skin_dir.'/itemuse.php'); ?></div>
</section>
<?php /* ---------- 사용후기 끝 ---------- */ ?>

<?php /* ---------- 상품문의 시작 ---------- */ ?>
<section id="sit_qa">
    <h2 class="h-hidden">상품문의</h2>
    <?php echo $shop->pg_anchor('sit_qa'); ?>

    <div id="itemqa"><?php include_once($skin_dir.'/itemqa.php'); ?></div>
</section>
<?php /* ---------- 상품문의 끝 ---------- */ ?>

<?php if ($default['de_baesong_content']) { // 배송정보 내용이 있다면 ?>
<?php /* ---------- 배송정보 시작 ---------- */ ?>
<section id="sit_dvr">
    <h2 class="h-hidden">배송정보</h2>
    <?php echo $shop->pg_anchor('sit_dvr'); ?>

    <?php echo conv_content($default['de_baesong_content'], 1); ?>
</section>
<?php /* ---------- 배송정보 끝 ---------- */ ?>
<?php } ?>

<?php if ($default['de_change_content']) { // 교환/반품 내용이 있다면 ?>
<?php /* ---------- 교환/반품 시작 ---------- */ ?>
<section id="sit_ex">
    <h2 class="h-hidden">교환/반품</h2>
    <?php echo $shop->pg_anchor('sit_ex'); ?>

    <?php echo conv_content($default['de_change_content'], 1); ?>
</section>
<?php /* ---------- 교환/반품 끝 ---------- */ ?>
<?php } ?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$('.pg-anchor-in a').on('click', function(e) {
    e.stopPropagation();
    var scrollTopSpace;
    if (window.innerWidth >= 992) {
        scrollTopSpace = 90;
    } else {
        scrollTopSpace = 70;
    }
    var tabLink = $(this).attr('href');
    var offset = $(tabLink).offset().top;
    $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
    return false;
});

$(window).on("load", function() {
    $("#sit_inf_explan").viewimageresize2();
});
</script>