<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    public function create()
    {
        return view('customer.prescriptions.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prescription' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $path = $request->file('prescription')->store('prescriptions', 'public');

        Prescription::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Prescription uploaded and under review');
    }
}
