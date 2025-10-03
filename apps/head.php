<head>
    <?php require_once('config/config.php'); ?>
    <?php require_once('Controllers/APIController.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
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
    <!-- <link href="asset/css/main.css" rel="stylesheet"> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* ===============================
      SweetAlert2 Custom Popup Styles
      =============================== */

        /* Bigger popup container */
        .swal2-popup.big-alert-popup {
            font-size: 16px;
            max-width: 900px !important;
            border-radius: 12px;
            padding: 25px;
        }

        /* Large title style */
        .swal2-title.big-alert-title {
            font-size: 22px !important;
            font-weight: 700;
            margin-bottom: 10px;
        }

        /* Text inside popup */
        .alert-text,
        .swal2-html-container.big-alert-text {
            font-size: 14px !important;
            text-align: left;
            line-height: 1.5;
        }

        /* Optional: Adjust confirm button */
        .swal2-confirm {
            padding: 10px 25px;
            font-size: 14px;
        }

        /* Custom SweetAlert2 Button */
        .swal-custom-btn {
            background-color: #212529 !important;
            color: #fff !important;
            font-size: 14px;
            padding: 10px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .swal-custom-btn:hover {
            background-color: #343a40 !important; /* Slightly lighter for hover */
        }

    </style>
</head>
