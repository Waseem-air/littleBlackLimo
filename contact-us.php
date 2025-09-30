<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
<body>
  <?php require_once('apps/header.php'); ?>
  
      <section class="contact-section " >
          <div class="container">
              <div class="row ">
                  <div class="col-12 pt-5 mt-5 vertical-center text-white">
                      <h1 class="grid-center charm pt-5 ">Contact Us</h1>
                  </div>
              </div>
               
          </div>
      </section>
      <div class="container py-5">
        <div class="row">
          
          <!-- Left Side -->
          <div class="col-md-6 mb-4">
            <h5 class="fw-bold">ADDRESS:</h5>
            <h5 class="fw-bold">Wembley. WA 6014</h5>

            <h5 class="fw-bold mt-5">PHONE:</h5>
            <h5 class="fw-bold "><a href="" class="text-decoration-underline text-dark">0404 359 777</a></h5>


            <h4 class="fw-bold mt-5">EMAIL:</h4>
            <h5 class="fw-bold text-decoration-underline"><a href="" class="text-decoration-underline text-dark">luxury@littleblacklimo.com.au</a></h5>

            <h4 class="fw-bold mt-5">REFUNDS & CANCELLATION POLICY:</h4>
            <p>
              <strong>Terms and conditions:</strong> On payment of the invoice, it is the understanding that you are
              accepting our T & C's as set out below:
            </p>
            <p>
              Deposits are refundable up to seven days prior to the booking event with a 10% administration fee deducted.
              Any cancellations made after seven days prior to the booking event the 50% deposit is forfeited.
              Refunds are net amount and do not include credit card fees.
            </p>
            <p>
              If the balance is paid prior to seven days of the booking event, then the whole booking event is cancelled.
              There would be a 50% cancellation charge, and 50% would be refunded. If the event is cancelled in whole within
              48 hours of the event date, 100% is forfeited and not refundable.
            </p>
            <p>
              Cancellations made by Little Black Limo or the client or alterations within 48 hours of booking time that are
              due to flight delays or customs delays and have an impact on our following bookings are not refundable. We
              reserve the right to cancel (non-refundable) the booking if you have been delayed in customs (we allow 1 hour
              from landing) if this were to affect a following booking.
            </p>
            <p>
              If rebooking to another date, charges are to be determined at the discretion of the management. Wedding
              ceremony T & C's are additional and listed on the invoice.
            </p>
          </div>

          <!-- Right Side -->
          <div class="col-md-6 ps-sm-4">
            <h3 class="fs-1 charm mb-4">Get In Touch with Us</h3>
            <form>
             <div class="row mb-3">
                  <div class="col-md-6 mb-3 mb-md-0">
                    <input type="text" class="form-control rounded-pill form-text " placeholder="Name">
                  </div>
                  <div class="col-md-6">
                    <input type="email" class="form-control rounded-pill form-text " placeholder="Email">
                  </div>
                </div>

                <!-- Row 2: Phone -->
                <div class="row mb-3">
                  <div class="col-12">
                    <input type="text" class="form-control form-text  rounded-pill" placeholder="Phone">
                  </div>
                </div>

                <!-- Row 3: Message -->
                <div class="row mb-3">
                  <div class="col-12">
                    <label for="message" class="form-label form-text fs-6">Message</label>
                    <textarea id="message" class="form-control form-text  " rows="4" placeholder="Message"></textarea>
                  </div>
                </div>

                <!-- Row 4: Date & Times Required -->
               <div class="row mb-3">
              <div class="col-12">
                <label for="datetime" class="form-label form-text fs-6">Date & Time Required</label>
                <div class="form-group position-relative">
                  <!-- Icon -->
                  <img src="assets/images/calendar_month.svg" class="form-img-c" alt="">
                  
                  <!-- Input -->
                  <input type="text" id="datetime" class="form-control input-custom rounded-pill form-text" placeholder="Select Date & Time">
                </div>
              </div>
              </div>

                <!-- Submit Button -->
                <div class="row">
                  <div class="col-12 text-start">
                    <button type="submit" class="btn btn-dark px-4 rounded-pill">Submit</button>
                  </div>
                </div>

            </form>
          </div>

        </div>
      </div>



  

  <?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>

 <script>
    flatpickr("#datetime", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });

 </script>
</body>
</html>