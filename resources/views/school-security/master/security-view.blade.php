<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 0; /* Remove padding from modal-content to control grid better */
        border: 1px solid #888;
        width: 90%;
        max-width: 900px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Header section for title and close button */
    .modal-header {
        background-color: #fbfbfb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #ccc;
    }

    .modal-header h5 {
        margin: 0;
        font-size: 1.25rem;
    }

    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    /* Grid layout for the content */
    .modal-body {
        padding: 20px;
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two columns */
        grid-template-rows: 1fr 1fr;   /* Two rows */
        gap: 10px;
    }

    .modal-box {
        background-color: #fbfbfb;
        border: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 20px;
        text-align: center;
    }

    img {
        width: 120px;
        height: 120px;
    }
</style>

@php
    $view = App\Models\SchoolAdminSecurity::where('id',$item->id)->first();
@endphp

<div id="myModal{{ $item->id }}" class="modal">
    <div class="modal-content">
        <!-- Header section: Title and Close button -->
        <div class="modal-header">
            <h5 class="font-bold">{{ $view->name }} Details</h5>
            <span class="close" onclick="closeModal({{ $view->id }})">&times;</span>
        </div>

        <!-- Body section divided into four squares -->
        <div class="modal-body">
            <div class="modal-box p-6 bg-white rounded-md shadow-lg max-w-3xl">
                <p><strong>Photo</strong></p>
                <img src="{{ asset('assets/images/'.$view->photo) }}" alt="{{ $view->name }}">
            </div>
            <div class="modal-box p-6 bg-white rounded-md shadow-lg max-w-3xl">
                <div class="flex justify-between gap-2">
                    <p><strong>Business Name:-</strong></p>
                    <p>{{ $view->business_name }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>Email ID:-</strong></p>
                    <p>{{ $view->email }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>Contact:-</strong></p>
                    <p>{{ $view->contant_number }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>WhatsApp:-</strong></p>
                    <p>{{ $view->whatsapp }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>Working Date:-</strong></p>
                    <p>{{ $view->working_date }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>Country:-</strong></p>
                    <p>{{ $view->Country->name }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>State:-</strong></p>
                    <p>{{ $view->State->name }}</p>
                </div>
                <div class="flex justify-between gap-2">
                    <p><strong>City:-</strong></p>
                    <p>{{ $view->City->name }}</p>
                </div>
            </div>            
            <div class="modal-box p-6 bg-white rounded-md shadow-lg max-w-3xl">
                <div class="flex gap-10">
                    <!-- Current Address Section -->
                    <div class="w-1/2">
                        <h3 class="border-b-2 border-gray-400 pb-2 mb-4 text-lg font-bold" style="text-decoration: underline">
                            Current Address
                        </h3>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>Address 1:</strong></p>
                            <p style="max-width: 200px; overflow-wrap: break-word; white-space: normal;">
                                {{ $view->c_address_1 }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>Address 2:</strong></p>
                            <p style="max-width: 200px; overflow-wrap: break-word; white-space: normal;">
                                {{ $view->c_address_2 ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>Landmark:</strong></p>
                            <p>{{ $view->c_landmark ?? 'N/A' }}</p>
                        </div>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>City:</strong></p>
                            <p>{{ $view->current_city }}</p>
                        </div>
                    </div>
            
                    <!-- Permanent Address Section -->
                    <div class="w-1/2">
                        <h3 class="border-b-2 border-gray-400 pb-2 mb-4 text-lg font-bold" style="text-decoration: underline">
                            Permanent Address
                        </h3>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>Address 1:</strong></p>
                            <p style="max-width: 200px; overflow-wrap: break-word; white-space: normal;">
                                {{ $view->p_address_1 }}
                            </p>
                        </div>
                        <div class="flex justify-between gap-2 mb-2">
                            <p><strong>Address 2:</strong></p>
                            <p style="max-width: 200px; overflow-wrap: break-word; white-space: normal;">
                                {{ $view->p_address_2 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-box p-6 bg-white rounded-md shadow-lg max-w-3xl">
                <div class="flex justify-between gap-2">
                    <p><strong>Photo ID:-</strong></p>
                    <a href="{{ asset('assets/upload/'.$view->photo_id) }}" download="{{ $view->photo_id }}" target="_blank" style="color: blue;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 22.0002H16C18.8284 22.0002 20.2426 22.0002 21.1213 21.1215C22 20.2429 22 18.8286 22 16.0002V15.0002C22 12.1718 22 10.7576 21.1213 9.8789C20.3529 9.11051 19.175 9.01406 17 9.00195M7 9.00195C4.82497 9.01406 3.64706 9.11051 2.87868 9.87889C2 10.7576 2 12.1718 2 15.0002L2 16.0002C2 18.8286 2 20.2429 2.87868 21.1215C3.17848 21.4213 3.54062 21.6188 4 21.749" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>                   
                    </div>
                <div class="flex justify-between gap-2">
                    <p><strong>Address Proof:-</strong></p>
                    <a href="{{ asset('assets/upload/'.$view->address_proof) }}" download="{{ $view->address_proof }}" target="_blank" style="color: blue;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 22.0002H16C18.8284 22.0002 20.2426 22.0002 21.1213 21.1215C22 20.2429 22 18.8286 22 16.0002V15.0002C22 12.1718 22 10.7576 21.1213 9.8789C20.3529 9.11051 19.175 9.01406 17 9.00195M7 9.00195C4.82497 9.01406 3.64706 9.11051 2.87868 9.87889C2 10.7576 2 12.1718 2 15.0002L2 16.0002C2 18.8286 2 20.2429 2.87868 21.1215C3.17848 21.4213 3.54062 21.6188 4 21.749" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>                   
                    </div>           
                <div class="flex justify-between gap-2">
                    <p><strong>Logo:-</strong></p>
                    <a href="{{ asset('assets/upload/'.$view->logo) }}" download="{{ $view->logo }}" target="_blank" style="color: blue;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 22.0002H16C18.8284 22.0002 20.2426 22.0002 21.1213 21.1215C22 20.2429 22 18.8286 22 16.0002V15.0002C22 12.1718 22 10.7576 21.1213 9.8789C20.3529 9.11051 19.175 9.01406 17 9.00195M7 9.00195C4.82497 9.01406 3.64706 9.11051 2.87868 9.87889C2 10.7576 2 12.1718 2 15.0002L2 16.0002C2 18.8286 2 20.2429 2.87868 21.1215C3.17848 21.4213 3.54062 21.6188 4 21.749" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                            <path d="M12 2L12 15M12 15L9 11.5M12 15L15 11.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(index) {
        var modal = document.getElementById("myModal" + index);
        modal.style.display = "block";
    }

    function closeModal(index) {
        var modal = document.getElementById("myModal" + index);
        modal.style.display = "none";
    }

    // Close modal when clicking outside
    window.onclick = function (event) {
        var modals = document.querySelectorAll(".modal");
        modals.forEach(function (modal) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    };
</script>
