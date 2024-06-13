<?php
/**
 * qfile class
 */

class qfile
{
    public function __construct() {
        /**
         * 그누보드5 사용자의 경우, 로고파일 저장 폴더 자동으로 생성하기
         */
        $data_common_path = G5_DATA_PATH.'/common';
        if (!is_dir($data_common_path)) {
            $this->make_directory($data_common_path);
        }

        /**
         * EB시리즈 관련 폴더 생성
         */
        if (!is_dir(G5_DATA_PATH.'/ebslider')) {
            $this->make_directory(G5_DATA_PATH.'/ebslider');
            $this->make_directory(G5_DATA_PATH.'/ebcontents');
            $this->make_directory(G5_DATA_PATH.'/eblatest');
            $this->make_directory(G5_DATA_PATH.'/ebgoods');
            $this->make_directory(G5_DATA_PATH.'/ebbanner');
        }

        /**
         * EYOOM 테마체크 URL 정의
         */
        define('EYOOM_SITE','https://eyoom.net');

        /**
         * 테마체크 URL 정의
         */
        define('EYOOM_AJAX_URL', EYOOM_SITE.'/eyoom4.php');

        /**
         * 테마정보 체크 URL 정의
         */
        define('CHECK_THEME_URL', EYOOM_SITE.'/theme4.php');
    }

    /**
     * 디렉토리 생성
     */
    public function make_directory($path) {
        if (!is_dir($path)) {
            @mkdir($path, G5_DIR_PERMISSION);
            @chmod($path, G5_DIR_PERMISSION);
        }
    }

    /**
     * 파일 확장자 가져오기
     */
    public function get_file_ext($filename) {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    /**
     * 배열을 지정한 파일로 저장 - 폴더에 웹서버의 쓰기 권한이 있어야 함
     */
    public function save_file($outvar, $filename, $info=array(), $int=false) {
        $fp = @fopen($filename, 'w');
        $contents  = "<?php\n";
        $contents .= "if (!defined('_EYOOM_')) exit;\n";
        $contents .= "\$" . $outvar . " = array(\n";
        if ($info != NULL) {
            foreach ($info as $key => $value) {
                if (!is_array($value)) {
                    // 키값으로 정수를 허용하지 않는다면
                    if (!$int) {
                        if (!is_int($key)) {
                            $contents .= "\t\"" . addslashes($key) . "\" => \"" . addslashes($value) . "\",\n";
                        }
                    } else $contents .= "\t\"" . addslashes($key) . "\" => \"" . addslashes($value) . "\",\n";
                } else {
                    $arr = '';
                    foreach ($value as $k => $v) {
                        if (!$int) {
                            if (!is_int($key)) {
                                $arr .= "\"" . addslashes($k) . "\" => \"" . addslashes($v) . "\",";
                            }
                        } else $arr .= "\"" . addslashes($k) . "\" => \"" . addslashes($v) . "\",";
                    }
                    if ($arr) {
                        $arr = substr($arr,0,-1);
                        $contents .= "\t\"" . addslashes($key) . "\" => array(" . $arr . "),\n";
                    }
                }
            }
        }

        $contents .= ");\n";
        @fwrite($fp, $contents);
        @fclose($fp);
        @chmod($filename, 0644);
    }

    /**
     * 지정한 파일 삭제하기
     */
    public function del_file($filename) {
        if (file_exists($filename)) {
            unlink($filename);
            return false;
        }
    }

    /**
     * 특정폴더에 있는 파일 중 일정시간(초)이 지난 파일만 삭제하기
     */
    public function del_timeover_file($path,$second=3600,$match='') {
        if (is_dir($path)) {
            $dir = @dir($path);
            $now = time();

            while($entry = $dir->read()) {
                if ($entry == '.' || $entry == '..' || is_dir($entry) || ($match && !preg_match("/".$match."/i",$entry))) continue;
                else {
                    unset($ctime);
                    $file = $path . "/" . $entry;
                    $ctime = filectime($file);
                    if (($now-$ctime)>$second) @unlink($file);
                }
            }
        }
    }

    /**
     * 특정폴더에 있는 모든 파일 및 폴더 삭제하기
     */
    public function del_all_file($path) {
        $dir = opendir($path);
        while (false !== ($filename = readdir($dir))) {
            if ($filename == '.' || $filename == '..') continue;
            $dest = $path.'/'.$filename;
            if (is_dir($dest)) {
                $this->del_all_file($dest);
                @rmdir($dest);
            } else {
                @unlink($dest);
            }
        }
        @rmdir($path);
    }

    /**
     * 디렉토리 전체 복사 - 하위 디렉토리 및 파일까지 모두
     * system(), exec() shell_exec() 등이 웹호스팅 환경에 따라 실행이 안되는 경우를 위해
     */
    public function copy_dir($src_dir, $dest_dir, $except_dir='') {
        if ($src_dir == $dest_dir) return false;
        if (!is_dir($src_dir)) return false;
        if (!is_dir($dest_dir)) {
            @mkdir($dest_dir, 0707);
            @chmod($dest_dir, 0707);
        }

        $dir = opendir($src_dir);
        while (false !== ($filename = readdir($dir))) {
            if ($filename == '.' || $filename == '..') continue;
            if ($except_dir) {
                if (is_array($except_dir)) {
                    if (in_array($filename, $except_dir)) continue; 
                } else {
                    if ($filename == $except_dir) continue;
                }
            }
            $files[] = $filename;
        }

        for ($i=0; $i<count((array)$files); $i++) {
            $src_file = $src_dir.'/'.$files[$i];
            $dest_file = $dest_dir.'/'.$files[$i];
            if (is_file($src_file)) {
                copy($src_file, $dest_file);
                @chmod($dest_file, 0707);
            }
            if (is_dir($src_file)) {
                $this->copy_dir($src_file, $dest_file, $except_dir);
            }
        }
    }

    /**
     * 에디터로 업로드된 이미지 파일 삭제
     */
    public function delete_editor_image($content) {
        if (!$content) return false;

        /**
         * 게시물 내용에서 이미지 추출
         */
        $matchs = get_editor_image($content,false);
        if (!$matchs) return false;

        for ($i=0; $i<count((array)$matchs[1]); $i++) {
            /**
             * 이미지 path 구함
             */
            $imgurl = parse_url($matchs[1][$i]);
            $srcfile = $_SERVER['DOCUMENT_ROOT'].$imgurl['path'];
            $filename = preg_replace('/\.[^\.]+$/i', '', basename($srcfile));
            $filepath = dirname($srcfile);
            $files = glob($filepath.'/thumb-'.$filename.'*');
            if (is_array($files)) {
                foreach ($files as $filename)
                    @unlink($filename);
            }
            @unlink($srcfile);
        }
    }

    /**
     * 댓글에 첨부한 이미지 삭제
     */
    public function delete_comment_image($content,$bo_table) {
        if (!$content || !$bo_table) return false;

        $b_file = unserialize($content);
        foreach ($b_file as $key => $bf) {
            @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$bf['file']);
        }
    }

    /**
     * 지정한 경로에서 지정한 디렉토리의 하위 디렉토리 정보를 가져옴
     */
    public function get_sub_dir($dir, $target) {
        global $g5;

        $result_array = array();

        $dirname = $target.'/'.$dir.'/';
        $handle = opendir($dirname);
        while ($file = readdir($handle)) {
            if ($file == '.'||$file == '..') continue;

            if (is_dir($dirname.$file)) $result_array[] = $file;
        }
        closedir($handle);
        sort($result_array);

        return $result_array;
    }
}