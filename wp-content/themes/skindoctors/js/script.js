jQuery(function ($) {
	$("img.scale").imageScale({
		rescaleOnResize: true
	});
	$('.scrolling-panel .header').click(function(){
		var $item = $(this);
		$('.scrolling-panel.on').not($(this).parent()).each(function(){
			$(this).removeClass('on');
		});
	 	$item.parent().toggleClass('on');
	});
	$("#contact-container form").submit(function(){
		$("#contact-container").bind("DOMSubtreeModified",function(){
			console.log("resize: " + $(this).height());
			$("#map").height($(this).height() + 280);
		});
	});

	$('#carousel-news').bind('slid.bs.carousel', function (e) {
	    console.log('slide event!');
	});
});

function loadTabsContent(url1, url2) {
	jQuery.ajax({
		type: "GET",
		url: url1
	}).done(function(html) {
		jQuery("#news .list").html(html);
		jQuery("img.scale").imageScale({
			rescaleOnResize: true
		});
	});

	jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  		var target = jQuery(e.target).attr("href") // activated tab
  		jQuery(target + " .list").html("");
  		console.log(target);
  		var url = "";

  		if(target == "#news") {
  			url = url1;
  		}
  		if(target == "#tips") {
  			url = url2;
  		}

  		jQuery.ajax({
			type: "GET",
			url: url
		}).done(function(html) {
			jQuery(target + " .list").html(html);
			jQuery("img.scale").imageScale({
				rescaleOnResize: true
			});
		});
	});
}

window.initMap = function(){
	if (document.getElementById("map")) {
		var map; 
		var salon = {lat: 52.2285634, lng: 21.0734135};
		var salon_pos = {lat: 52.2285635, lng: 21.0574135};
		var salon_mob = {lat: 52.2125634, lng: 21.0734135};
		var center = salon_pos;

		if(window.innerWidth <= 767) {
			center = salon_mob;
		}

	    map = new google.maps.Map(document.getElementById('map'), {
	        zoom: 14,
	        center: center,
	        disableDefaultUI: true,
	        //draggable: false, 
	        //zoomControl: false, 
	        scrollwheel: false, 
	        //disableDoubleClickZoom: true,
	        styles: [
					  {
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#f5f5f5"
					      }
					    ]
					  },
					  {
					    "elementType": "labels.icon",
					    "stylers": [
					      {
					        "visibility": "off"
					      }
					    ]
					  },
					  {
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#616161"
					      }
					    ]
					  },
					  {
					    "elementType": "labels.text.stroke",
					    "stylers": [
					      {
					        "color": "#f5f5f5"
					      }
					    ]
					  },
					  {
					    "featureType": "administrative.land_parcel",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#bdbdbd"
					      }
					    ]
					  },
					  {
					    "featureType": "poi",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "poi",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#757575"
					      }
					    ]
					  },
					  {
					    "featureType": "poi.park",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#e5e5e5"
					      }
					    ]
					  },
					  {
					    "featureType": "poi.park",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#9e9e9e"
					      }
					    ]
					  },
					  {
					    "featureType": "road",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#ffffff"
					      }
					    ]
					  },
					  {
					    "featureType": "road.arterial",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#757575"
					      }
					    ]
					  },
					  {
					    "featureType": "road.highway",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#dadada"
					      }
					    ]
					  },
					  {
					    "featureType": "road.highway",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#616161"
					      }
					    ]
					  },
					  {
					    "featureType": "road.local",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#9e9e9e"
					      }
					    ]
					  },
					  {
					    "featureType": "transit.line",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#e5e5e5"
					      }
					    ]
					  },
					  {
					    "featureType": "transit.station",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#eeeeee"
					      }
					    ]
					  },
					  {
					    "featureType": "water",
					    "elementType": "geometry",
					    "stylers": [
					      {
					        "color": "#c9c9c9"
					      }
					    ]
					  },
					  {
					    "featureType": "water",
					    "elementType": "labels.text.fill",
					    "stylers": [
					      {
					        "color": "#9e9e9e"
					      }
					    ]
					  }
					]
	    });
	    var marker = new google.maps.Marker({
	        position: salon,
	        map: map
	    });

	    var height = document.getElementById('contact-container').offsetHeight; 
		height = height + 200;
		document.getElementById('map').setAttribute('style', 'height: ' + height + 'px');

	    google.maps.event.addDomListener(window, "resize", function() {
			var w = window.innerWidth;
			var height = document.getElementById('contact-container').offsetHeight; 
		    height = height + 200;
		    document.getElementById('map').setAttribute('style', 'height: ' + height + 'px');

		 	google.maps.event.trigger(map, "resize");
		 	console.log(w);
		 	if(w <= 767) {
		 		map.setCenter(salon_mob);
		 	} else {
		 		map.setCenter(salon_pos);
		 	}
		});
	}
}
