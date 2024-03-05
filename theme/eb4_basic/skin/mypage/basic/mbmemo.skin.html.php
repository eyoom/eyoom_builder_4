<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/mbmemo.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 탭메뉴 출력
 */
include_once($eyoom_skin_path['mypage'] . '/tabmenu.skin.html.php');
?>

<div class="mbmemo-list">
    <form name="fmbmemo" method="get" class="eyoom-form m-b-10 lg-m-b-30">
    <div class="mbmemo-search-box">
        <div class="row">
            <div class="col-lg-4">
                <label class="select">
                    <select name="sfl" id="sfl" class="form-control" onchange="this.form.submit();">
                        <option value="">검색대상</option>
                        <option value="id" <?php if ($sfl == 'id') { ?>selected<?php } ?>>아이디</option>
                        <option value="nick" <?php if ($sfl == 'nick') { ?>selected<?php } ?>>닉네임</option>
                    </select>
                    <i></i>
                </label>
            </div>
            <div class="col-lg-8">
                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <div class="input input-button mbmemo-search-input">
                    <i class="icon-prepend fa fa-search"></i>
                    <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required>
                    <div class="button"><input type="submit" value="검색">검색</div>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="m-b-15 text-gray">
        <p>전체 <?php echo $total_count; ?> 건</p>
    </div>
    
    <div class="table-list-eb">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="width-150px">회원</th>
                    <th>메모</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i<$count; $i++) { ?>
                <tr>
                    <td><?php echo eb_nameview($list[$i]['mb_id'], $list[$i]['mb_name'], $list[$i]['mb_email'], $list[$i]['mb_homepage']); ?></td>
                    <td>
                        <?php if (is_array($list[$i]['mm_memo'])) { ?>
                        <?php foreach ($list[$i]['mm_memo'] as $k => $mm) { ?>
                        <div><?php echo $mm; ?></div>
                        <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
                <?php if ($count == 0) { ?>
                <tr>
                    <td colspan="2" class="text-center"><span class="text-light-gray"><i class="fas fa-exclamation-circle"></i> 입력하신 회원메모가 없습니다.</span></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>
