<x-layout.default>
    <style>
        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .bg-red-500 {
            background-color: #ef4444;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <div class="flex justify-left mb-4">

                <button id="preapproveVisitorButton" class="btn btn-warning">Preapprove Visitor</button>

                <div id="visitorDropdownContainer" style="display: none; margin-top: 10px;">
                    <select id="visitorDropdown" class="form-control"
                        style="
                margin-left: 1rem;
            ">
                        <option value="">Select a Visitor</option>
                    </select>
                </div>
            </div>
            <form id="visitorForm" action="{{ route('detectFaceApiController') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Video stream for camera -->
                <div class="flex justify-center mb-4" id="videoContainer">
                    <video id="video" width="640" height="480" autoplay style="border: 2px solid #a8acaf;"
                        hidden></video>
                </div>

                <!-- Image preview after capture -->
                <div class="flex justify-center mb-4" id="previewContainer" style="display: block;">
                    <img id="capturedPreview" alt="Captured Image" src="{{ asset('assets/images/security-logo.jpg') }}"
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
                        class="px-4 py-2 bg-green-500 btn btn-primary text-white rounded-lg" id="submitBtn"
                        style="display: none;">Submit</button>
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
        const submitBtn = document.getElementById('submitBtn');
        let stream;

        // Show the logo image initially
        previewContainer.style.display = 'block';
        video.hidden = true;
        captureBtn.hidden = true;

        async function requestCameraPermission() {
            try {
                const permissionStatus = await navigator.permissions.query({
                    name: "camera"
                });

                if (permissionStatus.state === "granted") {
                    initializeCameraSelection();
                } else if (permissionStatus.state === "prompt") {
                    initializeCameraSelection();
                } else if (permissionStatus.state === "denied") {
                    showPermissionNotification();
                }

                permissionStatus.onchange = () => {
                    if (permissionStatus.state === "granted") {
                        initializeCameraSelection();
                    } else if (permissionStatus.state === "denied") {
                        showPermissionNotification();
                    }
                };
            } catch (error) {
                console.error("Error checking camera permissions:", error);
                alert("Unable to check camera permissions. Please check your browser settings.");
            }
        }


        function showPermissionNotification() {
            const notificationContainer = document.createElement('div');
            notificationContainer.style.position = 'fixed';
            notificationContainer.style.bottom = '20px';
            notificationContainer.style.right = '20px';
            notificationContainer.style.backgroundColor = '#f8d7da';
            notificationContainer.style.color = '#721c24';
            notificationContainer.style.padding = '15px';
            notificationContainer.style.border = '1px solid #f5c6cb';
            notificationContainer.style.borderRadius = '5px';
            notificationContainer.style.zIndex = '1000';
            notificationContainer.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';

            notificationContainer.innerHTML = `
            <p style="margin: 0;">Camera access is blocked. Please enable it in your browser settings.</p>
            <button style="margin-top: 10px; padding: 5px 10px; background: #721c24; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Learn How</button>
        `;

            document.body.appendChild(notificationContainer);

            const learnHowButton = notificationContainer.querySelector('button');
            learnHowButton.addEventListener('click', () => {
                alert(
                    'To enable camera permissions:\n\n1. Click on the lock icon in your browser address bar.\n2. Find "Camera" and select "Allow".\n3. Reload the page.'
                );
            });

            setTimeout(() => {
                document.body.removeChild(notificationContainer);
            }, 10000);
        }

        async function initializeCameraSelection() {
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
            previewContainer.style.display = 'none';
            video.hidden = false;
            captureBtn.hidden = false;
            scanAgainBtn.style.display = 'none';
            submitBtn.style.display = 'block';
            startVideoStream(selectedDeviceId);
        }

        async function startVideoStream(deviceId) {
            if (stream) {
                // Stop any existing video streams
                stream.getTracks().forEach(track => track.stop());
            }

            try {
                // Attempt to access the camera using the selected deviceId
                stream = await navigator.mediaDevices.getUserMedia({
                    video: deviceId ? {
                        deviceId: {
                            exact: deviceId
                        }
                    } : true // fallback to default camera if deviceId is not valid
                });
                video.srcObject = stream;
                video.hidden = false;
                captureBtn.hidden = false;
            } catch (error) {
                console.error("Error accessing the camera:", error);
                if (error.name === "OverconstrainedError") {
                    alert("The selected camera doesn't meet the requirements. Reinitializing camera selection...");
                    initializeCameraSelection(); // Restart camera selection if constraints fail
                } else if (error.name === "NotAllowedError") {
                    showPermissionNotification();
                } else {
                    alert("Unable to access camera. Please check your settings.");
                }
            }
        }

        function captureImage() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');

            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageDataUrl = canvas.toDataURL('image/png');


            const blob = base64ToBlob(imageDataUrl, 'image/png');
            const file = new File([blob], 'captured_image.png', {
                type: 'image/png'
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            document.getElementById('captured_image').files = dataTransfer.files;



            capturedPreview.src = imageDataUrl;
            video.hidden = true;
            captureBtn.hidden = true;
            previewContainer.style.display = 'block';
            scanAgainBtn.style.display = 'inline-block';
            return file;
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
            console.log(formData);
            // debugger;
            let building_id = document.getElementById('building_id').value;
            const pre_approved_visitor = visitorDropdown.value;
            const capturedPreview = document.getElementById('capturedPreview');
            console.log(pre_approved_visitor);
            // debugger;
            if (pre_approved_visitor !== null && pre_approved_visitor !== "") {
                resizeAndConvertToBlob(capturedPreview.src).then(resizedBase64 => {
                    // Create a new URLSearchParams object and append parameters
                    const queryParams = new URLSearchParams({
                        pre_approved_visitor: pre_approved_visitor,
                        capturedPreview: resizedBase64
                    });

                    // Append additional formData values if available
                    for (const [key, value] of Object.entries(formData)) {
                        queryParams.append(key, value);
                    }

                    // Redirect with query parameters
                    window.location.href = `/building-security/pre-visitor-create?${queryParams.toString()}`;
                }).catch(error => {
                    console.error("Error resizing image:", error);
                });
            }


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
                    debugger;

                    if (data.data && data.status === true) {
                        if (data.data.building_type === 'building') {
                            console.log("get:", data.data.building_type);

                            console.log(data.data);
                            console.log('Redirected to building.');
                            buildingFunction(data);
                        } else if (data.data.building_type === 'school') {
                            console.log('Redirected to school.');
                            schoolFunction(data);
                        }
                    }
                })
                .catch(error => {
                    console.error("Error submitting form:", error);
                    alert("Failed to submit form. Please try again.");
                });
        }

        function resizeAndConvertToBlob(capturedPreviewSrc) {
            const img = new Image();
            img.src = capturedPreviewSrc;

            // Create a new promise to handle image load and resize
            return new Promise((resolve, reject) => {
                img.onload = () => {
                    // Set the desired width and height
                    const maxWidth = 100; // Set the max width for resizing
                    const maxHeight = 100; // Set the max height for resizing

                    // Create a canvas element for resizing
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    // Calculate the new width and height maintaining the aspect ratio
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;

                    // Draw the image to the canvas with the new size
                    ctx.drawImage(img, 0, 0, width, height);

                    // Convert the canvas content to base64
                    const resizedBase64 = canvas.toDataURL(
                        'image/jpeg'); // You can choose other formats as well

                    // Return the base64 image string
                    resolve(resizedBase64);
                };

                img.onerror = reject;
            });
        }

        function buildingFunction(data) {
            console.log('ok');
            console.log(data.data.is_new_visitor);

            if (data.data.is_new_visitor === true) {
                console.log('New visitor detected. Redirecting...');
                const capturedPreview = document.getElementById('capturedPreview');

                resizeAndConvertToBlob(capturedPreview.src).then(resizedBase64 => {
                    // Create a new URLSearchParams object and append parameters
                    const queryParams = new URLSearchParams(data.data);
                    queryParams.append('capturedPreview', resizedBase64);

                    // Redirect with the query parameters
                    window.location.href = `/building-security/visitor-create?${queryParams.toString()}`;
                });
            } else {
                console.log('Returning visitor detected.');
                console.log('ok');
                console.log(data.data);

                const capturedPreview = document.getElementById('capturedPreview');

                resizeAndConvertToBlob(capturedPreview.src).then(resizedBase64 => {
                    // Create a new URLSearchParams object and append parameters
                    const queryParams = new URLSearchParams(data.data);
                    queryParams.append('capturedPreview', resizedBase64);

                    // Redirect with the query parameters
                    window.location.href = `/building-security/repeat-visitor-create?${queryParams.toString()}`;
                });
            }

        }

        function schoolFunction(data) {
            console.log(data);
            if (data.data.is_new_visitor === true) {

                // console.log('New visitor detected. Redirecting...');

                // const queryParams = new URLSearchParams(data.data).toString();
                // window.location.href = `/school/security/visitor/create?${queryParams}`;
                const capturedPreview = document.getElementById('capturedPreview');

                resizeAndConvertToBlob(capturedPreview.src).then(resizedBase64 => {
                    // Create a new URLSearchParams object and append parameters
                    const queryParams = new URLSearchParams(data.data);
                    queryParams.append('capturedPreview', resizedBase64);

                    // Redirect with the query parameters
                    window.location.href = `/school/security/visitor/create?${queryParams.toString()}`;
                });
            } else {
                console.log('Returning visitor detected.');
                console.log('ok');
                console.log(data.data);

                // const queryParams = new URLSearchParams(data.data).toString();
                // window.location.href = `/school/security/repeat-visitor/create?${queryParams}`;
                const capturedPreview = document.getElementById('capturedPreview');

                resizeAndConvertToBlob(capturedPreview.src).then(resizedBase64 => {
                    // Create a new URLSearchParams object and append parameters
                    const queryParams = new URLSearchParams(data.data);
                    queryParams.append('capturedPreview', resizedBase64);

                    // Redirect with the query parameters
                    window.location.href = `/school/security/repeat-visitor/create?${queryParams.toString()}`;
                });
            }
        }


        document.getElementById('preapproveVisitorButton').addEventListener('click', function() {
            const container = document.getElementById('visitorDropdownContainer');
            container.style.display = container.style.display === 'none' ? 'block' : 'none';

            // Fetch visitors dynamically
            fetch('/get-visitors-by-building/{{ $data['building_id'] }}')
                .then(response => response.json())
                .then(data => {
                    const dropdown = document.getElementById('visitorDropdown');
                    dropdown.innerHTML = '<option value="">Select a Visitor</option>'; // Clear existing options
                    data.forEach(visitor => {
                        const option = document.createElement('option');
                        option.value = visitor.id;
                        option.textContent = visitor.full_name;
                        dropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching visitors:', error));
        });
    </script>


</x-layout.default>
