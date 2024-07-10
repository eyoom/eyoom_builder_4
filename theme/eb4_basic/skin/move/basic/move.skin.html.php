<?php
/**
 * skin file : /theme/THEME_NAME/skin/move/basic/move.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.copy-move {position:relative;overflow:hidden;padding:15px;font-size:.9375rem}
.copy-move .eyoom-form {border:0}
.copy-move .eyoom-form label {margin-bottom:0}
.copy-move .eyoom-form .checkbox i {top:-8px}
.copy-move .copymove_current {color:#e53935;padding:0;width:17px;height:17px;border-radius:50%}
.copy-move .copy-move-list label span {margin-right:10px}
</style>

<div class="copy-move">
    <form name="fboardmoveall" method="post" action="<?php echo G5_BBS_URL; ?>/move_update.php" onsubmit="return fboardmoveall_submit(this);" class="eyoom-form">
    <input type="hidden" name="sw" value="<?php echo $sw; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id_list" value="<?php echo $wr_id_list; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="act" value="<?php echo $act; ?>">
    <input type="hidden" name="url" value="<?php echo $SERVER['HTTP_REFERER']; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <h5 class="m-b-20"><strong><?php echo $g5['title']; ?></strong></h5>
    <div class="table-list-eb">
        <div class="board-list-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <label for="chkall" class="sound_only">현재 페이지 게시판 전체</label>
                            <label class="checkbox">
                                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>
                            </label>
                        </th>
                        <th>게시판</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr class="<?php echo $list[$i]['atc_bg']; ?>">
                        <td>
                            <label for="chk<?php echo $i; ?>" class="sound_only"><?php echo $list[$i]['bo_table']; ?></label>
                            <label class="checkbox">
                                <input type="checkbox" value="<?php echo $list[$i]['bo_table']; ?>" id="chk<?php echo $i; ?>" name="chk_bo_table[]"><i></i>
                            </label>
                        </td>
                        <td class="copy-move-list">
                            <label for="chk<?php echo $i; ?>">
                                <span><?php echo $list[$i]['gr_subject']; ?> / <?php echo $list[$i]['bo_subject']; ?></span><span class="text-gray">(<?php echo $list[$i]['bo_table']; ?>)</span><span><?php echo $list[$i]['atc_mark']; ?></span>
                            </label>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="win-btn text-center">
        <input type="submit" value="<?php echo $act; ?>" id="btn_submit" class="btn-e btn-e-lg btn-e-navy">
    </div>
    <div class="m-b-20"></div>
    </form>
</div>

<script>
$(function() {
    $(".win-btn").append("<button type=\"button\" class=\"btn-e btn-e-lg btn-e-dark\">창닫기</button>");
    $(".win-btn button").click(function() {
        window.close();
    });
});

function all_checked(sw) {
    var f = document.fboardmoveall;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bo_table[]")
            f.elements[i].checked = sw;
    }
}

function fboardmoveall_submit(f) {
    var check = false;
    if (typeof(f.elements['chk_bo_table[]']) == 'undefined')
        ;
    else {
        if (typeof(f.elements['chk_bo_table[]'].length) == 'undefined') {
            if (f.elements['chk_bo_table[]'].checked)
                check = true;
        } else {
            for (i=0; i<f.elements['chk_bo_table[]'].length; i++) {
                if (f.elements['chk_bo_table[]'][i].checked) {
                    check = true;
                    break;
                }
            }
        }
    }
    if (!check) {
        alert('게시물을 '+f.act.value+'할 게시판을 한개 이상 선택해 주십시오.');
        return false;
    }
    document.getElementById('btn_submit').disabled = true;
    f.action = './move_update.php';
    return true;
}
</script>