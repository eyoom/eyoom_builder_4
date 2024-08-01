<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/index.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_use_version_alarm'] == '1' && $eyoom_latest_version != EYOOM_VERSION) {
    add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
}
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/perfect-scrollbar/perfect-scrollbar.min.css" type="text/css" media="screen">',0);
add_javascript('<script src="'.EYOOM_ADMIN_THEME_URL.'/plugins/apexcharts/apexcharts.min.js"></script>', 0);
add_javascript('<script id="mode_js" src="'.EYOOM_ADMIN_THEME_URL.'/js/admin-main-'.$modeStyle.'.js"></script>', 0);

if ($is_youngcart) { // 영카트 쇼핑몰 사용시
    add_javascript('<script id="mode_shop_js" src="'.EYOOM_ADMIN_THEME_URL.'/js/admin-main-shop-'.$modeStyle.'.js"></script>', 0);

    // main_chart1 취소금액중 최고값 (마이너스 처리하여 차트 그래프 최소값 지정위해)
    foreach ($arr_order as $k => $arr) {
        $ord_cancel[$k] = $arr_order[$k]['cancel'];
    }
    $main_chart1_max_cancel = isset($ord_cancel) && $ord_cancel ? max($ord_cancel): 0;

    // main_chart2 주문 최대값
    foreach ($arr_order as $k => $arr) {
        $ord_date[$k] = $arr['order'];
    }
    $main_chart2_max_order = isset($ord_date) && $ord_date ? max($ord_date): 0;

    // main_chart3 취소금액중 최고값 (마이너스 처리하여 차트 그래프 최소값 지정위해)
    foreach ($ordercancel as $k => $arr) {
        $orderc_cancel[$k] = $ordercancel[$k];
    }
    $main_chart3_max_cancel = isset($orderc_cancel) && $orderc_cancel ? max($orderc_cancel): 0;

    // main_chart4 주문 최대값
    foreach ($tot as $k => $arr) {
        $ord_month[$k] = $arr['orderprice'];
    }
    $main_chart4_max_order = isset($ord_month) && $ord_month ? max($ord_month): 0;
}

// 로그인 최대값
$max_login_count = is_array($this_today_login) && $this_today_login ? max($this_today_login): 0;

// 회원가입 최대값
$max_regist_count = is_array($this_vi_regist) && $this_vi_regist ? max($this_vi_regist): 0;

if ($max_regist_count > $max_login_count) {
    $main_chart5_max_count = $max_regist_count;
} else {
    $main_chart5_max_count = $max_login_count;
}
?>

