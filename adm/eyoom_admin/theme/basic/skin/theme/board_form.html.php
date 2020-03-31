<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/board_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-board-form .width-60px {width:60px;font-size:11px}
.admin-board-form .width-130px {width:130px;font-size:11px}
@media (min-width: 1100px) {
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:13px;font-weight:bold;padding:8px 10px}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {z-index:1;border:1px solid #000;border-top:1px solid #DE2600;color:#DE2600}
    .pg-anchor-in.tab-e2 .tab-bottom-line {position:relative;display:block;height:1px;background:#000;margin-bottom:20px}
}
@media (max-width: 1099px) {
    .pg-anchor-in {position:relative;overflow:hidden;margin-bottom:20px;border:1px solid #757575}
    .pg-anchor-in.tab-e2 .nav-tabs li {width:33.33333%;margin:0}
    .pg-anchor-in.tab-e2 .nav-tabs li a {font-size:12px;padding:6px 0;text-align:center;border-bottom:1px solid #d5d5d5;margin-right:0;font-weight:bold;background:#fff}
    .pg-anchor-in.tab-e2 .nav-tabs li.active a {border:0;border-bottom:1px solid #d5d5d5 !important;color:#DE2600;background:#fff1f0}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(1) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(2) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(4) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(5) a {border-right:1px solid #d5d5d5}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(7) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(8) a {border-right:1px solid #d5d5d5;border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .nav-tabs li:nth-child(9) a {border-bottom:0 !important}
    .pg-anchor-in.tab-e2 .tab-bottom-line {display:none}
}
</style>

<div class="admin-board-form">
    <div class="adm-headline">
        <h3>게시판 추가설정</h3>
    </div>

    <?php include_once(EYOOM_ADMIN_THEME_PATH . '/skin/theme/theme_head.html.php'); ?>

    <form name="fboardform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardform_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $board['bo_table']; ?>">
    <input type="hidden" name="gr_id" id="gr_id" value="<?php echo $board['gr_id']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div id="anc_bo_common">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_common'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 기본설정 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">레이아웃 디자인</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="use_shop_skin_1" class="radio"><input type="radio" name="use_shop_skin" id="use_shop_skin_1" value="n" <?php echo $eyoom_board['use_shop_skin']=='n' ? 'checked': ''; ?>><i></i> 커뮤니티 디자인 레이아웃 적용</label>
                                    <label for="use_shop_skin_2" class="radio"><input type="radio" name="use_shop_skin" id="use_shop_skin_2" value="y" <?php echo $eyoom_board['use_shop_skin']=='y' ? 'checked': ''; ?>><i></i> 쇼핑몰 디자인 레이아웃 적용 [<b class="color-red"><?php echo $this_theme; ?></b> 테마의 쇼핑몰 스킨 레이아웃]</label>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group">
                                    <label for="chk_grp_device" class="checkbox"><input type="checkbox" name="chk_grp_device" value="1" id="chk_grp_device"><i></i>그룹적용</label>
                                    <label for="chk_all_device" class="checkbox"><input type="checkbox" name="chk_all_device" value="1" id="chk_all_device"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시판 스킨 선택</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="use_gnu_skin_1" class="radio"><input type="radio" name="use_gnu_skin" id="use_gnu_skin_1" value="n" <?php echo $eyoom_board['use_gnu_skin']=='n' ? 'checked': ''; ?>><i></i> 이윰빌더 스킨 사용</label>
                                    <label for="use_gnu_skin_2" class="radio"><input type="radio" name="use_gnu_skin" id="use_gnu_skin_2" value="y" <?php echo $eyoom_board['use_gnu_skin']=='y' ? 'checked': ''; ?>><i></i> 그누보드 스킨 사용</label>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_gnu_skin" class="checkbox"><input type="checkbox" name="chk_grp_gnu_skin" id="chk_grp_gnu_skin"><i></i>그룹적용</label>
                                    <label for="chk_all_gnu_skin" class="checkbox"><input type="checkbox" name="chk_all_gnu_skin" id="chk_all_gnu_skin"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">이윰 게시판 스킨</label>
                            </th>
                            <td>
                                <label for="bo_skin" class="select form-width-250px">
                                    <select name="bo_skin" id="bo_skin">
                                        <option value="">선택</option>
                                        <?php foreach ($bo_skin as $skin) { ?>
                                        <option value="<?php echo $skin; ?>" <?php echo $eyoom_board['bo_skin'] == $skin ? 'selected': ''; ?>><?php echo $skin; ?></option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 이윰빌더 스킨을 사용할 경우, 선택한 게시판 스킨이 적용됩니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_bo_skin" class="checkbox"><input type="checkbox" name="chk_grp_bo_skin" id="chk_grp_bo_skin"><i></i>그룹적용</label>
                                    <label for="chk_all_bo_skin" class="checkbox"><input type="checkbox" name="chk_all_bo_skin" id="chk_all_bo_skin"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">프로필 사진 사용여부</label>
                            </th>
                            <td>
                                <label for="bo_use_profile_photo" class="checkbox">
                                    <input type="checkbox" name="bo_use_profile_photo" id="bo_use_profile_photo" value="1" <?php echo $eyoom_board['bo_use_profile_photo'] == '1' ? 'checked': ''; ?>><i></i> 사용 <span class="note"> (체크하시면 게시물 작성자의 프로필 사진이 출력됩니다.)</span>
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_profile_photo" class="checkbox"><input type="checkbox" name="chk_grp_profile_photo" id="chk_grp_profile_photo"><i></i>그룹적용</label>
                                    <label for="chk_all_profile_photo" class="checkbox"><input type="checkbox" name="chk_all_profile_photo" id="chk_all_profile_photo"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">작성일 표기방식</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="bo_sel_date_type_1" class="radio"><input type="radio" name="bo_sel_date_type" id="bo_sel_date_type_1" value="1" <?php echo $eyoom_board['bo_sel_date_type']=='1' ? 'checked': ''; ?>><i></i> 초/분/시간 형식 <span class="note"> 예) 10초전 or 2분전</span></label>
                                    <label for="bo_sel_date_type_2" class="radio"><input type="radio" name="bo_sel_date_type" id="bo_sel_date_type_2" value="2" <?php echo $eyoom_board['bo_sel_date_type']=='2' ? 'checked': ''; ?>><i></i> 날짜 형식 <span class="note"> 예) YYYY-mm-dd HH:ii:ss</span></label>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_date_type" class="checkbox"><input type="checkbox" name="chk_grp_date_type" id="chk_grp_date_type"><i></i>그룹적용</label>
                                    <label for="chk_all_date_type" class="checkbox"><input type="checkbox" name="chk_all_date_type" id="chk_all_date_type"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <?php if(0) { //베스트 최근글 사용 숨김 처리 시작 (해당 기능 불필요) ?>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">베스트 최근글 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_hotgul" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_hotgul" id="bo_use_hotgul" value="1" <?php echo $eyoom_board['bo_use_hotgul']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 체크하시면 게시물 목록 하단에 최근 베스트글 목록을 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_hotgul" class="checkbox"><input type="checkbox" name="chk_grp_hotgul" id="chk_grp_hotgul"><i></i>그룹적용</label>
                                    <label for="chk_all_hotgul" class="checkbox"><input type="checkbox" name="chk_all_hotgul" id="chk_all_hotgul"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <?php } // 베스트 최근글 사용 숨김 처리 끝 ?>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">익명글쓰기 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_anonymous" class="select form-width-250px">
                                    <select name="bo_use_anonymous" id="bo_use_anonymous">
                                        <option value="" <?php echo $eyoom_board['bo_use_anonymous']=='' ? 'selected': ''; ?>>사용하지 않음</option>
                                        <option value="1" <?php echo $eyoom_board['bo_use_anonymous']=='1' ? 'selected': ''; ?>>체크박스</option>
                                        <option value="2" <?php echo $eyoom_board['bo_use_anonymous']=='2' ? 'selected': ''; ?>>무조건</option>
                                    </select><i></i>
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_anonymous" class="checkbox"><input type="checkbox" name="chk_grp_anonymous" id="chk_grp_anonymous"><i></i>그룹적용</label>
                                    <label for="chk_all_anonymous" class="checkbox"><input type="checkbox" name="chk_all_anonymous" id="chk_all_anonymous"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">목록에서 무한스크롤 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_infinite_scroll" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_infinite_scroll" id="bo_use_infinite_scroll" value="1" <?php echo $eyoom_board['bo_use_infinite_scroll']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 체크하시면 무한스크롤 기능이 활성화 됩니다. basic 게시판은 제외</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_infinite_scroll" class="checkbox"><input type="checkbox" name="chk_grp_infinite_scroll" id="chk_grp_infinite_scroll"><i></i>그룹적용</label>
                                    <label for="chk_all_infinite_scroll" class="checkbox"><input type="checkbox" name="chk_all_infinite_scroll" id="chk_all_infinite_scroll"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">목록에서 이미지 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_list_image" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_list_image" id="bo_use_list_image" value="1" <?php echo $eyoom_board['bo_use_list_image']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 목록에서 썸네일 이미지를 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_list_image" class="checkbox"><input type="checkbox" name="chk_grp_list_image" id="chk_grp_list_image"><i></i>그룹적용</label>
                                    <label for="chk_all_list_image" class="checkbox"><input type="checkbox" name="chk_all_list_image" id="chk_all_list_image"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">목록에서 동영상이미지 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_video_photo" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_video_photo" id="bo_use_video_photo" value="1" <?php echo $eyoom_board['bo_use_video_photo']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 목록에서 동영상의 썸네일 이미지를 자동으로 생성하여 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_video_photo" class="checkbox"><input type="checkbox" name="chk_grp_video_photo" id="chk_grp_video_photo"><i></i>그룹적용</label>
                                    <label for="chk_all_video_photo" class="checkbox"><input type="checkbox" name="chk_all_video_photo" id="chk_all_video_photo"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">내용에서 추천 회원 보기 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_good_member" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_good_member" id="bo_use_good_member" value="1" <?php echo $eyoom_board['bo_use_good_member']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 내용에서 게시물을 추천한 회원을 리스트로 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_good_member" class="checkbox"><input type="checkbox" name="chk_grp_good_member" id="chk_grp_good_member"><i></i>그룹적용</label>
                                    <label for="chk_all_good_member" class="checkbox"><input type="checkbox" name="chk_all_good_member" id="chk_all_good_member"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">내용에서 비추천 회원 보기 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_nogood_member" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_nogood_member" id="bo_use_nogood_member" value="1" <?php echo $eyoom_board['bo_use_nogood_member']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 내용에서 게시물을 비추천한 회원을 리스트로 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_nogood_member" class="checkbox"><input type="checkbox" name="chk_grp_nogood_member" id="chk_grp_nogood_member"><i></i>그룹적용</label>
                                    <label for="chk_all_nogood_member" class="checkbox"><input type="checkbox" name="chk_all_nogood_member" id="chk_all_nogood_member"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">외부이미지 썸네일기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_extimg" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_extimg" id="bo_use_extimg" value="1" <?php echo $eyoom_board['bo_use_extimg']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 외부 이미지를 게시물에 추가했을 경우, 자동으로 썸네일을 생성하여 목록에 출력합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_extimg" class="checkbox"><input type="checkbox" name="chk_grp_extimg" id="chk_grp_extimg"><i></i>그룹적용</label>
                                    <label for="chk_all_extimg" class="checkbox"><input type="checkbox" name="chk_all_extimg" id="chk_all_extimg"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">파일다운로드 수수료율 설정</label>
                            </th>
                            <td>
                                <label for="download_fee_ratio" class="input form-width-250px">
                                    <i class="icon-append">%</i>
                                    <input type="text" name="download_fee_ratio" id="download_fee_ratio" value="<?php echo $eyoom_board['download_fee_ratio']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 공유자료실 스킨 (share)의 다운로드 수수료율 지정</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_download_ratio" class="checkbox"><input type="checkbox" name="chk_grp_download_ratio" id="chk_grp_download_ratio"><i></i>그룹적용</label>
                                    <label for="chk_all_download_ratio" class="checkbox"><input type="checkbox" name="chk_all_download_ratio" id="chk_all_download_ratio"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">하루 게시물 등록 가능 회수 설정</label>
                            </th>
                            <td>
                                <label for="bo_write_limit" class="input form-width-250px">
                                    <i class="icon-append">회</i>
                                    <input type="text" name="bo_write_limit" id="bo_write_limit" value="<?php echo $eyoom_board['bo_write_limit']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 회원당 하루에 글쓰기 가능 회수를 지정합니다. 0일 경우는 제한이 없습니다.</div>
                                <div class="note"><strong>Note:</strong> 회수 제한을 설정하면 비회원은 글을 작성할 수 없습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_write_limit" class="checkbox"><input type="checkbox" name="chk_grp_write_limit" id="chk_grp_write_limit"><i></i>그룹적용</label>
                                    <label for="chk_all_write_limit" class="checkbox"><input type="checkbox" name="chk_all_write_limit" id="chk_all_write_limit"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_blind">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_blind'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 신고/블라인드 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 신고/블라인드 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_yellow_card" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_yellow_card" id="bo_use_yellow_card" value="1" <?php echo $eyoom_board['bo_use_yellow_card']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 체크하시면 스팸 및 광고성 게시물의 신고 및 블라인드 기능이 활성화 됩니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_yellow_card" class="checkbox"><input type="checkbox" name="chk_grp_yellow_card" id="chk_grp_yellow_card"><i></i>그룹적용</label>
                                    <label for="chk_all_yellow_card" class="checkbox"><input type="checkbox" name="chk_all_yellow_card" id="chk_all_yellow_card"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">자동 블라인드 조건 설정</label>
                            </th>
                            <td>
                                <label for="bo_blind_limit" class="input form-width-250px">
                                    <i class="icon-append">건</i>
                                    <input type="text" name="bo_blind_limit" id="bo_blind_limit" value="<?php echo $eyoom_board['bo_blind_limit']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 게시물의 신고건수가 설정된 숫자 이상이면 게시물을 자동으로 블라인드 처리합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_blind_limit" class="checkbox"><input type="checkbox" name="chk_grp_blind_limit" id="chk_grp_blind_limit"><i></i>그룹적용</label>
                                    <label for="chk_all_blind_limit" class="checkbox"><input type="checkbox" name="chk_all_blind_limit" id="chk_all_blind_limit"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">블라인드 게시물 보기 권한</label>
                            </th>
                            <td>
                                <label for="bo_blind_view" class="select form-width-250px">
                                    <?php echo get_member_level_select('bo_blind_view', 1, 10, $eyoom_board['bo_blind_view']); ?><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 선택한 그누레벨 이상의 회원은 블라인드된 게시물을 볼 수 있습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_blind_view" class="checkbox"><input type="checkbox" name="chk_grp_blind_view" id="chk_grp_blind_view"><i></i>그룹적용</label>
                                    <label for="chk_all_blind_view" class="checkbox"><input type="checkbox" name="chk_all_blind_view" id="chk_all_blind_view"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 바로 블라인드 설정권한</label>
                            </th>
                            <td>
                                <label for="bo_blind_direct" class="select form-width-250px">
                                    <?php echo get_member_level_select('bo_blind_direct', 1, 10, $eyoom_board['bo_blind_direct']); ?><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 선택한 그누레벨 이상의 회원은 블라인드된 게시물을 볼 수 있습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_blind_direct" class="checkbox"><input type="checkbox" name="chk_grp_blind_direct" id="chk_grp_blind_direct"><i></i>그룹적용</label>
                                    <label for="chk_all_blind_direct" class="checkbox"><input type="checkbox" name="chk_all_blind_direct" id="chk_all_blind_direct"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_rating">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_rating'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 별점기능 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 별점 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_rating" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_rating" id="bo_use_rating" value="1" <?php echo $eyoom_board['bo_use_rating']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 체크를 해제하시면 목록에서 별점 표시 사용이 체크되어 있어도 목록에 별점 기능이 출력되지 않습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating" class="checkbox"><input type="checkbox" name="chk_grp_rating" id="chk_grp_rating"><i></i>그룹적용</label>
                                    <label for="chk_all_rating" class="checkbox"><input type="checkbox" name="chk_all_rating" id="chk_all_rating"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">별점 평가 참가 포인트</label>
                            </th>
                            <td>
                                <label for="bo_rating_point" class="input form-width-250px">
                                    <i class="icon-append">점</i>
                                    <input type="input" name="bo_rating_point" id="bo_rating_point" value="<?php echo $eyoom_board['bo_rating_point'] ? $eyoom_board['bo_rating_point']: 0; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 별점 평가에 참가한 회원에게 제공하는 <?php echo $levelset['gnu_name']; ?>입니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating_point" class="checkbox"><input type="checkbox" name="chk_grp_rating_point" id="chk_grp_rating_point"><i></i>그룹적용</label>
                                    <label for="chk_all_rating_point" class="checkbox"><input type="checkbox" name="chk_all_rating_point" id="chk_all_rating_point"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">목록에서 별점 표시 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_rating_list" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_rating_list" id="bo_use_rating_list" value="1" <?php echo $eyoom_board['bo_use_rating_list']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 게시판 리스트 페이지에서 별점 평점내역을 출력할지 설정합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating_list" class="checkbox"><input type="checkbox" name="chk_grp_rating_list" id="chk_grp_rating_list"><i></i>그룹적용</label>
                                    <label for="chk_all_rating_list" class="checkbox"><input type="checkbox" name="chk_all_rating_list" id="chk_all_rating_list"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">참여회원 정보표시 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_rating_member" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_rating_member" id="bo_use_rating_member" value="1" <?php echo $eyoom_board['bo_use_rating_member']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 별점 평가에 참여한 회원들의 정보를 출력할지 설정합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating_member" class="checkbox"><input type="checkbox" name="chk_grp_rating_member" id="chk_grp_rating_member"><i></i>그룹적용</label>
                                    <label for="chk_all_rating_member" class="checkbox"><input type="checkbox" name="chk_all_rating_member" id="chk_all_rating_member"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">참여회원 평점 공개</label>
                            </th>
                            <td>
                                <label for="bo_use_rating_score" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_rating_score" id="bo_use_rating_score" value="1" <?php echo $eyoom_board['bo_use_rating_score']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 참여회원의 평점을 공개할 것인지 설정합니다. 참여회원 정보표시를 사용할 경우에만 적용됩니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating_score" class="checkbox"><input type="checkbox" name="chk_grp_rating_score" id="chk_grp_rating_score"><i></i>그룹적용</label>
                                    <label for="chk_all_rating_score" class="checkbox"><input type="checkbox" name="chk_all_rating_score" id="chk_all_rating_score"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">120자 한줄평 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_rating_comment" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_rating_comment" id="bo_use_rating_comment" value="1" <?php echo $eyoom_board['bo_use_rating_comment']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <div class="note"><strong>Note:</strong> 120자 이내의 한줄평을 사용할 것인지 설정합니다. (무료 게시판 스킨에서는 제공하지 않는 기능입니다.)</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_rating_comment" class="checkbox"><input type="checkbox" name="chk_grp_rating_comment" id="chk_grp_rating_comment"><i></i>그룹적용</label>
                                    <label for="chk_all_rating_comment" class="checkbox"><input type="checkbox" name="chk_all_rating_comment" id="chk_all_rating_comment"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_tag">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_tag'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 태그기능 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 태그 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_tag" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_tag" id="bo_use_tag" value="1" <?php echo $eyoom_board['bo_use_tag']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_use_tag" class="checkbox"><input type="checkbox" name="chk_grp_use_tag" id="chk_grp_use_tag"><i></i>그룹적용</label>
                                    <label for="chk_all_use_tag" class="checkbox"><input type="checkbox" name="chk_all_use_tag" id="chk_all_use_tag"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">글쓰기시 태그 작성 권한설정</label>
                            </th>
                            <td>
                                <label for="bo_tag_level" class="select form-width-250px">
                                    <?php echo get_member_level_select('bo_tag_level', 1, 10, $eyoom_board['bo_tag_level']); ?><i></i>
                                </label>
                                <div class="note"><strong>Note:</strong> 게시판 글쓰기 권한과 같거나 높아야 합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_tag_level" class="checkbox"><input type="checkbox" name="chk_grp_tag_level" id="chk_grp_tag_level"><i></i>그룹적용</label>
                                    <label for="chk_all_tag_level" class="checkbox"><input type="checkbox" name="chk_all_tag_level" id="chk_all_tag_level"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">입력가능한 태그수</label>
                            </th>
                            <td>
                                <label for="bo_tag_limit" class="input form-width-250px">
                                    <i class="icon-append">건</i>
                                    <input type="text" name="bo_tag_limit" id="bo_tag_limit" value="<?php echo $eyoom_board['bo_tag_limit']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 지정한 숫자를 초과하여 태그를 입력할 수 없습니다. [관리자는 제한없음]</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_tag_limit" class="checkbox"><input type="checkbox" name="chk_grp_tag_limit" id="chk_grp_tag_limit"><i></i>그룹적용</label>
                                    <label for="chk_all_tag_limit" class="checkbox"><input type="checkbox" name="chk_all_tag_limit" id="chk_all_tag_limit"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_automove">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_automove'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 자동 이동/복사 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 자동 이동/복사 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_automove" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_automove" id="bo_use_automove" value="1" <?php echo $eyoom_board['bo_use_automove']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_use_automove" class="checkbox"><input type="checkbox" name="chk_grp_use_automove" id="chk_grp_use_automove"><i></i>그룹적용</label>
                                    <label for="chk_all_use_automove" class="checkbox"><input type="checkbox" name="chk_all_use_automove" id="chk_all_use_automove"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">게시물 자동 이동/복사 조건</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="bo_automove_type" class="select form-width-150px">
                                            <select name="bo_automove[type]" id="bo_automove_type">
                                                <option value="hit" <?php echo $bo_automove['type']=='hit' ? 'selected': ''; ?>>조회수가</option>
                                                <option value="good" <?php echo $bo_automove['type']=='good' ? 'selected': ''; ?>>추천수가</option>
                                                <option value="nogood" <?php echo $bo_automove['type']=='nogood' ? 'selected': ''; ?>>비추천수가</option>
                                            </select><i></i>
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_automove_count" class="input form-width-150px">
                                            <i class="icon-append width-60px">이상이면</i>
                                            <input type="text" name="bo_automove[count]" id="bo_automove_count" value="<?php echo $bo_automove['count'] ? $bo_automove['count']: '100'; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_automove_target" class="select form-width-300px">
                                            <select name="bo_automove[target]" id="bo_automove_target">
                                                <option value="">선택한 게시판으로</option>
                                                <?php foreach ($bo_list as $bo) { ?>
                                                <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo_automove['target'] == $bo['bo_table'] ? 'selected': ''; ?>><?php echo $bo['bo_subject']; ?> [<?php echo $bo['bo_table']; ?>] 으로</option>
                                                <?php } ?>
                                            </select><i></i>
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_automove_action" class="select form-width-200px">
                                            <select name="bo_automove[action]" id="bo_automove_action">
                                                <option value="move" <?php echo $bo_automove['action']=='move' ? 'selected': ''; ?>>이동합니다.</option>
                                                <option value="copy" <?php echo $bo_automove['action']=='copy' ? 'selected': ''; ?>>복사합니다.</option>
                                            </select><i></i>
                                        </label>
                                    </span>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_automove" class="checkbox"><input type="checkbox" name="chk_grp_automove" id="chk_grp_automove"><i></i>그룹적용</label>
                                    <label for="chk_all_automove" class="checkbox"><input type="checkbox" name="chk_all_automove" id="chk_all_automove"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_addon">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_addon'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 애드온 기능 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">이모티콘 추가 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_emoticon" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_emoticon" id="bo_use_addon_emoticon" value="1" <?php echo $eyoom_board['bo_use_addon_emoticon']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_emoticon" class="checkbox"><input type="checkbox" name="chk_grp_addon_emoticon" id="chk_grp_addon_emoticon"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_emoticon" class="checkbox"><input type="checkbox" name="chk_all_addon_emoticon" id="chk_all_addon_emoticon"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">동영상 추가 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_video" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_video" id="bo_use_addon_video" value="1" <?php echo $eyoom_board['bo_use_addon_video']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_video" class="checkbox"><input type="checkbox" name="chk_grp_addon_video" id="chk_grp_addon_video"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_video" class="checkbox"><input type="checkbox" name="chk_all_addon_video" id="chk_all_addon_video"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">댓글에 코드표시 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_coding" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_coding" id="bo_use_addon_coding" value="1" <?php echo $eyoom_board['bo_use_addon_coding']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_coding" class="checkbox"><input type="checkbox" name="chk_grp_addon_coding" id="chk_grp_addon_coding"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_coding" class="checkbox"><input type="checkbox" name="chk_all_addon_coding" id="chk_all_addon_coding"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">사운드클라우드 추가 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_soundcloud" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_soundcloud" id="bo_use_addon_soundcloud" value="1" <?php echo $eyoom_board['bo_use_addon_soundcloud']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_soundcloud" class="checkbox"><input type="checkbox" name="chk_grp_addon_soundcloud" id="chk_grp_addon_soundcloud"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_soundcloud" class="checkbox"><input type="checkbox" name="chk_all_addon_soundcloud" id="chk_all_addon_soundcloud"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">지도 추가 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_map" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_map" id="bo_use_addon_map" value="1" <?php echo $eyoom_board['bo_use_addon_map']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_map" class="checkbox"><input type="checkbox" name="chk_grp_addon_map" id="chk_grp_addon_map"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_map" class="checkbox"><input type="checkbox" name="chk_all_addon_map" id="chk_all_addon_map"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">댓글에 파일 추가 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_addon_cmtfile" class="checkbox">
                                    <input type="checkbox" name="bo_use_addon_cmtfile" id="bo_use_addon_cmtfile" value="1" <?php echo $eyoom_board['bo_use_addon_cmtfile']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                                <label for="bo_count_cmtfile" class="input form-width-150px">
                                    <i class="icon-append">개</i>
                                    <input type="input" name="bo_count_cmtfile" id="bo_count_cmtfile" value="<?php echo $eyoom_board['bo_count_cmtfile'] ? $eyoom_board['bo_count_cmtfile']: 1; ?>">
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_addon_cmtfile" class="checkbox"><input type="checkbox" name="chk_grp_addon_cmtfile" id="chk_grp_addon_cmtfile"><i></i>그룹적용</label>
                                    <label for="chk_all_addon_cmtfile" class="checkbox"><input type="checkbox" name="chk_all_addon_cmtfile" id="chk_all_addon_cmtfile"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_cmtbest">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_cmtbest'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 베스트 댓글 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">베스트 댓글 기능 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_cmt_best" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_cmt_best" id="bo_use_cmt_best" value="1" <?php echo $eyoom_board['bo_use_cmt_best']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_cmt_best" class="checkbox"><input type="checkbox" name="chk_grp_cmt_best" id="chk_grp_cmt_best"><i></i>그룹적용</label>
                                    <label for="chk_all_cmt_best" class="checkbox"><input type="checkbox" name="chk_all_cmt_best" id="chk_all_cmt_best"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">베스트 댓글 최소 추천수</label>
                            </th>
                            <td>
                                <label for="bo_cmt_best_min" class="input form-width-250px">
                                    <i class="icon-append">건</i>
                                    <input type="text" name="bo_cmt_best_min" id="bo_cmt_best_min" value="<?php echo $eyoom_board['bo_cmt_best_min']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정한 추천수 이상일 때, 베스트 댓글이 될 수 있습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_cmtbest_min" class="checkbox"><input type="checkbox" name="chk_grp_cmtbest_min" id="chk_grp_cmtbest_min"><i></i>그룹적용</label>
                                    <label for="chk_all_cmtbest_min" class="checkbox"><input type="checkbox" name="chk_all_cmtbest_min" id="chk_all_cmtbest_min"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">노출 베스트 댓글수</label>
                            </th>
                            <td>
                                <label for="bo_cmt_best_limit" class="input form-width-250px">
                                    <i class="icon-append">건</i>
                                    <input type="text" name="bo_cmt_best_limit" id="bo_cmt_best_limit" value="<?php echo $eyoom_board['bo_cmt_best_limit']; ?>">
                                </label>
                                <div class="note"><strong>Note:</strong> 설정한 건수만큼 베스트 댓글로 순위를 노출합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_cmtbest_limit" class="checkbox"><input type="checkbox" name="chk_grp_cmtbest_limit" id="chk_grp_cmtbest_limit"><i></i>그룹적용</label>
                                    <label for="chk_all_cmtbest_limit" class="checkbox"><input type="checkbox" name="chk_all_cmtbest_limit" id="chk_all_cmtbest_limit"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_exif">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_exif'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 이미지 EXIF [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">포토이미지 EXIF 정보보기 사용</label>
                            </th>
                            <td>
                                <label for="bo_use_exif" class="checkbox form-width-100px">
                                    <input type="checkbox" name="bo_use_exif" id="bo_use_exif" value="1" <?php echo $eyoom_board['bo_use_exif']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_exif" class="checkbox"><input type="checkbox" name="chk_grp_exif" id="chk_grp_exif"><i></i>그룹적용</label>
                                    <label for="chk_all_exif" class="checkbox"><input type="checkbox" name="chk_all_exif" id="chk_all_exif"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">EXIF 정보보기 상세설정</label>
                            </th>
                            <td>
                                <div class="row">
                                    <?php foreach ($exif_detail as $key => $item) { ?>
                                    <div class="col col-10">
                                        <div class="inline-group">
                                            <span>
                                                <a href="javascript:;" class="btn-e btn-e-md btn-e-default form-width-70px" onclick="return false;"><?php echo $exif->exif_item[$key]; ?></a>
                                            </span>
                                            <span>
                                                <label for="bo_exif_detail_<?php echo $key; ?>_item" class="input <?php if (!G5_IS_MOBILE) { ?>form-width-150px<?php } else { ?>form-width-100px<?php } ?>">
                                                    <input type="text" name="bo_exif_detail[<?php echo $key; ?>][item]" id="bo_exif_detail_<?php echo $key; ?>_item" value="<?php echo get_text($item['item']) ? get_text($item['item']): ''; ?>">
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-2">
                                        <label for="bo_exif_detail_<?php echo $key; ?>_use" class="checkbox form-width-100px">
                                            <input type="checkbox" name="bo_exif_detail[<?php echo $key; ?>][use]" id="bo_exif_detail_<?php echo $key; ?>_use" value="1" <?php echo $item['use']=='1' ? 'checked': ''; ?>><i></i> 보이기
                                        </label>
                                    </div>
                                    <div class="clearfix margin-bottom-5"></div>
                                    <?php } ?>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_exif_detail" class="checkbox"><input type="checkbox" name="chk_grp_exif_detail" id="chk_grp_exif_detail"><i></i>그룹적용</label>
                                    <label for="chk_all_exif_detail" class="checkbox"><input type="checkbox" name="chk_all_exif_detail" id="chk_all_exif_detail"><i></i>전체적용</label>
                                </div>
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

    <div id="anc_bo_cmtpoint">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_cmtpoint'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 댓글 <?php echo $levelset['gnu_name']; ?> 설정 [ 게시판명 : <span class="color-pink"><?php echo $board['bo_subject']; ?></span> ]</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12 margin-bottom-0"><i class="fas fa-info-circle"></i> <strong>중요</strong> : 영카트5를 이용하시고 <a href="<?php echo G5_ADMIN_URL; ?>/?dir=config&pid=config_form"><u><strong>포인트 사용</strong></u></a> 설정이 <strong class="color-red">[사용]</strong>으로 체크되어 있을 경우, 상품구매를 위해 결제 수단으로 사용될 수 있는 포인트입니다.</p>
                </div>
            </fieldset>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">댓글<?php echo $levelset['gnu_name']; ?> 설명</label>
                            </th>
                            <td>
                                <label for="bo_use_point_explain" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_point_explain" id="bo_use_point_explain" value="1" <?php echo $eyoom_board['bo_use_point_explain']=='1' ? 'checked': ''; ?>><i></i> 보이기
                                </label>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_point_explain" class="checkbox"><input type="checkbox" name="chk_grp_point_explain" id="chk_grp_point_explain"><i></i>그룹적용</label>
                                    <label for="chk_all_point_explain" class="checkbox"><input type="checkbox" name="chk_all_point_explain" id="chk_all_point_explain"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">댓글<?php echo $levelset['gnu_name']; ?> 적용 대상</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <label for="bo_cmtpoint_target_1" class="radio"><input type="radio" name="bo_cmtpoint_target" id="bo_cmtpoint_target_1" value="1" <?php echo $eyoom_board['bo_cmtpoint_target']=='1' ? 'checked': ''; ?>><i></i> 그누보드 포인트로 적립</label>
                                    <label for="bo_cmtpoint_target_2" class="radio"><input type="radio" name="bo_cmtpoint_target" id="bo_cmtpoint_target_2" value="2" <?php echo $eyoom_board['bo_cmtpoint_target']=='2' ? 'checked': ''; ?>><i></i> 이윰레벨 포인트로 적립</label>
                                </div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_cmtpoint_target" class="checkbox"><input type="checkbox" name="chk_grp_cmtpoint_target" id="chk_grp_cmtpoint_target"><i></i>그룹적용</label>
                                    <label for="chk_all_cmtpoint_target" class="checkbox"><input type="checkbox" name="chk_all_cmtpoint_target" id="chk_all_cmtpoint_target"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">첫 댓글 <?php echo $levelset['gnu_name']; ?></label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="bo_firstcmt_point" class="input form-width-150px">
                                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?>를</i>
                                            <input type="text" name="bo_firstcmt_point" id="bo_firstcmt_point" value="<?php echo $eyoom_board['bo_firstcmt_point']; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_firstcmt_point_type" class="select form-width-250px">
                                            <select name="bo_firstcmt_point_type" id="bo_firstcmt_point_type">
                                                <option value="1" <?php echo $eyoom_board['bo_firstcmt_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로 첫댓글 작성자에게 지급합니다.</option>
                                                <option value="2" <?php echo $eyoom_board['bo_firstcmt_point_type']=='2' ? 'selected': ''; ?>>고정으로 작성자에게 지급합니다.</option>
                                            </select><i></i>
                                        </label>
                                    </span>
                                </div>
                                <div class="note"><strong>Note:</strong> 게시물의 첫번째 댓글에 주는 <?php echo $levelset['gnu_name']; ?>입니다. 0으로 설정하시면 기능이 작동하지 않습니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_firstcmt_point" class="checkbox"><input type="checkbox" name="chk_grp_firstcmt_point" id="chk_grp_firstcmt_point"><i></i>그룹적용</label>
                                    <label for="chk_all_firstcmt_point" class="checkbox"><input type="checkbox" name="chk_all_firstcmt_point" id="chk_all_firstcmt_point"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">지뢰 <?php echo $levelset['gnu_name']; ?></label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="bo_bomb_point" class="input form-width-150px">
                                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?>를 </i>
                                            <input type="text" name="bo_bomb_point" id="bo_bomb_point" value="<?php echo $eyoom_board['bo_bomb_point']; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_bomb_point_type" class="select form-width-150px">
                                            <select name="bo_bomb_point_type" id="bo_bomb_point_type">
                                                <option value="1" <?php echo $eyoom_board['bo_bomb_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로</option>
                                                <option value="2" <?php echo $eyoom_board['bo_bomb_point_type']=='2' ? 'selected': ''; ?>>고정으로</option>
                                            </select><i></i>
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_bomb_point_limit" class="input form-width-250px">
                                            <i class="icon-append width-130px">개의 지뢰를 매설합니다.</i>
                                            <input type="text" name="bo_bomb_point_limit" id="bo_bomb_point_limit" value="<?php echo $eyoom_board['bo_bomb_point_limit']; ?>">
                                        </label>
                                    </span>
                                </div>
                                <div class="note"><strong>Note:</strong> 게시물이 작성이 되면 자동으로 <?php echo $levelset['gnu_name']; ?> 지뢰가 심어집니다. 지뢰 폭탄을 터트릴 경우 주어지는 포인트입니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_bomb_point" class="checkbox"><input type="checkbox" name="chk_grp_bomb_point" id="chk_grp_bomb_point"><i></i>그룹적용</label>
                                    <label for="chk_all_bomb_point" class="checkbox"><input type="checkbox" name="chk_all_bomb_point" id="chk_all_bomb_point"><i></i>전체적용</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">럭키 <?php echo $levelset['gnu_name']; ?></label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="bo_lucky_point" class="input form-width-150px">
                                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?>를 </i>
                                            <input type="text" name="bo_lucky_point" id="bo_lucky_point" value="<?php echo $eyoom_board['bo_lucky_point']; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_bomb_point_type" class="select form-width-250px">
                                            <select name="bo_lucky_point_type" id="bo_lucky_point_type">
                                                <option value="1" <?php echo $eyoom_board['bo_lucky_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로 럭키<?php echo $levelset['gnu_name']; ?>를 100회 중</option>
                                                <option value="2" <?php echo $eyoom_board['bo_lucky_point_type']=='2' ? 'selected': ''; ?>>고정으로 럭키<?php echo $levelset['gnu_name']; ?>를 100회 중</option>
                                            </select><i></i>
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_lucky_point_ratio" class="input form-width-250px">
                                            <i class="icon-append width-130px">회의 확률로 지급합니다.</i>
                                            <input type="text" name="bo_lucky_point_ratio" id="bo_lucky_point_ratio" value="<?php echo $eyoom_board['bo_lucky_point_ratio']; ?>">
                                        </label>
                                    </span>
                                </div>
                                <div class="note"><strong>Note:</strong> 댓글을 작성할 경우, 지정한 확률에 따라 자동으로 행운의 포인트를 지급합니다.</div>
                            </td>
                            <td class="table-chk-td">
                                <div class="inline-group pull-right">
                                    <label for="chk_grp_lucky_point" class="checkbox"><input type="checkbox" name="chk_grp_lucky_point" id="chk_grp_lucky_point"><i></i>그룹적용</label>
                                    <label for="chk_all_lucky_point" class="checkbox"><input type="checkbox" name="chk_all_lucky_point" id="chk_all_lucky_point"><i></i>전체적용</label>
                                </div>
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

    <?php if (preg_match('/adopt/i', $eyoom_board['bo_skin'])) { ?>
    <div id="anc_bo_adopt">
        <div class="pg-anchor">
        <?php echo adm_pg_anchor('anc_bo_adopt'); ?>
        </div>
        <div class="adm-table-form-wrap margin-bottom-30">
            <header><strong><i class="fas fa-caret-right"></i> 채택 게시판 설정 [ 게시판명 : <span class='color-pink'><?php echo $board['bo_subject']; ?></span> ]</strong></header>
            <fieldset>
                <div class="cont-text-bg">
                    <p class="bg-danger font-size-12 margin-bottom-0"><i class="fas fa-info-circle"></i> <strong>알림</strong> : 채택 게시판을 사용하실 경우, 사이트 성격에 맞게 조건을 설정하실 수 있습니다.</p>
                </div>
            </fieldset>

            <div class="table-list-eb">
                <?php if (!G5_IS_MOBILE) { ?>
                <div class="table-responsive">
                <?php } ?>
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">채탹기능 사용여부</label>
                            </th>
                            <td>
                                <label for="bo_use_adopt_point" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_use_adopt_point" id="bo_use_adopt_point" value="1" <?php echo $eyoom_board['bo_use_adopt_point'] == '1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">채택 <?php echo $levelset['gnu_name']; ?> 설정</label>
                            </th>
                            <td>
                                <div class="inline-group">
                                    <span>
                                        <label for="bo_adopt_minpoint" class="input form-width-250px">
                                            <i class="icon-prepend">최소</i>
                                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?></i>
                                            <input type="text" name="bo_adopt_minpoint" id="bo_adopt_minpoint" value="<?php echo $eyoom_board['bo_adopt_minpoint']; ?>">
                                        </label>
                                    </span>
                                    <span>
                                        <label for="bo_adopt_maxpoint" class="input form-width-250px">
                                            <i class="icon-prepend">최대</i>
                                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?></i>
                                            <input type="text" name="bo_adopt_maxpoint" id="bo_adopt_maxpoint" value="<?php echo $eyoom_board['bo_adopt_maxpoint']; ?>">
                                        </label>
                                    </span>
                                </div>
                                <div class="note"><strong>Note: </strong><?php echo $levelset['gnu_name']; ?>는 원글 작성자가 자신의 포인트의 일부를 글작성 후, 채택 적용시 채택된 회원에게 후원하는 <?php echo $levelset['gnu_name']; ?>입니다.<br>글작성 시, 자신이 지정한 포인트만큼 설정한 포인트를 사용합니다.</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="table-form-th">
                                <label class="label">환급 <?php echo $levelset['gnu_name']; ?> 비율</label>
                            </th>
                            <td>
                                <label for="bo_adopt_ratio" class="input form-width-250px">
                                    <i class="icon-append">%</i>
                                    <input type="text" name="bo_adopt_ratio" id="bo_adopt_ratio" value="<?php echo $eyoom_board['bo_adopt_ratio']; ?>">
                                </label>
                                <div class="note"><strong>Note: </strong>환급 <?php echo $levelset['gnu_name']; ?>비율을 설정하시면, 해당 비율만큼 제외하고 채택자에게 채택 <?php echo $levelset['gnu_name']; ?>를 후원합니다.<br>나머지는 질문 작성자 본인에게 환급됩니다.(채택율을 높이기 위해 설정 필요)</div>
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
    <?php } ?>

    </form>
</div>

<script>
$('.pg-anchor a').on('click', function(e) {
    e.stopPropagation();
    var scrollTopSpace;
    if (window.innerWidth >= 1100) {
        scrollTopSpace = 70;
    } else {
        scrollTopSpace = 70;
    }
    var tabLink = $(this).attr('href');
    var offset = $(tabLink).offset().top;
    $('html, body').animate({scrollTop : offset - scrollTopSpace}, 500);
    return false;
});

$(function(){
    <?php if (G5_IS_MOBILE || $wmode) { ?>
    $("td").removeAttr('colspan');
    $(".table-chk-td").hide();
    <?php } ?>
});
</script>