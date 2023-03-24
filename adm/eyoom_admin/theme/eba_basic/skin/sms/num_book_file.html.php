<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/num_book_file.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'num_book_file';
$g5_title = '휴대폰번호 파일';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-num-book-file .sms_fileup_hide {display:none;border:0}
</style>

<div class="admin-num-book-file">
    <form name="upload_form" method="post" enctype="multipart/form-data" class="eyoom-form">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>파일 업로드</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    엑셀에 저장된 휴대폰번호 목록을 데이터베이스에 저장할 수 있습니다.<br><br>
                    엑셀에는 이름과 휴대폰번호 두개만 저장해주세요. 첫번째 라인부터 저장됩니다.<br>
                    ※ 휴대폰번호에 하이픈(-)은 포함되어도 되고 포함되지 않아도 됩니다.<br><br>
                    엑셀파일은 XLS( Excel 97 - 2003 통합 문서 ) 또는 CSV형식만 업로드 할수 있습니다. (xlsx 불가)<br>
                    <strong>CSV 저장방법 : 파일 > 다른 이름으로 저장 > 파일형식 : CSV (쉼표로 분리) (*.CSV)</strong><br><br>
                    이 작업을 실행하기 전에 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=member_update" target="_blank" class="btn-e btn-e-xs btn-e-dark">회원정보업데이트</a>를 먼저 실행해주세요.
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="upload_bg_no" class="label">그룹선택</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-200px">
                    <select name="upload_bg_no" id="upload_bg_no">
                        <option value=""></option>
                        <option value="1"> <?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?>) </option>
                        <?php for ($i=0; $i<count((array)$group); $i++) { ?>
                        <option value="<?php echo $group[$i]['bg_no']?>"> <?php echo $group[$i]['bg_name']?> (<?php echo number_format($group[$i]['bg_count'])?>) </option>
                        <?php } ?>
                    </select><i></i>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="csv" class="label">파일선택</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input">
                    <input type="file" class="form-control" name="csv" id="csv" onchange="document.getElementById('upload_info').style.display='none';">
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn text-center m-b-20" id="sms5_fileup">
        <div id="upload_button" class="m-b-10">
            <input type="button" value="파일전송" onclick="upload();" class="btn_submit btn-e btn-e-lg btn-e-crimson">
        </div>
        <span id="uploading" class="sms_fileup_hide">
            파일을 업로드 중입니다. 잠시만 기다려주세요.
        </span>
        <div id="upload_info" class="sms_fileup_hide"></div>
        <div id="register" class="sch_last sms_fileup_hide">
            휴대폰번호를 DB에 저장중 입니다. 잠시만 기다려주세요.
        </div>
    </div>

    </form>
    
    <div class="eyoom-form">
        <div class="adm-form-table m-b-20">
            <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>파일 다운로드</strong></div>
            <div class="adm-form-info">
                <div class="cont-text-bg">
                    <p class="bg-info">
                        저장된 휴대폰번호 목록을 엑셀(xls) 파일로 다운로드 할 수 있습니다.<br>
                        다운로드 할 휴대폰번호 그룹을 선택해주세요.
                    </p>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">세부선택</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label class="checkbox"><input type="checkbox" value="1" id="no_hp"><i></i>휴대폰 번호 없는 회원 포함</label>
                        <label class="checkbox"><input type="checkbox" value="1" id="hyphen"><i></i>하이픈 '―' 포함</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="download_bg_no" class="label">그룹선택</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-250px">
                        <select name="download_bg_no" id="download_bg_no">
                            <option value=""> </option>
                            <option value="all"> 전체 </option>
                            <option value="1"> <?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?>) </option>
                            <?php for ($i=0; $i<count((array)$group); $i++) { ?>
                            <option value="<?php echo $group[$i]['bg_no']?>"> <?php echo $group[$i]['bg_name']?> (<?php echo number_format($group[$i]['bg_count'])?>) </option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <button type="button" onclick="download()" class="btn_01 btn-e btn-e-lg btn-e-crimson">다운로드</button>
        </div>
    </div>
</div>

<script>
function upload(w)
{
    var f = document.upload_form;

    if (typeof w == 'undefined') {
        document.getElementById('upload_button').style.display = 'none';
        document.getElementById('uploading').style.display = 'inline';
        document.getElementById('upload_info').style.display = 'none';
        f.action = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book_file_upload&confirm=1&smode=1';
    } else {
        document.getElementById('upload_button').style.display = 'none';
        document.getElementById('upload_info').style.display = 'none';
        document.getElementById('register').style.display = 'block';
        f.action = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book_file_upload&smode=1';
    }

    (function($){
        if(!document.getElementById("fileupload_fr")){
            var i = document.createElement('iframe');
            i.setAttribute('id', 'fileupload_fr');
            i.setAttribute('name', 'fileupload_fr');
            i.style.display = 'none';
            document.body.appendChild(i);
        }
        f.target = 'fileupload_fr';
        f.submit();
    })(jQuery);
}

function download()
{
    var bg_no = document.getElementById('download_bg_no');
    var no_hp = document.getElementById('no_hp');
    var hyphen = document.getElementById('hyphen');
    var par = '';

    if (!bg_no.value.length) {
        alert('다운로드 할 휴대폰번호 그룹을 선택해주세요.');
        return;
    }

    if (no_hp.checked) no_hp = 1; else no_hp = 0;
    if (hyphen.checked) hyphen = 1; else hyphen = 0;

    par += '&bg_no=' + bg_no.value;
    par += '&no_hp=' + no_hp;
    par += '&hyphen=' + hyphen;

    (function($){
        if(!document.getElementById("fileupload_fr")){
            var i = document.createElement('iframe');
            i.setAttribute('id', 'fileupload_fr');
            i.setAttribute('name', 'fileupload_fr');
            i.style.display = 'none';
            document.body.appendChild(i);
        }
        fileupload_fr.location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book_file_download&smode=1&' + par;
    })(jQuery);
}
</script>