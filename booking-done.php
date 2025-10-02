<?php
require_once('apps/head.php');

$bookingSuccess = false;
$errorMessage = '';
$ticketNo = '';

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
        'drive_fare' => $_POST['drive_fare'] ?? '',
        'distance_text' => $_POST['distance_text'] ?? '',
        'distance' => $_POST['distance'] ?? '',
        'minutes' => $_POST['minutes'] ?? '',
        'pickcordinate' => $_POST['pickcordinate'] ?? '',
        'dropcordinate' => $_POST['dropcordinate'] ?? '',
        'firstname' => $_POST['firstname'] ?? '',
        'lastname' => $_POST['lastname'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'notes' => $_POST['notes'] ?? '',
    ];

    // Extras
    $postData['extras'] = [
        'baggage' => (int)($_POST['baggeg'] ?? 0),
        'handcarry' => (int)($_POST['hand_carry'] ?? 0),
        'babyseats' => (int)($_POST['noofbaby'] ?? 0),
        'boosters' => (int)($_POST['noofbooster'] ?? 0),
    ];

    // Bulk items
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

    if (!empty($result['success']) && $result['success'] === true) {
        $bookingSuccess = true;
        $ticketNo = htmlspecialchars($result['data']['ticket_no'] ?? '');
    } else {
        $bookingSuccess = false;
        $errorMessage = htmlspecialchars($result['message'] ?? 'Unknown error occurred');
    }
}
?>
<body>
<?php require_once('apps/header.php'); ?>

<section class="booking-bg">
    <div class="container">
        <div class="row charm">
            <div class="col-12 text-center mt-5 pt-4 text-white">
                <h1 class="charm">
                    <?php echo $bookingSuccess ? 'Booking Confirmed' : 'Booking Failed'; ?>
                </h1>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <?php if ($bookingSuccess): ?>
                <div class="col-sm-6 mt-3 mb-3 pt-sm-5 pb-sm-5 text-center">
                    <img src="assets/images/booking-done.svg" alt="" class="booking-done w-100">
                </div>
                <div class="col-sm-6 mt-sm-3 mb-3 pt-sm-5 pb-sm-5 charm">
                    <h1 class="charm mt-sm-5 pt-sm-3 text-center">
                        Your booking is confirmed! <br> Thank you for your trust.
                    </h1>
                    <p class="text-center jakarta">
                        Ticket No. <?php echo $ticketNo; ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="col-12 text-center mt-5 mb-5">
                    <h2 class="text-danger">❌ Booking Failed</h2>
                    <p><?php echo $errorMessage; ?></p>
                    <a href="index.php" class="btn btn-primary mt-3">Try Again</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once('apps/footer.php'); ?>
<script src="assets/js/custom.js"></script>
</body>
</html>
