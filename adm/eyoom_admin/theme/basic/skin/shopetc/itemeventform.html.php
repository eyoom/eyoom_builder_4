<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/itemeventform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-itemeventform .input-fake {padding:4px 10px;border:1px solid #d5d5d5}
.admin-shop-itemeventform .thumbnail-gallery {max-width:200px}
.admin-shop-itemeventform .srel_list {border:1px solid #d5d5d5;background:#f5f5f5;padding:10px;min-height:300px}
.admin-shop-itemeventform .srel_pad {min-height:34px}
.admin-shop-itemeventform .table-form-thumb-img {position:relative;float:left;width:150px}
.admin-shop-itemeventform .table-form-thumb .img-thumb {width:120px;height:auto;border:1px solid #d5d5d5;padding:3px}
.admin-shop-itemeventform .table-form-thumb .no-img-thumb {width:120px;height:auto;min-height:80px;border:1px dashed #d5d5d5;padding:5px}
.admin-shop-itemeventform .table-form-thumb-file {position:relative;float:left;width:300px}
.admin-shop-itemeventform #sch_item_list ul {list-style:none;margin:0;padding:0}
.admin-shop-itemeventform #sch_item_list ul li {position:relative;border:1px solid #d5d5d5;border-bottom:0;height:50px;padding:5px 10px;clear:both}
.admin-shop-itemeventform #sch_item_list ul li:nth-child(odd) {background:#fbfbfb}
.admin-shop-itemeventform #sch_item_list ul li:last-child {border-bottom:1px solid #d5d5d5}
.admin-shop-itemeventform #sch_item_list ul li img {margin-right:10px;width:50px}
.admin-shop-itemeventform #sch_item_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemeventform #sch_item_list ul li .list_item_btn {position:absolute;top:20px;right:10px;margin:0;float:inherit}
.admin-shop-itemeventform #sch_item_list ul li .add_item {width:48px;text-align:center;padding:4px 8px;font-size:11px;height:inherit;line-height:1;background:#FF2900;letter-spacing:inherit;box-sizing:border-box}
.admin-shop-itemeventform #reg_item_list ul {list-style:none;margin:0;padding:0}
.admin-shop-itemeventform #reg_item_list ul li {position:relative;border:1px solid #d5d5d5;border-bottom:0;height:50px;padding:5px 10px;clear:both}
.admin-shop-itemeventform #reg_item_list ul li:nth-child(odd) {background:#fbfbfb}
.admin-shop-itemeventform #reg_item_list ul li:last-child {border-bottom:1px solid #d5d5d5}
.admin-shop-itemeventform #reg_item_list ul li img {margin-right:10px;width:50px}
.admin-shop-itemeventform #reg_item_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemeventform #reg_item_list ul li .list_item_btn {position:absolute;top:20px;right:10px;margin:0;float:inherit}
.admin-shop-itemeventform #reg_item_list ul li .del_item {width:48px;text-align:center;padding:4px 8px;font-size:11px;height:inherit;line-height:1;background:#2E3340;letter-spacing:inherit;box-sizing:border-box}
</style>

<div class="admin-shop-itemeventform">
    <form name="feventform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return feventform_check(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="ev_id" value="<?php echo $ev_id; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="ev_item" value="">

    <div class="adm-headline">
        <h3>이벤트 관리 <?php if ($w=='') { ?>입력<?php } else if ($w=='u') {?>수정<?php } ?></h3>
    </div>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 설정관리</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <?php if ($w=='u') { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이벤트번호</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <div class="input-fake form-width-150px">
                                        <?php echo $ev_id; ?>
                                    </div>
                                </span>
                                <span>
                                    <a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $ev['ev_id']; ?>" class="btn-e btn-e-yellow">이벤트바로가기</a>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_skin" class="label">출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ev_skin" id="ev_skin">
                                    <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $ev['ev_skin']); ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 기본으로 제공하는 스킨은 <?php echo str_replace(G5_PATH.'/', '', G5_SHOP_SKIN_PATH); ?>/list.*.skin.php 입니다.<br><?php echo G5_SHOP_DIR; ?>/event.php?ev_id=1234567890&amp;skin=userskin.php 처럼 직접 만든 스킨을 사용할 수도 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mobile_skin" class="label">모바일 출력스킨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ev_mobile_skin" id="ev_mobile_skin">
                                    <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_MSHOP_SKIN_PATH, $ev['ev_mobile_skin']); ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 기본으로 제공하는 스킨은 <?php echo str_replace(G5_PATH.'/', '', G5_MSHOP_SKIN_PATH); ?>/list.*.skin.php 입니다.<br><?php echo G5_SHOP_DIR; ?>/event.php?ev_id=1234567890&amp;skin=userskin.php 처럼 직접 만든 스킨을 사용할 수도 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_img_width" class="label">출력이미지 폭</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append text-width">px</i>
                                <input type="text" name="ev_img_width" value="<?php echo $ev['ev_img_width']; ?>" id="ev_img_width" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_img_height" class="label">출력이미지 높이</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append text-width">px</i>
                                <input type="text" name="ev_img_height" value="<?php echo $ev['ev_img_height']; ?>" id="ev_img_height" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_list_mod" class="label">1줄당 이미지 수</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ev_list_mod" value="<?php echo $ev['ev_list_mod']; ?>" id="ev_list_mod" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 1행에 설정한 값만큼의 상품을 출력합니다. 스킨 설정에 따라 1행에 하나의 상품만 출력할 수도 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_list_row" class="label">이미지 줄 수</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append">줄</i>
                                <input type="text" name="ev_list_row" value="<?php echo $ev['ev_list_row']; ?>" id="ev_list_row" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 한 페이지에 출력할 이미지 줄 수를 설정합니다. 한 페이지에 표시되는 상품수는 (1줄당 이미지 수 x 줄 수) 입니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mobile_img_width" class="label">모바일 출력이미지 폭</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append text-width">px</i>
                                <input type="text" name="ev_mobile_img_width" value="<?php echo $ev['ev_mobile_img_width']; ?>" id="ev_mobile_img_width" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mobile_img_height" class="label">모바일 출력이미지 높이</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append text-width">px</i>
                                <input type="text" name="ev_mobile_img_height" value="<?php echo $ev['ev_mobile_img_height']; ?>" id="ev_mobile_img_height" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mobile_list_mod" class="label">모바일 1줄당 이미지 수</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="ev_mobile_list_mod" value="<?php echo $ev['ev_mobile_list_mod']; ?>" id="ev_mobile_list_mod" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 1행에 설정한 값만큼의 상품을 출력합니다. 스킨 설정에 따라 1행에 하나의 상품만 출력할 수도 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mobile_list_row" class="label">모바일 이미지 줄 수</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append">줄</i>
                                <input type="text" name="ev_mobile_list_row" value="<?php echo $ev['ev_mobile_list_row']; ?>" id="ev_mobile_list_row" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 한 페이지에 출력할 이미지 줄 수를 설정합니다. 한 페이지에 표시되는 상품수는 (1줄당 이미지 수 x 줄 수) 입니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_use" class="label">사용</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="ev_use" id="ev_use">
                                    <option value="1" <?php echo get_selected($ev['ev_use'], 1); ?>>사용</option>
                                    <option value="0" <?php echo get_selected($ev['ev_use'], 0); ?>>사용안함</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 사용하지 않으면 레이아웃의 이벤트 메뉴 및 이벤트 관련 페이지에 접근할 수 없습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_subject" class="label">이벤트제목</label>
                        </th>
                        <td>
                            <label class="input form-width-300px">
                                <input type="text" name="ev_subject" value="<?php echo htmlspecialchars2($ev['ev_subject']); ?>" id="ev_subject" required>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="ev_subject_strong" value="1" id="ev_subject_strong" <?php if($ev['ev_subject_strong']) echo 'checked="checked"'; ?>><i></i> 강조하기
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_mimg" class="label">배너이미지</label>
                        </th>
                        <td class="position-relative">
                            <div class="table-form-thumb">
                                <div class="table-form-thumb-img">
                                    <?php if ($mimg_url) { ?>
                                    <div class="img-thumb">
                                        <img src="<?php echo $mimg_url; ?>" class="img-responsive">
                                    </div>
                                    <?php } else { ?>
                                    <div class="no-img-thumb"></div>
                                    <?php } ?>
                                </div>
                                <div class="table-form-thumb-file">
                                    <label class="input input-file form-width-300px">
                                        <div class="button"><input type="file" name="ev_mimg" id="ev_mimg" onchange="this.parentNode.nextSibling.value = this.value">이미지 업로드</div><input type="text" readonly="">
                                    </label>
                                    <?php if ($mimg_url) { ?>
                                    <label class="checkbox"><input type="checkbox" name="ev_mimg_del" id="ev_mimg_del" value="1"><i></i>파일삭제</label>
                                    <a class="event-thumb-btn btn-e btn-e-xs btn-e-default" href="<?php echo $mimg_url; ?>">확대보기</a>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 관련상품 및 디자인</strong></header>

        <fieldset>
            <div class="row">
                <div class="col col-6">
                    <section>
                        <label for="ev_skin" class="label">상품검색</label>
                        <div class="row">
                            <div class="col col-6">
                                <section>
                                    <label class="select">
                                        <select name="ca_id" id="sch_ca_id">
                                            <option value="">분류선택</option>
                                            <?php echo $category_select; ?>
                                        </select><i></i>
                                    </label>
                                </section>
                            </div>
                            <div class="col col-6">
                                <section>
                                    <div class="input input-button">
                                        <input type="text" name="sch_name" id="sch_name" placeholder="상품명">
                                        <div class="button"><input type="button" id="btn_search_item"><i class="fas fa-search"></i> 검색</div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div id="sch_item_list" class="srel_list">
                            <p>상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>
                        </div>
                    </section>
                </div>
                <div class="col col-6">
                    <section>
                        <label for="ev_mobile_skin" class="label">등록된 상품</label>
                        <div class="srel_pad"></div>
                        <div id="reg_item_list" class="srel_sel srel_list">
                            <ul>
                                <?php for ($i=0; $i<count((array)$it_info); $i++) { ?>
                                <li>
                                    <input type="hidden" name="it_id[]" value="<?php echo $it_info[$i]['it_id']; ?>">
                                    <div><?php echo $it_info[$i]['image']; ?> <?php echo $it_info[$i]['it_name']; ?></div>
                                    <div class="list_item_btn"><button type="button" class="del_item btn-e btn-e-xs btn-e-dark">삭제</button></div>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php if (count((array)$it_info) == 0) { ?>
                            <p>등록된 상품이 없습니다.</p>
                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>
        </fieldset>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_himg" class="label">상단이미지</label>
                        </th>
                        <td class="position-relative">
                            <div class="table-form-thumb">
                                <div class="table-form-thumb-img">
                                    <?php if ($himg_url) { ?>
                                    <div class="img-thumb">
                                        <img src="<?php echo $himg_url; ?>" class="img-responsive">
                                    </div>
                                    <?php } else { ?>
                                    <div class="no-img-thumb"></div>
                                    <?php } ?>
                                </div>
                                <div class="table-form-thumb-file">
                                    <label class="input input-file form-width-300px">
                                        <div class="button"><input type="file" name="ev_himg" id="ev_himg" onchange="this.parentNode.nextSibling.value = this.value">이미지 업로드</div><input type="text" readonly="">
                                    </label>
                                    <?php if ($himg_url) { ?>
                                    <label class="checkbox"><input type="checkbox" name="ev_himg_del" id="ev_himg_del" value="1"><i></i>파일삭제</label>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="note"><strong>Note:</strong> 이벤트 페이지 상단에 업로드 한 이미지를 출력합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_timg" class="label">하단이미지</label>
                        </th>
                        <td class="position-relative">
                            <div class="table-form-thumb">
                                <div class="table-form-thumb-img">
                                    <?php if ($timg_url) { ?>
                                    <div class="img-thumb">
                                        <img src="<?php echo $timg_url; ?>" class="img-responsive">
                                    </div>
                                    <?php } else { ?>
                                    <div class="no-img-thumb"></div>
                                    <?php } ?>
                                </div>
                                <div class="table-form-thumb-file">
                                    <label class="input input-file form-width-300px">
                                        <div class="button"><input type="file" name="ev_timg" id="ev_timg" onchange="this.parentNode.nextSibling.value = this.value">이미지 업로드</div><input type="text" readonly="">
                                    </label>
                                    <?php if ($timg_url) { ?>
                                    <label class="checkbox"><input type="checkbox" name="ev_timg_del" id="ev_timg_del" value="1"><i></i>파일삭제</label>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="note"><strong>Note:</strong> 이벤트 페이지 하단에 업로드 한 이미지를 출력합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_head_html" class="label">상단내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('ev_head_html', get_text(html_purifier($ev['ev_head_html']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="ev_head_html" class="label">하단내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('ev_tail_html', get_text(html_purifier($ev['ev_tail_html']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(document).ready(function() {
    $('.event-thumb-btn').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });
});

$(function() {
    $("#btn_search_item").click(function() {
        var ca_id = $("#sch_ca_id").val();
        var it_name = $.trim($("#sch_name").val());

        if(ca_id == "" && it_name == "") {
            $("#sch_item_list").html("<p>상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>");
            return false;
        }

        $("#sch_item_list").load(
            "<?php echo G5_ADMIN_URL; ?>/shop_admin/itemeventsearch.php",
            { w: "<?php echo $w; ?>", ev_id: "<?php echo $ev_id; ?>", ca_id: ca_id, it_name: it_name }
        );
    });

    $(document).on("click", "#sch_item_list .add_item", function() {
        // 이미 등록된 상품인지 체크
        var $li = $(this).closest("li");
        var it_id = $li.find("input:hidden").val();
        var it_id2;
        var dup = false;
        $("#reg_item_list input[name='it_id[]']").each(function() {
            it_id2 = $(this).val();
            if(it_id == it_id2) {
                dup = true;
                return false;
            }
        });

        if(dup) {
            alert("이미 등록된 상품입니다.");
            return false;
        }

        var cont = "<li>"+$li.html().replace("add_item", "del_item").replace("추가", "삭제")+"</li>";
        var count = $("#reg_item_list li").size();

        if(count > 0) {
            $("#reg_item_list li:last").after(cont);
        } else {
            $("#reg_item_list").html("<ul>"+cont+"</ul>");
        }

        $li.remove();
    });

    $(document).on("click", "#reg_item_list .del_item", function() {
        if(!confirm("상품을 삭제하시겠습니까?"))
            return false;

        $(this).closest("li").remove();

        var count = $("#reg_item_list li").size();
        if(count < 1)
            $("#reg_item_list").html("<p>등록된 상품이 없습니다.</p>");
    });
});

function feventform_check(f) {
    var item = new Array();
    var ev_item = it_id = "";

    $("#reg_item_list input[name='it_id[]']").each(function() {
        it_id = $(this).val();
        if(it_id == "")
            return true;

        item.push(it_id);
    });

    if(item.length > 0)
        ev_item = item.join();

    $("input[name=ev_item]").val(ev_item);

    <?php echo get_editor_js('ev_head_html'); ?>
    <?php echo get_editor_js('ev_tail_html'); ?>

    return true;
}
</script>