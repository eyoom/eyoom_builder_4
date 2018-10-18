<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/basic/skin/shopetc/price.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;
?>

<div class="admin-shop-price">
    <div class="adm-headline">
        <h3>가격비교 사이트</h3>
    </div>

    <div class="eyoom-form">
        <div class="adm-form-wrap">
            <header>
                <strong><i class="fas fa-caret-right"></i> 가격비교사이트 연동 안내</strong>
            </header>

            <fieldset>
                <ol class="margin-top-10 margin-bottom-10">
                    <li>가격비교사이트는 네이버 지식쇼핑, 다음 쇼핑하우 등이 있습니다.</li>
                    <li>앞서 나열한 가격비교사이트 중 희망하시는 사이트에 입점합니다.</li>
                    <li><strong class="color-red">사이트별 엔진페이지 URL</strong>을 참고하여 해당 엔진페이지 URL 을 입점하신 사이트에 알려주시면 됩니다.</li>
                </ol>
            </fieldset>

            <header class="border-top">
                <strong><i class="fas fa-caret-right"></i> 사이트별 엔진페이지 URL</strong>
            </header>

            <fieldset>
                <div class="alert alert-info margin-top-10">
                    <p>사이트 명을 클릭하시면 해당 사이트로 이동합니다.</p>
                </div>

                <div class="price_engine">
                    <h5><a href="http://shopping.naver.com/" target="_blank"><strong>네이버 지식쇼핑</strong></a></h5>
                    <ul class="margin-bottom-20">
                        <li>입점 안내 : <a href="http://join.shopping.naver.com/join/intro.nhn" target="_blank"><u>http://join.shopping.naver.com/join/intro.nhn</u></a></li>
                        <li>전체상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/naver.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/naver.php</u></a></li>
                        <li>요약상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/naver_summary.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/naver_summary.php</u></a></li>
                    </ul>
                    <h5><a href="http://shopping.daum.net/" target="_blank"><strong>다음 쇼핑하우</strong></a></h5>
                    <ul>
                        <li>입점 안내 : <a href="http://commerceone.biz.daum.net/join/intro.daum" target="_blank"><u>http://commerceone.biz.daum.net/join/intro.daum</u></a></li>
                        <li>전체상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/daum.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/daum.php</u></a></li>
                        <li>요약상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/daum_summary.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/daum_summary.php</u></a></li>
                    </ul>
                </div>
            </fieldset>
        </div>
    </div>
</div>