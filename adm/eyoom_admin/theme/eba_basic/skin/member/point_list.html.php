<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/member/point_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'point_list';
$g5_title = '포인트관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">회원관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-point-list">
    <form name="fsearch" id="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" id="dir" value="<?php echo $dir; ?>">
    <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">검색어</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="select width-100px">
                                    <select name="sfl" id="sfl">
                                        <option value="mb_id"<?php echo get_selected($sfl, "mb_id"); ?>>아이디</option>
                                        <option value="po_content"<?php echo get_selected($sfl, 'po_content'); ?>>내용</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label class="input max-width-250px">
                                    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">포인트 검색대상</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <label for="po_type_all" class="radio"><input type="radio" name="po_type" id="po_type_all" value="all" <?php echo $po_type_all; ?>><i></i> 전체</label>
                            <label for="po_type_in" class="radio"><input type="radio" name="po_type" id="po_type_in" value="in" <?php echo $po_type_in; ?>><i></i> 지급내역</label>
                            <label for="po_type_out" class="radio"><input type="radio" name="po_type" id="po_type_out" value="out" <?php echo $po_type_out; ?>><i></i> 사용내역</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">기간별 검색</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="fr_date" name="fr_date" value="<?php echo $fr_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span> - </span>
                        <span>
                            <label class="input max-width-150px">
                                <input type="text" id="to_date" name="to_date" value="<?php echo $to_date; ?>" maxlength="10" autocomplete="off">
                            </label>
                        </span>
                        <span class="search-btns">
                            <button type="button" onclick="javascript:set_date('오늘');" class="btn-e btn-e-xs btn-e-gray">오늘</button>
                            <button type="button" onclick="javascript:set_date('어제');" class="btn-e btn-e-xs btn-e-gray">어제</button>
                            <button type="button" onclick="javascript:set_date('이번주');" class="btn-e btn-e-xs btn-e-gray">이번주</button>
                            <button type="button" onclick="javascript:set_date('이번달');" class="btn-e btn-e-xs btn-e-gray">이번달</button>
                            <button type="button" onclick="javascript:set_date('지난주');" class="btn-e btn-e-xs btn-e-gray">지난주</button>
                            <button type="button" onclick="javascript:set_date('지난달');" class="btn-e btn-e-xs btn-e-gray">지난달</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fpointlist" id="fpointlist" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fpointlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>전체 <?php echo number_format($total_count); ?>건
            <?php if (isset($mb['mb_id']) && $mb['mb_id']) { ?>
            <span class="m-l-7">(<?php echo $mb['mb_id']; ?> 님 포인트 합계 : <?php echo number_format($mb['mb_point']); ?>점)</span>
            <?php } else { ?>
            <span class="m-l-7">(전체 합계 <?php echo number_format($sum_point); ?>점)</span>
            <?php } ?>
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="mb_id|asc" <?php if ($sst=='mb_id' && $sod=='asc') echo 'selected'; ?>>회원아이디 정방향 (↓)</option>
                    <option value="mb_id|desc" <?php if ($sst=='mb_id' && $sod=='desc') echo 'selected'; ?>>회원아이디 역방향 (↑)</option>
                    <option value="po_content|asc" <?php if ($sst=='po_content' && $sod=='asc') echo 'selected'; ?>>포인트 내용 정방향 (↓)</option>
                    <option value="po_content|desc" <?php if ($sst=='po_content' && $sod=='desc') echo 'selected'; ?>>포인트 내용 역방향 (↑)</option>
                    <option value="po_point|asc" <?php if ($sst=='po_point' && $sod=='asc') echo 'selected'; ?>>포인트 정방향 (↓)</option>
                    <option value="po_point|desc" <?php if ($sst=='po_point' && $sod=='desc') echo 'selected'; ?>>포인트 역방향 (↑)</option>
                    <option value="po_datetime|asc" <?php if ($sst=='po_datetime' && $sod=='asc') echo 'selected'; ?>>일시 정방향 (↓)</option>
                    <option value="po_datetime|desc" <?php if ($sst=='po_datetime' && $sod=='desc') echo 'selected'; ?>>일시 역방향 (↑)</option>
                </select><i></i>
            </label>
        </div>
        <div class="clearfix"></div>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th>회원아이디</th>
                        <th>이름</th>
                        <th>닉네임</th>
                        <th>포인트내용</th>
                        <th>포인트</th>
                        <th>일시</th>
                        <th>만료일</th>
                        <th>포인트합</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_id']; ?>" id="mb_id_<?php echo $i; ?>">
                            <input type="hidden" name="po_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['po_id']; ?>" id="po_id_<?php echo $i; ?>">
                        </th>
                        <td><?php echo $list[$i]['mb_id']; ?></td>
                        <td><?php echo $list[$i]['mb_name']; ?></td>
                        <td><?php echo $list[$i]['mb_nick']; ?></td>
                        <td><?php if ($list[$i]['link']) { ?><a href="<?php echo get_eyoom_pretty_url($list[$i]['po_rel_table'],$list[$i]['po_rel_id']); ?>" target="_blank"><span><?php echo $list[$i]['po_content']; ?></span></a><?php } else { ?><span><?php echo $list[$i]['po_content']; ?></span><?php } ?></td>
                        <td><?php echo number_format($list[$i]['po_point']); ?></td>
                        <td><?php echo $list[$i]['po_datetime']; ?></td>
                        <td><?php echo $list[$i]['expire_date']; ?></td>
                        <td><?php echo number_format($list[$i]['po_mb_point']); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="9" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <div class="m-b-20">
        <?php echo eb_paging($eyoom['paging_skin']);?>
    </div>

    <form name="fpointlist2" method="post" id="fpointlist2" action="<?php echo $action_url2; ?>" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>개별회원 포인트 증감 설정</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="mb_id" class="label">회원아이디</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="input input-button max-width-500px">
                    <input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id; ?>" required>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="button"><input type="button">회원검색<i class="far fa-window-restore m-l-7"></i></a>
                </div>
                <div class="note">Note! '회원검색' 클릭후 회원아이디를 검색/선택하세요.</div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="po_content" class="label">포인트내용</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input">
                        <input type="text" name="po_content" id="po_content" value="" required>
                    </label>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="po_point" class="label">포인트</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <input type="text" name="po_point" id="po_point" value="" required>
                    </label>
                </div>
            </div>
        </div>
        <?php if ($config['cf_point_term'] > 0) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="po_expire_term" class="label">포인트 유효기간</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">일</i>
                    <input type="text" name="po_expire_term" id="po_expire_term" value="<?php echo $config['cf_point_term']; ?>">
                </label>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="confirm-bottom-btn">
        <button type="submit" id="btn_submit" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">확인</button>
    </div>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 검색 및 선택</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-e btn-e-lg btn-e-dark" data-bs-dismiss="modal">닫기<i class="fas fa-times m-l-5"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#fr_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#to_date').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#fr_date').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

