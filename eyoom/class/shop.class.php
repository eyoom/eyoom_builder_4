<?php
class shop extends eyoom
{
    public function __construct() {
        global $g5;

        $this->g5 = $g5;
    }

    /**
     * 쇼핑몰 분류관리의 메뉴 생성
     */
    public function menu_create() {
        /**
         * 1단계 분류 판매 가능한 것만
         */
        $hsql = " select ca_id, ca_name from {$this->g5['g5_shop_category_table']} where length(ca_id) = '2' and ca_use = '1' order by ca_order, ca_id ";
        $hresult = sql_query($hsql);
        $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
        $menu = array();
        for ($i=0; $row=sql_fetch_array($hresult); $i++) {
            $gnb_zindex -= 1; // html 구조에서 앞선 gnb_1dli 에 더 높은 z-index 값 부여
            /**
             * 2단계 분류 판매 가능한 것만
             */
            $sql2 = " select ca_id, ca_name from {$this->g5['g5_shop_category_table']} where LENGTH(ca_id) = '4' and substring(ca_id,1,2) = '{$row['ca_id']}' and ca_use = '1' order by ca_order, ca_id ";
            $result2 = sql_query($sql2);
            $count = sql_num_rows($result2);

            $menu[$i] = $row;
            $menu[$i]['href'] = shop_category_url($row['ca_id']);
            $menu[$i]['count'] = $count;

            $loop = &$menu[$i]['submenu'];
            for ($j=0; $row2=sql_fetch_array($result2); $j++) {
                $row2['href'] = shop_category_url($row2['ca_id']);
                $loop[$j] = $row2;
            }
            $menu[$i]['cnt'] = count((array)$loop);
        }
        return $menu;
    }

    /**
     * 상품리스트 화면에서 상단 카테고리 네비
     */
    public function get_navigation($ca_id = '') {
        if ($ca_id) {
            $navigation = $bar = "";
            $len = strlen($ca_id) / 2;
            for ($i=1; $i<=$len; $i++) {
                $code = substr($ca_id,0,$i*2);

                $sql = " select ca_name from {$this->g5['g5_shop_category_table']} where ca_id = '$code' ";
                $row = sql_fetch($sql);

                $sct_here = '';
                if ($ca_id == $code) // 현재 분류와 일치하면
                    $sct_here = 'sct_here';

                if ($i != $len) // 현재 위치의 마지막 단계가 아니라면
                    $sct_bg = 'sct_bg';
                else $sct_bg = '';

                $navigation .= $bar.'<a href="'.shop_category_url($code).'" class="'.$sct_here.' '.$sct_bg.'">'.$row['ca_name'].'</a>';
            }
        } else {
            $navigation = $this->g5['title'];
        }

        return $navigation;
    }

    /**
     * 상품리스트 화면에서 상단 분류 표기
     */
    public function get_navi($ca_id) {
        if ($ca_id) {
            $navigation = "";
            $len = strlen($ca_id) / 2;
            for ($i=1; $i<=$len; $i++) {
                $code = substr($ca_id,0,$i*2);

                $sql = " select ca_name from {$this->g5['g5_shop_category_table']} where ca_id = '$code' ";
                $row = sql_fetch($sql);

                $sct_here = '';
                if ($ca_id == $code) // 현재 분류와 일치하면
                    $sct_here = 'active';

                $navigation .= '<li class="'.$sct_here.'"><a href="'.shop_category_url($code).'">'.$row['ca_name'].'</a></li>';
                if($i == $len) {
                    $nav['title'] = $row['ca_name'];
                }
            }
        } else {
            $nav['title'] = $this->g5['title'];
            $navigation = $this->g5['title'];
        }
        $nav['path'] = $navigation;

        return $nav;
    }

