<?php
/**
 * theme file : /theme/THEME_NAME/misc.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ($is_member) { //회원일때 사용되는 모달 창 ?>
<?php /* 프로필 사진 모달 시작 */ ?>
<div class="modal fade profile-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form name="profile_photo" method="post" action="<?php echo EYOOM_CORE_URL; ?>/member/photo_update.php" enctype="multipart/form-data" class="eyoom-form">
            <input type="hidden" name="old_photo" value="<?php echo $eyoomer['photo']; ?>">
            <input type="hidden" name="back_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <input type="hidden" name="selected_icon" id="selected_icon" value="">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-user-circle text-gray m-r-7"></i><strong>프로필 사진 변경</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="profile-photo"><?php if ($eyoomer['mb_photo']) echo $eyoomer['mb_photo']; else { ?><img src="<?php echo EYOOM_THEME_URL; ?>/image/user.jpg"><?php } ?></div>
                <div class="m-b-10">
                    <ul class="nav nav-tabs">
                        <li><a href="#profile_photo_type1" data-bs-toggle="tab" class="active">기본 이미지 선택</a></li>
                        <li><a href="#profile_photo_type2" data-bs-toggle="tab">이미지 직접 업로드</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="profile_photo_type1">
                            <div class="default-photo-box">
                                <div class="default-photo-img" id="default-photo-img">
                                    <?php if ($eyoomer['mb_photo']) echo $eyoomer['mb_photo']; else { ?><img src="<?php echo EYOOM_THEME_URL; ?>/image/user.jpg"><?php } ?>
                                </div>
                                <div class="default-photo-btn">
                                    <a href="<?php echo EYOOM_CORE_URL;?>/member/member_icon.php" class="btn-e btn-e-lg btn-e-dark btn-e-brd btn-e-block default-img-btn" onclick="profile_default_img_modal(this.href); return false;"><i class="fas fa-user-check m-r-7"></i>기본 이미지 선택하기</a>
                                </div>
                            </div>
                            <?php if ($is_admin) { ?>
                            <p class="li-p f-s-13r text-gray m-t-10"><i class="fas fa-exclamation-circle li-p-fa text-crimson"></i>프로필 사진 기본 이미지는 /eyoom/misc/member_icon 폴더에서 추가 및 수정할수 있으니 참고 바랍니다.</p>
                            <?php } ?>
                        </div>
                        <div class="tab-pane in" id="profile_photo_type2">
                            <div class="input">
                                <input type="file" class="form-control" id="photo_file" name="photo" value="사진선택">
                            </div>
                            <div class="alert alert-warning m-b-0">
                                <p>jpg, png, gif 파일만 등록가능하며, 정사각형 비율로 업로드하여 주세요. (<?php echo $config['cf_member_img_width']; ?>x<?php echo $config['cf_member_img_height']; ?>픽셀 사이즈 권장)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($eyoomer['photo']) { ?><label class="checkbox"><input type="checkbox" name="del_photo" value="1"><i></i>프로필사진 삭제</label><?php } ?>
                <label class="checkbox"><input type="checkbox" name="apply_icon" value="1" checked><i></i>회원 아이콘 자동생성 <span class="text-light-gray">(권장 | 동일한 이미지의 아이콘 생성)</span></label>
            </div>
            <div class="modal-footer">
                <button class="btn-e btn-e-lg btn-navy" type="submit" value="저장하기">저장하기</button>
                <button data-bs-dismiss="modal" class="btn-e btn-e-lg btn-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
function set_member_icon (icon) {
    var icon_url = g5_url+'/eyoom/misc/member_icon/'+icon;
    var selected_icon_html = '<img src="'+icon_url+'">';
    $("#selected_icon").val(icon);
    $("#default-photo-img").empty().html(selected_icon_html);
    $('.profile-default-img-modal').modal('hide');
}
</script>
<?php /* 프로필 사진 모달 끝 */ ?>

<?php /* 프로필 사진 기본 이미지 모달 시작 */ ?>
<div class="modal fade profile-default-img-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-user-circle text-gray m-r-7"></i><strong>프로필 이미지 선택</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="profile-default-img-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 프로필 사진 기본 이미지 모달 끝 */ ?>

<?php /* 회원 자기소개 모달 시작 */ ?>
<div class="modal fade member-profile-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-user-circle text-gray m-r-7"></i><strong>회원 프로필</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="member-profile-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 회원 자기소개 모달 끝 */ ?>

<?php /* 스크랩 목록 모달 시작 */ ?>
<div class="modal fade scrap-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-list-alt text-gray m-r-7"></i><strong>스크랩 목록</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="scrap-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 스크랩 목록 모달 끝 */ ?>

<?php /* 포인트 모달 시작 */ ?>
<div class="modal fade point-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-chart-line text-gray m-r-7"></i><strong>포인트 내역</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="point-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 포인트 모달 끝 */ ?>

<?php /* 폼메일 발송 모달 시작 */ ?>
<div class="modal fade formmail-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-envelope text-gray m-r-7"></i><strong>메일 보내기</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="formmail-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 폼메일 발송 모달 끝 */ ?>

