<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/respond_new.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ( isset($respond_new) && is_array($respond_new) ) { ?>
<style>
.my-respond {position:relative;font-size:.9375rem;margin-bottom:30px}
.my-respond .timeline {padding:10px 0;list-style:none;position:relative}
.my-respond .timeline > li{position:relative}
.my-respond .timeline:before {position:absolute;top:0;bottom:0;left:10px;width:1px;content:"";background:#d5d5d5}
.my-respond .timeline > li .timeline-date {position:absolute;width:100px;display:block;padding-right:10px}
.my-respond .timeline > li .timeline-date span {position:relative;color:#757575;top:20px;display:block;text-align:right}
.my-respond .timeline > li .timeline-date span:first-child {line-height:1}
.my-respond .timeline > li .timeline-date span:last-child {font-weight:700;font-size:1.625rem;color:#454545}
.my-respond .timeline > li .timeline-content {position:relative;padding:15px 20px;border:1px solid #d5d5d5;margin:0 0 30px 110px}
.my-respond .timeline > li .timeline-content li {padding:0}
.my-respond .timeline > li .timeline-content h6 {margin-bottom:10px;font-size:.9375rem;line-height:1.5}
.my-respond .timeline > li .timeline-content h6 a {color:#000}
.my-respond .timeline > li .timeline-content:before {content:"";width:0px;height:0px;position:absolute;border-left:8px solid transparent;border-right:8px solid #c5c5c5;border-top:8px solid transparent;border-bottom:8px solid transparent;left:-16px;top:30px}
.my-respond .timeline > li .timeline-content:after {content:"";width:0px;height:0px;position:absolute;border-left:8px solid transparent;border-right:8px solid #fff;border-top:8px solid transparent;border-bottom:8px solid transparent;left:-15px;top:30px}
.my-respond .timeline > li .timeline-content:hover h6 a {text-decoration:underline}
.my-respond .timeline > li .timeline-icon {top:21px;left:3px;width:14px;height:14px;position:absolute;background:#ab0000;margin:0;border:2px solid #fff;box-shadow:0 0 0 1px #b5b5b5;border-radius:50%}
.my-respond .timeline > li .timeline-mention .mention-photo {display:inline-block;margin-right:2px}
.my-respond .timeline > li .timeline-mention .mention-photo img {width:17px;height:17px;border-radius:50%}
@media (max-width:576px) {
    .my-respond .timeline > li .timeline-date {width:80px;padding-right:3px}
    .my-respond .timeline > li .timeline-date span {font-size:.8125rem}
    .my-respond .timeline > li .timeline-date span:last-child {font-size:1.4375rem}
    .my-respond .timeline > li .timeline-content {margin:0 0 30px 90px}
    .my-respond .timeline > li .timeline-icon {top:20px}
}
</style>

<div class="my-respond">
    <div class="m-b-20">
        <h4><strong>내글 반응</strong></h4>
    </div>
    <ul class="timeline">
        <?php for ($i=0; $i<count((array)$respond_new); $i++) {?>
        <li>
            <div class="timeline-date"><span><?php echo $eb->date_format('Y.m',$respond_new[$i]['datetime']); ?></span> <span><?php echo $eb->date_format('d',$respond_new[$i]['datetime']); ?></span></div>
            <i class="timeline-icon"></i>
            <div class="timeline-content">
                <h6><span class="text-indigo"><?php echo $eb->date_time('H:i',$respond_new[$i]['datetime']); ?></span> - <a href="<?php echo $respond_new[$i]['href']; ?>"><span><?php echo stripslashes($respond_new[$i]['wr_subject']); ?></span></a></h6>
                <div class="timeline-mention">
                    <p class="text-gray">
                        <span class="mention-photo"><?php echo $respond_new[$i]['mb_photo'] ? $respond_new[$i]['mb_photo']: '<i class="far fa-user-circle"></i>'; ?></span>
                        <?php echo $respond_new[$i]['mention']; ?>
                    </p>
                    <?php if(0) { // 숨김처리 ?>
                    <p class="text-end">[<?php echo $respond_new[$i]['type']; ?>]</p>
                    <?php } ?>
                </div>
            </div>
        </li>
        <?php } ?>
        <?php if ( count((array)$respond_new)==0 ) { ?>
        <div class="text-center m-t-20 m-b-20 text-gray f-s-13r">
            <i class="fas fa-exclamation-circle"></i> 읽지 않은 내글 반응이 없습니다.
        </div>
        <?php } ?>
    </ul>
    <div class="text-center">
        <a href="<?php echo G5_URL; ?>/mypage/respond.php" class="btn-e btn-e-xl btn-e-brd btn-e-dark">내글반응 전체보기<i class="fas fa-external-link-alt m-l-8"></i></a>
    </div>
</div>
<?php } ?>