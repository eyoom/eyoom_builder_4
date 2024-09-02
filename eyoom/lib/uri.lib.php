<?php
/**
 * lib file : /eyoom/lib/uri.lib.php
 */

if (!defined('_EYOOM_')) exit;

// 짧은 주소 형식으로 만들어서 가져온다.
function get_eyoom_pretty_url($folder, $no='', $query_string='', $action='')
{
    global $g5, $config;

    $boards = get_board_names();
    $segments = array();
    $url = $add_query = '';

    if( $url = run_replace('get_eyoom_pretty_url', $url, $folder, $no, $query_string, $action) ){
        return $url;
    }

	// use shortten url
	if($config['cf_bbs_rewrite']) {
        
        $segments[0] = G5_URL;

        if( $folder === 'content' && $no ){     // 내용관리
            
            $segments[1] = $folder;

            if( $config['cf_bbs_rewrite'] > 1 ){

                $get_content = get_content_db( $no , true);
                $segments[2] = (isset($get_content['co_seo_title']) && $get_content['co_seo_title']) ? urlencode($get_content['co_seo_title']).'/' : urlencode($no);

            } else {
                $segments[2] = urlencode($no);
            }

        }
        else if ( $folder === 'group' && $no ) {
            $segments[1] = $folder;
            $segments[2] = urlencode($no);
        }
        else if ( $folder === 'page' && $no ) {
            $segments[1] = $folder;
            $segments[2] = urlencode($no);
        }
        else if ( $folder === 'mypage' && $no ) {
            $segments[1] = $folder;
            $segments[2] = urlencode($no);
        }
        else if(in_array($folder, $boards)) {     // 게시판

			$segments[1] = $folder;

			if($no) {

                if( $config['cf_bbs_rewrite'] > 1 ){

                    $get_write = get_write( $g5['write_prefix'].$folder, $no , true);
                    
                    $segments[2] = (isset($get_write['wr_seo_title']) && $get_write['wr_seo_title']) ? urlencode($get_write['wr_seo_title']).'/' : urlencode($no);

                } else {
                    $segments[2] = urlencode($no);
                }

			} else if($action) {
                $segments[2] = urlencode($action);
            }

		} else {
            $segments[1] = $folder;
			if($no) {
				$no_array = explode("=", $no);
				$no_value = end($no_array);
                $segments[2] = urlencode($no_value);
			}
		}

        if($query_string) {
            // If the first character of the query string is '&', replace it with '?'.
            if(substr($query_string, 0, 1) == '&') {
                $add_query = preg_replace("/\&amp;/", "?", $query_string, 1);
            } else {
                $add_query = '?'. $query_string;
            }
        }

	} else { // don't use shortten url
		if(in_array($folder, $boards)) {
			$url = G5_BBS_URL . '/board.php?bo_table='. $folder;
			if($no) {
				$url .= '&amp;wr_id='. $no;
			}
			if($query_string) {
                if(substr($query_string, 0, 1) !== '&') {
                    $url .= '&amp;';
                }

				$url .= $query_string;
			}
		} else if ($folder === 'group') {
            $url = G5_BBS_URL . '/group.php?gr_id=' . $no;
        } else if ($folder === 'page') {
            $url = G5_URL . '/page/?pid=' . $no;
        } else if ($folder === 'mypage') {
            $url = G5_URL . '/mypage/?t=' . $no;
        } else {
			$url = G5_BBS_URL . '/' . $folder.'.php';
            if($no) {
				$url .= ($folder === 'content') ? '?co_id='. $no : '?'. $no;
			}
            if($query_string) {
                $url .= (!$no ? '?' : '&amp;'). $query_string;
			}
		}

        $segments[0] = $url;
    }

	return implode('/', (array)$segments).$add_query;
}

/**
 * 이윰 메뉴의 이전 URL를 짧은 주소로 변경하기
 */
