<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/visit_browser.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'visit_list';
$g5_title = '접속자집계';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$g5_subtitle = '브라우저';
?>

<div class="admin-visit-browser">
    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/member/visit.sub.html.php'); ?>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-50px">순위</th>
                        <th>브라우저</th>
                        <th>그래프</th>
                        <th>접속자수</th>
                        <th>비율</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['no']; ?></th>
                        <td><?php echo $list[$i]['link']; ?><?php echo $list[$i]['key']; ?><?php echo $list[$i]['link2']; ?></td>
                        <td>
                            <div class="progress m-b-0" style="height:20px;">
                                <div class="progress-bar bg-indigo" role="progressbar" style="width:<?php echo $list[$i]['s_rate']; ?>%" aria-valuenow="<?php echo $list[$i]['s_rate']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td><?php echo $list[$i]['count']; ?></td>
                        <td><?php echo $list[$i]['s_rate']; ?>%</td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>