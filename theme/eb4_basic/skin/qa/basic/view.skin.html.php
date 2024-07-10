<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/view.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/prism/prism.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view {font-size:.9375rem}
.board-view .board-view-subj {font-size:1.25rem}
.board-view .board-view-info {position:relative;height:70px;border-top:2px solid #757575;border-bottom:1px solid #757575;padding:10px 0;margin-top:20px;background:#fafafa}
.board-view .board-view-info .view-photo-box {position:absolute;top:8px;left:0}
.board-view .board-view-info .view-info-box {position:relative;margin-left:60px}
.board-view .board-view-info .view-photo img {width:50px;height:50px;margin-right:3px;border-radius:50%}
.board-view .board-view-info .view-photo .view-user-icon {font-size:50px;margin-right:3px;line-height:1;color:#757575}
.board-view .board-view-info .info-box-top {display:block;margin:0 0 4px}
.board-view .board-view-info .info-box-top .view-nick {margin-right:3px}
.board-view .board-view-info .info-box-top .view-nick .sv_wrap > a {font-weight:700}
.board-view .board-view-info .info-box-top .view-lv-icon {display:inline-block;margin-right:3px}
.board-view .board-view-info .info-box-bottom {display:block}
.board-view .board-view-info .info-box-bottom span {margin-right:8px}
.board-view .board-view-info .info-box-bottom i {color:#a5a5a5;margin-right:5px}
.board-view .board-view-contact .contact-email {padding:8px 0;border-bottom:1px dotted #eaeaea}
.board-view .board-view-contact .contact-hp {padding:8px 0;border-bottom:1px dotted #eaeaea}
.board-view .board-view-file ul {margin-bottom:0}
.board-view .board-view-file li {padding:8px 0;border-bottom:1px solid #eaeaea}
.board-view .board-view-file a:hover {color:#000;text-decoration:underline}
.board-view .board-view-file span {margin-left:7px}
.board-view .board-view-file span i {margin-right:4px;color:#b5b5b5}
.board-view .view-top-btn {padding:20px 0}
.board-view .view-top-btn:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .view-top-btn .top-btn-left li {float:left;margin-right:1px;margin-bottom:5px}
.board-view .view-top-btn .top-btn-right li {float:left;margin-left:1px}
.board-view .board-view-atc {min-height:150px}
.board-view .board-view-atc-title {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-img {position:relative;overflow:hidden}
.board-view .board-view-img img {display:block;max-width:100%;height:auto;margin-bottom:10px}
.board-view .board-view-con {position:relative;overflow:hidden;margin-bottom:30px;width:100%;word-break:break-all}
.board-view .board-view-con img {max-width:100%;height:auto}
.board-view .board-view-rel {border-top:1px solid #757575;padding-top:15px;margin-top:20px}
.board-view .board-view-rel h4 {font-size:1.25rem;margin-bottom:15px}
@media (max-width:767px) {
    .board-view .board-view-rel .td-subj-wrap {border-color:transparent}
    .board-view .board-view-rel .td-subject a:hover {color:#000;text-decoration:underline}
    .board-view .board-view-rel .td-mobile td {padding-top:0}
}
</style>

<article class="board-view">
    <h3 class="board-view-subj">
        <?php if ($category_name) { ?>
        <span class="text-gray m-r-5">[<?php echo $view['category']; ?>]</span>
        <?php } ?>
        <strong><?php echo $view['subject']; ?></strong>
    </h3>
    <div class="board-view-info">
        <?php if ($config['cf_use_member_icon']) { ?>
        <div class="view-photo-box">
            <?php if ($view['mb_photo']) { ?>
            <span class="view-photo m-r-5"><?php echo $view['mb_photo'] ?></span>
            <?php } else { ?>
            <span class="view-photo m-r-5"><span class="view-user-icon"><i class="fas fa-user-circle"></i></span></span>
            <?php } ?>
        </div>
        <?php } ?>

        <div class="view-info-box">
            <div class="info-box-top">
                <span class="view-nick">
                    <?php echo eb_nameview($view['mb_id'], $view['qa_name'], $view['qa_email'], $view['wr_homepage']); ?>
                </span>
            </div>
            <div class="info-box-bottom">
                <span><?php echo $view['datetime']; ?></span>
            </div>
        </div>
    </div>

    <?php if ($view['email'] || $view['hp']) { ?>
    <div class="board-view-contact">
        <?php if ($view['email']) { ?>
        <div class="contact-email">
            - 이메일: <span><?php echo $view['email']; ?></span>
        </div>
        <?php } ?>
        <?php if ($view['hp']) { ?>
        <div class="contact-hp">
            - 휴대폰: <span><?php echo $view['hp']; ?></span>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if ($view['download_count']) { ?>
    <?php /* 첨부파일 시작 */ ?>
    <div class="board-view-file">
        <ul class="list-unstyled">
        <?php for ($i=0; $i<count($files); $i++) { ?>
            <li>
                - 첨부파일: <a href="<?php echo $files[$i]['download_href']; ?>"><span><?php echo $files[$i]['download_source']; ?></span></a>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php /* 첨부파일 끝 */ ?>
    <?php } ?>

    <?php /* 게시물 상단 버튼 시작 */?>
    <div class="view-top-btn">
        <?php if ($prev_href || $next_href) { ?>
        <ul class="top-btn-left list-unstyled float-start">
            <?php if ($prev_href) { ?>
            <li><a href="<?php echo $prev_href; ?>" class="btn-e btn-e-dark" type="button">이전글</a></li>
            <?php } ?>
            <?php if ($next_href) { ?>
            <li><a href="<?php echo $next_href; ?>" class="btn-e btn-e-dark" type="button">다음글</a></li>
            <?php } ?>
        </ul>
        <?php } ?>
        <ul class="top-btn-right list-unstyled float-end">
            <?php if ($update_href) { ?>
            <li><a href="<?php echo $update_href; ?>" class="btn-e btn-e-dark" type="button">수정</a></li>
            <?php } ?>
            <?php if ($delete_href) { ?>
            <li><a href="<?php echo $delete_href; ?>" class="btn-e btn-e-dark" type="button" onclick="del(this.href); return false;">삭제</a></li>
            <?php } ?>
            <li><a href="<?php echo $list_href; ?>" class="btn-e btn-e-dark" type="button">목록</a></li>
            <?php if ($write_href) { ?>
            <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-navy" type="button">글쓰기</a></li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시물 상단 버튼 끝 */?>

    <div class="board-view-atc">
        <h2 class="board-view-atc-title">본문</h2>
        <?php if(0) { ?>
        <div class="board-view-file-conts">
            <?php echo $file_conts; ?>
        </div>
        <?php } ?>
        <?php if ($view['img_count']) { ?>
        <div class="board-view-img">
            <?php foreach($thumbs as $k => $img) { echo $img; } ?>
        </div>
        <?php } ?>

        <?php /* 본문 내용 시작 */?>
        <div id="board_view_con" class="board-view-con view-content"><?php echo get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?></div>
        <?php echo $config['cf_editor'] == 'tuieditor' ? $bbs->tuieditor_viewer("board_view_con"): ''; ?>
        <?php /* 본문 내용 끝 */?>

        <?php if ($view['qa_type']) { ?>
        <div class="board-view-addq"><a href="<?php echo $rewrite_href; ?>" class="btn-e btn-teal">추가질문</a></div>
        <?php } ?>
    </div>

    <?php
    /**
     * 답변글 쓰기 || 답변글 내용
     */
    if (!$view['qa_type']) {
        if ($view['qa_status'] && $answer['qa_id']) {
            include_once($eyoom_skin_path['qa'] . '/answer.skin.html.php');
        } else {
            include_once($eyoom_skin_path['qa'] . '/answerform.skin.html.php');
        }
    }
    ?>

    <?php if ($view['rel_count']) { ?>
    <div class="board-view-rel">
        <h4><strong>연관질문</strong></h4>
        <div class="table-list-eb">
            <table class="table">
                <thead>
                    <tr>
                        <th>제목</th>
                        <th class="hidden-xs">상태</th>
                        <th class="hidden-xs">등록일</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i=0; $i<count((array)$rel_list); $i++) { ?>
                    <tr>
                        <td class="td-subj-wrap">
                            <div class="td-subject ellipsis">
                                <span class="text-gray">[<?php echo $rel_list[$i]['category']; ?>]</span>
                                <a href="<?php echo $rel_list[$i]['view_href']; ?>">
                                    <?php echo $rel_list[$i]['subject']; ?>
                                </a>
                            </div>
                        </td>
                        <td class="<?php if ($rel_list[$i]['qa_status']) { ?>text-teal<?php } else { ?>text-crimson<?php } ?> text-center hidden-xs"><?php if ($rel_list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></td>
                        <td class="text-center hidden-xs"><?php echo $rel_list[$i]['date']; ?></td>
                    </tr>
                    <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                        <td class="text-end" colspan="<?php echo $colspan; ?>">
                            <span class="text-gray m-r-7"><i class="far fa-clock m-r-5"></i><?php echo $rel_list[$i]['date']; ?></span>
                            <span class="<?php if ($rel_list[$i]['qa_status']) { ?>text-teal<?php } else { ?>text-crimson<?php } ?>"><?php if ($rel_list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
</article>

<script src="<?php echo G5_URL; ?>/js/viewimageresize.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/prism/prism.min.js"></script>
<script>
$(function() {
    // 이미지 리사이즈
    $(".board-view-atc").viewimageresize();
});
</script>