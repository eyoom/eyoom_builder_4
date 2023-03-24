<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/somoim/somo__form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'config_form';
$g5_title = '소모임 관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">소모임관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-somo_-form">
    <form name="fsomoimform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fsomoimform_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="smc" value="<?php echo $smc; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="sm_admin" value="<?php echo $sm['sm_admin']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">
    
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>소모임 <?php echo $html_title; ?></strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 소모임 신청 제목 : <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $sm_bo_table; ?>&amp;wr_id=<?php echo $sainfo['wr_id']; ?>&amp;wmode=1" onclick="eb_modal(this.href); return false;"><strong><?php echo get_text($sainfo['wr_subject']); ?></strong></a><br>
                    <i class="fas fa-info-circle"></i> 신청자 계정 : <strong><?php echo $sainfo['mb_id']; ?> (<?php echo $sainfo['wr_name']; ?>)</strong>
                </p>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_id" class="label">소모임 ID</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input width-250px">
                            <input type="text" name="sm_id" id="sm_id" value="<?php echo $sm['sm_id'] ? $sm['sm_id']: $somo['sm_prepned']; ?>" maxlength="20" <?php echo $sm_id_attr; ?>>
                        </label>
                    </span>
                    <?php if ($w=='u') { ?>
                    <span>
                        <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $sm['sm_id']; ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">소모임 바로가기</a>
                    </span>
                    <?php } ?>
                </div>
                <?php if ($w=='') { ?>
                <div class="note"><strong>Note:</strong> 영문자, 숫자, _ 만 가능 (공백없이)</div>
                <?php } ?>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_subject" class="label">소모임 제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="sm_subject" value="<?php echo get_text($sm['sm_subject']); ?>" id="sm_subject" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb-id" class="label">소모임 관리자</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input input-button max-width-500px">
                    <input type="text" name="mb_id" id="mb_id" value="<?php echo $sm['sm_admin'] ? $sm['sm_admin']: $sainfo['mb_id']; ?>" required>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="button"><input type="button">회원검색<i class="far fa-window-restore m-l-7"></i></a>
                </div>
                <div class="note">Note! '회원검색' 클릭후 회원아이디를 검색/선택하세요.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_category" class="label">소모임 카테고리</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select id="sm_category" name="sm_category" required>
                        <option value=''>선택하세요</option>
                        <?php
                        foreach($sm_category as $key=>$value) {
                            $selected = $sm['sm_category'] == $value ? 'selected': '';
                            echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                        }
                        ?>
                    </select><i></i>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_introduce" class="label">짧은 소개</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="sm_introduce" id="sm_introduce" value="<?php echo get_text($sm['sm_introduce']); ?>" required>
                </label>
                <div class="note"><strong>Note:</strong> 30자 이내</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">공개여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label class="radio"><input type="radio" name="sm_open" id="sm_open_y" value="y" <?php echo $sm['sm_open'] == 'y' || ! $sm['sm_open'] ? 'checked':''; ?>><i></i>보이기</label>
                    <label class="radio"><input type="radio" name="sm_open" id="sm_open_n" value="n" <?php echo $sm['sm_open'] == 'n' ? 'checked':''; ?>><i></i>숨기기</label>
                </div>
                <div class="note"><strong>Note:</strong> 소모임의 공개여부를 선택해 주세요.</div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 검색</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
function eb_modal(href) {
    <?php if (!$wmode) { ?>
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    <?php } ?>
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};

function fsomo__check(f) {
    return true;
}
</script>