    public function get_listcategory($ca_id='') {
        $listcategory = array();
        $ca_id_len = strlen($ca_id);
        $len2 = $ca_id_len + 2;
        $len4 = $ca_id_len + 4;

        $sql = " select ca_id, ca_name from {$this->g5['g5_shop_category_table']} where ca_id like '$ca_id%' and length(ca_id) = $len2 and ca_use = '1' order by ca_order, ca_id ";
        $result = sql_query($sql);
        $i=0;
        while ($row=sql_fetch_array($result)) {

            $row2 = sql_fetch(" select count(*) as cnt from {$this->g5['g5_shop_item_table']} where (ca_id like '{$row['ca_id']}%' or ca_id2 like '{$row['ca_id']}%' or ca_id3 like '{$row['ca_id']}%') and it_use = '1'  ");

            $listcategory[$i]['href'] = shop_category_url($row['ca_id']);
            $listcategory[$i]['ca_name'] = $row['ca_name'];
            $listcategory[$i]['cnt'] = $row2['cnt'];
            $i++;
        }
        return $listcategory;
    }

    public function item_icon($it) {
        $icon = '<div class="rgba-banner-area">';
        // 품절
        if (is_soldout($it['it_id']))
            $icon .= '<div class="shop-rgba-default rgba-banner">품절</div>';

        if ($it['it_type1'])
            $icon .= '<div class="shop-rgba-dark rgba-banner">히트</div>';

        if ($it['it_type2'])
            $icon .= '<div class="shop-rgba-yellow rgba-banner">추천</div>';

        if ($it['it_type3'])
            $icon .= '<div class="shop-rgba-red rgba-banner">신상</div>';

        if ($it['it_type4'])
            $icon .= '<div class="shop-rgba-green rgba-banner">인기</div>';

        if ($it['it_type5'])
            $icon .= '<div class="shop-rgba-purple rgba-banner">할인</div>';

        // 쿠폰상품
        $sql = " select count(*) as cnt
                    from {$this->g5['g5_shop_coupon_table']}
                    where cp_start <= '".G5_TIME_YMD."'
                      and cp_end >= '".G5_TIME_YMD."'
                      and (
                            ( cp_method = '0' and cp_target = '{$it['it_id']}' )
                            OR
                            ( cp_method = '1' and ( cp_target IN ( '{$it['ca_id']}', '{$it['ca_id2']}', '{$it['ca_id3']}' ) ) )
                          ) ";
        $row = sql_fetch($sql);
        if($row['cnt'])
            $icon .= '<div class="shop-rgba-orange rgba-banner">Coupon</div>';

        $icon .= '</div>';

        return $icon;
    }

    // 상품 파일 업로드
    public function it_file_upload($srcfile, $filename, $dir) {
        if($filename == '') return '';

        if(!is_dir($dir)) {
            @mkdir($dir, G5_DIR_PERMISSION);
            @chmod($dir, G5_DIR_PERMISSION);
        }

        $pattern = "/[#\&\+\-%@=\/\\:;,'\"\^`~\|\!\?\*\$#<>\(\)\[\]\{\}]/";
        $filename = preg_replace("/\s+/", "", $filename);
        $filename = preg_replace( $pattern, "", $filename);
        $filename = preg_replace_callback("/[가-힣]+/", create_function('$matches', 'return base64_encode($matches[0]);'), $filename);
        $filename = preg_replace( $pattern, "", $filename);
        upload_file($srcfile, $filename, $dir);
        $file = str_replace(G5_DATA_PATH.'/item/', '', $dir.'/'.$filename);

        return $file;
    }

    // 상품 1차 카테고리 가져오기
    public function get_goods_cate1($fields = '') {
        global $is_admin, $member;

        $where = " (1) ";
        if ($is_admin != 'super') {
            $where .= " and ca_mb_id = '{$member['mb_id']}' ";
        }
        $where .= " and length(ca_id) = 2 ";

        return $this->get_goods_category($fields, $where);
    }

    // 카테고리 정보 조건에 맞게 가져오기
    public function get_goods_category($fields, $where) {
        global $g5;

        $fields = $fields ? $fields : '*';
        $sql = "select {$fields} from {$this->g5['g5_shop_category_table']} where {$where} order by ca_order, ca_id";
        $res = sql_query($sql);
        $list = array();
        for ($i=0; $row=sql_fetch_array($res); $i++) {
            $list[$i] = $row;
        }

        return $list;
    }

