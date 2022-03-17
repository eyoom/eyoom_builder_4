<?php
/**
 * skin file : /theme/THEME_NAME/skin/paging/basic/paging.skin.php
 */
if (!defined('_EYOOM_')) exit;
?>
<style>
.eb-pagination-wrap {position:relative;text-align:center;padding:7px;margin-top:30px}
.eb-pagination {position:relative;list-style:none;display:inline-block;padding:0;margin:0}
.eb-pagination li {display:inline}
.eb-pagination a {display:inline-block;font-size:.8125rem;text-decoration:none;min-width:30px;height:30px;padding:0 5px;border:1px solid #dadada;line-height:28px;text-align:center;color:#757575;position:relative;z-index:1}
.eb-pagination a:active {outline:none}
.eb-pagination a:hover {color:#000;background:#eaeaea}
.eb-pagination a.active {cursor:default;background:#2b2b2e;color:#fff;border:0}
.eb-pagination a.active:hover {color:#fff;background:#2b2b2e}
.eb-pagination a.next,.eb-pagination a.prev {color:#959595}
.eb-pagination a.next:hover,.eb-pagination a.prev:hover {color:#000}
</style>

<div class="eb-pagination-wrap">
    <ul class="eb-pagination">
        <li><a href="<?php echo $first_page; ?>"><i class="fas fa-angle-double-left"></i></a></li>
        <li><a href="<?php echo $prev_page; ?>" class="prev"><i class="fas fa-angle-left"></i></a></li>
        <?php for ($i=0; $i<$pg_cnt; $i++) { ?>
        <li><a href="<?php echo $pg_str[$i]['url']; ?>" <?php if ($pg_str[$i]['on']) echo 'class="active"'; ?>><?php echo $pg_str[$i]['page']; ?><span class="sound_only">페이지</span></a></li>
        <?php  } ?>
        <?php if (!$pg_cnt) { ?>
        <li><a href="<?php echo $pg_url . 1 . $add; ?>" class="active">1<span class="sound_only">페이지</span></a></li>
        <?php } ?>
        <li><a href="<?php echo $next_page; ?>" class="next"><i class="fas fa-angle-right"></i></a></li>
        <li><a href="<?php echo $last_page; ?>"><i class="fas fa-angle-double-right"></i></a></li>
    </ul>
</div>