<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/point.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.point-list {position:relative;overflow:hidden;padding:5px}
.point-list .win-title {position:relative;margin:0 0 20px;font-size:18px}
.point-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.point-list .table-list-eb .table tbody > tr > td {padding:10px 5px}
.point-list .table-list-eb .table tfoot > tr > th {padding:10px 5px}
.point-list .table-list-eb .table tfoot > tr > td {padding:10px 5px}
.point-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.point-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.point-list .table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:5px !important;font-size:10px;color:#959595;background:#fbfbfb}
.point-list .table-list-eb .td-mobile td span {margin-right:5px}
.point-list .table-list-eb .tfoot-td-mobile td {border-top:1px solid #ddd;padding:8px 5px !important;font-size:13px;color:#000;background:#f4f4f4}
.point-list .table-list-eb .tfoot-td-mobile td span {margin-right:5px;font-weight:bold}
.point-list .table-list-eb .th-width-140 {width:140px}
<?php if (G5_IS_MOBILE) { ?>
.point-list {padding:20px 15px}
.point-list .win-title {height:50px;line-height:30px;padding:10px;background:#555;color:#fff}
.point-list .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff;float:right}
<?php } ?>
</style>

<div class="point-list">
    <h4 class="win-title">
        <strong><?php echo $g5['title']; ?></strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" onclick="window.close();" class="win-close-btn"><i class="fas fa-times"></i></button>
        <div class="clearfix"></div>
        <?php } ?>
    </h4>
    <div class="table-list-eb">
        <div class="board-list-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="th-width-140">일시</th>
                        <th>내용</th>
                        <th class="hidden-xs">만료일</th>
                        <th class="hidden-xs">지급<?php echo $levelset['gnu_name']; ?></th>
                        <th class="hidden-xs">사용<?php echo $levelset['gnu_name']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td><?php echo substr($list[$i]['po_datetime'],0,16); ?></td>
                        <td><?php echo $list[$i]['po_content']; ?></td>
                        <td class="text-center hidden-xs">
                        <?php if ($list[$i]['po_expired'] == 1) { ?>
                            만료 <?php echo substr(str_replace('-','',$list[$i]['po_expire_date']),2); ?>
                        <?php } else { ?>
                            <?php if ($list[$i]['po_expire_date'] == '9999-12-31') { ?>-<?php } else { ?><?php echo $list[$i]['po_expire_date']; ?><?php } ?>
                        <?php } ?>
                        </td>
                        <td class="text-right hidden-xs"><?php echo $list[$i]['point1']; ?></td>
                        <td class="text-right hidden-xs"><?php echo $list[$i]['point2']; ?></td>
                    </tr>
                    <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-right">
                            <span>
                            <?php if ($list[$i]['po_expired'] == 1) { ?>
                                만료 <?php echo substr(str_replace('-','',$list[$i]['po_expire_date']),2); ?>
                            <?php } else { ?>
                                <?php if ($list[$i]['po_expire_date'] == '9999-12-31') { ?>-<?php } else { ?><?php echo $list[$i]['po_expire_date']; ?><?php } ?>
                            <?php } ?>
                            </span>
                            <span>[지급] <?php echo $list[$i]['point1']; ?></span>
                            <span>[사용] <?php echo $list[$i]['point2']; ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="hidden-xs">
                        <th colspan="3" class="hidden-xs"><strong>소계</strong></th>
                        <td class="text-right"><strong class="color-green"><?php echo $sum_point1; ?></strong></td>
                        <td class="text-right"><strong class="color-yellow"><?php echo $sum_point2; ?></strong></td>
                    </tr>
                    <tr class="tfoot-td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-right">
                            <span>[지급소계] <strong class="color-red"><?php echo $sum_point1; ?></strong></span>
                            <span>[사용소계] <strong class="color-red"><?php echo $sum_point2; ?></strong></span>
                        </td>
                    </tr>
                    <tr class="hidden-xs">
                        <th colspan="3"><strong class="color-red">보유<?php echo $levelset['gnu_name']; ?></strong></th>
                        <td colspan="2" class="text-right"><strong class="color-red"><?php echo number_format($member['mb_point']); ?></strong></td>
                    </tr>
                    <tr class="tfoot-td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-right"><span>[보유포인트] <strong class="color-red"><?php echo number_format($member['mb_point']); ?></strong></span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center margin-top-30 margin-bottom-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xlg btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/respond.min.js"></script>
    <script src="<?php echo EYOOM_THEME_URL; ?>/plugins/html5shiv.min.js"></script>
<![endif]-->