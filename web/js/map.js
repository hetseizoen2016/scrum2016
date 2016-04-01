
	function initMap(){
		var mapDiv = document.getElementById('map');
		var latLng = {lat: 51.21203, lng: 4.42479};

		var map = new google.maps.Map(mapDiv, {
			center: latLng,
			zoom: 14
		});

		var marker = new google.maps.Marker({
			position: latLng,
			map: map,
			title: 'Competentiecentrum Horeca, ICT en Retail'
		});
	}
