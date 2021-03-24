<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/sms/form_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
?>

<style>
.form-list-sch {position:relative;padding:10px 10px 5px;background:#fff;border:2px solid #757575;margin-bottom:20px}
#sms5_preset {padding:20px 20px 0 20px}
#sms5_preset .li_cmd a {margin:0 2px}
</style>

<script>
function book_all_checked(chk) {
    if (chk) {
        jQuery('[name="fo_no[]"]').attr('checked', true);
    } else {
        jQuery('[name="fo_no[]"]').attr('checked', false);
    }
}

function book_del(fo_no) {
    if (confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n그래도 삭제하시겠습니까?"))
        location.href = "<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_update&w=d&fo_no=" + fo_no + "&page=<?php echo $page?>&fg_no=<?php echo $fg_no?>&st=<?php echo get_text($st); ?>&sv=<?php echo get_text($sv); ?>";
}

function multi_update(sel) {
    var fo_no = document.getElementsByName('fo_no');
    var ck_no = '';
    var count = 0;

    if (!sel.value) {
        sel.selectedIndex = 0;
        return;
    }

    for (i=0; i<fo_no.length; i++) {
        if (fo_no[i].checked==true) {
            count++;
            ck_no += fo_no[i].value + ',';
        }
    }

    if (!count) {
        alert('하나이상 선택해주세요.');
        sel.selectedIndex = 0;
        return;
    }

    if (sel.value == 'del') {
        if (!confirm("선택한 이모티콘를 삭제합니다.\n\n비회원만 삭제됩니다.\n\n회원을 삭제하려면 회원관리 메뉴를 이용해주세요.\n\n실행하시겠습니까?"))
        {
            sel.selectedIndex = 0;
            return;
        }
    } else if (!confirm("선택한 이모티콘를 " + sel.options[sel.selectedIndex].innerHTML + "\n\n실행하시겠습니까?")) {
        sel.selectedIndex = 0;
        return;
    }

    location.href = "<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=form_multi_update&w=" + sel.value + "&ck_no=" + ck_no;
}
</script>

<div class="admin-form-list">
    <div class="adm-headline">
        <h3><?php echo $g5['title']; ?></h3>
    </div>

    <div class="margin-bottom-10 font-size-12">건수 : <strong class="color-red"><?php echo number_format($total_count);?></strong>건</div>

    <div class="form-list-sch">
        <div class="eyoom-form margin-bottom-5">
            <div class="row">
                <div class="col col-3">
                    <label for="fg_no" class="label sound_only">그룹명</label>
                    <label class="select">
                        <select name="fg_no" id="fg_no" onchange="location.href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=form_list&amp;fg_no='+this.value;">
                            <option value="" <?php echo $fg_no?'':'selected'?>> 전체 </option>
                            <option value="0" <?php echo $fg_no=='0'?'selected':''?>> 미분류 (<?php echo number_format($no_count)?>) </option>
                            <?php for($i=0; $i<count((array)$group); $i++) {?>
                            <option value="<?php echo $group[$i]['fg_no']?>" <?php echo ($fg_no==$group[$i]['fg_no'])?'selected':''?>> <?php echo $group[$i]['fg_name']?> (<?php echo number_format($group[$i]['fg_count'])?>) </option>
                            <?php } ?>
                        </select>
                        <i></i>
                    </label>
                </div>
            </div>
        </div>
            
        <form name="search_form" method="get" action="" class="eyoom-form">
        <input type="hidden" name="dir" value="<?php echo $dir;?>">
        <input type="hidden" name="pid" value="<?php echo $pid;?>">
        <input type="hidden" name="fg_no" value="<?php echo $fg_no;?>">
        <div class="row">
            <div class="col col-3">
                <label for="st" class="label sound_only">검색대상</label>
                <label class="select">
                    <select name="st" id="st">
                        <option value="all"<?php echo get_selected('all', $st); ?>>제목 + 이모티콘</option>
                        <option value="name"<?php echo get_selected('name', $st); ?>>제목</option>
                        <option value="content"<?php echo get_selected('content', $st); ?>>이모티콘</option>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="col col-3">
                <label for="sv" class="label sound_only">검색어<strong class="sound_only"> 필수</strong><</label>
                <div class="input input-button">
                    <input type="text" name="sv" value="<?php echo get_text($sv) ;?>" id="sv" required>
                    <div class="button"><input type="submit" value="검색">검색</div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div id="sms5_preset_sel" class="eyoom-form">
        <label class="checkbox"><input type="checkbox" id="book_all" onclick="book_all_checked(this.checked);"><i></i>전체선택</label>
    </div>

    <form name="emoticonlist" id="emoticonlist" method="post" action="<?php echo $action_url; ?>" onsubmit="return emoticonlist_submit(this);">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="fg_no" value="<?php echo $fg_no; ?>">
    <input type="hidden" name="sw" value="">
    <input type="hidden" name="atype" value="del">
    <ul id="sms5_preset" class="sms5_box">
        <?php
        $count = 1;
        $qry = sql_query("select * from {$g5['sms5_form_table']} where 1 $sql_group $sql_search order by fo_no desc limit $page_start, $page_size");
        for($i=0;$res = sql_fetch_array($qry);$i++)
        {
            $tmp = sql_fetch("select fg_name from {$g5['sms5_form_group_table']} where fg_no='{$res['fg_no']}'");
            if (!$tmp)
                $group_name = '미분류';
            else
                $group_name = $tmp['fg_name'];

            if ($i == 0) $li_i = 1;
            else {
                if ($li_i < 12) $li_i += 1;
                else if ($li_i == 12) $li_i = 1;
            }
        ?>
        <li class="li_<?php echo $li_i; ?> sms5_box">
            <span class="box_ico"></span>
            <div class="li_chk">
                <label for="fo_no_<?php echo $i; ?>" class="sound_only"><?php echo $group_name?>의 <?php echo cut_str($res['fo_name'],10)?></label>
                <input type="checkbox" name="fo_no[]" value="<?php echo $res['fo_no']?>" id="fo_no_<?php echo $i; ?>">
            </div>
            <div class="li_preview">
                <textarea readonly class="box_txt box_square"><?php echo $res['fo_content']?></textarea>
            </div>
            <div class="li_info">
                <span class="sound_only">그룹 </span><b><?php echo $group_name?></b><br>
                <span class="sound_only">제목 </span><?php echo cut_str($res['fo_name'],10)?><br>
            </div>
            <div class="li_date">
                <span class="sound_only">등록 </span><?php echo date('Y-m-d', strtotime($res['fo_datetime']))?>
            </div>
            <div class="li_cmd">
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=form_write&amp;w=u&amp;fo_no=<?php echo $res['fo_no']?>&amp;page=<?php echo $page;?>&amp;fg_no=<?php echo $fg_no;?>&amp;st=<?php echo get_text($st);?>&amp;sv=<?php echo get_text($sv);?>">수정</a>
                <a href="javascript:void(book_del('<?php echo $res['fo_no']?>'));">삭제</a>
                <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=sms_write&amp;fo_no=<?php echo $res['fo_no']?>">보내기</a>
            </div>
        </li>
        <?php } ?>
    </ul>
    
    <div class="margin-top-20">
        <?php echo $frm_submit; ?>
    </div>

    </form>

    <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, G5_ADMIN_URL."/?dir=sms&amp;pid=form_list&amp;fg_no=$fg_no&amp;st=$st&amp;sv=$sv&amp;page="); ?>
</div>

<script>
function emoticonlist_submit(f) {
    if (!is_checked("fo_no[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
    if(document.pressed == "선택이동") {
        select_copy("move", f);
        return;
    }
    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    return true;
}

// 선택한 이모티콘 그룹 이동
function select_copy(sw, f) {
    if( !f ){
        var f = document.emoticonlist;
    }
    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=emoticon_move&wmode=1";
    f.submit();
}
</script>