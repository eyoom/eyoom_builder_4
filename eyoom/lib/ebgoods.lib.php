<?php
/**
 * lib file : /eyoom/lib/ebgoods.lib.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * eb_goods function
 * 상품 추출
 */
function eb_goods ($eg_code) {
    global $g5, $theme, $shop_theme, $member, $is_admin, $qfile, $eb, $config, $shop, $eyoom, $thema;
    
    /**
     * 쇼핑몰 테마가 아니면 패스
     */
    if ($eyoom['is_shop_theme'] == 'n') return;

    /**
     * 쇼핑몰 테마인지 체크
     */
    if (defined('_SHOP_')) $theme = $shop_theme;

    /**
     * EB상품추출 경로
     */
    $_ebgoods_path = G5_DATA_PATH.'/ebgoods/';
    $ebgoods_path = $_ebgoods_path.$theme;

    /**
     * 디렉토리가 없다면 생성하기
     */
    if (!is_dir($_ebgoods_path)) {
        $qfile->make_directory($_ebgoods_path);
    }

    if (!is_dir($ebgoods_path)) {
        $qfile->make_directory($ebgoods_path);
    }

    /**
     * EB상품추출 master 파일 경로
     */
    $master_file = $ebgoods_path.'/eg_master_'.$eg_code.'.php';

    if (file_exists($master_file) && !is_dir($master_file)) {
        include($master_file);
    } else {
        /**
         * g5_eyoom_goods 테이블에서 정보 추출
         */
        $eg_master = sql_fetch("select * from {$g5['eyoom_goods']} where (1) and eg_code = '{$eg_code}' limit 1 ");

        /**
         * 파일 캐시
         */
        $qfile->save_file('eg_master', $master_file, $eg_master);
    }

    /**
     * EB상품추출 기본소스 출력 여부
     */
    $eg_default = false;

    /**
     * EB상품추출이 활성화 되어 있다면 아이템 정보를 가져오기
     */
    if ($eg_master['eg_state'] == '1' || ($is_admin && $eg_master['eg_skin'])) {
        /**
        * 스킨정보
        */
        $ebgoods_skin_path = EYOOM_THEME_PATH.'/'.G5_SKIN_DIR.'/ebgoods/'.$eg_master['eg_skin'];
        $ebgoods_skin_url = str_replace(G5_PATH, G5_URL, $ebgoods_skin_path);

        /**
         * 회원레벨
         */
        $mb_level = $member['mb_level'] ? $member['mb_level']: 1;

        /**
         * 상품추출 아이템 설정정보
         */
        $ebgoods_item = $ebgoods_path.'/eg_item_'.$eg_code.'.php';

        if (file_exists($ebgoods_item) && !is_dir($ebgoods_item)) {
            include($ebgoods_item);
        } else {
            /**
             * 설정된 정보를 파일로 저장 - 캐쉬 기능
             */
            $eg_item = $thema->save_ebgoods_item($eg_code, $theme);
        }
        
        /**
         * 전체 상품분류
         */
        $ca_name = $shop->get_ca_name_form_ca_id();

        /**
         * 지정된 아이템의 게시물 가져오기
         */
        $eg_count = count((array)$eg_item);
        for ($i=0; $i<$eg_count; $i++) {
            if ($eg_item[$i]['gi_state'] == '2' || $eg_item[$i]['gi_view_level'] > $member['mb_level']) {
                unset($eg_item[$i]);
                continue;
            }

            /**
             * EB상품추출 아이템 고유번호
             */
            $gi_no = $eg_item[$i]['gi_no'];

            /**
             * 상품분류
             */
            if ($eg_item[$i]['gi_ca_ids']) {
                $ca_ids = explode(',', $eg_item[$i]['gi_ca_ids']);
                $where_ca_id = array();
                foreach ($ca_ids as $k => $id) {
                    $ca_id = trim($id);
                    $where_ca_id[$k] = " (ca_id like '".$ca_id."%' || ca_id2 like '".$ca_id."%' || ca_id3 like '".$ca_id."%') ";
                }
                $sql_where = ' and ' . implode(' or ', $where_ca_id);
            }
            
            /**
             * 출력순서
             */
            switch ($eg_item[$i]['gi_sortby']) {
                default :
                case '1': $order_by = ' it_order, it_id desc '; break;
                case '2': $order_by = ' it_sum_qty desc '; break;
                case '3': $order_by = ' it_price asc '; break;
                case '4': $order_by = ' it_price desc '; break;
                case '5': $order_by = ' it_use_avg desc '; break;
                case '6': $order_by = ' it_use_cnt desc '; break;
            }
            $sql_order = " order by {$order_by} ";
            
            /**
             * 쿼리문
             */
            $sql = "select * from {$g5['g5_shop_item_table']} where (1) and it_use = '1' {$sql_where} {$sql_order} limit {$eg_item[$i]['gi_count']} ";
            $result = sql_query($sql);

            /**
             * 리스트 출력 레코드 가공하기
             */
            $loop = &$eg_item[$i]['list'];
            for ($j=0; $row=sql_fetch_array($result); $j++) {
                $loop[$j] = $row;
                $loop[$j]['href'] = shop_item_url($row['it_id']);
                $loop[$j]['ca_name'] = $ca_name[$row['ca_id']];
                
                /**
                 * 상품 목록 이미지
                 */
                if ($eg_item[$i]['gi_view_img'] == 'y') {
                    $loop[$j]['it_image'] = get_it_image($row['it_id'], $eg_item[$i]['gi_img_width'], $eg_item[$i]['gi_img_height'], '', '', stripslashes($row['it_name']))."\n";
                }
                
                /**
                 * 상품유형 아이콘
                 */
                if($eg_item[$i]['gi_view_it_icon'] == 'y') {
                    $loop[$j]['it_icon'] = $shop->item_icon($row);
                }

                /**
                 * 소셜링크 정보
                 */
                if ($eg_item[$i]['gi_view_sns'] == 'y') {
                    $loop[$j]['sns_url']  = urlencode(shop_item_url($row['it_id']));
                    $loop[$j]['sns_title'] = urlencode(get_text($row['it_name']).' | '.get_text($config['cf_title']));
                }
            }
        }

        /**
         * EB상품추출 기본소스 출력
         */
        if (!$eg_item) $eg_default = true;

        /**
         * 스킨 출력
         */
        include($ebgoods_skin_path.'/ebgoods.skin.html.php');
    }
}