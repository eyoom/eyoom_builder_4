<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/mypage.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
#smb_my {margin-bottom:0}
.shop-mypage .panel-group {position:relative;margin-bottom:70px}
.shop-mypage .panel-oc-btn {position:absolute;bottom:-30px;left:50%;width:50px;height:30px;margin-left:-25px;border:1px solid #d5d5d5;border-top:0;text-align:center;padding:5px 0 0;background:#f8f8f8}
.shop-mypage .panel-oc-btn .fas {display:block;line-height:1;font-size:11px;color:#757575}
.shop-mypage .panel-oc-btn .fa-caret-down {margin-top:-5px}
.shop-mypage .panel-heading {background:#f8f8f8}
.shop-mypage .panel-heading .panel-title {font-size:1.25rem}
.shop-mypage .panel-body:after {content:"";display:block;clear:both}
.shop-mypage .panel-body dt {float:left;width:15%;margin:3px 0;font-weight:bold}
.shop-mypage .panel-body dd {float:left;width:35%;margin:3px 0}
.shop-mypage .mypage-wishlist-container {margin-left:-10px;margin-right:-10px}
.shop-mypage .mypage-wishlist-box {position:relative;width:25%}
.shop-mypage .mypage-wishlist-box-pd {padding:10px}
.shop-mypage .mypage-wishlist-box-in {position:relative;border:1px solid #dadada;padding:10px;background:#fff}
.shop-mypage .mypage-wishlist-box .mypage-wishlist-img {margin-bottom:15px}
.shop-mypage .mypage-wishlist-box .mypage-wishlist-img img {display:block;max-width:100%;height:auto}
.shop-mypage .mypage-wishlist-box h5 {font-size:1rem;margin-bottom:10px}
.shop-mypage .mypage-wishlist-box-in:hover h5 {text-decoration:underline;color:#000}
.shop-mypage .mypage-wishlist-box .mypage-wishlist-date {font-size:.875rem;color:#959595}
@media (max-width:991px) {
    .shop-mypage .mypage-wishlist-box {width:50%}
}
@media (max-width:767px) {
    .shop-mypage .panel-body dt {width:38%}
    .shop-mypage .panel-body dd {width:62%}
    .shop-mypage .mypage-wishlist-container {margin-left:-5px;margin-right:-5px}
    .shop-mypage .mypage-wishlist-box-pd {padding:5px}
}
</style>

<?php /* ---------- 마이페이지 시작 ---------- */ ?>
<div id="smb_my" class="shop-mypage">
    <div class="text-end m-b-20">
        <?php if ($is_admin == 'super') { ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/" class="btn-e btn-e-crimson">관리자</a>
        <?php } ?>
        <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="memo_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/memo.php" target="_blank"<?php } ?> class="btn-e btn-e-dark">쪽지함</a>
        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn-e btn-e-dark">회원정보수정</a>
        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn-e btn-e-gray">회원탈퇴</a>
    </div>

    <?php /* 회원정보 개요 시작 */ ?>
    <div class="panel-group accordion-default">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="fas fa-user-circle m-r-5"></i>
                    <a href="#mypage_panel" data-bs-toggle="collapse">
                        <strong><?php echo $member['mb_name']; ?></strong>
                    </a>
                </h4>
                <div class="m-t-10">
                    <span>보유포인트</span>
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="point_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"<?php } ?>><u class="text-crimson"><strong><?php echo number_format($member['mb_point']); ?></strong></u></a> 점
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="point_modal();"<?php } else { ?>href="<?php echo G5_BBS_URL; ?>/point.php" target="_blank"<?php } ?> class="btn-e btn-e-xxs btn-e-gray m-l-5 hidden-xs">상세보기</a>
                    <span class="m-l-10 m-r-10 text-light-gray">/</span>
                    <span>보유쿠폰</span>
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="coupon_modal();"<?php } else { ?>href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank"<?php } ?>><u class="text-crimson"><strong><?php echo number_format($cp_count); ?></strong></u></a> 개
                    <a <?php if ( !G5_IS_MOBILE ) { ?>href="javascript:void(0);" onclick="coupon_modal();"<?php } else { ?>href="<?php echo G5_SHOP_URL; ?>/coupon.php" target="_blank"<?php } ?> class="btn-e btn-e-xxs btn-e-gray m-l-5 hidden-xs">상세보기</a>
                </div>
            </div>
            <div id="mypage_panel" class="panel-collapse collapse in">
                <div class="panel-body">
                    <dl class="op_area">
                        <dt>연락처</dt>
                        <dd><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></dd>
                        <dt>E-Mail</dt>
                        <dd><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></dd>
                        <dt>최종접속일시</dt>
                        <dd><?php echo $member['mb_today_login']; ?></dd>
                        <dt>회원가입일시</dt>
                        <dd><?php echo $member['mb_datetime']; ?></dd>
                        <dt>주소</dt>
                        <dd><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <a href="#mypage_panel" data-bs-toggle="collapse" class="panel-oc-btn">
            <i class="fas fa-caret-up"></i>
            <i class="fas fa-caret-down"></i>
        </a>
    </div>
    <?php /* 회원정보 개요 끝 */ ?>

    <?php /* 최근 주문내역 시작 */ ?>
    <div class="m-b-50">
        <div class="headline-short">
            <h4><strong>최근 주문내역</strong></h4>
            <a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="headline-btn btn-e btn-e-brd btn-e-dark"><i class="fas fa-plus"></i> 더보기</a>
        </div>
        <?php
        // 최근 주문내역
        define("_ORDERINQUIRY_", true);

        $limit = " limit 0, 5 ";
        include $skin_dir.'/orderinquiry.sub.php';
        ?>
    </div>
    <?php /* 최근 주문내역 끝 */ ?>

    <?php /* 최근 위시리스트 시작 */ ?>
    <div class="mypage-wishlist-wrap">
        <div class="headline-short">
            <h4><strong>최근 위시리스트</strong></h4>
            <a href="<?php echo G5_SHOP_URL; ?>/wishlist.php" class="headline-btn btn-e btn-e-brd btn-e-dark"><i class="fas fa-plus"></i> 더보기</a>
        </div>
        <div class="mypage-wishlist-container">
            <?php for ($i=0; $i<$wish_count; $i++) { ?>
            <div class="mypage-wishlist-box">
                <div class="mypage-wishlist-box-pd">
                    <div class="mypage-wishlist-box-in">
                        <div class="mypage-wishlist-img">
                            <?php echo $wish_list[$i]['image']; ?>
                        </div>
                        <h5 class="ellipsis"><a href="<?php echo shop_item_url($wish_list[$i]['it_id']); ?>"><strong><?php echo stripslashes($wish_list[$i]['it_name']); ?></strong></a></h5>
                        <div class="mypage-wishlist-date"><i class="far fa-clock"></i> <?php echo $wish_list[$i]['wi_time']; ?></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <?php if ($wish_count == 0) { ?>
        <div class="text-center text-gray m-t-40"><i class="fas fa-exclamation-circle"></i> 보관 내역이 없습니다.</div>
        <?php } ?>
    </div>
    <?php /* 최근 위시리스트 끝 */ ?>
</div>
<?php /* ---------- 마이페이지 끝 ---------- */ ?>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/masonry/masonry.pkgd.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script>
$(document).ready(function(){
    var $container = $('.mypage-wishlist-container');
    $container.imagesLoaded(function() {
        $container.masonry({
            columnWidth: '.mypage-wishlist-box',
            itemSelector: '.mypage-wishlist-box'
        });
    });
});

function member_leave() {
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>