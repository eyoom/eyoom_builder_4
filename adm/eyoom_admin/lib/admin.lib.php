<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

// 메뉴들의 폴더명 리턴
function get_dirname() {
    global $amenu;

    // 메뉴 파일명에서 폴더명 추출
    foreach ($amenu as $key => $file) {
        $tmp = explode('.', $file);
        $dirname['menu'.($key*1).'00'] = $tmp[2];
    }
    return $dirname;
}

// 메뉴의 경로명 리턴
function get_path_info() {
    global $admin_menu, $dir, $submenu, $pid;

    $path[0]['title'] = 'Home';
    $path[1]['title'] = $admin_menu[$dir]['title'];
    foreach($admin_menu[$dir]['submenu'] as $key => $smenu) {
        if($pid == $smenu['pid']) {
            $path[2]['title'] = $smenu['title'];
        }
    }
    return $path;
}

// 기간별 통계
function get_visit_info($fr_date, $to_date='') {
    global $g5;

    // 하루 일자 지정
    if (!$fr_date) $fr_date = date('Y-m-d');
    if (!$to_date) $to_date = $fr_date;

    $sql = " select *, SUBSTRING(vi_time,1,2) as hour from {$g5['visit_table']} where vi_date between '{$fr_date}' and '{$to_date}' order by vi_id desc ";
    $result = sql_query($sql);
    $vi_cnt = $vi_br = $vi_os = $vi_dev = $vi_regist = $vi_domain = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $brow = $row['vi_browser'];
        if(!$brow) $brow = eb_get_brow($row['vi_agent']);

        $os = $row['vi_os'];
        if(!$os) $os = eb_get_os($row['vi_agent']);

        $device = $row['vi_device'];
        $hour = $row['hour'] * 1;

        $vi_cnt[$hour][$i]  = $row;
        $vi_br[$brow] ++;
        $vi_os[$os] ++;
        $vi_dev[$device] ++;

        $str = $row['vi_referer'];
        preg_match("/^http[s]*:\/\/([\.\-\_0-9a-zA-Z]*)\//", $str, $match);
        $domain = $match[1];
        $domain = preg_replace("/^(www\.|search\.|dirsearch\.|dir\.search\.|dir\.|kr\.search\.|myhome\.)(.*)/", "\\2", $domain);
        $vi_domain[$domain] ++;
        unset($domain, $str, $match);
    }

    /**
     * 그래프에 뿌려줄 내용에 순위적용 - 노출 갯수 제한
     */
    @arsort($vi_br);
    @arsort($vi_os);
    @arsort($vi_dev);
    @array_splice($vi_br, 6);
    @array_splice($vi_os, 6);
    @array_splice($vi_dev, 6);

    $sql = " select mb_id, SUBSTRING(mb_datetime,12,2) as hour from {$g5['member_table']} where mb_datetime between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59' order by mb_datetime desc ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $hour = $row['hour'] * 1;
        $vi_regist[$hour][$row['mb_id']] = $row['mb_id'];
    }

    $output['vi_cnt']       = $vi_cnt;
    $output['vi_br']        = $vi_br;
    $output['vi_os']        = $vi_os;
    $output['vi_dev']       = $vi_dev;
    $output['vi_regist']    = $vi_regist;
    $output['vi_domain']    = $vi_domain;

    return $output;
}

// 하루 활동기록 통계
function get_activity_info($fr_date, $to_date='') {
    global $g5;

    // 하루 일자 지정
    if (!$fr_date) $fr_date = date('Y-m-d');
    if (!$to_date) $to_date = $fr_date;

    $sql = " select *, SUBSTRING(act_regdt,12,2) as hour from {$g5['eyoom_activity']} where act_regdt between '{$fr_date} 00:00:00' and '{$to_date} 23:59:59' order by act_id desc ";
    $result = sql_query($sql);
    $act_login = $act_write = $act_cmt = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        unset($hour);
        $hour = $row['hour'] * 1;
        switch ($row['act_type']) {
            case 'login': $act_login[$hour]++; break;
            case 'new'  : $act_write[$hour]++; break;
            case 'cmt'  : $act_cmt[$hour]++; break;
        }
    }

    $output['login']    = $act_login;
    $output['write']    = $act_write;
    $output['cmt']      = $act_cmt;

    return $output;
}

// 일자별 활동기록 통계 - 하루 글쓰기, 댓글쓰기 총 갯수
function get_activity_date_sum($date) {
    global $g5;

    $date_set = implode(',', $date);

    $sql = " select * from {$g5['eyoom_activity']} where find_in_set(SUBSTRING(act_regdt, 1, 10), '{$date_set}') and (act_type='new' || act_type='cmt') ";
    $result = sql_query($sql);
    $info = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $act_regdt = date('Y-m-d', strtotime($row['act_regdt']));
        $act_type = $row['act_type'] == 'new' ? 'write': $row['act_type'];
        $info[$act_regdt][$act_type]++;
    }

    return $info;
}


// pg_anchor
function adm_pg_anchor($anc_id) {
    global $pg_anchor, $wmode;

    if (!$pg_anchor || !is_array($pg_anchor) || $wmode) return false;

    $li = '';
    $active = '';
    foreach ($pg_anchor as $id => $title) {
        if ($id == $anc_id) $active = "class=\"active\"";
        $li .= "<li ".$active."><a href=\"#".$id."\">".$title."</a></li>\n";
        unset($active);
    }
    return "
    <div class=\"pg-anchor-in tab-e2\">\n
        <ul class=\"nav nav-tabs\">\n
            ".$li."
        </ul>\n
        <div class=\"tab-bottom-line\"></div>\n
    </div>\n
    ";
}

function mb_photo_url($mb_id) {
    $photo_url = '';

    $mb_dir = substr($mb_id,0,2);
    $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.get_mb_icon_name($mb_id).'.gif';
    if (file_exists($icon_file)) {
        $photo_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.get_mb_icon_name($mb_id).'.gif';
    }

    if ($photo_url) {
        return $photo_url;
    } else return false;
}