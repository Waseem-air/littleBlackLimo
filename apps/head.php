<head>
  <?php require_once('config/config.php'); ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo SITE_NAME; ?></title>

  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <!-- Google Fonts - Montserrat -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<!-- Google Fonts - Charm -->
<link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap" rel="stylesheet">
<!-- Google Fonts - Jakarta -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
      <link href="asset/css/bootstrap.min.css" rel="stylesheet">
            <link href="asset/css/main.css" rel="stylesheet">

            <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


  <style>
    .booking-bg {
  background-image: url("assets/images/booking-confirm.png");
  background-size: cover;
  background-repeat: no-repeat;
  height:210px;
}

/*** Booking ***/
.booking {
    overflow: hidden;
}

.booking .heading {
    display: flex;
}

.booking .heading .step-img {
    height: 11.5px;
    margin-top: 9.5px;
}

.booking .heading .title {
    font-size: 20px;
    font-weight: bold;
    color: #0D0E0E;
    margin-left: 8px;
    margin-bottom: 3px;
}
.booking .heading .subtitle {
    color: black;
}
.booking .inner {
    flex-grow: 1;
}
.booking .inner .span-btn {
    color: black;
    font-weight: bold;
    float: right;
    text-decoration: underline;
    cursor: pointer;
}

.booking .bor {
    margin-left: 4px; 
    border-left: 2px solid black;
    padding-top: 6px;
    padding-bottom: 18px;
}

/*** Pickup ***/
.booking .pickup {
    border-radius: 8px;
    margin-left: 12px;
    border: 1px solid #D9D9D9;
    background-color: #F9F9F9;
}

.booking .pickup .pick-up1 {
    padding: 20px 10px;
}

hr {
    margin: 0;
}

.booking .pickup .pick-up2 {
    padding: 20px 10px;
}

.pickup .pick-up1 .button {
    width: 58px;
    height: 20px;
    font-size: 14px;
    border: none;
    color: white;
    border-radius: 100px;
    margin-right: 4px;
    background-color: black;
    font-weight: bold;
   
}

.pickup .pick-up1 .title {
    color: black;
    font-weight: bold;
    font-size: 16px;
    
}

.pickup .pick-up1 .span-btn {
    color: black;
    font-weight: bold;
    float: right;
    text-decoration: underline;
    cursor: pointer;
}

.pickup .pick-up2 .button {
    width: 84px;
    height: 26px;
    font-size: 14px;
    border: none;
    color: #FFFFFF;
    border-radius: 100px;
    margin-right: 4px;
    background-color: #006DDE;
    font-weight: bold;
}

.pickup .pick-up2 .title {
    color: #006DDE;
    font-weight: bold;
    font-size: 16px;
}

.pickup .pick-up2 .span-btn {
    color: #006DDE;
    font-weight: bold;
    float: right;
    text-decoration: underline;
    cursor: pointer;
}

.pickup .pick-up1 .dist1 {
    display: flex;
    font-weight: bold;
    margin-top: 10px;
}

.pickup .pick-up1 .dist1 p {
    margin-bottom: 0;
}

.pickup .pick-up1 .dist1 .title {
    color: #6F6F6F;
    margin-right: 10px;
}

.pickup .pick-up1 .dist1 .subtitle {
    color: #0D0E0E;
    font-size: 16px;
    font-weight: 500!important;
}

.pickup .pick-up1 .dist2 {
    display: flex;
    font-weight: bold;
    margin-top: 5px;
}

.pickup .pick-up1 .dist2 p {
    margin-bottom: 0;
}

.pickup .pick-up1 .dist2 .title {
    color: #6F6F6F;
    margin-right: 33px;
}

.pickup .pick-up1 .dist2 .subtitle {
    color: #0D0E0E;
    font-size: 16px;
    font-weight: 600;
}

.pickup .pick-up2 .dist1 {
    display: flex;
    font-weight: bold;
    margin-top: 10px;
}

.pickup .pick-up2 .dist1 p {
    margin-bottom: 0;
}

.pickup .pick-up2 .dist1 .title {
    color: #6F6F6F;
    margin-right: 10px;
}

.pickup .pick-up2 .dist1 .subtitle {
    color: #0D0E0E;
    font-size: 16px;
    font-weight: 600;
}

.pickup .pick-up2 .dist2 {
    display: flex;
    font-weight: bold;
    margin-top: 5px;
}

.pickup .pick-up2 .dist2 p {
    margin-bottom: 0;
}

.pickup .pick-up2 .dist2 .title {
    color: #6F6F6F;
    margin-right: 33px;
}

.pickup .pick-up2 .dist2 .subtitle {
    color: #0D0E0E;
    font-size: 16px;
    font-weight: 600;
}

