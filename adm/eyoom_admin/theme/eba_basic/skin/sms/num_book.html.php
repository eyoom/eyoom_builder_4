<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/num_book.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'num_book';
$g5_title = '휴대폰번호 관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.num-book-info {position:relative;padding:15px;border:1px solid var(--tbc-default)}
.num-book-info .book-info-li {margin-right:15px}
.num-book-info .book-info-li .ov-txt {margin-right:5px}
.num-book-info .book-info-li .ov-num {color:#ab0000;font-weight:700}
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
        jQuery('[name="bk_no[]"]').attr('checked', true);
    } else {
        jQuery('[name="bk_no[]"]').attr('checked', false);
    }
}

function no_hp_click(val) {
    var url = '<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book&bg_no=<?php echo $bg_no?>&st=<?php echo $st?>&sv=<?php echo $sv?>';

    if (val == true)
        location.href = url + '&no_hp=yes';
    else
        location.href = url + '&no_hp=no';
}
</script>

<div class="admin-num-book">
    <form id="search_form" name="search_form" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="bg_no" value="<?php echo $bg_no?>" >

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="st" id="st">
                                    <option value="all"<?php echo get_selected('all', $st); ?>>이름 + 휴대폰번호</option>
                                    <option value="name"<?php echo get_selected('name', $st); ?>>이름</option>
                                    <option value="hp" <?php echo get_selected('hp', $st); ?>>휴대폰번호</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input max-width-250px">
                                <input type="text" name="sv" value="<?php echo get_sanitize_input($sv); ?>" id="sv">
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit1;?>
        </div>
    </div>

    </form>

    <div class="num-book-info m-b-20">
        <?php if($sms5['cf_datetime']) { ?>
        <span class="book-info-li"><span class="ov-txt">업데이트 </span><span class="ov-num"><?php echo $sms5['cf_datetime']?></span></span>
        <?php } ?>
        <span class="book-info-li"><span class="ov-txt">건수 </span><span class="ov-num"><?php echo number_format($total_count)?>명</span></span>
        <span class="book-info-li"><span class="ov-txt">회원 </span><span class="ov-num"> <?php echo number_format($member_count)?>명</span></span>
        <span class="book-info-li"><span class="ov-txt">비회원 </span><span class="ov-num"> <?php echo number_format($no_member_count)?>명</span></span>
        <span class="book-info-li"><span class="ov-txt">수신 </span><span class="ov-num"> <?php echo number_format($receipt_count)?>명</span></span>
        <span class="book-info-li"><span class="ov-txt">거부 </span><span class="ov-num"> <?php echo number_format($reject_count)?>명</span></span>
    </div>

    <form name="search_form" class="eyoom-form m-b-20">
        <div class="inline-group">
            <span class="d-inline-block">
                <label class="select width-200px m-r-10">
                    <select name="bg_no" id="bg_no" onchange="location.href='<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book&bg_no='+this.value;">
                        <option value=""<?php echo get_selected('', $bg_no); ?>> 전체 </option>
                        <option value="<?php echo $no_group['bg_no']?>"<?php echo get_selected($no_group['bg_no'], $bg_no); ?>> <?php echo $no_group['bg_name']?> (<?php echo number_format($no_group['bg_count'])?> 명) </option>
                        <?php for($i=0; $i<count((array)$group); $i++) {?>
                        <option value="<?php echo $group[$i]['bg_no']?>"<?php echo get_selected($group[$i]['bg_no'], $bg_no);?>> <?php echo $group[$i]['bg_name']?> (<?php echo number_format($group[$i]['bg_count'])?> 명) </option>
                        <?php } ?>
                    </select>
                    <i></i>
                </label>
            </span>
            <span class="d-inline-block">
                <label class="checkbox"><input type="checkbox" name="no_hp" id="no_hp" <?php echo $no_hp_checked?> onclick="no_hp_click(this.checked)"><i></i>휴대폰 소유자만 보기</label>
            </span>
        </div>
    </form>

    <form name="hp_manage_list" id="hp_manage_list" method="post" action="<?php echo $action_url; ?>" onsubmit="return hplist_submit(this);" class="eyoom-form">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input type="hidden" name="sw" value="">
    <input type="hidden" name="atype" value="del">
    <input type="hidden" name="str_query" value="<?php echo clean_query_string($_SERVER['QUERY_STRING']); ?>" >

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" id="chk_all" onclick="book_all_checked(this.checked)"><i></i></label>
                        </th>
                        <th class="width-60px">번호</th>
                        <th class="width-180px">관리</th>
                        <th>그룹</th>
                        <th>이름</th>
                        <th>휴대폰</th>
                        <th>수신</th>
                        <th>아이디</th>
                        <th>업데이트</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="bk_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['bk_no']; ?>" id="bk_no_<?php echo $i; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="bk_no[]" value="<?php echo $res['bk_no']?>" id="bk_no_<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center"><?php echo number_format($list[$i]['vnum']); ?></td>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=num_book_write&amp;w=u&amp;bk_no=<?php echo $list[$i]['bk_no']; ?>&amp;page=<?php echo $page; ?>&amp;bg_no=<?php echo $bg_no; ?>&amp;st=<?php echo $st; ?>&amp;sv=<?php echo $sv; ?>&amp;ap=<?php echo $ap; ?>"><u>수정</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=sms_write&amp;bk_no=<?php echo $list[$i]['bk_no']?>" class="m-l-10"><u>보내기</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=sms&amp;pid=history_num&amp;st=hs_hp&amp;sv=<?php echo $list[$i]['bk_hp']?>" class="m-l-10"><u>내역</u></a>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['group_name']; ?></td>
                        <td class="text-center"><?php echo get_text($list[$i]['bk_name']) ?></td>
                        <td class="text-center"><?php echo $list[$i]['bk_hp']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bk_receipt'] ? '<span class="text-teal">수신</span>' : '<span class="text-gray">거부</span>'?></td>
                        <td class="text-center"><?php echo $list[$i]['mb_id'] ? $list[$i]['mb_id'] : '비회원'?></td>
                        <td class="text-center"><?php echo $list[$i]['bk_datetime']?></td>
                    </tr>
                    <?php } ?>
                    <?php if($count == 0) { ?>
                    <tr>
                        <td colspan="9" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit2; ?>
    </div>

    </form>
    
    <?php /* 페이지 */ ?>
    <div class="m-t-20">
        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, G5_ADMIN_URL."/?dir=sms&amp;pid=num_book&amp;bg_no=$bg_no&amp;st=$st&amp;sv=$sv&amp;ap=$ap&amp;page="); ?>
    </div>
</div>

<script>
function hplist_submit(f) {
    if (!is_checked("bk_no[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }
    if(document.pressed == "선택이동") {
        select_copy("move", f);
        return;
    }
    if(document.pressed == "선택복사") {
        select_copy("copy", f);
        return;
    }
    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    if(document.pressed == "수신허용") {
        f.atype.value="receipt";
    }
    if(document.pressed == "수신거부") {
        f.atype.value="reject";
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
    f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=sms&pid=num_book_move&wmode=1";
    f.submit();
}
</script>