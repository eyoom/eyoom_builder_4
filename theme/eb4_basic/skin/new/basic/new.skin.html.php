<?php
/**
 * skin file : /theme/THEME_NAME/skin/new/basic/new.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
?>

<style>
.new-list {font-size:.9375rem}
.new-list .nl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.new-list .nl-wrap > div:nth-last-child(1), .new-list .nl-wrap > div:nth-last-child(2) {border-bottom:0}
.new-list .nl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.new-list .nl-head > div {position:relative}
.new-list .nl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.new-list .nl-head > div:last-child:before {display:none}
.new-list .nl-head .nl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.new-list .nl-head .nl-num {width:90px}
.new-list .nl-head .nl-num-short {width:80px}
.new-list .nl-head .nl-num-checkbox {width:110px}
.new-list .nl-head .nl-author {display:table-cell;vertical-align:middle;width:150px;text-align:center;padding: 0 5px;}
.new-list .nl-head .nl-subj {display:table-cell;vertical-align:middle;text-align:center}
.new-list .nl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0}
.new-list .nl-list .checkbox i {top:5px}
.new-list .nl-list.nl-notice {background-color:#FFF8EC}
.new-list .nl-list > div {position:relative}
.new-list .nl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.new-list .nl-list > div:last-child:before {display:none}
.new-list .nl-list .nl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.new-list .nl-list .nl-author {display:table-cell;vertical-align:middle;width:120px;padding-left:10px}
.new-list .nl-list .nl-num {width:90px}
.new-list .nl-list .nl-num-short {width:80px}
.new-list .nl-list .nl-num-checkbox {width:110px}
.new-list .nl-list .nl-author {width:150px;padding:0 10px;text-align:left}
.new-list .nl-list .nl-subj {display:table-cell;vertical-align:middle;font-weight:500}
.new-list .nl-list .nl-subj a {position:relative;display:inline-block;padding:0 10px}
.new-list .nl-list .nl-subj a:hover {color:#000;text-decoration:underline}
.new-list .nl-list .nl-subj .reply-indication {display:inline-block;width:7px;height:10px;border-left:1px dotted #b5b5b5;border-bottom:1px dotted #b5b5b5}
.new-list .nl-list .nl-new {display:inline-block;width:12px;height:12px;line-height:12px;text-align:center;color:#fff;font-size:10px;font-weight:700;background-color:#ab0000}
.new-list .nl-list .nl-comment {color:#959595}
.new-list .nl-list .nl-comment strong {color:#f4511e}
.new-list .nl-list .blind-subject {color:#b5b5b5;cursor:not-allowed}
.new-list .nl-photo, .new-list .bl-photo {display:inline-block;margin-right:2px}
.new-list .nl-photo img, .new-list .bl-photo img {width:17px;height:17px;border-radius:50%}
.new-list .nl-photo .nl-user-icon, .new-list .bl-photo .bl-user-icon {font-size:.9375rem}
.new-list .nl-mobile {display:none}
.new-list .nl-mobile.nl-notice {background-color:#FFF8EC}
.new-list .star-ratings-list {width:75px;margin:0 auto}
.new-list .star-ratings-list li {padding:0;float:left;margin-right:0}
.new-list .star-ratings-list li .rating {color:#a5a5a5;font-size:.8125rem;line-height:normal}
.new-list .star-ratings-list li .rating-selected {color:#ab0000;font-size:.8125rem}
.new-list .nl-no-list {text-align:center;color:#959595;padding:70px 0}
.new-list .new-list-footer {margin-top:15px}
.new-list .new-list-footer:after {content:"";display:block;clear:both}
.new-list .new-list-footer .nlf-left {float:left;margin-top:5px}
.new-list .new-list-footer .nlf-right {float:right;margin-top:5px}
@media (max-width:991px) {
    .new-list .eyoom-form label {margin-bottom:0}
    .new-list .nl-head {display:none}
    .new-list .nl-head-checkbox {display:table}
    .new-list .nl-head > div:before, .new-list .nl-list > div:before, .new-list .nl-head .nl-item, .new-list .nl-list .nl-item, .new-list .nl-list .nl-author {display:none}
    .new-list .nl-head .nl-num-checkbox, .new-list .nl-list .nl-num-checkbox {display:table-cell;width:20px}
    .new-list .nl-head .nl-num-checkbox .nl-txt, .new-list .nl-list .nl-num-checkbox .nl-txt {visibility:visible;opacity:0}
    .new-list .nl-head .checkbox, .new-list .nl-list .checkbox {z-index:1}
    .new-list .nl-list {border-bottom:0}
    .new-list .nl-list .nl-subj a {padding:0}
    .new-list .nl-list .nl-subj a .subj {font-weight:700}
    .new-list .nl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .new-list .nl-mobile-right {position:absolute;top:0;right:0}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .new-list .nl-head {display:none}
    .new-list .nl-head-checkbox {display:table}
    .new-list .nl-head > div:before, .new-list .nl-list > div:before, .new-list .nl-head .nl-item, .new-list .nl-list .nl-item, .new-list .nl-list .nl-author {display:none}
    .new-list .nl-head .nl-num-checkbox, .new-list .nl-list .nl-num-checkbox {display:table-cell;width:20px}
    .new-list .nl-head .nl-num-checkbox .nl-txt, .new-list .nl-list .nl-num-checkbox .nl-txt {visibility:visible;opacity:0}
    .new-list .nl-head .checkbox, .new-list .nl-list .checkbox {z-index:1}
    .new-list .nl-list {border-bottom:0}
    .new-list .nl-list .nl-subj a {padding:0}
    .new-list .nl-list .nl-subj a .subj {font-weight:700}
    .new-list .nl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px;color:#959595}
    .new-list .nl-mobile-right {position:absolute;top:0;right:0}
}
</style>
<?php } ?>

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
            <div class="input input-button m-b-15">
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

    <form name="fnewlist" method="post" action="#" onsubmit="return fnew_submit(this);" class="eyoom-form">
    <input type="hidden" name="sw"       value="move">
    <input type="hidden" name="view"     value="<?php echo $view; ?>">
    <input type="hidden" name="sfl"      value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx"      value="<?php echo $stx; ?>">
    <input type="hidden" name="srows"    value="<?php echo $srows; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="page"     value="<?php echo $page; ?>">
    <input type="hidden" name="pressed"  value="">

    <div class="nl-wrap">
        <div class="nl-head <?php if ($is_admin) { ?>nl-head-checkbox<?php } ?>">
            <?php if ($is_admin) { ?>
            <div class="nl-item nl-num nl-num-checkbox">
                <label for="all_chk" class="sound_only">목록 전체</label>
                <label class="checkbox">
                    <input type="checkbox" id="all_chk"><i></i>
                </label>
                <span class="nl-txt">번호</span>
            </div>
            <?php } ?>
            <div class="nl-subj">제목</div>
            <div class="nl-item">그룹</div>
            <div class="nl-item">게시판</div>
            <div class="nl-author">이름</div>
            <div class="nl-item">일시</div>
        </div>
        <?php for ($i=0; $i<count((array)$newlist); $i++) { ?>
        <div class="nl-list">
            <?php if ($is_admin) { ?>
            <div class="nl-item nl-num nl-num-checkbox">
                <label for="chk_bn_id_<?php echo $i; ?>" class="sound_only"><?php echo $newlist[$i]['num']; ?>번</label>
                <label class="checkbox">
                    <input type="checkbox" name="chk_bn_id[]" value="<?php echo $i; ?>" id="chk_bn_id_<?php echo $i; ?>"><i></i>
                </label>
                <span class="nl-txt"><?php echo number_format($newlist[$i]['num']); ?></span>
                <input type="hidden" name="bo_table[<?php echo $i; ?>]" value="<?php echo $newlist[$i]['bo_table']; ?>">
                <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $newlist[$i]['wr_id']; ?>">
            </div>
            <?php } ?>
            <div class="nl-subj">
                <a href="<?php echo $newlist[$i]['href']; ?>"><span class="text-gray"><?php echo $newlist[$i]['comment']; ?></span> <span><?php echo $newlist[$i]['wr_subject']; ?></span></a>
            </div>
            <div class="nl-item">
                <a href="<?php echo G5_BBS_URL; ?>/new.php?gr_id=<?php echo $newlist[$i]['gr_id']; ?>"><?php echo $newlist[$i]['gr_subject']; ?></a>
            </div>
            <div class="nl-item">
                <a href="<?php echo get_eyoom_pretty_url($newlist[$i]['bo_table']); ?>"><?php echo $newlist[$i]['bo_subject']; ?></a>
            </div>
            <div class="nl-author">
                <?php echo $newlist[$i]['name']; ?>
            </div>
            <div class="nl-item">
                <?php echo $newlist[$i]['datetime2']; ?>
            </div>
        </div>
        <div class="nl-mobile"><?php /* 991px 이하에서만 보임 */ ?>
            <span class="nl-name-in"><?php echo $newlist[$i]['name']; ?></span>
            <div class="nl-mobile-right">
                <span><a href="<?php echo G5_BBS_URL; ?>/new.php?gr_id=<?php echo $newlist[$i]['gr_id']; ?>">[<?php echo $newlist[$i]['gr_subject']; ?>]</a></span>
                <span><a href="<?php echo get_eyoom_pretty_url($newlist[$i]['bo_table']); ?>">[<?php echo $newlist[$i]['bo_subject']; ?>]</a></span>
                <span class="m-l-5"><i class="far fa-clock"></i> <?php echo $newlist[$i]['datetime2']; ?></span>
            </div>
        </div>
        <?php } ?>
        <?php if (count((array)$newlist) == 0) { ?>
        <div class="nl-no-list">
            <i class="fas fa-exclamation-circle"></i> 새글 목록이 없습니다.
        </div>
        <?php } ?>
    </div>
    <div class="m-t-20">
        <?php if ($is_admin) { ?>
        <input type="submit" onclick="document.pressed=this.value" value="선택삭제" class="btn-e btn-e-dark">
        <?php } ?>
    </div>

    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<?php if ($is_admin) { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
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
        Swal.fire({
            title: "중요!",
            html: "<strong class='text-crimson'>" + document.pressed + "</strong> 할 게시물을 하나 이상 선택하세요.",
            confirmButtonColor: "#e53935",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }

    Swal.fire({
        title: "선택삭제",
        html: "선택한 게시물을 정말 <strong class='text-crimson'>" + document.pressed + "</strong> 하시겠습니까?<br>한번 삭제한 자료는 복구할 수 없습니다.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#e53935",
        confirmButtonText: "삭제",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            f.action = "<?php echo G5_BBS_URL; ?>/new_delete.php";
            f.submit();
            return true;
        }
    });
    return false;
}
</script>
<?php } ?>