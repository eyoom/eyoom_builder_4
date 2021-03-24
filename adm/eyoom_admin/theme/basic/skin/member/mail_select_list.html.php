<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/member/mail_select_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<div class="mail-list">
    <div class="adm-headline">
        <h3>메일발송 대상 회원</h3>
    </div>

    <?php if (G5_IS_MOBILE) { ?>
    <p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
    <?php } ?>

    <form name="fmailselectlist" id="fmailselectlist" method="post" action="<?php echo $action_url1; ?>" class="eyoom-form">
    <input type="hidden" name="token" value="">
    <input type="hidden" name="ma_id" value="<?php echo $ma_id; ?>">

    <div id="mail-list"></div>

    <textarea name="ma_list" style="display:none"><?php echo $ma_list; ?></textarea>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script>
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
                return !(filter.No && !(client.No.indexOf(filter.No) > -1) || filter.회원아이디 && !(client.회원아이디.indexOf(filter.회원아이디) > -1))
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
        <?php for ($i=1; $i<=count((array)$list); $i++) { ?>
        {
            No: "<?php echo $i; ?>",
            회원아이디: "<?php echo $list[$i]['mb_id']; ?>",
            이름: "<?php echo get_text($list[$i]['mb_name']); ?>",
            닉네임: "<?php echo $list[$i]['mb_nick']; ?>",
            이메일: "<?php echo $list[$i]['mb_email']; ?>"
        },
        <?php } ?>
    ]
}();

$(document).ready(function() {
    $("#mail-list").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 10,
        pageSize       : 20,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "No", type: "text", align: "center", width: 40 },
            { name: "회원아이디", type: "text", width: 120 },
            { name: "이름", type: "text", width: 120 },
            { name: "닉네임", type: "text", width: 120 },
            { name: "이메일", type: "text", width: 200 },
        ]
    })
});
</script>