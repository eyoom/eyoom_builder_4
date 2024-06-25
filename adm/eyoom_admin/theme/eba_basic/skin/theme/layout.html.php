<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/cpannel/layout.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.cpannel-layout {width:240px;overflow-x:hidden}
.cpannel-layout h6 {margin:10px 0;color:#959595;font-weight:700}
.cpannel-layout h6 i {color:#c5c5c5}
.cpannel-layout .cpannel-select-left {float:left;width:140px}
.cpannel-layout .cpannel-select-right {float:right;width:90px}
.cpannel-layout .margin-top-30 {margin-top:30px}
.cpannel-layout .margin-bottom-30 {margin-bottom:30px}
</style>

<div class="cpannel-layout">
    <form name="flayout" method="post" action="<?php echo $action_url1; ?>" class="eyoom-form">
    <input type="hidden" name="theme" id="theme" value="<?php echo $theme; ?>">

    <h5 class="m-b-20"><strong>테마 레이아웃 설정</strong></h5>
    
    <h6>테마유형 설정</h6>
    <div class="inline-group">
        <label for="is_responsive1" class="radio dark-radio"><input type="radio" name="is_responsive" id="is_responsive1" value="1" <?php echo $eyoom['is_responsive'] == '1' ? 'checked': '';?>><i></i> 반응형</label>
        <label for="is_responsive2" class="radio dark-radio"><input type="radio" name="is_responsive" id="is_responsive2" value="0" <?php echo $eyoom['is_responsive'] == '0' ? 'checked': '';?>><i></i> 비반응형</label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>레이아웃 모양</h6>
    <div class="inline-group">
        <label for="layout1" class="radio dark-radio"><input type="radio" name="layout" id="layout1" value="wide" <?php echo $eyoom['layout'] == 'wide' || !$eyoom['layout'] ? 'checked': ''; ?>><i></i> 와이드형</label>
        <label for="layout2" class="radio dark-radio"><input type="radio" name="layout" id="layout2" value="boxed" <?php echo $eyoom['layout'] == 'boxed' ? 'checked': ''; ?>><i></i> 박스형</label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>상단메뉴 스크롤시 고정</h6>
    <input type="hidden" name="sticky" id="sticky" value="<?php echo !$eyoom['sticky'] ? 'y': $eyoom['sticky']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="sticky" <?php echo $eyoom['sticky'] == 'y' || !$eyoom['sticky'] ? 'checked':''; ?>><i></i><span>고정하기</span>
    </label>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>홈페이지 메인 사이드</h6>
    <input type="hidden" name="use_main_side_layout" id="use_main_side_layout" value="<?php echo !$eyoom['use_main_side_layout'] ? 'y': $eyoom['use_main_side_layout']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_main_side_layout" <?php echo $eyoom['use_main_side_layout'] == 'y' || !$eyoom['use_main_side_layout'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <div class="inline-group">
        <label for="pos_main_side_layout1" class="radio dark-radio"><input type="radio" name="pos_main_side_layout" id="pos_main_side_layout1" value="left" <?php echo $eyoom['pos_main_side_layout'] == 'left' ? 'checked': ''; ?>><i></i> 왼쪽</label>
        <label for="pos_main_side_layout2" class="radio dark-radio"><input type="radio" name="pos_main_side_layout" id="pos_main_side_layout2" value="right" <?php echo $eyoom['pos_main_side_layout'] == 'right' ? 'checked': ''; ?>><i></i> 오른쪽</label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>홈페이지 서브 사이드</h6>
    <input type="hidden" name="use_sub_side_layout" id="use_sub_side_layout" value="<?php echo !$eyoom['use_sub_side_layout'] ? 'y': $eyoom['use_sub_side_layout']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_sub_side_layout" <?php echo $eyoom['use_sub_side_layout'] == 'y' || !$eyoom['use_sub_side_layout'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <div class="inline-group">
        <label for="pos_sub_side_layout1" class="radio dark-radio"><input type="radio" name="pos_sub_side_layout" id="pos_sub_side_layout1" value="left" <?php echo $eyoom['pos_sub_side_layout'] == 'left' ? 'checked': ''; ?>><i></i> 왼쪽</label>
        <label for="pos_sub_side_layout2" class="radio dark-radio"><input type="radio" name="pos_sub_side_layout" id="pos_sub_side_layout2" value="right" <?php echo $eyoom['pos_sub_side_layout'] == 'right' ? 'checked': ''; ?>><i></i> 오른쪽</label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <?php if ($eyoom['is_shop_theme'] == 'y' || $is_admin) { ?>
    <h6>쇼핑몰 메인 사이드</h6>
    <input type="hidden" name="use_shopmain_side_layout" id="use_shopmain_side_layout" value="<?php echo !$eyoom['use_shopmain_side_layout'] ? 'y': $eyoom['use_shopmain_side_layout']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_shopmain_side_layout" <?php echo $eyoom['use_shopmain_side_layout'] == 'y' || !$eyoom['use_shopmain_side_layout'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <div class="inline-group">
        <label for="pos_shopmain_side_layout1" class="radio dark-radio"><input type="radio" name="pos_shopmain_side_layout" id="pos_shopmain_side_layout1" value="left" <?php echo $eyoom['pos_shopmain_side_layout'] == 'left' ? 'checked': ''; ?>><i></i> 왼쪽</label>
        <label for="pos_shopmain_side_layout2" class="radio dark-radio"><input type="radio" name="pos_shopmain_side_layout" id="pos_shopmain_side_layout2" value="right" <?php echo $eyoom['pos_shopmain_side_layout'] == 'right' ? 'checked': ''; ?>><i></i> 오른쪽</label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>쇼핑몰 서브 사이드</h6>
    <input type="hidden" name="use_shopsub_side_layout" id="use_shopsub_side_layout" value="<?php echo !$eyoom['use_shopsub_side_layout'] ? 'y': $eyoom['use_shopsub_side_layout']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_shopsub_side_layout" <?php echo $eyoom['use_shopsub_side_layout'] == 'y' || !$eyoom['use_shopsub_side_layout'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <div class="inline-group">
        <label for="pos_shopsub_side_layout1" class="radio dark-radio"><input type="radio" name="pos_shopsub_side_layout" id="pos_shopsub_side_layout1" value="left" <?php echo $eyoom['pos_shopsub_side_layout'] == 'left' ? 'checked': ''; ?>><i></i> 왼쪽</label>
        <label for="pos_shopsub_side_layout2" class="radio dark-radio"><input type="radio" name="pos_shopsub_side_layout" id="pos_shopsub_side_layout2" value="right" <?php echo $eyoom['pos_shopsub_side_layout'] == 'right' ? 'checked': ''; ?>><i></i> 오른쪽</label>
    </div>
    <div class="clearfix"></div>
    <?php } ?>

    <?php echo $frm_submit; ?>

    <h5 class="m-b-20"><strong>기능성 스킨 &amp; 권한 설정</strong></h5>

    <h6>아웃로그인</h6>
    <input type="hidden" name="use_outlogin_skin" id="use_outlogin_skin" value="<?php echo !$eyoom['use_outlogin_skin'] ? 'y': $eyoom['use_outlogin_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_outlogin_skin" <?php echo $eyoom['use_outlogin_skin'] == 'y' || !$eyoom['use_outlogin_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['outlogin']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="outlogin_skin" id="outlogin_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['outlogin']); $i++) { ?>
                <option value="<?php echo $skins['outlogin'][$i]; ?>" <?php echo get_selected($eyoom['outlogin_skin'], $skins['outlogin'][$i]); ?>><?php echo $skins['outlogin'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_outlogin" class="select">
            <?php echo get_member_level_select('view_level_outlogin', 1, 10, $eyoom['view_level_outlogin']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>설문조사</h6>
    <input type="hidden" name="use_poll_skin" id="use_poll_skin" value="<?php echo !$eyoom['use_poll_skin'] ? 'y': $eyoom['use_poll_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_poll_skin" <?php echo $eyoom['use_poll_skin'] == 'y' || !$eyoom['use_poll_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['poll']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="poll_skin" id="poll_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['poll']); $i++) { ?>
                <option value="<?php echo $skins['poll'][$i]; ?>" <?php echo get_selected($eyoom['poll_skin'], $skins['poll'][$i]); ?>><?php echo $skins['poll'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_poll" class="select">
            <?php echo get_member_level_select('view_level_poll', 1, 10, $eyoom['view_level_poll']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>회원랭킹</h6>
    <input type="hidden" name="use_ranking_skin" id="use_ranking_skin" value="<?php echo !$eyoom['use_ranking_skin'] ? 'y': $eyoom['use_ranking_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_ranking_skin" <?php echo $eyoom['use_ranking_skin'] == 'y' || !$eyoom['use_ranking_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['ranking']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="ranking_skin" id="ranking_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['ranking']); $i++) { ?>
                <option value="<?php echo $skins['ranking'][$i]; ?>" <?php echo get_selected($eyoom['ranking_skin'], $skins['ranking'][$i]); ?>><?php echo $skins['ranking'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_ranking" class="select">
            <?php echo get_member_level_select('view_level_ranking', 1, 10, $eyoom['view_level_ranking']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>인기검색어</h6>
    <input type="hidden" name="use_popular_skin" id="use_popular_skin" value="<?php echo !$eyoom['use_popular_skin'] ? 'y': $eyoom['use_popular_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_popular_skin" <?php echo $eyoom['use_popular_skin'] == 'y' || !$eyoom['use_popular_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['ranking']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="popular_skin" id="popular_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['popular']); $i++) { ?>
                <option value="<?php echo $skins['popular'][$i]; ?>" <?php echo get_selected($eyoom['popular_skin'], $skins['popular'][$i]); ?>><?php echo $skins['popular'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_popular" class="select">
            <?php echo get_member_level_select('view_level_popular', 1, 10, $eyoom['view_level_popular']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>태그</h6>
    <input type="hidden" name="use_tag_skin" id="use_tag_skin" value="<?php echo !$eyoom['use_tag_skin'] ? 'y': $eyoom['use_tag_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_tag_skin" <?php echo $eyoom['use_tag_skin'] == 'y' || !$eyoom['use_tag_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['ranking']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="tag_skin" id="tag_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['tag']); $i++) { ?>
                <option value="<?php echo $skins['tag'][$i]; ?>" <?php echo get_selected($eyoom['tag_skin'], $skins['tag'][$i]); ?>><?php echo $skins['tag'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_tag" class="select">
            <?php echo get_member_level_select('view_level_tag', 1, 10, $eyoom['view_level_tag']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <h6>방문자통계</h6>
    <input type="hidden" name="use_visit_skin" id="use_visit_skin" value="<?php echo !$eyoom['use_visit_skin'] ? 'y': $eyoom['use_visit_skin']; ?>">
    <label class="toggle small-toggle green-toggle">
        <input type="checkbox" class="btn_toggle" value="use_visit_skin" <?php echo $eyoom['use_visit_skin'] == 'y' || !$eyoom['use_visit_skin'] ? 'checked':''; ?>><i></i><span>보이기</span>
    </label>
    <?php if ($skins['ranking']) { ?>
    <div class="cpannel-select-left">
        <label class="select">
            <select name="visit_skin" id="visit_skin" required="required">
                <option value="">선택</option>
                <?php for($i=0; $i<count((array)$skins['visit']); $i++) { ?>
                <option value="<?php echo $skins['visit'][$i]; ?>" <?php echo get_selected($eyoom['visit_skin'], $skins['visit'][$i]); ?>><?php echo $skins['visit'][$i]; ?></option>
                <?php } ?>
            </select><i></i>
        </label>
    </div>
    <?php }?>
    <div class="cpannel-select-right">
        <label for="view_level_visit" class="select">
            <?php echo get_member_level_select('view_level_visit', 1, 10, $eyoom['view_level_visit']); ?><i></i>
        </label>
    </div>
    <div class="clearfix"></div>
    <div class="margin-hr-5"></div>

    <?php echo $frm_submit; ?>

    </form>
</div>

<script>
$(function() {
    $(".btn_toggle").click(function() {
        var $id = $(this).val();
        var $val = $("#"+$id).val();
        if ($val == 'y') {
            $("#"+$id).val('n');
        } else if ($val == 'n') {
            $("#"+$id).val('y');
        }
    });
});
</script>