<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/orderform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-orderform .table-list-eb {background:#fff}
.admin-shop-orderform .table-list-eb img {display:block;width:100% \9;max-width:100%;height:auto}
.admin-shop-orderform .checkbox-lineheight .checkbox {line-height:16px}
.admin-shop-orderform .checkbox-lineheight .checkbox i {top:0;line-height:26px}
.admin-shop-orderform .orderform-btns .btn-e {margin-bottom:3px}
.admin-shop-orderform .alert-padding-trans {padding:3px 10px 4px}
.admin-shop-orderform .orderform-box {position:relative;border:1px solid #d5d5d5;padding:10px;background:#fff}
@media screen and (max-width: 600px){
	.admin-shop-orderform .orderform-box .col {margin-bottom:5px}
}
.admin-shop-orderform .orderform-box .row {padding:5px}
.admin-shop-orderform .orderform-box .row .col-3 {font-weight:bold}
.admin-shop-orderform .orderform-box .row .col-4 {font-weight:bold}
.admin-shop-orderform .od_test_caution {color:#E52700}
@media (min-width: 1100px) {
	.pg-anchor-in.tab-e2 .nav-tabs li a {font-size:14px;font-weight:bold;padding:8px 17px}
	.pg-anchor-in.tab-e2 .nav-tabs li.active a {z-index:1;border:1px solid #000;border-top:1px solid #DE2600;color:#DE2600}
	.pg-anchor-in.tab-e2 .tab-bottom-line {position:relative;display:block;height:1px;background:#000;margin-bottom:20px}
}
@media (max-width: 1099px) {
	.pg-anchor-in {position:relative;overflow:hidden;margin-bottom:20px;border:1px solid #757575}
	.pg-anchor-in.tab-e2 .nav-tabs li {width:33.33333%;margin:0}
	.pg-anchor-in.tab-e2 .nav-tabs li a {font-size:11px;padding:6px 0;text-align:center;border-bottom:1px solid #d5d5d5;margin-right:0;font-weight:bold;background:#fff}
	.pg-anchor-in.tab-e2 .nav-tabs li.active a {border:0;border-bottom:1px solid #d5d5d5 !important;color:#DE2600;background:#fff1f0}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(4) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(5) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(9) a {border-bottom:0 !important}
	.pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
</style>

<div class="admin-shop-orderform">
    <div class="adm-headline">
        <h3>주문 내역</h3>
    </div>

	<div id="anc_sodr_list">
		<div class="pg-anchor">
			<?php echo adm_pg_anchor('anc_sodr_list'); ?>
		</div>

		<form name="frmorderform" id="frmorderform" action="<?php echo $action_url1; ?>" onsubmit="return form_submit(this);" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
        <input type="hidden" name="mb_id" value="<?php echo $od['mb_id']; ?>">
        <input type="hidden" name="od_email" value="<?php echo $od['od_email']; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="sel_field" value="<?php echo $sel_field; ?>">
        <input type="hidden" name="search" value="<?php echo $search; ?>">
        <input type="hidden" name="page" value="<?php echo $page;?>">
        <input type="hidden" name="pg_cancel" value="0">

		<?php if (G5_IS_MOBILE) { ?>
		<p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fa fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fa fa-arrows-h"></i>)</p>
		<?php } ?>

	    <p>
	        현재 주문상태 <strong class="color-red"><?php echo $od['od_status']; ?></strong><span class="margin-left-5 margin-right-5 color-light-grey">|</span>주문일시 <strong><?php echo substr($od['od_time'],0,16); ?> (<?php echo get_yoil($od['od_time']); ?>)</strong><span class="margin-left-5 margin-right-5 color-light-grey">|</span>주문총액 <strong><?php echo number_format($od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2']); ?></strong>원
	    </p>
	    <?php if ($default['de_hope_date_use']) { ?>
	    <p>희망배송일은 <?php echo $od['od_hope_date']; ?> (<?php echo get_yoil($od['od_hope_date']); ?>) 입니다.</p>
	    <?php } ?>
	    <?php if($od['od_mobile']) { ?>
	    <p>모바일 쇼핑몰의 주문입니다.</p>
	    <?php } ?>

        <div class="table-list-eb">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="width-100px">상품이미지</th>
                            <th class="width-200px">주문번호 / 상품명</th>
                            <th>
                                <label for="sit_select_all" class="checkbox">
                                    <input type="checkbox" id="sit_select_all"><i></i>
                                </label>
                            </th>
                            <th class="width-200px">옵션항목</th>
                            <th class="width-50px">상태</th>
                            <th class="width-50px">수량</th>
                            <th>판매가</th>
                            <th>소계</th>
                            <th class="width-50px">쿠폰</th>
                            <th class="width-50px">포인트</th>
                            <th class="width-50px">배송비</th>
                            <th class="width-50px">포인트<br>반영</th>
                            <th class="width-50px">재고<br>반영</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { $opt = $list[$i]['opt'];?>
                        <?php for($k=0; $k<count((array)$opt); $k++) { ?>
                        <tr>
                            <?php if ($k == 0) { ?>
                            <td rowspan="<?php echo $list[$i]['rowspan']; ?>">
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a>
                            </td>
                            <td rowspan="<?php echo $list[$i]['rowspan']; ?>">
                                <span class="color-grey"><?php echo $od['od_id']; ?></span><br>
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><strong><?php echo get_text($list[$i]['it_name']); ?></strong></a>
                                <?php if($od['od_tax_flag'] && $list[$i]['ct_notax']) echo '[비과세상품]'; ?>
                            </td>
                            <td rowspan="<?php echo $list[$i]['rowspan']; ?>">
                                <label for="sit_sel_<?php echo $i; ?>" class="checkbox">
                                    <input type="checkbox" id="sit_sel_<?php echo $i; ?>" name="it_sel[]"><i></i>
                                </label>
                            </td>
                            <?php } ?>
                            <td class="checkbox-lineheight">
                                <label for="ct_chk_<?php echo $opt[$k]['chk_cnt']; ?>" class="checkbox">
                                    <input type="checkbox" name="ct_chk[<?php echo $opt[$k]['chk_cnt']; ?>]" id="ct_chk_<?php echo $opt[$k]['chk_cnt']; ?>" value="<?php echo $opt[$k]['chk_cnt']; ?>" class="sct_sel_<?php echo $i; ?>"><i></i> <?php echo get_text($opt[$k]['ct_option']); ?>
                                    <input type="hidden" name="ct_id[<?php echo $opt[$k]['chk_cnt']; ?>]" value="<?php echo $opt[$k]['ct_id']; ?>">
                                </label>
                            </td>
                            <td><?php echo $opt[$k]['ct_status']; ?></td>
                            <td>
                                <label class="sound_only"><?php echo get_text($opt[$k]['ct_option']); ?> 수량</label>
                                <label for="ct_qty_<?php echo $opt[$k]['chk_cnt']; ?>" class="input">
                                    <input type="text" name="ct_qty[<?php echo $opt[$k]['chk_cnt']; ?>]" id="ct_qty_<?php echo $opt[$k]['chk_cnt']; ?>" value="<?php echo $opt[$k]['ct_qty']; ?>" required>
                                </label>
                            </td>
                            <td class="text-right"><?php echo number_format($opt[$k]['opt_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt[$k]['ct_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt[$k]['cp_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt[$k]['ct_point']); ?></td>
                            <td><?php echo $list[$i]['ct_send_cost']; ?></td>
                            <td><?php echo get_yn($opt[$k]['ct_point_use']); ?></td>
                            <td><?php echo get_yn($opt[$k]['ct_stock_use']); ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="btn_list02 btn_list">
            <div class="margin-bottom-5">
                <strong>주문 및 장바구니 상태 변경</strong>
            </div>
            <div class="orderform-btns">
                <input type="hidden" name="chk_cnt" value="<?php echo $chk_cnt; ?>">
                <input type="submit" name="ct_status" value="주문" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '주문' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="입금" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '입금' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="준비" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '준비' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="배송" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '배송' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="완료" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '완료' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="취소" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '취소' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="반품" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '반품' ? 'yellow':'default'; ?>">
                <input type="submit" name="ct_status" value="품절" onclick="document.pressed=this.value" class="btn-e btn-e-<?php echo $od['od_status'] == '품절' ? 'yellow':'default'; ?>">
            </div>
        </div>
        <div class="margin-bottom-20"></div>

        <div class="alert alert-warning">
            <p>주문, 입금, 준비, 배송, 완료는 장바구니와 주문서 상태를 모두 변경하지만, 취소, 반품, 품절은 장바구니의 상태만 변경하며, 주문서 상태는 변경하지 않습니다.<br>개별적인(이곳에서의) 상태 변경은 모든 작업을 수동으로 처리합니다. 예를 들어 주문에서 입금으로 상태 변경시 입금액(결제금액)을 포함한 모든 정보는 수동 입력으로 처리하셔야 합니다.</p>
        </div>

        </form>

        <?php if ($od['od_mod_history']) { ?>
        <section id="sodr_qty_log">
            <h3>주문 수량변경 및 주문 전체취소 처리 내역</h3>
            <div>
                <?php echo conv_content($od['od_mod_history'], 0); ?>
            </div>
        </section>
        <?php } ?>

        <?php if ($od['od_test']) { ?>
        <div class="margin-bottom-10"></div>
        <blockquote class="hero-bg-red od_test_caution">
            <p><strong>주의) 이 주문은 테스트용으로 실제 결제가 이루어지지 않았으므로 절대 배송하시면 안됩니다.</strong></p>
        </blockquote>
        <?php } ?>
        
        <?php if($od['od_pg'] === 'inicis' && !$od['od_test']) {
            $sql = "select P_TID from {$g5['g5_shop_inicis_log_table']} where oid = '$od_id' and P_STATUS = 'cancel' ";
            $tmp_row = sql_fetch($sql);
            if($tmp_row['P_TID']) {
        ?>
        <div class="margin-bottom-10"></div>
        <blockquote class="hero-bg-red od_test_caution">
            <p><strong>주의) 이 주문은 결제취소된 내역이 있습니다. 이니시스 관리자 상점에서 반드시 재확인을 해 주세요.</strong></p>
        </blockquote>
        <?php 
            }   //end if
        }   //end if
        ?>
    </div>
    <div class="margin-bottom-30"></div>

    <div id="anc_sodr_pay">
        <div class="pg-anchor">
            <?php echo adm_pg_anchor('anc_sodr_pay'); ?>
        </div>

        <p class="font-size-14 text-right"><strong class="color-red">미수금</strong> <strong class="color-black"><?php echo display_price($od['od_misu']); ?></strong></p>

        <div class="table-list-eb">
            <div class="table-responsive">

                <table class="table table-bordered">
                    <caption>주문결제 내역</caption>
                    <thead>
                        <tr>
                            <th>주문번호</th>
                            <th>결제방법</th>
                            <th>주문총액</th>
                            <th>배송비</th>
                            <th>포인트결제</th>
                            <th>총결제액</th>
                            <th>쿠폰</th>
                            <th>주문취소</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $od['od_id']; ?></td>
                            <td><?php echo $s_receipt_way; ?></td>
                            <td><?php echo display_price($amount['order']); ?></td>
                            <td><?php echo display_price($od['od_send_cost'] + $od['od_send_cost2']); ?></td>
                            <td><?php echo display_point($od['od_receipt_point']); ?></td>
                            <td><?php echo number_format($amount['receipt']); ?>원</td>
                            <td><?php echo display_price($amount['coupon']); ?></td>
                            <td><?php echo number_format($amount['cancel']); ?>원</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="margin-bottom-30"></div>

    <div id="anc_sodr_chk">
        <div class="pg-anchor">
            <?php echo adm_pg_anchor('anc_sodr_chk'); ?>
        </div>

        <form name="frmorderreceiptform" action="<?php echo $action_url2; ?>" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="sel_field" value="<?php echo $sel_field; ?>">
        <input type="hidden" name="search" value="<?php echo $search; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="od_name" value="<?php echo $od['od_name']; ?>">
        <input type="hidden" name="od_hp" value="<?php echo $od['od_hp']; ?>">
        <input type="hidden" name="od_tno" value="<?php echo $od['od_tno']; ?>">
        <input type="hidden" name="od_escrow" value="<?php echo $od['od_escrow']; ?>">
        <input type="hidden" name="od_pg" value="<?php echo $od['od_pg']; ?>">

		<div class="orderform-box">
			<div class="row">
				<div class="col col-6">
					<h4><strong class="color-purple">결제상세정보 확인</strong></h4>
					<div class="margin-bottom-10"></div>

                    <?php if ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') { ?>
                    <?php if ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌') { ?>
					<div class="row">
						<div class="col col-4">계좌번호</div>
						<div class="col col-8"><?php echo get_text($od['od_bank_account']); ?></div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col col-4"><?php echo $od['od_settle_case']; ?> 입금액</div>
						<div class="col col-8"><?php echo display_price($od['od_receipt_price']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">입금자</div>
						<div class="col col-8"><?php echo get_text($od['od_deposit_name']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">입금확인일시</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == 0) { ?>
							입금 확인일시를 체크해 주세요.
							<?php } else { ?>
							<?php echo $od['od_receipt_time']; ?> (<?php echo get_yoil($od['od_receipt_time']); ?>)
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '휴대폰') { ?>
					<div class="row">
						<div class="col col-4">휴대폰번호</div>
						<div class="col col-8"><?php echo get_text($od['od_bank_account']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4"><?php echo $od['od_settle_case']; ?> 결제액</div>
						<div class="col col-8"><?php echo display_price($od['od_receipt_price']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">결제 확인일시</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == 0) { ?>
							결제 확인일시를 체크해 주세요.
							<?php } else { ?>
							<?php echo $od['od_receipt_time']; ?> (<?php echo get_yoil($od['od_receipt_time']); ?>)
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '신용카드') { ?>
					<div class="row">
						<div class="col col-4">신용카드 결제금액</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							0원
							<?php } else { ?>
							<?php echo display_price($od['od_receipt_price']); ?>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">카드 승인일시</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							신용카드 결제 일시 정보가 없습니다.
							<?php } else { ?>
							<?php echo substr($od['od_receipt_time'], 0, 20); ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == 'KAKAOPAY') { ?>
					<div class="row">
						<div class="col col-4">KAKOPAY 결제금액</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							0원
							<?php } else { ?>
							<?php echo display_price($od['od_receipt_price']); ?>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">KAKAOPAY 승인일시</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							KAKAOPAY 결제 일시 정보가 없습니다.
							<?php } else { ?>
							<?php echo substr($od['od_receipt_time'], 0, 20); ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '간편결제' || ($od['od_pg'] == 'inicis' && is_inicis_order_pay($od['od_settle_case']) ) ) { ?>
					<div class="row">
						<div class="col col-4"><?php echo $s_receipt_way; ?> 결제금액</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							0원
							<?php } else { ?>
							<?php echo display_price($od['od_receipt_price']); ?>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col col-4"><?php echo $s_receipt_way; ?> 승인일시</div>
						<div class="col col-8">
							<?php if ($od['od_receipt_time'] == "0000-00-00 00:00:00") { ?>
							<?php echo $s_receipt_way; ?> 결제 일시 정보가 없습니다.
							<?php } else { ?>
							<?php echo substr($od['od_receipt_time'], 0, 20); ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] != '무통장') { ?>
					<div class="row">
						<div class="col col-4">결제대행사 링크</div>
						<div class="col col-8">
    						<a href="<?php echo $pg_url; ?>" target="_blank"><?php echo $pg_test; ?>바로가기</a><br>
						</div>
					</div>
					<?php } ?>

					<?php if($od['od_tax_flag']) { ?>
					<div class="row">
						<div class="col col-4">과세공급가액</div>
						<div class="col col-8"><?php echo display_price($od['od_tax_mny']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">과세부가세액</div>
						<div class="col col-8"><?php echo display_price($od['od_vat_mny']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">비과세공급가액</div>
						<div class="col col-8"><?php echo display_price($od['od_free_mny']); ?></div>
					</div>
					<?php } ?>

					<div class="row">
						<div class="col col-4">주문금액할인</div>
						<div class="col col-8"><?php echo display_price($od['od_coupon']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">포인트</div>
						<div class="col col-8"><?php echo display_point($od['od_receipt_point']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">결제취소/환불액</div>
						<div class="col col-8"><?php echo display_price($od['od_refund_price']); ?></div>
					</div>

					<?php if ($od['od_invoice']) { ?>
					<div class="row">
						<div class="col col-4">배송회사</div>
						<div class="col col-8"><?php echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link'); ?></div>
					</div>
					<div class="row">
						<div class="col col-4">운송장번호</div>
						<div class="col col-8"><?php echo $od['od_invoice']; ?></div>
					</div>
					<div class="row">
						<div class="col col-4">배송일시</div>
						<div class="col col-8">
							<?php if (!is_null_time($od['od_invoice_time'])) { ?>
							<?php echo $od['od_invoice_time']; ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

					<div class="row">
						<div class="col col-4">배송비</div>
						<div class="col col-6">
							<label class="input" for="od_send_cost">
								<i class="icon-append">원</i>
								<input type="text" name="od_send_cost" id="od_send_cost" value="<?php echo $od['od_send_cost']; ?>">
							</label>
						</div>
						<div class="col col-2"></div>
					</div>

					<?php if($od['od_send_coupon']) { ?>
					<div class="row">
						<div class="col col-4">배송비할인</div>
						<div class="col col-8"><?php echo display_price($od['od_send_coupon']); ?></div>
					</div>
					<?php } ?>

					<div class="row">
						<div class="col col-4">추가배송비</div>
						<div class="col col-6">
							<label class="input" for="od_send_cost2">
								<i class="icon-append">원</i>
								<input type="text" name="od_send_cost2" id="od_send_cost2" value="<?php echo $od['od_send_cost2']; ?>">
							</label>
						</div>
						<div class="col col-2"></div>
					</div>

                    <?php if ($od['od_misu'] == 0 && $od['od_receipt_price'] && ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체')) { ?>
					<div class="row">
						<div class="col col-4">현금영수증</div>
						<div class="col col-8">
						<?php if ($od['od_cash']) { ?>
							<a href="javascript:;" onclick="<?php echo $cash_receipt_script; ?>">현금영수증 확인</a>
						<?php } else { ?>
							<a href="javascript:;" onclick="window.open('<?php echo G5_SHOP_URL; ?>/taxsave.php?od_id=<?php echo $od_id; ?>', 'taxsave', 'width=550,height=400,scrollbars=1,menus=0');">현금영수증 발급</a>
						<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>

				<div class="col col-6">
					<h4><strong class="color-purple">결제상세정보 수정</strong></h4>
					<div class="margin-bottom-10"></div>

					<?php if ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') { ?>
					<?php if ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌') { ?>
					<div class="row">
						<div class="col col-4">계좌번호</div>
						<div class="col col-8"><?php echo $bank_account; ?></div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col col-4"><?php echo $od['od_settle_case']; ?> 입금액</div>
						<div class="col col-8">
							<?php echo $html_receipt_chk; ?>
							<label class="input" for="od_receipt_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_receipt_price" value="<?php echo $od['od_receipt_price']; ?>" id="od_receipt_price">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">입금자명</div>
						<div class="col col-8">
							<?php if ($config['cf_sms_use'] && $default['de_sms_use4']) { ?>
							<label class="checkbox" for="od_sms_ipgum_check">
								<input type="checkbox" name="od_sms_ipgum_check" id="od_sms_ipgum_check"><i></i> SMS 입금 문자전송
							</label>
							<?php } ?>
							<label class="input" for="od_deposit_name">
								<input type="text" name="od_deposit_name" value="<?php echo get_text($od['od_deposit_name']); ?>" id="od_deposit_name">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">입금 확인일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_bank_chk">
								<input type="checkbox" name="od_bank_chk" id="od_bank_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.od_receipt_time.value=this.form.od_bank_chk.value; else this.form.od_receipt_time.value = this.form.od_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_receipt_time">
								<input type="text" name="od_receipt_time" value="<?php echo is_null_time($od['od_receipt_time']) ? "" : $od['od_receipt_time']; ?>" id="od_receipt_time" maxlength="19">
							</label>
							<div class="note">형식 : 0000-00-00 00:00:00</div>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '휴대폰') { ?>
					<div class="row">
						<div class="col col-4">휴대폰번호</div>
						<div class="col col-8"><?php echo get_text($od['od_bank_account']); ?></div>
					</div>
					<div class="row">
						<div class="col col-4"><?php echo $od['od_settle_case']; ?> 결제액</div>
						<div class="col col-8">
							<?php echo $html_receipt_chk; ?>
							<label class="input" for="od_receipt_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_receipt_price" value="<?php echo $od['od_receipt_price']; ?>" id="od_receipt_price">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">휴대폰 결제일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_hp_chk">
								<input type="checkbox" name="od_hp_chk" id="od_hp_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.od_receipt_time.value=this.form.od_bank_chk.value; else this.form.od_receipt_time.value = this.form.od_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_receipt_time">
								<input type="text" name="od_receipt_time" value="<?php echo is_null_time($od['od_receipt_time']) ? "" : $od['od_receipt_time']; ?>" id="od_receipt_time" maxlength="19">
							</label>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '신용카드') { ?>
					<div class="row">
						<div class="col col-4">신용카드 결제금액</div>
						<div class="col col-8">
							<?php echo $html_receipt_chk; ?>
							<label class="input" for="od_receipt_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_receipt_price" value="<?php echo $od['od_receipt_price']; ?>" id="od_receipt_price">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">카드 승인일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_hp_chk">
								<input type="checkbox" name="od_card_chk" id="od_card_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.od_receipt_time.value=this.form.od_bank_chk.value; else this.form.od_receipt_time.value = this.form.od_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_receipt_time">
								<input type="text" name="od_receipt_time" value="<?php echo is_null_time($od['od_receipt_time']) ? "" : $od['od_receipt_time']; ?>" id="od_receipt_time" maxlength="19">
							</label>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == 'KAKAOPAY') { ?>
					<div class="row">
						<div class="col col-4">KAKAOPAY 결제금액</div>
						<div class="col col-8">
							<?php echo $html_receipt_chk; ?>
							<label class="input" for="od_receipt_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_receipt_price" value="<?php echo $od['od_receipt_price']; ?>" id="od_receipt_price">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4">KAKAOPAY 승인일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_hp_chk">
								<input type="checkbox" name="od_card_chk" id="od_card_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.od_receipt_time.value=this.form.od_bank_chk.value; else this.form.od_receipt_time.value = this.form.od_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_receipt_time">
								<input type="text" name="od_receipt_time" value="<?php echo is_null_time($od['od_receipt_time']) ? "" : $od['od_receipt_time']; ?>" id="od_receipt_time" maxlength="19">
							</label>
						</div>
					</div>
					<?php } ?>

					<?php if ($od['od_settle_case'] == '간편결제' || ($od['od_pg'] == 'inicis' && is_inicis_order_pay($od['od_settle_case']) )) { ?>
					<div class="row">
						<div class="col col-4"><?php echo $s_receipt_way; ?> 결제금액</div>
						<div class="col col-8">
							<?php echo $html_receipt_chk; ?>
							<label class="input" for="od_receipt_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_receipt_price" value="<?php echo $od['od_receipt_price']; ?>" id="od_receipt_price">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-4"><?php echo $s_receipt_way; ?> 승인일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_hp_chk">
								<input type="checkbox" name="od_card_chk" id="od_card_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="if (this.checked == true) this.form.od_receipt_time.value=this.form.od_bank_chk.value; else this.form.od_receipt_time.value = this.form.od_receipt_time.defaultValue;"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_receipt_time">
								<input type="text" name="od_receipt_time" value="<?php echo is_null_time($od['od_receipt_time']) ? "" : $od['od_receipt_time']; ?>" id="od_receipt_time" maxlength="19">
							</label>
						</div>
					</div>
					<?php } ?>

					<div class="row">
						<div class="col col-4">포인트 결제액</div>
						<div class="col col-8">
							<label class="input" for="od_receipt_point">
								<i class="icon-append">점</i>
								<input type="text" name="od_receipt_point" value="<?php echo $od['od_receipt_point']; ?>" id="od_receipt_point">
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col col-4">결제취소/환불 금액</div>
						<div class="col col-8">
							<label class="input" for="od_refund_price">
								<i class="icon-append">원</i>
								<input type="text" name="od_refund_price" value="<?php echo $od['od_refund_price']; ?>" id="od_refund_price">
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col col-4">운송장번호</div>
						<div class="col col-8">
							<?php if ($config['cf_sms_use'] && $default['de_sms_use5']) { ?>
							<label class="checkbox" for="od_sms_baesong_check">
								<input type="checkbox" name="od_sms_baesong_check" id="od_sms_baesong_check"><i></i> SMS 배송 문자전송
							</label>
							<?php } ?>
							<label class="input" for="od_invoice">
								<input type="text" name="od_invoice" value="<?php echo $od['od_invoice']; ?>" id="od_invoice">
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col col-4">배송회사</div>
						<div class="col col-8">
							<label class="checkbox" for="od_delivery_chk">
								<input type="checkbox" name="od_delivery_chk" id="od_delivery_chk" value="<?php echo $default['de_delivery_company']; ?>" onclick="chk_delivery_company();"><i></i> 기본 배송회사로 설정
							</label>
							<label class="input" for="od_delivery_company">
								<input type="text" name="od_delivery_company" value="<?php echo $od['od_delivery_company']; ?>" id="od_delivery_company">
							</label>
						</div>
					</div>

					<div class="row">
						<div class="col col-4">배송일시</div>
						<div class="col col-8">
							<label class="checkbox" for="od_invoice_chk">
								<input type="checkbox" name="od_invoice_chk" id="od_invoice_chk" value="<?php echo date("Y-m-d H:i:s", G5_SERVER_TIME); ?>" onclick="chk_invoice_time();"><i></i> 현재 시간으로 설정
							</label>
							<label class="input" for="od_invoice_time">
								<input type="text" name="od_invoice_time" value="<?php echo is_null_time($od['od_invoice_time']) ? "" : $od['od_invoice_time']; ?>" id="od_invoice_time">
							</label>
						</div>
					</div>

					<?php if ($config['cf_email_use']) { ?>
					<div class="row">
						<div class="col col-4">메일발송</div>
						<div class="col col-8">
							<label class="checkbox" for="od_send_mail">
								<input type="checkbox" name="od_send_mail" value="1" id="od_send_mail"><i></i> 메일발송
							</label>
							<div class="note margin-bottom-10"><strong>Note:</strong> 주문자님께 입금, 배송내역을 메일로 발송합니다. 메일발송시 상점메모에 기록됩니다.</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="text-center margin-top-30 margin-bottom-30">
			<input type="submit" value="결제/배송내역 수정" class="btn-e btn-e-lg btn-e-red" accesskey="s">
			<?php if($od['od_status'] == '주문' && $od['od_misu'] > 0) { ?>
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=personalpayform&amp;wmode=1&amp;od_id=<?php echo $od_id; ?>" id="personalpay_add" onclick="personalpay_modal(this.href); return false;" class="btn-e btn-e-lg btn-e-dark">개인결제추가</a>
			<?php } ?>
			<?php if($od['od_misu'] < 0 && ($od['od_receipt_price'] - $od['od_refund_price']) > 0 && ($od['od_settle_case'] == '신용카드' || $od['od_settle_case'] == '계좌이체' || $od['od_settle_case'] == 'KAKAOPAY')) { ?>
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderpartcancel&amp;wmode=1&amp;od_id=<?php echo $od_id; ?>" id="orderpartcancel" onclick="orderpartcancel_modal(this.href); return false;" class="btn-e btn-e-lg btn-e-dark"><?php echo $od['od_settle_case']; ?> 부분취소</a>
			<?php } ?>
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderlist&amp;qstr=<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
		</div>
		</form>
	</div>
	<div class="margin-bottom-30"></div>

	<div id="anc_sodr_memo">
		<div class="pg-anchor">
			<?php echo adm_pg_anchor('anc_sodr_memo'); ?>
		</div>

	    <form name="frmorderform2" action="<?php echo $action_url3; ?>" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="sel_field" value="<?php echo $sel_field; ?>">
        <input type="hidden" name="search" value="<?php echo $search; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="mod_type" value="memo">

		<div class="alert alert-info">
		    <p>
    		    현재 열람 중인 주문에 대한 내용을 메모하는곳입니다.<br>
    		    입금, 배송 내역을 메일로 발송할 경우 함께 기록됩니다.
            </p>
		</div>

		<label for="od_shop_memo" class="textarea textarea-resizable">
			<textarea name="od_shop_memo" id="od_shop_memo" rows="8"><?php echo html_purifier(stripslashes($od['od_shop_memo'])); ?></textarea>
		</label>

		<div class="text-center margin-top-30 margin-bottom-30">
			<input type="submit" value="메모 수정" class="btn-e btn-e-lg btn-e-red">
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderlist&amp;qstr=<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
		</div>
	    </form>
    </div>
	<div class="margin-bottom-30"></div>

	<div id="anc_sodr_orderer"><div id="anc_sodr_taker"></div>
		<div class="pg-anchor">
			<?php echo adm_pg_anchor('anc_sodr_orderer'); ?>
		</div>

	    <form name="frmorderform3" action="<?php echo $action_url3; ?>" method="post" autocomplete="off" class="eyoom-form">
        <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
        <input type="hidden" name="sort1" value="<?php echo $sort1; ?>">
        <input type="hidden" name="sort2" value="<?php echo $sort2; ?>">
        <input type="hidden" name="sel_field" value="<?php echo $sel_field; ?>">
        <input type="hidden" name="search" value="<?php echo $search; ?>">
        <input type="hidden" name="page" value="<?php echo $page; ?>">
        <input type="hidden" name="mod_type" value="info">

		<div class="orderform-box">
			<div class="row">
				<div class="col col-6">
					<h4><strong class="color-purple">주문하신 분</strong></h4>
					<div class="margin-bottom-10"></div>

					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>이름</div>
						<div class="col col-9">
							<label for="od_name" class="input">
								<input type="text" name="od_name" value="<?php echo get_text($od['od_name']); ?>" id="od_name" required>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>전화번호</div>
						<div class="col col-9">
							<label for="od_tel" class="input">
								<input type="text" name="od_tel" value="<?php echo get_text($od['od_tel']); ?>" id="od_tel" required>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>핸드폰</div>
						<div class="col col-9">
							<label for="od_hp" class="input">
								<input type="text" name="od_hp" value="<?php echo get_text($od['od_hp']); ?>" id="od_hp">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>주소</div>
						<div class="col col-9">
							<div class="row">
								<div class="col col-6">
									<section>
										<label for="od_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
										<label class="input">
											<i class="icon-append fa fa-question-circle"></i>
					                    	<input type="text" name="od_zip" value="<?php echo get_text($od['od_zip1']).get_text($od['od_zip2']); ?>" id="od_zip" maxlength="6" readonly="readonly">
					                    	<b class="tooltip tooltip-top-right">우편번호</b>
										</label>
									</section>
								</div>
								<div class="col col-4">
									<section>
										<button type="button" onclick="win_zip('frmorderform3', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'od_addr_jibeon');" class="btn-e btn-e-purple">주소 검색</button>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col col-12">
									<section>
						                <label class="input">
						                	<input type="text" name="od_addr1" value="<?php echo get_text($od['od_addr1']); ?>" id="od_addr1">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col col-6">
									<section>
						                <label class="input">
						                	<input type="text" name="od_addr2" value="<?php echo get_text($od['od_addr2']); ?>" id="od_addr2">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
									</section>
								</div>
								<div class="col col-6">
									<section>
						                <label class="input">
						                	<input type="text" name="od_addr3" value="<?php echo get_text($od['od_addr3']); ?>" id="od_addr3">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 참고항목</div>
									</section>
								</div>
								<input type="hidden" name="od_addr_jibeon" value="<?php echo get_text($od['od_addr_jibeon']); ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>E-mail</div>
						<div class="col col-9">
							<label for="od_email" class="input">
								<input type="text" name="od_email" value="<?php echo $od['od_email']; ?>" id="od_hp" required class="email">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">주문하신 분 </span>IP Address</div>
						<div class="col col-9">
							<?php echo $od['od_ip']; ?>
						</div>
					</div>
				</div>

				<div class="col col-6">
					<h4><strong class="color-purple">받으시는 분</strong></h4>
					<div class="margin-bottom-10"></div>

					<div class="row">
						<div class="col col-3"><span class="sound_only">받으시는 분 </span>이름</div>
						<div class="col col-9">
							<label for="od_b_name" class="input">
								<input type="text" name="od_b_name" value="<?php echo get_text($od['od_b_name']); ?>" id="od_b_name" required>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">받으시는 분 </span>전화번호</div>
						<div class="col col-9">
							<label for="od_b_tel" class="input">
								<input type="text" name="od_b_tel" value="<?php echo get_text($od['od_b_tel']); ?>" id="od_b_tel" required>
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">받으시는 분 </span>핸드폰</div>
						<div class="col col-9">
							<label for="od_b_hp" class="input">
								<input type="text" name="od_b_hp" value="<?php echo get_text($od['od_b_hp']); ?>" id="od_b_hp">
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col col-3"><span class="sound_only">받으시는 분 </span>주소</div>
						<div class="col col-9" style="padding:0 5px;">
							<div class="row">
								<div class="col col-6">
									<section>
										<label for="od_b_zip" class="sound_only">우편번호<strong class="sound_only"> 필수</strong></label>
										<label class="input">
											<i class="icon-append fa fa-question-circle"></i>
					                    	<input type="text" name="od_b_zip" value="<?php echo get_text($od['od_b_zip1']).get_text($od['od_b_zip2']); ?>" id="od_b_zip" maxlength="6" readonly="readonly">
					                    	<b class="tooltip tooltip-top-right">우편번호</b>
										</label>
									</section>
								</div>
								<div class="col col-4">
									<section>
										<button type="button" onclick="win_zip('frmorderform3', 'od_b_zip', 'od_b_addr1', 'od_b_addr2', 'od_b_addr3', 'od_b_addr_jibeon');" class="btn-e btn-e-purple">주소 검색</button>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col col-12">
									<section>
						                <label class="input">
						                	<input type="text" name="od_b_addr1" value="<?php echo get_text($od['od_b_addr1']); ?>" id="od_b_addr1">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
									</section>
								</div>
							</div>
							<div class="row">
								<div class="col col-6">
									<section>
						                <label class="input">
						                	<input type="text" name="od_b_addr2" value="<?php echo get_text($od['od_b_addr2']); ?>" id="od_b_addr2">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
									</section>
								</div>
								<div class="col col-6">
									<section>
						                <label class="input">
						                	<input type="text" name="od_b_addr3" value="<?php echo get_text($od['od_b_addr3']); ?>" id="od_b_addr3">
						                </label>
						                <div class="note margin-bottom-10"><strong>Note:</strong> 참고항목</div>
									</section>
								</div>
								<input type="hidden" name="od_b_addr_jibeon" value="<?php echo get_text($od['od_b_addr_jibeon']); ?>">
							</div>
						</div>
					</div>
					<?php if ($default['de_hope_date_use']) { ?>
					<div class="row">
						<div class="col col-3">희망배송일</div>
						<div class="col col-9">
							<label for="od_hope_date" class="input">
								<i class="icon-append"><?php echo get_yoil($od['od_hope_date']); ?></i>
								<input type="text" name="od_hope_date" value="<?php echo $od['od_hope_date']; ?>" id="od_hope_date" required minlength="10">
							</label>
						</div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col col-3">전달 메세지</div>
						<div class="col col-9">
							<div class="alert alert-info alert-padding-trans">
								<?php if ($od['od_memo']) echo get_text($od['od_memo'], 1);else echo "없음";?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="text-center margin-top-30 margin-bottom-30">
			<input type="submit" value="주문자/배송지 정보 수정" class="btn-e btn-e-lg btn-e-red">
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderlist&amp;qstr=<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
		</div>
	    </form>
    </div>
</div>

<div class="modal fade orderfrom-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="modalLabel" class="modal-title"><strong><i class="fa fa-ellipsis-v color-grey"></i> <span id="modal-title"></span></strong></h4>
            </div>
            <div class="modal-body">
                <iframe id="orderfrom-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fa fa-close"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script>
function orderfrom_modal(href) {
    $('.orderfrom-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#product-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.orderfrom-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#orderfrom-iframe").attr("src", href);
        $('#orderfrom-iframe').height(650);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.modal').modal('hide');
};

function personalpay_modal (href) {
	$("#modal-title").text("개인결제추가");
	orderfrom_modal(href);
}

function orderpartcancel_modal (href) {
	$("#modal-title").text("<?php echo $od['od_settle_case']; ?> 부분취소");
	orderfrom_modal(href);
}

$('.pg-anchor a').on('click', function(e) {
	e.stopPropagation();
	var scrollTopSpace;
	if (window.innerWidth >= 1100) {
		scrollTopSpace = 70;
	} else {
		scrollTopSpace = 70;
	}
	var tabLink = $(this).attr('href');
	var offset = $(tabLink).offset().top;
	$('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
	return false;
});

$(function() {
    // 전체 옵션선택
    $("#sit_select_all").click(function() {
        if($(this).is(":checked")) {
            $("input[name='it_sel[]']").attr("checked", true);
            $("input[name^=ct_chk]").attr("checked", true);
        } else {
            $("input[name='it_sel[]']").attr("checked", false);
            $("input[name^=ct_chk]").attr("checked", false);
        }
    });

    // 상품의 옵션선택
    $("input[name='it_sel[]']").click(function() {
        var cls = $(this).attr("id").replace("sit_", "sct_");
        var $chk = $("input[name^=ct_chk]."+cls);
        if($(this).is(":checked"))
            $chk.attr("checked", true);
        else
            $chk.attr("checked", false);
    });

    // 부분취소창
    // $("#orderpartcancel").on("click", function() {
    //     var href = this.href;
    //     window.open(href, "partcancelwin", "left=100, top=100, width=600, height=350, scrollbars=yes");
    //     return false;
    // });
});

function form_submit(f)
{
    var check = false;
    var status = document.pressed;

    for (i=0; i<f.chk_cnt.value; i++) {
        if (document.getElementById('ct_chk_'+i).checked == true)
            check = true;
    }

    if (check == false) {
        alert("처리할 자료를 하나 이상 선택해 주십시오.");
        return false;
    }

    var msg = "";

    <?php if($od['od_settle_case'] == '신용카드' || $od['od_settle_case'] == 'KAKAOPAY' || $od['od_settle_case'] == '간편결제' || ($od['od_pg'] == 'inicis' && is_inicis_order_pay($od['od_settle_case']) )) { ?>
    if(status == "취소" || status == "반품" || status == "품절") {
        var $ct_chk = $("input[name^=ct_chk]");
        var chk_cnt = $ct_chk.size();
        var chked_cnt = $ct_chk.filter(":checked").size();
        <?php if($od['od_pg'] == 'KAKAOPAY') { ?>
        var cancel_pg = "카카오페이";
        <?php } else { ?>
        var cancel_pg = "PG사의 <?php echo $od['od_settle_case']; ?>";
        <?php } ?>

        if(chk_cnt == chked_cnt) {
            if(confirm(cancel_pg+" 결제를 함께 취소하시겠습니까?\n\n한번 취소한 결제는 다시 복구할 수 없습니다.")) {
                f.pg_cancel.value = 1;
                msg = cancel_pg+" 결제 취소와 함께 ";
            } else {
                f.pg_cancel.value = 0;
                msg = "";
            }
        }
    }
    <?php } ?>

    if (confirm(msg+"\'" + status + "\' 상태를 선택하셨습니다.\n\n선택하신대로 처리하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}

function del_confirm()
{
    if(confirm("주문서를 삭제하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}

// 기본 배송회사로 설정
function chk_delivery_company()
{
    var chk = document.getElementById("od_delivery_chk");
    var company = document.getElementById("od_delivery_company");
    company.value = chk.checked ? chk.value : company.defaultValue;
}

// 현재 시간으로 배송일시 설정
function chk_invoice_time()
{
    var chk = document.getElementById("od_invoice_chk");
    var time = document.getElementById("od_invoice_time");
    time.value = chk.checked ? chk.value : time.defaultValue;
}

// 결제금액 수동 설정
function chk_receipt_price()
{
    var chk = document.getElementById("od_receipt_chk");
    var price = document.getElementById("od_receipt_price");
    price.value = chk.checked ? (parseInt(chk.value) + parseInt(price.defaultValue)) : price.defaultValue;
}
</script>