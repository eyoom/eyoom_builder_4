<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/mail_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'mail_list';
$g5_title = '회원메일발송';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-mail-list">
    <form name="fmaillist" id="fmaillist" action="<?php echo $action_url1; ?>" method="post" class="eyoom-form">

    <div class="adm-headline">
        <h3>메일발송 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=mail_form" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>메일내용 추가</span></a>
        <?php } ?>
    </div>

    <div class="cont-text-bg m-b-20">
        <p class="bg-info">
            <i class="fas fa-info-circle"></i> <b>테스트</b>는 등록된 최고관리자의 이메일로 테스트 메일을 발송합니다.<br>
            <i class="fas fa-info-circle"></i> 현재 등록된 메일은 총 <?php echo number_format($total_count); ?>건입니다.<br>
            <i class="fas fa-info-circle"></i> <strong>주의!</strong> 수신자가 동의하지 않은 대량 메일 발송에는 적합하지 않습니다. 수십건 단위로 발송해 주십시오.
        </p>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-50px">번호</th>
                        <th>수정</th>
                        <th>발송대상</th>
                        <th>제목</th>
                        <th>작성일시</th>
                        <th>테스트</th>
                        <th>미리보기</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $list[$i]['ma_id']; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center"><?php echo $list[$i]['num']; ?></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=mail_form&amp;w=u&amp;ma_id=<?php echo $list[$i]['ma_id']; ?>"><u>메일수정</u></a></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=mail_select_form&amp;ma_id=<?php echo $list[$i]['ma_id']; ?>"><u>대상선택</u></a></td>
                        <td><?php echo $list[$i]['ma_subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['ma_time']; ?></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/mail_test.php?ma_id=<?php echo $list[$i]['ma_id']; ?>"><u>테스트</u></a></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/mail_preview.php?ma_id=<?php echo $list[$i]['ma_id']; ?>&amp;wmode=1" <?php if (!(G5_IS_MOBILE)) { ?>onclick='eb_modal(this.href); return false;'<?php } else { ?>target="_blank"<?php } ?>><u>미리보기</u></a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="text-start">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark">
    </div>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">미리보기</h5>
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
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
</script>