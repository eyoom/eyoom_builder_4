<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderinquiry.sub.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.table-list-eb thead th {min-width:100px}
.od-num:hover {color:#ab0000}
.state-label {display:inline-block;color:#fff;padding:5px 7px;line-height:1;font-size:.75rem;min-width:70px;text-align:center}
.state-01 {background:#ab0000}
.state-02 {background:#0d7368}
.state-03 {background:#533889}
.state-04 {background:#db9532}
.state-05 {background:#394488}
.state-06 {background:#757575}
</style>

<?php /* ---------- 주문 내역 목록 시작 ---------- */ ?>
<?php if (!$limit) { ?>
<P class="m-b-10">총 <?php echo $cnt; ?> 건</P>
<?php } ?>

<blockquote class="hero">
	<p class="p-li"><i class="fas fa-info-circle"></i>주문서번호를 클릭하시면 상세 주문내역으로 이동합니다.</p>
</blockquote>

<p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>

<div class="table-list-eb">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>주문서번호</th>
                    <th>주문일시</th>
                    <th>상품수</th>
                    <th>주문금액</th>
                    <th>입금액</th>
                    <th>미입금액</th>
                    <th>상태</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i<$count; $i++) { ?>
                <tr>
                    <td class="text-center">
                        <input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['ct_id']; ?>">
                        <a href="<?php echo $list[$i]['href']; ?>" class="od-num"><u><?php echo $list[$i]['od_id']; ?></u></a>
                    </td>
                    <td class="text-center"><?php echo substr($list[$i]['od_time'],2,14); ?> (<?php echo get_yoil($list[$i]['od_time']); ?>)</td>
                    <td class="text-center"><?php echo $list[$i]['od_cart_count']; ?></td>
                    <td class="text-center"><?php echo display_price($list[$i]['od_price']); ?></td>
                    <td class="text-center"><?php echo display_price($list[$i]['od_receipt_price']); ?></td>
                    <td class="text-center"><?php echo display_price($list[$i]['od_misu']); ?></td>
                    <td class="text-center">
                        <span class="state-label state-0<?php echo $list[$i]['od_status_number'];?>">
                            <?php echo $list[$i]['od_status']; ?>
                        </span>
                    </td>
                </tr>
                <?php } ?>

                <?php if ($count == 0) { ?>
                <tr><td colspan="7" class="text-center"><span class="text-gray"><i class="fas fa-exclamation-circle"></i> 주문 내역이 없습니다.</span></td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php /* ---------- 주문 내역 목록 끝 ---------- */ ?>