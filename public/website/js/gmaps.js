function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -33.8688, lng: 151.2195 },
        zoom: 13,
        mapTypeId: "roadmap",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("address");
    const searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    // creates a draggable marker to the given coords
    var vMarker = new google.maps.Marker({
        position: new google.maps.LatLng(31.0409483, 31.3784704),
        draggable: true,
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // change vmarker position to the place
            vMarker.setPosition(place.geometry.location);

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            // change lat and lng to the place
            document.getElementById("lat").value = place.geometry.location.lat();
            document.getElementById("lng").value = place.geometry.location.lng();

        });
        map.fitBounds(bounds);
    });

    // adds a listener to the marker
    // gets the coords when drag event ends
    // then updates the input with the new coords
    google.maps.event.addListener(vMarker, "dragend", function (evt) {
        // get evt location name from reverse geocoding
        var latlng = { lat: evt.latLng.lat(), lng: evt.latLng.lng() };
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: latlng }, function (results, status) {
            //console.log(results[1].formatted_address);
            $("#address").val(results[1].formatted_address);
            $("input[name='lat']").val(evt.latLng.lat().toFixed(6));
            $("input[name='lng']").val(evt.latLng.lng().toFixed(6));
            map.panTo(evt.latLng);
        });
    });
    // centers the map on markers coords
    map.setCenter(vMarker.position);
    // adds the marker on the map
    vMarker.setMap(map);
}
