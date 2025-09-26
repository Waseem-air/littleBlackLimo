<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
<body>
  <?php require_once('apps/header.php'); ?>

<div id="simpleCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/slider.png" class="d-block w-100" alt="1">
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider.png" class="d-block w-100" alt="2">
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider.png" class="d-block w-100" alt="3">
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider.png" class="d-block w-100" alt="4">
    </div>
    <div class="carousel-item">
      <img src="assets/images/slider.png" class="d-block w-100" alt="5">
    </div>
  </div>

  <!-- custom indicators (buttons include <img>) -->
  <div class="carousel-indicators custom-indicators">
    <button type="button" data-bs-target="#simpleCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
      <img src="assets/images/custom-circle.png" alt="dot 1">
    </button>
    <button type="button" data-bs-target="#simpleCarousel" data-bs-slide-to="1" aria-label="Slide 2">
      <img src="assets/images/custom-circle.png" alt="dot 2">
    </button>
    <button type="button" data-bs-target="#simpleCarousel" data-bs-slide-to="2" aria-label="Slide 3">
      <img src="assets/images/custom-circle.png" alt="dot 3">
    </button>
    <button type="button" data-bs-target="#simpleCarousel" data-bs-slide-to="3" aria-label="Slide 4">
      <img src="assets/images/custom-circle.png" alt="dot 4">
    </button>
    <button type="button" data-bs-target="#simpleCarousel" data-bs-slide-to="4" aria-label="Slide 5">
      <img src="assets/images/custom-circle.png" alt="dot 5">
    </button>
  </div>
</div>



<!-- Travel and Tour Section Start -->
<section id="travel-tour" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h1 class="fw-bold mb-4">Where travel and luxury meet</h1>
        
        <p class="mb-3">
          Our commitment to making every person feel welcome, cared for, and at home,
          forms the very fabric of Little Black Limo.
        </p>
        
        <p>
          Little Black Limo provides luxury transportation for weddings, wine tours,
          airport transfers, events, and corporate functions. With two luxury vehicles
          servicing the CBD and surrounding suburbs, Little Black Limo is the one-stop-shop
          for your <br> transportation needs.
        </p>
        
        <p>
          We can also supply BYO alcohol services for any of your travel requirements.
        </p>
      </div>

      <div class="row mt-4 ">
  <div class="col-12 col-sm-4 d-flex justify-content-center text-center mb-4 mb-sm-0">
    <div>
      <img src="assets/images/travel-1.png" alt="" >
      <h5 class="mt-2">Wedding & Events</h5>
    </div>
  </div>

  <div class="col-12 col-sm-4 d-flex justify-content-center text-center mb-4 mb-sm-0">
    <div>
      <img src="assets/images/travel-2.png" alt="" >
      <h5 class="mt-2">Winery & Coastal</h5>
    </div>
  </div>

  <div class="col-12 col-sm-4 d-flex justify-content-center text-center">
    <div>
      <img src="assets/images/travel-3.png" alt="" >
      <h5 class="mt-2">Corporate Services</h5>
    </div>
  </div>
</div>

<div class="row mt-4">
  <div class="col-12 col-sm-4 d-flex justify-content-center text-center mb-4 mb-sm-0">
    <div>
      <img src="assets/images/travel-4.png" alt="" class="img-fluid">
      <h5 class="mt-2">Airport Transfers</h5>
    </div>
  </div>

  <div class="col-12 col-sm-4 d-flex justify-content-center text-center mb-4 mb-sm-0">
    <div>
      <img src="assets/images/travel-5.png" alt="" class="img-fluid">
      <h5 class="mt-2">Extras</h5>
    </div>
  </div>

  <div class="col-12 col-sm-4 d-flex justify-content-center text-center">
    <div>
      <img src="assets/images/travel-6.png" alt="" class="img-fluid">
      <h5 class="mt-2">Our Why</h5>
    </div>
  </div>
</div>

    </div>
  </div>
</section>
<!-- Travel and Tour Section End -->


