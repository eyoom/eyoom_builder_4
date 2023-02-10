<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/tail.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<?php if (!$wmode) { ?>
    </div>
    <div class="eb-sidebar-right">
        <ul class="nav nav-tabs sidebar-tabs">
            <li class="active">
                <a href="#sidebar_tab_qna" data-toggle="tab"><i class="fas fa-comment-alt"></i></a>
            </li>
            <li>
                <a href="#sidebar_tab_member" data-toggle="tab"><i class="fas fa-user-circle"></i></a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="sidebar_tab_qna" class="tab-pane active">
                <?php /* ------------- 캘린더 시작 ------------- */?>
                <h6 class="eb-sidebar-right-title">CALENDAR</h6>
                <div class="sidebar-datepicker">
                    <div id="sidebar_carlendar"></div>
                </div>
                <?php /* 캘린더 끝 */?>

                <?php if ($is_youngcart) { // ------------- 상품문의 시작 -------------?>
                <h6 class="eb-sidebar-right-title">
                    상품문의
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemqalist" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-latest">
                    <?php for ($i=0; $i<count((array)$item_qa); $i++) { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemqaform&amp;iq_id=<?php echo $item_qa[$i]['iq_id']; ?>" class="eb-sidebar-latest-link <?php if (!$item_qa[$i]['is_answer'] == '') { ?>sidebar-latest-no-answer<?php } ?>">
                        <div class="sidebar-latest-member-img">
                            <?php if (!$item_qa[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $item_qa[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-latest-cont">
                            <p class="ellipsis"><?php echo conv_subject($item_qa[$i]['iq_subject'], 40); ?></p>
                            <p class="ellipsis"><span><?php echo $item_qa[$i]['name']; ?></span><span><i class="far fa-clock-o"></i> 2018.01.09</span></p>
                        </div>
                        <?php if (!$item_qa[$i]['is_answer'] == '') { ?>
                        <span class="latest-status-indicator"></span>
                        <?php } ?>
                    </a>
                    <?php } ?>
                    <?php if (count((array)$item_qa) == 0) { ?>
                    <p class="sidebar-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 문의글이 없습니다.</p>                 <?php } ?>
                </div>
                <?php } // 상품문의 끝 ?>

                <?php if ($is_youngcart) { // ------------- 사용후기 시작 -------------?>
                <h6 class="eb-sidebar-right-title">
                    사용후기
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&pid=itemuselist" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-latest">
                    <?php for ($i=0; $i<count($item_use); $i++) { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shop&amp;pid=itemuseform&amp;is_id=<?php echo $item_use[$i]['is_id']; ?>&amp;w=u" class="eb-sidebar-latest-link sidebar-latest-no-answer">
                        <div class="sidebar-latest-member-img">
                            <?php if (!$item_use[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $item_use[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-latest-cont">
                            <p class="ellipsis"><?php echo conv_subject($item_use[$i]['is_subject'], 40); ?></p>
                            <p class="ellipsis"><span><?php echo $item_use[$i]['name']; ?></span><span><i class="far fa-clock-o"></i> 2018.01.09</span></p>
                        </div>
                        <span class="latest-status-indicator"></span>
                    </a>
                    <?php } ?>
                    <?php if (count((array)$item_use) == 0) { ?>
                    <p class="sidebar-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 후기글이 없습니다.</p>
                    <?php } ?>
                </div>
                <?php } // 사용후기 끝 ?>

                <?php /* ------------- 1:1 문의 시작 ------------- */?>
                <h6 class="eb-sidebar-right-title">
                    1:1 문의
                    <a href="<?php echo G5_BBS_URL; ?>/qalist.php" target="_blank" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-latest">
                    <?php for ($i=0; $i<count((array)$qa_conts); $i++) { ?>
                    <a href="<?php echo G5_BBS_URL; ?>/qaview.php?qa_id=<?php echo $qa_conts[$i]['qa_id']; ?>" class="eb-sidebar-latest-link <?php if (!$qa_conts[$i]['qa_status']) { ?>sidebar-latest-no-answer<?php } ?>">
                        <div class="sidebar-latest-member-img">
                            <?php if (!$qa_conts[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $qa_conts[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-latest-cont">
                            <p class="ellipsis"><?php echo conv_subject($qa_conts[$i]['qa_subject'], 40); ?></p>
                            <p class="ellipsis"><span>이윰MOUNT</span><span><i class="far fa-clock-o"></i> 2018.01.09</span></p>
                        </div>
                        <?php if (!$qa_conts[$i]['qa_status']) { ?>
                        <span class="latest-status-indicator"></span>
                        <?php } ?>
                    </a>
                    <?php } ?>
                    <?php if (count((array)$qa_conts) == 0) { ?>
                    <p class="sidebar-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 문의글이 없습니다.</p>
                    <?php } ?>
                </div>
                <?php /* 1:1 문의 끝 */?>

                <?php /* ------------- 최근 게시물 시작 ------------- */?>
                <h6 class="eb-sidebar-right-title">
                    최근 게시물
                    <a href="<?php echo G5_BBS_URL; ?>/new.php" target="_blank" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-latest">
                    <?php for($i=0; $i<count((array)$new_post); $i++) { ?>
                    <a href="<?php echo $new_post[$i]['view_url']; ?>" target="_blank" class="eb-sidebar-latest-link">
                        <div class="sidebar-latest-member-img">
                            <?php if (!$new_post[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $new_post[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-latest-cont">
                            <p class="ellipsis"><?php echo $new_post[$i]['subject']; ?></p>
                            <p class="ellipsis"><span><?php echo $new_post[$i]['name']; ?></span><span><i class="far fa-clock-o"></i> <?php echo $eb->date_format('Y-m-d', $new_post[$i]['datetime']); ?></span></p>
                        </div>
                    </a>
                    <?php } ?>
                    <?php if (count((array)$new_post) == 0) { ?>
                    <p class="sidebar-latest-none"><i class="fas fa-exclamation-circle"></i> 출력할 게시글이 없습니다.</p>
                    <?php } ?>
                </div>
                <?php /* 최근 게시물 끝 */?>
                <br><br>
            </div>
            <div id="sidebar_tab_member" class="tab-pane">
                <?php /* ------------- 신규가입 회원 시작 ------------- */?>
                <h6 class="eb-sidebar-right-title">
                    신규가입 회원
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_list" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-member">
                    <?php for($i=0; $i<count((array)$new_member); $i++) { ?>
                    <div class="eb-sidebar-member-item">
                        <div class="sidebar-member-img" title="이름: <?php echo get_text($new_member[$i]['mb_name']); ?>">
                            <?php if (!$new_member[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $new_member[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-member-cont">
                            <p class="member-id-nick ellipsis">
                                <span>ID: <?php echo $new_member[$i]['mb_id']; ?></span>
                                <span>닉: <?php echo $new_member[$i]['mb_nick']; ?></span>
                            </p>
                            <p class="ellipsis">
                                <span><i class="far fa-clock-o"></i> <?php echo substr($new_member[$i]['mb_datetime'],0,-3); ?></span>
                                <span><?php echo number_format($new_member[$i]['mb_point']); ?>p</span>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (count((array)$new_member) == 0) { ?>
                    <p class="sidebar-member-none"><i class="fas fa-exclamation-circle"></i> 출력할 자료가 없습니다.</p>
                    <?php } ?>
                </div>
                <?php /* 신규가입 회원 끝 */?>

                <?php /* ------------- 포인트 발생내역 시작 ------------- */?>
                <h6 class="eb-sidebar-right-title">
                    포인트 발생내역
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=point_list" class="sidebar-right-btn">전체보기 <i class="fas fa-plus"></i></a>
                </h6>
                <div class="eb-sidebar-member">
                    <?php for($i=0; $i<count((array)$new_point); $i++) { ?>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=point_list&amp;sfl=mb_id&amp;stx=<?php echo $new_point[$i]['mb_id']; ?>" title="ID: <?php echo $new_point[$i]['mb_id']; ?> 이름: <?php echo $new_point[$i]['mb_name']; ?>" class="eb-sidebar-member-item">
                        <div class="sidebar-member-img">
                            <?php if (!$new_point[$i]['mb_photo']) { ?>
                            <i class="fas fa-user-circle"></i>
                            <?php } else { ?>
                            <?php echo $new_point[$i]['mb_photo']; ?>
                            <?php } ?>
                        </div>
                        <div class="sidebar-member-cont">
                            <p class="member-point-cont ellipsis">
                                <?php echo $new_point[$i]['po_content']; ?>
                            </p>
                            <p class="ellipsis">
                                <span class="member-point-nick"><?php echo $new_point[$i]['mb_nick']; ?></span>
                                <span><i class="far fa-clock-o"></i> <?php echo $new_point[$i]['po_datetime']; ?></span>
                            </p>
                            <p>
                                <span><strong><?php echo number_format($new_point[$i]['po_point']); ?>p</strong></span>
                                <span>포인트합: <?php echo number_format($new_point[$i]['po_mb_point']); ?>p</span>
                            </p>
                        </div>
                    </a>
                    <?php } ?>
                    <?php if (count((array)$new_point) == 0) { ?>
                    <p class="sidebar-member-none"><i class="fas fa-exclamation-circle"></i> 출력할 자료가 없습니다.</p>
                    <?php } ?>
                </div>
                <?php /* 포인트 발생내역 끝 */?>
                <br><br>
            </div>
        </div>
    </div>
    <div class="eb-sidebar-mask"></div>
    <div class="back-to-top">
        <i class="fas fa-angle-up"></i>
    </div>
</div>
<?php } ?>

<script>var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";</script>
<script src="<?php echo G5_ADMIN_URL; ?>/admin.js?ver=<?php echo G5_JS_VER; ?>"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/screenfull/screenfull.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/waves/waves.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/app.js"></script>
<script>
$(document).ready(function() {
    App.init();

    <?php if (!$wmode) { ?>
    new PerfectScrollbar('#sidebar_left_scroll');
    new PerfectScrollbar('#sidebar_tab_qna');
    new PerfectScrollbar('#sidebar_tab_member');
    <?php } ?>

    <?php if ($config['cf_editor'] == 'smarteditor2') { ?>
    // 만일 smarteditor를 사용할 경우, 단축키 버튼 숨기기
    $('.cke_sc').hide();
    <?php } ?>
});
</script>
<?php if ($sub_menu) { ?>
<script>
$(function() {
    var submenu_id = 'submenu_<?php echo $sub_menu; ?>';
    $("#"+submenu_id).addClass('active');
});
</script>
<?php } ?>
<!--[if lt IE 9]>
    <script src="../plugins/respond.min.js"></script>
    <script src="../plugins/html5shiv.min.js"></script>
    <script src="../plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->

<?php
include_once(EYOOM_ADMIN_THEME_PATH . '/admin.tail_sub.html.php');
?>