<x-layout.default>
    <div class="flex justify-center mb-4">
        <h1 class="text-2xl font-bold">New Ticket</h1>
    </div>
    <div class="table-responsive" x-data="form">
        <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="font-bold py-2 px-6">S.No</th>
                    <th class="font-bold py-2 px-8">Ticket Id</th>
                    <th class="font-bold py-2 px-8">Date & Time</th>
                    <th class="font-bold py-2 px-8">Subject</th>
                    <th class="font-bold py-2 px-8">From</th>
                    <th class="font-bold py-2 px-8">Person Name</th>
                    <th class="font-bold py-2 px-8">Description</th>
                    <th class="font-bold py-2 px-8">Reply</th>
                </tr>
            </thead>
            {{-- <tbody>
                <template x-for="(item, index) in tableData" :key="index">
                    <tr class="border-b duration-300">
                        <td x-text="index + 1"></td>
                        <td x-text="item.ticket_id"></td>
                        <td x-text="item.date">
                        <td x-text="item.subject"></td>
                        <td x-text="item.tentorschool"></td>
                        <td x-text="item.name"></td>
                        <td><a href="#" class="btn btn-primary" onclick="openModal_1()" >
                            View
                            </a>
                            @include('school-security.ticket.ticket-modal.view')
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-primary" onclick="openModal()" style="white-space: nowrap;">
                            Reply
                            </a>
                            @include('school-security.ticket.ticket-modal.reply')
                        </td>
                    </tr>
                </template>
            </tbody> --}}
        </table>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                tableData: [
                    {
                        id: 1,
                        date: '4-10-24',
                        tentorschool: 'Greenwood High',
                        name: 'Uhas',
                        subject: 'english',
                        contact_person: 'Jane Doe',
                        contact_number: '+123456789',
                        email: 'janedoe@school.com',
                        tenant_person_count: 10,
                        security_person_count: 10,
                        ticket_id: '0001',
                    },
                    // Add more objects as needed
                ],
            }));
        });
    </script>
</x-layout.default>
