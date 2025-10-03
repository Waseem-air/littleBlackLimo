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
            <p><strong>Terms and conditions:</strong> On payment of the invoice, it is the understanding that you accept our T & C's...</p>
            <p>Deposits are refundable up to seven days prior to the booking event with a 10% administration fee deducted...</p>
            <p>Additional policies apply as described above...</p>
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
                        <label for="datetime" class="form-label fs-6">Date & Time Required</label>
                        <input type="text" id="datetime" name="email_date_time" required class="form-control datetime" placeholder="Select date & time">
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
<script>
    flatpickr(".datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: new Date(Date.now() + 48 * 60 * 60 * 1000) // 48 hours from now
    });
</script>
</body>
</html>
