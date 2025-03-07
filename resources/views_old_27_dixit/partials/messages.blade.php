<!-- resources/views/partials/messages.blade.php -->

<style>
    /* Style for toast notifications */
    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: none;
        min-width: 300px;
        padding: 15px 20px;
        border-radius: 8px;
        font-size: 16px;
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
        display: flex;
        align-items: center;
        gap: 10px;
        transition: opacity 0.5s ease-in-out; /* Smooth fade in/out */
        opacity: 0;
    }
    .toast-success {
        background-color: #28a745; /* Green for success */
    }
    .toast-error {
        background-color: #dc3545; /* Red for error */
    }
    .toast-icon {
        font-size: 20px;
    }
    .toast.show {
        display: block;
        opacity: 1;
    }
</style>

<!-- Success message -->
@if (session('success'))
    <div class="toast toast-success" id="toast-success">
        <span class="toast-icon">✔️</span> <!-- Success icon -->
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Error message -->
@if (session('error'))
    <div class="toast toast-error" id="toast-error">
        <span class="toast-icon">❌</span> <!-- Error icon -->
        <span>{{ session('error') }}</span>
    </div>
@endif

<!-- Validation errors -->
@if ($errors->any())
    <div class="toast toast-error" id="toast-errors">
        <span class="toast-icon">❌</span> <!-- Error icon -->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- JavaScript to display and auto-hide the toasts -->
<script>
    // Function to show and hide the toast with a fade-in/fade-out effect
    function showToast(toastId) {
        var toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.add('show');  // Add 'show' class to fade in
            setTimeout(function() {
                toast.classList.remove('show');  // Fade out after 3 seconds
            }, 3000);  // 3000 milliseconds = 3 seconds
        }
    }

    // Show the toasts if they exist
    @if (session('success'))
        showToast('toast-success');
    @endif

    @if (session('error'))
        showToast('toast-error');
    @endif

    @if ($errors->any())
        showToast('toast-errors');
    @endif
</script>
