<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/bbs.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'bbs_list';
$g5_title = '게시물통합관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="adm-headline">
        <h3>게시물 관리</h3>
        <?php if (!$wmode && $bo_table) { ?>
        <a href="<?php echo G5_BBS_URL; ?>/write.php?bo_table=<?php echo $bo_table; ?>&amp;wmode=1" class="btn-e btn-e-md btn-e-crimson adm-headline-btn" onclick="eb_modal(this.href); return false;"><i class="las la-plus m-r-7"></i><span>글쓰기</span></a>
        <?php } ?>
    </div>

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
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">그룹선택</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <?php echo get_group_select('gr_id', $gr_id, 'onchange="group_board(this.value);"'); ?><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">게시판선택</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px" id="select_board">
                            <select name="bo_table" id="bo_table" onchange="board_list(this.form);">
                                <option value="">게시판선택</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label class="label">게시물타입</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="view" id="view" onchange="board_list(this.form);">
                                <option value="">전체게시물</option>
                                <option value="w" <?php echo $view=='w' ? 'selected': ''; ?>>원글만</option>
                                <option value="c" <?php echo $view=='c' ? 'selected': ''; ?>>댓글만</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
                <div class="adm-form-tr tr-r">
                    <div class="adm-form-td td-l">
                        <label class="label">검색조건</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="select max-width-250px">
                            <select name="sop" id="sop" onchange="board_list(this.form);">
                                <option value="and" <?php echo $sop=='' || $sop=='and' ? 'selected': ''; ?>>AND</option>
                                <option value="or" <?php echo $sop=='or' ? 'selected': ''; ?>>OR</option>
                            </select><i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr">
                <div class="adm-form-td td-l">
                    <label class="label">검색어</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <span>
                            <label class="select width-150px">
                                <select name="sfl" id="sfl">
                                    <option value=""> ::: 선택 ::: </option>
                                    <option value="wr_subject">제목</option>
                                    <option value="wr_content">내용</option>
                                    <option value="wr_subject||wr_content" selected>제목+내용</option>
                                    <option value="mb_id,1">회원아이디</option>
                                    <option value="mb_id,0">회원아이디(코)</option>
                                    <option value="wr_name,1">글쓴이</option>
                                    <option value="wr_name,0">글쓴이(코)</option>
                                </select><i></i>
                            </label>
                        </span>
                        <span>
                            <label class="input max-width-350px">
                                <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" autocomplete="off">
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>

    <form name="fbbslist" id="fbbslist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fbbslist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="sop" value="<?php echo $sop; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="view" value="<?php echo $view; ?>">
    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <div class="float-start f-s-13r">
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>게시물수 <?php echo number_format($total_count); ?>건
    </div>
    <p class="text-end f-s-13r m-b-5 text-gray">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all(this.form)"><i></i></label>
                        </th>
                        <th class="width-100px">관리</th>
                        <th class="width-100px">번호</th>
                        <th class="width-180px">그룹</th>
                        <th class="width-180px">게시판</th>
                        <th><?php echo subject_sort_link('wr_subject',$qstr) ?>제목</a></th>
                        <th>작성자</th>
                        <th><?php echo subject_sort_link('wr_datetime',$qstr) ?>등록일</a></th>
                        <th><?php echo subject_sort_link('wr_hit',$qstr) ?>조회</a></th>
                        <th>추천</th>
                        <th>비추천</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$list_count; $i++) { 
                        $li = $list[$i];
                        if (empty($li['wr_is_comment'])) { // 원글이라면
                            $li['wr_subject'] = conv_subject($li['wr_subject'], 200, '…');
                            $wr_subject = $li['wr_subject'];
                        } else { // 댓글이라면
                            $wr_subject = get_text( $li['wr_content'] );
                            $wr_subject = "&nbsp;└&nbsp;&nbsp;{$wr_subject}";
                        }
                    ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="wr_ids[<?php echo $i; ?>]" value="<?php echo $li['wr_id']; ?>"></input>
                        </th>
                        <td class="text-center">
                            <?php if (!$li['wr_is_comment']) { ?>
                            <a href="<?php echo G5_BBS_URL; ?>/write.php?w=u&amp;bo_table=<?php echo $li['bo_table']; ?>&amp;wr_id=<?php echo $li['wr_id']; ?>&amp;wmode=1" onclick="eb_modal(this.href); return false;"><u>수정</u></a>
                            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $li['bo_table']; ?>&amp;wr_id=<?php echo $li['wr_id']; ?>&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="m-l-10"><u>보기</u></a>
                            <?php } else { ?>
                            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $li['bo_table']; ?>&amp;wr_id=<?php echo $li['wr_parent']; ?>&amp;wmode=1#c_<?php echo $li['wr_id']; ?>" onclick="eb_modal(this.href); return false;" class="m-l-10"><u>보기</u></a>
                            <?php } ?>
                        </td>
                        <td class="text-center"><?php echo $li['num']; ?></td>
                        <td class="text-center">
                            <?php echo $gr_subject; ?>
                        </td>
                        <td>
                            <?php echo $board['bo_subject']; ?>
                        </td>
                        <td>
                            <?php echo $wr_subject; ?>
                        </td>
                        <td>
                            <?php echo eb_nameview($li['mb_id'], $li['wr_name'], $li['wr_email'], $li['homepage']); ?>
                        </td>
                        <td>
                            <label class="input width-250px"><input type="text" name="wr_datetime[<?php echo $i; ?>]" id="wr_datetime_<?php echo $i; ?>" value="<?php echo get_text($li['wr_datetime']); ?>" required></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="wr_hit[<?php echo $i; ?>]" id="wr_hit_<?php echo $i; ?>" value="<?php echo $li['wr_hit']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="wr_good[<?php echo $i; ?>]" id="wr_good_<?php echo $i; ?>" value="<?php echo $li['wr_good']; ?>" class="text-end"></label>
                        </td>
                        <td>
                            <label class="input width-100px"><input type="text" name="wr_nogood[<?php echo $i; ?>]" id="wr_nogood_<?php echo $i; ?>" value="<?php echo $li['wr_nogood']; ?>" class="text-end"></label>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($list_count == 0) { ?>
                    <tr>
                        <td colspan="16" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-start">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-crimson" onclick="document.pressed=this.value">
    </div>

    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title f-w-700">게시물관리</h5>
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

$(function() {
    var gr_id = $("#gr_id option:selected").val();
    if (gr_id) {
        group_board(gr_id);
    } else {
        group_board();
    }
});

function group_board(gr_id='') {
    var url = "<?php echo G5_ADMIN_URL; ?>/?dir=board&pid=bbs_group_board_ajax&smode=1";
    $.post(url, {gr_id:gr_id}, function(data) {
        if(data.bo_table) {
            var selected = '';
            var bo_table = '<?php echo $bo_table; ?>';
            var bo_table_str = data.bo_table;
            var bo_subject_str = data.bo_subject;
            var bo_tables = bo_table_str.split("|");
            var bo_subject = bo_subject_str.split("|");
            if(bo_tables.length>0) {
                var select = "<select name='bo_table' id='bo_table'><option value=''>게시판선택</option>";
                for(var i=0; i<bo_tables.length;i++) {
                    selected = '';
                    if (bo_table == bo_tables[i]) selected = ' selected';
                    select += "<option value=\""+bo_tables[i]+"\""+selected+">"+bo_subject[i]+"</option>";
                }
                select += "</select><i></i>";
            }
            $("#bo_table").html(select);
        }
    },"json");
}

function board_list(f) {
    f.submit();
}
</script>