<?php
require_once('apps/head.php');

function showSweetAlert($type, $title, $message = '')
{
    $icon = $type === 'success' ? 'success' : 'error';

    return "
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$message',
                width: '600px',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'swal-custom-btn'
                },
                buttonsStyling: false
            });
        });
        </script>
    ";
}
/**
 * Handle Fetch Booking (Step 1)
 */
if (isset($_REQUEST['fetchBooking'])) {

    // Build request payload
    $postData = [
        'trip_type'        => $_REQUEST['trip_type']        ?? '',
        'pick'             => $_REQUEST['pick']             ?? '',
        'drop'             => $_REQUEST['drop']             ?? '',
        'datetime'         => $_REQUEST['datetime']         ?? '',
        'total_passenger'  => $_REQUEST['total_passenger']  ?? '',
    ];

    // Optional stops
    if (!empty($_REQUEST['stops']) && is_array($_REQUEST['stops'])) {
        $postData['stops'] = array_filter($_REQUEST['stops']);
    }

    // Send CURL request to fetch vehicles
    $response = curlPost($postData, 'booking/vehicles');
    $bookingData = is_string($response) ? json_decode($response, true) : $response;

    // Validate response
    if (empty($bookingData) || !$bookingData['success']) {
        $errorMessage = htmlspecialchars($bookingData['message'] ?? 'Unknown error occurred');
        echo showSweetAlert('error', 'API Error', $errorMessage);
        exit();
    }

    // Extract data
    $vehicles = $bookingData['data']['vehicles'] ?? [];
    $bulkies  = $bookingData['data']['bulkies']  ?? [];
    $formData = $bookingData['data']['formData'] ?? [];
    $distance = $bookingData['data']['distance'] ?? [];
    // Validate required data
    if (empty($vehicles) || empty($formData)) {
        echo showSweetAlert('error', 'No Vehicles', 'No vehicles available for your criteria. Please try different locations or passenger count.');
        exit();
    }

} else {
    echo showSweetAlert('error', 'Invalid Access', 'Please start from the booking form.');
    exit();
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
            <div class="col-lg-6 col-12 p-0 mt-5 ps-lg-2">
                <form method="post" action="booking-done.php">
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
                                        echo htmlspecialchars($formData['time']) . ', ' . date('d M Y', strtotime(htmlspecialchars($formData['date'])));
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
                                                   value="0" readonly>
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
                                                   value="0" readonly>
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
                                                    data-action="decrease" onclick="changeCounter('boosterseats', -1)">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterBoosterSeats"
                                                   value="0" readonly>
                                            <input type="hidden" name="noofbooster" id="hiddenBoosterSeats" value="0">
                                            <button class="counter-btn" data-counter="boosterseats"
                                                    data-action="increase" onclick="changeCounter('boosterseats', 1)">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>


                                    <?php if (!empty($bulkies)): ?>
                                        <?php foreach ($bulkies as $bulky): ?>
                                            <div class="col-lg-6 col-6">
                                                <p class="heading"><?= htmlspecialchars($bulky['name']); ?></p>
                                                <div class="counter-container">
                                                    <button class="counter-btn"
                                                            data-counter="bulky_<?= $bulky['id']; ?>"
                                                            data-action="decrease">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>
                                                    <input type="text" class="form-control counter"
                                                           id="counterBulky_<?= $bulky['id']; ?>" value="0" readonly>
                                                    <input type="hidden" name="bulkItems[<?= $bulky['id']; ?>]"
                                                           id="hiddenBulky_<?= $bulky['id']; ?>" value="0">
                                                    <button class="counter-btn"
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
                                                     data-vehicle-id="<?php echo htmlspecialchars($vehicle['vehicle_uid']); ?>"
                                                     data-price="<?php echo htmlspecialchars($vehicle['fare']); ?>"
                                                     data-driver-fare="<?php echo htmlspecialchars($vehicle['fare_details']['driver_fare'] ?? 0); ?>">

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
                                    <?php if (isset($formData['stops']) && is_array($formData['stops'])): ?>
                                        <?php foreach ($formData['stops'] as $stop): ?>
                                            <input type="hidden" name="stops[]" value="<?= htmlspecialchars($stop) ?>">
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($vehicles)): ?>
                                        <?php $firstVehicle = $vehicles[0]; ?>
                                        <input type="hidden" name="vehicle_id" id="vehicle_id"
                                               value="<?php echo htmlspecialchars($firstVehicle['vehicle_uid'] ?? ''); ?>">
                                        <input type="hidden" name="fare" id="vehicle_price"
                                               value="<?php echo htmlspecialchars($firstVehicle['fare'] ?? ''); ?>">
                                        <input type="hidden" name="driver_fare" id="driver_fare"
                                               value="<?php echo htmlspecialchars($firstVehicle['fare_details']['driver_fare'] ?? ''); ?>">
                                    <?php endif; ?>


                                    <!-- Distance -->
                                    <input type="hidden" name="distance"
                                           value="<?= htmlspecialchars($distance['km'] ?? '') ?>">
                                    <input type="hidden" name="distance_text"
                                           value="<?= htmlspecialchars($distance['text'] ?? '') ?>">
                                    <input type="hidden" name="minutes"
                                           value="<?= htmlspecialchars($distance['minute'] ?? '') ?>">
                                    <input type="hidden" name="distance_text"
                                           value="<?= htmlspecialchars($distance['text'] ?? '') ?>">
                                    <input type="hidden" name="doneBooking" value="doneBooking">
                                    <input type="hidden" name="pickcordinate"
                                           value="<?= htmlspecialchars($distance['pickcordinate'] ?? '') ?>">
                                    <input type="hidden" name="dropcordinate"
                                           value="<?= htmlspecialchars($distance['dropcordinate'] ?? '') ?>">

                                    <div class="col-6"
                                         style="    padding-right: 0px !important; padding-left: 0px !important;">
                                        <div class="form-group">
                                            <input type="text" class="form-control detail" name="firstname"
                                                   placeholder="First name *">
                                        </div>
                                    </div>
                                    <div class="col-6 ps-2"
                                         style="    padding-right: 0px !important; padding-left: 10px !important;">
                                        <div class="form-group">
                                            <input type="text" name="lastname" class="form-control detail"
                                                   placeholder="Last name *">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control detail" name="email"
                                           placeholder="Email address*">
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control detail" name="phone"
                                           placeholder="Mobile no.*">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control detail" name="notes" placeholder="Notes *">
                                </div>
                            </div>
                        </div>

                        <!-- FINAL STEP: Make your payment -->

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
                                <button type="submit" class="total-btn">Book Now</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
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
<div class="modal fade" id="modalPickup1" tabindex="-1" aria-labelledby="modalPickup1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <span class="modal-span" id="modalPickup1Label">Pick-up 1</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <img src="./asset/img/calendar_month.svg" class="form-img" alt="">
                        <input type="text" name="pickup" id="datePicker1" class="form-control custom"
                               placeholder="Pickup date & time">
                    </div>
                    <div class="form-group mb-0">
                        <img src="./asset/img/arrow_up.svg" class="form-img" alt="">
                        <input type="text" name="pickup" class="form-control custom" placeholder="Pickup address">
                    </div>
                    <div>
                        <button class="swapvert-btn"><img src="./asset/img/swap_vert.svg" alt=""></button>
                    </div>
                    <div class="form-group">
                        <img src="./asset/img/arrow_down.svg" class="form-img" style="margin-top: 32px;" alt="">
                        <input type="text" name="dropoff" class="form-control custom" placeholder="Dropoff address">
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
        const hiddendriverFare = document.getElementById('drive_fare');


        vehicleCards.forEach(card => {
            card.addEventListener('click', function () {
                const vehicleType = this.querySelector('.card-title').textContent.split('•')[0].trim();
                const price = this.getAttribute('data-price');
                const vehicleId = this.getAttribute('data-vehicle-id');
                const driverFare = this.getAttribute('data-driverFare');

                // Update UI
                selectedVehicleDisplay.querySelector('.card-title').textContent = vehicleType + ' • $' + parseFloat(price).toFixed(2);
                totalPriceElement.textContent = parseFloat(price).toFixed(2);
                // Set hidden inputs
                hiddenVehicleId.value = vehicleId;
                hiddenVehiclePrice.value = price;
                hiddendriverFare.value = driverFare;
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalRideSelection'));
                modal.hide();
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Dispatcher: one entry point for all counter changes
        window.changeCounter = function (counterType, change) {
            if (counterType.startsWith('bulky_')) {
                handleDynamicCounter(counterType, change);
            } else {
                handleStaticCounter(counterType, change);
            }
        };

        // Attach event listeners to all counter buttons
        const buttons = document.querySelectorAll('.counter-btn');
        buttons.forEach(btn => {
            btn.setAttribute('type', 'button'); // prevent accidental form submit
            btn.removeAttribute('onclick');     // remove inline onclicks if any

            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const counterType = btn.dataset.counter;
                const action = btn.dataset.action;
                const change = action === 'increase' ? 1 : -1;

                changeCounter(counterType, change);
            });
        });
    });

    // Handle static counters
    function handleStaticCounter(counterType, change) {
        let visibleId, hiddenId;

        switch (counterType) {
            case 'bags':
                visibleId = 'counterBags';
                hiddenId = 'hiddenBags';
                break;
            case 'handcarry':
                visibleId = 'counterHandCarry';
                hiddenId = 'hiddenHandCarry';
                break;
            case 'babyseats':
                visibleId = 'counterBabySeats';
                hiddenId = 'hiddenBabySeats';
                break;
            case 'boosterseats':
                visibleId = 'counterBoosterSeats';
                hiddenId = 'hiddenBoosterSeats';
                break;
            default:
                return; // not a static counter
        }

        updateCounter(visibleId, hiddenId, change);
    }

    // Handle dynamic bulky counters
    function handleDynamicCounter(counterType, change) {
        // counterType looks like "bulky_3"
        const idNumber = counterType.substring(6); // strip "bulky_"
        const visibleId = `counterBulky_${idNumber}`;
        const hiddenId = `hiddenBulky_${idNumber}`;

        updateCounter(visibleId, hiddenId, change);
    }

    // Shared update function
    function updateCounter(visibleId, hiddenId, change) {
        const visibleInput = document.getElementById(visibleId);
        const hiddenInput = document.getElementById(hiddenId);

        if (!visibleInput) return;

        let value = parseInt(visibleInput.value) || 0;
        value += change;

        if (value < 0) value = 0; // no negatives

        visibleInput.value = value;
        if (hiddenInput) hiddenInput.value = value;
    }
</script>


</body>
</html>