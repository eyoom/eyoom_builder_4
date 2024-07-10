<?php
/**
 * skin file : /theme/eb4_basic/skin/shop/basic/boxcart.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="sbsk" class="op-area">
    <h2>장바구니</h2>
    <form name="skin_frmcartlist" id="skin_sod_bsk_list" method="post" action="<?php echo G5_SHOP_URL.'/cartupdate.php'; ?>">
    <ul class="list-unstyled">
        <?php if (is_array($ct_list)) { $i=0; ?>
        <?php foreach ($ct_list as $k => $info) { ?>
        <li>
            <div class="prd-img"><?php echo $info['it_img']; ?></div>
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><?php echo get_text($info['it_name']); ?></a>
        </li>
        <input type="hidden" name="act" value="buy">
        <input type="hidden" name="ct_chk[<?php echo $i; ?>]" value="1">
        <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $info['it_id']; ?>">
        <input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $info['it_name']; ?>">
        <?php $i++; } ?>
        <?php } ?>

        <?php if ($ct_count == 0) { ?>
        <li class="li-empty">해당내용 없음</li>
        <?php } ?>
    </ul>

    <?php if ($ct_count > 0) { ?>
    <button type="submit" class="btn-e btn-e-lg btn-e-block btn-e-navy m-b-5">바로구매</button>
    <?php } ?>
    <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="btn-e btn-e-lg btn-e-block btn-e-dark btn-e-brd">장바구니 바로가기<i class="far fa-arrow-alt-circle-right m-l-5"></i></a>
    </form>
</div>