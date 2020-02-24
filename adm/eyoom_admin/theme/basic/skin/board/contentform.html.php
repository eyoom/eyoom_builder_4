<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/contentform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-contentform">
    <form name="frmcontentform" id="frmcontentform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmcontentform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="co_html" value="1">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>내용 <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> 내용 <?php echo $html_title; ?></strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_id" class="label">ID<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="co_id" value="<?php echo $co['co_id']; ?>" id="co_id" required <?php echo $readonly; ?> maxlength="20">
                                    </label>
                                </span>
                                <?php if ($w == 'u') { ?>
                                <span>
                                    <a href="<?php echo get_eyoom_pretty_url('content', $co_id); ?>" class="btn-e btn-e-md btn-e-dark">내용확인</a>
                                </span>
                                <?php } ?>
                            </div>
                            <div class="note"><strong>Note:</strong> 20자 이내의 영문자, 숫자, _ 만 가능합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_subject" class="label">제목<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="co_subject" value="<?php echo htmlspecialchars2($co['co_subject']); ?>" id="co_subject" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_content" class="label">내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('co_content', get_text(html_purifier($co['co_content']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_mobile_content" class="label">모바일 내용</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <?php echo editor_html('co_mobile_content', get_text(html_purifier($co['co_mobile_content']), 0)); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_skin" class="label">스킨 디렉토리<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_skin_select('content', 'co_skin', 'co_skin', $co['co_skin'], 'required'); ?><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_mobile_skin" class="label">모바일 스킨 디렉토리<strong class="sound_only">필수</strong></label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_mobile_skin_select('content', 'co_mobile_skin', 'co_mobile_skin', $co['co_mobile_skin'], 'required'); ?><i></i>
                            </label>
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <th class="table-form-th">
                            <label class="label">태그 필터링 사용</label>
                        </th>
                        <td>
                            <label for="co_tag_filter_use" class="select form-width-250px">
                                <select name="co_tag_filter_use" id="co_tag_filter_use">
                                    <option value="1"<?php echo get_selected($co['co_tag_filter_use'], 1); ?>>사용함</option>
                                    <option value="0"<?php echo get_selected($co['co_tag_filter_use'], 0); ?>>사용안함</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 내용에서 iframe 등의 태그를 사용하려면 사용안함으로 선택해 주십시오.</div>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <th class="table-form-th">
                            <label for="co_include_head" class="label">상단 파일 경로</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="co_include_head" value="<?php echo $co['co_include_head']; ?>" id="co_include_head">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정값이 없으면 기본 상단 파일을 사용합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_include_tail" class="label">하단 파일 경로</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="co_include_tail" value="<?php echo $co['co_include_tail']; ?>" id="co_include_tail">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정값이 없으면 기본 하단 파일을 사용합니다..</div>
                        </td>
                    </tr>
                    <tr id="admin_captcha_box" style="display:none;">
                        <th class="table-form-th">
                            <label for="bo_include_tail" class="label">자동등록방지</label>
                        </th>
                        <td>
                            <?php
                            include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
                            $captcha_html = captcha_html();
                            $captcha_js   = chk_captcha_js();
                            echo $captcha_html;
                            ?>
                            <script>
                            jQuery("#captcha_key").removeAttr("required").removeClass("required");
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_himg" class="label">상단 이미지</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file form-width-500px">
                                <div class="button bg-color-light-grey"><input type="file" id="co_himg" name="co_himg" value="이미지선택" onchange="this.parentNode.nextSibling.value = this.value">이미지선택</div><input type="text" readonly>
                            </label>
                            <?php if ($co['himg_width']) { ?>
                            <label for="co_himg_del" class="checkbox"><input type="checkbox" name="co_himg_del" value="1" id="co_himg_del"><i></i> 삭제</label>
                            <img class="img-responsive" src="<?php echo G5_DATA_URL; ?>/content/<?php echo $co['co_id']; ?>_h" width="<?php echo $co['himg_width']; ?>" alt="">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="co_himg" class="label">하단 이미지</label>
                        </th>
                        <td>
                            <label for="file" class="input input-file form-width-500px">
                                <div class="button bg-color-light-grey"><input type="file" id="co_timg" name="co_timg" value="이미지선택" onchange="this.parentNode.nextSibling.value = this.value">이미지선택</div><input type="text" readonly>
                            </label>
                            <?php if ($co['timg_width']) { ?>
                            <label for="co_timg_del" class="checkbox"><input type="checkbox" name="co_timg_del" value="1" id="co_timg_del"><i></i> 삭제</label>
                            <img class="img-responsive" src="<?php echo G5_DATA_URL; ?>/content/<?php echo $co['co_id']; ?>_t" width="<?php echo $co['timg_width']; ?>" alt="">
                            <?php } ?>
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

<?php
// [KVE-2018-2089] 취약점 으로 인해 파일 경로 수정시에만 자동등록방지 코드 사용
?>
<script>
    var captcha_chk = false;

function use_captcha_check(){
    $.ajax({
        type: "POST",
        url: g5_admin_url+"/ajax.use_captcha.php",
        data: { admin_use_captcha: "1" },
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
        }
    });
}

function frm_check_file(){
    var co_include_head = "<?php echo $co['co_include_head']; ?>";
    var co_include_tail = "<?php echo $co['co_include_tail']; ?>";
    var head = jQuery.trim(jQuery("#co_include_head").val());
    var tail = jQuery.trim(jQuery("#co_include_tail").val());

    if(co_include_head !== head || co_include_tail !== tail){
        // 캡챠를 사용합니다.
        jQuery("#admin_captcha_box").show();
        captcha_chk = true;

        use_captcha_check();

        return false;
    } else {
        jQuery("#admin_captcha_box").hide();
    }

    return true;
}

jQuery(function($){
    if( window.self !== window.top ){   // frame 또는 iframe을 사용할 경우 체크
        $("#co_include_head, #co_include_tail").on("change paste keyup", function(e) {
            frm_check_file();
        });

        use_captcha_check();
    }
});

function frmcontentform_check(f)
{
    errmsg = "";
    errfld = "";

    <?php echo get_editor_js('co_content'); ?>
    <?php echo chk_editor_js('co_content'); ?>
    <?php echo get_editor_js('co_mobile_content'); ?>

    check_field(f.co_id, "ID를 입력하세요.");
    check_field(f.co_subject, "제목을 입력하세요.");
    check_field(f.co_content, "내용을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}
</script>