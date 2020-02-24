<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/board/boardgroup_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
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

    <div class="adm-headline">
        <h3>게시판 그룹 <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> 게시판 그룹 <?php echo $html_title; ?></strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="gr_id" class="label">그룹 ID</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="gr_id" id="gr_id" value="<?php echo $group['gr_id']; ?>" maxlength="20" <?php echo $gr_id_attr; ?>>
                                    </label>
                                </span>
                                <?php if ($w=='u') { ?>
                                <span>
                                    <a href="<?php echo get_eyoom_pretty_url(G5_GROUP_DIR,$group['gr_id']); ?>" target="_blank" class="btn-e btn-e-yellow">게시판 그룹 바로가기</a>
                                </span>
                                <?php } ?>
                            </div>
                            <?php if ($w=='') { ?>
                            <div class="note"><strong>Note:</strong> 영문자, 숫자, _ 만 가능 (공백없이)</div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="gr_subject" class="label">그룹 제목</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="gr_subject" value="<?php echo get_text($group['gr_subject']); ?>" id="gr_subject" required>
                                    </label>
                                </span>
                                <?php if ($w=='u') { ?>
                                <span>
                                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;gr_id=<?php echo $group['gr_id']; ?>" class="btn-e btn-e-dark">그룹 내 게시판 생성</a>
                                </span>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="gr_device" class="label">접속기기</label>
                        </th>
                        <td colspan="3">
                            <label class="select form-width-250px">
                                <select id="gr_device" name="gr_device">
                                    <option value="both"<?php echo get_selected($group['gr_device'], 'both'); ?>>PC와 모바일에서 모두 사용</option>
                                    <option value="pc"<?php echo get_selected($group['gr_device'], 'pc'); ?>>PC 전용</option>
                                    <option value="mobile"<?php echo get_selected($group['gr_device'], 'mobile'); ?>>모바일 전용</option>
                                </select><i></i>
                            </label>
                            <div class="note margin-bottom-10"><strong>Note:</strong> PC 와 모바일 사용을 구분합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label <?php if ($is_admin == 'super') { ?>for="gr_admin"<?php } ?> class="label">그룹 관리자</label>
                        </th>
                        <td colspan="3">
                            <label class="input form-width-250px">
                                <?php if ($is_admin == 'super') { ?>
                                <input type="text" name="gr_admin" value="<?php echo $gr['gr_admin']; ?>" id="gr_admin" maxlength="20">
                                <?php } else { ?>
                                <input type="hidden" name="gr_admin" value="<?php echo $gr['gr_admin']; ?>" id="gr_admin"><?php echo $gr['gr_admin']; ?>
                                <?php } ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="gr_use_access" class="label">접근회원사용</label>
                        </th>
                        <td colspan="3">
                            <label class="checkbox" style="width:120px;">
                                <input type="checkbox" name="gr_use_access" value="1" id="gr_use_access" <?php echo $gr['gr_use_access'] ? 'checked':''; ?>><i></i> 사용 <strong class="color-orange">[ 접근회원수 : <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_list&amp;gr_id=<?php echo $gr_id; ?>"><?php echo number_format($grmember_cnt); ?></a> ]</strong>
                            </label>
                            <div class="note margin-bottom-10"><strong>Note:</strong> 사용에 체크하시면 이 그룹에 속한 게시판은 접근가능한 회원만 접근이 가능합니다.</div>
                        </td>
                    </tr>
                    <?php for ($i=1; $i<=10; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="gr_<?php echo $i; ?>_subj" class="label">여분필드 <?php echo $i; ?> 제목</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="gr_<?php echo $i; ?>_subj" id="gr_<?php echo $i; ?>_subj" value="<?php echo get_text($config['gr_'.$i.'_subj']); ?>">
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="gr_<?php echo $i; ?>" class="label">여분필드 <?php echo $i; ?> 값</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="gr_<?php echo $i; ?>" id="gr_<?php echo $i; ?>" value="<?php echo get_sanitize_input($gr['gr_'.$i]); ?>">
                            </label>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; // 버튼 ?>

    </form>
</div>

<?php if (!$wmode) { ?>
<div class="margin_top_20">
    <div class="cont-text-bg">
        <p class="bg-info font-size-12">
            <i class="fas fa-info-circle"></i> 게시판을 생성하시려면 1개 이상의 게시판그룹이 필요합니다.<br>
            <i class="fas fa-info-circle"></i> 게시판그룹을 이용하시면 더 효과적으로 게시판을 관리할 수 있습니다.
        </p>
    </div>
</div>
<?php } ?>

<script>
function fboardgroup_check(f) {
    return true;
}
</script>