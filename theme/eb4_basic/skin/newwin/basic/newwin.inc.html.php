<?php
/**
 * skin file : /theme/THEME_NAME/skin/newwin/basic/newwin.inc.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/slick/slick.min.css" type="text/css">',0);
?>

<?php if (is_array($newwin)) { ?>
<style>
#hd_pop {z-index:9999}
#hd_pop .slick-next, #hd_pop .slick-prev {width:20px;height:100%;background:#fff}
#hd_pop .slick-next:hover, #hd_pop .slick-prev:hover {background:#f2f2f2}
#hd_pop .slick-next {right:-25px}
#hd_pop .slick-prev {left:-25px}
#hd_pop .slick-next:before, #hd_pop .slick-prev:before {font-family:'Font Awesome\ 5 Free';font-weight:900;color:#000;font-size:16px}
#hd_pop .slick-next:before {content:"\f054"}
#hd_pop .slick-prev:before {content:"\f053"}
.modal-dialog {display:none}
.modal-dialog .hd-pops-content {display:none;position:relative;margin:10px 20px 20px}
.modal-dialog .hd-pops-list {position:relative;overflow:hidden;outline:none}
.modal-dialog .hd-pops-list img {display:block;max-width:100%;height:auto}
</style>

<div id="hd_pop">
    <div id="modal_hd_pop" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="hd-pops-content">
                        <?php foreach ($newwin as $k => $popup) { 
                            if ($k==0) $nw_disable_hours = $popup['nw_disable_hours']; 
                        ?>
                        <div id="hd_pops_list" class="hd-pops-list">
                            <?php echo conv_content(($popup['nw_content']), 1); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="hd_pops_reject btn-e btn-e-dark" data-bs-dismiss="modal"><?php echo $nw_disable_hours; ?>시간 동안 열지 않기</button>
                    <button type="button" class="btn-e btn-e-dark" data-bs-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/slick/slick.min.js"></script>
<script>
$(function() {
    setTimeout(function(){
        $('#modal_hd_pop').modal('show').on('shown.bs.modal', function() {
            $('html').css({overflow: 'hidden'});
            $('.modal-dialog').css("display", "block");
            $('.hd-pops-content').css("display", "block");
            $('.hd-pops-content').slick({
                infinite: true,
                autoplay: true,
                autoplaySpeed: 10000,
                dots: true,
                arrows: true
            });
        });
    }, 1000);

    $('#modal_hd_pop').on('hidden.bs.modal', function() {
        $('html').css({overflow: ''});
    });
});

$(function() {
    $(".hd_pops_reject").click(function() {
        var ck_name = 'hd_pops_list';
        var nw_disable_hours = '<?php echo $nw_disable_hours; ?>';
        var exp_time = parseInt(nw_disable_hours);
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
    });
});
</script>
<?php } ?>