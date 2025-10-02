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
                   <div class="row w-100" style="width:99%!important;">
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
                    <form method="post" action="#" class="mt-4">
                        <div class="row">
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
                                <select name="total_passenger" id="total_passenger" class="form-select custom rounded-2">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                </select>
                            </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mt-3">
                            <div class="col-12 ps-0">
                            <button type="submit" class="btn btn-dark w-100 custom">Search</button>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5><a href="" class="text-dark text-decoration-underline montserrat">Or call us to book</a></h5>
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


        <div class="modal fade mb-5 pb-5" id="multipleTripModal" tabindex="-1" aria-labelledby="multipleTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered modal-dialog-end">
        <div class="modal-content border-0 montserrat-p">

            <!-- Fixed Header -->
            <div class="modal-header border-bottom position-sticky top-0 bg-white z-3">
                <h5 class="modal-title fw-semibold mx-auto" id="multipleTripLabel">
                    Multiple Stops
                </h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Scrollable Body -->
            <div class="modal-body overflow-auto pb-0" style="max-height: calc(100vh - 136px); background:#f5f5f5;">
                <form class="form" id="createJob" method="post" action="#">

                    <!-- TRIP 1 -->
                    <div class="trip-segment bg-white rounded-4 p-3 trip-shadow mb-3">
                        <div class="fw-semibold text-uppercase small mb-2">Trip</div>
                        <div class="position-relative mb-3">
                            <label class="form-label small mb-1">Pickup</label>
                            <input type="text" class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI pickup" name="pick" placeholder="Enter pickup location" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small mb-1">Dropoff</label>
                            <input type="text" class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI dropoff" name="drop" placeholder="Enter dropoff location" required>
                        </div>

                        <div>
                            <label class="form-label small mb-1">Date & Time</label>
                            <input type="text" class="form-control search-bar-input border-0 p-0 fw-semibold datetime" id="pickupDateTime" placeholder="Select date & time" required>
                        </div>
                    </div>

                    <!-- Additional trips get injected here -->
                    <div id="moreSegments"></div>

                    <!-- Add Another Trip -->
                    <div class="d-grid mb-3">
                        <button type="button" class="btn rounded-pill py-2 fw-medium" id="addSegment" style="background:#fff; border: 1px solid #CCCCCC; color:#323232;">
                            <i class="bi bi-plus-lg me-1"></i>
                            Add Stop
                        </button>
                    </div>

                    <!-- Passengers -->
                    <div class="bg-white rounded-4 p-3 trip-shadow mb-3">
                        <label class="form-label small mb-1">Passengers</label>
                        <select class="form-select p-select text-start" name="total_passenger" id="total_passenger">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <!-- Fixed Footer -->
                    <div class="modal-footer border-0 p-3 position-sticky bottom-0 bg-white z-3">
                        <button type="submit" class="btn btn-dark rounded-pill w-100 py-2 fw-semibold">
                            See Prices
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>

<script>
  flatpickr(".datetime", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: new Date(Date.now() + 48 * 60 * 60 * 1000) // aaj se 48 ghante baad
  });
</script>

</body>
</html>
