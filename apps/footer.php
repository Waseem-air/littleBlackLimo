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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<style>
    .gj-icon {
        display: none !important;   /* ✅ Completely hides icon container */
    }

    .gj-datepicker-bootstrap [role="right-icon"] {
        display: none !important;   /* ✅ Handles Bootstrap-specific icon */
    }

    .gj-picker-bootstrap5 {
        z-index: 2000 !important;
    }

    /* Limit height and enable scroll INSIDE the picker */
    .gj-picker-bootstrap5 {
        max-height: 330px;
        overflow-y: auto;
        overflow-x: hidden;
        border-radius: 8px;
        position: fixed !important; /* ✅ fix picker in viewport, not modal flow */
        z-index: 20000 !important;  /* ensure it's above the modal */
    }

    /* Sticky OK / Cancel buttons */
    .gj-picker-bootstrap5 .gj-picker-footer {
        position: sticky;
        bottom: 0;
        background: #fff;
        border-top: 1px solid #ddd;
        padding-top: 6px;
        z-index: 1;
    }

</style>


<script>
    const BOOKING_DAYS_BEFORE = <?php echo BOOKING_DAYS_BEFORE ?? 7; ?>;

    document.addEventListener('DOMContentLoaded', function () {
        const minSelectableDate = new Date();
        minSelectableDate.setDate(minSelectableDate.getDate() + BOOKING_DAYS_BEFORE);

        $('.datetime').each(function () {
            const $input = $(this);

            $input.datetimepicker({
                uiLibrary: 'bootstrap5',
                format: 'dd mmm yyyy HH:MM',
                modal: false,
                footer: true,
                // ✅ Disable all dates *before* the allowed date
                disableDates: function (date) {
                    const onlyDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    const minDateOnly = new Date(minSelectableDate.getFullYear(), minSelectableDate.getMonth(), minSelectableDate.getDate());
                    return onlyDate < minDateOnly; // disable past
                },
                icons: {
                    rightIcon: '' // Hide calendar icon
                },
                openOnFocus: true,
                appendTo: $input.closest('.datetime-wrapper')
            });

            // 🟢 Position picker above input
            $input.on('focus', function () {
                setTimeout(() => {
                    const picker = $('.gj-picker[role="calendar"]').filter(':visible');
                    if (picker.length) {
                        const offset = $input.offset();
                        const pickerHeight = picker.outerHeight();
                        picker.css({
                            top: offset.top - pickerHeight - 5,
                            left: offset.left,
                            position: 'absolute'
                        });

                        $('html, body').animate({
                            scrollTop: offset.top - 400
                        }, 300);
                    }
                }, 50);
            });

            // 🟠 Validate on change
            $input.on('change', function () {
                const val = $(this).val();
                if (!val) return;
                const selectedDate = new Date(val);
                if (isNaN(selectedDate.getTime()) || selectedDate < minSelectableDate) {
                    $(this).val('');
                }
            });
        });

        // 🧭 Reposition picker on modal scroll
        $(document).on('scroll', '.modal', function () {
            const picker = $('.gj-picker[role="calendar"]').filter(':visible');
            if (!picker.length) return;

            const $activeInput = $('.datetime').filter(function () {
                return $(this).data('gijgo');
            });

            if ($activeInput.length) {
                const offset = $activeInput.offset();
                const pickerHeight = picker.outerHeight();
                picker.css({
                    top: offset.top - pickerHeight - 5,
                    left: offset.left,
                    position: 'absolute'
                });
            }
        });
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






