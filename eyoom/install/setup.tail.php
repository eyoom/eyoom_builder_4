<div id="ins_ft">
    <strong>GNUBOARD5</strong>
    <p>GPL OPEN SOURCE GNUBOARD</p>
</div>

</div>

<script src="../../js/jquery-1.8.3.min.js"></script>
<script>
function frm_install_submit(f) {
    <?php if (!$install_eb4) { ?>
    if (f.mysql_host.value == '')
    {
        alert('MySQL Host 를 입력하십시오.'); f.mysql_host.focus(); return false;
    }
    else if (f.mysql_user.value == '')
    {
        alert('MySQL User 를 입력하십시오.'); f.mysql_user.focus(); return false;
    }
    else if (f.mysql_db.value == '')
    {
        alert('MySQL DB 를 입력하십시오.'); f.mysql_db.focus(); return false;
    }
    else if (f.admin_id.value == '')
    {
        alert('최고관리자 ID 를 입력하십시오.'); f.admin_id.focus(); return false;
    }
    else if (f.admin_pass.value == '')
    {
        alert('최고관리자 비밀번호를 입력하십시오.'); f.admin_pass.focus(); return false;
    }
    else if (f.admin_name.value == '')
    {
        alert('최고관리자 이름을 입력하십시오.'); f.admin_name.focus(); return false;
    }
    else if (f.admin_email.value == '')
    {
        alert('최고관리자 E-mail 을 입력하십시오.'); f.admin_email.focus(); return false;
    }

    var reg = /\);(passthru|eval|pcntl_exec|exec|system|popen|fopen|fsockopen|file|file_get_contents|readfile|unlink|include|include_once|require|require_once)\s?\(\$_(get|post|request)\s?\[.*?\]\s?\)/gi;
    var reg_msg = " 에 유효하지 않는 문자가 있습니다. 다른 문자로 대체해 주세요.";

    if( reg.test(f.mysql_host.value) ){
        alert('MySQL Host'+reg_msg); f.mysql_host.focus(); return false;
    }

    if( reg.test(f.mysql_user.value) ){
        alert('MySQL User'+reg_msg); f.mysql_user.focus(); return false;
    }

    if( f.mysql_pass.value && reg.test(f.mysql_pass.value) ){
        alert('MySQL PASSWORD'+reg_msg); f.mysql_pass.focus(); return false;
    }

    if( reg.test(f.mysql_db.value) ){
        alert('MySQL DB'+reg_msg); f.mysql_db.focus(); return false;
    }

    if( f.table_prefix.value && reg.test(f.table_prefix.value) ){
        alert('TABLE명 접두사'+reg_msg); f.table_prefix.focus(); return false;
    }

    if(/^[a-z][a-z0-9]/i.test(f.admin_id.value) == false) {
        alert('최고관리자 회원 ID는 첫자는 반드시 영문자 그리고 영문자와 숫자로만 만드셔야 합니다.');
        f.admin_id.focus();
        return false;
    }
    
    if (window.jQuery) {

        var jqxhr = jQuery.post( "../../install/ajax.install.check.php", $(f).serialize(), function(data) {
            
            if( data.error ){
                alert(data.error);
            } else if( data.exists ) {
                if( confirm(data.exists) ){
                    f.submit();
                }
            } else if( data.success ) {
                f.submit();
            }

        }, "json");

        jqxhr.fail(function(xhr) {
            alert( xhr.responseText );
        });

        return false;
    }
    <?php } ?>

    return true;
}
</script>

</body>
</html>