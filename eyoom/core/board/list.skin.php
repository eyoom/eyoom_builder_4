<?php
/**
 * core file : /eyoom/core/board/list.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 게시판 썸네일 라이브러리
 */
@include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/**
 * wmode 에서 링크 재정의
 */
$write_href .= $wmode ? '&amp;wmode=1': '';

/**
 * 선택옵션으로 인해 셀합치기가 가변적으로 변함
 */
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
if ($eyoom_board['bo_use_rating']) $colspan++;

/**
 * 제목에서 구분자로 회원정보 추출
 */
$bo_use_anonymous = !$is_admin ? $eyoom_board['bo_use_anonymous']: false;
$is_anonymous = false;
foreach ($list as $i => $val) {
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
        $list[$i]['mb_photo'] = '';
        $list[$i]['mb_id2'] = $list[$i]['mb_id'];;
        $list[$i]['mb_id'] = 'anonymous';
        $list[$i]['wr_name'] = $eyoom['anonymous_title'];
        $list[$i]['email'] = '';
        $list[$i]['homepage'] = '';
        $list[$i]['gnu_level'] = '';
        $list[$i]['gnu_icon'] = '';
        $list[$i]['eyoom_icon'] = '';
        $list[$i]['lv_gnu_name'] = '';
        $list[$i]['lv_name'] = '';
    } else if (is_array($level)) {
        $list[$i]['mb_photo'] = $eb->mb_photo($list[$i]['mb_id'], 'icon');
        $list[$i]['gnu_level'] = $level['gnu_level'];
        $list[$i]['eyoom_level'] = $level['eyoom_level'];
        $list[$i]['lv_gnu_name'] = $level['gnu_name'];
        $list[$i]['lv_name'] = $level['name'];
        $list[$i]['gnu_icon'] = $level['gnu_icon'];
        $list[$i]['eyoom_icon'] = $level['eyoom_icon'];
    }

    $list[$i]['key'] = $key;

    /**
     * eb_4 여유필드 unserialize
     */
    $eb_4 = $eb->mb_unserialize($list[$i]['eb_4']);
    if (!$eb_4) $eb_4 = array();

    /**
     * 갤러리 게시판의 경우, 목록에서 이미지를 반드시 사용으로 체크해야만 이미지가 출력되도록 기능 개선
     * 일반 게시판의 경우, 사용하지 않도록 체크하면 속도향상이 기대됨
     */
    if ($eyoom_board['bo_use_list_image']) {
        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
        if ($thumb['src']) {
            $list[$i]['img_content'] = '<img class="img-responsive" src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
            $list[$i]['img_src'] = $thumb['src'];
        } else {
            $list[$i]['img_content'] = '<span style="width:100%;">no image</span>';
        }
    }

    /**
     * 목록에서 동영상이미지 사용을 체크했을 경우
     * 속도에 영향을 미치지 않도록 썸네일 정보가 이미 있다면 실행하지 않도록 처리
     */
    if ($eyoom_board['bo_use_video_photo'] == '1') {
        /**
         * 동영상으로 부터 이미지 추출하는 부분
         * 동영상 경로는 eb_4 필드를 활용하기
         */
        if ($list[$i]['eb_4'] && !$thumb['src']) {
            $thumb['src'] = $eb_4['thumb_src'];
            if ($thumb['src']) {
                if ($thumb['src']) {
                    $list[$i]['img_content'] = '<img class="img-responsive" src="'.$thumb['src'].'" alt="">';
                    $list[$i]['img_src'] = $thumb['src'];
                } else {
                    $list[$i]['img_content'] = '<span style="width:100%;">no image</span>';
                }
            }
        }

        /**
         * 게시물에 동영상이 있는지 결정
         */
        $list[$i]['is_video'] = $eb_4['is_video'];
    }

    /**
     * 외부이미지 썸네일화 하기
     */
    if ($eyoom_board['bo_use_list_image'] && $eyoom_board['bo_use_extimg'] && !$thumb['src']) {
        $thumb = $bbs->make_thumb_from_extra_image($board['bo_table'], $list[$i]['wr_id'], $list[$i]['wr_content'], $board['bo_gallery_width'], $board['bo_gallery_height']);
        if ($thumb) {
            $list[$i]['img_content'] = '<img class="img-responsive" src="'.$thumb.'" alt="">';
            $list[$i]['img_src'] = $thumb;
        }
    }

    /**
     * 채택 게시판용
     */
    if (preg_match('/adopt/i',$eyoom_board['bo_skin'])) {
        $eb_6 = $eb->mb_unserialize($list[$i]['eb_6']);
        $list[$i]['adopt_cmt_id'] = $eb_6['adopt_cmt_id'];
        $list[$i]['adopt_point'] = $eb_6['adopt_point'];
    }

    /**
     * 별점기능 사용
     */
    if ($eyoom_board['bo_use_rating'] == '1' && $eyoom_board['bo_use_rating_list'] == '1') {
        $eb_7 = $eb->mb_unserialize($list[$i]['eb_7']);
        if (!$eb_7) $eb_7 = array();
        $rating = $bbs->get_star_rating($eb_7);
        $list[$i]['star'] = $rating['point'];
    }

    /**
     * 목록에서 내용 사용
     */
    if ($board['bo_use_list_content']) {
        $content_length = G5_IS_MOBILE ? 100:150;
        $wr_content = strip_tags($list[$i]['wr_content']);
        if ($eyoom_board['bo_use_addon_coding'] == '1') {
            $wr_content = $bbs->remove_editor_code($wr_content);
        }
        if ($eyoom_board['bo_use_addon_emoticon'] == '1') {
            $wr_content = $bbs->remove_editor_emoticon($wr_content);
        }
        if ($eyoom_board['bo_use_addon_video'] == '1') {
            $wr_content = $bbs->remove_editor_video($wr_content);
        }
        if ($eyoom_board['bo_use_addon_soundcloud'] == '1') {
            $wr_content = $bbs->remove_editor_sound($wr_content);
        }
        $list[$i]['content'] = cut_str(trim(strip_tags(preg_replace("/\?/","",$wr_content))),$content_length, '…');
    }

    /**
     * 게시물 view페이지의 wmode(Window Mode) 설정
     */
    if ($infinite_wmode) {
        $list[$i]['href'] .= strpos($list[$i]['href'], '?') ? '&wmode=1': '?wmode=1';
    }

    /**
     * 게시물 블라인드 처리
     */
    $eb_5 = $eb->mb_unserialize($list[$i]['eb_5']);
    if (isset($eb_5['yc_blind']) && $eb_5['yc_blind'] == 'y') {
        $yc_data = sql_fetch("select mb_id from {$g5['emp_yellowcard']} where bo_table = '{$bo_table}' and wr_id = '{$list[$i]['wr_id']}' and mb_id = '{$member['mb_id']}' ");
        $list[$i]['subject'] = '<span class="blind-subject">이 게시물은 블라인드 처리된 글입니다.</span>';
        $list[$i]['content'] = '<span class="blind-content">이 게시물은 블라인드 처리된 글입니다.</span>';
    }

    /**
     * 비밀글과 블라인드 처리된 게시물의 이미지 처리
     */
    if (strstr($list[$i]['wr_option'], 'secret') || $eb_5['yc_blind'] == 'y') {
        $list[$i]['img_content'] = '';
        $list[$i]['img_src'] = '';
    }

    /**
     * 확장필드
     */
    if ($bo_extend) {
        foreach ($exbo as $ex_fname => $exinfo) {
            unset($ex_value);

            switch ($exinfo['ex_form']) {
                case 'text':
                case 'radio':
                case 'select':
                    $list[$i][$ex_fname] = $list[$i][$ex_fname];
                    break;
                case 'checkbox':
                    $ex_value = explode('^|^', $list[$i][$ex_fname]);
                    $list[$i][$ex_fname] = is_array($ex_value) ? implode(', ', $ex_value): $ex_value;
                    break;
                case 'address':
                    $ex_value = explode('^|^', $list[$i][$ex_fname]);
                    unset($ex_value[4]);
                    $list[$i][$ex_fname] = is_array($ex_value) ? implode(' ', $ex_value): $ex_value;
                    break;
                case 'textarea':
                    $list[$i][$ex_fname] = conv_content($list[$i][$ex_fname], $html);
                    break;
            }
        }
    }

    /**
     * 투표
     */
    if ($eyoom_board['bo_use_addon_poll'] == '1' && isset($list[$i]['wr_poll_use']) && $list[$i]['wr_poll_use'] == '1') {
        $list[$i]['poll_type'] = '';
        if ($list[$i]['wr_poll_text'] != '') {
            $list[$i]['poll_type'] = 'text';
        } else if ($list[$i]['wr_poll_video'] != '') {
            $list[$i]['poll_type'] = 'video';
        } else if ($list[$i]['wr_poll_text'] == '' && $list[$i]['wr_poll_video'] == '') {
            $list[$i]['poll_type'] = 'image';
        }
    }
}

