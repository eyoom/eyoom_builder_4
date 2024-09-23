<?php
/**
 * core file : /eyoom/core/board/move_update.php
 */
if (!defined('_EYOOM_')) exit;

$act = isset($act) ? strip_tags($act) : '';

$sd_chk_bo_table = isset($_POST['chk_bo_table']) ? (array)$_POST['chk_bo_table']: $sd_chk_bo_table;
$count_chk_bo_table = is_array($sd_chk_bo_table) ? count($sd_chk_bo_table): 0;

if ($sw != 'move' && $sw != 'copy')
    alert('sw 값이 제대로 넘어오지 않았습니다.');

// 원본 파일 디렉토리
$src_dir = G5_DATA_PATH.'/file/'.$sd_bo_table;

$save = array();
$save_count_write = 0;
$save_count_comment = 0;
$cnt = 0;

$sd_wr_id_list = preg_replace('/[^0-9\,]/', '', $sd_wr_id_list);
$sql = " select distinct wr_num from $sd_write_table where wr_id in ({$sd_wr_id_list}) order by wr_id ";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)) {
    $save[$cnt]['wr_contents'] = array();

    $wr_num = $row['wr_num'];
    for ($i=0; $i<$count_chk_bo_table; $i++) {
        $move_bo_table = isset($sd_chk_bo_table[$i]) ? preg_replace('/[^a-z0-9_]/i', '', $sd_chk_bo_table[$i]) : '';

        // 취약점 18-0075 참고
        $sql = "select * from {$g5['board_table']} where bo_table = '".sql_real_escape_string($move_bo_table)."' ";
        $move_board = sql_fetch($sql);
        // 존재하지 않다면
        if( !$move_board['bo_table'] ) continue;

        $move_write_table = $g5['write_prefix'] . $move_bo_table;

        $src_dir = G5_DATA_PATH.'/file/'.$sd_bo_table; // 원본 디렉토리
        $dst_dir = G5_DATA_PATH.'/file/'.$move_bo_table; // 복사본 디렉토리

        $count_write = 0;
        $count_comment = 0;

        $next_wr_num = get_next_num($move_write_table);

        $sql2 = " select * from $sd_write_table where wr_num = '$wr_num' order by wr_parent, wr_is_comment, wr_comment desc, wr_id ";
        $result2 = sql_query($sql2);
        while ($row2 = sql_fetch_array($result2)) {
            $save[$cnt]['wr_contents'][] = $row2['wr_content'];

            // 게시글 추천, 비추천수
            $wr_good = $wr_nogood = 0;
            if ($sw == 'move' && $i == 0) {
                $wr_good = $row2['wr_good'];
                $wr_nogood = $row2['wr_nogood'];
            }

            $sql = " insert into $move_write_table
                        set wr_num = '$next_wr_num',
                             wr_reply = '{$row2['wr_reply']}',
                             wr_is_comment = '{$row2['wr_is_comment']}',
                             wr_comment = '{$row2['wr_comment']}',
                             wr_comment_reply = '{$row2['wr_comment_reply']}',
                             ca_name = '".addslashes($row2['ca_name'])."',
                             wr_option = '{$row2['wr_option']}',
                             wr_subject = '".addslashes($row2['wr_subject'])."',
                             wr_content = '".addslashes($row2['wr_content'])."',
                             wr_link1 = '".addslashes($row2['wr_link1'])."',
                             wr_link2 = '".addslashes($row2['wr_link2'])."',
                             wr_link1_hit = '{$row2['wr_link1_hit']}',
                             wr_link2_hit = '{$row2['wr_link2_hit']}',
                             wr_hit = '{$row2['wr_hit']}',
                             wr_good = '{$wr_good}',
                             wr_nogood = '{$wr_nogood}',
                             mb_id = '{$row2['mb_id']}',
                             wr_password = '{$row2['wr_password']}',
                             wr_name = '".addslashes($row2['wr_name'])."',
                             wr_email = '".addslashes($row2['wr_email'])."',
                             wr_homepage = '".addslashes($row2['wr_homepage'])."',
                             wr_datetime = '{$sd_wr_opendate}',
                             wr_file = '{$row2['wr_file']}',
                             wr_last = '{$row2['wr_last']}',
                             wr_ip = '{$row2['wr_ip']}',
                             wr_1 = '".addslashes($row2['wr_1'])."',
                             wr_2 = '".addslashes($row2['wr_2'])."',
                             wr_3 = '".addslashes($row2['wr_3'])."',
                             wr_4 = '".addslashes($row2['wr_4'])."',
                             wr_5 = '".addslashes($row2['wr_5'])."',
                             wr_6 = '".addslashes($row2['wr_6'])."',
                             wr_7 = '".addslashes($row2['wr_7'])."',
                             wr_8 = '".addslashes($row2['wr_8'])."',
                             wr_9 = '".addslashes($row2['wr_9'])."',
                             wr_10 = '".addslashes($row2['wr_10'])."',
                             eb_1 = '".addslashes($row2['eb_1'])."',
                             eb_2 = '".addslashes($row2['eb_2'])."',
                             eb_3 = '".addslashes($row2['eb_3'])."',
                             eb_4 = '".addslashes($row2['eb_4'])."',
                             eb_5 = '".addslashes($row2['eb_5'])."',
                             eb_6 = '".addslashes($row2['eb_6'])."',
                             eb_7 = '".addslashes($row2['eb_7'])."',
                             eb_8 = '".addslashes($row2['eb_8'])."',
                             eb_9 = '".addslashes($row2['eb_9'])."',
                             eb_10 = '".addslashes($row2['eb_10'])."' ";
            sql_query($sql);

            $insert_id = sql_insert_id();

            // 타겟 테이블 최신글 스위치온
            $latest->make_switch_on($move_bo_table, $theme);

            // 코멘트가 아니라면
            if (!$row2['wr_is_comment']) {
                $save_parent = $insert_id;

                // 메뉴에서 해당 게시물 정보 가져옮
                $eyoom_tag = sql_fetch("select * from {$g5['eyoom_tag_write']} where tw_theme='" . sql_real_escape_string($theme) . "' and bo_table='$sd_bo_table' and wr_id='{$row2['wr_id']}'");

                $sql3 = " select * from {$g5['board_file_table']} where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' order by bf_no ";
                $result3 = sql_query($sql3);
                for ($k=0; $row3 = sql_fetch_array($result3); $k++) {
                    if ($row3['bf_file']) {
                        // 원본파일을 복사하고 퍼미션을 변경
                        // 제이프로님 코드제안 적용

                        $copy_file_name = $row3['bf_file'];

                        if($sd_bo_table === $move_bo_table){
                            if(preg_match('/_copy(\d+)?_(\d+)_/', $copy_file_name, $match)){
                                $number = isset($match[1]) ? (int) $match[1] : 0;
                                $replace_str = '_copy'.($number + 1).'_'.$insert_id.'_';
                                $copy_file_name = preg_replace('/_copy(\d+)?_(\d+)_/', $replace_str, $copy_file_name);
                            } else {
                                $copy_file_name = $row2['wr_id'].'_copy_'.$insert_id.'_'.$row3['bf_file'];
                            }
                        }

                        $is_exist_file = is_file($src_dir.'/'.$row3['bf_file']) && file_exists($src_dir.'/'.$row3['bf_file']);
                        if( $is_exist_file ){
                            @copy($src_dir.'/'.$row3['bf_file'], $dst_dir.'/'.$copy_file_name);
                            @chmod($dst_dir.'/'.$row3['bf_file'], G5_FILE_PERMISSION);
                        }

                        $row3 = run_replace('bbs_move_update_file', $row3, $copy_file_name, $sd_bo_table, $move_bo_table, $insert_id);
                    }

                    $sql = " insert into {$g5['board_file_table']}
                                set bo_table = '$move_bo_table',
                                     wr_id = '$insert_id',
                                     bf_no = '{$row3['bf_no']}',
                                     bf_source = '".addslashes($row3['bf_source'])."',
                                     bf_file = '$copy_file_name',
                                     bf_download = '{$row3['bf_download']}',
                                     bf_content = '".addslashes($row3['bf_content'])."',
                                     bf_fileurl = '".addslashes($row3['bf_fileurl'])."',
                                     bf_thumburl = '".addslashes($row3['bf_thumburl'])."',
                                     bf_storage = '".addslashes($row3['bf_storage'])."',
                                     bf_filesize = '{$row3['bf_filesize']}',
                                     bf_width = '{$row3['bf_width']}',
                                     bf_height = '{$row3['bf_height']}',
                                     bf_type = '{$row3['bf_type']}',
                                     bf_datetime = '{$row3['bf_datetime']}' ";
                    sql_query($sql);

                    if ($sw == 'move' && $row3['bf_file']) {
                        $save[$cnt]['bf_file'][$k] = $src_dir.'/'.$row3['bf_file'];
                    }
                }

                $count_write++;

                if ($sw == 'move' && $i == 0) {
                    // 스크랩 이동
                    sql_query(" update {$g5['scrap_table']} set bo_table = '$move_bo_table', wr_id = '$save_parent' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");

                    // 최신글 이동
                    $row4 = sql_fetch(" select count(*) as cnt from {$g5['board_new_table']} where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");
                    if ($row4['cnt']) {
                        sql_query(" update {$g5['board_new_table']} set bo_table = '$move_bo_table', wr_id = '$save_parent', wr_parent = '$save_parent' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");
                    } else {
                        sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, ca_name, wr_hit ) values ( '{$move_bo_table}', '{$save_parent}', '{$save_parent}', '{$row2['wr_datetime']}', '{$row2['mb_id']}', '{$row2['ca_name']}', '{$row2['wr_hit']}' ) ");
                    }

                    // 추천데이터 이동
                    sql_query(" update {$g5['board_good_table']} set bo_table = '$move_bo_table', wr_id = '$save_parent' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");

                    // 이윰 내글반응 이동
                    sql_query(" update {$g5['eyoom_respond']} set bo_table = '$move_bo_table', wr_id = '$save_parent', pr_id = '$save_parent' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");

                    // 이윰 태그글
                    if ($eyoom_tag['wr_tag']) {
                        sql_query(" update {$g5['eyoom_tag_write']} set bo_table = '$move_bo_table', wr_id = '$save_parent', wr_image='{$wr_image}' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' and tw_theme = '" . sql_real_escape_string($theme) . "' ");
                    } else {
                        sql_query(" delete from {$g5['eyoom_tag_write']} where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' and tw_theme = '" . sql_real_escape_string($theme) . "' ");
                    }
                }

                // 이윰 태그 복사
                if ($sw == 'copy') {
                    // 최신글 복사
                    sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id, ca_name, wr_hit ) values ( '{$move_bo_table}', '{$save_parent}', '{$save_parent}', '{$row2['wr_datetime']}', '{$row2['mb_id']}', '{$row2['ca_name']}', '{$row2['wr_hit']}' ) ");

                    if ($eyoom_tag['wr_tag']) {
                        unset($copy_set);
                        foreach ($eyoom_tag as $key => $val) {
                            if ($key=='tw_id' || $key == 'wr_datetime') continue;
                            else {
                                if ($key == 'bo_table') $val = $move_bo_table;
                                if ($key == 'wr_id') $val = $insert_id;
                                if ($key == 'wr_image') $val = $wr_image;
                                if ($key == 'wr_subject' || $key == 'wr_content') {
                                    $val = addslashes(stripslashes($val));
                                }
                                $copy_set .= "{$key} = '{$val}', ";
                            }
                        }
                        $copy_set .= "tw_datetime='".G5_TIME_YMDHIS."'";
                        sql_query("insert into {$g5['eyoom_tag_write']} set {$copy_set}");
                    } else {
                        sql_query(" delete from {$g5['eyoom_tag_write']} where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' and tw_theme = '" . sql_real_escape_string($theme) . "' ");
                    }
                }
            } else {
                $count_comment++;
                if ($sw == 'move') {
                    // 최신글 이동
                    sql_query(" update {$g5['board_new_table']} set bo_table = '$move_bo_table', wr_id = '$insert_id', wr_parent = '$save_parent' where bo_table = '$sd_bo_table' and wr_id = '{$row2['wr_id']}' ");
                }
            }

            sql_query(" update $move_write_table set wr_parent = '$save_parent' where wr_id = '$insert_id' ");

            if ($sw == 'move')
                $save[$cnt]['wr_id'] = $row2['wr_parent'];

            $cnt++;

            run_event('bbs_move_copy', $row2, $move_bo_table, $insert_id, $next_wr_num, $sw);
        }

        sql_query(" update {$g5['board_table']} set bo_count_write = bo_count_write + '$count_write' where bo_table = '$move_bo_table' ");
        sql_query(" update {$g5['board_table']} set bo_count_comment = bo_count_comment + '$count_comment' where bo_table = '$move_bo_table' ");

        delete_cache_latest($move_bo_table);
    }

    $save_count_write += $count_write;
    $save_count_comment += $count_comment;
}

