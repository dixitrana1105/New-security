<x-layout.default>
    <style>
        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-red-500 {
            background-color: #ef4444;
        }
    </style>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
        <div>
            <form action="{{ route('deleteCollectionApi') }}" method="GET">
                <input type="hidden" name="building_id" value="{{ $data['building_id'] }}">
                <input type="hidden" name="building_type" value="{{ $data['building_type'] }}">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg">Delete Faces</button>
            </form>
        </div>
        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto"
            style="border-color: #a8acaf; border-width: medium;">
            <button type="button" onclick="initializeCameraSelection()"
                class="absolute top-10 right-10 px-4 py-2 bg-blue-500 text-black rounded-lg shadow-lg btn btn-primary">
                New Scan
            </button>
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Visitor</h1>
            </div>

            <form id="visitorForm" action="{{ route('detectFaceApi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Video stream for camera -->
                <div class="flex justify-center mb-4" id="videoContainer">
                    <video id="video" width="640" height="480" autoplay style="border: 2px solid #a8acaf;"
                        hidden></video>
                </div>

                <!-- Image preview after capture -->
                <div class="flex justify-center mb-4" id="previewContainer" style="display: block;">
                    <img id="capturedPreview" alt="Captured Image"
                        value="{{ asset('assets/images/security-logo.jpg') }}"
                        style="border: 2px solid #a8acaf; width: 640px; height: 480px;">
                </div>
                <div>
                    <input type="hidden" name="building_id" id="building_id" value="{{ $data['building_id'] }}">
                    <input type="hidden" name="building_type" id="building_type" value="{{ $data['building_type'] }}">

                </div>
                <!-- Capture and Scan Again buttons -->
                <div class="flex justify-center mb-4">
                    <button type="button" onclick="captureImage()" class="px-4 py-2 bg-blue-500 text-white rounded-lg"
                        hidden id="captureBtn">Capture Image</button>
                    <button type="button" onclick="initializeCameraSelection()"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg" style="display: none;" id="scanAgainBtn">
                        Scan Again
                    </button>
                </div>

                <!-- Hidden field to store captured image as file -->
                <input type="file" style="display:none;" name="file" id="captured_image">

                <div class="flex justify-center">
                    <button type="button" onclick="ajaxSubmitForm()"
                        class="px-4 py-2 bg-green-500 btn btn-primary text-white rounded-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const captureBtn = document.getElementById('captureBtn');
        const scanAgainBtn = document.getElementById('scanAgainBtn');
        const previewContainer = document.getElementById('previewContainer');
        const videoContainer = document.getElementById('videoContainer');
        const capturedPreview = document.getElementById('capturedPreview');
        let stream;

        async function initializeCameraSelection() {
            previewContainer.style.display = 'none';
            video.hidden = false;
            captureBtn.hidden = false;
            scanAgainBtn.style.display = 'none';

            const devices = await navigator.mediaDevices.enumerateDevices();
            const videoDevices = devices.filter(device => device.kind === 'videoinput');

            let selectedDeviceId;
            if (videoDevices.length > 1) {
                const deviceLabels = videoDevices.map((device, index) => `${index + 1}: ${device.label}`);
                const selectedIndex = prompt(`Select a camera:\n${deviceLabels.join('\n')}\nEnter number:`);

                if (selectedIndex && videoDevices[selectedIndex - 1]) {
                    selectedDeviceId = videoDevices[selectedIndex - 1].deviceId;
                } else {
                    alert("Invalid selection or no camera selected.");
                    return;
                }
            } else if (videoDevices.length === 1) {
                selectedDeviceId = videoDevices[0].deviceId;
            } else {
                alert("No camera found.");
                return;
            }

            startVideoStream(selectedDeviceId);
        }

        async function startVideoStream(deviceId) {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        deviceId: {
                            exact: deviceId
                        }
                    }
                });
                video.srcObject = stream;
                video.hidden = false;
                captureBtn.hidden = false;
            } catch (error) {
                console.error("Error accessing the camera:", error);
                alert("Unable to access camera.");
            }
        }

        function captureImage() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageDataUrl = canvas.toDataURL('image/png');

            // Create a file from base64 data
            const blob = base64ToBlob(imageDataUrl, 'image/png');
            const file = new File([blob], 'captured_image.png', {
                type: 'image/png'
            });

            // Use DataTransfer to create a FileList
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('captured_image').files = dataTransfer.files;

            // Show the preview
            capturedPreview.src = imageDataUrl;
            video.hidden = true;
            captureBtn.hidden = true;
            previewContainer.style.display = 'block';
            scanAgainBtn.style.display = 'inline-block';
        }

        function base64ToBlob(base64, contentType) {
            const byteCharacters = atob(base64.split(',')[1]);
            const byteNumbers = new Array(byteCharacters.length);
            for (let i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            const byteArray = new Uint8Array(byteNumbers);
            return new Blob([byteArray], {
                type: contentType
            });
        }

        function ajaxSubmitForm() {
            const form = document.getElementById('visitorForm');
            const formData = new FormData(form);
            let building_id = document.getElementById('building_id').value;
            let building_type = document.getElementById('building_type').value;
            // Perform the AJAX request
            fetch("{{ route('detectFaceApiController') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    },
                })
                .then(response => response.json())
                .then(data => {
                    alert("Form submitted successfully!");
                    console.log("Server response:", data);

                    if (data.data && data.status === true) {
                        if (building_type === 'building') {
                            console.log('redirected to building');
                        } else if (building_type === 'school') {
                            console.log('redirected to school');
                        }
                    }
                })
                .catch(error => {
                    console.error("Error submitting form:", error);
                    alert("Failed to submit form. Please try again.");
                });
        }
    </script>
</x-layout.default>
