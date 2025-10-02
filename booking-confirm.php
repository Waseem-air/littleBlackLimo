<?php
require_once('apps/head.php');
// --------------------------------------------------
// STEP 1: FETCH AVAILABLE VEHICLES (when coming from index form)
// --------------------------------------------------
if (isset($_REQUEST['fetchBooking']) && !isset($_POST['doneBooking'])) {
    $postData = [
        'trip_type' => $_REQUEST['trip_type'] ?? '',
        'pick' => $_REQUEST['pick'] ?? '',
        'drop' => $_REQUEST['drop'] ?? '',
        'datetime' => $_REQUEST['datetime'] ?? '',
        'total_passenger' => $_REQUEST['total_passenger'] ?? '',
    ];

    $response = curlPost($postData, 'booking/vehicles');

    // Decode API response
    $bookingData = is_string($response) ? json_decode($response, true) : $response;

    // Store data
    $vehicles = $bookingData['data']['vehicles'] ?? [];
    $bulkies = $bookingData['data']['bulkies'] ?? [];
    $formData = $bookingData['data']['formData'] ?? [];
    $distance = $bookingData['data']['distance'] ?? [];

    // Show API errors if any with SweetAlert
    if (!$bookingData['success']) {
        $errorMessage = htmlspecialchars($bookingData['message'] ?? 'Unknown error');
        $errorDetails = '';

        if (!empty($bookingData['errors'])) {
            $errorDetails = "<ul style='text-align: left; margin: 10px 0;'>";
            foreach ($bookingData['errors'] as $error) {
                if (is_array($error)) {
                    foreach ($error as $err) {
                        $errorDetails .= "<li>" . htmlspecialchars($err) . "</li>";
                    }
                } else {
                    $errorDetails .= "<li>" . htmlspecialchars($error) . "</li>";
                }
            }
            $errorDetails .= "</ul>";
        }

        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'API Error',
            html: '<strong>{$errorMessage}</strong>{$errorDetails}',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
        </script>";
    }

    // Redirect if no valid data
    if (empty($vehicles) || empty($formData)) {
        header("Location: index.php");
        exit();
    }
}

