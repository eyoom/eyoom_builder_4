<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderinquiry.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.od-num:hover {color:#FF4848}
.state-label {display:inline-block;color:#fff;padding:3px 5px;line-height:1;font-size:11px;min-width:62px;text-align:center}
.state-01 {background:#FF4848}
.state-02 {background:#73B852}
.state-03 {background:#907EEC}
.state-04 {background:#FDAB29}
.state-05 {background:#6284F3}
.state-06 {background:#fff;border:1px solid #d5d5d5;color:#656565}
</style>

<?php /* ---------- 주문 내역 목록 시작 ---------- */ ?>
<?php if (!$limit) { ?>
<P>총 <?php echo $cnt; ?> 건</P>
<?php } ?>

<blockquote class="hero">
	<p><i class="fas fa-info-circle"></i> 주문서번호를 클릭하시면 상세 주문내역으로 이동합니다.</p>
</blockquote>

<?php if (G5_IS_MOBILE) { ?>
<p class="text-right font-size-11 margin-bottom-5 color-grey">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>
<?php } ?>

<div class="table-list-eb">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">주문서번호</th>
                    <th scope="col" class="td-border">주문일시</th>
                    <th scope="col">상품수</th>
                    <th scope="col" class="td-border">주문금액</th>
                    <th scope="col">입금액</th>
                    <th scope="col" class="td-border">미입금액</th>
                    <th scope="col">상태</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i<$count; $i++) { ?>
                <tr>
                    <td class="text-center">
                        <input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['ct_id']; ?>">
                        <a href="<?php echo $list[$i]['href']; ?>" class="od-num"><u><?php echo $list[$i]['od_id']; ?></u></a>
                    </td>
                    <td class="td-border text-center"><?php echo substr($list[$i]['od_time'],2,14); ?> (<?php echo get_yoil($list[$i]['od_time']); ?>)</td>
                    <td class="text-center"><?php echo $list[$i]['od_cart_count']; ?></td>
                    <td class="td-border text-right"><?php echo display_price($list[$i]['od_price']); ?></td>
                    <td class="text-right"><?php echo display_price($list[$i]['od_receipt_price']); ?></td>
                    <td class="td-border text-right"><?php echo display_price($list[$i]['od_misu']); ?></td>
                    <td class="text-center">
                        <span class="state-label state-0<?php echo $list[$i]['od_status_number'];?>">
                            <?php echo $list[$i]['od_status']; ?>
                        </span>
                    </td>
                </tr>
                <?php } ?>

                <?php if ($count == 0) { ?>
                <tr><td colspan="7" class="text-center"><span class="color-grey"><i class="fas fa-exclamation-circle"></i> 주문 내역이 없습니다.</span></td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php /* ---------- 주문 내역 목록 끝 ---------- */ ?>