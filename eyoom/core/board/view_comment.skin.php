<?php
/**
 * core file : /eyoom/core/board/view_comment.skin.php
 */
if (!defined('_EYOOM_')) exit;

if ($eyoom_board['bo_use_yellow_card'] == '1') {
    /**
     * 바로 블라인드 처리할 수 있는 권한인지 체크
     */
    if ($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
        $blind_direct = true;
    }
}

/**
 * 댓글에 지도를 사용 - Daum 주소 Javascript
 */
if ($eyoom_board['bo_use_addon_map'] == '1') {
    add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
}

/**
 * 익명글 설정값
 */
$bo_use_anonymous = !$is_admin ? $eyoom_board['bo_use_anonymous']: false;
$is_anonymous = false;

unset($cmt);
$cmt_amt = count((array)$list);
$cmt = array();
for ($i=0; $i<$cmt_amt; $i++) {
    $cmt[$i]['comment_id'] = $list[$i]['wr_id'];
    $cmt[$i]['cmt_depth'] = strlen($list[$i]['wr_comment_reply']) * 15;
    $comment = $list[$i]['content'];
    $cmt[$i]['comment'] = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $comment);
    $cmt[$i]['comment'] = $bbs->board_content($cmt[$i]['comment'], $bo_table, $wr_id, $cmt[$i]['comment_id']);
    $cmt[$i]['cmt_sv'] = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
    $cmt[$i]['wr_name'] = get_text($list[$i]['wr_name']);
    $cmt[$i]['wr_email'] = $list[$i]['wr_email'];
    $cmt[$i]['wr_homepage'] = $list[$i]['wr_homepage'];
    $cmt[$i]['name'] = $list[$i]['name'];
    $cmt[$i]['mb_id'] = $list[$i]['mb_id'];
    $cmt[$i]['ip'] = $list[$i]['ip'];
    $cmt[$i]['datetime'] = $list[$i]['datetime'];
    $cmt[$i]['wr_option'] = $list[$i]['wr_option'];
    $cmt[$i]['content1'] = get_text($list[$i]['content1'], 0);

    /**
     * 댓글포인트
     */
    $point = $list[$i]['wr_link1'] ? @$eb->mb_unserialize($list[$i]['wr_link1']):'';
    if (is_array($point)) {
        $cmt[$i]['firstcmt_point'] = $point['firstcmt'] ? $point['firstcmt']:0;
        $cmt[$i]['bomb_point'] = is_array($point['bomb']) ? array_sum($point['bomb']):0;
        $cmt[$i]['lucky_point'] = $point['lucky'] ? $point['lucky']:0;
    }
    
    /**
     * 비밀댓글 체크
     */
    $is_secret_cmt = false;
    if (strstr($cmt[$i]['wr_option'], 'secret') && !$is_admin && $cmt[$i]['mb_id'] && $cmt[$i]['mb_id'] != $member['mb_id']) {
        $is_secret_cmt = true;
    }

    /**
     * wr_link2를 활용하여 댓글에 이미지표현
     */
    $cmt_file = !$is_secret_cmt ? $eb->mb_unserialize($list[$i]['wr_link2']): '';
    if (is_array($cmt_file)) {
        $cfile_loop = &$cmt[$i]['cmtfile'];
        $cimg_loop = &$cmt[$i]['cmtimg'];
        $cmt_attach = array();
        foreach ($cmt_file as $k => $_file) {
            if($_file['href']) {
                unset($dn_href);
                $dn_href = parse_url($_file['href']);
                $_file['href'] = G5_URL.$dn_href['path'].'?'.$dn_href['query'];
            }
            $cfile_loop[$k] = $_file;
            $cmt_attach[$k] = $_file['source'];
            if (preg_match('/(gif|jpg|jpeg|png|webp)/',strtolower($_file['source']))) {
                $cimg_loop[$k]['imgsrc'] = G5_DATA_URL . '/file/'.$bo_table.'/'.$_file['file'];
                $cimg_loop[$k]['imgname'] = $_file['file'];
            }
        }
        $cmt[$i]['count_cmtfile'] = count((array)$cmt_file);
        $cmt[$i]['count_cmtimg'] = count((array)$cimg_loop);
        $cmt[$i]['cmt_attach'] = implode('||', $cmt_attach);
    }

    $level = $list[$i]['eb_1'] ? $eb->level_info($list[$i]['eb_1']):'';
    if ($bo_use_anonymous == '1') {
        if ($list[$i]['wr_anonymous'] == '1') {
            $is_anonymous = true;
        } else {
            $is_anonymous = false;
        }
    } else if ($bo_use_anonymous == '2') {
        $is_anonymous = true;
    } else {
        $is_anonymous = false;
    }

    if ($is_anonymous) {
        $anonymous_title = '';
        if ($cmt[$i]['mb_id'] == $write['mb_id']) {
            $anonymous_title = $eyoom['anonymous_title'] . '(글쓴이)';
        } else {
            if (!$cmt[$i]['wr_hit']) {
                $sql1 = "select wr_hit from {$write_table} where wr_parent = '{$wr_id}' and mb_id = '{$cmt[$i]['mb_id']}' ";
                $row1 = sql_fetch($sql1);
                if ($row1['wr_hit']) {
                    $anum = (int) $row1['wr_hit'];
                } else {
                    $sql2 = "select max(wr_hit) as max from {$write_table} where wr_parent = '{$wr_id}' and wr_id <> wr_parent ";
                    $row2 = sql_fetch($sql2);
                    if (!$row2) {
                        $row2['max'] = 0;
                    }
                    $anum = (int) $row2['max'] + 1;
                }
                $sql3 = "update {$write_table} set wr_hit = '{$anum}' where wr_parent = '{$wr_id}' and mb_id = '{$cmt[$i]['mb_id']}' ";
                sql_query($sql3);
            } else {
                $anum = $cmt[$i]['wr_hit'];
            }
            $anonymous_title = $eyoom['anonymous_title'] . $anum;
        }

        $cmt[$i]['mb_photo'] = '';
        $cmt[$i]['is_anonymous'] = 'y';
        $cmt[$i]['mb_id2'] = $cmt[$i]['mb_id'];
        $cmt[$i]['mb_id'] = 'anonymous';
        $cmt[$i]['wr_name'] = $anonymous_title;
        $cmt[$i]['email'] = '';
        $cmt[$i]['homepage'] = '';
        $cmt[$i]['gnu_level'] = '';
        $cmt[$i]['eyoom_level'] = '';
        $cmt[$i]['lv_gnu_name'] = '';
        $cmt[$i]['lv_name'] = '';
        $cmt[$i]['gnu_icon'] = '';
        $cmt[$i]['eyoom_icon'] = '';
    } else {
        $cmt[$i]['mb_photo'] = $eb->mb_photo($list[$i]['mb_id']);
        if (is_array($level)) {
            $cmt[$i]['gnu_level'] = $level['gnu_level'];
            $cmt[$i]['eyoom_level'] = $level['eyoom_level'];
            $cmt[$i]['lv_gnu_name'] = $level['gnu_name'];
            $cmt[$i]['lv_name'] = $level['name'];
            $cmt[$i]['gnu_icon'] = $level['gnu_icon'];
            $cmt[$i]['eyoom_icon'] = $level['eyoom_icon'];
        }
    }

    if ($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
        $cmt[$i]['is_reply'] = $list[$i]['is_reply'];
        $cmt[$i]['is_edit'] = $list[$i]['is_edit'];
        $cmt[$i]['is_del'] = $list[$i]['is_del'];
        $cmt[$i]['del_link'] = $wmode ? $list[$i]['del_link'].'&wmode=1':$list[$i]['del_link'];
        $query_string = str_replace("&", "&amp;", $_SERVER['QUERY_STRING']);

        if ($w == 'cu') {
            $sql = " select wr_id, wr_content from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
            $cmt = sql_fetch($sql);
            if (isset($cmt)) {
                if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id']))) {
                    $cmt['wr_content'] = '';
                }
                $cmt[$i]['c_wr_content'] = $cmt['wr_content'];
            }
        }
        $cmt[$i]['c_reply_href'] = $comment_common_url.'&amp;c_id='.$cmt[$i]['comment_id'].'&amp;w=c#bo_vc_w';
        $cmt[$i]['c_edit_href'] = $comment_common_url.'&amp;c_id='.$cmt[$i]['comment_id'].'&amp;w=cu#bo_vc_w';
    }

    /**
     * 댓글 추천/비추천 링크
     */
    if ($board['bo_use_good'] || $board['bo_use_nogood']) {
        $cmt[$i]['good'] = $list[$i]['wr_good'];
        $cmt[$i]['nogood'] = $list[$i]['wr_nogood'];
        $cmt[$i]['c_good_href'] = $board['bo_use_good'] ? EYOOM_CORE_URL.'/board/goodcmt.php?'.$query_string.'&amp;c_id='.$cmt[$i]['comment_id'].'&amp;good=good':'';
        $cmt[$i]['c_nogood_href'] = $board['bo_use_nogood'] ? EYOOM_CORE_URL.'/board/goodcmt.php?'.$query_string.'&amp;c_id='.$cmt[$i]['comment_id'].'&amp;good=nogood':'';
    }

    /**
     * 블라인드 처리
     */
    if ($eyoom_board['bo_use_yellow_card'] == '1') {
        $cmt_ycard = $eb->mb_unserialize($list[$i]['eb_5']);
        if (!$cmt_ycard) $cmt_ycard = array();
        $cmt[$i]['yc_count'] = $cmt_ycard['yc_count'];
        if ($cmt_ycard['yc_blind'] == 'y') {
            if (!$is_admin && $member['mb_level'] < $eyoom_board['bo_blind_view']) {
                $cmt[$i]['mb_ycard'] = $bbs->mb_yellow_card($member['mb_id'],$bo_table, $cmt[$i]['comment_id']);
                if (!$cmt[$i]['mb_ycard']) {
                    $cmt[$i]['yc_cannotsee'] = true;
                }
            }
            $cmt[$i]['yc_blind'] = true;
        }

        /**
         * 바로 블라인드 처리할 수 있는 권한인지 체크
         */
        if ($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
            $blind_direct = true;
        }
    }

    /**
     * 베스트 댓글용 raw data
     */
    if ($eyoom_board['bo_use_cmt_best'] == '1' && $cmt[$i]['good']) {
        if ($cmt[$i]['good'] >= $eyoom_board['bo_cmt_best_min']) {
            $good_comment[$i] = $cmt[$i]['good'];
            $best_comment[$i] = $cmt[$i];
        }
    }
}

