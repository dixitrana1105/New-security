<x-layout.default>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto "
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Visitor</h1>
            </div>
            <form action="{{route('school.security.visitor.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="VisitorId"><strong>Visitor ID </strong></label>
                        <input id="VisitorId" type="text" name="VisitorId" value="{{$nextId}}" placeholder="Auto Generate"
                            class="form-input" readonly />
                    </div>
                    <div>
                        <label for="date"><strong>Date</strong></label>
                        <input id="registerDate" name="date" type="date" placeholder="Enter Date" class="form-input"
                            required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="class"><strong>Class</strong></label>
                        <select id="class" name="class" class="form-input" required>
                            <option value="">Select Class</option>
                            @foreach ($class as $item)
                                <option value="{{ $item->class }}">{{ $item->class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="section"><strong>Section</strong></label>
                        <select id="section" name="section" class="form-input" required>
                            <option value="">Select Section</option>
                        </select>
                    </div>
                    <div>
                        <label for="student"><strong>Students</strong></label>
                        <select id="student" name="student" class="form-input" required>
                            <option value="">Select Student</option>                            
                        </select>
                    </div>
                </div>             
                
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">                    
                    <div>
                        <label for="name"><strong>Full Name</strong></label>
                        <input id="name" name="name" type="text" placeholder="Enter Full Name"
                            class="form-input" required />
                    </div>
                    <div>
                        <label for="email"><strong>Email</strong></label>
                        <input id="email" name="email" type="email" placeholder="Enter email" class="form-input"
                            required />
                        <input type="hidden" name="visitor_id" value="{{ $visitor_id }}">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="mobile"><strong>Mobile</strong></label>
                        <input id="mobile" name="mobile" type="number" placeholder="enter mobile" 
                        class="form-input" required />
                    </div>
                    <div>
                        <label for="whatsapp"><strong>Whatsapp</strong></label>
                        <input id="whatsapp" name="whatsapp" type="number" placeholder="Enter whatsapp"
                            class="form-input" required />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">                    
                    <div>
                        <label for="in_time"><strong>In Time</strong></label>
                        <input id="in_time" name="in_time" type="time" value="{{ date('H:i') }}" placeholder="Enter time" class="form-input"
                            required />
                    </div>
                    <div>
                        <label for="out_time"><strong>Out Time</strong></label>
                        <input id="out_time" name="out_time" type="time" placeholder="Enter time" class="form-input"
                             />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- ID Proof Section -->
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

                        <input type="hidden" id="id_captured_image" name="proof" />
                    </div>
                    <div>
                        <label for="Photo"><strong>Photo</strong></label>

                        <div id="cameraContainer" class="mb-4">
                            <video id="video" width="640" height="480" autoplay
                                style="border: 2px solid #a8acaf;"></video>
                        </div>

                        <div id="imagePreview" class="flex justify-center mb-4 hidden">
                            <img id="capturedPreview" alt="Captured Image" class="rounded-lg"
                                style="width: 640px; height: 480px;" />
                        </div>

                        <div class="flex justify-center mb-4">
                            <button type="button" id="captureBtn" class="btn btn-primary">Capture Image</button>
                            <button type="button" id="retakeBtn" class="btn btn-primary">Retake</button>
                        </div>

                        <input type="hidden" id="captured_image" name="photo" />
                    </div>                   
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label for="visiter_purpose"><strong>Visitor Purpose</strong></label>
                        <input id="visiter_purpose" name="visiter_purpose" type="text" placeholder="Enter Visitor Purpose"
                            class="form-input" required />
                    </div>                    
                    
                </div>

                <div>
                    <button type="submit" class="btn btn-primary !mt-6">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('registerDate').value = new Date().toISOString().substring(0, 10);
    </script>

    <script>
        document.getElementById('class').addEventListener('change', function () {
    const classValue = this.value;
    const sectionSelect = document.getElementById('section');
    sectionSelect.innerHTML = '<option value="">Select Section</option>';  // Reset sections

    if (classValue) {
        fetch(`/get-sections?class=${classValue}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(function (section) {
                    const option = document.createElement('option');
                    option.value = section.section;
                    option.textContent = section.section;
                    sectionSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching sections:', error));
    }
});

document.getElementById('section').addEventListener('change', function () {
    const sectionValue = this.value;
    const studentSelect = document.getElementById('student');
    studentSelect.innerHTML = '<option value="">Select Student</option>';  // Reset students

    if (sectionValue) {
        console.log(sectionValue);

        fetch(`/get-students?section=${sectionValue}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(function (student) {
                    const option = document.createElement('option');
                    option.value = student.name;  // Use the correct student identifier
                    option.textContent = student.name;  // Display the student name
                    studentSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching students:', error));
    }
});

    </script>
     <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
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
