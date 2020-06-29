<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/gmap/write.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert/sweetalert.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/venobox/venobox.css" type="text/css" media="screen">',0);
?>

<style>
.board-write .board-setup {position:relative;border:1px solid #d5d5d5;height:30px;margin-bottom:20px}
.board-write .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-write .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-write .board-setup-btn {float:left;width:25%;height:30px;line-height:30px;color:#fff;text-align:center;font-size:12px}
.board-write .board-setup-btn:nth-child(odd) {background:#59595B}
.board-write .board-setup-btn:nth-child(even) {background:#676769}
.board-write .board-setup-btn:hover {opacity:0.8}
.board-write .board-write-title {position:relative;border-bottom:1px solid #b5b5b5;padding-bottom:15px}
.board-write .blind {position:absolute;top:-10px;left:-100000px;display:none}
.board-write .write-edit-wrap #wr_content {display:block;box-sizing:border-box;-moz-box-sizing:border-box;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
.board-write .write-option-btn {float:left;padding:0 15px;margin-bottom:3px;height:24px;line-height:24px;color:#fff;text-align:center;font-size:11px}
.board-write .write-option-btn:nth-child(odd) {background:#59595B}
.board-write .write-option-btn:nth-child(even) {background:#676769}
.board-write .write-option-btn:hover {color:#fff;opacity:0.8}
.board-write .write-collapse-box {margin-top:10px;background:#f8f8f8;border:1px solid #d5d5d5;padding:15px 10px}
.board-write #modal_video_note .table-list-eb .table thead>tr>th {text-align:left}
/* Auto Save */
.autosave-btn {position:absolute;top:0;right:0}
#autosave_wrapper {position:relative}
#autosave_pop {display:none;z-index:10;position:absolute;top:0;right:0;padding:8px;width:320px;height:auto !important;height:180px;max-height:250px;border:2px solid #959595;background:#fff;box-shadow:0 1px 8px rgba(0, 0, 0, 0.2);overflow-y:scroll}
html.no-overflowscrolling #autosave_pop {height:auto;max-height:10000px !important}
#autosave_pop div {text-align:right}
#autosave_pop button {margin:0;padding:0;border:0;background:transparent;margin-left:10px}
#autosave_pop ul {margin:10px 0;padding:0;border-top:1px solid #e9e9e9;list-style:none}
#autosave_pop li {padding:7px 0;border-bottom:1px solid #e9e9e9;zoom:1;font-size:12px}
#autosave_pop li:after {display:block;visibility:hidden;clear:both;content:""}
#autosave_pop a {display:block;float:left}
#autosave_pop span {display:block;float:right}
#autosave_pop .autosave_heading {text-align:left}
#autosave_pop strong {font-size:13px}
#autosave_pop .fa-times {position:absolute;top:10px;right:15px}
.autosave_close {cursor:pointer}
.autosave_content {display:none}
/* Tag */
#tag-box {border:1px dashed #c5c5c5;min-height:20px;padding:5px;background:#fff;margin-top:15px}
#tag-cloud div {display:inline-block;line-height:1;background:#676769;padding:3px 7px;margin:2px 3px;font-size:11px;color:#fff;border-radius:2px !important}
#tag-cloud div i {cursor:pointer}
/* Ckeditor */
.board-write a.cke_button {padding:2px 5px}
.board-write a.cke_button_on {padding:1px 4px}
.board-write a.cke_button_off:hover, .board-write a.cke_button_off:focus, .board-write a.cke_button_off:active {padding:1px 4px}
/* Smart Editor */
.cke_sc {margin-bottom:10px}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
/* Summernote */
.eyoom-form .note-editor *, .eyoom-form .note-editor *:after, .eyoom-form .note-editor *:before {box-sizing:border-box;-moz-box-sizing:border-box}
.eyoom-form .note-editor.panel-default>.panel-heading {background-color:#eaecee;border:0;border-bottom:1px solid #A9A9A9}
.panel-heading.note-toolbar .note-color .dropdown-menu {padding-top:6px;padding-bottom:6px;padding-left:1px}
/* Gmap */
.board-write .gmap-search-box {position:relative;border:1px solid #b5b5b5;background:#fafafa;margin:0 0 20px;padding:15px 15px 8px}
.board-write #gmap-container {position:relative;overflow:hidden;height:230px;padding:6px;border:1px solid #d5d5d5;background:#fff}
.board-write #gmap_write_srh_canvas {width:100%;height:100%;margin:0px;padding:0px}
.board-write #pac-input:focus {border-color:#4D90FE}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (min-width:768px) {
    .writegmap-iframe-modal .modal-lg {width:600px}
}
@media (min-width:992px) {
    .writegmap-iframe-modal .modal-lg {width:900px}
}
<?php } ?>
<?php if ($wmode) { ?>
.board-write {width:100%;overflow:hidden}
<?php } ?>
</style>

<div class="board-write">
    <?php if ($is_admin && !G5_IS_MOBILE && !$wmode) { ?>
    <div class="board-setup btn-edit-mode hidden-xs hidden-sm">
        <span class="eyoom-form">
            <label class="select">
                <select name="set_bo_skin" class="set_bo_skin">
                    <option value="">::스킨선택::</option>
                    <?php foreach ($bo_skin as $skin) { ?>
                    <option value="<?php echo $skin; ?>" <?php echo $skin == $eyoom_board['bo_skin'] ? 'selected': ''; ?>><?php echo $skin; ?></option>
                    <?php }?>
                </select><i></i>
            </label>
        </span>
        <span class="board-setup-btn-box">
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> 추가기능</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
        </span>
    </div>
    <?php } ?>

    <h4 class="board-write-title">
        <strong><?php echo $g5['title']; ?></strong>
    </h4>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
    <input type="hidden" name="spt" value="<?php echo $spt; ?>">
    <input type="hidden" name="sst" value="<?php echo $sst; ?>">
    <input type="hidden" name="sod" value="<?php echo $sod; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH;?>/board">
    <input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="eb_1" id="eb_1" value="<?php echo $eb_1; ?>">
    <input type="hidden" name="eb_2" id="eb_2" value="<?php echo $eb_2; ?>">
    <input type="hidden" name="eb_3" id="eb_3" value="<?php echo $eb_3; ?>">
    <input type="hidden" name="eb_4" id="eb_4" value="<?php echo $eb_4; ?>">
    <input type="hidden" name="eb_5" id="eb_5" value="<?php echo $eb_5; ?>">
    <input type="hidden" name="eb_6" id="eb_6" value="<?php echo $eb_6; ?>">
    <input type="hidden" name="eb_7" id="eb_7" value="<?php echo $eb_7; ?>">
    <input type="hidden" name="eb_8" id="eb_8" value="<?php echo $eb_8; ?>">
    <input type="hidden" name="eb_9" id="eb_9" value="<?php echo $eb_9; ?>">
    <input type="hidden" name="eb_10" id="eb_10" value="<?php echo $eb_10; ?>">

    <?php if (($is_name) || ($is_password && !$is_admin) || ($is_email) || ($is_homepage)) { ?>
    <section class="margin-top-20">
        <div class="row">
            <?php if ($is_name) { ?>
            <div class="col col-3">
                <label for="wr_name" class="label">이름<strong class="sound_only">필수</strong></label>
                <label class="input required-mark margin-bottom-10">
                    <i class="icon-append fas fa-user"></i>
                    <input type="text" name="wr_name" value="<?php echo $name; ?>" id="wr_name" required size="10" maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_password && !$is_admin) { ?>
            <div class="col col-3">
                <label for="wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
                <label class="input required-mark margin-bottom-10">
                    <i class="icon-append fas fa-lock"></i>
                    <input type="password" name="wr_password" id="wr_password" required maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_email) { ?>
            <div class="col col-3">
                <label for="wr_email" class="label">이메일</label>
                <label class="input margin-bottom-10">
                    <i class="icon-append fas fa-envelope"></i>
                    <input type="text" name="wr_email" value="<?php echo $email; ?>" id="wr_email" size="50" maxlength="100">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_homepage) { ?>
            <div class="col col-3">
                <label for="wr_homepage" class="label">홈페이지</label>
                <label class="input margin-bottom-10">
                    <i class="icon-append fas fa-home"></i>
                    <input type="text" name="wr_homepage" value="<?php echo $homepage; ?>" id="wr_homepage" size="50">
                </label>
            </div>
            <?php } ?>
        </div>
    </section>
    <div class="margin-hr-10"></div>
    <?php } ?>
    <section>
        <div class="row">
            <?php if ($is_category) { ?>
            <div class="col col-4">
                <label class="select">
                    <select name="ca_name" id="ca_name" required class="form-control">
                        <option value="">선택하세요 - 필수</option>
                        <?php echo $category_option; ?>
                    </select>
                    <i></i>
                </label>
            </div>
            <?php } ?>
            <div class="col col-8">
            <?php if ($is_notice || $is_html || $is_secret || $is_mail || $bo_use_anonymous == '1') { ?>
                <div class="inline-group">
                    <?php if ($is_notice) { ?>
                    <label for="notice" class="checkbox"><input type="checkbox" id="notice" name="notice" value="1" <?php echo $notice_checked; ?>><i></i>공지</label>
                    <?php } ?>

                    <?php if ($is_html) { ?>
                    <?php if ($is_dhtml_editor) { ?>
                    <input type="hidden" value="html1" name="html">
                    <?php } else { ?>
                    <label for="html" class="checkbox"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="<?php echo $html_value; ?>" <?php echo $html_checked; ?>><i></i>HTML</label>
                    <?php } ?>
                    <?php } ?>

                    <?php if ($is_secret) { ?>
                    <?php if ($is_admin || $is_secret == 1) { ?>
                    <label for="secret" class="checkbox"><input type="checkbox" id="secret" name="secret" value="secret" <?php echo $secret_checked; ?>><i></i>비밀글</label>
                    <?php } else { ?>
                    <input type="hidden" name="secret" value="secret">
                    <?php } ?>
                    <?php } ?>

                    <?php if ($bo_use_anonymous == '1') { ?>
                    <label for="wr_anonymous" class="checkbox"><input type="checkbox" id="wr_anonymous" name="wr_anonymous" value="1" <?php echo $wr_anonymous_checked; ?>><i></i>익명글</label>
                    <?php } ?>

                    <?php if ($is_mail) { ?>
                    <label for="mail" class="checkbox"><input type="checkbox" id="mail" name="mail" value="mail" <?php echo $recv_email_checked; ?>><i></i>답변메일받기</label>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <div class="margin-hr-10"></div>
    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
	<label class="label">대표 지도 표시<small class="color-grey font-normal margin-left-10"><span class="color-red">*</span> 검색한 아래의 지도 위치가 '<strong class="color-red">글 본문내용 상단</strong>' 및 '<strong class="color-red">게시판 목록 지도</strong>'에 출력됩니다.</small></label>
	<section class="gmap-search-box">
		<div class="row">
			<div class="col col-6">
				<section>
					<label for="pac-input">주소 검색<small class="color-grey font-normal margin-left-10"><span class="color-red">*</span> 주소입력 시 자동완성</small></label>
					<label class="input">
						<i class="icon-append fas fa-location-arrow"></i>
						<input id="pac-input" type="text" placeholder="검색할 주소를 입력하세요.">
					</label>
				</section>
				<section>
					<label for="wr_6">주소</label>
					<label class="input">
		                <i class="icon-append fas fa-map-marker-alt"></i>
		                <input type="text" name="wr_6" id="wr_6" value="<?php echo $wr_6; ?>">
		            </label>
				</section>
				<section>
					<label for="wr_7">위도</label>
					<label class="input">
		                <i class="icon-append fas fa-map-pin"></i>
		                <input type="text" name="wr_7" id="wr_7" value="<?php echo $wr_7; ?>">
		            </label>
				</section>
				<section>
					<label for="wr_8">경도</label>
					<label class="input">
		                <i class="icon-append fas fa-map-pin"></i>
		                <input type="text" name="wr_8" id="wr_8" value="<?php echo $wr_8; ?>">
		            </label>
				</section>
			</div>
			<div class="sm-margin-bottom-20"></div>
			<div class="col col-6">
				<div id="gmap-container">
					<div id="gmap_write_srh_canvas"></div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
    <section>
        <div class="row">
            <div class="col col-12 md-margin-bottom-10">
                <div class="position-relative">
                    <label for="wr_subject" class="label">
                        제목<strong class="sound_only"> 필수</strong>
                    </label>
                    <label class="input required-mark">
                        <input type="text" name="wr_subject" value="<?php echo $subject; ?>" id="wr_subject" required size="50" maxlength="255" placeholder="제목을 입력해 주세요.">
                    </label>
                    <?php if ($is_member) { //임시 저장된 글 기능 ?>
                    <span class="autosave-btn">
                        <script src="<?php echo G5_URL; ?>/js/autosave.js"></script>
                        <button type="button" id="btn_autosave" class="btn-e btn-e-xs btn-e-dark position-relative">임시 저장된 글 <span id="autosave_count" class="badge badge-red rounded"><?php echo $autosave_count; ?></span></button>
                        <div id="autosave_pop">
                            <div class="autosave_heading">
                                <strong>임시 저장된 글 목록</strong>
                                <span class="autosave_close"><i class="fas fa-times"></i></span>
                            </div>
                            <div class="clearfix"></div>
                            <ul></ul>
                            <div><span class="autosave_close btn-e btn-e-dark btn-e-sm">닫기</span></div>
                        </div>
                    </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <div class="margin-hr-10"></div>
	<section>
		<div class="row">
			<div class="col col-6 md-margin-bottom-10">
				<label for="wr_9">위치명</label>
				<label class="input">
		            <i class="icon-append fas fa-building"></i>
		            <input type="text" name="wr_9" id="wr_9" value="<?php echo $wr_9; ?>">
		        </label>
        	</div>
        	<div class="col col-6">
				<label for="wr_10">연락처</label>
				<label class="input">
		            <i class="icon-append fas fa-phone"></i>
		            <input type="text" name="wr_10" id="wr_10" value="<?php echo $wr_10; ?>">
		        </label>
	        </div>
        </div>
	</section>
	<div class="margin-hr-10"></div>
    <?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) { ?>
    <section>
        <label class="label">태그 입력</label>
        <div class="input input-button">
            <i class="icon-prepend fas fa-tags"></i>
            <input type="text" name="tmp_tag" id="tmp_tag" size="50" maxlength="255">
            <b class="tooltip tooltip-top-left">관련 태그를 입력 후, TAB키를 누르시면 쉽게 태그를 추가할 수 있습니다.</b>
            <div class="button"><input type="button" class="add_tags"><i class="fas fa-plus"></i> 태그입력</div>
        </div>
        <div id="tag-box">
            <div id="tag-cloud">
            <?php if (is_array($wr_tags)) { ?>
            <?php foreach ($wr_tags as $key => $value) { ?>
                <div id="tag_box_<?php echo $key; ?>"><?php echo $value; ?> <i class="fas fa-times" onclick="del_tags('<?php echo $value; ?>','<?php echo $key; ?>');"></i></div>
            <?php } ?>
            <?php } ?>
            </div>
        </div>
        <input type="hidden" name="wr_tag" id="wr_tag" value="<?php echo $write['wr_tag']; ?>">
        <input type="hidden" name="del_tag" id="del_tag" value="">
    </section>
    <div class="margin-hr-10"></div>
    <?php } ?>
    <section>
        <div class="wr_content">
            <div id="write-option">
                <div class="panel panel-default">
                    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                    <a class="write-option-btn" data-toggle="collapse" data-parent="#write-option" href="#collapse-video-wr"><i class="fas fa-play-circle"></i> 동영상</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                    <a class="write-option-btn" data-toggle="collapse" data-parent="#write-option" href="#collapse-sound-wr"><i class="fab fa-soundcloud"></i> 사운드클라우드</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
                    <a class="write-option-btn pull-right emoticon" data-vbtype="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL;?>/board/emoticon.php"><i class="far fa-smile"></i> 이모티콘</a>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                    <div id="collapse-video-wr" class="panel-collapse collapse">
                        <div class="write-collapse-box">
                            <div class="input input-button">
                                <input type="text" id="video_url" placeholder="동영상주소 입력">
                                <div class="button"><input type="button" id="btn_video" onclick="return false;">적용하기</div>
                            </div>
                            <div class="note">
                                <span class="color-red">*</span> <a href="#" data-toggle="modal" data-target="#modal_video_note"><u>지원 동영상 서비스 목록 보기</u></a>
                            </div>
                            <div id="modal_video_note" class="modal fade">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4 class="modal-title"><i class="fas fa-play-circle color-grey"></i> <strong>지원 동영상 서비스 목록</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-list-eb">
                                                <table class="table font-size-12">
                                                    <thead>
                                                        <tr><th>서비스명</th><th>URL 주소</th></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><th>유튜브</th><td><a href="https://www.youtube.com" target="_blank">https://www.youtube.com</a></td></tr>
                                                        <tr><th>비메오</th><td><a href="https://vimeo.com" target="_blank">https://vimeo.com</a></td></tr>
                                                        <tr><th>네이버 TV</th><td><a href="http://tv.naver.com" target="_blank">http://tv.naver.com</a></td></tr>
                                                        <tr><th>카카오 TV</th><td><a href="https://tv.kakao.com" target="_blank">https://tv.kakao.com</a></td></tr>
                                                        <tr><th>테드</th><td><a href="https://www.ted.com" target="_blank">https://www.ted.com</a></td></tr>
                                                        <tr><th>판도라</th><td><a href="http://www.pandora.tv" target="_blank">http://www.pandora.tv</a></td></tr>
                                                        <tr><th>데일리모션</th><td><a href="https://www.dailymotion.com" target="_blank">https://www.dailymotion.com</a></td></tr>
                                                        <tr><th>슬라이더쉐어</th><td><a href="https://www.slideshare.net" target="_blank">https://www.slideshare.net</a></td></tr>
                                                        <tr><th>유쿠</th><td><a href="http://www.youku.com" target="_blank">http://www.youku.com</a></td></tr>
                                                        <tr><th>iQiyi</th><td><a href="http://www.iqiyi.com" target="_blank">http://www.iqiyi.com</a></td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn-e btn-e-lg btn-e-dark" type="button"><i class="fas fa-times"></i> 닫기</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                    <div id="collapse-sound-wr" class="panel-collapse collapse">
                        <div class="write-collapse-box">
                            <div class="input input-button">
                                <input type="text" id="scloud_url" placeholder="사운드클라우드 음원주소 입력">
                                <div class="button"><input type="button" id="btn_scloud" onclick="return false;">적용하기</div>
                            </div>
                            <div class="note">사운드클라우드 바로가기 : <a href="https://soundcloud.com/" target="_blank">https://soundcloud.com/</a></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="margin-bottom-15"></div>
            <label class="label" for="wr_content">본문 내용</label>
            <div class="wr_content  <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
                <div class="write-edit-wrap">
                    <?php /* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 */ ?>
                    <?php echo $editor_html; ?>
                </div>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
            </div>
        </div>
    </section>
    <div class="margin-hr-10"></div>
    <section>
        <?php $wl_cnt = count($wr_link); ?>
        <?php for ($i=1; $i<=$wl_cnt; $i++) { ?>
        <div class="row">
            <div class="col col-12">
                <label class="label">관련 링크 <?php echo $i; ?></label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="wr_link<?php echo $i; ?>" value="<?php if ($w == 'u') echo $wr_link[$i]['link_val']; ?>" id="wr_link<?php echo $i; ?>" class="form-control" size="50">
                    <b class="tooltip tooltip-top-right">링크주소를 입력 해 주세요.</b>
                </label>
            </div>
        </div>
        <div class="margin-hr-10"></div>
        <?php } ?>
    </section>
    <section>
        <?php $wf_cnt = count($wr_file); ?>
        <?php for ($i=0; $i<$wf_cnt; $i++) { ?>
        <div class="row">
            <div class="col col-12">
                <label class="label">파일 <?php echo $i+1; ?> 업로드</label>
                <label for="file" class="input input-file">
                    <div class="button bg-color-light-grey"><input type="file" id="bf_file_<?php echo $i+1 ?>" name="bf_file[]" value="사진선택" title="파일첨부 <?php echo $i+1; ?> : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" onchange="this.parentNode.nextSibling.value = this.value">파일<?php echo $i+1; ?> 선택</div><input type="text" readonly>
                </label>
            </div>
            <?php if ($is_file_content) { ?>
            <div class="col col-12 margin-top-10">
                <label class="input">
                    <i class="icon-append fas fa-question-circle"></i>
                    <input type="text" name="bf_content[]" value="<?php if ($w == 'u') echo $wr_file[$i]['bf_content']; ?>" class="form-control" size="50" placeholder="파일<?php echo $i+1; ?> 설명">
                    <b class="tooltip tooltip-top-right">파일 <?php echo $i+1; ?> 설명을 입력 해 주세요.</b>
                </label>
            </div>
            <div class="clearfix"></div>
            <?php } ?>
            <?php if ($w=='u' && $wr_file[$i]['file']) { ?>
            <div class="col col-6">
                <label for="bf_file_del<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="bf_file_del<?php echo $i; ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $wr_file[$i]['source'];?> (<?php echo $wr_file[$i]['size']; ?>) 파일삭제</label>
            </div>
            <?php } ?>
        </div>
        <div class="margin-hr-10"></div>
        <?php } ?>
    </section>
    <?php if ($is_use_captcha) { ?>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"><?php echo $captcha_html; ?></div>
        <div class="margin-bottom-20"></div>
    </section>
    <?php } ?>

    <div class="text-center">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn-e btn-e-xlg btn-e-red">
        <a href="<?php echo $infinite_wmode ? "javascript:history.go(-1)": get_eyoom_pretty_url($bo_table, '', $qstr); ?>" class="btn-e btn-e-xlg btn-e-dark">취소</a>
    </div>
    </form>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert/sweetalert.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'])) { ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=KR&key=<?php echo $config['cf_map_google_id']; ?>"></script>
<?php } ?>
<script>
<?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
function initialize() {
	var map = new google.maps.Map(document.getElementById('gmap_write_srh_canvas'), {
		center: {lat: 37.571211, lng: 126.976952},
		zoom: 7,
		scrollwheel: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var markers = [];
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	var infowindow = new google.maps.InfoWindow();
	var marker = new google.maps.Marker({
		map: map
	});
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker);
	});
	map.addListener('bounds_changed', function() {
		searchBox.setBounds(map.getBounds());
	});
	google.maps.event.addListener(searchBox, 'places_changed', function() {
		var places = searchBox.getPlaces();
		if (places.length == 0) {
			return;
		}
		markers.forEach(function(marker) {
			marker.setMap(null);
		});
		markers = [];
		var bounds = new google.maps.LatLngBounds();
		places.forEach(function(place) {
			var icon = {
				url: place.icon,
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25)
			};
			markers.push(new google.maps.Marker({
				map: map,
				title: place.name,
				position: place.geometry.location
			}));
			if (place.geometry.viewport) {
				bounds.union(place.geometry.viewport);
			} else {
				bounds.extend(place.geometry.location);
			}
			marker.setPlace(/** @type {!google.maps.Place} */ ({
				placeId: place.place_id,
				location: place.geometry.location
			}));
			marker.setVisible(true);
		    infowindow.setContent('<div class="font-size-11"><strong>' + place.name + '</strong><br>' +
		        '장소 ID: ' + place.place_id + '<br>' +
		        place.formatted_address + '</div>');
		    infowindow.open(map, marker);
		    document.getElementById('wr_6').value = place.formatted_address;
		    document.getElementById('wr_7').value = place.geometry.location.lat();
		    document.getElementById('wr_8').value = place.geometry.location.lng();
		});
		map.fitBounds(bounds);
		map.setZoom(16);
	});
}
google.maps.event.addDomListener(window, 'load', initialize);
<?php } ?>

$(document).ready(function(){
    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
    $(".emoticon").venobox();
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
    // 동영상 추가
    $("#btn_video").click(function(){
        var v_url = $("#video_url").val();
        if (!v_url){
            swal({
                title: "중요!",
                text: "동영상 주소를 입력해 주세요.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
        } else {
            set_textarea_contents('video',v_url);
        }
        $("#video_url").val('');
    });
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
    // 사운드크라우드 추가
    $("#btn_scloud").click(function(){
        var s_url = $("#scloud_url").val();
        if (!s_url){
            swal({
                title: "중요!",
                text: "사운드클라우드 주소를 입력해 주세요.",
                confirmButtonColor: "#FF4848",
                type: "error",
                confirmButtonText: "확인"
            });
        } else {
            set_textarea_contents('sound',s_url);
        }
    });
    $("#scloud_url").val('');
    <?php } ?>
});

<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
function set_emoticon(emoticon) {
    var type='emoticon';
    set_textarea_contents(type,emoticon);
}
<?php } ?>

function set_textarea_contents(type,value) {
    var type_text = '';
    var content = '';
    switch(type) {
        case 'emoticon': type_text = '이모티콘'; break;
        case 'video': type_text = '동영상'; break;
        case 'code': type_text = 'code'; break;
        case 'sound': type_text = 'soundcloud'; break;
        case 'map': type_text = '지도'; break;
    }
    if (type_text != 'code') {
        content = '{'+type_text+':'+value+'}';
    } else {
        content = '{code:'+value+'}<br><br>{/code}<br>'
    }
    if (g5_editor.indexOf('ckeditor')!=-1 && !g5_is_mobile) {
        CKEDITOR.instances.wr_content.insertHtml(content);
    } else if (g5_editor.indexOf('smarteditor')!=-1 && !g5_is_mobile) {
        oEditors.getById["wr_content"].exec("PASTE_HTML", [content]);
    } else {
        var wr_html = $("#wr_content").val();
        var wr_emo = content;
        wr_html += wr_emo;
        $("#wr_content").val(wr_html);
    }
}

<?php if ($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});
<?php } ?>

function html_auto_br(obj) {
    if (obj.checked) {
        swal({
            title: "자동 줄바꿈",
            text: "자동 줄바꿈을 하시겠습니까?\n자동 줄바꿈은 게시물 내용 중 줄바뀐 곳을 <br>태그로 변환하는 기능입니다.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#FDAB29",
            confirmButtonText: "승인",
            cancelButtonText: "취소",
            closeOnConfirm: true,
            closeOnCancel: true
        },
        function(isConfirm){
            if (isConfirm) {
                obj.value = "html2";
            } else {
                obj.value = "html1";
            }
        });
    }
    else
        obj.value = "";
}

function fwrite_submit(f) {
    <?php echo $editor_js; ?> // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        swal({
            html: true,
            title: "알림!",
            text: "제목에 금지단어 '<strong class='color-red'>"+subject+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        swal({
            html: true,
            title: "알림!",
            text: "내용에 금지단어 '<strong class='color-red'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#FDAB29",
            type: "warning",
            confirmButtonText: "확인"
        });
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                swal({
                    html: true,
                    title: "알림!",
                    text: "내용은 <strong class='color-red'>"+char_min+"</strong> 글자 이상 쓰셔야 합니다.",
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                swal({
                    html: true,
                    title: "알림!",
                    text: "내용은 <strong class='color-red'>"+char_max+"</strong> 글자 이하로 쓰셔야 합니다.",
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                return false;
            }
        }
    }

    <?php echo $captcha_js; ?> // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}

<?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) { ?>
var tag_size = '<?php echo (count($wr_tags) > 0)? count($wr_tags):0; ?>';
$(function(){
    $(".add_tags").click(function(){
        add_tags();
    });
    $("#tmp_tag").blur(function(){
        var tag = $('#tmp_tag').val();
        if (tag) add_tags();
    });

    var add_tags = function() {
        var obj = $('#tmp_tag');
        var tag = obj.val();
        if (!tag) {
            obj.focus();
        } else {
            <?php if (!$is_admin) { ?>
            var count = $('#tag-cloud > div:not(.blind)').length;
            var limit = '<?php echo $eyoom_board['bo_tag_limit'];?>';
            var max = parseInt(limit)-1;
            if (count > max) {
                swal({
                    html: true,
                    title: "알림!",
                    text: "태그는 <strong class='color-red'>"+limit+"</strong> 개까지 등록가능합니다.",
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                obj.val('');
                obj.focus();
                return;
            }
            <?php } ?>
            var duplicate = false;
            $('#tag-cloud > div:not(.blind)').each(function(){
                if ($(this).text().trim() == tag) {
                    duplicate = true;
                }
            });
            if (duplicate) {
                swal({
                    title: "알림!",
                    text: "중복된 태그입니다.",
                    confirmButtonColor: "#FDAB29",
                    type: "warning",
                    confirmButtonText: "확인"
                });
                obj.val('');
                obj.focus();
                return;
            }
            var tag_html = $('#tag-cloud').html();
            tag_html += '<div id="tag_box_'+tag_size+'">'+tag+' <i class="fas fa-close" onclick="del_tags(\''+tag+'\',\''+tag_size+'\');"></i></div>';
            $('#tag-cloud').html(tag_html);

            var add_tags = $('#wr_tag').val();
            if (add_tags) {
                add_tags += ',';
            }
            add_tags += tag;
            $('#wr_tag').val(add_tags);

            tag_size++;
            obj.val('');
            obj.focus();
        }
    }
});

function del_tags(tag, num) {
    var del_tags = $('#del_tag').val();
    if (del_tags) {
        del_tags += ',';
    }
    del_tags += tag;
    $('#del_tag').val(del_tags);
    $('#tag_box_'+num).addClass('blind');
}
<?php } ?>

<?php if ($is_admin) { ?>
$(function() {
    $(".set_bo_skin").change(function() {
        var skin = $(this).val();
        if (!skin) {
            swal({
                title: "알림",
                text: '스킨을 선택해 주세요.',
                confirmButtonColor: "#FF4848",
                type: "warning",
                confirmButtonText: "확인"
            });
        } else {
            $.post('<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php', { bo_table: "<?php echo $bo_table; ?>", skin: skin });
            document.location.reload();
        }
    });
});
<?php } ?>
</script>