<?php
/**
 * skin file : /theme/THEME_NAME/skin/connect/basic/current_connect.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.current-connect .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:left;padding:10px 5px}
.current-connect .table-list-eb .table tbody > tr > td {border-top:1px solid #ededed;padding:7px 5px}
.current-connect .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.current-connect .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.current-connect .table-list-eb td {font-size:12px}
.current-connect .table-list-eb .table tbody > tr.td-mobile > td {border-top:1px solid #fff;padding:0 0 5px !important;font-size:11px;color:#959595;text-align:right}
.current-connect .table-list-eb .td-mobile td {position:relative}
</style>

<div class="current-connect">
    <div class="table-list-eb">
        <div class="board-list-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="th-num">번호</th>
                        <th>이름</th>
                        <th class="hidden-xs">위치</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-left"><?php echo $list[$i]['num']; ?></td>
                        <td><?php if ($list[$i]['mb_id']) { echo eb_nameview($eyoom['nameview_skin'], $list[$i]['mb_id'], $list[$i]['mb_nick'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); } else { echo $list[$i]['name']; } ?></td>
                        <td class="td-width hidden-xs">
                            <div class="td-location">
                                <?php if ($list[$i]['lo_url'] && $is_admin == 'super') { ?>
                                <a href="<?php echo $list[$i]['lo_url']; ?>"><?php echo $list[$i]['lo_location']; ?></a>
                                <?php } else { ?>
                                <?php echo $list[$i]['lo_location']; ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr class="td-mobile visible-xs">
                        <td colspan="2">
                            <?php if ($list[$i]['lo_url'] && $is_admin == 'super') { ?>
                            <a href="<?php echo $list[$i]['lo_url']; ?>"><?php echo $list[$i]['lo_location']; ?></a>
                            <?php } else { ?>
                            <?php echo $list[$i]['lo_location']; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr><td colspan="3" class="text-center"><span class="color-grey"><i class="fa fa-exclamation-circle"></i> 현재 접속자가 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>