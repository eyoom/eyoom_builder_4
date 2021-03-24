<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/mail_select_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-mail-select-form">
    <form name="frmsendmailselectform" id="frmsendmailselectform" method="post" action="<?php echo $action_url1; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="ma_id" value="<?php echo $ma_id; ?>">

    <div class="adm-headline">
        <h3>회원메일발송 대상 선택</h3>
    </div>

    <div class="cont-text-bg">
        <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 전체회원 <?php echo number_format($tot_cnt); ?>명 , 탈퇴대기회원 <?php echo number_format($finish_cnt); ?>명, 정상회원 <?php echo number_format($tot_cnt - $finish_cnt); ?>명 중 메일 발송 대상 선택</p>
    </div>
    <div class="margin-bottom-20"></div>

    <div class="adm-table-form-wrap">
        <header><strong><i class="fas fa-caret-right"></i> 대상선택</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="ma_subject" class="label">선택 방식</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_id1_all" class="radio"><input type="radio" name="mb_id1" value="1" id="mb_id1_all" <?php echo $mb_id1?"checked":""; ?>><i></i> 전체</label>
                                <label for="mb_id1_section" class="radio input"><input type="radio" name="mb_id1" value="0" id="mb_id1_section" <?php echo !$mb_id1?"checked":""; ?>><i></i> 구간</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="ma_subject" class="label">아이디 범위 (알파벳)</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="mb_id1_from" class="input">
                                        <input type="text" name="mb_id1_from" value="<?php echo get_sanitize_input($mb_id1_from); ?>" id="mb_id1_from" title="시작구간">
                                    </label>
                                </span>
                                <span> - </span>
                                <span>
                                    <label for="mb_id1_to" class="input">
                                        <input type="text" name="mb_id1_to" value="<?php echo get_sanitize_input($mb_id1_to); ?>" id="mb_id1_to" title="종료구간">
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> 회원아이디의 알파벳 구간을 설정하여 대상을 검색할 수 있습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_email" class="label">E-mail</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="mb_email" id="mb_email" value="<?php echo get_sanitize_input($mb_email); ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 메일 주소에 단어 포함 (예 : @<?php echo preg_replace("#^(www[^\.]*\.)#", "", $_SERVER['HTTP_HOST']); ?>)</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_mailling" class="label">메일링 수신여부</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="mb_mailling" id="mb_mailling">
                                    <option value="1">수신동의한 회원만</option>
                                    <option value="">전체</option>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="mb_level_from" class="label">최소권한</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="mb_level_from" id="mb_level_from">
                                    <?php for ($i=1; $i<=10; $i++) { ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label for="mb_level_to" class="label">최대권한</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="mb_level_to" id="mb_level_to">
                                    <?php for ($i=1; $i<=10; $i++) { ?>
                                    <option value="<?php echo $i ?>"<?php echo $i==10 ? " selected" : ""; ?>><?php echo $i ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th border-left-th">
                            <label for="mb_level_to" class="label">게시판 그룹회원</label>
                        </th>
                        <td colspan="3">
                            <label class="select form-width-250px">
                                <select name="gr_id" id="gr_id">
                                    <option value="">전체</option>
                                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                                    <option value="<?php echo $list[$i]['gr_id']; ?>"><?php echo $list[$i]['gr_subject']; ?></option>
                                    <?php } ?>
                                </select><i></i>
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

    <?php echo $frm_submit; ?>

    </form>
</div>