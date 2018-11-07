<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebcontents_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/venobox/venobox.css" type="text/css" media="screen">',0);
?>

<style>
.admin-ebcontents-form .ebcontents-image {max-width:300px;background:#fafafa}
.admin-ebcontents-form .write-option-btn {float:left;padding:0 15px;margin-bottom:3px;height:24px;line-height:24px;color:#fff;text-align:center;font-size:11px}
.admin-ebcontents-form .write-option-btn:nth-child(odd) {background:#59595B}
.admin-ebcontents-form .write-option-btn:nth-child(even) {background:#676769}
.admin-ebcontents-form .write-option-btn:hover {color:#fff;opacity:0.8}
.admin-ebcontents-form .write-collapse-box {margin-top:10px;background:#f8f8f8;border:1px solid #d5d5d5;padding:15px 10px}
</style>

<div class="admin-ebcontents-form">
    <div class="adm-headline margin-top-30">
        <h3>EB배너 등록/수정</h3>
    </div>

    <form name="fcontentsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fcontentsform_submit(this);" enctype="multipart/form-data" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $ci_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="ci_no" id="ci_no" value="<?php echo $ec_item['ci_no']; ?>">
    <input type="hidden" name="ec_code" id="ec_code" value="<?php echo $ec_item['ec_code'] ? $ec_item['ec_code']:$ec_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-30">
        <header><strong><i class="fas fa-caret-right"></i> EB콘텐츠 아이템 설정</strong></header>
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
                            <label for="ec_code" class="input form-width-250px">
                                <input type="text" name="ec_code" id="ec_code" value="<?php echo $ec['ec_code'] ? $ec['ec_code']: time(); ?>" readonly required>
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
                                <div id="substitution_code" class="eb-clipboard-box-cont"><strong>&lt;?php echo eb_contents('<?php echo $ec['ec_code'] ? $ec['ec_code']: time(); ?>'); ?&gt;</strong></div>
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
                                <label for="ec_state_1" class="radio"><input type="radio" name="ec_state" id="ec_state_1" value="1" <?php echo $ec['ec_state'] == '1' || !$ec['ec_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="ec_state_2" class="radio"><input type="radio" name="ec_state" id="ec_state_2" value="2" <?php echo $ec['ec_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 출력여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">EB콘텐츠 마스터 명칭</label>
                        </th>
                        <td colspan="3">
                            <label for="ec_name" class="input">
                                <input type="text" name="ec_name" id="ec_name" value="<?php echo get_text($ec['ec_name']); ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 회사소개, CEO인사말, 메인 포트폴리오, etc</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="ci_state_1" class="radio"><input type="radio" name="ci_state" id="ci_state_1" value="1" <?php echo $ec_item['ci_state'] == '1' || !$ec_item['ci_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="ci_state_2" class="radio"><input type="radio" name="ci_state" id="ci_state_2" value="2" <?php echo $ec_item['ci_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 콘텐츠 아이템의 출력여부를 설정합니다.</div>
                        </td>
                    <?php if (G5_IS_MOBILE) { ?>
                    </tr>
                    <tr>
                    <?php } ?>
                        <th class="table-form-th border-left-th">
                            <label class="label">출력순서</label>
                        </th>
                        <td>
                            <label for="ci_sort" class="input form-width-250px">
                                <i class="icon-append fas fa-sort-numeric-down"></i>
                                <input type="text" name="ci_sort" id="ci_sort" value="<?php echo $ec_item['ci_sort'] ? $ec_item['ci_sort']: $ec_max_sort; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">보기권한 설정</label>
                        </th>
                        <td colspan="3">
                            <label for="ci_view_level" class="select form-width-150px">
                                <?php echo get_member_level_select('ci_view_level', 1, 10, $ec_item['ci_view_level']); ?><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">노출 방식</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <label for="ci_period_1" class="radio"><input type="radio" name="ci_period" id="ci_period_1" value="1" class="period-type" <?php echo $ec_item['ci_period'] == '1' || !$ec_item['ci_period'] ? 'checked':''; ?>><i></i> 무제한 방식</label>
                                <label for="ci_period_2" class="radio"><input type="radio" name="ci_period" id="ci_period_2" value="2" class="period-type" <?php echo $ec_item['ci_period'] == '2' ? 'checked':''; ?>><i></i> 기간제 방식</label>
                            </div>
                        </td>
                    </tr>
                    <tr id="date-period">
                        <th class="table-form-th">
                            <label class="label">노출 기간</label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label for="ci_start" class="input form-width-250px">
                                        <i class="icon-prepend text-width">시작</i>
                                        <i class="icon-append far fa-calendar-alt"></i>
                                        <input type="text" name="ci_start" id="ci_start" value="<?php echo $ec_item['ci_start']; ?>" class="text-right">
                                    </label>
                                </span>
                                <span>
                                    <label for="ci_start" class="input form-width-250px">
                                        <i class="icon-prepend text-width">종료</i>
                                        <i class="icon-append far fa-calendar-alt"></i>
                                        <input type="text" name="ci_end" id="ci_end" value="<?php echo $ec_item['ci_end']; ?>" class="text-right">
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> 노출 시작일과 종료일은 기간제 방식에만 적용됩니다.</div>
                        </td>
                    </tr>
                    <?php for($i=0; $i<$ec['ec_ext_cnt']; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">텍스트 필드 #<?php echo $i+1; ?></label>
                        </th>
                        <td colspan="3">
                            <label for="ci_subject_<?php echo $i+1; ?>" class="input">
                                <input type="text" name="ci_subject[]" id="ci_subject_<?php echo $i+1; ?>" value="<?php echo $ec_item['ci_subject_'.($i+1)]; ?>">
                            </label>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">설명글 #1</label>
                        </th>
                        <td colspan="3">
                            <label for="ci_text_1" class="textarea">
                                <textarea name="ci_text[]" id="ci_text_1" rows="4"><?php echo $ec_item['ci_text_1']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">설명글 #2</label>
                        </th>
                        <td colspan="3">
                            <label for="ci_text_2" class="textarea">
                                <textarea name="ci_text[]" id="ci_text_2" rows="4"><?php echo $ec_item['ci_text_2']; ?></textarea>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">내용</label>
                        </th>
                        <td colspan="3">
                            <div id="write-option">
                                <div class="panel panel-default">
                                    <a class="write-option-btn" data-toggle="collapse" data-parent="#write-option" href="#collapse-video-wr"><i class="fas fa-play-circle"></i> 동영상</a>
                                    <a class="write-option-btn" data-toggle="collapse" data-parent="#write-option" href="#collapse-sound-wr"><i class="fab fa-soundcloud"></i> 사운드클라우드</a>
                                    <?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
                                    <a class="write-option-btn" data-toggle="collapse" data-parent="#write-option" href="#collapse-map-wr"><i class="fas fa-map-marker-alt"></i> 지도</a>
                                    <?php } ?>
                                    <a class="write-option-btn pull-right emoticon" data-vbtype="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL;?>/board/emoticon.php"><i class="far fa-smile"></i> 이모티콘</a>
                                    <div class="clearfix"></div>

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
                                    <div id="collapse-sound-wr" class="panel-collapse collapse">
                                        <div class="write-collapse-box">
                                            <div class="input input-button">
                                                <input type="text" id="scloud_url" placeholder="사운드클라우드 음원주소 입력">
                                                <div class="button"><input type="button" id="btn_scloud" onclick="return false;">적용하기</div>
                                            </div>
                                            <div class="note">사운드클라우드 바로가기 : <a href="https://soundcloud.com/" target="_blank">https://soundcloud.com/</a></div>
                                        </div>
                                    </div>
                                    <div id="collapse-map-wr" class="panel-collapse collapse">
                                        <?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
                                        <div class="write-collapse-box">
                                            <div class="row">
                                                <div class="col col-6 md-margin-bottom-10">
                                                    <div class="input input-button">
                                                        <i class="icon-prepend fas fa-question-circle"></i>
                                                        <input type="text" name="map_zip" id="map_zip" size="5" maxlength="6" readonly>
                                                        <b class="tooltip tooltip-top-left">우편번호 - 우측 <span class="color-yellow">주소검색</span> 클릭하여 검색</b>
                                                        <div class="button"><input type="button" onclick="win_zip('fcontentsform', 'map_zip', 'map_addr1', 'map_addr2', 'map_addr3', 'map_addr_jibeon');"><i class="fas fa-search"></i> 주소검색</div>
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
                                            <div class="margin-bottom-10"></div>
                                            <div class="row">
                                                <div class="col col-12">
                                                    <label class="input">
                                                        <input type="text" name="map_addr1" id="map_addr1" size="50">
                                                    </label>
                                                    <div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-6">
                                                    <label class="input">
                                                        <input type="text" name="map_addr2" id="map_addr2" size="50">
                                                    </label>
                                                    <div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
                                                </div>
                                                <div class="col col-6">
                                                    <label class="input">
                                                        <input type="text" name="map_name" id="map_name" size="50">
                                                    </label>
                                                    <div class="note margin-bottom-10"><strong>Note:</strong> 장소명</div>
                                                </div>
                                            </div>
                                            <div class="margin-hr-10"></div>
                                            <div class="row">
                                                <div class="col col-12">
                                                    <input type="hidden" name="map_addr3" id="map_addr3" value="">
                                                    <input type="hidden" name="map_addr_jibeon" value="">
                                                    <div class="text-center">
                                                        <button type="button" class="btn-e btn-e-lg btn-e-red" id="btn_map" onclick="return false;">적용하기</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <label for="ci_content" class="textarea">
                                <?php echo editor_html("ci_content", stripslashes($ci['ci_content'])); ?>
                            </label>
                        </td>
                    </tr>
                    <?php for($i=0; $i<$ec['ec_link_cnt']; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">연결주소 [링크] #<?php echo $i+1; ?></label>
                        </th>
                        <td colspan="3">
                            <div class="inline-group">
                                <span>
                                    <label for="ci_link_<?php echo $i; ?>" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="ci_link[<?php echo $i; ?>]" id="ci_link_<?php echo $i; ?>" value="<?php echo $ci_link[$i]; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="ci_target_<?php echo $i; ?>" class="select form-width-150px">
                                        <select name="ci_target[<?php echo $i; ?>]" id="ci_target_<?php echo $i; ?>" required>
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $ci_target[$i] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $ci_target[$i] == '_self' || !$ci_target[$i] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB콘텐츠 아이템에 사용할 링크주소를 입력해 주세요.</div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php for($i=0; $i<$ec['ec_image_cnt']; $i++) { ?>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이미지 #<?php echo $i+1; ?></label>
                        </th>
                        <td colspan="3">
                            <span class="input input-file form-width-350px">
                                <div class="button"><input type="file" name="ci_img[<?php echo $i; ?>]" id="ci_img_<?php echo $i; ?>" onchange="this.parentNode.nextSibling.value = this.value">이미지파일 찾기</div><input type="text" readonly="">
                            </span>
                            <?php if ($ci_img[$i]) { ?>
                            <div class="ci_img_info">
                                <label for="ci_img_del_<?php echo $i; ?>" class="checkbox"><input type="checkbox" id="ci_img_del_<?php echo $i; ?>" name="ci_img_del[<?php echo $i; ?>]" value="1"><i></i><?php echo $ci_img[$i]; ?> 파일삭제</label>
                                <input type="hidden" name="del_img_name[<?php echo $i; ?>]" value="<?php echo $ci_img[$i]; ?>">
                                <div class="thumbnail ebcontents-image">
                                    <div class="thumb">
                                        <img src="<?php echo $ci_url[$i]; ?>">
                                        <div class="caption-overflow">
                                            <span>
                                                <a href="<?php echo $ci_url[$i]; ?>" class="btn-e btn-e-default btn-e-lg btn-e-brd"><i class="fas fa-plus color-white"></i></a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="note"><strong>Note:</strong> EB콘텐츠 아이템에 사용할 링크주소를 입력해 주세요.</div>
                        </td>
                    </tr>
                    <?php } ?>
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
</div>

<div id="map_canvas"></div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/venobox/venobox.min.js"></script>

<?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
<?php if ($config['cf_map_google_id']) { ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config['cf_map_google_id']; ?>" async defer></script>
<?php } ?>
<?php if ($config['cf_map_naver_id']) { ?>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=<?php echo $config['cf_map_naver_id']; ?>&submodules=geocoder"></script>
<?php } ?>
<?php if ($config['cf_map_daum_id']) { ?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $config['cf_map_daum_id']; ?>&libraries=services"></script>
<?php } ?>
<?php } ?>
<script>
$(document).ready(function(){
    $(".emoticon").venobox();

    // 동영상 추가
    $("#btn_video").click(function(){
        var v_url = $("#video_url").val();
        if (!v_url){
            alert('동영상 주소를 입력해 주세요.');
        } else {
            set_textarea_contents('video',v_url);
        }
        $("#video_url").val('');
    });

    // 사운드크라우드 추가
    $("#btn_scloud").click(function(){
        var s_url = $("#scloud_url").val();
        if (!s_url){
            alert('사운드클라우드 주소를 입력해 주세요.');
        } else {
            set_textarea_contents('sound',s_url);
        }
    });
    $("#scloud_url").val('');

    // 지도 추가
    $("#btn_map").click(function(){
        var map_type = $("input[name='map_type']:checked").val();
        var map_addr1 = $("#map_addr1").val();
        var map_addr2 = $("#map_addr2").val();
        var map_name = $("#map_name").val();
        set_map_address(map_type, map_addr1, map_addr2, map_name);
    });
});

function set_emoticon(emoticon) {
    var type='emoticon';
    set_textarea_contents(type,emoticon);
}

<?php if ($config['cf_map_google_id'] || $config['cf_map_naver_id'] || $config['cf_map_daum_id']) { ?>
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
            alert('잘못된 주소입니다.');
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
            alert('잘못된 주소입니다.');
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
    var g5_editor = '<?php echo $config['cf_editor']; ?>';
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
        CKEDITOR.instances.ci_content.insertHtml(content);
    } else if (g5_editor.indexOf('smarteditor')!=-1 && !g5_is_mobile) {
        oEditors.getById["ci_content"].exec("PASTE_HTML", [content]);
    } else {
        var wr_html = $("#ci_content").val();
        var wr_emo = content;
        wr_html += wr_emo;
        $("#ci_content").val(wr_html);
    }
}

$(document).ready(function(){
    $(".emoticon").venobox();

    $('#ci_start').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#ci_end').datepicker('option', 'minDate', selectedDate);
        }
    });
    $('#ci_end').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        prevText: '<i class="fas fa-angle-left"></i>',
        nextText: '<i class="fas fa-angle-right"></i>',
        showMonthAfterYear: true,
        monthNames: ['년 1월','년 2월','년 3월','년 4월','년 5월','년 6월','년 7월','년 8월','년 9월','년 10월','년 11월','년 12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        onSelect: function(selectedDate){
            $('#ci_start').datepicker('option', 'maxDate', selectedDate);
        }
    });
});

$(function() {
    var ptype = '<?php echo $ec_item['ci_period']; ?>';
    if (!ptype) ptype = '1';
    period_showhide(ptype);

    $(".period-type").click(function() {
        var type = $(this).val();
        period_showhide(type);
    });
});

function period_showhide(type) {
    switch(type) {
        case '1': $("#date-period").hide(); break;
        case '2': $("#date-period").show(); break;
    }
}

function fcontentsform_submit(f) {

    if ($(':radio[name="ci_period"]:checked').val() == '2') {
        if ( !($('#ci_start').val() && $('#ci_end').val()) ) {
            alert('기간제로 선택할 경우, 시작일과 종료일은 필수항목입니다.');
            if (!$('#ci_start').val()) {
                $('#ci_start').focus();
            } else if (!$('#ci_end').val()) {
                $('#ci_end').focus();
            }
            return false;
        }
    }

    <?php echo get_editor_js('ci_content'); ?>

    return true;
}

$(document).ready(function() {
    $('.ebcontents-image').magnificPopup({
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
