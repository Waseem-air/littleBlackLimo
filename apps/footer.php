<section style="background-color:black;">
    <div class="container ">
        <div class="row text-white montserrat-p">
            <div class="col-sm-9 mt-3">
                <h5 class="montserrat">Contact</h5>
                <div class="d-flex align-items-center mt-4">
                    <img src="assets/images/location.png" alt="Location" width="17" height="17">
                    <p class="ms-2 mb-0 text-nowrap">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        <?php echo CONTACT_ADDRESS; ?>
                    </p>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <img src="assets/images/call.png" alt="Location" width="17" height="17">
                    <p class="ms-2 mb-0 text-nowrap">
                        <a href="tel:<?php echo CONTACT_PHONE; ?>" class="text-white text-decoration-none">
                            <?php echo CONTACT_PHONE; ?>
                        </a>
                    </p>
                </div>
                <div>

                    <p class="ms-2 mb-0 text-nowrap mt-4">
                        <a href="tel:<?php echo CONTACT_PHONE; ?>" class="text-white text-decoration-none">
                            ODBS: <?php echo COMPANY_ODBS; ?>
                        </a>
                    </p>

                </div>
                <div class="d-flex align-items-center mt-4">
                    <img src="assets/images/message.png" alt="Location" width="17" height="17">
                    <p class="ms-2 mb-0 text-nowrap">
                        <a href="mailto:<?php echo CONTACT_EMAIL; ?>" class="text-white text-decoration-none">
                            <?php echo CONTACT_EMAIL; ?>
                        </a>
                    </p>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <a href="<?php echo CONTACT_FACEBOOK; ?>" target="_blank">
                        <img src="assets/images/facebook.png" alt="Facebook" class="img-fluid">
                    </a>
                    <a href="<?php echo CONTACT_INSTA; ?>" target="_blank" class="ms-4">
                        <img src="assets/images/instagram.png" alt="Instagram" class="img-fluid">
                    </a>
                    <a href="<?php echo CONTACT_TIKTOK; ?>" target="_blank" class="ms-4">
                        <img src="assets/images/tiktok.png" alt="TikTok" class="img-fluid">
                    </a>
                    <a href="<?php echo CONTACT_WHATSAPP; ?>" target="_blank" class="ms-4">
                        <img src="assets/images/whatsapp.png" alt="WhatsApp" class="img-fluid">
                    </a>
                </div>

            </div>
            <div class="col-sm-3 mt-3 text-white justify-content-between">
                <h5 class="montserrat">LOCATION</h5>
                <div id="map" class="w-100 border rounded footer-map-img" style="height:250px;"></div>
            </div>

            <div class="col-12">
                <p class="mt-3">©Copyrights 2024 littleblacklimo | All Rights Reserved. Designed by A1 APPS</p>
            </div>
        </div>
    </div>
</section>


<?php require_once 'config/config.php'; ?>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Your Custom Script -->
<!--<script src="assets/js/custom.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>&libraries=places"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.3.2.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=en&key=<?php echo MAP_KEY; ?>"
        async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    flatpickr(".datetime", {
        enableTime: true,
        allowInput: true,
        dateFormat: "d M Y, H:i",
        mode: 'single',
        disableMobile: "true",
        minDate: new Date(Date.now() + 48 * 60 * 60 * 1000) // aaj se 48 ghante baad
    });
</script>

<script>
    function initMap() {
        // Wembley WA 6014 Location
        const wembleyLocation = {lat: -31.9330, lng: 115.8190};

        // Create map centered on Wembley
        const map = new google.maps.Map(document.getElementById("map"), {
            center: wembleyLocation,
            zoom: 14,
        });

        // Add marker on Wembley
        const marker = new google.maps.Marker({
            position: wembleyLocation,
            map: map,
            title: "Wembley WA 6014",
        });
    }

    // Run map after page loads
    window.onload = initMap;
</script>






