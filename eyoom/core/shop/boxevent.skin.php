<?php
/**
 * core file : /eyoom/core/shop/boxevent.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 이벤트 정보
 */
$hsql = " select ev_id, ev_subject, ev_subject_strong from {$g5['g5_shop_event_table']} where ev_use = '1' order by ev_id desc limit 3";
$hresult = sql_query($hsql);
$ev_list = array();
if(sql_num_rows($hresult)) {
    for ($i=0; $row=sql_fetch_array($hresult); $i++) {
        $ev_list[$i] = $row;
        $ev_list[$i]['href'] = G5_SHOP_URL.'/event.php?ev_id='.$row['ev_id'];
        $ev_list[$i]['event_img'] = G5_DATA_PATH.'/event/'.$row['ev_id'].'_m'; // 이벤트 이미지

        /**
         * 이벤트 상품
         */
        $sql2 = " select b.*
                            from `{$g5['g5_shop_event_item_table']}` a left join `{$g5['g5_shop_item_table']}` b on (a.it_id = b.it_id)
                            where a.ev_id = '{$row['ev_id']}'
                            order by it_id desc
                            limit 0, 4 ";
        $result2 = sql_query($sql2);
        
        $loop = &$ev_list[$i]['ev_prd'];
        for($k=1; $row2=sql_fetch_array($result2); $k++) {
            $loop[$k] = $row2;
            $loop[$k]['item_href'] = shop_item_url($row2['it_id']);
            $loop[$k]['it_price'] = display_price(get_price($row2), $row2['it_tel_inq']);
        }
    }
}
$ev_count = count((array)$ev_list);