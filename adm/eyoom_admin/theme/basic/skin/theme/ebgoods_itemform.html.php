<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/theme/ebgoods_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_ADMIN_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<div class="admin-ebgoods-form">
    <form name="febgoodsform" method="post" action="<?php echo $action_url1; ?>" onsubmit="return febgoodsform_submit(this);" class="eyoom-form">
    <input type="hidden" name="iw" value="<?php echo $gi_no ? 'u':$iw; ?>">
    <input type="hidden" name="theme" id="theme" value="<?php echo $this_theme ? $this_theme: $theme; ?>">
    <input type="hidden" name="gi_no" id="gi_no" value="<?php echo $gi['gi_no']; ?>">
    <input type="hidden" name="eg_code" id="eg_code" value="<?php echo $gi['eg_code'] ? $gi['eg_code']:$eg_code; ?>">
    <input type="hidden" name="page" value="<?php echo $page; ?>">
    <input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
    <input type="hidden" name="token" value="">

    <div class="adm-table-form-wrap margin-bottom-10">
        <header><strong><i class="fas fa-caret-right"></i> EB상품 아이템 설정</strong></header>
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
                                <label for="gi_state_1" class="radio"><input type="radio" name="gi_state" id="gi_state_1" value="1" <?php echo $gi['gi_state'] == '1' || !$gi['gi_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                                <label for="gi_state_2" class="radio"><input type="radio" name="gi_state" id="gi_state_2" value="2" <?php echo $gi['gi_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품 아이템의 출력여부를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력순서</label>
                        </th>
                        <td>
                            <label for="gi_sort" class="input form-width-250px">
                                <i class="icon-append fas fa-sort-numeric-down"></i>
                                <input type="text" name="gi_sort" id="gi_sort" value="<?php echo $gi['gi_sort'] ? $gi['gi_sort']: $gi_max_sort; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">타이틀</label>
                        </th>
                        <td>
                            <label for="gi_title" class="input">
                                <input type="text" name="gi_title" id="gi_title" value="<?php echo $gi['gi_title']; ?>" required>
                            </label>
                            <div class="note"><strong>Note:</strong> 예) 자유게시판, 질문과 답변</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">보기권한 설정</label>
                        </th>
                        <td>
                            <label for="gi_view_level" class="select form-width-250px">
                                <?php echo get_member_level_select('gi_view_level', 1, 10, $gi['gi_view_level']); ?><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">대표 연결주소 [링크]</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="gi_link" class="input form-width-350px">
                                        <i class="icon-prepend fas fa-link"></i>
                                        <input type="text" name="gi_link" id="gi_link" value="<?php echo $gi['gi_link']; ?>">
                                    </label>
                                </span>
                                <span>
                                    <label for="gi_target" class="select form-width-150px">
                                        <select name="gi_target" id="gi_target">
                                            <option value="">타겟을 선택하세요.</option>
                                            <option value="_blank" <?php echo $gi['gi_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                                            <option value="_self" <?php echo $gi['gi_target'] == '_self' || !$gi['gi_target'] ? 'selected':''; ?>>현재창</option>
                                        </select><i></i>
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> EB상품 아이템에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
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
        <header><strong><i class="fas fa-caret-right"></i> 상품 대상 선택</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">카테고리 (ca_id)</label>
                        </th>
                        <td>
                            <label for="gi_ca_id" class="select form-width-250px">
                                <select name="gi_ca_id" id="gi_ca_id">
                                    <option value="">::전체상품::</option>
                                    <?php echo conv_selected_option($category_select, $gi['gi_ca_id']); ?>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 추출하고자 하는 카테고리를 선택해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">포함 카테고리 (ca_id)</label>
                        </th>
                        <td>
                            <label for="gi_include" class="input">
                                <input type="text" name="gi_include" id="gi_include" value="<?php echo $gi['gi_include']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 여러 카테고리의 상품을 동시에 불러옵니다. 쉼표(,)로 구분하여 ca_id를 입력해 주세요.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">제외 카테고리 (ca_id)</label>
                        </th>
                        <td>
                            <label for="gi_exclude" class="input">
                                <input type="text" name="gi_exclude" id="gi_exclude" value="<?php echo $gi['gi_exclude']; ?>">
                            </label>
                            <div class="note"><strong>Note:</strong> 제외하고 싶은 게시판의 ca_id를 쉼표(,)로 구분하여 입력해 주세요.</div>
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
        <header><strong><i class="fas fa-caret-right"></i> 추출 옵션</strong></header>
        <div class="table-list-eb">
            <?php if (!G5_IS_MOBILE) { ?>
            <div class="table-responsive">
            <?php } ?>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력상품수</label>
                        </th>
                        <td>
                            <label for="gi_count" class="input form-width-250px">
                                <i class="icon-append">개</i>
                                <input type="text" name="gi_count" id="gi_count" value="<?php echo $gi['gi_count'] ? $gi['gi_count']: 8; ?>" required maxlength="2">
                            </label>
                            <div class="note"><strong>Note:</strong> 추출하고자 하는 상품수를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">출력방식</label>
                        </th>
                        <td>
                            <label for="gi_sortby" class="select form-width-250px">
                                <select name="gi_sortby" id="gi_sortby">
                                    <option value="">::출력방식선택::</option>
                                    <option value="1" <?php echo $gi['gi_sortby'] == '1' ? 'selected':''; ?>>최신등록순</option>
                                    <option value="2" <?php echo $gi['gi_sortby'] == '2' ? 'selected':''; ?>>판매많은순</option>
                                    <option value="3" <?php echo $gi['gi_sortby'] == '3' ? 'selected':''; ?>>낮은가격순</option>
                                    <option value="4" <?php echo $gi['gi_sortby'] == '4' ? 'selected':''; ?>>높은가격순</option>
                                    <option value="5" <?php echo $gi['gi_sortby'] == '5' ? 'selected':''; ?>>평점높은순</option>
                                    <option value="6" <?php echo $gi['gi_sortby'] == '6' ? 'selected':''; ?>>후기많은순</option>
                                </select><i></i>
                            </label>
                            <div class="note"><strong>Note:</strong> 출력대상이 되는 상품의 출력방식을을 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품 이미지 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_img_1" class="radio"><input type="radio" name="gi_view_img" id="gi_view_img_1" value="y" <?php echo $li['gi_view_img'] == 'y' || !$li['gi_view_img'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_img_2" class="radio"><input type="radio" name="gi_view_img" id="gi_view_img_2" value="n" <?php echo $li['gi_view_img'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품 이미지 출력 여부를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">이미지 사이즈</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <span>
                                    <label for="gi_img_width" class="input form-width-200px">
                                        <i class="icon-prepend">폭</i>
                                        <i class="icon-append text-width">px</i>
                                        <input type="text" name="gi_img_width" id="gi_img_width" value="<?php echo $gi['gi_img_width'] ? $gi['gi_img_width']: 300; ?>" class="text-right">
                                    </label>
                                </span>
                                <span> X </span>
                                <span>
                                    <label for="gi_img_height" class="input form-width-200px">
                                        <i class="icon-prepend text-width">높이</i>
                                        <i class="icon-append text-width">px</i>
                                        <input type="text" name="gi_img_height" id="gi_img_height" value="<?php echo $gi['gi_img_height'] ? $gi['gi_img_height']: 0; ?>" class="text-right">
                                    </label>
                                </span>
                            </div>
                            <div class="note"><strong>Note:</strong> 최신글 스킨이 갤러리 또는 웹진 타입일 경우, 출력 이미지의 사이즈를 설정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품아이디 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_id_1" class="radio"><input type="radio" name="gi_view_it_id" id="gi_view_it_id_1" value="y" <?php echo $gi['gi_view_it_id'] == 'y' || !$gi['gi_view_it_id'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_id_2" class="radio"><input type="radio" name="gi_view_it_id" id="gi_view_it_id_2" value="n" <?php echo $gi['gi_view_it_id'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품아이디(it_id) 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">상품명 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_name_1" class="radio"><input type="radio" name="gi_view_it_name" id="gi_view_it_name_1" value="y" <?php echo $gi['gi_view_it_name'] == 'y' || !$gi['gi_view_it_name'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_name_2" class="radio"><input type="radio" name="gi_view_it_name" id="gi_view_it_name_2" value="n" <?php echo $gi['gi_view_it_name'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품명 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">기본설명 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_basic_1" class="radio"><input type="radio" name="gi_view_it_basic" id="gi_view_it_basic_1" value="y" <?php echo $gi['gi_view_it_basic'] == 'y' || !$gi['gi_view_it_basic'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_basic_2" class="radio"><input type="radio" name="gi_view_it_basic" id="gi_view_it_basic_2" value="n" <?php echo $gi['gi_view_it_basic'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품명 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">소비자가 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_cust_price_1" class="radio"><input type="radio" name="gi_view_it_cust_price" id="gi_view_it_cust_price_1" value="y" <?php echo $gi['gi_view_it_cust_price'] == 'y' || !$gi['gi_view_it_cust_price'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_cust_price_2" class="radio"><input type="radio" name="gi_view_it_cust_price" id="gi_view_it_cust_price_2" value="n" <?php echo $gi['gi_view_it_cust_price'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 소비자가 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">판매가 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_price_1" class="radio"><input type="radio" name="gi_view_it_price" id="gi_view_it_price_1" value="y" <?php echo $gi['gi_view_it_price'] == 'y' || !$gi['gi_view_it_price'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_price_2" class="radio"><input type="radio" name="gi_view_it_price" id="gi_view_it_price_2" value="n" <?php echo $gi['gi_view_it_price'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 상품 판매가격 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">아이콘 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_it_icon_1" class="radio"><input type="radio" name="gi_view_it_icon" id="gi_view_it_icon_1" value="y" <?php echo $gi['gi_view_it_icon'] == 'y' || !$gi['gi_view_it_icon'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_it_icon_2" class="radio"><input type="radio" name="gi_view_it_icon" id="gi_view_it_icon_2" value="n" <?php echo $gi['gi_view_it_icon'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 인기상품, 신상품, 품절등을 알리는 아이콘의 출력 여부를 결정합니다.</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-form-th">
                            <label class="label">소셜버튼 출력 여부</label>
                        </th>
                        <td>
                            <div class="inline-group">
                                <label for="gi_view_sns_1" class="radio"><input type="radio" name="gi_view_sns" id="gi_view_sns_1" value="y" <?php echo $gi['gi_view_sns'] == 'y' || !$gi['gi_view_sns'] ? 'checked': ''; ?>><i></i> 사용</label>
                                <label for="gi_view_sns_2" class="radio"><input type="radio" name="gi_view_sns" id="gi_view_sns_2" value="n" <?php echo $gi['gi_view_sns'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                            </div>
                            <div class="note"><strong>Note:</strong> 소셜사이트 연동 버튼의 출력 여부를 결정합니다.</div>
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
function febgoodsform_submit(f) {
    return true;
}
</script>