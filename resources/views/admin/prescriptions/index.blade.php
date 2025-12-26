<h2>Prescriptions</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if($prescriptions->isEmpty())
    <p>No prescriptions uploaded</p>
@endif

@foreach($prescriptions as $prescription)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>User ID:</strong> {{ $prescription->user_id }}<br>
        <strong>Status:</strong> {{ ucfirst($prescription->status) }}<br>

        <a href="{{ asset('storage/'.$prescription->file_path) }}" target="_blank">
            View Prescription
        </a>
        <br><br>

        @if($prescription->status === 'pending')
            <form method="POST" action="{{ route('admin.prescriptions.approve', $prescription) }}" style="display:inline;">
                @csrf
                <button type="submit">Approve</button>
            </form>

            <form method="POST" action="{{ route('admin.prescriptions.reject', $prescription) }}" style="display:inline;">
                @csrf
                <button type="submit">Reject</button>
            </form>
        @endif
    </div>
@endforeach
