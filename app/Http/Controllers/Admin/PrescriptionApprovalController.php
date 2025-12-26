<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;

class PrescriptionApprovalController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::latest()->get();

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function approve(Prescription $prescription)
    {
        $prescription->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Prescription approved');
    }

    public function reject(Prescription $prescription)
    {
        $prescription->update([
            'status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Prescription rejected');
    }
}
