<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/boxwish.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<aside id="sbsk" class="op-area">
    <h2>위시리스트</h2>
    <ul class="list-unstyled">
        <?php if (is_array($wish_list)) { ?>
        <?php foreach ($wish_list as $k => $info) { ?>
        <li>
            <div class="prd-img"><?php echo $info['it_img']; ?></div>
            <a href="<?php echo shop_item_url($info['it_id']); ?>"><?php echo get_text($info['it_name']); ?></a>
        </li>
        <?php } ?>
        <?php } ?>

        <?php if ($wish_count == 0) { ?>
        <li class="li-empty">해당내용 없음</li>
        <?php } ?>
    </ul>

    <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="btn-e btn-e-lg btn-e-block btn-e-dark btn-e-brd">위시리스트 바로가기<i class="far fa-arrow-alt-circle-right m-l-5"></i></a>
</aside>