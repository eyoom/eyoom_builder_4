<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/orderprintresult.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-orderprintresult {position:relative;padding:20px}
.admin-shop-orderprintresult .print-btn {font-weight:bold;font-size:15px;text-decoration:underline}
.admin-shop-orderprintresult .orderprintresult-box {padding:20px;border:2px solid #b5b5b5;margin-bottom:30px}
.admin-shop-orderprintresult .margin-bottom-20 {margin-bottom:20px}
.admin-shop-orderprintresult .margin-bottom-30 {margin-bottom:30px}
.admin-shop-orderprintresult h4 {font-size:18px}
.admin-shop-orderprintresult h5 {font-size:16px;margin-bottom:10px}
.admin-shop-orderprintresult table {border-collapse:collapse;width:100%;margin-bottom:20px}
.admin-shop-orderprintresult th {font-weight:bold}
.admin-shop-orderprintresult th, .admin-shop-orderprintresult td {border:1px solid #d5d5d5;text-align:left;padding:3px 10px}
.admin-shop-orderprintresult .width-50px {width:50px}
.admin-shop-orderprintresult .width-80px {width:80px}
.admin-shop-orderprintresult .text-center {text-align:center}
.admin-shop-orderprintresult .text-right {text-align:right}
.admin-shop-orderprintresult .font-size-17 {font-size:17px}
</style>

<div class="admin-shop-orderprintresult">
    <div class="margin-bottom-20 text-right">
        <a href="javascript:window.print()" class="print-btn">프린트</a>
    </div>
    <div class="headline">
        <h4>
            <strong>
                주문내역
            </strong>
            <small class="margin-left-10">
                [
                <?php if ($case == 1) { ?>
                <?php echo $fr_date; ?> 부터 <?php echo $to_date; ?> 까지 <?php echo $ct_status; ?> 내역
                <?php } else { ?>
                <?php echo $fr_od_id; ?> 부터 <?php echo $to_od_date; ?> 까지 <?php echo $ct_status; ?> 내역
                <?php } ?>
                ]
            </small>
        </h4>
    </div>
    <div class="margin-bottom-30"></div>

    <div class="margin-bottom-30">
        <?php for ($i=0; $i<count((array)$ordinfo); $i++) { ?>
        <h5><strong>주문번호 : </strong><strong class="color-red"><?php echo $ordinfo[$i]['od_id']; ?></strong></h5>
        <div class="orderprintresult-box">
            <h5><strong>보내는 사람</strong> : <?php echo get_text($ordinfo[$i]['od_name']); ?></h5>
            <div class="table-list-eb">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="td-border-right">항목</th>
                            <th>내용</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="td-border-right">주소</th>
                            <td><?php echo get_text($ordinfo[$i]['od_addr']); ?></td>
                        </tr>
                        <tr>
                            <th class="td-border-right">휴대푠</th>
                            <td><?php echo get_text($ordinfo[$i]['od_hp']); ?></td>
                        </tr>
                        <tr>
                            <th class="td-border-right">전화번호</th>
                            <td><?php echo get_text($ordinfo[$i]['od_tel)']); ?></td>
                        </tr>
                        <tr>
                            <th class="td-border-right">요청사항</th>
                            <td><?php echo $ordinfo[$i]['od_memo'] ? get_text($ordinfo[$i]['od_memo'], 1): '없음'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if ($samesamesame) { ?>
            <div>
                <p class="bg-info font-size-12 padding-10"><i class="fas fa-info-circle"></i>보내는 사람과 받는 사람이 동일합니다.</p>
            </div>
            <?php } else { ?>
            <h5><strong>받는 사람</strong> : <?php echo get_text($ordinfo[$i]['od_b_name']); ?></h5>
            <div class="table-list-eb">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="td-border-right">항목</th>
                            <th>내용</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="td-border-right">주소</th>
                            <td><?php echo get_text($ordinfo[$i]['od_b_addr']); ?></td>
                        </tr>
                        <tr>
                            <th class="td-border-right">휴대푠</th>
                            <td><?php echo get_text($ordinfo[$i]['od_b_hp']); ?></td>
                        </tr>
                        <tr>
                            <th class="td-border-right">전화번호</th>
                            <td><?php echo get_text($ordinfo[$i]['od_b_tel']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php } ?>

            <h5><strong>주문 목록</strong></h5>
            <div class="table-list-eb">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="td-border-right">상품명(선택사항)</th>
                            <th class="td-border-right">판매가</th>
                            <th class="td-border-right width-50px">수량</th>
                            <th class="td-border-right">소계</th>
                            <th class="width-80px">배송비</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordinfo[$i]['orditem'] as $orditem) { ?>
                        <tr>
                            <td class="td-border-right"><?php echo $orditem['it_name']; ?></td>
                            <td class="td-border-right"><?php echo number_format($orditem['it_price']); ?></td>
                            <td class="td-border-right"><?php if ($orditem['ct_qty']>=2) { ?><strong><?php echo number_format($orditem['ct_qty']); ?></strong><?php } else { ?><?php echo number_format($orditem['ct_qty']); } ?></td>
                            <td class="td-border-right"><?php echo number_format($orditem['row2_tot_price']); ?></td>
                            <td><?php echo $orditem['ct_send_cost']; ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="td-border-right">배송비</td>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['od_send_cost']); ?></td>
                            <td class="td-border-right">-</td>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['od_send_cost']); ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="td-border-right">추가 배송비</td>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['od_send_cost2']); ?></td>
                            <td class="td-border-right">-</td>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['od_send_cost2']); ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="row" colspan="2" class="td-border-right">합계</th>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['sub_tot_qty']); ?></td>
                            <td class="td-border-right"><?php echo number_format($ordinfo[$i]['sub_tot_price'] + $ordinfo[$i]['od_send_cost '] + $ordinfo[$i]['od_send_cost2']); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <?php } ?>

        <div class="text-center">
            <p class="font-size-17 margin-bottom-20">전체 <strong class="color-red"><?php echo number_format($tot_tot_qty); ?></strong>개<strong class="color-red margin-left-10"><?php echo number_format($tot_tot_price); ?></strong>원</p>
            <p>- 출력 끝 -</p>
        </div>
    </div>
</div>