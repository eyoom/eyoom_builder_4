<?php
/**
 * skin file : /theme/THEME_NAME/skin/countdown/basic/countdown.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>공사중</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
<link rel="stylesheet" type="text/css" href="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo EYOOM_THEME_URL; ?>/plugins/fontawesome5/css/fontawesome-all.min.css"/>
</head>

<style>
.countdown-box {
    margin: 50px auto 0;
    text-align: center;
    color: #fff;
}

.countdown-bg {
    height: 600px;
    padding-top: 20px;
    background: url(<?php echo EYOOM_THEME_URL; ?>/skin/countdown/<?php echo $countdown['cd_skin']; ?>/img/pattern.png);
    -moz-box-shadow: 0 1px 5px 0 rgba(0,0,0,.7);
    -webkit-box-shadow: 0 1px 5px 0 rgba(0,0,0,.7);
    box-shadow: 0 1px 5px 0 rgba(0,0,0,.7);
}
h1.logo {
    margin-bottom: 100px;
    margin-top:0;
    text-align: left;
    text-indent: 30px;
    color: #fff;
    font-size: 40px;
    text-shadow: 0 1px 7px rgba(0,0,0,.5);
}

.countdown-box h2 {
    font-size: 40px;
    font-weight: 700;
    text-transform: uppercase;
    text-shadow: 0 1px 7px rgba(0,0,0,.5);
}

.countdown-box p {
    margin-top: 20px;
    font-size: 18px;
    line-height: 36px;
    text-shadow: 0 1px 7px rgba(0,0,0,.3);
}

.timer {
    margin-top: 40px;
    text-shadow: 0 1px 5px rgba(0,0,0,.1);
}
.timer ul {
    position: relative;
    margin: 0 auto;
    width: 70%;
}
.timer li {
    min-width: 140px;
    max-width: 320px;
       display: inline-block;
       text-align: center;
       background: rgba(0,0,0, 0.5);
       border-radius: 5px !important;
       margin-bottom: 5px;
  }
.timer  span {
    font-size: 42px;
    font-weight: bold;
    padding-top: 20px;
    display: block;
}
.timer p{
    margin-top: 0;
}

.contact {
    margin-top: 30px;
    text-align: center;
}
.contact > li {
    font-size: 16px;
    color: #6a6a6a;
}
.contact > li > i {

}
.contact > li > ul {}
.contact > li > ul > li {
    margin-top: 10px;
}
.contact > li > ul > li > a {
}
.contact > li > ul > li > a > i {
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    color: #fff;
    background: #3a3a3a;
    border-radius: 5px !important;
    font-size: 22px;
}
.contact > li > ul > li > a:hover i {
    background: #111;
}



@media (max-width: 767px) {
    h1.logo {
        margin-bottom: 50px;
        text-align: center;
        text-indent: 0;
    }
    .inner-bg {
        padding: 45px 0 50px 0;
    }

    .countdown-box h2 {
        font-size: 32px;
        padding: 0 20px;
    }

    .countdown-box p {
        padding: 0 20px;
    }
    .timer {
        margin-top: 60px;
    }
    .timer ul {
        width: 90%;
    }
    .timer ul li {
        min-width: 140px;
    }


}
</style>

<body>

<div class="container">
    <div class="countdown-box margin-top-50 row">
        <div class="countdown-bg">
            <h1 class="logo"><?php echo $countdown['cd_title'];?></h1>
            <h2>지금은 <strong>공사중</strong> 입니다.</h2>
            <p>더 좋은 모습으로 찾아 뵙겠습니다.</p>
            <div class="timer">
                <ul class="countdown list-inline">
                    <li>
                        <span class="days"></span>
                        <p class="timeRefDays"></p>
                    </li>
                    <li>
                        <span class="hours"></span>
                        <p class="timeRefHours"></p>
                    </li>
                    <li>
                        <span class="minutes"></span>
                        <p class="timeRefMinutes"></p>
                    </li>
                    <li>
                        <span class="seconds"></span>
                        <p class="timeRefSeconds"></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <ul class="list-unstyled contact"><!--{* 전화번호 설정 : 영카트는 쇼핑몰설정에서 / 그누보드는 직접 아래 부분을 수정, 이메일 설정 : 환경설정 - 관리자 메일 주소에서 설정 *}-->
        <li><i class="fa fa-phone"></i> <?php echo $default['de_admin_company_tel'] ? $default['de_admin_company_tel'] : '000-0000-0000';?> / <i class="fa fa-envelope-o"></i> <?php echo $config['cf_admin_email']; ?></li>
        <li>
            <!--{* 소셜 미디어 설정 *}-->
            <ul class="list-inline">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                <li><a href="<?php echo G5_BBS_URL;?>/login.php"><i class="fas fa-user"></i></a></li>
            </ul>
        </li>
    </ul>
</div>

<style>
</style>

<script src="<?php echo G5_URL; ?>/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/backstretch/jquery.backstretch.min.js"></script>
<script>
jQuery(document).ready(function() {
    /* 배경 이미지 및 시간 설정 */
    $('.countdown-box').backstretch([
      "<?php echo EYOOM_THEME_URL; ?>/skin/countdown/<?php echo $countdown['cd_skin']; ?>/img/01.jpg"
    , "<?php echo EYOOM_THEME_URL; ?>/skin/countdown/<?php echo $countdown['cd_skin']; ?>/img/02.jpg"
    , "<?php echo EYOOM_THEME_URL; ?>/skin/countdown/<?php echo $countdown['cd_skin']; ?>/img/03.jpg"
    ], {duration: 15000, fade: 750});

    /* Countdown plugin */
    (function($) {
        $.fn.countdown = function(options, callback) {

          //custom 'this' selector
          var thisEl = $(this);

          //array of custom settings
          var settings = {
            'date': null,
            'format': null
          };

          //append the settings array to options
          if(options) {
            $.extend(settings, options);
          }

          //main countdown function
          var countdown_proc = function () {

            var eventDate = Date.parse(settings['date']) / 1000;
            var currentDate = Math.floor($.now() / 1000);

            if(eventDate <= currentDate) {
              callback.call(this);
              clearInterval(interval);
            };

            var seconds = eventDate - currentDate;

            var days = Math.floor(seconds / (60 * 60 * 24)); //calculate the number of days
            seconds -= days * 60 * 60 * 24; //update the seconds variable with no. of days removed

            var hours = Math.floor(seconds / (60 * 60));
            seconds -= hours * 60 * 60; //update the seconds variable with no. of hours removed

            var minutes = Math.floor(seconds / 60);
            seconds -= minutes * 60; //update the seconds variable with no. of minutes removed

            //conditional Ss
            if (days == 1) { thisEl.find(".timeRefDays").text("Day"); } else { thisEl.find(".timeRefDays").text("Days"); }
            if (hours == 1) { thisEl.find(".timeRefHours").text("Hour"); } else { thisEl.find(".timeRefHours").text("Hours"); }
            if (minutes == 1) { thisEl.find(".timeRefMinutes").text("Minute"); } else { thisEl.find(".timeRefMinutes").text("Minutes"); }
            if (seconds == 1) { thisEl.find(".timeRefSeconds").text("Second"); } else { thisEl.find(".timeRefSeconds").text("Seconds"); }

            //logic for the two_digits ON setting
            if(settings['format'] == "on") {
              days = (String(days).length >= 2) ? days : "0" + days;
              hours = (String(hours).length >= 2) ? hours : "0" + hours;
              minutes = (String(minutes).length >= 2) ? minutes : "0" + minutes;
              seconds = (String(seconds).length >= 2) ? seconds : "0" + seconds;
            }

            //update the countdown's html values.
            if(!isNaN(eventDate)) {
              thisEl.find(".days").text(days);
              thisEl.find(".hours").text(hours);
              thisEl.find(".minutes").text(minutes);
              thisEl.find(".seconds").text(seconds);
            } else {
              alert("Invalid date. Here's an example: 12 Tuesday 2012 17:30:00");
              clearInterval(interval);
            }
          }

          //run the function
          countdown_proc();

          //loop the function
          interval = setInterval(countdown_proc, 1000);

        }
    }) (jQuery);


    //Call countdown plugin
    $(".countdown").countdown({
      date: "<?php echo $cd_date['day'] . ' ' . $cd_date['month_text'] . ' ' . $cd_date['year'] . ' ' . $cd_date['hour'] . ':' . $cd_date['minute'] . ':00'; ?>", // add the countdown's end date (i.e. 3 november 2012 12:00:00)
      format: "on" // on (03:07:52) | off (3:7:52) - two_digits set to ON maintains layout consistency
    },

    function() {

      // the code here will run when the countdown ends
      alert("D-day!")

    });

});
</script>
</body>
</html>