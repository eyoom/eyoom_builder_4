<?php
/**
 * page file : /theme/THEME_NAME/page/taglist.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.tag-list {position:relative;margin-bottom:40px}
.tag-list .tag-word {display:inline-block;padding:2px 10px;line-height:1;-webkit-transition:all 0.1s ease-in-out;-moz-transition:all 0.1s ease-in-out;-o-transition:all 0.1s ease-in-out;transition:all 0.1s ease-in-out;border-radius:2px !important;background:#f5f5f5;margin:2px;font-size:12px}
.tag-list .tag-word:hover {background:#d5d5d5}
.tag-list .font-kind-10 {font-size:20px;color:#FF2900}
.tag-list .font-kind-9 {font-size:19px;color:#4052B5}
.tag-list .font-kind-8 {font-size:18px;color:#009687}
.tag-list .font-kind-7 {font-size:17px;color:#663BB8}
.tag-list .font-kind-6 {font-size:16px;color:#FF9500}
.tag-list .font-kind-5 {font-size:15px;color:#87BA00}
.tag-list .font-kind-4 {font-size:14px;color:#0078FF}
.tag-list .font-kind-3 {font-size:13px;color:#2E3340}
.tag-list .font-kind-2 {font-size:12px;color:#757575}
.tag-list .font-kind-1 {font-size:11px;color:#B5B5B5}
</style>

<div class="margin-bottom-20 font-size-12 color-grey">
    <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo number_format($page); ?> 페이지</u>
</div>
<div class="tag-list">
    <?php for ($i=0; count((array)$list); $i++) { ?>
    <a href="<?php echo $list[$i]['href']; ?>"><span class="tag-word"><span class="font-kind-<?php echo $list[$i]['weight']; ?>"><?php echo $list[$i]['tag']; ?></span></span></a>
    <?php } ?>
</div>

<?php echo eb_paging($eyoom['paging_skin']);?>