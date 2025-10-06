<!DOCTYPE html>
<html lang="en">
<?php require_once('apps/head.php'); ?>
<body>
  <?php require_once('apps/header.php'); ?>
  
        <section class="selfie-section " >
            <div class="container">
                <div class="row ">
                    <div class="col-12 pt-5 mt-5 vertical-center text-white">
                        <h1 class="grid-center charm selfie-heading pt-5 ">Selfies</h1>
                    </div>
                </div>
               
            </div>
        </section>
        <div class="container py-5 text-center">

            <!-- Row 1 -->
            <div class="row mb-3">
                <div class="col-md-3 col-6 mb-3 ">
                <img src="assets/images/selfie-pic-1.png" alt="Pic 1" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-2.png" alt="Pic 2" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-3.png" alt="Pic 3" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-4.png" alt="Pic 4" class="img-fluid selfie-margin">
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row mb-3">
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-5.png" alt="Pic 5" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-6.png" alt="Pic 6" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-7.png" alt="Pic 7" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-8.png" alt="Pic 8" class="img-fluid selfie-margin">
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row mb-5">
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-9.png" alt="Pic 9" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-10.png" alt="Pic 10" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-11.png" alt="Pic 11" class="img-fluid selfie-margin">
                </div>
                <div class="col-md-3 col-6 mb-3">
                <img src="assets/images/selfie-pic-12.png" alt="Pic 12" class="img-fluid selfie-margin">
                </div>
            </div>

            <!-- Heading -->
            <div class="row mb-4">
                <div class="col-12">
                <h2 class="fw-bold">We are Little Black Limo</h2>
                </div>
            </div>

            <!-- Full width Image -->
           <div class="row">
            <div class="col-12 text-center">
                <!-- Image ko video trigger banaya -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#videoModal">
                <img src="assets/images/selfie-last-1.png" alt="Full Pic" class="img-fluid" style="cursor:pointer;">
                </a>
            </div>
            </div>
        </div>


<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
          <iframe id="youtubeVideo" 
                  src="" 
                  title="YouTube video" 
                  frameborder="0"
                  allow="autoplay; encrypted-media" 
                  allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>




  

  <?php require_once('apps/footer.php'); ?>
 <script src="assets/js/custom.js"></script>

<script>
  const videoModal = document.getElementById('videoModal');
  const youtubeVideo = document.getElementById('youtubeVideo');
  const videoURL = "https://www.youtube.com/embed/owMBwXcNxLE?autoplay=1";

  // When modal opens → play video
  videoModal.addEventListener('show.bs.modal', function () {
    youtubeVideo.src = videoURL;
  });

  // When modal closes → stop video
  videoModal.addEventListener('hidden.bs.modal', function () {
    youtubeVideo.src = "";
  });
</script>


</body>
</html>