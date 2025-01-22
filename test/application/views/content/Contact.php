<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3067.6053497340163!2d-105.00028602428594!3d39.7485149960385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x876c81cd83479989%3A0xbe99b376940a069f!2sSwift%20Courier%20Services!5e0!3m2!1sen!2slk!4v1729067518205!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<!-- Contact Section -->
<section class="contact section">
    <center><h2>Contact Us</h2></center><br>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdkVHwqAAAAAOU7o7Prsp-UGdXzIEVBlpfQ0LnY"></script>
    
    <div class="container">
        <form id="cfrm" method="POST" class="php-email-form">
            <div class="row gy-4">
                <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" id="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-12">
                    <input type="text" id="subject" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" id="message" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    <button type="button" id="contactForm" style="background-color: #378aa4; color:#fff; padding: 7px 13px; border-radius: 30px;">Send Message</button>
                </div>
                <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            </div>
        </form>

        <div id="responseMessage" style="margin-top: 10px;"></div>
    </div>
</section>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- CSS for Response Message -->
<style>
    #responseMessage {
        display: none;
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>

<script>
$(document).ready(function() {
    $('#contactForm').on('click', function(e) {
        e.preventDefault(); 

        // reCAPTCHA
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdkVHwqAAAAAOU7o7Prsp-UGdXzIEVBlpfQ0LnY', {action: 'submit'}).then(function(token){
                $('#g-recaptcha-response').val(token);

                // Run input validation after getting the reCAPTCHA token
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const subject = $('#subject').val().trim();
                const message = $('#message').val().trim();
                const namePattern = /^[a-zA-Z\s]+$/;
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const validDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'icloud.com'];

                if (!namePattern.test(name)) {
                    showErrorMessage('Please enter a valid name (letters and spaces only).');
                    return;
                }
                if (!emailPattern.test(email)) {
                    showErrorMessage('Please enter a valid email address.');
                    return;
                }
                const emailDomain = email.split('@')[1];
                if (!validDomains.includes(emailDomain)) {
                    showErrorMessage('Please enter a valid email address (e.g., yourname@gmail.com).');
                    return;
                }
                if (subject === '' || message === '') {
                    showErrorMessage('Subject and message cannot be empty.');
                    return;
                }

                // AJAX request
                $.ajax({
                    url: '/test/index.php/Welcome/table', // Update with your backend URL
                    type: 'POST',
                    data: $("#cfrm").serialize(),
                    success: function(response) {
                        $('#responseMessage').removeClass('error').addClass('success')
                            .html('Message sent successfully!').fadeIn(500);
                        $('#cfrm')[0].reset();
                        setTimeout(function() {
                            $('#responseMessage').fadeOut(500);
                        }, 2000);
                    },
                    error: function() {
                        $('#responseMessage').removeClass('success').addClass('error')
                            .html('An error occurred. Please try again later.').fadeIn(500);
                        setTimeout(function() {
                            $('#responseMessage').fadeOut(500);
                        }, 2000);
                    }
                });
            });
        });
    });
});

function showErrorMessage(message) {
    $('#responseMessage').removeClass('success').addClass('error')
        .html(message).fadeIn(500);
    setTimeout(function() {
        $('#responseMessage').fadeOut(500);
    }, 2000);
}
</script>