function get_pretty_eyoom_menu_url($me_type, $me_pid, $me_link='') {
    global $config;

    if($config['cf_bbs_rewrite']) {
        switch ($me_type) {
            case 'board':
                if (stripos($me_link, 'write')) {
                    return G5_URL . '/' . $me_pid . '/write';
                } else {
                    return get_eyoom_pretty_url($me_pid);
                }
            break;

            case 'group':
                return get_eyoom_pretty_url('group', $me_pid);
            break;

            case 'page':
                return get_eyoom_pretty_url('content', $me_pid);
            break;

            case 'pid':
                return get_eyoom_pretty_url('page', $me_pid);
            break;

            case 'mypage':
                return get_eyoom_pretty_url('mypage', $me_pid);
            break;

            case 'userpage':
                if(!preg_match('/(http|https):/i',$me_link)) {
                    $me_link = G5_URL . $me_link;
                }
                return $me_link;
            break;

            case 'theme':
                return G5_URL.$me_link;
            break;
        }

        /**
         * G5_USE_SHOP : false 대응 코드
         * 마젠토님이 제보해 주셨습니다.
         */
        if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
            switch ($me_type) {
                case 'shop':
                    return shop_category_url($me_pid);
                break;
    
                case 'item':
                    return shop_item_url($me_pid);
                break;
    
                case 'type':
                    return shop_type_url($me_pid);
                break;
    
                case 'brand':
                    return shop_brand_url($me_pid);
                break;
            }
        }
    } else {
        return $me_link;
    }
}

/**
 * 짧은 주소를 이전 방식으로 되돌려 줌
 */
function get_query_url_from_pretty_url($short_url) {
    global $thema;
    
    $purl = parse_url($short_url);
    if ($purl['host']) {
        if(!$thema->compare_host($purl)) {
            return false;
        }
    }

    $get_path_url = parse_url(G5_URL);
    $base_path = isset($get_path_url['path']) ? $get_path_url['path'] : '';

    if ($purl['query']) {
        $_purl = $base_path ? str_replace($base_path, '', $purl['path']): $purl['path'];
        $path_name = str_replace('/','',$_purl);
        $info = explode('/', $_purl);
        if (preg_match('/\.php/i',$info[2]) || !$info[2]) {
            return $short_url;
        } else {
            $url = get_query_url($info).'&amp;'.$purl['query'];
            return $url;
        }
    } else {
        $_purl = $base_path ? str_replace($base_path, '', $short_url): $short_url;
        $info = explode('/', preg_replace('#http(s)?:\/\/#i','', $_purl));
        $url = get_query_url($info);
        return $url;
    }
}

/**
 * 짧은주소를 받아 이전 URL로 변경
 */
function get_query_url ($info) {
    if ($info[1] == 'content' && $info[2]) {
        $url = G5_BBS_URL . "/content.php?co_id={$info[2]}";
    }
    else if ($info[1] == 'group' && $info[2]) {
        $url = G5_BBS_URL . "/group.php?gr_id={$info[2]}";
    }
    else if ($info[1] == 'page' && $info[2]) {
        $url = G5_URL . "/page/?pid={$info[2]}";
    }
    else if ($info[1] == 'bbs' && $info[2]) {
        $url = G5_URL . "/bbs/{$info[2]}";
    }
    else if ($info[1] == 'mypage') {
        $url = G5_URL . "/mypage/";
        switch ($info[2]) {
            default: $url .= $info[2]; break;
            case 'favorite':
            case 'followinggul':
            case 'goodpost':
            case 'pinboard':
            case 'starpost':
            case 'subscribe':
            case 'timeline':
                $url .= "?t=".$info[2];
                break;
        }
    }
    else if ($info[1] == 'shop') {
        $tmp = explode('-', $info[2]);
        if ($tmp[0] == 'list') {
            $url = G5_URL . "/shop/list.php?ca_id={$tmp[1]}";
        } else if ($tmp[0] == 'type') {
            $url = G5_URL . "/shop/listtype.php?type={$tmp[1]}";
        } else if ($tmp[0] == 'brand') {
            $url = G5_URL . "/shop/brand.php?br_cd={$tmp[1]}";
        } else {
            $url = G5_URL . "/shop/item.php?it_id={$tmp[1]}";
        }
    } else {
        if ($info[2] == 'write') {
            $url = G5_BBS_URL . "/write.php?bo_table={$info[1]}";
        } else {
            $url = G5_BBS_URL . "/board.php?bo_table={$info[1]}";
        }
    }

    return $url;
}

