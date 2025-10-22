<?php
// contact_form_template.php
require_once('config/config.php');
require_once('Controllers/APIController.php');
if (isset($_POST['sendEmail'])) {
    $serviceType = $_POST['contact_service_type'] ?? '';
    $serviceName = ucwords(str_replace('_', ' ', $serviceType));
    $postData = [
        'name'         => $_POST['email_name'] ?? '',
        'email'        => $_POST['email_address'] ?? '',
        'phone'        => $_POST['email_phone'] ?? '',
        'message'      => $_POST['email_description'] ?? '',
        'datetime'     => $_POST['email_date_time'] ?? '',
        'service_type' => $serviceType,
        'service_name' => $serviceName,
    ];

    try {
        $response = curlPost($postData, 'send/contactusemail');
        $result = is_string($response) ? json_decode($response, true) : $response;
        if (!empty($result['success']) && $result['success'] === true) {
            echo json_encode([
                'success' => true,
                'message' => 'Inquiry sent successfully',
                'service_name' => $serviceName
            ]);
            exit;
        } else {
            $errorTitle = htmlspecialchars($result['title'] ?? 'Submission Failed');
            $errorMessage = htmlspecialchars($result['message'] ?? 'Unknown error occurred');
            $errorData = !empty($result['errors']) ? $result['errors'] : null;

            echo json_encode([
                'success' => false,
                'error' => $errorMessage,
                'error_title' => $errorTitle,
                'error_data' => $errorData
            ]);
            exit;
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage(),
            'error_title' => 'Server Error'
        ]);
        exit;
    }
}

// If not a POST request or no sendEmail
echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit;
?>