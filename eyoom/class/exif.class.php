<?php
/**
 * exif class
 */

class exif
{
    protected $exif;
    protected $exif_detail = array();
    public    $exif_item = array();

    public function __construct() {
        global $eyoom_board;

        $this->exif_item = array(
            'maker'     => '제조사',
            'model'     => '모델',
            'datetime'  => '촬영일',
            'size'      => '사이즈',
            'exprogram' => '촬영모드',
            'metermode' => '측광모드',
            'focallen'  => '초점거리',
            'focal35mm' => '35mm환산거리',
            'fnumber'   => '조리개',
            'iso'       => 'ISO',
            'whitebal'  => '화이트밸러스',
            'exptime'   => '노출시간',
            'expbias'   => '노출보정(EV)',
            'ccd'       => 'CCD',
            'flash'     => 'Flash'
        );

        if (isset($eyoom_board) && $eyoom_board['bo_use_exif']) {
            if (!$eyoom_board['bo_exif_detail']) {
                $this->exif_detail = $this->get_exif_default();
            } else {
                $this->exif_detail = unserialize($eyoom_board['bo_exif_detail']);
            }
        }
    }

    /**
     * Exif Default config
     */
    public function get_exif_default() {
        foreach ($this->exif_item as $key => $val) {
            $exif[$key]['item'] = $val;
            $exif[$key]['use'] = 1;
        }
        return $exif;
    }

