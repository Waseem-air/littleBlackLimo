
<!-- Bootstrap 5 Modal for Custom Services -->
<div class="modal fade" id="customServiceModal" tabindex="-1" aria-labelledby="customServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customServiceModalLabel">Custom Service Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-4">Please provide your details, and we'll reach out to you to discuss pricing and requirements.</p>
                <form method="POST" id="customServiceForm">
                    <input type="hidden" name="contact_service_type" id="contact_service_type" value="">

                    <div class="row mb-3">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <input type="text" name="email_name" required class="form-control rounded-pill" placeholder="Your Name">
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <input type="email" name="email_address" required class="form-control rounded-pill" placeholder="Your Email">
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <input type="text" name="email_phone" required class="form-control rounded-pill" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="email_description" required class="form-control" rows="3" placeholder="Please describe your requirements..."></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="contact_datetime" class="form-label">Preferred Date & Time</label>
                            <textarea id="contact_datetime" name="email_date_time" class="form-control" placeholder="Please provide your preferred date and time..." rows="2" required></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="sendEmail" value="1">

                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-outline-secondary me-2  py-2 px-5 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark px-5 py-2 rounded-pill">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>