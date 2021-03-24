<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderinquiryview.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * LG 현금영수증 JS
 */
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
        echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_TEST_JS.'"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_REAL_JS.'"></script>'.PHP_EOL;
    }
}
?>

<style>
.shop-steps {position:relative;margin-bottom:30px}
.shop-steps .step-indicator {border-collapse:separate;display:table;margin-left:0;position:relative;table-layout:fixed;vertical-align:middle}
.shop-steps .step-indicator li {display:table-cell;float:none;padding:0;width:1%}
.shop-steps .step-indicator li:before {background-color:#d5d5d5;content:"";display:block;height:1px;position:relative;top:25px}
.shop-steps .step-indicator li:first-child:before {left:50%}
.shop-steps .step-indicator li:last-child:before {right:50%}
.shop-steps .step-indicator .step {background-color:#fff;border:2px solid #e5e5e5;color:#e5e5e5;font-size:20px;width:50px;height:50px;line-height:48px;border-radius:25px !important;margin:0 auto;position:relative;z-index:1}
.shop-steps .step-indicator .caption {box-sizing:border-box;color:#e5e5e5;padding:10px 15px;font-size:14px;font-weight:bold}
.shop-steps .step-indicator .active .step {border-color:#2B2B2E;color:#2B2B2E}
.shop-steps .step-indicator .active .caption {color:#2B2B2E}
.shop-steps .step-indicator .complete .step {border-color:#b5b5b5;color:#b5b5b5}
.shop-steps .step-indicator .complete .caption {color:#b5b5b5}
.shop-steps .step-indicator .incomplete .step {border-color:#b5b5b5;color:#b5b5b5}
.shop-steps .step-indicator .incomplete .caption {color:#b5b5b5}
.shop-steps .step-indicator .inactive .caption {color:#b5b5b5}
.shop-steps .alarm-marker .alarm-point {top:3px;right:3px}
.shop-steps .alarm-marker .alarm-effect {top:-7px;right:-7px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:600px) {
    .shop-steps .step-indicator .caption {font-size:11px;font-weight:normal}
}
<?php } ?>
.shop-order-inquiry-view .order-num-box {border:3px solid #e5e5e5;background:#fff;padding:15px;font-size:15px;color:#959595;margin-bottom:30px}
.shop-order-inquiry-view .order-num-box strong {margin-left:10px;color:#000}
.shop-order-inquiry-view .table-list-eb .table {margin-bottom:10px}
.shop-order-inquiry-view .table-list-eb td img {display:block;width:100% \9;max-width:100%;height:auto}
.shop-order-inquiry-view .table-list-eb .td-img {text-align:center}
.shop-order-inquiry-view .table-list-eb .td-img .td-img-box {display:inline-block;overflow:hidden;width:70px;height:70px}
.shop-order-inquiry-view .order-view-payment {position:relative;border:1px solid #e5e5e5;margin-top:30px}
.shop-order-inquiry-view .order-view-member-area {position:relative;margin-right:370px}
.shop-order-inquiry-view .order-view-member-area .headline-short {margin-bottom:40px}
.shop-order-inquiry-view .order-view-payment-area {position:absolute;top:0;right:0;width:370px;height:100%;border-left:1px solid #e5e5e5;background:#fafafa;padding:15px;box-sizing:border-box}
.shop-order-inquiry-view .order-view-member-area .order-view-member-box {padding:20px 15px;border-bottom:1px solid #e5e5e5}
.shop-order-inquiry-view .order-view-member-area .order-view-member-box.border-bottom-0 {border-bottom:0}
.shop-order-inquiry-view .state-explan-box {position:relative;margin-top:10px;display:none}
.shop-order-inquiry-view .state-explan-box .table-list-eb {background:#fff}
.shop-order-inquiry-view .state-explan-box .table-list-eb .table {margin-bottom:0;font-size:12px}
.shop-order-inquiry-view .payment-info-box {position:relative;overflow:hidden;clear:both;padding:10px 15px;border:1px solid #e5e5e5;margin-top:-1px;background:#fff;text-align:right;font-size:13px;color:#757575}
.shop-order-inquiry-view .payment-info-box span {float:left}
.shop-order-inquiry-view .payment-info-box strong {color:#000;font-size:14px}
.shop-order-inquiry-view .payment-info-total {position:relative;overflow:hidden;border:1px solid #FF4848;margin-bottom:20px}
.shop-order-inquiry-view .payment-info-total h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-order-inquiry-view .payment-info-total-box {position:relative;overflow:hidden;clear:both;padding:10px 15px;border-bottom:1px solid #ff9090;background:#FF7070;text-align:right;font-size:13px;color:#ffeaea}
.shop-order-inquiry-view .payment-info-total-box:last-child {border-bottom:0}
.shop-order-inquiry-view .payment-info-total-box span {float:left}
.shop-order-inquiry-view .payment-info-total-box strong {color:#fff;font-size:14px}
.shop-order-inquiry-view .total-box-in-wrap {position:relative;border:1px solid #FF4848;background:#fff;padding:5px 0;margin-top:5px}
.shop-order-inquiry-view .total-box-in-box {position:relative;overflow:hidden;clear:both;padding:5px 10px;text-align:right;font-size:12px;color:#757575}
.shop-order-inquiry-view .total-box-in-box span {float:left}
.shop-order-inquiry-view .total-box-in-box strong {color:#000;font-size:12px}
#sod_cancel_pop {display:none;position:relative}
#sod_fin_cancelfrm form {padding:0}
.shop-order-inquiry-view .order-payment-cancel h2 {position:absolute;font-size:0;line-height:0;overflow:hidden}
.shop-order-inquiry-view .order-payment-cancel button {height:40px;border:1px solid #959595;font-weight:bold;width:100%;background:#fff;color:#757575}
.shop-order-inquiry-view .order-payment-cancel #sod_fin_cancelfrm {display:block;position:relative;top:inherit;left:inherit;width:100%;margin:20px 0 0;padding:0;background:none;box-shadow:0 0 0 #fff;border:0 none}
.shop-order-inquiry-view .order-payment-cancel .btn-e-xxlg {border:0}
.shop-order-inquiry-view #sod_fin_test {padding:0;margin-top:20px}
.shop-order-inquiry-view #sod_fin_test .btn-e-xxlg {border:0}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width:991px) {
    .shop-order-inquiry-view .order-view-member-area {margin-right:0}
    .shop-order-inquiry-view .order-view-payment-area {position:relative;top:inherit;right:inherit;width:100%;height:auto;border-left:0;border-top:1px solid #e5e5e5;background:#fafafa}
}
<?php } ?>
</style>

<div class="shop-steps">
    <ol class="list-inline text-center step-indicator">
        <li class="complete">
            <div class="step"><span class="fas fa-hand-pointer"></span></div>
            <div class="caption">상품선택</div>
        </li>
        <li class="complete">
            <div class="step"><i class="fas fa-shopping-basket"></i></div>
            <div class="caption">장바구니</div>
        </li>
        <li class="complete">
            <div class="step"><i class="fas fa-credit-card"></i></div>
            <div class="caption">주문/결제</div>
        </li>
        <li class="active">
            <div class="step">
                <div class="alarm-marker">
                    <span class="alarm-effect"></span>
                    <span class="alarm-point"></span>
                </div>
                <i class="fas fa-check"></i>
            </div>
            <div class="caption">주문완료</div>
        </li>
    </ol>
</div>

<div class="shop-order-inquiry-view">
    <div class="order-num-box">
        주문번호 <strong><?php echo $od_id; ?></strong>
    </div>
    <div class="sod-fin-list">
        <div class="headline-short"><h5><strong>주문하신 상품</strong></h5></div>
        <?php if (G5_IS_MOBILE) { ?>
        <p class="text-right font-size-11 margin-bottom-5 color-grey">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>
        <div class="table-list-eb">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2" class="td-border-right">이미지</th>
                            <th scope="col" colspan="7" id="th_itname" class="text-left">상품명</th>
                        </tr>
                        <tr>
                            <th id="th_itopt" class="td-border-right text-left">옵션명</th>
                            <th id="th_itqty" class="td-border-right">수량</th>
                            <th id="th_itprice" class="td-border-right">판매가</th>
                            <th id="th_itsum" class="td-border-right">소계</th>
                            <th id="th_itpt" class="td-border-right">포인트</th>
                            <th id="th_itpt" class="td-border-right">배송비</th>
                            <th id="th_itst"><span class="color-red">상태</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0; $i<$order_count; $i++) { ?>
                        <?php foreach ($order[$i]['option'] as $k => $opt) { ?>
                        <?php if ($k==0) { ?>
                        <tr>
                            <td rowspan="<?php echo $order[$i]['rowspan']; ?>" class="td-img td-border-right"><a href="./item.php?it_id=<?php echo $order[$i]['it_id']; ?>" class="td-img-box"><?php echo $order[$i]['image']; ?></a></td>
                            <td headers="th_itname" colspan="7"><a href="./item.php?it_id=<?php echo $order[$i]['it_id']; ?>"><strong><?php echo $order[$i]['it_name']; ?></strong></a></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td headers="th_itopt" class="td-border-right color-grey"><?php echo get_text($opt['ct_option']); ?></td>
                            <td headers="th_itqty" class="td-border-right text-center"><?php echo number_format($opt['ct_qty']); ?></td>
                            <td headers="th_itprice" class="td-border-right text-right"><?php echo number_format($opt['opt_price']); ?></td>
                            <td headers="th_itsum" class="td-border-right text-right"><?php echo number_format($opt['sell_price']); ?></td>
                            <td headers="th_itpt" class="td-border-right text-right"><?php echo number_format($opt['point']); ?></td>
                            <td headers="th_itpt" class="td-border-right text-right"><?php echo number_format($opt['ct_send_cost']); ?></td>
                            <td headers="th_itst" class="td-bg-color text-center"><strong class="color-red"><?php echo $opt['ct_status']; ?></span></td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-right">
            <button type="button" id="state_explan_open" class="btn-e btn-e-dark">상태설명보기</button>
        </div>
        <div id="state_explan_box" class="state-explan-box">
            <div class="table-list-eb">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>상태</th>
                            <th>설명</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>주문</th>
                            <td>주문이 접수 되었습니다.</td>
                        </tr>
                        <tr>
                            <th>입금</th>
                            <td>입금(결제)이 완료 되었습니다.</td>
                        </tr>
                        <tr>
                            <th>준비</th>
                            <td>상품 준비 중 입니다.</td>
                        </tr>
                        <tr>
                            <th>배송</th>
                            <td>상품 배송 중 입니다.</td>
                        </tr>
                        <tr>
                            <th>완료</th>
                            <td>상품 배송이 완료 되었습니다.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="order-view-payment">
        <div class="order-view-member-area">
            <div class="order-view-member-box">
                <div class="headline-short"><h5><strong>결제/배송 정보</strong></h5></div>
                <div class="table-list-eb">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="td-border-right width-80px">주문번호</th>
                                <td><?php echo $od_id; ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">주문일시</th>
                                <td><?php echo $od['od_time']; ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">결제방식</th>
                                <td><?php echo check_pay_name_replace($od['od_settle_case'], $od, 1); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">결제금액</th>
                                <td><?php echo $od_receipt_price; ?></td>
                            </tr>
                            <?php if($od['od_receipt_price'] > 0) { ?>
                            <tr>
                                <th class="td-border-right">결제일시</th>
                                <td><?php echo $od['od_receipt_time']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($app_no_subj && $app_no) { // 승인번호, 휴대폰번호, 거래번호 ?>
                            <tr>
                                <th class="td-border-right"><?php echo $app_no_subj; ?></th>
                                <td><?php echo $app_no; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($disp_bank) { // 계좌정보 ?>
                            <tr>
                                <th class="td-border-right">입금자명</th>
                                <td><?php echo get_text($od['od_deposit_name']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">입금계좌</th>
                                <td><?php echo get_text($od['od_bank_account']); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if($disp_receipt) { // 영수증 ?>
                            <tr>
                                <th class="td-border-right">영수증</th>
                                <td>
                                    <?php if(isset($hp_receipt_script) && $hp_receipt_script) { ?>
                                    <a href="javascript:;" onclick="<?php echo $hp_receipt_script; ?>">영수증 출력</a>
                                    <?php } ?>

                                    <?php if(isset($card_receipt_script) && $card_receipt_script) { ?>
                                    <a href="javascript:;" onclick="<?php echo $card_receipt_script; ?>">영수증 출력</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php if ($od['od_receipt_point'] > 0) { // 포인트사용 ?>
                            <tr>
                                <th class="td-border-right">포인트사용</th>
                                <td><?php echo display_point($od['od_receipt_point']); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($od['od_refund_price'] > 0) { // 환불 금액 ?>
                            <tr>
                                <th class="td-border-right">환불 금액</th>
                                <td><?php echo display_price($od['od_refund_price']); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($default['de_taxsave_use']) { // 현금영수증 ?>
                            <?php if ($misu_price == 0 && $od['od_receipt_price'] && ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '계좌이체' || $od['od_settle_case'] == '가상계좌')) { // 미수금이 없고 현금일 경우에만 현금영수증을 발급 할 수 있습니다. ?>
                            <tr>
                                <th class="td-border-right">현금영수증</th>
                                <td>
                                    <?php if ($od['od_cash']) { ?>
                                    <a href="javascript:;" onclick="<?php echo $cash_receipt_script; ?>" class="btn_frmline">현금영수증 확인하기</a>
                                    <?php } else { ?>
                                    <a href="javascript:;" onclick="window.open('<?php echo G5_SHOP_URL; ?>/taxsave.php?od_id=<?php echo $od_id; ?>', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');" class="btn_frmline">현금영수증을 발급하시려면 클릭하십시오.</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                     </table>
                </div>
            </div>
            
            <div class="order-view-member-box">
                <div class="headline-short"><h5><strong>주문하신 분</strong></h5></div>
                <div class="table-list-eb">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="td-border-right width-80px">이름</th>
                                <td><?php echo get_text($od['od_name']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">전화번호</th>
                                <td><?php echo get_text($od['od_tel']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">핸드폰</th>
                                <td><?php echo get_text($od['od_hp']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">주 소</th>
                                <td><?php echo get_text(sprintf("(%s%s)", $od['od_zip1'], $od['od_zip2']).' '.print_address($od['od_addr1'], $od['od_addr2'], $od['od_addr3'], $od['od_addr_jibeon'])); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">E-mail</th>
                                <td><?php echo get_text($od['od_email']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="order-view-member-box">
                <div class="headline-short"><h5><strong>받으시는 분</strong></h5></div>
                <div class="table-list-eb">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th class="td-border-right width-80px">이름</th>
                                <td><?php echo get_text($od['od_b_name']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">전화번호</th>
                                <td><?php echo get_text($od['od_b_tel']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">핸드폰</th>
                                <td><?php echo get_text($od['od_b_hp']); ?></td>
                            </tr>
                            <tr>
                                <th class="td-border-right">주 소</th>
                                <td><?php echo get_text(sprintf("(%s%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td>
                            </tr>
                            <?php if ($default['de_hope_date_use']) { ?>
                            <tr>
                                <th class="td-border-right">희망배송일</th>
                                <td><?php echo substr($od['od_hope_date'],0,10).' ('.get_yoil($od['od_hope_date']).')' ;?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($od['od_memo']) { ?>
                            <tr>
                                <th class="td-border-right">전하실 말씀</th>
                                <td><?php echo conv_content($od['od_memo'], 0); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="order-view-member-box border-bottom-0">
                <div class="headline-short"><h5><strong>배송정보</strong></h5></div>
                <div class="table-list-eb">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>배송회사</th>
                                <th class="td-border">운송장번호</th>
                                <th>배송일시</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($od['od_invoice'] && $od['od_delivery_company']) { ?>
                            <tr>
                                <td><?php echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link'); ?></td>
                                <td class="td-border"><?php echo $od['od_invoice']; ?></td>
                                <td><?php echo $od['od_invoice_time']; ?></td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <td colspan="3" class="text-center"><span class="font-size-13 color-grey"><i class="fas fa-exclamation-circle"></i> 아직 배송하지 않았거나 배송정보를 입력하지 못하였습니다.</span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="order-view-payment-area">
            <div class="margin-bottom-20">
                <div class="payment-info-box">
                    <span>주문총액</span>
                    <strong><?php echo number_format($od['od_cart_price']); ?></strong>원
                </div>
                <?php if($od['od_cart_coupon'] > 0) { ?>
                <div class="payment-info-box">
                    <span>개별상품 쿠폰할인</span>
                    <strong><?php echo number_format($od['od_cart_coupon']); ?></strong>원
                </div>
                <?php } ?>
                <?php if($od['od_coupon'] > 0) { ?>
                <div class="payment-info-box">
                    <span>주문금액 쿠폰할인</span>
                    <strong><?php echo number_format($od['od_coupon']); ?></strong>원
                </div>
                <?php } ?>
                <?php if ($od['od_send_cost'] > 0) { ?>
                <div class="payment-info-box">
                    <span>배송비</span>
                    <strong><?php echo number_format($od['od_send_cost']); ?></strong>원
                </div>
                <?php } ?>
                <?php if($od['od_send_coupon'] > 0) { ?>
                <div class="payment-info-box">
                    <span>배송비 쿠폰할인</span>
                    <strong><?php echo number_format($od['od_send_coupon']); ?></strong>원
                </div>
                <?php } ?>
                <?php if ($od['od_send_cost2'] > 0) { ?>
                <div class="payment-info-box">
                    <span>추가배송비</span>
                    <strong><?php echo number_format($od['od_send_cost2']); ?></strong>원
                </div>
                <?php } ?>
                <?php if ($od['od_cancel_price'] > 0) { ?>
                <div class="payment-info-box">
                    <span>취소금액</span>
                    <strong><?php echo number_format($od['od_cancel_price']); ?></strong>원
                </div>
                <?php } ?>
                <div class="payment-info-box">
                    <span>총계</span>
                    <strong><b class="color-red"><?php echo number_format($tot_price); ?></b></strong>원
                </div>
                <div class="payment-info-box">
                    <span>적립포인트</span>
                    <strong><?php echo number_format($tot_point); ?></strong>원
                </div>
            </div>

            <div class="payment-info-total">
                <h2>결제합계</h2>
                <div class="payment-info-total-box">
                    <span>총 구매액</span>
                    <strong><?php echo display_price($tot_price); ?></strong>
                </div>
                <?php
                if ($misu_price > 0) {
                echo '<div class="payment-info-total-box">';
                echo '<span>미결제액</span>'.PHP_EOL;
                echo '<strong>'.display_price($misu_price).'</strong>';
                echo '</div>';
                }
                ?>
                <div id="alrdy" class="payment-info-total-box">
                    <span>결제액</span>
                    <strong><?php echo $wanbul; ?></strong>
                    <?php if( $od['od_receipt_point'] ){    //포인트로 결제한 내용이 있으면 ?>
                    <div class="total-box-in-wrap">
                        <div class="total-box-in-box"><span>- 포인트 결제</span><strong><?php echo number_format($od['od_receipt_point']); ?>점</strong></div>
                        <div class="total-box-in-box"><span>- 실결제</span><strong><?php echo number_format($od['od_receipt_price']); ?>원</strong></div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="order-payment-cancel">
                <?php
                // 취소한 내역이 없다면
                if ($cancel_price == 0) {
                    if ($custom_cancel) {
                ?>
                <button type="button" class="sod_fin_c_btn">주문 취소하기</button>

                <div id="sod_cancel_pop">
                    <div id="sod_fin_cancelfrm">
                        <h2>주문취소</h2>
                        <form method="post" action="<?php echo G5_SHOP_URL; ?>/orderinquirycancel.php" onsubmit="return fcancel_check(this);" class="eyoom-form">
                        <input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
                        <input type="hidden" name="token"  value="<?php echo $token; ?>">

                        <label for="cancel_memo" class="sound_only">취소사유</label>
                        <label class="input required-mark">
                            <input type="text" name="cancel_memo" id="cancel_memo" required size="40" maxlength="100" placeholder="취소사유">
                        </label>
                        <input type="submit" value="확인" class="btn-e btn-e-xxlg btn-e-dark btn-e-block margin-top-10">
                        </form>
                    </div>
                </div>
                <script>	
                $(function (){
                    $(".sod_fin_c_btn").on("click", function() {
                        $("#sod_cancel_pop").show();
                    });
                    $(".sod_cls_btn").on("click", function() {
                        $("#sod_cancel_pop").hide();
                    });		
                });
                </script>
                <?php
                    }
                } else {
                ?>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12"><i class="fas fa-exclamation-circle"></i> 주문 취소, 반품, 품절된 내역이 있습니다.</p>
                </div>
                <?php } ?>
            </div>

            <?php if ($od['od_settle_case'] == '가상계좌' && $od['od_misu'] > 0 && $default['de_card_test'] && $is_admin && $od['od_pg'] == 'kcp') {
            preg_match("/\s{1}([^\s]+)\s?/", $od['od_bank_account'], $matchs);
            $deposit_no = trim($matchs[1]);
            ?>
            <div class="cont-text-bg margin-top-20 margin-bottom-20">
                <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 관리자가 가상계좌 테스트를 한 경우에만 보입니다.</p>
            </div>
            <form method="post" action="http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti_Proc.jsp" target="_blank" class="eyoom-form">
            <div class="headline-short"><h5><strong>모의입금처리</strong></h5></div>
            <label for="e_trade_no">KCP 거래번호</label>
            <label class="input margin-bottom-10">
                <input type="text" name="e_trade_no" value="<?php echo $od['od_tno']; ?>">
            </label>
            <label for="deposit_no">입금계좌</label>
            <label class="input margin-bottom-10">
                <input type="text" name="deposit_no" value="<?php echo $deposit_no; ?>">
            </label>
            <label for="req_name">입금자명</label>
            <label class="input margin-bottom-10">
                <input type="text" name="req_name" value="<?php echo $od['od_deposit_name']; ?>">
            </label>
            <label for="noti_url">입금통보 URL</label>
            <label class="input margin-bottom-10">
                <input type="text" name="noti_url" value="<?php echo G5_SHOP_URL; ?>/settle_kcp_common.php">
            </label>
            <div id="sod_fin_test" class="btn_confirm">
                <input type="submit" value="입금통보 테스트" class="btn-e btn-e-xxlg btn-e-red btn-e-block">
            </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>

<script>
$(function() {
    $("#state_explan_open").on("click", function() {
        var $explan = $("#state_explan_box");
        if($explan.is(":animated"))
            return false;

        if($explan.is(":visible")) {
            $explan.slideUp(200);
            $("#state_explan_open").text("상태설명보기");
        } else {
            $explan.slideDown(200);
            $("#state_explan_open").text("상태설명닫기");
        }
    });

    $("#state_explan_close").on("click", function() {
        var $explan = $("#state_explan_box");
        if($explan.is(":animated"))
            return false;

        $explan.slideUp(200);
        $("#state_explan_open").text("상태설명보기");
    });
});

function fcancel_check(f) {
    if(!confirm("주문을 정말 취소하시겠습니까?"))
        return false;

    var memo = f.cancel_memo.value;
    if(memo == "") {
        alert("취소사유를 입력해 주십시오.");
        return false;
    }

    return true;
}
</script>