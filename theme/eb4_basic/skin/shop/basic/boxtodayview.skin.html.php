<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/boxtodayview.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<div id="stv" class="op-area">
    <h2>오늘 본 상품</h2>

    <?php if ($tv_list) { ?>
    <ul id="stv_ul" class="list-unstyled">
        <?php if (is_array($tv_list)) { ?>
        <?php foreach ($tv_list as $info) { ?>
        <li class="stv-item c<?php echo $info['k']; ?>">
            <div class="prd-img"><?php echo $info['img']; ?></div>
            <div class="prd-name"><?php echo cut_str($info['it_name'], 10, ''); ?></div>
            <div class="prd-cost">₩ <?php echo $info['price']; ?></div>
        </li>
        <?php } ?>
        <?php } ?>
    </ul>

    <div id="stv_btn"></div>
    <span id="stv_pg"></span>

    <script>
    $(function() {
        var itemQty = <?php echo $tv_tot_count; ?>; // 총 아이템 수량
        var itemShow = <?php echo $tv_div['img_length']; ?>; // 한번에 보여줄 아이템 수량
        if (itemQty > itemShow) {
            $('#stv_btn').append('<button type="button" id="up"><i class="fas fa-angle-left"></i><span>이전</span></button><button type="button" id="down"><span>다음</span><i class="fas fa-angle-right"></i></button>');
        }
        var Flag = 1; // 페이지
        var EOFlag = parseInt(<?php echo $cnt-1; ?>/itemShow); // 전체 리스트를 3(한 번에 보여줄 값)으로 나눠 페이지 최댓값을 구하고
        var itemRest = parseInt(<?php echo $cnt-1; ?>%itemShow); // 나머지 값을 구한 후
        if (itemRest > 0) // 나머지 값이 있다면
        {
            EOFlag++; // 페이지 최댓값을 1 증가시킨다.
        }
        $('.c'+Flag).css('display','block');
        $('#stv_pg').text(Flag+'/'+EOFlag); // 페이지 초기 출력값
        $('#up').click(function() {
            if (Flag == 1)
            {
                alert('목록의 처음입니다.');
            } else {
                Flag--;
                $('.c'+Flag).css('display','block');
                $('.c'+(Flag+1)).css('display','none');
            }
            $('#stv_pg').text(Flag+'/'+EOFlag); // 페이지 값 재설정
        })
        $('#down').click(function() {
            if (Flag == EOFlag)
            {
                alert('더 이상 목록이 없습니다.');
            } else {
                Flag++;
                $('.c'+Flag).css('display','block');
                $('.c'+(Flag-1)).css('display','none');
            }
            $('#stv_pg').text(Flag+'/'+EOFlag); // 페이지 값 재설정
        });
    });
    </script>

    <?php } else { // 오늘 본 상품이 없을 때?>
    <p class="li-empty">해당내용 없음</p>
    <?php } ?>

</div>

<script src="<?php echo G5_JS_URL ?>/scroll_oldie.js"></script>