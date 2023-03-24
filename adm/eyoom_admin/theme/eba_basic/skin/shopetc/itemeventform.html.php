<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/itemeventform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemevent';
$g5_title = '이벤트관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
.admin-shop-itemeventform .adm-form-thumb {display:flex}
.admin-shop-itemeventform .adm-form-thumb-img {flex-shrink:0;width:120px;margin-right:10px}
.admin-shop-itemeventform .adm-form-thumb .img-thumb {width:120px;height:auto;border:1px solid var(--tbc-default);padding:5px}
.admin-shop-itemeventform .adm-form-thumb .no-goods-thumb {width:120px;height:auto;min-height:70px;border:1px dashed var(--tbc-default);padding:5px}
.admin-shop-itemeventform .adm-form-thumb-file {flex-grow:1;position:relative}
.admin-shop-itemeventform .srel_sel {margin-top:48px}
.admin-shop-itemeventform #sch_item_list ul {list-style:none;margin:0;padding:0}
.admin-shop-itemeventform #sch_item_list ul li {position:relative;border:1px solid var(--tbc-default);border-bottom:0;padding:10px;clear:both}
.admin-shop-itemeventform #sch_item_list ul li:last-child {border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemeventform #sch_item_list ul li img {margin-right:10px;width:50px}
.admin-shop-itemeventform #sch_item_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemeventform #sch_item_list ul li .list_item_btn {position:absolute;top:50%;right:10px;transform:translateY(-50%);margin:0;float:inherit}
.admin-shop-itemeventform #sch_item_list ul li .list_item_btn button {width:48px;text-align:center;padding:0;background-color:#ab0000;border:1px solid #ab0000;color:#fff;font-size:.75rem;line-height:1.5;border-radius:2px}
.admin-shop-itemeventform #reg_item_list ul {list-style:none;margin:0;padding:0}
.admin-shop-itemeventform #reg_item_list ul li {position:relative;border:1px solid var(--tbc-default);border-bottom:0;padding:10px;clear:both}
.admin-shop-itemeventform #reg_item_list ul li:last-child {border-bottom:1px solid var(--tbc-default)}
.admin-shop-itemeventform #reg_item_list ul li img {margin-right:10px;width:50px}
.admin-shop-itemeventform #reg_item_list ul li .list_item {display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;margin-right:58px}
.admin-shop-itemeventform #reg_item_list ul li .list_item_btn {position:absolute;top:50%;right:10px;transform:translateY(-50%);margin:0;float:inherit}
.admin-shop-itemeventform #reg_item_list ul li .list_item_btn button {width:48px;text-align:center;padding:0;background-color:#ab0000;border:1px solid #ab0000;color:#fff;font-size:.75rem;line-height:1.5;border-radius:2px}
@media (max-width: 991px) {
    .admin-shop-itemeventform .srel_sel {margin-top:0}
    .admin-shop-itemeventform #reg_item_list ul {margin-top:0}
}
</style>

