<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/member_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.admin-member-list .new-member-photo {position:relative;overflow:hidden;width:26px;height:26px;border:1px solid #c5c5c5;background:#fff;padding:1px;margin:0 auto;text-align:center;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-member-list .new-member-photo i {width:22px;height:22px;font-size:12px;line-height:22px;background:#b5b5b5;color:#fff;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
.admin-member-list .new-member-photo img {-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important}
</style>

<div class="admin-member-list">
    <div class="adm-headline adm-headline-btn">
        <h3>회원 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 회원 추가</a>
        <?php } ?>
    </div>

    <form id="fsearch" name="fsearch" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">

    <div class="adm-table-form-wrap adm-search-box">
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">검색어</label>
                        </th>
                        <td colspan="3">
                            <div <?php if (!G5_IS_MOBILE) { ?>class="inline-group"<?php } ?>>
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sfl" id="sfl">
                                            <option value="a.mb_name"<?php echo get_selected($sfl, "a.mb_name"); ?>>이름</option>
                                            <option value="a.mb_id"<?php echo get_selected($sfl, "a.mb_id"); ?>>아이디</option>
                                            <option value="a.mb_nick"<?php echo get_selected($sfl, "a.mb_nick"); ?>>닉네임</option>
                                            <option value="a.mb_email"<?php echo get_selected($sfl, "a.mb_email"); ?>>E-MAIL</option>
                                            <option value="a.mb_tel"<?php echo get_selected($sfl, "a.mb_tel"); ?>>전화번호</option>
                                            <option value="a.mb_hp"<?php echo get_selected($sfl, "a.mb_hp"); ?>>휴대폰번호</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-250px">
                                        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                    </label>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">회원레벨</label>
                        </th>
                        <td>
                            <label class="select form-width-150px">
                                <select name="lev" id="lev">
                                    <option value="">전체</option>
                                    <?php for ($i=1; $i<=10; $i++) { ?>
                                    <option value="<?php echo $i; ?>" <?php echo get_selected($lev, $i); ?>><?php echo $i; ?> 레벨</option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">본인확인</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_certify_all" class="radio"><input type="radio" name="cert" value="0" id="mb_certify_all" <?php echo $mb_certify_all; ?>><i></i> 전체</label>
                                <label for="mb_certify_yes" class="radio"><input type="radio" name="cert" value="2" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>><i></i> 예</label>
                                <label for="mb_certify_no" class="radio"><input type="radio" name="cert" value="1" id="mb_certify_no" <?php echo $mb_certify_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <?php if (!($wmode || G5_IS_MOBILE)) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">정보공개</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_open_all" class="radio"><input type="radio" name="open" id="mb_open_all" value="0" <?php echo $mb_open_all; ?>><i></i> 전체</label>
                                <label for="mb_open_yes" class="radio"><input type="radio" name="open" id="mb_open_yes" value="2" <?php echo $mb_open_yes; ?>><i></i> 예</label>
                                <label for="mb_open_no" class="radio"><input type="radio" name="open" id="mb_open_no" value="1" <?php echo $mb_open_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">성인인증</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_adult_all" class="radio"><input type="radio" name="adt" value="0" id="mb_adult_all" <?php echo $mb_adult_all; ?>><i></i> 전체</label>
                                <label for="mb_adult_yes" class="radio"><input type="radio" name="adt" value="2" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>><i></i> 예</label>
                                <label for="mb_adult_no" class="radio"><input type="radio" name="adt" value="1" id="mb_adult_no" <?php echo $mb_adult_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">메일수신</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_mailling_all" class="radio"><input type="radio" name="mail" id="mb_mailling_all" value="0" <?php echo $mb_mailling_all; ?>><i></i> 전체</label>
                                <label for="mb_mailling_yes" class="radio"><input type="radio" name="mail" id="mb_mailling_yes" value="2" <?php echo $mb_mailling_yes; ?>><i></i> 예</label>
                                <label for="mb_mailling_no" class="radio"><input type="radio" name="mail" id="mb_mailling_no" value="1" <?php echo $mb_mailling_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">SMS 수신</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="mb_sms_all" class="radio"><input type="radio" name="sms" id="mb_sms_all" value="0" <?php echo $mb_sms_all; ?>><i></i> 전체</label>
                                <label for="mb_sms_yes" class="radio"><input type="radio" name="sms" id="mb_sms_yes" value="2" <?php echo $mb_sms_yes; ?>><i></i> 예</label>
                                <label for="mb_sms_no" class="radio"><input type="radio" name="sms" id="mb_sms_no" value="1" <?php echo $mb_sms_no; ?>><i></i> 아니오</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">날짜검색</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <div class="margin-bottom-5">
                                    <label class="select form-width-150px">
                                        <select name="sdt" id="sdt">
                                            <option value="mb_datetime" <?php echo get_selected($sdt, 'mb_datetime'); ?>>가입일</option>
                                            <option value="mb_today_login" <?php echo get_selected($sdt, 'mb_today_login'); ?>>최신로그인</option>
                                        </select><i></i>
                                    </label>
                                </div>
                                <span>
                                    <label class="input form-width-150px">
                                        <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <span> - </span>
                                <span>
                                    <label class="input form-width-150px">
                                        <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10">
                                    </label>
                                </span>
                                <span class="search-btns">
                                    <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-sm btn-e-default">오늘</button>
                                    <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-sm btn-e-default">어제</button>
                                    <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-sm btn-e-default">이번주</button>
                                    <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-sm btn-e-default">이번달</button>
                                    <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-sm btn-e-default">지난주</button>
                                    <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-sm btn-e-default">지난달</button>
                                    <button type="button" onclick="javascript:set_date('전체');" class="btn-e btn-e-sm btn-e-default">전체</button>
                                </span>
                            </div>
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

    <?php echo $frm_submit;?>

    <div class="margin-bottom-30"></div>

    <div class="row">
        <div class="col col-9">
            <div class="padding-top-5">
                <span class="font-size-12 color-grey">
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="margin-left-10 margin-right-10 color-light-grey">|</span>총회원수 <?php echo number_format($total_count); ?>명<?php if (!$wmode) { ?> 중,
    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl; ?>&amp;stx=<?php echo $stx; ?>"><u>차단 <?php echo number_format($intercept_count); ?></u></a>명,
    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl; ?>&amp;stx=<?php echo $stx; ?>"><u>탈퇴 <?php echo number_format($leave_count); ?></u></a>명<?php } ?>
                </span>
            </div>
        </div>
        <div class="col col-3">
            <section>
                <label for="sort_list" class="select" style="width:200px;float:right;">
                    <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                        <option value="">:: 정렬방식선택 ::</option>
                        <option value="mb_id|asc" <?php if ($sst=='mb_id' && $sod=='asc') { ?>selected<?php } ?>>회원아이디 정방향 (↓)</option>
                        <option value="mb_id|desc" <?php if ($sst=='mb_id' && $sod=='desc') { ?>selected<?php } ?>>회원아이디 역방향 (↑)</option>
                        <option value="mb_name|asc" <?php if ($sst=='mb_name' && $sod=='asc') { ?>selected<?php } ?>>이름 정방향 (↓)</option>
                        <option value="mb_name|desc" <?php if ($sst=='mb_name' && $sod=='desc') { ?>selected<?php } ?>>이름 역방향 (↑)</option>
                        <option value="mb_nick|asc" <?php if ($sst=='mb_nick' && $sod=='asc') { ?>selected<?php } ?>>닉네임 정방향 (↓)</option>
                        <option value="mb_nick|desc" <?php if ($sst=='mb_nick' && $sod=='desc') { ?>selected<?php } ?>>닉네임 역방향 (↑)</option>
                        <option value="mb_certify|asc" <?php if ($sst=='mb_certify' && $sod=='asc') { ?>selected<?php } ?>>본인확인 정방향 (↓)</option>
                        <option value="mb_certify|desc" <?php if ($sst=='mb_certify' && $sod=='desc') { ?>selected<?php } ?>>본인확인 역방향 (↑)</option>
                        <option value="mb_email_certify|asc" <?php if ($sst=='mb_email_certify' && $sod=='asc') { ?>selected<?php } ?>>메일인증 정방향 (↓)</option>
                        <option value="mb_email_certify|desc" <?php if ($sst=='mb_email_certify' && $sod=='desc') { ?>selected<?php } ?>>메일인증 역방향 (↑)</option>
                        <option value="mb_open|asc" <?php if ($sst=='mb_open' && $sod=='asc') { ?>selected<?php } ?>>정보공개 정방향 (↓)</option>
                        <option value="mb_open|desc" <?php if ($sst=='mb_open' && $sod=='desc') { ?>selected<?php } ?>>정보공개 역방향 (↑)</option>
                        <option value="mb_mailling|asc" <?php if ($sst=='mb_mailling' && $sod=='asc') { ?>selected<?php } ?>>메일수신 정방향 (↓)</option>
                        <option value="mb_mailling|desc" <?php if ($sst=='mb_mailling' && $sod=='desc') { ?>selected<?php } ?>>메일수신 역방향 (↑)</option>
                        <option value="mb_sms|asc" <?php if ($sst=='mb_sms' && $sod=='asc') { ?>selected<?php } ?>>SMS수신 정방향 (↓)</option>
                        <option value="mb_sms|desc" <?php if ($sst=='mb_sms' && $sod=='desc') { ?>selected<?php } ?>>SMS수신 역방향 (↑)</option>
                        <option value="mb_level|asc" <?php if ($sst=='mb_level' && $sod=='asc') { ?>selected<?php } ?>>권한 정방향 (↓)</option>
                        <option value="mb_level|desc" <?php if ($sst=='mb_level' && $sod=='desc') { ?>selected<?php } ?>>권한 역방향 (↑)</option>
                        <option value="mb_adult|asc" <?php if ($sst=='mb_adult' && $sod=='asc') { ?>selected<?php } ?>>성인인증 정방향 (↓)</option>
                        <option value="mb_adult|desc" <?php if ($sst=='mb_adult' && $sod=='desc') { ?>selected<?php } ?>>성인인증 역방향 (↑)</option>
                        <option value="mb_intercept_date|asc" <?php if ($sst=='mb_intercept_date' && $sod=='asc') { ?>selected<?php } ?>>접근차단 정방향 (↓)</option>
                        <option value="mb_intercept_date|desc" <?php if ($sst=='mb_intercept_date' && $sod=='desc') { ?>selected<?php } ?>>접근차단 역방향 (↑)</option>
                        <option value="mb_today_login|asc" <?php if ($sst=='mb_today_login' && $sod=='asc') { ?>selected<?php } ?>>최종접속 정방향 (↓)</option>
                        <option value="mb_today_login|desc" <?php if ($sst=='mb_today_login' && $sod=='desc') { ?>selected<?php } ?>>최종접속 역방향 (↑)</option>
                        <option value="mb_point|asc" <?php if ($sst=='mb_point' && $sod=='asc') { ?>selected<?php } ?>>포인트 정방향 (↓)</option>
                        <option value="mb_point|desc" <?php if ($sst=='mb_point' && $sod=='desc') { ?>selected<?php } ?>>포인트 역방향 (↑)</option>
                        <option value="mb_datetime|asc" <?php if ($sst=='mb_datetime' && $sod=='asc') { ?>selected<?php } ?>>가입일 정방향 (↓)</option>
                        <option value="mb_datetime|desc" <?php if ($sst=='mb_datetime' && $sod=='desc') { ?>selected<?php } ?>>가입일 역방향 (↑)</option>
                    </select><i></i>
                </label>
            </section>
        </div>
    </div>

    </form>

    <form name="fboardlist" id="fboardlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="lev" value="<?php echo $lev; ?>">
    <input type="hidden" name="cert" value="<?php echo $cert; ?>">
    <input type="hidden" name="open" value="<?php echo $open; ?>">
    <input type="hidden" name="adt" value="<?php echo $adt; ?>">
    <input type="hidden" name="mail" value="<?php echo $mail; ?>">
    <input type="hidden" name="sms" value="<?php echo $sms; ?>">
    <input type="hidden" name="sdt" value="<?php echo $sdt; ?>">
    <input type="hidden" name="fr_date" value="<?php echo $fr_date; ?>">
    <input type="hidden" name="to_date" value="<?php echo $to_date; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <div id="member-list"></div>

    <?php if (!$wmode) { ?>
    <div class="margin-top-20">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>
    <?php } ?>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
<div class="margin-bottom-20"></div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">회원 정보 수정</h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<?php if (!$wmode) { ?>
<div class="margin_top_20">
    <div class="cont-text-bg">
        <p class="bg-info font-size-12"><i class="fas fa-info-circle"></i> 회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.</p>
    </div>
</div>
<?php } ?>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
<?php if (!(G5_IS_MOBILE || $wmode)) { ?>
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
<?php } ?>

$(document).ready(function(){
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

!function () {
    var db = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1) || filter.아이디 && !(client.아이디.indexOf(filter.아이디) > -1) || filter.이름 && !(client.이름.indexOf(filter.이름) > -1) )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            <?php if (!$wmode) { ?>
            체크: "<input type='hidden' name='mb_id[<?php echo $i; ?>]' value='<?php echo $list[$i]['mb_id']; ?>' id='mb_id_<?php echo $i; ?>'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label>",
            관리: "<?php if ($is_admin!='group') { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>&amp;w=u<?php if ($qstr) { ?>&amp;<?php echo $qstr; ?><?php } ?>'><u>수정</u></a><?php } ?><?php if ($config['cf_admin'] != $list[$i]['mb_id']) { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=boardgroupmember_form&amp;mb_id=<?php echo $list[$i]['mb_id']; ?>' class='margin-left-10'><u>그룹</u></a><?php } ?>",
            포토: "<div class='new-member-photo'><?php if (!$list[$i]['photo_url']) { ?><i class='fas fa-user'></i><?php } else { ?><img src='<?php echo $list[$i]['photo_url']; ?>' class='img-responsive'><?php } ?></div>",
            <?php } ?>
            아이디: "<span class='ellipsis'><a <?php if (!(G5_IS_MOBILE || $wmode)) { ?>href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id']; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'<?php } else { ?>href='javascript:void(0);'<?php } ?> ><i class='fas fa-external-link-alt color-light-grey margin-right-5 hidden-xs'></i><strong><?php echo $list[$i]['mb_id']; ?></strong></a></span>",
            이름: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'><?php echo get_text($list[$i]['mb_name']); ?></a>",
            닉네임: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=member_form&mb_id=<?php echo $list[$i]['mb_id'];; ?>&w=u&amp;wmode=1' onclick='eb_modal(this.href); return false;'><?php echo get_text($list[$i]['mb_nick']); ?></a>",
            <?php if (!$wmode) { ?>
            권한: "<label class='select'><?php echo $list[$i]['mb_level_select']; ?><i></i></label><input type='hidden' name='mb_prev_level[<?php echo $i; ?>]' value='<?php echo $list[$i]['mb_level']; ?>'>",
            이윰레벨: "<?php echo $list[$i]['level']; ?> 레벨<input type='hidden' name='level[<?php echo $i; ?>]' value='<?php echo $list[$i]['level']; ?>'>",
            그누<?php echo $levelset['gnu_name']; ?>: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=point_list&amp;sfl=mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>'><?php echo number_format($list[$i]['mb_point']); ?></a>",
            이윰<?php echo $levelset['eyoom_name']; ?>: "<?php echo number_format($list[$i]['level_point']); ?><input type='hidden' name='level_point[<?php echo $i; ?>]' value='<?php echo $list[$i]['level_point']; ?>'>",
            메일인증: "<span class='<?php if ($list[$i]['email_certify'] == 'Yes') { ?>color-red<?php } else if ($list[$i]['email_certify'] == 'No') { ?>color-dark<?php } ?>'><?php echo $list[$i]['email_certify']; ?></span>",
            정보공개: "<label class='checkbox'><input type='checkbox' name='mb_open[<?php echo $i; ?>]' <?php if ($list[$i]['mb_open']) { ?>checked<?php } ?> value='1'><i></i></label>",
            메일수신: "<label class='checkbox'><input type='checkbox' name='mb_mailling[<?php echo $i; ?>]' <?php if ($list[$i]['mb_mailling']) { ?>checked<?php } ?> value='1'><i></i></label>",
            SMS수신: "<label class='checkbox'><input type='checkbox' name='mb_sms[<?php echo $i; ?>]' <?php if ($list[$i]['mb_sms']) { ?>checked<?php } ?> value='1'><i></i></label>",
            성인인증: "<label class='checkbox'><input type='checkbox' name='mb_adult[<?php echo $i; ?>]' <?php if ($list[$i]['mb_adult']) { ?>checked<?php } ?> value='1'><i></i></label><input type='hidden' name='mb_certify[<?php echo $i; ?>]' value='<?php echo $list[$i]['mb_certify']; ?>'>",
            접근차단: "<?php if (empty($list[$i]['mb_leave_date'])) { ?><label class='checkbox'><input type='checkbox' name='mb_intercept_date[<?php echo $i; ?>]' <?php if ($list[$i]['mb_intercept_date']) { ?>checked<?php } ?> value='<?php echo $list[$i]['intercept_date']; ?>'><i></i></label><?php } ?>",
            상태: "<?php echo $list[$i]['mb_status']; ?>",
            가입일: "<?php echo substr($list[$i]['mb_datetime'],0,-9); ?>",
            최신로그인: "<?php echo substr($list[$i]['mb_today_login'],0,-9); ?>",
            <?php } else { ?>
            선택하기: "<a href='javascript:;' data-mb-id='<?php echo $list[$i]['mb_id']; ?>' data-dismiss='modal' class='set_mbid btn-e btn-e-xs btn-e-indigo'>선택하기</a>",
            <?php } ?>
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#member-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            <?php if (!$wmode) { ?>
            { name: "체크", type: "text", width: 40 },
            { name: "관리", type: "text", align: "center", width: 110, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "포토", type: "text", align: "center", width: 60 },
            <?php } ?>
            { name: "아이디", type: "text", width: 150 },
            { name: "이름", type: "text", width: 150 },
            { name: "닉네임", type: "text", width: 150 },
            <?php if (!$wmode) { ?>
            { name: "권한", type: "text", width: 100 },
            { name: "이윰레벨", type: "text", align: "right", width: 60 },
            { name: "그누<?php echo $levelset['gnu_name']; ?>", type: "number", width: 80 },
            { name: "이윰<?php echo $levelset['eyoom_name']; ?>", type: "number", width: 80 },
            { name: "메일인증", type: "text", align: "center", width: 80 },
            { name: "정보공개", type: "text", align: "center", width: 80 },
            { name: "메일수신", type: "text", align: "center", width: 80 },
            { name: "SMS수신", type: "text", align: "center", width: 80 },
            { name: "성인인증", type: "text", align: "center", width: 80 },
            { name: "접근차단", type: "text", align: "center", width: 80 },
            { name: "상태", type: "text", align: "center", width: 70 },
            { name: "가입일", type: "text", align: "center", width: 110 },
            { name: "최신로그인", type: "text", align: "center", width: 110 },
            <?php } else { ?>
            { name: "선택하기", type: "text", align: "center", width: 80 },
            <?php } ?>
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }

    <?php if ($wmode) { ?>
    $(".set_mbid").click(function() {
        var mb_id = $(this).attr('data-mb-id');
        $('#mb_id', parent.document).val(mb_id);
        window.parent.closeModal();
    });
    <?php } ?>
});

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    } else if (today == "전체") {
        document.getElementById("fr_date").value = "";
        document.getElementById("to_date").value = "";
    }
}
</script>