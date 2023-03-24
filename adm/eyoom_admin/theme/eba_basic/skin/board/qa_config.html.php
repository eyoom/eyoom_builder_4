<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/qa_config.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'qa_config';
$g5_title = '1:1문의설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-qa-config">
    <form name="fqaconfigform" id="fqaconfigform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fqaconfigform_submit(this)" class="eyoom-form" autocomplete="off">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>1:1문의 설정</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="qa_title" class="label">타이틀<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px">
                            <input type="text" name="qa_title" value="<?php echo get_sanitize_input($qaconfig['qa_title']); ?>" id="qa_title" required>
                        </label>
                    </span>
                    <span>
                        <a href="<?php echo G5_BBS_URL; ?>/qalist.php" target="_blank" class="btn-e btn-e-lg btn-e-dark">1:1문의 바로가기</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="qa_category" class="label">분류<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="qa_category" value="<?php echo get_sanitize_input($qaconfig['qa_category']); ?>" id="qa_category" required>
                </label>
                <div class="note"><strong>Note:</strong> 분류와 분류 사이는 | 로 구분하세요. (예: 질문|답변) 첫자로 #은 입력하지 마세요. (예: #질문|#답변 [X])</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_skin" class="label">스킨 디렉토리<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_skin_select('qa', 'qa_skin', 'qa_skin', $qaconfig['qa_skin'], 'required'); ?><i></i>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_mobile_skin" class="label">모바일 스킨 디렉토리<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <?php echo get_mobile_skin_select('qa', 'qa_mobile_skin', 'qa_mobile_skin', $qaconfig['qa_mobile_skin'], 'required'); ?><i></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">이메일 입력</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="qa_use_email" class="checkbox"><input type="checkbox" name="qa_use_email" value="1" id="qa_use_email" <?php echo $qaconfig['qa_use_email']?'checked':''; ?>><i></i> 보이기</label>
                        <label for="qa_req_email" class="checkbox"><input type="checkbox" name="qa_req_email" value="1" id="qa_req_email" <?php echo $qaconfig['qa_req_email']?'checked':''; ?>><i></i> 필수입력</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">휴대폰 입력</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="qa_use_hp" class="checkbox"><input type="checkbox" name="qa_use_hp" value="1" id="qa_use_hp" <?php echo $qaconfig['qa_use_hp']?'checked':''; ?>><i></i> 보이기</label>
                        <label for="qa_req_hp" class="checkbox"><input type="checkbox" name="qa_req_hp" value="1" id="qa_req_hp" <?php echo $qaconfig['qa_req_hp']?'checked':''; ?>><i></i> 필수입력</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_use_sms" class="label">SMS 알림</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="qa_use_sms" id="qa_use_sms">
                            <?php echo option_selected(0, $qaconfig['qa_use_sms'], '사용안함'); ?>
                            <?php echo option_selected(1, $qaconfig['qa_use_sms'], '사용함'); ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note:</strong> 휴대폰 입력을 사용하실 경우 문의글 등록시 등록자가 답변등록시 SMS 알림 수신을 선택할 수 있도록 합니다.<br>SMS 알림을 사용하기 위해서는 기본환경설정 > <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form#anc_cf_sms">SMS 설정</a>을 하셔야 합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_send_number" class="label">SMS 발신번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="qa_send_number" value="<?php echo get_sanitize_input($qaconfig['qa_send_number']); ?>" id="qa_send_number">
                    </label>
                    <div class="note margin-bottom-10"><strong>Note:</strong> SMS 알림 전송시 발신번호로 사용됩니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_admin_hp" class="label">관리자 휴대폰번호</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="qa_admin_hp" value="<?php echo get_sanitize_input($qaconfig['qa_admin_hp']); ?>" id="qa_admin_hp">
                    </label>
                    <div class="note"><strong>Note:</strong> 관리자 휴대폰번호를 입력하시면 문의글 등록시 등록하신 번호로 SMS 알림이 전송됩니다.<br>SMS 알림을 사용하지 않으시면 알림이 전송되지 않습니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_admin_email" class="label">관리자 이메일</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="qa_admin_email" value="<?php echo get_sanitize_input($qaconfig['qa_admin_email']); ?>" id="qa_admin_email">
                    </label>
                    <div class="note"><strong>Note:</strong> 관리자 이메일을 입력하시면 문의글 등록시 등록하신 이메일로 알림이 전송됩니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="qa_use_editor" class="label">DHTML 에디터 사용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="qa_use_editor" id="qa_use_editor">
                        <?php echo option_selected(0, $qaconfig['qa_use_editor'], '사용안함'); ?>
                        <?php echo option_selected(1, $qaconfig['qa_use_editor'], '사용함'); ?>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 글작성시 내용을 DHTML 에디터 기능으로 사용할 것인지 설정합니다. 스킨에 따라 적용되지 않을 수 있습니다.</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_subject_len" class="label">제목 길이<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">글자</i>
                        <input type="text" name="qa_subject_len" value="<?php echo $qaconfig['qa_subject_len']; ?>" id="qa_subject_len" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 목록에서의 제목 글자수</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_mobile_subject_len" class="label">모바일 제목 길이<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">글자</i>
                        <input type="text" name="qa_mobile_subject_len" value="<?php echo $qaconfig['qa_mobile_subject_len']; ?>" id="qa_mobile_subject_len" class="text-right" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 목록에서의 제목 글자수</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_page_rows" class="label">페이지당 목록 수<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="qa_page_rows" value="<?php echo $qaconfig['qa_page_rows']; ?>" id="qa_page_rows" class="text-end" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_mobile_page_rows" class="label">모바일 페이지당 목록 수<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">개</i>
                        <input type="text" name="qa_mobile_page_rows" value="<?php echo $qaconfig['qa_mobile_page_rows']; ?>" id="qa_mobile_page_rows" class="end-right" required>
                    </label>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_image_width" class="label">이미지 폭 크기<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">px</i>
                        <input type="text" name="qa_image_width" value="<?php echo $qaconfig['qa_image_width']; ?>" id="qa_image_width" class="text-end" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 게시판에서 출력되는 이미지의 폭 크기</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_upload_size" class="label">파일 업로드 용량<strong class="sound_only"> 필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <p>업로드 파일 한개당</p>
                    <div class="inline-group">
                        <span>
                            <label class="input max-width-250px">
                                <i class="icon-append">byte</i>
                                <input type="text" name="qa_upload_size" id="qa_upload_size" value="<?php echo $qaconfig['qa_upload_size']; ?>" required class="text-end">
                            </label>
                        </span>
                        <span>
                            <p>이하</p>
                        </span>
                    </div>
                    <div class="note"><strong>Note:</strong> 최대 <?php echo ini_get("upload_max_filesize"); ?> 이하 업로드 가능, 1 MB = 1,048,576 bytes</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_include_head" class="label">상단 파일 경로</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="qa_include_head" value="<?php echo get_sanitize_input($qaconfig['qa_include_head']); ?>" id="qa_include_head">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_include_tail" class="label">하단 파일 경로</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="qa_include_tail" value="<?php echo get_sanitize_input($qaconfig['qa_include_tail']); ?>" id="qa_include_tail">
                    </label>
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
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="qa_content_head" class="label">상단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("qa_content_head", get_text(html_purifier($qaconfig['qa_content_head']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="qa_content_tail" class="label">하단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("qa_content_tail", get_text(html_purifier($qaconfig['qa_content_tail']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="qa_mobile_content_head" class="label">모바일 상단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("qa_mobile_content_head", get_text(html_purifier($qaconfig['qa_mobile_content_head']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="qa_mobile_content_tail" class="label">모바일 하단 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="textarea">
                    <?php echo editor_html("qa_mobile_content_tail", get_text(html_purifier($qaconfig['qa_mobile_content_tail']), 0)); ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label for="qa_insert_content" class="label">글쓰기 기본 내용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea id="qa_insert_content" name="qa_insert_content" rows="5"><?php echo html_purifier($qaconfig['qa_insert_content']); ?></textarea>
                </label>
            </div>
        </div>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>1:1문의 여분필드</strong></div>
        <?php for ($i=1; $i<=5; $i++) { ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="qa_<?php echo $i; ?>_subj" class="label">여분필드 <?php echo $i; ?> 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="qa_<?php echo $i; ?>_subj" id="qa_<?php echo $i; ?>_subj" value="<?php echo get_text($config['qa_'.$i.'_subj']); ?>">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="qa_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?> 값</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="qa_<?php echo $i; ?>" id="qa_<?php echo $i; ?>" value="<?php echo $config['qa_'. $i]; ?>">
                    </label>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
var captcha_chk = false,
    qa_include_head = jQuery.trim(jQuery("#qa_include_head").val()),
    qa_include_tail = jQuery.trim(jQuery("#qa_include_tail").val());

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
    var head = jQuery.trim(jQuery("#qa_include_head").val());
    var tail = jQuery.trim(jQuery("#qa_include_tail").val());

    if(qa_include_head !== head || qa_include_tail !== tail){
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
        $("#qa_include_head, #qa_include_tail").on("change paste keyup", function(e) {
            frm_check_file();
        });

        use_captcha_check();
    }
});

function fqaconfigform_submit(f)
{
    <?php echo get_editor_js("qa_content_head"); ?>
    <?php echo get_editor_js("qa_content_tail"); ?>
    <?php echo get_editor_js("qa_mobile_content_head"); ?>
    <?php echo get_editor_js("qa_mobile_content_tail"); ?>

    if( captcha_chk ) {
        <?php echo isset($captcha_js) ? $captcha_js : ''; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    }

    return true;
}
</script>