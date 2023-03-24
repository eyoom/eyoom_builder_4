<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/itemevent.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'itemevent';
$g5_title = '이벤트관리';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-itemevent">
    <div class="adm-headline">
        <h3>이벤트 리스트</h3>
        <?php if (!$wmode) { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventform" class="btn-e btn-e-md btn-e-crimson adm-headline-btn"><i class="las la-plus m-r-7"></i><span>이벤트 추가</span></a>
        <?php } ?>
    </div>

    <div class="f-s-13r m-b-5">
        전체 이벤트 <?php echo number_format($total_count); ?>건
    </div>

    <p class="text-end f-s-13r m-b-5 text-gray visible-xs">Note! 좌우 스크롤 (<i class="las la-arrows-alt-h"></i>)</p>
    
    <div class="table-list-eb">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="width-150px">이벤트번호</th>
                        <th class="width-180px">관리</th>
                        <th>제목</th>
                        <th>연결상품</th>
                        <th>사용</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
                    <tr>
                        <th class="text-center"><?php echo $list[$i]['ev_id']; ?></th>
                        <td class="text-center">
                            <a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventform&amp;w=u&amp;ev_id=<?php echo $list[$i]['ev_id']; ?>"><u>수정</u></a><a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $list[$i]['ev_id']; ?>" target="_blank" class='m-l-10'><u>보기</u></a><a href="<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&amp;pid=itemeventformupdate&amp;w=d&amp;ev_id=<?php echo $list[$i]['ev_id']; ?>" onclick="return delete_confirm(this);" class="m-l-10"><u>삭제</u></a>
                        </td>
                        <td><?php echo $list[$i]['subject']; ?></td>
                        <td class="text-center"><?php echo $list[$i]['cnt'] ? $list[$i]['href']: 0; ?></td>
                        <td class="text-center"><?php echo $list[$i]['ev_use'] ? '예': '아니오'; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if(count((array)$list) == 0) { ?>
                    <tr>
                        <td colspan="5" class="text-center text-light-gray"><i class="fas fa-exclamation-circle"></i> 출력할 내용이 없습니다.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function itemeventwin(ev_id) {
    window.open("<?php echo G5_ADMIN_URL; ?>/?dir=shopetc&pid=itemeventwin&wmode=1&ev_id="+ev_id, "itemeventwin", "left=10,top=10,width=500,height=600,scrollbars=1");
}

function delete_confirm() {
    if(confirm('정말로 선택한 이벤트를 삭제하시겠습니까?')) {
        return true;
    } else {
        return false;
    }
}
</script>