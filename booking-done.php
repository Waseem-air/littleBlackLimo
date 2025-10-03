<!DOCTYPE html>
<html lang="en">
<?php
require_once('apps/head.php');
function showSweetAlert($title, $message = '')
{
    return "
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: '$title',
                html: '$message',
                icon: null,
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

$bookingSuccess = false;
$errorMessage = '';
$ticketNo = '';
$bookingData = [];
if (isset($_POST['doneBooking'])) {
    // Base booking data
    $postData = [
        'trip_type'       => $_POST['trip_type']       ?? '',
        'pick'            => $_POST['pick']            ?? '',
        'drop'            => $_POST['drop']            ?? '',
        'date'            => $_POST['date']            ?? '',
        'time'            => $_POST['time']            ?? '',
        'total_passenger' => $_POST['total_passenger'] ?? '',
        'vehicle_id'      => $_POST['vehicle_id']      ?? '',
        'fare'            => $_POST['fare']            ?? '',
        'driver_fare'     => $_POST['driver_fare']     ?? '',
        'distance_text'   => $_POST['distance_text']   ?? '',
        'distance'        => $_POST['distance']        ?? '',
        'minutes'         => $_POST['minutes']         ?? '',
        'pickcordinate'   => $_POST['pickcordinate']   ?? '',
        'dropcordinate'   => $_POST['dropcordinate']   ?? '',
        'stops'           => $_POST['stops']           ?? [],
        'firstname'       => $_POST['firstname']       ?? '',
        'lastname'        => $_POST['lastname']        ?? '',
        'email'           => $_POST['email']           ?? '',
        'phone'           => $_POST['phone']           ?? '',
        'notes'           => $_POST['notes']           ?? '',
    ];

    // Extras
    $postData['extras'] = [
        'baggage'   => (int)($_POST['baggeg'] ?? 0),
        'handcarry' => (int)($_POST['hand_carry'] ?? 0),
        'babyseats' => (int)($_POST['noofbaby'] ?? 0),
        'boosters'  => (int)($_POST['noofbooster'] ?? 0),
    ];

    // Bulk items
    $bulkItems = $_POST['bulkItems'] ?? [];
    $postData['bulkies'] = $bulkItems;
    // Call API
    $result = curlPost($postData, 'booking/create');
    // Handle success
    if ($result['success']) {
        $bookingSuccess = true;
        $ticketNo = htmlspecialchars($result['data']['ticket_no'] ?? 'N/A');
        $bookingData = $result['data']; // Store all booking data

        // NO SweetAlert for success - just set variables for HTML

    } else {
        // Handle errors (validation + message)
        $errorTitle = htmlspecialchars($result['message'] ?? 'Booking Failed');
        $errorHtml = "<div style='text-align:center;'><ul>";

        if (!empty($result['errors']) && is_array($result['errors'])) {
            foreach ($result['errors'] as $field => $errors) {
                if (is_array($errors)) {
                    foreach ($errors as $error) {
                        $errorHtml .= "<li>" . htmlspecialchars($error) . "</li>";
                    }
                } else {
                    $errorHtml .= "<li>" . htmlspecialchars($errors) . "</li>";
                }
            }
        } else {
            $errorHtml .= "<li>$errorTitle</li>";
        }

        $errorHtml .= "</ul></div>";

        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '$errorTitle',
                html: `$errorHtml`,
                icon: null,
                showConfirmButton: true,
                confirmButtonText: 'Try Again',
                width: '600px'
            });
        });
        </script>";
    }
}
?>
<body>
<?php require_once('apps/header.php'); ?>
<?php if ($bookingSuccess): ?>
    <section class="booking-bg">
        <div class="container">
            <div class="row charm">
                <div class="col-12 text-center mt-5 pt-4 text-white">
                    <h1 class="charm">Booking Confirmed</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background:#f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">

                            <!-- Success Icon -->
                            <div class="text-center mb-3">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
                            </div>

                            <!-- Thank You -->
                            <div class="text-center mb-2">
                                <p class="fw-bold fs-5 mb-0">Thank you, <span class="text-primary"><?php echo htmlspecialchars($bookingData['firstname'] ?? '') . ' ' . htmlspecialchars($bookingData['lastname'] ?? ''); ?></span>!</p>
                            </div>

                            <!-- Booking Processed -->
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-0">We've processed your booking</h2>
                                <small class="text-muted">Your trip details are below</small>
                            </div>

                            <!-- Booking No -->
                            <div class="text-center mb-3">
                                <span class="badge bg-dark fs-6 px-3 py-2">Booking #<?php echo $ticketNo; ?></span>
                            </div>

                            <!-- Email -->
                            <div class="text-center mb-4">
                                <p class="text-muted mb-0">
                                    We'll send more details to <span class="fw-semibold"><?php echo htmlspecialchars($bookingData['email'] ?? ''); ?></span>
                                </p>
                            </div>

                            <!-- Summary Section -->
                            <div class="p-4 bg-light rounded-4">
                                <h5 class="fw-bold mb-4">Summary</h5>

                                <!-- Pick-up -->
                                <div class="mb-3">
                                    <p class="fw-semibold mb-1">Pick-up</p>
                                    <p class="mb-0">
                                        <?php
                                        $pickupDate = $bookingData['date'] ?? '';
                                        $pickupTime = $bookingData['time'] ?? '';
                                        if ($pickupDate && $pickupTime) {
                                            echo date('d M Y- g:i a', strtotime($pickupDate . ' ' . $pickupTime));
                                        } else {
                                            echo 'Date not specified';
                                        }
                                        ?>
                                    </p>
                                    <p class="text-muted small mb-0"><?php echo htmlspecialchars($bookingData['pick'] ?? ''); ?></p>
                                </div>

                                <!-- Drop-off -->
                                <div class="mb-3">
                                    <p class="fw-semibold mb-1">Drop-off</p>
                                    <p class="mb-0">
                                        <?php
                                        if ($pickupDate && $pickupTime && isset($bookingData['minutes'])) {
                                            $duration = (int)$bookingData['minutes'];
                                            $arrivalTime = date('g:i a', strtotime($pickupDate . ' ' . $pickupTime . ' + ' . $duration . ' minutes'));
                                            echo date('d M Y', strtotime($pickupDate)) . ' - ' . $arrivalTime;
                                        } else {
                                            echo 'Time not calculated';
                                        }
                                        ?>
                                    </p>
                                    <p class="text-muted small mb-0"><?php echo htmlspecialchars($bookingData['drop'] ?? ''); ?></p>
                                </div>
                                <hr>

                                <!-- Total -->
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold fs-5">Total</span>
                                    <span class="fw-bold fs-5 text-dark">$<?php echo number_format($bookingData['fare'] ?? 0, 2); ?></span>
                                </div>
                                <p class="text-end text-muted small mb-0">GST included</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-center mt-4">
                                <a href="index.php" class="btn bg-dark text-white text-center px-4 py-2">
                                    Make Another Booking
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <!-- Error State -->
    <section class="booking-bg">
        <div class="container">
            <div class="row charm">
                <div class="col-12 text-center mt-5 pt-4 text-white">
                    <h1 class="charm">Booking Status</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5" style="background:#f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5 text-center">
                            <!-- Error Icon -->
                            <div class="text-center mb-3">
                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 3.5rem;"></i>
                            </div>

                            <h2 class="fw-bold text-danger mb-3">Booking Failed</h2>
                            <p class="text-muted mb-4">Please check the popup message for details and try again.</p>

                            <div class="d-flex justify-content-center gap-3">
                                <a href="index.php" class="btn btn-primary">Try Again</a>
                                <a href="contact-us.php" class="btn btn-outline-secondary">Contact Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php require_once('apps/footer.php'); ?>
<script src="assets/js/custom.js"></script>
</body>
</html>