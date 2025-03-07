<x-layout.default>

    {{-- {{dd('repeate page');}} --}}
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto "
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Visitor</h1>
            </div>
            @if ($isBlocked)
                <button class="btn btn-danger" style="margin-left: 57rem;">Blocked</button>
                <p style='text-align: right; color: red'>{{ $isBlocked->block_tenant_remark }}</p>
            @else
                <button class="btn btn-success" style="margin-left: 57rem;">Active</button>
            @endif

            <form action="{{ route('building-security.repeate-store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label for="VisitorId"><strong>Visitor ID </strong></label>
                        <input id="VisitorId" type="text" name="VisitorId" value="{{ $nextVisitorId }}"
                            placeholder="Auto Generate" class="form-input" required readonly />
                    </div>
                    <div>
                        <label for="date"><strong>Date</strong></label>
                        <input id="date" name="date" placeholder="Enter Date" class="form-input" readonly
                            required />
                    </div>

                    {{-- {{ dd($visitor_id) }} --}}

                    {{-- {{ dd($get_all_data->out_time); }} --}}

                    <input type="hidden" name="visitor_id" value="{{ $visitor_id }}">


                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="Photo"><strong>Photo</strong></label>
                        <img src="{{ asset($idProofPath ?? 'default/image/path.jpg') }}" width="300" height="300" name="photo" alt="image"
                            class="w-30 h-30 object-cover mb-5" />
                        
                        <!-- Hidden field to submit the photo path -->
                        <input type="hidden" name="photo" value="{{ $idProofPath ?? '' }}" />
                    </div>


                    <div>
                        <label for="full_name"><strong>Full Name</strong></label>
                        <input id="full_name" name="full_name" value="{{ $get_all_data->full_name }}" type="text"
                            placeholder="Enter Full Name" class="form-input" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    <?php
                    date_default_timezone_set('Asia/Kolkata');
                    ?>

                    <div>
                        <label for="in_time"><strong>In Time (IST)</strong></label>
                        <input id="in_time" name="in_time" type="time" value="{{ date('H:i') }}"
                            placeholder="Enter time" class="form-input" required readonly />
                    </div>

                    <div>
                        <label for="out_time"><strong>Out Time</strong></label>
                        <input id="out_time" name="out_time" type="time" placeholder="Enter  time"
                            class="form-input" />
                    </div>
                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <!-- ID Proof Capture -->
                        <label for="ID Proof"><strong>ID Proof</strong></label>

                        <div id="idCameraContainer" class="mb-4">
                            <video id="idVideo" width="640" height="480" autoplay
                                style="border: 2px solid #a8acaf;"></video>
                        </div>

                        <div id="idImagePreview" class="flex justify-center mb-4 hidden">
                            <img id="idCapturedPreview" alt="Captured ID Proof" class="rounded-lg"
                                style="width: 640px; height: 480px;" />
                        </div>

                        <div class="flex justify-center mb-4">
                            <button type="button" id="idCaptureBtn" class="btn btn-primary">Capture ID Proof</button>
                            <button type="button" id="idRetakeBtn" class="btn btn-primary">Retake</button>
                        </div>

                        <input type="hidden" id="id_captured_image" name="id_file" />
                    </div>





                    <!-- Previous Log Modal Section -->
                    <div class="mt-5">
                        <div x-data="{ open: false }">
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-primary w-40 float-right mb-2" @click="open = true">
                                View Previous Log
                            </button>

                            <!-- Modal overlay -->
                            <div class="fixed inset-0 bg-black/60 z-[999] hidden" :class="{ '!block': open }">
                                <div class="flex items-start justify-center min-h-screen px-4"
                                    @click.self="open = false">
                                    <div x-show="open" x-transition x-transition.duration.300
                                        class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                        <!-- Modal Header -->
                                        <div
                                            class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                            <h5 class="font-bold text-lg">Previous Log List</h5>
                                            <button type="button" class="text-white-dark hover:text-dark"
                                                @click="open = false">
                                                <svg style="max-height: 40px;" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" width="24" height="24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6"
                                                        y2="18"></line>
                                                    <line x1="6" y1="6" x2="18"
                                                        y2="18"></line>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="p-5">
                                            @include(
                                                'building-security.visitor.previous-log',
                                                $get_all_records_for_visitor)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label for="mobile"><strong>Mobile Number</strong></label>
                        <input id="mobile" name="mobile" type="number" value="{{ $get_all_data->mobile }}" placeholder="Enter mobile number" class="form-input" required readonly/>
                    </div>
                    
                    <div>
                        <label for="whatsapp"><strong>WhatsApp Number</strong></label>
                        <input id="whatsapp" name="whatsapp" type="number" value="{{ $get_all_data->whatsapp }}" placeholder="Enter WhatsApp number" class="form-input" required readonly/>
                    </div>
                    </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="visiter_purpose"><strong>Visitor Purpose</strong></label>
                        <input id="visiter_purpose" name="visiter_purpose" type="text"
                            placeholder="Enter Visitor Purpose" class="form-input" required />
                    </div>
                    <div>
                        <label for="tenant_flat_office_no"><strong>Tenant</strong></label>
                        <select id="tenant_flat_office_no" name="tenant_flat_office_no" class="form-input" required>
                            <option value="">Select Tenant</option>
                            @foreach ($tenants as $tenant)
                                <option value="{{ $tenant->flat_office_no }}">{{ $tenant->flat_office_no }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div>
                    <button 
                    type="submit" 
                    class="btn btn-primary !mt-6" 
                    @if ($isBlockedFlag == 1) disabled @endif
                >
                    Submit
                </button>
                
                </div>
            </form>
        </div>
    </div>

    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        //   $(document).ready(function() {
        //     $('#tenant_flat_office_no').on('change', function() {
        //         var tenantId = $(this).val(); 
        //         var visitorId = $("input[name='visitor_id']").val(); 

        //         if (tenantId && visitorId) {
        //             $.ajax({
        //                 url: "/building-security/check-block-tenant", 
        //                 type: 'GET', 
        //                 data: {
        //                     tenant_id: tenantId,
        //                     visitor_id: visitorId
        //                 },
        //                 success: function(response) {

        //                     alert(response.message); 
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error("AJAX Error: " + status + ": " + error);
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>

    <script>
        const video = document.getElementById('video');
        const captureBtn = document.getElementById('captureBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const imagePreview = document.getElementById('imagePreview');
        const capturedPreview = document.getElementById('capturedPreview');
        const capturedInput = document.getElementById('captured_image');

        let stream;

        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = stream;
            } catch (error) {
                console.error('Camera access error:', error);
                alert('Unable to access camera. Please check permissions.');
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }

        function captureImage() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageDataUrl = canvas.toDataURL('image/png');

            capturedPreview.src = imageDataUrl;
            capturedInput.value = imageDataUrl;

            imagePreview.classList.remove('hidden');
            video.style.display = 'none';
            captureBtn.style.display = 'none';
            retakeBtn.style.display = 'block';
        }

        captureBtn.addEventListener('click', captureImage);
        retakeBtn.addEventListener('click', () => {
            imagePreview.classList.add('hidden');
            video.style.display = 'block';
            captureBtn.style.display = 'block';
            retakeBtn.style.display = 'none';
        });

        startCamera();

        window.addEventListener('beforeunload', stopCamera);
    </script>

    <script>
        const idVideo = document.getElementById('idVideo');
        const idCaptureBtn = document.getElementById('idCaptureBtn');
        const idRetakeBtn = document.getElementById('idRetakeBtn');
        const idImagePreview = document.getElementById('idImagePreview');
        const idCapturedPreview = document.getElementById('idCapturedPreview');
        const idCapturedInput = document.getElementById('id_captured_image');

        let idStream;

        async function startIdCamera() {
            try {
                idStream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                idVideo.srcObject = idStream;
            } catch (error) {
                console.error('ID Camera access error:', error);
                alert('Unable to access ID camera. Please check permissions.');
            }
        }

        function stopIdCamera() {
            if (idStream) {
                idStream.getTracks().forEach(track => track.stop());
            }
        }

        function captureIdImage() {
            const canvas = document.createElement('canvas');
            canvas.width = idVideo.videoWidth;
            canvas.height = idVideo.videoHeight;
            const context = canvas.getContext('2d');

            context.drawImage(idVideo, 0, 0, canvas.width, canvas.height);
            const idImageDataUrl = canvas.toDataURL('image/png');

            idCapturedPreview.src = idImageDataUrl;
            idCapturedInput.value = idImageDataUrl;

            idImagePreview.classList.remove('hidden');
            idVideo.style.display = 'none';
            idCaptureBtn.style.display = 'none';
            idRetakeBtn.style.display = 'block';
        }

        idCaptureBtn.addEventListener('click', captureIdImage);
        idRetakeBtn.addEventListener('click', () => {
            idImagePreview.classList.add('hidden');
            idVideo.style.display = 'block';
            idCaptureBtn.style.display = 'block';
            idRetakeBtn.style.display = 'none';
        });

        startIdCamera();

        window.addEventListener('beforeunload', stopIdCamera);
    </script>


</x-layout.default>
