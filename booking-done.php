<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
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