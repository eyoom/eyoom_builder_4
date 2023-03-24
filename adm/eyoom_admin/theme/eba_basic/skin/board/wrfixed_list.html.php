<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/wrfixed_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'wrfixed_list';
$g5_title = '상당고정게시물관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-wrfixed-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">

    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label for="stx" class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="sfl" id="sfl">
                                    <option value="bo_table"<?php echo get_selected($sfl, "bo_table"); ?>>테이블아이디</option>
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
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fboardlist" id="fboardlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fboardlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="m-b-5 f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>상단고정 게시물수 <?php echo number_format($total_count); ?>개
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
                        <th>게시판명</th>
                        <th>테이블아이디</th>
                        <th>글제목</th>
                        <th>작성자</th>
                        <th>작성자보유P</th>
                        <th>소모P</th>
                        <th>상단고정자</th>
                        <th>고정일수</th>
                        <th>상태</th>
                        <th>파기일</th>
                        <th>포인트처리일</th>
                        <th>신청일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$bf_cnt; $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="au_menu[<?php echo $i; ?>]" value="<?php echo $list[$i]['au_menu']; ?>">
                            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td class="text-center">
                            <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>" target="_blank"><strong><?php echo $list[$i]['bo_subject']; ?></strong></a>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table']); ?>" target="_blank"><strong><?php echo $list[$i]['bo_table']; ?></strong></a>
                            <input type="hidden" name="bo_table[<?php echo $i; ?>]" value="<?php echo $list[$i]['bo_table']; ?>">
                            <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['wr_id']; ?>">
                        </td>
                        <td>
                            <a href="<?php echo get_eyoom_pretty_url($list[$i]['bo_table'], $list[$i]['wr_id']); ?>" target="_blank"><strong><?php echo $list[$i]['wr_subject']; ?></strong></a>
                        </td>
                        <td class="text-center">
                            <?php echo $list[$i]['wr_name']; ?> [<?php echo $list[$i]['wr_mb_id']; ?>]
                        </td>
                        <td><?php echo number_format($list[$i]['mb_point']); ?></td>
                        <td><?php echo number_format($list[$i]['bf_wrfixed_point']); ?></td>
                        <td class="text-center"><?php echo $list[$i]['mb_id']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bf_wrfixed_date']; ?></td>
                        <td>
                            <label class="select width-150px"><select name="bf_open[<?php echo $i; ?>]"><option value="n" <?php echo $list[$i]['bf_open'] == 'n' ? 'selected': ''; ?>>대기중</option><option value="y" <?php echo $list[$i]['bf_open'] == 'y' ? 'selected': ''; ?>>고정중</option></select><i></i></label>
                        </td>
                        <td class="text-center"><?php echo $list[$i]['ex_datetime']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['po_datetime']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bf_datetime']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($bf_cnt == 0) { ?>
                    <tr>
                        <td colspan="13" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
        <?php if ($is_admin == 'super') { ?>
        <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
        <?php } ?>
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.submit();
    }
}

function fboardlist_submit(f) {
    if (!is_checked("chk[]")) {
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
</script>