/**
 * paging 처리 및 댓글 무한스크롤 기능 구현
 */
if ($eyoom_board['bo_use_cmt_infinite'] == '1' && is_array($cmt) ) {
    $cpage = (int)$_GET['cpage'];
    if (!$cpage) $cpage = 1;
    if (!$page_rows) $page_rows = $board['bo_page_rows'] ? $board['bo_page_rows'] : 15;
    $from_record = ($cpage - 1) * $page_rows; // 시작 열을 구함
    $cmt = array_slice($cmt,$from_record,$page_rows);
}

/**
 * Best 댓글
 */
if (isset($good_comment) && is_array($good_comment)) {
    if (!isset($cpage) || (isset($cpage) && $cpage == 1) ) {
        arsort($good_comment);

        $i=0;
        foreach ($good_comment as $key => $good) {
            // 베스트 댓글 추출 갯수 제한
            if ( $eyoom_board['bo_cmt_best_limit'] <= $i) break;
            else {
                $best_comment[$key]['is_cmt_best'] = true;
                $best_cmt[$i] = $best_comment[$key];
            }
            $i++;
        }

        if (isset($best_cmt) && is_array($best_cmt)) {
            krsort($best_cmt);
            foreach ($best_cmt as $key => $bestcmt) {
                array_unshift($cmt, $bestcmt);
            }
        }
    }
}

