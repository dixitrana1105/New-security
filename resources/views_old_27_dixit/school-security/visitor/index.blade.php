<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">Visitor List</h1>
    </div>

    <div class="table-responsive">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Visitor ID</th>
                    <th class="font-bold py-2 px-8">Date</th>
                    <th class="font-bold py-2 px-8">Photo</th>
                    <th class="font-bold py-2 px-8">Full Name</th>
                    <th class="font-bold py-2 px-8">In Time</th>
                    <th class="font-bold py-2 px-8">Out Time</th>
                    <th class="font-bold py-2 px-8">ID Proof</th>
                    <th class="font-bold py-2 px-8">Visitor Purpose</th>
                    <th class="font-bold py-2 px-8">Previous Log</th>
                    <th class="font-bold py-2 px-8">Block</th>
                    <th class="font-bold py-2 px-8">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitor->sortByDesc('created_at') as $key => $item)
                <tr class="border-b duration-300">
                    <td>{{ $key + 1}}</td>
                    <td>{{ $item->visitor_id}}</td>
                    <td>{{ $item->date}}</td>
                    <td>
                        <img src="{{ asset($item->photo) }}" alt="image"
                            class="w-30 h-30 object-cover mb-5" />
                    </td>
                    {{-- <td>
                        <img src="{{ asset('assets/images/'.$item->photo) }}" alt="{{$item->visitor_name}}" class="w-12 h-12">
                    </td> --}}
                    <td>{{ $item->visitor_name}}</td>
                    <td>{{ $item->in_time}}</td>
                    @if ($item->out_time_remark == null)
                            <td class="py-2 px-8">
                                <div class="container mt-5">
                                    <div x-data="{ open: false }">
                                        <!-- Button to open the modal -->
                                        <button type="button" class="btn btn-danger" @click="open = !open"
                                            style="width: 100px; float: right; margin-bottom: 8px;">
                                            Out
                                        </button>

                                        <!-- Modal Structure -->
                                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden"
                                            :class="open && '!block'">
                                            <div class="flex items-start justify-center min-h-screen px-4"
                                                @click.self="open = false">
                                                <div x-show="open" x-transition x-transition.duration.300
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                                    <div
                                                        class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                        <h5 class="font-bold text-lg"></h5>
                                                        <button type="button" class="text-white-dark hover:text-dark"
                                                            @click="open = false">
                                                            <svg style="max-height: 40px;"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                width="24" height="24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-5">
                                                        <form action="{{ route('school.security.visitor.storeOutTimeRemark') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="security_id"
                                                                value="{{ $item->id }}">

                                                            <div class="form-group">
                                                                <div>
                                                                    <label
                                                                        for="out_time_remark"><strong>Remark</strong></label>
                                                                    <input id="out_time_remark" type="text"
                                                                        name="out_time_remark"
                                                                        placeholder="Enter your remark"
                                                                        class="form-input" required />
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <button type="submit"
                                                                    class="btn btn-primary !mt-6">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="py-2 px-8">
                                {{ $item->out_time }}
                                <button class="btn btn-primary rounded show-remark-btn"
                                    data-remark="{{ $item->out_time_remark }}">
                                    Show Remark
                                </button>
                            </td>
                        @endif
                        <td class="">
                            <img src="{{ asset($item->id_proof) }}" alt="image" class="object-cover"
                                style="width: 200px; height: 100px;" />
                        </td>
                        <td class="py-2 px-8">{{ $item->visiter_purpose }}</td>
                    <td>
                        <div class="container mt-5">
                            <div x-data="modal">
                                <button type="button" class="btn btn-primary" @click="toggle"
                                    style="width: 100px; float:right; margin-bottom: 8px;"> Log </button>
                                <div class="fixed inset-0 bg-[black]/60 z-[999]  hidden" :class="open && '!block'">
                                    <div class="flex items-start justify-center min-h-screen px-4"
                                        @click.self="open = false">
                                        <div x-show="open" x-transition x-transition.duration.300
                                            class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-5xl my-8">
                                            <div
                                                class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                                <h5 class="font-bold text-lg">Previous Log List</h5>
                                                <button type="button" class="text-white-dark hover:text-dark"
                                                    @click="toggle"><svg style="max-height: 40px;"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        width="24" height="24" fill="none"
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-x">
                                                        <line x1="18" y1="6" x2="6"
                                                            y2="18"></line>
                                                        <line x1="6" y1="6" x2="18"
                                                            y2="18"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-5">
                                                @php
                                                    $visitorId = $item->visitor_id_detected;
                                                    $visitor = App\Models\SchoolSecurityVisitor::where('visitor_id_detected',$visitorId)->get();
                                                @endphp
                                                @include('school-security.visitor.previous-log', [
                                                    'get_all_records_for_school_visitor' => $visitor,
                                                ])
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($item->visitor_block == null)
                        <button
                        class="block-visitor-btn btn-danger text-white font-bold py-1 px-4 rounded shadow-md transition duration-300"
                        data-visitor-id="{{ $item->visitor_id }}">
                        Block
                        </button>
                        {{-- <form action="{{ route('school.visitor.block', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                            data-visitor-id="{{ $item->visitor_id }}"
                            >Block</button>
                        </form> --}}
                        @else
                        Block
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('school.security.visitor.status', $item->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="{{ $item->status == 1 ? 0 : 1 }}">
                            <button type="submit" class="btn {{ $item->status ? 'btn-success' : 'btn-danger' }}">
                                {{ $item->status ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="blockVisitorModal" class="hidden fixed z-10 inset-0 bg-gray-800 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-4 rounded shadow-lg max-w-sm w-full relative">

                <button id="blockVisitorcloseModal"
                    class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold">
                    &times;
                </button>

                <h2 class="text-xl font-bold mb-4">Block Visitor</h2>
                <form id="blockVisitorForm">
                    <input type="hidden" id="visitorId" name="visitor_id">

                    <label for="blockVisitorRemark" class="block text-sm font-medium text-gray-700">Block Visitor
                        Remark</label>
                    <textarea id="blockVisitorRemark" name="block_visitor_remark" class="mt-1 block w-full p-2 border rounded-md"
                        rows="4"></textarea>

                    <div class="mt-4">
                        <button type="button" id="submitBlockVisitor" class="btn btn-primary rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>   

    <!-- Remark Modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const blockVisitorButtons = document.querySelectorAll('.block-visitor-btn');
            const blockVisitorModal = document.getElementById('blockVisitorModal');
            const closeModalButton = document.getElementById('blockVisitorcloseModal');
            const blockVisitorForm = document.getElementById('blockVisitorForm');
            const submitBlockVisitor = document.getElementById('submitBlockVisitor');
            const visitorIdInput = document.getElementById('visitorId');
            const blockVisitorRemark = document.getElementById('blockVisitorRemark');
    
            // Open modal and set visitor ID
            blockVisitorButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const visitorId = this.getAttribute('data-visitor-id');
                    visitorIdInput.value = visitorId; // Set the visitor ID in the input field
                    blockVisitorModal.classList.remove('hidden'); // Show the modal
                });
            });
    
            // Close modal
            closeModalButton.addEventListener('click', function () {
                blockVisitorModal.classList.add('hidden');
            });
    
            // Submit block visitor request
            submitBlockVisitor.addEventListener('click', function () {
                const visitorId = visitorIdInput.value.trim();
                const remark = blockVisitorRemark.value.trim();
    
                // Validate inputs
                if (!visitorId || !remark) {
                    alert('Please fill in all fields.');
                    return;
                }
    
                fetch('/school/visitor/block', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        visitor_id: visitorId,
                        block_visitor_remark: remark,
                    })
                })
                    .then(response => {
                        if (!response.ok) {
                            // Handle non-200 responses
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response:', data); // Log the response for debugging
                        if (data.success) {
                            alert('Visitor blocked successfully!');
                            window.location.reload(); // Reload the page to reflect changes
                        } else {
                            alert(data.message || 'An error occurred.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error); // Log error for debugging
                        alert('An error occurred while processing your request. Please try again.');
                    })
                    .finally(() => {
                        blockVisitorModal.classList.add('hidden'); // Hide the modal
                    });
            });
        });
    </script>

</x-layout.default>
