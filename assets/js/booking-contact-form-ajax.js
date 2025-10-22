document.addEventListener('DOMContentLoaded', function () {
    const serviceTypeSelect = document.getElementById('service_type');
    const customServiceModal = new bootstrap.Modal(document.getElementById('customServiceModal'));
    const mainBookingBtn = document.getElementById('mainBookingBtn');
    const customServiceBtn = document.getElementById('customServiceBtn');

    // Initialize button states
    updateButtonStates();
    if (serviceTypeSelect) {
        serviceTypeSelect.addEventListener('change', function () {
            const selectedValue = this.value;
            if (selectedValue) {
                const [serviceKey, formType] = selectedValue.split(':');
                if (formType === 'contact_form') {
                    disableMainBookingButton();
                    showCustomServiceModal(serviceKey);
                } else if (formType === 'booking_form') {
                    enableMainBookingButton();
                }
            } else {
                enableMainBookingButton();
            }
        });
    }

    // Show custom service modal
    function showCustomServiceModal(serviceKey) {
        const serviceName = serviceKey.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        document.getElementById('customServiceModalLabel').textContent = `${serviceName} Service Inquiry`;
        document.getElementById('contact_service_type').value = serviceKey;
        enableCustomServiceButton();
        customServiceModal.show();
    }

    // Update button states based on current selection
    function updateButtonStates() {
        const selectedValue = serviceTypeSelect ? serviceTypeSelect.value : '';
        if (selectedValue) {
            const [serviceKey, formType] = selectedValue.split(':');
            if (formType === 'contact_form') {
                disableMainBookingButton();
            } else {
                enableMainBookingButton();
            }
        } else {
            enableMainBookingButton();
        }
    }

    // Disable main booking button
    function disableMainBookingButton() {
        if (mainBookingBtn) {
            mainBookingBtn.disabled = true;
            mainBookingBtn.style.opacity = '0.6';
            mainBookingBtn.style.cursor = 'not-allowed';
            mainBookingBtn.title = 'Please use the contact form for custom services';
        }
    }

    // Enable main booking button
    function enableMainBookingButton() {
        if (mainBookingBtn) {
            mainBookingBtn.disabled = false;
            mainBookingBtn.style.opacity = '1';
            mainBookingBtn.style.cursor = 'pointer';
            mainBookingBtn.title = '';
        }
    }

    // Disable custom service button
    function disableCustomServiceButton() {
        if (customServiceBtn) {
            customServiceBtn.disabled = true;
            customServiceBtn.style.opacity = '0.6';
            customServiceBtn.style.cursor = 'not-allowed';
        }
    }

    // Enable custom service button
    function enableCustomServiceButton() {
        if (customServiceBtn) {
            customServiceBtn.disabled = false;
            customServiceBtn.style.opacity = '1';
            customServiceBtn.style.cursor = 'pointer';
        }
    }

    // Handle modal events
    document.getElementById('customServiceModal').addEventListener('show.bs.modal', function () {
        enableCustomServiceButton();
    });

    document.getElementById('customServiceModal').addEventListener('hidden.bs.modal', function () {
        disableMainBookingButton();
    });

    // Handle custom service form submission
    const customServiceForm = document.getElementById('customServiceForm');
    if (customServiceForm) {
        customServiceForm.addEventListener('submit', function (e) {
            e.preventDefault();
            disableCustomServiceButton();
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            submitBtn.disabled = true;

            // Submit form via AJAX
            const formData = new FormData(this);
            fetch('contact_form_template.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Close current modal
                        customServiceModal.hide();
                        Swal.fire({
                            title: 'Success!',
                            text: `Your ${data.service_name} inquiry has been submitted successfully.`,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            timer: 5000,
                            timerProgressBar: true
                        }).then(() => {
                            customServiceForm.reset();
                            if (serviceTypeSelect) {
                                serviceTypeSelect.value = '';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: data.error_title || 'Submission Failed',
                            text: data.error || 'An error occurred while submitting your inquiry.',
                            icon: 'error',
                            confirmButtonText: 'Try Again',
                            confirmButtonColor: '#d33'
                        });
                        // Re-enable custom service button on error
                        enableCustomServiceButton();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Network Error',
                        text: 'There was a problem connecting to the server. Please check your internet connection and try again.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                    // Re-enable custom service button on error
                    enableCustomServiceButton();
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });
    }


});