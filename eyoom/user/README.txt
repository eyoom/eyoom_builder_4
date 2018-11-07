1. 이 폴더는 이윰빌더에서 제공하지 못하는 기능을 구현하고자 할 경우, 개발하시는 분이 직접 코딩할 수 있도록 지원하는 공간입니다.

2. 이윰빌더 파일의 폴더구조와 동일한 위치에 동일한 파일명을 생성하여 저장하시면 해당 파일은 이윰빌더 core 에서 include 하여 실행됩니다.

3. 대부분 이윰빌더 core 파일 하단에 user 개발 기능을 확장할 수 있도록 include를 지원합니다.

4. 만일 /eyoom/head.php 파일에 특정 코드를 입력하고자 한다면, 해당 파일에 직접 코딩하지 마시고 /eyoom/user/head.php 파일을 생성하여 코딩하시고 저장하시기만 하시면 /eyoom/head.php 파일 하단에서 /eyoom/user/head.php 파일을 자동으로 인지하여 인크루드 합니다.

5. /eyoom/core/board/list.skin.php 파일의 경우는 /eyoom/user/board/list.skin.php 파일을 생성하여 응용해 주시면 됩니다.
   
6. 생성한 파일 상단에는 반드시 개별파일 접속을 제한하는 php 프로그램 소스를 입력해 주시기 바랍니다.

<?php
if (!defined('_EYOOM_')) exit;
?>
