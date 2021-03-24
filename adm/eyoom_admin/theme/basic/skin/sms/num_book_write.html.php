<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/num_book_write.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-num-book-write">
    <form name="book_form" id="book_form" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo get_sanitize_input($w); ?>">
    <input type="hidden" name="page" value="<?php echo get_sanitize_input($page); ?>">
    <input type="hidden" name="ap" value="<?php echo get_sanitize_input($ap); ?>">
    <input type="hidden" name="bk_no" value="<?php echo $write['bk_no']?>">
    <input type="hidden" name="mb_id" id="mb_id" value="<?php echo $write['mb_id']?>">
    <input type="hidden" name="get_bg_no" value="<?php echo get_sanitize_input($bg_no); ?>">
    
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>
    
    <div class="adm-table-form-wrap margin-bottom-30">
        <header><i class="fas fa-caret-right"></i> 휴대폰 번호 정보</strong></header>

        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label for="bg_no" class="label">그룹</label>
                        </th>
                        <td>
                            <label class="select form-width-250px">
                                <select name="bg_no" id="bg_no" required>
                                    <option value="1"><?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?> 명)</option>
                                    <?php
                                    $qry = sql_query("select * from {$g5['sms5_book_group_table']} where bg_no> 1 order by bg_name");
                                    while($res = sql_fetch_array($qry)) {
                                    ?>
                                    <option value="<?php echo $res['bg_no']?>" <?php echo $res['bg_no']==$write['bg_no']?'selected':''?>> <?php echo $res['bg_name']?>  (<?php echo number_format($res['bg_count'])?> 명) </option>
                                    <?php } ?>
                                </select>
                                <i></i>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bk_name" class="label">이름</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="bk_name" id="bk_name" maxlength="50" value="<?php echo get_sanitize_input($write['bk_name']); ?>" required>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bk_hp" class="label">휴대폰번호</label>
                        </th>
                        <td>
                            <label class="input form-width-250px">
                                <input type="text" name="bk_hp" id="bk_hp" value="<?php echo $write['bk_hp']?>" required>
                            </label>
                            <?php if (count((array)$exist_hplist)) { ?>
                            <div class="hp_check_el">
                                <ul>
                                <?php foreach( $exist_hplist as $v ) { if( empty($v) ) continue; ?>
                                <li><strong>중복됨 </strong><a href="<?php echo G5_ADMIN_URL."/?dir=member&amp;pid=member_form&amp;w=u&amp;mb_id={$v['mb_id']}"; ?>" target="_blank"><?php echo $v['mb_id']; ?></a></li>
                                <?php } ?>
                                </ul>
                            </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label for="bk_name" class="label">수신여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="bk_receipt_1" class="radio"><input type="radio" name="bk_receipt" value="1" id="bk_receipt_1" <?php echo $write['bk_receipt']?'checked':''?>><i></i> 수신허용</label>
                                <label for="bk_receipt_2" class="radio"><input type="radio" name="bk_receipt" value="0" id="bk_receipt_2" <?php echo !$write['bk_receipt']?'checked':''?>><i></i> 수신거부</label>
                            </div>
                        </td>
                    </tr>
                    <?php if ($w == 'u') { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">회원아이디</label>
                        </th>
                        <td> <?php echo $write['mb_id'] ? '<a href="'.G5_ADMIN_URL.'/?dir=member&amp;pid=member_form&amp;w=u&amp;mb_id='.$write['mb_id'].'">'.$write['mb_id'].'</a>' : '비회원'?> </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">업데이트</label>
                        </th>
                        <td> <?php echo $write['bk_datetime']?> </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label for="bk_memo" class="label">메모</label>
                        </th>
                        <td colspan="3">
                            <label for="bk_memo" class="textarea">
                                <textarea name="bk_memo" id="bk_memo"><?php echo html_purifier($write['bk_memo']); ?></textarea>
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

<script>
function book_submit() {
    var f = document.book_form;
    var regExp_hp = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?[0-9]{3,4}-?[0-9]{4}$/;

    if(!f.bk_hp.value){
        f.bk_hp.focus();
        alert("휴대폰번호를 입력하세요.");
        return false;
    } else if ( !regExp_hp.test(f.bk_hp.value) )
    {
        f.bk_hp.focus();
        alert("휴대폰번호 입력이 올바르지 않습니다.");
        return false;
    }

    var w = "<?php echo $w; ?>";
    var bk_no = "<?php echo $bk_no; ?>";
    var mb_id = f.mb_id.value;
    var bk_hp = f.bk_hp.value;
    var params = { w: w, bk_no: bk_no, mb_id : mb_id, bk_hp : bk_hp };
    var is_submit;

    $.ajax({
        url: "<?php echo G5_ADMIN_URL; ?>/sms_admin/ajax.hp_chk.php",
        type: "POST",
        cache:false,
        timeout : 30000,
        dataType:"json",
        data:params,
        success: function(data) {
            if(data.error) {
                is_submit = false;
                alert( data.error );
            } else {
                var list_text = "";
                var list_data;

                $.each( data.exist , function(num) {
                    list_data = data.exist[num];

                    if(list_data) {
                        var href = "<?php echo G5_ADMIN_URL ?>/?dir=member&pid=member_form&w=u&mb_id="+list_data;
                        list_text += "<li><a href=\""+href+"\" target=\"_blank\">"+list_data+"</a></li>";
                    }
                });

                var $check_msg = $("#hp_check_el");

                if( !list_text ){ // 중복 휴대폰 번호가 없다면 submit
                    if($check_msg.size()> 0)
                        $check_msg.remove();

                    is_submit = true;
                } else {
                    if($check_msg.size() < 1)
                        $("input#bk_hp").after("<div id=\"hp_check_el\"><h3>이 번호를 쓰는 회원 정보</h3><ul></ul></div>");

                    $("#hp_check_el").find("ul").html( list_text );

                    if(confirm("회원 정보에 중복 휴대폰 번호가 있습니다.수정하실 경우 회원정보에 반영되지 않습니다.\n수정하시겠습니까?"))
                        is_submit = true;
                    else
                        is_submit = false;
                }
            }

            if(is_submit)
                f.submit();
        }
    });

    return false;
}
</script>