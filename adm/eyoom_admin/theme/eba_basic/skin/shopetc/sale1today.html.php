<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/sale1today.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'sale1';
$g5_title = '매출현황';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-sale1today">
    <div class="adm-headline">
        <h3><?php echo $date; ?> 일 매출현황</h3>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>주문번호</th>
                        <th>주문자</th>
                        <th>주문합계</th>
                        <th>쿠폰</th>
                        <th>무통장</th>
                        <th>가상계좌</th>
                        <th>계좌이체</th>
                        <th>카드입금</th>
                        <th>간편결제</th>
                        <th>휴대폰</th>
                        <th>포인트입금</th>
                        <th>주문취소</th>
                        <th>미수금</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=orderform&amp;od_id=<?php echo $list[$i]['od_id']; ?>"><u><?php echo $list[$i]['od_id']; ?></u></a>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo $list[$i]['href']; ?>"><u><?php echo $list[$i]['od_name']; ?></u></a>
                        </td>
                        <td class="text-end"><?php echo number_format($list[$i]['orderprice']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['couponprice']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['receipt_bank']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['receipt_vbank']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['receipt_iche']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['receipt_card']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['save']['receipteasy']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['receipt_hp']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['od_receipt_point']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['od_cancel_price']); ?></td>
                        <td class="text-end"><?php echo number_format($list[$i]['od_misu']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="13" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">합계</td>
                        <td class="text-end"><?php echo number_format($tot['orderprice']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['coupon']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_bank']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_vbank']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_iche']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_card']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_easy']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_hp']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['receipt_point']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['ordercancel']); ?></td>
                        <td class="text-end"><?php echo number_format($tot['misu']); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>