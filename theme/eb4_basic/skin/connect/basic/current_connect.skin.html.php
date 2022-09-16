<?php
/**
 * skin file : /theme/THEME_NAME/skin/connect/basic/current_connect.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.current-connect {font-size:.9375rem}
.current-connect .table-list-eb .td-location {white-space:normal;word-break:break-all;}
.current-connect .table-list-eb .td-mobile td {padding-top:0;color:#959595;white-space:normal;word-break:break-all;}
.current-connect .table-list-eb .td-mobile td a {color:#959595}
.current-connect .connect-nameview {color:#3949ab !important}
.current-connect .connect-nameview .sv_wrap > a {color:#3949ab}
.current-connect .connect-nameview .sv_wrap .profile_img {display:none}
.current-connect .connect-nameview .sv_wrap .sv {text-align:left;color:#151515}
.current-connect .connect-url:hover {color:#000;text-decoration:underline}
@media (max-width:767px) {
    .current-connect .table-list-eb table {white-space:inherit}
    .current-connect .table-list-eb .td-mlt td {border-bottom:0}
    .current-connect .table-list-eb .td-num {font-weight:700}
}
</style>

<div class="current-connect">
    <div class="table-list-eb">
        <div class="board-list-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-start">번호</th>
                        <th>접속자 (IP)</th>
                        <th class="hidden-xs">위치</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr class="td-mlt">
                        <td class="td-num text-start"><?php echo $list[$i]['num']; ?></td>
                        <td class="text-center">
                            <?php if ($list[$i]['mb_id']) { ?>
                            <span class="connect-nameview"><?php echo eb_nameview($eyoom['nameview_skin'], $list[$i]['mb_nick'], $list[$i]['mb_id'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?></span>
                            <?php } else { ?>
                            <span><?php echo $list[$i]['name']; ?></span>
                            <?php } ?>
                        </td>
                        <td class="hidden-xs td-location">
                            <?php if ($list[$i]['lo_url'] && $is_admin == 'super') { ?>
                            <a href="<?php echo $list[$i]['lo_url']; ?>" class="connect-url"><?php echo $list[$i]['lo_location']; ?></a>
                            <?php } else { ?>
                            <?php echo $list[$i]['lo_location']; ?>
                            <?php } ?>
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
                    <tr><td colspan="3" class="text-center"><span class="text-gray"><i class="fas fa-exclamation-circle"></i> 현재 접속자가 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>