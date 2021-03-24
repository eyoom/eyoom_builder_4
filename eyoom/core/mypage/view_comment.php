<?php
/**
 * core file : /eyoom/core/mypage/view_comment.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 회원체크
 */
if (!$is_member) alert('회원만 접근하실 수 있습니다.',G5_URL);

/**
 * 코멘트수 제한 설정값
 */
if ($is_admin) {
    $comment_min = $comment_max = 0;
} else {
    $comment_min = (int)$board['bo_comment_min'];
    $comment_max = (int)$board['bo_comment_max'];
}

$comment = array();
if ($row['wr_id'] == $row['wr_parent']) {
    unset($sql,$write_table);
    $write_table = $g5['write_prefix'] . $row['bo_table'];
    $sql = " select * from $write_table where wr_parent = '{$row['wr_id']}' and wr_is_comment = 1 order by wr_comment, wr_comment_reply ";
    $res = sql_query($sql, false);
    for ($j=0; $cmt=sql_fetch_array($res); $j++) {
        $comment[$j] = $cmt;

        $comment[$j]['comment_id'] = $cmt['wr_id'];
        $comment[$j]['mb_photo'] = $eb->mb_photo($comment[$j]['mb_id']);
        $comment[$j]['cmt_depth'] = strlen($comment[$j]['wr_comment_reply']) * 20;
        $comment[$j]['content'] = $comment[$j]['content1']= '비밀 댓글 입니다.';
        if (!strstr($cmt['wr_option'], 'secret') ||
            $is_admin ||
            ($write['mb_id']==$member['mb_id'] && $member['mb_id']) ||
            ($cmt['mb_id']==$member['mb_id'] && $member['mb_id'])) {
            $comment[$j]['content1'] = $cmt['wr_content'];
            $comment[$j]['content'] = conv_content($cmt['wr_content'], 0, 'wr_content');
            $comment[$j]['content'] = search_font($stx, $comment[$j]['content']);
        } else {
            $ss_name = 'ss_secret_comment_'.$row['bo_table'].'_'.$comment[$j]['wr_id'];
            if (!get_session($ss_name))
                $comment[$j]['content'] = '비밀 댓글입니다.';
            else {
                $comment[$j]['content'] = conv_content($cmt['wr_content'], 0, 'wr_content');
                $comment[$j]['content'] = search_font($stx, $comment[$j]['content']);
            }
        }
        $comment[$j]['datetime'] = $cmt['wr_datetime'];
    }
}
$count = count($comment);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/mypage/myhome_following.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['mypage'].'/myhome_following.skin.html.php');