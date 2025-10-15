<!DOCTYPE html>
<html lang="en">
<?php
require_once('apps/head.php');
function showSweetAlert($title, $message = '')
{
    $safeTitle = json_encode($title, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    $safeMessage = json_encode($message, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
    return "
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: $safeTitle,
                html: $safeMessage,
                icon: '',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                width: '600px',
                customClass: {
                    popup: 'swal-custom-popup',
                    title: 'swal-custom-title',
                    htmlContainer: 'swal-custom-text',
                    confirmButton: 'swal-custom-btn'
                },
                buttonsStyling: false
        }).then(() => {
                document.body.style.transition = 'opacity 0.4s ease';
                document.body.style.opacity = '0';
                setTimeout(() => {
                    history.back();
                }, 400);
            });

        });
        </script>

        <style>
        .swal-custom-popup {
            text-align: center;
            padding: 20px;
        }
        .swal-custom-title {
            font-size: 22px !important;
            font-weight: 600;
            text-align: center;
            margin-bottom: 10px;
        }
        .swal-custom-text {
            font-size: 16px;
            text-align: center;
        }
        .swal-custom-text ul {
            list-style-type: none;
            padding: 0;
            display: inline-block;
            text-align: left;
        }
        .swal-custom-text li {
            margin-bottom: 5px;
        }
        .swal-custom-btn {
            background: #333;
            color: #fff;
            border-radius: 6px;
            padding: 8px 20px;
            font-size: 15px;
            cursor: pointer;
        }
        .swal-custom-btn:hover {
            background: #000;
        }
        </style>
    ";
}

/**
 * Handle Fetch Booking Request (Step 1)
 */
if (isset($_REQUEST['fetchBooking'])) {

    // Build request payload
    $postData = [
        'trip_type' => $_REQUEST['trip_type'] ?? '',
        'pick' => $_REQUEST['pick'] ?? '',
        'drop' => $_REQUEST['drop'] ?? '',
        'datetime' => $_REQUEST['datetime'] ?? '',
        'total_passenger' => $_REQUEST['total_passenger'] ?? '',
    ];

    // Optional stops
    if (!empty($_REQUEST['stops']) && is_array($_REQUEST['stops'])) {
        $postData['stops'] = array_filter($_REQUEST['stops']);
    }

    // Send CURL request to fetch vehicles
    $response = curlPost($postData, 'booking/vehicles');
    $bookingData = is_string($response) ? json_decode($response, true) : $response;

    // Handle empty or invalid response
    if (empty($bookingData) || !isset($bookingData['success'])) {
        echo showSweetAlert('API Error', 'Invalid or empty response from the server.');
        exit();
    }

    /**
     * Handle HTTP 422 Validation Errors (e.g., booking days, invalid fields)
     */
    if (isset($bookingData['http_code']) && $bookingData['http_code'] == 422) {
        $errorTitle = $bookingData['message'] ?? 'Validation Error';
        $errorDetails = '';

        if (isset($bookingData['errors']) && is_array($bookingData['errors'])) {
            $errorDetails .= '<ul>';
            foreach ($bookingData['errors'] as $field => $messages) {
                if (is_array($messages)) {
                    foreach ($messages as $msg) {
                        $errorDetails .= '<li>' . htmlspecialchars($msg) . '</li>';
                    }
                } else {
                    $errorDetails .= '<li>' . htmlspecialchars($messages) . '</li>';
                }
            }
            $errorDetails .= '</ul>';
        }

        echo showSweetAlert($errorTitle, $errorDetails);
        exit();
    }

    /**
     * Handle General API Validation Failures
     */
    if (!$bookingData['success']) {
        $errorTitle = $bookingData['message'] ?? 'Validation failed';
        $errorDetails = '';

        // Check if errors exist in the response
        if (isset($bookingData['errors']) && is_array($bookingData['errors'])) {
            $errorDetails .= '<ul>';
            foreach ($bookingData['errors'] as $field => $messages) {
                if (is_array($messages)) {
                    foreach ($messages as $msg) {
                        $errorDetails .= '<li>' . htmlspecialchars($msg) . '</li>';
                    }
                } else {
                    $errorDetails .= '<li>' . htmlspecialchars($messages) . '</li>';
                }
            }
            $errorDetails .= '</ul>';
        } // Some APIs return errors inside 'data'
        elseif (isset($bookingData['data']) && is_array($bookingData['data'])) {
            $errorDetails .= '<ul>';
            foreach ($bookingData['data'] as $field => $messages) {
                if (is_array($messages)) {
                    foreach ($messages as $msg) {
                        $errorDetails .= '<li>' . htmlspecialchars($msg) . '</li>';
                    }
                } else {
                    $errorDetails .= '<li>' . htmlspecialchars($messages) . '</li>';
                }
            }
            $errorDetails .= '</ul>';
        } else {
            $errorDetails = htmlspecialchars($errorTitle);
        }

        echo showSweetAlert($errorTitle, $errorDetails);
        exit();
    }

    // ✅ Success: Extract data
    $vehicles = $bookingData['data']['vehicles'] ?? [];
    $bulkies = $bookingData['data']['bulkies'] ?? [];
    $formData = $bookingData['data']['formData'] ?? [];
    $distance = $bookingData['data']['distance'] ?? [];

    if (empty($vehicles) || empty($formData)) {
        echo showSweetAlert('No Vehicles', 'No vehicles available for your criteria. Please try again with different details.');
        exit();
    }

} else {
    echo showSweetAlert('Invalid Access', 'Please start your booking from the main form.');
    exit();
}
?>

