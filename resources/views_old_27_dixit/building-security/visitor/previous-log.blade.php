<div class="table-responsive" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; border-radius: 8px;">
    <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
        <thead>
            <tr>
                <th class="font-bold py-2 px-6">S.No</th>
                <th class="font-bold py-2 px-8">Date</th>
                <th class="font-bold py-2 px-8">Photo</th>
                <th class="font-bold py-2 px-8">Full Name</th>
                <th class="font-bold py-2 px-8">Flat/Office Number</th>
                <th class="font-bold py-2 px-8">In Time</th>
                <th class="font-bold py-2 px-8">Out Time</th>
                <th class="font-bold py-2 px-8">ID Proof</th>
                <th class="font-bold py-2 px-8">Remark by Tenant</th>
            </tr>
        </thead>
        <tbody>
            @if( isset($get_all_records_for_visitor) && !empty($get_all_records_for_visitor))
                @foreach($get_all_records_for_visitor as $index => $visitor)
                    <tr>
                        <td class="py-2 px-6">{{ $index + 1 }}</td>
                        <td class="py-2 px-8">{{ \Carbon\Carbon::parse($visitor->date)->format('d-m-Y') }}</td>
                        <td>
                            <img src="{{ asset($visitor->photo) }}" alt="image"
                                class="w-30 h-30 object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $visitor->full_name }}</td>
                        <td class="py-2 px-8">{{ $visitor->tenant_flat_office_no }}</td>
                        <td class="py-2 px-8">{{ \Carbon\Carbon::parse($visitor->in_time)->format('h:i A') }}</td>
                        <td class="py-2 px-8">{{ \Carbon\Carbon::parse($visitor->out_time)->format('h:i A') }}</td>
                        <td>
                            <img src="{{ asset($visitor->id_proof) }}" alt="image"
                                class="w-30 h-30 object-cover mb-5" />
                        </td>
                        <td class="py-2 px-8">{{ $visitor->out_time_remark }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
