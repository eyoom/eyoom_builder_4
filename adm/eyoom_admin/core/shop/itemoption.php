<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemoption.php
 */
include_once('./_common.php');

$po_run = false;

if(isset($it['it_id']) && $it['it_id']) {
    $opt_subject = explode(',', $it['it_option_subject']);
    $opt1_subject = isset($opt_subject[0]) ? $opt_subject[0] : '';
    $opt2_subject = isset($opt_subject[1]) ? $opt_subject[1] : '';
    $opt3_subject = isset($opt_subject[2]) ? $opt_subject[2] : '';

    $sql = " select * from {$g5['g5_shop_item_option_table']} where io_type = '0' and it_id = '{$it['it_id']}' order by io_no asc ";
    $result = sql_query($sql);
    if(sql_num_rows($result))
        $po_run = true;
} else if(!empty($_POST)) {
    $opt1_subject = isset($_POST['opt1_subject']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt1_subject']))) : '';
    $opt2_subject = isset($_POST['opt2_subject']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt2_subject']))) : '';
    $opt3_subject = isset($_POST['opt3_subject']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt3_subject']))) : '';

    $opt1_val = isset($_POST['opt1']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt1']))) : '';
    $opt2_val = isset($_POST['opt2']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt2']))) : '';
    $opt3_val = isset($_POST['opt3']) ? preg_replace(G5_OPTION_ID_FILTER, '', trim(stripslashes($_POST['opt3']))) : '';

    if(!$opt1_subject || !$opt1_val) {
        echo '옵션1과 옵션1 항목을 입력해 주십시오.';
        exit;
    }

    $po_run = true;

    $opt1_count = $opt2_count = $opt3_count = 0;

    if($opt1_val) {
        $opt1 = explode(',', $opt1_val);
        $opt1_count = count($opt1);
    }

    if($opt2_val) {
        $opt2 = explode(',', $opt2_val);
        $opt2_count = count($opt2);
    }

    if($opt3_val) {
        $opt3 = explode(',', $opt3_val);
        $opt3_count = count($opt3);
    }
}

$itoption = array();
if($po_run) {
    if($it['it_id']) {
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $itoption[$i]['opt_id'] = $row['io_id'];
            $opt_val = explode(chr(30), $itoption[$i]['opt_id']);
            $itoption[$i]['opt_1'] = $opt_val[0];
            $itoption[$i]['opt_2'] = isset($opt_val[1]) ? $opt_val[1] : '';
            $itoption[$i]['opt_3'] = isset($opt_val[2]) ? $opt_val[2] : '';
            $itoption[$i]['opt_2_len'] = strlen($itoption[$i]['opt_2']);
            $itoption[$i]['opt_3_len'] = strlen($itoption[$i]['opt_3']);
            $itoption[$i]['opt_price'] = $row['io_price'];
            $itoption[$i]['opt_stock_qty'] = $row['io_stock_qty'];
            $itoption[$i]['opt_noti_qty'] = $row['io_noti_qty'];
            $itoption[$i]['opt_use'] = $row['io_use'];
        } // for
    } else {

        $w = isset($_POST['w']) ? $_POST['w'] : '';
        $post_it_id = isset($_POST['it_id']) ? safe_replace_regex($_POST['it_id'], 'it_id') : '';

        for($i=0; $i<$opt1_count; $i++) {
            $j = 0;
            do {
                $k = 0;
                do {
                    $m = $i.$j.$k;
                    $itoption[$m]['opt_1'] = isset($opt1[$i]) ? strip_tags(trim($opt1[$i])) : '';
                    $itoption[$m]['opt_2'] = isset($opt2[$j]) ? strip_tags(trim($opt2[$j])) : '';
                    $itoption[$m]['opt_3'] = isset($opt3[$k]) ? strip_tags(trim($opt3[$k])) : '';

                    $itoption[$m]['opt_2_len'] = strlen($itoption[$m]['opt_2']);
                    $itoption[$m]['opt_3_len'] = strlen($itoption[$m]['opt_3']);

                    $itoption[$m]['opt_id'] = $itoption[$m]['opt_1'];
                    if($itoption[$m]['opt_2_len'])
                        $itoption[$m]['opt_id'] .= chr(30).$itoption[$m]['opt_2'];
                    if($itoption[$m]['opt_3_len'])
                        $itoption[$m]['opt_id'] .= chr(30).$itoption[$m]['opt_3'];
                    $itoption[$m]['opt_price'] = 0;
                    $itoption[$m]['opt_stock_qty'] = 9999;
                    $itoption[$m]['opt_noti_qty'] = 100;
                    $itoption[$m]['opt_use'] = 1;

                    // 기존에 설정된 값이 있는지 체크
                    if($_POST['w'] == 'u') {
                        $sql = " select io_price, io_stock_qty, io_noti_qty, io_use from {$g5['g5_shop_item_option_table']} where it_id = '{$post_it_id}' and io_id = '{$itoption[$m]['opt_id']}' and io_type = '0' ";
                        $row = sql_fetch($sql);

                        if($row) {
                            $itoption[$m]['opt_price'] = (int)$row['io_price'];
                            $itoption[$m]['opt_stock_qty'] = (int)$row['io_stock_qty'];
                            $itoption[$m]['opt_noti_qty'] = (int)$row['io_noti_qty'];
                            $itoption[$m]['opt_use'] = (int)$row['io_use'];
                        }
                    }
                    $k++;
                } while($k < $opt3_count);

                $j++;
            } while($j < $opt2_count);
        } // for
    }

    /**
     * 페이지 출력
     */
    include_once(EYOOM_ADMIN_THEME_PATH . "/skin/shop/itemoption.html.php");
}