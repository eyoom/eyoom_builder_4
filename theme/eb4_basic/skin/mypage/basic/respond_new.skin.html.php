<?php
/**
 * skin file : /theme/THEME_NAME/skin/mypage/basic/respond_new.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<?php if ( isset($respond_new) && is_array($respond_new) ) { ?>
<style>
.my-respond {position:relative;padding:15px;border:1px solid #e5e5e5;margin-bottom:30px}
.my-respond .timeline {padding:10px 0;list-style:none;position:relative;font-size:12px;background:#fff}
.my-respond .timeline > li{position:relative}
.my-respond .timeline:before {position:absolute;top:0;bottom:0;left:10px;width:1px;content:"";background:#e5e5e5}
.my-respond .timeline > li .timeline-date {width:90px;display:block;position:absolute;padding-right:10px}
.my-respond .timeline > li .timeline-date span {color:#959595;font-size:12px;top:22px;display:block;text-align:right;position:relative}
.my-respond .timeline > li .timeline-date span:first-child {line-height:0.9}
.my-respond .timeline > li .timeline-date span:last-child {font-weight:bold;font-size:26px;color:#454545}
.my-respond .timeline > li .timeline-content {padding:15px 20px;background:#F8F8F8;clear:both;position:relative;margin:0 0 20px 100px}
.my-respond .timeline > li .timeline-content li {padding:0}
.my-respond .timeline > li .timeline-content h4 {margin-top:0px;font-size:12px;padding:0 0 10px;margin-bottom:10px;border-bottom:1px dotted #d5d5d5;color:#000}
.my-respond .timeline > li .timeline-content .t-left {float:left}
.my-respond .timeline > li .timeline-content:after {right:100%;border:solid transparent;content:"";height:0;width:0;position:absolute;pointer-events:none;border-right-color:#F8F8F8;border-width:8px;top:18px}
.my-respond .timeline > li .timeline-icon {top:22px;left:5px;width:10px;height:10px;position:absolute;background:#FF4848;margin:0;box-shadow:0 0 0 3px #e5e5e5;-webkit-font-smoothing:antialiased}
.my-respond .timeline > li .timeline-photo {position: absolute;top:46px;left:15px;width:38px}
.my-respond .timeline > li .timeline-photo img {height:30px;width:30px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;background-color:#fff;background-size:cover}
.my-respond .timeline > li .timeline-photo i {height:30px;width:30px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;text-align:center;line-height:30px;background:#959595;color:#fff;font-size:15px}
.my-respond .timeline > li .timeline-mention {margin-left:35px}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media screen and (max-width: 767px) {
    .my-respond .timeline:before {display:none}
    .my-respond .timeline > li .timeline-date {width:100%;display:block;position:relative;overflow:hidden;padding:0 0 25px 0}
    .my-respond .timeline > li .timeline-date span {text-align:left}
    .my-respond .timeline > li .timeline-date span:last-child {margin-left:15px}
    .my-respond .timeline > li .timeline-content {padding:1em;font-weight:400;margin:0}
    .my-respond .timeline > li .timeline-content:after {left:22px;top:-16px;right:auto;border-bottom-color:#f3f3f3;border-right-color:transparent}
    .my-respond .timeline > li .timeline-icon {left:auto;float:right;position:relative;margin:-55px 5px 0 0px}
    .my-respond .timeline > li .timeline-mention {margin-left:45px}
}
<?php } ?>
</style>

<div class="my-respond">
    <blockquote class="hero">
    	<p>내글 반응</p>
    </blockquote>
    <ul class="timeline">
        <?php for ($i=0; $i<count((array)$respond_new); $i++) {?>
        <li>
            <div class="timeline-date helvetica-neue"><span><?php echo $eb->date_format('Y.m',$respond_new[$i]['datetime']); ?></span> <span><?php echo $eb->date_format('d',$respond_new[$i]['datetime']); ?></span></div>
            <i class="timeline-icon rounded-x hidden-xs"></i>
            <div class="timeline-content">
                <h4 class="ellipsis"><strong class="color-indigo"><?php echo $eb->date_time('H:i',$respond_new[$i]['datetime']); ?></strong> - <a href="<?php echo $respond_new[$i]['href']; ?>"><strong><?php echo stripslashes($respond_new[$i]['wr_subject']); ?></strong></a></h4>
                <div class="timeline-photo">
                    <?php echo $respond_new[$i]['mb_photo'] ? $respond_new[$i]['mb_photo']: '<i class="fas fa-user"></i>'; ?>
                </div>
                <div class="timeline-mention">
                    <p class="color-grey"><?php echo $respond_new[$i]['mention']; ?></p>
                    <p class="font-size-11 text-right margin-bottom-0">
                        <i class="fas fa-info-circle"></i> <?php echo $respond_new[$i]['type']; ?>
                        <?php if ($respond_new[$i]['chk'] == 1) { ?>
                        <span class="read margin-left-5"><i class="fas fa-eye"></i> 읽음</span>
                        <?php } else { ?>
                        <span class="noread margin-left-5 color-red"><i class="fa fa-eye-slash"></i> 읽지않음</span>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </li>
        <?php } ?>
        <?php if ( count((array)$respond_new)==0 ) { ?>
        <div class="text-center margin-top-20 margin-bottom-20 color-grey font-size-13">
            <i class="fa fa-exclamation-circle"></i> 읽지 않은 내글 반응이 없습니다.
        </div>
        <?php } ?>
    </ul>
    <div class="text-center margin-bottom-30">
        <a href="<?php echo G5_URL; ?>/mypage/respond.php" class="btn-e btn-e-lg btn-e-dark">내글반응 전체보기</a>
    </div>
</div>
<?php } ?>