    public function get_category_path($ca_id) {
        $fields = " ca_id, ca_name ";

        $ca_ids = str_split($ca_id, 2);
        if (is_array($ca_ids)) {
            foreach($ca_ids as $k => $id) {
                $_ca_id .= $id;
                $where = " ca_id = '{$_ca_id}' ";
                $tempinfo = $this->get_goods_category($fields, $where);
                $cainfo[$k] = $tempinfo[0];
            }
            return $cainfo;
        }
    }

    public function get_category($depth = '', $pr_code = '') {
        global $admin_mode;
    
        $addwhere = "";
        if (!$admin_mode) {
            $addwhere .= " AND ca_use = '1' ";
        }
        if ($depth) {
            $length = $depth * 2;
            $addwhere .= " AND LENGTH(ca_id) = $length ";
            if ($pr_code) {
                $addwhere .= " AND ca_id LIKE '{$pr_code}%' ";
            }
        }
        
        $sql = "
            select ca_id, ca_name, ca_order, ca_use, ca_stock_qty, ca_sell_email
            from {$this->g5['g5_shop_category_table']}
            where (1) {$addwhere}
            order by
                case
                    when length(ca_id) = 2 then 1
                    when length(ca_id) = 4 then 2
                    when length(ca_id) = 6 then 3
                    when length(ca_id) = 8 then 4
                    when length(ca_id) = 10 then 5
                    ELSE 6
                END,
                case
                    when length(ca_id) = 2 then cast(ca_order as signed)
                    when length(ca_id) = 4 then cast(concat(left(ca_id, 2), lpad(ca_order, 2, '0')) as signed)
                    when length(ca_id) = 6 then cast(concat(left(ca_id, 2), substring(ca_id, 3, 2), lpad(ca_order, 2, '0')) as signed)
                    when length(ca_id) = 8 then cast(concat(left(ca_id, 2), substring(ca_id, 3, 2), substring(ca_id, 5, 2), lpad(ca_order, 2, '0')) as signed)
                    when length(ca_id) = 10 then cast(concat(left(ca_id, 2), substring(ca_id, 3, 2), substring(ca_id, 5, 2), substring(ca_id, 7, 2), lpad(ca_order, 2, '0')) as signed)
                    ELSE cast(ca_order as signed)
                END
        ";
        
        $res = sql_query($sql, false);
        $category = array();
        
        while ($row = sql_fetch_array($res)) {
            $split = str_split($row['ca_id'], 2);
            $depth = count($split);
            
            switch ($depth) {
                case 1:
                    $category[$split[0]] = $row;
                    $category[$split[0]]['children'] = array();
                    break;
                case 2:
                    $category[$split[0]]['children'][$split[1]] = $row;
                    $category[$split[0]]['children'][$split[1]]['children'] = array();
                    break;
                case 3:
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]] = $row;
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]]['children'] = array();
                    break;
                case 4:
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]]['children'][$split[3]] = $row;
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]]['children'][$split[3]]['children'] = array();
                    break;
                case 5:
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]]['children'][$split[3]]['children'][$split[4]] = $row;
                    $category[$split[0]]['children'][$split[1]]['children'][$split[2]]['children'][$split[3]]['children'][$split[4]]['children'] = array();
                    break;
            }
        }
        
        return $category;
    }      

    // 카테고리를 정렬하는 메소드
    public function sort_category($category) {
        foreach ($category as &$cat) {
            if (isset($cat['children']) && is_array($cat['children'])) {
                $cat['children'] = $this->sort_category($cat['children']);
            }
        }
    
        uasort($category, function ($a, $b) {
            return $a['ca_order'] - $b['ca_order'];
        });
    
        return $category;
    }

    // 이윰배열을 JSON 형식으로 변환
    public function category_json($arr) {
        $output = '';
        if (is_array($arr) && !empty($arr)) {
            $output .= ',"children":[';
            $_output = array();
            foreach ($arr as $val) {
                if (isset($val['ca_id'])) {
                    $blind = '';
                    $ca_order = $val['ca_order'];
                    if ($val['ca_use'] != '1') {
                        $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
                    }
                    $children_json = $this->category_json($val['children']);
                    $_output[] = '{' .
                                 '"id":"' . $val['ca_id'] . '",' .
                                 '"order":"' . $ca_order . '",' .
                                 '"text":"' . trim($val['ca_name']) . $blind . '"' .
                                 $children_json .
                                 '}';
                }
            }
            $output .= implode(',', $_output);
            $output .= ']';
        }
        return $output;
    }

    // 상품분류 소팅하기
    public function category_array_sort($arr) {
        $cate_sel_option = array();
        if (is_array($arr)) {
            foreach ($arr as $val) {
                if (isset($val['ca_id'])) {
                    $ca_order = $val['ca_order'];
                    $cate_sel_option[$ca_order] = array(
                        'ca_id' => $val['ca_id'],
                        'ca_use' => $val['ca_use'],
                        'ca_name' => trim($val['ca_name']),
                        'ca_stock_qty' => $val['ca_stock_qty'],
                        'ca_sell_email' => $val['ca_sell_email'],
                    );
                    if (isset($val['children']) && is_array($val['children']) && !empty($val['children'])) {
                        $cate_sel_option[$ca_order]['ca_sub'] = $this->category_array_sort($val['children']);
                    }
                }
            }
            ksort($cate_sel_option);
        }
        return $cate_sel_option;
    }

    // 카테고리 순서데로 뽑아오기
    public function get_category_select($arr) {
        if(is_array($arr)) {
            foreach ($arr as $k => $info) {
                $len = strlen($info['ca_id']) / 2 - 1;
    
                $nbsp = "";
                for ($i=0; $i<$len; $i++)
                    $nbsp .= "&nbsp;&nbsp;&nbsp;";
        
                $output['select'] .= "<option value=\"{$info['ca_id']}\">$nbsp{$info['ca_name']}</option>\n";
        
                $output['script'] .= "ca_use['{$info['ca_id']}'] = '{$info['ca_use']}';\n";
                $output['script'] .= "ca_stock_qty['{$info['ca_id']}'] = '{$info['ca_stock_qty']}';\n";
                $output['script'] .= "ca_sell_email['{$info['ca_id']}'] = '{$info['ca_sell_email']}';\n";
    
                if (is_array($info['ca_sub'])) {
                    $_output = $this->get_category_select($info['ca_sub']);
                    $output['select'] .= $_output['select'];
                    $output['script'] .= $_output['script'];
                }
            }
            return $output;
        }
    }

    // 할인율 계산
    public function dc_ratio($it_cust_price, $it_price) {
        if (!$it_cust_price) return;
        return ceil( (($it_cust_price-$it_price)/$it_cust_price)*100 );
    }

    /**
     * 이윰에서 영카트5 제어하기
     */
    public function eyoom_shop_controller($path='') {
        if (!$path) $path = parent::get_filename_from_url();
        $file = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR.'/'.$path['filename'];
        return $this->check_shopfile($file);
    }

    /**
     * 쇼핑몰 파일이 있는지 검사
     */
    protected function check_shopfile($file) {
        if ($file) {
            if(file_exists($file)) {
                return $file;
            }
        } else return false;
    }

    /**
     * pg_anchor
     */
    public function pg_anchor($anc_id) {
        global $default, $pg_anchor, $wmode;
        global $item_use_count, $item_qa_count, $item_relation_count;

        if (!$pg_anchor || !is_array($pg_anchor) || $wmode) return false;

        $li = '';
        $active = '';
        $ii_count_info = '';

        foreach ($pg_anchor as $id => $title) {
            if ($id == 'sit_dvr' && !$default['de_baesong_content']) continue;
            if ($id == 'sit_ex' && !$default['de_change_content']) continue;

            if ($id == 'sit_use') {
                $ii_count_info = ' <span class="item_use_count">' . $item_use_count . '</span>';
            }
            if ($id == 'sit_qa') {
                $ii_count_info = ' <span class="item_qa_count">' . $item_qa_count . '</span>';
            }

            if ($id == $anc_id) $active = "class=\"active\"";
            $li .= "<li ".$active."><a href=\"#".$id."\">".$title.$ii_count_info."</a></li>\n";
            unset($active, $ii_count_info);
        }
        return "
        <div class=\"pg-anchor-in\">\n
            <ul class=\"nav nav-tabs\">\n
                ".$li."
            </ul>\n
            <div class=\"tab-bottom-line\"></div>\n
        </div>\n
        ";
    }

    /**
     * 상품 선택옵션
     */
    public function get_item_options($it_id, $subject) {
        if(!$it_id || !$subject) return '';

        $sql = " select * from {$this->g5['g5_shop_item_option_table']} where io_type = '0' and it_id = '" . sql_real_escape_string($it_id) . "' and io_use = '1' order by io_no asc ";
        $result = sql_query($sql);
        if(!sql_num_rows($result)) return '';

        $seloption = array();
        $subj = explode(',', $subject);
        $subj_count = count($subj);

        if($subj_count > 1) {
            $options = array();

            /**
             * 옵션항목 배열에 저장
             */
            for($i=0; $row=sql_fetch_array($result); $i++) {
                $opt_id = explode(chr(30), $row['io_id']);

                for($k=0; $k<$subj_count; $k++) {
                    if(!is_array($options[$k]))
                        $options[$k] = array();

                    if($opt_id[$k] && !in_array($opt_id[$k], $options[$k]))
                        $options[$k][] = $opt_id[$k];
                }
            }

            /**
             * 옵션선택목록 만들기
             */
            for($i=0; $i<$subj_count; $i++) {
                $opt = $options[$i];
                $opt_count = count((array)$opt);
                $disabled = '';
                if($opt_count) {
                    $seq = $i + 1;
                    if($i > 0) $disabled = ' disabled="disabled"';

                    $seloption[$i]['seq'] = $seq;
                    $seloption[$i]['disabled'] = $disabled;
                    $seloption[$i]['subject'] = $subj[$i];

                    $loop = &$seloption[$i]['select'];
                    for($k=0; $k<$opt_count; $k++) {
                        $opt_val = $opt[$k];
                        if(strlen($opt_val)) {
                            $loop[$k]['opt_val'] = $opt_val;
                        }
                    }
                }
            }
        } else {
            $seloption['subject'] = $subj[0];

            $loop = &$seloption['select'];
            for($i=0; $row=sql_fetch_array($result); $i++) {
                $loop[$i] = $row;
                if($row['io_price'] >= 0)
                    $price = '&nbsp;&nbsp;+ '.number_format($row['io_price']).'원';
                else
                    $price = '&nbsp;&nbsp; '.number_format($row['io_price']).'원';

                if($row['io_stock_qty'] < 1)
                    $soldout = '&nbsp;&nbsp;[품절]';
                else
                    $soldout = '';

                $loop[$i]['price'] = $price;
                $loop[$i]['soldout'] = $soldout;
            }
        }

        return $seloption;
    }

    /**
     * 상품 추가옵션
     */
    public function get_item_supply($it_id, $subject) {
        if(!$it_id || !$subject) return '';

        $sql = " select * from {$this->g5['g5_shop_item_option_table']} where io_type = '1' and it_id = '" . sql_real_escape_string($it_id) . "' and io_use = '1' order by io_no asc ";
        $result = sql_query($sql);
        if(!sql_num_rows($result)) return '';

        $supoption = array();
        $subj = explode(',', $subject);
        $subj_count = count($subj);
        $options = array();

        /**
         * 옵션항목 배열에 저장
         */
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $opt_id = explode(chr(30), $row['io_id']);

            if($opt_id[0] && !array_key_exists($opt_id[0], $options))
                $options[$opt_id[0]] = array();

            if(strlen($opt_id[1])) {
                if($row['io_price'] >= 0)
                    $price = '&nbsp;&nbsp;+ '.number_format($row['io_price']).'원';
                else
                    $price = '&nbsp;&nbsp; '.number_format($row['io_price']).'원';
                $io_stock_qty = get_option_stock_qty($it_id, $row['io_id'], $row['io_type']);

                if($io_stock_qty < 1)
                    $soldout = '&nbsp;&nbsp;[품절]';
                else
                    $soldout = '';

                $options[$opt_id[0]][] = '<option value="'.$opt_id[1].','.$row['io_price'].','.$io_stock_qty.'">'.$opt_id[1].$price.$soldout.'</option>';
            }
        }

        /**
         * 옵션항목 만들기
         */
        for($i=0; $i<$subj_count; $i++) {
            $opt = $options[$subj[$i]];
            $opt_count = count((array)$opt);
            if($opt_count) {
                $seq = $i + 1;

                $supoption[$i]['seq'] = $seq;
                $supoption[$i]['subject'] = $subj[$i];

                $select = '<select id="it_supply_'.$seq.'" class="it_supply">'.PHP_EOL;
                $select .= '<option value="">선택</option>'.PHP_EOL;
                $loop = &$supoption[$i]['select'];
                for($k=0; $k<$opt_count; $k++) {
                    $opt_val = $opt[$k];
                    if($opt_val) {
                        $loop[$k]['opt_val'] = trim($opt_val);
                    }
                }
            }
        }

        return $supoption;
    }
    
    /**
     * 상품분류 ca_id에 매칭되는 ca_name 가져오기
     */
    public function get_ca_name_form_ca_id ($ca_id='') {
        $sql = "select ca_id, ca_name from {$this->g5['g5_shop_category_table']} where (1)";
        if ($ca_id) {
            $sql .= " and ca_id = '{$ca_id}' limit 1";
            $info = sql_fetch($sql);
            $data[$ca_id] = $info['ca_name'];
        } else {
            $result = sql_query($sql);
            $data = array();
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $data[$row['ca_id']] = $row['ca_name'];
            }
        }
        
        return $data;
    }

    /**
     * 상품의 두번째 이미지를 추출합니다.
     */
    public function get_it_second_image($it_id, $width, $height=0, $anchor=false, $img_id='', $img_alt='', $is_crop=false) {
        global $g5;
    
        if(!$it_id || !$width)
            return '';
    
        $row = get_shop_item($it_id, true);
    
        if(!$row['it_id'])
            return '';
    
        $filename = $thumb = $img = '';
        $file = G5_DATA_PATH.'/item/'.$row['it_img2'];

        if(is_file($file) && $row['it_img2']) {
            $size = @getimagesize($file);

            $filename = basename($file);
            $filepath = dirname($file);
            $img_width = $size[0];
            $img_height = $size[1];
        }
    
        if($img_width && !$height) {
            $height = round(($width * $img_height) / $img_width);
        }
    
        if($filename) {
            //thumbnail($filename, $source_path, $target_path, $thumb_width, $thumb_height, $is_create, $is_crop=false, $crop_mode='center', $is_sharpen=true, $um_value='80/0.5/3')
            $thumb = thumbnail($filename, $filepath, $filepath, $width, $height, false, $is_crop, 'center', false, $um_value='80/0.5/3');
        }
    
        if($thumb) {
            $file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
            $img = '<img src="'.$file_url.'" width="'.$width.'" height="'.$height.'" alt="'.$img_alt.'"';
        } else {
            return false;
        }
    
        if($img_id)
            $img .= ' id="'.$img_id.'"';
        $img .= '>';
    
        if($anchor)
            $img = $img = '<a href="'.shop_item_url($it_id).'">'.$img.'</a>';
    
        return run_replace('get_it_image_tag', $img, $thumb, $it_id, $width, $height, $anchor, $img_id, $img_alt, $is_crop);
    }
}