<?php /* 쪽지 모달 시작 */ ?>
<div class="modal fade memo-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-paper-plane text-gray m-r-7"></i><strong>내 쪽지함</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="memo-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 쪽지 모달 끝 */ ?>

<?php /* 쪽지 보내기 모달 시작 */ ?>
<div class="modal fade memo-send-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-paper-plane text-gray m-r-7"></i><strong>내 쪽지함</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="memo-send-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 쪽지 보내기 모달 끝 */ ?>

<?php /* 쪽지 보기  모달 시작 */ ?>
<div class="modal fade memo-view-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-paper-plane text-gray m-r-7"></i><strong>내 쪽지함</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="memo-view-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 쪽지 보기 모달 끝 */ ?>

<?php /* 회원메모 모달 시작 */ ?>
<?php if ($config['cf_use_mbmemo'] == '1' && $is_member) { ?>
<div class="modal fade mbmemo-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-sticky-note text-gray m-r-7"></i><strong>회원메모</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="mbmemo-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php /* 회원메모 모달 끝 */ ?>

<?php /* 관리자 iframe 설정 모달 시작 */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<div class="modal fade admset-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="far fa-edit text-gray m-r-7"></i><strong>관리자 설정</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="admset-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
function close_modal_and_reload() {
    window.closeModal = function(){
        $('.admset-iframe-modal').modal('hide');
    };
    document.location.reload();
}
</script>
<?php } ?>
<?php /* 관리자 iframe 설정 모달 끝 */ ?>

