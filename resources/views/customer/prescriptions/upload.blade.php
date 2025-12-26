<h2>Upload Prescription</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="file" name="prescription" required><br><br>

    <button type="submit">Upload</button>
</form>
