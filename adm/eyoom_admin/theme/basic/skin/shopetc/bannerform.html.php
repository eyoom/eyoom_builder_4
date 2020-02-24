<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shop/bannerform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-shop-bannerform .thumbnail-gallery {max-width:200px}
.admin-shop-bannerform .table-form-thumb-img {position:relative;float:left;width:150px}
.admin-shop-bannerform .table-form-thumb .img-thumb {width:120px;height:auto;border:1px solid #d5d5d5;padding:3px}
.admin-shop-bannerform .table-form-thumb .no-img-thumb {width:120px;height:auto;min-height:80px;border:1px dashed #d5d5d5;padding:5px}
.admin-shop-bannerform .table-form-thumb-file {position:relative;float:left;width:300px}
</style>

<div class="admin-shop-bannerform">
    <form name="fbanner" method="post" action="<?php echo $action_url1; ?>" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bn_id" value="<?php echo $bn_id; ?>">

    <div class="adm-headline">
        <h3>배너 관리</h3>
    </div>

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> 설정관리</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_bimg" class="label">이미지</label>
                        </th>
                        <td>
                            <div class="table-form-thumb">
                                <div class="table-form-thumb-img">
                                    <?php if ($bimg_url) { ?>
                                    <div class="img-thumb">
                                        <img src="<?php echo $bimg_url; ?>" class="img-responsive">
                                    </div>
                                    <?php } else { ?>
                                    <div class="no-img-thumb"></div>
                                    <?php } ?>
                                </div>
                                <div class="table-form-thumb-file">
                                    <label class="input input-file form-width-300px">
                                        <div class="button"><input type="file" name="bn_bimg" id="bn_bimg" onchange="this.parentNode.nextSibling.value = this.value">이미지 업로드</div><input type="text" readonly="">
                                    </label>
                                    <?php if ($bimg_url) { ?>
                                    <label class="checkbox"><input type="checkbox" name="bn_bimg_del" id="bn_bimg_del" value="1"><i></i>파일삭제</label>
                                    <a class="banner-thumb-btn btn-e btn-e-xs btn-e-default" href="<?php echo $bimg_url; ?>">확대보기</a>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="note"><strong>Note:</strong> 이미지는 동일한 사이즈로 편집하여 업로드하시기 바랍니다. (가로사이즈 1140px 이상 권장)</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_bimg" class="label">이미지 설명</label>
                        </th>
                        <td>
                            <label class="input form-width-300px">
                                <input type="text" name="bn_alt" value="<?php echo get_text($bn['bn_alt']); ?>" id="bn_alt">
                            </label>
                            <div class="note"><strong>Note:</strong> img 태그의 alt, title 에 해당되는 내용입니다.<br>배너에 마우스를 오버하면 이미지의 설명이 나옵니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_url" class="label">링크</label>
                        </th>
                        <td>
                            <label class="input form-width-300px">
                                <i class="icon-append fas fa-link"></i>
                                <input type="text" name="bn_url" value="<?php echo get_sanitize_input($bn['bn_url']); ?>" id="bn_url">
                            </label>
                            <div class="note"><strong>Note:</strong> 배너클릭시 이동하는 주소입니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_device" class="label">접속기기</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="bn_device" id="bn_device">
                                    <option value="both"<?php echo get_selected($bn['bn_device'], 'both', true); ?>>PC와 모바일</option>
                                    <option value="pc"<?php echo get_selected($bn['bn_device'], 'pc'); ?>>PC</option>
                                    <option value="mobile"<?php echo get_selected($bn['bn_device'], 'mobile'); ?>>모바일</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 배너를 표시할 접속기기를 선택합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_position" class="label">출력위치</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="bn_position" id="bn_position">
                                    <option value="왼쪽" <?php echo get_selected($bn['bn_position'], '왼쪽'); ?>>왼쪽</option>
                                    <option value="메인" <?php echo get_selected($bn['bn_position'], '메인'); ?>>메인</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 왼쪽 : 쇼핑몰화면 왼쪽에 출력합니다.<br>메인 : 쇼핑몰 메인화면(index.php)에만 출력합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_border" class="label">테두리</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="bn_border" id="bn_border">
                                    <option value="0" <?php echo get_selected($bn['bn_border'], 0); ?>>사용안함</option>
                                    <option value="1" <?php echo get_selected($bn['bn_border'], 1); ?>>사용</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 배너이미지에 테두리를 넣을지를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_new_win" class="label">새창</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="bn_new_win" id="bn_new_win">
                                    <option value="0" <?php echo get_selected($bn['bn_new_win'], 0); ?>>사용안함</option>
                                    <option value="1" <?php echo get_selected($bn['bn_new_win'], 1); ?>>사용</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 배너클릭시 새창을 띄울지를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_begin_time" class="label">시작일시</label>
                        </th>
                        <td>
                            <label class="input form-width-300px">
                                <input type="text" name="bn_begin_time" value="<?php echo $bn['bn_begin_time']; ?>" id="bn_begin_time" maxlength="19">
                            </label>
                            <label for="bn_begin_chk" class="checkbox"><input type="checkbox" name="bn_begin_chk" value="<?php echo date("Y-m-d 00:00:00", time()); ?>" id="bn_begin_chk" onclick="if (this.checked == true) this.form.bn_begin_time.value=this.form.bn_begin_chk.value; else this.form.bn_begin_time.value = this.form.bn_begin_time.defaultValue;"><i></i> 오늘</label>
                            <div class="note"><strong>Note:</strong> 배너 게시 시작일시를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_end_time" class="label">종료일시</label>
                        </th>
                        <td>
                            <label class="input form-width-300px">
                                <input type="text" name="bn_end_time" value="<?php echo $bn['bn_end_time']; ?>" id="bn_end_time" maxlength="19">
                            </label>
                            <label for="bn_end_chk" class="checkbox"><input type="checkbox" name="bn_end_chk" value="<?php echo date("Y-m-d 23:59:59", time()+60*60*24*31); ?>" id="bn_end_chk" onclick="if (this.checked == true) this.form.bn_end_time.value=this.form.bn_end_chk.value; else this.form.bn_end_time.value = this.form.bn_end_time.defaultValue;"><i></i> 오늘+31일</label>
                            <div class="note"><strong>Note:</strong> 배너 게시 종료일시를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bn_order" class="label">출력 순서</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <?php echo order_select("bn_order", $bn['bn_order']); ?><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 배너를 출력할 때 순서를 정합니다. 숫자가 작을수록 먼저 출력됩니다.</div>
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
$('.banner-thumb-btn').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
        verticalFit: true
    }
});
</script>