<script>
function profile_default_img_modal(href) {
    $('.profile-default-img-modal').modal('show').on('hidden.bs.modal', function() {
        $("#profile-default-img-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.profile-default-img-modal').modal('show').on('shown.bs.modal', function() {
        $("#profile-default-img-iframe").attr("src", href);
        $('#profile-default-img-iframe').height(500);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function member_profile_modal(href) {
    $('.member-profile-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#member-profile-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.member-profile-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#member-profile-iframe").attr("src", href);
        $('#member-profile-iframe').height(510);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function scrap_modal() {
    $('.scrap-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#scrap-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.scrap-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#scrap-iframe").attr("src", "<?php echo G5_BBS_URL; ?>/scrap.php");
        $('#scrap-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function point_modal() {
    $('.point-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#point-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.point-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#point-iframe").attr("src", "<?php echo G5_BBS_URL; ?>/point.php");
        $('#point-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function formmail_modal(href) {
    $('.formmail-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#formmail-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.formmail-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#formmail-iframe").attr("src", href);
        $('#formmail-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}
window.closeFormmailModal = function(){
    $('.formmail-iframe-modal').modal('hide');
};

function memo_modal() {
    $('.memo-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#memo-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.memo-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#memo-iframe").attr("src", "<?php echo G5_BBS_URL; ?>/memo.php");
        $('#memo-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function memo_send_modal(href) {
    $('.memo-send-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#memo-send-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.memo-send-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#memo-send-iframe").attr("src", href);
        $('#memo-send-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function memo_view_modal(href) {
    $('.memo-view-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#memo-view-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.memo-view-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#memo-view-iframe").attr("src", href);
        $('#memo-view-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

<?php if ($config['cf_use_mbmemo'] == '1' && $is_member) { ?>
function mbmemo_modal(href) {
    $('.mbmemo-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#mbmemo-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.mbmemo-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#mbmemo-iframe").attr("src", href);
        $('#mbmemo-iframe').height(550);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}
<?php } ?>

<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
function eb_admset_modal(href) {
    $('.admset-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#admset-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admset-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#admset-iframe").attr("src", href);
        $('#admset-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(url){
    $('.admset-iframe-modal').modal('hide');
    document.location.href = url;
};
<?php } ?>
</script>
<?php } ?>

<?php /* 상담 신청 모달 시작 */ ?>
<?php if ($config['cf_use_counsel'] == '1') { ?>
<div class="modal fade counsel-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="counsel-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php /* 상담 신청 모달 끝 */ ?>

<?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
<?php /* 상품 사용후기 모달 시작 */ ?>
<div class="modal fade itemuse-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-edit text-gray m-r-7"></i><strong>사용후기 작성하기</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="itemuse-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <?php if (G5_IS_MOBILE) { ?>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-xl btn-e-dark btn-e-block" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-7"></i></button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php /* 상품 사용후기 모달 끝 */ ?>

<?php /* 상품 문의하기 모달 시작 */ ?>
<div class="modal fade itemqa-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-question-circle text-gray m-r-7"></i><strong>상품문의 작성하기</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="itemqa-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <?php if (G5_IS_MOBILE) { ?>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-xl btn-e-dark btn-e-block" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-7"></i></button>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php /* 상품 문의하기 모달 끝 */ ?>

<?php /* 상품 쿠폰 모달 시작 */ ?>
<div class="modal fade coupon-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-ticket-alt text-gray m-r-7"></i><strong>쿠폰 내역</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="coupon-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 상품 쿠폰 모달 끝 */ ?>

<script>
<?php if ($config['cf_use_counsel'] == '1') { ?>
function counsel_modal() {
    $('.counsel-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#counsel-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.counsel-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#counsel-iframe").attr("src", "<?php echo G5_URL; ?>/page/?pid=counsel&wmode=1");
        $('#counsel-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}
<?php } ?>

function itemuse_modal(href) {
    $('.itemuse-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#itemuse-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.itemuse-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#itemuse-iframe").attr("src", href);
        <?php if (!G5_IS_MOBILE) { ?>
        $('#itemuse-iframe').height(parseInt($(window).height() * 0.8));
        <?php } else { ?>
        $('#itemuse-iframe').height(parseInt($(window).height() * 0.95));
        <?php } ?>
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function itemqa_modal(href) {
    $('.itemqa-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#itemqa-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.itemqa-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#itemqa-iframe").attr("src", href);
        <?php if (!G5_IS_MOBILE) { ?>
        $('#itemqa-iframe').height(parseInt($(window).height() * 0.8));
        <?php } else { ?>
        $('#itemqa-iframe').height(parseInt($(window).height() * 0.95));
        <?php } ?>
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

function coupon_modal(href) {
    $('.coupon-iframe-modal').modal('show').on('hidden.bs.modal', function() {
        $("#coupon-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.coupon-iframe-modal').modal('show').on('shown.bs.modal', function() {
        $("#coupon-iframe").attr("src", "<?php echo G5_SHOP_URL; ?>/coupon.php");
        $('#coupon-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}
</script>
<?php } ?>
<script>
// 모달창을 닫은 후 리로드
function close_modal_and_reload() {
    close_modal();
    document.location.reload();
}
function close_modal() {
    $('.modal').modal('hide');
}
</script>

<?php /* 설문 결과보기 모달 시작 */ ?>
<div class="modal fade poll-result-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-s-20r"><i class="fas fa-chart-bar text-gray m-r-7"></i><strong>투표 결과 보기</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="poll-result-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<?php /* 설문 결과보기 모달 끝 */ ?>

<script>
function poll_result(url) {
    <?php if ($member['mb_level'] < $po['po_level']) { ?>
    Swal.fire({
        title: "중요!",
        html: "권한 <strong class='text-crimson'><?php echo $po['po_level']; ?></strong> 이상의 회원만 결과를 볼 수 있습니다.",
        confirmButtonColor: "#ab0000",
        icon: "error",
        confirmButtonText: "확인"
    });
    return false;
    <?php } ?>
    $('.poll-result-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#poll-result-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.poll-result-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#poll-result-iframe").attr("src", url);
        $('#poll-result-iframe').height(parseInt($(window).height() * 0.7));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}
</script>

<?php /* 레이아웃 설정 시작 */ ?>
<?php if ($is_admin == 'super' && !G5_IS_MOBILE) { ?>
<style>
.sidebar-right-wrap .sidebar-admset-trigger {z-index:1002;position:fixed;top:65px;right:0;display:inline-block;width:40px;height:40px;line-height:40px;background:#cc2300;color:#fff;text-align:center;font-size:15px;cursor:pointer;border-radius:2px 0 0 2px !important}
.sidebar-right.offcanvas {position:fixed;bottom:0;z-index:1004;display:flex;flex-direction:column;max-width:100%;width:280px;background-color:#fff;background-clip:padding-box;outline:0;transition:transform .3s ease-in-out}
.sidebar-right .sidebar-right-content {position:relative;height:100%;width:100%}
.sidebar-right .sidebar-config-wrap {position:relative;overflow:hidden;min-height:400px;padding:0 0 20px 15px}
.sidebar-right .sidebar-config-wrap label {font-size:12px}
.sidebar-right .sidebar-btn-wrap {position:fixed;bottom:0;width:280px;z-index:1}
.sidebar-right .sidebar-btn {position:relative;overflow:hidden}
.sidebar-right .sidebar-btn .btn-e-lg {width:100%;padding:12px 0;border-radius:0 !important}
</style>

<div class="sidebar-right-wrap">
    <?php if (!$wmode) { ?>
    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=layout&amp;thema=<?php echo $theme; ?>&amp;wmode=1" onclick="eb_admset_sidebar(this.href); return false;" class="sidebar-admset-trigger btn-edit-mode" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-cog"></i></a>
    <?php } ?>

    <div class="sidebar-right offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title f-s-16r" id="offcanvasRightLabel"><i class="fas fa-sliders-h text-gray"></i> 테마 환경 설정</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="sidebar-right-content">
            <div class="sidebar-config-wrap">
                <iframe id="admset-sidebar-iframe" width="100%" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
function eb_admset_sidebar(href) {
    $("#admset-sidebar-iframe").attr("src", href);
    $("#admset-sidebar-iframe").height(parseInt($(window).height() * 0.95));
    return false;
}
</script>
<?php } ?>
<?php /* 레이아웃 설정 끝 */ ?>