<x-layout.default>
    <div
        class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">

        <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto "
            style="border-color: #a8acaf; border-width: medium;">
            <div class="flex justify-center mb-4">
                <h1 class="text-2xl font-bold">Add My Ticket</h1>
            </div>
            <form action="{{ route('building-security.myTicket-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="ticket_id"><strong>Ticket ID</strong></label>
                        <input id="ticket_id" type="text" name="ticket_id" placeholder="Enter Ticket ID"
                            class="form-input" value="{{ $ticketId }}" required readonly />
                    </div>
                    <div>
                        <label for="date_time"><strong>Date & Time</strong></label>
                        <input
                        id="date_time"
                        name="date_time"
                        type="datetime-local"
                        value="<?php echo date('Y-m-d\TH:i'); ?>"
                        class="form-input"
                        required
                        readonly />

                    </div>
                </div>

                <!-- WhatsApp Number and Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="subject"><strong>Subject</strong></label>
                        <input id="subject" name="subject" type="text" placeholder="Enter	Subject"
                            class="form-input" required />
                    </div>
                    <div>
                        <label for="role"><strong>To</strong></label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="building_admin">Building Admin</option>
                            <option value="building_tenant">Tenant</option>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="attachment"><strong>Attachment</strong></label>
                        <input id="attachment" name="attachment" type="file" class="form-input" />
                    </div>
                    <div>
                        <label for="description"><strong>Description</strong></label>
                        <textarea id="description" name="description" placeholder="Enter Description" class="form-input" required></textarea>
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

</x-layout.default>
