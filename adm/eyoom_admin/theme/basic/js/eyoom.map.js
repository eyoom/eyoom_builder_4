/**
 * 구글지도 로딩
 */
function loading_google_map(id, x, y, name, address) {
    var latlng = new google.maps.LatLng(x, y);
    var mapOptions = {
        zoom: 16,
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
        content: '<div><b>'+name+'</b><br>'+address+'</div>',
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
	var oPoint = new nhn.api.map.LatLng(x, y);
	nhn.api.map.setDefaultPoint('LatLng');
	oMap = new nhn.api.map.Map(id ,{
		point : oPoint,
		zoom : 11,
		enableWheelZoom : true,
		enableDragPan : true,
		enableDblClickZoom : false,
		mapMode : 0,
		activateTrafficMap : false,
		activateBicycleMap : false,
		minMaxLevel : [ 1, 14 ],
		//size : new nhn.api.map.Size(800, 350)
	});
	
	var oSize = new nhn.api.map.Size(28, 37);
	var oOffset = new nhn.api.map.Size(14, 37);
	var oIcon = new nhn.api.map.Icon('http://static.naver.com/maps2/icons/pin_spot2.png', oSize, oOffset);
	
	var oMarker = new nhn.api.map.Marker(oIcon, { title : '<div style="min-height:60px;">'+address+'</div>' });  //마커를 생성한다 
	oMarker.setPoint(oPoint); 
	
	oMap.addOverlay(oMarker);
	
	
	var oLabel = new nhn.api.map.MarkerLabel();
	oMap.addOverlay(oLabel);
	oLabel.setVisible(true, oMarker);
	
	var mapZoom = new nhn.api.map.ZoomControl();
	mapZoom.setPosition({right:20, bottom:40});
	oMap.addControl(mapZoom);
}

/**
 * 다음지도 로딩
 */
function loading_daum_map(id, x, y, name, address) {
	var mapContainer = document.getElementById(id), // 지도를 표시할 div 
	    mapOption = { 
	        center: new daum.maps.LatLng(x, y), // 지도의 중심좌표
	        level: 3 // 지도의 확대 레벨
	    };
	
	var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
	  
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
	
	// 마커를 클릭했을 때 마커 위에 표시할 인포윈도우를 생성합니다
	var iwContent = '<div><b>'+name+'</b><br>'+address+'</div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
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