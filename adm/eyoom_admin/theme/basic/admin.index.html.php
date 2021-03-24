<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/index.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/c3/c3.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
/*----- Main Headline -----*/
.main-headline {position:relative}
.main-headline h5 {position:relative;float:left;padding:0;margin:0 0 20px;color:#000}
.main-headline h5:after {content:"";display:block;position:absolute;bottom:-10px;left:0;width:14px;height:2px;background:#EA3C4D}
.main-headline a:hover {text-decoration:underline}
.main-headline .headline-btn {float:right}
.main-headline .headline-btn.btn-e-brd {background:#fff}
.main-headline .headline-btn .btn-e-brd {background:#fff}
.main-headline .headline-btn.btn-e-brd:hover {text-decoration:none}
.main-headline .headline-btn .btn-e-brd:hover {text-decoration:none}
/*----- Order Box -----*/
.order-wrap {position:relative;margin-bottom:30px;border:1px solid #c5c5c5;border-bottom:2px solid #c5c5c5}
.order-box {position:relative;overflow:hidden;width:25%;float:left;background:#fff}
.order-box:nth-child(1) {border-right:1px dotted #d5d5d5}
.order-box:nth-child(2) {border-right:1px dotted #d5d5d5}
.order-box:nth-child(3) {border-right:1px dotted #d5d5d5}
.order-box > .order-box-in {padding:15px}
.order-box > .order-box-footer {position:relative;text-align:center;padding:5px 0;color:#000;display:block;z-index:10;background:#fbfbfb;text-decoration:none;font-size:12px;border-top:1px dotted #d5d5d5}
.order-box > .order-box-footer:hover span {color:#FF0035}
.order-box h3 {font-size:35px;font-weight:bold;margin:0 0 10px;white-space:nowrap;padding:0;color:#1C1C26}
.order-box:nth-child(1) h3 {color:#FDAB29}
.order-box:nth-child(2) h3 {color:#14BAA8}
.order-box:nth-child(3) h3 {color:#6284F3}
.order-box:nth-child(4) h3 {color:#FF4848}
.order-box > .order-box-footer span {text-decoration:underline}
.order-box p {font-size:13px;margin-bottom:0;color:#838391}
.order-box p > order {display:block;color:#f9f9f9;font-size:13px;margin-top:5px}
.order-box h3 {position:relative}
.order-box h3,.order-box p {z-index:5px}
.order-box .icon {position:absolute;top:0;right:15px;z-index:0;font-size:42px;color:rgba(0, 0, 0, 0.1)}
.order-box:hover {text-decoration:none;color:#f9f9f9}
.order-box:hover .icon {color:rgba(0, 0, 0, 0.2)}
.order-box:hover p {color:#000}
@media (max-width: 767px) {
    .order-box {text-align:center;width:50%}
    .order-box:nth-child(1) {border-right:1px dotted #d5d5d5;border-bottom:1px solid #d5d5d5}
    .order-box:nth-child(2) {border-right:0;border-bottom:1px solid #d5d5d5}
    .order-box:nth-child(3) {border-right:1px dotted #d5d5d5}
    .order-box .icon {display:none}
    .order-box p {font-size:12px}
}
/*----- Chart -----*/
.chart-wrap .chart-item {position:relative;float:left;width:50%}
.chart-wrap .chart-item .btn-group .dropdown-menu {left:inherit;right:0}
.chart-wrap .chart-item.item-left {padding-right:10px}
.chart-wrap .chart-item.item-right {padding-left:10px}
.chart-wrap .chart-item-in {position:relative;width:100%;height:auto;border:1px solid #c5c5c5;border-bottom:2px solid #c5c5c5;padding:10px 0;background:#fff}
.chart-wrap .chart-item-in.padding-left-10 {padding-left:10px}
.chart-wrap .chart-item-in.padding-right-10 {padding-right:10px}
.chart-wrap .chart-item-in.padding-x-10 {padding-left:10px;padding-right:10px}
@media (max-width: 767px) {
    .chart-wrap .chart-item {position:relative;float:left;width:100%;margin-bottom:30px}
    .chart-wrap .chart-item.item-left {padding-right:0}
    .chart-wrap .chart-item.item-right {padding-left:0}
}
.chart-wrap .chart-item .chart-status-wrap {position:relative;padding:10px 20px}
.chart-wrap .chart-item .chart-status {float:left;border-right:1px solid #dadada;padding:0 15px}
.chart-wrap .chart-item .chart-status.border-right-0 {border-right:0}
.chart-wrap .chart-item .chart-status label {color:#838391;font-size:12px}
.chart-wrap .chart-item .chart-status p {color:#2E3340;font-weight:bold;font-size:15px}
@media (max-width: 500px) {
    .chart-wrap .chart-item .chart-status-wrap {padding:10px}
    .chart-wrap .chart-item .chart-status {padding:0 10px}
    .chart-wrap .chart-item .chart-status p {font-size:13px}
}
/*----- Site Chart & Member Chart -----*/
.site-chart-wrap {background:#fff;border:1px solid #c5c5c5;border-bottom:2px solid #c5c5c5;padding:20px;height:324px}
.site-chart-wrap h5 {position:relative;margin:0 0 20px}
.site-chart-wrap .statistics-box-wrap {position:relative;margin:0 -20px 20px;background:linear-gradient(to top right, #242630, #000)}
.site-chart-wrap .statistics-box {float:left;width:33.33333%;padding:10px 5px;text-align:center;background:#fff;border-top:1px solid #d5d5d5;border-bottom:1px solid #d5d5d5}
.site-chart-wrap .statistics-box:nth-child(1) {background:#f0f1f3}
.site-chart-wrap .statistics-box:nth-child(2) {background:#e5e6e9}
.site-chart-wrap .statistics-box:nth-child(3) {background:#f0f1f3}
.site-chart-wrap .statistics-box h6 {color:#83838F;font-size:12px}
.site-chart-wrap .statistics-box p {color:#000;font-size:13px}
.site-chart-wrap .statistics-box a:hover p {text-decoration:underline}
.site-chart-wrap .statistics-list li {margin:5px 0;font-size:12px}
.site-chart-wrap .statistics-list li span {display:inline-block;width:110px;color:#838391}
.site-chart-wrap .statistics-list li strong {display:inline-block;color:#000}
.member-chart-wrap {background:#fff;border:1px solid #c5c5c5;border-bottom:2px solid #c5c5c5;padding:20px 0 20px 20px;height:324px}
.member-chart-wrap h5 {position:relative;margin:0 0 20px}
.member-chart-wrap .tab-std {position:relative}
.member-chart-wrap .tab-content-left {position:relative;margin-right:85px;border-color:#474A5E}
.member-chart-wrap .tab-content-left .tab-content {padding:0 15px 0 0}
.member-chart-wrap .tab-content-left .tab-content .tab-pane {position:relative;top:inherit;bottom:inherit;left:inherit;right:inherit;padding:0}
.member-chart-wrap .member-rank-list {position:relative;overflow:hidden;height:25px;line-height:25px;font-size:12px;max-width:230px}
.member-chart-wrap .member-rank-list .rank-num {display:inline-block;position:absolute;top:1px;left:0;width:30px;height:22px;line-height:22px;text-align:center;color:#dfdfe3;font-size:11px;background:#474A5E;margin-right:5px}
.member-chart-wrap .member-rank-list .rank-name {display:inline-block;position:relative;overflow:hidden;width:80px;color:#5d5d68;margin-left:40px}
.member-chart-wrap .member-rank-list .rank-point {display:inline-blok;position:absolute;top:0;right:0;width:70px;height:25px;line-height:25px;color:#FF7042;text-align:right}
.member-chart-wrap .member-rank-list:nth-child(1) .rank-num {background:#FF4848;color:#fff}
.member-chart-wrap .member-rank-list:nth-child(2) .rank-num {background:#FDAB29;color:#fff}
.member-chart-wrap .member-rank-list:nth-child(3) .rank-num {background:#FDAB29;color:#fff}
.member-chart-wrap .tab-nav-right {position:absolute;top:0;right:0;width:86px;border-color:#474A5E}
.member-chart-wrap .tab-std-dark .nav-stacked li a {background:#e5e6e9;font-size:12px;color:#000;border-radius:0 !important}
.member-chart-wrap .tab-std-dark .nav-stacked li a:hover {background:#d3d4d8;color:#000}
.member-chart-wrap .tab-std-dark .nav-stacked li.active a {background:#474A5E;color:#fff}
@media (min-width:1600px) {
    .site-chart-wrap .statistics-box p {font-size:17px}
}
/*----- Table -----*/
.jsgride-wrap .new-member-photo {position:relative;overflow:hidden;width:26px;height:26px;border:1px solid #c5c5c5;background:#fff;padding:1px;margin:0 auto;text-align:center;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.jsgride-wrap .new-member-photo i {width:22px;height:22px;font-size:15px;line-height:22px;background:#b2b4bd;color:#fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.jsgride-wrap .new-member-photo img {-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
/*----- Latest -----*/
.main-latest-wrap {position:relative;background:#fff;border:1px dashed #b5b5b5;padding:10px}
.main-latest .main-latest-none {display:block;text-align:center;font-size:12px;color:#7c7c89;padding:20px 7px;margin:0}
.main-latest-link {position:relative;overflow:hidden;display:block;font-size:13px;color:#2c2c35;height:52px;padding:7px;transition:all 0.2s ease-in-out;background:#fff}
.main-latest-link:nth-child(even) {background:#f2f2f2}
.main-latest-link .main-latest-member-img {position:absolute;overflow:hidden;top:10px;left:10px;width:36px;height:36px;border-radius:50% !important}
.main-latest-link .main-latest-member-img img {display:block;width:100% \9;max-width:100%;height:auto}
.main-latest-link .main-latest-member-img i {font-size:36px;color:#74747d}
.main-latest-link .main-latest-cont {position:relative;margin-left:46px}
.main-latest-link .main-latest-cont p {margin-bottom:0;color:#2c2c35;font-size:12px}
.main-latest-link .main-latest-cont span {display:inline-block;font-size:11px;color:#7c7c89;margin-right:7px}
.main-latest-link .main-latest-cont .member-point-info {position:absolute;top:2px;right:0;min-width:60px;background:#3D4254;color:#b8b8c3;padding:2px 5px;font-size:10px;line-height:1;text-align:right}
.main-latest-link .main-latest-cont .member-point-info span {color:#87BA00;font-size:10px;margin-right:2px}
.main-latest-link .main-latest-cont .member-id-nick span {color:#2c2c35;font-size:12px}
.main-latest-link .main-latest-cont .member-id-nick strong {color:#0078FF;font-weight:normal}
.main-latest-link:hover, .main-latest-link:focus {color:#fff;opacity:0.9}
.main-latest-link:hover p {color:#000}
.main-latest-link:hover .main-latest-member-img i {color:#50505a}
.main-latest-link + .main-latest-link {margin-top:1px}
.main-latest-link.main-latest-no-answer {background:#fff7eb}
.main-latest-link .latest-status-indicator {position:absolute;bottom:7px;right:7px;display:inline-block;width:7px;height:7px;border-radius:50% !important;background:#ff0035}
/*----- Secret QA Latest -----*/
.secret-qa-wrap {background:#fff;border:1px solid #c5c5c5;border-bottom:2px solid #c5c5c5;padding:20px;height:324px}
.secret-qa-headline {position:relative}
.secret-qa-headline h5 {position:relative;float:left;padding:0;margin:0 0 20px}
.secret-qa-headline .headline-btn {float:right;background:#000}
.secret-qa-headline .headline-btn .btn-e {background:#000}
.secret-qa-wrap .main-latest-wrap {border:0;padding:0}
.secret-qa-wrap .main-latest-link {height:48px}
.secret-qa-wrap .main-latest-link .main-latest-member-img {width:32px;height:32px}
.secret-qa-wrap .main-latest-link .main-latest-member-img i {font-size:32px}
.secret-qa-wrap .main-latest-link .main-latest-cont p {line-height:1.4}
</style>

<?php if ($is_youngcart) { ?>

<?php /* ------------- 처리할 주문 시작 ------------- */?>
<div class="main-headline">
    <h5><strong>처리할 주문</strong></h5>
    <div class="clearfix"></div>
</div>
<div class="order-wrap">
    <?php foreach ($order_status as $key => $status) { ?>
    <div class="order-box">
        <div class="order-box-in">
            <h3><?php if ($status['count'] > 0) { ?><div class="alarm-marker"><span class="alarm-effect"></span><span class="alarm-point"></span></div><?php } ?><?php echo number_format($status['count']); ?></h3>
            <p>
                <?php echo $key; ?> <i class="fas fa-caret-right"></i>
                <?php if ($key == '주문') { ?>입금<?php } else if ($key == '입금') { ?>준비<?php } else if ($key == '준비') { ?>배송<?php } else if ($key == '배송') { ?>완료<?php } ?>
            </p>
        </div>
        <div class="icon">
            <i class="fas fa-<?php if ($key == '주문') { ?>shopping-basket<?php } else if ($key == '입금') { ?>credit-card<?php } else if ($key == '준비') { ?>cube<?php } else if ($key == '배송') { ?>check<?php } ?>"></i>
        </div>
        <a href="<?php echo $status['href']; ?>" class="order-box-footer ellipsis">
            금액: <strong><?php echo number_format($status['price']); ?>원</strong> - <span>처리하기</span>
        </a>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>
<?php /* 처리할 주문 끝 */?>

<?php } ?>

<div class="row">
    <div class="col-md-4 md-margin-bottom-30">
        <?php /* ------------- 사이트 통계 시작 ------------- */?>
        <div class="site-chart-wrap">
            <h5><strong>사이트 통계</strong></h5>
            <div class="statistics-box-wrap">
                <div class="statistics-box">
                    <h6>현재접속자</h6>
                    <a href="<?php echo G5_BBS_URL; ?>/current_connect.php" target="_blank">
                        <p><strong><?php echo number_format($current['total_cnt']); ?> (<span class="color-red"><?php echo number_format($current['mb_cnt']); ?></span>)</strong></p>
                    </a>
                </div>
                <div class="statistics-box">
                    <h6>오늘방문자</h6>
                    <p><strong class="color-orange"><?php echo $visit['visit_today']; ?></strong></p>
                </div>
                <div class="statistics-box">
                    <h6>어제방문자</h6>
                    <p><strong class="color-teal"><?php echo $visit['visit_yesterday']; ?></strong></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled statistics-list">
                <li><span>• 최대방문자 :</span><strong><?php echo $visit['visit_max']; ?></strong></li>
                <li><span>• 전체방문자 :</span><strong><?php echo $visit['visit_total']; ?></strong></li>
                <li><span>• 신규회원수 :</span><strong><?php echo $visit['newby']; ?></strong></li>
                <li><span>• 전체회원수 :</span><strong><?php echo $visit['members']; ?></strong></li>
                <li><span>• 전체게시물 :</span><strong><?php echo $visit['total_write']; ?></strong></li>
                <li><span>• 전체코멘트 :</span><strong><?php echo $visit['total_comment']; ?></strong></li>
            </ul>
        </div>
        <?php /* 사이트 통계 끝 */?>
    </div>
    <div class="col-md-4 md-margin-bottom-30">
        <?php /* ------------- 회원 랭킹 시작 ------------- */?>
        <div class="member-chart-wrap">
            <h5><strong>회원 랭킹</strong></h5>
            <div class="tab-std tab-std-dark">
                <div class="tab-content-left">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab-member-rank-1">
                            <?php foreach ($ranking['total'] as $key => $rankinfo) { ?>
                            <div class="member-rank-list">
                                <span class="rank-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                                <span class="rank-name"><?php echo $rankinfo['mb_nick']; ?></span>
                                <span class="rank-point"><?php echo number_format($rankinfo['mb_point']); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="tab-member-rank-2">
                            <?php foreach ($ranking['today'] as $key => $rankinfo) { ?>
                            <div class="member-rank-list">
                                <span class="rank-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                                <span class="rank-name"><?php echo $rankinfo['mb_nick']; ?></span>
                                <span class="rank-point"><?php echo number_format($rankinfo['po_point']); ?></span>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="tab-member-rank-3">
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
                <div class="tab-nav-right">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#tab-member-rank-1" data-toggle="tab">전체포인트</a></li>
                        <li><a href="#tab-member-rank-2" data-toggle="tab">오늘포인트</a></li>
                        <li><a href="#tab-member-rank-3" data-toggle="tab">경험치</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php /* 회원 랭킹 끝 */?>
    </div>
    <div class="col-md-4">
        <?php /* ------------- 1:1 문의 시작 ------------- */?>
        <div class="secret-qa-wrap">
            <div class="secret-qa-headline">
                <h5><strong>1:1 문의</strong></h5>
                <div class="headline-btn">
                    <a href="<?php echo G5_BBS_URL; ?>/qalist.php" target="_blank" class="btn-e btn-e-xs btn-e-dark">전체보기 <i class="fas fa-plus"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="main-latest-wrap">
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
                    <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 문의글이 없습니다.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php /* 1:1 문의 끝 */?>
    </div>
</div>
<div class="margin-bottom-30"></div>

<?php if ($is_youngcart) { ?>

<div class="row">
    <div class="col-md-6 md-margin-bottom-30">
        <?php /* ------------- 상품문의 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>상품문의</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemqalist" class="btn-e btn-e-xs btn-e-brd btn-e-default">전체보기 <i class="fas fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main-latest-wrap">
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
                <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 문의글이 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php /* 상품문의 끝 */?>
    </div>
    <div class="col-md-6">
        <?php /* ------------- 사용후기 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>사용후기</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemuselist" class="btn-e btn-e-xs btn-e-brd btn-e-default">전체보기 <i class="fas fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main-latest-wrap">
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
                <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 후기글이 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php /* 사용후기 끝 */?>
    </div>
</div>
<div class="margin-bottom-30"></div>

<div class="chart-wrap">
    <div class="chart-item item-left">
        <?php /* ------------- 쇼핑몰 주간 일-매출 현황 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>쇼핑몰 주간 일-매출 현황</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1">기간별 매출현황 검색</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemsellrank">상품판매 순위</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist">쇼핑몰 주문현황</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in padding-right-10">
            <div class="chart-canvas">
                <div id="chartSalesWeek"></div>
            </div>
        </div>
        <?php /* 쇼핑몰 주간 일-매출 현황 끝 */?>
    </div>

    <div class="chart-item item-right">
        <?php /* ------------- 쇼핑몰 년간 월-매출 현황 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>쇼핑몰 년간 월-매출 현황</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=sale1">기간별 매출현황 검색</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemsellrank">상품판매 순위</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=orderlist">쇼핑몰 주문현황</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in padding-right-10">
            <div class="chart-canvas">
                <div id="chartSalesMonth"></div>
            </div>
        </div>
        <?php /* 쇼핑몰 년간 월-매출 현황 끝 */?>
    </div>
    <div class="clearfix"></div>
    <div class="margin-bottom-30 hidden-xs"></div>
</div>

<?php /* ------------- 결제수단별 주문현황 시작 ------------- */?>
<div class="table-wrap">
    <div class="main-headline">
        <h5><strong>결제수단별 주문현황</strong></h5>
        <div class="clearfix"></div>
    </div>
    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-h"></i>)</p>
    <?php } ?>
    <div class="table-list-eb main-table">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th rowspan="2" class="td-width-150 bg-yellow lighter"><span class="color-black">구분</span></th>
                    <?php for ($i=0; $i<count((array)$od_pg_thead); $i++) { ?>
                    <th colspan="2" class="text-center"><?php echo $od_pg_thead[$i]['day']; ?></th>
                    <?php } ?>
                </tr>
                <tr>
                    <?php for ($i=0; $i<count((array)$od_pg_thead); $i++) { ?>
                    <th class="min-width-50 text-center">건수</th>
                    <th class="min-width-50 text-center">금액</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pg_info as $key => $pgifno) { ?>
                <tr>
                    <th><strong><?php echo $pgifno['method']; ?></strong></th>
                    <?php foreach ($pgifno['info'] as $k => $ifno) { ?>
                    <td class="text-right"><?php echo number_format($ifno['count']); ?></td>
                    <td class="text-right"><?php echo number_format($ifno['price']); ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="margin-bottom-30"></div>
</div>
<?php /* 결제수단별 주문현황 끝 */?>

<?php } ?>

<div class="row">
    <div class="col-md-4 md-margin-bottom-30">
        <?php /* ------------- 신규가입 회원 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>신규가입 회원</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list" class="btn-e btn-e-xs btn-e-brd btn-e-default">전체보기 <i class="fas fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main-latest-wrap">
            <div class="main-latest">
                <?php for($i=0; $i<count((array)$new_member); $i++) { ?>
                <div class="main-latest-link" title="이름: <?php echo get_text($new_member[$i]['mb_name']); ?>">
                    <div class="main-latest-member-img">
                        <?php if (!$new_member[$i]['mb_photo']) { ?>
                        <i class="fas fa-user-circle"></i>
                        <?php } else { ?>
                        <?php echo $new_member[$i]['mb_photo']; ?>
                        <?php } ?>
                    </div>
                    <div class="main-latest-cont">
                        <p class="member-id-nick ellipsis">
                            <span>ID: <strong><?php echo $new_member[$i]['mb_id']; ?></strong></span>
                            <span>닉: <strong><?php echo $new_member[$i]['mb_nick']; ?></strong></span>
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
    <div class="col-md-4 md-margin-bottom-30">
        <?php /* ------------- 포인트 발생내역 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>포인트 발생내역</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=point_list" class="btn-e btn-e-xs btn-e-brd btn-e-default">전체보기 <i class="fas fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main-latest-wrap">
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
                            <span><i class="far fa-clock"></i> <?php echo $eb->date_format('Y-m-d', $new_point[$i]['po_datetime']); ?></span>
                        </p>
                        <div class="member-point-info">
                            <span><?php echo number_format($new_point[$i]['po_point']); ?></span>p
                        </div>
                    </div>
                </a>
                <?php } ?>
                <?php if (count((array)$new_point) == 0) { ?>
                <p class="main-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 자료가 없습니다.</p>
                <?php } ?>
            </div>
        </div>
        <?php /* 포인트 발생내역 끝 */?>
    </div>
    <div class="col-md-4">
        <?php /* ------------- 최근 게시물 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>최근 게시물</strong></h5>
            <div class="headline-btn">
                <a href="<?php echo G5_BBS_URL; ?>/new.php" target="_blank" class="btn-e btn-e-xs btn-e-brd btn-e-default">전체보기 <i class="fas fa-plus"></i></a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="main-latest-wrap">
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
<div class="margin-bottom-30"></div>

<div class="chart-wrap">
    <div class="chart-item item-left">
        <?php /* ------------- 오늘의 시간별 접속자, 회원가입 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>오늘의 시간별 접속자, 회원가입</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list">접속자 집계</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_search">접속자 검색</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list">회원 관리</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in">
            <div class="chart-canvas">
                <div id="chartTime"></div>
            </div>
        </div>
        <?php /* 오늘의 시간별 접속자, 회원가입 끝 */?>
    </div>

    <div class="chart-item item-right">
        <?php /* ------------- 오늘의 브라우저별 접속자 비율 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>오늘의 브라우저별 접속자 비율</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list">접속자 집계</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_search">접속자 검색</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list">회원 관리</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in">
            <div class="chart-canvas">
                <div id="chartBrowser"></div>
            </div>
        </div>
        <?php /* 오늘의 브라우저별 접속자 비율 끝 */?>
    </div>
    <div class="clearfix"></div>
    <div class="margin-bottom-30 hidden-xs"></div>
</div>

<div class="chart-wrap">
    <div class="chart-item item-left">
        <?php /* ------------- 오늘의 도메인별 접속자 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>오늘의 도메인별 접속자</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list">접속자 집계</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_search">접속자 검색</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list">회원 관리</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in">
            <div class="chart-canvas">
                <div id="chartDomain"></div>
            </div>
        </div>
        <?php /* 오늘의 도메인별 접속자 끝 */?>
    </div>

    <div class="chart-item item-right">
        <?php /* ------------- 오늘의 접속자 OS 비율 시작 ------------- */?>
        <div class="main-headline">
            <h5><strong>오늘의 OS별 접속자 비율</strong></h5>
            <div class="headline-btn btn-group">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list" type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split">상세보기</a>
                <button type="button" class="btn-e btn-e-xs btn-e-brd btn-e-default btn-e-split-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-caret-down"></i>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_list">접속자 집계</a></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=visit_search">접속자 검색</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list">회원 관리</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="chart-item-in">
            <div class="chart-canvas">
                <div id="chartOS"></div>
            </div>
        </div>
        <?php /* 오늘의 접속자 OS 비율 끝 */?>
    </div>
    <div class="clearfix"></div>
</div>

<script type="text/javascript" src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/d3/d3.min.js"></script>
<script type="text/javascript" src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/c3/c3.min.js"></script>
<script type="text/javascript" src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script type="text/javascript" src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
// ----- 시간별 접속자, 회원가입 ----- //
var chartTime = c3.generate({
    bindto: '#chartTime',
    data: {
        x: '시간',
        columns: [
            ['시간', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
            // 시간별 접속자
            ['접속자', 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            // 시간별 회원가입
            ['회원가입', 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
        ],
        axes: {
            회원가입: 'y2'
        },
        types: {
            접속자: 'area-spline',
            회원가입: 'bar'
        }
    },
    color: {
        pattern: ['#007AFF', '#FF9400']
    },
    axis: {
        x: {
            label: {
                text: '시간 (단위: 시)',
                position: 'outer-center'
            }
        },
        y: {
            tick: {
                format: d3.format(",")
            },
            label: {
                text: '접속자 (단위: 명)',
                position: 'outer-middle'
            }
        },
        y2: {
            show: true,
            label: {
                text: '회원가입 (단위: 명)',
                position: 'outer-middle'
            }
        }
    }
});

setTimeout(function () {
    chartTime.load({
        columns: [
            // 오늘의 시간별 접속자
            ['접속자', <?php for($i=0; $i<count((array)$this_vi_count); $i++) { echo $this_vi_count[$i]; if(count((array)$this_vi_count)!=($i+1)) echo ','; } ?>]
        ]
    });
}, 1500);

setTimeout(function () {
    chartTime.load({
        columns: [
            // 오늘의 시간별 회원가입
            ['회원가입', <?php for($i=0; $i<count((array)$this_vi_regist); $i++) { echo $this_vi_regist[$i]; if(count((array)$this_vi_regist)!=($i+1)) echo ','; } ?>]
        ]
    });
}, 2000);

// ----- 브라우저별 접속자  ----- //
var chartBrowser = c3.generate({
    bindto: '#chartBrowser',
    data: {
        // 어제의 브라우저별 접속자
        columns: [],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "브라우저별 접속자",
        label: {
            format: function (value, ratio, id) {
                return d3.format()(value);
            }
        }
    }
});

setTimeout(function () {
    chartBrowser.load({
        // 오늘의 브라우저별 접속자
        columns: [
            <?php $i=0; if (is_array($this_vi_browser)) { foreach ($this_vi_browser as $key => $val) { ?>
            ['<?php echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$this_vi_browser) != ($i+1)) echo ','; $i++; ?>
            <?php }} ?>
        ]
    });
}, 1500);

// ----- 도메인별 접속자   ----- //
var chartDomain = c3.generate({
    bindto: '#chartDomain',
    data: {
        // 어제의 도메인별 접속자
        columns: [],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "도메인별 접속자",
        label: {
            format: function (value, ratio, id) {
                return d3.format()(value);
            }
        }
    }
});
setTimeout(function () {
    chartDomain.load({
        // 오늘의 도메인별 접속자
        columns: [
            <?php $i=0; if (is_array($this_vi_domain)) { foreach ($this_vi_domain as $key => $val) { ?>
            <?php if ($i<10) { ?>
            ['<?php echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$this_vi_domain) != ($i+1)) echo ','; ?>
            <?php } ?>
            <?php }} ?>
        ]
    });
}, 1500);

// ----- OS별 접속자 비율 ----- //
var chartOS = c3.generate({
    bindto: '#chartOS',
    data: {
        // 어제의 OS 접속자
        columns: [],
        type : 'donut',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    donut: {
        title: "OS별 접속자",
        label: {
            format: function (value, ratio, id) {
                return d3.format()(value);
            }
        }
    }
});
setTimeout(function () {
    chartOS.load({
        // 오늘의 OS 접속자
        columns: [
            <?php $i=0; if (is_array($this_vi_os)) { foreach ($this_vi_os as $key => $val) { ?>
            ['<?php if (!$key) echo '기타'; else echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$this_vi_os) != ($i+1)) echo ','; ?>
            <?php }} ?>
        ]
    });
}, 1500);

<?php if ($is_youngcart) { ?>
// ----- 쇼핑몰 주간 일-매출 현황 ----- //
var chartSalesWeek = c3.generate({
    bindto: '#chartSalesWeek',
    data: {
        x: '날짜',
        // 지난 7일 쇼핑몰 매출 현황
        columns: [
            ['날짜', <?php for($i=0; $i<count((array)$last_x_val); $i++) { echo "'".$last_x_val[$i]."'"; if(count((array)$last_x_val)!=($i+1)) echo ','; } ?>],
            ['주문', 0, 0, 0, 0, 0, 0, 0],
            ['취소', 0, 0, 0, 0, 0, 0, 0]
        ],
        type: 'bar'
    },
    color: {
        pattern: ['#87BA00', '#FF2900']
    },
    bar: {
        width: {
            ratio: 0.8
        }
    },
    axis: {
        x: {
            type: 'timeseries',
            tick: {
                format: '%m-%d'
            },
            label: {
                text: '주간 (단위: 일)',
                position: 'outer-center'
            }
        },
        y: {
            tick: {
                format: d3.format(",")
            },
            label: {
                text: '매출 (단위: 원)',
                position: 'outer-middle'
            }
        }
    }
});

setTimeout(function () {
    chartSalesWeek.load({
        // 최근 7일 쇼핑몰 매출 현황((주문)
        columns: [
            ['날짜', <?php for($i=0; $i<count((array)$x_val); $i++) { echo "'".$x_val[$i]."'"; if(count((array)$x_val)!=($i+1)) echo ','; } ?>],
            ['주문', <?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['order']; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
        ]
    });
}, 1600);

setTimeout(function () {
    chartSalesWeek.load({
        // 최근 7일 쇼핑몰 매출 현황(취소)
        columns: [
            ['날짜', <?php for($i=0; $i<count((array)$x_val); $i++) { echo "'".$x_val[$i]."'"; if(count((array)$x_val)!=($i+1)) echo ','; } ?>],
            ['취소', <?php for($i=0; $i<count((array)$arr_order); $i++) { echo $arr_order[$i]['cancel']*-1; if(count((array)$arr_order)!=($i+1)) echo ','; } ?>]
        ]
    });
}, 2200);

// ----- 쇼핑몰 년간 월-매출 현황 ----- //
var chartSalesMonth = c3.generate({
    bindto: '#chartSalesMonth',
    data: {
        x: '월',
        // 작년 쇼핑몰 매출 현황
        columns: [
            ['월', 1, 2, 3, 4 ,5 ,6 ,7 ,8 ,9 ,10 ,11, 12],
            ['합계', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['무통장', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['가상계좌', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['계좌이체', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['카드', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['간편결제', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['카카오페이', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['휴대폰', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['쿠폰', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
            ['포인트', ],
            ['취소', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
        ],
        types: {
            합계: 'bar',
            취소: 'bar'
        }
    },
    color: {
        pattern: ['#63B5F5', '#DE2600', '#E08200', '#669400', '#7347CF', '#8C6130', '#C2175C', '#171C29', '#FF2900', '#AA2929']
    },
    bar: {
        width: {
            ratio: 0.5
        }
    },
    axis: {
        x: {
            label: {
                text: '년간 (단위: 월)',
                position: 'outer-center'
            }
        },
        y: {
            tick: {
                format: d3.format(",")
            },
            label: {
                text: '매출 (단위: 원)',
                position: 'outer-middle'
            }
        }
    }
});

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(무통장)
            ['무통장', <?php for($i=1; $i<=12; $i++) { echo $receiptbank[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 1000);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(가상계좌)
            ['가상계좌', <?php for($i=1; $i<=12; $i++) { echo $receiptvbank[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 1200);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(계좌이체)
            ['계좌이체', <?php for($i=1; $i<=12; $i++) { echo $receiptiche[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 1400);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(카드입금)
            ['카드', <?php for($i=1; $i<=12; $i++) { echo $receiptcard[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 1600);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(PAYNOW 외)
            ['간편결제', <?php for($i=1; $i<=12; $i++) { echo $receipteasy[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 1800);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(KAKAOPAY)
            ['카카오페이', <?php for($i=1; $i<=12; $i++) { echo $receiptkakao[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 2000);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(휴대폰)
            ['휴대폰', <?php for($i=1; $i<=12; $i++) { echo $receipthp[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 2200);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(쿠폰)
            ['쿠폰', <?php for($i=1; $i<=12; $i++) { echo $ordercoupon[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 2400);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(포인트)
            ['포인트', <?php for($i=1; $i<=12; $i++) { echo $receiptpoint[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 2600);

setTimeout(function () {
    chartSalesMonth.load({
        columns: [
            // 올해 쇼핑몰 매출 현황(주문취소)
            ['취소', <?php for($i=1; $i<=12; $i++) { echo $ordercancel[$i]; if($i!='12') echo ','; } ?>]
        ]
    });
}, 2800);

setTimeout(function () {
    chartSalesMonth.load({
        // 올해 쇼핑몰 매출 현황(주문합계)
        columns: [
            ['합계', <?php for($i=1; $i<=12; $i++) { echo $tot[$i]['orderprice']; if($i!='12') echo ','; } ?>]
        ]
    });
}, 3000);
<?php } ?>
</script>