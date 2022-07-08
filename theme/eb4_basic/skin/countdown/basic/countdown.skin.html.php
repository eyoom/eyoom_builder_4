<?php
/**
 * skin file : /theme/THEME_NAME/skin/countdown/basic/countdown.skin.html.php
 */
if (!defined('_EYOOM_')) exit;
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>공사중</title>
<link rel="stylesheet" type="text/css" href="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/css/bootstrap.min.css"/>
</head>

<body>
<style>
.countdown-box {position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:900px;height:450px;text-align:center;border:1px solid #757575;padding:20px}
.countdown-box h3 {margin-bottom:50px;margin-top:0;text-align:left;font-size:20px}
.countdown-box h2 {font-size:40px;font-weight:700;color:#555}
.countdown-box h2 strong {color:#000}
.countdown-box > p {margin-top:20px;font-size:17px;color:#757575}
.countdown-box .timer {margin-top:40px}
.countdown-box .timer ul {position:relative;margin:0 auto;width:70%}
.countdown-box .timer li {min-width:140px;max-width:320px;display:inline-block;text-align:center;background:rgba(0,0,0, 0.7);border-radius:5px;margin-bottom:5px;color:#fff}
.countdown-box .timer span {font-size:42px;font-weight:bold;padding-top:20px;display:block}
.countdown-box .timer p {margin-top:3px;color:#c5c5c5}
.countdown-box .contact {margin-top:30px;text-align:center}
.countdown-box .contact a {color:#000;text-decoration:underline}
@media (max-width: 991px) {
    .countdown-wrap {padding:15px}
    .countdown-box {position:relative;top:inherit;left:inherit;transform:translate(0,0);width:100%;height:auto}
    .countdown-box h3 {margin-bottom:50px;text-align:center}
    .countdown-box h2 {font-size:32px;padding:0 20px}
    .countdown-box > p {padding:0 20px}
    .countdown-box .timer ul {width:90%}
}
</style>

<div class="countdown-wrap">
    <div class="countdown-box">
        <div class="countdown-bg">
            <h3><?php echo $countdown['cd_title'];?></h3>
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
            <div class="contact">
                <div class="d-inline"><a href="<?php echo G5_BBS_URL;?>/login.php">관리자</a></div>
            </ul>
        </div>
    </div>
</div>

<script src="<?php echo G5_JS_URL; ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/popper/popper.min.js"></script>
<script src="<?php echo EYOOM_THEME_URL; ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script>
jQuery(document).ready(function() {
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