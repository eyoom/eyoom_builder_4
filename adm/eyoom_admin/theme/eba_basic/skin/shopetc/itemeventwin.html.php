<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/itemeventwin.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<style>
.admin-shop-itemeventwin .itemeventwin-image {width:80px;margin:0 auto}
.admin-shop-itemeventwin .itemeventwin-image img {display:block;max-width:100%;height:auto}
</style>

<div class="admin-shop-itemeventwin">
    <div class="adm-headline">
        <h3>[<?php echo $ev['ev_subject']; ?>] 이벤트상품</h3>
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>이미지</th>
                        <th>상품명</th>
                        <th>사용</th>
                        <th class="wieth-60px">삭제</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th>
                            <div class="itemeventwin-image"><a href="<?php echo $list[$i]['href']; ?>" target="_blank"><?php echo $list[$i]['image']; ?></a></div>
                        </th>
                        <td><?php echo cut_str(stripslashes($list[$i]['it_name']), 60, "&#133"); ?></td>
                        <td class="text-center"><?php echo $list[$i]['it_use'] ? '사용':'미사용'; ?></td>
                        <td class="text-center"><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventwindel&amp;smode=1&amp;ev_id=<?php echo $ev_id; ?>&amp;it_id=<?php echo $list[$i]['it_id']; ?>" onclick="return delete_confirm();"><u>삭제</u></a></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="4" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
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