<div class="admin-shop-itemeventform">
    <form name="feventform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return feventform_check(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="ev_id" value="<?php echo $ev_id; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="ev_item" value="">

    <div class="adm-headline">
        <h3>이벤트 <?php if ($w=='') { ?>등록<?php } else if ($w=='u') {?>수정<?php } ?></h3>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>이벤트 기본설정</strong></div>
        <?php if ($w=='u') { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이벤트번호</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input state-disabled width-250px">
                            <input type="text" value="<?php echo $ev_id; ?>" disabled>
                        </label>
                    </span>
                    <span>
                        <a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $ev['ev_id']; ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">이벤트바로가기</a>
                    </span>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ev_skin" class="label">출력스킨</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="ev_skin" id="ev_skin">
                            <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_SHOP_SKIN_PATH, $ev['ev_skin']); ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> 기본으로 제공하는 스킨은 <?php echo str_replace(G5_PATH.'/', '', G5_SHOP_SKIN_PATH); ?>/list.*.skin.php 입니다.<br><?php echo G5_SHOP_DIR; ?>/event.php?ev_id=1234567890&amp;skin=userskin.php 처럼 직접 만든 스킨을 사용할 수도 있습니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ev_mobile_skin" class="label">모바일 출력스킨</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="ev_mobile_skin" id="ev_mobile_skin">
                            <?php echo get_list_skin_options("^list.[0-9]+\.skin\.php", G5_MSHOP_SKIN_PATH, $ev['ev_mobile_skin']); ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> 기본으로 제공하는 스킨은 <?php echo str_replace(G5_PATH.'/', '', G5_MSHOP_SKIN_PATH); ?>/list.*.skin.php 입니다.<br><?php echo G5_SHOP_DIR; ?>/event.php?ev_id=1234567890&amp;skin=userskin.php 처럼 직접 만든 스킨을 사용할 수도 있습니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ev_img_width" class="label">출력이미지 폭</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">px</i>
                        <input type="text" name="ev_img_width" value="<?php echo $ev['ev_img_width']; ?>" id="ev_img_width" class="text-end" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ev_img_height" class="label">출력이미지 높이</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">px</i>
                        <input type="text" name="ev_img_height" value="<?php echo $ev['ev_img_height']; ?>" id="ev_img_height" class="text-end" required>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ev_list_mod" class="label">1줄당 이미지 수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="ev_list_mod" value="<?php echo $ev['ev_list_mod']; ?>" id="ev_list_mod" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 1행에 설정한 값만큼의 상품을 출력합니다. 스킨 설정에 따라 1행에 하나의 상품만 출력할 수도 있습니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ev_list_row" class="label">이미지 줄 수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">줄</i>
                        <input type="text" name="ev_list_row" value="<?php echo $ev['ev_list_row']; ?>" id="ev_list_row" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 한 페이지에 출력할 이미지 줄 수를 설정합니다. 한 페이지에 표시되는 상품수는 (1줄당 이미지 수 x 줄 수) 입니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ev_mobile_img_width" class="label">모바일 출력이미지 폭</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append text-width">px</i>
                        <input type="text" name="ev_mobile_img_width" value="<?php echo $ev['ev_mobile_img_width']; ?>" id="ev_mobile_img_width" class="text-end" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ev_mobile_img_height" class="label">모바일 출력이미지 높이</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append text-width">px</i>
                        <input type="text" name="ev_mobile_img_height" value="<?php echo $ev['ev_mobile_img_height']; ?>" id="ev_mobile_img_height" class="text-end" required>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="ev_mobile_list_mod" class="label">모바일 1줄당 이미지 수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="ev_mobile_list_mod" value="<?php echo $ev['ev_mobile_list_mod']; ?>" id="ev_mobile_list_mod" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 1행에 설정한 값만큼의 상품을 출력합니다. 스킨 설정에 따라 1행에 하나의 상품만 출력할 수도 있습니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="ev_mobile_list_row" class="label">모바일 이미지 줄 수</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">줄</i>
                        <input type="text" name="ev_mobile_list_row" value="<?php echo $ev['ev_mobile_list_row']; ?>" id="ev_mobile_list_row" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 한 페이지에 출력할 이미지 줄 수를 설정합니다. 한 페이지에 표시되는 상품수는 (1줄당 이미지 수 x 줄 수) 입니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ev_use" class="label">사용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="ev_use" id="ev_use">
                        <option value="1" <?php echo get_selected($ev['ev_use'], 1); ?>>사용</option>
                        <option value="0" <?php echo get_selected($ev['ev_use'], 0); ?>>사용안함</option>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 사용하지 않으면 레이아웃의 이벤트 메뉴 및 이벤트 관련 페이지에 접근할 수 없습니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="ev_subject" class="label">이벤트제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="ev_subject" value="<?php echo htmlspecialchars2($ev['ev_subject']); ?>" id="ev_subject" required>
                </label>
                <label class="checkbox">
                    <input type="checkbox" name="ev_subject_strong" value="1" id="ev_subject_strong" <?php if($ev['ev_subject_strong']) echo 'checked="checked"'; ?>><i></i> 강조하기
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="ev_mimg" class="label">배너이미지</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="adm-form-thumb">
                    <div class="adm-form-thumb-img">
                        <?php if ($mimg_url) { ?>
                        <div class="img-thumb">
                            <img class="img-fluid" src="<?php echo $mimg_url; ?>">
                        </div>
                        <?php } else { ?>
                        <div class="no-goods-thumb"></div>
                        <?php } ?>
                    </div>
                    <div class="adm-form-thumb-file">
                        <div class="input">
                            <input type="file" class="form-control" name="ev_mimg" id="ev_mimg">
                        </div>
                        <?php if ($mimg_url) { ?>
                        <label class="checkbox"><input type="checkbox" name="ev_mimg_del" id="ev_mimg_del" value="1"><i></i>파일삭제</label>
                        <a class="event-thumb-btn btn-e btn-e-xs btn-e-dark" href="<?php echo $mimg_url; ?>">확대보기</a>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>관련상품 및 디자인</strong></div>
        <div class="adm-form-cont">
            <div class="row row-g-20">
                <div class="col-lg-6 lg-m-b-20">
                    <label class="label">상품검색</label>
                    <div class="inline-group m-b-5">
                        <label class="select d-inline-block width-30">
                            <select name="ca_id" id="sch_ca_id">
                                <option value="">분류선택</option>
                                <?php echo $category_select; ?>
                            </select><i></i>
                        </label>
                        <label class="input input-button d-inline-block width-60">
                            <input type="text" name="sch_name" id="sch_name" placeholder="상품명"><div class="button"><a href="javascript:void(0);" id="btn_search_item" onclick="return false;"><i class="fas fa-search"></i> 검색</a></div>
                        </label>
                    </div>
                    <div id="sch_item_list" class="srel_list">
                        <p class="relation-sbox">상품의 분류를 선택하시거나 상품명을 입력하신 후 검색하여 주십시오.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="ev_mobile_skin" class="label">등록된 상품</label>
                    <div id="reg_item_list" class="srel_sel srel_list">
                        <ul>
                            <?php for ($i=0; $i<count((array)$it_info); $i++) { ?>
                            <li>
                                <input type="hidden" name="it_id[]" value="<?php echo $it_info[$i]['it_id']; ?>">
                                <div class="list_item"><?php echo $it_info[$i]['image']; ?> <?php echo $it_info[$i]['it_name']; ?></div>
                                <div class="list_item_btn"><button type="button" class="del_item btn-e btn-e-xs btn-e-red">삭제</button></div>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php if (count((array)$it_info) == 0) { ?>
                        <p class="relation-sbox text-gray"><i class="fas fa-exclamation-circle m-r-7"></i>등록된 상품이 없습니다.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="ev_himg" class="label">상단이미지</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="adm-form-thumb">
                    <div class="adm-form-thumb-img">
                        <?php if ($himg_url) { ?>
                        <div class="img-thumb">
                            <img class="img-fluid" src="<?php echo $himg_url; ?>">
                        </div>
                        <?php } else { ?>
                        <div class="no-goods-thumb"></div>
                        <?php } ?>
                    </div>
                    <div class="adm-form-thumb-file">
                        <div class="input">
                            <input type="file" class="form-control" name="ev_himg" id="ev_himg">
                        </div>
                        <?php if ($himg_url) { ?>
                        <label class="checkbox"><input type="checkbox" name="ev_himg_del" id="ev_himg_del" value="1"><i></i>파일삭제</label>
                        <a class="event-thumb-btn btn-e btn-e-xs btn-e-dark" href="<?php echo $himg_url; ?>">확대보기</a>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="ev_timg" class="label">하단이미지</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="adm-form-thumb">
                    <div class="adm-form-thumb-img">
                        <?php if ($timg_url) { ?>
                        <div class="img-thumb">
                            <img class="img-fluid" src="<?php echo $timg_url; ?>">
                        </div>
                        <?php } else { ?>
                        <div class="no-goods-thumb"></div>
                        <?php } ?>
                    </div>
                    <div class="adm-form-thumb-file">
                        <div class="input">
                            <input type="file" class="form-control" name="ev_timg" id="ev_timg">
                        </div>
                        <?php if ($timg_url) { ?>
                        <label class="checkbox"><input type="checkbox" name="ev_timg_del" id="ev_timg_del" value="1"><i></i>파일삭제</label>
                        <a class="event-thumb-btn btn-e btn-e-xs btn-e-dark" href="<?php echo $timg_url; ?>">확대보기</a>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="ev_head_html" class="label">상단내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('ev_head_html', get_text(html_purifier($ev['ev_head_html']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="ev_head_html" class="label">하단내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('ev_tail_html', get_text(html_purifier($ev['ev_tail_html']), 0)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

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