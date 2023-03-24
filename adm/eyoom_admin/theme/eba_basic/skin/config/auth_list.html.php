<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/auth_list.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'auth_list';
$g5_title = '권리권한설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-auth-list">
    <form id="fsearch" name="fsearch" class="eyoom-form" method="get" class="eyoom-form">
    <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
    
    <?php if (G5_IS_MOBILE) { ?>
    <a class="collapse-search-btn btn-e btn-e-sm btn-e-dark m-b-20" data-bs-toggle="collapse" href="#collapse-search-box"><i class="fas fa-search m-r-7"></i><span>검색 조건 열기</span></a>
    <?php } ?>
    <div id="collapse-search-box" class="<?php if (G5_IS_MOBILE) { ?>panel-collapse collapse<?php } ?> m-b-20">
        <div class="adm-form-table adm-search-box m-b-20">
            <div class="adm-form-tr-wrap">
                <div class="adm-form-tr tr-l">
                    <div class="adm-form-td td-l">
                        <label for="stx" class="label">검색어</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label class="select width-150px">
                                    <select name="sfl" id="sfl">
                                        <option value="b.mb_name"<?php echo get_selected($sfl, "b.mb_name"); ?>>이름</option>
                                        <option value="a.mb_id"<?php echo get_selected($sfl, "a.mb_id"); ?>>아이디</option>
                                        <option value="b.mb_nick"<?php echo get_selected($sfl, "b.mb_nick"); ?>>닉네임</option>
                                        <option value="b.mb_email"<?php echo get_selected($sfl, "b.mb_email"); ?>>E-MAIL</option>
                                        <option value="b.mb_tel"<?php echo get_selected($sfl, "b.mb_tel"); ?>>전화번호</option>
                                        <option value="b.mb_hp"<?php echo get_selected($sfl, "b.mb_hp"); ?>>휴대폰번호</option>
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
                        <label for="au_menu" class="label">메뉴 코드</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label class="input max-width-250px">
                            <input type="text" name="au_menu" value="<?php echo $au_menu; ?>" id="au_menu" autocomplete="off">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="confirm-bottom-btn">
            <?php echo $frm_submit;?>
        </div>
    </div>

    </form>

    <form name="fauthlist" id="fauthlist" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fauthlist_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>설정된 관리권한 <?php echo number_format($total_count); ?>건
        </div>
        <div class="float-end xs-float-start">
            <label for="sort_list" class="select width-200px">
                <select name="sort_list" id="sort_list" onchange="sorting_list(this.form, this.value);">
                    <option value="">:: 정렬방식선택 ::</option>
                    <option value="a.mb_id|asc" <?php if ($sst=='a.mb_id' && $sod=='asc') echo 'selected'; ?>>회원아이디 정방향 (↓)</option>
                    <option value="a.mb_id|desc" <?php if ($sst=='a.mb_id' && $sod=='desc') echo 'selected'; ?>>회원아이디 역방향 (↑)</option>
                    <option value="mb_nick|asc" <?php if ($sst=='mb_nick' && $sod=='asc') echo 'selected'; ?>>닉네임 정방향 (↓)</option>
                    <option value="mb_nick|desc" <?php if ($sst=='mb_nick' && $sod=='desc') echo 'selected'; ?>>닉네임 역방향 (↑)</option>
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
                        <th>닉네임</th>
                        <th>메뉴</th>
                        <th>권한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="au_menu[<?php echo $i; ?>]" value="<?php echo $list[$i]['au_menu']; ?>">
                            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=auth_list&amp;sfl=a.mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>"><?php echo $list[$i]['mb_id']; ?></a></td>
                        <td><?php echo $list[$i]['mb_nick']; ?></td>
                        <td><?php echo $list[$i]['au_menu']; ?> <?php echo $list[$i]['auth_menu']; ?></td>
                        <td><?php echo $list[$i]['au_auth']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if($count == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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

    <form name="fauthlist2" id="fauthlist2" action="<?php echo $action_url2; ?>" method="post" autocomplete="off" class="eyoom-form" onsubmit="return fauth_add_submit(this);">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>관리권한 추가</h3>
    </div>

    <div id="auth-form">
        <div class="adm-form-table m-b-20">
            <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>관리권한 설정</strong></div>
            <div class="adm-form-info">
                <div class="cont-text-bg">
                    <p class="bg-info">
                        <i class="fas fa-info-circle"></i> 다음 양식에서 회원에게 관리권한을 부여하실 수 있습니다.<br>
                        <i class="fas fa-info-circle"></i> 권한 <strong>r</strong> 은 읽기권한, <strong>w</strong> 는 쓰기권한, <strong>d</strong> 는 삭제권한입니다.
                    </p>
                </div>
            </div>
            <div class="adm-form-cont">
                <label for="mb_id" class="label">회원아이디</label>
                <div class="input input-button max-width-500px">
                    <input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id; ?>" required>
                    <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="button"><input type="button">회원검색<i class="far fa-window-restore m-l-7"></i></a>
                </div>
            </div>
            <div class="adm-form-cont">
                <section>
                    <label for="mb_id" class="label">접근가능메뉴</label>
                    <label class="select max-width-300px">
                        <select id="au_menu" name="au_menu" required>
                            <option value=''>선택하세요</option>
                            <?php
                            foreach($auth_menu as $key=>$value)
                            {
                                if (!(substr($key, -3) == '000' || $key == '-' || !$key))
                                    echo '<option value="'.$key.'">'.$key.' '.$value.'</option>';
                            }
                            ?>
                        </select><i></i>
                    </label>
                </section>
                <section>
                    <label for="mb_id" class="label">권한지정</label>
                    <div class="inline-group">
                        <label for="r" class="checkbox"><input type="checkbox" name="r" id="r" value="r" checked><i></i> r (읽기)</label>
                        <label for="w" class="checkbox"><input type="checkbox" name="w" id="w" value="w"><i></i> w (쓰기)</label>
                        <label for="d" class="checkbox"><input type="checkbox" name="d" id="d" value="d"><i></i> d (삭제)</label>
                    </div>
                </section>
            </div>
            <div class="adm-form-cont">
                <label for="mb_id" class="label">자동등록방지</label>
                <div>
                    <?php echo $captcha_html; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <button type="submit" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">추가하기</button>
    </div>

    </form>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700">회원 검색</h5>
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
    <?php if (!$wmode) { ?>
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $('html').css({overflow: 'hidden'});
    });
    <?php } ?>
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};

function sorting_list(f, str) {
    var sort = str.split('|');

    $("#sst").val(sort[0]);
    $("#sod").val(sort[1]);

    if (sort[0] && sort[1]) {
        f.action = "<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&pid=<?php echo $pid; ?>";
        f.submit();
    }
}

function fauth_add_submit(f){
    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    return true;
}

function fauthlist_submit(f) {
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