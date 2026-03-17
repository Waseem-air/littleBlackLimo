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
                <h1 class="grid-center charm pt-sm-5">Contact Us</h1>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
<div class="row ps-0">
    <!-- ✅ Right Side: Contact Form (show first on mobile) -->
    <div class="col-md-6 ps-sm-4 order-1 order-md-2" style="padding-right: 0px !important; padding-left: 0px !important;">
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
            <label for="email_date_time" class="form-label fs-6">Date & Times Required</label>
            <textarea id="email_date_time" name="email_date_time" class="form-control" placeholder="Date & Times Required" rows="4"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-12 text-start">
            <input type="submit" name="sendEmail" class="btn btn-dark px-4 rounded-pill" value="Submit">
          </div>
        </div>
      </form>
    </div>

    <!-- ✅ Left Side: Contact Info (show second on mobile) -->
    <div class="col-md-6 mb-4 mt-4 order-2 order-md-1">
      <h5 class="fw-bold">ADDRESS:</h5>
      <h5 class="fw-bold">Wembley, WA 6014</h5>

      <h5 class="fw-bold mt-5">PHONE:</h5>
      <h5 class="fw-bold">
        <a href="tel:0404359777" class="text-decoration-underline text-dark">0404 359 777</a>
      </h5>

      <h4 class="fw-bold mt-5">EMAIL:</h4>
      <h5 class="fw-bold">
        <a href="mailto:<?php echo CONTACT_US_EMAIL; ?>" class="text-decoration-underline text-dark">
          <?php echo CONTACT_US_EMAIL; ?>
        </a>
      </h5>

      <h4 class="fw-bold mt-5">REFUNDS & CANCELLATION POLICY:</h4>
      <p><strong>Terms and conditions:</strong></p>
      <p>On payment of the invoice, it is the understanding that you are accepting our T & C's as set out below:</p>
      <p>Deposits are refundable up to seven days prior to the booking event with a 10% administration fee deducted. Any cancellations made after seven days prior to the booking event the 50% deposit is forfeited. Refunds are net amount and does not include any credit card fees made on initial payment. If the balance is paid prior to seven days of the booking event, then the whole booking event is cancelled; there would be a 50% cancellation charge, and 50% would be refunded. If the event is cancelled in whole within 48 hours of the event date, 100% is forfeited and not refundable. We do track your flights and we would always endeavor to allocate another team member to your event or flight collection if a collection time were to change out of our or your control. However if this were not possible the following would still apply:</p>
      <p>Cancellations made by Little Black Limo or the client or alterations within 48 hours of booking time that are due to flight delays or customs delays and have an impact on any other of our bookings are also not refundable. We reserve the right to cancel (non-refundable) the booking if you have been delayed in customs (we allow 1 hour from landing) if this were to affect a following booking.</p>
      <p>If rebooking to another date, charges are to be determined at the discretion of the management. Wedding ceremony T & C's are additional and listed separately on the invoice.</p>

      <h4 class="fw-bold mt-5">Social Media Policy:</h4>
      <p>On payment of our invoice, it is understood that any video or photos’ taken may be used in our social media, website or other promotional campaigns. If you do not wish to be included in any of the above platforms in any way, please advise us in writing prior to your event/ booking date. Removal will not be possible after the posting of any promotional content if written consent to be removed has not been received.</p>

      <h4 class="fw-bold mt-5">ADDITIONAL POLICIES:</h4>
      <p>We're always happy to clarify any questions you have.</p>
      <p>1. Alcohol: While it is legal in WA for adults to consume alcohol while travelling in a licensed Small Charter Vehicle (SCV) under some circumstances, it is subject to your driver explicitly approving it. You must ask BEFORE the travel booking day. Spillages are regarded as damage. Major spillages can result in termination of travel without refund.</p>
      <p>2. No Food or Smoking: No food or chewing gum is permitted in our vehicles. Strictly no take-away food, even in unopened containers or bags. Wedding food by prior arrangement. Smoking or Vaping is not permitted in, or around doors of the vehicles.</p>
      <p>3. Damage: Clients are liable for any damage caused to our vehicles either by the client themselves or a member of their travelling party. For wine, champagne, premix or beer, the minimum cleaning fee is A$250. For cosmetics, bodily fluids, vomit or chewing gum the minimum cleaning fee is A$750, plus the cost of any repair or replacement of vehicle parts and components. Our Vape and cigarette smoke deodorisation fee is A$500 per car. Damage caused by scratches or dents caused by luggage (bags/ backpacks) will be passed onto the client at cost price for repair or replacement parts. Damage caused by behaviour will be reported to the Police and costs on forwarded to the client.</p>
      <p>4. Behaviour: We reserve the right to not transport any individual who may be considered to be under the influence of alcohol or displaying signs of intoxication. Passengers who appear intoxicated or behave in an unacceptable manner (rude, anti-social, loud, boisterous, uncoordinated, disorderly, aggressive, etc.) will not be permitted to travel in the car. At the drivers, sole discretion. We may withdraw all vehicles immediately under these circumstances. No refunds!!</p>
      <p>5. Customer Delays (Non Airport): If an appointment should go over the time stated in the booking due to customer-triggered delays, overtime rates may apply. This is to discourage conflicts with other customer bookings and to respect our driver’s availability. Overtime is $3 per minute (per car) after the first 15mins, unless specified otherwise on your booking confirmation.</p>
      <p>6. Payment Default: In the event of a payment default we shall engage a debt collection agency and/or law firm. Any commissions and legal costs will be added to the amount outstanding and form part of the debt. We reserve the right to charge an additional 2.5% admin fee on the cumulative balance, per week overdue.</p>
      <p>7. Unforeseen Circumstances: We cannot assume responsibility for any unforeseen circumstances beyond our control such as traffic, weather, illness, vehicle breakdown, emergency, etc.. Should your requested vehicle be unavailable on the day, we reserve the right to substitute a similar vehicle.</p>
      <p>8. Limits Of Liabilities: In all cases, Little black Limo, it's owners, operators and chauffeurs maximum liability shall be limited to a full refund of monies paid for the contracted transfer in question. We will take due care, but no liability will be assumed beyond consumer laws in WA. You agree not to claim for liquidated damages, consequential loss or for any other eventuality.</p>
      <p>9. Acceptance Of Risk: You acknowledge that all travel involves an element of risk and that some tours offered may be adventurous in nature and may involve personal risk. You hereby assume all such risk and You, your estate, your family, heirs and assigns hereby release Little Black Limo and the Tour Guide from all claims and causes of action whatsoever arising from any injury, death or other damages, both pecuniary and non-pecuniary, to You that may occur as a result of your participation in the tours offered.</p>
      <p>10. Luggage: All luggage will be placed in the rear cargo area, unless a trailer is being used to accommodate luggage. Luggage cannot be carried in the passenger space including back packs or cases. Small handbags or laptop bags permissible inside. Large objects like back packs, luggage cases, golf clubs, surfboards, and snow boards will be otherwise accommodated in a trailer at no liability to Little Black Limo and maybe at additional cost.</p>
    </div>

  </div>
</div>


<?php require_once('apps/footer.php'); ?>

<script src="assets/js/custom.js"></script>
</body>
</html>
