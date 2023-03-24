<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/inorderform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'inorderlist';
$g5_title = '미완료주문';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-shop-inorderform .inorderform-image {width:80px;margin:0 auto}
.admin-shop-inorderform .inorderform-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-inorderform">
    <div class="adm-headline">
        <h3>주문상품 목록</h3>
    </div>

    <div class="f-s-13r m-b-5">
        주문일시 <strong><?php echo substr($od['dt_time'],0,16); ?> (<?php echo get_yoil($od['dt_time']); ?>)</strong><span class="m-l-10 m-r-10 text-light-gray">|</span>주문합계 <?php echo number_format($total_count); ?>개
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>상품이미지</th>
                        <th>상품명</th>
                        <th>옵션항목</th>
                        <th>상태</th>
                        <th>수량</th>
                        <th>판매가</th>
                        <th>소계</th>
                        <th>쿠폰</th>
                        <th>포인트</th>
                        <th>배송비</th>
                        <th>포인트 반영</th>
                        <th>재고 반영</th>
                    </tr>
                </thead>
                <tbody>
                <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <?php foreach ($list[$i]['opt'] as $j => $opt) { ?>
                    <tr>
                        <?php if ($j == 0) { ?>
                        <td rowspan="<?php echo count((array)$list[$i]['opt']); ?>">
                            <div class="inorderform-image">
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a>
                            </div>
                        </td>
                        <td rowspan="<?php echo count((array)$list[$i]['opt']); ?>">
                            <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><strong><?php echo stripslashes($row['it_name']); ?></strong></a><br>
                            <?php if($od['od_tax_flag'] && $row['ct_notax']) echo '[비과세상품]'; ?>
                        </td>
                        <?php } ?>
                        <td><?php echo $opt['ct_option']; ?></td>
                        <td class="text-end"><?php echo $opt['ct_status']; ?></td>
                        <td class="text-end"><?php echo number_format($opt['ct_qty']); ?></td>
                        <td class="text-end"><?php echo number_format($opt['opt_price']); ?></td>
                        <td class="text-end"><?php echo number_format($opt['ct_price']); ?></td>
                        <td class="text-end"><?php echo number_format($opt['opt_cp_price']); ?></td>
                        <td class="text-end"><?php echo number_format($opt['ct_point']); ?></td>
                        <td class="text-end"><?php echo number_format($opt['ct_send_cost']); ?></td>
                        <td class="text-center"><?php echo get_yn($opt['ct_point_use']); ?></td>
                        <td class="text-center"><?php echo get_yn($opt['ct_stock_use']); ?></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="12" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="adm-headline">
        <h3>주문결제 내역</h3>
    </div>

    <form name="frmorderform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_submit(this);" class="eyoom-form">
    <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div class="f-s-13r m-b-5">
        미수금 <strong class="text-crimson"><?php echo display_price($amount['misu']); ?></strong>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
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
                        <th><?php echo $od['od_id']; ?></th>
                        <td class="text-center"><?php echo $s_receipt_way; ?></td>
                        <td class="text-end"><?php echo display_price($amount['order']); ?></td>
                        <td class="text-end"><?php echo display_price($od_send_cost + $od_send_cost2); ?></td>
                        <td class="text-end"><?php echo display_point($od_temp_point); ?></td>
                        <td class="text-end"><?php echo number_format($amount['receipt']); ?>원</td>
                        <td class="text-end"><?php echo display_price($amount['coupon']); ?></td>
                        <td class="text-end"><?php echo number_format($amount['cancel']); ?>원</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-30">
        <input type="submit" value="주문 복구" class="btn-e btn-e-lg btn-e-crimson">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderlist&qstr=<?php echo $qstr; ?>" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
    </div>

    </form>

    <?php if (is_array($tmps)) { ?>
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>이니시스 결제 로그</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 실결제로 결제된 경우 반드시 이니시스 상점 관리자에서 해당 결제건을 확인 후에 주문을 처리해 주세요.
                </p>
            </div>
        </div>
        <?php foreach ($inilog as $ilog) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">주문번호</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $ilog['oid']; ?>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">결제 TID</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $ilog['p_tid']; ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">결제 MID</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $ilog['p_mid'] . $ilog['test_str']; ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">결제 시간</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $ilog['p_date']; ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">결제 수단</label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $ilog['p_method']; ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">결제 금액</label>
            </div>
            <div class="adm-form-td td-r">
                <?php echo $ilog['p_amount']; ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <div class="adm-headline">
        <h3>주문자/배송지 정보</h3>
    </div>

    <div class="row row-g-20 m-b-20">
        <div class="col-lg-6 lg-m-b-20">
            <div class="adm-form-table">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>주문하신 분</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">주문하신 분 </span>이름</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_name']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">주문하신 분 </span>전화번호</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_tel']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">주문하신 분 </span>핸드폰</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_hp']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">주문하신 분 </span>주소</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <span><?php echo $data['od_zip']; ?></span>
                        <span><?php echo get_text($data['od_addr1']); ?></span>
                        <span><?php echo get_text($data['od_addr2']); ?></span>
                        <span><?php echo get_text($data['od_addr3']); ?></span>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">주문하신 분 </span>E-mail</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_email']); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="adm-form-table">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>받으시는 분</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">받으시는 분 </span>이름</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_b_name']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">받으시는 분 </span>전화번호</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_b_tel']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">받으시는 분 </span>핸드폰</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo get_text($data['od_b_hp']); ?>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label"><span class="sound_only">받으시는 분 </span>주소</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <span><?php echo $data['od_b_zip']; ?></span>
                        <span><?php echo get_text($data['od_b_addr1']); ?></span>
                        <span><?php echo get_text($data['od_b_addr2']); ?></span>
                        <span><?php echo get_text($data['od_b_addr3']); ?></span>
                    </div>
                </div>
                <?php if ($default['de_hope_date_use']) { ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">희망배송일</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php echo $data['od_hope_date']; ?> (<?php echo get_yoil($data['od_hope_date']); ?>)
                    </div>
                </div>
                <?php } ?>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">전달 메세지</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <?php if ($data['od_memo']) echo get_text($data['od_memo'], 1);else echo "없음";?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="주문 복구" class="btn-e btn-e-lg btn-e-crimson">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderlist&<?php echo $qstr; ?>" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
    </div>
</div>

<script>
function form_submit(f) {
    if (!confirm("현재 미완료 주문을 입금완료 주문건으로 복구하시겠습니까?")) {
        return false;
    }

    return true;
}

function del_confirm() {
    if(confirm("주문서를 삭제하시겠습니까?")) {
        return true;
    } else {
        return false;
    }
}
</script>