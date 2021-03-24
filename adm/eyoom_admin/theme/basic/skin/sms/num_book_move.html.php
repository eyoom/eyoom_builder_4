<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/num_book_move.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div id="copymove" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>

    <form name="fboardmoveall" method="post" action="<?php echo $action_url; ?>" onsubmit="return fboardmoveall_submit(this);">
    <input type="hidden" name="sw" value="<?php echo $sw ?>">
    <input type="hidden" name="bk_no_list" value="<?php echo get_sanitize_input($bk_no_list); ?>">
    <input type="hidden" name="act" value="<?php echo get_sanitize_input($act); ?>">
    <input type="hidden" name="url" value="<?php echo clean_xss_tags(strip_tags($_SERVER['HTTP_REFERER'])); ?>">
    <div class=" new_win_con"> 
        <div class="tbl_head01 tbl_wrap">
            <table>
            <caption><?php echo $act ?>할 그룹을 한개 이상 선택하여 주십시오.</caption>
            <thead>
            <tr>
                <th scope="col">
                    <?php if ( $inputbox_type == "checkbox" ){ //복사일때만 ?>
                    <label for="chkall" class="sound_only">그룹 전체</label>
                    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
                    <?php } ?>
                </th>
                <th scope="col">그룹</th>
            </tr>
            </thead>
            <tbody>
            <?php for ($i=0; $i<count((array)$list); $i++) { ?>
            <tr>
                <td class="td_chk">
                    <label for="chk<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['bg_name'] ?></label>
                    <input type="<?php echo $inputbox_type; ?>" value="<?php echo $list[$i]['bg_no'] ?>" id="chk<?php echo $i ?>" name="chk_bg_no[]">
                </td>
                <td>
                    <label for="chk<?php echo $i ?>">
                        <?php echo $list[$i]['bg_name'] ?>
                    </label>
                </td>
            </tr>
            <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
    <div class="win_btn">
        <input type="submit" value="<?php echo $act ?>" id="btn_submit" class="btn_submit btn-e btn-e-red width-100px">
        <button type="button" class="btn_cancel btn-e btn-e-dark width-100px">창닫기</button>
    </div>
    </form>
</div>

<script>
(function($) {
    $(".win_btn button").click(function(e) {
        window.close();
        return false;
    });
})(jQuery);

function all_checked(sw) {
    var f = document.fboardmoveall;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bg_no[]")
            f.elements[i].checked = sw;
    }
}

function fboardmoveall_submit(f) {
    var check = false;

    if (typeof(f.elements['chk_bg_no[]']) == 'undefined')
        ;
    else {
        if (typeof(f.elements['chk_bg_no[]'].length) == 'undefined') {
            if (f.elements['chk_bg_no[]'].checked)
                check = true;
        } else {
            for (i=0; i<f.elements['chk_bg_no[]'].length; i++) {
                if (f.elements['chk_bg_no[]'][i].checked) {
                    check = true;
                    break;
                }
            }
        }
    }

    if (!check) {
        alert('이모티콘을 '+f.act.value+'할 그룹을 한개 이상 선택해 주십시오.');
        return false;
    }

    document.getElementById('btn_submit').disabled = true;

    return true;
}
</script>