<!DOCTYPE html>
<html lang="en">
<?php
require_once('apps/head.php');
$bookingId = $_GET['booking_id'] ?? null;

if ($bookingId) {
    $response = curlPost(['booking_id' => $bookingId], 'booking/stripe-cancel');
}
?>
<body>
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Payment Canceled',
        html: 'Your booking has not been charged. You can retry payment anytime.',
        confirmButtonText: 'Return to Home'
    }).then(() => {
        window.location.href = "index.php";
    });
</script>
</body>
</html>
