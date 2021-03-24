<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/num_book_file.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
#sms5_fileup_frm {margin:0;padding:0;border-bottom:0}
#sms5_fileup_frm div {padding:0;border-bottom:0}
#sms5_fileup_frm strong {display:inherit;width:inherit}
</style>

<div class="admin-num-book-file">
    <div class="adm-headline">
        <h3>파일 업로드</h3>
    </div>

    <div class="alert alert-success">
        <p>
            엑셀에 저장된 휴대폰번호 목록을 데이터베이스에 저장할 수 있습니다.<br><br>
            엑셀에는 이름과 휴대폰번호 두개만 저장해주세요. 첫번째 라인부터 저장됩니다.<br>
            ※ 휴대폰번호에 하이픈(-)은 포함되어도 되고 포함되지 않아도 됩니다.<br><br>
            엑셀파일은 XLS( Excel 97 - 2003 통합 문서 ) 또는 CSV형식만 업로드 할수 있습니다. (xlsx 불가)<br>
            <strong>CSV 저장방법 : 파일 > 다른 이름으로 저장 > 파일형식 : CSV (쉼표로 분리) (*.CSV)</strong><br><br>
            이 작업을 실행하기 전에 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=member_update" target="_blank" class="btn-e btn-e-xs btn-e-dark">회원정보업데이트</a>를 먼저 실행해주세요.
        </p>
    </div>

    <form name="upload_form" method="post" enctype="multipart/form-data" id="sms5_fileup_frm" class="eyoom-form">
    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> 파일 업로드</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="upload_bg_no" class="label">그룹선택</label>
                        </th>
                        <td>
                            <label class="select form-width-300px">
                                <select name="upload_bg_no" id="upload_bg_no">
                                    <option value=""></option>
                                    <option value="1"> <?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?>) </option>
                                    <?php for ($i=0; $i<count((array)$group); $i++) { ?>
                                    <option value="<?php echo $group[$i]['bg_no']?>"> <?php echo $group[$i]['bg_name']?> (<?php echo number_format($group[$i]['bg_count'])?>) </option>
                                    <?php } ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="csv" class="label">파일선택</label>
                        </th>
                        <td>
                            <div id="sms5_fileup">
                                <input type="file" name="csv" id="csv" onchange="document.getElementById('upload_info').style.display='none';">
                                <span id="upload_button">
                                    <input type="button" value="파일전송" onclick="upload();" class="btn_submit btn-e btn-e-xlg btn-e-red margin-top-20 width-150px">
                                </span>
                                <span id="uploading" class="sms_fileup_hide">
                                    파일을 업로드 중입니다. 잠시만 기다려주세요.
                                </span>

                                <div id="upload_info" class="sms_fileup_hide"></div>
                                <div id="register" class="sch_last sms_fileup_hide">
                                    휴대폰번호를 DB에 저장중 입니다. 잠시만 기다려주세요.
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>
    </form>

    <div class="adm-headline margin-top-40">
        <h3>파일 다운로드</h3>
    </div>

    <div class="alert alert-warning">
        <p>
            저장된 휴대폰번호 목록을 엑셀(xls) 파일로 다운로드 할 수 있습니다.<br>
            다운로드 할 휴대폰번호 그룹을 선택해주세요.
        </p>
    </div>
    
    <div class="eyoom-form">
        <div class="adm-table-form-wrap">
            <header><strong><i class="fas fa-caret-right"></i> 파일 다운로드</strong></header>
            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">세부선택</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label class="checkbox"><input type="checkbox" value="1" id="no_hp"><i></i>휴대폰 번호 없는 회원 포함</label>
                                    <label class="checkbox"><input type="checkbox" value="1" id="hyphen"><i></i>하이픈 '―' 포함</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="download_bg_no" class="label">그룹선택</label>
                            </th>
                            <td>
                                <label class="select form-width-300px">
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
                                <button type="button" onclick="download()" class="btn_01 btn-e btn-e-xlg btn-e-red margin-top-20 width-150px">다운로드</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!G5_IS_MOBILE) { ?>
                </div>
                <?php } ?>
            </div>
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