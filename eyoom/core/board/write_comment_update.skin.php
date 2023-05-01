<?php
/**
 * core file : /eyoom/core/board/write_comment_update.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 이윰빌더용 여분필드
 */
for ($i=1; $i<=10; $i++) {
    $var = "eb_$i";
    $$var = "";
    if (isset($_POST['eb_'.$i]) && settype($_POST['eb_'.$i], 'string')) {
        $$var = trim($_POST['eb_'.$i]);
    }
}

/**
 * $write_table 에 적용할 변수 선언
 */
$up_set = array();
$up_set['eb_1'] = $eb_1 ? $eb->decrypt_aes($eb_1): ''; // 이윰 레벨정보 : "그누레벨|이윰레벨"
$up_set['eb_2'] = $eb_2 ? $eb->decrypt_aes($eb_2): ''; // 지뢰폭탄 정보
$up_set['eb_3'] = $eb_3 ? $eb->decrypt_aes($eb_3): ''; // 원본 이미지 정보
$up_set['eb_4'] = $eb_4 ? $eb->decrypt_aes($eb_4): ''; // 썸네일 이미지 정보, 동영상여부
$up_set['eb_5'] = $eb_5 ? $eb->decrypt_aes($eb_5): ''; // 신고, 블라인드 기능
$up_set['eb_6'] = $eb_6 ? $eb->decrypt_aes($eb_6): ''; // 채택포인트
$up_set['eb_7'] = $eb_7 ? $eb->decrypt_aes($eb_7): ''; // 별점 평가
$up_set['eb_8'] = $eb_8 ? $eb->decrypt_aes($eb_8): '';
$up_set['eb_9'] = $eb_9 ? $eb->decrypt_aes($eb_9): '';
$up_set['eb_10'] = $eb_10 ? $eb->decrypt_aes($eb_10): '';

/**
 * 첨부파일이 있다면 파일처리
 */
$upload_max_filesize = ini_get('upload_max_filesize');

/**
 * POST 변수가 없는 경우는 첨부파일의 용량이 오버했을 때 나타나는 현상
 */
if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

/**
 * 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
 */
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

/**
 * 본 댓글의 저장값 다시 가져오기
 */
$row = sql_fetch("select wr_link2 from {$write_table} where wr_id='{$comment_id}'", false);
if ($row) {
    $cfile = $eb->mb_unserialize($row['wr_link2']);
}

/**
 * 첨부 이미지 삭제처리
 */
/*
if ($_POST['del_cmtfile']) {
    $dfile = $eb->mb_unserialize($cdata['wr_link2']);
    if (is_array($dfile)) {
        foreach ($dfile as $i => $file) {
            $del_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$file['file'];
            @unlink($del_file);
            $delimg = "update {$write_table} set wr_link2 = '' where wr_id = '{$comment_id}'";
            sql_query($delimg,false);
        }
    }
}
*/

