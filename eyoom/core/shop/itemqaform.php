<?php
/**
 * core file : /eyoom/core/shop/itemqaform.php
 */
if (!defined('_EYOOM_')) exit;

include_once(G5_EDITOR_LIB);

if (!$is_member) {
    if (G5_IS_MOBILE) {
        alert_close("상품문의는 회원만 작성 가능합니다.");
    } else {
        echo "<script>alert('상품문의는 회원만 작성 가능합니다.'); window.parent.close_modal();</script>";
    }
    exit;
}

$w     = preg_replace('/[^0-9a-z]/i', '', trim($_REQUEST['w']));
$it_id = get_search_string(trim($_REQUEST['it_id']));
$iq_id = preg_replace('/[^0-9]/', '', trim($_REQUEST['iq_id']));

// 상품정보체크
$row = get_shop_item($it_id, true);
if(!$row['it_id']) {
    if (G5_IS_MOBILE) {
        alert_close("상품정보가 존재하지 않습니다.");
    } else {
        echo "<script>alert('상품정보가 존재하지 않습니다.'); window.parent.close_modal();</script>";
    }
    exit;
}

$chk_secret = '';

if($w == '') {
    $qa['iq_email'] = $member['mb_email'];
    $qa['iq_hp'] = $member['mb_hp'];
}

if ($w == "u")
{
    $qa = sql_fetch(" select * from {$g5['g5_shop_item_qa_table']} where iq_id = '$iq_id' ");
    if (!$qa) {
        if (G5_IS_MOBILE) {
            alert_close("상품문의 정보가 없습니다.");
        } else {
            echo "<script>alert('상품문의 정보가 없습니다.'); window.parent.close_modal();</script>";
        }
        exit;
    }

    $it_id    = $qa['it_id'];

    if (!$is_admin && $qa['mb_id'] != $member['mb_id']) {
        if (G5_IS_MOBILE) {
            alert_close("자신의 상품문의만 수정이 가능합니다.");
        } else {
            echo "<script>alert('자신의 상품문의만 수정이 가능합니다.'); window.parent.close_modal();</script>";
        }
        exit;
    }

    if($qa['iq_secret'])
        $chk_secret = 'checked="checked"';
}

include_once(G5_PATH.'/head.sub.php');

$is_dhtml_editor = false;
// 모바일에서는 DHTML 에디터 사용불가
if ($config['cf_editor'] && (!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)) {
    $is_dhtml_editor = true;
}
$editor_html = editor_html('iq_question', get_text(html_purifier($qa['iq_question']), 0), $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('iq_question', $is_dhtml_editor);
$editor_js .= chk_editor_js('iq_question', $is_dhtml_editor);

/**
 * 스킨 경로
 */
$skin_dir = EYOOM_CORE_PATH.'/'. G5_SHOP_DIR;

$itemqaform_skin = $skin_dir.'/itemqaform.skin.php';

if(!file_exists($itemqaform_skin)) {
    echo str_replace(G5_PATH.'/', '', $itemqaform_skin).' 스킨 파일이 존재하지 않습니다.';
} else {
    include_once($itemqaform_skin);
}

include_once(G5_PATH.'/tail.sub.php');