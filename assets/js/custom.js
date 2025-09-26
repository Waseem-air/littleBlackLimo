 

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

    function initAutocomplete() {
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
