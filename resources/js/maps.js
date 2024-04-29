(function ($) {
    "use strict";
    
   
    var markerIcon = {
       
        iconSize: [38, 95],
       
        icon: 'marker.png',
        
       
  
    }

    
        function locationData(locationURL, locationCategory, locationImg, locationTitle, locationAddress, locationPhone, locationStarRating, locationRevievsCounter) {
            return ('<div class="map-popup-wrap"><div class="map-popup"><div class="infoBox-close"><i class="fa fa-times"></i></div><div class="map-popup-category">' + locationCategory + '</div><a href="' + locationURL + '" class="listing-img-content fl-wrap"><img src="' + locationImg + '" alt=""></a> <div class="listing-content fl-wrap"><div class="card-popup-raining map-card-rainting" data-staRrating="' + locationStarRating + '"><span class="map-popup-reviews-count">( ' + locationRevievsCounter + ' reviews )</span></div><div class="listing-title fl-wrap"><h4><a href=' + locationURL + '>' + locationTitle + '</a></h4><span class="map-popup-location-info"><i class="fa fa-map-marker"></i>' + locationAddress + '</span><span class="map-popup-location-phone"><i class="fa fa-phone"></i>' + locationPhone + '</span></div></div></div></div>')
        }
        var locations = [
            [locationData('Event Booking.html', 'Food and Drink', 'images/all/8.jpg', 'Luxury Restourant', "Green Point Athletics Stadium, CPT ", "+38099231212", "5", "27"),-33.904333, 18.408896, 0, markerIcon],
            [locationData('listing-single.html', 'Conference and Events', 'images/all/1.jpg', 'Event In City Mol', "Hamilton Rugby Club ", "+38099231212", "4", "5"),-33.902659, 18.40406171, 1, markerIcon],
            [locationData('listing-single.html', 'Food and Drink', 'images/all/4.jpg', 'Luxury Restourant', "Green Point Shared Fields", "+38099231212", "4", "5"), -33.903887, 18.406193, 2, markerIcon],
            [locationData('listing-single.html', 'Gym - Fitness', 'images/all/20.jpg', 'Gym in the Center', "Green Point Urban Park ", "+38099231212", "4", "127"),-33.903857, 18.401107, 3, markerIcon],
            [locationData('listing-single.html', 'Shop - Store', 'images/all/5.jpg', 'Shop in Boutique Zone', "Green Point Stadium", "+38099231212", "5", "43"), -33.905834, 18.408971, 4, markerIcon],
            [locationData('listing-single.html', 'Hotels', 'images/all/23.jpg', 'Luxary Hotel', "Green Point A Track", "+38099231212", "4", "7"), -33.906003, 18.412533, 5, markerIcon],
            [locationData('listing-single.html', 'Shop - Store', 'images/all/6.jpg', 'Shop In City Mol', "Cape Town Stadium, NY ", "+38099231212", "3", "4"), -33.902632, -18.411235, 6, markerIcon],
           
        ];

        var map = new google.maps.Map(document.getElementById('map-main'), {
            zoom: 15.7,
            scrollwheel: false,
            center: new google.maps.LatLng(-33.9027531,18.4059689 ),
            mapTypeId: google.maps.MapTypeId.SATELLITE,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            fullscreenControl: false,
            navigationControl: false,
            streetViewControl: false,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
            styles: [{
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [{
                    visibility: "off" 
                    
                }]
            }]
        });


        map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true,
            styles: [{
              
                featureType: "poi",
        //elementType: "labels",
                "stylers": [{
                    visibility: "off" 
                    
                }]
            }]});
///make the icons not to show
//var myStyles =[
    //{
        //featureType: "poi",
        //elementType: "labels",
        //stylers: [
              //{ visibility: "off" }
        //]
    //}
//];
[
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]

//read from the above variable
//var myOptions = {
    //zoom: 10,
    //center: homeLatlng,
    //mapTypeId: google.maps.MapTypeId.ROADMAP,
    //styles: myStyles 
//};





 // Define the LatLng coordinates for the polygon's path.  
 var triangleCoords =   
 [{lat:-33.907344, lng:18.410456},       
 {lat:-33.907596, lng:18.410545},      
 {lat:-33.907918, lng:18.410370},  
 
 {lat:-33.907390, lng:18.408777},
 {lat:-33.907338, lng:18.408331},
 {lat:-33.907719, lng:18.402627},
 {lat:-33.907233, lng:18.402568},
 {lat:-33.907309, lng:18.404328},
 {lat:-33.907126, lng:18.408169}


]; 
 // Construct the polygon.  
 var drawTriangle = new google.maps.Polygon({  
    paths: triangleCoords,  
    strokeColor: '#4169E1',  
    strokeOpacity: 0.8,  
    strokeWeight: 2,  
    fillColor: '#4169E1',  
    fillOpacity: 0.35  
  });  
  drawTriangle.setMap(null);  




 // Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906565, lng:18.411559},       
{lat:-33.907015, lng:18.411205},      
{lat:-33.907158, lng:18.411285},  

{lat:-33.907981, lng:18.412530},
{lat:-33.907799, lng:18.412583}


]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#2F4F4F',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#2F4F4F',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(null);

 


// Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.903869, lng:18.409241},       
{lat:-33.904428, lng:18.408558},      
{lat:-33.904486, lng:18.408676}, 


{lat:-33.904380, lng:18.408912},
{lat:-33.904616, lng:18.409869}



]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#DC143C',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#DC143C',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);


 // Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.902979, lng:18.405980},       
{lat:-33.902631, lng:18.408235},      
{lat:-33.903808, lng:18.409173}, 


{lat:-33.905010, lng:18.407714},
{lat:-33.903914, lng:18.406759}



]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#720e9e',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#720e9e',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);




  //Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906416, lng:18.406782},       
{lat:-33.906549, lng:18.406909},      
{lat:-33.906460, lng:18.408204}, 


{lat:-33.905917, lng:18.407501}




]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#D6F430',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#D6F430',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);




 ///Define the LatLng coordinates for the polygon's path.  
var triangleCoords =   
[{lat:-33.906813, lng:18.404714},       
{lat:-33.906769, lng:18.406098},      
{lat:-33.904970, lng:18.403652}, 


{lat:-33.905397, lng:18.402869}




]; 
// Construct the polygon.  
var drawTriangle = new google.maps.Polygon({  
   paths: triangleCoords,  
   strokeColor: '#662d91',  
   strokeOpacity: 0.8,  
   strokeWeight: 2,  
   fillColor: '#662d91',  
   fillOpacity: 0.35  
 });  
 drawTriangle.setMap(map);


 
 





        var boxText = document.createElement("div");
        boxText.className = 'map-box'
        var currentInfobox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-145, -45),
            zIndex: null,
            boxStyle: {
                width: "260px"
            },
            closeBoxMargin: "0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false,
        };
        var markerCluster, marker, i;
        var allMarkers = [];
        var clusterStyles = [{
            textColor: 'white',
            url: '',
            height: 50,
            width: 50
        }];


        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][4],
                id: i
            });
            allMarkers.push(marker);
            var ib = new InfoBox();
            google.maps.event.addListener(ib, "domready", function () {
                cardRaining()
            });
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[i][0];
                    ib.close();
                    ib.open(map, marker);
                    currentInfobox = marker.id;
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -180);
                    google.maps.event.addListener(ib, 'domready', function () {
                        $('.infoBox-close').click(function (e) {
                            e.preventDefault();
                            ib.close();
                        });
                    });
                }
            })(marker, i));
        }
        var options = {
            imagePath: 'images/',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        $('.nextmap-nav').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            var index = currentInfobox;
            if (index + 1 < allMarkers.length) {
                google.maps.event.trigger(allMarkers[index + 1], 'click');
            } else {
                google.maps.event.trigger(allMarkers[0], 'click');
            }
        });
        $('.prevmap-nav').click(function (e) {
            e.preventDefault();
            map.setZoom(15);
            if (typeof (currentInfobox) == "undefined") {
                google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
            } else {
                var index = currentInfobox;
                if (index - 1 < 0) {
                    google.maps.event.trigger(allMarkers[allMarkers.length - 1], 'click');
                } else {
                    google.maps.event.trigger(allMarkers[index - 1], 'click');
                }
            }
        });
        $('.map-item').click(function (e) {
            e.preventDefault();
     		map.setZoom(15);
            var index = currentInfobox;
            var marker_index = parseInt($(this).attr('href').split('#')[1], 10);
            google.maps.event.trigger(allMarkers[marker_index], "click");
			if ($(this).hasClass("scroll-top-map")){
			  $('html, body').animate({
				scrollTop: $(".map-container").offset().top+ "-80px"
			  }, 500)
			}
			else if ($(window).width()<1064){
			  $('html, body').animate({
				scrollTop: $(".map-container").offset().top+ "-80px"
			  }, 500)
			}
        });
      // Scroll enabling button
    
       


    
    var map = document.getElementById('map-main');
    if (typeof (map) != 'undefined' && map != null) {
        google.maps.event.addDomListener(window, 'load', mainMap);
    }

    //DELETE MAP MARKERS

    function DeleteMarkers() {
        //Loop through all the markers and remove
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    };

    ///END OF DELETE MAKERS

    function singleMap() {
        var myLatLng = {
            lng: $('#singleMap').data('longitude'),
            lat: $('#singleMap').data('latitude'),
        };
        var single_map = new google.maps.Map(document.getElementById('singleMap'), {
            zoom: 14,
            center: myLatLng,
            scrollwheel: false,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [{
                    "color": "#f2f2f2"
                }]
            }]
        });
        var markerIcon2 = {
            url: 'images/marker.png',
        }		
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: single_map,
            icon: markerIcon2,
            title: 'Our Location'
        });
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, single_map);

        function ZoomControl(controlDiv, single_map) {
            zoomControlDiv.index = 1;
            single_map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "mapzoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "mapzoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function () {
                single_map.setZoom(single_map.getZoom() - 1);
            });
        }
    }
    var single_map = document.getElementById('singleMap');
    if (typeof (single_map) != 'undefined' && single_map != null) {
        google.maps.event.addDomListener(window, 'load', singleMap);
    }
})(this.jQuery);