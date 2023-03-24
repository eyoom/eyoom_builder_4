<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/faqmasterform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'faqmasterlist';
$g5_title = 'FAQ관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-faqmasterform">
    <form name="frmfaqmasterform" id="frmfaqmasterform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmfaqmasterform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_order" class="label">출력순서</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="fm_order" value="<?php echo $fm['fm_order']; ?>" id="fm_order" maxlength="10">
                </label>
                <div class="note"><strong>Note:</strong> 숫자가 작을수록 FAQ 분류에서 먼저 출력됩니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_subject" class="label">제목<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px">
                            <input type="text" name="fm_subject" value="<?php echo get_text($fm['fm_subject']); ?>" id="fm_subject" required>
                        </label>
                    </span>
                    <?php if ($w == 'u') { ?>
                    <span>
                        <a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $fm_id; ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">보기</a>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqlist&amp;fm_id=<?php echo $fm_id; ?>" class="btn-e btn-e-lg btn-e-crimson"><i class="fas fa-plus"></i> 상세보기 내용추가</a>
                    </span>
                    <?php } ?>
                </div>
                <div class="note"><strong>Note:</strong> 20자 이내의 영문자, 숫자, _ 만 가능합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="fm_himg" class="label">상단 이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="fm_himg" name="fm_himg" value="이미지선택">
                    </div>
                    <?php if ($fm['himg_width']) { ?>
                    <label for="fm_himg_del" class="checkbox"><input type="checkbox" name="fm_himg_del" value="1" id="fm_himg_del"><i></i> 삭제</label>
                    <img class="img-fluid" src="<?php echo G5_DATA_URL; ?>/faq/<?php echo $fm['fm_id']; ?>_h" width="<?php echo $fm['himg_width']; ?>" alt="">
                    <?php } ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="fm_timg" class="label">하단 이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="fm_timg" name="fm_timg" value="이미지선택">
                    </div>
                    <?php if ($fm['timg_width']) { ?>
                    <label for="fm_timg_del" class="checkbox"><input type="checkbox" name="fm_timg_del" value="1" id="fm_timg_del"><i></i> 삭제</label>
                    <img class="img-fluid" src="<?php echo G5_DATA_URL; ?>/faq/<?php echo $fm['fm_id']; ?>_t" width="<?php echo $fm['timg_width']; ?>" alt="">
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_head_html" class="label">상단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fm_head_html', get_text(html_purifier($fm['fm_head_html']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_tail_html" class="label">하단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fm_tail_html', get_text(html_purifier($fm['fm_tail_html']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_mobile_head_html" class="label">모바일 상단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fm_mobile_head_html', get_text(html_purifier($fm['fm_mobile_head_html']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fm_mobile_tail_html" class="label">모바일 하단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('fm_mobile_tail_html', get_text(html_purifier($fm['fm_mobile_tail_html']), 0)); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
function frmfaqmasterform_check(f)
{
    <?php echo get_editor_js('fm_head_html'); ?>
    <?php echo get_editor_js('fm_tail_html'); ?>
    <?php echo get_editor_js('fm_mobile_head_html'); ?>
    <?php echo get_editor_js('fm_mobile_tail_html'); ?>
}
</script>