/**
 * 댓글수 재조정
 */
$cmt_amt = count((array)$cmt);

/**
 * 댓글에 이미지 첨부파일 용량 제한
 */
$upload_max_filesize = ini_get('upload_max_filesize') . ' 바이트';

if ($board['bo_use_sns']) {
    ob_start();
    include_once (G5_SNS_PATH."/view_comment_list.sns.skin.php");
    $cmt_list_sns = ob_get_contents();
    ob_end_clean();
}

/**
 * cmt_eb_1에 작성자의 레벨정보 입력
 */
if ($is_member) {
    if ($w=='' || $w=='c') {
        $cmt_eb_1 = $member['mb_level']."|".$eyoomer['level'];
    }
}

/**
 * 이윰 여분필드 변수값 암호화
 */
$cmt_eb_1 = $cmt_eb_1 ? $eb->encrypt_aes($cmt_eb_1): '';
$cmt_eb_2 = $cmt_eb_2 ? $eb->encrypt_aes($cmt_eb_2): '';
$cmt_eb_3 = $cmt_eb_3 ? $eb->encrypt_aes($cmt_eb_3): '';
$cmt_eb_4 = $cmt_eb_4 ? $eb->encrypt_aes($cmt_eb_4): '';
$cmt_eb_5 = $cmt_eb_5 ? $eb->encrypt_aes($cmt_eb_5): '';
$cmt_eb_6 = $cmt_eb_6 ? $eb->encrypt_aes($cmt_eb_6): '';
$cmt_eb_7 = $cmt_eb_7 ? $eb->encrypt_aes($cmt_eb_7): '';
$cmt_eb_8 = $cmt_eb_8 ? $eb->encrypt_aes($cmt_eb_8): '';
$cmt_eb_9 = $cmt_eb_9 ? $eb->encrypt_aes($cmt_eb_9): '';
$cmt_eb_10 = $cmt_eb_10 ? $eb->encrypt_aes($cmt_eb_10): '';

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/view_comment.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/view_comment.skin.php');

/**
 * 이윰 테마파일 출력
 */
include_once($eyoom_skin_path['board'].'/view_comment.skin.html.php');