    /**
     * EXIF 정보 가져오기
     */
    public function get_exif_info($source) {
        global $eyoom_board;

        /**
         * exif_read_data 함수를 지원하는가?
         */
        if ( function_exists('exif_read_data') ) {
            $this->exif = @exif_read_data($source);
            if ($this->exif) {
                $exif_data = array();
                foreach ((array)$this->exif_item as $key => $val) {
                    if ($exif_value = $this->get_exif_value($key)) {
                        $exif_data[$key] = $exif_value;
                    }
                }

                $exif_info  = '<div class="exif_info"><ul><li>';
                $exif_info .= implode('</li><li>', $exif_data);
                $exif_info .= '</li></ul></div>';

                return $exif_info;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function get_exif_value($exif_key) {
        /**
         * exif 필드를 사용하지 않는다면 리턴
         */
        if ($this->exif_detail[$exif_key]['use'] != 1) return false;
        else $exif = $this->exif;

        switch($exif_key) {
            case 'maker':
                if (isset($exif['Make'])) {
                    $exif_value = $exif['Make'];
                }
                break;
            case 'model':
                if (isset($exif['Model'])) {
                    $exif_value = $exif['Model'];
                }
                break;
            case 'datetime':
                if (isset($exif['DateTimeOriginal'])) {
                    $exif_value = $exif['DateTimeOriginal'];
                }
                break;
            case 'size':
                if (isset($exif['COMPUTED']['Width']) && isset($exif['COMPUTED']['Height'])) {
                    $exif_value = number_format($exif['COMPUTED']['Width']) . 'px X ' . number_format($exif['COMPUTED']['Height']) . 'px';
                }
                break;
            case 'exprogram':
                if (isset($exif['ExposureProgram'])) {
                    $exif_value = $this->get_exprogram_mode($exif['ExposureProgram']);
                }
                break;
            case 'metermode':
                if (isset($exif['ExposureProgram'])) {
                    $exif_value = $this->get_metering_mode($exif['MeteringMode']);
                }
                break;
            case 'focallen':
                if (isset($exif['FocalLength'])) {
                    $exif_value = $this->get_focal_length($exif['FocalLength']);
                }
                break;
            case 'focal35mm':
                if (isset($exif['FocalLengthIn35mmFilm'])) {
                    $exif_value = $exif['FocalLengthIn35mmFilm'] . 'mm';
                }
                break;
            case 'fnumber':
                if (isset($exif['COMPUTED']['ApertureFNumber'])) {
                    $exif_value = $exif['COMPUTED']['ApertureFNumber'];
                }
                break;
            case 'iso':
                if (isset($exif['ISOSpeedRatings'])) {
                    $exif_value = $exif['ISOSpeedRatings'];
                }
                break;
            case 'whitebal':
                if (isset($exif['WhiteBalance'])) {
                    $exif_value = $this->get_white_balance($exif['WhiteBalance']);
                }
                break;
            case 'exptime':
                if (isset($exif['ExposureTime'])) {
                    $exif_value = $this->get_expose_time($exif['ExposureTime']);
                }
                break;
            case 'expbias':
                if (isset($exif['ExposureBiasValue'])) {
                    $exif_value = $this->get_expose_bias($exif['ExposureBiasValue']);
                }
                break;
            case 'ccd':
                if (isset($exif['COMPUTED']['CCDWidth'])) {
                    $exif_value = $exif['COMPUTED']['CCDWidth'];
                }
                break;
            case 'flash':
                if (isset($exif['Flash'])) {
                    $exif_value = $this->get_exif_flash($exif['Flash']);
                }
                break;
        }

        // return exif_data
        if (isset($exif_value)) {
            return $this->exif_detail[$exif_key]['item'] ? $this->exif_detail[$exif_key]['item'] . ' : ' . $exif_value : $exif_value;
        } else return false;
    }

    /**
     * 촬영모드
     */
    private function get_exprogram_mode($exif_ep) {
        switch($exif_ep) {
            case 0 : $ep_mode = '자동모드'; break;
            case 1 : $ep_mode = '수동모드'; break;
            case 2 : $ep_mode = '프로그램모드'; break;
            case 3 : $ep_mode = '조리개모드'; break;
            case 4 : $ep_mode = '서터스피드모드'; break;
            default : $ep_mode = '자동모드'; break;
        }
        return $ep_mode;
    }

    /**
     * 측광모드
     */
    private function get_metering_mode($exif_mm) {
        switch($exif_mm) {
            case 0 : $mm_mode = 'Unknown'; break;
            case 1 : $mm_mode = 'Average'; break;
            case 2 : $mm_mode = 'Center weighted averaget'; break;
            case 3 : $mm_mode = 'Spot'; break;
            case 4 : $mm_mode = 'Unknown'; break;
            case 5 : $mm_mode = 'Multi Segment'; break;
            case 6 : $mm_mode = 'Partial'; break;
            default : $mm_mode = 'Unknown'; break;
        }
        return $mm_mode;
    }

    /**
     * 초점거리
     */
    private function get_focal_length($exif_fl) {
        $tmp = explode('/', $exif_fl);
        return ($tmp[0] / $tmp[1]) . 'mm';
    }

    /**
     * 화이트밸런스
     */
    private function get_white_balance($exif_wb) {
        switch($exif_wb) {
            case 0 : $white_balance = 'Auto'; break;
            case 1 : $white_balance = 'Manual'; break;
            default : $white_balance = 'Auto'; break;
        }
        return $white_balance;
    }

    /**
     * 노출시간
     */
    private function get_expose_time($exif_et) {
        $leng=explode('/', $exif_et);
        if ($leng[0]/$leng[1] > 1) {
            $expose_time = ($leng[0]/$leng[1]);
        } else {
            $expose_time = $exif_et;
        }
        return $expose_time;
    }

    /**
     * 노출보정
     */
    private function get_expose_bias($exif_eb) {
        $tmp = explode('/', $exif_eb);
        $expose_bias = $tmp[0] / $tmp[1];
        $expose_bias = substr(strval($expose_bias),0,4);
        $expose_bias = $expose_bias . 'EV';
        return $expose_bias;
    }

    /**
     * Flash
     */
    private function get_exif_flash($exif_fl) {
        switch($exif_fl) {
            case 16 : $exif_flash = 'Off Compulsory'; break;
            case 73 : $exif_flash = 'On Compulsory Red-eye reduction'; break;
            case 9  : $exif_flash = 'On Compulsory'; break;
            case 7  : $exif_flash = 'On'; break;
            default : $exif_flash = 'Unknown'; break;
        }
        return $exif_flash;
    }
}