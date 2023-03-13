<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$is_shop = $_POST['me_shop'] === '1' ? 'shop': '';
$mode = isset($_POST['mode']) ? clean_xss_tags($_POST['mode']): '';
$theme = isset($_POST['theme']) ? clean_xss_tags($_POST['theme']): 'eb4_basic';

switch($mode) {
    case "update":
        $me_code = isset($_POST['me_code']) ? clean_xss_tags($_POST['me_code']): '';
        $me_path = isset($_POST['me_path']) ? clean_xss_tags($_POST['me_path']): '';
        $me_name = isset($_POST['me_name']) ? clean_xss_tags($_POST['me_name']): '';
        $me_shop = isset($_POST['me_shop']) ? clean_xss_tags($_POST['me_shop']): '';
        $me_order = isset($_POST['me_order']) ? clean_xss_tags($_POST['me_order']): '';
        $me_order_prev = isset($_POST['me_order_prev']) ? clean_xss_tags($_POST['me_order_prev']): '';
        $me_use_nav = isset($_POST['me_use_nav']) ? clean_xss_tags($_POST['me_use_nav']): '';
        $me_icon = isset($_POST['me_icon']) ? clean_xss_tags($_POST['me_icon']): '';
        $me_path = isset($_POST['me_path']) ? clean_xss_tags($_POST['me_path']): '';
        $me_target = isset($_POST['me_target']) ? clean_xss_tags($_POST['me_target']): '';
        $apply_permit_level_submenu = isset($_POST['apply_permit_level_submenu']) ? clean_xss_tags($_POST['apply_permit_level_submenu']): '';
        $me_permit_level = isset($_POST['me_permit_level']) ? clean_xss_tags($_POST['me_permit_level']): '';
        $me_side = isset($_POST['me_side']) ? clean_xss_tags($_POST['me_side']): '';
        $me_use = isset($_POST['me_use']) ? clean_xss_tags($_POST['me_use']): '';
        $me_name_prev = isset($_POST['me_name_prev']) ? clean_xss_tags($_POST['me_name_prev']): '';

        $subme_name = isset($_POST['subme_name']) ? clean_xss_tags($_POST['subme_name']): '';
        $subme_link = isset($_POST['subme_link']) ? clean_xss_tags($_POST['subme_link']): '';
        $subme_use_nav = isset($_POST['subme_use_nav']) ? clean_xss_tags($_POST['subme_use_nav']): '';
        $subme_icon = isset($_POST['subme_icon']) ? clean_xss_tags($_POST['subme_icon']): '';
        $subme_target = isset($_POST['subme_target']) ? clean_xss_tags($_POST['subme_target']): '';
        $subme_permit_level = isset($_POST['subme_permit_level']) ? clean_xss_tags($_POST['subme_permit_level']): '';
        $subme_side = isset($_POST['subme_side']) ? clean_xss_tags($_POST['subme_side']): '';
        $subme_use = isset($_POST['subme_use']) ? clean_xss_tags($_POST['subme_use']): '';

        if($me_code === '1') $me_code = '';

        /**
         * 메뉴 생성하기
         */
        if($subme_name) {
            $subme_info = $thema->get_menu_link($subme_link);
            $subme_info['me_link'] = preg_match('/^javascript/i', $subme_info['me_link']) ? G5_URL : strip_tags($subme_info['me_link']);
            $subme_info['me_link'] = html_purifier($subme_info['me_link']);
            $subme_path = $me_path ? $me_path.' > '.$subme_name: $subme_name;

            $subme_code = strip_tags($me_code);
            $subme_name = strip_tags(trim($subme_name));
            $subme_name = str_replace(array("\r\n","\r","\n"), '', $subme_name);

            $length = strlen($subme_code)+3;
            $where = " me_theme='{$theme}' and me_code like '{$subme_code}%' and length(me_code)=$length and me_shop='{$me_shop}'";
            $row = sql_fetch("select max(me_code) as max from {$g5['eyoom_menu']} where $where");
            $max = $row['max'];
            if (!$max) $max = $subme_code."000";
            $subme_code = sprintf("%0{$length}s",$max+1);

            $row2 = sql_fetch("select max(me_order) as max from {$g5['eyoom_menu']} where $where");
            $subme_order = $row2['max'] + 1;

            if(!$subme_use_nav) {
                $_me_code = str_split($subme_code,3);
                $row3 = sql_fetch("select * from {$g5['eyoom_menu']} where me_theme='{$theme}' and me_code='{$_me_code[0]}' and me_shop='{$me_shop}'");
                $subme_use_nav = $row3['me_use_nav'];
                if(!$subme_use_nav) $subme_use_nav = 'y';
            }

            $set = "
                me_theme        = '{$theme}',
                me_code         = '{$subme_code}',
                me_order        = '{$subme_order}',
                me_icon         = '{$subme_icon}',
                me_shop         = '{$me_shop}',
                me_name         = '{$subme_name}',
                me_path         = '{$subme_path}',
                me_type         = '{$subme_info['me_type']}',
                me_pid          = '{$subme_info['me_pid']}',
                me_sca          = '{$subme_info['me_sca']}',
                me_link         = '{$subme_info['me_link']}',
                me_target       = '{$subme_target}',
                me_permit_level = '{$subme_permit_level}',
                me_side         = '{$subme_side}',
                me_use          = '{$subme_use}',
                me_use_nav      = '{$subme_use_nav}'
            ";
            $insert = "insert into {$g5['eyoom_menu']} set $set";
            sql_query($insert,false);

        }

        /**
         * 메뉴 수정하기
         */
        if ($me_name) {
            $me_info = $thema->get_menu_link($me_link);
            $me_info['me_link'] = preg_match('/^javascript/i', $me_info['me_link']) ? G5_URL : strip_tags($me_info['me_link']);
            $me_info['me_link'] = html_purifier($me_info['me_link']);

            $me_code = strip_tags($me_code);
            $me_name = strip_tags(trim($me_name));
            $me_name = str_replace(array("\r\n","\r","\n"), '', $me_name);

            /**
             * 출력순서값이 수정될 경우, 입력된 순서 이상은 +1처리
             */
            if($me_order != $me_order_prev) {
                $_code = substr($me_code,0,-3);
                if($_code) $where = " and me_code like '{$_code}%' and length(me_code)=".strlen($me_code);
                else $where = " and length(me_code)=3 ";
                $where .= " and me_shop='{$me_shop}' ";

                if ($me_order_prev > $me_order) {
                    $where .= " and me_order >= {$me_order} and me_order < {$me_order_prev} and me_shop='{$me_shop}' ";
                    $sql = "update {$g5['eyoom_menu']} set me_order = me_order + 1 where me_theme='{$theme}' $where ";
                } else if ($me_order_prev < $me_order) {
                    $where .= " and me_order <= {$me_order} and me_order > {$me_order_prev} and me_shop='{$me_shop}' ";
                    $sql = "update {$g5['eyoom_menu']} set me_order = me_order - 1 where me_theme='{$theme}' $where ";
                }
                sql_query($sql, false);
            }

            if(!$me_use_nav) {
                $_me_code = str_split($me_code,3);
                $row3 = sql_fetch("select * from {$g5['eyoom_menu']} where me_theme='{$theme}' and me_code='{$_me_code[0]}' and me_shop='{$me_shop}'");
                $me_use_nav = $row3['me_use_nav'];
                if(!$me_use_nav) $me_use_nav = 'y';
            } else {
                $me_use_nav = $me_use_nav;
                $sql = "update {$g5['eyoom_menu']} set me_use_nav='{$me_use_nav}' where me_theme='{$theme}' and me_code like '{$me_code}%' and me_shop='{$me_shop}'";
                sql_query($sql,false);
            }

            /**
             * 메뉴 접근권한 서브메뉴에 적용
             */
            if (isset($_POST['apply_permit_level_submenu']) && $apply_permit_level_submenu) {
                $sql = "update {$g5['eyoom_menu']} set me_permit_level='{$me_permit_level}' where me_theme='{$theme}' and me_code like '{$me_code}%' ";
                sql_query($sql, false);
            }

            $set = "
                me_order        = '{$me_order}',
                me_icon         = '{$me_icon}',
                me_shop         = '{$me_shop}',
                me_name         = '{$me_name}',
                me_path         = '{$me_path}',
                me_type         = '{$me_info['me_type']}',
                me_pid          = '{$me_info['me_pid']}',
                me_sca          = '{$me_info['me_sca']}',
                me_link         = '{$me_info['me_link']}',
                me_target       = '{$me_target}',
                me_permit_level = '{$me_permit_level}',
                me_side         = '{$me_side}',
                me_use          = '{$me_use}',
                me_use_nav      = '{$me_use_nav}'
            ";

            $update = "update {$g5['eyoom_menu']} set $set where me_theme='{$theme}' and me_code='{$me_code}' and me_shop='{$me_shop}'";
            sql_query($update,false);

            /**
             * 메뉴명이 바뀐경우
             */
            if($me_name != $me_name_prev) {
                $sql = "select me_id, me_path, me_code from {$g5['eyoom_menu']} where me_theme='{$theme}' and me_code like '{$me_code}%' and me_shop='{$me_shop}'";
                $res = sql_query($sql,false);
                $depth = strlen($me_code)/3 - 1;
                for($i=0;$row=sql_fetch_array($res);$i++) {
                    unset($path,$_path);
                    $path = explode(">",$row['me_path']);
                    $_path = array();
                    foreach($path as $key => $path_name) {
                        if($key == $depth) $path_name = $me_name;
                        $_path[$key] = trim($path_name);
                    }
                    $new_path = implode(" > ",$_path);
                    sql_query("update {$g5['eyoom_menu']} set me_path='{$new_path}' where me_id='{$row['me_id']}' and me_shop='{$me_shop}'");
                }
            }

            /**
             * 보이기, 감추기 서브에도 일괄적용
             */
            if($me_use == 'n') {
                $sql = "update {$g5['eyoom_menu']} set me_use = '{$me_use}' where me_theme='{$theme}' and me_code like '{$me_code}%' and me_shop='{$me_shop}'";
                sql_query($sql,false);
            }
        }
        break;

    case "delete":
        if(!$me_code) alert("잘못된 접근입니다.");
        if(!$theme) alert("잘못된 접근입니다.");
        $sql = "delete from {$g5['eyoom_menu']} where me_theme='{$theme}' and me_code like '{$me_code}%' and me_shop='{$me_shop}'";
        sql_query($sql,false);
        break;
}

?>

<meta charset="utf-8">
<body onload="fmenu_submit();">
<form name="fmenu" id="fmenu" method="post" action="<?php echo G5_ADMIN_URL . "/?dir=theme&pid={$is_shop}menu_list"; ?>">
<?php if ($mode != 'delete') { ?>
<input type="hidden" name="id" value="<?php echo $me_code; ?>">
<input type="hidden" name="thema" value="<?php echo $theme; ?>">
<input type="hidden" name="wmode" value="<?php echo $wmode; ?>">
<?php } ?>
</form>
</body>
<script>
function fmenu_submit() {
    var f = document.fmenu;
    f.submit();
}
</script>