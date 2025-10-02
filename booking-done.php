<?php
require_once('apps/head.php');
// --------------------------------------------------
// STEP 2: BOOKING CREATION (when user submits passenger form)
// --------------------------------------------------
if (isset($_POST['doneBooking'])) {
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
    print_r($response);
    exit();
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
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
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
    } else {
        // Handle error case
        $errorMessage = htmlspecialchars($result['message'] ?? 'Unknown error occurred');
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Booking Failed',
            text: '{$errorMessage}',
            confirmButtonText: 'Try Again',
            confirmButtonColor: '#d33'
        });
        </script>";
    }
    exit();
}
?>
<body>
<?php require_once('apps/header.php'); ?>

<section class="booking-bg">
    <div class="container">
        <div class="row charm">
            <div class="col-12 text-center mt-5 pt-4 text-white">
                <h1 class="charm">Booking Confirmed</h1>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mt-3 mb-3 pt-sm-5 pb-sm-5 text-center">
                <img src="assets/images/booking-done.svg" alt="" class="booking-done w-100">
            </div>
            <div class="col-sm-6 mt-sm-3 mb-3 pt-sm-5 pb-sm-5 charm">
                <h1 class="charm mt-sm-5 pt-sm-3 text-center">
                    Your booking is confirmed! <br> Thank you for your trust.
                </h1>
                <p class="text-center jakarta">
                    Booking no. <?php echo htmlspecialchars($_GET['ticket_no'] ?? ''); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php require_once('apps/footer.php'); ?>
<script src="assets/js/custom.js"></script>
</body>
</html>
