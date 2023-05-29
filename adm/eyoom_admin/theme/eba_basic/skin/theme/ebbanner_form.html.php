<?php
/**
 * Eyoom Admin Skin File
 * @file	~/theme/THEME_NAME/skin/theme/ebbanner_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'ebbanner_list';
$g5_title = 'EB배너관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-ebbanner-form .ebbanner-image {width:200px}
.admin-ebbanner-itemlist .ebbanner-itemlist-image {width:150px;margin:0 auto}
</style>

<div class="admin-ebbanner-form">
	<?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

	<div class="adm-headline">
		<h3>EB배너 마스터 관리</h3>
	</div>

	<form name="febbannerform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febbannerform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
	<input type="hidden" name="w" value="<?php echo $w; ?>">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
	<input type="hidden" name="bn_no" id="bn_no" value="<?php echo $es['bn_no']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="">

	<div class="adm-form-table m-b-20">
		<div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB배너 마스터 설정정보</strong></div>
		<div class="adm-form-tr">
			<div class="adm-form-td td-l">
				<label for="bn_code" class="label">코드</label>
			</div>
			<div class="adm-form-td td-r">
				<label class="input max-width-250px">
					<input type="text" name="bn_code" id="bn_code" value="<?php echo $es['bn_code'] ? $es['bn_code']: time(); ?>" readonly required>
				</label>
				<div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l">
				<div class="adm-form-td td-l">
					<label class="label">치환코드</label>
				</div>
				<div class="adm-form-td td-r">
					<div class="eb-clipboard-box">
						<div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_banner('<?php echo $es['bn_code'] ? $es['bn_code']: time(); ?>'); ?&gt;</strong></div>
						<div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드복사</div>
					</div>
					<div class="note"><strong>Note:</strong> 치환코드를 복사하여 출력하고자 하는 위치에 붙여넣기 하세요.</div>
				</div>
			</div>
			<div class="adm-form-tr tr-r">
				<div class="adm-form-td td-l">
					<label class="label">출력여부</label>
				</div>
				<div class="adm-form-td td-r">
					<div class="inline-group">
						<label for="bn_state_1" class="radio"><input type="radio" name="bn_state" id="bn_state_1" value="1" <?php echo $es['bn_state'] == '1' || !$es['bn_state'] ? 'checked':''; ?>><i></i> 보이기</label>
						<label for="bn_state_2" class="radio"><input type="radio" name="bn_state" id="bn_state_2" value="2" <?php echo $es['bn_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
					</div>
					<div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
				</div>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l">
				<div class="adm-form-td td-l">
					<label for="bn_subject" class="label">배너마스터 제목</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="input max-width-250px">
						<input type="text" name="bn_subject" id="bn_subject" value="<?php echo get_text($es['bn_subject']); ?>" required>
					</label>
					<div class="note"><strong>Note:</strong> 예) 메인 배너, 메인 제품소개 배너...</div>
				</div>
			</div>
			<div class="adm-form-tr tr-r">
				<div class="adm-form-td td-l">
					<label for="bn_skin" class="label">배너마스터 스킨</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="select max-width-250px">
						<select name="bn_skin" id="bn_skin">
							<option value="">::선택::</option>
							<?php foreach ($ebbanner_skins as $eb_skin) { ?>
							<option value="<?php echo $eb_skin; ?>" <?php echo get_selected($es['bn_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
							<?php } ?>
						</select><i></i>
					</label>
					<div class="note"><strong>Note:</strong> EB배너 마스터에 적용할 스킨을 선택해 주세요.</div>
				</div>
			</div>
		</div>
		<div class="adm-form-tr">
			<div class="adm-form-td td-l">
				EB배너 마스터 이미지
			</div>
			<div class="adm-form-td td-r">
				<div class="input">
                    <input type="file" class="form-control" name="bn_image" id="bn_image">
                </div>
				<?php if ($es['bn_image']) { ?>
				<div class="bn_img_info">
					<label for="bn_image_del" class="checkbox"><input type="checkbox" id="bn_image_del" name="bn_image_del" value="1"><i></i><?php echo $es['bn_image']; ?> 파일삭제</label>
					<input type="hidden" name="del_image_name" value="<?php echo $es['bn_image']; ?>">
					<div class="thumbnail ebbanner-image">
						<div class="thumb">
							<img src="<?php echo $es['bn_img_url']; ?>">
							<div class="caption-overflow">
								<span>
									<a href="<?php echo $es['bn_img_url']; ?>" class="btn-e btn-e-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="note"><strong>Note:</strong> EB배너 마스터의 이미지를 업로드해 주세요.</div>
			</div>
		</div>
	</div>

	<div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

	</form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
function febbannerform_submit(f) {
	if (f.bn_code.value == '') {
		alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
		document.location.reload();
		return false;
	}
	if (f.bn_subject.value.length < 2) {
		alert("배너 마스터의 제목을 2자이상으로 입력해 주세요.");
		f.bn_subject.focus();
		return false;
	}
	if (!f.bn_skin.value) {
		alert("배너 마스터의 스킨을 선택해 주세요.");
		f.bn_skin.focus();
		return false;
	}
	return true;
}

new Clipboard('.eb-clipboard-box-btn');
</script>

<?php if ($w == 'u' && $bn_code) { ?>
<div class="admin-ebbanner-itemlist">
	<form name="febbanneritemlist" id="febbanneritemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return febbanneritemlist_submit(this);" class="eyoom-form">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
	<input type="hidden" name="bn_code" id="bn_code" value="<?php echo $es['bn_code']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="<?php echo $token; ?>">

	<div class="adm-headline adm-headline-btn">
        <h3>EB배너 - 아이템 관리</h3>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebbanner_itemform&amp;bn_code=<?php echo $es['bn_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB배너 아이템'); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB배너 아이템 추가</span></a>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>
                        </th>
                        <th class="width-60px">관리</th>
                        <th>이미지</th>
                        <th>대표타이틀</th>
                        <th>순서</th>
						<th>상태</th>
                        <th>보기권한</th>
                        <th>노출수</th>
                        <th>클릭수</th>
                        <th>클릭율(%)</th>
                        <th>시작일</th>
						<th>종료일</th>
						<th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="chk[]" id="chk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="bi_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['bi_no']; ?>">
                        </th>
                        <td class="text-center">
							<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_itemform&amp;thema=<?php echo $this_theme; ?>&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;bi_no=<?php echo $list[$i]['bi_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB배너 아이템관리'); return false;"><u>수정</u></a>
							<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_dateinfo&amp;thema=<?php echo $this_theme; ?>&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;bi_no=<?php echo $list[$i]['bi_no']; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB배너 날짜별 통계'); return false;"><u>통계</u></a>
                        </td>
                        <td>
                            <div class="ebbanner-itemlist-image"><?php echo $list[$i]['bi_image']; ?></div>
                        </td>
                        <td>
							<?php echo $list[$i]['bi_title'] ? get_text($list[$i]['bi_title']):'없음'; ?>
                        </td>
                        <td>
							<label class="input width-100px"><input type="text" name="bi_sort[<?php echo $i; ?>]" id="bi_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['bi_sort']; ?>"></label>
                        </td>
                        <td>
							<label class="select width-150px"><select name="bi_state[<?php echo $i; ?>]" id="bi_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $list[$i]['bi_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $list[$i]['bi_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
						<td>
							<label class="select width-100px"><?php echo $list[$i]['view_level']; ?><i></i></label>
						</td>
						<td class="text-center"><?php echo $list[$i]['bi_exposed']; ?></td>
						<td class="text-center">
							<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_itemhit&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;bi_no=<?php echo $list[$i]['bi_no']; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB배너 조회수 집계'); return false;" class="btn-e btn-e-dark width-100px"><?php echo $list[$i]['bi_clicked']; ?></a>
						</td>
                        <td class="text-center"><?php echo $list[$i]['bi_ratio'] ? $list[$i]['bi_ratio']:0; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bi_start'] ? date('Y-m-d',strtotime($list[$i]['bi_start'])):''; ?></td>
                        <td class="text-center"><?php echo $list[$i]['bi_end'] ? date('Y-m-d',strtotime($list[$i]['bi_end'])):''; ?></td>
                        <td class="text-center"><?php echo substr($list[$i]['bi_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="12" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-700"></h5>
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

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
<?php if (!$wmode) { ?>
function eb_modal(href, title) {
    $('.admin-iframe-modal').modal('show').on('hidden.bs.modal', function () {
        $("#modal-iframe").attr("src", "");
        $(".modal-title").text("");
        $('html').css({overflow: ''});
    });
    $('.admin-iframe-modal').modal('show').on('shown.bs.modal', function () {
        $("#modal-iframe").attr("src", href);
        $('#modal-iframe').height(parseInt($(window).height() * 0.85));
        $(".modal-title").text(title);
        $('html').css({overflow: 'hidden'});
    });
    return false;
}

window.closeModal = function(){
    $('.admin-iframe-modal').modal('hide');
};
<?php } ?>

function febbanneritemlist_submit(f) {
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

function del_confirm() {
	if (confirm('배너를 삭제하시겠습니까?')) {
		return true;
	} else {
		return false;
	}
}

function check_all_img(f) {
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function close_modal_and_reload() {
	window.closeModal = function(){
		$('.admin-iframe-modal').modal('hide');
	};
	document.location.reload();
}

$(document).ready(function() {
	$('.ebbanner-image').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: '로딩중...',
		mainClass: 'mfp-img-mobile',
		image: {
			tError: '이미지를 불러올수 없습니다.'
		}
	});
});
</script>
<?php } ?>