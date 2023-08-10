<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shop/couponmember.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-couponmemberlist">
    <form name="fmember" id="fmember" class="eyoom-form" method="get">

    <div class="adm-form-table adm-search-box m-b-20">
        <div class="adm-form-tr">
            <div class="adm-form-td td-l">
                <label for="sch_word" class="label">검색어<strong class="sound_only"> 필수</strong></label>
            </div>
            <div class="adm-form-td td-r">
                <input type="hidden" name="dir" value="<?php echo $dir; ?>" id="dir">
                <input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid">
                <input type="hidden" name="wmode" value="1">
                <label class="input max-width-250px">
                    <input type="text" name="mb_name" value="<?php echo get_text($mb_name); ?>" id="mb_name" placeholder="회원이름">
                </label>
            </div>
        </div>
    </div>

    <div class="confirm-bottom-btn m-b-20">
        <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark">
    </div>

    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>회원이름</th>
                        <th>회원아이디</th>
                        <th>선택</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><strong><?php echo get_text($list[$i]['mb_name']); ?></strong></th>
                        <td class="text-center"><?php echo $list[$i]['mb_id']; ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="btn-e btn-e-dark" onclick="sel_member_id('<?php echo $list[$i]['mb_id']; ?>');">선택</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="3" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>

    </form>
</div>

<script>
function sel_member_id(mb_id)
{
    $('#mb_id', parent.document).val(mb_id);
    window.parent.closeModal();
}
</script>