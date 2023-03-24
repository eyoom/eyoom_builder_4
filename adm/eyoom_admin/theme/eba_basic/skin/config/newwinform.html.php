<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/newwinform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();

/**
 * 페이지 경로 설정
 */
$fm_pid = 'newwinlist';
$g5_title = '팝업레이어관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
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

    <div id="newwin-layer">
        <div class="adm-form-table m-b-20">
            <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>팝업레이어 설정</strong></div>
            <div class="adm-form-info">
                <div class="cont-text-bg">
                    <p class="bg-info">
                        <i class="fas fa-info-circle"></i> 초기화면 접속 시 자동으로 출력되는 팝업레이어를 설정합니다.
                    </p>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="nw_subject" class="label">팝업 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="nw_subject" id="nw_subject" value="<?php echo get_sanitize_input($nw['nw_subject']); ?>" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label for="nw_division" class="label">구분</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="nw_division" id="nw_division">
                                <option value="comm"  <?php echo get_selected($nw['nw_division'], 'comm', true); ?>>커뮤니티</option>
                                <?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
                                <option value="both"  <?php echo get_selected($nw['nw_division'], 'both', true); ?>>커뮤니티와 쇼핑몰</option>
                                <option value="shop"  <?php echo get_selected($nw['nw_division'], 'shop', true); ?>>쇼핑몰</option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 커뮤니티에 표시될 것인지 쇼핑몰에 표시될 것인지를 설정합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label for="nw_device" class="label">접속기기</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="nw_device" id="nw_device">
                                <option value="both"  <?php echo get_selected($nw['nw_device'], 'both', true); ?>>PC와 모바일</option>
                                <option value="pc"  <?php echo get_selected($nw['nw_device'], 'pc', true); ?>>PC</option>
                                <option value="mobile"  <?php echo get_selected($nw['nw_device'], 'mobile', true); ?>>모바일</option>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 팝업레이어가 표시될 접속기기를 설정합니다.</div>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="nw_disable_hours" class="label">시간</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append text-width">시간</i>
                        <input type="text" name="nw_disable_hours" id="nw_disable_hours" value="<?php echo $nw['nw_disable_hours']; ?>" required>
                    </label>
                    <div class="note"><strong>Note:</strong> 고객이 다시 보지 않음을 선택할 시 몇 시간동안 팝업레이어를 보여주지 않을지 설정합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label for="nw_begin_time" class="label">시작일시</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="nw_begin_time" id="nw_begin_time" value="<?php echo $nw['nw_begin_time']; ?>" required maxlength="19">
                        </label>
                        <label class="checkbox">
                            <input type="checkbox" name="nw_begin_chk" value="<?php echo date('Y-m-d 00:00:00', G5_SERVER_TIME); ?>" id="nw_begin_chk" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;"><i></i> 시작일시를 오늘로
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label for="nw_end_time" class="label">종료일시</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="nw_end_time" id="nw_end_time" value="<?php echo $nw['nw_end_time']; ?>" required maxlength="19">
                        </label>
                        <label class="checkbox">
                            <input type="checkbox" name="nw_end_chk" value="<?php echo date('Y-m-d 23:59:59', G5_SERVER_TIME+(60*60*24*7)); ?>" id="nw_end_chk" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;"><i></i> 종료일시를 오늘로부터 7일 후로
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">팝업 사이즈</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label for="nw_width" class="input max-width-200px">
                                    <i class="icon-prepend">가로</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="nw_width" id="nw_width" value="<?php echo $nw['nw_width']; ?>" class="text-end" required>
                                </label>
                            </span>
                            <span>x</span>
                            <span>
                                <label for="nw_height" class="input max-width-200px">
                                    <i class="icon-prepend">세로</i>
                                    <i class="icon-append">px</i>
                                    <input type="text" name="nw_height" id="nw_height" value="<?php echo $nw['nw_height']; ?>" class="text-end" required>
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 팝업 내용의 에디터에 이미지를 업로드할 경우, 가로 사이즈에 맞춰 올려주세요.</div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">팝업 위치</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="nw_top" class="input max-width-200px">
                            <i class="icon-prepend">상단</i>
                            <i class="icon-append">px</i>
                            <input type="text" name="nw_top" id="nw_top" value="<?php echo $nw['nw_top']; ?>" class="text-end" required>
                        </label>
                        <label for="nw_left" class="input max-width-200px">
                            <i class="icon-prepend">좌측</i>
                            <i class="icon-append">px</i>
                            <input type="text" name="nw_left" id="nw_left" value="<?php echo $nw['nw_left']; ?>" class="text-end" required>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr adm-sm-100">
                <div class="adm-form-td td-l">
                    <label for="nw_content" class="label">팝업 내용</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="textarea">
                        <?php echo editor_html('nw_content', get_text(html_purifier($nw['nw_content']), 0)); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=newwinlist&amp;<?php echo $qstr; ?>" class="btn-e btn-e-lg btn-e-dark">목록</a>
        </div>
    </div>

    <?php echo $frm_eba_submit; ?>

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
    f.target = 'blank_iframe';
    return true;
}
</script>