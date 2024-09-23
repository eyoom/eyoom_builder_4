<?php
/**
 * skin file : /theme/THEME_NAME/skin/board/basic/write.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/sweetalert2/sweetalert2.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/venobox/venobox.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/eyoom-form/plugins/jquery-clockpicker/jquery.clockpicker.min.css" type="text/css" media="screen">',0);
if ($config['cf_editor'] == 'tuieditor') echo tuieditor_resource();
?>

<style>
.board-write {font-size:.9375rem}
.board-write .board-setup {position:relative;border:1px solid #d5d5d5;height:38px;margin-bottom:20px}
.board-write .board-setup .select {position:absolute;top:-1px;left:-1px;display:inline-block;width:200px}
.board-write .board-setup-btn-box {position:absolute;top:-1px;right:-1px;display:inline-block;width:420px}
.board-write .board-setup-btn {float:left;width:25%;height:38px;line-height:38px;color:#fff;text-align:center;font-size:.8125rem}
.board-write .board-setup-btn:nth-child(odd) {background-color:#000}
.board-write .board-setup-btn:nth-child(even) {background-color:#3c3c3e}
.board-write .board-setup-btn:hover {opacity:0.8}
.board-write .board-write-title {position:relative;border-bottom:1px solid #959595;padding-bottom:15px;margin-bottom:15px}
.board-write .blind {position:absolute;top:-10px;left:-100000px;display:none}
.board-write .write-edit-wrap #wr_content {display:block;width:100%;min-height:200px;padding:6px 10px;outline:none;border-width:1px;border-style:solid;border-radius:0;background:#FFF;color:#353535;appearance:normal;-moz-appearance:none;-webkit-appearance:none;resize:vertical}
.board-write .write-option-btn {float:left;padding:0 15px;margin-bottom:3px;height:32px;line-height:32px;color:#fff;text-align:center;font-size:.8125rem}
.board-write .write-option-btn:nth-child(odd) {background:#000}
.board-write .write-option-btn:nth-child(even) {background:#3c3c3e}
.board-write .write-option-btn:hover {color:#fff;opacity:0.8}
.board-write .write-collapse-box {margin:10px 0;background:#f8f8f8;border:1px solid #d5d5d5;padding:15px 10px}
.board-write #modal_video_note .table-list-eb .table thead>tr>th {text-align:left}
.board-write .l-h-38 {line-height:38px}
.board-write .poll-tabs .nav-link {padding:10px 20px;border-radius:0;color:#000}
.board-write .poll-tabs .nav-link.active {font-weight:700}
.board-write .poll-panel .tab-content {border:1px solid #dee2e6;border-top:0;padding:15px;background-color:#fff}
/* Auto Save */
.autosave-btn {position:absolute;top:0;right:0}
#autosave_wrapper {position:relative}
#autosave_pop {display:none;z-index:10;position:absolute;top:0;right:0;padding:8px;width:320px;height:auto !important;height:180px;max-height:250px;border:2px solid #959595;background:#fff;box-shadow:0 1px 8px rgba(0, 0, 0, 0.2);overflow-y:scroll}
html.no-overflowscrolling #autosave_pop {height:auto;max-height:10000px !important}
#autosave_pop div {text-align:right}
#autosave_pop button {margin:0;padding:0;border:0;background:transparent;margin-left:10px}
#autosave_pop ul {margin:10px 0;padding:0;border-top:1px solid #e9e9e9;list-style:none}
#autosave_pop li {padding:7px 0;border-bottom:1px solid #e9e9e9;zoom:1;font-size:.75rem}
#autosave_pop li:after {display:block;visibility:hidden;clear:both;content:""}
#autosave_pop a {display:block;float:left}
#autosave_pop span {display:block;float:right}
#autosave_pop .autosave_heading {text-align:left}
#autosave_pop strong {font-size:.8125rem}
#autosave_pop .fa-times {position:absolute;top:10px;right:15px}
.autosave_close {cursor:pointer}
.autosave_content {display:none}
/* Tag */
#tag-box {position:relative;border:1px dashed #c5c5c5;min-height:47px;padding:10px;background:#fafafa;margin-top:15px}
#tag-box:before {content:"태그 박스";display:block;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:.8125rem;color:#d5d5d5}
#tag-cloud div {position:relative;display:inline-block;line-height:1;background:#676769;padding:5px 10px;margin:2px 3px;font-size:.9375rem;color:#fff;border-radius:2px;z-index:1}
#tag-cloud div i {cursor:pointer;margin-left:5px}
/* Ckeditor */
.board-write a.cke_button {padding:2px 5px}
.board-write a.cke_button_on {padding:1px 4px}
.board-write a.cke_button_off:hover, .board-write a.cke_button_off:focus, .board-write a.cke_button_off:active {padding:1px 4px}
/* Smart Editor */
.cke_sc {margin-bottom:10px}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px}
.cke_sc_def button {padding:3px 15px;background:#555555;color:#fff;border:none}
/* Map */
#map_canvas {width:1000px;height:400px;display:none}
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
            <?php if( $config['cf_eyoom_admin_theme'] != 'basic' ) { ?>
            <a href="<?php echo $bbs->board_config_url('copy'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo $bbs->board_config_url('basic'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo $bbs->board_config_url('addon'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> <?php echo $eyoom_board['cf_eyoom_admin_theme'] == 'basic' ? '추가기능': '확장기능'; ?></a>
            <a href="<?php echo $bbs->board_config_url('extend'); ?>"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
            <?php } else { ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_copy&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-clone"></i> 복제하기</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="fas fa-list-alt"></i> 기본설정</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=theme&amp;pid=board_form&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-list-alt"></i> 추가기능</a>
            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=board&amp;pid=board_extend&amp;w=u&amp;bo_table=<?php echo $bo_table; ?>&amp;wmode=1"  onclick="eb_admset_modal(this.href); return false;" class="board-setup-btn"><i class="far fa-plus-square"></i> 확장필드 (<?php echo number_format($board['bo_ex_cnt']); ?>)</a>
            <?php } ?>
        </span>
    </div>
    <?php } ?>

    <h5 class="board-write-title">
        <strong><?php echo $g5['title']; ?> <?php if ($eyoom_board['bo_table_scheduled']) { ?><small> - 대상게시판 : <?php echo $bo['bo_subject']; ?> [<?php echo $bo['bo_table']; ?>]</small><?php } ?></strong>
    </h5>

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
    <section>
        <div class="row">
            <?php if ($is_name) { ?>
            <div class="col col-3">
                <label for="wr_name" class="label">이름<strong class="sound_only">필수</strong></label>
                <label class="input required-mark m-b-10">
                    <i class="icon-append fas fa-user"></i>
                    <input type="text" name="wr_name" value="<?php echo $name; ?>" id="wr_name" required size="10" maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_password && !$is_admin) { ?>
            <div class="col col-3">
                <label for="wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
                <label class="input required-mark m-b-10">
                    <i class="icon-append fas fa-lock"></i>
                    <input type="password" name="wr_password" id="wr_password" required maxlength="20">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_email) { ?>
            <div class="col col-3">
                <label for="wr_email" class="label">이메일</label>
                <label class="input m-b-10">
                    <i class="icon-append fas fa-envelope"></i>
                    <input type="text" name="wr_email" value="<?php echo $email; ?>" id="wr_email" size="50" maxlength="100">
                </label>
            </div>
            <?php } ?>
            <?php if ($is_homepage) { ?>
            <div class="col col-3">
                <label for="wr_homepage" class="label">홈페이지</label>
                <label class="input m-b-10">
                    <i class="icon-append fas fa-home"></i>
                    <input type="text" name="wr_homepage" value="<?php echo $homepage; ?>" id="wr_homepage" size="50">
                </label>
            </div>
            <?php } ?>
        </div>
    </section>
    <?php } ?>
    <section>
        <div class="row">
            <?php if ($is_category) { ?>
            <div class="col col-4">
                <label class="select">
                    <select name="ca_name" id="ca_name" required class="form-control">
                        <option value="">분류 선택 - 필수</option>
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
                    <label for="wr_anonymous" class="checkbox"><input type="checkbox" id="wr_anonymous" name="wr_anonymous" value="1" <?php echo $wr_anonymous_checked; ?>><i></i><?php echo $eyoom['anonymous_title']; ?>글</label>
                    <?php } ?>

                    <?php if ($is_mail) { ?>
                    <label for="mail" class="checkbox"><input type="checkbox" id="mail" name="mail" value="mail" <?php echo $recv_email_checked; ?>><i></i>답변메일받기</label>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <?php if ($board['bo_use_approval'] && $is_admin && $w == 'u') { ?>
    <section>
        <div class="row">
            <div class="col col-4">
                <label class="label">상태설정</label>
                <label class="select">
                    <select name="wr_approval" id="wr_approval">
                        <option value="0" <?php echo $write['wr_approval'] == '0' || !$write['wr_approval'] ? 'selected': ''; ?>>미승인</option>
                        <option value="1" <?php echo $write['wr_approval'] == '1' ? 'selected': ''; ?>>승인</option>
                    </select><i></i>
                </label>
            </div>
        </div>
    </section>
    <?php } ?>
    <section>
        <div class="row">
            <div class="col col-12 md-m-b-10">
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
                        <button type="button" id="btn_autosave" class="btn-e btn-dark position-relative">임시 저장된 글 <span id="autosave_count" class="badge badge-crimson rounded"><?php echo $autosave_count; ?></span></button>
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
    <?php if ($eyoom['use_tag'] == 'y' && $eyoom_board['bo_use_tag'] == '1' && $member['mb_level'] >= $eyoom_board['bo_tag_level']) { ?>
    <section class="m-b-20">
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
    <?php } ?>
    <?php if ($eyoom_board['bo_use_scheduled'] == '1') { // 예약게시판 사용 ?>
    <section class="m-b-20">
        <div class="row">
            <div class="col col-6">
                <label class="label">예약 날짜</label>
                <div class="input">
                    <i class="icon-prepend far fa-calendar-alt"></i>
                    <input type="text" name="wr_scheduled_date" id="wr_scheduled_date" class="required" value="<?php echo $wr_scheduled_date; ?>" maxlength="255">
                </div>
            </div>
            <div class="col col-6">
                <label class="label">공개 시간</label>
                <div class="input">
                    <i class="icon-prepend far fa-clock"></i>
                    <input type="text" name="wr_scheduled_time" id="wr_scheduled_time" class="clockpicker required" value="<?php echo $wr_scheduled_time; ?>" maxlength="255">
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <section>
        <div class="wr_content">
            <div id="write_option">
                <div class="panel panel-default">
                    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                    <a class="write-option-btn" data-bs-toggle="collapse" href="#collapse-video-wr"><i class="fas fa-play-circle"></i> 동영상</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                    <a class="write-option-btn" data-bs-toggle="collapse" href="#collapse-sound-wr"><i class="fab fa-soundcloud"></i> 사운드클라우드</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
                    <a class="write-option-btn" data-bs-toggle="collapse" href="#collapse-map-wr"><i class="fas fa-map-marker-alt"></i> 지도</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_poll'] == '1') { ?>
                    <a class="write-option-btn" data-bs-toggle="collapse" href="#collapse-poll-wr"><i class="fas fa-poll"></i> 투표</a>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
                    <a class="write-option-btn float-end emoticon" data-vbtype="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL;?>/board/emoticon.php"><i class="far fa-smile"></i> 이모티콘</a>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
                    <div id="collapse-video-wr" class="panel-collapse collapse" data-bs-parent="#write_option">
                        <div class="write-collapse-box">
                            <div class="input input-button">
                                <input type="text" id="video_url" placeholder="동영상주소 입력">
                                <div class="button"><input type="button" id="btn_video" onclick="return false;">적용하기</div>
                            </div>
                            <div class="note">
                                <span class="text-crimson">*</span> <a href="#" data-bs-toggle="modal" data-bs-target="#modal_video_note"><u>지원 동영상 서비스 목록 보기</u></a>
                            </div>
                            <div id="modal_video_note" class="modal fade" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-s-20r"><i class="fas fa-play-circle text-gray m-r-7"></i><strong>지원 동영상 서비스 목록</strong></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-list-eb">
                                                <table class="table">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_soundcloud'] == '1') { ?>
                    <div id="collapse-sound-wr" class="panel-collapse collapse" data-bs-parent="#write_option">
                        <div class="write-collapse-box">
                            <div class="input input-button">
                                <input type="text" id="scloud_url" placeholder="사운드클라우드 음원주소 입력">
                                <div class="button"><input type="button" id="btn_scloud" onclick="return false;">적용하기</div>
                            </div>
                            <div class="note">사운드클라우드 바로가기 : <a href="https://soundcloud.com/" target="_blank">https://soundcloud.com/</a></div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
                    <div id="collapse-map-wr" class="panel-collapse collapse" data-bs-parent="#write_option">
                        <?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
                        <div class="write-collapse-box">
                            <div class="row">
                                <div class="col col-6 md-m-b-10">
                                    <div class="input input-button">
                                        <i class="icon-prepend fas fa-question-circle"></i>
                                        <input type="text" name="map_zip" id="map_zip" size="5" maxlength="6" readonly>
                                        <b class="tooltip tooltip-top-left">우편번호 - 우측 <span class="text-orange">주소검색</span> 클릭하여 검색</b>
                                        <div class="button"><input type="button" onclick="win_zip('fwrite', 'map_zip', 'map_addr1', 'map_addr2', 'map_addr3', 'map_addr_jibeon');"><i class="fas fa-search"></i> 주소검색</div>
                                    </div>
                                </div>
                                <div class="col col-6 inline-group">
                                    <?php if ($config['cf_map_google_id']) { ?>
                                    <label class="radio" for="map_type_1">
                                        <input type="radio" name="map_type" id="map_type_1" value="1" checked><i class="rounded-x"></i> Google지도
                                    </label>
                                    <?php } ?>
                                    <?php if ($config['cf_map_naver_id']) { ?>
                                    <label class="radio" for="map_type_2">
                                        <input type="radio" name="map_type" id="map_type_2" value="2" <?php echo !$config['cf_map_google_id'] ? 'checked':''; ?>><i class="rounded-x"></i> 네이버지도
                                    </label>
                                    <?php } ?>
                                    <?php if ($config['cf_map_daum_id']) { ?>
                                    <label class="radio" for="map_type_3">
                                        <input type="radio" name="map_type" id="map_type_3" value="3" <?php echo !$config['cf_map_google_id'] && !$config['cf_map_naver_id'] ? 'checked':''; ?>><i class="rounded-x"></i> 다음지도
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="m-b-10"></div>
                            <div class="row">
                                <div class="col col-12">
                                    <label class="input">
                                        <input type="text" name="map_addr1" id="map_addr1" size="50">
                                    </label>
                                    <div class="note m-b-10"><strong>Note:</strong> 기본주소</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <label class="input">
                                        <input type="text" name="map_addr2" id="map_addr2" size="50">
                                    </label>
                                    <div class="note m-b-10"><strong>Note:</strong> 상세주소</div>
                                </div>
                                <div class="col col-6">
                                    <label class="input">
                                        <input type="text" name="map_name" id="map_name" size="50">
                                    </label>
                                    <div class="note m-b-10"><strong>Note:</strong> 장소명</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-12">
                                    <input type="hidden" name="map_addr3" id="map_addr3" value="">
                                    <input type="hidden" name="map_addr_jibeon" value="">
                                    <div class="text-center">
                                        <button type="button" class="btn-e btn-e-lg btn-e-crimson" id="btn_map" onclick="return false;">적용하기</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } else if ($is_admin) { ?>
                        <div class="write-collapse-box text-center">
                            <p><i class="fas fa-exclamation-circle"></i> 먼저 지도 API ID를 신청 및 설정을 하셔야 합니다.</p>
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&amp;pid=config_form#anc_cf_map" class="btn-e btn-e-xs btn-e-dark margin-left-5">지도 API 설정 바로가기</a>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>

                    <?php if ($eyoom_board['bo_use_addon_poll'] == '1') { // 투표 기능 ?>
                    <div id="collapse-poll-wr" class="panel-collapse collapse" data-bs-parent="#write_option">
                        <div class="write-collapse-box">
                            <input type="hidden" name="wr_poll_result" id="wr_poll_result" value="<?php echo $write['wr_poll_result']; ?>">
                            <input type="hidden" name="wr_poll_use" id="wr_poll_use" value="">
                            <label class="label" for="wr_content">투표 종료일</label>
                            <div class="row m-b-15">
                                <div class="col col-4">
                                    <label class="input m-b-0">
                                        <i class="icon-append far fa-calendar-alt"></i>
                                        <input type="text" name="poll_limit_date" value="<?php echo $poll_limit_date; ?>" id="poll_limit_date" size="10" placeholder="종료일">
                                    </label>
                                </div>
                                <div class="col col-8">
                                    <div class="inline-group d-flex">
                                        <span>
                                            <label class="select width-80px m-b-0">
                                                <select name="poll_limit_hour">
                                                    <?php for ($i=0; $i<=23; $i++) { $hour = (strlen($i) == 1) ? "0".$i: $i; ?>
                                                    <option value='<?php echo $hour; ?>' <?php echo $hour == $poll_limit_hour ? 'selected': ''; ?>><?php echo $hour; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </span>
                                        <span class="l-h-38 m-l-5 m-r-10">시</span>
                                        <span>
                                            <label class="select width-80px m-b-0">
                                                <select name="poll_limit_minute">
                                                    <?php for ($i=0; $i<=59; $i++) { $minute = (strlen($i) == 1) ? "0".$i: $i; ?>
                                                    <option value='<?php echo $minute; ?>' <?php echo $minute == $poll_limit_minute ? 'selected': ''; ?>><?php echo $minute; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </span>
                                        <span class="l-h-38 m-l-5 m-r-10">분</span>
                                        <span>
                                            <label class="select width-80px m-b-0">
                                                <select name="poll_limit_second">
                                                    <?php for ($i=0; $i<=59; $i++) { $second = (strlen($i) == 1) ? "0".$i: $i; ?>
                                                    <option value='<?php echo $second; ?>' <?php echo $second == $poll_limit_second ? 'selected': ''; ?>><?php echo $second; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </span>
                                        <span class="l-h-38 m-l-5">초</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="poll-panel">
                                <ul class="nav nav-tabs poll-tabs">
                                    <li>
                                        <a href="#poll_text" data-bs-toggle="tab" class="nav-link <?php if($w=='u') { echo $poll_type == 'text' ? 'active': 'disabled'; } else { echo 'active'; } ?>">텍스트 투표</a>
                                    </li>
                                    <li>
                                        <a href="#poll_image" data-bs-toggle="tab" class="nav-link <?php if($w=='u') { echo $poll_type == 'image' ? 'active': 'disabled'; } ?>">이미지 투표</a>
                                    </li>
                                    <li>
                                        <a href="#poll_video" data-bs-toggle="tab" class="nav-link <?php if($w=='u') { echo $poll_type == 'video' ? 'active': 'disabled'; } ?>">동영상 투표</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane in <?php echo $poll_type == 'text' ? 'active': ''; ?>" id="poll_text">
                                        <div class="poll-text">
                                            <div class="cont-text-bg m-b-15">
                                                <p class="bg-info">텍스트 투표는 아래처럼 입력해주세요.<br>예) 구글,네이버,다음,네이트</p>
                                            </div>
                                            <label class="input">
                                                <input type="text" id="wr_poll_text" name="wr_poll_text" placeholder="투표 항목 ,로 구분" value="<?php echo $write['wr_poll_text']; ?>">
                                            </label>
                                            <div class="note"><span class="text-crimson">*</span> <span class="text-black">텍스트 투표는 아래의 첨부 파일 무시하세요!</span></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane in <?php echo $poll_type == 'image' ? 'active': ''; ?>" id="poll_image">
                                        <div class="poll-image">
                                            <div class="cont-text-bg">
                                                <p class="bg-warning">아래의 파일업로드에 이미지 첨부를 하고 파일 설명에 각 투표 제목을 입력합니다.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane in <?php echo $poll_type == 'video' ? 'active': ''; ?>" id="poll_video">
                                        <div class="poll-video">
                                            <div class="cont-text-bg m-b-15">
                                                <p class="bg-info">동영상 주소를 <span class="text-black">파이프문자(|)</span>로 구분하여 아래 입력란에 입력해 주세요.<br>http(s)://동영상주소1|http(s)://동영상주소2<br>그리고 아래 파일 업로드에 이미지 첨부를 각 동영상에 맞게 차례대로 첨부합니다.<br>첨부 파일 설명에 각 투표 제목을 입력합니다.</p>
                                            </div>
                                            <div class="textarea m-b-0">
                                                <textarea id="wr_poll_video" name="wr_poll_video" placeholder="http://동영상주소|http://동영상주소 <-이런식으로 입력하세요. (이미지만 사용시 여긴 비워두세요.)" class="frm_input full_input"  rows="5" style="resize:vertical;"><?php echo $write['wr_poll_video']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 투표 설정 -->
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="m-b-15"></div>
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
    <section>
        <?php $wl_cnt = count((array)$wr_link); ?>
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
        <?php } ?>
    </section>
    <section>
        <?php $wf_cnt = count((array)$wr_file); ?>
        <?php for ($i=0; $i<$wf_cnt; $i++) { ?>
        <div class="row">
            <div class="col col-12">
                <label for="bf_file_<?php echo $i+1 ?>" class="label">파일 <?php echo $i+1; ?> 업로드</label>
                <label class="input">
                    <input type="file" class="form-control" id="bf_file_<?php echo $i+1 ?>" name="bf_file[]" value="사진선택">
                    <b class="tooltip tooltip-top-right">파일첨부 <?php echo $i+1; ?> : 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능</b>
                </label>
            </div>
            <?php if ($is_file_content) { ?>
            <div class="col col-12">
                <label class="input">
                    <i class="icon-append fas fa-question-circle"></i>
                    <input type="text" name="bf_content[]" value="<?php if ($w == 'u') echo $wr_file[$i]['bf_content']; ?>" class="form-control" size="50" placeholder="파일<?php echo $i+1; ?> 설명">
                    <b class="tooltip tooltip-top-right">파일 <?php echo $i+1; ?> 설명을 입력 해 주세요.</b>
                </label>
            </div>
            <div class="clearfix"></div>
            <?php } ?>
            <?php if ($w=='u' && $wr_file[$i]['file']) { ?>
            <div class="col col-12 m-b-15">
                <label for="bf_file_del<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="bf_file_del<?php echo $i; ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $wr_file[$i]['source'];?> (<?php echo $wr_file[$i]['size']; ?>) 파일삭제</label>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    <?php if ($is_use_captcha) { ?>
    <section>
        <label class="label">자동등록방지</label>
        <div class="vc-captcha"><?php echo $captcha_html; ?></div>
        <div class="m-b-20"></div>
    </section>
    <?php } ?>

    <div class="text-center">
        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn-e btn-e-xlg btn-e-navy">
        <a href="<?php echo $infinite_wmode ? "javascript:history.go(-1)": get_eyoom_pretty_url($bo_table, '', $qstr); ?>" class="btn-e btn-e-xlg btn-e-dark">취소</a>
    </div>
    </form>
</div>
<div id="map_canvas"></div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_poll'] == '1' || $eyoom_board['bo_use_scheduled'] == '1') { // datepicker 사용 ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<?php } ?>
<?php if ($eyoom_board['bo_use_addon_poll'] == '1') { // 투표 ?>
<script>
$(function(){
    // Bootstrap의 collapse 이벤트를 활용해 클래스 변경을 체크
    $('#collapse-poll-wr').on('shown.bs.collapse', function () {
        $('#wr_poll_use').val(1);
        $('#poll_limit_date').attr('required', 'required');
    });

    $('#collapse-poll-wr').on('hidden.bs.collapse', function () {
        $('#wr_poll_use').val(0);
        $('#poll_limit_date').removeAttr('required');
    });

    <?php /* 투표 : 달력 */ ?>
    $('#poll_limit_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
    });
});
</script>
<?php } // 투표 ?>
<?php if ($eyoom_board['bo_use_scheduled'] == '1') { // 예약게시판 ?>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-clockpicker/jquery.clockpicker.min.js"></script>
<script>
$(document).ready(function(){
    $('.clockpicker').clockpicker();
    
    $('#wr_scheduled_date').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '◁',
        nextText: '▷',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        minDate: 0 // This prevents past dates from being selected
    });
});
</script>
<?php } // 예약게시판 ?>
<script>
$(document).ready(function(){
    <?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
    $(".emoticon").venobox({
        framewidth : '800px',
        frameheight: '500px'
    });
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_video'] == '1') { ?>
    // 동영상 추가
    $("#btn_video").click(function(){
        var v_url = $("#video_url").val();
        if (!v_url){
            Swal.fire({
                title: "중요!",
                text: "동영상 주소를 입력해 주세요.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
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
            Swal.fire({
                title: "중요!",
                text: "사운드클라우드 주소를 입력해 주세요.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
        } else {
            set_textarea_contents('sound',s_url);
        }
    });
    $("#scloud_url").val('');
    <?php } ?>

    <?php if ($eyoom_board['bo_use_addon_map'] == '1') { ?>
    // 지도 추가
    $("#btn_map").click(function(){
        var map_type = $("input[name='map_type']:checked").val();
        var map_addr1 = $("#map_addr1").val();
        var map_addr2 = $("#map_addr2").val();
        var map_name = $("#map_name").val();
        set_map_address(map_type, map_addr1, map_addr2, map_name);
    });
    <?php } ?>
});

<?php if ($eyoom_board['bo_use_addon_emoticon'] == '1') { ?>
function set_emoticon(emoticon) {
    var type='emoticon';
    set_textarea_contents(type,emoticon);
}
<?php } ?>

<?php if ($eyoom_board['bo_use_addon_map'] == '1' && ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id'])) { ?>
function set_map_address(map_type, map_addr1, map_addr2, map_name) {
    switch(map_type) {
        case '1':
            <?php if ($config['cf_map_google_id']) { ?>
            set_map_google_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
        case '2':
            <?php if ($config['cf_map_naver_id']) { ?>
            set_map_naver_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
        case '3':
            <?php if ($config['cf_map_daum_id']) { ?>
            set_map_daum_address(map_type, map_addr1, map_addr2, map_name);
            <?php } ?>
            break;
    }
}

<?php if ($config['cf_map_google_id']) { ?>
function set_map_google_address(map_type, map_addr1, map_addr2, map_name) {
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 8,
        center: {lat: -34.397, lng: 150.644}
    });
    var geocoder = new google.maps.Geocoder();

    var address = map_addr1 + " " + map_addr2;
    geocoder.geocode({'address': map_addr1}, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var latlng = map.getCenter();
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        } else {
            Swal.fire({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
        }
    });
}
<?php }?>

<?php if ($config['cf_map_naver_id']) { ?>
function set_map_naver_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    naver.maps.Service.geocode({
        address: map_addr1
    }, function(status, response) {
        if (status !== naver.maps.Service.Status.OK) {
            Swal.fire({
                title: "중요!",
                text: "잘못된 주소입니다.",
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
        }

        var item = response.result.items[0],
            point = new naver.maps.Point(item.point.x, item.point.y);

        var latlng = '('+point.y+', '+point.x+')';
        set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
    });
}
<?php }?>

<?php if ($config['cf_map_daum_id']) { ?>
function set_map_daum_address(map_type, map_addr1, map_addr2, map_name) {
    var address = map_addr1 + " " + map_addr2;

    var mapContainer = document.getElementById('map_canvas'), // 지도를 표시할 div
        mapOption = {
            center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    // 지도를 생성합니다
    var map = new daum.maps.Map(mapContainer, mapOption);

    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new daum.maps.services.Geocoder();

    // 주소로 좌표를 검색합니다
    geocoder.addressSearch(map_addr1, function(result, status) {
        // 정상적으로 검색이 완료됐으면
        if (status === daum.maps.services.Status.OK) {
            var latlng = new daum.maps.LatLng(result[0].y, result[0].x);
            set_textarea_contents('map', map_type+'^|^'+address+'^|^'+map_name+'^|^'+latlng);
        }
    });
}
<?php }?>

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
    } else if (g5_editor.indexOf('tuieditor')!=-1 && !g5_is_mobile) {
        tui_wr_content.insertText(content);
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
        Swal.fire({
            title: "자동 줄바꿈",
            text: "자동 줄바꿈을 하시겠습니까? 자동 줄바꿈은 게시물 내용 중 줄바뀐 곳을 <br>태그로 변환하는 기능입니다.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#00897b",
            confirmButtonText: "승인",
            cancelButtonText: "취소"
        }).then((result) => {
            if (result.isConfirmed) {
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
        Swal.fire({
            title: "알림!",
            html: "제목에 금지단어 '<strong class='text-crimson'>"+subject+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#ab0000",
            icon: "error",
            confirmButtonText: "확인"
        });
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        Swal.fire({
            title: "알림!",
            text: "내용에 금지단어 '<strong class='text-crimson'>"+content+"</strong>' 단어가 포함되어있습니다.",
            confirmButtonColor: "#ab0000",
            icon: "error",
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
                Swal.fire({
                    title: "알림!",
                    html: "내용은 <strong class='text-crimson'>"+char_min+"</strong> 글자 이상 쓰셔야 합니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                Swal.fire({
                    title: "알림!",
                    html: "내용은 <strong class='text-crimson'>"+char_max+"</strong> 글자 이하로 쓰셔야 합니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "error",
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
var tag_size = '<?php echo (count((array)$wr_tags) > 0)? count((array)$wr_tags):0; ?>';
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
                Swal.fire({
                    title: "알림!",
                    html: "태그는 <strong class='text-crimson'>"+limit+"</strong> 개까지 등록가능합니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "warning",
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
                Swal.fire({
                    title: "알림!",
                    text: "중복된 태그입니다.",
                    confirmButtonColor: "#ab0000",
                    icon: "error",
                    confirmButtonText: "확인"
                });
                obj.val('');
                obj.focus();
                return;
            }
            var tag_html = $('#tag-cloud').html();
            tag_html += '<div id="tag_box_'+tag_size+'">'+tag+' <i class="fas fa-times" onclick="del_tags(\''+tag+'\',\''+tag_size+'\');"></i></div>';
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
            Swal.fire({
                title: "알림",
                text: '스킨을 선택해 주세요.',
                confirmButtonColor: "#ab0000",
                icon: "warning",
                confirmButtonText: "확인"
            });
        } else {
            var bo_table = '<?php echo $bo_table; ?>';
            var url = '<?php echo EYOOM_CORE_URL; ?>/board/set_bo_skin.php';
            $.post(url, { bo_table: bo_table, skin: skin }, function() {
                document.location.href = '<?php echo str_replace('&amp;','&', get_pretty_url($bo_table));?>';
            });
        }
    });
});
<?php } ?>
</script>