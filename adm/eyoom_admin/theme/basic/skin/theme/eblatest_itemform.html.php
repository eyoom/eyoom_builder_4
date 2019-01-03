<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/eblatest_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-eblatest-form">
    <form name="feblatestform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return feblatestform_submit(this);" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $li_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="li_no" id="li_no" value="<?php echo $li['li_no']; ?>">
    <input type="hidden" name="el_code" id="el_code" value="<?php echo $li['el_code'] ? $li['el_code']:$el_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-10">
        <header><strong><i class="fas fa-caret-right"></i> EB최신글 아이템 설정</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_state_1" class="radio"><input type="radio" name="li_state" id="li_state_1" value="1" <?php echo $li['li_state'] == '1' || !$li['li_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="li_state_2" class="radio"><input type="radio" name="li_state" id="li_state_2" value="2" <?php echo $li['li_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글 아이템의 출력여부를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력순서</label>
                        </th>
                        <td>
                            <label for="li_sort" class="input form-width-250px">
                                <i class="icon-append fas fa-sort-numeric-down"></i>
                                <input type="text" name="li_sort" id="li_sort" value="<?php echo $li['li_sort'] ? $li['li_sort']: $li_max_sort; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">최신글 제목</label>
                        </th>
                        <td>
                            <label for="li_title" class="input">
                                <input type="text" name="li_title" id="li_title" value="<?php echo $li['li_title']; ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 자유게시판, 질문과 답변</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">대표 연결주소 [링크]</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="li_link" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="li_link" id="li_link" value="<?php echo $li['li_link']; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="li_target" class="select form-width-150px">
                                        <select name="li_target" id="ec_target">
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $li['li_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $li['li_target'] == '_self' || !$li['li_target'] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB최신글 아이템에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">보기권한 설정</label>
                        </th>
                        <td colspan="3">
                            <label for="li_view_level" class="select form-width-250px">
                                <?php echo get_member_level_select('li_view_level', 1, 10, $li['li_view_level']); ?><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력기간 재적용</label>
                        </th>
                        <td colspan="3">
                            <label for="li_renew" class="checkbox"><input type="checkbox" name="li_renew" id="li_renew" value="y"><i></i> 최신글 추출일 적용하기</label>
                            <div class="note"><strong>Note:</strong> 환경설정에서 적용한 <strong>최신게시물 삭제</strong>일수(<?php echo $config['cf_new_del']; ?>일)를 기준으로 최신글을 자동으로 적용해 줍니다.<br>게시물이 있는데 최신 게시물이 출력되지 않을 경우 체크하세요.</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="adm-table-form-wrap margin-bottom-10">
        <header><strong><i class="fas fa-caret-right"></i> 최신글 대상 게시판 선택</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">추출 게시판 (bo_table)</label>
                        </th>
                        <td>
                            <label for="li_bo_table" class="select form-width-250px">
                                <select name="li_bo_table" id="li_bo_table">
                                    <option value="">::전체게시판::</option>
                                    <?php foreach ($bo_info as $k => $bo) { ?>
                                    <option value="<?php echo $bo['bo_table']; ?>" <?php echo $li['li_bo_table'] == $bo['bo_table'] ? 'selected':''; ?>>[<?php echo $bo['bo_table']; ?>] <?php echo $bo['bo_subject']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 추출하고자 하는 게시판을 선택해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시판 그룹 (gr_id)</label>
                        </th>
                        <td>
                            <label for="li_gr_id" class="select form-width-250px">
                                <select name="li_gr_id" id="li_gr_id">
                                    <option value="">::선택::</option>
                                    <?php foreach ($gr_info as $k => $gr) { ?><!--{@ gr_info}-->
                                    <option value="<?php echo $gr['gr_id']; ?>" <?php echo $li['li_gr_id'] == $gr['gr_id'] ? 'selected':''; ?>>[<?php echo $gr['gr_id']; ?>] <?php echo $gr['gr_subject']; ?></option>
                                    <?php } ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 특정 그룹에 속한 모든 게시판의 게시물을 추출하고자 할 때 그룹ID를 입력해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">포함 게시판 (bo_table)</label>
                        </th>
                        <td>
                            <label for="li_include" class="input">
                                <input type="text" name="li_include" id="li_include" value="<?php echo $li['li_include']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 여러 게시판의 최신 게시물을 동시에 불러옵니다. 쉼표(,)로 구분하여 bo_table를 입력해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">제외 게시판 (bo_table)</label>
                        </th>
                        <td>
                            <label for="li_exclude" class="input">
                                <input type="text" name="li_exclude" id="li_exclude" value="<?php echo $li['li_exclude']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 게시판 그룹을 일괄로 불러올 때 제외하고 싶은 게시판의 bo_table를 쉼표(,)로 구분하여 입력해 주세요.</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if (!G5_IS_MOBILE) { ?>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php echo $frm_submit; ?>

    <div class="adm-table-form-wrap margin-bottom-10">
        <header><strong><i class="fas fa-caret-right"></i> 최신글 추출 옵션</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">최신글 게시물수</label>
                        </th>
                        <td>
                            <label for="li_count" class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="li_count" id="li_count" value="<?php echo $li['li_count'] ? $li['li_count']: 5; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 추출 최신 게시물수를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">분할 출력 칸수</label>
                        </th>
                        <td>
                            <label for="li_depart" class="input form-width-250px">
                                <i class="icon-append">칸</i>
                                <input type="text" name="li_depart" id="li_depart" value="<?php echo $li['li_depart'] ? $li['li_depart']: 2; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 추출 최신 게시물의 가로 분할 칸수를 설정합니다.</div>
                            <div class="note"><strong class="color-black">주의:</strong> <span class="color-red">이 기능은 <strong>최신글 basic, bestset 스킨에서만 적용 가능</strong>합니다. 분할 가능한 입력값은 2, 3, 4, 6 이 가능하며(2, 3 권장) 해당 입력값으로 나눠질수 있는 정수로 위 '<strong>최신글 게시물수</strong>'를 입력하여야 합니다.</span></div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물 추출 기간</label>
                        </th>
                        <td>
                            <label for="li_period" class="input form-width-250px">
                                <i class="icon-append">일</i>
                                <input type="text" name="li_period" id="li_period" value="<?php echo $li['li_period'] ? $li['li_period']: 0; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 게시물의 출력 범위를 날자만큼 이전부터 현재까지의 게시물을 추출합니다. 0 으로 설정시 제한을 두지 않습니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물 제목 길이</label>
                        </th>
                        <td>
                            <label for="li_cut_subject" class="input form-width-250px">
                                <i class="icon-append">글자</i>
                                <input type="text" name="li_cut_subject" id="li_cut_subject" value="<?php echo $li['li_cut_subject'] ? $li['li_cut_subject']: 0; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력한 길이 만큼 잘라서 표기합니다. 0으로 설정시 전체 제목이 출력됩니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">최신글 대상</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_type_1" class="radio"><input type="radio" name="li_type" id="li_type_1" value="a" <?php echo $li['li_type'] == 'a' ? 'checked': ''; ?>><i></i> 전체</label>
                                <label for="li_type_2" class="radio"><input type="radio" name="li_type" id="li_type_2" value="w" <?php echo $li['li_type'] == 'w' || !$li['li_type'] ? 'checked': ''; ?>><i></i> 원글만</label>
                                <label for="li_type_3" class="radio"><input type="radio" name="li_type" id="li_type_3" value="c" <?php echo $li['li_type'] == 'c' ? 'checked': ''; ?>><i></i> 댓글만</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글로 추출할 대상을 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이미지 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_img_view_1" class="radio"><input type="radio" name="li_img_view" id="li_img_view_1" value="y" <?php echo $li['li_img_view'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_img_view_2" class="radio"><input type="radio" name="li_img_view" id="li_img_view_2" value="n" <?php echo $li['li_img_view'] == 'n' || !$li['li_img_view'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 이미지 출력이 가능한 스킨에서 적용이 가능합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="li_img_width" class="input form-width-200px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append text-width">px</i>
                                        <input type="text" name="li_img_width" id="li_img_width" value="<?php echo $li['li_img_width'] ? $li['li_img_width']: 300; ?>" class="text-right">
                                    </label>
                                </span>
                                <span> X </span>
                                <span>
                                    <label for="li_img_height" class="input form-width-200px">
                                        <i class="icon-prepend text-width">높이</i>
                                        <i class="icon-append text-width">px</i>
                                        <input type="text" name="li_img_height" id="li_img_height" value="<?php echo $li['li_img_height']; ?>" class="text-right">
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글 스킨이 갤러리 또는 웹진 타입일 경우, 출력 이미지의 사이즈를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물 내용 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_content_1" class="radio"><input type="radio" name="li_content" id="li_content_1" value="y" <?php echo $li['li_content'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_content_2" class="radio"><input type="radio" name="li_content" id="li_content_2" value="n" <?php echo $li['li_content'] == 'n' || !$li['li_content'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 게시물의 내용의 일부를 추출하여 출력합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물 내용 길이</label>
                        </th>
                        <td>
                            <label for="li_cut_content" class="input form-width-250px">
                                <i class="icon-append">글자</i>
                                <input type="text" name="li_cut_content" id="li_cut_content" value="<?php echo $li['li_cut_content'] ? $li['li_cut_content']: 0; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 입력한 길이 만큼 잘라서 표기합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시판 이름 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_bo_subject_1" class="radio"><input type="radio" name="li_bo_subject" id="li_bo_subject_1" value="y" <?php echo $li['li_bo_subject'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_bo_subject_2" class="radio"><input type="radio" name="li_bo_subject" id="li_bo_subject_2" value="n" <?php echo $li['li_bo_subject'] == 'n' || !$li['li_bo_subject'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글 리스트에 게시판명의 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물 분류 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_ca_view_1" class="radio"><input type="radio" name="li_ca_view" id="li_ca_view_1" value="y" <?php echo $li['li_ca_view'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_ca_view_2" class="radio"><input type="radio" name="li_ca_view" id="li_ca_view_2" value="n" <?php echo $li['li_ca_view'] == 'n' || !$li['li_ca_view'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 카테고리인 분류를 사용하는 게시판의 분류명을 출력할지 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">인기글 순서로 출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_best_1" class="radio"><input type="radio" name="li_best" id="li_best_1" value="y" <?php echo $li['li_best'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_best_2" class="radio"><input type="radio" name="li_best" id="li_best_2" value="n" <?php echo $li['li_best'] == 'n' || !$li['li_best'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 히트수가 많은 게시물부터 순서대로 추출합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">게시물의 랜덤 출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_random_1" class="radio"><input type="radio" name="li_random" id="li_random_1" value="y" <?php echo $li['li_random'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_random_2" class="radio"><input type="radio" name="li_random" id="li_random_2" value="n" <?php echo $li['li_random'] == 'n' || !$li['li_random'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 사용시 최신글에 게시물을 랜덤하게 추출합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">작성자 정보 출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_mbname_view_1" class="radio"><input type="radio" name="li_mbname_view" id="li_mbname_view_1" value="y" <?php echo $li['li_mbname_view'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_mbname_view_2" class="radio"><input type="radio" name="li_mbname_view" id="li_mbname_view_2" value="n" <?php echo $li['li_mbname_view'] == 'n' || !$li['li_mbname_view'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 작성자 정보를 출력할지 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">회원 프로필 사진 출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_photo_1" class="radio"><input type="radio" name="li_photo" id="li_photo_1" value="y" <?php echo $li['li_photo'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_photo_2" class="radio"><input type="radio" name="li_photo" id="li_photo_2" value="n" <?php echo $li['li_photo'] == 'n' || !$li['li_photo'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 게시물 목록에서 작성자의 프로필 사진을 출력할지 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">작성일 출력여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_use_date_1" class="radio"><input type="radio" name="li_use_date" id="li_use_date_1" value="y" <?php echo $li['li_use_date'] == 'y' ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="li_use_date_2" class="radio"><input type="radio" name="li_use_date" id="li_use_date_2" value="n" <?php echo $li['li_use_date'] == 'n' || !$li['li_use_date'] ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글에 작성일을 출력할지 여부를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">작성일 출력형식</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="li_date_type_1" class="radio"><input type="radio" name="li_date_type" id="li_date_type_1" value="1" <?php echo $li['li_date_type'] == '1' ? 'checked': ''; ?>><i></i> 24시간 단위</label>
                                <label for="li_date_type_2" class="radio"><input type="radio" name="li_date_type" id="li_date_type_2" value="2" <?php echo $li['li_date_type'] == '2' || !$li['li_date_type'] ? 'checked': ''; ?>><i></i> 년월일 방식</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 24시간 이내에 작성된 게시물의 출력방식을 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">작성일 표기방식</label>
                        </th>
                        <td>
                            <label for="li_date_kind" class="input form-width-250px">
                                <input type="text" name="li_date_kind" id="li_date_kind" value="<?php echo $li['li_date_kind'] ? $li['li_date_kind']: 'Y-m-d H:i:s'; ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 날짜 관련 표기 방식은 date() 함수를 참고해 주세요.</div>
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
</div>

<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo EYOOM_ADMIN_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
function feblatestform_submit(f) {
    return true;
}
</script>