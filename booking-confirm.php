<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
<body>
  <?php require_once('apps/header.php'); ?>
  <!-- bookin detail section start -->
        <section class="booking-bg" >
            <div class="container">
                <div class="row charm">
                    <div class="col-12 text-center mt-5 pt-4 text-white">
                        <h1>Booking Details</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Start -->
       <section id="booking-section" data-bs-version="5.1" class="booking">
        <div class="container-fluid px-0">
            <div class="row g-0 flex-column-reverse flex-lg-row">
                <div class="col-lg-6 col-12 p-0 mt-5 ps-lg-2">
                    <div class="px-2 ms-lg-5 me-lg-4">
                        <!-- STEP 1: Confirm pick-up schedule -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <p class="title charm fw-bold "><span class="subtitle fw-bold me-1">STEP 1</span>  <span class="montserrat">Confirm Itinerary</span></p>
                        </div>
                        
                        <div class="bor">
                            <!-- Pickup 1 -->
                            <div class="pickup">
                                <div class="pick-up1 montserrat">
                                    <button class="button ">Trip 1</button>
                                    <span class="title">12:30 PM, 22 Dec 2023</span>
                                    <span class="span-btn" data-bs-toggle="modal" data-bs-target="#modalPickup1">
                                        Edit
                                    </span>
                                    
                                    <!-- Modal for Pickup 1 -->
                                    <div class="modal fade" id="modalPickup1" tabindex="-1" aria-labelledby="modalPickup1Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-head">
                                                    <span class="modal-span" id="modalPickup1Label">Pick-up 1</span>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="">
                                                        <div class="form-group">
                                                            <img src="./asset/img/calendar_month.svg" class="form-img" alt="">
                                                            <input type="text" name="pickup" id="datePicker1" class="form-control custom" placeholder="Pickup date & time">
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <img src="./asset/img/arrow_up.svg" class="form-img" alt="">
                                                            <input type="text" name="pickup" class="form-control custom" placeholder="Pickup address">
                                                        </div>
                                                        <div>
                                                            <button class="swapvert-btn"><img src="./asset/img/swap_vert.svg" alt=""></button>
                                                        </div>
                                                        <div class="form-group">
                                                            <img src="./asset/img/arrow_down.svg" class="form-img" style="margin-top: 32px;" alt="">
                                                            <input type="text" name="dropoff" class="form-control custom" placeholder="Dropoff address">
                                                        </div>
                                                        <div class="form-group d-grid gap-2">
                                                            <a href="javascript:void(0)" class="modal-btn">Done</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="dist1">
                                        <p class="title">From</p>
                                        <p class="subtitle">1 Muller Ln, Mascot NSW 2020</p>
                                    </div>
                                    <div class="dist2">
                                        <p class="title">To</p>
                                        <p class="subtitle">Sydney Airport - International, Mascot NSW 2020</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <!-- STEP 2: Select your Extras -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="...">
                            <div class="inner">
                                <span class="title "><span class="subtitle charm fw-bold me-1">STEP 2</span> <span class="montserrat">Add any extras</span>
                            </div>
                        </div>
                             <!-- Items Counter -->
                        <div class="bor">
                            <div class="items">
                                <div class="row montserrat">
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Check-In Bags</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="passengers" data-action="decrease">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterPassengers" value="0" readonly>
                                            <button class="counter-btn" data-counter="passengers" data-action="increase">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Check-In Hand Carry</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="luggage" data-action="decrease">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterLuggage" value="0" readonly>
                                            <button class="counter-btn" data-counter="luggage" data-action="increase">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Baby Seats</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="carryon" data-action="decrease">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterCarryon" value="0" readonly>
                                            <button class="counter-btn" data-counter="carryon" data-action="increase">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <p class="heading">Booster Seats</p>
                                        <div class="counter-container">
                                            <button class="counter-btn" data-counter="surfboards" data-action="decrease">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control counter" id="counterSurfboards" value="0" readonly>
                                            <button class="counter-btn" data-counter="surfboards" data-action="increase">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- STEP 3: Select your ride -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="...">
                            <div class="inner">
                                <span class="title"><span class="subtitle charm fw-bold me-1">STEP 3</span><span class="montserrat">Select your ride</span>
                                <span class="span-btn" data-bs-toggle="modal" data-bs-target="#modalRideSelection">
                                    Change
                                </span>
                            </div>
                        </div>
                        
                        <!-- Modal for Ride Selection -->
                        <div class="modal fade" id="modalRideSelection" tabindex="-1" aria-labelledby="modalRideSelectionLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-head">
                                        <span class="modal-span" id="modalRideSelectionLabel">Select your ride</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="booking-card booking-card-modal">
                                            <button class="badge2">Our pick</button>
                                            <div class="card-item">
                                                <div class="card-inner">
                                                    <div class="card-subinner">
                                                        <p class="card-title text-white">Sedan • $35</p>
                                                        <div class="extras">
                                                            <img src="assets/images/group-white.png" class="cardimg text-white" alt=""><span class="text-white">3</span>
                                                            <img src="assets/images/basil_bag-solid-white.png" class="cardimg " alt=""><span class="text-white">3</span>
                                                            <img src="assets/images/wpf_luggage-trolley-white.png" class="cardimg text-white" alt=""><span class="text-white">3</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="assets/images/model-1.png" class="card-img" alt="...">
                                            </div>
                                        </div>
                                        <div class="booking-card">
                                            <div class="card-item">
                                                <div class="card-inner">
                                                    <div class="card-subinner">
                                                        <p class="card-title">SUV • $60</p>
                                                        <div class="extras">
                                                            <img src="assets/images/group.png" class="cardimg" alt=""><span>3</span>
                                                            <img src="assets/images/wpf_luggage-trolley.png" class="cardimg" alt=""><span>3</span>
                                                            <img src="assets/images/basil_bag-solid.png" class="cardimg" alt=""><span>3</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="assets/images/model-2.png" class="card-img" alt="...">
                                            </div>
                                        </div>
                                        <div class="booking-card">
                                            <div class="card-item">
                                                <div class="card-inner">
                                                    <div class="card-subinner">
                                                        <p class="card-title">SUV • $60</p>
                                                        <div class="extras">
                                                            <img src="assets/images/group.png" class="cardimg" alt=""><span>3</span>
                                                            <img src="assets/images/wpf_luggage-trolley.png" class="cardimg" alt=""><span>3</span>
                                                            <img src="assets/images/basil_bag-solid.png" class="cardimg" alt=""><span>3</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="assets/images/model-3.png" class="card-img" alt="...">
                                            </div>
                                        </div>
                                        <div class="booking-card">
                                            <div class="card-item">
                                                <div class="card-inner">
                                                    <div class="card-subinner">
                                                        <p class="card-title">People Mover • $65</p>
                                                        <div class="extras">
                                                            <img src="assets/images/group.png" class="cardimg" alt=""><span>6</span>
                                                            <img src="assets/images/wpf_luggage-trolley.png" class="cardimg" alt=""><span>6</span>
                                                            <img src="assets/images/basil_bag-solid.png" class="cardimg" alt=""><span>6</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img src="assets/images/model-3.png" class="card-img" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bor">
                            <div class="booking-card1 montserrat">
                                <button class="badge1">Our pick</button>
                                <div class="card-item">
                                    <div class="card-inner">
                                        <div class="card-subinner">
                                            <p class="card-title">Limo Sedan • $55</p>
                                            <div class="extras">
                                                <img src="assets/images/group.png" class="cardimg" alt=""><span>3</span>
                                                <img src="assets/images/wpf_luggage-trolley.png" class="cardimg" alt=""><span>3</span>
                                                <img src="assets/images/basil_bag-solid.png" class="cardimg" alt=""><span>3</span>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="assets/images/booking-car-img.png" class="card-img" alt="...">
                                </div>
                            </div>
                        </div>
                        
                        <!-- STEP 4: Enter your details -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <span class="title"><span class="subtitle charm fw-bold me-1">STEP 4</span> <span class="montserrat">Enter your Contact<span> 
                        </div>
                        
                        <div class="bor">
                            <div class="details">
                                <form action="">
                                    <div class="row " >
                                        <div class="col-6" style="    padding-right: 0px !important; padding-left: 0px !important;">
                                            <div class="form-group">
                                                <input type="text" class="form-control detail" placeholder="First name *">
                                            </div>
                                        </div>
                                        <div class="col-6 ps-2" style="    padding-right: 0px !important; padding-left: 10px !important;">
                                            <div class="form-group">
                                                <input type="text" class="form-control detail" placeholder="Last name *">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control detail" placeholder="Email address*">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control detail" placeholder="Mobile no.*">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control detail" placeholder="Notes *">
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- FINAL STEP: Make your payment -->
                        <div class="heading">
                            <img src="assets/images/circle.png" class="step-img" alt="">
                            <p class="title "><span class="subtitle charm fw-bold">FINAL STEP</span><span class="montserrat ms-1">Make your payment</span> </p>
                        </div>                        
                        <div class="total montserrat">
                            <p class="total-p">$35.00 <sup class="total-span">Total</sup></p>
                            <div class="d-grid gap-2">
                                <a href="booking_confirmed.html" class="total-btn">Pay now to book</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map Section -->
                <div class="col-lg-6 col-12 embed-responsive d-none d-lg-block">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8385385572983!2d144.95358331584498!3d-37.81725074201705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sbd!4v1612419490850!5m2!1sen!2sbd"
                        class="embed-responsive-item" frameborder="0" style="border:0; width: 100%; height: 100%;" allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

        <!-- Booking End -->
     <!-- bookin detail End -->
  <?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>
</body>
</html>