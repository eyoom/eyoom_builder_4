<?php
/**
 * Eyoom Admin Skin File
 * @file    ~/theme/THEME_NAME/skin/sms/sms_write_form.html.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 페이지 경로 설정
 */
$fm_pid = 'sms_write';
$g5_title = '문자보내기';
$g5_page_path = '<li class="breadcrumb-item"><a href="'.correct_goto_url(G5_ADMIN_URL).'">Home</a></li><li class="breadcrumb-item active" aria-current="page">SMS 관리</li><li class="breadcrumb-item active" aria-current="page">'.$g5_title.'</li>';
?>

<style>
#sms5_send #send_emo #emo_sel {position:relative;top:inherit;right:inherit}
#sms5_send #send_emo ul.emo_list {margin-bottom:20px}
#sms5_send #send_emo li.empty_list {font-size:.8125rem}
.admin-sms-write-form .emo-sel {position:relative;top:inherit;right:inherit;margin-bottom:20px}
/* page */
.pg_wrap {clear:both;margin:20px 0 0;padding:0;text-align:center}
.pg {display:inline-block}
.pg_page, .pg_current {font-size:.75rem;color:#fff;background-color:#353535;display:inline-block;float:left;padding:0;width:32px;height:26px;line-height:26px;text-decoration:none;border:0;margin:1px}
.pg a:focus, .pg a:hover {background-color:none}
.pg_current {display:inline-block;background:#3949ab;color:#fff;font-weight:400}
</style>

<div class="admin-sms-write-form">
    <form name="emo_frm" class="eyoom-form">
        <div class="emo-sel">
            <label for="emo_sel" class="label sound_only">이모티콘 그룹</label>
            <label class="select width-150px">
                <select name="fg_no" id="emo_sel">
                    <option value=""<?php echo get_selected('', $fg_no); ?>> 전체 </option>
                    <option value="0"<?php echo get_selected('0', $fg_no); ?>> 미분류 (<?php echo number_format($no_count)?>) </option>
                    <?php for($i=0; $i<count((array)$group); $i++) {?>
                    <option value="<?php echo $group[$i]['fg_no']?>"<?php echo get_selected($fg_no, $group[$i]['fg_no']);?>> <?php echo $group[$i]['fg_name']?> (<?php echo number_format($group[$i]['fg_count'])?>) </option>
                    <?php } ?>
                </select>
                <i></i>
            </label>
        </div>
    </form>

    <ul class="emo_list"></ul>

    <form name="emo_sch" id="emo_sch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME']?>" class="eyoom-form margin-top-20">
    <input type="hidden" name="fg_no" value="<?php echo $fg_no?>">
    <input type="hidden" name="page" id="hidden_page" >
    <input type="hidden" name="fg_no" id="hidden_fg_no" >

    <label for="st" class="label sound_only">검색대상</label>
    <label class="select width-150px">
        <select name="st" id="st">
            <option value="all"<?php echo get_selected('all', $st); ?>>제목 + 이모티콘</option>
            <option value="name"<?php echo get_selected('name', $st); ?>>제목</option>
            <option value="content"<?php echo get_selected('content', $st); ?>>이모티콘</option>
        </select>
        <i></i>
    </label>
    <label for="sv" class="label sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <div class="input input-button">
        <input type="text" name="sv" value="<?php echo $sv?>" id="sv" required size="15">
        <div class="button"><input type="submit" value="검색" class="btn_submit">검색</div>
    </div>

    </form>

    <nav class="pg_wrap">
        <span class="pg" id="emo_pg"></span>
    </nav>
</div>

<script src="<?php echo G5_JS_URL?>/jquery.sms_paging.js"></script>
<script>
var emoticon_list = {
    go : function(fo_no){
        var wr_message = document.getElementById('wr_message');

        //wr_message.focus();
        wr_message.value = document.getElementById('fo_contents_' + fo_no).value;

        byte_check('wr_message', 'sms_bytes');
    }
};

(function($){
    var $search_form = $("form#emo_sch");
    emoticon_list.fn_paging = function( hash_val,total_page ){
        $('#emo_pg').paging({
            current:hash_val ? hash_val : 1,
            max:total_page == 0 || total_page ? total_page : 45,
            length : 5,
            liitem : 'span',
            format:'{0}',
            next:'다음',
            prev:'이전',
            sideClass:'pg_page pg_next',
            prevClass:'pg_page pg_prev',
            first:'&lt;&lt;',last:'&gt;&gt;',
            href:'#',
            itemCurrent:'pg_current',
            itemClass:'pg_page',
            appendhtml:'<span class="sound_only">페이지</span>',
            onclick:function(e,page){
                e.preventDefault();
                $("#hidden_page").val( page );
                var params = $($search_form).serialize();
                emoticon_list.select_page( params, "json" );
            }
        });
    }
    emoticon_list.loading = function( el, src ){
        if( !el || !src) return;
        $(el).append("<span class='tmp_loading'><img src='"+src+"' title='loading...' ></span>");
    }
    emoticon_list.loadingEnd = function( el ){
        $(".tmp_loading", $(el)).remove();
    }
    emoticon_list.select_page = function( params, type ){
        if( !type ){
            type = "json";
        }
        emoticon_list.loading(".emo_list", "<?php echo G5_ADMIN_URL; ?>/sms_admin/img/ajax-loader.gif" ); //로딩 이미지 보여줌
        $.ajax({
            url: "<?php echo G5_ADMIN_URL; ?>/sms_admin/ajax.sms_write_form.php",
            cache:false,
            timeout : 30000,
            dataType:type,
            data:params,
            success: function(HttpRequest) {
                if( type == "json" ){
                    if (HttpRequest.error) {
                        alert(HttpRequest.error);
                        return false;
                    } else {
                        var $emoticon_box = $(".emo_list");
                        $emoticon_box.html( HttpRequest.list_text );
                        emoticon_list.fn_paging( HttpRequest.page, HttpRequest.total_page );
                        $("#hidden_page").val( HttpRequest.page );
                    }
                }
                emoticon_list.loadingEnd(".emo_list"); //로딩 이미지 지움
            }
        });
    }

    $("#emo_sel").bind("change", function(e){
        var params = { fg_no : $(this).val() };
        $search_form[0].reset();
        $("#hidden_fg_no").val( $(this).val() );
        emoticon_list.select_page( params, "json" );
    });
    $search_form.submit(function(e){
        e.preventDefault();
        var $form = $(this),
            params = $(this).serialize();
        emoticon_list.select_page( params, "json" );
    });
    $("#emo_sel").trigger("change");
})(jQuery);
</script>