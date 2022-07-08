<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemexcelupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

// 상품이 많을 경우 대비 설정변경
set_time_limit ( 0 );
ini_set('memory_limit', '50M');

auth_check_menu($auth, $sub_menu, "w");

function only_number($n)
{
    return preg_replace('/[^0-9]/', '', (string)$n);
}

$is_upload_file = (isset($_FILES['excelfile']['tmp_name']) && $_FILES['excelfile']['tmp_name']) ? 1 : 0;

if( ! $is_upload_file){
    alert("엑셀 파일을 업로드해 주세요.");
}

if($is_upload_file) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/PHPExcel/IOFactory.php');

    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $sheet = $objPHPExcel->getSheet(0);

    $num_rows = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

    for ($i = 3; $i <= $num_rows; $i++) {
        $total_count++;

        $j = 0;

        $rowData = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
                                            NULL,
                                            TRUE,
                                            FALSE);

        $it_id              = (string) $rowData[0][$j++];
        $it_id              = preg_match('/[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)/', $it_id) ? addslashes(sprintf("%.0f", $it_id)) : preg_replace('/[^0-9a-z_\-]/i', '', $it_id);
        $ca_id              = addslashes($rowData[0][$j++]);
        $ca_id2             = addslashes((string)$rowData[0][$j++]);
        $ca_id3             = addslashes((string)$rowData[0][$j++]);
        $it_name            = addslashes($rowData[0][$j++]);
        $it_maker           = addslashes((string)$rowData[0][$j++]);
        $it_origin          = addslashes((string)$rowData[0][$j++]);
        $it_brand           = addslashes((string)$rowData[0][$j++]);
        $it_model           = addslashes((string)$rowData[0][$j++]);
        $it_option1         = addslashes((string)$rowData[0][$j++]);
        $it_option2         = addslashes((string)$rowData[0][$j++]);
        $it_option3         = addslashes((string)$rowData[0][$j++]);
        $it_opt_set         = addslashes((string)$rowData[0][$j++]);
        $it_type1           = addslashes((string)$rowData[0][$j++]);
        $it_type2           = addslashes((string)$rowData[0][$j++]);
        $it_type3           = addslashes((string)$rowData[0][$j++]);
        $it_type4           = addslashes((string)$rowData[0][$j++]);
        $it_type5           = addslashes((string)$rowData[0][$j++]);
        $it_basic           = addslashes((string)$rowData[0][$j++]);
        $it_explan          = addslashes((string)$rowData[0][$j++]);
        $it_mobile_explan   = addslashes((string)$rowData[0][$j++]);
        $it_cust_price      = addslashes(only_number($rowData[0][$j++]));
        $it_price           = addslashes(only_number($rowData[0][$j++]));
        $it_tel_inq         = addslashes((string)$rowData[0][$j++]);
        $it_point           = addslashes(only_number($rowData[0][$j++]));
        $it_point_type      = addslashes(only_number($rowData[0][$j++]));
        $it_sell_email      = addslashes((string)$rowData[0][$j++]);
        $it_use             = addslashes((string)$rowData[0][$j++]);
        $it_stock_qty       = addslashes(only_number($rowData[0][$j++]));
        $it_noti_qty        = addslashes(only_number($rowData[0][$j++]));
        $it_buy_min_qty     = addslashes(only_number($rowData[0][$j++]));
        $it_buy_max_qty     = addslashes(only_number($rowData[0][$j++]));
        $it_notax           = addslashes(only_number($rowData[0][$j++]));
        $it_order           = addslashes(only_number($rowData[0][$j++]));
        $it_img1            = addslashes((string)$rowData[0][$j++]);
        $it_img2            = addslashes((string)$rowData[0][$j++]);
        $it_img3            = addslashes((string)$rowData[0][$j++]);
        $it_img4            = addslashes((string)$rowData[0][$j++]);
        $it_img5            = addslashes((string)$rowData[0][$j++]);
        $it_img6            = addslashes((string)$rowData[0][$j++]);
        $it_img7            = addslashes((string)$rowData[0][$j++]);
        $it_img8            = addslashes((string)$rowData[0][$j++]);
        $it_img9            = addslashes((string)$rowData[0][$j++]);
        $it_img10           = addslashes((string)$rowData[0][$j++]);
        $it_explan2         = strip_tags(trim($it_explan));

        if(!$it_id || !$ca_id || !$it_name) {
            $fail_count++;
            continue;
        }

        // it_id 중복체크
        $sql2 = " select count(*) as cnt from {$g5['g5_shop_item_table']} where it_id = '$it_id' ";
        $row2 = sql_fetch($sql2);
        if(isset($row2['cnt']) && $row2['cnt']) {
            $fail_it_id[] = $it_id;
            $dup_it_id[] = $it_id;
            $dup_count++;
            $fail_count++;
            continue;
        }

        // 기본분류체크
        $sql2 = " select count(*) as cnt from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
        $row2 = sql_fetch($sql2);
        if(! (isset($row2['cnt']) && $row2['cnt'])) {
            $fail_it_id[] = $it_id;
            $fail_count++;
            continue;
        }

        // 옵션처리
        if ($it_option1 && $it_opt_set) {
            unset($it_option_subject);
            $opt_set = explode('|', $it_opt_set);
            
            $ii=0;
            $opt1 = get_option_set($it_option1);
            $opt_subject[$ii] = $opt1['opt_subject'];
            $ii++;

            if ($it_option2) {
                $opt2 = get_option_set($it_option2);
                $opt_subject[$ii] = $opt2['opt_subject'];
                $ii++;
                
                if ($it_option3) {
                    $opt3 = get_option_set($it_option3);
                    $opt_subject[$ii] = $opt3['opt_subject'];
                    
                    foreach ($opt1['opt_item'] as $opt1_val) {
                        foreach ($opt2['opt_item'] as $opt2_val) {
                            foreach ($opt3['opt_item'] as $opt3_val) {
                                $opt_set_subject = "{$opt1_val}".chr(30)."{$opt2_val}".chr(30)."{$opt3_val}";
                                insert_option_data($opt_set_subject, $opt_set);
                            }
                        }
                    }
                } else {
                    foreach ($opt1['opt_item'] as $opt1_val) {
                        foreach ($opt2['opt_item'] as $opt2_val) {
                            $opt_set_subject = "{$opt1_val}".chr(30)."{$opt2_val}";
                            insert_option_data($opt_set_subject, $opt_set);
                        }
                    }
                }
            } else {
                foreach ($opt1['opt_item'] as $opt1_val) {
                    $opt_set_subject = "{$opt1_val}";
                    insert_option_data($opt_set_subject, $opt_set);
                }
            }

            if (is_array($opt_subject)) {
                $it_option_subject = implode(',', $opt_subject);
            }
        }
        
        $sql = " INSERT INTO {$g5['g5_shop_item_table']}
                     SET it_id = '$it_id',
                         ca_id = '$ca_id',
                         ca_id2 = '$ca_id2',
                         ca_id3 = '$ca_id3',
                         it_name = '$it_name',
                         it_maker = '$it_maker',
                         it_origin = '$it_origin',
                         it_brand = '$it_brand',
                         it_model = '$it_model',
                         it_type1 = '$it_type1',
                         it_type2 = '$it_type2',
                         it_type3 = '$it_type3',
                         it_type4 = '$it_type4',
                         it_type5 = '$it_type5',
                         it_basic = '$it_basic',
                         it_explan = '$it_explan',
                         it_explan2 = '$it_explan2',
                         it_mobile_explan = '$it_mobile_explan',
                         it_option_subject = '$it_option_subject',
                         it_cust_price = '$it_cust_price',
                         it_price = '$it_price',
                         it_point = '$it_point',
                         it_point_type = '$it_point_type',
                         it_stock_qty = '$it_stock_qty',
                         it_noti_qty = '$it_noti_qty',
                         it_buy_min_qty = '$it_buy_min_qty',
                         it_buy_max_qty = '$it_buy_max_qty',
                         it_notax = '$it_notax',
                         it_use = '$it_use',
                         it_time = '".G5_TIME_YMDHIS."',
                         it_ip = '{$_SERVER['REMOTE_ADDR']}',
                         it_order = '$it_order',
                         it_tel_inq = '$it_tel_inq',
                         it_img1 = '$it_img1',
                         it_img2 = '$it_img2',
                         it_img3 = '$it_img3',
                         it_img4 = '$it_img4',
                         it_img5 = '$it_img5',
                         it_img6 = '$it_img6',
                         it_img7 = '$it_img7',
                         it_img8 = '$it_img8',
                         it_img9 = '$it_img9',
                         it_img10 = '$it_img10' ";

        sql_query($sql);

        $succ_count++;
    }
}

function get_option_set($row_data) {
    $temp1 = explode('|', $row_data);
    $output['opt_subject'] = $temp1[0];
    
    $temp2 = explode(',', $temp1[1]);
    $output['opt_item'] = $temp2;
    
    return $output;
}

function insert_option_data($io_id_subject, $opt_set) {
    global $g5, $it_id;
    
    $m=0;
    $io_set[$m++] = " io_id = '{$io_id_subject}' ";
    $io_set[$m++] = " io_price = '{$opt_set[0]}' ";
    $io_set[$m++] = " io_stock_qty = '{$opt_set[1]}' ";
    $io_set[$m++] = " io_noti_qty = '{$opt_set[2]}' ";
    $io_set[$m++] = " io_use = '{$opt_set[3]}' ";
    $io_upset = implode(',', $io_set);
    
    $io_sql = "insert into {$g5['g5_shop_item_option_table']} set it_id = '{$it_id}', {$io_upset}";
    sql_query($io_sql);
}