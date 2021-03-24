<?php
/**
 * skin file : /theme/THEME_NAME/skin/new/basic/new.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
?>

<style>
.new-list .eyoom-form .checkbox i {top:2px}
.new-list .eyoom-form .checkbox {margin-bottom:0}
.new-list .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;padding:10px 5px}
.new-list .table-list-eb .table tbody > tr > td {border-top:1px solid #ededed;padding:7px 5px}
.new-list .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595}
.new-list .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap;font-size:13px}
.new-list .table-list-eb .td-subject {width:300px}
.new-list .table-list-eb .td-subject .fa {color:#FF4848}
.new-list .table-list-eb .table tbody > tr.td-mobile > td {border-top:1px solid #fff;padding:0 0 5px !important;font-size:11px;color:#959595}
.new-list .table-list-eb .td-mobile td {position:relative}
.new-list .table-list-eb .td-mobile td > span {margin-right:5px}
.new-list .table-list-eb .td-mobile td > span i {color:#959595}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 1199px) {
    .new-list .table-list-eb .td-subject {width:240px}
}
@media (max-width: 767px) {
    .new-list .table-list-eb .table tbody > tr > td {padding:10px 0}
    .new-list .table-list-eb .td-width {width:inherit}
    .new-list .table-list-eb .td-subject {width:300px}
}
<?php } ?>
</style>

<div class="new-list">
    <form name="fnew" method="get" class="eyoom-form">
    <div class="row">
        <section class="col col-12">
            <div class="note"><strong>Note:</strong> 회원 아이디만 검색 가능</div>
        </section>
        <section class="col col-3">
            <label for="gr_id" class="sound_only">그룹</label>
            <label class="select">
                <select name="gr_id" id="gr_id">
                    <option value="">전체그룹</option>
                    <?php for($i=0; $i<count((array)$sel_group); $i++) { ?>
                    <option value='<?php echo $sel_group[$i]['gr_id']; ?>'><?php echo $sel_group[$i]['gr_subject']; ?></option>
                    <?php } ?>
                </select>
                <i></i>
            </label>
        </section>
        <section class="col col-3">
            <label for="view" class="sound_only">검색대상</label>
            <label class="select">
                <select name="view" id="view">
                    <option value="">전체게시물</option>
                    <option value="w">원글만</option>
                    <option value="c">댓글만</option>
                </select>
                <i></i>
            </label>
        </section>
        <section class="col col-6">
            <label for="mb_id" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="input input-button">
                <input type="text" name="mb_id" value="<?php echo $mb_id; ?>" id="mb_id" required placeholder="회원아이디 입력">
                <div class="button"><input type="submit" value="검색">검색</div>
            </div>
        </section>
    </div>
    </form>
    <script>
    /* 셀렉트 박스에서 자동 이동 해제
    function select_change() {
        document.fnew.submit();
    }
    */
    document.getElementById("gr_id").value = "<?php echo $gr_id; ?>";
    document.getElementById("view").value = "<?php echo $view; ?>";
    </script>

    <div class="margin-bottom-10"></div>

    <form name="fnewlist" method="post" action="#" onsubmit="return fnew_submit(this);" class="eyoom-form">
    <input type="hidden" name="sw"       value="move">
    <input type="hidden" name="view"     value="<?php echo $view; ?>">
    <input type="hidden" name="sfl"      value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx"      value="<?php echo $stx; ?>">
    <input type="hidden" name="srows"    value="<?php echo $srows; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="page"     value="<?php echo $page; ?>">
    <input type="hidden" name="pressed"  value="">

    <div class="table-list-eb margin-bottom-20">
        <div class="board-list-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <?php if ($is_admin) { ?>
                        <th>
                            <label for="all_chk" class="sound_only">목록 전체</label>
                            <label class="checkbox">
                                <input type="checkbox" id="all_chk"><i></i>
                            </label>
                        </th>
                        <?php } ?>
                        <th>제목</th>
                        <th class="hidden-xs">그룹</th>
                        <th class="hidden-xs">게시판</th>
                        <th class="hidden-xs">이름</th>
                        <th class="hidden-xs">일시</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$newlist); $i++) { ?>
                    <tr>
                        <?php if ($is_admin) { ?>
                        <td>
                            <label for="chk_bn_id_<?php echo $i; ?>" class="sound_only"><?php echo $newlist[$i]['num']; ?>번</label>
                            <label class="checkbox">
                                <input type="checkbox" name="chk_bn_id[]" value="<?php echo $i; ?>" id="chk_bn_id_<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="bo_table[<?php echo $i; ?>]" value="<?php echo $newlist[$i]['bo_table']; ?>">
                            <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $newlist[$i]['wr_id']; ?>">
                        </td>
                        <?php } ?>
                        <td class="td-width">
                            <div class="td-subject ellipsis">
                                <a href="<?php echo $newlist[$i]['href']; ?>"><span class="color-grey"><?php echo $newlist[$i]['comment']; ?></span><strong><?php echo $newlist[$i]['wr_subject']; ?></strong></a>
                            </div>
                        </td>
                        <td class="hidden-xs"><a href="<?php echo G5_BBS_URL; ?>/new.php?gr_id=<?php echo $newlist[$i]['gr_id']; ?>"><?php echo $newlist[$i]['gr_subject']; ?></a></td>
                        <td class="hidden-xs"><a href="<?php echo get_eyoom_pretty_url($newlist[$i]['bo_table']); ?>"><?php echo $newlist[$i]['bo_subject']; ?></a></td>
                        <td class="hidden-xs"><div><?php echo $newlist[$i]['name']; ?></div></td>
                        <td class="hidden-xs"><?php echo $newlist[$i]['datetime2']; ?></td>
                    </tr>
                    <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td colspan="<?php echo $colspan; ?>">
                            <span><a href="<?php echo G5_BBS_URL; ?>/new.php?gr_id=<?php echo $newlist[$i]['gr_id']; ?>">[<?php echo $newlist[$i]['gr_subject']; ?>]</a></span>
                            <span><a href="<?php echo get_eyoom_pretty_url($newlist[$i]['bo_table']); ?>">[<?php echo $newlist[$i]['bo_subject']; ?>]</a></span>
                            <span><i class="fas fa-user"></i> <?php echo $newlist[$i]['name']; ?></span>
                            <span><i class="far fa-clock"></i> <?php echo $newlist[$i]['datetime2']; ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$newlist) == 0) { ?>
                    <tr><td colspan="<?php echo $colspan; ?>" class="text-center"><span class="color-grey"><i class="fas fa-exclamation-circle"></i> 새글 목록이 없습니다.</span></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($is_admin) { ?>
    <input type="submit" onclick="document.pressed=this.value" value="선택삭제" class="btn-e btn-e-dark">
    <?php } ?>
    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<?php if ($is_admin) { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<script>
$(function(){
    $('#all_chk').click(function(){
        $('[name="chk_bn_id[]"]').attr('checked', this.checked);
    });
});

function fnew_submit(f) {
    f.pressed.value = document.pressed;

    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
            cnt++;
    }

    if (!cnt) {
        swal({
            html: true,
            title: "중요!",
            text: "<strong class='color-red'>" + document.pressed + "</strong> 할 게시물을 하나 이상 선택하세요.",
            confirmButtonColor: "#FF2900",
            type: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    swal({
        html: true,
        title: "선택삭제",
        text: "선택한 게시물을 정말 <strong class='color-red'>" + document.pressed + "</strong> 하시겠습니까?<br>한번 삭제한 자료는 복구할 수 없습니다.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#FF9500",
        confirmButtonText: "삭제",
        cancelButtonText: "취소",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function(){
        f.action = "<?php echo G5_BBS_URL; ?>/new_delete.php";
        f.submit();
        return true;
    });
    return false;
}
</script>
<?php } ?>