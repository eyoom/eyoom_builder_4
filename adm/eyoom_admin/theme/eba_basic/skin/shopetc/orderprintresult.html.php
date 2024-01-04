<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/orderprintresult.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-orderprintresult {position:relative;overflow:hidden;padding:15px;font-size:12px}
.admin-shop-orderprintresult .table-list-eb .table {white-space:inherit;word-break:inherit;font-size:12px}
.admin-shop-orderprintresult .table-list-eb .table td {text-align:center}
</style>

<div class="admin-shop-orderprintresult">
    <div style="text-align:right;margin-bottom:20px;">
        <a href="javascript:window.print();" class="print-btn btn-e btn-e-crimson">프린트</a>
    </div>

    <div class="adm-headline">
        <h3 style="font-size:12px;margin-bottom:30px;">
            <strong style="font-size:15px">주문내역</strong><br>
            <span class="f-w-400 text-gray">(<?php if ($case == 1) { ?><?php echo $fr_date; ?> 부터 <?php echo $to_date; ?> 까지 <?php echo $ct_status; ?> 내역<?php } else { ?><?php echo $fr_od_id; ?> 부터 <?php echo $to_od_date; ?> 까지 <?php echo $ct_status; ?> 내역<?php } ?>)</span>
        </h3>
    </div>
    
    <?php for ($i=0; $i<count((array)$ordinfo); $i++) { ?>
    <h5 style="font-size:12px;margin-top:20px;margin-bottom:10px;"><strong>주문번호 : </strong><strong class="text-crimson"><?php echo $ordinfo[$i]['od_id']; ?></strong></h5>
    <div class="orderprintresult-box">
        <h5 style="font-size:12px;margin-bottom:10px;"><strong>보내는 사람</strong> : <?php echo get_text($ordinfo[$i]['od_name']); ?></h5>
        <div class="table-list-eb" style="margin-bottom:20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>항목</th>
                        <th>내용</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>주소</th>
                        <td><?php echo get_text($ordinfo[$i]['od_addr']); ?></td>
                    </tr>
                    <tr>
                        <th>휴대푠</th>
                        <td><?php echo get_text($ordinfo[$i]['od_hp']); ?></td>
                    </tr>
                    <tr>
                        <th>전화번호</th>
                        <td><?php echo get_text($ordinfo[$i]['od_tel']); ?></td>
                    </tr>
                    <tr>
                        <th>요청사항</th>
                        <td><?php echo $ordinfo[$i]['od_memo'] ? get_text($ordinfo[$i]['od_memo'], 1): '없음'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php if ($samesamesame) { ?>
        <p style="margin-bottom:20px;">보내는 사람과 받는 사람이 동일합니다.</p>
        <?php } else { ?>
        <h5 style="font-size:12px;margin-bottom:10px;"><strong>받는 사람</strong> : <?php echo get_text($ordinfo[$i]['od_b_name']); ?></h5>
        <div class="table-list-eb" style="margin-bottom:20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>항목</th>
                        <th>내용</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>주소</th>
                        <td><?php echo get_text($ordinfo[$i]['od_b_addr']); ?></td>
                    </tr>
                    <tr>
                        <th>휴대푠</th>
                        <td><?php echo get_text($ordinfo[$i]['od_b_hp']); ?></td>
                    </tr>
                    <tr>
                        <th>전화번호</th>
                        <td><?php echo get_text($ordinfo[$i]['od_b_tel']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>

        <h5 style="font-size:12px;margin-bottom:10px;"><strong>주문 목록</strong></h5>
        <div class="table-list-eb" style="margin-bottom:20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:200px">상품명(선택사항)</th>
                        <th>판매가</th>
                        <th>수량</th>
                        <th>소계</th>
                        <th>배송비</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordinfo[$i]['orditem'] as $orditem) { ?>
                    <tr>
                        <th><?php echo $orditem['it_name']; ?></th>
                        <td><?php echo number_format($orditem['it_price']); ?></td>
                        <td><?php if ($orditem['ct_qty']>=2) { ?><strong><?php echo number_format($orditem['ct_qty']); ?></strong><?php } else { ?><?php echo number_format($orditem['ct_qty']); } ?></td>
                        <td><?php echo number_format($orditem['row2_tot_price']); ?></td>
                        <td><?php echo $orditem['ct_send_cost']; ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th>배송비</th>
                        <td><?php echo number_format($ordinfo[$i]['od_send_cost']); ?></td>
                        <td>-</td>
                        <td><?php echo number_format($ordinfo[$i]['od_send_cost']); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>추가 배송비</th>
                        <td><?php echo number_format($ordinfo[$i]['od_send_cost2']); ?></td>
                        <td>-</td>
                        <td><?php echo number_format($ordinfo[$i]['od_send_cost2']); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="2">합계</th>
                        <td><?php echo number_format($ordinfo[$i]['sub_tot_qty']); ?></td>
                        <td><?php echo number_format($ordinfo[$i]['sub_tot_price'] + $ordinfo[$i]['od_send_cost '] + $ordinfo[$i]['od_send_cost2']); ?></td>
                        <td></td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>
    <?php } ?>

    <div style="text-align:center;">
        <p style="margin-bottom:20px;">전체 <strong class="text-crimson"><?php echo number_format($tot_tot_qty); ?></strong>개<strong class="text-crimson m-l-10"><?php echo number_format($tot_tot_price); ?></strong>원</p>
        <p>- 출력 끝 -</p>
    </div>
</div>