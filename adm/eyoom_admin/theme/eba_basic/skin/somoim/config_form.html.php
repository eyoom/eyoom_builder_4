<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/somoim/config_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'config_form';
$g5_title = '소모임 기본설정';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">소모임관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-config-form">
    <form name="fsomoconfig" id="fsomoconfig" method="post" action="<?php echo $action_url1; ?>" onsubmit="return fsomoconfig_submit(this);" class="eyoom-form">
    <input type="hidden" name="token" id="token" value="">

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>기본설정</strong></div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_prepned" class="label">소모임 ID 머릿글자<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <input type="text" name="sm_prepned" id="sm_prepned" value="<?php echo $somo['sm_prepned'] ? $somo['sm_prepned']: 'so_'; ?>">
                </label>
                <div class="note"><strong>Note:</strong> 소모임 ID의 머릿글자입니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_goods_for_open" class="label">소모임 개설조건<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">추천</i>
                    <input type="text" name="sm_goods_for_open" id="sm_goods_for_open" value="<?php echo isset($somo['sm_goods_for_open']) ? $somo['sm_goods_for_open']: '10'; ?>" class="text-end">
                </label>
                <div class="note"><strong>Note:</strong> 소모임 신청 게시판에서 위 추천수를 만족할 경우 개설조건을 충족합니다.</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_goods_for_open" class="label">새글 지정시간<strong class="sound_only">필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input max-width-250px">
                    <i class="icon-append">시간</i>
                    <input type="text" name="sm_newpost_hour" id="sm_newpost_hour" value="<?php echo $somo['sm_newpost_hour'] ? $somo['sm_newpost_hour']: '24'; ?>" class="text-end">
                </label>
                <div class="note"><strong>Note:</strong> 소모임 게시판에 글 입력후 새글로 인정하는 기준 시간</div>
            </div>
        </div>
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sm_category_list" class="label">카테고리</label>
            </div>
            <div class="adm-form-td td-r">
                <label class="input">
                    <input type="text" name="sm_category_list" id="sm_category_list" value="<?php echo get_text($somo['sm_category_list']); ?>">
                </label>
                <div class="note"><strong>Note:</strong> 분류와 분류 사이는 | 로 구분하세요. (예: 동물|프로그램) 첫자로 #은 입력하지 마세요. (예: #질문|#답변 [X])<br>분류명에 일부 특수문자 ()/ 는 사용할수 없습니다.</div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>소모임 활동 점수</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="sm_write_point" class="label">게시글 점수<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">점</i>
                        <input type="text" name="sm_write_point" id="sm_write_point" value="<?php echo $somo['sm_write_point'] ? $somo['sm_write_point']: '100'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 게시물이 작성될 때 점수가 추가됩니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="sm_cmt_point" class="label">댓글 점수<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">점</i>
                        <input type="text" name="sm_cmt_point" id="sm_cmt_point" value="<?php echo $somo['sm_cmt_point'] ? $somo['sm_cmt_point']: '30'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 댓글이 작성될 때 점수가 추가됩니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="sm_good_point" class="label">추천 점수<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">점</i>
                        <input type="text" name="sm_good_point" id="sm_good_point" value="<?php echo $somo['sm_good_point'] ? $somo['sm_good_point']: '1'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 게시물 추천 시 점수가 추가됩니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="sm_nogood_point" class="label">비추천 점수<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">점</i>
                        <input type="text" name="sm_nogood_point" id="sm_nogood_point" value="<?php echo $somo['sm_nogood_point'] ? $somo['sm_nogood_point']: '-1'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 게시물 비추천 시 점수가 삭감됩니다.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt m-b-20">
        <?php echo $frm_submit; ?>
    </div>

    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>소모임 랭킹 설정</strong></div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="sm_ranking_reset" class="label">랭킹 리셋 시간<strong class="sound_only">필수</strong></label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">시간</i>
                        <input type="text" name="sm_ranking_reset" id="sm_ranking_reset" value="<?php echo $somo['sm_ranking_reset'] ? $somo['sm_ranking_reset']: '1'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 소모임 랭킹이 반영되는 주기입니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="sm_ranking_main_cnt" class="label">랭킹 소모임 메인 출력수 </label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">건</i>
                        <input type="text" name="sm_ranking_main_cnt" id="sm_ranking_main_cnt" value="<?php echo $somo['sm_ranking_main_cnt'] ? $somo['sm_ranking_main_cnt']: '50'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 소모임 메인 화면에 출력될 소모임 랭킹의 출력수를 지정합니다.</div>
                </div>
            </div>
        </div>
        <div class="adm-form-tr-wrap">
            <div class="adm-form-tr tr-l">
                <div class="adm-form-td td-l">
                    <label for="sm_ranking_side_cnt" class="label">랭킹 소모임 사이드메뉴 출력수 </label>
                </div>
                <div class="adm-form-td td-r">
                    <label class="input max-width-250px">
                        <i class="icon-append">건</i>
                        <input type="text" name="sm_ranking_side_cnt" id="sm_ranking_side_cnt" value="<?php echo $somo['sm_ranking_side_cnt'] ? $somo['sm_ranking_side_cnt']: '20'; ?>" class="text-end">
                    </label>
                    <div class="note"><strong>Note:</strong> 소모임 사이드메뉴 출력될 소모임 랭킹의 출력수를 지정합니다.</div>
                </div>
            </div>
            <div class="adm-form-tr tr-r">
                <div class="adm-form-td td-l">
                    <label for="sm_ranking_side_cnt" class="label">최근 업데이트 시간 </label>
                </div>
                <div class="adm-form-td td-r">
                    <?php echo $somo['sm_ranking_lasttime'] ? date('Y-m-d H:i:s', $somo['sm_ranking_lasttime']): '-'; ?>
                    <input type="hidden" name="sm_ranking_lasttime" value="<?php echo $somo['sm_ranking_lasttime']; ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn-alt">
        <?php echo $frm_submit; ?>
    </div>

    </form>
</div>

<script>
function fsomoconfig_submit(f) {
    f.action = "<?php echo $action_url1; ?>";
    return true;
}
</script>