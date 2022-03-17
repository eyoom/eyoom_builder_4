<?php
/**
 * skin file : /theme/THEME_NAME/skin/popular/basic/popular.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.popular-box {position:relative;border:1px solid #e5e5e5;padding:15px 10px;margin:0px 0 30px;background:#fff}
.popular ul {margin-bottom:0}
.popular li {float:left;margin:0 3px}
.popular li .popular-word {background:#e5e5e5;padding:2px 5px;color:#252525;font-size:.875rem;margin-bottom:5px;display:inline-block;line-height:1}
.popular li .popular-word:hover {background:#d5d5d5}
</style>

<div class="popular-box">
    <div class="headline-short">
        <h5>인기검색어</h5>
    </div>
    <div class="popular">
        <ul class="list-unstyled">
            <?php for ($i=0; $i<count((array)$popular); $i++) { ?>
            <li>
                <a href="<?php echo G5_BBS_URL; ?>/search.php?sfl=wr_subject&amp;sop=and&amp;stx=<?php echo urlencode($popular[$i]['pp_word']); ?>" class="popular-word">
                    <span><?php echo $i+1; ?>. <?php echo $popular[$i]['pp_word']; ?></span>
                </a>
            </li>
            <?php } ?>
            <?php if (count((array)$popular) == 0) { ?>
            <p class="text-center text-gray"><i class="fas fa-exclamation-circle"></i> 출력할 인기검색어가 없습니다.</p>
            <?php } ?>
            <div class="clearfix"></div>
        </ul>
    </div>
</div>