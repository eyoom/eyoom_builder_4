<?php
/**
 * lib file : /eyoom/lib/connect.lib.php
 */

if (!defined('_EYOOM_')) exit;

/**
 * 현재 접속자수 출력
 */
function eb_connect($skin_dir='basic', $return=true)
{
    global $config, $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    /**
     * 회원, 방문객 카운트
     */
    $sql = " select sum(IF(mb_id<>'',1,0)) as mb_cnt, count(*) as total_cnt from {$g5['login_table']}  where mb_id <> '{$config['cf_admin']}' ";
    $row = sql_fetch($sql);

    if ($return) {
        $connect_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/connect/'.$skin_dir;
        $connect_skin_url = str_replace(G5_PATH, G5_URL, $connect_skin_path);

        ob_start();
        include_once ($connect_skin_path.'/connect.skin.html.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    } else {
        return $row;
    }
}