/**
 * 쇼핑몰 브랜드 URL
 */
function shop_brand_url($br_cd, $add_param='') {
    global $config;

    $add_params = $add_param ? '&'.$add_param : '';

    if( $config['cf_bbs_rewrite'] ) {
        return G5_SHOP_URL . '/brand-'.$br_cd.$add_params;
    } else {
        return G5_SHOP_URL . '/brand.php?br_cd='.urlencode($br_cd).$add_params;
    }
}

/**
 * NGINX Rewrite Module
 */
function get_eyoom_nginx_conf_rules($return_string=false) {

    $get_path_url = parse_url(G5_URL);

    $base_path = isset($get_path_url['path']) ? $get_path_url['path'] . '/' : '/';

    $rules = array();
    
    $rules[] = '#### ' . G5_VERSION . ' nginx rules BEGIN #####';

    if ($add_rules = run_replace('add_nginx_conf_pre_rules', '', $get_path_url, $base_path, $return_string)) {
        $rules[] = $add_rules;
    }

    $rules[] = 'if (!-e $request_filename) {';

    if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
        $rules[] = "rewrite ^{$base_path}shop/brand-([0-9a-zA-Z_]+)$ {$base_path}" . G5_SHOP_DIR . "/brand.php?br_cd=$1&rewrite=1 break;";
    }

    if ($add_rules = run_replace('add_nginx_conf_rules', '', $get_path_url, $base_path, $return_string)) {
        $rules[] = $add_rules;
    }

    $rules[] = "rewrite ^{$base_path}group/([0-9a-zA-Z_]+)$ {$base_path}" . G5_BBS_DIR . "/group.php?gr_id=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}page/([0-9a-zA-Z_]+)$ {$base_path}page/?pid=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}mypage/([0-9a-zA-Z_]+)$ {$base_path}mypage/?t=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}content/([0-9a-zA-Z_]+)$ {$base_path}" . G5_BBS_DIR . "/content.php?co_id=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}content/([^/]+)/$ {$base_path}" . G5_BBS_DIR . "/content.php?co_seo_title=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}rss/([0-9a-zA-Z_]+)$ {$base_path}" . G5_BBS_DIR . "/rss.php?bo_table=$1 break;";
    $rules[] = "rewrite ^{$base_path}([0-9a-zA-Z_]+)$ {$base_path}" . G5_BBS_DIR . "/board.php?bo_table=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}([0-9a-zA-Z_]+)/write$ {$base_path}" . G5_BBS_DIR . "/write.php?bo_table=$1&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}([0-9a-zA-Z_]+)/([^/]+)/$ {$base_path}" . G5_BBS_DIR . "/board.php?bo_table=$1&wr_seo_title=$2&rewrite=1 break;";
    $rules[] = "rewrite ^{$base_path}([0-9a-zA-Z_]+)/([0-9]+)$ {$base_path}" . G5_BBS_DIR . "/board.php?bo_table=$1&wr_id=$2&rewrite=1 break;";
    $rules[] = '}';
    $rules[] = '#### ' . G5_VERSION . ' nginx rules END #####';

    return $return_string ? implode("\n", $rules) : $rules;
}

/**
 * APACHE Rewrite Module
 */