<style>
    .booking-card {
        border: 2px solid transparent;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .booking-card.selected {
        border-color: #333333;
        background-color: #f8f8f8;
    }

    .booking-card:hover {
        background-color: #f5f5f5;
        border-color: #555555;
    }

    .booking-card1 {
        border: 2px solid #333333;
        border-radius: 8px;
        padding: 12px;
        background-color: #f8f8f8;
    }
</style>

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


                                    <?php if (!empty($formData['stops']) && is_array($formData['stops'])): ?>
                                        <div class="dist2">
                                            <p class="title">Stops</p>
                                            <p class="subtitle">
                                                <?php foreach ($formData['stops'] as $stop): ?>
                                                    <span class="stop ms-0"><?= htmlspecialchars($stop) ?></span><br>
                                                <?php endforeach; ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
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
                                            <?php foreach ($vehicles as $index => $vehicle): ?>
                                                <div class="booking-card <?php echo $index === 0 ? 'selected' : ''; ?>"
                                                     data-vehicle-id="<?php echo htmlspecialchars($vehicle['vehicle_uid']); ?>"
                                                     data-price="<?php echo htmlspecialchars($vehicle['fare']); ?>"
                                                     data-driver-fare="<?php echo htmlspecialchars($vehicle['fare_details']['driver_fare'] ?? 0); ?>"
                                                     data-vehicle-type="<?php echo htmlspecialchars($vehicle['vehicle_type']); ?>"
                                                     data-vehicle-image="<?php echo $vehicle['vehicle_image']; ?>"
                                                     data-person-allowed="<?php echo $vehicle['person_allowed']; ?>"
                                                     data-no-of-seats="<?php echo $vehicle['no_of_seats']; ?>">

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
                                                                    <span><?php echo $vehicle['hand_carry']; ?></span>

                                                                    <img src="assets/images/wpf_luggage-trolley.png"
                                                                         class="cardimg" alt="">
                                                                    <span><?php echo $vehicle['luggage_allowed']; ?></span>
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


                                <div class="form-group mt-3">
                                    <?php if (CASH_PAYMENT == 1 || STRIPE_PAYMENT == 1): ?>
                                        <label class="fw-bold d-block mb-3">Make your payment :</label>

                                        <div class="row">
                                            <?php if (STRIPE_PAYMENT == 1): ?>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <div class="form-check p-3 border rounded shadow-sm h-100">
                                                        <input class="form-check-input me-2" type="radio" name="payment_type"
                                                               id="payment_stripe" value="Card" checked>
                                                        <label class="form-check-label fw-semibold" for="payment_stripe">
                                                            Pay Now (Card)
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (CASH_PAYMENT == 1): ?>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <div class="form-check p-3 border rounded shadow-sm h-100">
                                                        <input class="form-check-input me-2" type="radio" name="payment_type"
                                                               id="payment_cash" value="Cash">
                                                        <label class="form-check-label fw-semibold" for="payment_cash">
                                                            Pay Cash at Pickup
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
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
                                <button type="submit" class="total-btn">Book Now</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- Map Section -->

            <?php
            $origin = urlencode($formData['pick'] ?? '');
            $destination = urlencode($formData['drop'] ?? '');
            $waypoints = '';
            if (!empty($formData['stops']) && is_array($formData['stops'])) {
                $waypointsArr = array_map('urlencode', $formData['stops']);
                $waypoints = '&waypoints=' . implode('|', $waypointsArr);
            }
            ?>

            <div class="col-lg-6 col-12 embed-responsive d-none d-lg-block">
                <?php if (!empty($formData['pick']) && !empty($formData['drop'])): ?>
                    <iframe
                            src="https://www.google.com/maps/embed/v1/directions?origin=<?= $origin; ?>&destination=<?= $destination; ?><?= $waypoints; ?>&key=<?= MAP_KEY; ?>"
                            class="embed-responsive-item"
                            frameborder="0"
                            style="border:0; width: 100%; height: 100%"
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
<?php require_once('apps/multi_stops_popup.php'); ?>
<!-- Booking End -->
<!-- bookin detail End -->
<?php require_once('apps/footer.php'); ?>
<script src="assets/js/custom.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const vehicleCards = document.querySelectorAll('.booking-card');
        const selectedVehicleDisplay = document.getElementById('selected-vehicle');
        const totalPriceElement = document.getElementById('total-price');

        const hiddenVehicleId = document.getElementById('vehicle_id');
        const hiddenVehiclePrice = document.getElementById('vehicle_price');
        const hiddenDriverFare = document.getElementById('driver_fare');

        // Function to update the selected vehicle display
        function updateSelectedVehicle(card) {
            const vehicleType = card.getAttribute('data-vehicle-type');
            const price = card.getAttribute('data-price');
            const vehicleId = card.getAttribute('data-vehicle-id');
            const driverFare = card.getAttribute('data-driver-fare');
            const vehicleImage = card.getAttribute('data-vehicle-image');
            const personAllowed = card.getAttribute('data-person-allowed');
            const noOfSeats = card.getAttribute('data-no-of-seats');
            selectedVehicleDisplay.querySelector('.card-title').textContent = vehicleType + ' • $' + parseFloat(price).toFixed(2);
            totalPriceElement.textContent = parseFloat(price).toFixed(2);
            selectedVehicleDisplay.querySelector('.cardimg[src*=".svg"]').src = "<?php echo $IMG_URL; ?>" + vehicleImage + '.svg';
            const extras = selectedVehicleDisplay.querySelectorAll('.extras span');
            if (extras.length >= 3) {
                extras[0].textContent = personAllowed;
                extras[1].textContent = noOfSeats;
                extras[2].textContent = noOfSeats;
            }
            hiddenVehicleId.value = vehicleId;
            hiddenVehiclePrice.value = price;
            hiddenDriverFare.value = driverFare;
        }

        vehicleCards.forEach(card => {
            card.addEventListener('click', function () {
                vehicleCards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                updateSelectedVehicle(this);
                // // Close modal
                // const modal = bootstrap.Modal.getInstance(document.getElementById('modalRideSelection'));
                // modal.hide();
            });
        });

        // Initialize with the first vehicle selected by default
        if (vehicleCards.length > 0) {
            vehicleCards[0].classList.add('selected');
        }
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