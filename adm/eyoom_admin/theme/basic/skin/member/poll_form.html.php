<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/poll_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
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

    <div class="adm-headline">
        <h3>투표 <?php echo $html_title; ?></h3>
    </div>

    <div class="adm-table-form-wrap">
        <header><i class="fas fa-caret-right"></i> 투표 <?php echo $html_title; ?></strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_subject" class="label">투표 제목</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="po_subject" id="po_subject" value="<?php echo get_sanitize_input($po['po_subject']); ?>" required maxlength="125">
                            </label>
                        </td>
                    </tr>
                    <?php
                    for ($i=1; $i<=9; $i++) {
                        $required = '';
                        if ($i==1 || $i==2) {
                            $required = 'required';
                            $sound_only = '<strong class="sound_only">필수</strong>';
                        }

                        $po_poll = get_text($po['po_poll'.$i]);
                    ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_poll<?php echo $i ?>" class="label">항목 <?php echo $i ?></label>
                        </th>
                        <td>
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <span>
                                    <label class="input form-width-250px">
                                        <i class="icon-prepend"><?php echo $i ?></i>
                                        <input type="text" name="po_poll<?php echo $i ?>" id="po_poll<?php echo $i ?>" value="<?php echo $po_poll ?>" <?php echo $required ?>>
                                    </label>
                                </span>
                                <span>
                                    <label class="input">
                                        <i class="icon-prepend text-width">투표</i>
                                        <i class="icon-append">건</i>
                                        <input type="text" name="po_cnt<?php echo $i ?>" id="po_cnt<?php echo $i ?>" value="<?php echo $po['po_cnt'.$i] ?>" class="text-right">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_etc" class="label">기타의견</label>
                        </th>
                        <td>
                            <label class="input">
                                <input type="text" name="po_etc" id="po_etc" value="<?php echo get_text($po['po_etc']) ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 기타 의견을 남길 수 있도록 하려면, 간단한 질문을 입력하세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_level" class="label">투표가능 회원레벨</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <?php echo get_member_level_select('po_level', 1, 10, $po['po_level']) ?>
                                <i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_point" class="label">투표 포인트</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <i class="icon-append">점</i>
                                <input type="text" name="po_point" id="po_point" value="<?php echo $po['po_point']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 설정한 포인트를 투표 참여 회원에게 제공합니다.</div>
                        </td>
                    </tr>
                    <?php if ($w == 'u') { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">투표등록일</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" class="color-blue-important" value="<?php echo $po['po_date']; ?>" readonly>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="po_ips" class="label">투표참가 IP</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <textarea name="po_ips" id="po_ips" readonly rows="5"><?php echo preg_replace("/\n/", " / ", $po['po_ips']) ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_ids" class="label">투표참가 회원</label>
                        </th>
                        <td>
                            <label class="textarea">
                                <textarea name="mb_ids" id="mb_ids" readonly rows="5"><?php echo preg_replace("/\n/", " / ", $po['mb_ids']) ?></textarea>
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

    <?php echo $frm_submit; ?>

    </form>
</div>