function get_eyoom_mod_rewrite_rules($return_string=false) {

    $get_path_url = parse_url(G5_URL);

    $base_path = isset($get_path_url['path']) ? $get_path_url['path'] . '/' : '/';

    $rules = array();
    
    $rules[] = '#### ' . G5_VERSION . ' rewrite BEGIN #####';
    $rules[] = '<IfModule mod_rewrite.c>';
    $rules[] = 'RewriteEngine On';
    $rules[] = 'RewriteBase ' . $base_path;

    if ($add_rules = run_replace('add_mod_rewrite_pre_rules', '', $get_path_url, $base_path, $return_string)) {
        $rules[] = $add_rules;
    }

    $rules[] = 'RewriteCond %{REQUEST_FILENAME} -f [OR]';
    $rules[] = 'RewriteCond %{REQUEST_FILENAME} -d';
    $rules[] = 'RewriteRule ^ - [L]';

    if (defined('G5_USE_SHOP') && G5_USE_SHOP) {
        $rules[] = 'RewriteRule ^shop/brand-([0-9a-z]+)$  ' . G5_SHOP_DIR . '/brand.php?br_cd=$1&rewrite=1  [QSA,L]';
    }
    
    if ($add_rules = run_replace('add_mod_rewrite_rules', '', $get_path_url, $base_path, $return_string)) {
        $rules[] = $add_rules;
    }

    $rules[] = 'RewriteRule ^group/([0-9a-zA-Z_]+)$  ' . G5_BBS_DIR . '/group.php?gr_id=$1&rewrite=1  [QSA,L]';
    $rules[] = 'RewriteRule ^page/([0-9a-zA-Z_]+)$  page/?pid=$1&rewrite=1  [QSA,L]';
    $rules[] = 'RewriteRule ^mypage/([0-9a-zA-Z_]+)$  mypage/?t=$1&rewrite=1  [QSA,L]';
    $rules[] = 'RewriteRule ^content/([0-9a-zA-Z_]+)$ ' . G5_BBS_DIR . '/content.php?co_id=$1&rewrite=1 [QSA,L]';
    $rules[] = 'RewriteRule ^content/([^/]+)/$ ' . G5_BBS_DIR . '/content.php?co_seo_title=$1&rewrite=1 [QSA,L]';
    $rules[] = 'RewriteRule ^rss/([0-9a-zA-Z_]+)$ ' . G5_BBS_DIR . '/rss.php?bo_table=$1 [QSA,L]';
    $rules[] = 'RewriteRule ^([0-9a-zA-Z_]+)$ ' . G5_BBS_DIR . '/board.php?bo_table=$1&rewrite=1 [QSA,L]';
    $rules[] = 'RewriteRule ^([0-9a-zA-Z_]+)/([^/]+)/$ ' . G5_BBS_DIR . '/board.php?bo_table=$1&wr_seo_title=$2&rewrite=1 [QSA,L]';
    $rules[] = 'RewriteRule ^([0-9a-zA-Z_]+)/write$ ' . G5_BBS_DIR . '/write.php?bo_table=$1&rewrite=1 [QSA,L]';
    $rules[] = 'RewriteRule ^([0-9a-zA-Z_]+)/([0-9]+)$ ' . G5_BBS_DIR . '/board.php?bo_table=$1&wr_id=$2&rewrite=1 [QSA,L]';
    $rules[] = '</IfModule>';
    $rules[] = '#### ' . G5_VERSION . ' rewrite END #####';

    return $return_string ? implode("\n", $rules) : $rules;
}

function update_eyoom_rewrite_rules(){

    $is_apache = (stripos($_SERVER['SERVER_SOFTWARE'], 'apache') !== false);

    if($is_apache){
        $save_path = G5_PATH . '/.htaccess';

        if( (!file_exists($save_path) && is_writable(G5_PATH)) || is_writable($save_path) ){

            $rules = get_eyoom_mod_rewrite_rules();

            $bof_str = $rules[0];
            $eof_str = end($rules);

            if( file_exists($save_path) ){
                $code = file_get_contents($save_path);
                
                if( $code && strpos($code, $bof_str) !== false && strpos($code, $eof_str) !== false ){
                    return true;
                }
            }

            $fp = fopen($save_path, "ab");
            flock( $fp, LOCK_EX );
            
            $rewrite_str = implode("\n", (array)$rules);
            
            fwrite( $fp, "\n" );
            fwrite( $fp, $rewrite_str );
            fwrite( $fp, "\n" );

            flock( $fp, LOCK_UN );
            fclose($fp);
            
            return true;
        }
    }

    return false;

}