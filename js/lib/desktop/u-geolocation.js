u.injectGeolocation = function(node) {

	if(!u.browser("IE", "<=9")) {
		node.geolocation.node = node;
//		u.bug("node.geolocation:" + node.geolocation);

		var li_longitude = u.qs("li.longitude", node.geolocation);
		var li_latitude = u.qs("li.latitude", node.geolocation);

		// u.bug("li_longitude:" + li_longitude);
		// u.bug("li_latitude:" + li_latitude);

		if(li_longitude && li_latitude) {
			node.geo_longitude = parseFloat(li_longitude.getAttribute("content"));
			node.geo_latitude = parseFloat(li_latitude.getAttribute("content"));

			// u.bug("geo_longitude:" + node.geo_longitude);
			// u.bug("geo_latitude:" + node.geo_latitude);

			node.showMap = function() {

				if(!this.geomap) {

					this.geomap = u.ae(this, "div", {"class":"geomap"});
					this.insertBefore(this.geomap, u.qs("ul.info", this));

					var maps_url = "https://maps.googleapis.com/maps/api/js" + (u.gapi_key ? "?key="+u.gapi_key : "");
					var html = '<html><head>';
					html += '<style type="text/css">body {margin: 0;}#map {height: 300px;}</style>';
					html += '<script type="text/javascript" src="'+maps_url+'"></script>';
					html += '<script type="text/javascript">';
					html += 'var map, marker;';
					html += 'var initialize = function() {';
					html += '	window._map_loaded = true;';
					html += '	var mapOptions = {center: new google.maps.LatLng('+this.geo_latitude+', '+this.geo_longitude+'),zoom: 12};';
					html += '	map = new google.maps.Map(document.getElementById("map"),mapOptions);';
					html += '	marker = new google.maps.Marker({position: new google.maps.LatLng('+this.geo_latitude+', '+this.geo_longitude+'), draggable:true});';
					html += '	marker.setMap(map);';
					html += '};';
					html += 'google.maps.event.addDomListener(window, "load", initialize);';
					html += '</script>';
					html += '</head><body><div id="map"></div></body></html>';

					this.mapsiframe = u.ae(this.geomap, "iframe");
					this.mapsiframe.doc = this.mapsiframe.contentDocument? this.mapsiframe.contentDocument: this.mapsiframe.contentWindow.document;
					this.mapsiframe.doc.open();
					this.mapsiframe.doc.write(html);
					this.mapsiframe.doc.close();
				}
			}
			node.geolocation.clicked = function() {
				this.node.showMap();
			}
			u.ce(node.geolocation);

			u.ac(node.geolocation, "active");
		}

	}


}
