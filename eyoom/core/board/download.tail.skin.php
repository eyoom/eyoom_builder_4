<?php
/**
 * core file : /eyoom/core/board/download.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

if ($share == 'on') {
    unset($ratio);
    $ratio = $eyoom_board['download_fee_ratio'] ? $eyoom_board['download_fee_ratio'] : 0;

    /**
     * 다운로드 포인트 이력이 있는지 체크
     */
    $chk = "
        select
            count(*) as cnt
        from
            {$g5['point_table']}
        where
            mb_id='{$member['mb_id']}' and
            po_rel_table='{$bo_table}' and
            po_rel_id='{$wr_id}' and
            po_rel_action = '{$no}다운로드'
    ";

    $count = sql_fetch($chk);
    $tmp_board_table = $g5['write_prefix'].$board['bo_table'];

    /**
     * 다운로드 포인트 이력이 없다면
     */
    if (!$count['cnt']) {
        // 해당 게시물의 파일정보 가져오기
        $sql = "
            select
                a.*, b.mb_id
            from
                {$g5['board_file_table']} as a
            left join
                {$tmp_board_table} as b
            on
                a.wr_id=b.wr_id
            where
                a.bo_table='$bo_table' and
                a.wr_id='$wr_id' and
                a.bf_no='$no'
        ";
        $finfo = sql_fetch($sql);

        if (($write['mb_id'] && $write['mb_id'] == $member['mb_id']) || $is_admin) {
            // 관리자나 자신의 게시물일 경우 예외처리
            ;
        } else if ($board['bo_download_level'] >= 1) {
            if ($is_member && $finfo['bf_content']>0) {
                if ($member['mb_point'] - $finfo['bf_content'] < 0) {
                    // 다운로드를 위한 회원 포인트 부족
                    alert('보유하신 포인트('.number_format($member['mb_point']).')가 없거나 모자라서 다운로드('.number_format($finfo['bf_content']).')가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.');
                } else {
                    // 다운로드 포인트 차감
                    if (isset($board['bo_point_target']) && ($board['bo_point_target'] == 'gnu' || $board['bo_point_target'] == 'all')) {
                        insert_point($member['mb_id'], $finfo['bf_content']*(-1), "{$board['bo_subject']} $wr_id 파일 다운로드", $bo_table, $wr_id, "{$no}다운로드");
        
                        // 게시물 등록한 회원에게 수수료를 뺀 차액 포인트 적립
                        insert_point($finfo['mb_id'], ceil($finfo['bf_content']*(1-($ratio/100))), "{$board['bo_subject']} $wr_id 파일 다운로드 후원", $bo_table, $wr_id, "{$member['mb_id']}님-{$no}다운로드");
                    }

                    if (isset($board['bo_point_target']) && ($board['bo_point_target'] == 'eyoom' || $board['bo_point_target'] == 'all')) {
                        $download_point = abs($board['bo_download_point']);
                        $eb->level_point($download_point);
                    }
                }
            }
        }
    }
}