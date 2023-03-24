<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/config/multi_manager.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'multi_manager';
$g5_title = '다중관리자설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">환경설정</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-manager-list">
    <form name="fmultimanager" id="fmultimanager" action="<?php echo $action_url1; ?>" method="post" onsubmit="return fmultimanager_submit(this);" class="eyoom-form">
    <input type="hidden" name="sst" id="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" id="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="m-b-5">
        <div class="float-start f-s-13r">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=<?php echo $dir; ?>&amp;pid=<?php echo $pid; ?>">[전체목록]</a><span class="m-l-10 m-r-10 text-light-gray">|</span>설정된 다중관리자 <?php echo number_format($total_count); ?>명
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

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs m-b-5">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

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
                        <th>관리자테마</th>
                        <th>관리메뉴</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<$count; $i++) { ?>
                    <tr>
                        <th>
                            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['mb_id']; ?>">
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                        </th>
                        <td><a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=multi_manager&amp;sfl=a.mb_id&amp;stx=<?php echo $list[$i]['mb_id']; ?>"><?php echo $list[$i]['mb_id']; ?></a></td>
                        <td><?php echo $list[$i]['mb_nick']; ?></td>
                        <td><?php echo $list[$i]['mg_theme']; ?></td>
                        <td><?php echo $list[$i]['mg_menu']; ?></td>
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

    <form name="fmultimanager2" id="fmultimanager2" action="<?php echo $action_url2; ?>" method="post" autocomplete="off" class="eyoom-form" onsubmit="return fmanager_add_submit(this);">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-headline">
        <h3>다중관리자 추가</h3>
    </div>
    
    <div id="manager-form">
        <div class="adm-form-table m-b-20">
            <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>다중관리자 테마 및 메뉴 설정</strong></div>
            <div class="adm-form-info">
                <div class="cont-text-bg">
                    <p class="bg-info">
                        <i class="fas fa-info-circle"></i> 다중관리자로 설정할 회원 아이디를 검색하세요.<br>
                        <i class="fas fa-info-circle"></i> 추가한 관리자의 메뉴노출 여부를 설정하세요.<br>
                        <i class="fas fa-info-circle"></i> 동일한 아이디를 중복하여 추가할 경우, 다중관리자의 정보를 업데이트 합니다.
                    </p>
                </div>
            </div>
            <div class="adm-form-cont">
                <section>
                    <label for="mb_id" class="label">회원아이디</label>
                    <div class="input input-button max-width-500px">
                        <input type="text" name="mb_id" id="mb_id" value="<?php echo $mb_id; ?>" required>
                        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=member&amp;pid=member_list&amp;wmode=1" onclick="eb_modal(this.href); return false;" class="button"><input type="button">회원검색<i class="far fa-window-restore m-l-7"></i></a>
                    </div>
                </section>
                <section>
                    <label for="mg_theme" class="label">관리자모드 테마선택</label>
                    <label class="select max-width-250px">
                        <select name="mg_theme" id="mg_theme" required>
                            <option value="">선택</option>
                            <?php for ($i=0; $i<count((array)$cf_eyoom_admin_theme); $i++) { ?>
                            <option value="<?php echo $cf_eyoom_admin_theme[$i]; ?>"><?php echo $cf_eyoom_admin_theme[$i]; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                </section>
            </div>
            
            <?php $i=0; foreach ($dir_menu as $dirname => $menuname) { ?>
            <?php if ($i%4==0) { ?>
            <div class="adm-form-cont">
                <div class="row">
            <?php } ?>
                    <div class="col-sm-3">
                        <section>
                            <label for="me_<?php echo $dirname; ?>" class="label"><?php echo $menuname; ?></label>
                            <label for="me_<?php echo $dirname; ?>" class="checkbox"><input type="checkbox" name="mg_menu[<?php echo $dirname; ?>]" value="1" id="me_<?php echo $dirname; ?>" checked><i></i> 보이기</label>
                        </section>
                    </div>
            <?php if ($i%4==3 || count($dir_menu)-1 == $i) { ?>
                </div>
            </div>
            <?php } ?>
            <?php $i++; } ?>

            <div class="adm-form-cont">
                <label for="mb_id" class="label">자동등록방지</label>
                <div>
                    <?php echo $captcha_html; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <button type="submit" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">적용하기</button>
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

function fmanager_add_submit(f){
    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
    return true;
}

function fmultimanager_submit(f) {
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 다중관리자를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }
    return true;
}
</script>