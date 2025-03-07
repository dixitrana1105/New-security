<x-layout.default>

    <style>
        /* Modal styles */
        /* Modal styles */
        .custom-modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .custom-modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .d-none {
            display: none;
        }
    </style>
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
                    <th class="font-bold py-2 px-8">User ID</th>
                    <th class="font-bold py-2 px-8">In Time</th>
                    <th class="font-bold py-2 px-8">Out Time</th>
                    <th class="font-bold py-2 px-8">ID Proof</th>
                    <th class="font-bold py-2 px-8">Visitor Purpose</th>
                    <th class="font-bold py-2 px-8">Previous Log</th>
                    <th class="font-bold py-2 px-8">Block User</th>
                    <th class="font-bold py-2 px-8">User Status</th>
                    <th class="font-bold py-2 px-8">Status</th>
                    {{-- <th class="font-bold py-2 px-8">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($security_data->sortByDesc('created_at') as $key => $security)
                    <tr>
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td class="py-2 px-8">{{ $security->visitor_id }}</td>
                        <td class="py-2 px-8">{{ $security->date }}</td>
                        <td>
                            <img src="{{ asset($security->photo) }}" alt="image"
                                class="w-30 h-30 object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $security->full_name }}</td>
                        <td class="py-2 px-8">{{ $security->tenant_flat_office_no }}</td>
                        <td class="py-2 px-8">{{ $security->in_time }}</td>

                        @if ($security->out_time_remark == null)
                            <td class="py-2 px-8">
                                {{-- {{ $security->out_time }} --}}
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
                                                        <form action="{{ route('building-security.timeout-remark') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="security_id"
                                                                value="{{ $security->id }}">

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
                                {{ $security->out_time }}
                                <button class="btn btn-primary rounded show-remark-btn"
                                    data-remark="{{ $security->out_time_remark }}">
                                    Show Remark
                                </button>
                            </td>
                        @endif



                        <td class="">
                            <img src="{{ asset($security->id_proof) }}" alt="image" class="object-cover"
                                style="width: 200px; height: 100px;" />
                        </td>

                        <td class="py-2 px-8">{{ $security->visiter_purpose }}</td>
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
                                                        $visitorId = $security->visitor_id_detected;
                                                        $visitor = App\Models\Visitor_Master::where(
                                                            'visitor_id_detected',
                                                            $visitorId,
                                                        )->get();
                                                    @endphp

                                                    @include('building-security.visitor.previous-log', [
                                                        'get_all_records_for_visitor' => $visitor,
                                                    ])
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($security->tenant_block == null)
                                <button
                                    class="block-tenant-btn btn-danger text-white font-bold py-1 px-4 rounded shadow-md transition duration-300"
                                    data-visitor-id="{{ $security->visitor_id }}"
                                    data-tenant-id="{{ $security->tenant_flat_office_no }}">
                                    Block
                                </button>
                            @else
                                Block
                            @endif

                        </td>

                        <!-- @if ($security->tenant_block == null)
<button
                                    class="block-tenant-btn btn-danger text-white font-bold py-1 px-4 rounded shadow-md transition duration-300"
                                    data-visitor-id="{{ $security->visitor_id }}"
                                    data-tenant-id="{{ $security->tenant_flat_office_no }}">
                                    Block
                                </button>
@else
Block
@endif -->
                        <!-- ok -->
                        <td class="py-2 px-8">
                            @if ($security->status_of_visitor === 0)
                                <button class="btn btn-success">Approve</button>
                                @if (!is_null($security->pre_approve_tenant_visitore_id))
                                    <p style="color: red;">Preapproved By User: {{ $security->pre_approve_tenant_visitore_id }}</p>
                                @endif
                                @if (!is_null($security->subtenant_id_tenant_block))
                                <p style="color: red;">SubUserId:{{ $security->subtenant_id_tenant_block }}</p>
                                @endif
                                -{{ $security->visitor_remark }}
                                
                            @elseif($security->status_of_visitor === 1)
                                <button class="btn btn-danger">Reject</button>
                                <p style="color: red;">SubUserId:{{ $security->subtenant_id_tenant_block }}</p>
                                -{{ $security->visitor_remark }}
                            @elseif($security->status_of_visitor === 2)
                                <button class="btn btn-primary">Reschedule</button>
                                {{-- <p style="color: red;">SubTenantId:{{ $security->subtenant_id_tenant_block }}</p> --}}
                                -{{ $security->reschedule_date }}
                                -{{ $security->visitor_remark }}
                            @elseif(is_null($security->status_of_visitor))
                                <button class="btn btn-warning">Pending</button>
                            @endif
                        </td>
                        {{-- <td class="py-2 px-8">
                            @if ($security->status_of_visitor === 0)
                                <button class="btn btn-success">Approve</button>
                                <button class="btn btn-info" disabled>SubTenantId: {{ $security->subtenant_id_tenant_block }}</button>
                                <button class="btn btn-info" disabled>-{{ $security->visitor_remark }}</button>
                            @elseif($security->status_of_visitor === 1)
                                <button class="btn btn-danger">Reject</button>
                                <button class="btn btn-info" disabled>SubTenantId: {{ $security->subtenant_id_tenant_block }}</button>
                                <button class="btn btn-info" disabled>-{{ $security->visitor_remark }}</button>
                            @elseif($security->status_of_visitor === 2)
                                <button class="btn btn-primary">Reschedule</button>
                                <button class="btn btn-info" disabled>SubTenantId: {{ $security->subtenant_id_tenant_block }}</button>
                                <button class="btn btn-info" disabled>-{{ $security->reschedule_date }}</button>
                                <button class="btn btn-info" disabled>-{{ $security->visitor_remark }}</button>
                            @elseif(is_null($security->status_of_visitor))
                                <button class="btn btn-warning">Pending</button>
                            @endif
                        </td> --}}
                        




                        <td class="py-2 px-8">
                            <form action="{{ route('building-security.visitor-status', $security->id) }}"
                                method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="{{ $security->status == 1 ? 0 : 1 }}">
                                <button type="submit"
                                    class="btn {{ $security->status ? 'btn-success' : 'btn-danger' }}">
                                    {{ $security->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>

                        {{-- <td>
                            @if (is_null($security->status_of_visitor) || $security->status_of_visitor === '')
                                <!-- Show buttons if status_of_visitor is null or empty -->
                                <button class="btn btn-primary btn-prove" data-id="{{ $security->id }}">Prove</button>
                                <button class="btn btn-danger btn-reject" data-id="{{ $security->id }}">Reject</button>
                                <button class="btn btn-warning btn-resedual" data-id="{{ $security->id }}">Reschedule</button>
                            @else
                                <!-- Show the status if status_of_visitor is not null/empty -->
                                @if ($security->status_of_visitor == 0)
                                    <span>Approved</span>
                                @elseif ($security->status_of_visitor == 1)
                                    <span>Rejected</span>
                                @elseif ($security->status_of_visitor == 2)
                                    <span>Rescheduled</span>
                                    <span style='color:red'>Date: {{ $security->reschedule_date }}</span>
                                @endif
                            @endif
                        </td> --}}




                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="remarkModal" class="fixed inset-0 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg p-4 max-w-sm w-full relative">
                <button id="closeIcon" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    &times;
                </button>

                <h2 class="text-lg font-semibold mb-2">Out Time Remark</h2>
                <p id="modalRemark" class="mt-2"></p>

                <div class="mt-4 flex justify-end space-x-2">
                    {{-- <button id="cancelModal" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button> --}}
                    <button id="closeModal" class="btn btn-success px-4 py-2 rounded">Close</button>
                </div>
            </div>
        </div>



        <div id="blockTenantModal" class="hidden fixed z-10 inset-0 bg-gray-800 bg-opacity-50">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-4 rounded shadow-lg max-w-sm w-full relative">

                    <button id="blockTenantcloseModal"
                        class="absolute top-2 right-2 text-gray-700 hover:text-gray-900 text-2xl font-bold">
                        &times;
                    </button>

                    <h2 class="text-xl font-bold mb-4">Block Tenant</h2>
                    <form id="blockTenantForm">
                        <input type="hidden" id="visitorId" name="visitor_id">
                        <input type="hidden" id="tenantId" name="tenant_id">

                        <label for="blockTenantRemark" class="block text-sm font-medium text-gray-700">Block Tenant
                            Remark</label>
                        <textarea id="blockTenantRemark" name="block_tenant_remark" class="mt-1 block w-full p-2 border rounded-md"
                            rows="4"></textarea>

                        <div class="mt-4">
                            <button type="button" id="submitBlockTenant" class="btn btn-primary rounded">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="customModal" class="custom-modal">
            <div class="custom-modal-content">
                <span class="close-modal">&times;</span>
                <h2 id="modalTitle">Action</h2>

                <div id="proveFields" class="remark-fields d-none">
                    <label for="proveRemark">Prove Remark</label>
                    <input type="text" class="form-input" id="proveRemark" placeholder="Enter prove remark">
                </div>

                <div id="rejectFields" class="remark-fields d-none">
                    <label for="rejectRemark">Reject Remark</label>
                    <input type="text" class="form-input" id="rejectRemark" placeholder="Enter reject remark">
                </div>

                <div id="resedualFields" class="remark-fields d-none">
                    <label for="resedualRemark">Resedual Remark</label>
                    <input type="text" class="form-input" id="resedualRemark"
                        placeholder="Enter resedual remark">
                    <label for="resedualDate">Resedual Date</label>
                    <input type="date" class="form-input" id="resedualDate">
                </div>

                <input type="hidden" id="currentRecordId">

                <br>
                <button class="btn btn-primary btn-save">Save Changes</button>
            </div>
        </div>



        <script>
            $('.show-remark-btn').on('click', function() {
                var remark = $(this).data('remark');

                $('#modalRemark').text(remark);

                $('#remarkModal').removeClass('hidden');
            });

            $('#closeIcon, #closeModal, #cancelModal').on('click', function() {
                $('#remarkModal').addClass('hidden');
            });

            $(document).on('click', function(event) {
                if ($(event.target).closest('#remarkModal .relative').length === 0) {
                    $('#remarkModal').addClass('hidden');
                }
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const showRemarkButtons = document.querySelectorAll('.show-remark-btn');
                const modal = document.getElementById('remarkModal');
                const modalRemark = document.getElementById('modalRemark');
                const closeModal = document.getElementById('closeModal');

                showRemarkButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const remark = this.getAttribute('data-remark');
                        modalRemark.textContent = remark;
                        modal.classList.remove('hidden');
                    });
                });

                closeModal.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });

                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                    }
                });

                const blockTenantButtons = document.querySelectorAll('.block-tenant-btn');
                const blockTenantModal = document.getElementById('blockTenantModal');
                const closeModalButton = document.getElementById('blockTenantcloseModal');
                const blockTenantForm = document.getElementById('blockTenantForm');
                const submitBlockTenant = document.getElementById('submitBlockTenant');
                const visitorIdInput = document.getElementById('visitorId');
                const tenantIdInput = document.getElementById('tenantId');
                const blockTenantRemark = document.getElementById('blockTenantRemark');

                blockTenantButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const visitorId = this.getAttribute('data-visitor-id');
                        const tenantId = this.getAttribute('data-tenant-id');

                        visitorIdInput.value = visitorId;
                        tenantIdInput.value = tenantId;

                        blockTenantModal.classList.remove('hidden');
                    });
                });

                closeModalButton.addEventListener('click', function() {
                    blockTenantModal.classList.add('hidden');
                });

                submitBlockTenant.addEventListener('click', function() {
                    const visitorId = visitorIdInput.value;
                    const tenantId = tenantIdInput.value;
                    const remark = blockTenantRemark.value;

                    fetch('{{ route('block-security') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                visitor_id: visitorId,
                                tenant_id: tenantId,
                                block_tenant_remark: remark,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Tenant blocked successfully!');
                                window.location.reload();
                            } else {
                                alert(data.message || 'An error occurred.');
                            }

                            blockTenantModal.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred.');
                        });
                });

            });
        </script>

        <script>
            closeModalButton.addEventListener('click', function() {
                console.log("Close button clicked");
                blockTenantModal.classList.add('hidden');
            });
        </script>
        <!-- JavaScript at the bottom of the Blade template -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById("customModal");
                var closeModal = document.querySelector(".close-modal");

                // Modal title
                var modalTitle = document.getElementById("modalTitle");

                // Fields
                var proveFields = document.getElementById("proveFields");
                var rejectFields = document.getElementById("rejectFields");
                var resedualFields = document.getElementById("resedualFields");

                // Hidden input to store record ID
                var currentRecordId = document.getElementById("currentRecordId");

                // Function to reset fields
                function resetFields() {
                    proveFields.classList.add('d-none');
                    rejectFields.classList.add('d-none');
                    resedualFields.classList.add('d-none');
                    // Reset form inputs
                    $('#proveRemark').val('');
                    $('#rejectRemark').val('');
                    $('#resedualRemark').val('');
                    $('#resedualDate').val('');
                }

                // Function to open the modal
                function openModal(actionType, recordId) {
                    modal.style.display = "block";
                    currentRecordId.value = recordId;
                    resetFields();

                    if (actionType === 'prove') {
                        modalTitle.textContent = "Prove Remark";
                        proveFields.classList.remove('d-none');
                    } else if (actionType === 'reject') {
                        modalTitle.textContent = "Reject Remark";
                        rejectFields.classList.remove('d-none');
                    } else if (actionType === 'resedual') {
                        modalTitle.textContent = "Resedual Remark and Date";
                        resedualFields.classList.remove('d-none');
                    }
                }

                // Add event listeners to all prove, reject, and resedual buttons
                document.querySelectorAll('.btn-prove').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var recordId = button.getAttribute('data-id');
                        openModal('prove', recordId);
                    });
                });

                document.querySelectorAll('.btn-reject').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var recordId = button.getAttribute('data-id');
                        openModal('reject', recordId);
                    });
                });

                document.querySelectorAll('.btn-resedual').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var recordId = button.getAttribute('data-id');
                        openModal('resedual', recordId);
                    });
                });

                // Close the modal when the close button is clicked
                closeModal.addEventListener('click', function() {
                    modal.style.display = "none";
                });

                // Close the modal if the user clicks outside the modal content
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };

                // Handle form submission via AJAX
                document.querySelector('.btn-save').addEventListener('click', function() {
                    var recordId = document.getElementById('currentRecordId').value;
                    var proveRemark = document.getElementById('proveRemark').value;
                    var rejectRemark = document.getElementById('rejectRemark').value;
                    var resedualRemark = document.getElementById('resedualRemark').value;
                    var resedualDate = document.getElementById('resedualDate').value;

                    var actionType = $('#modalTitle').text()
                        .toLowerCase(); // To determine if it's prove/reject/resedual

                    var dataToSend = {
                        id: recordId,
                        actionType: actionType,
                        proveRemark: proveRemark,
                        rejectRemark: rejectRemark,
                        resedualRemark: resedualRemark,
                        resedualDate: resedualDate,
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    };

                    // AJAX request to save the data to the database
                    $.ajax({
                        url: '{{ route('security-save-remark') }}', // Your Laravel route to handle saving
                        type: 'POST',
                        data: dataToSend,
                        success: function(response) {
                            // Handle success (e.g., close modal, show success message, etc.)
                            alert('Data saved successfully!');

                            window.location.reload();


                            modal.style.display = "none";
                            // Optionally, refresh the table or update UI based on response
                        },
                        error: function(xhr, status, error) {
                            // Handle error (e.g., show error message)
                            console.error('Error saving data:', error);
                            alert('An error occurred while saving data. Please try again.');
                        }
                    });
                });
            });
        </script>




    </div>

</x-layout.default>
