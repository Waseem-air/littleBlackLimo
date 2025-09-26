<section style="background-color:black;">
  <div class="container">
      <div class="row text-white">
          <div class="col-sm-9">
              <h5>Contact</h5>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/location.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">Wembley WA 6014</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/call.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">0404 359 777</p>
              </div>
              <div>
                <p class="text-nowrap mt-4">ODBS: 1010295</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/message.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">luxury@littleblacklimo.com.au</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src=" assets/images/facebook.png" alt="">
                <img src=" assets/images/instagram.png" alt="" class="ms-4">
                <img src=" assets/images/tiktok.png" alt="" class="ms-4">
                <img src=" assets/images/whatsapp.png" alt="" class="ms-4">
              </div>
              
          </div>
          <div class="col-sm-3 text-white justify-content-between">
              <h5>LOCATION</h5>
              <img src="assets/images/map.png" alt="" class="w-100 mb-2">
          </div>
          <div class="col-12">
              <p class="mt-3">©Copyrights 2024 littleblacklimo | All Rights Reserved. Designed by A1 APPS</p>
          </div>
      </div>
  </div>
</section>  
  
  
  
  
  <!-- Bootstrap JS (with Popper.js included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=en&key=YOUR_GOOGLE_MAPS_KEY" async defer></script>

<script>
    const addStopHerePlaceholder = "Add stop here";
    const removeStopText = "Remove"; 

    document.addEventListener('DOMContentLoaded', function () {

        function renumberTrips() {
            document.querySelectorAll('.trip-segment').forEach((segment, index) => {
                const tripNum = index + 1;
                segment.querySelector('.text-uppercase').textContent = `Stop ${tripNum}`;
            });
        }

        let tripCount = 0;
        let autocompleteInstances = [];

        function fixAutocompleteZIndex() {
            const style = document.createElement('style');
            style.innerHTML = `.pac-container { z-index: 1060 !important; }`;
            document.head.appendChild(style);
        }

        // Google Places Autocomplete Init
        function initPlacesAutocomplete(inputElement) {
            if (!inputElement.dataset.autocompleteInitialized) {
                const autocomplete = new google.maps.places.Autocomplete(inputElement, {});
                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    if (!place.geometry) {
                        console.warn("No details for: " + place.name);
                        return;
                    }
                });
                inputElement.dataset.autocompleteInitialized = 'true';
                autocompleteInstances.push(autocomplete);
            }
        }

        function initializeExistingAutocompletes() {
            document.querySelectorAll('.placesAPI').forEach(input => {
                initPlacesAutocomplete(input);
            });
        }

        // Add new stop
        document.getElementById('addSegment').addEventListener('click', function() {
            tripCount++;
            const newSegment = document.createElement('div');
            newSegment.className = 'trip-segment bg-white rounded-4 p-3 trip-shadow mb-3';
            newSegment.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-semibold text-uppercase small">Stop ${tripCount}</div>
                    <button type="button" class="btn btn-sm btn-link text-danger p-0 remove-trip" data-trip-id="${tripCount}">
                        <i class="bi bi-trash"></i> ${removeStopText}
                    </button>
                </div>
                <div class="position-relative mb-3">
                    <input type="text" class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI pickup" name="stops[]" placeholder="${addStopHerePlaceholder}" required>
                </div>
            `;
            document.getElementById('moreSegments').appendChild(newSegment);
            newSegment.querySelectorAll('.placesAPI').forEach(input => {
                initPlacesAutocomplete(input);
            });
            renumberTrips();
        });

        // Remove trip
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-trip')) {
                e.target.closest('.trip-segment').remove();
                renumberTrips();
            }
        });

        window.initAutocomplete = function () {
            fixAutocompleteZIndex();
            initializeExistingAutocompletes();
        };

        function checkGoogleMapsLoaded() {
            if (window.google && google.maps && google.maps.places) {
                initAutocomplete();
            } else {
                setTimeout(checkGoogleMapsLoaded, 100);
            }
        }

        $('#multipleTripModal').on('shown.bs.modal', function () {
            checkGoogleMapsLoaded();
        });

        checkGoogleMapsLoaded();
    });
</script>

<script>
    function initAutocomplete() {
        // --- GOOGLE AUTOCOMPLETE LOGIC ---
        const inputs = document.getElementsByClassName('placesAPI');
        for (let i = 0; i < inputs.length; i++) {
            const input = inputs[i];
            const autocomplete = new google.maps.places.Autocomplete(input, {});
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                input.value = place.formatted_address || input.value;
            });
        }
    }
</script>
