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
        'driver_fare' => $_POST['driver_fare'] ?? '',
        'distance_text' => $_POST['distance_text'] ?? '',
        'distance' => $_POST['distance'] ?? '',
        'minutes' => $_POST['minutes'] ?? '',
        'pickcordinate' => $_POST['pickcordinate'] ?? '',
        'dropcordinate' => $_POST['dropcordinate'] ?? '',
        'stops' => $_POST['stops'] ?? [],
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
    $result = curlPost($postData, 'booking/create');

    // Handle booking creation response
    if ($result['success']) {
        $bookingSuccess = true;
        $ticketNo = htmlspecialchars($result['data']['ticket_no'] ?? 'N/A');

        // Success message with booking details
        $successHtml = "
        <div style='text-align: left;'>
            <p><strong>🚗 Booking Confirmed!</strong></p>
            <p><strong>Ticket Number:</strong> {$ticketNo}</p>
            <p><strong>From:</strong> " . htmlspecialchars($result['data']['pick'] ?? '') . "</p>
            <p><strong>To:</strong> " . htmlspecialchars($result['data']['drop'] ?? '') . "</p>
            <p><strong>Date & Time:</strong> " . htmlspecialchars($result['data']['date'] ?? '') . " " . htmlspecialchars($result['data']['time'] ?? '') . "</p>
            <p><strong>Passenger:</strong> " . htmlspecialchars($result['data']['firstname'] ?? '') . " " . htmlspecialchars($result['data']['lastname'] ?? '') . "</p>
            <p><strong>Phone:</strong> " . htmlspecialchars($result['data']['phone'] ?? '') . "</p>
            <p><strong>Total Fare:</strong> $" . htmlspecialchars($result['data']['fare'] ?? '') . "</p>
        </div>";

        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Booking Created Successfully!',
                html: `{$successHtml}`,
                confirmButtonText: 'View Booking',
                confirmButtonColor: '#28a745',
                width: '600px'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'booking-done.php?ticket_no={$ticketNo}';
                }
            });
        });
        </script>";

    } else {
        $bookingSuccess = false;
        $errorMessage = htmlspecialchars($result['message'] ?? 'Unknown error occurred during booking');

        // Error message with details
        $errorDetails = "<div style='text-align: left;'>";

        // Add validation errors if available
        if (!empty($result['errors'])) {
            $errorDetails .= "<p><strong>Validation Errors:</strong></p><ul style='margin: 10px 0;'>";
            foreach ($result['errors'] as $field => $errors) {
                if (is_array($errors)) {
                    foreach ($errors as $error) {
                        $errorDetails .= "<li><strong>" . htmlspecialchars($field) . ":</strong> " . htmlspecialchars($error) . "</li>";
                    }
                } else {
                    $errorDetails .= "<li><strong>" . htmlspecialchars($field) . ":</strong> " . htmlspecialchars($errors) . "</li>";
                }
            }
            $errorDetails .= "</ul>";
        }

        // Add HTTP status code
        if (!empty($result['http_code'])) {
            $errorDetails .= "<p><strong>Status Code:</strong> " . htmlspecialchars($result['http_code']) . "</p>";
        }

        $errorDetails .= "</div>";

        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Booking Failed',
                html: `{$errorDetails}`,
                confirmButtonText: 'Try Again',
                confirmButtonColor: '#d33',
                width: '600px'
            });
        });
        </script>";
    }
}

// If no booking attempt, show error
if (!isset($_POST['doneBooking'])) {
    echo showSweetAlert('error', 'Invalid Access', 'Please start from the booking form.');
}
?>
<body>
  <?php require_once('apps/header.php'); ?>
  
    <section class="booking-bg" >
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
              <p class="fw-bold fs-5 mb-0">Thank you, <span class="text-primary">John Doe</span>!</p>
            </div>

            <!-- Booking Processed -->
            <div class="text-center mb-4">
              <h2 class="fw-bold mb-0">We've processed your booking</h2>
              <small class="text-muted">Your trip details are below</small>
            </div>

            <!-- Booking No -->
            <div class="text-center mb-3">
              <span class="badge bg-dark fs-6 px-3 py-2">Booking #ABC12345</span>
            </div>

            <!-- Email -->
            <div class="text-center mb-4">
              <p class="text-muted mb-0">
                We'll send more details to <span class="fw-semibold">john.doe@example.com</span>
              </p>
            </div>

            <!-- Summary Section -->
            <div class="p-4 bg-light rounded-4">
              <h5 class="fw-bold mb-4">Summary</h5>

              <!-- Pick-up -->
              <div class="mb-3">
                <p class="fw-semibold mb-1">Pick-up</p>
                <p class="mb-0">Mon, Oct 14 - 10:00 am</p>
                <p class="text-muted small mb-0">123 Main Street, Wembley WA</p>
              </div>

              <!-- Drop-off -->
              <div class="mb-3">
                <p class="fw-semibold mb-1">Drop-off</p>
                <p class="mb-0">Mon, Oct 14 - 10:45 am</p>
                <p class="text-muted small mb-0">456 City Centre, Perth WA</p>
              </div>

              <hr>

              <!-- Fare Breakdown -->
              <div class="d-flex justify-content-between mb-2">
                <span>Base fare</span>
                <span>$50.00</span>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <span>Passengers × 2</span>
                <span>$0.00</span>
              </div>

              <hr>

              <!-- Total -->
              <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="fw-bold fs-5">Total</span>
                <span class="fw-bold fs-5 text-dark">$50.00</span>
              </div>
              <p class="text-end text-muted small mb-0">GST included</p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  

  <?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>
</body>
</html>