/**
 * 구글지도 로딩
 */
function loading_google_map(id, x, y, name, address) {
    var latlng = new google.maps.LatLng(x, y);
    var mapOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById(id), mapOptions);

    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: name
    });

    var infowindow = new google.maps.InfoWindow({
        content: '<div style="font-size:12px;margin-top:3px"><span style="color:#757575;font-weight:normal">'+address+'</span></div>',
        maxWidth: 400
    });

    google.maps.event.addListener(marker, "click", function() {
        infowindow.open(map, marker);
    });
}

/**
 * 네이버지도 로딩
 */
function loading_naver_map(id, x, y, name, address) {
    var map = new naver.maps.Map(id, {
        center: new naver.maps.LatLng(x, y),
        zoom: 10,
        minZoom: 1, //지도의 최소 줌 레벨
        zoomControl: true, //줌 컨트롤의 표시 여부
        zoomControlOptions: { //줌 컨트롤의 옵션
            position: naver.maps.Position.TOP_RIGHT
        }
    });

    var title;
    if (name) title = '<h6 style="margin:0 0 5px"><strong>'+name+'</strong></h6>';
    var contentString = [
        '<div style="padding:10px">',
        title,
        '<div style="font-size:12px"><span style="color:#757575;font-weight:normal">'+address+'</span></div>',
        '</div>'
    ].join('');

    var marker = new naver.maps.Marker({
        position: new naver.maps.LatLng(x, y),
        map: map
    });

    var infowindow = new naver.maps.InfoWindow({
        content: contentString
    });

    naver.maps.Event.addListener(marker, "click", function(e) {
        if (infowindow.getMap()) {
            infowindow.close();
        } else {
            infowindow.open(map, marker);
        }
    });
}

/**
 * 다음지도 로딩
 */
function loading_daum_map(id, x, y, name, address) {
    var mapContainer = document.getElementById(id), // 지도를 표시할 div
        mapOption = {
            center: new daum.maps.LatLng(x, y), // 지도의 중심좌표
            level: 5 // 지도의 확대 레벨
        };

    var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

    // 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
    var mapTypeControl = new daum.maps.MapTypeControl();

    // daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
    map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

    // 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
    var zoomControl = new daum.maps.ZoomControl();
    map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

    // 마커를 표시할 위치입니다
    var position =  new daum.maps.LatLng(x, y);

    // 마커를 생성합니다
    var marker = new daum.maps.Marker({
      position: position,
      clickable: true // 마커를 클릭했을 때 지도의 클릭 이벤트가 발생하지 않도록 설정합니다
    });

    // 아래 코드는 위의 마커를 생성하는 코드에서 clickable: true 와 같이
    // 마커를 클릭했을 때 지도의 클릭 이벤트가 발생하지 않도록 설정합니다
    // marker.setClickable(true);

    // 마커를 지도에 표시합니다.
    marker.setMap(map);

    var title = '';
    if (name) title = '<h6 style="margin:0 0 5px"><strong>'+name+'</strong></h6>';

    // 마커를 클릭했을 때 마커 위에 표시할 인포윈도우를 생성합니다
    var iwContent = '<div style="padding:10px">'+title+'<div style="font-size:12px;margin-top:4px;"><span style="color:#757575;font-weight:normal">'+address+'</span></div></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
        iwRemoveable = true; // removeable 속성을 ture 로 설정하면 인포윈도우를 닫을 수 있는 x버튼이 표시됩니다

    // 인포윈도우를 생성합니다
    var infowindow = new daum.maps.InfoWindow({
        content : iwContent,
        removable : iwRemoveable
    });

    // 마커에 클릭이벤트를 등록합니다
    daum.maps.event.addListener(marker, 'click', function() {
          // 마커 위에 인포윈도우를 표시합니다
          infowindow.open(map, marker);
    });
}