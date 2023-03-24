<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/form_group.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'form_group';
$g5_title = '이모티콘 그룹';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<script>
function move(fg_no, fg_name, sel) {
    var msg = '';
    if (sel.value)
    {
        msg  = "'" + fg_name + "' 그룹에 속한 모든 데이터를\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' 그룹으로 이동하시겠습니까?";

        if (confirm(msg))
            location.href = 'form_group_move.php?fg_no=' + fg_no + '&move_no=' + sel.value;
        else
            sel.selectedIndex = 0;
    }
}

function empty(fg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?"))
        location.href = 'form_group_update.php?w='+ fg_no +'&fg_no=' + fg_no;
}

function grouplist_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '미분류'로 이동됩니다.\n\n그래도 삭제하시겠습니까?")) {
            f.w.value = "de";
        } else {
            return false;
        }
    }

    if(document.pressed == "선택비우기") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?")) {
            f.w.value = "em";
        } else {
            return false;
        }
    }

    return true;
}
</script>

<div class="admin-form-group">
    <form name="group<?php echo $res['fg_no']?>" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="fg_no" value="<?php echo $res['fg_no']?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="fg_name" class="label">그룹명<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input input-button max-width-250px">
                    <input type="text" id="fg_name" name="fg_name" required>
                    <div class="button"><input type="submit">추가</div>
                </div>
            </div>
        </div>
        <div class="adm-form-cont">
            <div class="cont-text-bg">
                <p class="bg-success">
                    <i class="fas fa-info-circle"></i> 건수 : <strong><?php echo $total_count ?></strong>
                </p>
            </div>
        </div>
    </div>

    </form>

    <form name="group<?php echo $group[$i]['fg_no']?>" method="post" action="<?php echo $action_url; ?>" onsubmit="return grouplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="u">

    <p class="f-s-13r m-b-5 text-gray">Note! 그룹명순으로 정렬됩니다.</p>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb m-b-10">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th>보기</th>
                        <th>그룹명</th>
                        <th>이모티콘수</th>
                        <th>이동</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $qry = sql_query("select count(*) as cnt from {$g5['sms5_form_table']} where fg_no=0");
                    $res = sql_fetch_array($qry);
                    ?>
                    <tr>
                        <th></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_list&fg_no=0"><u>보기</u></a>
                        </td>
                        <td class="text-center">미분류</td>
                        <td class="text-center"><?php echo number_format($res['cnt'])?></td>
                        <td>
                            <label class="select width-150px"><select name="select_fg_no_999" id="select_fg_no_999" onchange="move(0, '미분류', this);"><option value=""></option><?php for ($i=0; $i<count((array)$group); $i++) { ?><option value="<?php echo $group[$i]['fg_no']?>"> <?php echo $group[$i]['fg_name']?> </option><?php } ?></select><i></i></label>
                        </td>
                    </tr>
                    <?php for ($i=0; $i<count((array)$group); $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="fg_no[<?php echo $i; ?>]" value="<?php echo $group[$i]['fg_no']; ?>" id="fg_no_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_list&fg_no=<?php echo $group[$i]['fg_no']?>"><u>보기</u></a>
                        </td>
                        <td class="text-center">
                            <label class="input width-150px"><input type="text" name="fg_name[<?php echo $i; ?>]" value="<?php echo get_sanitize_input($group[$i]['fg_name']); ?>" id="fg_name_<?php echo $i; ?>"></label>
                        </td>
                        <td class="text-center"><?php echo number_format($group[$i]['fg_count'])?></td>
                        <td>
                            <label class="select width-150px"><select name="select_fg_no[<?php echo $i; ?>]" id="select_fg_no_<?php echo $i; ?>" onchange="move(<?php echo $group[$i]['fg_no']?>, '<?php echo $group[$i]['fg_name']?>', this);"><option value=""></option><option value="0">미분류</option><?php for ($j=0; $j<count((array)$group); $j++) { ?><?php if ($group[$i]['fg_no']==$group[$j]['fg_no']) continue; ?><option value="<?php echo $group[$j]['fg_no']?>"> <?php echo $group[$j]['fg_name']?> </option><?php } ?></select><i></i></label>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$group) == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>