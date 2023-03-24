<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/visit_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'visit_list';
$g5_title = '접속자집계';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$g5_subtitle = '접속자';
?>

<div class="admin-visit-list">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/visit.sub.html.php'); ?>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>IP</th>
                        <th>접속경로</th>
                        <th>브라우저</th>
                        <th>OS</th>
                        <?php if ($device_view == true) { ?>
                        <th>접속기기</th>
                        <?php } ?>
                        <th>일시</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th><?php echo $list[$i]['ip']; ?></th>
                        <td><?php echo $list[$i]['link']; ?><?php echo $list[$i]['title']; ?><?php echo $list[$i]['link2']; ?></td>
                        <td><?php echo $list[$i]['brow']; ?></td>
                        <td><?php echo $list[$i]['os']; ?></td>
                        <?php if ($device_view == true) { ?>
                        <td><?php echo $list[$i]['device']; ?></td>
                        <?php } ?>
                        <td><?php echo $list[$i]['vi_date'] . ' ' . $list[$i]['vi_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="<?php if ($device_view == true) { ?>6<?php } else { ?>5<?php } ?>" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>