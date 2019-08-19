<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/faqmasterform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-faqmasterform">
    <form name="frmfaqmasterform" id="frmfaqmasterform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmfaqmasterform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>FAQ <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> FAQ <?php echo $html_title; ?></strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_order" class="label">출력순서</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="fm_order" value="<?php echo $fm['fm_order']; ?>" id="fm_order" maxlength="10">
                            </label>
                            <div class="note"><strong>Note:</strong> 숫자가 작을수록 FAQ 분류에서 먼저 출력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_subject" class="label">제목<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="fm_subject" value="<?php echo get_text($fm['fm_subject']); ?>" id="fm_subject" required>
                                    </label>
                                </span>
                                <?php if ($w == 'u') { ?>
                                <span>
                                    <a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $fm_id; ?>" target="_blank" class="btn-e btn-e-md btn-e-dark">보기</a>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=faqlist&amp;fm_id=<?php echo $fm_id; ?>" class="btn-e btn-e-md btn-e-red"><i class="fas fa-plus"></i> 상세보기 내용추가</a>
                                </span>
                                <?php } ?>
                            </div>
                            <div class="note"><strong>Note:</strong> 20자 이내의 영문자, 숫자, _ 만 가능합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_himg" class="label">상단 이미지</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file form-width-500px">
                                <div class="button bg-color-light-grey"><input type="file" id="fm_himg" name="fm_himg" value="이미지선택" onchange="this.parentNode.nextSibling.value = this.value">이미지선택</div><input type="text" readonly>
                            </label>
                            <?php if ($fm['himg_width']) { ?>
                            <label for="fm_himg_del" class="checkbox"><input type="checkbox" name="fm_himg_del" value="1" id="fm_himg_del"><i></i> 삭제</label>
                            <img class="img-responsive" src="<?php echo G5_DATA_URL; ?>/faq/<?php echo $fm['fm_id']; ?>_h" width="<?php echo $fm['himg_width']; ?>" alt="">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_timg" class="label">하단 이미지</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file form-width-500px">
                                <div class="button bg-color-light-grey"><input type="file" id="fm_timg" name="fm_timg" value="이미지선택" onchange="this.parentNode.nextSibling.value = this.value">이미지선택</div><input type="text" readonly>
                            </label>
                            <?php if ($fm['timg_width']) { ?>
                            <label for="fm_timg_del" class="checkbox"><input type="checkbox" name="fm_timg_del" value="1" id="fm_timg_del"><i></i> 삭제</label>
                            <img class="img-responsive" src="<?php echo G5_DATA_URL; ?>/faq/<?php echo $fm['fm_id']; ?>_t" width="<?php echo $fm['timg_width']; ?>" alt="">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_head_html" class="label">상단 내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fm_head_html', get_text(html_purifier($fm['fm_head_html']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_tail_html" class="label">하단 내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fm_tail_html', get_text(html_purifier($fm['fm_tail_html']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_mobile_head_html" class="label">모바일 상단 내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fm_mobile_head_html', get_text(html_purifier($fm['fm_mobile_head_html']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="fm_mobile_tail_html" class="label">모바일 하단 내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('fm_mobile_tail_html', get_text(html_purifier($fm['fm_mobile_tail_html']), 0)); ?>
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

<script>
function frmfaqmasterform_check(f)
{
    <?php echo get_editor_js('fm_head_html'); ?>
    <?php echo get_editor_js('fm_tail_html'); ?>
    <?php echo get_editor_js('fm_mobile_head_html'); ?>
    <?php echo get_editor_js('fm_mobile_tail_html'); ?>
}
</script>