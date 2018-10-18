<?php
/**
 * core file : /eyoom/core/board/view.head.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 자동 이동/복사 기능을 사용하고 조건값들이 있을 때
 */
if ($eyoom_board['bo_use_automove'] && $bo_automove['count'] && $bo_automove['target'] && $bo_table && $wr_id) {

    // 이동/복사 실행여부
    $is_exec = false;

    // 이동/복사 조건
    switch ($bo_automove['type']) {
        case 'hit': if($write['wr_hit'] >= $bo_automove['count']) $is_exec = true; $auto_type = '조회수'; break;
        case 'good': if($write['wr_good'] >= $bo_automove['count']) $is_exec = true; $auto_type = '추천수'; break;
        case 'nogood': if($write['wr_nogood'] >= $bo_automove['count']) $is_exec = true; $auto_type = '비추천수'; break;
    }

    // 관리자가 작성한 공지글은 제외하기
    $arr_notice = explode(',', trim($board['bo_notice']));
    // 이동/복사 실행
    if ($is_exec && !in_array($wr_id, $arr_notice)) {
        if (($write['mb_id'] && $write['mb_id']!=$config['cf_admin'] && $write['mb_id']!=$board['bo_admin']) || !$write['mb_id']) {
            define("G5_AUTOMOVE", true);
            $sw = $bo_automove['action'];
            $tg_table = $bo_automove['target'];
            $_POST['chk_bo_table'] = array($tg_table);
            $wr_id_list = $wr_id;

            $binfo = sql_fetch("select bo_subject from {$g5['board_table']} where bo_table = '{$tg_table}'");

            switch ($sw) {
                case 'copy': $act = '복사'; break;
                case 'move': $act = '이동'; break;
            }

            @include_once(EYOOM_CORE_PATH . "/board/move_update.php");
        }
    }
}