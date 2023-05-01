<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebbanner_itemhit.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-bannerhit-list">
    <div class="adm-headline">
        <h3>조회수 집계</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/ebbanner_itemhit.sub.html.php'); ?>

    <div class="f-s-13r m-b-5">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>총조회수 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>IP</th>
                        <th>접속경로</th>
                        <th>일시</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$cnt; $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['bh_ip']; ?></th>
                        <td><?php echo $list[$i]['link']; ?><?php echo $list[$i]['title']; ?><?php echo $list[$i]['link2']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bh_date'] . ' ' . $list[$i]['bh_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($cnt == 0) { ?>
                    <tr>
                        <td colspan="11" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>