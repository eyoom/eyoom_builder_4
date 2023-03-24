<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/boardgroup_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'boardgroup_list';
$g5_title = '게시판그룹관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-boardgroup-form">
    <form name="fboardform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardgroup_check(this)" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gr_id" class="label">그룹 ID</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input max-width-250px">
                            <input type="text" name="gr_id" id="gr_id" value="<?php echo $group['gr_id']; ?>" maxlength="20" <?php echo $gr_id_attr; ?>>
                        </label>
                    </span>
                    <?php if ($w=='u') { ?>
                        <span><a href="<?php echo get_eyoom_pretty_url(G5_GROUP_DIR,$group['gr_id']); ?>" target="_blank" class="btn-e btn-e-lg btn-e-dark">게시판그룹 바로가기</a></span>
                    <?php } ?>
                    <?php if ($w=='') { ?>
                    <span>영문자, 숫자, _ 만 가능 (공백없이)</span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gr_subject" class="label">그룹 제목</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="input max-width-250px">
                            <input type="text" name="gr_subject" value="<?php echo get_text($group['gr_subject']); ?>" id="gr_subject" required>
                        </label>
                    </span>
                    <?php if ($w=='u') { ?>
                    <span>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;gr_id=<?php echo $group['gr_id']; ?>" class="btn-e btn-e-lg btn-e-dark">그룹 내 게시판 생성</a>
                    </span>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gr_device" class="label">접속기기</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select id="gr_device" name="gr_device">
                        <option value="both"<?php echo get_selected($group['gr_device'], 'both'); ?>>PC와 모바일에서 모두 사용</option>
                        <option value="pc"<?php echo get_selected($group['gr_device'], 'pc'); ?>>PC 전용</option>
                        <option value="mobile"<?php echo get_selected($group['gr_device'], 'mobile'); ?>>모바일 전용</option>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> PC 와 모바일 사용을 구분합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label <?php if ($is_admin == 'super') { ?>for="gr_admin"<?php } ?> class="label">그룹 관리자</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <?php if ($is_admin == 'super') { ?>
                    <input type="text" name="gr_admin" value="<?php echo $gr['gr_admin']; ?>" id="gr_admin" maxlength="20">
                    <?php } else { ?>
                    <input type="hidden" name="gr_admin" value="<?php echo $gr['gr_admin']; ?>" id="gr_admin"><?php echo $gr['gr_admin']; ?>
                    <?php } ?>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gr_use_access" class="label">접근회원사용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="checkbox">
                    <input type="checkbox" name="gr_use_access" value="1" id="gr_use_access" <?php echo $gr['gr_use_access'] ? 'checked':''; ?>><i></i> 사용 <strong class="text-crimson">[ 접근회원수 : <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_list&amp;gr_id=<?php echo $gr_id; ?>"><?php echo number_format($grmember_cnt); ?></a> ]</strong>
                </label>
                <div class="note"><strong>Note:</strong> 사용에 체크하시면 이 그룹에 속한 게시판은 접근가능한 회원만 접근이 가능합니다.</div>
            </div>
        </div>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시판 그룹 여분필드 설정</strong></div>
        <?php for ($i=1; $i<=10; $i++) { ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="gr_<?php echo $i; ?>_subj" class="label">여분필드 <?php echo $i; ?> 제목</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="gr_<?php echo $i; ?>_subj" id="gr_<?php echo $i; ?>_subj" value="<?php echo get_text($config['gr_'.$i.'_subj']); ?>">
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="gr_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?> 값</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="gr_<?php echo $i; ?>" id="gr_<?php echo $i; ?>" value="<?php echo get_sanitize_input($gr['gr_'.$i]); ?>">
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

    <?php if (!$wmode) { ?>
    <div class="m-t-20">
        <div class="cont-text-bg">
            <p class="bg-info">
            <i class="fas fa-info-circle"></i> 게시판을 생성하시려면 1개 이상의 게시판그룹이 필요합니다.<br>
                <i class="fas fa-info-circle"></i> 게시판그룹을 이용하시면 더 효과적으로 게시판을 관리할 수 있습니다.
            </p>
        </div>
    </div>
    <?php } ?>
</div>

<script>
function fboardgroup_check(f) {
    return true;
}
</script>