<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/itemeventwin.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="ac-order-print-list">
    <div class="headline">
        <h2> [<?php echo $ev['ev_subject']; ?>] 이벤트상품</h2>
    </div>
    <div class="margin-bottom-20"></div>

    <form class="eyoom-form">
    <div class="margin-bottom-30">

        <div class="table-list-eb">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">이미지</th>
                        <th scope="col">상품명</th>
                        <th scope="col">사용</th>
                        <th scope="col">삭제</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <td class="text-center"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></td>
                        <td><?php echo cut_str(stripslashes($list[$i]['it_name']), 60, "&#133"); ?></td>
                        <td class="text-center"><?php echo $list[$i]['it_use'] ? '사용':'미사용'; ?></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventwindel&amp;smode=1&amp;ev_id=<?php echo $ev_id; ?>&amp;it_id=<?php echo $list[$i]['it_id']; ?>" onclick="return delete_confirm();" class="btn-e btn-e-xs btn-e-yellow">삭제</a></td>
                    </tr>
                    <?php } ?>
                    <?php if (count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="4" class="text-center">자료가 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </form>
</div>

<script>
function delete_confirm() {
    if(confirm('정말로 선택한 상품을 이벤트에서 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>