.swapvert-btn {
    height: 32px;
    width: 32px;
    border: none;
    border-radius: 8px;
    float: right;
    margin:0;
    background-color: #F9F9F9;
}

/*** Count ***/
.count {
    margin-left: 13px;
}

.count .return {
    cursor: pointer;
    margin-top: 20px;
}

.count .return-cehkbox {
    cursor: pointer;
    margin-top: 4px;
    width: 17px;
    height: 17px;
}

.count .return-sapn {
    color: #006DDE;
    cursor: pointer;
    margin-left: 8px;
    margin-bottom: 10px;
    font-weight: bold;
}

/*** Items ***/
.items .heading {
    font-weight: bold;
    font-size: 14px;
    margin-top: 8px;
    margin-bottom: 10px;
    display: grid;
}

.items .counter-container {
    display: flex;
    margin-bottom: 9.5px ;
}

.items .counter {
    width: 35px;
    height: 26px;
    border: none;
    background: none;
    box-shadow: none;
}

.items .counter-btn {
    cursor: pointer;
    color: black;
    border: 1px solid #77838F;
    background: #D9D9D9;
    width: 26px;
    height: 26px;
    border-radius: 13px;
}

/*** Booking-card ***/
.booking-card1 {
    border: 1px solid #D9D9D9;
    background-color: #F9F9F9;
    border-radius: 8px;
    margin-left: 12px;
}

.booking-card {
    border: 1px solid #D9D9D9;
    background-color: #F9F9F9;
    border-radius: 8px;
    margin-bottom: 10px;
}

.card-item {
    display: flex; 
    justify-content: space-between;
    margin-top: 4px;
    margin-bottom: 6px;
}

.card-subinner {
    margin-top: 4px;
    margin-left: 12px;
}

.card-img {
    width: 254px;
    height: 73px;
}

.card-title {
    color: #0D0E0E;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 3px;
}

.card-subtitle {
    color: #0D0E0E;
    font-size: 14px;
    font-weight: 500;
}

/*** Extras ***/
.extras {
    display: flex;
}

.extras .cardimg {
  width: 16px;
  height: 16px;
    color: #0D0E0E;
    padding-right: 2px;
    margin-top:3px;
}

.extras span {
    color: #0D0E0E;
    margin-right: 6px;
    margin-bottom: 0;
}

.badge1 {
    width: 75px;
    height: 28px;
    font-size: 12px;
    margin: 0px;
    padding: 0;
    border: none;
    color: #FFFFFF;
    border-top-left-radius: 8px;
    border-bottom-right-radius: 8px;
    background-color: black;
    font-weight: bold;
}

/*** Details ***/
.details {
    margin-left: 13px;
}

.details .form-group {
    margin-bottom: 15px;
}

.details .detail {
    box-shadow: none;
    border: 1px solid #909090;
    height: 49px;
    border-radius: 99px;
}

.details .detail:focus {
    border: 1px dashed black;
}

.details .detail1 {
    box-shadow: none;
    border: 1px solid #909090;
    border-radius: 8px;
}

.details .detail1:focus {
    border: 1px dashed #006DDE;
}
/*** Total ***/
.total {
    margin-top: 40px;
    margin-bottom: 45px;
    text-align: center;
}

.total .total-p {
    font-size: 24px;
    font-weight: bold;
    color: #0D0E0E;
    margin-bottom: 0;
}

.total .total-span {
    font-size: 18px;
    color: #0D0E0E;
}
.total .total-btn {
    transition:all 0.8s, 
    color 0.3s 0.3s; 
    text-align: center;
    cursor:pointer; 
    clear:both;  
    display:inline-block;
    padding: 16px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 99px;
    text-decoration: none; 
    color: #FFFFFF;  
    background-color: #0D0E0E;
}
/*** booking confirmed ***/
.confirmed-img1 {
    width: 470px;
    height: 100%;
    margin-bottom: 40px;
}

.confirmed .confirmed-content {
    margin-bottom: 10px;
}

.confirmed .booking-title {
    font-size: 28px;
    font-weight: bold;
}

.confirmed .booking-span {
    color: #006DDE;
    font-size: 18px;
    font-weight: bold;
}

.confirmed .booking-subtitle {
    color: #1D1B20;
    font-size: 20px;
    font-weight: bold;
    margin-top: 25px;
}

.confirmed .bookingq {
    display: flex;
}

.bookingq .bookingq-title {
    color: #1D1B20;
    font-size: 18px;
    font-weight: bold;
}

.confirmed .image-container {
    align-items: center;
    margin-left: 35px;
    gap: 10px;
}

.confirmed .image-container img {
    max-width: 100%;
    height: auto;
}

.confirmed-img2 {
    width: 100%;
}
  </style>
</head>
