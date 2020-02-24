<?php
/**
 * core file : /eyoom/core/shop/itemuseform.php
 */
if (!defined('_EYOOM_')) exit;

include_once(G5_EDITOR_LIB);

if (!$is_member) {
    if (G5_IS_MOBILE) {
        alert_close("사용후기는 회원만 작성 가능합니다.");
    } else {
        echo "<script>alert('사용후기는 회원만 작성 가능합니다.'); window.parent.close_modal();</script>";
    }
    exit;
}

$w     = preg_replace('/[^0-9a-z]/i', '', trim($_REQUEST['w']));
$it_id = get_search_string(trim($_REQUEST['it_id']));
$is_id = preg_replace('/[^0-9]/', '', trim($_REQUEST['is_id']));

/**
 * 상품정보체크
 */
$row = get_shop_item($it_id, true);
if(!$row['it_id']) {
    if (G5_IS_MOBILE) {
        alert_close("상품정보가 존재하지 않습니다.");
    } else {
        echo "<script>alert('상품정보가 존재하지 않습니다.'); window.parent.close_modal();</script>";
    }
    exit;
}

if ($w == "") {
    $is_score = 5;

    /**
     * 사용후기 작성 설정에 따른 체크
     */
    check_itemuse_write($it_id, $member['mb_id']);
} else if ($w == "u") {
    $use = sql_fetch(" select * from {$g5['g5_shop_item_use_table']} where is_id = '$is_id' ");
    if (!$use) {
        if (G5_IS_MOBILE) {
            alert_close("사용후기 정보가 없습니다.");
        } else {
            echo "<script>alert('사용후기 정보가 없습니다.'); window.parent.close_modal();</script>";
        }
        exit;
    }

    $it_id    = $use['it_id'];
    $is_score = $use['is_score'];

    if (!$is_admin && $use['mb_id'] != $member['mb_id']) {
        if (G5_IS_MOBILE) {
            alert_close("자신의 사용후기만 수정이 가능합니다.");
        } else {
            echo "<script>alert('자신의 사용후기만 수정이 가능합니다.'); window.parent.close_modal();</script>";
        }
        exit;
    }
}

include_once(G5_PATH.'/head.sub.php');

$is_dhtml_editor = false;
/**
 * 모바일에서는 DHTML 에디터 사용불가
 */
if ($config['cf_editor'] && (!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)) {
    $is_dhtml_editor = true;
}
$editor_html = editor_html('is_content', get_text(html_purifier($use['is_content']), 0), $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('is_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('is_content', $is_dhtml_editor);

/**
 * 스킨 경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'. G5_SHOP_DIR;

$itemuseform_skin = $skin_dir.'/itemuseform.skin.php';

if(!file_exists($itemuseform_skin)) {
    echo str_replace(G5_PATH.'/', '', $itemuseform_skin).' 스킨 파일이 존재하지 않습니다.';
} else {
    include_once($itemuseform_skin);
}

include_once(G5_PATH.'/tail.sub.php');