<!-- Booking Section Start -->
<section style="background-color: black;">
  <!-- Hero Content -->
  <div class="container mt-2">

    <!-- Heading -->
    <div class="row">
      <div class="col-12 text-white mt-5">
        <h1>Book Airport Transfers</h1>
      </div>
    </div>

    <!-- Desktop Toggle -->
    <div class="row d-none d-md-block">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-4 px-0">
        <div class="booking-toggle" style="background-color: #868686 !important;">
          <button class="toggle-btn active" data-type="oneway" style="width: 176px; height: 40px;">
            one-way
          </button>
          <button class="toggle-btn" id="multipleBtn" data-bs-toggle="modal"
                  data-bs-target="#multipleTripModal" style="width: 176px; height: 40px;">
            Multiple
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Toggle -->
    <div class="row d-md-none mt-4">
      <div class="booking-toggle col-12" style="background-color: #868686 !important;">
        <button class="toggle-btn active col-6" data-type="oneway">one-way</button>
        <button class="toggle-btn col-6" id="multipleBtn" data-bs-toggle="modal"
                data-bs-target="#multipleTripModal">
          Multiple
        </button>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="row">
  <div class="search-bar-container mt-4">
    <form method="post" action="#">
      <div class="row oneway">

        <!-- From -->
        <div class="col-12 col-md-5 ps-2 d-flex justify-content-between align-items-end">
          <div>
            <label for="oneway_pick" class="form-label">From</label>
            <input type="text" name="pick" id="oneway_pick"
                  class="form-control search-bar-input placesAPI"
                  placeholder="Per International Airport" required>
          </div>

          <!-- Image visible only on large screens -->
          <div class="d-none d-lg-block">
            <img src="assets/images/b-arrow.png" alt="" width="55px" height="55px">
          </div>
        </div>


        <!-- To -->
        <div class="col-12 col-md-5 mb-3 mb-md-0">
          <label for="oneway_drop" class="form-label">To</label>
          <input type="text" name="drop" id="oneway_drop"
                 class="form-control search-bar-input placesAPI"
                 placeholder="Enter Destination" required>
        </div>

        <!-- Button -->
        <div class="col-12 col-md-2">
          <button type="submit" class="btn btn-dark booking-btn w-100">
            Book now
          </button>
        </div>

      </div>
    </form>
  </div>
