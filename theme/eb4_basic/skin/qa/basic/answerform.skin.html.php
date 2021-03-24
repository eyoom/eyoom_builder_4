<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/answerform.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view-ans textarea {min-height:250px}
.view-ans-divider {position:relative;height:1px;border-top:1px solid #d5d5d5;margin:30px 0}
.view-ans-divider .divider-circle {position:absolute;top:-7px;left:50%;margin-left:-7px;width:14px;height:14px;border:2px solid #d5d5d5;background:#fff;z-index:1px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
/* Ckeditor */
.board-view-ans a.cke_button {padding:2px 5px}
.board-view-ans a.cke_button_on {padding:1px 4px}
.board-view-ans a.cke_button_off:hover, .board-view-ans a.cke_button_off:focus, .board-view-ans a.cke_button_off:active {padding:1px 4px}
/* Smart Editor */
.cke_sc {margin-bottom:10px}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px}
.cke_sc_def button {padding:3px 15px;background:#53535a;color:#fff;border:none}
/* Summernote */
.eyoom-form .note-editor *, .eyoom-form .note-editor *:after, .eyoom-form .note-editor *:before {box-sizing:border-box;-moz-box-sizing:border-box}
.eyoom-form .note-editor.panel-default>.panel-heading {background-color:#eaecee;border:0;border-bottom:1px solid #A9A9A9}
.panel-heading.note-toolbar .note-color .dropdown-menu {padding-top:6px;padding-bottom:6px;padding-left:1px}
</style>

<div class="view-ans-divider"><span class="divider-circle"></span></div>
<div class="board-view-ans">
    <?php if ($is_admin) { //#1 ?>
    <h4><strong>답변등록</strong></h4>
    <form name="fanswer" method="post" action="<?php echo G5_BBS_URL; ?>/qawrite_update.php" onsubmit="return fwrite_submit(this);" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="qa_id" value="<?php echo $view['qa_id']; ?>">
    <input type="hidden" name="w" value="a">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <?php if ($is_dhtml_editor) { ?>
    <input type="hidden" name="qa_html" value="1">
    <?php } ?>
    <div class="margin-hr-15"></div>
    <section>
        <label for="qa_subject" class="label">제목<strong class="sound_only"> 필수</strong></label>
        <label class="input required-mark">
            <input type="text" name="qa_subject" value="" id="qa_subject" required size="50" maxlength="255">
        </label>
    </section>
    <div class="margin-hr-15"></div>
    <?php if (!$is_dhtml_editor) { ?>
    <section>
        <div class="row">
            <div class="col col-4">
                <label for="qa_html" class="checkbox"><input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="<?php echo $html_value; ?>" <?php echo $html_checked; ?>><i></i>HTML</label>
            </div>
        </div>
    </section>
    <div class="margin-hr-15"></div>
    <?php } ?>
    <section>
        <label class="label">답변 내용</label>
        <label class="textarea textarea-resizable">
            <?php echo $editor_html; ?>
        </label>
    </section>
    <div class="margin-hr-15"></div>
    <section class="text-center">
        <input type="submit" value="답변쓰기" id="btn_submit" accesskey="s" class="btn-e btn-e-red btn-e-xlg">
    </section>
    </form>
    <?php } else { //#1 ?>
    <h6 class="text-center margin-top-10">고객님의 문의에 대한 답변을 준비 중입니다.</h6>
    <?php } //#1 ?>
</div>
<div class="view-ans-divider"><span class="divider-circle"></span></div>

<script>
function html_auto_br(obj) {
    if (obj.checked) {
        swal({
            title: "자동 줄바꿈",
            text: "자동 줄바꿈을 하시겠습니까?\n자동 줄바꿈은 게시물 내용 중 줄바뀐 곳을 <br>태그로 변환하는 기능입니다.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FF9500",
            confirmButtonText: "승인",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                obj.value = "2";
            } else {
                obj.value = "1";
            }
        });
    }
    else
        obj.value = "";
}

function fwrite_submit(f) {
    <?php echo $editor_js; ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.qa_subject.value,
            "content": f.qa_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        swal({
            html: true,
            title: "알림!",
            text: "제목에 금지단어 '<strong class='color-red'>"+subject+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        f.qa_subject.focus();
        return false;
    }

    if (content) {
        swal({
            html: true,
            title: "알림!",
            text: "내용에 금지단어 '<strong class='color-red'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        if (typeof(ed_qa_content) != "undefined")
            ed_qa_content.returnFalse();
        else
            f.qa_content.focus();
        return false;
    }

    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.write.token.php",
        data: { 'token_case' : 'qa_write' },
        cache: false,
        async: false,
        dataType: "json",
        success: function(data) {
            if (typeof data.token !== "undefined") {
                token = data.token;
                if(typeof f.token === "undefined")
                    $(f).prepend('<input type="hidden" name="token" value="">');
                $(f).find("input[name=token]").val(token);
            }
        }
    });

    document.getElementById("btn_submit").disabled = "disabled";
    return true;
}
</script>