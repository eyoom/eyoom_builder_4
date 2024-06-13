<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/ebgoods_itemform.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
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

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>EB상품 아이템 설정</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">게시여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_state_1" class="radio"><input type="radio" name="gi_state" id="gi_state_1" value="1" <?php echo $gi['gi_state'] == '1' || !$gi['gi_state'] ? 'checked':''; ?>><i></i> 보이기</label>
                    <label for="gi_state_2" class="radio"><input type="radio" name="gi_state" id="gi_state_2" value="2" <?php echo $gi['gi_state'] == '2' ? 'checked':''; ?>><i></i> 숨기기</label>
                </div>
                <div class="note"><strong>Note:</strong> 상품 아이템의 출력여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_sort" class="label">출력순서</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append fas fa-sort-numeric-down"></i>
                    <input type="text" name="gi_sort" id="gi_sort" value="<?php echo $gi['gi_sort'] ? $gi['gi_sort']: $gi_max_sort; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 출력순서를 결정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_title" class="label">타이틀</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="gi_title" id="gi_title" value="<?php echo $gi['gi_title']; ?>" required>
                </label>
                <div class="note"><strong>Note:</strong> EB상품 아이템의 타이틀을 입력합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_view_level" class="label">보기권한 설정</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <?php echo get_member_level_select('gi_view_level', 1, 10, $gi['gi_view_level']); ?><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 그누레벨 이상 회원에게 표시</div>
            </div>
        </div>
        <div class="adm-form-tr adm-sm-100">
            <div class="adm-form-td td-l">
                <label class="label">대표 연결주소 [링크]</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="gi_target" id="gi_target">
                        <option value="">타겟을 선택하세요.</option>
                        <option value="_blank" <?php echo $gi['gi_target'] == '_blank' ? 'selected':''; ?>>새창</option>
                        <option value="_self" <?php echo $gi['gi_target'] == '_self' ? 'selected':''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="gi_link" id="gi_link" value="<?php echo $gi['gi_link']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> EB상품 아이템에서 사용할 링크주소를 입력해 주세요. 예) <?php echo G5_URL; ?></div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>상품 대상 선택</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_ca_id" class="label">카테고리 (ca_id)</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
                    <select name="gi_ca_id" id="gi_ca_id">
                        <option value="">::전체상품::</option>
                        <?php echo conv_selected_option($category_select, $gi['gi_ca_id']); ?>
                    </select><i></i>
                </label>
                <div class="note"><strong>Note:</strong> 추출하고자 하는 카테고리를 선택해 주세요.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_include" class="label">포함 카테고리 (ca_id)</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="gi_include" id="gi_include" value="<?php echo $gi['gi_include']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 여러 카테고리의 상품을 동시에 불러옵니다. 쉼표(,)로 구분하여 ca_id를 입력해 주세요.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_exclude" class="label">제외 카테고리 (ca_id)</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="gi_exclude" id="gi_exclude" value="<?php echo $gi['gi_exclude']; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 제외하고 싶은 카테고리의 ca_id를 쉼표(,)로 구분하여 입력해 주세요.</div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>추출 옵션</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_count" class="label">출력상품수</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">개</i>
                    <input type="text" name="gi_count" id="gi_count" value="<?php echo $gi['gi_count'] ? $gi['gi_count']: 8; ?>" class="text-end" required maxlength="2">
                </label>
                <div class="note"><strong>Note:</strong> 추출하고자 하는 상품수를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="gi_sortby" class="label">출력방식</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-250px">
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
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">상품 이미지 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_img_1" class="radio"><input type="radio" name="gi_view_img" id="gi_view_img_1" value="y" <?php echo $li['gi_view_img'] == 'y' || !$li['gi_view_img'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_img_2" class="radio"><input type="radio" name="gi_view_img" id="gi_view_img_2" value="n" <?php echo $li['gi_view_img'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 상품 이미지 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">이미지 사이즈</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label for="gi_img_width" class="input width-200px">
                            <i class="icon-prepend">폭</i>
                            <i class="icon-append">px</i>
                            <input type="text" name="gi_img_width" id="gi_img_width" value="<?php echo $gi['gi_img_width'] ? $gi['gi_img_width']: 300; ?>" class="text-end">
                        </label>
                    </span>
                    <span> X </span>
                    <span>
                        <label for="gi_img_height" class="input width-200px">
                            <i class="icon-prepend">높이</i>
                            <i class="icon-append">px</i>
                            <input type="text" name="gi_img_height" id="gi_img_height" value="<?php echo $gi['gi_img_height'] ? $gi['gi_img_height']: 0; ?>" class="text-end">
                        </label>
                    </span>
                </div>
                <div class="note"><strong>Note:</strong> 상품 이미지 사이즈를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">상품아이디 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_id_1" class="radio"><input type="radio" name="gi_view_it_id" id="gi_view_it_id_1" value="y" <?php echo $gi['gi_view_it_id'] == 'y' || !$gi['gi_view_it_id'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_id_2" class="radio"><input type="radio" name="gi_view_it_id" id="gi_view_it_id_2" value="n" <?php echo $gi['gi_view_it_id'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 상품아이디(it_id) 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">상품명 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_name_1" class="radio"><input type="radio" name="gi_view_it_name" id="gi_view_it_name_1" value="y" <?php echo $gi['gi_view_it_name'] == 'y' || !$gi['gi_view_it_name'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_name_2" class="radio"><input type="radio" name="gi_view_it_name" id="gi_view_it_name_2" value="n" <?php echo $gi['gi_view_it_name'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 상품명 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">기본설명 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_basic_1" class="radio"><input type="radio" name="gi_view_it_basic" id="gi_view_it_basic_1" value="y" <?php echo $gi['gi_view_it_basic'] == 'y' || !$gi['gi_view_it_basic'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_basic_2" class="radio"><input type="radio" name="gi_view_it_basic" id="gi_view_it_basic_2" value="n" <?php echo $gi['gi_view_it_basic'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 기본설명 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">소비자가 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_cust_price_1" class="radio"><input type="radio" name="gi_view_it_cust_price" id="gi_view_it_cust_price_1" value="y" <?php echo $gi['gi_view_it_cust_price'] == 'y' || !$gi['gi_view_it_cust_price'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_cust_price_2" class="radio"><input type="radio" name="gi_view_it_cust_price" id="gi_view_it_cust_price_2" value="n" <?php echo $gi['gi_view_it_cust_price'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 소비자가 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">판매가 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_price_1" class="radio"><input type="radio" name="gi_view_it_price" id="gi_view_it_price_1" value="y" <?php echo $gi['gi_view_it_price'] == 'y' || !$gi['gi_view_it_price'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_price_2" class="radio"><input type="radio" name="gi_view_it_price" id="gi_view_it_price_2" value="n" <?php echo $gi['gi_view_it_price'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 상품 판매가격 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">아이콘 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_it_icon_1" class="radio"><input type="radio" name="gi_view_it_icon" id="gi_view_it_icon_1" value="y" <?php echo $gi['gi_view_it_icon'] == 'y' || !$gi['gi_view_it_icon'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_it_icon_2" class="radio"><input type="radio" name="gi_view_it_icon" id="gi_view_it_icon_2" value="n" <?php echo $gi['gi_view_it_icon'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 히트상품, 추천상품, 최신상품, 인기상품, 할인상품, 품절 등을 알리는 아이콘의 출력 여부를 설정합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">소셜버튼 출력 여부</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <label for="gi_view_sns_1" class="radio"><input type="radio" name="gi_view_sns" id="gi_view_sns_1" value="y" <?php echo $gi['gi_view_sns'] == 'y' || !$gi['gi_view_sns'] ? 'checked': ''; ?>><i></i> 사용</label>
                    <label for="gi_view_sns_2" class="radio"><input type="radio" name="gi_view_sns" id="gi_view_sns_2" value="n" <?php echo $gi['gi_view_sns'] == 'n' ? 'checked': ''; ?>><i></i> 사용하지 않음</label>
                </div>
                <div class="note"><strong>Note:</strong> 소셜사이트 연동 버튼의 출력 여부를 설정합니다.</div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script>
function febgoodsform_submit(f) {
    return true;
}
</script>