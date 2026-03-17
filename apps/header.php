  <nav class="navbar navbar-expand-lg bg-color p-0 m-0">
        <div class="container-fluid container-fluid-header px-3 py-2 position-relative">
            <!-- Mobile View: Toggle + Centered Logo + Book Now -->
            <div class="d-flex w-100 align-items-center justify-content-between d-lg-none">
                <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand m-0 p-0 position-absolute start-50 translate-middle-x" href="index.php">
                    <img src="assets/images/mobile-logo.svg" alt="Logo" style="height: 40px;">
                </a>

                <a href="booking.php"
                    class="btn bg-white text-dark montserrat nav-mb-button d-flex align-items-center justify-content-center">
                    Book now
                </a>
            </div>

            <!-- Desktop View: Logo (Hidden on Mobile) -->
            <a class="navbar-brand d-none d-lg-flex" href="index.php">
                <img src="assets/images/logo.svg" alt="Logo" class="nav-logo">
            </a>

            <!-- Collapsible Menu -->
            <div class="collapse navbar-collapse order-3 order-lg-1" id="navbarTogglerDemo03">
                <ul class="navbar-nav mx-auto mb-lg-0 jakarta">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="why.php">Our Why</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="weeding.php">Wedding & Events</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            What We Do <span class="submenu-icon-down"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="winery.php">Winery or Coastal Drive</a></li>
                            <li><a class="dropdown-item" href="corporate-service.php">Corporate Services</a></li>
                            <li><a class="dropdown-item" href="transfer.php">Airport Transfers</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="limoDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Limo Vans & Coaches <span class="submenu-icon-down"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="limoDropdown">
                            <li><a class="dropdown-item" href="mercedes-limo-van.php">Mercedes Limo Van</a></li>
                            <li><a class="dropdown-item" href="corporate-limo-van.php">Corporate Limo Van</a></li>
                            <li><a class="dropdown-item" href="wine-tours-events.php">Wine Tours & Events</a></li>
                            <li><a class="dropdown-item" href="mini-coach.php">Mini Coach</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link text-white" href="selfie.php">Selfies</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="extras.php">Extras</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contact-us.php">Contact Us</a></li>
                </ul>

                <!-- Desktop Book Now Button -->
                <a href="booking.php"
                    class="btn bg-white text-dark nav-button montserrat d-flex align-items-center justify-content-center text-center text-decoration-none mobile-booknow">
                    Book now
                </a>
            </div>
        </div>
    </nav>