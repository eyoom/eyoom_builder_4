<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventformupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

if ($w == "u" || $w == "d")
    check_demo();

if ($w == 'd')
    auth_check($auth[$sub_menu], "d");
else
    auth_check($auth[$sub_menu], "w");

check_admin_token();

@mkdir(G5_DATA_PATH."/event", G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/event", G5_DIR_PERMISSION);

if ($ev_mimg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_m");
if ($ev_himg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_h");
if ($ev_timg_del)  @unlink(G5_DATA_PATH."/event/{$ev_id}_t");

$ev_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_skin);
$ev_mobile_skin = preg_replace('#\.+(\/|\\\)#', '', $ev_mobile_skin);
$ev_subject = strip_tags($ev_subject);

$skin_regex_patten = "^list.[0-9]+\.skin\.php";

$ev_skin = (preg_match("/$skin_regex_patten/", $ev_skin) && file_exists(G5_SHOP_SKIN_PATH.'/'.$ev_skin)) ? $ev_skin : ''; 
$ev_mobile_skin = (preg_match("/$skin_regex_patten/", $ev_mobile_skin) && file_exists(G5_MSHOP_SKIN_PATH.'/'.$ev_mobile_skin)) ? $ev_mobile_skin : ''; 

$sql_common = " set ev_skin             = '$ev_skin',
                    ev_mobile_skin      = '$ev_mobile_skin',
                    ev_img_width        = '$ev_img_width',
                    ev_img_height       = '$ev_img_height',
                    ev_list_mod         = '$ev_list_mod',
                    ev_list_row         = '$ev_list_row',
                    ev_mobile_img_width = '$ev_mobile_img_width',
                    ev_mobile_img_height= '$ev_mobile_img_height',
                    ev_mobile_list_mod  = '$ev_mobile_list_mod',
                    ev_mobile_list_row  = '$ev_mobile_list_row',
                    ev_subject          = '$ev_subject',
                    ev_head_html        = '$ev_head_html',
                    ev_tail_html        = '$ev_tail_html',
                    ev_use              = '$ev_use',
                    ev_subject_strong   = '$ev_subject_strong'
                    ";

if ($w == "")
{
    $ev_id = G5_SERVER_TIME;

    $sql = " insert {$g5['g5_shop_event_table']}
                    $sql_common
                  , ev_id = '$ev_id' ";
    sql_query($sql);
}
else if ($w == "u")
{
    $sql = " update {$g5['g5_shop_event_table']}
                $sql_common
              where ev_id = '$ev_id' ";
    sql_query($sql);
}
else if ($w == "d")
{
    @unlink(G5_DATA_PATH."/event/{$ev_id}_m");
    @unlink(G5_DATA_PATH."/event/{$ev_id}_h");
    @unlink(G5_DATA_PATH."/event/{$ev_id}_t");

    // 이벤트상품삭제
    $sql = " delete from {$g5['g5_shop_event_item_table']} where ev_id = '$ev_id' ";
    sql_query($sql);

    $sql = " delete from {$g5['g5_shop_event_table']} where ev_id = '$ev_id' ";
    sql_query($sql);

    $msg = "해당 이벤트를 삭제처리하였습니다.";
}

if ($w == "" || $w == "u")
{
    if ($_FILES['ev_mimg']['name']) upload_file($_FILES['ev_mimg']['tmp_name'], $ev_id."_m", G5_DATA_PATH."/event");
    if ($_FILES['ev_himg']['name']) upload_file($_FILES['ev_himg']['tmp_name'], $ev_id."_h", G5_DATA_PATH."/event");
    if ($_FILES['ev_timg']['name']) upload_file($_FILES['ev_timg']['tmp_name'], $ev_id."_t", G5_DATA_PATH."/event");

    // 등록된 이벤트 상품 먼저 삭제
    $sql = " delete from {$g5['g5_shop_event_item_table']} where ev_id = '$ev_id' ";
    sql_query($sql);

    // 이벤트 상품등록
    $item = explode(',', $ev_item);
    $count = count($item);

    for($i=0; $i<$count; $i++) {
        $it_id = $item[$i];
        if($it_id) {
            $sql = " insert into {$g5['g5_shop_event_item_table']}
                        set ev_id = '$ev_id',
                            it_id = '$it_id' ";
            sql_query($sql);
        }
    }

    $msg = "이벤트 설정정보를 적용하였습니다.";
    
    $url = G5_ADMIN_URL."/?dir=shopetc&amp;pid=itemeventform&amp;w=u&amp;ev_id=$ev_id";
    if ($wmode) $url .= "&amp;wmode=1";
    alert($msg, $url);
}
else
{
    alert($msg, G5_ADMIN_URL."/?dir=shopetc&amp;pid=itemevent");
}