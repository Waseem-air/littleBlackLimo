<!DOCTYPE html>
<html lang="en">
<?php
require_once('apps/head.php');

/**
 * Show SweetAlert popup without icon (centered content)
 */
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
    ";
}

// Handle contact form submission
if (isset($_POST['sendEmail'])) {
    $postData = [
        'name'        => $_POST['email_name'] ?? '',
        'email'       => $_POST['email_address'] ?? '',
        'phone'       => $_POST['email_phone'] ?? '',
        'message'     => $_POST['email_description'] ?? '',
        'datetime'    => $_POST['email_date_time'] ?? ''
    ];

    $response = curlPost($postData, 'send/contactusemail');
    $result = is_string($response) ? json_decode($response, true) : $response;

    if (!empty($result['success']) && $result['success'] === true) {
        echo showSweetAlert('Message Sent', 'Thank you! Your message has been successfully sent.');
    } else {
        $errorMessage = htmlspecialchars($result['message'] ?? 'Unknown error occurred');
        echo showSweetAlert('Error', $errorMessage);
    }
}
?>

<body>
<?php require_once('apps/header.php'); ?>

<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5 mt-5 vertical-center text-white">
                <h1 class="grid-center charm pt-5">Contact Us</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">

        <!-- Left Side: Contact Info -->
        <div class="col-md-6 mb-4">
            <h5 class="fw-bold">ADDRESS:</h5>
            <h5 class="fw-bold">Wembley, WA 6014</h5>

            <h5 class="fw-bold mt-5">PHONE:</h5>
            <h5 class="fw-bold"><a href="tel:0404359777" class="text-decoration-underline text-dark">0404 359 777</a></h5>

            <h4 class="fw-bold mt-5">EMAIL:</h4>
            <h5 class="fw-bold"><a href="mailto:<?php echo CONTACT_US_EMAIL; ?>" class="text-decoration-underline text-dark"><?php echo CONTACT_US_EMAIL; ?></a></h5>

            <h4 class="fw-bold mt-5">REFUNDS & CANCELLATION POLICY:</h4>
            <p><strong>Terms and conditions:</strong> On payment of the invoice, it is the understanding that you are accepting our T & C's as set out below:</p>
            <p>Deposits are refundable up to seven days prior to the booking event with a 10% administration fee deducted. Any cancellations made after seven days prior to the booking event the 50% deposit is forfeited. Refunds are net amount and does not include credit card fees.</p>
            <p>If the balance is paid prior to seven days of the booking event, then the whole booking event is cancelled. There would be a 50% cancellation charge, and 50% would be refunded. If the event is cancelled in whole within 48 hours of the event date, 100% is forfeited and not refundable.
Cancellations made by Little Black Limo or the client or alterations within 48 hours of booking time that are due to flight delays or customs delays and have an impact on our following bookings are not refundable. We reserve the right to cancel (non-refundable) the booking if you have been delayed in customs (we allow 1 hour from landing) if this were to affect a following booking.</p>
            <p>If rebooking to another date, charges are to be determined at the discretion of the management.</p>
            <p>Wedding ceremony T & C's are additional and listed on the invoice.</p>
        </div>

        <!-- Right Side: Contact Form -->
        <div class="col-md-6 ps-sm-4">
            <h3 class="fs-1 charm mb-4">Get In Touch with Us</h3>
            <form method="post">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <input type="text" name="email_name" required class="form-control rounded-pill" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email_address" required class="form-control rounded-pill" placeholder="Email">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <input type="text" name="email_phone" required class="form-control rounded-pill" placeholder="Phone">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="message" class="form-label fs-6">Message</label>
                        <textarea id="message" name="email_description" required class="form-control" rows="4" placeholder="Message"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="message" class="form-label fs-6">Date & Time Required</label>
                        <textarea id="datetime" name="email_date_time" class="form-control datetime" placeholder="Date & Times Required"  rows="4"></textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 text-start">
                        <input type="submit" name="sendEmail" class="btn btn-dark px-4 rounded-pill" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<?php require_once('apps/footer.php'); ?>

<script src="assets/js/custom.js"></script>
</body>
</html>
