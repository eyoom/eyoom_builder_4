<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/num_group.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'num_group';
$g5_title = '휴대폰번호 그룹';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<script>
function del(bg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '<?php echo $no_group['bg_name']?>'로 이동됩니다.\n\n그래도 삭제하시겠습니까?"))
        location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_group_update&mw=d&bg_no=' + bg_no;
}

function move(bg_no, bg_name, sel) {
    var msg = '';
    if (sel.value)
    {
        msg  = "'" + bg_name + "' 그룹에 속한 모든 데이터를\n\n'";
        msg += sel.options[sel.selectedIndex].text + "' 그룹으로 이동하시겠습니까?";

        if (confirm(msg))
            location.href = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_group_move&bg_no=' + bg_no + '&move_no=' + sel.value;
        else
            sel.selectedIndex = 0;
    }
}

function empty(bg_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그룹에 속한 데이터를 정말로 비우시겠습니까?"))
        location.href = 'num_group_update.php?mw=empty&bg_no=' + bg_no;
}

function num_group_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n삭제되는 그룹에 속한 자료는 '<?php echo $no_group['bg_name']?>'로 이동됩니다.\n\n그래도 삭제하시겠습니까?")) {
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

<div class="admin-num-form">
    <div class="f-s-13r m-b-5">
        건수 <strong class="text-crimson"><?php echo number_format($total_count); ?></strong>건
    </div>

    <form name="group<?php echo $res['bg_no']?>" method="post" action="<?php echo $action_url; ?>" class="eyoom-form">
    <input type="hidden" name="bg_no" value="<?php echo $res['bg_no']?>">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="bg_name" class="label">그룹추가<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" id="bg_name" name="bg_name" required>
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" value="그룹추가" class="btn-e btn-e-lg btn-e-dark">
    </div>

    </form>
    <div class="m-b-20"></div>

    <form name="group_hp_form" id="group_hp_form" method="post" action="<?php echo $action_url; ?>" onsubmit="return num_group_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="u">

    <div class="m-b-5">
        <p class="float-start f-s-13r text-gray"><i class="fas fa-info-circle m-r-5"></i>그룹명순으로 정렬됩니다.</p>
        <p class="float-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>
        <div class="clearfix"></div>
    </div>

    <div class="table-list-eb m-b-20">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th ckass="width-60px">보기</th>
                        <th>그룹명</th>
                        <th>총</th>
                        <th>회원</th>
                        <th>비회원</th>
                        <th>수신</th>
                        <th>거부</th>
                        <th>이동</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 미분류 시작 -->
                    <tr>
                        <th></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book&amp;bg_no=1"><u>보기</u></a>
                        </td>
                        <td class="text-center"><?php echo $no_group['bg_name']?></td>
                        <td class="text-center"><?php echo number_format($no_group['bg_count'])?></td>
                        <td class="text-center"><?php echo number_format($no_group['bg_member'])?></td>
                        <td class="text-center"><?php echo number_format($no_group['bg_nomember'])?></td>
                        <td class="text-center"><?php echo number_format($no_group['bg_receipt'])?></td>
                        <td class="text-center"><?php echo number_format($no_group['bg_reject'])?></td>
                        <td>
                            <label class="select width-150px">
                                <select name="select_bg_no_999" id="select_bg_no_999" onchange="move(<?php echo $no_group['bg_no']?>, '<?php echo $no_group['bg_name']?>', this);" >
                                    <option value=""></option>
                                    <?php for ($i=0; $i<count($group); $i++) { ?>
                                    <option value="<?php echo $group[$i]['bg_no']?>"> <?php echo get_sanitize_input($group[$i]['bg_name']); ?> </option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                        </td>
                    </tr>
                    <!-- 미분류 끝 -->
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="bg_no[<?php echo $i; ?>]" value="<?php echo $group[$i]['bg_no']; ?>" id="bg_no_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book&amp;bg_no=<?php echo $group[$i]['bg_no']?>"><u>보기</u></a>
                        </td>
                        <td>
                            <label class="input width-150px"><input type="text" name="bg_name[<?php echo $i; ?>]" value="<?php echo get_sanitize_input($group[$i]['bg_name']); ?>" id="bg_name_<?php echo $i; ?>"></label>
                        </td>
                        <td class="text-center"><?php echo number_format($group[$i]['bg_count'])?></td>
                        <td class="text-center"><?php echo number_format($group[$i]['bg_member'])?></td>
                        <td class="text-center"><?php echo number_format($group[$i]['bg_nomember'])?></td>
                        <td class="text-center"><?php echo number_format($group[$i]['bg_receipt'])?></td>
                        <td class="text-center"><?php echo number_format($group[$i]['bg_reject'])?></td>
                        <td>
                            <label class='select width-150px'><select name='select_bg_no[<?php echo $i; ?>]' id='select_bg_no_<?php echo $i; ?>' onchange=\"move(<?php echo $group[$i]['bg_no']?>, '<?php echo $group[$i]['bg_name']?>', this);\"><option value=''></option><option value='<?php echo $no_group['bg_no']?>'><?php echo $no_group['bg_name']?></option><?php for ($j=0; $j<count((array)$group); $j++) { ?><?php if ($group[$i]['bg_no']==$group[$j]['bg_no']) continue; ?><option value='<?php echo $group[$j]['bg_no']?>'><?php echo get_sanitize_input($group[$j]['bg_name']); ?></option><?php } ?></select><i></i></label>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>