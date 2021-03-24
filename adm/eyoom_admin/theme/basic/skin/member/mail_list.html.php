<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/mail_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-mail-list">
    <form name="fmaillist" id="fmaillist" action="<?php echo $action_url1; ?>" method="post" class="eyoom-form">
    <div class="mail-list">
        <div class="adm-headline adm-headline-btn">
            <h3>회원 메일 발송</h3>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&pid=mail_form" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> 메일내용추가</a>
        </div>

        <div class="cont-text-bg">
            <p class="bg-info font-size-12">
                <i class="fas fa-info-circle"></i> <b>테스트</b>는 등록된 최고관리자의 이메일로 테스트 메일을 발송합니다.<br>
                <i class="fas fa-info-circle"></i> 현재 등록된 메일은 총 <?php echo number_format($total_count); ?>건입니다.<br>
                <i class="fas fa-info-circle"></i> <strong>주의! 수신자가 동의하지 않은 대량 메일 발송에는 적합하지 않습니다. 수십건 단위로 발송해 주십시오.</strong>
            </p>
        </div>
        <div class="margin-bottom-20"></div>

        <?php if (G5_IS_MOBILE) { ?>
        <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>

        <div id="mail-list"></div>
    </div>
    <div class="margin-top-20">
        <input type="submit" value="선택삭제" class="btn-e btn-e-dark btn-e-xs">
    </div>
    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">미리보기</h4>
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

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
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
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.제목 && !(client.제목.indexOf(filter.제목) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
            체크: "<div class='eyoom-form'><label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $list[$i]['ma_id']; ?>'><i></i></label></div>",
            번호: "<?php echo $list[$i]['num']; ?>",
            수정: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=mail_form&amp;w=u&amp;ma_id=<?php echo $list[$i]['ma_id']; ?>' class='btn-e btn-e-xs btn-e-yellow'>메일수정</a>",
            발송대상: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=mail_select_form&amp;ma_id=<?php echo $list[$i]['ma_id']; ?>' class='btn-e btn-e-xs btn-e-pink'>메일발송 대상선택</a>",
            제목: "<?php echo $list[$i]['ma_subject']; ?>",
            작성일시: "<?php echo $list[$i]['ma_time']; ?>",
            테스트: "<a href='<?php echo G5_ADMIN_URL; ?>/mail_test.php?ma_id=<?php echo $list[$i]['ma_id']; ?>' class='btn-e btn-e-xs btn-e-indigo'>테스트</a>",
            미리보기: "<a href='<?php echo G5_ADMIN_URL; ?>/mail_preview.php?ma_id=<?php echo $list[$i]['ma_id']; ?>&amp;wmode=1' <?php if (!(G5_IS_MOBILE)) { ?>onclick='eb_modal(this.href); return false;'<?php } else { ?>target='_blank'<?php } ?> class='btn-e btn-e-xs btn-e-dark'>미리보기</a>"
        },
        <?php } ?>
    ]
}();

$(function() {
    $("#mail-list").jsGrid({
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
            { name: "체크", type: "text", width: 40 },
            { name: "번호", type: "text", align: "center", width: 60 },
            { name: "수정", type: "text", align: "center", width: 100 },
            { name: "발송대상", type: "text", align: "center", width: 150 },
            { name: "제목", type: "text", width: 200 },
            { name: "작성일시", type: "text", align: "center", width: 130 },
            { name: "테스트", type: "text", align: "center", width: 100 },
            { name: "미리보기", type: "text", align: "center", width: 100 },
        ]
    });

    var $chk = $(".jsgrid-table th:first-child");
    if ($chk.text() == '체크') {
        var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>';
        $chk.html(html);
    }
});
</script>