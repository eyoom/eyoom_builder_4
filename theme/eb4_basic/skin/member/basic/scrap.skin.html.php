<?php
/**
 * skin file : /theme/THEME_NAME/skin/member/basic/scrap.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.scrap-list {position:relative;overflow:hidden;padding:15px}
.scrap-list .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem}
.scrap-list .table-list-eb .width-70px {width:70px}
.scrap-list .table-list-eb .tr-num-subj {border-color:transparent}
.scrap-list .table-list-eb .tr-info td {padding-top:0}
.scrap-list .table-list-eb .tr-info td span {margin-left:7px;font-size:.8125rem}
</style>
<?php if (G5_IS_MOBILE) { ?>
<style>
.scrap-list {padding:15px}
.scrap-list .win-title {height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.scrap-list .btn-close {position:absolute;top:19px;right:10px}
</style>
<?php } ?>

<div class="scrap-list">
    <h4 class="win-title">
        <strong><?php echo $g5['title']; ?></strong>
        <?php if (G5_IS_MOBILE) { ?>
        <button type="button" class="btn-close btn-close-white" onclick="window.close();" aria-label="Close"></button>
        <?php } ?>
    </h4>
    <div class="table-list-eb">
        <div class="board-list-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="width-70px">번호</th>
                        <th>제목</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr class="tr-num-subj">
                        <td class="text-center"><?php echo $list[$i]['num']; ?></td>
                        <td>
                            <div class="td-subject ellipsis">
                                <a href="<?php echo $list[$i]['opener_href_wr_id']; ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href_wr_id']; ?>'; return false;"><strong><?php echo $list[$i]['subject']; ?></strong></a>
                            </div>
                        </td>
                    </tr>
                    <tr class="tr-info"><?php /* 600px 이하에서만 보임 */ ?>
                        <td colspan="2" class="text-end">
                            <span><a href="<?php echo $list[$i]['opener_href']; ?>" target="_blank" onclick="opener.document.location.href='<?php echo $list[$i]['opener_href']; ?>'; return false;"><?php echo $list[$i]['bo_subject']; ?></a></span>
                            <span><?php echo $list[$i]['ms_datetime']; ?></span>
                            <span><a href="<?php echo $list[$i]['del_href']; ?>" onclick="del(this.href); return false;">삭제</a></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr><td colspan="2" class="text-center">자료가 없습니다.</td></tr>
                    <?php } ?>
                </tbody>
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