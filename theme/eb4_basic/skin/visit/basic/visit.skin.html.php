<?php
/**
 * skin file : /theme/THEME_NAME/skin/visit/basic/visit.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.statistics-wrap {position:relative;border:1px solid #e5e5e5;padding:15px 10px;margin:0;background:#fff}
.statistics-wrap ul {margin-bottom:0}
.statistics-list li {color:#555555;padding:6px 0;display:block;border-top:1px dotted #e5e5e5}
.statistics-list li:first-child {border-top:none}
.statistics-list li a {color:#000;display:block}
.statistics-list li strong {color:#353535;float:right;font-weight:400}
</style>

<div class="statistics-wrap">
    <div class="headline-short">
        <h5>사이트 통계</h5>
    </div>
    <ul class="list-unstyled statistics-list">
        <li><?php echo eb_connect($eyoom['connect_skin']); ?></li>
        <li>오늘방문자 : <strong><?php echo $counter['visit_today']; ?></strong></li>
        <li>어제방문자 : <strong><?php echo $counter['visit_yesterday']; ?></strong></li>
        <li>최대방문자 : <strong><?php echo $counter['visit_max']; ?></strong></li>
        <li>전체방문자 : <strong><?php echo $counter['visit_total']; ?></strong></li>
        <li>신규회원수 : <strong><?php echo $counter['newby']; ?></strong></li>
        <li>전체회원수 : <strong><?php echo $counter['members']; ?></strong></li>
        <li>전체게시물 : <strong><?php echo $counter['write']; ?></strong></li>
        <li>전체코멘트 : <strong><?php echo $counter['comment']; ?></strong></li>
    </ul>
</div>