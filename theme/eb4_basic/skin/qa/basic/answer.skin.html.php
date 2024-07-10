<?php
/**
 * skin file : /theme/THEME_NAME/skin/qa/basic/answer.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.board-view-ans {font-size:.9375rem;border-top:1px solid #757575;padding-top:15px}
.board-view-ans h4 {font-size:1.25rem}
.board-view-ans .ans-datetime {margin:15px 0 0;padding:8px 0;border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;color:#757575}
.board-view-ans .ans-con {position:relative;margin:20px 0}
.board-view-ans #bo_v_file {margin-top:15px;padding:10px 0;background-color:#fafafa;border-top:1px solid #959595;border-bottom:1px solid #959595}
.board-view-ans #bo_v_file h2 {margin:0 0 10px;padding:5px 0 10px;font-size:1.0625rem;font-weight:700;border-bottom:1px solid #d5d5d5}
.board-view-ans #bo_v_file ul {list-style:none;margin:0;padding:0}
.board-view-ans #bo_v_file ul li {margin-bottom:5px;font-size:.9375rem}
.board-view-ans #bo_v_file ul li i {margin-right:5px;color:#959595}
.board-view-ans #bo_v_file ul li a:hover {text-decoration:underline}
</style>

<div class="board-view-ans">
    <h4><strong><span class="text-crimson">답변</span> : <?php echo get_text($answer['qa_subject']); ?></strong></h4>

    <?php if ($is_admin == 'super') { ?>
    <div class="board-view-info">
        <?php if ($config['cf_use_member_icon']) { ?>
        <div class="view-photo-box">
            <?php if ($answer['mb_photo']) { ?>
            <span class="view-photo m-r-5"><?php echo $answer['mb_photo'] ?></span>
            <?php } else { ?>
            <span class="view-photo m-r-5"><span class="view-user-icon"><i class="fas fa-user-circle"></i></span></span>
            <?php } ?>
        </div>
        <?php } ?>

        <div class="view-info-box">
            <div class="info-box-top">
                <span class="view-nick">
                    <?php echo eb_nameview($answer['mb_id'], $answer['qa_name'], $answer['qa_email'], $answer['wr_homepage']); ?>
                </span>
            </div>
            <div class="info-box-bottom">
                <span><?php echo $answer['qa_datetime']; ?></span>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="ans-datetime">
        <i class="far fa-clock"></i> <?php echo $answer['qa_datetime']; ?>
    </div>
    <?php } ?>

    <div id="ans_con" class="ans-con">
        <?php
        if(isset($answer['img_count']) && $answer['img_count']) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<$answer['img_count']; $i++) {
                echo get_view_thumbnail($answer['img_file'][$i], $qaconfig['qa_image_width']);
            }

            echo "</div>\n";
        }
        ?>

        <?php echo get_view_thumbnail(conv_content($answer['qa_content'], $answer['qa_html']), $qaconfig['qa_image_width']); ?>

        <?php if(isset($answer['download_count']) && $answer['download_count']) { ?>
        <section id="bo_v_file">
            <h2>첨부파일</h2>
            <ul>
            <?php
            for ($i=0; $i<$answer['download_count']; $i++) {
            ?>
                <li>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <a href="<?php echo $answer['download_href'][$i];  ?>" class="view_file_download" download>
                        <?php echo $answer['download_source'][$i] ?>
                    </a>
                </li>
            <?php
            }
            ?>
            </ul>
        </section>
        <?php } ?>
    </div>
    <?php echo $config['cf_editor'] == 'tuieditor' ? $bbs->tuieditor_viewer("ans_con"): ''; ?>
    <div class="float-start">
        <?php if ($answer_update_href) { ?>
        <a href="<?php echo $answer_update_href; ?>" class="btn-e btn-gray">답변수정</a>
        <?php } ?>
        <?php if ($answer_delete_href) { ?>
        <a href="<?php echo $answer_delete_href; ?>" class="btn-e btn-gray" onclick="del(this.href); return false;">답변삭제</a>
        <?php } ?>
    </div>
    <div class="float-end">
        <a href="<?php echo $rewrite_href; ?>" class="btn-e btn-teal">추가질문</a>
    </div>
    <div class="clearfix"></div>
</div>