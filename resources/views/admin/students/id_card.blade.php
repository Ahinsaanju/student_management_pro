@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Action Bar (Not Printed) -->
    <div class="d-flex justify-content-between align-items-center mb-4 mx-auto no-print" style="max-width: 650px;">
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
        <button onclick="window.print()" class="btn btn-dark btn-sm rounded-pill px-4 shadow-sm">
            <i class="bi bi-printer me-1"></i> Print ID Card
        </button>
    </div>

    <!-- 🇱🇰 Sri Lankan NIC Style Horizontal Student ID Card -->
    <div class="nic-card border-0 shadow-lg mx-auto overflow-hidden position-relative" 
         style="max-width: 650px; min-height: 380px; border-radius: 16px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #f8fafc; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        
        <!-- Top Bar with National/University Colors Accent -->
        <div style="height: 6px; background: linear-gradient(90deg, #d97706 0%, #dc2626 50%, #059669 100%);"></div>

        <!-- Card Header -->
        <div class="p-3 px-4 d-flex align-items-center justify-content-between border-bottom border-secondary border-opacity-25 bg-black bg-opacity-20">
            <div class="d-flex align-items-center gap-2">
                <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 38px; height: 38px;">
                    🎓
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-uppercase tracking-wider text-warning" style="letter-spacing: 1.5px;">StuDora Portal</h5>
                    <small class="text-white-50 text-uppercase fs-9">Student Identity Card  </small>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-warning text-dark font-monospace px-3 py-1 rounded-pill fw-bold">
                    {{ $student->reg_no ?? 'STU-' . str_pad($student->id, 5, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-4">
            <div class="row align-items-center">
                
                <!-- Left: Photo & Status -->
                <div class="col-md-4 text-center border-end border-secondary border-opacity-25 pe-md-4">
                    <div class="position-relative d-inline-block mb-2">
                        <div class="rounded-3 p-1 bg-warning bg-opacity-25 shadow-sm">
                            <div class="bg-secondary text-white rounded-2 d-flex align-items-center justify-content-center fw-bold fs-1 mx-auto" 
                                 style="width: 110px; height: 130px; background: #334155 !important;">
                                {{ strtoupper(substr($student->user->name ?? 'S', 0, 1)) }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 rounded-pill px-3 py-1 fs-8">
                            ● Active Student
                        </span>
                    </div>
                </div>

                <!-- Center: Student Details -->
                <div class="col-md-5 ps-md-4 my-3 my-md-0">
                    <div class="mb-3">
                        <label class="text-white-50 fs-9 text-uppercase d-block mb-0">Full Name </label>
                        <strong class="fs-6 text-white text-uppercase d-block">{{ $student->user->name ?? 'Student Name' }}</strong>
                    </div>

                    <div class="mb-3">
                        <label class="text-white-50 fs-9 text-uppercase d-block mb-0">Course </label>
                        <strong class="text-warning fs-7 d-block">{{ $course->course_name ?? $student->course ?? 'BICT (Hons)' }}</strong>
                        <small class="text-white-50 fs-8 font-monospace">{{ $course->course_code ?? 'ICT-MODULE' }}</small>
                    </div>

                    <div>
                        <label class="text-white-50 fs-9 text-uppercase d-block mb-0">Email Address</label>
                        <span class="text-white-50 fs-8">{{ $student->user->email ?? $student->email ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Right: QR Code & Verification -->
                <div class="col-md-3 text-center border-start border-secondary border-opacity-25 ps-md-3">
                    <div class="bg-white p-2 rounded-3 d-inline-block shadow-sm mb-2">
                        {!! $qrCode !!}
                    </div>
                    <span class="d-block text-white-50 fs-9 text-uppercase">Scan to Verify</span>
                </div>

            </div>
        </div>

        <!-- Footer Accent Line -->
        <div class="px-4 py-2 bg-black bg-opacity-40 d-flex justify-content-between align-items-center border-top border-secondary border-opacity-25">
            <small class="text-white-50 fs-9">Issued by StuDora Academic Authority</small>
            <small class="text-warning fs-9 font-monospace">OFFICIAL DIGITAL ID</small>
        </div>

    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    .no-print, nav, sidebar, footer, header { display: none !important; }
    body { background: #fff !important; }
    .nic-card { 
        box-shadow: none !important; 
        -webkit-print-color-adjust: exact !important; 
        print-color-adjust: exact !important; 
        margin-top: 50px !important;
    }
}
</style>
@endsection