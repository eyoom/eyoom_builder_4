<?php
/**
 * core file : /eyoom/core/board/write_update.tail.skin.php
 */
if (!defined('_EYOOM_')) exit;

if ($w == '') {
    if (defined('G5_SLACK_USE') && G5_SLACK_USE === true && is_file(G5_SLACK_PATH.'/slack.class.php')) {
        include_once(G5_SLACK_PATH.'/slack.class.php');

        $slack = new SLACK();

        $slack->setChannel("#{$config['cf_slack_channel']}"); // 메세지를 전송할 Slack 채널명
        $slack->setUsername('[게시글] '.$wr_name);
        $slack->setMessage($wr_content, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&wr_id='.$wr_id);


        $result = $slack->send();
    }
}

/**
 * 한줄 게시판이라면 목록으로 이동
 */
if (isset($_POST['bbs_no_view']) && $_POST['bbs_no_view'] == '1') {
    delete_cache_latest($bo_table);
    
    if ($file_upload_msg)
        alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.$qstr);
    else
        goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.$qstr);
}

/**
 * 리스트 화면으로 리턴
 */
if ($_POST['golist'] == '1') {
    echo "
        <script>parent.document.location.href = '".G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table."'</script>
    ";
    exit;
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_update.tail.skin.php');