<style>
/*----- Main Headline -----*/
.main-headline {position:relative}
.main-headline:after {content:"";display:block;clear:both}
.main-headline h5 {position:relative;float:left;padding:0;margin:0 0 20px;color:var(--ttc-default)}
.main-headline h5:after {content:"";display:block;position:absolute;bottom:-10px;left:0;width:14px;height:2px;background:var(--tbg-primary)}
.main-headline .headline-btn {float:right}
.main-headline .headline-btn a {font-size:.8125rem;color:var(--ttc-muted)}
.main-headline .headline-btn a:hover {text-decoration:underline}
/*----- Card -----*/
.card .card-title {position:relative}
.card .card-title:after {content:"";display:block;clear:both}
.card .card-title h5 {position:relative;float:left;font-weight:600;font-size:1.0625rem;color:var(--ttc-default)}
.card .card-title .card-title-btn {float:right}
.card .card-title .card-title-btn a {font-size:.8125rem;color:var(--ttc-muted)}
.card .card-title .card-title-btn a:hover {text-decoration:underline}
/*----- Main Order -----*/
.order-wrap {position:relative;border:1px solid var(--tbc-primary)}
.order-wrap:after {content:"";display:block;clear:both}
.order-box {position:relative;overflow:hidden;width:25%;float:left;background-color:var(--tbg-default)}
.order-box:nth-child(1) {border-right:1px solid var(--tbc-primary)}
.order-box:nth-child(2) {border-right:1px solid var(--tbc-primary)}
.order-box:nth-child(3) {border-right:1px solid var(--tbc-primary)}
.order-box-in {padding:15px;text-align:center}
.order-box-in h3 {position:relative;font-size:1.875rem;font-weight:700;margin:0 0 10px;white-space:nowrap;text-align:center}
.order-box-in h3 i {margin-right:10px;color:var(--ttc-muteder)}
.order-box:nth-child(1) h3 {color:#ab0000}
.order-box:nth-child(2) h3 {color:#1e88e5}
.order-box:nth-child(3) h3 {color:#5e35b1}
.order-box:nth-child(4) h3 {color:#00897b}
.order-box-in > p {margin-bottom:10px}
.order-box-in > p > span {color:var(--ttc-muted)}
.order-box-in > span {font-weight:600;font-size:1.0625rem;color:var(--ttc-low)}
.order-box-in:hover > span {text-decoration:underline}
.personal-order-wrap {position:relative;margin-bottom:20px;border:1px solid var(--tbc-primary)}
.personal-order-box {position:relative;overflow:hidden;background-color:var(--tbg-default)}
.personal-order-box-in {padding:15px;text-align:center}
.personal-order-box-in h3 {position:relative;font-size:1.875rem;font-weight:700;margin:0 0 10px;white-space:nowrap;text-align:center;color:#fb8c00}
.personal-order-box-in h3 i {margin-right:10px;color:var(--ttc-muteder)}
.personal-order-box-in > p {margin-bottom:10px}
.personal-order-box-in > p > span {color:var(--ttc-muted)}
.personal-order-box-in > span {font-weight:600;font-size:1.0625rem;color:var(--ttc-low)}
.personal-order-box-in:hover > span {text-decoration:underline}
@media (max-width:1399px) {
    .personal-order-wrap {border-top:0}
    .personal-order-box-in h3 {display:inline-block;font-size:1rem;margin:0 10px 0 0}
    .personal-order-box-in h3 i {font-size:1.33333em}
    .personal-order-box-in > p {display:inline-block;margin-bottom:0}
    .personal-order-box-in > span {margin-left:10px}
}
@media (max-width:767px) {
    .order-box {text-align:center;width:50%}
    .order-box:nth-child(1) {border-right:1px solid var(--tbc-primary);border-bottom:1px solid var(--tbc-primary)}
    .order-box:nth-child(2) {border-right:0;border-bottom:1px solid var(--tbc-primary)}
    .order-box:nth-child(3) {border-right:1px solid var(--tbc-primary)}
    .order-box .icon {display:none}
}
/*----- Latest -----*/
.main-latest-wrap {position:relative;overflow:hidden;padding:10px;height:300px;;border:1px solid var(--tbc-primary)}
.main-latest .main-latest-none {display:block;text-align:center;font-size:.8125rem;padding:30px 5px;margin:0;color:var(--ttc-muted)}
.main-latest-link {position:relative;overflow:hidden;display:block;font-size:.8125rem;height:55px;padding:5px;border-bottom:1px solid var(--tbc-primary);color:var(--ttc-default)}
.main-latest-link:last-child {border-bottom:0}
.main-latest-link .main-latest-member-img {position:absolute;overflow:hidden;top:5px;left:5px;width:30px;height:30px;border-radius:50%}
.main-latest-link .main-latest-member-img img {display:block;max-width:100%;height:auto}
.main-latest-link .main-latest-member-img i {font-size:30px;color:var(--ttc-muted)}
.main-latest-link .main-latest-cont {position:relative;margin-left:42px}
.main-latest-link .main-latest-cont p {margin-bottom:0;font-size:1rem;color:var(--ttc-default)}
.main-latest-link:hover .main-latest-cont p {text-decoration:underline}
.main-latest-link .main-latest-cont span {display:inline-block;font-size:.8125rem;margin-right:7px;color:var(--ttc-muted)}
.main-latest-link .main-latest-cont .member-id-nick {position:relative;overflow:hidden;height:23px}
.main-latest-link .main-latest-cont .member-id-nick span {font-size:.9375rem;color:var(--ttc-default)}
.main-latest-link .main-latest-cont .member-point-info {position:absolute;top:2px;right:0;min-width:60px;background:#45454a;color:#fff;padding:3px 5px;font-size:10px;line-height:1;text-align:right}
.main-latest-link .main-latest-cont .member-point-info span {color:#fff;font-size:.6875rem;margin-right:0}
.main-latest-link.main-latest-no-answer .main-latest-cont p {font-weight:700}
.main-latest-link.main-latest-no-answer .main-latest-cont span {font-weight:400}
.main-latest-link .latest-status-indicator {position:absolute;top:5px;right:5px;display:inline-block;width:7px;height:7px;border-radius:50%;background:#e53935}
/*----- Site Chart -----*/
.site-chart-wrap {position:relative;min-height:300px;border:1px solid var(--tbc-primary)}
.site-chart-wrap .statistics-box-wrap {position:relative}
.site-chart-wrap .statistics-box {float:left;width:50%;padding:20px 5px;text-align:center;border-bottom:1px solid var(--tbc-primary)}
.site-chart-wrap .statistics-box:nth-child(1) {border-right:1px solid var(--tbc-primary)}
.site-chart-wrap .statistics-box h6 {font-size:1rem;margin-bottom:10px;color:var(--ttc-lower)}
.site-chart-wrap .statistics-box p {font-size:1rem;color:var(--ttc-heigher)}
.site-chart-wrap .statistics-box a:hover p {text-decoration:underline}
.site-chart-wrap .statistics-list {padding:15px}
.site-chart-wrap .statistics-list p {margin-bottom:3px}
.site-chart-wrap .statistics-list p:last-child {margin-bottom:0}
.site-chart-wrap .statistics-list span {display:inline-block;width:100px;color:var(--ttc-lower)}
.site-chart-wrap .statistics-list strong {display:inline-block;color:var(--ttc-heigher)}
/*----- Member Rank Chart -----*/
.member-chart-wrap {position:relative;padding:15px;height:300px;border:1px solid var(--tbc-primary)}
.member-chart-wrap .nav {flex-shrink:0;border-right:1px solid #45454a}
.member-chart-wrap .tab-content {flex-grow:1;position:relative}
.member-chart-wrap .nav-link {width:80px;height:34px;line-height:34px;margin-bottom:2px;border-radius:0;background-color:var(--tbg-muteder)}
.member-chart-wrap .nav-link.active {background-color:#45454a}
.member-chart-wrap .member-rank-list {position:relative;overflow:hidden;height:25px;font-size:.9375rem;margin-bottom:2px}
.member-chart-wrap .member-rank-list .rank-num {display:inline-block;position:absolute;top:1px;left:0;width:30px;height:22px;line-height:22px;text-align:center;color:#fff;font-size:.75rem;background:#45454a;margin-right:5px}
.member-chart-wrap .member-rank-list .rank-name {display:inline-block;position:relative;overflow:hidden;width:100px;height:25px;margin-left:40px}
.member-chart-wrap .member-rank-list .rank-point {display:inline-blok;position:absolute;top:0;right:0;height:25px;line-height:25px;color:#cc2300;text-align:right}
.member-chart-wrap .member-rank-list:nth-child(1) .rank-num {background:#ab0000}
.member-chart-wrap .member-rank-list:nth-child(2) .rank-num {background:#fb8c00}
.member-chart-wrap .member-rank-list:nth-child(3) .rank-num {background:#fb8c00}
/*----- Sweetalert2 Toast -----*/
.swal2-popup.swal2-toast.swal2-show {padding:15px !important}
</style>

<?php if ($is_youngcart) { // 영카트 쇼핑몰 사용시 ?>
<?php /* 처리할 주문 시작 */?>
<div class="main-order">
    <div class="row">
        <div class="col-xxl-10">
            <div class="order-wrap">
                <?php foreach ($order_status as $key => $status) { ?>
                <div class="order-box">
                    <a href="<?php echo $status['href']; ?>">
                        <div class="order-box-in">
                            <h3>
                                <?php if ($status['count'] > 0) { ?><div class="alarm-marker"><span class="alarm-effect"></span><span class="alarm-point"></span></div><?php } ?>
                                <i class="las la-lg la-<?php if ($key == '주문') { ?>cart-arrow-down<?php } else if ($key == '입금') { ?>credit-card<?php } else if ($key == '준비') { ?>truck-loading<?php } else if ($key == '배송') { ?>truck<?php } ?>"></i>
                                <?php echo number_format($status['count']); ?>
                            </h3>
                            <p>
                                <?php echo $key; ?><span><i class="fas fa-caret-right m-l-7 m-r-7"></i><?php if ($key == '주문') { ?>입금<?php } else if ($key == '입금') { ?>준비<?php } else if ($key == '준비') { ?>배송<?php } else if ($key == '배송') { ?>완료<?php } ?></span>
                            </p>
                            <span>
                                <?php echo number_format($status['price']); ?> 원
                            </span>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-xxl-2">
            <div class="personal-order-wrap">
                <div class="personal-order-box">
                    <a href="<?php echo $pp_info['href']; ?>">
                        <div class="personal-order-box-in">
                            <h3>
                                <i class="las la-lg la-user"></i><?php echo number_format($pp_info['count']); ?>
                            </h3>
                            <p>개인결제<span><i class="fas fa-caret-right m-l-7 m-r-7"></i>완료</span></p>
                            <span><?php echo number_format($pp_info['price']); ?> 원</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /* 처리할 주문 끝 */?>

<div class="row row-g-20 m-b-20">
    <div class="col-xxl-6 xxl-m-b-20">
        <div class="row row-g-20">
            <div class="col-sm-6 sm-m-b-20">
                <?php /* 사이트 통계 시작 */?>
                <div class="main-headline">
                    <h5><strong>사이트 통계</strong></h5>
                </div>
                <div class="site-chart-wrap">
                    <div class="statistics-box-wrap">
                        <div class="statistics-box">
                            <h6>현재접속자</h6>
                            <a href="<?php echo G5_BBS_URL; ?>/current_connect.php" target="_blank">
                                <p><strong><?php echo number_format($current['total_cnt']); ?> (<span class="text-crimson"><?php echo number_format($current['mb_cnt']); ?></span>)</strong></p>
                            </a>
                        </div>
                        <div class="statistics-box">
                            <h6>오늘방문자</h6>
                            <p><strong><?php echo $visit['visit_today']; ?></strong></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="statistics-list">
                        <p class="li-p-sq"><span>어제방문자 :</span><strong><?php echo $visit['visit_yesterday']; ?></strong></p>
                        <p class="li-p-sq"><span>최대방문자 :</span><strong><?php echo $visit['visit_max']; ?></strong></p>
                        <p class="li-p-sq"><span>전체방문자 :</span><strong><?php echo $visit['visit_total']; ?></strong></p>
                        <p class="li-p-sq"><span>신규회원수 :</span><strong><?php echo $visit['newby']; ?></strong></p>
                        <p class="li-p-sq"><span>전체회원수 :</span><strong><?php echo $visit['members']; ?></strong></p>
                        <p class="li-p-sq"><span>전체게시물 :</span><strong><?php echo $visit['total_write']; ?></strong></p>
                        <p class="li-p-sq"><span>전체코멘트 :</span><strong><?php echo $visit['total_comment']; ?></strong></p>
                    </div>
                </div>
                <?php /* 사이트 통계 끝 */?>
            </div>
            <div class="col-sm-6">
                <?php /* 1:1문의 시작 */?>
                <div class="main-headline">
                    <h5><strong>1:1문의</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_BBS_URL; ?>/qalist.php" target="_blank"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_1" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for ($i=0; $i<count((array)$qa_conts); $i++) { ?>
                        <a href="<?php echo G5_BBS_URL; ?>/qaview.php?qa_id=<?php echo $qa_conts[$i]['qa_id']; ?>" target="_blank" class="main-latest-link <?php if (!$qa_conts[$i]['qa_status']) { ?>main-latest-no-answer<?php } ?>">
                            <div class="main-latest-member-img">
                                <?php if (!$qa_conts[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $qa_conts[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="ellipsis"><?php echo conv_subject($qa_conts[$i]['qa_subject'], 40); ?></p>
                                <p class="ellipsis"><span><?php echo $qa_conts[$i]['name']; ?></span><span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $qa_conts[$i]['qa_datetime']); ?></span></p>
                            </div>
                            <?php if (!$qa_conts[$i]['qa_status']) { ?>
                            <span class="latest-status-indicator"></span>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        <?php if (count((array)$qa_conts) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 1:1문의가 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 1:1문의 끝 */?>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="row row-g-20">
            <div class="col-sm-6 sm-m-b-20">
                <?php /* 상품문의 시작 */?>
                <div class="main-headline">
                    <h5><strong>상품문의</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemqalist"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_2" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for ($i=0; $i<count((array)$item_qa); $i++) { ?>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemqaform&amp;iq_id=<?php echo $item_qa[$i]['iq_id']; ?>&amp;w=u" class="main-latest-link <?php if (!$item_qa[$i]['is_answer']) { ?>main-latest-no-answer<?php } ?>">
                            <div class="main-latest-member-img">
                                <?php if (!$item_qa[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $item_qa[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="ellipsis"><?php echo conv_subject($item_qa[$i]['iq_subject'], 40); ?></p>
                                <p class="ellipsis"><span><?php echo $item_qa[$i]['name']; ?></span><span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $item_qa[$i]['iq_time']); ?></span></p>
                            </div>
                            <?php if (!$item_qa[$i]['is_answer']) { ?>
                            <span class="latest-status-indicator"></span>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        <?php if (count((array)$item_qa) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 상품문의가 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 상품문의 끝 */?>
            </div>
            <div class="col-sm-6">
                <?php /* 사용후기 시작 */?>
                <div class="main-headline">
                    <h5><strong>사용후기</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemuselist"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_3" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for ($i=0; $i<count((array)$item_use); $i++) { ?>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemuseform&amp;is_id=<?php echo $item_use[$i]['is_id']; ?>&amp;w=u" class="main-latest-link <?php if (!$item_use[$i]['is_answer']) { ?>main-latest-no-answer<?php } ?>">
                            <div class="main-latest-member-img">
                                <?php if (!$item_use[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $item_use[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="ellipsis"><?php echo conv_subject($item_use[$i]['is_subject'], 40); ?></p>
                                <p class="ellipsis"><span><?php echo $item_use[$i]['name']; ?></span><span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $item_use[$i]['is_time']); ?></span></p>
                            </div>
                            <?php if (!$item_use[$i]['is_answer']) { ?>
                            <span class="latest-status-indicator"></span>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        <?php if (count((array)$item_use) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 사용후기가 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 사용후기 끝 */?>
            </div>
        </div>
    </div>
</div>

<div class="row row-g-20 m-b-20">
    <div class="col-lg-6 lg-m-b-20">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>쇼핑몰 주간 일-매출 주문 현황</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart1" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>쇼핑몰 주간 일-매출 결제수단별 현황</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart2" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row row-g-20 m-b-20">
    <div class="col-lg-6 lg-m-b-20">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>쇼핑몰 년간 월-매출 주문 현황</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart3" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>쇼핑몰 년간 월-매출 결제수단별 현황</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart4" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
</div>
<?php } else { // 영카트 쇼핑몰 미사용시 ?>
<div class="row row-g-20 m-b-20">
    <div class="col-sm-6 sm-m-b-20">
        <?php /* 사이트 통계 시작 */?>
        <div class="main-headline">
            <h5><strong>사이트 통계</strong></h5>
        </div>
        <div class="site-chart-wrap">
            <div class="statistics-box-wrap">
                <div class="statistics-box">
                    <h6>현재접속자</h6>
                    <a href="<?php echo G5_BBS_URL; ?>/current_connect.php" target="_blank">
                        <p><strong><?php echo number_format($current['total_cnt']); ?> (<span class="text-crimson"><?php echo number_format($current['mb_cnt']); ?></span>)</strong></p>
                    </a>
                </div>
                <div class="statistics-box">
                    <h6>오늘방문자</h6>
                    <p><strong><?php echo $visit['visit_today']; ?></strong></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="statistics-list">
                <p class="li-p-sq"><span>어제방문자 :</span><strong><?php echo $visit['visit_yesterday']; ?></strong></p>
                <p class="li-p-sq"><span>최대방문자 :</span><strong><?php echo $visit['visit_max']; ?></strong></p>
                <p class="li-p-sq"><span>전체방문자 :</span><strong><?php echo $visit['visit_total']; ?></strong></p>
                <p class="li-p-sq"><span>신규회원수 :</span><strong><?php echo $visit['newby']; ?></strong></p>
                <p class="li-p-sq"><span>전체회원수 :</span><strong><?php echo $visit['members']; ?></strong></p>
                <p class="li-p-sq"><span>전체게시물 :</span><strong><?php echo $visit['total_write']; ?></strong></p>
                <p class="li-p-sq"><span>전체코멘트 :</span><strong><?php echo $visit['total_comment']; ?></strong></p>
            </div>
        </div>
        <?php /* 사이트 통계 끝 */?>
    </div>
    <div class="col-sm-6">
        <?php /* 1:1문의 시작 */?>
        <div class="main-headline">
            <h5><strong>1:1문의</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_BBS_URL; ?>/qalist.php" target="_blank"><i class="las la-plus"></i> 전체보기</a>
            </div>
        </div>
        <div id="main_latest_wrap_1" class="main-latest-wrap">
            <div class="main-latest">
                <?php for ($i=0; $i<count((array)$qa_conts); $i++) { ?>
                <a href="<?php echo G5_BBS_URL; ?>/qaview.php?qa_id=<?php echo $qa_conts[$i]['qa_id']; ?>" class="main-latest-link <?php if (!$qa_conts[$i]['qa_status']) { ?>main-latest-no-answer<?php } ?>">
                    <div class="main-latest-member-img">
                        <?php if (!$qa_conts[$i]['mb_photo']) { ?>
                        <i class="fas fa-user-circle"></i>
                        <?php } else { ?>
                        <?php echo $qa_conts[$i]['mb_photo']; ?>
                        <?php } ?>
                    </div>
                    <div class="main-latest-cont">
                        <p class="ellipsis"><?php echo conv_subject($qa_conts[$i]['qa_subject'], 40); ?></p>
                        <p class="ellipsis"><span><?php echo $qa_conts[$i]['name']; ?></span><span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $qa_conts[$i]['qa_datetime']); ?></span></p>
                    </div>
                    <?php if (!$qa_conts[$i]['qa_status']) { ?>
                    <span class="latest-status-indicator"></span>
                    <?php } ?>
                </a>
                <?php } ?>
                <?php if (count((array)$qa_conts) == 0) { ?>
                <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 1:1문의가 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php /* 1:1문의 끝 */?>
    </div>
</div>
<?php } ?>

<div class="row row-g-20 m-b-20">
    <div class="col-xxl-6 xxl-m-b-20">
        <div class="row row-g-20">
            <div class="col-sm-6 sm-m-b-20">
                <?php /* 회원 랭킹 시작 */?>
                <div class="main-headline">
                    <h5><strong>회원 랭킹</strong></h5>
                </div>
                <div class="member-chart-wrap">
                    <div class="d-flex">
                        <div class="nav flex-column nav-pills m-r-15" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="tab-member-rank1" data-bs-toggle="pill" data-bs-target="#tab-member-rank-1" type="button" role="tab" aria-controls="tab-case4-1" aria-selected="true">오늘포인트</button>
                            <button class="nav-link" id="tab-member-rank2" data-bs-toggle="pill" data-bs-target="#tab-member-rank-2" type="button" role="tab" aria-controls="tab-case4-2" aria-selected="false">전체포인트</button>
                            <button class="nav-link" id="tab-member-rank3" data-bs-toggle="pill" data-bs-target="#tab-member-rank-3" type="button" role="tab" aria-controls="tab-case4-3" aria-selected="false">전체경험치</button>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-member-rank-1" role="tabpanel" aria-labelledby="tab-member-rank1">
                                <?php foreach ($ranking['today'] as $key => $rankinfo) { ?>
                                <div class="member-rank-list">
                                    <span class="rank-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                                    <span class="rank-name"><?php echo $rankinfo['mb_nick']; ?></span>
                                    <span class="rank-point"><?php echo number_format($rankinfo['po_point']); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="tab-member-rank-2" role="tabpanel" aria-labelledby="tab-member-rank2">
                                <?php foreach ($ranking['total'] as $key => $rankinfo) { ?>
                                <div class="member-rank-list">
                                    <span class="rank-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                                    <span class="rank-name"><?php echo $rankinfo['mb_nick']; ?></span>
                                    <span class="rank-point"><?php echo number_format($rankinfo['mb_point']); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="tab-member-rank-3" role="tabpanel" aria-labelledby="tab-member-rank3">
                                <?php foreach ($ranking['level'] as $key => $rankinfo) { ?>
                                <div class="member-rank-list">
                                    <span class="rank-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                                    <span class="rank-name"><?php echo $rankinfo['mb_nick']; ?></span>
                                    <span class="rank-point"><?php echo number_format($rankinfo['point']); ?></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /* 회원 랭킹 끝 */?>
            </div>
            <div class="col-sm-6">
                <?php /* 신규가입 회원 시작 */?>
                <div class="main-headline">
                    <h5><strong>신규가입 회원</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_4" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for($i=0; $i<count((array)$new_member); $i++) { ?>
                        <div class="main-latest-link">
                            <div class="main-latest-member-img">
                                <?php if (!$new_member[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $new_member[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="member-id-nick" title="이름: <?php echo get_text($new_member[$i]['mb_name']); ?>">
                                    <span>ID: <strong><?php echo $new_member[$i]['mb_id']; ?></strong></span>
                                    <span>닉네임: <strong><?php echo $new_member[$i]['mb_nick']; ?></strong></span>
                                    <span>이름: <strong><?php echo get_text($new_member[$i]['mb_name']); ?></strong></span>
                                </p>
                                <p class="ellipsis">
                                    <span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $new_member[$i]['mb_datetime']); ?></span>
                                    <span><?php echo number_format($new_member[$i]['mb_point']); ?>p</span>
                                </p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if (count((array)$new_member) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 자료가 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 신규가입 회원 끝 */?>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="row row-g-20">
            <div class="col-sm-6 sm-m-b-20">
                <?php /* 포인트 발생 내역시작 */?>
                <div class="main-headline">
                    <h5><strong>포인트 발생 내역</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=point_list"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_5" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for($i=0; $i<count((array)$new_point); $i++) { ?>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=point_list&amp;sfl=mb_id&amp;stx=<?php echo $new_point[$i]['mb_id']; ?>" title="ID: <?php echo $new_point[$i]['mb_id']; ?> 이름: <?php echo $new_point[$i]['mb_name']; ?> 포인트합: <?php echo number_format($new_point[$i]['po_mb_point']); ?>p" class="main-latest-link">
                            <div class="main-latest-member-img">
                                <?php if (!$new_point[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $new_point[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="member-point-cont ellipsis">
                                    <?php echo $new_point[$i]['po_content']; ?>
                                </p>
                                <p class="ellipsis">
                                    <span class="member-point-nick"><?php echo $new_point[$i]['mb_nick']; ?></span>
                                    <span>포인트합: <?php echo number_format($new_point[$i]['po_mb_point']); ?></span>
                                    <span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $new_point[$i]['po_datetime']); ?></span>
                                </p>
                                <div class="member-point-info">
                                    <span><?php echo number_format($new_point[$i]['po_point']); ?></span>
                                </div>
                            </div>
                        </a>
                        <?php } ?>
                        <?php if (count((array)$new_point) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 자료가 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 포인트 발생 내역 끝 */?>
            </div>
            <div class="col-sm-6">
                <?php /* 최근 게시물 시작 */?>
                <div class="main-headline">
                    <h5><strong>최근 게시물</strong></h5>
                    <div class="headline-btn">
                        <a href="<?php echo G5_BBS_URL; ?>/new.php" target="_blank"><i class="las la-plus"></i> 전체보기</a>
                    </div>
                </div>
                <div id="main_latest_wrap_6" class="main-latest-wrap">
                    <div class="main-latest">
                        <?php for($i=0; $i<count((array)$new_post); $i++) { ?>
                        <a href="<?php echo $new_post[$i]['view_url']; ?>" target="_blank" class="main-latest-link">
                            <div class="main-latest-member-img">
                                <?php if (!$new_post[$i]['mb_photo']) { ?>
                                <i class="fas fa-user-circle"></i>
                                <?php } else { ?>
                                <?php echo $new_post[$i]['mb_photo']; ?>
                                <?php } ?>
                            </div>
                            <div class="main-latest-cont">
                                <p class="ellipsis"><?php echo $new_post[$i]['subject']; ?></p>
                                <p class="ellipsis"><span><?php echo $new_post[$i]['name']; ?></span><span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $new_post[$i]['datetime']); ?></span></p>
                            </div>
                        </a>
                        <?php } ?>
                        <?php if (count((array)$new_post) == 0) { ?>
                        <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 게시글이 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
                <?php /* 최근 게시물 끝 */?>
            </div>
        </div>
    </div>
</div>

<div class="row row-g-20 m-b-20">
    <div class="col-xxl-6 xxl-m-b-20">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>오늘의 시간별 접속자, 회원가입, 로그인</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart5" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="row row-g-20">
            <div class="col-sm-6 sm-m-b-20">
                <div class="card deformed-card bd-r-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>오늘의 브라우저별 접속자 비율</h5>
                        </div>
                        <div id="main_chart6" style="width:100%;height:285px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card deformed-card bd-r-0">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>오늘의 OS별 접속자 비율</h5>
                        </div>
                        <div id="main_chart7" style="width:100%;height:285px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-g-20">
    <div class="col-xxl-6 xxl-m-b-20">
        <div class="card deformed-card bd-r-0">
            <div class="card-body">
                <div class="card-title">
                    <h5>오늘의 도메인별 접속자 (직접 접속자 제외)</h5>
                    <div class="card-title-btn">
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list"><i class="las la-plus"></i> 상세보기</a>
                    </div>
                </div>
                <div id="main_chart8" style="width:100%;height:285px;"></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6">
        <div class="card deformed-card bd-r-0">
            <div class="row row-g-20">
                <div class="col-sm-6 sm-m-b-20">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>오늘의 게시글, 댓글 현황</h5>
                        </div>
                        <div id="main_chart9" style="width:100%;height:285px;"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="card-title">
                            <h5>주간 일-게시글, 댓글 현황</h5>
                        </div>
                        <div id="main_chart10" style="width:100%;height:285px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<?php if ($config['cf_use_version_alarm'] == '1' && $eyoom_latest_version != EYOOM_VERSION) { ?>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<?php } ?>
<script>
$(function() {
    new PerfectScrollbar('#main_latest_wrap_1');
    <?php if ($is_youngcart) { // 영카트 쇼핑몰 사용시 ?>
    new PerfectScrollbar('#main_latest_wrap_2');
    new PerfectScrollbar('#main_latest_wrap_3');
    <?php } ?>
    new PerfectScrollbar('#main_latest_wrap_4');
    new PerfectScrollbar('#main_latest_wrap_5');
    new PerfectScrollbar('#main_latest_wrap_6');

    <?php if ($config['cf_use_version_alarm'] == '1' && $eyoom_latest_version != EYOOM_VERSION) { ?>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: 'warning',
        html: '<p class="m-b-10">이윰빌더 <span class="text-indigo"><?php echo $eyoom_latest_version; ?></span> 버전으로 업그레이드 하실 수 있습니다.</p><div class="d-flex justify-content-between"><a href="<?php echo EYOOM_SITE; ?>/eb4_download" target="_blank"><u>바로가기</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form"><i class="fas fa-cog"></i></a></div>'
    });
    <?php } ?>
});

<?php if ($is_youngcart) { // 영카트 쇼핑몰 사용시 ?>
// 쇼핑몰 주간 일-매출 주문 현황
var main_chart1_series = [
    {
        name: '주문금액',
        type: 'column',
        data: [<?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['order'] ? $arr_order[$i]['order']: 0; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
    }, {
        name: '취소금액',
        type: 'column',
        data: [<?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['cancel'] ? $arr_order[$i]['cancel']*-1: 0; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
    }, {
        name: '주문건수',
        type: 'area',
        data: [<?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['count'] ? $arr_order[$i]['count']: 0; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
    }
];

var main_chart1_max_cancel = <?php echo $main_chart1_max_cancel ? $main_chart1_max_cancel*-1: 0; ?>;
var main_chart1_xaxis_cate = [<?php for($i=0; $i<count((array)$x_val); $i++) { echo "'".$x_val[$i]."'"; if(count((array)$x_val)!=($i+1)) echo ','; } ?>];

// 쇼핑몰 주간 일-매출 결제수단별 현황
var main_chart2_series = [
    <?php foreach ($pg_info as $k => $pginfo) { ?>
    {
        name: '<?php echo $pginfo['method']; ?>',
        type: 'column',
        data: [<?php for($i=0; $i<count((array)$x_val); $i++) { echo $pginfo['info'][$i]['price'] ? $pginfo['info'][$i]['price']: 0; if(count((array)$x_val)!=($i+1)) echo ','; } ?>]
    }, 
    <?php } ?>
    {
        name: '합계금액',
        type: 'line',
        data: [<?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['order'] ? $arr_order[$i]['order']: 0; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
    }
];

var main_chart2_max_order = <?php echo $main_chart2_max_order ? $main_chart2_max_order: 0; ?>;
var main_chart2_xaxis_cate = [<?php for($i=0; $i<count((array)$x_val); $i++) { echo "'".$x_val[$i]."'"; if(count((array)$x_val)!=($i+1)) echo ','; } ?>];

// 쇼핑몰 년간 월-매출 주문 현황
var main_chart3_series = [
    {
        name: '주문금액',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $tot[$i]['orderprice'] ? $tot[$i]['orderprice']: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '주문건수',
        type: 'area',
        data: [<?php for($i=1; $i<=12; $i++) { echo $sale_month[$i]['count'] ? $sale_month[$i]['count']: 0; if($i!='12') echo ','; } ?>]
    }
];

var main_chart3_max_cancel = <?php echo $main_chart3_max_cancel ? $main_chart3_max_cancel*-1: 0; ?>;;
var main_chart3_xaxis_cate = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];

// 쇼핑몰 년간 월-매출 결제수단별 현황
var main_chart4_series = [
    {
        name: '무통장',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptbank[$i] ? $receiptbank[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '가상계좌',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptvbank[$i] ? $receiptvbank[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '계좌이체',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptiche[$i] ? $receiptiche[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '신용카드',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptcard[$i] ? $receiptcard[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '간편결제',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receipteasy[$i] ? $receipteasy[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: 'KAKAOPAY',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptkakao[$i] ? $receiptkakao[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '휴대폰',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receipthp[$i] ? $receipthp[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '쿠폰',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $ordercoupon[$i] ? $ordercoupon[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '포인트',
        type: 'column',
        data: [<?php for($i=1; $i<=12; $i++) { echo $receiptpoint[$i] ? $receiptpoint[$i]: 0; if($i!='12') echo ','; } ?>]
    }, {
        name: '합계금액',
        type: 'line',
        data: [<?php for($i=1; $i<=12; $i++) { echo $tot[$i]['orderprice'] ? $tot[$i]['orderprice']: 0; if($i!='12') echo ','; } ?>]
    }
];

var main_chart4_max_order = <?php echo $main_chart4_max_order ? $main_chart4_max_order: 0; ?>;
var main_chart4_xaxis_cate = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
<?php } ?>

// 오늘의 시간별 접속자, 회원가입, 로그인
var main_chart5_series = [
    {
        name: '접속자',
        type: 'area',
        data: [<?php for($i=0; $i<24; $i++) { echo $this_vi_count[$i] ? $this_vi_count[$i]: 0; if(($i+1)!=24) echo ','; } ?>]
    }, {
        name: '회원가입',
        type: 'column',
        data: [<?php for($i=0; $i<24; $i++) { echo $this_vi_regist[$i] ? $this_vi_regist[$i]: 0; if(($i+1)!=24) echo ','; } ?>]
    }, {
        name: '로그인',
        type: 'column',
        data: [<?php for($i=0; $i<24; $i++) { echo $this_today_login[$i] ? $this_today_login[$i]: 0; if(($i+1)!=24) echo ','; } ?>]
    }
];

var main_chart5_max_count = <?php echo $main_chart5_max_count ? $main_chart5_max_count: 0; ?>;
var main_chart5_xaxis_cate = ['0시', '1시', '2시', '3시', '4시', '5시', '6시', '7시', '8시', '9시', '10시', '11시', '12시', '13시', '14시', '15시', '16시', '17시', '18시', '19시', '20시', '21시', '22시', '23시'];

// 오늘의 브라우저별 접속자 비율
var main_chart6_series = [<?php $i=0; if (is_array($this_vi_browser)) { foreach ($this_vi_browser as $key => $val) { ?><?php echo $val; ?><?php if (count((array)$this_vi_browser) != ($i+1)) echo ','; $i++; ?><?php }} ?>];
var main_chart6_labels = [<?php $i=0; if (is_array($this_vi_browser)) { foreach ($this_vi_browser as $key => $val) { ?>'<?php echo $key; ?>'<?php if (count((array)$this_vi_browser) != ($i+1)) echo ','; $i++; ?><?php }} ?>];

// 오늘의 OS별 접속자 비율
var main_chart7_series = [<?php $i=0; if (is_array($this_vi_os)) { foreach ($this_vi_os as $key => $val) { ?><?php echo $val; ?><?php if (count((array)$this_vi_os) != ($i+1)) echo ','; ?><?php }} ?>];
var main_chart7_labels = [<?php $i=0; if (is_array($this_vi_os)) { foreach ($this_vi_os as $key => $val) { ?>'<?php if (!$key) echo '기타'; else echo $key; ?>'<?php if (count((array)$this_vi_os) != ($i+1)) echo ','; ?><?php }} ?>];

// 오늘의 OS별 접속자 비율
var main_chart8_series = [
    {
        data: [
            <?php $i=0; if (is_array($this_vi_domain)) { foreach ($this_vi_domain as $key => $val) { ?>
            <?php if ($i<20 && !$key == '') { ?>
            {x: '<?php if($key == '') { ?>Direct<?php } else { ?><?php echo $key; ?><?php } ?>', y: <?php echo $val; ?>}<?php if (count((array)$this_vi_domain) != ($i+1)) echo ','; ?>
            <?php } ?>
            <?php }} ?>
        ]
    }
];

// 오늘의 게시글, 댓글 현황
var main_chart9_series = [
    {
        name: '게시글',
        type: 'area',
        data: [<?php for($i=0; $i<24; $i++) { echo $this_today_write[$i] ? $this_today_write[$i]: 0; if(($i+1)!=24) echo ','; } ?>]
    }, {
        name: '댓글',
        type: 'area',
        data: [<?php for($i=0; $i<24; $i++) { echo $this_today_cmt[$i] ? $this_today_cmt[$i]: 0; if(($i+1)!=24) echo ','; } ?>]
    }
];

var main_chart9_xaxis_cate = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];

// 주간 일-게시글, 댓글 현황
var main_chart10_series = [
    {
        name: '게시글',
        type: 'column',
        data: [<?php for($i=0; $i<7; $i++) { echo $arr_activity[$i]['write'] ? $arr_activity[$i]['write']: 0; if(($i+1)!=7) echo ','; } ?>]
    }, {
        name: '댓글',
        type: 'column',
        data: [<?php for($i=0; $i<7; $i++) { echo $arr_activity[$i]['cmt'] ? $arr_activity[$i]['cmt']: 0; if(($i+1)!=7) echo ','; } ?>]
    }
];

var main_chart10_xaxis_cate = [<?php for($i=0; $i<count((array)$x_val); $i++) { echo "'".$x_val[$i]."'"; if(count((array)$x_val)!=($i+1)) echo ','; } ?>];
</script>