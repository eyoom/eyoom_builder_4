<?php
/**
 * page file : /theme/THEME_NAME/page/gmap_search.html.php
 * 구글지도 기능성 스킨을 위한 페이지입니다.
 * 일반 페이지에서는 기능 적용이 안되며 특정 스킨과 연동 시에만 기능 적용이 되오니 참고하시기 바랍니다.
 */
if (!defined('_EYOOM_')) exit;
?>

<style>
.view-srh-gmap-wrap .gmap-search-box {position:relative;border:1px solid #b5b5b5;background:#f5f5f5;margin:0 0 20px;padding:15px}
.view-srh-gmap-wrap #gmap-container {position:relative;overflow:hidden;height:255px;padding:6px;border:3px solid #656565;background:#fff;-webkit-box-shadow:rgba(64, 64, 64, 0.5) 0 2px 5px;-moz-box-shadow:rgba(64, 64, 64, 0.5) 0 2px 5px;box-shadow:rgba(64, 64, 64, 0.1) 0 2px 5px}
.view-srh-gmap-wrap #gmap_search_canvas {width:100%;height:100%;margin:0px;padding:0px}
.view-srh-gmap-wrap #pac-input:focus {border-color:#4d90fe}
</style>

<div class="view-srh-gmap-wrap">
    <div class="gmap-search-box">
        <div class="row">
            <div class="col-sm-6 sm-margin-bottom-20">
                <div class="eyoom-form">
                    <section>
                        <label for="pac-input">주소 검색<small class="color-grey font-normal margin-left-10"><span class="color-red">*</span> 주소입력 시 자동완성</small></label>
                        <label class="input">
                            <i class="icon-append fa fa-location-arrow"></i>
                            <input id="pac-input" type="text" placeholder="검색할 주소를 입력하세요.">
                        </label>
                    </section>
                    <section>
                        <label for="srh_address">주소</label>
                        <label class="input">
                            <i class="icon-append fa fa-map-marker"></i>
                            <input type="text" name="srh_address" id="srh_address">
                        </label>
                    </section>
                    <section>
                        <label for="srh_address_lat">위도</label>
                        <label class="input">
                            <i class="icon-append fa fa-map-pin"></i>
                            <input type="text" name="srh_address_lat" id="srh_address_lat">
                        </label>
                    </section>
                    <section>
                        <label for="srh_address_lng">경도</label>
                        <label class="input">
                            <i class="icon-append fa fa-map-pin"></i>
                            <input type="text" name="srh_address_lng" id="srh_address_lng">
                        </label>
                    </section>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="gmap-container">
                    <div id="gmap_search_canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="button" class="btn-e btn-e-lg btn-e-navy rounded" id="btn_map" onclick="return false;"><i class="fa fa-hand-pointer-o margin-right-5"></i>적용하기</button>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&region=kr&key=구글맵_api키_입력"></script>
<script>
function initializeSrh() {
    var map = new google.maps.Map(document.getElementById('gmap_search_canvas'), {
        center: {lat: 37.571211, lng: 126.976952},
        zoom: 7,
        scrollwheel: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var markers = [];
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });
    google.maps.event.addListener(searchBox, 'places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };
            markers.push(new google.maps.Marker({
                map: map,
                title: place.name,
                position: place.geometry.location
            }));
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
            marker.setPlace(/** @type {!google.maps.Place} */ ({
                placeId: place.place_id,
                location: place.geometry.location
            }));
            marker.setVisible(true);
            infowindow.setContent('<div class="font-size-11"><strong>' + place.name + '</strong><br>' +
                '장소 ID: ' + place.place_id + '<br>' +
                place.formatted_address + '</div>');
            infowindow.open(map, marker);
            document.getElementById('srh_address').value = place.formatted_address;
            document.getElementById('srh_address_lat').value = place.geometry.location.lat();
            document.getElementById('srh_address_lng').value = place.geometry.location.lng();
        });
        map.fitBounds(bounds);
        map.setZoom(16);
    });
}

google.maps.event.addDomListener(window, 'load', initializeSrh);

$("#btn_map").click(function(){
    var map_addr1 = $("#srh_address").val();
    if (!map_addr1) {
        alert("주소를 검색하신 후 적용하실 수 있습니다.");
    } else {
        parent.set_map_address(1, map_addr1, '', '');
        window.parent.closeModal();
    }
});
</script>