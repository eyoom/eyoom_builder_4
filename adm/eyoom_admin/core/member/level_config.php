<?php
/**
 * @file    /adm/eyoom_admin/core/member/level_config.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200710";

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');

/**
 * 폼 action url
 */
$action_url1 = G5_ADMIN_URL . "/?dir=member&amp;pid=level_config_update&amp;smode=1";

/**
 * 기준포인트
 */
if (!$levelset['max_use_gnu_level']) {
    $levelset['max_use_gnu_level'] = 7;
}

/**
 * 포인트 증가비율
 */
if (!$levelset['calc_level_ratio']) {
    $levelset['calc_level_ratio'] = 200;
}

$mgl = !isset($_POST['max_use_gnu_level']) ? $levelset['max_use_gnu_level'] : clean_xss_tags($_POST['max_use_gnu_level']);

$cgl[2] = !isset($_POST['cnt_gnu_level_2']) ? $levelset['cnt_gnu_level_2'] : clean_xss_tags($_POST['cnt_gnu_level_2']);
$cgl[3] = !isset($_POST['cnt_gnu_level_3']) ? $levelset['cnt_gnu_level_3'] : clean_xss_tags($_POST['cnt_gnu_level_3']);
$cgl[4] = !isset($_POST['cnt_gnu_level_4']) ? $levelset['cnt_gnu_level_4'] : clean_xss_tags($_POST['cnt_gnu_level_4']);
$cgl[5] = !isset($_POST['cnt_gnu_level_5']) ? $levelset['cnt_gnu_level_5'] : clean_xss_tags($_POST['cnt_gnu_level_5']);
$cgl[6] = !isset($_POST['cnt_gnu_level_6']) ? $levelset['cnt_gnu_level_6'] : clean_xss_tags($_POST['cnt_gnu_level_6']);
$cgl[7] = !isset($_POST['cnt_gnu_level_7']) ? $levelset['cnt_gnu_level_7'] : clean_xss_tags($_POST['cnt_gnu_level_7']);
$cgl[8] = !isset($_POST['cnt_gnu_level_8']) ? $levelset['cnt_gnu_level_8'] : clean_xss_tags($_POST['cnt_gnu_level_8']);
$cgl[9] = !isset($_POST['cnt_gnu_level_9']) ? $levelset['cnt_gnu_level_9'] : clean_xss_tags($_POST['cnt_gnu_level_9']);

$clp = !isset($_POST['calc_level_point']) ? $levelset['calc_level_point'] : clean_xss_tags($_POST['calc_level_point']);
$clr = !isset($_POST['calc_level_ratio']) ? $levelset['calc_level_ratio'] : clean_xss_tags($_POST['calc_level_ratio']);

$level_table = array();

$level = 1;
for($i=2;$i<=$mgl;$i++) {
    $cnt = $cgl[$i];
    for($j=0;$j<$cnt;$j++) {
        if ($j == 0) {
            $level_table[$level]['rowspan'] = $cnt;
            $level_table[$level]['gnu_level'] = $i;

            $gnu_alias = 'gnu_alias_' . $i;
            $level_table[$level]['gnu_alias'] = $levelset[$gnu_alias];
        }
        $min = $max;
        $max = $min + $clp*$clr*$level/100;

        $level_table[$level]['eyoom_level']         = $level;
        $level_table[$level]['eyoom_level_name']    = $levelinfo[$level]['name'];
        $level_table[$level]['min'] = $min;
        $level_table[$level]['max'] = $max;
        $level_table[$level]['gap'] = $max - $min;

        $level++;
    }
}

/**
 * submit 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_URL . '" class="btn-e btn-e-lg btn-e-dark">메인으로</a> ';
$frm_submit .= '</div>';