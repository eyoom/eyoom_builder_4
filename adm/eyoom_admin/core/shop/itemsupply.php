<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemsupply.php
 */
include_once('./_common.php');

$ps_run = false;

if($it['it_id']) {
    $sql = " select * from {$g5['g5_shop_item_option_table']} where io_type = '1' and it_id = '{$it['it_id']}' order by io_no asc ";
    $result = sql_query($sql);
    if(sql_num_rows($result))
        $ps_run = true;
} else if(!empty($_POST)) {
    $subject_count = count($_POST['subject']);
    $supply_count = count($_POST['supply']);

    if(!$subject_count || !$supply_count) {
        echo '추가옵션명과 추가옵션항목을 입력해 주십시오.';
        exit;
    }

    $ps_run = true;
}

if($ps_run) {
    if($it['it_id']) {
        for($i=0; $row=sql_fetch_array($result); $i++) {
            $itsupply[$i]['spl_id'] = $row['io_id'];
            $spl_val = explode(chr(30), $itsupply[$i]['spl_id']);
            $itsupply[$i]['spl_subject'] = $spl_val[0];
            $itsupply[$i]['spl'] = $spl_val[1];
            $itsupply[$i]['spl_price'] = $row['io_price'];
            $itsupply[$i]['spl_stock_qty'] = $row['io_stock_qty'];
            $itsupply[$i]['spl_noti_qty'] = $row['io_noti_qty'];
            $itsupply[$i]['spl_use'] = $row['io_use'];
        } // for
    } else {
        for($i=0; $i<$subject_count; $i++) {
            $spl_subject = preg_replace('/[\'\"]/', '', trim(stripslashes($_POST['subject'][$i])));
            $spl_val = explode(',', preg_replace('/[\'\"]/', '', trim(stripslashes($_POST['supply'][$i]))));
            $spl_count = count($spl_val);

            for($j=0; $j<$spl_count; $j++) {
                $spl = strip_tags(trim($spl_val[$j]));
                if($spl_subject && strlen($spl)) {
                    $m = $i.$j;
                    $itsupply[$m]['spl_id'] = $spl_subject.chr(30).$spl;
                    $itsupply[$m]['spl_subject'] = $spl_subject;
                    $itsupply[$m]['spl'] = $spl;
                    $itsupply[$m]['spl_price'] = 0;
                    $itsupply[$m]['spl_stock_qty'] = 9999;
                    $itsupply[$m]['spl_noti_qty'] = 100;
                    $itsupply[$m]['spl_use'] = 1;

                    // 기존에 설정된 값이 있는지 체크
                    if($_POST['w'] == 'u') {
                        $sql = " select io_price, io_stock_qty, io_noti_qty, io_use from {$g5['g5_shop_item_option_table']} where it_id = '{$_POST['it_id']}' and io_id = '$spl_id' and io_type = '1' ";
                        $row = sql_fetch($sql);

                        if($row) {
                            $itsupply[$m]['spl_price'] = (int)$row['io_price'];
                            $itsupply[$m]['spl_stock_qty'] = (int)$row['io_stock_qty'];
                            $itsupply[$m]['spl_noti_qty'] = (int)$row['io_noti_qty'];
                            $itsupply[$m]['spl_use'] = (int)$row['io_use'];
                        }
                    }
                } // if
            } // for
        } // for
    }

    /**
     * 페이지 출력
     */
    include_once(EYOOM_ADMIN_THEME_PATH . "/skin/shop/itemsupply.html.php");
}