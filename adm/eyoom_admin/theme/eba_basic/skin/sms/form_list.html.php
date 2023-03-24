<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/form_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'form_list';
$g5_title = '이모티콘 관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
#sms5_preset {padding:20px 20px 0;min-height:60px;border-radius:0;background-color:transparent;border:1px solid var(--tbc-default)}
#sms5_preset li {margin: 0 20px 20px 0}
#sms5_preset .li_preview {width:120px}
#sms5_preset .box_square {width:120px;height:80px}
#sms5_preset .li_info {width:120px;margin:0 0 0 10px}
#sms5_preset .li_cmd a {margin-left:5px}
/* page */
.pg_wrap {clear:both;margin:20px 0 0;padding:0;text-align:center}
.pg {display:inline-block}
.pg_page, .pg_current {font-size:.75rem;color:#fff;background-color:#353535;display:inline-block;float:left;padding:0;width:32px;height:26px;line-height:26px;text-decoration:none;border:0;margin:1px}
.pg a:focus, .pg a:hover {background-color:none}
.pg_current {display:inline-block;background:#3949ab;color:#fff;font-weight:400}
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
    <div class="f-s-13r m-b-5">
    건수 <strong class="text-crimson"><?php echo number_format($total_count); ?></strong>건
    </div>

    <form name="search_form" method="get" action="" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir;?>">
    <input type="hidden" name="pid" value="<?php echo $pid;?>">
    <input type="hidden" name="fg_no" value="<?php echo $fg_no;?>">

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="fg_no" class="label">그룹명</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-150px">
                        <select name="fg_no" id="fg_no" onchange="location.href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=form_list&amp;fg_no='+this.value;">
                            <option value="" <?php echo $fg_no?'':'selected'?>> 전체 </option>
                            <option value="0" <?php echo $fg_no=='0'?'selected':''?>> 미분류 (<?php echo number_format($no_count)?>) </option>
                            <?php for($i=0; $i<count((array)$group); $i++) {?>
                            <option value="<?php echo $group[$i]['fg_no']?>" <?php echo ($fg_no==$group[$i]['fg_no'])?'selected':''?>> <?php echo $group[$i]['fg_name']?> (<?php echo number_format($group[$i]['fg_count'])?>) </option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="sv" class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="st" id="st">
                                    <option value="all"<?php echo get_selected('all', $st); ?>>제목 + 이모티콘</option>
                                    <option value="name"<?php echo get_selected('name', $st); ?>>제목</option>
                                    <option value="content"<?php echo get_selected('content', $st); ?>>이모티콘</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input width-250px">
                                <input type="text" name="sv" value="<?php echo get_text($sv) ;?>" id="sv" required>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark">
        </div>
    </div>

    </form>

    <form name="emoticonlist" id="emoticonlist" method="post" action="<?php echo $action_url; ?>" onsubmit="return emoticonlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="fg_no" value="<?php echo $fg_no; ?>">
    <input type="hidden" name="sw" value="">
    <input type="hidden" name="atype" value="del">

    <div id="sms5_preset_sel">
        <label class="checkbox"><input type="checkbox" id="book_all" onclick="book_all_checked(this.checked);"><i></i>전체선택</label>
    </div>

    <ul id="sms5_preset" class="sms5_box m-b-20">
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
                <textarea readonly class="box_txt box_square"><?php echo html_purifier($res['fo_content']); ?></textarea>
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
        <?php if($li_i == 0) { ?>
        <div class="text-center"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</div>
        <?php } ?>
    </ul>
    
    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit; ?>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <div class="m-t-20">
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, G5_ADMIN_URL."/?dir=sms&amp;pid=form_list&amp;fg_no=$fg_no&amp;st=$st&amp;sv=$sv&amp;page="); ?>
    </div>
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