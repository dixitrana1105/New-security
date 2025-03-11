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
                    <th class="font-bold py-2 px-8">Photo</th>
                    <th class="font-bold py-2 px-8">Visitor ID</th>
                    <th class="font-bold py-2 px-8">Date</th>
                    <th class="font-bold py-2 px-8">Full Name</th>
                    <th class="font-bold py-2 px-8">In Time</th>
                    <th class="font-bold py-2 px-8">Visitor Purpose</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($security_data->reverse() as $key => $security)
                    <tr>
                        <td class="py-2 px-6">{{ $key + 1 }}</td>
                        <td>
                            <img src="{{ asset($security->photo) }}" alt="image"
                                style="width: 50px; height: 50px; object-fit: cover;" />
                        </td>
                        <td class="py-2 px-8">{{ $security->visitor_id }}</td>
                        <td class="py-2 px-8">{{ $security->date }}</td>
                        <td class="py-2 px-8">{{ $security->full_name }}</td>
                        <td class="py-2 px-8">{{ $security->in_time }}</td>
                        <td class="py-2 px-8">{{ $security->visiter_purpose }}</td>
                    </tr>
                @endforeach
                </tbody>

    </div>

</x-layout.default>
