  <nav class="navbar navbar-expand-lg bg-color p-0 m-0">
        <div class="container d-flex align-items-center justify-content-between p-2">

            <!-- ✅ Left side (mobile): Toggle + Logo -->
            <div class="d-flex align-items-center order-0">
                <button class="navbar-toggler d-lg-none me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand mb-0 p-0 d-none d-lg-flex" href="index.php">
                    <img src="assets/images/logo.svg" alt="Logo" class="nav-logo">
                </a>

                <a class="navbar-brand mb-0 p-0 d-flex d-lg-none" href="index.php">
                    <img src="assets/images/mobile-logo.svg" alt="Logo">
                </a>
            </div>

            <!-- ✅ Mobile Book Now Button (right side) -->
            <a href="booking.php"
                class="btn bg-white text-dark montserrat d-flex align-items-center justify-content-center text-center d-lg-none order-2 nav-mb-button fs-6">
                Book now
            </a>

            <!-- ✅ Collapsible Menu -->
            <div class="collapse navbar-collapse order-3 order-lg-1" id="navbarTogglerDemo03">
                <ul class="navbar-nav mb-2 mb-lg-0 jakarta">
                    <li class="nav-item px-lg-2"><a class="nav-link text-lg-white" href="index.php">Home</a></li>
                    <li class="nav-item px-lg-2"><a class="nav-link text-lg-white" href="why.php">Our Why</a></li>
                    <li class="nav-item px-lg-2"><a class="nav-link text-lg-white" href="weeding.php">Wedding & Events</a></li>

                    <li class="nav-item dropdown px-lg-2">
                        <a class="nav-link dropdown-toggle text-lg-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            What We Do
                        </a>
                        <ul class="dropdown-menu p-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-lg-white" href="winery.php">Winery or Coastal Drive</a></li>
                            <li><a class="dropdown-item text-lg-white" href="corporate-service.php">Corporate Services</a></li>
                            <li><a class="dropdown-item text-lg-white" href="transfer.php">Airport Transfers</a></li>
                        </ul>
                    </li>

                    <li class="nav-item px-lg-2"><a class="nav-link text-lg-white" href="selfie.php">Selfies</a></li>
                    <li class="nav-item px-lg-2"><a class="nav-link text-lg-white" href="extras.php">Extras</a></li>
                    <li class="nav-item px-lg-3"><a class="nav-link text-lg-white" href="contact-us.php">Contact Us</a></li>
                </ul>

                <!-- ✅ Desktop Book Now Button -->
              <a href="booking.php"
   class="btn bg-white text-dark nav-button montserrat d-flex align-items-center justify-content-center text-center text-decoration-none mobile-booknow">
  Book now
</a>


            </div>
        </div>
    </nav>