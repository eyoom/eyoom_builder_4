<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/point.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.point-list {position:relative;overflow:hidden}
.point-list .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
.point-list .table-list-eb .tr-mobile td {padding-top:0}
.point-list .table-list-eb .tr-mobile td span {margin-right:5px}
.point-list .table-list-eb .tfoot-td-mobile td span {margin-left:10px;font-weight:700}
.point-list .table-list-eb .th-width-160 {width:160px}
@media (max-width:767px) {
    .point-list .table-list-eb .tr-fixing {border-color:transparent}
}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.point-list {padding:15px}
.point-list .win-title {height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.point-list .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="point-list">
    <h4 class="win-title">
        <strong><?php echo $g5['title']; ?></strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
        <?php } ?>
    </h4>
    <div class="table-list-eb">
        <div class="board-list-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th-width-160">일시</th>
                        <th>내용</th>
                        <th class="hidden-xs">만료일</th>
                        <th class="hidden-xs">지급<?php echo $levelset['gnu_name']; ?></th>
                        <th class="hidden-xs">사용<?php echo $levelset['gnu_name']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr class="tr-fixing">
                        <td><?php echo substr($list[$i]['po_datetime'],0,16); ?></td>
                        <td><?php echo $list[$i]['po_content']; ?></td>
                        <td class="text-center hidden-xs">
                        <?php if ($list[$i]['po_expired'] == 1) { ?>
                            만료 <?php echo substr(str_replace('-','',$list[$i]['po_expire_date']),2); ?>
                        <?php } else { ?>
                            <?php if ($list[$i]['po_expire_date'] == '9999-12-31') { ?>-<?php } else { ?><?php echo $list[$i]['po_expire_date']; ?><?php } ?>
                        <?php } ?>
                        </td>
                        <td class="text-center hidden-xs"><?php echo $list[$i]['point1']; ?></td>
                        <td class="text-center hidden-xs"><?php echo $list[$i]['point2']; ?></td>
                    </tr>
                    <tr class="tr-mobile visible-xs"><?php /* 991px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-end">
                            <span>
                            [만료일]
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
                    <tr><td colspan="5" class="text-center text-gray"><i class="fas fa-exclamation-circle"></i>자료가 없습니다.</td></tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr class="hidden-xs">
                        <th colspan="3" class="hidden-xs"><strong>소계</strong></th>
                        <td class="text-center"><strong class="text-teal"><?php echo $sum_point1; ?></strong></td>
                        <td class="text-center"><strong class="text-deep-orange"><?php echo $sum_point2; ?></strong></td>
                    </tr>
                    <tr class="tfoot-td-mobile visible-xs"><?php /* 991px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-end">
                            <span>[지급소계] <strong class="text-crimson"><?php echo $sum_point1; ?></strong></span>
                            <span>[사용소계] <strong class="text-crimson"><?php echo $sum_point2; ?></strong></span>
                        </td>
                    </tr>
                    <tr class="hidden-xs">
                        <th colspan="4"><strong class="text-crimson">보유<?php echo $levelset['gnu_name']; ?></strong></th>
                        <td colspan="1" class="text-center"><strong class="text-crimson"><?php echo number_format($member['mb_point']); ?></strong></td>
                    </tr>
                    <tr class="tfoot-td-mobile visible-xs"><?php /* 991px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-end"><span>[보유포인트] <strong class="text-crimson"><?php echo number_format($member['mb_point']); ?></strong></span></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    <?php if (G5_IS_MOBILE) { ?>
    <div class="text-center m-t-30 m-b-30">
        <button type="button" onclick="window.close();" class="btn-e btn-e-xl btn-e-dark">창닫기</button>
    </div>
    <?php } ?>
</div>