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

      <div class="row mt-4 text-center" >
          <div class="col-sm-4" >
            <div >
                <img src="assets/images/travel-1.png" alt="" >
                <h5 class="mt-2">Wedding & Events</h5>
            </div>
          </div>
          <div class="col-sm-4">
            <div>
                <img src="assets/images/travel-2.png" alt="">
                <h5 class="mt-2">Winery & Coastal</h5>
            </div>
          </div>
          <div class="col-sm-4">
            <div>
                <img src="assets/images/travel-3.png" alt="">
                <h5 class="mt-2">Corporate Services</h5>
            </div>
          </div>
      </div>
      <div class="row mt-4 text-center" >
          <div class="col-sm-4" >
            <div >
                <img src="assets/images/travel-4.png" alt="" >
                <h5 class="mt-2">Airport Transfers</h5>
            </div>
          </div>
          <div class="col-sm-4">
            <div>
                <img src="assets/images/travel-5.png" alt="">
                <h5 class="mt-2">Extras</h5>
            </div>
          </div>
          <div class="col-sm-4">
            <div>
                <img src="assets/images/travel-6.png" alt="">
                <h5 class="mt-2">Our Why</h5>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
<!-- Travel and Tour Section End -->



  <?php require_once('apps/footer.php'); ?>
</body>
</html>
