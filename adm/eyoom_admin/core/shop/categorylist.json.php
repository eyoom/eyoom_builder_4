<?php
include_once('./_common.php');

$root_text = '카테고리 루트';
$admin_mode = true;
$category = $shop->get_category();
$category = $shop->sort_category($category);

$output  = '';
$output .= '[{';
$output .= '
    "id":"0",
    "text":"' . $root_text . '",
    "children":[
';

if (is_array($category)) {
    $_output = array();
    foreach ($category as $val) {
        if (isset($val['ca_id'])) {
            $blind = '';
            $ca_order = $val['ca_order'];
            if ($val['ca_id'] != '0' && !$val['ca_id']) continue;
            if ($val['ca_use'] != '1') $blind = " <span style='color:#f30;'><i class='fa fa-eye-slash'></i></span>";
            $children_json = $shop->category_json($val['children']);
            $_output[] = '{' .
                         '"id":"' . $val['ca_id'] . '",' .
                         '"order":"' . $ca_order . '",' .
                         '"text":"' . trim($val['ca_name']) . $blind . '"' .
                         $children_json .
                         '}';
        }
    }
    $output .= implode(',', $_output);
}
$output .= '
    ]
';
$output .= '}]';

echo $output;
?>