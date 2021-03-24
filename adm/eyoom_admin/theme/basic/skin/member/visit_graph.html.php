<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/visit_graph.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/c3/c3.min.css" type="text/css" media="screen">',0);
?>

<style>
.chart-wrap .chart-item {position:relative;float:left;width:50%}
.chart-wrap .chart-item .btn-group .dropdown-menu {left:inherit;right:0}
.chart-wrap .chart-item.item-left {padding-right:10px}
.chart-wrap .chart-item.item-right {padding-left:10px}
.chart-wrap .chart-item-in {position:relative;overflow:hidden;width:100%;height:auto;border:1px solid #d5d5d5;padding:10px 0;background:#fff}
.chart-wrap .chart-item-in.padding-left-10 {padding-left:10px}
.chart-wrap .chart-item-in.padding-right-10 {padding-right:10px}
.chart-wrap .chart-item-in.padding-x-10 {padding-left:10px;padding-right:10px}
@media (max-width: 767px) {
    .chart-wrap .chart-item {position:relative;float:left;width:100%;margin-bottom:30px}
    .chart-wrap .chart-item.item-left {padding-right:0}
    .chart-wrap .chart-item.item-right {padding-left:0}
}
</style>

<div class="admin-visit-list">
    <div class="adm-headline">
        <h3>접속자별 그래프 집계</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/visit.sub.html.php'); ?>

    <div class="chart-wrap">
        <!--{* ------------- 오늘의 시간별 접속자, 회원가입 시작 ------------- *}-->
        <div class="chart-item item-left">
            <div class="main-headline">
                <h5><strong>시간별 접속자</strong></h5>
                <div class="clearfix"></div>
            </div>
            <div class="chart-item-in">
                <div class="chart-canvas">
                    <div id="chartTime"></div>
                </div>
            </div>
        </div>
        <!--{* 오늘의 시간별 접속자, 회원가입 끝 *}-->

        <!--{* ------------- 오늘의 브라우저별 접속자 비율 시작 ------------- *}-->
        <div class="chart-item item-right">
            <div class="main-headline">
                <h5><strong>브라우저별 접속자 비율</strong></h5>
                <div class="clearfix"></div>
            </div>
            <div class="chart-item-in">
                <div class="chart-canvas">
                    <div id="chartBrowser"></div>
                </div>
            </div>
        </div>
        <!--{* 오늘의 브라우저별 접속자 비율 끝 *}-->
        <div class="clearfix"></div>
        <div class="margin-bottom-30 hidden-xs"></div>
    </div>

    <div class="margin-bottom-20"></div>

    <div class="chart-wrap">
        <!--{* ------------- 도메인별 접속자 시작 ------------- *}-->
        <div class="chart-item item-left">
            <div class="main-headline">
                <h5><strong>도메인별 접속자 비율</strong></h5>
                <div class="clearfix"></div>
            </div>
            <div class="chart-item-in">
                <div class="chart-canvas">
                    <div id="chartDomain"></div>
                </div>
            </div>
        </div>
        <!--{* 도메인별 접속자 끝 *}-->

        <!--{* ------------- OS별 접속자 비율 시작 ------------- *}-->
        <div class="chart-item item-right">
            <div class="main-headline">
                <h5><strong>OS별 접속자 비율</strong></h5>
                <div class="clearfix"></div>
            </div>
            <div class="chart-item-in">
                <div class="chart-canvas">
                    <div id="chartOS"></div>
                </div>
            </div>
        </div>
        <!--{* OS별 접속자 비율 끝 *}-->
        <div class="clearfix"></div>
        <div class="margin-bottom-30 hidden-xs"></div>
    </div>

    <div class="margin-bottom-20"></div>

</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/d3/d3.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/c3/c3.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>

<script>
/*--------------------------------------
    Chart
--------------------------------------*/
// ----- 시간별 접속자, 회원가입 ----- //
var chartTime = c3.generate({
    bindto: '#chartTime',
    data: {
        x: '시간',
        columns: [
            ['시간', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
            // 어제의 시간별 접속자
            ['접속자', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ],
        types: {
            접속자: 'bar'
        }
    },
    color: {
        pattern: ['#007AFF']
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
        }
    }
});

setTimeout(function() {
    chartTime.load({
        columns: [
            // 오늘의 시간별 접속자
            ['접속자', <?php for($i=0; $i<count((array)$period_vi_count); $i++) { echo $period_vi_count[$i]; if(count((array)$period_vi_count)!=($i+1)) echo ','; } ?>]
        ]
    });
}, 1500);

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

setTimeout(function() {
    chartBrowser.load({
        // 오늘의 브라우저별 접속자
        columns: [
            <?php $i=0; if (is_array($period_vi_browser)) { foreach ($period_vi_browser as $key => $val) { ?>
            ['<?php echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$period_vi_browser) != ($i+1)) echo ','; $i++; ?>
            <?php }} ?>
        ]
    });
}, 1500);

// ----- 도메인별 접속자 ----- //
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

setTimeout(function() {
    chartDomain.load({
        // 도메인별 접속자
        columns: [
            <?php $i=0; if (is_array($period_vi_domain)) { foreach ($period_vi_domain as $key => $val) { ?>
            <?php if ($i<10) { ?>
            ['<?php echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$period_vi_domain) != ($i+1)) echo ','; ?>
            <?php } ?>
            <?php }} ?>
        ]
    });
}, 1500);

// ----- OS 접속자 비율 ----- //
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

setTimeout(function() {
    chartOS.load({
        // 도메인별 접속자
        columns: [
            <?php $i=0; if (is_array($period_vi_os)) { foreach ($period_vi_os as $key => $val) { ?>
            ['<?php if (!$key) echo '기타'; else echo $key; ?>', <?php echo $val; ?>]<?php if (count((array)$period_vi_os) != ($i+1)) echo ','; ?>
            <?php }} ?>
        ]
    });
}, 1500);

</script>