delete_cache_latest($sd_bo_table);

if ($sw == 'move') {
    for ($i=0; $i<count((array)$save); $i++) {
        if( isset($save[$i]['bf_file']) && $save[$i]['bf_file'] ){
            for ($k=0; $k<count((array)$save[$i]['bf_file']); $k++) {
                $del_file = run_replace('delete_file_path', clean_relative_paths($save[$i]['bf_file'][$k]), $save[$i]);

                if ( is_file($del_file) && file_exists($del_file) ){
                    @unlink($del_file);
                }

                // 썸네일 파일 삭제, 먼지손 님 코드 제안
                delete_board_thumbnail($sd_bo_table, basename($save[$i]['bf_file'][$k]));
            }
        }

        for ($k=0; $k<count($save[$i]['wr_contents']); $k++){
            delete_editor_thumbnail($save[$i]['wr_contents'][$k]);
        }

        sql_query(" delete from $sd_write_table where wr_parent = '{$save[$i]['wr_id']}' ");
        sql_query(" delete from {$g5['board_new_table']} where bo_table = '$sd_bo_table' and wr_id = '{$save[$i]['wr_id']}' ");
        sql_query(" delete from {$g5['board_file_table']} where bo_table = '$sd_bo_table' and wr_id = '{$save[$i]['wr_id']}' ");
        sql_query(" delete from {$g5['eyoom_scheduled']} where bo_table = '$sd_bo_table' and wr_id = '{$save[$i]['wr_id']}' ");
        $w_id[$i] = $save[$i]['wr_id'];
    }

    // 공지사항이 이동되는 경우의 처리 begin
    $arr = array();
    $sql = " select bo_notice from {$g5['board_table']} where bo_table = '{$sd_bo_table}' ";
    $row = sql_fetch($sql);
    $arr_notice = explode(',', $row['bo_notice']);
    for ($i=0; $i<count($arr_notice); $i++) {
        $move_id = (int)$arr_notice[$i];
        // 게시판에 wr_id 가 있다면 이동한게 아니므로 bo_notice 에 다시 넣음
        $row2 = sql_fetch(" select count(*) as cnt from $sd_write_table where wr_id = '{$move_id}' ");
        if ($row2['cnt']) {
            $arr[] = $move_id;
        }
        $bo_notice = implode(',', $arr);
    }
    // 공지사항이 이동되는 경우의 처리 end

    sql_query(" update {$g5['board_table']} set bo_notice = '{$bo_notice}', bo_count_write = bo_count_write - '$save_count_write', bo_count_comment = bo_count_comment - '$save_count_comment' where bo_table = '$sd_bo_table' ");
}

/**
 * 최신글 캐시 스위치온
 */
$latest->make_switch_on($sd_bo_table, $theme);