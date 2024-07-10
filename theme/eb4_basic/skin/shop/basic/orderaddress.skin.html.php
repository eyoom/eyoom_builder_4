<?php
/**
 * skin file : /theme/THEME_NAME/skin/shop/basic/orderaddress.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.shop-order-adress {position:relative;padding:15px}
.shop-order-adress .win-title {position:relative;margin:0 0 20px;font-size:1.0625rem;height:60px;line-height:30px;padding:15px 10px;background:#353535;color:#fff}
.shop-order-adress .btn-close {position:absolute;top:19px;right:10px}
.shop-order-adress .eyoom-form .checkbox {position:absolute;top:0;left:0}
.shop-order-adress .eyoom-form .input {margin-bottom:0}
</style>

<div class="shop-order-adress">
    <h4 class="win-title">
        배송지 목록
        <button type="button" class="btn-close btn-close-white" onclick="self.close();" aria-label="Close"></button>
    </h4>
    <form name="forderaddress" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off" class="eyoom-form">
    <div class="order-adress-wrap">
        <?php if (G5_IS_MOBILE) { ?>
        <p class="text-end f-s-13r m-b-5 text-gray">Note! 좌우 스크롤 (<i class="fas fa-arrows-alt-h"></i>)</p>
        <?php } ?>
        <div class="table-list-eb">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>배송지명</th>
                            <th class="tbd-both">이름</th>
                            <th>배송지정보</th>
                            <th class="tbd-l">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i=0; $i<$count; $i++) { ?>
                        <tr>
                            <td class="position-relative">
                                <input type="hidden" name="ad_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['ad_id'];?>">
                                <label for="chk_<?php echo $i;?>" class="sound_only">배송지선택</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="chk[]" value="<?php echo $i;?>" id="chk_<?php echo $i;?>"><i></i>
                                </label>
                                <label for="ad_subject<?php echo $i;?>" class="sound_only">배송지명</label>
                                <label class="input width-100px">
                                    <input type="text" name="ad_subject[<?php echo $i; ?>]" id="ad_subject<?php echo $i;?>" size="12" maxlength="20" value="<?php echo get_text($list[$i]['ad_subject']); ?>">
                                </label>
                                <div class="clearfix"></div>
                            </td>

                            <td class="tbd-both text-center"><?php echo get_text($list[$i]['ad_name']); ?></td>
                            <td>
                                <?php echo print_address($list[$i]['ad_addr1'], $list[$i]['ad_addr2'], $list[$i]['ad_addr3'], $list[$i]['ad_jibeon']); ?><br>
                                <span class="text-gray"><?php echo $list[$i]['ad_tel']; ?> / <?php echo $list[$i]['ad_hp']; ?></span>
                            </td>
                            <td class="tbd-l">
                                <input type="hidden" value="<?php echo $list[$i]['addr']; ?>" >
                                <button type="button" class="sel_address btn-e btn-e-crimson btn-e-block m-b-10">선택</button>
                                <a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?w=d&amp;ad_id=<?php echo $list[$i]['ad_id']; ?>" class="del_address btn-e btn-e-dark btn-e-block m-b-10">삭제</a>
                                <label class="radio"><input type="radio" name="ad_default" value="<?php echo $list[$i]['ad_id'];?>" id="ad_default<?php echo $i;?>" <?php if($list[$i]['ad_default']) echo 'checked="checked"';?>><i></i>기본배송지</label>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center">
        <input type="submit" name="act_button" value="선택수정" class="btn-e btn-e-lg btn-e-navy">
        <button type="button" onclick="self.close();" class="btn-e btn-e-lg btn-e-dark">닫기</button>
    </div>
    </form>

    <?php /* 페이지 */ ?>
    <?php echo eb_paging($eyoom['paging_skin']);?>
</div>

<script>
$(function() {
    $(".sel_address").on("click", function() {
        var addr = $(this).siblings("input").val().split(String.fromCharCode(30));

        var f = window.opener.forderform;
        f.od_b_name.value        = addr[0];
        f.od_b_tel.value         = addr[1];
        f.od_b_hp.value          = addr[2];
        f.od_b_zip.value         = addr[3] + addr[4];
        f.od_b_addr1.value       = addr[5];
        f.od_b_addr2.value       = addr[6];
        f.od_b_addr3.value       = addr[7];
        f.od_b_addr_jibeon.value = addr[8];
        f.ad_subject.value       = addr[9];

        var zip1 = addr[3].replace(/[^0-9]/g, "");
        var zip2 = addr[4].replace(/[^0-9]/g, "");

        if(zip1 != "" && zip2 != "") {
            var code = String(zip1) + String(zip2);

            if(window.opener.zipcode != code) {
                window.opener.zipcode = code;
                window.opener.calculate_sendcost(code);
            }
        }

        window.close();
    });

    $(".del_address").on("click", function() {
        return confirm("배송지 목록을 삭제하시겠습니까?");
    });

    // 전체선택 부분
    $("#chk_all").on("click", function() {
        if($(this).is(":checked")) {
            $("input[name^='chk[']").attr("checked", true);
        } else {
            $("input[name^='chk[']").attr("checked", false);
        }
    });

    $(".btn_submit").on("click", function() {
        if($("input[name^='chk[']:checked").length==0 ){
            alert("수정하실 항목을 하나 이상 선택하세요.");
            return false;
        }
    });

});

<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$is_iphone = (strpos($user_agent, 'iPhone') !== false);
$is_ipad = (strpos($user_agent, 'iPad') !== false);

if ($is_iphone || $is_ipad) {
?>
$(document).ready(function(){
    var touchStartTimestamp = 0;
    
    $("input, textarea, select").on('touchstart', function(event) {
        zoomDisable();
        touchStartTimestamp = event.timeStamp;
    });

    $("input, textarea, select").on('touchend', function(event) {
        var touchEndTimestamp = event.timeStamp;
        if (touchEndTimestamp - touchStartTimestamp > 500) {
            setTimeout(zoomEnable, 500);
        } else {
            zoomDisable();
            setTimeout(zoomEnable, 500);
        }
    });

    function zoomDisable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">');
    }

    function zoomEnable(){
        $('head meta[name=viewport]').remove();
        $('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=1">');
    }
});
<?php } ?>
</script>