</div>
<div class="row">
  <div class="col-12 text-white mt-5 text-center">
      <h1>What Our Clients Say</h1>
      <div id="customSlider" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">

          <!-- Slide 1 -->
          <div class="carousel-item active ">
            <div class="slide-bg d-flex align-items-center justify-content-center text-center text-white"
                 style="background-image: url('assets/images/slider-2.png'); height:455px; ">
                <div class="p-5">
                  <p>Outstanding Service from Little Black Limo!</p>
                  <p>I've been following Colin's page for a while, and from the moment I reached out with my inquiry, I knew I was in <br> brgood hands. The entire process- from booking to pickup and drop-off-was seamless and professional. Colin is an <br>absolute top bloke-friendly, reliable, and great with communication. His pricing is fair, and the vehicle itself is <br> immaculate, making for a truly luxurious and comfortable ride.
                </p>
                  <p>Colin, it was an absolute pleasure! We appreciate your fantastic service and will      definitely be recommending you! We <br>look forward to booking with you again in the future!
                  </p>
                  <p>Thanks again!</p>
                  <h4>- Jovanka Hawkins </h4>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item">
            <div class="slide-bg d-flex align-items-center justify-content-center text-center text-white"
                 style="background-image: url('assets/images/slider-2.png'); height:455px;">
                 <div class="p-5">
                  <p>Outstanding Service from Little Black Limo!</p>
                  <p>I've been following Colin's page for a while, and from the moment I reached out with my inquiry, I knew I was in <br> brgood hands. The entire process- from booking to pickup and drop-off-was seamless and professional. Colin is an <br>absolute top bloke-friendly, reliable, and great with communication. His pricing is fair, and the vehicle itself is <br> immaculate, making for a truly luxurious and comfortable ride.
                </p>
                  <p>Colin, it was an absolute pleasure! We appreciate your fantastic service and will      definitely be recommending you! We <br>look forward to booking with you again in the future!
                  </p>
                  <p>Thanks again!</p>
                  <h4>- Jovanka Hawkins </h4>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item">
            <div class="slide-bg d-flex align-items-center justify-content-center text-center text-white"
                 style="background-image: url('assets/images/slider-2.png'); height:455px;">
               <div class="p-5">
                  <p>Outstanding Service from Little Black Limo!</p>
                  <p>I've been following Colin's page for a while, and from the moment I reached out with my inquiry, I knew I was in <br> brgood hands. The entire process- from booking to pickup and drop-off-was seamless and professional. Colin is an <br>absolute top bloke-friendly, reliable, and great with communication. His pricing is fair, and the vehicle itself is <br> immaculate, making for a truly luxurious and comfortable ride.
                </p>
                  <p>Colin, it was an absolute pleasure! We appreciate your fantastic service and will      definitely be recommending you! We <br>look forward to booking with you again in the future!
                  </p>
                  <p>Thanks again!</p>
                  <h4>- Jovanka Hawkins </h4>
                </div>
            </div>
          </div>

          <!-- Slide 4 -->
          <div class="carousel-item">
            <div class="slide-bg d-flex align-items-center justify-content-center text-center text-white"
                 style="background-image: url('assets/images/slider-2.png'); height:455px;">
               <div class="p-5">
                  <p>Outstanding Service from Little Black Limo!</p>
                  <p>I've been following Colin's page for a while, and from the moment I reached out with my inquiry, I knew I was in <br> brgood hands. The entire process- from booking to pickup and drop-off-was seamless and professional. Colin is an <br>absolute top bloke-friendly, reliable, and great with communication. His pricing is fair, and the vehicle itself is <br> immaculate, making for a truly luxurious and comfortable ride.
                </p>
                  <p>Colin, it was an absolute pleasure! We appreciate your fantastic service and will      definitely be recommending you! We <br>look forward to booking with you again in the future!
                  </p>
                  <p>Thanks again!</p>
                  <h4>- Jovanka Hawkins </h4>
                </div>
            </div>
          </div>

          <!-- Slide 5 -->
          <div class="carousel-item">
            <div class="slide-bg d-flex align-items-center justify-content-center text-center text-white"
                 style="background-image: url('assets/images/slider-2.png'); height:455px;">
              <div class="p-5">
                  <p>Outstanding Service from Little Black Limo!</p>
                  <p>I've been following Colin's page for a while, and from the moment I reached out with my inquiry, I knew I was in <br> brgood hands. The entire process- from booking to pickup and drop-off-was seamless and professional. Colin is an <br>absolute top bloke-friendly, reliable, and great with communication. His pricing is fair, and the vehicle itself is <br> immaculate, making for a truly luxurious and comfortable ride.
                </p>
                  <p>Colin, it was an absolute pleasure! We appreciate your fantastic service and will      definitely be recommending you! We <br>look forward to booking with you again in the future!
                  </p>
                  <p>Thanks again!</p>
                  <h4>- Jovanka Hawkins </h4>
                </div>
            </div>
          </div>
        </div>

        <!-- Indicators -->
        <div class="carousel-indicators custom-indicators">
          <button type="button" data-bs-target="#customSlider" data-bs-slide-to="0" class="active text-white" aria-current="true" aria-label="Slide 1">
            <img src="assets/images/custom-circle.png" alt="dot 1">
          </button>
          <button type="button" data-bs-target="#customSlider" data-bs-slide-to="1" aria-label="Slide 2">
            <img src="assets/images/custom-circle.png" alt="dot 2">
          </button>
          <button type="button" data-bs-target="#customSlider" data-bs-slide-to="2" aria-label="Slide 3">
            <img src="assets/images/custom-circle.png" alt="dot 3">
          </button>
          <button type="button" data-bs-target="#customSlider" data-bs-slide-to="3" aria-label="Slide 4">
            <img src="assets/images/custom-circle.png" alt="dot 4">
          </button>
          <button type="button" data-bs-target="#customSlider" data-bs-slide-to="4" aria-label="Slide 5">
            <img src="assets/images/custom-circle.png" alt="dot 5">
          </button>
        </div>
      </div>
  </div>
</div>


  </div>
