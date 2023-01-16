<?php
/**
 * Eyoom Admin Skin File
 * @file	~/theme/basic/skin/theme/ebbanner_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/jsgrid/jsgrid-theme.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.eb-clipboard-box {position:relative;overflow:hidden;border:1px solid #4052B5;background:#f7f8ff;text-align:center}
.eb-clipboard-box-cont {height:26px;line-height:26px;padding:0 10px}
.eb-clipboard-box-btn {height:26px;line-height:26px;cursor:pointer;color:#fff;background:#5C6BBF}
.eb-clipboard-box-btn:hover {background:#4052B5}
.admin-ebbanner-form .ebbanner-image {max-width:300px;background:#fafafa}
</style>

<div class="admin-ebbanner-form">
	<div class="adm-headline">
		<h3>EB배너 마스터 관리</h3>
	</div>

	<?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

	<form name="febbannerform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febbannerform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
	<input type="hidden" name="w" value="<?php echo $w; ?>">
	<input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
	<input type="hidden" name="bn_no" id="bn_no" value="<?php echo $es['bn_no']; ?>">
	<input type="hidden" name="page" value="<?php echo $page; ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
	<input type="hidden" name="token" value="">

	<div class="adm-table-form-wrap margin-bottom-30">
		<header><strong><i class="fas fa-caret-right"></i> EB배너 마스터 설정정보</strong></header>

		<div class="table-list-eb">
			<?php if (!G5_IS_MOBILE) { ?>
			<div class="table-responsive">
			<?php } ?>
			<table class="table">
				<tbody>
					<tr>
						<th class="table-form-th">
							<label class="label">코드</label>
						</th>
						<td colspan="3">
							<label for="bn_code" class="input form-width-250px">
						        <input type="text" name="bn_code" id="bn_code" value="<?php echo $es['bn_code'] ? $es['bn_code']: time(); ?>" readonly required>
							</label>
							<div class="note"><strong>Note:</strong> 자동생성되며, 수정하실 수 없습니다.</div>
						</td>
					</tr>
					<tr>
						<th class="table-form-th">
							<label class="label">치환코드</label>
						</th>
						<td>
							<div class="eb-clipboard-box">
								<div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_banner('<?php echo $es['bn_code'] ? $es['bn_code']: time(); ?>'); ?&gt;</strong></div>
								<div class="eb-clipboard-box-btn" data-clipboard-target="#substitution_code">치환코드복사</div>
							</div>
							<div class="note"><strong>Note:</strong> 치환코드를 복사하여 출력하고자 하는 위치에 붙여넣기 하세요.</div>
						</td>
					<?php if (G5_IS_MOBILE) { ?>
					</tr>
					<tr>
					<?php } ?>
						<th class="table-form-th border-left-th">
							<label class="label">출력여부</label>
						</th>
						<td>
							<div class="inline-group">
								<label for="bn_state_1" class="radio"><input type="radio" name="bn_state" id="bn_state_1" value="1" <?php echo $es['bn_state'] == '1' || !$es['bn_state'] ? 'checked':''; ?>><i></i> 보이기</label>
								<label for="bn_state_2" class="radio"><input type="radio" name="bn_state" id="bn_state_2" value="2" <?php echo $es['bn_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
							</div>
							<div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
						</td>
					</tr>
					<tr>
						<th class="table-form-th">
							<label class="label">배너마스터 제목</label>
						</th>
						<td>
							<label for="bn_subject" class="input">
						        <input type="text" name="bn_subject" id="bn_subject" value="<?php echo get_text($es['bn_subject']); ?>" required>
							</label>
							<div class="note"><strong>Note:</strong> 예) 메인 배너, 메인 제품소개 배너...</div>
						</td>
					<?php if (G5_IS_MOBILE) { ?>
					</tr>
					<tr>
					<?php } ?>
						<th class="table-form-th border-left-th">
							<label class="label">배너마스터 스킨</label>
						</th>
						<td>
							<label for="bn_skin" class="select form-width-250px">
						        <select name="bn_skin" id="bn_skin">
							    	<option value="">::선택::</option>
							    	<?php foreach ($ebbanner_skins as $eb_skin) { ?>
							    	<option value="<?php echo $eb_skin; ?>" <?php echo get_selected($es['bn_skin'], $eb_skin); ?>><?php echo $eb_skin; ?></option>
							    	<?php } ?>
						        </select><i></i>
							</label>
							<div class="note"><strong>Note:</strong> EB배너 마스터에 적용할 스킨을 선택해 주세요.</div>
						</td>
					</tr>
					<tr>
						<th class="table-form-th">
							<label class="label">EB배너 마스터 이미지</label>
						</th>
						<td colspan="3">
							<span class="input input-file form-width-350px">
								<div class="button"><input type="file" name="bn_image" id="bn_image" onchange="this.parentNode.nextSibling.value = this.value">이미지파일 찾기</div><input type="text" readonly="">
							</span>
							<?php if ($es['bn_image']) { ?>
							<div class="bn_img_info">
								<label for="bn_image_del" class="checkbox"><input type="checkbox" id="bn_image_del" name="bn_image_del" value="1"><i></i><?php echo $es['bn_image']; ?> 파일삭제</label>
								<input type="hidden" name="del_image_name" value="<?php echo $es['bn_image']; ?>">
								<div class="thumbnail ebbanner-image">
									<div class="thumb">
										<img src="<?php echo $es['bn_img_url']; ?>">
										<div class="caption-overflow">
											<span>
												<a href="<?php echo $es['bn_img_url']; ?>" class="btn-e btn-e-default btn-e-lg btn-e-brd"><i class="fas fa-plus color-white"></i></a>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="note"><strong>Note:</strong> EB배너 마스터의 이미지를 업로드해 주세요.</div>
						</td>
					</tr>
					</tbody>
				</table>
				<?php if (!G5_IS_MOBILE) { ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php echo $frm_submit; ?>

	</form>

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
			<h3>EB 배너 - 아이템 관리</h3>
			<?php if (!$wmode) { ?>
			<a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&pid=ebbanner_itemform&amp;bn_code=<?php echo $es['bn_code']; ?>&amp;thema=<?php echo $this_theme; ?>&amp;wmode=1" onclick="eb_modal(this.href, 'EB배너 아이템'); return false;" class="btn-e btn-e-red btn-e-lg"><i class="fas fa-plus"></i> EB배너 아이템 추가</a>
			<div class="clearfix"></div>
			<?php } ?>
		</div>

		<?php if (G5_IS_MOBILE) { ?>
		<p class="font-size-11 color-grey text-right margin-bottom-5"><i class="fas fa-info-circle"></i> Note! 좌우스크롤 가능 (<i class="fas fa-arrows-alt-h"></i>)</p>
		<?php } ?>

		<div id="ebbanner-itemlist"></div>

		<div class="margin-top-20">
		    <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-xs btn-e-red" onclick="document.pressed=this.value">
		    <?php if ($is_admin == 'super') { ?>
		    <input type="submit" name="act_button" value="선택삭제" class="btn-e btn-e-xs btn-e-dark" onclick="document.pressed=this.value">
		    <?php } ?>
		</div>
		</form>
	</div>
</div>

<div class="modal fade admin-iframe-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <iframe id="modal-iframe" width="100%" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/jsgrid/jsgrid.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/js/jsgrid.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
<?php if (!(G5_IS_MOBILE || $wmode)) { ?>
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

!function () {
	// EB배너 이미지 아이템
    var db = {
        deleteItem: function (deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1)
        },
        insertItem: function (insertingClient) {
            this.clients.push(insertingClient)
        },
        loadData  : function (filter) {
            return $.grep(this.clients, function (client) {
                return !(filter.체크 && !(client.체크.indexOf(filter.체크) > -1)  )
            })
        },
        updateItem: function (updatingClient) {}
    };
    window.db    = db,
    db.clients   = [
	    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
        {
	        체크: "<label for='chk_<?php echo $i; ?>' class='checkbox'><input type='checkbox' name='chk[]' id='chk_<?php echo $i; ?>' value='<?php echo $i; ?>'><i></i></label><input type='hidden' name='bi_no[<?php echo $i; ?>]' value='<?php echo $list[$i]['bi_no']; ?>'>",
	        관리: "<a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_itemform&amp;thema=<?php echo $this_theme; ?>&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;bi_no=<?php echo $list[$i]['bi_no']; ?>&amp;w=u&amp;iw=u&amp;page=<?php echo $page; ?>&amp;wmode=1' onclick='eb_modal(this.href,\"EB배너 아이템관리\"); return false;'><u>수정</u></a>",
	        이미지: "<?php echo $list[$i]['bi_image']; ?>",
	        대표타이틀: "<?php echo $list[$i]['bi_title'] ? get_text($list[$i]['bi_title']):'없음'; ?>",
	        순서: "<label for='bi_sort_<?php echo $list[$i]['index']; ?>' class='input'><input type='text' name='bi_sort[<?php echo $i; ?>]' id='bi_sort_<?php echo $i; ?>' value='<?php echo $list[$i]['bi_sort']; ?>'></label>",
	        상태: "<label for='bi_state_<?php echo $i; ?>' class='select'><select name='bi_state[<?php echo $i; ?>]' id='bi_state_<?php echo $i; ?>'><option value=''>선택</option><option value='1' <?php echo $list[$i]['bi_state'] == '1' ? 'selected':''; ?>>보이기</option><option value='2' <?php echo $list[$i]['bi_state'] == '2' ? 'selected': ''; ?>>숨기기</option></select><i></i></label>",
	        보기권한: "<label class='select'><?php echo $list[$i]['view_level']; ?><i></i></label>",
	        링크_타겟: "<?php if ($list[$i]['bi_type'] == 'intra') { ?><label class='input'><i class='icon-prepend fas fa-link'></i><input type='text' name='bi_link[<?php echo $i; ?>]' value='<?php echo $list[$i]['bi_link']; ?>'><i></i></label><label for='bi_target_<?php echo $i; ?>' class='select' style='margin-top:5px;'><select name='bi_target[<?php echo $i; ?>]' id='bi_target_<?php echo $i; ?>'><option value=''>선택</option><option value='_blank' <?php echo $list[$i]['bi_target'] == '_blank' ? 'selected':''; ?>>새창</option><option value='_self' <?php echo $list[$i]['bi_target'] == '_self' ? 'selected': ''; ?>>현재창</option></select><i></i></label><?php } else { echo '지원안함'; } ?>",
	        노출수: "<?php echo $list[$i]['bi_exposed']; ?>",
	        클릭수: "<?php if ($list[$i]['bi_type'] == 'intra') { ?><a href='<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=ebbanner_itemhit&amp;bn_code=<?php echo $list[$i]['bn_code']; ?>&amp;bi_no=<?php echo $list[$i]['bi_no']; ?>&amp;wmode=1' onclick='eb_modal(this.href,\"EB배너 조회수 집계\"); return false;' class='btn-e btn-e-purple btn-e-md' style='width:100%;'><?php echo $list[$i]['bi_clicked']; ?></a><?php } else { echo '지원안함'; } ?>",
	        클릭율: "<?php echo $list[$i]['bi_type'] == 'intra' ? $list[$i]['bi_ratio'].'%': '지원안함'; ?>",
	        시작일: "<?php echo $list[$i]['bi_start'] ? date('Y-m-d',strtotime($list[$i]['bi_start'])):''; ?>",
	        종료일: "<?php echo $list[$i]['bi_end'] ? date('Y-m-d',strtotime($list[$i]['bi_end'])):''; ?>",
	        등록일: "<?php echo substr($list[$i]['bi_regdt'], 0, 10); ?>",
        },
        <?php } ?>
    ];

}();

$(function() {
    $("#ebbanner-itemlist").jsGrid({
        filtering      : false,
        editing        : false,
        sorting        : false,
        paging         : true,
        autoload       : true,
        controller     : db,
        deleteConfirm  : "정말로 삭제하시겠습니까?\n한번 삭제된 데이터는 복구할수 없습니다.",
        pageButtonCount: 5,
        pageSize       : <?php echo $config['cf_page_rows']; ?>,
        width          : "100%",
        height         : "auto",
        fields         : [
            { name: "체크", type: "text", width: 40 },
            { name: "관리", type: "text", align: "center", width: 60, headercss: "set-btn-header", css: "set-btn-field" },
            { name: "이미지", type: "text", align: "center", width: 100 },
            { name: "대표타이틀", type: "text", width: 180 },
            { name: "순서", type: "number",width: 60 },
            { name: "상태", type: "text", width: 110 },
            { name: "보기권한", type: "text", width: 100 },
            { name: "링크_타겟", type: "text", width: 200 },
            { name: "노출수", type: "number", width: 60 },
            { name: "클릭수", type: "text", align: "center", width: 70 },
            { name: "클릭율", type: "text", align: "center", width: 70 },
            { name: "시작일", type: "text", align: "center", width: 80 },
            { name: "종료일", type: "text", align: "center", width: 80 },
            { name: "등록일", type: "text", align: "center", width: 80 },
        ]
    });

    var $chk = $("#ebbanner-itemlist .jsgrid-table th:first-child");
	if ($chk.text() == '체크') {
		var html = '<label for="chkall" class="checkbox"><input type="checkbox" name="chkall" id="chkall" value="1" onclick="check_all_img(this.form)"><i></i></label>';
		$chk.html(html);
	}
});

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