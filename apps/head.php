<head>
    <?php require_once('config/config.php'); ?>
    <?php require_once('Controllers/APIController.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Google Fonts - Charm -->
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap" rel="stylesheet">
    <!-- Google Fonts - Jakarta -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Flatpickr CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* ===============================
   SweetAlert2 Custom Popup Styles
   =============================== */

    /* Bigger popup container */
    .swal2-popup.big-alert-popup {
        max-width: 900px !important;
        font-size: 16px;
        border-radius: 12px;
        padding: 25px;
    }

    /* Large title style */
    .swal2-title.big-alert-title {
        font-size: 22px !important;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .swal2-html-container.big-alert-text,
    .alert-text {
        font-size: 14px !important;
        text-align: left;
        line-height: 1.5;
    }

    /* Confirm button adjustments */
    .swal2-confirm {
        padding: 10px 24px;
        font-size: 14px;
        background-color: #212529 !important;
    }
    /* Optional title & text styling */
    .swal-custom-title {
        font-size: 20px !important;
        font-weight: 600;
    }

    .swal-custom-text {
        font-size: 14px !important;
        line-height: 1.5;
    }
    .swal-custom-popup {
         text-align: center;
         padding: 20px;
     }
    .swal-custom-title {
        font-size: 22px !important;
        font-weight: 600;
        text-align: center;
        margin-bottom: 10px;
    }
    .swal-custom-text {
        font-size: 16px;
        text-align: center;
    }
    .swal-custom-text ul {
        list-style-type: none;
        padding: 0;
        display: inline-block;
        text-align: left;
    }
    .swal-custom-text li {
        margin-bottom: 5px;
    }
    .swal-custom-btn {
        background: #212529;
        color: #fff;
        border-radius: 6px;
        padding: 8px 20px;
        font-size: 15px;
        cursor: pointer;
    }
    .swal-custom-btn:hover {
        background: #000;
    }
<
</style>
</head>