/**
 * 카테고리
 */
if ($board['bo_use_category']) {
    /**
     * 카테고리별 게시글수 출력 표시 - 비즈팔님이 아이디어를 제공해 주셨습니다.
     */
    $res = sql_query("select distinct ca_name, count(*) as cnt from {$write_table} where wr_id = wr_parent {$sql_approval} group by ca_name",false);
    $ca_total=0;
    for ($i=0;$row=sql_fetch_array($res);$i++) {
        $ca_name = $row['ca_name'] ? $row['ca_name'] : '미분류';
        $ca_count[$ca_name] = $row['cnt'];
        $ca_total += $row['cnt'];
    }

    /**
     * 카테고리 정보 재구성
     */
    foreach ((array)$categories as $key => $val) {
        if (!$val) break; 
        $bocate[$key]['ca_name'] = trim($val);
        $bocate[$key]['ca_sca'] = urlencode($bocate[$key]['ca_name']);
        $bocate[$key]['ca_count'] = number_format($ca_count[$val]);
    }
    $decode_sca =urldecode($sca);
}

/**
 * 관심게시판 체크
 */
if (is_array($bo_favorite)) {
    $is_bo_favorite = in_array($bo_table, $bo_favorite) && $is_member ? true: false;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('board', $bo_table, $qstr);

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/list.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/list.skin.php');

/**
 * 이윰 테마파일 출력
 */
$list_skin_file = $eyoom_skin_path['board'].'/list.skin.html.php';
if (file_exists($list_skin_file)) {
    include_once($list_skin_file);
} else {
    alert("현재 테마에는 게시판 스킨({$list_skin_file}) 파일이 존재하지 않습니다.");
}