<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/theme/menu_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.checkbox {border:0}
</style>

<div class="admin-menu-form">
    <input type="hidden" name="me_code" id="me_code" value="<?php echo $me_code; ?>">
    <input type="hidden" name="me_shop" id="me_shop" value="<?php echo $me_shop; ?>">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $me_code === '1' || !$me_code ? '메뉴생성':'메뉴수정 및 삭제'; ?></strong></div>
        <?php if ($me_code === '1' || !$me_code) { ?>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label class="label">메뉴위치</label>
            </div>
            <div class="adm-form-td td-r">
                <strong class="text-indigo"><?php echo $me_shop == '1' ? '쇼핑몰':'커뮤니티'; ?> 메뉴 루트</strong>
            </div>
        </div>
        <?php } else { ?>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">메뉴코드</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input state-disabled max-width-250px">
                        <input type="text" disabled value="<?php echo $meinfo['me_code']; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 분류코드는 고유코드로 수정하실 수 없습니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="me_order" class="label">출력순서</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-150px">
                        <i class="icon-append fas fa-sort-numeric-down"></i>
                        <input type="text" name="me_order" id="me_order" value="<?php echo $meinfo['me_order']; ?>">
                        <input type="hidden" name="me_order_prev" id="me_order_prev" value="<?php echo $meinfo['me_order']; ?>">
                    </label>
                    <div class="note"><strong>Note:</strong> 작은 숫자가 먼저 출력됩니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="me_icon" class="label">폰트어썸 아이콘</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input input-button max-width-300px">
                    <input type="text" name="me_icon" id="me_icon" value="<?php echo $meinfo['me_icon']; ?>">
                    <a href="https://fontawesome.com/v5/search?m=free" target="_blank" class="button">Font Awesome</a>
                </label>
                <div class="note"><strong>예:</strong> fas fa-circle 또는 far fa-circle</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="me_name" class="label">메뉴명<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="me_name" id="me_name" value="<?php echo $meinfo['me_name']; ?>" required>
                    <input type="hidden" name="me_name_prev" id="me_name_prev" value="<?php echo $meinfo['me_name']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="me_path" class="label">메뉴경로<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="me_path" id="me_path" value="<?php echo $meinfo['me_path']; ?>" required>
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="me_permit_level" class="label">메뉴보이기 레벨설정</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select max-width-150px">
                    <select name="me_permit_level">
                        <?php for ($i=1; $i<=10; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php echo $i == $meinfo['me_permit_level'] ? 'selected': ''; ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select><i></i>
                </label>
                <label class="checkbox" for="apply_permit_level_submenu">
                    <input type="checkbox" name="apply_permit_level_submenu" id="apply_permit_level_submenu" value="1"><i></i> 하위메뉴에도 동일하게 적용하기
                </label>
                <div class="note"><strong>Note : </strong> 설정한 레벨 이상 회원에게만 메뉴가 노출됩니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <div class="d-block width-100">
                    <label for="me_link" class="label">메뉴링크</label>
                    <?php if ($meinfo['me_link']) { ?>
                    <div class="m-t-10 d-block width-100"><a href="<?php echo $meinfo['me_url']; ?>" target="_blank" class="btn-e btn-e-xs btn-e-dark btn-e-block"><i class="fas fa-external-link-alt m-r-7"></i>바로가기</a></div>
                    <?php } ?>
                </div>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="me_target" id="me_target">
                        <option value="">:: 타겟 선택 ::</option>
                        <option value="blank" <?php echo $meinfo['me_target']=='blank' ? 'selected': ''; ?>>새창</option>
                        <option value="self" <?php echo $meinfo['me_target']=='self' ? 'selected': ''; ?>>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="me_link" id="me_link" value="<?php echo $meinfo['me_url']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">메뉴 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="me_use1" class="radio"><input type="radio" name="me_use" id="me_use1" value="y" <?php echo $meinfo['me_use']=='y' ? 'checked': ''; ?>><i></i> 사용</label>
                        <label for="me_use2" class="radio"><input type="radio" name="me_use" id="me_use2" value="n" <?php echo $meinfo['me_use']=='n' ? 'checked': ''; ?>><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">상단메뉴 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="me_use_nav1" class="radio"><input type="radio" name="me_use_nav" id="me_use_nav1" value="y" <?php echo $meinfo['me_use_nav']=='y' ? 'checked': ''; ?>><i></i> 사용</label>
                        <label for="me_use_nav2" class="radio"><input type="radio" name="me_use_nav" id="me_use_nav2" value="n" <?php echo $meinfo['me_use_nav']=='n' ? 'checked': ''; ?>><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">사이드 레이아웃</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="me_side1" class="radio"><input type="radio" name="me_side" id="me_side1" value="y" <?php echo $meinfo['me_side']=='y' ? 'checked': ''; ?>><i></i> 사용</label>
                        <label for="me_side2" class="radio"><input type="radio" name="me_side" id="me_side2" value="n" <?php echo $meinfo['me_side']=='n' ? 'checked': ''; ?>><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">메뉴삭제</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="d-block m-b-10">
                        <a href="javascript:void(0);" onclick="delete_menu('<?php echo $meinfo['me_code']; ?>','<?php echo $meinfo['me_theme']; ?>');" class="btn-e btn-e-md btn-e-dark width-150px">삭제하기</a>
                    </div>
                    <i class="fas fa-exclamation-circle text-crimson m-r-7"></i><span class="exp text-gray">주의! 삭제시, 서브메뉴까지 함께 삭제됩니다.</span></span>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if ($me_code !== '1' && $me_code) {?>
    <div class="confirm-bottom-btn m-b-20">
        <input type="submit" name="act_button" value="메뉴수정" class="btn-e btn-e-lg btn-e-crimson" accesskey="s" onclick="document.pressed=this.value">
    </div>
    <?php } ?>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i><?php echo $me_code === '1' || !$me_code ? '1차메뉴 생성': $meinfo['me_name'].' <i class="fas fa-angle-right"></i> 하위메뉴 생성'; ?></strong><?php if ($subme_code) { ?><small class="f-s-13r text-gray m-l-10">선택한 메뉴의 하위 메뉴를 생성합니다.</small><?php } ?></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="subme_type" class="label">대상 선택</label>
            </div>
            <div class="adm-form-td td-r">
                <div class="inline-group">
                    <span>
                        <label class="select width-200px">
                            <select name="subme_type" id="subme_type" onchange="view_select_list(this.value);return false;">
                                <option value="userpage">직접입력</option>
                                <option value="group">게시판그룹</option>
                                <option value="board">게시판</option>
                                <option value="page">내용페이지</option>
                                <?php if ($is_youngcart) { ?>
                                <option value="shop">쇼핑몰분류</option>
                                <?php } ?>
                            </select><i></i>
                        </label>
                    </span>
                    <span>
                        <label class="select width-250px" id="selbox">
                            <select>
                                <option value=''>::대상을 선택해 주세요::</option>
                            </select><i></i>
                        </label>
                    </span>
                </div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="subme_icon" class="label">폰트어썸 아이콘</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input input-button max-width-300px">
                    <input type="text" name="subme_icon" id="subme_icon" value="">
                    <a href="https://fontawesome.com/v5/search?m=free" target="_blank" class="button">Font Awesome</a>
                </label>
                <div class="note"><strong>예:</strong> fas fa-circle 또는 far fa-circle</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="subme_name" class="label">메뉴명</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="subme_name" id="subme_name" value="">
                    <input type="hidden" name="subme_nasubme_prev" id="subme_nasubme_prev" value="">
                </label>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="subme_link" class="label">메뉴링크</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="select width-150px m-b-10">
                    <select name="subme_target" id="subme_target">
                        <option value="">:: 타겟 선택 ::</option>
                        <option value="blank">새창</option>
                        <option value="self" selected>현재창</option>
                    </select><i></i>
                </label>
                <label class="input">
                    <i class="icon-append fas fa-link"></i>
                    <input type="text" name="subme_link" id="subme_link" value="<?php echo $meinfo['subme_link']; ?>">
                </label>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="subme_permit_level" class="label">메뉴보이기 레벨설정</label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="select max-width-150px">
                        <select name="subme_permit_level">
                            <?php for ($i=1; $i<=10; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select><i></i>
                    </label>
                    <div class="note"><strong>Note : </strong> 설정한 레벨 이상 회원에게만 메뉴가 노출됩니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">메뉴 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="subme_use1" class="radio"><input type="radio" name="subme_use" id="subme_use1" value="y" checked><i></i> 사용</label>
                        <label for="subme_use2" class="radio"><input type="radio" name="subme_use" id="subme_use2" value="n"><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label class="label">상단메뉴 사용여부</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="subme_use_nav1" class="radio"><input type="radio" name="subme_use_nav" id="subme_use_nav1" value="y" checked><i></i> 사용</label>
                        <label for="subme_use_nav2" class="radio"><input type="radio" name="subme_use_nav" id="subme_use_nav2" value="n"><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label class="label">사이드 레이아웃</label>
                </div>
                <div class="adm-form-td td-r">
                    <div class="inline-group">
                        <label for="subme_side1" class="radio"><input type="radio" name="subme_side" id="subme_side1" value="y" checked><i></i> 사용</label>
                        <label for="subme_side2" class="radio"><input type="radio" name="subme_side" id="subme_side2" value="n"><i></i> 사용안함</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn">
        <input type="submit" name="act_button" value="메뉴생성" class="btn-e btn-e-lg btn-e-crimson" accesskey="s" onclick="document.pressed=this.value">
    </div>
</div>