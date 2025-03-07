<div class="table-responsive">
    <table class="min-w-full shadow-lg rounded-lg overflow-hidden">
        <thead>
            <tr>
                <th class="font-bold py-2 px-6">S.No</th>
                <th class="font-bold py-2 px-8">Date</th>
                <th class="font-bold py-2 px-8">Student Name</th>
                <th class="font-bold py-2 px-8">Class/Section</th>
                <th class="font-bold py-2 px-8">Photo</th>
                <th class="font-bold py-2 px-8">Full Name</th>
                <th class="font-bold py-2 px-8">In Time </th>
                <th class="font-bold py-2 px-8">Out Time</th>
                <th class="font-bold py-2 px-8">ID Proof</th>
            </tr>
        </thead>
        <tbody>
            @if( isset($get_all_records_for_school_visitor) && !empty($get_all_records_for_school_visitor))
            @foreach($get_all_records_for_school_visitor as $index => $visitor)
            <tr class="border-b duration-300">
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($visitor->date)->format('d-m-Y') }}</td>
                <td>{{ $visitor->student_name }}</td>
                <td>{{ $visitor->class }}/{{ $visitor->section }}</td>
                <td>
                    <img src="{{ asset($visitor->photo) }}" alt="image"
                    class="w-30 h-30 object-cover mb-5" />
                </td>
                <td>{{ $visitor->visitor_name }}</td>
                <td>{{ \Carbon\Carbon::parse($visitor->in_time)->format('h:i A') }}</td>
                <td>
                    @if ($visitor->out_time)
                    {{ \Carbon\Carbon::parse($visitor->out_time)->format('h:i A') }}
                    @else
                    --
                   @endif
                </td>
                <td>
                    <img src="{{ asset($visitor->id_proof) }}" alt="image"
                        class="w-30 h-30 object-cover mb-5" />
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