<?php if (!$wmode) { ?>
function eb_modal(href) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function fpointlist_submit(f) {
    if ($("input:checked").length == 0) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

function set_date(today) {
    <?php
    $date_term = date('w', G5_SERVER_TIME);
    $week_term = $date_term + 7;
    $last_term = strtotime(date('Y-m-01', G5_SERVER_TIME));
    ?>
    if (today == "오늘") {
        document.getElementById("fr_date").value = "<?php echo G5_TIME_YMD; ?>";
        document.getElementById("to_date").value = "<?php echo G5_TIME_YMD; ?>";
    } else if (today == "어제") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME - 86400); ?>";
    } else if (today == "이번주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.($date_term + 6).' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "이번달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', G5_SERVER_TIME); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', G5_SERVER_TIME); ?>";
    } else if (today == "지난주") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-d', strtotime('-'.$week_term.' days', G5_SERVER_TIME)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-d', strtotime('-'.($week_term - 6).' days', G5_SERVER_TIME)); ?>";
    } else if (today == "지난달") {
        document.getElementById("fr_date").value = "<?php echo date('Y-m-01', strtotime('-1 Month', $last_term)); ?>";
        document.getElementById("to_date").value = "<?php echo date('Y-m-t', strtotime('-1 Month', $last_term)); ?>";
    }
}
</script>