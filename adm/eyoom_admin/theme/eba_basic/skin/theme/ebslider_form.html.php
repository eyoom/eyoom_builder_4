<?php
/**
 * Eyoom Admin Skin File
 * @file	~/theme/THEME_NAME/skin/theme/ebslider_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);

/**
 * 페이지 경로 설정
 */
$fm_pid = 'ebslider_list';
$g5_title = 'EB슬라이더관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">테마설정관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
.admin-ebslider-form .ebslider-image {width:200px}
.admin-ebslider-itemlist .ebslider-itemlist-image {width:150px;margin:0 auto}
</style>

<div class="admin-ebslider-form">
	<?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

	<div class="adm-headline">
		<h3>EB슬라이더 마스터 관리</h3>
	</div>

	<form name="febsliderform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febsliderform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
	<input type="hidden" name="w" value="<?php echo $w; ?>">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
	<input type="hidden" name="es_no" id="es_no" value="<?php echo $es['es_no']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="">

	<div class="adm-form-table m-b-20">
		<div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB슬라이더 마스터 설정정보</strong></div>
		<div class="adm-form-tr">
			<div class="adm-form-td td-l">
				<label for="es_code" class="label">코드</label>
			</div>
			<div class="adm-form-td td-r">
				<label class="input max-width-250px">
					<input type="text" name="es_code" id="es_code" value="<?php echo $es['es_code'] ? $es['es_code']: time(); ?>" readonly required>
				</label>
				<div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l adm-sm-100">
				<div class="adm-form-td td-l">
					<label class="label">치환코드</label>
				</div>
				<div class="adm-form-td td-r">
					<div class="eb-clipboard-box">
						<div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_slider('<?php echo $es['es_code'] ? $es['es_code']: time(); ?>'); ?&gt;</strong></div>
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
						<label for="es_state_1" class="radio"><input type="radio" name="es_state" id="es_state_1" value="1" <?php echo $es['es_state'] == '1' || !$es['es_state'] ? 'checked':''; ?>><i></i> 보이기</label>
						<label for="es_state_2" class="radio"><input type="radio" name="es_state" id="es_state_2" value="2" <?php echo $es['es_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
					</div>
					<div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
				</div>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l">
				<div class="adm-form-td td-l">
					<label for="es_subject" class="label">슬라이더마스터 제목</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="input max-width-250px">
						<input type="text" name="es_subject" id="es_subject" value="<?php echo get_text($es['es_subject']); ?>" required>
					</label>
					<div class="note"><strong>Note:</strong> 예) 메인 슬라이더, 메인 제품소개 슬라이더...</div>
				</div>
			</div>
			<div class="adm-form-tr tr-r">
				<div class="adm-form-td td-l">
					<label for="es_skin" class="label">슬라이더마스터 스킨</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="select max-width-250px">
						<select name="es_skin" id="es_skin">
							<option value="">::선택::</option>
							<?php foreach ($ebslider_skins as $eb_skin) { ?>
							<option value="<?php echo $eb_skin; ?>" <?php echo get_selected($es['es_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
							<?php } ?>
						</select><i></i>
					</label>
					<div class="note"><strong>Note:</strong> EB슬라이더 마스터에 적용할 스킨을 선택해 주세요.</div>
				</div>
			</div>
		</div>
		<div class="adm-form-tr">
			<div class="adm-form-td td-l">
				<label for="es_text" class="label">슬라이더마스터 설명글</label>
			</div>
			<div class="adm-form-td td-r">
				<label class="textarea">
					<textarea name="es_text" id="es_text" style="height:80px;"><?php echo $es['es_text']; ?></textarea>
				</label>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l">
				<div class="adm-form-td td-l">
					<label class="label">동영상 플레이 방식</label>
				</div>
				<div class="adm-form-td td-r">
					<div class="inline-group">
						<label for="es_ytplay_1" class="radio"><input type="radio" name="es_ytplay" id="es_ytplay_1" value="1" <?php echo $es['es_ytplay'] == '1' || !$es['es_ytplay'] ? 'checked':''; ?>><i></i> 순차적으로 플레이</label>
						<label for="es_ytplay_2" class="radio"><input type="radio" name="es_ytplay" id="es_ytplay_2" value="2" <?php echo $es['es_ytplay'] == '2' ? 'checked':''; ?>><i></i> 랜덤하게 플레이</label>
					</div>
					<div class="note"><strong>Note:</strong> 유튜브동영상 아이템을 여러개 등록하였을 경우, 플레이 방식을 선택합니다.<br>유튜브동영상을 지원하는 EB슬라이더 스킨에서만 작동합니다.</div>
				</div>
			</div>
			<div class="adm-form-tr tr-r">
				<div class="adm-form-td td-l">
					<label class="label">동영상 모바일 자동플레이</label>
				</div>
				<div class="adm-form-td td-r">
					<div class="inline-group">
						<label for="es_ytmauto_1" class="radio"><input type="radio" name="es_ytmauto" id="es_ytmauto_1" value="1" <?php echo $es['es_ytmauto'] == '1' ? 'checked':''; ?>><i></i> 자동실행</label>
						<label for="es_ytmauto_2" class="radio"><input type="radio" name="es_ytmauto" id="es_ytmauto_2" value="2" <?php echo $es['es_ytmauto'] == '2' || !$es['es_ytmauto'] ? 'checked':''; ?>><i></i> 멈춤</label>
					</div>
					<div class="note"><strong>Note:</strong> 모바일에서 페이지 로딩 후, 동영상을 바로 플레이 시킬지 멈춘 상태로 있을지 결정합니다.<br>유튜브동영상을 지원하는 EB슬라이더 스킨에서만 작동합니다.</div>
				</div>
			</div>
		</div>
		<div class="adm-form-tr-wrap">
			<div class="adm-form-tr tr-l">
				<div class="adm-form-td td-l">
					<label for="es_link_cnt" class="label">EB슬라이더 아이템 링크수</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="input max-width-250px">
						<i class="icon-append">개</i>
						<input type="text" name="es_link_cnt" id="es_link_cnt" value="<?php echo $es['es_link_cnt'] ? $es['es_link_cnt']: 1; ?>" class="text-end" required maxlength="2">
					</label>
				</div>
			</div>
			<div class="adm-form-tr tr-r">
				<div class="adm-form-td td-l">
					<label for="es_image_cnt" class="label">EB슬라이더 아이템 이미지수</label>
				</div>
				<div class="adm-form-td td-r">
					<label class="input form-width-250px">
						<i class="icon-append">개</i>
						<input type="text" name="es_image_cnt" id="es_image_cnt" value="<?php echo $es['es_image_cnt'] ? $es['es_image_cnt']: 1; ?>" class="text-end" required maxlength="2">
					</label>
				</div>
			</div>
		</div>
		<div class="adm-form-tr adm-sm-100">
			<div class="adm-form-td td-l">
				<label class="label">대표 연결주소 [링크]</label>
			</div>
			<div class="adm-form-td td-r">
				<label class="select width-150px m-b-10">
					<select name="es_target" id="es_target">
						<option value="">타겟을 선택하세요.</option>
						<option value="_blank" <?php echo $es['es_target'] == '_blank' ? 'selected':''; ?>>새창</option>
						<option value="_self" <?php echo $es['es_target'] == '_self' ? 'selected':''; ?>>현재창</option>
					</select><i></i>
				</label>
				<label class="input">
					<i class="icon-prepend fas fa-link"></i>
					<input type="text" name="es_link" id="es_link" value="<?php echo $es['es_link']; ?>">
				</label>
				<div class="note"><strong>Note:</strong> EB슬라이더 마스터에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
			</div>
		</div>
		<div class="adm-form-tr adm-sm-100">
			<div class="adm-form-td td-l">
				<label class="label">EB슬라이더 마스터 이미지</label>
			</div>
			<div class="adm-form-td td-r">
				<div class="input">
					<input type="file" class="form-control" name="es_image" id="es_image">
				</div>
				<?php if ($es['es_image']) { ?>
				<div class="es_img_info">
					<label for="es_image_del" class="checkbox"><input type="checkbox" id="es_image_del" name="es_image_del" value="1"><i></i><?php echo $es['es_image']; ?> 파일삭제</label>
					<input type="hidden" name="del_image_name" value="<?php echo $es['es_image']; ?>">
					<div class="thumbnail ebslider-image">
						<div class="thumb">
							<img src="<?php echo $es['es_img_url']; ?>" class="img-fluid">
							<div class="caption-overflow">
								<span>
									<a href="<?php echo $es['es_img_url']; ?>" class="btn-e btn-e-gray btn-e-lg btn-e-brd"><i class="fas fa-plus text-white"></i></a>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="note"><strong>Note:</strong> EB슬라이더 마스터의 이미지를 업로드해 주세요.</div>
			</div>
		</div>
	</div>

	<div class="confirm-bottom-btn">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/clipboard/clipboard.min.js"></script>
<script>
function febsliderform_submit(f) {
	if (f.es_code.value == '') {
		alert("코드는 자동생성되며 빈값을 입력하실 수 없습니다.");
		document.location.reload();
		return false;
	}
	if (f.es_subject.value.length < 2) {
		alert("슬라이더 마스터의 제목을 2자이상으로 입력해 주세요.");
		f.es_subject.focus();
		return false;
	}
	if (!f.es_skin.value) {
		alert("슬라이더 마스터의 스킨을 선택해 주세요.");
		f.es_skin.focus();
		return false;
	}
	return true;
}

new Clipboard('.eb-clipboard-box-btn');

$(document).ready(function() {
	$('.ebslider-image').magnificPopup({
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

<?php if ($w == 'u' && $es_code) { ?>
<div class="admin-ebslider-itemlist m-t-20">
	<div class="adm-headline">
        <h3>EB슬라이더 - 아이템 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_itemform&amp;es_code=<?php echo $es['es_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB슬라이더 아이템'); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>EB슬라이더 아이템 추가</span></a>
        <?php } ?>
    </div>

	<form name="febslideritemlist" id="febslideritemlist" action="<?php echo $action_url3; ?>" method="post" onsubmit="return febslideritemlist_submit(this);" class="eyoom-form">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
	<input type="hidden" name="es_code" id="es_code" value="<?php echo $es['es_code']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="<?php echo $token; ?>">
	
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
                            <input type="hidden" name="ei_no[<?php echo $i; ?>]" value="<?php echo $list[$i]['ei_no']; ?>">
                        </th>
                        <td class="text-center">
							<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_itemform&amp;thema=<?php echo $this_theme; ?>&amp;es_code=<?php echo $list[$i]['es_code']; ?>&amp;ei_no=<?php echo $list[$i]['ei_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB슬라이더 아이템관리'); return false;"><u>수정</u></a>
                        </td>
                        <td>
							<div class="ebslider-itemlist-image">
								<?php echo $list[$i]['ei_image']; ?>
							</div>
                        </td>
                        <td>
							<?php echo $list[$i]['ei_title'] ? get_text($list[$i]['ei_title']):'없음'; ?>
                        </td>
                        <td>
							<label class="input width-100px"><input type="text" name="ei_sort[<?php echo $i; ?>]" id="ei_sort_<?php echo $i; ?>" value="<?php echo $list[$i]['ei_sort']; ?>"></label>
                        </td>
                        <td>
							<label class="select width-150px"><select name="ei_state[<?php echo $i; ?>]" id="ei_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $list[$i]['ei_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $list[$i]['ei_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>
                        </td>
                        <td>
							<label class="select width-100px"><?php echo $list[$i]['view_level']; ?><i></i></label>
						</td>
                        <td class="text-center"><?php echo $list[$i]['ei_start'] ? date('Y-m-d',strtotime($list[$i]['ei_start'])):''; ?></td>
						<td class="text-center"><?php echo $list[$i]['ei_end'] ? date('Y-m-d',strtotime($list[$i]['ei_end'])):''; ?></td>
						<td class="text-center"><?php echo substr($list[$i]['ei_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="10" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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

<div class="admin-ebslider-YTitemlist m-t-20">
	<div class="adm-headline">
        <h3>EB슬라이더 - 동영상 아이템 관리</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebslider_ytitemform&amp;es_code=<?php echo $es['es_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, '유튜브동영상 아이템'); return false;" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>유튜브동영상 아이템 추가</span></a>
        <?php } ?>
    </div>

	<form name="febsliderytitemlist" id="febsliderytitemlist" action="<?php echo $action_url2; ?>" method="post" onsubmit="return febsliderytitemlist_submit(this);" class="eyoom-form">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme; ?>">
	<input type="hidden" name="es_code" id="es_code" value="<?php echo $es['es_code']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="<?php echo $token; ?>">

	<div class="cont-text-bg m-b-20">
		<p class="bg-warning">
			<i class="fas fa-exclamation-circle"></i> 유튜브동영상을 지원하는 EB슬라이더 스킨에서만 작동합니다.
		</p>
	</div>
	
	<p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-40px">
                            <label for="chkall" class="sound_only">전체선택</label>
                            <label class="checkbox adm-table-check"><input type="checkbox" name="chkall" id="ytchkall" value="1" onclick="check_all_yt(this.form)"><i></i></label>
                        </th>
                        <th class="width-60px">관리</th>
                        <th>유튜브동영상_URL</th>
                        <th>순서</th>
                        <th>상태</th>
                        <th>보기권한</th>
                        <th>시작일</th>
                        <th>종료일</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
					<?php for ($i=0; $i<count((array)$yt_list); $i++) { ?>
                    <tr>
                        <th>
                            <label class="checkbox adm-table-check">
                                <input type="checkbox" name="ytchk[]" id="ytchk_<?php echo $i; ?>" value="<?php echo $i; ?>"><i></i>
                            </label>
                            <input type="hidden" name="ei_no[<?php echo $i; ?>]" value="<?php echo $yt_list[$i]['ei_no']; ?>">
                        </th>
                        <td class="text-center">
							<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebslider_ytitemform&amp;thema=<?php echo $this_theme; ?>&amp;es_code=<?php echo $yt_list[$i]['es_code']; ?>&amp;ei_no=<?php echo $yt_list[$i]['ei_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1" onclick="eb_modal(this.href, '유튜브동영상 설정관리'); return false;"><u>수정</u></a>
                        </td>
                        <td>
							<a href="https://youtu.be/<?php echo $yt_list[$i]['ei_ytcode']; ?>" target="_blank">https://youtu.be/<?php echo $yt_list[$i]['ei_ytcode']; ?></a>
						</td>
                        <td>
							<label class="input width-100px"><input type="text" name="ei_sort[<?php echo $i; ?>]" id="ei_sort_<?php echo $i; ?>" value="<?php echo $yt_list[$i]['ei_sort']; ?>"></label>
						</td>
						<td>
							<label class="select width-150px"><select name="ei_state[<?php echo $i; ?>]" id="ei_state_<?php echo $i; ?>"><option value="">선택</option><option value="1" <?php echo $yt_list[$i]['ei_state'] == '1' ? 'selected':''; ?>>보이기</option><option value="2" <?php echo $yt_list[$i]['ei_state'] == '2' ? 'selected':''; ?>>숨기기</option></select><i></i></label>
						</td>
						<td>
							<label class="select width-100px"><?php echo $yt_list[$i]['view_level']; ?><i></i></label>
						</td>
						<td class="text-center"><?php echo $yt_list[$i]['ei_start'] ? date('Y-m-d',strtotime($yt_list[$i]['ei_start'])):''; ?></td>
						<td class="text-center"><?php echo $yt_list[$i]['ei_end'] ? date('Y-m-d',strtotime($yt_list[$i]['ei_end'])):''; ?></td>
						<td class="text-center"><?php echo substr($yt_list[$i]['ei_regdt'], 0, 10); ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$yt_list) == 0) { ?>
                    <tr>
                        <td colspan="9" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
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

function febslideritemlist_submit(f) {
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

function febsliderytitemlist_submit(f) {
    if (!is_checked("ytchk[]")) {
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
	if (confirm('슬라이더를 삭제하시겠습니까?')) {
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

function check_all_yt(f) {
    var chk = document.getElementsByName("ytchk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function close_modal_and_reload() {
	window.closeModal = function(){
		$('.admin-iframe-modal').modal('hide');
	};
	document.location.reload();
}
</script>
<?php } ?>