</section>
<!-- Booking Section End -->


 <!-- blog Section Start -->


 <div class="container">
  <div class="row mt-5">
    <div class="col-12 text-center">
      <h3>Latest News about Little Black Limo</h3>
    </div>

    <!-- Blog 1 -->
    <div class="col-12 col-md-6 mt-4 text-center">
      <img src="assets/images/blog-1.png" alt="" class="img-fluid">
      <h6 class="mt-4">WAWA Accredited Business</h6>
      <p>
        Little Black Limo is a Western Australian Wedding <br>
        Association accredited business.
      </p>
    </div>

    <!-- Blog 2 -->
    <div class="col-12 col-md-6 mt-4 text-center">
      <img src="assets/images/blog-2.png" alt="" class="img-fluid">
      <h6 class="mt-3">Supplied or BYO</h6>
      <p class="mt-2 mb-0">
        Little Black Limo is licenced for BYO and the supply of <br> alcohol.
      </p>
      <p>
        Drivers have RSA and we are fully insured with all DOT <br> licences.
      </p>
    </div>
  </div>

  <!-- Blog 3 -->
  <div class="row align-items-center mt-5 text-center">
    <div class="col-12 col-md-6 mb-4 mb-md-0 p-5">
      <img src="assets/images/blog-3.png" alt="" class="w-100">
    </div>
    <div class="col-12 col-md-6 text-center text-md-start p-5">
      <h1 class="fw-bold">Little Black Limo is <br> proud to be part of <br> WCLA.</h1>
      <p>
        The Wedding Car and Limousine Association W.A. is a body formed
        to promote professionalism in the wedding car and limousine industry.  
        We are here to ensure the highest standards of ethics are maintained
        by our members at all times.
      </p>
    </div>
  </div>
</div>

<!-- blog Section End -->






<div class="modal fade mb-5 pb-5" id="multipleTripModal" tabindex="-1" aria-labelledby="multipleTripLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered modal-dialog-end">
        <div class="modal-content border-0">

            <!-- Fixed Header -->
            <div class="modal-header border-bottom position-sticky top-0 bg-white z-3">
                <h5 class="modal-title fw-semibold mx-auto" id="multipleTripLabel">
                    Multiple Stops
                </h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Scrollable Body -->
            <div class="modal-body overflow-auto pb-0" style="max-height: calc(100vh - 136px); background:#f5f5f5;">
                <form class="form" id="createJob" method="post" action="#">

                    <!-- TRIP 1 -->
                    <div class="trip-segment bg-white rounded-4 p-3 trip-shadow mb-3">
                        <div class="fw-semibold text-uppercase small mb-2">Trip</div>
                        <div class="position-relative mb-3">
                            <label class="form-label small mb-1">Pickup</label>
                            <input type="text" class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI pickup" name="pick" placeholder="Enter pickup location" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small mb-1">Dropoff</label>
                            <input type="text" class="form-control search-bar-input border-0 border-bottom rounded-0 ps-0 fw-semibold placesAPI dropoff" name="drop" placeholder="Enter dropoff location" required>
                        </div>

                        <div>
                            <label class="form-label small mb-1">Date & Time</label>
                            <input type="text" class="form-control search-bar-input border-0 p-0 fw-semibold datetime" id="pickupDateTime" placeholder="Select date & time" required>
                        </div>
                    </div>

                    <!-- Additional trips get injected here -->
                    <div id="moreSegments"></div>

                    <!-- Add Another Trip -->
                    <div class="d-grid mb-3">
                        <button type="button" class="btn rounded-pill py-2 fw-medium" id="addSegment" style="background:#fff; border: 1px solid #CCCCCC; color:#323232;">
                            <i class="bi bi-plus-lg me-1"></i>
                            Add Stop
                        </button>
                    </div>

                    <!-- Passengers -->
                    <div class="bg-white rounded-4 p-3 trip-shadow mb-3">
                        <label class="form-label small mb-1">Passengers</label>
                        <select class="form-select p-select text-start" name="total_passenger" id="total_passenger">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>

                    <!-- Fixed Footer -->
                    <div class="modal-footer border-0 p-3 position-sticky bottom-0 bg-white z-3">
                        <button type="submit" class="btn btn-dark rounded-pill w-100 py-2 fw-semibold">
                            See Prices
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>
</body>
</html>
