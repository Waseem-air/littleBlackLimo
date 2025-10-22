<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
<body>
<?php require_once('apps/header.php'); ?>
<!-- bookin detail section start -->
<section class="booking-bg" >
    <div class="container">
        <div class="row charm">
            <div class="col-12 text-center mt-5 pt-4 text-white">
                <h1 class="charm">Book Now – Arrive in Style</h1>
            </div>
        </div>
    </div>
</section>

<!-- bookin form start -->
<section>
    <div class="container">
        <div class="row mt-5 pt-5 mb-5 pb-5">
            <!-- Left Column -->
            <div class="col-sm-6">
                <h1 class="charm">Schedule Your Little Black Limo Experience</h1>
                <p>Let us take care of the details — you just enjoy the ride.</p>

                <!-- Booking Toggle (desktop only) -->
                <div class="row w-100" style="width:99%!important;" id="mainBookingForm">
                    <div class="col-12 mt-4 p-0">
                        <div class="booking-toggle w-100 " id="bookingToggle">
                            <button class="toggle-btn active text-dark" id="onewayBtn" data-type="oneway">
                                One-way
                            </button>
                            <button class="toggle-btn text-dark" id="multipleBtn" data-bs-toggle="modal" data-bs-target="#multipleTripModal">
                                Multiple
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Booking Form -->
                <form method="post" id="bookingFormSection" action="booking-confirm.php" class="mt-4">
                    <input type="hidden" name="trip_type" value="oneway">
                    <div class="row">
                        <div class="col-12 mb-3 ps-0">
                            <select class="form-select custom rounded-2" name="service_type" id="service_type" required>
                                <?php if (!empty($serviceTypes)): ?>
                                    <?php foreach ($serviceTypes as $serviceKey => $formType): ?>
                                        <?php
                                        $serviceName = ucwords(str_replace('_', ' ', $serviceKey));
                                        $serviceValue = $serviceKey . ':' . $formType;
                                        $selected = (strtolower($serviceKey) === 'airport_transfer') ? 'selected' : '';
                                        ?>
                                        <option value="<?= $serviceValue ?>" <?= $selected ?>><?= $serviceName ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="airport_transfer:booking_form" selected>Airport Transfer</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Pickup -->
                        <div class="col-lg-6 col-md-6 col-12 mb-3 ps-0">
                            <div class="form-group position-relative">
                                <img src="assets/images/arrow_up.svg" class="form-img" alt="">
                                <input type="text" name="pick" class="form-control custom placesAPI"
                                       placeholder="Pickup Location" required>
                            </div>
                        </div>

                        <!-- Drop-off -->
                        <div class="col-lg-6 col-md-6 col-12 mb-3 ps-0">
                            <div class="form-group position-relative">
                                <img src="assets/images/arrow_down.svg" class="form-img" alt="">
                                <input type="text" name="drop" class="form-control custom placesAPI"
                                       placeholder="Drop-off Location" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Date -->
                        <div class="col-lg-6 col-md-6 col-12 mb-3 ps-0">
                            <div class="form-group position-relative">
                                <img src="assets/images/calendar_month.svg" class="form-img" alt="">
                                <input type="text" name="datetime" id="date"
                                       class="form-control custom flatpickr datetime"
                                       placeholder="Select Date & Time" required>
                            </div>
                        </div>

                        <!-- Passengers -->
                        <div class="col-lg-6 col-md-6 col-12 mb-3 ps-0">
                            <div class="form-group position-relative input-with-buttons">
                                <img src="assets/images/emoji_people.svg" class="form-img" alt="">
                                <select class="form-select custom rounded-2"
                                        name="total_passenger" id="total_passenger">
                                    <?php for ($i = 1; $i <= MAX_PASSENGERS; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-12 ps-0">
                            <input type="submit" class="btn btn-dark w-100 custom" id="mainBookingBtn" name="fetchBooking" value="Search" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <h5><a  href="tel:<?php echo CONTACT_PHONE; ?>" class="text-dark text-decoration-underline montserrat">Or call us to book</a></h5>
                    </div>
                </form>
            </div>

            <!-- Right Column -->
            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                <!-- Example Image / Illustration -->
                <img src="assets/images/booking.png" alt="Limo Car" class="img-fluid d-none d-sm-block">
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap customServiceModal Custom Services -->
<?php require_once('customServiceModal.php'); ?>

<?php require_once('apps/multi_stops_popup.php'); ?>
<?php require_once('apps/footer.php'); ?>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=en&key=<?php echo MAP_KEY; ?>"
        async defer></script>
<script src="assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/booking-contact-form-ajax.js"></script>
</body>
</html>