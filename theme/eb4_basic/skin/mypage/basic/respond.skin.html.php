<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/respond.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);

/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<style>
.respond-list {font-size:.9375rem}
.respond-list .rl-wrap {position:relative;border-top:2px solid #757575;border-bottom:1px solid #757575}
.respond-list .rl-wrap > div:nth-last-child(1), .respond-list .rl-wrap > div:nth-last-child(2) {border-bottom:0}
.respond-list .rl-head {position:relative;display:table;width:100%;height:50px;border-bottom:1px solid #757575;background-color:#f2f2f2;font-weight:500}
.respond-list .rl-head > div {position:relative}
.respond-list .rl-head > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#cacaca;transform:translateY(-50%)}
.respond-list .rl-head > div:last-child:before {display:none}
.respond-list .rl-head .rl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.respond-list .rl-head .rl-num {width:90px}
.respond-list .rl-head .rl-num-short {width:80px}
.respond-list .rl-head .rl-num-checkbox {width:30px}
.respond-list .rl-head .rl-num-checkbox:before {display:none}
.respond-list .rl-head .rl-subj {display:table-cell;vertical-align:middle;text-align:center}
.respond-list .rl-list {position:relative;display:table;table-layout:fixed;;width:100%;height:46px;border-bottom:1px solid #eaeaea;padding:8px 0;background-color:rgba(255, 243, 224, 0.3)}
.respond-list .rl-list.resopnd-chked {background-color:rgba(0,0,0,0.01)}
.respond-list .rl-list .checkbox i {top:5px}
.respond-list .rl-list.rl-notice {background-color:#FFF8EC}
.respond-list .rl-list > div {position:relative}
.respond-list .rl-list > div:before {content:"";position:absolute;top:50%;right:0;width:1px;height:13px;background-color:#dadada;transform:translateY(-50%)}
.respond-list .rl-list > div:last-child:before {display:none}
.respond-list .rl-list .rl-item {display:table-cell;vertical-align:middle;width:120px;text-align:center}
.respond-list .rl-list .rl-num {width:90px}
.respond-list .rl-list .rl-num-short {width:80px}
.respond-list .rl-list .rl-num-checkbox {width:30px}
.respond-list .rl-list .rl-num-checkbox:before {display:none}
.respond-list .rl-list .rl-subj {display:table-cell;vertical-align:middle}
.respond-list .rl-list .rl-subj a {position:relative;display:inline-block;padding:0 10px}
.respond-list .rl-list .rl-subj a:hover {color:#000;text-decoration:underline}
.respond-list .rl-list .rl-subj .subj {font-weight:500}
.respond-list .rl-list .rl-subj .mention {color:#757575;margin-top:5px}
.respond-list .rl-list .rl-subj .mention-photo {display:inline-block;margin-right:2px}
.respond-list .rl-list .rl-subj .mention-photo img {width:17px;height:17px;border-radius:50%}
.respond-list .rl-list .rl-subj .mention-photo .rl-user-icon {font-size:.9375rem}
.respond-list .rl-list.resopnd-chked .rl-subj {opacity:0.5}
.respond-list .rl-mobile {display:none;background-color:rgba(255, 243, 224, 0.3)}
.respond-list .rl-mobile.resopnd-chked {background-color:rgba(0,0,0,0.01)}
.respond-list .rl-no-list {text-align:center;color:#959595;padding:70px 0}
.respond-list .respond-list-footer {margin-top:15px}
.respond-list .respond-list-footer:after {content:"";display:block;clear:both}
.respond-list .respond-list-footer .rlf-left {float:left;margin-top:5px}
.respond-list .respond-list-footer .rlf-right {float:right;margin-top:5px}
@media (max-width:991px) {
    .respond-list .rl-head {display:none}
    .respond-list .rl-head-checkbox {display:table}
    .respond-list .rl-head > div:before, .respond-list .rl-list > div:before, .respond-list .rl-head .rl-item, .respond-list .rl-list .rl-item {display:none}
    .respond-list .rl-head .rl-num-checkbox, .respond-list .rl-list .rl-num-checkbox {display:table-cell;width:25px}
    .respond-list .rl-head .rl-num-checkbox .rl-txt, .respond-list .rl-list .rl-num-checkbox .rl-txt {visibility:visible;opacity:0}
    .respond-list .rl-head .checkbox, .respond-list .rl-list .checkbox {z-index:1}
    .respond-list .rl-list {border-bottom:0}
    .respond-list .rl-list .rl-subj a {padding:0}
    .respond-list .rl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px 25px;color:#959595}
    .respond-list .rl-mobile-right {float:right}
}
</style>
<?php if ($side_layout['use'] == 'yes') { ?>
<style>
@media (max-width:1199px) {
    .respond-list .rl-head {display:none}
    .respond-list .rl-head-checkbox {display:table}
    .respond-list .rl-head > div:before, .respond-list .rl-list > div:before, .respond-list .rl-head .rl-item, .respond-list .rl-list .rl-item {display:none}
    .respond-list .rl-head .rl-num-checkbox, .respond-list .rl-list .rl-num-checkbox {display:table-cell;width:25px}
    .respond-list .rl-head .rl-num-checkbox .rl-txt, .respond-list .rl-list .rl-num-checkbox .rl-txt {visibility:visible;opacity:0}
    .respond-list .rl-head .checkbox, .respond-list .rl-list .checkbox {z-index:1}
    .respond-list .rl-list {border-bottom:0}
    .respond-list .rl-list .rl-subj a {padding:0}
    .respond-list .rl-mobile {position:relative;display:block;border-bottom:1px solid #eaeaea;padding:0 0 8px 25px;color:#959595}
    .respond-list .rl-mobile-right {float:right}
}
</style>
<?php } ?>

<div class="respond-list">
    <form name="frespond" method="get" class="eyoom-form m-b-10 lg-m-b-30">
    <div class="respond-search-box">
        <div class="row">
            <div class="col-lg-2">
                <label for="read" class="sound_only">검색대상</label>
                <label class="select">
                    <select name="read" id="read" class="form-control" onchange="this.form.submit();">
                        <option value="">읽음여부|전체</option>
                        <option value="y" <?php if ($read == 'y') { ?>selected<?php } ?>>읽음</option>
                        <option value="n" <?php if ($read == 'n') { ?>selected<?php } ?>>읽지않음</option>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="col-lg-2">
                <label class="select">
                    <select name="type" id="type" class="form-control" onchange="this.form.submit();">
                        <option value="">글타입|전체</option>
                        <option value="reply" <?php if ($type == 'reply') { ?>selected<?php } ?>>답글</option>
                        <option value="cmt" <?php if ($type == 'cmt') { ?>selected<?php } ?>>댓글</option>
                        <option value="cmt_re" <?php if ($type == 'cmt_re') { ?>selected<?php } ?>>대댓글</option>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="col-lg-2">
                <label class="select">
                    <select name="sfl" id="sfl" class="form-control" onchange="this.form.submit();">
                        <option value="">검색대상</option>
                        <option value="id" <?php if ($sfl == 'id') { ?>selected<?php } ?>>아이디</option>
                        <option value="nick" <?php if ($sfl == 'nick') { ?>selected<?php } ?>>닉네임</option>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="col-lg-6">
                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <div class="input input-button respond-search-input">
                    <i class="icon-prepend fa fa-search"></i>
                    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required>
                    <div class="button"><input type="submit" value="검색">검색</div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <form name="frespondlist" method="post" action="#" onsubmit="return frespond_submit(this);" class="eyoom-form">
    <input type="hidden" name="act" value="">
    <input type="hidden" name="chk" value="<?php echo $chk; ?>">
    <input type="hidden" name="type" value="<?php echo $type; ?>">
    <input type="hidden" name="mb_id" value="<?php echo $mb_id; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="pressed" value="">

    <div class="m-b-15 text-gray">
        <p>전체 <?php echo $total_count; ?> 건</p>
    </div>

    <div class="rl-wrap">
        <div class="rl-head <?php if ($is_member) { ?>rl-head-checkbox<?php } ?>">
            <?php if ($is_member) { ?>
            <div class="rl-item rl-num rl-num-checkbox">
                <label for="all_chk" class="sound_only">목록 전체</label>
                <label class="checkbox">
                    <input type="checkbox" id="all_chk"><i></i>
                </label>
                <span class="rl-txt">&nbsp;</span>
            </div>
            <?php } ?>
            <div class="rl-subj">반응글 및 기록</div>
            <div class="rl-item">날짜</div>
            <div class="rl-item">확인</div>
            <div class="rl-item">종류</div>
            <div class="rl-item">관리</div>
        </div>
        <?php for ($i=0; $i<count((array)$respond); $i++) { ?>
        <div class="rl-list <?php if ( $respond[$i]['chk'] == 1) { ?>resopnd-chked<?php } ?>">
            <?php if ($is_member) { ?>
            <div class="rl-item rl-num rl-num-checkbox">
                <label for="chk_bn_id_<?php echo $i; ?>" class="sound_only"><?php echo $respond[$i]['num']; ?>번</label>
                <label class="checkbox">
                    <input type="checkbox" name="rid[]" value="<?php echo $respond[$i]['rid']; ?>" id="chk_bn_id_<?php echo $i; ?>"><i></i>
                </label>
                <span class="rl-txt">&nbsp;</span>
            </div>
            <?php } ?>
            <div class="rl-subj">
                <a href="<?php echo $respond[$i]['href']; ?>">
                    <div class="subj"><span><?php echo stripslashes($respond[$i]['wr_subject']); ?></span></div>
                    <div class="mention"><span class="mention-photo"><?php if ($respond[$i]['mb_photo']) { echo $respond[$i]['mb_photo']; }  else { ?><span class="rl-user-icon"><i class="far fa-user-circle"></i></span><?php } ?></span> <?php echo $respond[$i]['mention']; ?></div>
                </a>
            </div>
            <div class="rl-item text-gray">
                <?php echo $respond[$i]['datetime']; ?>
            </div>
            <div class="rl-item">
                <?php if ($respond[$i]['chk'] == 1) { ?>
                <span class="text-gray">확인</span>
                <?php }  else { ?>
                <span class="text-crimson">미확인</span>
                <?php } ?>
            </div>
            <div class="rl-item text-gray">
                <?php echo $respond[$i]['type']; ?>
            </div>
            <div class="rl-item">
                <a href="<?php echo $respond[$i]['delete']; ?>" class="alone-del-btn respond-del-btn"><u>삭제</u></a>
            </div>
        </div>
        <div class="rl-mobile <?php if ( $respond[$i]['chk'] == 1) { ?>resopnd-chked<?php } ?>"><?php /* 991px 이하에서만 보임 */ ?>
            <span class="m-r-5"><i class="far fa-clock"></i> <?php echo $respond[$i]['datetime']; ?></span>
            <span class="m-r-5">
                <?php if ($respond[$i]['chk'] == 1) { ?>
                <span class="read">[확인]</span>
                <?php }  else { ?>
                <span class="text-crimson">[미확인]</span>
                <?php } ?>
            </span>
            <div class="rl-mobile-right">
                <span><a href="<?php echo $respond[$i]['delete']; ?>" class="alone-del-btn"><u>삭제</u></a></span>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php } ?>
        <?php if (count((array)$respond) == 0) { ?>
        <div class="rl-no-list">
            <i class="fas fa-exclamation-circle"></i> 내글 반응이 없습니다.
        </div>
        <?php } ?>
    </div>
    <?php if ($is_member) { ?>
    <div class="respond-list-footer">
        <div class="rlf-left">
            <button class="btn-e btn-e-sm btn-gray" type="submit" onclick="document.pressed=this.value" value="선택삭제">선택삭제</button>
            <button class="btn-e btn-e-sm btn-gray" type="button" onclick="delete_all();">전체삭제</button>
            <button class="btn-e btn-e-sm btn-gray" type="button" onclick="check_read();">선택읽음</button>
        </div>
    </div>
    <?php } ?>

    </form>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<?php if ($is_member) { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
$(function(){
    $('#all_chk').click(function(){
        $('[name="rid[]"]').attr('checked', this.checked);
    });
});

function frespond_submit(f) {
    f.pressed.value = document.pressed;
    f.act.value = 'chkdel';
    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "rid[]" && f.elements[i].checked)
            cnt++;
    }
    if (!cnt) {
        Swal.fire({
            title: "중요!",
            html: "<span class='text-crimson'>" + document.pressed + "</span> 할 반응글을 하나 이상 선택하세요.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }
    Swal.fire({
        title: "선택삭제",
        html: "선택한 내글반응 항목을 정말 <span class='text-crimson'>" + document.pressed + "</span> 하시겠습니까?<br>한번 삭제한 자료는 복구할 수 없습니다.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#ab0000",
        confirmButtonText: "삭제",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            f.action = "./respond_chk.php";
            f.submit();
            return true;
        }
    });
    return false;
}

function delete_all() {
    var f = document.frespondlist;
    f.act.value = 'alldel';
    Swal.fire({
        text: "내글반응 기록을 모두 삭제하시겠습니까?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#ab0000",
        confirmButtonText: "전체 삭제",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            f.action = "./respond_chk.php";
            f.submit();
            return true;
        } else {
            return false;
        }
    });
}

function check_read() {
    var f = document.frespondlist;
    f.act.value = 'chkread';
    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "rid[]" && f.elements[i].checked)
            cnt++;
    }
    if (!cnt) {
        Swal.fire({
            title: "중요!",
            text: "반응글을 하나 이상 선택하세요.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        return false;
    }
    Swal.fire({
        title: "읽음 처리",
        text: "선택한 내글반응을 읽음표시로 처리하시겠습니까?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#ab0000",
        confirmButtonText: "읽음",
        cancelButtonText: "취소"
    }).then((result) => {
        if (result.isConfirmed) {
            f.action = "./respond_chk.php";
            f.submit();
            return true;
        } else {
            return false;
        }
    });
}

$(function() {
    $('.alone-del-btn').click(function(e){
        e.preventDefault();
        var linkURL = $(this).attr("href");
        respond_delete_link(linkURL);
    });
    function respond_delete_link(linkURL) {
        Swal.fire({
            title: "내글반응 삭제",
            text: "정말로 이 내글반응을 삭제하시겠습니까?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#ab0000",
            confirmButtonText: "삭제",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = linkURL;
            }
        });
    }
});
</script>
<?php } ?>