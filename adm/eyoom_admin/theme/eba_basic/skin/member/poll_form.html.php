<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/poll_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'poll_list';
$g5_title = '투표관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<div class="admin-poll-form">
    <form name="fpoll" id="fpoll" method="post" action="<?php echo $action_url1; ?>" class="eyoom-form" enctype="multipart/form-data">
    <input type="hidden" name="po_id" value="<?php echo $po_id; ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $html_title; ?></strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_subject" class="label">투표 제목</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="po_subject" id="po_subject" value="<?php echo get_sanitize_input($po['po_subject']); ?>" required maxlength="125">
                </label>
            </div>
        </div>
        <?php
        for ($i=1; $i<=9; $i++) {
            $required = '';
            if ($i==1 || $i==2) {
                $required = 'required';
                $sound_only = '<strong class="sound_only">필수</strong>';
            }

            $po_poll = get_text($po['po_poll'.$i]);
        ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_poll<?php echo $i ?>" class="label">항목 <?php echo $i ?></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <i class="icon-prepend"><?php echo $i ?></i>
                    <input type="text" name="po_poll<?php echo $i ?>" id="po_poll<?php echo $i ?>" value="<?php echo $po_poll ?>" <?php echo $required ?>>
                </label>
                <label class="input width-150px">
                    <i class="icon-prepend text-width">투표</i>
                    <i class="icon-append">건</i>
                    <input type="text" name="po_cnt<?php echo $i ?>" id="po_cnt<?php echo $i ?>" value="<?php echo $po['po_cnt'.$i] ?>" class="text-end">
                </label>
            </div>
        </div>
        <?php } ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_etc" class="label">기타의견</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="po_etc" id="po_etc" value="<?php echo get_text($po['po_etc']) ?>">
                </label>
                <div class="note"><strong>Note:</strong> 기타 의견을 남길 수 있도록 하려면, 간단한 질문을 입력하세요.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_level" class="label">투표가능 회원레벨</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <?php echo get_member_level_select('po_level', 1, 10, $po['po_level']) ?>
                    <i></i>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_point" class="label">투표 포인트</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">점</i>
                    <input type="text" name="po_point" id="po_point" value="<?php echo $po['po_point']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 설정한 포인트를 투표 참여 회원에게 제공합니다.</div>
            </div>
        </div>
        <?php if ($w == 'u') { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">투표사용</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="checkbox"><input type="checkbox" name="po_use" id="po_use" value="1" <?php if ($po['po_use']) { echo 'checked="checked"'; } ?>><i></i>사용</label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">투표등록일</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" class="color-blue-important" value="<?php echo $po['po_date']; ?>" readonly>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_ips" class="label">투표참가 IP</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="po_ips" id="po_ips" readonly rows="5"><?php echo html_purifier(preg_replace("/\n/", " / ", $po['po_ips'])); ?></textarea>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_ids" class="label">투표참가 회원</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="textarea">
                    <textarea name="mb_ids" id="mb_ids" readonly rows="5"><?php echo html_purifier(preg_replace("/\n/", " / ", $po['mb_ids'])); ?></textarea>
                </label>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>