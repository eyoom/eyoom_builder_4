<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/config/newwinform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-newwinform">
    <form name="frmnewwin" action="<?php echo $action_url1; ?>" onsubmit="return frmnewwin_check(this);" method="post" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="nw_id" value="<?php echo $nw_id; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="device" value="<?php echo $device; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">

    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>팝업레이어 <?php echo $html_title; ?></h3>
    </div>

    <div id="newwin-layer">
        <div class="adm-table-form-wrap">
            <header><strong><i class="fas fa-caret-right"></i> 팝업레이어 설정</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-info font-size-12 margin-bottom-0">
                        <i class="fas fa-info-circle"></i> 초기화면 접속 시 자동으로 뜰 팝업레이어를 설정합니다.
                    </p>
                </div>
            </fieldset>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label for="nw_subject" class="label">팝업 제목</label>
                            </th>
                            <td colspan="3">
                                <label class="input">
                                    <input type="text" name="nw_subject" id="nw_subject" value="<?php echo get_sanitize_input($nw['nw_subject']); ?>" required>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="nw_division" class="label">구분</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="nw_division" id="nw_division">
                                        <option value="both"  <?php echo get_selected($nw['nw_division'], 'both', true); ?>>커뮤니티와 쇼핑몰</option>
                                        <option value="comm"  <?php echo get_selected($nw['nw_division'], 'comm', true); ?>>커뮤니티</option>
                                        <option value="shop"  <?php echo get_selected($nw['nw_division'], 'shop', true); ?>>쇼핑몰</option>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 커뮤니티에 표시될 것인지 쇼핑몰에 표시될 것인지를 설정합니다.</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="nw_device" class="label">접속기기</label>
                            </th>
                            <td>
                                <label class="select form-width-250px">
                                    <select name="nw_device" id="nw_device">
                                        <option value="both"  <?php echo get_selected($nw['nw_device'], 'both', true); ?>>PC와 모바일</option>
                                        <option value="pc"  <?php echo get_selected($nw['nw_device'], 'pc', true); ?>>PC</option>
                                        <option value="mobile"  <?php echo get_selected($nw['nw_device'], 'mobile', true); ?>>모바일</option>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 팝업레이어가 표시될 접속기기를 설정합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="nw_disable_hours" class="label">시간</label>
                            </th>
                            <td colspan="3">
                                <label class="input form-width-250px">
                                    <i class="icon-append text-width">시간</i>
                                    <input type="text" name="nw_disable_hours" id="nw_disable_hours" value="<?php echo $nw['nw_disable_hours']; ?>" required>
                                </label>
                                <div class="note"><strong>Note:</strong> 고객이 다시 보지 않음을 선택할 시 몇 시간동안 팝업레이어를 보여주지 않을지 설정합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label for="nw_begin_time" class="label">시작일시</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="nw_begin_time" id="nw_begin_time" value="<?php echo $nw['nw_begin_time']; ?>" required maxlength="19">
                                </label>
                                <label class="checkbox" style="width:200px;">
                                    <input type="checkbox" name="nw_begin_chk" value="<?php echo date('Y-m-d 00:00:00', G5_SERVER_TIME); ?>" id="nw_begin_chk" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;"><i></i> 시작일시를 오늘로
                                </label>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label for="nw_end_time" class="label">종료일시</label>
                            </th>
                            <td>
                                <label class="input form-width-250px">
                                    <input type="text" name="nw_end_time" id="nw_end_time" value="<?php echo $nw['nw_end_time']; ?>" required maxlength="19">
                                </label>
                                <label class="checkbox" style="width:200px;">
                                    <input type="checkbox" name="nw_end_chk" value="<?php echo date('Y-m-d 00:00:00', G5_SERVER_TIME+(60*60*24*7)); ?>" id="nw_end_chk" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;"><i></i> 종료일시를 오늘로부터 7일 후로
                                </label>
                            </td>
                        </tr>
                        <?php if(0) { //팝업 사이즈, 팝업 위치 숨김 처리 시작 (해당 기능 불필요) ?>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">팝업 사이즈</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="nw_width" class="input form-width-200px">
                                            <i class="icon-prepend text-width">가로</i>
                                            <i class="icon-append text-width">px</i>
                                            <input type="text" name="nw_width" id="nw_width" value="<?php echo $nw['nw_width']; ?>" class="text-right" required>
                                        </label>
                                    </span>
                                    <span>x</span>
                                    <span>
                                        <label for="nw_height" class="input form-width-200px">
                                            <i class="icon-prepend text-width">세로</i>
                                            <i class="icon-append text-width">px</i>
                                            <input type="text" name="nw_height" id="nw_height" value="<?php echo $nw['nw_height']; ?>" class="text-right" required>
                                        </label>
                                    </span>
                                </div>
                                <div class="note"><strong>Note:</strong> 팝업 내용의 에디터에 이미지를 업로드할 경우, 가로 사이즈에 맞춰 올려주세요.</div>
                            </td>
                        <?php if (G5_IS_MOBILE) { ?>
                        </tr>
                        <tr>
                        <?php } ?>
                            <th class="table-form-th border-left-th">
                                <label class="label">팝업 위치</label>
                            </th>
                            <td>
                                <label for="nw_top" class="input form-width-200px">
                                    <i class="icon-prepend text-width">상단</i>
                                    <i class="icon-append text-width">px</i>
                                    <input type="text" name="nw_top" id="nw_top" value="<?php echo $nw['nw_top']; ?>" class="text-right" required>
                                </label>
                                <label for="nw_left" class="input form-width-200px">
                                    <i class="icon-prepend text-width">좌측</i>
                                    <i class="icon-append text-width">px</i>
                                    <input type="text" name="nw_left" id="nw_left" value="<?php echo $nw['nw_left']; ?>" class="text-right" required>
                                </label>
                            </td>
                        </tr>
                        <?php } //팝업 사이즈, 팝업 위치 숨김 처리 끝 ?>
                        <tr>
                            <th class="table-form-th">
                                <label for="nw_content" class="label">팝업 내용</label>
                            </th>
                            <td colspan="3">
                                <label class="textarea">
                                    <?php echo editor_html('nw_content', get_text(html_purifier($nw['nw_content']), 0)); ?>
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

        <div class="text-center margin-top-30 margin-bottom-30">
            <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=newwinlist&amp;<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">목록</a>
        </div>
    </div>
    </form>
</div>

<script>
function frmnewwin_check(f)
{
    errmsg = "";
    errfld = "";

    <?php echo get_editor_js('nw_content'); ?>

    check_field(f.nw_subject, "제목을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}
</script>