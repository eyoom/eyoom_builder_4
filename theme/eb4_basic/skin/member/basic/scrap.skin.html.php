<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/scrap.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/fontawesome5/css/fontawesome-all.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/common.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/style.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/css/custom.css" type="text/css" media="screen">',0);
?>

<style>
.scrap-list {position:relative;overflow:hidden;padding:5px}
.scrap-list .win-title {position:relative;margin:0 0 20px;font-size:18px}
.scrap-list .scrap-hidden-lg {display:none}
@media (max-width: 540px) {
    .scrap-list .scrap-hidden-sm {display:none}
    .scrap-list .scrap-hidden-lg {display:table-row !important}
}
.scrap-list .table-list-eb .td-subject {width:280px}
@media (max-width: 540px) {
    .scrap-list .table-list-eb .td-width {width:inherit}
    .scrap-list .table-list-eb .td-subject {width:280px}
}
.scrap-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.scrap-list .table-list-eb .table tbody > tr > td {padding:10px 5px}
.scrap-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.scrap-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.scrap-list .table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:5px !important;font-size:11px;color:#959595}
.scrap-list .table-list-eb .td-mobile td span {margin-right:5px}
<?php if (G5_IS_MOBILE) { ?>
.scrap-list {padding:20px 15px}
.scrap-list .win-title {height:50px;line-height:30px;padding:10px;background:#555;color:#fff}
.scrap-list .win-close-btn {position:absolute;top:10px;right:10px;width:30px;height:30px;line-height:30px;text-align:center;margin:0;padding:0;border:0;background:none;color:#fff;float:right}
<?php } ?>
</style>

<div class="scrap-list">
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
                        <th>번호</th>
                        <th>제목</th>
                        <th class="scrap-hidden-sm">게시판</th>
                        <th class="scrap-hidden-sm">보관일시</th>
                        <th class="scrap-hidden-sm">삭제</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-center"><?php echo $list[$i]['num']; ?></td>
                        <td class="td-width">
                            <div class="td-subject ellipsis">
                                <a href="<?php echo $list[$i]['opener_href_wr_id']; ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href_wr_id']; ?>'; return false;"><strong><?php echo $list[$i]['subject']; ?></strong></a>
                            </div>
                        </td>
                        <td class="text-center scrap-hidden-sm"><a href="<?php echo $list[$i]['opener_href']; ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href']; ?>'; return false;"><?php echo $list[$i]['bo_subject']; ?></a></td>
                        <td class="text-center scrap-hidden-sm"><?php echo $list[$i]['ms_datetime']; ?></td>
                        <td class="text-center scrap-hidden-sm"><a href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;">삭제</a></td>
                    </tr>
                    <tr class="td-mobile scrap-hidden-lg"><?php /* 600px 이하에서만 보임 */ ?>
                        <td colspan="2">
                            <span><a href="<?php echo $list[$i]['opener_href']; ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href']; ?>'; return false;"><?php echo $list[$i]['bo_subject']; ?></a></span>
                            <span><i class="fa fa-clock-o color-grey"></i> <?php echo $list[$i]['ms_datetime']; ?></span>
                            <span class="pull-right"><a href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;">삭제</a></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>
                    <?php } ?>
                </tbody>
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