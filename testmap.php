<?php
// testmap.php
$apiKey = 'AIzaSyDFYT_HcUnPlqrh1BgkyOf03nmgT7diJe0';
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Place Autocomplete Element</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }
        .place-autocomplete-container {
            margin: 20px 0;
        }
        .pac-target-input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 4px;
        }
        .place-details {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>New Place Autocomplete Element</h1>
    
    <div class="place-autocomplete-container">
        <label for="autocomplete-input">Search for places:</label>
        <!-- This div will be transformed by PlaceAutocompleteElement -->
        <div id="autocomplete-container"></div>
    </div>

    <div id="place-details" class="place-details"></div>
    
    <div id="map"></div>

    <script>
        // Initialize the map
        function initMap() {
            console.log('Initializing map with new PlaceAutocompleteElement...');
            
            // Create map
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.7128, lng: -74.0060 },
                zoom: 12
            });

            // Initialize the new PlaceAutocompleteElement
            initPlaceAutocompleteElement(map);
        }

        function initPlaceAutocompleteElement(map) {
            // Request the needed libraries
            const { PlaceAutocompleteElement } = google.maps.places;

            // Create the input element container
            const container = document.getElementById('autocomplete-container');
            
            // Create configuration options
            const options = {
                inputElement: container,
                placeType: 'establishment', // or 'geocode', 'address', etc.
                fetchFields: ['displayName', 'formattedAddress', 'location', 'id'],
                // country: 'us', // Optional: restrict to specific country
            };

            // Create the autocomplete element
            const autocomplete = new PlaceAutocompleteElement(options);

            // Add event listener for place changes
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.value;
                
                if (place && place.location) {
                    displayPlaceDetails(place);
                    showPlaceOnMap(place, map);
                }
            });

            console.log('PlaceAutocompleteElement initialized successfully');
        }

        function displayPlaceDetails(place) {
            const detailsContainer = document.getElementById('place-details');
            
            detailsContainer.innerHTML = `
                <h3>Selected Place Details</h3>
                <p><strong>Name:</strong> ${place.displayName || 'N/A'}</p>
                <p><strong>Address:</strong> ${place.formattedAddress || 'N/A'}</p>
                <p><strong>Place ID:</strong> ${place.id || 'N/A'}</p>
                <p><strong>Latitude:</strong> ${place.location.lat().toFixed(6)}</p>
                <p><strong>Longitude:</strong> ${place.location.lng().toFixed(6)}</p>
            `;
        }

        function showPlaceOnMap(place, map) {
            // Clear existing markers (you might want to manage markers properly)
            const markers = [];
            
            // Create a new marker
            const marker = new google.maps.Marker({
                position: place.location,
                map: map,
                title: place.displayName || 'Selected Place'
            });

            markers.push(marker);
            
            // Center the map on the selected place
            map.setCenter(place.location);
            map.setZoom(15);
        }

        // Error handling
        function handleMapError() {
            console.error('Failed to load Google Maps');
            document.getElementById('map').innerHTML = 
                '<div style="color: red; padding: 20px;">Failed to load Google Maps. Please check your API key and console for errors.</div>';
        }
    </script>

    <!-- Load Google Maps API with the new places library -->
    <script 
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiKey; ?>&loading=async&libraries=places,marker&callback=initMap"
        async 
        defer
        onerror="handleMapError()">
    </script>

    <div style="margin-top: 30px; padding: 15px; background: #e7f3ff; border-radius: 4px;">
        <h3>Migration Notes:</h3>
        <ul>
            <li>Using new <code>google.maps.places.PlaceAutocompleteElement</code></li>
            <li>Added <code>marker</code> library for better performance</li>
            <li>Using <code>loading=async</code> for better loading</li>
            <li>New property names: <code>displayName</code>, <code>formattedAddress</code>, <code>id</code></li>
        </ul>
    </div>
</body>
</html>