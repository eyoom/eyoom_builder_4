<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/theme_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'theme_list';
$g5_title = '테마관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-theme-manager">
    <div class="adm-headline">
        <h3>테마 리스트</h3>
    </div>

    <form name="fthemeform" method="post" action="<?php echo $theme_action_url; ?>" class="eyoom-form">
    <input type="hidden" name="w" id="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="">
    <input type="hidden" name="shop_theme" id="shop_theme" value="">
    <input type="hidden" name="back_theme" id="back_theme" value="<?php echo $this_theme; ?>">
    <input type="hidden" name="back_pid" id="back_pid" value="<?php echo $pid; ?>">
    <input type="hidden" name="page" id="page" value="<?php echo $page; ?>">
    <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $_GET['bo_table']; ?>">

    <div class="cont-text-bg m-b-20">
        <p class="bg-info"><strong>테마 매니저</strong> (보유중인 테마 리스트입니다.)</p>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>테마명</th>
                        <th>홈페이지테마적용</th>
                        <?php if ($is_youngcart) { ?>
                        <th>쇼핑몰테마적용</th>
                        <?php } ?>
                        <th>기본설정</th>
                        <th>홈페이지메뉴</th>
                        <?php if ($is_youngcart) { ?>
                        <th>쇼핑몰메뉴</th>
                        <?php } ?>
                        <th>EB슬라이더</th>
                        <th>EB콘텐츠</th>
                        <?php if ($is_youngcart) { ?>
                        <th>EB상품추출</th>
                        <?php } ?>
                        <th>홈페이지</th>
                        <?php if ($is_youngcart) { ?>
                        <th>쇼핑몰</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tlist as $li) { ?>
                    <tr>
                        <th>
                            <strong><?php echo $li['theme_name']; ?> <?php echo $li['theme_alias'] ? '('. $li['theme_alias'].')':'';?></strong>
                        </th>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href="javascript:void(0);" data-theme="<?php echo $li['theme_name']; ?>" class="set_theme"><?php if ($li['theme_name'] == $theme) { ?><i class="fas fa-check m-r-7"></i><strong class="text-crimson">적용중</strong><?php } else { ?><u>적용하기</u><?php } ?></a><?php } else { ?><a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=theme_form&amp;thema=<?php echo $li['theme_name']; ?>&amp;wmode=1" onclick="theme_modal(this.href, '테마설치'); return false;" class="btn-e btn-e-xs btn-e-crimson">테마설치하기</a><?php } ?>
                        </td>
                        <?php if ($is_youngcart) { ?>
                        <td class="text-center">
                            <?php if (defined('G5_USE_SHOP') && $li['shop_theme'] && $li['is_setup']) { ?><a href="javascript:void(0);" data-theme="<?php echo $li['theme_name']; ?>" class="set_shop_theme"><?php if ($li['theme_name'] == $shop_theme || $li['is_shopping_theme']) { ?><i class="fas fa-check m-r-7"></i><strong class="text-crimson">적용중</strong><?php } else { ?><u>적용하기</u><?php } ?></a><?php } ?>
                        </td>
                        <?php } ?>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=config_form&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '110') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '300') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <?php if ($is_youngcart) { ?>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=shopmenu_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '400') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <?php } ?>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '600') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '610') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <?php if ($is_youngcart) { ?>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '500') { ?><i class='fas fa-check m-r-7'></i><strong class='text-crimson'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>
                        </td>
                        <?php } ?>
                        <td class="text-center">
                            <?php if ($li['is_setup']) { ?><a href='<?php echo G5_URL; ?>/?theme=<?php if ($li['theme_alias']) { ?><?php echo $li['theme_alias']; ?><?php } else { ?><?php echo $li['theme_name']; ?><?php } ?>' target='_blank'><u>미리보기</u></a><?php } ?>
                        </td>
                        <?php if ($is_youngcart) { ?>
                        <td class="text-center">
                            <?php if (defined('G5_USE_SHOP') && $li['shop_theme'] && $li['is_setup']) { ?><a href='<?php echo G5_SHOP_URL; ?>/?shop_theme=<?php if ($li['theme_alias']) { ?><?php echo $li['theme_alias']; ?><?php } else { ?><?php echo $li['theme_name']; ?><?php } ?>' target='_blank'><u>미리보기</u></a><?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    </form>
</div>

<div class="modal fade theme-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">테마 매니저</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="theme-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
function theme_modal(href, title) {
    $('.theme-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#theme-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.theme-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#theme-iframe").attr("src", href);
        $('#theme-iframe').height(700);
        $('html').css({overflow: 'hidden'});
    });
    $("#modal-title").text(title);
    return false;
}

$(function() {
    $(".set_theme").click(function() {
        var theme = $(this).attr('data-theme');
        set_theme(theme, 'c');
    });

    $(".set_shop_theme").click(function() {
        var theme = $(this).attr('data-theme');
        set_theme(theme, 's');
    });
});

function set_theme(theme,type) {
    $("#mode").val('theme');
    switch(type) {
        case 'c':
            Swal.fire({
                title: "홈페이지 적용",
                html: "정말로 [<strong class='text-crimson'>" + theme + "</strong>]테마를 홈페이지 홈으로 사용하시겠습니까?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#00897b",
                confirmButtonText: "확인",
                cancelButtonText: "취소"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#theme").val(theme);
                    document.fthemeform.submit();
                } else {
                    return;
                }
            });
            break;
        case 's':
            Swal.fire({
                title: "쇼핑몰 적용",
                html: "정말로 [<strong class='text-crimson'>" + theme + "</strong>]테마를 쇼핑몰 홈으로 사용하시겠습니까?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#00897b",
                confirmButtonText: "확인",
                cancelButtonText: "취소"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#shop_theme").val(theme);
                    document.fthemeform.submit();
                } else {
                    return;
                }
            });
            break;
    }
}
</script>