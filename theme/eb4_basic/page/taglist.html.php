<?php
/**
 * page file : /theme/THEME_NAME/page/taglist.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.tag-list {position:relative;margin-bottom:40px}
.tag-list .tag-word {display:inline-block;padding:3px 10px;line-height:1;-webkit-transition:all 0.1s ease-in-out;-moz-transition:all 0.1s ease-in-out;-o-transition:all 0.1s ease-in-out;transition:all 0.1s ease-in-out;border-radius:2px !important;background:#f5f5f5;margin:2px;font-size:.8125rem}
.tag-list .tag-word:hover {background:#e5e5e5}
.tag-list .font-kind-10 {font-size:1.4375rem;color:#e53935}
.tag-list .font-kind-9 {font-size:1.375rem;color:#3949ab}
.tag-list .font-kind-8 {font-size:1.3125rem;color:#00897b}
.tag-list .font-kind-7 {font-size:1.25rem;color:#5e35b1}
.tag-list .font-kind-6 {font-size:1.1875rem;color:#fb8c00}
.tag-list .font-kind-5 {font-size:1.125rem;color:#43a047}
.tag-list .font-kind-4 {font-size:1.0625rem;color:#1e88e5}
.tag-list .font-kind-3 {font-size:1rem;color:#2E3340}
.tag-list .font-kind-2 {font-size:.9375rem;color:#757575}
.tag-list .font-kind-1 {font-size:.875rem;color:#B5B5B5}
</style>

<div class="m-b-20 text-gray">
    <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo number_format($page); ?> 페이지</u>
</div>
<div class="tag-list">
    <?php for ($i=0; count((array)$list); $i++) { ?>
    <a href="<?php echo $list[$i]['href']; ?>"><span class="tag-word"><span class="font-kind-<?php echo $list[$i]['weight']; ?>"><?php echo $list[$i]['tag']; ?></span></span></a>
    <?php } ?>
</div>

<?php echo eb_paging($eyoom['paging_skin']);?>