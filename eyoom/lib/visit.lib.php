<?php
/**
 * lib file : /eyoom/lib/tagmenu.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 방문자수 출력
 */
function eb_visit($skin_dir='basic', $return=true)
{
    global $config, $eyoom, $member, $g5, $theme, $shop_theme, $is_admin, $connect;

    /**
     * 숨기기 처리
     */
    if (!defined('G5_IS_ADMIN')) {
        if ($eyoom['use_visit_skin'] == 'n' || $member['mb_level'] < $eyoom['view_level_visit']) return;   
    }

    if (!$skin_dir) $skin_dir = 'basic';

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /** visit 배열변수에
     * $visit[1] = 오늘
     * $visit[2] = 어제
     * $visit[3] = 최대
     * $visit[4] = 전체
     * 숫자가 들어감
     */
    preg_match('/오늘:(.*),어제:(.*),최대:(.*),전체:(.*)/', $config['cf_visit'], $visit);
    settype($visit[1], "integer");
    settype($visit[2], "integer");
    settype($visit[3], "integer");
    settype($visit[4], "integer");

    $write      = sql_fetch("select sum(bo_count_write) as total from {$g5['board_table']}", false);
    $comment    = sql_fetch("select sum(bo_count_comment) as total from {$g5['board_table']}", false);
    $members    = sql_fetch("select count(*) as total from {$g5['member_table']}", false);
    $newby      = sql_fetch("select count(*) as total from {$g5['member_table']} where mb_datetime between date_format(".date('YmdHis').",'%Y-%m-%d 00:00:00') and date_format(".date('YmdHis').",'%Y-%m-%d 23:59:59')", false);

    $counter['visit_today']     = number_format($visit[1]);
    $counter['visit_yesterday'] = number_format($visit[2]);
    $counter['visit_max']       = number_format($visit[3]);
    $counter['visit_total']     = number_format($visit[4]);
    $counter['total_write']     = number_format($write['total']);
    $counter['total_comment']   = number_format($comment['total']);
    $counter['newby']           = number_format($newby['total']);
    $counter['members']         = number_format($members['total']);
    $counter['write']           = number_format($write['total']);
    $counter['comment']         = number_format($comment['total']);

    if ($return) {
        $visit_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/visit/'.$skin_dir;
        $visit_skin_url = str_replace(G5_PATH, G5_URL, $visit_skin_path);

        ob_start();
        include_once ($visit_skin_path.'/visit.skin.html.php');
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    } else {
        return $counter;
    }
}

/**
 * get_brow() 함수는 이미 있음
 */
function eb_get_brow($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match('/msie ([1-9][0-9]\.[0-9]+)/', $agent, $m)) { $s = 'MSIE '.$m[1]; }
    else if (preg_match('/firefox/', $agent))            { $s = 'FireFox'; }
    else if (preg_match('/chrome/', $agent))             { $s = 'Chrome'; }
    else if (preg_match('/x11/', $agent))                { $s = 'Netscape'; }
    else if (preg_match('/opera/', $agent))              { $s = 'Opera'; }
    else if (preg_match('/gec/', $agent))                { $s = 'Gecko'; }
    else if (preg_match('/bot|slurp/', $agent))          { $s = 'Robot'; }
    else if (preg_match('/internet explorer/', $agent))  { $s = 'IE'; }
    else if (preg_match('/mozilla/', $agent))            { $s = 'Mozilla'; }
    else { $s = '기타'; }

    return $s;
}

function eb_get_os($agent)
{
    $agent = strtolower($agent);

    //echo $agent; echo "<br/>";

    if (preg_match('/windows 98/', $agent))                  { $s = '98'; }
    else if (preg_match('/windows 95/', $agent))             { $s = '95'; }
    else if (preg_match('/windows nt 4\.[0-9]*/', $agent))   { $s = 'NT'; }
    else if (preg_match('/windows nt 5\.0/', $agent))        { $s = '2000'; }
    else if (preg_match('/windows nt 5\.1/', $agent))        { $s = 'XP'; }
    else if (preg_match('/windows nt 5\.2/', $agent))        { $s = '2003'; }
    else if (preg_match('/windows nt 6\.0/', $agent))        { $s = 'Vista'; }
    else if (preg_match('/windows nt 6\.1/', $agent))        { $s = 'Windows7'; }
    else if (preg_match('/windows nt 6\.2/', $agent))        { $s = 'Windows8'; }
    else if (preg_match('/windows 9x/', $agent))             { $s = 'ME'; }
    else if (preg_match('/windows ce/', $agent))             { $s = 'CE'; }
    else if (preg_match('/mac/', $agent))                    { $s = 'MAC'; }
    else if (preg_match('/linux/', $agent))                  { $s = 'Linux'; }
    else if (preg_match('/sunos/', $agent))                  { $s = 'sunOS'; }
    else if (preg_match('/irix/', $agent))                   { $s = 'IRIX'; }
    else if (preg_match('/phone/', $agent))                  { $s = 'Phone'; }
    else if (preg_match('/bot|slurp/', $agent))              { $s = 'Robot'; }
    else if (preg_match('/internet explorer/', $agent))      { $s = 'IE'; }
    else if (preg_match('/mozilla/', $agent))                { $s = 'Mozilla'; }
    else { $s = '기타'; }

    return $s;
}