<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/theme_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-theme-manager .function-btns .btn-e-sm {margin-bottom:5px}
.admin-theme-manager .admin-divider {position:relative;height:1px;border-top:1px solid #c5c5c5;margin:40px 0}
.admin-theme-manager .admin-divider .divider-circle {position:absolute;top:-16px;left:50%;margin-left:-16px;width:32px;height:32px;border:2px solid #b5b5b5;background:#fff;text-align:center;line-height:28px;color:#959595;font-size:16px;z-index:1px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
@media (max-width:600px) {
    .admin-theme-manager .adm-headline .headline-btn {position:relative;top:inherit;right:inherit}
    .admin-theme-manager .adm-headline .headline-btn .btn-e {padding:2px 7px;font-size:11px}
}
</style>

<div class="admin-theme-manager">
    <div class="adm-headline adm-headline-btn">
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

    <div class="function-btns margin-bottom-20">

    </div>

    <div class="alert alert-primary">
        <p class="font-size-12"><strong>테마 매니저</strong> (보유중인 테마 리스트입니다.)</p>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="theme-list"></div>

    </form>
</div>

<div class="modal fade theme-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="themeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 id="themeModalLabel" class="modal-title"><strong><i class="fas fa-ellipsis-v color-grey"></i> <span id="modal-title">테마 매니저</span></strong></h4>
            </div>
            <div class="modal-body">
                <iframe id="theme-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
function theme_modal(href, title) {
    $('.theme-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#product-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.theme-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#theme-iframe").attr("src", href);
        $('#theme-iframe').height(600);
        $('html').css({overflow: 'hidden'});
    });
    $("#modal-title").text(title);
    return false;
}

!function () {
    var tm_db = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.tm_db    = tm_db,
    tm_db.clients   = [
        <?php foreach ($tlist as $li) { ?>
        {
            테마명: "<strong><?php echo $li['theme_name']; ?> <?php echo $li['theme_alias'] ? '('. $li['theme_alias'].')':'';?></strong>",
            홈페이지테마적용: "<?php if ($li['is_setup']) { ?><a href='javascript:;' data-theme='<?php echo $li['theme_name']; ?>' class='set_theme'><?php if ($li['theme_name'] == $theme) { ?><i class='fas fa-check'></i> <strong class='color-red'>적용중</strong><?php } else { ?><u>적용하기</u><?php } ?></a><?php } else { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=theme_form&amp;thema=<?php echo $li['theme_name']; ?>&amp;wmode=1' onclick='theme_modal(this.href, \"테마설치\"); return false;' class='btn-e btn-e-xs btn-e-red'>테마설치하기</a><?php } ?>",
            <?php if ($is_youngcart) { ?>
            쇼핑몰테마적용: "<?php if (defined('G5_USE_SHOP') && $li['shop_theme'] && $li['is_setup']) { ?><a href='javascript:;' data-theme='<?php echo $li['theme_name']; ?>' class='set_shop_theme'><?php if ($li['theme_name'] == $shop_theme || $li['is_shopping_theme']) { ?><i class='fas fa-check'></i> <strong class='color-red'>적용중</strong><?php } else { ?><u>적용하기</u><?php } ?></a><?php } ?>",
            <?php } ?>
            기본설정: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=config_form&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '110') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            게시판설정: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '200') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            홈페이지메뉴: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=menu_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '300') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            <?php if ($is_youngcart) { ?>
            쇼핑몰메뉴: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=shopmenu_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '400') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            <?php } ?>
            EB슬라이더: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '600') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            EB콘텐츠: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebcontents&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '610') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            <?php if ($is_youngcart) { ?>
            EB상품추출: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebgoods_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '500') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            <?php } ?>
            태그설정: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=tag_list&amp;thema=<?php echo $li['theme_name']; ?>'><?php if ($li['theme_name'] == $this_theme && $sub_key == '700') { ?><i class='fas fa-check'></i> <strong class='color-red'>설정중</strong><?php } else { ?><u>설정하기</u><?php } ?></a><?php } ?>",
            홈페이지: "<?php if ($li['is_setup']) { ?><a href='<?php echo G5_URL; ?>/?theme=<?php if ($li['theme_alias']) { ?><?php echo $li['theme_alias']; ?><?php } else { ?><?php echo $li['theme_name']; ?><?php } ?>' target='_blank'><u>미리보기</u></a><?php } ?>",
            <?php if ($is_youngcart) { ?>
            쇼핑몰: "<?php if (defined('G5_USE_SHOP') && $li['shop_theme'] && $li['is_setup']) { ?><a href='<?php echo G5_SHOP_URL; ?>/?shop_theme=<?php if ($li['theme_alias']) { ?><?php echo $li['theme_alias']; ?><?php } else { ?><?php echo $li['theme_name']; ?><?php } ?>' target='_blank'><u>미리보기</u></a><?php } ?>"
            <?php } ?>
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#theme-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : tm_db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : 30,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "테마명", type: "text", width: 120, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "홈페이지테마적용", type: "text", align: "center", width: 120 },
            <?php if ($is_youngcart) { ?>
            { name: "쇼핑몰테마적용", type: "text", align: "center", width: 120 },
            <?php } ?>
            { name: "기본설정", type: "text", align: "center", width: 70 },
            { name: "게시판설정", type: "text", align: "center", width: 80 },
            { name: "홈페이지메뉴", type: "text", align: "center", width: 90 },
            <?php if ($is_youngcart) { ?>
            { name: "쇼핑몰메뉴", type: "text", align: "center", width: 80 },
            <?php } ?>
            { name: "EB슬라이더", type: "text", align: "center", width: 80 },
            { name: "EB콘텐츠", type: "text", align: "center", width: 80 },
            <?php if ($is_youngcart) { ?>
            { name: "EB상품추출", type: "text", align: "center", width: 80 },
            <?php } ?>
            { name: "태그설정", type: "text", align: "center", width: 70 },
            { name: "홈페이지", type: "text", align: "center", width: 70 },
            <?php if ($is_youngcart) { ?>
            { name: "쇼핑몰", type: "text", align: "center", width: 70 }
            <?php } ?>
        ]
    });

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
            swal({
                html: true,
                title: "홈페이지 적용",
                text: "정말로 [<strong class='color-red'>" + theme + "</strong>]테마를 홈페이지 홈으로 사용하시겠습니까?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF9500",
                confirmButtonText: "확인",
                cancelButtonText: "취소",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    $("#theme").val(theme);
                    document.fthemeform.submit();
                } else {
                    return;
                }
            });
            break;
        case 's':
            swal({
                html: true,
                title: "쇼핑몰 적용",
                text: "정말로 [<strong class='color-red'>" + theme + "</strong>]테마를 쇼핑몰 홈으로 사용하시겠습니까?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#FF9500",
                confirmButtonText: "확인",
                cancelButtonText: "취소",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
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