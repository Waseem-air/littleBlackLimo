<div class="modal fade" id="multipleTripModal" tabindex="-1" aria-labelledby="multipleTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered modal-dialog-end">
        <div class="modal-content border-0 montserrat-p">

            <!-- Header -->
            <div class="modal-header border-bottom position-sticky top-0 bg-white z-3">
                <h5 class="modal-title fw-semibold mx-auto" id="multipleTripLabel">Multiple Stops</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body overflow-auto pb-0" style="max-height: calc(100vh - 136px); background:#f5f5f5;">
                <form method="post" action="booking-confirm.php" id="multiStopForm">
                    <input type="hidden" name="trip_type" value="oneway">
                    <input type="hidden" name="fetchBooking" value="fetchBooking">

                    <!-- Main Trip (Pickup & Dropoff) -->
                    <div class="trip-segment bg-white rounded-4 p-3 trip-shadow mb-3">
                        <div class="fw-semibold text-uppercase small mb-2">Main Trip</div>
                        <div class="position-relative mb-3">
                            <label class="form-label small mb-1">Pickup</label>
                            <input type="text"
                                   class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI pickup"
                                   name="pick" placeholder="Enter pickup location" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small mb-1">Dropoff</label>
                            <input type="text"
                                   class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI dropoff"
                                   name="drop" placeholder="Enter dropoff location" required>
                        </div>
                        <div>
                            <label class="form-label small mb-1">Date & Time</label>
                            <input type="text" class="form-control search-bar-input border-0 p-0 fw-semibold datetime"
                                   name="datetime" placeholder="Select date & time" required>
                        </div>
                    </div>

                    <!-- Additional stops injected here -->
                    <div id="moreSegments"></div>

                    <!-- Add Stop Button -->
                    <div class="d-grid mb-3" id="addStopSection">
                        <button type="button" class="btn rounded-pill py-2 fw-medium" id="addSegment"
                                style="background:#fff; border:1px solid #CCC; color:#323232;">
                            <i class="bi bi-plus-lg me-1"></i> Add Stop
                        </button>
                    </div>

                    <!-- Passengers -->
                    <div class="bg-white rounded-4 p-3 trip-shadow mb-3">
                        <label class="form-label small mb-1">Passengers</label>
                        <select class="form-select p-select text-start" name="total_passenger" id="total_passenger">
                            <?php for ($i = 1; $i <= MAX_PASSENGERS; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- Footer -->
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