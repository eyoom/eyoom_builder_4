<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/inorderform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-inorderform .table-list-eb {background:#fff}
.admin-shop-inorderform .table-list-eb img {display:block;width:100% \9;max-width:100%;height:auto}
.admin-shop-inorderform .checkbox-lineheight .checkbox {line-height:16px}
.admin-shop-inorderform .checkbox-lineheight .checkbox i {top:0;line-height:26px}
.admin-shop-inorderform .inorderform-btns .btn-e {margin-bottom:3px}
.admin-shop-inorderform .alert-padding-trans {padding:3px 10px 4px}
.admin-shop-inorderform .inorderform-box {position:relative;border:1px solid #d5d5d5;padding:10px;background:#fff}
@media screen and (max-width: 600px){
    .admin-shop-inorderform .inorderform-box .col {margin-bottom:5px}
}
.admin-shop-inorderform .inorderform-box .row {padding:5px}
.admin-shop-inorderform .inorderform-box .row .col-3 {font-weight:bold}
.admin-shop-inorderform .inorderform-box .row .col-4 {font-weight:bold}
.admin-shop-inorderform .od_test_caution {color:#E52700}
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
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(3) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
</style>

<div class="admin-shop-inorderform">
    <div class="adm-headline">
        <h3>주문상품 목록</h3>
    </div>

    <div id="anc_sodr_list">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_sodr_list'); ?>
        </div>

        <p>
            주문일시 <strong><?php echo substr($od['dt_time'],0,16); ?> (<?php echo get_yoil($od['dt_time']); ?>)</strong><span class="margin-left-5 margin-right-5 color-light-grey">|</span>주문합계 <strong><?php echo number_format($order_price); ?></strong>원
        </p>

        <div class="table-list-eb">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="width-100px">상품이미지</th>
                            <th class="width-200px">상품명</th>
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
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                        <?php foreach ($list[$i]['opt'] as $j => $opt) { ?>
                        <tr>
                            <?php if ($j == 0) { ?>
                            <td rowspan="<?php echo count((array)$list[$i]['opt']); ?>">
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a>
                            </td>
                            <td rowspan="<?php echo count((array)$list[$i]['opt']); ?>">
                                <a href="<?php echo $list[$i]['href']; ?>" target="_blank"><strong><?php echo stripslashes($row['it_name']); ?></strong></a><br>
                                <?php if($od['od_tax_flag'] && $row['ct_notax']) echo '[비과세상품]'; ?>
                            </td>
                            <?php } ?>
                            <td><?php echo $opt['ct_option']; ?></td>
                            <td><?php echo $opt['ct_status']; ?></td>
                            <td class="text-right"><?php echo number_format($opt['ct_qty']); ?></td>
                            <td class="text-right"><?php echo number_format($opt['opt_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt['ct_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt['opt_cp_price']); ?></td>
                            <td class="text-right"><?php echo number_format($opt['ct_point']); ?></td>
                            <td class="text-center"><?php echo number_format($opt['ct_send_cost']); ?></td>
                            <td><?php echo get_yn($opt['ct_point_use']); ?></td>
                            <td><?php echo get_yn($opt['ct_stock_use']); ?></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="margin-bottom-30"></div>

    <form name="frmorderform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return form_submit(this);" class="eyoom-form">
    <input type="hidden" name="od_id" value="<?php echo $od_id; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">

    <div id="anc_sodr_orderer">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_sodr_orderer'); ?>
        </div>

        <p class="color-red"><strong>미수금 <?php echo display_price($amount['misu']); ?></strong></p>

        <div id="order-info"></div>
        <div class="margin-bottom-20"></div>

        <div class="text-center margin-top-30 margin-bottom-30">
            <input type="submit" value="주문 복구" class="btn-e btn-e-lg btn-e-red">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderlist&qstr=<?php echo $qstr; ?>" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
        </div>
    </div>
    <div class="margin-bottom-30"></div>

    <?php if (is_array($tmps)) { ?>
    <div class="headline">
        <h4><strong>이니시스 결제 로그</strong></h4>
    </div>
    <div class="margin-bottom-30"></div>

    <div>
        <p>실결제로 결제된 경우 반드시 이니시스 상점 관리자에서 해당 결제건을 확인 후에 주문을 처리해 주세요.</p>

        <div class="table-list-eb">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <?php foreach ($inilog as $ilog) { ?>
                    <tr>
                        <th class="width-100px">주문번호</th>
                        <td><?php echo $ilog['oid']; ?></td>
                    </tr>
                    <tr>
                        <th>결제 TID</th>
                        <td><?php echo $ilog['p_tid']; ?></td>
                    </tr>
                    <tr>
                        <th>결제 MID</th>
                        <td><?php echo $ilog['p_mid'] . $ilog['test_str']; ?></td>
                    </tr>
                    <tr>
                        <th>결제 시간</th>
                        <td><?php echo $ilog['p_date']; ?></td>
                    </tr>
                    <tr>
                        <th>결제 수단</th>
                        <td><?php echo $ilog['p_method']; ?></td>
                    </tr>
                    <tr>
                        <th>결제 금액</th>
                        <td><?php echo $ilog['p_amount']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="margin-bottom-30"></div>
    <?php } ?>

    <div id="anc_sodr_taker">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_sodr_taker'); ?>
        </div>

        <div class="admin-shop-orderform">
            <form class="eyoom-form">
            <div class="inorderform-box">
                <div class="row">
                    <div class="col col-6">
                        <h4><strong class="color-purple">주문하신 분</strong></h4>
                        <div class="margin-bottom-10"></div>

                        <div class="row">
                            <div class="col col-3"><span class="sound_only">주문하신 분 </span>이름</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_name']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">주문하신 분 </span>전화번호</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_tel']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">주문하신 분 </span>핸드폰</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_hp']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">주문하신 분 </span>주소</div>
                            <div class="col col-9">
                                <span><?php echo $data['od_zip']; ?></span>
                                <span><?php echo get_text($data['od_addr1']); ?></span>
                                <span><?php echo get_text($data['od_addr2']); ?></span>
                                <span><?php echo get_text($data['od_addr3']); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">주문하신 분 </span>E-mail</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_email']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col col-6">
                        <h4><strong class="color-purple">받으시는 분</strong></h4>
                        <div class="margin-bottom-10"></div>

                        <div class="row">
                            <div class="col col-3"><span class="sound_only">받으시는 분 </span>이름</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_b_name']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">받으시는 분 </span>전화번호</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_b_tel']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">받으시는 분 </span>핸드폰</div>
                            <div class="col col-9">
                                <?php echo get_text($data['od_b_hp']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-3"><span class="sound_only">받으시는 분 </span>주소</div>
                            <div class="col col-9">
                                <span><?php echo $data['od_b_zip']; ?></span>
                                <span><?php echo get_text($data['od_b_addr1']); ?></span>
                                <span><?php echo get_text($data['od_b_addr2']); ?></span>
                                <span><?php echo get_text($data['od_b_addr3']); ?></span>
                            </div>
                        </div>
                        <?php if ($default['de_hope_date_use']) { ?>
                        <div class="row">
                            <div class="col col-3">희망 배송일</div>
                            <div class="col col-9">
                                <?php echo $data['od_hope_date']; ?> (<?php echo get_yoil($data['od_hope_date']); ?>)
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col col-3">전달 메세지</div>
                            <div class="col col-9">
                                <?php if ($data['od_memo']) echo get_text($data['od_memo'], 1);else echo "없음";?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center margin-top-30 margin-bottom-30">
            <input type="submit" value="주문 복구" class="btn-e btn-e-lg btn-e-red">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=inorderlist&<?php echo $qstr; ?>" id="btn_list" class="btn-e btn-e-lg btn-e-dark">목록보기</a>
        </div>

        </form>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>

<script>
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

!function () {
    var db = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.회원아이디 && !(client.회원아이디.indexOf(filter.회원아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) || filter.영문이름 && !(client.영문이름.indexOf(filter.영문이름) > -1) || filter.이니셜 && !(client.이니셜.indexOf(filter.이니셜) > -1) || filter.키 && !(client.키.indexOf(filter.키) > -1) || filter.몸무게 && !(client.몸무게.indexOf(filter.몸무게) > -1) || filter.성별 && !(client.성별.indexOf(filter.성별) > -1) || filter.등록일 && !(client.등록일.indexOf(filter.등록일) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        {
            주문번호: "<?php echo $od['od_id']; ?>",
            결제방법: "<?php echo $s_receipt_way; ?>",
            주문총액: "<?php echo display_price($amount['order']); ?>",
            배송비: "<?php echo display_price($od_send_cost + $od_send_cost2); ?>",
            포인트결제: "<?php echo display_point($od_temp_point); ?>",
            총결제액: "<?php echo number_format($amount['receipt']); ?>원",
            쿠폰: "<?php echo display_price($amount['coupon']); ?>",
            주문취소: "<?php echo number_format($amount['cancel']); ?>원",
        },
    ]
}();

$(document).ready(function() {
    $("#order-info").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "주문번호", type: "text", width: 120 },
            { name: "결제방법", type: "text", width: 80 },
            { name: "주문총액", type: "number", width: 100 },
            { name: "배송비", type: "number", width: 80 },
            { name: "포인트결제", type: "number", width: 100 },
            { name: "총결제액", type: "number", width: 100 },
            { name: "쿠폰", type: "number", width: 100 },
            { name: "주문취소", type: "number", width: 100 },
            //{ type: "control" }
        ]
    })

});

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