// --------------------------------------------------
// STEP 2: BOOKING CREATION (when user submits passenger form)
// --------------------------------------------------
if (isset($_POST['doneBooking'])) {
    // Base booking data
    $postData = [
        'trip_type' => $_POST['trip_type'] ?? '',
        'pick' => $_POST['pick'] ?? '',
        'drop' => $_POST['drop'] ?? '',
        'date' => $_POST['date'] ?? '',
        'time' => $_POST['time'] ?? '',
        'total_passenger' => $_POST['total_passenger'] ?? '',
        'vehicle_id' => $_POST['vehicle_id'] ?? '',
        'fare' => $_POST['fare'] ?? '',
        'distance_meter' => $_POST['distance_meter'] ?? '',
        'distance' => $_POST['distance'] ?? '',
        'minutes' => $_POST['minutes'] ?? '',
        'firstname' => $_POST['firstname'] ?? '',
        'lastname' => $_POST['lastname'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'notes' => $_POST['notes'] ?? '',
    ];

    // Add extra passenger / luggage options
    $postData['extras'] = [
        'baggage' => (int)($_POST['baggeg'] ?? 0),
        'handcarry' => (int)($_POST['hand_carry'] ?? 0),
        'babyseats' => (int)($_POST['noofbaby'] ?? 0),
        'boosters' => (int)($_POST['noofbooster'] ?? 0),
    ];

    // Bulk items (plain array)
    $bulkItems = $_POST['bulkItems'] ?? [];
    $postData['bulkies'] = [];
    foreach ($bulkItems as $qty) {
        if ((int)$qty > 0) {
            $postData['bulkies'][] = (int)$qty;
        }
    }

    // Call API
    $response = curlPost($postData, 'booking/create');
    $result = is_string($response) ? json_decode($response, true) : $response;

    if ($result['success']) {
        $ticketNo = htmlspecialchars($result['data']['ticket_no'] ?? '');
        $successHtml = "
    <div style='text-align: left;'>
        <p><strong>🚗 Trip Details:</strong></p>
        <p><strong>Ticket No:</strong> {$ticketNo}</p>
        <p><strong>From:</strong> " . htmlspecialchars($result['data']['pick'] ?? '') . "</p>
        <p><strong>To:</strong> " . htmlspecialchars($result['data']['drop'] ?? '') . "</p>
        <p><strong>Date & Time:</strong> " . htmlspecialchars($result['data']['date'] ?? '') . " " . htmlspecialchars($result['data']['time'] ?? '') . "</p>
        <p><strong>Phone:</strong> " . htmlspecialchars($result['data']['phone'] ?? '') . "</p>
        <p><strong>Total Fare:</strong> $" . htmlspecialchars($result['data']['fare'] ?? '') . "</p>
    </div>";
        echo "
                <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Created Successfully!',
                    html: `{$successHtml}`,
                    confirmButtonText: 'Great!',
                    confirmButtonColor: '#28a745',
                    width: '600px'
                }).then(() => {
                    window.location.href = 'booking-done.php?ticket_no={$ticketNo}';
                });
    </script>";
    }
} else {
    // Error message with details
    $errorHtml = "<div style='text-align: left;'>";
    $errorHtml .= "<p><strong>" . htmlspecialchars($result['message'] ?? 'Unknown error occurred') . "</strong></p>";

    // Show validation errors if available
    if (!empty($result['errors'])) {
        $errorHtml .= "<p><strong>Validation Errors:</strong></p><ul>";
        foreach ($result['errors'] as $field => $errors) {
            if (is_array($errors)) {
                foreach ($errors as $error) {
                    $errorHtml .= "<li><strong>" . htmlspecialchars($field) . ":</strong> " . htmlspecialchars($error) . "</li>";
                }
            } else {
                $errorHtml .= "<li><strong>" . htmlspecialchars($field) . ":</strong> " . htmlspecialchars($errors) . "</li>";
            }
        }
        $errorHtml .= "</ul>";
    }

    // Show API errors if available
    if (!empty($result['api_errors'])) {
        $errorHtml .= "<p><strong>API Errors:</strong></p><ul>";
        foreach ($result['api_errors'] as $error) {
            $errorHtml .= "<li>" . htmlspecialchars($error) . "</li>";
        }
        $errorHtml .= "</ul>";
    }

    // Show HTTP status code
    if (!empty($result['http_code'])) {
        $errorHtml .= "<p><strong>HTTP Status:</strong> " . htmlspecialchars($result['http_code']) . "</p>";
    }
    $errorHtml .= "</div>";

    echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Booking Failed',
            html: `{$errorHtml}`,
            confirmButtonText: 'Try Again',
            confirmButtonColor: '#d33',
            width: '600px'
        });
        </script>";
}
?>
<body>
<?php require_once('apps/header.php'); ?>

<!-- bookin detail section start -->
<section class="booking-bg">
    <div class="container">
        <div class="row charm">
            <div class="col-12 text-center mt-5 pt-4 text-white">
                <h1>Booking Details</h1>
            </div>
        </div>
    </div>
</section>

