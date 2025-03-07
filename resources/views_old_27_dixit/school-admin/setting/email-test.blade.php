<div>
    <label for="testemail"><strong>Send Test Email</strong></label>
    <input id="testemail" name="mail_test_email" type="email" placeholder="Test Email" class="form-input"
        value="{{ old('mail_test_email.' . $loop->index, $setup->mail_test_email ?? '') }}"  />
    <span id="email-error" style="color: red; display: none;">Please enter a valid email address.</span>
</div>
<div>
    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const emailInput = document.getElementById('testemail');
    const emailError = document.getElementById('email-error');

    form.addEventListener('submit', function(event) {
        const emailValue = emailInput.value.trim();

        if (!validateEmail(emailValue)) {
            emailError.style.display = 'block'; // Show error message
            event.preventDefault(); // Prevent form submission
        } else {
            emailError.style.display = 'none'; // Hide error message
        }
    });

    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }
});

    </script>
