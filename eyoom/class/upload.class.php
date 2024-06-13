<?php
/**
 * upload class
 */

class upload extends qfile
{
    public $path = '';

    public function __construct() {
        global $eb;

        $this->eb = $eb;
    }

    private function check_directory() {
        $path = $this->path;
        if(!@is_dir($path)) {
            @mkdir($path, G5_DIR_PERMISSION);
            @chmod($path, G5_DIR_PERMISSION);
        }
    }

    // 이미지 업로드 함수
    public function upload_image($key) {
        $this->check_directory();

        /**
         * php파일도 getimagesize 에서 Image Type Flag 를 속일수 있다
         */
        $ext = strtolower($this->get_file_ext($_FILES[$key]['name']));
        if (!preg_match('/(gif|jpe?g|png)$/i', $ext)) {
            return '';
        }

        if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
            $filename = md5(time().$_FILES[$key]['name']);

            $dest_file = $this->path.$filename.'.'.$ext;
            move_uploaded_file($_FILES[$key]['tmp_name'], $dest_file);
            chmod($dest_file, G5_FILE_PERMISSION);
            $info['o_name'] = $_FILES[$key]['tmp_name'];
            $info['c_name'] = $filename.'.'.$ext;
            $info['d_file'] = $dest_file;
            $info['ext']    = $ext;
            return $info;
        } else return false;
    }

    /*
        $thumb[width] = 가로;
        $thumb[height] = 세로;
        $thumb[delete] = y or n; //$dest_file 삭제여부
    */
    public function upload_make_thumb($key, $thumb=array()) {
        $this->check_directory();
        $upload = $this->upload_image($key);
        if(!$upload) return false;

        if (file_exists($upload['d_file'])) {
            $size = getimagesize($upload['d_file']);
            switch ($size['mime']) {
                case 'image/jpeg'   : $source = @imagecreatefromjpeg($upload['d_file']); break;
                case 'image/gif'    : $source = @imagecreatefromgif($upload['d_file']); break;
                case 'image/png'    : $source = @imagecreatefrompng($upload['d_file']); break;
            }
            $width = $thumb['width'];
            if(!$thumb['height']) {
                $height = $width*($size[1]/$size[0]);
            } else {
                $height = $thumb['height'];
            }

            $dest = @imagecreatetruecolor($width, $height);
            $out_name = md5($upload['c_name']).'.'.$upload['ext'];
            $out_file = $this->path.$out_name;
            @imagecopyresampled($dest, $source, 0, 0, 0, 0, $width , $height, $size[0], $size[1]);

            // 사진의 방향정보를 활용하여 회전하기
            $exif = exif_read_data($upload['d_file']);
            if(!empty($exif['Orientation'])) {
                switch($exif['Orientation']) {
                    case 8: $dest = imagerotate($dest,90,0); break;
                    case 3: $dest = imagerotate($dest,180,0); break;
                    case 6: $dest = imagerotate($dest,-90,0);  break;
                }
            }

            // 이미지 타입에 따라 처리
            if ($upload['ext'] == 'jpg' || $upload['ext'] == 'jpeg') {
                @imagejpeg($dest, $out_file);
            } else if ($upload['ext'] == 'png') {
                @imagepng($dest, $out_file);
            } else if ($upload['ext'] == 'bmp' || $upload['ext'] == 'wbmp') {
                @imagewbmp($dest, $out_file);
            } else if ($upload['ext'] == 'gif') {
                @imagegif($dest, $out_file);
            }
            @imagedestroy($dest);
            @imagedestroy($source);
            if($thumb['delete'] == 'y') @unlink($upload['d_file']);
            $upload['t_file'] = $out_file;
            $upload['f_name'] = $out_name;

            return $upload;

        } else return false;
    }

    /**
     * 단순 파일 업로드 - 지정한 파일명으로 다이렉트 업로드
     */
    public function upload_file($source, $dir, $chkimg='') {
        if (!$source) return false;

        $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

        /**
         * 업로드 소스 파일명
         */
        $src_name = $source['name'];

        /**
         * 소스 파일 원본
         */
        $srcfile = $source['tmp_name'];

        /**
         * 파일 확장자
         */
        $ext = trim($this->get_file_ext($src_name));

        /**
         * 이미지 파일이라면 체크
         */
        if ($chkimg && !preg_match('/(gif|jpe?g|png)$/i', $ext)) return false;
        else {
            $filename = get_safe_filename($src_name);
            $destfile = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc|phar)/i", "$0-x", $src_name);

            shuffle($chars_array);
            $shuffle = implode('', $chars_array);

            $destfile = md5(sha1($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($destfile);

            /**
             * 업로드 한후 , 퍼미션을 변경함
             */
            @move_uploaded_file($srcfile, $dir.'/'.$destfile);
            @chmod($dir.'/'.$destfile, G5_FILE_PERMISSION);
        }
        
        $upfile['filename'] = $filename;
        $upfile['destfile'] = $destfile;

        return $upfile;
    }
}