<!-- Booking Start -->
<section id="booking-section" data-bs-version="5.1" class="booking">
    <div class="container-fluid px-0">
        <div class="row g-0 flex-column-reverse flex-lg-row">
            <form method="post" action="booking-confirm.php">
                <div class="col-lg-6 col-12 p-0 mt-5 ps-lg-2">
                    <div class="px-2 ms-lg-5 me-lg-4">
                        <!-- STEP 1: Confirm pick-up schedule -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <p class="title charm fw-bold "><span class="subtitle fw-bold me-1">STEP 1</span> <span
                                        class="montserrat">Confirm Itinerary</span></p>
                        </div>

                        <div class="bor">
                            <!-- Pickup 1 -->
                            <div class="pickup">
                                <div class="pick-up1 montserrat">
                                    <button class="button ">Trip 1</button>
                                    <span class="title"></span>
                                    <?php
                                    if (isset($formData['time']) && isset($formData['date'])) {
                                        echo htmlspecialchars($formData['time']) . ', ' . htmlspecialchars($formData['date']);
                                    } else {
                                        echo 'Time not specified';
                                    }
                                    ?>
                                    <!--                                    <span class="span-btn" data-bs-toggle="modal" data-bs-target="#modalPickup1">-->
                                    <!--                                        Edit-->
                                    <!--                                    </span>-->


                                    <div class="dist1">
                                        <p class="title">From</p>
                                        <p class="subtitle"><?php echo htmlspecialchars($formData['pick'] ?? 'Pickup location not specified'); ?></p>
                                    </div>
                                    <div class="dist2">
                                        <p class="title">To</p>
                                        <p class="subtitle"><?php echo htmlspecialchars($formData['drop'] ?? 'Dropoff location not specified'); ?></p>
                                    </div>

                                    <div class="dist2">
                                        <p class="title">Passengers</p>
                                        <p class="subtitle"><?php echo htmlspecialchars($formData['total_passenger'] ?? '1'); ?></p>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- STEP 2: Select your Extras -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="...">
                            <div class="inner">
                                <span class="title "><span class="subtitle charm fw-bold me-1">STEP 2</span> <span
                                            class="montserrat">Add any extras</span>
                            </div>
                        </div>


                        <div class="bor">
                            <div class="items">
                                <div class="row montserrat">
                                    <!-- Check-In Bags -->
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Check-In Bags</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="bags" data-action="decrease"
                                                    onclick="changeCounter('bags', -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterBags" value="0"
                                                   readonly>
                                            <input type="hidden" name="baggeg" id="hiddenBags" value="0">
                                            <button class="counter-btn" data-counter="bags" data-action="increase"
                                                    onclick="changeCounter('bags', 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Check-In Hand Carry -->
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Check-In Hand Carry</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="handcarry" data-action="decrease"
                                                    onclick="changeCounter('handcarry', -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterHandCarry"
                                                   value="0"
                                                   readonly>
                                            <input type="hidden" name="hand_carry" id="hiddenHandCarry" value="0">
                                            <button class="counter-btn" data-counter="handcarry" data-action="increase"
                                                    onclick="changeCounter('handcarry', 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Baby Seats -->
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Baby Seats</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="babyseats" data-action="decrease"
                                                    onclick="changeCounter('babyseats', -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterBabySeats"
                                                   value="0"
                                                   readonly>
                                            <input type="hidden" name="noofbaby" id="hiddenBabySeats" value="0">
                                            <button class="counter-btn" data-counter="babyseats" data-action="increase"
                                                    onclick="changeCounter('babyseats', 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Booster Seats -->
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Booster Seats</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="boosterseats"
                                                    data-action="decrease"
                                                    onclick="changeCounter('boosterseats', -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterBoosterSeats"
                                                   value="0" readonly>
                                            <input type="hidden" name="noofbooster" id="hiddenBoosterSeats" value="0">
                                            <button class="counter-btn" data-counter="boosterseats"
                                                    data-action="increase"
                                                    onclick="changeCounter('boosterseats', 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <?php if (!empty($bulkies)): ?>
                                        <?php foreach ($bulkies as $bulky): ?>
                                            <div class="col-lg-6 col-6">
                                                <p class="heading"><?= htmlspecialchars($bulky['name']); ?></p>
                                                <div class="counter-container">
                                                    <!-- Decrease button -->
                                                    <button type="button" class="counter-btn"
                                                            data-counter="bulky_<?= $bulky['id']; ?>"
                                                            data-action="decrease">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>

                                                    <!-- Visible counter -->
                                                    <input type="text" class="form-control counter"
                                                           id="counterBulky_<?= $bulky['id']; ?>" value="0" readonly>

                                                    <!-- Hidden input for backend -->
                                                    <input type="hidden" name="bulkItems[<?= $bulky['id']; ?>]"
                                                           id="hiddenBulky_<?= $bulky['id']; ?>" value="0">

                                                    <!-- Increase button -->
                                                    <button type="button" class="counter-btn"
                                                            data-counter="bulky_<?= $bulky['id']; ?>"
                                                            data-action="increase">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>

                        <!-- STEP 3: Select your ride -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="...">
                            <div class="inner">
                                <span class="title"><span class="subtitle charm fw-bold me-1">STEP 3</span><span
                                            class="montserrat">Select your ride</span>
                                <span class="span-btn" data-bs-toggle="modal" data-bs-target="#modalRideSelection">
                                    Change
                                </span>
                            </div>
                        </div>

                        <!-- Modal for Ride Selection -->
                        <div class="modal fade" id="modalRideSelection" tabindex="-1"
                             aria-labelledby="modalRideSelectionLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-head">
                                        <span class="modal-span" id="modalRideSelectionLabel">Select your ride</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (!empty($vehicles)): ?>
                                            <?php foreach ($vehicles as $vehicle): ?>
                                                <div class="booking-card"
                                                     data-vehicle-id="<?php echo $vehicle['vehicle_uid']; ?>"
                                                     data-price="<?php echo $vehicle['fare']; ?>">

                                                    <div class="card-item">
                                                        <div class="card-inner">
                                                            <div class="card-subinner">
                                                                <p class="card-title">
                                                                    <?php echo htmlspecialchars($vehicle['vehicle_type']); ?>
                                                                    • $<?php echo number_format($vehicle['fare'], 2); ?>
                                                                </p>
                                                                <div class="extras">
                                                                    <img src="assets/images/group.png" class="cardimg"
                                                                         alt="">
                                                                    <span><?php echo $vehicle['person_allowed']; ?></span>

                                                                    <img src="assets/images/basil_bag-solid.png"
                                                                         class="cardimg" alt="">
                                                                    <span><?php echo $vehicle['no_of_seats']; ?></span>

                                                                    <img src="assets/images/wpf_luggage-trolley.png"
                                                                         class="cardimg" alt="">
                                                                    <span><?php echo $vehicle['no_of_seats']; ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="<?php echo $IMG_URL . $vehicle['vehicle_image'] . '.svg'; ?>"
                                                             class="cardimg" alt="">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="text-center p-3">
                                                <p>No vehicles available</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Selected Vehicle Display -->
                        <div class="bor">
                            <?php if (!empty($vehicles)): ?>
                                <?php $firstVehicle = $vehicles[0]; ?>
                                <div class="booking-card1 montserrat" id="selected-vehicle">
                                    <button class="badge1">Our pick</button>
                                    <div class="card-item">
                                        <div class="card-inner">
                                            <div class="card-subinner">
                                                <p class="card-title"><?php echo htmlspecialchars($firstVehicle['vehicle_type']); ?>
                                                    • $<?php echo number_format($firstVehicle['fare'], 2); ?></p>
                                                <div class="extras">
                                                    <img src="assets/images/group.png" class="cardimg text-dark" alt="">
                                                    <span><?php echo $firstVehicle['person_allowed']; ?></span>

                                                    <img src="assets/images/wpf_luggage-trolley.png" class="cardimg"
                                                         alt="">
                                                    <span><?php echo $firstVehicle['no_of_seats']; ?></span>

                                                    <img src="assets/images/basil_bag-solid.png" class="cardimg" alt="">
                                                    <span><?php echo $firstVehicle['no_of_seats']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="<?php echo $IMG_URL . $firstVehicle['vehicle_image'] . '.svg'; ?>"
                                             class="cardimg" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- STEP 4: Enter your details -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <span class="title"><span class="subtitle charm fw-bold me-1">STEP 4</span> <span
                                        class="montserrat">Enter your Contact<span>
                        </div>

                        <div class="bor">
                            <div class="details">
                                <div class="row ">

                                    <!-- Form Data -->
                                    <input type="hidden" name="date"
                                           value="<?= htmlspecialchars($formData['date'] ?? '') ?>">
                                    <input type="hidden" name="time"
                                           value="<?= htmlspecialchars($formData['time'] ?? '') ?>">
                                    <input type="hidden" name="total_passenger"
                                           value="<?= htmlspecialchars($formData['total_passenger'] ?? '') ?>">
                                    <input type="hidden" name="pick"
                                           value="<?= htmlspecialchars($formData['pick'] ?? '') ?>">
                                    <input type="hidden" name="drop"
                                           value="<?= htmlspecialchars($formData['drop'] ?? '') ?>">
                                    <input type="hidden" name="trip_type"
                                           value="<?= htmlspecialchars($formData['trip_type'] ?? '') ?>">

                                    <?php if (!empty($vehicles)): ?>
                                        <?php $firstVehicle = $vehicles[0]; ?>
                                        <input type="hidden" name="vehicle_id" id="vehicle_id"
                                               value="<?= htmlspecialchars($firstVehicle['vehicle_uid']); ?>">
                                        <input type="hidden" name="fare" id="vehicle_price"
                                               value="<?= htmlspecialchars($firstVehicle['fare']); ?>">
                                    <?php endif; ?>

                                    <!-- Distance -->
                                    <input type="hidden" name="distance_meter"
                                           value="<?= htmlspecialchars($distance['meter'] ?? '') ?>">
                                    <input type="hidden" name="distance"
                                           value="<?= htmlspecialchars($distance['km'] ?? '') ?>">
                                    <input type="hidden" name="distance_text"
                                           value="<?= htmlspecialchars($distance['text'] ?? '') ?>">
                                    <input type="hidden" name="minutes"
                                           value="<?= htmlspecialchars($distance['minute'] ?? '') ?>">
                                    <input type="hidden" name="minutes_time_text" "
                                    value="<?= htmlspecialchars($distance['minute'] ?? '') ?>">
                                    <input type="hidden" value="doneBooking" name="doneBooking">

                                    <div class="col-6"
                                         style="    padding-right: 0px !important; padding-left: 0px !important;">
                                        <div class="form-group">
                                            <input type="text" class="form-control detail" name="firstname"
                                                   placeholder="First name *" required>
                                        </div>
                                    </div>
                                    <div class="col-6 ps-2"
                                         style="    padding-right: 0px !important; padding-left: 10px !important;">
                                        <div class="form-group">
                                            <input type="text" class="form-control detail" name="lastname"
                                                   placeholder="Last name *" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control detail" name="email"
                                           placeholder="Email address*" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control detail" name="phone"
                                           placeholder="Mobile no.*" required>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="text" name="notes" class="form-control detail" placeholder="Notes *">
                                </div>
                            </div>
                        </div>


                        <!-- FINAL STEP: Make your payment -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <p class="title "><span class="subtitle charm fw-bold">FINAL STEP</span><span
                                        class="montserrat ms-1">Make your payment</span></p>
                        </div>

                        <div class="total montserrat">
                            <?php if (!empty($vehicles)): ?>
                                <p class="total-p">$<span
                                            id="total-price"><?php echo number_format($vehicles[0]['fare'], 2); ?></span>
                                    <sup class="total-span">Total</sup></p>
                            <?php else: ?>
                                <p class="total-p">$0.00 <sup class="total-span">Total</sup></p>
                            <?php endif; ?>
                            <div class="d-grid gap-2">
                                <button type="submit" class="total-btn">Pay now to book</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>


            <!-- Map Section -->
            <div class="col-lg-6 col-12 embed-responsive d-none d-lg-block">
                <?php if (!empty($formData['pick']) && !empty($formData['drop'])): ?>
                    <iframe
                            src="https://www.google.com/maps/embed/v1/directions?origin=<?php echo urlencode($formData['pick']); ?>&destination=<?php echo urlencode($formData['drop']); ?>&key=<?php echo MAP_KEY; ?>"
                            class="embed-responsive-item"
                            frameborder="0"
                            style="border:0; width: 100%; height: 100%;"
                            allowfullscreen=""
                            loading="lazy">
                    </iframe>
                <?php else: ?>
                    <p class="text-muted">Map not available. Missing pickup or drop-off location.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>


