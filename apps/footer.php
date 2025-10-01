<section style="background-color:black;">
  <div class="container ">
      <div class="row text-white montserrat-p">
          <div class="col-sm-9 mt-3">
              <h5 class="montserrat">Contact</h5>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/location.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">Wembley WA 6014</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/call.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">0404 359 777</p>
              </div>
              <div>
                <p class="text-nowrap mt-4">ODBS: 1010295</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src="assets/images/message.png" alt="Location" width="17" height="17">
                <p class="ms-2 mb-0 text-nowrap">luxury@littleblacklimo.com.au</p>
              </div>
              <div class="d-flex align-items-center mt-4">
                <img src=" assets/images/facebook.png" alt="">
                <img src=" assets/images/instagram.png" alt="" class="ms-4">
                <img src=" assets/images/tiktok.png" alt="" class="ms-4">
                <img src=" assets/images/whatsapp.png" alt="" class="ms-4">
              </div>
              
          </div>
          <div class="col-sm-3 mt-3 text-white justify-content-between">
              <h5 class="montserrat">LOCATION</h5>
              <img src="assets/images/map.png" alt="" class="w-100 mb-2">
          </div>
          <div class="col-12">
              <p class="mt-3">©Copyrights 2024 littleblacklimo | All Rights Reserved. Designed by A1 APPS</p>
          </div>
      </div>
  </div>
</section>  
  
  
  
 <?php require_once 'config/config.php'; ?>
 
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Your Custom Script -->
<script src="assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.3.2.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=en&key=<?php echo MAP_KEY; ?>" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            flatpickr("#datetime", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
  });
        </script>




