<?php
/**
 * skin file : /theme/THEME_NAME/skin/tag/basic/list.skin.html.php
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

<form name="ftag" method="get" action="" onsubmit="return ftag_search(this);" class="eyoom-form">
    <div class="row">
        <div class="col-lg-4">
            <div class="input input-button">
                <input type="text" name="stx" id="stx" value="<?php echo $stx; ?>">
                <div class="button"><input type="submit" value="검색">검색</div>
            </div>
        </div>
    </div>

    <div class="tag-list-tab m-b-20">
        <ul class="list-inline">
            <?php for ($i=0; $i<count((array)$fccate); $i++) { ?>
            <li class="<?php echo $sca == $fccate[$i]['fccate_no'] ? 'active': '';?>"><a href="javascript:;" onclick="set_fccate('<?php echo $fccate[$i]['fccate_no']; ?>');" class="btn-e btn-e-xs btn-e-<?php echo $sca == $fccate[$i]['fccate_no'] ? 'crimson': 'dark';?>"><?php echo $fccate[$i]['fccate_name']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
</form>

<div class="m-b-20 text-gray">
    <u>전체 <?php echo number_format($total_count); ?> 건 - <?php echo $page; ?> 페이지</u>
</div>

<div class="tag-list">
    <?php for ($i=0; $i<count((array)$list); $i++) { ?>
    <a href="<?php echo $list[$i]['href']; ?>"><span class="tag-word"><span class="font-kind-<?php echo $list[$i]['weight']; ?>"><?php echo $list[$i]['tag']; ?></span></span></a>
    <?php } ?>
</div>

<?php /* 페이지 */ ?>
<?php echo eb_paging($eyoom['paging_skin']);?>

<script>
function ftag_search(f) {
    if (f.stx.value == '') {
        alert("검색 태그명을 입력해 주세요.");
        f.stx.focus();
        return false;
    }
}
</script>