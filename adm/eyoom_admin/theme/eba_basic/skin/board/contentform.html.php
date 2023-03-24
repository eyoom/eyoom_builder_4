<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/contentform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'contentlist';
$g5_title = '내용관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-contentform">
    <form name="frmcontentform" id="frmcontentform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return frmcontentform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="co_html" value="1">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>내용 <?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="co_id" class="label">ID<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px">
                            <input type="text" name="co_id" value="<?php echo $co['co_id']; ?>" id="co_id" required <?php echo $readonly; ?> maxlength="20">
                        </label>
                    </span>
                    <?php if ($w == 'u') { ?>
                    <span>
                        <a href="<?php echo get_eyoom_pretty_url('content', $co_id); ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">내용확인</a>
                    </span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="co_subject" class="label">제목<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="co_subject" value="<?php echo htmlspecialchars2($co['co_subject']); ?>" id="co_subject" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="co_content" class="label">내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('co_content', get_text(html_purifier($co['co_content']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="co_mobile_content" class="label">모바일 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html('co_mobile_content', get_text(html_purifier($co['co_mobile_content']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="co_skin" class="label">스킨 디렉토리<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_skin_select('content', 'co_skin', 'co_skin', $co['co_skin'], 'required'); ?><i></i>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="co_mobile_skin" class="label">모바일 스킨 디렉토리<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_mobile_skin_select('content', 'co_mobile_skin', 'co_mobile_skin', $co['co_mobile_skin'], 'required'); ?><i></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="co_include_head" class="label">상단 파일 경로</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="co_include_head" value="<?php echo get_sanitize_input($co['co_include_head']); ?>" id="co_include_head">
                    </label>
                    <div class="note"><strong>Note:</strong> 설정값이 없으면 기본 상단 파일을 사용합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="co_include_tail" class="label">하단 파일 경로</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="co_include_tail" value="<?php echo get_sanitize_input($co['co_include_tail']); ?>" id="co_include_tail">
                    </label>
                    <div class="note"><strong>Note:</strong> 설정값이 없으면 기본 하단 파일을 사용합니다..</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr" id="admin_captcha_box" style="display:none;">
            <div class="adm-form-td td-l">
                <label for="bo_include_tail" class="label">자동등록방지</label>
            </div>
            <div class="adm-form-td td-r">
                <?php
                include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
                $captcha_html = captcha_html();
                $captcha_js   = chk_captcha_js();
                echo $captcha_html;
                ?>
                <script>
                jQuery("#captcha_key").removeAttr("required").removeClass("required");
                </script>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="co_himg" class="label">상단 이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="co_himg" name="co_himg" value="이미지선택">
                    </div>
                    <?php if ($co['himg_width']) { ?>
                    <label for="co_himg_del" class="checkbox"><input type="checkbox" name="co_himg_del" value="1" id="co_himg_del"><i></i> 삭제</label>
                    <img class="img-fluid" src="<?php echo G5_DATA_URL; ?>/content/<?php echo $co['co_id']; ?>_h" width="<?php echo $co['himg_width']; ?>" alt="">
                    <?php } ?>
                </div>
            </div>
            <div class="adm-form-tr tr-r adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="co_himg" class="label">하단 이미지</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="input">
                        <input type="file" class="form-control" id="co_timg" name="co_timg" value="이미지선택">
                    </div>
                    <?php if ($co['timg_width']) { ?>
                    <label for="co_timg_del" class="checkbox"><input type="checkbox" name="co_timg_del" value="1" id="co_timg_del"><i></i> 삭제</label>
                    <img class="img-fluid" src="<?php echo G5_DATA_URL; ?>/content/<?php echo $co['co_id']; ?>_t" width="<?php echo $co['timg_width']; ?>" alt="">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

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