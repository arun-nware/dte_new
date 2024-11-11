<div class="table-responsive">
    <table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
        <thead>
        <tr>
            <th>Sl No</th>
            <th>Region</th>
            <th class="">Account Name</th>
            <th class="">Account No</th>
            <th class="">IFSC Code</th>
            <th class="">Mobile No</th>
            <th class="">Email ID</th>
            <th class="">Address</th>
            <th class="">Created At</th>
            <th class="">Status</th>
        </tr>
        </thead>
        <tbody>
        @php $i = 1;@endphp
        @foreach($users as $user)
            <tr>
                <td>{{ $i++ }}</td>
                <td>@if(!empty($user->region)){{ $user->region->pluck('name')->implode('') ?? ''}}@endif</td>
                <td>{{ $user->warehouse_name ?? ''}}</td>
                <td>{{ $user->warehouse_account_no ?? ''}}</td>
                <td>{{ $user->warehouse_IFSC ?? ''}}</td>
                <td>@if (Auth::user()->hasRole("Maker"))
                        {{ \Str::mask($user->warehouse_mobile_no, '*', 3, 4) }};
                    @else
                        {{ $user->warehouse_mobile_no }}
                    @endif</td>
                <td>{{ $user->warehouse_email_id ?? ''}}</td>
                <td>{{ $user->warehouse_address ?? ''}}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                <td> @if ($user->status == "approved")
                        <span title="Edit" class="badge badge-md btn-success mx-1">Approved</span>
                    @elseif ($user->status == "rejected")
                        <span title="Edit" class="badge badge-md btn-danger mx-1">Rejected</span>
                    @else
                        <span title="Edit" class="badge badge-md btn-warning mx-1">Pending</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
