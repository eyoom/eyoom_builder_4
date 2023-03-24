<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/emoticon_move.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.new-win {padding:15px}
</style>

<div id="copymove" class="new-win">
    <h5 class="m-b-20"><strong><?php echo $g5['title'] ?></strong></h5>

    <form name="fboardmoveall" method="post" action="<?php echo $action_url; ?>" onsubmit="return fboardmoveall_submit(this);">
    <input type="hidden" name="sw" value="<?php echo $sw ?>">
    <input type="hidden" name="fo_no_list" value="<?php echo $fo_no_list ?>">
    <input type="hidden" name="url" value="<?php echo clean_xss_tags(strip_tags($_SERVER['HTTP_REFERER'])); ?>">

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>선택</th>
                        <th>그룹</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check"><input type="checkbox" value="<?php echo $list[$i]['fg_no'] ?>" id="chk<?php echo $i ?>" name="chk_fg_no[]"><i></i></label>
                        </th>
                        <td class="text-center">
                            <label for="chk<?php echo $i ?>"><?php echo $list[$i]['fg_name'] ?></label>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="win_btn confirm-bottom-btn">
        <input type="submit" value="이동" id="btn_submit" class="btn_submit btn-e btn-e-lg btn-e-crimson">
        <button type="button" class="btn_cancel btn-e btn-e-lg btn-e-dark">창닫기</button>
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
        if (f.elements[i].name == "chk_fg_no[]")
            f.elements[i].checked = sw;
    }
}

function fboardmoveall_submit(f)
{
    var check = false;

    if (typeof(f.elements['chk_fg_no[]']) == 'undefined')
        ;
    else {
        if (typeof(f.elements['chk_fg_no[]'].length) == 'undefined') {
            if (f.elements['chk_fg_no[]'].checked)
                check = true;
        } else {
            for (i=0; i<f.elements['chk_fg_no[]'].length; i++) {
                if (f.elements['chk_fg_no[]'][i].checked) {
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