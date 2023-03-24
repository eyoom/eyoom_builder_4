<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/shopetc/price.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'price';
$g5_title = '가격비교사이트';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">쇼핑몰현황/기타</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<div class="admin-shop-price">
    <div class="adm-form-table m-b-20">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>가격비교사이트 연동 안내</strong></div>
        <div class="adm-form-cont">
            <p class="li-p-sq">가격비교사이트는 네이버 지식쇼핑, 다음 쇼핑하우 등이 있습니다.</p>
            <p class="li-p-sq">앞서 나열한 가격비교사이트 중 희망하시는 사이트에 입점합니다.</p>
            <p class="li-p-sq"><strong class="text-crimson">사이트별 엔진페이지 URL</strong>을 참고하여 해당 엔진페이지 URL 을 입점하신 사이트에 알려주시면 됩니다.</p>
        </div>
    </div>

    <div class="adm-form-table">
        <div class="adm-form-header"><strong><i class="las la-caret-right m-r-10"></i>사이트별 엔진페이지 URL</strong></div>
        <div class="adm-form-info">
            <div class="cont-text-bg">
                <p class="bg-info">
                    <i class="fas fa-info-circle"></i> 사이트 명을 클릭하시면 해당 사이트로 이동합니다.
                </p>
            </div>
        </div>
        <div class="adm-form-cont">
            <h6 class="m-b-10"><a href="http://shopping.naver.com/" target="_blank"><strong>네이버쇼핑</strong></a></h6>
            <p class="li-p-sq">입점 안내 : <a href="http://join.shopping.naver.com/join/intro.nhn" target="_blank"><u>http://join.shopping.naver.com/join/intro.nhn</u></a></p>
            <p class="li-p-sq">전체상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/naver.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/naver.php</u></a></p>
            <p class="li-p-sq m-b-20">요약상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/naver_summary.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/naver_summary.php</u></a></p>

            <h6 class="m-b-10"><a href="https://shopping.google.co.kr/" target="_blank"><strong>구글쇼핑</strong></a></h6>
            <p class="li-p-sq">구글 Merchant Center : <a href="https://www.google.com/intl/ko_kr/retail/solutions/merchant-center" target="_blank"><u>https://www.google.com/intl/ko_kr/retail/solutions/merchant-center</u></a></p>
            <p class="li-p-sq">파일 이름 : google_feed.php</p>
            <p class="li-p-sq m-b-20">파일 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/google_feed.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/google_feed.php</u></a></p>

            <h6 class="m-b-10"><strong>피드설명</strong></h6>
            <p class="li-p-sq">판매국가 <b>대한민국</b>, 언어 <b>한국어</b> 설정 기준입니다.</p>
            <p class="li-p-sq">기본 피드 이름 : 쇼핑몰피드</p>
            <p class="li-p-sq m-b-20">상품 설명 : <b>it_basic</b> (상품기본설명을 필수 입력해주세요. HTML 태그는 자동 제거됩니다.)</p>

            <h6 class="m-b-10"><a href="http://shopping.daum.net/" target="_blank"><strong>다음 쇼핑하우</strong></a></h6>
            <p class="li-p-sq">입점 안내 : <a href="https://shopping.biz.daum.net/join/main" target="_blank"><u>https://shopping.biz.daum.net/join/main</u></a></p>
            <p class="li-p-sq">전체상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/daum.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/daum.php</u></a></p>
            <p class="li-p-sq">요약상품 URL : <a href="<?php echo G5_SHOP_URL; ?>/price/daum_summary.php" target="_blank"><u><?php echo G5_SHOP_URL; ?>/price/daum_summary.php</u></a></p>
        </div>
    </div>
</div>