/**
 * 가변 파일 업로드
 */
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<count((array)$_FILES['cmt_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = 0;
    $upload[$i]['image'][1] = 0;
    $upload[$i]['image'][2] = 0;
    $upload[$i]['download'] = '';
    $upload[$i]['datetime'] = '';
    $upload[$i]['href'] = '';

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['del_cmtfile'][$i]) && $_POST['del_cmtfile'][$i]) {
        $upload[$i]['del_check'] = true;

        $del_filename = $cfile[$i]['file'];
        $delete_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$del_filename;
        if( file_exists($delete_file) ){
            @unlink($delete_file);
        }
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $del_filename)) {
            delete_board_thumbnail($bo_table, $del_filename);
        }
    }
    else
        $upload[$i]['del_check'] = false;

    $tmp_file  = $_FILES['cmt_file']['tmp_name'][$i];
    $filesize  = $_FILES['cmt_file']['size'][$i];
    $filename  = $_FILES['cmt_file']['name'][$i];
    $filename  = get_safe_filename($filename);
    if (!$filename) {
        if ($upload[$i]['del_check'] == false) {
            $upload[$i] = $cfile[$i];
        }
        continue;
    }

    /**
     * 서버에 설정된 값보다 큰파일을 업로드 한다면
     */
    if ($filename) {
        if ($_FILES['cmt_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['cmt_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        /**
         * 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
         */
        if (!$is_admin && $filesize > $board['bo_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 18)
                continue;
        }
        $upload[$i]['image'] = $timg;

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|pht|phar|phtml|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
        
        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.str_replace('%', '', urlencode(str_replace(' ', '_', $filename)));

        $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['cmt_file']['error'][$i]);

        $upload[$i]['datetime'] = G5_TIME_YMDHIS;
        $upload[$i]['href'] = EYOOM_CORE_URL.'/board/cmt_download.php?bo_table='.$bo_table.'&amp;wr_id='.$comment_id.'&amp;no='.$i;

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

// 업로드 이미지가 있다면 wr_link2 필드에 업데이트
$sql = "update {$write_table} set wr_link2 = '".serialize($upload)."' where wr_id='{$comment_id}'";
sql_query($sql,false);

/**
 * 게시물에 익명글 적용
 */
$bo_use_anonymous = $eyoom_board['bo_use_anonymous'];
if ($bo_use_anonymous == '1') {
    $up_set['wr_anonymous'] = $_POST['wr_anonymous'];
} else if ($bo_use_anonymous == '2') {
    $up_set['wr_anonymous'] = '1';
    $wr_bo_anonymous = '1';
} else {
    $up_set['wr_anonymous'] = '';
    $wr_bo_anonymous = '';
}
sql_query("update {$g5['board_new_table']} set wr_anonymous='{$up_set['wr_anonymous']}', wr_bo_anonymous='{$wr_bo_anonymous}' where wr_id='{$comment_id}' ");

/**
 * 내글반응 적용하기
 */
if ($w == 'c') {
    if ($reply_char) {
        $prev = sql_fetch(" select mb_id from {$write_table} where wr_id = '$_POST[comment_id]' and wr_is_comment = 1 and wr_comment_reply = '".substr($tmp_comment_reply,0,-1)."' ");
        $type = 'cmt_re';
        $pr_id = $_POST['comment_id'];
        $wr_mb_id = $prev['mb_id']; // 부모댓글 작성자 아이디
    } else {
        $type = 'cmt';
        $pr_id = $_POST['wr_id'];
        $wr_mb_id = $wr['mb_id']; // 부모글 작성자 아이디
    }

    $respond = array();
    $respond['type']        = $type;
    $respond['bo_table']    = $bo_table;
    $respond['pr_id']       = $pr_id;
    $respond['wr_id']       = $wr_id;
    $respond['wr_cmt']      = $comment_id;
    $respond['wr_subject']  = $wr_subject;
    $respond['wr_mb_id']    = $wr_mb_id;
    if ($_POST['wr_anonymous'] == '1' || $bo_use_anonymous == '2') $anonymous = true;
    $eb->respond($respond);
}

/**
 * 나의 활동 및 댓글포인트 적용
 */
if ($w == 'c') {

    /**
     * 나의 활동
     */
    $act_contents = array();
    $act_contents['bo_table'] = $bo_table;
    $act_contents['bo_name'] = $board['bo_subject'];
    $act_contents['wr_id'] = $comment_id;
    $act_contents['wr_parent'] = $wr_id;
    $act_contents['content'] = $wr_content;
    $bbs->insert_activity($mb_id,$type,$act_contents);

    if ($board['bo_point_target'] == 'eyoom' || $board['bo_point_target'] == 'all') {
        $comment_point = $board['bo_comment_point'];
    } else {
        $comment_point = $levelset['cmt'];
    }

    if ($comment_point) {
        $eb->level_point($comment_point);
    }

    /**
     * 댓글 포인트
     */
    if ($eyoom_board['bo_firstcmt_point'] || $eyoom_board['bo_bomb_point'] || $eyoom_board['bo_lucky_point']) {
        $point = $eb->point_comment();
        if (is_array($point)) {
            $point = serialize($point);
            /**
             * 댓글의 경우 wr_link1을 사용하지 않기에 활용
             */
            sql_query(" update $write_table set wr_link1 = '{$point}' where wr_id='{$comment_id}'");
        }
    }

}
if ($query) sql_query($query);
unset($query);

/**
 * 댓글 수정시, 레벨정보는 예외처리
 */
if ($w == 'cu') {
    unset($up_set['eb_1']);
}

/**
 * $up_set 대상이 있다면 원본 테이블에 적용
 */
if (count((array)$up_set) > 0 && is_array($up_set) ) {
    $j=0;
    $set = array();
    foreach ($up_set as $key => $val) {
        $set[$j] = " {$key} = '{$val}' ";
        $j++;
    }
    $sql = "update {$write_table} set " . implode(',', $set) ." where wr_id='{$comment_id}'";
    sql_query($sql, false);
}

/**
 * 최신글 캐시 스위치온
 */
$sql = "select * from {$g5['eyoom_latest_item']} where (1) and find_in_set('{$bo_table}', li_tables) and li_theme = '" . sql_real_escape_string($theme) . "' ";
$res = sql_query($sql, false);
for ($i=0; $row=sql_fetch_array($res); $i++) {
    /**
     * 캐시 스위치온 등록
     */
    $latest->cache_switch_on($row['el_code'], $row['li_theme'], $row['li_no']);
}

/**
 * 게시판 스킨파일
 */
@include_once($eyoom_skin_path['board'].'/write_comment_update.skin.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/board/write_comment_update.skin.php');

/**
 * 무한스크롤 리스트에서 뷰창을 띄웠을 경우
 */
$qstr .= $wmode ? $qstr.'&wmode=1':'';

if ($goback) {
    delete_cache_latest($bo_table);
    $mb_photo = $eb->mb_photo($mb_id);
    $output['mb_nick'] = $member['mb_nick'];
    $output['mb_photo'] = $mb_photo;
    $output['datetime'] = G5_TIME_YMDHIS;
    include_once EYOOM_CLASS_PATH."/json.class.php";

    $json = new Services_JSON();
    $data = $json->encode($output);
    echo $data;
    exit;
}