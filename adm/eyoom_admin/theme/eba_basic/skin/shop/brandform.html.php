<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/brandform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'brandlist';
$g5_title = '브랜드관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-brandform">
    <form name="fbrandform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fbrandformcheck(this);" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx"  value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="br_no" value="<?php echo $br_no; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="uploading" id="uploading" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="br_code" class="label">브랜드코드</label>
            </div>
            <div class="adm-form-td td-r">
                <?php if ($w == '') { ?>
                <label for="br_code" class="input max-width-250px">
                    <input type="text" name="br_code" value="<?php echo time(); ?>" id="br_code" required  maxlength="20">
                </label>
                <div class="note"><strong>Note:</strong> 브랜드의 코드는 10자리 숫자로 자동생성합니다. <b>직접 브랜드코드를 입력할 수도 있습니다.</b><br>브랜드코드는 영문자, 숫자, - 만 입력 가능합니다.</div>
                <?php } else { ?>
                <input type="hidden" name="br_code" value="<?php echo $br['br_code']; ?>" id="br_code">
                <strong><?php echo $br['br_code']; ?></strong>
                <?php } ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="br_name" class="label">브랜드명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="br_name" value="<?php echo get_text(cut_str($br['br_name'], 250, "")); ?>" id="br_name" required>
                </label>
                <div class="note"><strong>Note:</strong> HTML 입력이 불가합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="br_basic" class="label">기본설명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="br_basic" value="<?php echo get_text(html_purifier($br['br_basic'])); ?>" id="br_basic">
                </label>
                <div class="note"><strong>Note:</strong> 브랜드명 하단에 브랜드에 대한 추가적인 설명이 필요한 경우에 입력합니다. HTML 입력도 가능합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">노출여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="br_open_y" class="radio"><input type="radio" name="br_open" id="br_open_y" value="y" <?php echo $br['br_open']=='y' ? 'checked': ''; ?>><i></i> 예</label>
                    <label for="br_open_n" class="radio"><input type="radio" name="br_open" id="br_open_n" value="n" <?php echo $br['br_open']=='n' ? 'checked': ''; ?>><i></i> 아니오</label>
                </div>
                <div class="note"><strong>Note:</strong> 노출 여부를 설정합니다.</b></div>
            </div>
        </div>
        <?php if ($w=='u') { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="br_sort" class="label">출력순서</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="br_sort" value="<?php echo $br['br_sort']; ?>" id="br_sort">
                </label>
                <div class="note"><strong>Note:</strong> 숫자가 작을 수록 상위에 출력됩니다. 음수 입력도 가능하며 입력 가능 범위는 -2147483648 부터 2147483647 까지입니다.<br><b>입력하지 않으면 자동으로 출력됩니다.</b></div>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="br_img" class="label">브랜드 이미지</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
                    <input type="file" class="form-control" id="br_img" name="br_img" value="파일선택">
                </div>
                <?php if ($br['img_url']) { ?>
                <label for="del_br_img" class="checkbox"><input type="checkbox" id="del_br_img" name="del_br_img" value="1"><i></i> [<?php echo $br['br_img']; ?>] 삭제</label>
                <?php } ?>
                <div class="note"><strong>Note:</strong> 브랜드 대표 이미지를 등록해 주세요.</div>
            </div>
        </div>
    </div>
    
    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>
