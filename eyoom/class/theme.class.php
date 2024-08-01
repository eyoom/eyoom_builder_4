<?php
/**
 * theme class
 */

class theme extends qfile
{
    protected $path         = '';
    protected $tmp_path     = '';
    protected $theme_path   = '';
    protected $page_type    = '';
    protected $me_pid       = '';
    protected $bo_new       = 24;
    protected $eyoom        = '';
    public    $is_shop      = false;

    /**
     * Constructor Function
     */
    public function __construct($eb) {
        global $g5, $theme, $shop_theme, $eyoom;
        global $bo_table, $co_id, $gr_id, $board, $pid, $ca_id, $it_id, $faq, $fm_id, $sca, $tag, $po_id, $ev_id;

        $this->tmp_path     = G5_DATA_PATH . '/tmp';
        $this->theme_path   = G5_PATH . '/theme';
        $this->eyoom        = $eyoom;
        $this->g5           = $g5;
        $this->eb           = $eb;
        $this->config       = $config;

        if ($theme) {
            $this->page_type = 'theme';
            $this->me_pid = $theme;
        } else if ($shop_theme) {
            $this->page_type = 'shop_theme';
            $this->me_pid = $shop_theme;
        } else if ($bo_table) {
            $this->page_type = 'board';
            $this->me_pid = $bo_table;
        } else if ($gr_id) {
            $this->page_type = 'group';
            $this->me_pid = $gr_id;
        } else if ($co_id) {
            $this->page_type = 'page';
            $this->me_pid = $co_id;
        } else if ($pid) {
            $this->page_type = 'pid';
            $this->me_pid = $pid;
        } else if ($ca_id) {
            $this->page_type = 'shop';
            $this->me_pid = $ca_id;
        } else if ($it_id) {
            $this->page_type = 'item';
            $this->me_pid = $it_id;
        } else if ($fm_id) {
            $this->page_type = 'faq';
            $this->me_pid = $fm_id;
        } else if ($tag) {
            $this->page_type = 'tag';
            $this->me_pid = $tag;
        } else if ($po_id) {
            $this->page_type = 'poll';
            $this->me_pid = $po_id;
        } else if ($ev_id) {
            $this->page_type = 'event';
            $this->me_pid = $ev_id;
        }
    }

    /**
     * 실제 출력될 테마가 어떤 것인지 체크하여 자동으로 테마 로딩
     */
    public function loading_theme() {
        global $eyoom; // 실제 테마 설정변수

        /**
         * 적용테마, 미리보기 태마를 설정정보를 토대로 결정
         */
        $this->check_theme();

        /**
         * 쇼핑몰 경로인지 체크
         */
        $path_info = $this->eb->get_filename_from_url();
        if ( defined('G5_USE_SHOP') && G5_USE_SHOP && $path_info['dirname'] == G5_SHOP_DIR ) {
            /**
             * 쇼핑몰 테마 설정정보 불러오기
             */
            if (!$this->shop_theme) $this->shop_theme = $this->eyoom['shop_theme'];
            @include_once(G5_DATA_PATH . '/eyoom.' . $this->shop_theme . '.config.php');
            $this->g5_theme = $this->shop_theme;

            $this->is_shop = true;
        } else {
            /**
             * 커뮤니티 테마 설정정보 불러오기
             */
            if (!$this->theme) $this->theme = $eyoom['theme'];
            @include_once(G5_DATA_PATH . '/eyoom.' . $this->theme . '.config.php');
            $this->g5_theme = $this->theme;
        }

        /**
         * 로딩된 테마 설정변수
         */
        $this->eyoom = $eyoom;

        /**
         * 테마정보에 맞게 테마 셋팅
         */
        $this->set_theme_path();

        $this_theme['comm'] = $this->theme;
        $this_theme['shop'] = $this->shop_theme;

        return $this_theme;
    }

    /**
     * 적용테마 및 미리보기 테마 설정
     */
    protected function check_theme() {
        $_user              = array();
        $this->theme        = $this->eyoom['theme'];
        $this->shop_theme   = $this->eyoom['shop_theme'];

        /**
         * GET값으로 테마를 지정할 경우
         */
        if (isset($_GET['theme']) || isset($_GET['shop_theme'])) {
            $_user['theme']      = clean_xss_tags(trim($_GET['theme']));
            $_user['shop_theme'] = clean_xss_tags(trim($_GET['shop_theme']));
            $_config = $this->set_user_theme($_user);
        } else {
            $_config = $this->get_user_theme();
        }

        /**
         * 테마정보가 있다면 해당 테마로 강제 지정
         */
        if (isset($_config['theme'])) $this->theme = $_config['theme'];

        /**
         * 쇼핑몰 테마정보가 있다면 해당 테마로 강제 지정
         */
        if (isset($_config['shop_theme'])) $this->shop_theme = $_config['shop_theme'];
    }

