<?php
$g5_path = '../../..';
include_once($g5_path.'/common.php');

if (!($bo_table && $wr_id)) {
    alert("잘못된 접근입니다.");
}

$ans = (int) clean_xss_tags(trim($_POST['ans']));
$max_ans = (int) clean_xss_tags(trim($_POST['max_ans']));
$msg_point = '';

if(isset($ans) && $max_ans) {
    $sql = " select wr_poll_result from $write_table where wr_id = '$wr_id' ";
    $wr = sql_fetch($sql);

    if (!(isset($wr['wr_poll_result']) && isset($ans))) {
        alert("필요한 값이 넘어오지 않았습니다.");
    }

    if (!$is_admin) {
        if ($member['mb_level'] >= $board['bo_poll_level'] && $is_member) {
            $sql = " select * from {$g5['eyoom_bbspoll']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and mb_id = '{$member['mb_id']}' ";
            $row = sql_fetch($sql);
    
            if ($row['po_id']) {
                alert("이미 참여하신 투표입니다.");
            } else {
                $poll_point = 0;
                if ($eyoom_board['bo_addon_poll_point'] > 0) {
                    $poll_point = $eyoom_board['bo_addon_poll_type'] == 1 ? $eb->random_num($eyoom_board['bo_addon_poll_point']-1)+1 : $eyoom_board['bo_addon_poll_point'];
                }

                $sql = " insert {$g5['eyoom_bbspoll']} set 
                            bo_table = '{$bo_table}',
                            wr_id = '{$wr_id}',
                            mb_id = '{$member['mb_id']}',
                            po_flag = '{$ans}',
                            po_point = '{$poll_point}',
                            po_datetime = '".G5_TIME_YMDHIS."'
                ";
                sql_query($sql);

                if($poll_point > 0){
                    insert_point($member['mb_id'], $poll_point, "{$board['bo_subject']} {$wr_id} 글 투표했습니다.", $bo_table, $wr_id, $member['mb_id'].'투표하기');
                    $msg_point = "\\n참여{$levelset['gnu_name']}로 " . number_format($poll_point) . $levelset['gnu_name'] . "를 지급해 드렸습니다." ;
                }
            }
        } else {
            if (get_cookie("ck_{$bo_table}_{$wr_id}") == "{$bo_table}_{$wr_id}") {
                alert("이미 참여하신 투표입니다.");
            }
        }
    }

    $tmp = explode(",", $wr['wr_poll_result']);
    $tmp[$ans]++;
    $comma = $wr_poll_result = "";
    for ($i=0; $i<$max_ans; $i++) {
        $wr_poll_result .= $comma . (int)$tmp[$i];
        $comma = ",";
    }

    sql_query(" update {$write_table} set wr_poll_result = '{$wr_poll_result}' where wr_id = '{$wr_id}' ");
    if (!$is_member) {
        set_cookie("ck_{$bo_table}_{$wr_id}", "{$bo_table}_{$wr_id}", 86400*365);
    }

    echo '
        <script> 
        alert("투표에 참여해 주셔서 감사합니다.'.$msg_point.'"); 
        parent.document.location.href="'. G5_BBS_URL .'/board.php?bo_table='.$bo_table.'&wr_id='.$wr_id.'";
        </script>
    ';
} else {
    alert("잘못된 접근입니다");
}