<!-- Modal for Pickup 1 -->
<div class="modal fade" id="modalPickup1" tabindex="-1"
     aria-labelledby="modalPickup1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <span class="modal-span" id="modalPickup1Label">Pick-up 1</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <img src="./asset/img/calendar_month.svg" class="form-img"
                             alt="">
                        <input type="text" name="pickup" id="datePicker1"
                               class="form-control custom"
                               placeholder="Pickup date & time">
                    </div>
                    <div class="form-group mb-0">
                        <img src="./asset/img/arrow_up.svg" class="form-img" alt="">
                        <input type="text" name="pickup" class="form-control custom"
                               placeholder="Pickup address">
                    </div>
                    <div>
                        <button class="swapvert-btn"><img
                                    src="./asset/img/swap_vert.svg" alt=""></button>
                    </div>
                    <div class="form-group">
                        <img src="./asset/img/arrow_down.svg" class="form-img"
                             style="margin-top: 32px;" alt="">
                        <input type="text" name="dropoff" class="form-control custom"
                               placeholder="Dropoff address">
                    </div>
                    <div class="form-group d-grid gap-2">
                        <a href="javascript:void(0)" class="modal-btn">Done</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Booking End -->
<!-- bookin detail End -->
<?php require_once('apps/footer.php'); ?>
<script src="assets/js/custom.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vehicleCards = document.querySelectorAll('.booking-card-modal, .booking-card');
        const selectedVehicleDisplay = document.getElementById('selected-vehicle');
        const totalPriceElement = document.getElementById('total-price');

        const hiddenVehicleId = document.getElementById('vehicle_id');
        const hiddenVehiclePrice = document.getElementById('vehicle_price');

        vehicleCards.forEach(card => {
            card.addEventListener('click', function () {
                const vehicleType = this.querySelector('.card-title').textContent.split('•')[0].trim();
                const price = this.getAttribute('data-price');
                const vehicleId = this.getAttribute('data-vehicle-id');

                // Update UI
                selectedVehicleDisplay.querySelector('.card-title').textContent = vehicleType + ' • $' + parseFloat(price).toFixed(2);
                totalPriceElement.textContent = parseFloat(price).toFixed(2);
                // Set hidden inputs
                hiddenVehicleId.value = vehicleId;
                hiddenVehiclePrice.value = price;
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalRideSelection'));
                modal.hide();
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        /**
         * Dispatcher for all counters
         */
        function changeCounter(counterType, change) {
            if (counterType.startsWith('bulky_')) {
                handleDynamicCounter(counterType, change);
            } else {
                handleStaticCounter(counterType, change);
            }
        }

        /**
         * Static counters: bags, handcarry, babyseats, boosterseats
         */
        function handleStaticCounter(counterType, change) {
            const map = {
                bags: { visible: 'counterBags', hidden: 'hiddenBags' },
                handcarry: { visible: 'counterHandCarry', hidden: 'hiddenHandCarry' },
                babyseats: { visible: 'counterBabySeats', hidden: 'hiddenBabySeats' },
                boosterseats: { visible: 'counterBoosterSeats', hidden: 'hiddenBoosterSeats' }
            };

            if (!map[counterType]) return;

            updateCounter(map[counterType].visible, map[counterType].hidden, change);
        }

        /**
         * Dynamic bulky counters: bulky_12 → counterBulky_12
         */
        function handleDynamicCounter(counterType, change) {
            const id = counterType.split('_')[1]; // e.g. "bulky_12" → "12"
            const visibleId = `counterBulky_${id}`;
            const hiddenId  = `hiddenBulky_${id}`;
            updateCounter(visibleId, hiddenId, change);
        }

        /**
         * Shared update function for both static & dynamic counters
         */
        function updateCounter(visibleId, hiddenId, change) {
            const visibleInput = document.getElementById(visibleId);
            const hiddenInput  = document.getElementById(hiddenId);

            if (!visibleInput) return;

            let value = parseInt(visibleInput.value) || 0;
            value += change;
            if (value < 0) value = 0; // Prevent negatives

            visibleInput.value = value;
            if (hiddenInput) hiddenInput.value = value;
        }

        /**
         * Attach event listeners to all .counter-btn
         */
        document.querySelectorAll('.counter-btn').forEach(btn => {
            btn.setAttribute('type', 'button'); // prevent form submission

            btn.addEventListener('click', (e) => {
                e.preventDefault();

                const counterType = btn.dataset.counter; // e.g. "bags" or "bulky_12"
                const action = btn.dataset.action;       // "increase" or "decrease"
                const change = action === 'increase' ? 1 : -1;

                changeCounter(counterType, change);
            });
        });

    });
</script>
</body>
</html>