    /**
     * 설정된 테마를 적용하기
     */
    protected function set_theme_path () {
        if ($this->is_shop === true && $this->eyoom['use_gnu_shop'] == 'y') {
            $theme_path = G5_PATH . '/' . G5_THEME_DIR . '/' . $this->eyoom['theme'];
            $theme_url = G5_URL . '/' . G5_THEME_DIR . '/' . $this->eyoom['theme'];
            if (is_dir($theme_path)) {
                define('EYOOM_THEME_PATH', $theme_path);
                define('EYOOM_THEME_URL', $theme_url);
                define('EYOOM_THEME_PAGE_URL', $theme_url . '/page');
                define('EYOOM_CSS_URL', EYOOM_URL.'/'.G5_CSS_DIR);

                if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
                    define('EYOOM_THEME_SHOP_URL', $theme_url.'/'.G5_SHOP_DIR);
                    define('EYOOM_THEME_MSHOP_URL', $theme_url.'/'.G5_MOBILE_DIR.'/'.G5_SHOP_DIR);
                } 
            }
        } else if (isset($this->g5_theme) && trim($this->g5_theme)) {
            $theme_path = G5_PATH . '/' . G5_THEME_DIR . '/' . $this->g5_theme;
            $theme_url = G5_URL . '/' . G5_THEME_DIR . '/' . $this->g5_theme;
            if (is_dir($theme_path)) {
                define('G5_THEME_PATH', EYOOM_PATH);
                define('G5_THEME_MOBILE_PATH', EYOOM_PATH . '/' . G5_MOBILE_DIR);
                define('EYOOM_THEME_PATH', $theme_path);
                define('EYOOM_THEME_URL', $theme_url);
                define('EYOOM_THEME_PAGE_URL', $theme_url . '/page');
                define('EYOOM_CSS_URL', EYOOM_URL.'/'.G5_CSS_DIR);

                /**
                 * 쇼핑몰 경로 정의
                 */
                if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
                    define('G5_THEME_SHOP_PATH', EYOOM_PATH .'/'. G5_SHOP_DIR);
                    define('G5_THEME_MSHOP_PATH', EYOOM_PATH.'/'.G5_MOBILE_DIR.'/'.G5_SHOP_DIR);
                    define('EYOOM_THEME_SHOP_PATH', $theme_path .'/'.G5_SHOP_DIR);
                    define('EYOOM_THEME_SHOP_URL', $theme_url.'/'. G5_SHOP_DIR);
                    define('EYOOM_THEME_MSHOP_PATH', $theme_path.'/'.G5_MOBILE_DIR.'/'.G5_SHOP_DIR);
                    define('EYOOM_THEME_MSHOP_URL', $theme_url.'/'.G5_MOBILE_DIR.'/'.G5_SHOP_DIR);

                    define('EYOOM_THEME_SHOP_SKIN_PATH', $theme_path .'/skin/'.G5_SHOP_DIR.'/'.$this->eyoom['shop_skin']);
                    define('EYOOM_THEME_SHOP_SKIN_URL', $theme_url.'/skin/'.G5_SHOP_DIR.'/'.$this->eyoom['shop_skin']);
                    define('EYOOM_THEME_MSHOP_SKIN_PATH', $theme_path.'/'.G5_MOBILE_DIR.'/skin/'.G5_SHOP_DIR.'/'.$this->eyoom['shop_skin']);
                    define('EYOOM_THEME_MSHOP_SKIN_URL', $theme_url.'/'.G5_MOBILE_DIR.'/skin/'.G5_SHOP_DIR.'/'.$this->eyoom['shop_skin']);
                }
            }
        }
    }

    /**
     * 사용자 지정 테마 설정
     */
    public function set_user_theme($arr) {
        $is_shop_theme = false;
        if ($arr['theme']) {
            $tm_name = $arr['theme'];
        } else if ($arr['shop_theme']) {
            $tm_name = $arr['shop_theme'];
            $is_shop_theme = true;
        }

        /**
         * 테마정보 가져오기
         */
        $tminfo = sql_fetch("select * from {$this->g5['eyoom_theme']} where tm_name='" . sql_real_escape_string($tm_name) . "' || tm_alias='" . sql_real_escape_string($tm_name) . "'",false);

        /**
         * 지정한 사용자 테마 체크
         */
        if ($tminfo['tm_name'] && is_dir($this->theme_path.'/'.$tminfo['tm_name'])) {
            if ($is_shop_theme) {
                $arr['theme']       = $this->eyoom['theme'];
                $arr['shop_theme']  = $tminfo['tm_name'];
            } else {
                $arr['theme']       = $tminfo['tm_name'];
                $arr['shop_theme']  = $this->eyoom['shop_theme'];
            }
        } else {
            $arr['theme']       = $this->eyoom['theme'];
            $arr['shop_theme']  = $this->eyoom['shop_theme'];
        }

        /**
         * 유니크 아이디 쿠키 생성
         */
        if (get_cookie('unique_theme_id')) {
            $unique_theme_id = get_cookie('unique_theme_id');
        } else {
            $unique_theme_id = date('YmdHis', time()) . str_pad((int)(microtime()*100), 2, "0", STR_PAD_LEFT);
            set_cookie('unique_theme_id',$unique_theme_id,3600);
        }

        /**
         * [KVE-2022-0622] 원격코드실행 취약점 패치
         */
        $unique_theme_id = preg_replace("/[^0-9]*/s", '', $unique_theme_id);

        $file = $this->tmp_path . '/' . str_replace(':', '_', $_SERVER['REMOTE_ADDR']) . '.' . $unique_theme_id . '.php';
        if (file_exists($file)) {
            include_once($file);
            if ($is_shop_theme) {
                $arr['theme']       = $user_config['theme'];
            } else {
                $arr['shop_theme']  = $user_config['shop_theme'];
            }
        }
        $_config = $arr;


        /**
         * 파일 생성 및 갱신
         */
        parent::save_file('user_config', $file, $_config);

        /**
         * 특정시간이 지난 파일은 자동 삭제
         */
        parent::del_timeover_file($this->tmp_path);

        /**
         * 사용자 테마가 없다면 파일삭제
         */
        if (!$_config['theme']) {
            parent::del_file($file);
            return false;
        } else return $_config;
    }

    /**
     * 사용자 지정 테마 가져오기
     */
    public function get_user_theme() {
        $unique_theme_id = get_cookie('unique_theme_id');
        $file = $this->tmp_path . '/' . str_replace(':', '_', $_SERVER['REMOTE_ADDR']) . '.' . $unique_theme_id . '.php';

        if (@file_exists($file)) {
            include_once($file);
            return $user_config;
        } else return false;
    }

    /**
     * 테마정보 체크
     */
    public function check_theme_info($tminfo) {
        $hostname = $this->eb->eyoom_host();
        $info = $this->eb->decrypt_md5($tminfo['cm_key'], $tminfo['cm_salt']);
        if ($info) {
            $cminfo = explode('|', $info);
            if ($cminfo[0] != $hostname['host']) {
                $data = array(
                    'theme_name'  => $tminfo['tm_name'],
                    'theme_key'   => $tminfo['tm_key'],
                    'domain_name' => $hostname['host']
                );

                $ch = curl_init(CHECK_THEME_URL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

                $result = curl_exec($ch);
                return $result;
            }
        }
    }

    /**
     * 기능별 스킨 경로
     */
    public function get_skin_path($dir, $skin) {
        $theme_path = '';
        if (!$skin) $skin = 'basic';

        $theme_path = G5_PATH.'/'.G5_THEME_DIR.'/'.$this->g5_theme;
        if (G5_IS_MOBILE) {
            $skin_path = $theme_path.'/'.G5_MOBILE_DIR.'/'.G5_SKIN_DIR.'/'.$dir.'/'.$skin;
            if (!is_dir($skin_path))
                $skin_path = $theme_path.'/'.G5_SKIN_DIR.'/'.$dir.'/'.$skin;
        } else {
            $skin_path = $theme_path.'/'.G5_SKIN_DIR.'/'.$dir.'/'.$skin;
        }

        return $skin_path;
    }

    /**
     * 스킨 url
     */
    function get_skin_url($dir, $skin) {
        $skin_path = $this->get_skin_path($dir, $skin);

        return str_replace(G5_PATH, G5_URL, $skin_path);
    }

    /**
     * 자동메뉴 연동/생성
     */
    public function menu_create($flag) {
        if (!$flag) $flag = 'g5';
        switch($flag) {
            case 'g5'   : $menu = $this->g5_menu_create(); break;
            case 'eyoom': $menu = $this->eyoom_menu_create(); break;
        }
        return $menu;
    }

    /**
     * 그누메뉴 자동생성 : 반복문 안에 SQL문이 반복되어 메뉴가 많을 경우 느려지는 원인이 될 수 있음
     */
    private function g5_menu_create() {
        global $bo_table, $co_id, $gr_id, $board;

        if ($bo_table) {
            $str = "bo_table={$bo_table}";
            $grp = sql_fetch("select gr_id from {$this->g5['board_table']} where bo_table = '{$bo_table}'");
            $gr_str = "gr_id=".$grp['gr_id'];
        }
        if ($gr_id) {
            $gr_str = "gr_id=".$gr_id;
        }
        if ($co_id) $str = "co_id={$co_id}";

        $sql = " select * from {$this->g5['menu_table']} where me_use = '1' and length(me_code) = '2' order by me_order, me_id ";
        $result = sql_query($sql, false);
        $menu = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            if ($str || $gr_str) {
                if ((preg_match('/'.$gr_str.'/i',$row['me_link']) && $gr_str) || (preg_match('/'.$str.'/i',$row['me_link'])) && $str) {
                    if (!defined('_INDEX_')) $row['active'] = true;
                }
            }
            $menu[$i] = $row;

            $loop = &$menu[$i]['submenu'];
            $sql2 = " select * from {$this->g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$row['me_code']}' order by me_order, me_id ";
            $result2 = sql_query($sql2, false);

            for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                if (preg_match('/'.$str.'/i',$row2['me_link']) && $str!='') { $row2['active'] = true; }

                list($url,$tmp_bo_table) = explode('=',$row2['me_link']);
                $sql = "select count(*) as cnt from {$this->g5['board_new_table']} where bn_datetime between date_format(".date('YmdHis',G5_SERVER_TIME - ($this->bo_new * 3600)).", '%Y-%m-%d %H:%i:%s') AND date_format(".date('YmdHis',G5_SERVER_TIME).", '%Y-%m-%d %H:%i:%s') and bo_table = '{$tmp_bo_table}' and wr_id = wr_parent";
                $new = sql_fetch($sql,false);

                if ($new['cnt']>0) {
                    $row2['new'] = true;
                    $menu[$i]['new'] = true;
                }

                $loop[$k] = $row2;
            }
            $menu[$i]['cnt'] = count((array)$loop);
        }
        return $menu;
    }

    /**
     * Eyoom 메뉴
     */
    private function eyoom_menu_create() {
        global $me_shop;

        /**
         * 메뉴정보 가져오기
         */
        $menu_package = $this->eyoom_menu($me_shop);
        if (!$menu_package) return false;
        $menu = $this->eyoom_menu_assign($menu_package);
        return $menu;
    }

    /**
     * Eyoom 메뉴 재정의
     */
    private function eyoom_menu_assign($menu_package) {
        global $member, $sca;

        /**
         * 새글정보 가져오기
         */
        $new = $this->eyoom_menu_new();
        $ca_new = $this->eyoom_menu_ca_new();

        foreach ($menu_package as $k0 => $menu0) {
            if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                $menu0['me_link'] = get_pretty_eyoom_menu_url($menu0['me_type'], $menu0['me_pid'], $menu0['me_link']);
            } else {
                $menu0['me_link'] = $menu0['me_type'] == 'shop' ? shop_category_url($menu0['me_pid']): get_pretty_eyoom_menu_url($menu0['me_type'], $menu0['me_pid'], $menu0['me_link']);
            }
            
            foreach ($menu0 as $k1 => $menu1) {
                if (!is_array($menu1)) {
                    if ($member['mb_level'] < $menu0['me_permit_level']) continue;
                    $mk1 = $menu0['me_order'].$k0;
                    $menu[$mk1][$k1] = $menu1;
                    
                    if ($menu0['me_sca']) {
                        if ($menu0['me_type'] == $this->page_type && $menu0['me_pid'] == $this->me_pid && $menu0['me_sca'] == urldecode($sca)) {
                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                        }
                    } else {
                        if ($menu0['me_type'] == $this->page_type && $menu0['me_pid'] == $this->me_pid) {
                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                        }
                    }

                    @ksort($menu);
                } else {
                    $cate1 = &$menu[$mk1]['submenu'];
                    if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                        $menu1['me_link'] = get_pretty_eyoom_menu_url($menu1['me_type'], $menu1['me_pid'], $menu1['me_link']);
                    } else {
                        $menu1['me_link'] = $menu1['me_type'] == 'shop' ? shop_category_url($menu1['me_pid']): get_pretty_eyoom_menu_url($menu1['me_type'], $menu1['me_pid'], $menu1['me_link']);
                    }
                    foreach ($menu1 as $k2 => $menu2) {
                        if (!is_array($menu2)) {
                            if ($member['mb_level'] < $menu1['me_permit_level']) continue;
                            $mk2 = $menu1['me_order'].$k1;
                            $cate1[$mk2][$k2] = $menu2;
                            
                            if ($menu1['me_sca']) {
                                if ($menu1['me_type'] == $this->page_type && $menu1['me_pid'] == $this->me_pid && $menu1['me_sca'] == urldecode($sca)) {
                                    if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                    $cate1[$mk2]['active'] = true;
                                }
                            } else {
                                if ($menu1['me_type'] == $this->page_type && $menu1['me_pid'] == $this->me_pid) {
                                    if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                    $cate1[$mk2]['active'] = true;
                                }
                            }
        
                            @ksort($cate1);
                        } else {
                            $cate1[$mk2]['sub'] = 'on';
                            $cate2 = &$cate1[$mk2]['subsub'];
                            if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                                $menu2['me_link'] = get_pretty_eyoom_menu_url($menu2['me_type'], $menu2['me_pid'], $menu2['me_link']);
                            } else {
                                $menu2['me_link'] = $menu2['me_type'] == 'shop' ? shop_category_url($menu2['me_pid']): get_pretty_eyoom_menu_url($menu2['me_type'], $menu2['me_pid'], $menu2['me_link']);
                            }
                            foreach ($menu2 as $k3 => $menu3) {
                                if (!is_array($menu3)) {
                                    if ($member['mb_level'] < $menu2['me_permit_level']) continue;
                                    $mk3 = $menu2['me_order'].$k2;
                                    $cate2[$mk3][$k3] = $menu3;
                                    
                                    if ($menu2['me_sca']) {
                                        if ($menu2['me_type'] == $this->page_type && $menu2['me_pid'] == $this->me_pid && $menu2['me_sca'] == urldecode($sca)) {
                                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                            $cate1[$mk2]['active'] = true;
                                            $cate2[$mk3]['active'] = true;
                                        }
                                    } else {
                                        if ($menu2['me_type'] == $this->page_type && $menu2['me_pid'] == $this->me_pid) {
                                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                            $cate1[$mk2]['active'] = true;
                                            $cate2[$mk3]['active'] = true;
                                        }
                                    }
                
                                    @ksort($cate2);
                                } else {
                                    $cate1[$mk2]['sub'] = 'on';
                                    $cate2[$mk3]['sub'] = 'on';
                                    $cate3 = &$cate2[$mk3]['ssubsub'];
                                    if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                                        $menu3['me_link'] = get_pretty_eyoom_menu_url($menu3['me_type'], $menu3['me_pid'], $menu3['me_link']);
                                    } else {
                                        $menu3['me_link'] = $menu3['me_type'] == 'shop' ? shop_category_url($menu3['me_pid']): get_pretty_eyoom_menu_url($menu3['me_type'], $menu3['me_pid'], $menu3['me_link']);
                                    }
                                    foreach ($menu3 as $k4 => $menu4) {
                                        if (!is_array($menu4)) {
                                            if ($member['mb_level'] < $menu3['me_permit_level']) continue;
                                            $mk4 = $menu3['me_order'].$k3;
                                            $cate3[$mk4][$k4] = $menu4;
                                            
                                            if ($menu3['me_sca']) {
                                                if ($menu3['me_type'] == $this->page_type && $menu3['me_pid'] == $this->me_pid && $menu3['me_sca'] == urldecode($sca)) {
                                                    if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                                    $cate1[$mk2]['active'] = true;
                                                    $cate2[$mk3]['active'] = true;
                                                    $cate3[$mk4]['active'] = true;
                                                }
                                            } else {
                                                if ($menu3['me_type'] == $this->page_type && $menu3['me_pid'] == $this->me_pid) {
                                                    if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                                    $cate1[$mk2]['active'] = true;
                                                    $cate2[$mk3]['active'] = true;
                                                    $cate3[$mk4]['active'] = true;
                                                }
                                            }
                        
                                            @ksort($cate3);
                                        } else {
                                            $cate1[$mk2]['sub'] = 'on';
                                            $cate2[$mk3]['sub'] = 'on';
                                            $cate3[$mk4]['sub'] = 'on';
                                            $cate4 = &$cate3[$mk4]['sssubsub'];
                                            if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                                                $menu4['me_link'] = get_pretty_eyoom_menu_url($menu4['me_type'], $menu4['me_pid'], $menu4['me_link']);
                                            } else {
                                                $menu4['me_link'] = $menu4['me_type'] == 'shop' ? shop_category_url($menu4['me_pid']): get_pretty_eyoom_menu_url($menu4['me_type'], $menu4['me_pid'], $menu4['me_link']);
                                            }
                                            foreach ($menu4 as $k5 => $menu5) {
                                                if (!is_array($menu5)) {
                                                    if ($member['mb_level'] < $menu4['me_permit_level']) continue;
                                                    $mk5 = $menu4['me_order'].$k4;
                                                    $cate4[$mk5][$k5] = $menu5;
                                                    
                                                    if ($menu4['me_sca']) {
                                                        if ($menu4['me_type'] == $this->page_type && $menu4['me_pid'] == $this->me_pid && $menu4['me_sca'] == urldecode($sca)) {
                                                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                                            $cate1[$mk2]['active'] = true;
                                                            $cate2[$mk3]['active'] = true;
                                                            $cate3[$mk4]['active'] = true;
                                                            $cate4[$mk5]['active'] = true;
                                                        }
                                                    } else {
                                                        if ($menu4['me_type'] == $this->page_type && $menu4['me_pid'] == $this->me_pid) {
                                                            if (!defined('_INDEX_')) $menu[$mk1]['active'] = true;
                                                            $cate1[$mk2]['active'] = true;
                                                            $cate2[$mk3]['active'] = true;
                                                            $cate3[$mk4]['active'] = true;
                                                            $cate4[$mk5]['active'] = true;
                                                        }
                                                    }
                                
                                                    @ksort($cate4);
                                                } else {
                                                    $cate1[$mk2]['sub'] = 'on';
                                                    $cate2[$mk3]['sub'] = 'on';
                                                    $cate3[$mk4]['sub'] = 'on';
                                                    $cate4[$mk5]['sub'] = 'on';
                                                    $cate5 = &$cate4[$mk5]['ssssubsub'];
                                                    if (!defined('G5_USE_SHOP') || !G5_USE_SHOP) {
                                                        $menu5['me_link'] = get_pretty_eyoom_menu_url($menu5['me_type'], $menu5['me_pid'], $menu5['me_link']);
                                                    } else {
                                                        $menu5['me_link'] = $menu5['me_type'] == 'shop' ? shop_category_url($menu5['me_pid']): get_pretty_eyoom_menu_url($menu5['me_type'], $menu5['me_pid'], $menu5['me_link']);
                                                    }
                                                    foreach ($menu5 as $k6 => $menu6) {
                                                        ;
                                                    }
                                                    
                                                    if ($menu5['me_type'] == 'board' && $menu5['me_pid']) {
                                                        $tmp_bo_table = $menu5['me_pid'];
                                                        if ($menu5['me_sca']) {
                                                            if ($ca_new[$menu4['me_sca']]>0) {
                                                                $cate5[$mk6]['new'] = true;
                                                                $cate4[$mk5]['new'] = true;
                                                                $cate3[$mk4]['new'] = true;
                                                                $cate2[$mk3]['new'] = true;
                                                                $cate1[$mk2]['new'] = true;
                                                                $menu[$mk1]['new'] = true;
                                                            }
                                                        } else {
                                                            if ($new[$tmp_bo_table]>0) {
                                                                $cate5[$mk6]['new'] = true;
                                                                $cate4[$mk5]['new'] = true;
                                                                $cate3[$mk4]['new'] = true;
                                                                $cate2[$mk3]['new'] = true;
                                                                $cate1[$mk2]['new'] = true;
                                                                $menu[$mk1]['new'] = true;
                                                            }
                                                        }
                                                    }
                                                }

                                            }
                                            
                                            if ($menu4['me_type'] == 'board' && $menu4['me_pid']) {
                                                $tmp_bo_table = $menu4['me_pid'];
                                                if ($menu4['me_sca']) {
                                                    if ($ca_new[$menu4['me_sca']]>0) {
                                                        $cate4[$mk5]['new'] = true;
                                                        $cate3[$mk4]['new'] = true;
                                                        $cate2[$mk3]['new'] = true;
                                                        $cate1[$mk2]['new'] = true;
                                                        $menu[$mk1]['new'] = true;
                                                    }
                                                } else {
                                                    if ($new[$tmp_bo_table]>0) {
                                                        $cate4[$mk5]['new'] = true;
                                                        $cate3[$mk4]['new'] = true;
                                                        $cate2[$mk3]['new'] = true;
                                                        $cate1[$mk2]['new'] = true;
                                                        $menu[$mk1]['new'] = true;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    
                                    if ($menu3['me_type'] == 'board' && $menu3['me_pid']) {
                                        $tmp_bo_table = $menu3['me_pid'];
                                        if ($menu3['me_sca']) {
                                            if ($ca_new[$menu3['me_sca']]>0) {
                                                $cate3[$mk4]['new'] = true;
                                                $cate2[$mk3]['new'] = true;
                                                $cate1[$mk2]['new'] = true;
                                                $menu[$mk1]['new'] = true;
                                            }
                                        } else {
                                            if ($new[$tmp_bo_table]>0) {
                                                $cate3[$mk4]['new'] = true;
                                                $cate2[$mk3]['new'] = true;
                                                $cate1[$mk2]['new'] = true;
                                                $menu[$mk1]['new'] = true;
                                            }
                                        }
                                    }
                                }
                            }
                            
                            if ($menu2['me_type'] == 'board' && $menu2['me_pid']) {
                                $tmp_bo_table = $menu2['me_pid'];
                                if ($menu2['me_sca']) {
                                    if ($ca_new[$menu2['me_sca']]>0) {
                                        $cate2[$mk3]['new'] = true;
                                        $cate1[$mk2]['new'] = true;
                                        $menu[$mk1]['new'] = true;
                                    }
                                } else {
                                    if ($new[$tmp_bo_table]>0) {
                                        $cate2[$mk3]['new'] = true;
                                        $cate1[$mk2]['new'] = true;
                                        $menu[$mk1]['new'] = true;
                                    }
                                }
                            }
                        }
                    }
                    
                    if ($menu1['me_type'] == 'board' && $menu1['me_pid']) {
                        $tmp_bo_table = $menu1['me_pid'];
                        if ($menu1['me_sca']) {
                            if ($ca_new[$menu1['me_sca']]>0) {
                                $cate1[$mk2]['new'] = true;
                                $menu[$mk1]['new'] = true;
                            }
                        } else {
                            if ($new[$tmp_bo_table]>0) {
                                $cate1[$mk2]['new'] = true;
                                $menu[$mk1]['new'] = true;
                            }
                        }
                    }
                }
            }
            
            if ($menu0['me_type'] == 'board' && $menu0['me_pid']) {
                $tmp_bo_table = $menu0['me_pid'];
                if ($menu0['me_sca']) {
                    if ($ca_new[$menu0['me_sca']]>0) {
                        $menu[$mk1]['new'] = true;
                    }
                } else {
                    if ($new[$tmp_bo_table]>0) {
                        $menu[$mk1]['new'] = true;
                    }
                }
            }
        }
        
        return $menu;
    }

    /**
     * Eyoom New 테이블에서 최근글 정보 가져옴 : 2015-02-25 그림자밟기님이 아이디어를 제공해 주셨습니다.
     */
    private function eyoom_menu_new($bo_new=24) {
        global $g5;
        if (!$bo_new) $bo_new = $this->bo_new;
        $sql = "select bo_table, count(*) as cnt from {$this->g5['board_new_table']} where bn_datetime between date_format(".date("YmdHis",G5_SERVER_TIME - ($bo_new * 3600)).", '%Y-%m-%d %H:%i:%s') AND date_format(".date("YmdHis",G5_SERVER_TIME).", '%Y-%m-%d %H:%i:%s') and wr_id = wr_parent group by bo_table";
        $res = sql_query($sql, false);
        $new = array();
        if ($res) {
            for ($i=0;$row=sql_fetch_array($res);$i++) {
                $new[$row['bo_table']] = $row['cnt'];
            }
            return $new;
        } else return false;
    }

    /**
     * 게시판 분류사용시, 새글정보
     */
    private function eyoom_menu_ca_new($bo_new=24) {
        global $g5;
        if (!$bo_new) $bo_new = $this->bo_new;
        $sql = "select ca_name, count(*) as cnt from {$this->g5['board_new_table']} where bn_datetime between date_format(".date("YmdHis",G5_SERVER_TIME - ($bo_new * 3600)).", '%Y-%m-%d %H:%i:%s') AND date_format(".date("YmdHis",G5_SERVER_TIME).", '%Y-%m-%d %H:%i:%s') and wr_id = wr_parent group by ca_name";
        $res = sql_query($sql, false);
        $ca_new = array();
        if ($res) {
            for ($i=0;$row=sql_fetch_array($res);$i++) {
                $ca_new[$row['ca_name']] = $row['cnt'];
            }
            return $ca_new;
        } else return false;
    }

    /**
     * 링크로 부터 sca 추출하기
     */
    private function get_sca_from_link($link) {
        $str = parse_url(urldecode($link));
        parse_str($str['query'], $query);
        return $query['sca'];
    }

    /**
     * Eyoom 메뉴 패키지
     */
    public function eyoom_menu($me_shop=2, $theme='') {
        global $admin_mode;

        if (!$admin_mode) $addwhere = " and me_use = 'y' and me_use_nav = 'y' ";
        if (!$me_shop) $me_shop = 2;

        $theme_name = $me_shop == 1 || defined('_SHOP_') ? $this->shop_theme: $this->theme;
        if ($admin_mode) $theme_name = $theme ? $theme: $this->theme;
        $addwhere .= " and me_shop = '".$me_shop."' ";
        $sql = " select *
                    from {$this->g5['eyoom_menu']}
                    where me_theme='" . sql_real_escape_string($theme_name) . "' {$addwhere}
                    order by
                    case
                        when length(me_code) = 3 then cast(me_order as signed)
                        when length(me_code) = 6 then cast(concat(left(me_code, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 9 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 12 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), substring(me_code, 7, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 15 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), substring(me_code, 7, 3), substring(me_code, 10, 3), lpad('', 3, '0'), me_order) as signed)
                        else cast(me_order as signed)
                    end
        ";
        $res = sql_query($sql, false);
        $menu = array();
        for ($i=0;$row=sql_fetch_array($res);$i++) {
            $split = str_split($row['me_code'],3);
            $depth = count((array)$split);

            if ($depth==1) $menu[$split[0]] = $row;
            if ($depth==2) $menu[$split[0]][$split[1]] = $row;
            if ($depth==3) $menu[$split[0]][$split[1]][$split[2]] = $row;
            if ($depth==4) $menu[$split[0]][$split[1]][$split[2]][$split[3]] = $row;
            if ($depth==5) $menu[$split[0]][$split[1]][$split[2]][$split[3]][$split[4]] = $row;
        }
        return $menu;
    }

    /**
     * 서브페이지 좌/우측에 해당 페이지의 서브메뉴 가져오기
     */
    public function submenu_create($flag='') {
        if (!$flag) $flag = 'g5';
        switch($flag) {
            case 'g5'   : $submenu = $this->g5_submenu_create(); break;
            case 'eyoom': $submenu = $this->eyoom_submenu_create(); break;
        }
        return $submenu;
    }

    /**
     * g5 서브 메뉴 만들기
     */
    private function g5_submenu_create($me_code) {
        $sql = " select * from {$this->g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$me_code}' order by me_order, me_id ";
        $result = sql_query($sql, false);
        $submenu = array();
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $submenu[$i] = $row;
        }
        return $submenu;
    }

    /**
     * Eyoom 서브메뉴 생성하기
     */
    private function eyoom_submenu_create() {
        $data = $this->eyoom_pagemenu_info();
        $menu_package = $this->eyoom_submenu($data);
        if (!$menu_package) return false;
        $submenu = $this->eyoom_menu_assign($menu_package);
        return $submenu;
    }

    /**
     * 페이지 정보 가져오기
     */
    private function eyoom_pagemenu_info() {
        $url = $this->compare_host_from_link($_SERVER['REQUEST_URI']);
        $info = $this->get_meinfo_link($url);
        $sql = "select * from {$this->g5['eyoom_menu']} where me_theme='" . sql_real_escape_string($this->theme) . "' and me_type='{$info['me_type']}' and me_pid='{$info['me_pid']}'";
        $data = sql_fetch($sql,false);
        return $data;
    }

    /**
     * Eyoom 서브메뉴 패키지
     */
    public function eyoom_submenu($data) {
        if (!$data) $data = $this->eyoom_pagemenu_info();
        if (!$admin_mode) $addwhere = " and me_use = 'y' "; // 감추기 기능 연동 - fm25님이 제보해 주셨습니다.
        if (defined('_SHOP_')) $me_shop='1'; else $me_shop='2'; 
        $addwhere .= " and me_shop='{$me_shop}' ";
        $me_code = str_split($data['me_code'],3);
        $sql = " select *
                    from {$this->g5['eyoom_menu']}
                    where me_theme='" . sql_real_escape_string($this->theme) . "' and me_code like '{$me_code[0]}%' and length(me_code) > 3 {$addwhere}
                    order by
                    case
                        when length(me_code) = 3 then cast(me_order as signed)
                        when length(me_code) = 6 then cast(concat(left(me_code, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 9 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 12 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), substring(me_code, 7, 3), lpad('', 3, '0'), me_order) as signed)
                        when length(me_code) = 15 then cast(concat(left(me_code, 3), substring(me_code, 4, 3), substring(me_code, 7, 3), substring(me_code, 10, 3), lpad('', 3, '0'), me_order) as signed)
                        else cast(me_order as signed)
                    end
        ";
        $res = sql_query($sql, false);
        $menu = array();
        for ($i=0;$row=sql_fetch_array($res);$i++) {
            $split = str_split($row['me_code'],3);
            $depth = count((array)$split);

            if ($depth==2) $menu[$split[1]] = $row;
            if ($depth==3) $menu[$split[1]][$split[2]] = $row;
            if ($depth==4) $menu[$split[1]][$split[2]][$split[3]] = $row;
            if ($depth==5) $menu[$split[1]][$split[2]][$split[3]][$split[4]] = $row;
        }
        return $menu;
    }

    /**
     * Eyoom 메뉴 배열을 JSON 형식으로 변환
     */
    public function eyoom_menu_json($arr) {
        $output = '';
        if (is_array($arr)) {
            $output .= ',"children":[';
            $_output = array();
            $i=0;
            foreach ($arr as $key => $val) {
                if (is_array($val)) {
                    if (strlen($val['me_code'])<2) continue;
                    unset($blind);
                    $me_order = $val['me_order'];
                    if ($val['me_use'] == 'n') $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
                    $_output[$key] .= '{';
                    $_output[$key] .= '"id":"'.$val['me_code'].'",';
                    $_output[$key] .= '"order":"'.$me_order.'",';
                    $_output[$key] .= '"text":"'.trim($val['me_name']).$blind.'"';
                    if (is_array($val) && count((array)$val)>3) $_output[$key] .= $this->eyoom_menu_json($val);
                    $_output[$key] .= '}';
                }
                $i++;
            }
            $output .= @implode(',',$_output);
            $output .= ']';
        }
        return $output;
    }

    /**
     * 메뉴코드를 단계별로 잘라 배열에 담기
     */
    private function get_splited_code($split=array()) {
        $cnt = count((array)$split);
        if ($cnt<1) return false;
        else {
            for ($i=0;$i<$cnt;$i++) {
                if ($i==0) $code[$i] = $split[$i];
                else $code[$i] = $code[$i-1].$split[$i];
            }
        }
        return $code;
    }

    /**
     * 메뉴코드에서 위치정보 가져오기 - 반복문 안에 쿼리문으로 권장하지 않은 방법
     * 만들긴 했지만 거의 사용하지 않을 예정 - 관리자모드에서 사용
     */
    public function get_path($me_code) {
        $split = str_split($me_code,3);
        $code = $this->get_splited_code($split);
        $path_name = array();
        if (is_array($code)) {
            for ($i=0;$i<count((array)$code);$i++) {
                $path = sql_fetch("select me_name from {$this->g5['eyoom_menu']} where me_code='{$code[$i]}'");
                $path_name[$i] = $path['me_name'];
            }
        }
        $path_string = implode(" &gt; ", $path_name);
        return $path_string;
    }

    /**
     * 메뉴 링크로 부터 메뉴속성 추출하기
     */
    public function get_meinfo_link($url) {
        global $bo_table;

        if (preg_match('/\b(qa|respond|memo|memo_form)\b/i', $url['path'])) {
            unset($url['query']);
        }

        if ($url['query']) {
            parse_str($url['query'],$query);
            if ($query['pid'] && $query['theme']) unset($query['theme']);
            foreach ($query as $key => $val) {
                if (in_array($key,array('theme', 'shop_theme', 'bo_table', 'gr_id', 'co_id', 'type', 'ca_id', 'it_id', 'br_cd', 'pid', 'faq', 'fm_id', 'sca', 'sfl', 'tag', 'po_id', 'ev_id', 't'))) {
                    switch($key) {
                        case 'theme'        : $info['me_type'] = 'theme'; break;
                        case 'shop_theme'   : $info['me_type'] = 'shop_theme'; break;
                        case 'bo_table'     : $info['me_type'] = 'board'; break;
                        case 'gr_id'        : $info['me_type'] = 'group'; break;
                        case 'co_id'        : $info['me_type'] = 'page'; break;
                        case 'ca_id'        : $info['me_type'] = 'shop'; break;
                        case 'br_cd'        : $info['me_type'] = 'brand'; break;
                        case 'it_id'        : $info['me_type'] = 'item'; break;
                        case 'type'         : $info['me_type'] = 'type'; break;
                        case 'pid'          : $info['me_type'] = 'pid'; break;
                        case 'faq'          : $info['me_type'] = 'faq'; break;
                        case 'fm_id'        : $info['me_type'] = 'faq'; break;
                        case 'qalist'       : $info['me_type'] = 'qalist'; break;
                        case 'sca'          : $info['me_type'] = 'board'; break;
                        case 'sfl'          : $info['me_type'] = 'search'; break;
                        case 'tag'          : $info['me_type'] = 'tag'; break;
                        case 'po_id'        : $info['me_type'] = 'poll'; break;
                        case 'ev_id'        : $info['me_type'] = 'event'; break;
                        case 't'            : $info['me_type'] = 'mypage'; break;
                    }
                    
                    if ($key != 'sca') {
                        $info['me_pid']  = $val;
                    } else {
                        $info['me_pid']  = $bo_table;
                    }
                    $info['me_link'] = $url['path']."?".$url['query'];
                    $info['me_link'] .= $url['fragment']?'#'.$url['fragment']:'';
                    $info['me_sca'] = $query['sca'];
                }
                if ($key == 'bo_table') break;
            }
            if (!$info) {
                $info['me_pid'] = basename($url['path']);
                $info['me_type'] = 'userpage';
                $info['me_link'] = $url['path'];
                $info['me_link'] .= $url['fragment']?'#'.$url['fragment']:'';
            }
        } else if ($url['path']) {
            if (preg_match('/\bqa\b/i', $url['path'])) {
                $url['path'] = 'qalist.php';
            } else if (preg_match('/\brespond\b/i', $url['path'])) {
                $url['path'] = 'respond.php';
            } else if (preg_match('/\b(memo|memo_form)\b/i', $url['path'])) {
                $url['path'] = 'memo.php';
            }
            $info['me_pid'] = basename($url['path']);
            $info['me_type'] = 'userpage';
            $info['me_link'] = $url['path'];
            $info['me_link'] .= $url['fragment']?'#'.$url['fragment']:'';
        } else {
            $info['me_pid'] = 'intra';
            $info['me_type'] = 'userpage';
            $info['me_link'] = $url['path'];
            $info['me_link'] .= $url['fragment']?'#'.$url['fragment']:'';
        }
        if (is_array($info)) return $info;
    }

    // 메뉴링크 정보 가져오기
    public function get_menu_link($link) {
        $info = array();
        $url = $this->compare_host_from_link($link);
        if ($url) {
            $info = $this->get_meinfo_link($url);
            if (preg_match('/\bqa\b/i', $info['me_pid']) && $info['me_pid'] != 'qa' || preg_match('/\b(respond|memo|memo_form)\b/i', $info['me_pid']) ) {
                $info['me_link'] = $url['path'];
            }
        } else {
            $info['me_pid'] = 'extra';
            $info['me_type'] = 'userpage';
            $info['me_link'] = $link;
            $info['me_sca'] = '';
        }
        if (is_array($info)) return $info;
    }

    // 입력한 링크가 해당 도메인인지 아닌지 검토
    public function compare_host_from_link($link) {
        global $config;

        if($config['cf_bbs_rewrite']) {
            $link = get_query_url_from_pretty_url($link);
            if ($link) {
                return parse_url($link);
            } else {
                return false;
            }
        } else {
            $url = parse_url($link);
            if ($url['host']) {
                if(!$this->compare_host($url)) {
                    return false;
                }
            }
            return $url;
        }
    }

    // 호스트명 비교
    public function compare_host ($parsed_url) {
        $host = preg_replace('/www\./i','',$parsed_url['host']);
        if ($parsed_url['port']) $host .= ':' . $parsed_url['port'];
        $_host = preg_replace('/www\./i','',$_SERVER['HTTP_HOST']);
        if ($host != $_host) {
            return false;
        } else {
            return true;
        }
    }

    // 서브페이지의 title 및 Path 가져오기
    public function subpage_info($menu_array) {
        if ($this->eyoom['use_eyoom_menu'] == 'y') {
            $page_info = $this->eyoom_subpage_info($this->theme);
        } else {
            $page_info = $this->g5_subpage_info($menu_array);
        }
        return $page_info;
    }

    // eyoom메뉴 서브페이지 정보 가져오기
    private function eyoom_subpage_info($theme) {
        global $g5, $it_id, $is_admin, $ca_id, $board, $member;

        /**
         * URL에서 메뉴정보 추출
         */
        $url = $this->compare_host_from_link($_SERVER['REQUEST_URI']);
        $info = $this->get_meinfo_link($url);
        foreach ($info as &$value) {
            $value = filter_var($value, FILTER_SANITIZE_STRING);
        }

        /**
         * 분류명 체크
         */
        $_sca = $this->get_sca_from_link($info['me_link']);
        if ($_sca) {
            $_sca = filter_var($_sca, FILTER_VALIDATE_REGEXP, array(
                "options" => array("regexp" => "/^[^<>'\"%=\(\)\/\^\*]+$/")
            ));
            $_sca = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", "", clean_xss_tags(trim($_sca)));
        }

        if ($_sca) {
            $where = " me_theme='" . sql_real_escape_string($theme) . "' and me_type='{$info['me_type']}' and me_pid='{$info['me_pid']}' and me_sca='{$_sca}' ";
        } else {
            if (!$board['bo_use_category']) {
                $where = " me_theme='" . sql_real_escape_string($theme) . "' and me_type='{$info['me_type']}' and me_pid='{$info['me_pid']}' ";
            } else {
                $where = " me_theme='" . sql_real_escape_string($theme) . "' and me_type='{$info['me_type']}' and me_pid='{$info['me_pid']}' and me_sca='' ";
            }
        }

        /**
         * 쇼핑몰 아이템 페이지
         */
        if ($it_id) $where .= " and me_link='{$info['me_link']}' ";

        /**
         * 쇼핑몰인지 체크
         */
        $where .= defined('_SHOP_') ? " and me_shop = '1' ": " and me_shop = '2' ";

        $sql = "select * from {$this->g5['eyoom_menu']} where $where order by me_code desc";
        $data = sql_fetch($sql,false);

        if ($_sca && !$data['me_id']) {
            $where = " me_theme='" . sql_real_escape_string($theme) . "' and me_type='{$info['me_type']}' and me_pid='{$info['me_pid']}' and me_sca='' ";

            if ($it_id) $where .= " and me_link='{$info['me_link']}' ";

            $sql = "select * from {$this->g5['eyoom_menu']} where $where order by me_code desc";
            $data = sql_fetch($sql,false);
        }

        if ($data['me_id']) {
            $me_path = explode(' > ',$data['me_path']);
            $cnt = count($me_path);
            foreach ($me_path as $key => $me_name) {
                if ($cnt-1 == $key) {
                    $active = "class='active'";
                }
                $path .= "<li {$active}>".$me_name."</li>";
            }
            $page_info['title'] = $data['me_name'];
            $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li>".$path;
            $page_info['subtitle'] = $me_path[0];
            $page_info['sidemenu'] = $data['me_side'];
            $page_info['registed'] = 'y';
            // 메뉴코드 정보
            $me_code = str_split($data['me_code'],3);
            $page_info['cate1'] = $me_code[0];
            $page_info['cate2'] = $me_code[1];
        } else {
            if ($it_id || $ca_id) $page_info = $this->shop_subpage_info();
            else $page_info = $this->get_default_page();
        }
        if (!$page_info['title']) {
            if ($is_admin) {
                $page_info['title'] = '미등록페이지';
                $page_info['path'] = "<a href='".G5_ADMIN_URL."/?dir=theme&amp;pid=menu_list&amp;wmode=1' onclick='eb_admset_modal(this.href); return false;' style='color:#f30;'>관리자모드 > 테마관리 > 홈페이지메뉴설정</a> 에서 메뉴를 등록해 주세요.";
            } else {
                $page_info['title'] = '미등록페이지';
                $page_info['path'] = '메뉴등록이 안된 페이지입니다.';
            }
        }
        return $page_info;
    }

    // 그누메뉴 서브페이지 정보 가져오기
    private function g5_subpage_info($menu_array) {
        global $g5, $bo_table, $co_id, $board, $co, $gr_id, $ca_id, $it_id;

        if ($bo_table || $co_id) {
            $stx = $bo_table ? "bo_table=".$bo_table : "co_id=".$co_id;
            foreach ($menu_array as $key => $menu) {
                if (is_array($menu['submenu'])) {
                    foreach ($menu['submenu'] as $k => $sub) {
                        if (preg_match('/$stx/',$sub['me_link'])) {
                            $submenu['cate1']['me_code'] = $menu['me_code'];
                            $submenu['cate1']['link'] = $menu['me_link'];
                            $submenu['cate1']['name'] = $menu['me_name'];
                            $submenu['cate2'] = $sub;
                            break;
                        }
                    }
                }
            }
            if ($submenu) {
                $page_info['pr_code'] = $submenu['cate1']['me_code'];
                $page_info['subtitle'] = $submenu['cate1']['name'];
                $page_info['title'] = $submenu['cate2']['me_name'];
                $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li><a href='".$submenu['cate1']['link']."'>" . $submenu['cate1']['name'] . "</a></li><li class='active'>" . $submenu['cate2']['me_name']."</li>";
            }

            if (!$page_info) {
                if ($bo_table) {
                    $page_info['title'] = $board['bo_subject'];
                    $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li class='active'>".$board['bo_subject']."</li>";
                } else if ($co_id) {
                    $page_info['title'] = $co['co_subject'];
                    $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li class='active'>".$co['co_subject']."</li>";
                }
            }
        } else if ($gr_id) {
            // Group 페이지 정보
            $sql = "select gr_subject from {$this->g5['group_table']} where gr_id='" . sql_real_escape_string($gr_id) . "'";
            $group = sql_fetch($sql, false);

            if ($group['gr_subject']) {
                $page_info['title'] = $group['gr_subject'];
                $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li class='active'>".$group['gr_subject']."</li>";
            }

        } else {
            // 새글 / 1:1문의 / 내글반응 / 회원관련 페이지 등 정해진 페이지 정보
            if ($it_id || $ca_id) $page_info = $this->shop_subpage_info();
            else $page_info = $this->get_default_page();
        }

        if (!$page_info['title']) {
            if ($is_admin) {
                $page_info['title'] = '미등록페이지';
                $page_info['path'] = "<a href='".G5_ADMIN_URL."/?dir=theme&amp;pid=menu_list&amp;wmode=1' onclick='eb_admset_modal(this.href); return false;' style='color:#f30;'>관리자모드 > 테마관리 > 홈페이지메뉴설정</a> 에서 메뉴를 등록해 주세요.";
            } else {
                $page_info['title'] = '미등록페이지';
                $page_info['path'] = '메뉴등록이 안된 페이지입니다.';
            }
        }
        return $page_info;
    }

    // 이미 존재하는 기능페이지 정보
    private function get_default_page() {
        global $is_member, $type, $board, $pid, $gr_id;

        $temp_sname = explode('/',$_SERVER['SCRIPT_NAME']);
        list($key,$ext) = explode('.',$temp_sname[count($temp_sname)-1]);
        parse_str($_SERVER['QUERY_STRING'],$query);
        if ($key == 'board' && $query['sfl'] && $query['stx']) $key = 'bo_search';

        switch($key) {
            case 'new'              : $title = '새글모음'; break;
            case 'best'             : $title = '인기게시물'; break;
            case 'respond'          : $title = '내글반응'; break;
            case 'search'           : $title = '전체검색'; break;
            case 'bo_search'        : $title = '검색결과'; $cate_name = $board['bo_subject']; break;
            case 'write'            :
            case 'board'            : $title = $board['bo_subject']; $cate_name = '게시판'; break;
            case 'faq'              : $title = '자주하시는 질문'; break;
            case 'qalist'           :
            case 'qawrite'          :
            case 'qaview'           : $title = '1:1문의'; break;
            case 'current_connect'  : $title = '현재접속자'; break;
            case 'register'         : $title = '약관동의'; $cate_name = '회원가입'; break;
            case 'register_form'    : $title = $is_member ? '정보수정': '정보입력'; $cate_name = $is_member ? '멤버쉽': '회원가입'; break;
            case 'register_result'  : $title = '회원가입완료'; $cate_name = '회원가입'; break;
            case 'register_member'  : $title = '회원가입'; $cate_name = '소셜로그인 회원가입'; break;
            case 'password_lost'    : $title = '회원정보찾기'; $cate_name = '회원정보'; break;
            case 'password_reset'   : $title = '비밀번호재설정'; $cate_name = '회원정보'; break;
            case 'cart'             : $title = '장바구니'; $cate_name = '쇼핑몰'; break;
            case 'wishlist'         : $title = '위시리스트'; $cate_name = '쇼핑몰'; break;
            case 'orderform'        : $title = '주문하기'; $cate_name = '쇼핑몰'; break;
            case 'orderinquiryview' : $title = '구매내역 상세보기'; $cate_name = '쇼핑몰'; break;
            case 'orderinquiry'     : $title = '구매내역'; $cate_name = '쇼핑몰'; break;
            case 'event'            : $title = '이벤트'; $cate_name = '쇼핑몰'; break;
            case 'mypage'           : $title = '마이페이지'; $cate_name = '쇼핑몰'; break;
            case 'personalpay'      :
            case 'personalpayform'  :
            case 'personalpayresult': $title = '개인결제'; $cate_name = '쇼핑몰'; break;
            case 'itemqalist'       : $title = '상품문의'; $cate_name = '쇼핑몰'; break;
            case 'itemuselist'      : $title = '사용후기'; $cate_name = '쇼핑몰'; break;
            case 'itempatchlist'    : $title = '패치내역'; $cate_name = '쇼핑몰'; break;
            case 'couponzone'       : $title = '쿠폰존'; $cate_name = '쇼핑몰'; break;
            case 'listtype':
                switch($type) {
                    case 1: $title = '히트상품'; $cate_name = '쇼핑몰'; break;
                    case 2: $title = '추천상품'; $cate_name = '쇼핑몰'; break;
                    case 3: $title = '최신상품'; $cate_name = '쇼핑몰'; break;
                    case 4: $title = '인기상품'; $cate_name = '쇼핑몰'; break;
                    case 5: $title = '할인상품'; $cate_name = '쇼핑몰'; break;
                }
                break;
            case 'brand': $title = '브랜드'; $cate_name = '쇼핑몰'; break;
            case 'group':
                if ($gr_id) {
                    $gr_id = preg_replace('/[^a-z0-9_]/i', '', $gr_id);
                    $gr = sql_fetch("select * from {$this->g5['group_table']} where gr_id = '" . sql_real_escape_string($gr_id) . "' ");
                    $title = $gr['gr_subject'];
                }
                break;
            case 'index':
                if ($pid == 'aboutus') { $title = '회사소개'; }
                if ($pid == 'contactus') { $title = '찾아오시는길'; }
                if ($pid == 'provision') { $title = '이용약관'; }
                if ($pid == 'privacy') { $title = '개인정보취급방침'; }
                if ($pid == 'noemail') { $title = '이메일무단수집거부'; }
                if ($pid == 'counsel') { $title = '상담 신청'; }
                break;
        }

        if (defined('_TAG_')) {
            // 태그 페이지
            if ($_GET['tag']) {
                $tag = str_replace('^','&',get_text($_GET['tag']));
                $page_info['title'] = str_replace('*',' <span style="font-weight:normal;color:#aaa;">&gt;</span> ',$tag);
                $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li>태그</li><li>".str_replace('*','</li><li>',$tag)."</li>";
                $page_info['subtitle'] = '태그';
            } else {
                $page_info['title'] = '태그 크라우드';
                $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li>태그</li><li>".$page_info['title']."</li>";
                $page_info['subtitle'] = '태그';
            }
        } else if (!$cate_name) {
            $page_info['title'] = $title;
            $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li class='active'>".$title."</li>";
        } else {
            $page_info['title'] = $title;
            $page_info['path'] = "<li><a href='".G5_URL."'>Home</a></li><li>".$cate_name."</li><li class='active'>".$title."</li>";
            $page_info['subtitle'] = $cate_name;
        }
        return $page_info;
    }

    public function shop_subpage_info() {
        global $shop, $ca_id, $it_id;

        if ($it_id) {
            $row = sql_fetch("select ca_id, ca_id2, ca_id3 from {$this->g5['g5_shop_item_table']} where it_id='{$it_id}' limit 1");
            if ($row['ca_id3']) {
                $ca_id = $row['ca_id3'];
            } else if ($row['ca_id2']) {
                $ca_id = $row['ca_id2'];
            } else if ($row['ca_id']) {
                $ca_id = $row['ca_id'];
            }
            $cate1 = $shop->get_navi($row['ca_id']);
        }

        $path = $shop->get_navi($ca_id);
        $pageinfo['title'] = $path['title'];
        $pageinfo['path'] = "<li><a href='".G5_URL."'>Home</a></li>".$path['path'];
        $pageinfo['subtitle'] = $cate1['title'];
        $page_info['registed'] = 'y';
        return $pageinfo;
    }

    /**
     * 테마 기업정보 기본값
     */
    public function default_bizinfo() {
        /**
         * 디렉토리가 없다면 생성
         */
        @mkdir(G5_DATA_PATH.'/bizinfo/', G5_DIR_PERMISSION);
        @chmod(G5_DATA_PATH.'/bizinfo/', G5_DIR_PERMISSION);

        return array(
            'bi_company_name'       => '주식회사 OOOO',
            'bi_company_bizno'      => 'OOO-OO-OOOOO',
            'bi_company_ceo'        => '홍길동',
            'bi_company_tel'        => '000-0000-0000',
            'bi_company_fax'        => '000-0000-0000',
            'bi_company_sellno'     => '제'.date('Y').'-서울OO-0000호',
            'bi_company_bugano'     => '',
            'bi_company_infoman'    => '홍길동',
            'bi_company_infomail'   => 'webmaster@domain.com',
            'bi_cs_tel1'            => '012-3456-7890',
            'bi_cs_tel2'            => '',
            'bi_cs_fax'             => '000-0000-0000',
            'bi_cs_email'           => 'webmaster@domain.com',
            'bi_cs_time'            => "평일 09:00 ~ 18:00\n토요일 09:00 ~ 12:00",
            'bi_cs_closed'          => "일요일 및 공휴일은 휴무",
        );
    }

    /**
     * 회사 기본정보
     */
    public function get_bizinfo() {
        global $theme, $shop_theme;
        $this_theme = $this->is_shop ? $shop_theme: $theme;

        $bizinfo_config = G5_DATA_PATH . '/bizinfo/bizinfo.'.$this_theme.'.config.php';

        if (file_exists($bizinfo_config) && !is_dir($bizinfo_config)) {
            include($bizinfo_config);
            return $bizinfo;
        } else {
            $bizinfo = $this->default_bizinfo();
            $this->save_file('bizinfo', $bizinfo_config, $bizinfo);
            return $bizinfo;
        }
    }

    /**
     * EB슬라이더 아이템 파일 생성
     */
    public function save_ebslider_item($code, $theme) {
        /**
         * 설정된 정보를 파일로 저장 - 캐쉬 기능
         */
        $link_path = G5_DATA_URL.'/ebslider';

        $sql = "select * from {$this->g5['eyoom_slider_item']} where es_code = '{$code}' and ei_theme = '" . sql_real_escape_string($theme) . "' and ei_state = '1' order by ei_sort asc ";
        $result = sql_query($sql, false);
        $this_date = date('Ymd');
        $es_item = array();
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($row['ei_period'] == '2') {
                if($this_date >= $row['ei_start'] && $this_date <= $row['ei_end']) {
                    $es_item[$i] = $row;
                } else continue;
            } else {
                $es_item[$i] = $row;
            }
        }

        /**
         * EB슬라이더 아이템파일
         */
        $es_item_file = G5_DATA_PATH . '/ebslider/'.$theme.'/es_item_' . $code . '.php';

        /**
         * 설정파일 저장
         */
        parent::save_file('es_item', $es_item_file, $es_item, true);
    }

    /**
     * EB컨텐츠 아이템 파일 생성
     */
    public function save_ebcontents_item($code, $theme) {
        /**
         * 설정된 정보를 파일로 저장 - 캐쉬 기능
         */
        $link_path = G5_DATA_URL.'/ebcontents';
        
        /**
         * 디렉토리가 없다면 생성
         */
        $this->make_directory($link_path);

        $sql = "select * from {$this->g5['eyoom_contents_item']} where ec_code = '{$code}' and ci_theme = '" . sql_real_escape_string($theme) . "' and ci_state = '1' order by ci_sort asc ";
        $result = sql_query($sql, false);
        $this_date = date('Ymd');
        $ec_item = array();
        for($i=0; $row=sql_fetch_array($result); $i++) {
            if($row['ci_period'] == '2') {
                if($this_date >= $row['ci_start'] && $this_date <= $row['ci_end']) {
                    $ec_item[$i] = $row;
                } else continue;
            } else {
                $ec_item[$i] = $row;
            }
        }

        /**
         * EB컨텐츠 아이템파일
         */
        $ec_theme_path = G5_DATA_PATH . '/ebcontents/'.$theme;
        $this->make_directory($ec_theme_path);
        $ec_item_file = $ec_theme_path.'/ec_item_' . $code . '.php';

        /**
         * 설정파일 저장
         */
        parent::save_file('ec_item', $ec_item_file, $ec_item, true);
    }

    /**
     * EB상품추출 아이템 파일 생성
     */
    public function save_ebgoods_item($code, $theme) {
        /**
         * 설정된 정보를 파일로 저장 - 캐쉬 기능
         */
        $link_path = G5_DATA_URL.'/ebgoods';
        
        /**
         * 디렉토리가 없다면 생성
         */
        $this->make_directory($link_path);

        $sql = "select * from {$this->g5['eyoom_goods_item']} where eg_code = '{$code}' and gi_theme = '" . sql_real_escape_string($theme) . "' and gi_state = '1' order by gi_sort asc ";
        $result = sql_query($sql, false);
        $this_date = date('Ymd');
        $eg_item = array();
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $eg_item[$i] = $row;
        }

        /**
         * EB상품추출 아이템파일
         */
        $eg_theme_path = G5_DATA_PATH . '/ebgoods/'.$theme;
        $this->make_directory($eg_theme_path);
        $eg_item_file = G5_DATA_PATH . '/ebgoods/'.$theme.'/eg_item_' . $code . '.php';

        /**
         * 설정파일 저장
         */
        parent::save_file('eg_item', $eg_item_file, $eg_item, true);

        return $eg_item;
    }

    /**
     * EB배너 아이템 파일 생성
     */
    public function save_ebbanner_item($code, $theme) {
        /**
         * 설정된 정보를 파일로 저장 - 캐쉬 기능
         */
        $link_path = G5_DATA_URL.'/ebbanner';

        $bn_code = (int) $code;

        $sql = "select * from {$this->g5['eyoom_banner_item']} where bn_code = '{$bn_code}' and bi_theme = '" . sql_real_escape_string($theme) . "' and bi_state = '1' order by bi_sort asc ";
        $result = sql_query($sql, false);
        $this_date = date('Ymd');
        $bn_item = array();
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $bn_item[$i] = $row;
        }

        /**
         * EB배너 아이템파일
         */
        $bn_item_file = G5_DATA_PATH . '/ebbanner/'.$theme.'/bn_item_' . $code . '.php';

        /**
         * 설정파일 저장
         */
        parent::save_file('bn_item', $bn_item_file, $bn_item, true);
    }
}