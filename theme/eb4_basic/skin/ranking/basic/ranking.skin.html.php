<?php
/**
 * skin file : /theme/THEME_NAME/skin/ranking/basic/ranking.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.ranking-box {position:relative;margin:0 0 30px}
.ranking-box .nav-tabs {border:1px solid #e5e5e5;border-bottom:0;margin-bottom:0}
.ranking-box .nav-tabs li {width:33.33333%}
.ranking-box .nav-tabs li a {display:block;text-align:center;margin-right:0;margin-left:-1px;background:#f5f5f5;color:#959595;border:1px solid #e5e5e5;padding:8px 5px;font-size:.9375rem;border-top:0}
.ranking-box .nav-tabs li:first-child a {margin-left:0;border-left:0}
.ranking-box .nav-tabs li:last-child a {border-right:0}
.ranking-box .nav-tabs li a:hover {background:#fff;border-bottom:1px solid #e5e5e5}
.ranking-box .nav-tabs li a.active {z-index:1;background:#fff;color:#000;border-bottom:1px solid transparent}
.ranking-box .tab-content {position:relative;border:1px solid #e5e5e5;border-top:0;padding:10px;background:#fff;-webkit-border-radius:0 0 3px 3px !important;-moz-border-radius:0 0 3px 3px !important;border-radius:0 0 3px 3px !important}
.ranking-content ul {margin-bottom:0}
.ranking-content li {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.ranking-content li:last-child {border-bottom:0}
.ranking-content .ranking-num {position:absolute;top:0;left:0;display:block;width:18px;height:18px;line-height:18px;background:#4B4B4D;text-align:center;color:#fff;font-size:10px;margin-right:5px;border-radius:50%}
.ranking-content .ranking-num-1 {background:#ab0000}
.ranking-content .ranking-num-2 {background:#f4511e}
.ranking-content .ranking-num-3 {background:#f4511e}
.ranking-content .ranking-photo img {width:17px;height:17px;display:inline-block}
.ranking-content .ranking-photo .ranking-user-icon {color:#959595}
.ranking-content .float-start {position:relative;padding-left:25px}
.ranking-content .float-end {text-align:right;color:#f4511e}
.ranking-content .ranking-lv-icon {display:inline-block;margin-left:2px}
</style>

<div class="ranking-box">
    <ul class="nav nav-tabs eb-ranking-tabs">
        <li><a href="#rank-1" data-bs-toggle="tab" class="active">오늘<?php echo $levelset['gnu_name']; ?></a></li>
        <li><a href="#rank-2" data-bs-toggle="tab">전체<?php echo $levelset['gnu_name']; ?></a></li>
        <li><a href="#rank-3" data-bs-toggle="tab"><?php echo $levelset['eyoom_name'] ? $levelset['eyoom_name']: '경험치'; ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active in" id="rank-1">
            <div class="ranking-content">
                <ul class="list-unstyled">
                    <?php foreach ($ranking['today'] as $key => $rankinfo) { ?>
                    <li>
                        <div class="width-60 float-start ellipsis">
                            <span class="ranking-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                            <span class="ranking-photo">
                                <?php if ($rankinfo['mb_photo']) { ?>
                                <?php echo $rankinfo['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="ranking-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php echo $rankinfo['mb_nick']; ?>
                            <?php if ($rankinfo['eyoom_icon']) { ?>
                            <span class="ranking-lv-icon"><img src="<?php echo $rankinfo['eyoom_icon']; ?>" alt="레벨"></span>
                            <?php } ?>
                        </div>
                        <div class="width-40 float-end text-end">
                            <?php echo number_format($rankinfo['po_point']); ?>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php } ?>
                    <?php if (count((array)$ranking['today']) == 0) { ?>
                    <p class="text-center text-gray m-t-20 m-b-20"><i class="fas fa-exclamation-circle"></i> 출력할 랭킹이 없습니다.</p>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="tab-pane in" id="rank-2">
            <div class="ranking-content">
                <ul class="list-unstyled">
                    <?php foreach ($ranking['total'] as $key => $rankinfo) { ?>
                    <li>
                        <div class="width-60 float-start ellipsis">
                            <span class="ranking-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                            <span class="ranking-photo">
                                <?php if ($rankinfo['mb_photo']) { ?>
                                <?php echo $rankinfo['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="ranking-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php echo $rankinfo['mb_nick']; ?>
                            <?php if ($rankinfo['eyoom_icon']) { ?>
                            <span class="ranking-lv-icon"><img src="<?php echo $rankinfo['eyoom_icon']; ?>" alt="레벨"></span>
                            <?php } ?>
                        </div>
                        <div class="width-40 float-end text-end">
                            <?php echo number_format($rankinfo['mb_point']); ?>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php } ?>
                    <?php if (count((array)$ranking['total']) == 0) { ?>
                    <p class="text-center text-gray m-t-20 m-b-20"><i class="fas fa-exclamation-circle"></i> 출력할 랭킹이 없습니다.</p>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="tab-pane in" id="rank-3">
            <div class="ranking-content">
                <ul class="list-unstyled">
                    <?php foreach ($ranking['level'] as $key => $rankinfo) { ?>
                    <li>
                        <div class="width-60 float-start ellipsis">
                            <span class="ranking-num <?php if ($key <= 2) { ?>ranking-num-<?php echo $key+1; } ?>"><?php echo $key+1; ?></span>
                            <span class="ranking-photo">
                                <?php if ($rankinfo['mb_photo']) { ?>
                                <?php echo $rankinfo['mb_photo']; ?>
                                <?php } else { ?>
                                <span class="ranking-user-icon"><i class="far fa-user-circle"></i></span>
                                <?php } ?>
                            </span>
                            <?php echo $rankinfo['mb_nick']; ?>
                            <?php if ($rankinfo['eyoom_icon']) { ?>
                            <span class="ranking-lv-icon"><img src="<?php echo $rankinfo['eyoom_icon']; ?>" alt="레벨"></span>
                            <?php } ?>
                        </div>
                        <div class="width-40 float-end text-end">
                            <?php echo number_format($rankinfo['point']); ?>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <?php } ?>
                    <?php if (count((array)$ranking['level']) == 0) { ?>
                    <p class="text-center text-gray m-t-20 m-b-20"><i class="fas fa-exclamation-circle"></i> 출력할 랭킹이 없습니다.</p>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.eb-ranking-tabs li a').hover(function (e) {
        e.preventDefault()
        $(this).tab('show');
    });
});
</script>