<?php
/**
 * core file : /eyoom/core/member/photo_update.skin.php
 */
$g5_path = '../../..';
include_once ($g5_path.'/common.php');

/**
 * 썸네일 라이브러리
 */
@include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (!$is_member) exit;

// 아이콘 업로드
$mb_icon = '';
$image_regex = "/(\.(gif|jpe?g|png))$/i";
$mb_photo_img = get_mb_icon_name($member['mb_id']).'.gif';

if ($config['cf_member_img_width'] < 100) {
    $config['cf_member_img_width'] = 100;
}
if ($config['cf_member_img_height'] < 100) {
    $config['cf_member_img_height'] = 100;
}

if( $config['cf_member_img_size'] && $config['cf_member_img_width'] && $config['cf_member_img_height'] ){
    $mb_img_tmp_dir = G5_DATA_PATH.'/member_image/';
    $mb_icon_tmp_dir = G5_DATA_PATH.'/member/';
    $mb_img_dir = $mb_img_tmp_dir.substr($member['mb_id'],0,2);
    $mb_icon_dir = $mb_icon_tmp_dir.substr($member['mb_id'],0,2);
    if( !is_dir($mb_img_tmp_dir) ){
        @mkdir($mb_img_tmp_dir, G5_DIR_PERMISSION);
        @chmod($mb_img_tmp_dir, G5_DIR_PERMISSION);
    }
    if( !is_dir($mb_icon_tmp_dir) ){
        @mkdir($mb_icon_tmp_dir, G5_DIR_PERMISSION);
        @chmod($mb_icon_tmp_dir, G5_DIR_PERMISSION);
    }

    // 아이콘 삭제
    if (isset($_POST['del_photo'])) {
        $member_path = G5_DATA_PATH.'/member';
        $old_dest_path = $member_path.'/profile/';
        $_old_photo = $old_dest_path.$old_photo;
        @unlink($_old_photo);
        @unlink($mb_img_dir.'/'.$mb_photo_img);

        sql_query("update {$g5['eyoom_member']} set photo = '' where mb_id='".$member['mb_id']."'");
    }

    // 회원 프로필 이미지 업로드
    $photo = '';
    $selected_icon = clean_xss_tags(trim($_POST['selected_icon']));
    if ($selected_icon) {
        $sel_icon_path = EYOOM_MISC_PATH.'/member_icon/'.$selected_icon;
    }

    $is_uploaded_file = is_uploaded_file($_FILES['photo']['tmp_name']);
    if ((isset($_FILES['photo']) && $is_uploaded_file) || file_exists($sel_icon_path)) {

        $msg = $msg ? $msg."\\r\\n" : '';

        if ((isset($_FILES['photo']) && $is_uploaded_file)) {
            $photo_name = $_FILES['photo']['name'];
            $photo_file = $_FILES['photo']['tmp_name'];
        } else if ($sel_icon_path) {
            $photo_name = $selected_icon;
            $photo_file = $sel_icon_path;
        }

        if (preg_match($image_regex, $photo_name)) {
            // 아이콘 용량이 설정값보다 이하만 업로드 가능
            if (($_FILES['photo']['size'] <= $config['cf_member_img_size']) || $selected_icon) {
                @mkdir($mb_img_dir, G5_DIR_PERMISSION);
                @chmod($mb_img_dir, G5_DIR_PERMISSION);
                @mkdir($mb_icon_dir, G5_DIR_PERMISSION);
                @chmod($mb_icon_dir, G5_DIR_PERMISSION);

                $dest_img_path = $mb_img_dir.'/'.$mb_photo_img;
                $dest_icon_path = $mb_icon_dir.'/'.$mb_photo_img;

                if ($selected_icon) {
                    copy($photo_file, $dest_img_path);
                } else {
                    move_uploaded_file($photo_file, $dest_img_path);
                }
                chmod($dest_img_path, G5_FILE_PERMISSION);

                if (file_exists($dest_img_path)) {
                    $size = @getimagesize($dest_img_path);
                    if (!($size[2] === 1 || $size[2] === 2 || $size[2] === 3)) { // gif jpg png 파일이 아니면 올라간 이미지를 삭제한다.
                        @unlink($dest_img_path);
                    } else {
                        $thumb_img = null;
                        if($size[2] === 1 || $size[2] === 2 || $size[2] === 3) {
                            //gif, jpg, png 파일 적용
                            $thumb_img = thumbnail($mb_photo_img, $mb_img_dir, $mb_img_dir, $config['cf_member_img_width'], $config['cf_member_img_height'], true, true);

                            // 회원아이콘 파일 복사
                            $apply_icon = clean_xss_tags($_REQUEST['apply_icon']);

                            if ($apply_icon) {
                                @copy($dest_img_path, $dest_icon_path);
                                @chmod($dest_icon_path, G5_FILE_PERMISSION);
                            }

                            if($thumb_img) {
                                @unlink($dest_img_path);
                                rename($mb_img_dir.'/'.$thumb_img, $dest_img_path);
                            }

                            // 회원아이콘 만들기
                            if ($apply_icon) {
                                $size2 = @getimagesize($dest_icon_path);
                                if (!($size2[2] === 1 || $size2[2] === 2 || $size2[2] === 3)) {
                                    @unlink($dest_icon_path);
                                } else if ($size2[0] > $config['cf_member_icon_width'] || $size2[1] > $config['cf_member_icon_height']) {
                                    $thumb_icon = null;
                                    if($size2[2] === 1 || $size2[2] === 2 || $size2[2] === 3) {
                                        // gif, jpg, png 파일 적용
                                        $thumb_icon = thumbnail($mb_photo_img, $mb_icon_dir, $mb_icon_dir, $config['cf_member_icon_width'], $config['cf_member_icon_height'], true, true);
                                        if($thumb_icon) {
                                            @unlink($dest_icon_path);
                                            rename($mb_icon_dir.'/'.$thumb_icon, $dest_icon_path);
                                        }
                                    }
                                    if( !$thumb_icon ){
                                        // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                                        @unlink($dest_icon_path);
                                    }
                                }
                            }
                        }
                        if( !$thumb_img ){
                            // 아이콘의 폭 또는 높이가 설정값 보다 크다면 이미 업로드 된 아이콘 삭제
                            @unlink($dest_img_path);
                        }
                    }

                    sql_query("update {$g5['eyoom_member']} set photo = '".$mb_photo_img."' where mb_id='".$member['mb_id']."'");
                }
            } else {
                $msg .= '회원이미지을 '.number_format($config['cf_member_img_size']).'바이트 이하로 업로드 해주십시오.';
            }

        } else {
            $msg .= $_FILES['photo']['name'].'은(는) gif/jpg/png 파일이 아닙니다.';
        }
    }
}

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/photo_update.php');

if ($msg) {
    alert($msg, $back_url);
}

/**
 * 리턴 URL
 */
goto_url($back_url);