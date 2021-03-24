<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/view.skin.html.php
 */
if (!defined('_EYOOM_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.EYOOM_THEME_URL.'/plugins/magnific-popup/magnific-popup.min.css" type="text/css" media="screen">',0);
?>

<style>
.board-view .board-view-info {position:relative;box-sizing:content-box;height:46px;border-top:2px solid #757575;border-bottom:1px solid #959595;padding:7px 0;margin-top:15px;background:#fafafa}
.board-view .board-view-info .view-photo-box {position:absolute;top:7px;left:0}
.board-view .board-view-info .view-info-box {position:relative;margin-left:56px}
.board-view .board-view-info .view-photo .view-user-icon {width:46px;height:46px;font-size:26px;line-height:46px;text-align:center;background:#757575;color:#fff;margin-right:3px;-webkit-border-radius:50% !important;-moz-border-radius:50% !important;border-radius:50% !important;display:inline-block;white-space:nowrap;vertical-align:baseline}
.board-view .board-view-info .info-box-top {display:block;margin:3px 0 5px}
.board-view .board-view-info .info-box-top .view-nick {font-size:13px;margin-right:3px}
.board-view .board-view-info .info-box-bottom {display:block;font-size:11px}
.board-view .board-view-info .info-box-bottom span {margin-right:7px}
.board-view .board-view-info .info-box-bottom i {color:#b5b5b5;margin-right:4px}
.board-view .board-view-file {font-size:11px}
.board-view .board-view-file ul {margin-bottom:0}
.board-view .board-view-file li {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.board-view .board-view-file a:hover {text-decoration:underline}
.board-view .board-view-contact {font-size:11px}
.board-view .board-view-contact .contact-email {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.board-view .board-view-contact .contact-hp {padding:7px 0;border-bottom:1px dotted #e5e5e5}
.board-view .view-top-btn {padding:20px 0 5px}
.board-view .view-top-btn:after {display:block;visibility:hidden;clear:both;content:""}
.board-view .view-top-btn .top-btn-left li {float:left;margin-right:5px}
.board-view .view-top-btn .top-btn-right li {float:left;margin-left:5px;margin-bottom:5px}
.board-view .board-view-atc {min-height:200px}
.board-view .board-view-atc-title {position:absolute;font-size:0;line-height:0;overflow:hidden}
.board-view .board-view-img {position:relative;overflow:hidden}
.board-view .board-view-img img {display:block;width:100% \9;max-width:100%;height:auto;margin-bottom:10px}
.board-view .board-view-con {position:relative;overflow:hidden;margin-bottom:30px;width:100%;word-break:break-all}
.board-view .board-view-con img {max-width:100%;height:auto}
.board-view-rel .txt_done {color:#b5b5b5}
.board-view-rel .txt_rdy {color:#FF4848}
.board-view-rel .table-list-eb .table thead > tr > th {border-bottom:1px solid #959595;text-align:center;padding:10px 5px}
.board-view-rel .table-list-eb .table tbody > tr > td {border-top:1px solid #ededed;padding:7px 5px}
.board-view-rel .table-list-eb thead {border-top:2px solid #757575;border-bottom:1px solid #959595;background:#fafafa}
.board-view-rel .table-list-eb th {color:#000;font-weight:bold;white-space:nowrap;font-size:13px}
.board-view-rel .table-list-eb .td-subject {width:300px}
.board-view-rel .table-list-eb .table tbody > tr.td-mobile > td {border-top:1px solid #fff;padding:0 0 5px !important;font-size:11px;color:#959595}
.board-view-rel .table-list-eb .td-mobile td {position:relative}
.board-view-rel .table-list-eb .td-mobile td span {margin-right:5px}
.draggable {display:block;width:100% \9;max-width:100%;height:auto;margin:0 auto}
button.mfp-close {position:fixed;color:#fff !important}
.mfp-figure .mfp-close {position:absolute}
<?php if ($eyoom['is_responsive'] == '1' || G5_IS_MOBILE) { // 반응형 또는 모바일일때 ?>
@media (max-width: 1199px) {
    .board-view-rel .table-list-eb .td-subject {width:240px}
}
@media (max-width: 767px) {
    .board-view-rel .table-list-eb .table tbody > tr > td.td-subj-wrap {padding:10px 0}
    .board-view-rel .table-list-eb .td-subject {width:300px}
}
<?php } ?>
</style>

<article class="board-view">
    <h4>
        <span class="color-grey margin-right-5">[<?php echo $view['category']; ?>]</span>
        <strong><?php echo $view['subject']; ?></strong>
    </h4>
    <div class="board-view-info">
        <div class="view-photo-box">
            <span class="view-photo margin-right-5"><span class="view-user-icon"><i class="fas fa-user"></i></span></span>
        </div>
        <div class="view-info-box">
            <div class="info-box-top">
                <strong class="view-nick"><?php echo $view['name']; ?></strong>
            </div>
            <div class="info-box-bottom">
                <span class="color-black"><i class="far fa-clock"></i><?php echo $view['datetime']; ?></span>
            </div>
        </div>
    </div>

    <?php if ($view['download_count']) { ?>
    <?php /* 첨부파일 시작 */ ?>
    <div class="board-view-file">
        <ul class="list-unstyled">
        <?php for ($i=0; $i<count((array)$files); $i++) { ?>
            <li>
                - 첨부파일: <a href="<?php echo $files[$i]['download_href']; ?>"><strong><?php echo $files[$i]['download_source']; ?></strong></a>
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php /* 첨부파일 끝 */ ?>
    <?php } ?>

    <?php if ($view['email'] || $view['hp']) { ?>
    <div class="board-view-contact">
        <?php if ($view['email']) { ?>
        <div class="contact-email">
            - 이메일: <strong><?php echo $view['email']; ?></strong>
        </div>
        <?php } ?>
        <?php if ($view['hp']) { ?>
        <div class="contact-hp">
            - 휴대폰: <strong><?php echo $view['hp']; ?></strong>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <?php /* 게시물 상단 버튼 시작 */ ?>
    <div class="view-top-btn">
        <?php if ($prev_href || $next_href) { ?>
        <ul class="top-btn-left list-unstyled pull-left">
            <?php if ($prev_href) { ?>
            <li><a href="<?php echo $prev_href; ?>" class="btn-e btn-e-default" type="button">이전글</a></li>
            <?php } ?>
            <?php if ($next_href) { ?>
            <li><a href="<?php echo $next_href; ?>" class="btn-e btn-e-default" type="button">다음글</a></li>
            <?php } ?>
        </ul>
        <?php } ?>

        <ul class="top-btn-right list-unstyled pull-right">
            <?php if ($update_href) { ?>
            <li><a href="<?php echo $update_href; ?>" class="btn-e btn-e-dark" type="button">수정</a></li>
            <?php } ?>
            <?php if ($delete_href) { ?>
            <li><a href="<?php echo $delete_href; ?>" class="btn-e btn-e-dark" type="button" onclick="del(this.href); return false;">삭제</a></li>
            <?php } ?>
            <li><a href="<?php echo $list_href; ?>" class="btn-e btn-e-dark" type="button">목록</a></li>
            <?php if ($write_href) { ?>
            <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li>
            <?php } ?>
        </ul>
    </div>
    <?php /* 게시물 상단 버튼 끝 */ ?>

    <div class="board-view-atc">
        <h2 class="board-view-atc-title">본문</h2>

        <?php if ($view['img_count']) { ?>
        <div class="board-view-img">
            <?php foreach($thumbs as $k => $img) { echo $img; } ?>
        </div>
        <?php } ?>

        <?php /* 본문 내용 시작 */ ?>
        <div class="board-view-con view-content"><?php echo get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?></div>
        <?php /* 본문 내용 끝 */ ?>

        <?php if ($view['qa_type']) { ?>
        <div class="board-view-addq"><a href="<?php echo $rewrite_href; ?>" class="btn-e btn-e-yellow">추가질문</a></div>
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
        <h4 class="margin-bottom-20"><strong>연관질문</strong></h4>
        <div class="table-list-eb margin-bottom-20">
            <div class="board-list-body">
                <table class="table table-hover">
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
                                    <span class="color-grey">[<?php echo $rel_list[$i]['category']; ?>]</span>
                                    <a href="<?php echo $rel_list[$i]['view_href']; ?>">
                                        <?php echo $rel_list[$i]['subject']; ?>
                                    </a>
                                </div>
                            </td>
                            <td class="<?php if ($rel_list[$i]['qa_status']) { ?>txt_done<?php } else { ?>txt_rdy<?php } ?> text-center hidden-xs"><?php if ($rel_list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></td>
                            <td class="text-center hidden-xs"><?php echo $rel_list[$i]['date']; ?></td>
                        </tr>
                        <tr class="td-mobile visible-xs"><?php /* 767px 이하에서만 보임 */ ?>
                            <td colspan="<?php echo $colspan; ?>">
                                <span><i class="far fa-clock"></i> <?php echo $rel_list[$i]['date']; ?></span>
                                <span class="<?php if ($rel_list[$i]['qa_status']) { ?>txt_done<?php } else { ?>txt_rdy<?php } ?>"><?php if ($rel_list[$i]['qa_status']) { ?>답변완료<?php } else { ?>답변대기<?php } ?></span>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php /* 게시물 하단 버튼 시작 */ ?>
    <div class="view-top-btn">
        <?php if ($prev_href || $next_href) { ?>
        <ul class="top-btn-left list-unstyled pull-left">
            <?php if ($prev_href) { ?>
            <li><a href="<?php echo $prev_href; ?>" class="btn-e btn-e-default" type="button">이전글</a></li>
            <?php } ?>
            <?php if ($next_href) { ?>
            <li><a href="<?php echo $next_href; ?>" class="btn-e btn-e-default" type="button">다음글</a></li>
            <?php } ?>
        </ul>
        <?php } ?>
        <ul class="top-btn-right list-unstyled pull-right">
            <?php if ($update_href) { ?>
            <li><a href="<?php echo $update_href; ?>" class="btn-e btn-e-dark" type="button">수정</a></li>
            <?php } ?>
            <?php if ($delete_href) { ?>
            <li><a href="<?php echo $delete_href; ?>" class="btn-e btn-e-dark" type="button" onclick="del(this.href); return false;">삭제</a></li>
            <?php } ?>
            <li><a href="<?php echo $list_href; ?>" class="btn-e btn-e-dark" type="button">목록</a></li>
            <?php if ($write_href) { ?>
            <li><a href="<?php echo $write_href; ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li>
            <?php } ?>
        </ul>
        <div class="clearfix"></div>
    </div>
    <?php /* 게시물 하단 버튼 끝 */ ?>
</article>

<script src="<?php echo G5_URL; ?>/js/viewimageresize.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/magnific-popup/magnific-popup.min.js"></script>
<script>
$(function() {
    $('.board-view-img img').parent().attr('class', 'view-img-popup').removeAttr('target');
    $('.view-img-popup').magnificPopup({
        type: 'ajax'
    });

    if ($('.board-view-con img').parent().hasClass('view_image')) {
        $('.board-view-con img').parent().attr('class', 'view-image-popup').removeAttr('target');
        $('.view-image-popup').magnificPopup({
            type: 'ajax'
        });
    } else {
        $('.board-view-con img').wrap('<a class="view-image-popup">');
        $('.board-view-con img').each(function() {
            var imgURL = $(this).attr('src');
            $(this).parent().attr('href', imgURL);
        });
        $('.view-image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });
    }

    // 이미지 리사이즈
    $(".board-view-atc").viewimageresize();
});
</script>