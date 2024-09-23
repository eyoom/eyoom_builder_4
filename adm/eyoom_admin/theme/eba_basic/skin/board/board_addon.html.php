<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/board/board_addon.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'board_list';
$g5_title = '게시판관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">게시판관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';

$frm_eba_submit  = ' <div class="confirm-fixed-btn"> ';
$frm_eba_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-md btn-e-crimson" accesskey="s">' ;
$frm_eba_submit .= '</div>';
$frm_submit .= $frm_eba_submit;
?>

<style>
@media (max-width: 1199px) {
    .pg-anchor-in .nav-tabs li:nth-child(10) a {border-bottom:0}
}
</style>

<div class="admin-board-form">
    <div class="adm-headline">
        <h3>이윰 확장기능 설정 [ <span class="text-crimson"><?php echo $board['bo_table'] . ' : ' . $board['bo_subject']; ?></span> ]</h3>
    </div>

    <form name="fboardform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fboardform_submit(this);" class="eyoom-form">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $board['bo_table']; ?>">
    <input type="hidden" name="gr_id" id="gr_id" value="<?php echo $board['gr_id']; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="pg-anchor">
        <div class="pg-anchor-in">
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ($pg_anchor as $ac_id => $ac_name) { ?>
                <li role="presentation">
                    <a href="javasecipt:void(0);" class="anchor-menu <?php echo $ac_id; ?>" id="<?php echo $ac_id; ?>_tab" data-bs-toggle="tab" data-bs-target="#<?php echo $ac_id; ?>"><?php echo $ac_name; ?></a>
                </li>
                <?php } ?>
                <?php if (!$wmode) { ?>
                <li role="presentation">
                    <a href="<?php echo G5_ADMIN_URL."?dir=board&amp;pid=board_form&amp;bo_table={$bo_table}&amp;w=u"; ?>" class="anchor-menu" id="board_basic_tab">기본기능</a>
                </li>
                <?php } ?>
            </ul>
            <div class="tab-bottom-line"></div>
        </div>
    </div>

    <div class="tab-content">
        <?php /* 신고기능 : 시작 */ ?>
        <div class="tab-pane show active" id="anc_bo_blind" role="tabpanel" aria-labelledby="anc_bo_blind_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시물 신고/블라인드</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_yellow_card" class="label">게시물 신고/블라인드 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_yellow_card" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_yellow_card" id="bo_use_yellow_card" value="1" <?php echo $eyoom_board['bo_use_yellow_card']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 체크하시면 스팸 및 광고성 게시물의 신고 및 블라인드 기능이 활성화 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_yellow_card" class="checkbox"><input type="checkbox" name="chk_grp_yellow_card" value="1" id="chk_grp_yellow_card"><i></i>그룹적용</label>
                                <label for="chk_all_yellow_card" class="checkbox"><input type="checkbox" name="chk_all_yellow_card" value="1" id="chk_all_yellow_card"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_blind_limit" class="label">자동 블라인드 조건 설정</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_blind_limit" class="input max-width-250px">
                            <i class="icon-append">건</i>
                            <input type="text" name="bo_blind_limit" id="bo_blind_limit" value="<?php echo $eyoom_board['bo_blind_limit']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물의 신고건수가 설정된 숫자 이상이면 게시물을 자동으로 블라인드 처리합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_blind_limit" class="checkbox"><input type="checkbox" name="chk_grp_blind_limit" value="1" id="chk_grp_blind_limit"><i></i>그룹적용</label>
                                <label for="chk_all_blind_limit" class="checkbox"><input type="checkbox" name="chk_all_blind_limit" value="1" id="chk_all_blind_limit"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_blind_view" class="label">블라인드 게시물 보기 권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_blind_view" class="select max-width-250px">
                            <?php echo get_member_level_select('bo_blind_view', 1, 10, $eyoom_board['bo_blind_view']); ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 선택한 그누레벨 이상의 회원은 블라인드된 게시물을 볼 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_blind_view" class="checkbox"><input type="checkbox" name="chk_grp_blind_view" value="1" id="chk_grp_blind_view"><i></i>그룹적용</label>
                                <label for="chk_all_blind_view" class="checkbox"><input type="checkbox" name="chk_all_blind_view" value="1" id="chk_all_blind_view"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_blind_direct" class="label">게시물 바로 블라인드 설정권한</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_blind_direct" class="select max-width-250px">
                            <?php echo get_member_level_select('bo_blind_direct', 1, 10, $eyoom_board['bo_blind_direct']); ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 선택한 그누레벨 이상의 회원은 블라인드된 설정 권한이 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_blind_direct" class="checkbox"><input type="checkbox" name="chk_grp_blind_direct" value="1" id="chk_grp_blind_direct"><i></i>그룹적용</label>
                                <label for="chk_all_blind_direct" class="checkbox"><input type="checkbox" name="chk_all_blind_direct" value="1" id="chk_all_blind_direct"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 신고기능 : 끝 */ ?>

        <?php /* 별점기능 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_rating" role="tabpanel" aria-labelledby="anc_bo_rating_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시물 별점기능</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rating" class="label">게시물 별점 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_rating" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_rating" id="bo_use_rating" value="1" <?php echo $eyoom_board['bo_use_rating']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크가 되어 있지 않으면 아래 '목록에서 별점 표시 사용'이 체크되어 있어도 목록에 별점이 출력되지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating" class="checkbox"><input type="checkbox" name="chk_grp_rating" value="1" id="chk_grp_rating"><i></i>그룹적용</label>
                                <label for="chk_all_rating" class="checkbox"><input type="checkbox" name="chk_all_rating" value="1" id="chk_all_rating"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_rating_point" class="label">별점 평가 참가 포인트</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_rating_point" class="input max-width-250px">
                            <i class="icon-append">점</i>
                            <input type="input" name="bo_rating_point" id="bo_rating_point" value="<?php echo $eyoom_board['bo_rating_point'] ? $eyoom_board['bo_rating_point']: 0; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 별점 평가에 참가한 회원에게 제공하는 <?php echo $levelset['gnu_name']; ?>입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating_point" class="checkbox"><input type="checkbox" name="chk_grp_rating_point" value="1" id="chk_grp_rating_point"><i></i>그룹적용</label>
                                <label for="chk_all_rating_point" class="checkbox"><input type="checkbox" name="chk_all_rating_point" value="1" id="chk_all_rating_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rating_list" class="label">목록에서 별점 표시 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_rating_list" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_rating_list" id="bo_use_rating_list" value="1" <?php echo $eyoom_board['bo_use_rating_list']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판 목록에서 별점 평점내역을 출력할지 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating_list" class="checkbox"><input type="checkbox" name="chk_grp_rating_list" value="1" id="chk_grp_rating_list"><i></i>그룹적용</label>
                                <label for="chk_all_rating_list" class="checkbox"><input type="checkbox" name="chk_all_rating_list" value="1" id="chk_all_rating_list"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rating_member" class="label">참여회원 정보표시 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_rating_member" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_rating_member" id="bo_use_rating_member" value="1" <?php echo $eyoom_board['bo_use_rating_member']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 별점 평가에 참여한 회원들의 정보를 출력할지 설정합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating_member" class="checkbox"><input type="checkbox" name="chk_grp_rating_member" value="1" id="chk_grp_rating_member"><i></i>그룹적용</label>
                                <label for="chk_all_rating_member" class="checkbox"><input type="checkbox" name="chk_all_rating_member" value="1" id="chk_all_rating_member"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rating_score" class="label">참여회원 평점 공개</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_rating_score" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_rating_score" id="bo_use_rating_score" value="1" <?php echo $eyoom_board['bo_use_rating_score']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 참여회원의 평점을 공개할 것인지 설정합니다. 참여회원 정보표시를 사용할 경우에만 적용됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating_score" class="checkbox"><input type="checkbox" name="chk_grp_rating_score" value="1" id="chk_grp_rating_score"><i></i>그룹적용</label>
                                <label for="chk_all_rating_score" class="checkbox"><input type="checkbox" name="chk_all_rating_score" value="1" id="chk_all_rating_score"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_rating_comment" class="label">120자 한줄평 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_rating_comment" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_rating_comment" id="bo_use_rating_comment" value="1" <?php echo $eyoom_board['bo_use_rating_comment']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 120자 이내의 한줄평을 사용할 것인지 설정합니다. (무료 게시판 스킨에서는 제공하지 않는 기능입니다.)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_rating_comment" class="checkbox"><input type="checkbox" name="chk_grp_rating_comment" value="1" id="chk_grp_rating_comment"><i></i>그룹적용</label>
                                <label for="chk_all_rating_comment" class="checkbox"><input type="checkbox" name="chk_all_rating_comment" value="1" id="chk_all_rating_comment"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 별점기능 : 끝 */ ?>

        <?php /* 태그기능 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_tag" role="tabpanel" aria-labelledby="anc_bo_tag_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>태그기능</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_tag" class="label">게시물 태그 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_tag" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_tag" id="bo_use_tag" value="1" <?php echo $eyoom_board['bo_use_tag']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 게시판에 태그 기능을 활성화 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_tag" class="checkbox"><input type="checkbox" name="chk_grp_use_tag" value="1" id="chk_grp_use_tag"><i></i>그룹적용</label>
                                <label for="chk_all_use_tag" class="checkbox"><input type="checkbox" name="chk_all_use_tag" value="1" id="chk_all_use_tag"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_tag_level" class="label">글쓰기시 태그 작성 권한설정</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_tag_level" class="select max-width-250px">
                            <?php echo get_member_level_select('bo_tag_level', 1, 10, $eyoom_board['bo_tag_level']); ?><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 게시판 글쓰기 권한과 같거나 높아야 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_tag_level" class="checkbox"><input type="checkbox" name="chk_grp_tag_level" value="1" id="chk_grp_tag_level"><i></i>그룹적용</label>
                                <label for="chk_all_tag_level" class="checkbox"><input type="checkbox" name="chk_all_tag_level" value="1" id="chk_all_tag_level"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_tag_limit" class="label">입력가능한 태그수</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_tag_limit" class="input max-width-250px">
                            <i class="icon-append">건</i>
                            <input type="text" name="bo_tag_limit" id="bo_tag_limit" value="<?php echo $eyoom_board['bo_tag_limit']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 지정한 숫자를 초과하여 태그를 입력할 수 없습니다. [관리자는 제한없음]</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_tag_limit" class="checkbox"><input type="checkbox" name="chk_grp_tag_limit" value="1" id="chk_grp_tag_limit"><i></i>그룹적용</label>
                                <label for="chk_all_tag_limit" class="checkbox"><input type="checkbox" name="chk_all_tag_limit" value="1" id="chk_all_tag_limit"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 태그기능 : 끝 */ ?>

        <?php /* 자동이동/복사 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_automove" role="tabpanel" aria-labelledby="anc_bo_automove_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>자동 이동/복사</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_automove" class="label">게시물 자동 이동/복사 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_automove" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_automove" id="bo_use_automove" value="1" <?php echo $eyoom_board['bo_use_automove']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 게시물의 자동 이동/복사 기능을 활성화 합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_automove" class="checkbox"><input type="checkbox" name="chk_grp_use_automove" value="1" id="chk_grp_use_automove"><i></i>그룹적용</label>
                                <label for="chk_all_use_automove" class="checkbox"><input type="checkbox" name="chk_all_use_automove" value="1" id="chk_all_use_automove"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_automove" class="label">게시물 자동 이동/복사 조건</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group m-b-20">
                            <span>
                                <label for="bo_automove_type1" class="select width-200px">
                                    <select name="bo_automove_type1" id="bo_automove_type1">
                                        <option value="hit" <?php echo $bo_automove['type1']=='hit' ? 'selected': ''; ?>>[규칙1] 조회수가</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_count1" class="input width-200px">
                                    <i class="icon-append width-80px">이상이면</i>
                                    <input type="text" name="bo_automove_count1" id="bo_automove_count1" value="<?php echo $bo_automove['count1'] ? $bo_automove['count1']: '100'; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_target1" class="select width-200px">
                                    <select name="bo_automove_target1" id="bo_automove_target1">
                                        <option value="">선택한 게시판으로</option>
                                        <?php foreach ($bo_list as $bo) { if ($bo['bo_table'] == $bo_table) continue; ?>
                                        <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo_automove['target1'] == $bo['bo_table'] ? 'selected': ''; ?>><?php echo $bo['bo_subject']; ?> [<?php echo $bo['bo_table']; ?>] 으로</option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_action1" class="select width-200px">
                                    <select name="bo_automove_action1" id="bo_automove_action1">
                                        <option value="move" <?php echo $bo_automove['action1']=='move' ? 'selected': ''; ?>>이동합니다.</option>
                                        <option value="copy" <?php echo $bo_automove['action1']=='copy' ? 'selected': ''; ?>>복사합니다.</option>
                                    </select><i></i>
                                </label>
                            </span>
                        </div>
                        <div class="inline-group m-b-20">
                            <span>
                                <label for="bo_automove_type2" class="select width-200px">
                                    <select name="bo_automove_type2" id="bo_automove_type2">
                                        <option value="good" <?php echo $bo_automove['type2']=='good' ? 'selected': ''; ?>>[규칙2] 추천수가</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_count2" class="input width-200px">
                                    <i class="icon-append width-80px">이상이면</i>
                                    <input type="text" name="bo_automove_count2" id="bo_automove_count2" value="<?php echo $bo_automove['count2'] ? $bo_automove['count2']: '100'; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_target2" class="select width-200px">
                                    <select name="bo_automove_target2" id="bo_automove_target2">
                                        <option value="">선택한 게시판으로</option>
                                        <?php foreach ($bo_list as $bo) { if ($bo['bo_table'] == $bo_table) continue; ?>
                                        <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo_automove['target2'] == $bo['bo_table'] ? 'selected': ''; ?>><?php echo $bo['bo_subject']; ?> [<?php echo $bo['bo_table']; ?>] 으로</option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_action2" class="select width-200px">
                                    <select name="bo_automove_action2" id="bo_automove_action2">
                                        <option value="move" <?php echo $bo_automove['action2']=='move' ? 'selected': ''; ?>>이동합니다.</option>
                                        <option value="copy" <?php echo $bo_automove['action2']=='copy' ? 'selected': ''; ?>>복사합니다.</option>
                                    </select><i></i>
                                </label>
                            </span>
                        </div>
                        <div class="inline-group">
                            <span>
                                <label for="bo_automove_type3" class="select width-200px">
                                    <select name="bo_automove_type3" id="bo_automove_type3">
                                        <option value="nogood" <?php echo $bo_automove['type3']=='nogood' ? 'selected': ''; ?>>[규칙3] 비추천수가</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_count3" class="input width-200px">
                                    <i class="icon-append width-80px">이상이면</i>
                                    <input type="text" name="bo_automove_count3" id="bo_automove_count3" value="<?php echo $bo_automove['count3'] ? $bo_automove['count3']: '100'; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_target3" class="select width-200px">
                                    <select name="bo_automove_target3" id="bo_automove_target3">
                                        <option value="">선택한 게시판으로</option>
                                        <?php foreach ($bo_list as $bo) { if ($bo['bo_table'] == $bo_table) continue; ?>
                                        <option value="<?php echo $bo['bo_table']; ?>" <?php echo $bo_automove['target3'] == $bo['bo_table'] ? 'selected': ''; ?>><?php echo $bo['bo_subject']; ?> [<?php echo $bo['bo_table']; ?>] 으로</option>
                                        <?php } ?>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_automove_action3" class="select width-200px">
                                    <select name="bo_automove_action3" id="bo_automove_action3">
                                        <option value="move" <?php echo $bo_automove['action3']=='move' ? 'selected': ''; ?>>이동합니다.</option>
                                        <option value="copy" <?php echo $bo_automove['action3']=='copy' ? 'selected': ''; ?>>복사합니다.</option>
                                    </select><i></i>
                                </label>
                            </span>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_automove" class="checkbox"><input type="checkbox" name="chk_grp_automove" value="1" id="chk_grp_automove"><i></i>그룹적용</label>
                                <label for="chk_all_automove" class="checkbox"><input type="checkbox" name="chk_all_automove" value="1" id="chk_all_automove"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 자동이동/복사 : 끝 */ ?>

        <?php /* 인기게시물 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_best" role="tabpanel" aria-labelledby="anc_bo_best_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>인기게시물</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_best" class="label">인기게시물 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_best" class="checkbox" style="width:80px;">
                            <input type="checkbox" name="bo_use_best" id="bo_use_best" value="1" <?php echo $eyoom_board['bo_use_best']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 인기게시물 기능을 활성화하며 사용시점부터 추천 및 조회한 게시글에 적용됩니다.</div>
                        <div class="note"><strong>Note:</strong> 익명게시물은 인기게시물에서 제외됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_best" class="checkbox"><input type="checkbox" name="chk_grp_use_best" value="1" id="chk_grp_use_best"><i></i>그룹적용</label>
                                <label for="chk_all_use_best" class="checkbox"><input type="checkbox" name="chk_all_use_best" value="1" id="chk_all_use_best"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_best" class="label">인기게시물 조건</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group m-b-20">
                            <span>
                                <label for="bo_best_use1" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_best_use1" id="bo_best_use1" value="1" <?php echo $bo_best['use1']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </span>
                            <span>
                                <label for="bo_best_type1" class="select width-200px">
                                    <select name="bo_best_type1" id="bo_best_type1">
                                        <option value="hit" <?php echo $bo_best['type1']=='hit' ? 'selected': ''; ?>>[규칙1] 조회수가</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_best_count1" class="input width-200px">
                                    <i class="icon-append width-80px">이상이면</i>
                                    <input type="text" name="bo_best_count1" id="bo_best_count1" value="<?php echo $bo_best['count1'] ? $bo_best['count1']: '100'; ?>">
                                </label>
                            </span>
                            <span>
                                인기게시물로 지정합니다.
                            </span>
                        </div>
                        <div class="inline-group m-b-20">
                            <span>
                                <label for="bo_best_use2" class="checkbox" style="width:80px;">
                                    <input type="checkbox" name="bo_best_use2" id="bo_best_use2" value="1" <?php echo $bo_best['use2']=='1' ? 'checked': ''; ?>><i></i> 사용
                                </label>
                            </span>
                            <span>
                                <label for="bo_best_type2" class="select width-200px">
                                    <select name="bo_best_type2" id="bo_best_type2">
                                        <option value="good" <?php echo $bo_best['type2']=='good' ? 'selected': ''; ?>>[규칙2] 추천수가</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_best_count2" class="input width-200px">
                                    <i class="icon-append width-80px">이상이면</i>
                                    <input type="text" name="bo_best_count2" id="bo_best_count2" value="<?php echo $bo_best['count2'] ? $bo_best['count2']: '10'; ?>">
                                </label>
                            </span>
                            <span>
                                인기게시물로 지정합니다.
                            </span>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_best" class="checkbox"><input type="checkbox" name="chk_grp_best" value="1" id="chk_grp_best"><i></i>그룹적용</label>
                                <label for="chk_all_best" class="checkbox"><input type="checkbox" name="chk_all_best" value="1" id="chk_all_best"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 인기게시물 : 끝 */ ?>

        <?php /* 상단고정 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_wrfixed" role="tabpanel" aria-labelledby="anc_bo_wrfixed_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>게시물 상단고정 설정</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_wrfixed" class="label">게시물 상단고정 사용여부</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_wrfixed" class="checkbox">
                            <input type="checkbox" name="bo_use_wrfixed" id="bo_use_wrfixed" value="1" <?php echo $eyoom_board['bo_use_wrfixed'] == '1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 게시물 상단고정 기능이 활성화 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_wrfixed" class="checkbox"><input type="checkbox" name="chk_grp_use_wrfixed" value="1" id="chk_grp_use_wrfixed"><i></i>그룹적용</label>
                                <label for="chk_all_use_wrfixed" class="checkbox"><input type="checkbox" name="chk_all_use_wrfixed" value="1" id="chk_all_use_wrfixed"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_wrfixed" class="label">게시물 상단고정 노출방식</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_wrfixed_type" class="select max-width-250px">
                            <select name="bo_wrfixed_type" id="bo_wrfixed_type">
                                <option value="1" <?php echo $eyoom_board['bo_wrfixed_type']=='1' ? 'selected': ''; ?>>관지라 승인 후 적용하기</option>
                                <option value="2" <?php echo $eyoom_board['bo_wrfixed_type']=='2' ? 'selected': ''; ?>>상단노출 신청시 바로 적용하기</option>
                            </select><i></i>
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_wrfixed_type" class="checkbox"><input type="checkbox" name="chk_grp_wrfixed_type" value="1" id="chk_grp_wrfixed_type"><i></i>그룹적용</label>
                                <label for="chk_all_wrfixed_type" class="checkbox"><input type="checkbox" name="chk_all_wrfixed_type" value="1" id="chk_all_wrfixed_type"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_wrfixed_point" class="label">차감 포인트 설정</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_wrfixed_point" class="input max-width-250px">
                            <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?></i>
                            <input type="text" name="bo_wrfixed_point" id="bo_wrfixed_point" value="<?php echo $eyoom_board['bo_wrfixed_point'] ? $eyoom_board['bo_wrfixed_point']: '1000'; ?>">
                        </label>
                        <div class="note"><strong>Note: </strong>게시물을 상단고정 시킬 때 필요한 차감 포인트를 설정합니다. (숫자만 입력해 주세요)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_wrfixed_point" class="checkbox"><input type="checkbox" name="chk_grp_wrfixed_point" value="1" id="chk_grp_wrfixed_point"><i></i>그룹적용</label>
                                <label for="chk_all_wrfixed_point" class="checkbox"><input type="checkbox" name="chk_all_wrfixed_point" value="1" id="chk_all_wrfixed_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_wrfixed_date" class="label">상단고정 일수</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_wrfixed_date" class="input max-width-250px">
                            <i class="icon-append">일</i>
                            <input type="text" name="bo_wrfixed_date" id="bo_wrfixed_date" value="<?php echo $eyoom_board['bo_wrfixed_date'] ? $eyoom_board['bo_wrfixed_date']: '5'; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note: </strong> 상단고정 일수를 설정할 수 있습니다. (게시물의 상단고정 시간을 기준으로 해당일 만큼 지나면 자동으로 기능이 해제됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_wrfixed_date" class="checkbox"><input type="checkbox" name="chk_grp_wrfixed_date" value="1" id="chk_grp_wrfixed_date"><i></i>그룹적용</label>
                                <label for="chk_all_wrfixed_date" class="checkbox"><input type="checkbox" name="chk_all_wrfixed_date" value="1" id="chk_all_wrfixed_date"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 상단고정 : 끝 */ ?>

        <?php /* 포인트게시글 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_pointpost" role="tabpanel" aria-labelledby="anc_bo_pointpost_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>포인트게시물 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 게시물 작성자가 읽기 포인트를 설정하면 설정한 포인트를 작성자에게 지불하고 게시물을 읽을 수 있습니다.<br>
                            <i class="fas fa-info-circle"></i> 최고관리자의 경우 설정한 포인트와 상관없이 게시물을 읽을 수 있습니다.<br>
                            <i class="fas fa-info-circle"></i> 이윰넷에서 판매하는 유료 게시판 스킨인 포인트게시물 스킨에서 작동되며 다른 스킨에서는 작동하지 않습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_pointpost" class="label">포인트게시글 사용여부</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_pointpost" class="checkbox">
                            <input type="checkbox" name="bo_use_pointpost" id="bo_use_pointpost" value="1" <?php echo $eyoom_board['bo_use_pointpost'] == '1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 포인트게시물 기능이 활성화 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_use_pointpost" class="checkbox"><input type="checkbox" name="chk_grp_use_pointpost" value="1" id="chk_grp_use_pointpost"><i></i>그룹적용</label>
                                <label for="chk_all_use_pointpost" class="checkbox"><input type="checkbox" name="chk_all_use_pointpost" value="1" id="chk_all_use_pointpost"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_pointpost_point" class="label">포인트 구간 설정</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_pointpost_point" class="input">
                            <input type="text" name="bo_pointpost_point" id="bo_pointpost_point" value="<?php echo $eyoom_board['bo_pointpost_point'] ? $eyoom_board['bo_pointpost_point']: ''; ?>">
                        </label>
                        <div class="note"><strong>Note: </strong>포인트와 포인트 사이는 | 로 구분하세요. (예: 0|100|200|300)</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_pointpost_point" class="checkbox"><input type="checkbox" name="chk_grp_pointpost_point" value="1" id="chk_grp_pointpost_point"><i></i>그룹적용</label>
                                <label for="chk_all_pointpost_point" class="checkbox"><input type="checkbox" name="chk_all_pointpost_point" value="1" id="chk_all_pointpost_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 포인트게시글 : 끝 */ ?>

        <?php /* 댓글포인트 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_cmtpoint" role="tabpanel" aria-labelledby="anc_bo_cmtpoint_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>댓글 <?php echo $levelset['gnu_name']; ?> 설정</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">댓글<?php echo $levelset['gnu_name']; ?> 설명</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_point_explain" class="checkbox">
                            <input type="checkbox" name="bo_use_point_explain" id="bo_use_point_explain" value="1" <?php echo $eyoom_board['bo_use_point_explain']=='1' ? 'checked': ''; ?>><i></i> 보이기
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_point_explain" class="checkbox"><input type="checkbox" name="chk_grp_point_explain" id="chk_grp_point_explain"><i></i>그룹적용</label>
                                <label for="chk_all_point_explain" class="checkbox"><input type="checkbox" name="chk_all_point_explain" id="chk_all_point_explain"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">댓글<?php echo $levelset['gnu_name']; ?> 적용 대상</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <label for="bo_cmtpoint_target_1" class="radio"><input type="radio" name="bo_cmtpoint_target" id="bo_cmtpoint_target_1" value="1" <?php echo $eyoom_board['bo_cmtpoint_target']=='1' ? 'checked': ''; ?>><i></i> 그누보드 포인트로 적립</label>
                            <label for="bo_cmtpoint_target_2" class="radio"><input type="radio" name="bo_cmtpoint_target" id="bo_cmtpoint_target_2" value="2" <?php echo $eyoom_board['bo_cmtpoint_target']=='2' ? 'checked': ''; ?>><i></i> 이윰레벨 포인트로 적립</label>
                        </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_cmtpoint_target" class="checkbox"><input type="checkbox" name="chk_grp_cmtpoint_target" id="chk_grp_cmtpoint_target"><i></i>그룹적용</label>
                                <label for="chk_all_cmtpoint_target" class="checkbox"><input type="checkbox" name="chk_all_cmtpoint_target" id="chk_all_cmtpoint_target"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">첫 댓글 <?php echo $levelset['gnu_name']; ?></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <span>
                                <label for="bo_firstcmt_point" class="input width-150px">
                                    <i class="icon-append width-70px"><?php echo $levelset['gnu_name']; ?>를</i>
                                    <input type="text" name="bo_firstcmt_point" id="bo_firstcmt_point" value="<?php echo $eyoom_board['bo_firstcmt_point']; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_firstcmt_point_type" class="select width-250px">
                                    <select name="bo_firstcmt_point_type" id="bo_firstcmt_point_type">
                                        <option value="1" <?php echo $eyoom_board['bo_firstcmt_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로 첫댓글 작성자에게 지급합니다.</option>
                                        <option value="2" <?php echo $eyoom_board['bo_firstcmt_point_type']=='2' ? 'selected': ''; ?>>고정으로 작성자에게 지급합니다.</option>
                                    </select><i></i>
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 게시물의 첫번째 댓글에 주는 <?php echo $levelset['gnu_name']; ?>입니다. 0으로 설정하시면 기능이 작동하지 않습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_firstcmt_point" class="checkbox"><input type="checkbox" name="chk_grp_firstcmt_point" id="chk_grp_firstcmt_point"><i></i>그룹적용</label>
                                <label for="chk_all_firstcmt_point" class="checkbox"><input type="checkbox" name="chk_all_firstcmt_point" id="chk_all_firstcmt_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">지뢰 <?php echo $levelset['gnu_name']; ?></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <span>
                                <label for="bo_bomb_point" class="input width-150px">
                                    <i class="icon-append width-70px"><?php echo $levelset['gnu_name']; ?>를 </i>
                                    <input type="text" name="bo_bomb_point" id="bo_bomb_point" value="<?php echo $eyoom_board['bo_bomb_point']; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_bomb_point_type" class="select width-250px">
                                    <select name="bo_bomb_point_type" id="bo_bomb_point_type">
                                        <option value="1" <?php echo $eyoom_board['bo_bomb_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로</option>
                                        <option value="2" <?php echo $eyoom_board['bo_bomb_point_type']=='2' ? 'selected': ''; ?>>고정으로</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_bomb_point_limit" class="input width-250px">
                                    <i class="icon-append width-170px">개의 지뢰를 매설합니다.</i>
                                    <input type="text" name="bo_bomb_point_limit" id="bo_bomb_point_limit" value="<?php echo $eyoom_board['bo_bomb_point_limit']; ?>">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 게시물이 작성이 되면 자동으로 <?php echo $levelset['gnu_name']; ?> 지뢰가 심어집니다. 지뢰 폭탄을 터트릴 경우 주어지는 포인트입니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_bomb_point" class="checkbox"><input type="checkbox" name="chk_grp_bomb_point" id="chk_grp_bomb_point"><i></i>그룹적용</label>
                                <label for="chk_all_bomb_point" class="checkbox"><input type="checkbox" name="chk_all_bomb_point" id="chk_all_bomb_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">럭키 <?php echo $levelset['gnu_name']; ?></label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <div class="inline-group">
                            <span>
                                <label for="bo_lucky_point" class="input width-150px">
                                    <i class="icon-append width-70px"><?php echo $levelset['gnu_name']; ?>를 </i>
                                    <input type="text" name="bo_lucky_point" id="bo_lucky_point" value="<?php echo $eyoom_board['bo_lucky_point']; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_bomb_point_type" class="select width-250px">
                                    <select name="bo_lucky_point_type" id="bo_lucky_point_type">
                                        <option value="1" <?php echo $eyoom_board['bo_lucky_point_type']=='1' ? 'selected': ''; ?>>최대 랜덤으로 럭키<?php echo $levelset['gnu_name']; ?>를 100회 중</option>
                                        <option value="2" <?php echo $eyoom_board['bo_lucky_point_type']=='2' ? 'selected': ''; ?>>고정으로 럭키<?php echo $levelset['gnu_name']; ?>를 100회 중</option>
                                    </select><i></i>
                                </label>
                            </span>
                            <span>
                                <label for="bo_lucky_point_ratio" class="input width-250px">
                                    <i class="icon-append width-170px">회의 확률로 지급합니다.</i>
                                    <input type="text" name="bo_lucky_point_ratio" id="bo_lucky_point_ratio" value="<?php echo $eyoom_board['bo_lucky_point_ratio']; ?>">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 댓글을 작성할 경우, 지정한 확률에 따라 자동으로 행운의 포인트를 지급합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_lucky_point" class="checkbox"><input type="checkbox" name="chk_grp_lucky_point" id="chk_grp_lucky_point"><i></i>그룹적용</label>
                                <label for="chk_all_lucky_point" class="checkbox"><input type="checkbox" name="chk_all_lucky_point" id="chk_all_lucky_point"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 댓글포인트 : 끝 */ ?>

        <?php /* 댓글베스트 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_cmtbest" role="tabpanel" aria-labelledby="anc_bo_cmtbest_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>베스트 댓글</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_cmt_best" class="label">베스트 댓글 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_cmt_best" class="checkbox">
                            <input type="checkbox" name="bo_use_cmt_best" id="bo_use_cmt_best" value="1" <?php echo $eyoom_board['bo_use_cmt_best']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note: </strong> 사용 체크시 베스트 댓글 기능이 활성화 됩니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_cmt_best" class="checkbox"><input type="checkbox" name="chk_grp_cmt_best" value="1" id="chk_grp_cmt_best"><i></i>그룹적용</label>
                                <label for="chk_all_cmt_best" class="checkbox"><input type="checkbox" name="chk_all_cmt_best" value="1" id="chk_all_cmt_best"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_cmt_best_min" class="label">베스트 댓글 최소 추천수</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_cmt_best_min" class="input max-width-250px">
                            <i class="icon-append">건</i>
                            <input type="text" name="bo_cmt_best_min" id="bo_cmt_best_min" value="<?php echo $eyoom_board['bo_cmt_best_min']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 설정한 추천수 이상일 때, 베스트 댓글이 될 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_cmtbest_min" class="checkbox"><input type="checkbox" name="chk_grp_cmtbest_min" value="1" id="chk_grp_cmtbest_min"><i></i>그룹적용</label>
                                <label for="chk_all_cmtbest_min" class="checkbox"><input type="checkbox" name="chk_all_cmtbest_min" value="1" id="chk_all_cmtbest_min"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_cmt_best_limit" class="label">노출 베스트 댓글수</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_cmt_best_limit" class="input max-width-250px">
                            <i class="icon-append">건</i>
                            <input type="text" name="bo_cmt_best_limit" id="bo_cmt_best_limit" value="<?php echo $eyoom_board['bo_cmt_best_limit']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 설정한 건수만큼 베스트 댓글로 순위를 노출합니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_cmtbest_limit" class="checkbox"><input type="checkbox" name="chk_grp_cmtbest_limit" value="1" id="chk_grp_cmtbest_limit"><i></i>그룹적용</label>
                                <label for="chk_all_cmtbest_limit" class="checkbox"><input type="checkbox" name="chk_all_cmtbest_limit" value="1" id="chk_all_cmtbest_limit"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 댓글베스트 : 끝 */ ?>

        <?php /* 애드온 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_addon" role="tabpanel" aria-labelledby="anc_bo_addon_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>애드온 기능</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_emoticon" class="label">이모티콘 추가 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_emoticon" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_emoticon" id="bo_use_addon_emoticon" value="1" <?php echo $eyoom_board['bo_use_addon_emoticon']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 귀엽고 깜찍한 움직이는 이모티콘을 게시물 작성시 쉽게 추가하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_emoticon" class="checkbox"><input type="checkbox" name="chk_grp_addon_emoticon" value="1" id="chk_grp_addon_emoticon"><i></i>그룹적용</label>
                                <label for="chk_all_addon_emoticon" class="checkbox"><input type="checkbox" name="chk_all_addon_emoticon" value="1" id="chk_all_addon_emoticon"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_video" class="label">동영상 추가 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_video" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_video" id="bo_use_addon_video" value="1" <?php echo $eyoom_board['bo_use_addon_video']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 게시물 내용에 유튜브, 비메오, 네이버TV, 카카오TV, 테드, 판도라와 같은 동영상 서비스 플렛폼의 동영상을 쉽게 공유하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_video" class="checkbox"><input type="checkbox" name="chk_grp_addon_video" value="1" id="chk_grp_addon_video"><i></i>그룹적용</label>
                                <label for="chk_all_addon_video" class="checkbox"><input type="checkbox" name="chk_all_addon_video" value="1" id="chk_all_addon_video"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_coding" class="label">댓글에 코드표시 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_coding" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_coding" id="bo_use_addon_coding" value="1" <?php echo $eyoom_board['bo_use_addon_coding']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글 작성시 HTML, CSS, JS, PHP 프로그램 소스등을 하일라이트 기능으로 추가하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_coding" class="checkbox"><input type="checkbox" name="chk_grp_addon_coding" value="1" id="chk_grp_addon_coding"><i></i>그룹적용</label>
                                <label for="chk_all_addon_coding" class="checkbox"><input type="checkbox" name="chk_all_addon_coding" value="1" id="chk_all_addon_coding"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_soundcloud" class="label">사운드클라우드 추가 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_soundcloud" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_soundcloud" id="bo_use_addon_soundcloud" value="1" <?php echo $eyoom_board['bo_use_addon_soundcloud']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사운드클라우드 (<a href="https://soundcloud.com" target="_blank">https://soundcloud.com</a>)의 다양한 음원을 직접 추가하여 청취하실 수 있습니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_soundcloud" class="checkbox"><input type="checkbox" name="chk_grp_addon_soundcloud" value="1" id="chk_grp_addon_soundcloud"><i></i>그룹적용</label>
                                <label for="chk_all_addon_soundcloud" class="checkbox"><input type="checkbox" name="chk_all_addon_soundcloud" value="1" id="chk_all_addon_soundcloud"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_map" class="label">지도 추가 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_map" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_map" id="bo_use_addon_map" value="1" <?php echo $eyoom_board['bo_use_addon_map']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 구글지도, 카카오지도, 네이버지도 등을 게시물에 쉽게 추가하실 수 있습니다. </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_map" class="checkbox"><input type="checkbox" name="chk_grp_addon_map" value="1" id="chk_grp_addon_map"><i></i>그룹적용</label>
                                <label for="chk_all_addon_map" class="checkbox"><input type="checkbox" name="chk_all_addon_map" value="1" id="chk_all_addon_map"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_poll" class="label">투표 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_poll" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_poll" id="bo_use_addon_poll" value="1" <?php echo $eyoom_board['bo_use_addon_poll']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="inline-group">
                            <span>
                                <label for="bo_addon_poll_point" class="input width-150px">
                                    <i class="icon-append width-70px"><?php echo $levelset['gnu_name']; ?>를</i>
                                    <input type="text" name="bo_addon_poll_point" id="bo_addon_poll_point" value="<?php echo $eyoom_board['bo_addon_poll_point'] ? $eyoom_board['bo_addon_poll_point']: 0; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_addon_poll_type" class="select width-250px">
                                    <select name="bo_addon_poll_type" id="bo_addon_poll_type">
                                        <option value="1" <?php echo $eyoom_board['bo_addon_poll_type']=='1' ? 'selected': ''; ?>>랜덤으로 지급</option>
                                        <option value="2" <?php echo $eyoom_board['bo_addon_poll_type']=='2' ? 'selected': ''; ?>>고정으로 지급</option>
                                    </select><i></i>
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> 게시글에 투표 기능(텍스트 투표, 이미지 투표, 동영상 투표)을 활성화 시킵니다. </div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_poll" class="checkbox"><input type="checkbox" name="chk_grp_addon_poll" value="1" id="chk_grp_addon_poll"><i></i>그룹적용</label>
                                <label for="chk_all_addon_poll" class="checkbox"><input type="checkbox" name="chk_all_addon_poll" value="1" id="chk_all_addon_poll"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_addon_cmtfile" class="label">댓글에 파일 추가 기능 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_addon_cmtfile" class="checkbox">
                            <input type="checkbox" name="bo_use_addon_cmtfile" id="bo_use_addon_cmtfile" value="1" <?php echo $eyoom_board['bo_use_addon_cmtfile']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <label for="bo_count_cmtfile" class="input max-width-150px">
                            <i class="icon-append">개</i>
                            <input type="input" name="bo_count_cmtfile" id="bo_count_cmtfile" value="<?php echo $eyoom_board['bo_count_cmtfile'] ? $eyoom_board['bo_count_cmtfile']: 1; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 댓글에도 파일을 첨부할 수 있는 기능을 활성화 시킵니다.</div>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_addon_cmtfile" class="checkbox"><input type="checkbox" name="chk_grp_addon_cmtfile" value="1" id="chk_grp_addon_cmtfile"><i></i>그룹적용</label>
                                <label for="chk_all_addon_cmtfile" class="checkbox"><input type="checkbox" name="chk_all_addon_cmtfile" value="1" id="chk_all_addon_cmtfile"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 애드온 : 끝 */ ?>

        <?php /* 사진 EXIF : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_exif" role="tabpanel" aria-labelledby="anc_bo_exif_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>이미지 EXIF</strong></div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">포토이미지 EXIF 정보보기 사용</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <label for="bo_use_exif" class="checkbox">
                            <input type="checkbox" name="bo_use_exif" id="bo_use_exif" value="1" <?php echo $eyoom_board['bo_use_exif']=='1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_exif" class="checkbox"><input type="checkbox" name="chk_grp_exif" id="chk_grp_exif"><i></i>그룹적용</label>
                                <label for="chk_all_exif" class="checkbox"><input type="checkbox" name="chk_all_exif" id="chk_all_exif"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adm-form-tr adm-sm-100">
                    <div class="adm-form-td td-l">
                        <label class="label">EXIF 정보보기 상세설정</label>
                    </div>
                    <div class="adm-form-td td-r td-rs">
                        <?php foreach ($exif_detail as $key => $item) { ?>
                        <div class="inline-group m-b-10">
                            <span>
                                <label class="input state-disabled width-200px">
                                    <input type="text" value="<?php echo $exif->exif_item[$key]; ?>" disabled>
                                </label>
                            </span>
                            <span>
                                <label for="bo_exif_detail_<?php echo $key; ?>_item" class="input width-200px m-r-15">
                                    <input type="text" name="bo_exif_detail[<?php echo $key; ?>][item]" id="bo_exif_detail_<?php echo $key; ?>_item" value="<?php echo get_text($item['item']) ? get_text($item['item']): ''; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_exif_detail_<?php echo $key; ?>_use" class="checkbox width-100px">
                                    <input type="checkbox" name="bo_exif_detail[<?php echo $key; ?>][use]" id="bo_exif_detail_<?php echo $key; ?>_use" value="1" <?php echo $item['use']=='1' ? 'checked': ''; ?>><i></i> 보이기
                                </label>
                            </span>
                        </div>
                        <?php } ?>
                        <div class="adm-form-td-rs">
                            <div class="inline-group">
                                <label for="chk_grp_exif_detail" class="checkbox"><input type="checkbox" name="chk_grp_exif_detail" id="chk_grp_exif_detail"><i></i>그룹적용</label>
                                <label for="chk_all_exif_detail" class="checkbox"><input type="checkbox" name="chk_all_exif_detail" id="chk_all_exif_detail"><i></i>전체적용</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 사진 EXIF : 끝 */ ?>

        <?php /* 채택기능 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_adopt" role="tabpanel" aria-labelledby="anc_bo_adopt_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>채택 게시판 설정</strong></div>
                <div class="adm-form-info">
                    <div class="cont-text-bg">
                        <p class="bg-info">
                            <i class="fas fa-info-circle"></i> 이윰넷에서 판매하는 유료 게시판 스킨인 채택게시판 스킨에서 작동되며 다른 스킨에서는 작동하지 않습니다.
                        </p>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_adopt_point" class="label">채택기능 사용여부</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="bo_use_adopt_point" class="checkbox">
                            <input type="checkbox" name="bo_use_adopt_point" id="bo_use_adopt_point" value="1" <?php echo $eyoom_board['bo_use_adopt_point'] == '1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 채택기능이 활성화 됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label class="label">채택 <?php echo $levelset['gnu_name']; ?> 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <div class="inline-group">
                            <span>
                                <label for="bo_adopt_minpoint" class="input max-width-250px">
                                    <i class="icon-prepend">최소</i>
                                    <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?></i>
                                    <input type="text" name="bo_adopt_minpoint" id="bo_adopt_minpoint" value="<?php echo $eyoom_board['bo_adopt_minpoint']; ?>">
                                </label>
                            </span>
                            <span>
                                <label for="bo_adopt_maxpoint" class="input max-width-250px">
                                    <i class="icon-prepend">최대</i>
                                    <i class="icon-append width-60px"><?php echo $levelset['gnu_name']; ?></i>
                                    <input type="text" name="bo_adopt_maxpoint" id="bo_adopt_maxpoint" value="<?php echo $eyoom_board['bo_adopt_maxpoint']; ?>">
                                </label>
                            </span>
                        </div>
                        <div class="note"><strong>Note:</strong> <?php echo $levelset['gnu_name']; ?>는 원글 작성자가 자신의 포인트의 일부를 글작성 후, 채택 적용시 채택된 회원에게 후원하는 <?php echo $levelset['gnu_name']; ?>입니다.<br>글작성 시, 자신이 지정한 포인트만큼 설정한 포인트를 사용합니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_adopt_ratio" class="label">환급 <?php echo $levelset['gnu_name']; ?> 비율</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="bo_adopt_ratio" class="input max-width-250px">
                            <i class="icon-append">%</i>
                            <input type="text" name="bo_adopt_ratio" id="bo_adopt_ratio" value="<?php echo $eyoom_board['bo_adopt_ratio']; ?>" class="text-end">
                        </label>
                        <div class="note"><strong>Note:</strong> 환급 <?php echo $levelset['gnu_name']; ?>비율을 설정하시면, 해당 비율만큼 제외하고 채택자에게 채택 <?php echo $levelset['gnu_name']; ?>를 후원합니다.<br>나머지는 질문 작성자 본인에게 환급됩니다.(채택율을 높이기 위해 설정 필요)</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 채택기능 : 끝 */ ?>

        <?php /* 예약게시판기능 : 시작 */ ?>
        <div class="tab-pane" id="anc_bo_scheduled" role="tabpanel" aria-labelledby="anc_bo_scheduled_tab">
            <div class="adm-form-table m-b-20">
                <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>예약게시판 설정</strong></div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_scheduled" class="label">예약게시판기능 사용여부</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="bo_use_scheduled" class="checkbox">
                            <input type="checkbox" name="bo_use_scheduled" id="bo_use_scheduled" value="1" <?php echo $eyoom_board['bo_use_scheduled'] == '1' ? 'checked': ''; ?>><i></i> 사용
                        </label>
                        <div class="note"><strong>Note:</strong> 사용 체크시 예약게시판기능 활성화 됩니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_use_scheduled" class="label">대상 게시판 설정</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="bo_table_scheduled" class="select max-width-250px">
                            <select name="bo_table_scheduled">
                                <option value="">:: 대상 게시판 선택 ::</option>
                                <?php foreach($bo_tables as $k => $bo) { if ($bo == $bo_table) continue; ?>
                                <option value="<?php echo $bo; ?>" <?php echo $eyoom_board['bo_table_scheduled'] == $bo ? 'selected': ''; ?>><?php echo $bo_subject[$k]; ?> [<?php echo $bo; ?>]</option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                        <div class="note"><strong>Note:</strong> 예약 게시판 기능의 대상이 되는 게시판을 설정하시기 바랍니다.</div>
                    </div>
                </div>
                <div class="adm-form-tr">
                    <div class="adm-form-td td-l">
                        <label for="bo_scheduled_ip" class="label">글작성 가능 아이피</label>
                    </div>
                    <div class="adm-form-td td-r">
                        <label for="bo_scheduled_ip" class="input max-width-250px">
                            <input type="text" name="bo_scheduled_ip" id="bo_scheduled_ip" value="<?php echo $eyoom_board['bo_scheduled_ip'] ? $eyoom_board['bo_scheduled_ip']: ''; ?>">
                        </label>
                        <div class="note"><strong>Note:</strong> 예약 게시판에 접근 가능한 아이피를 쉼표로 구분하여 입력해 주시요. 예) 111.111.111.111, 222.222.222.222</div>
                        <div class="note"><strong>Note:</strong> 현재 접속하신 아이피는 <strong class="color-red"><?php echo $_SERVER['REMOTE_ADDR']; ?></strong>입니다.</div>
                        <div class="note"><strong>Note:</strong> 입력하지 않으면 접근제한을 두지 않습니다.</div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* 예약계시 기능 : 끝 */ ?>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit;?>
    </div>

    </form>
</div>

<script>
$(function(){
    // 신고기능 탭 우선 active 적용
    $(".anc_bo_blind").addClass('active');
});

function fboardform_submit(f) {
    f.target = 'blank_iframe';
    return true;
}
</script>