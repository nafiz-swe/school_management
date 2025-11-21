@extends('layouts.app')

@section('content')
<style>
    body {
        background: #eef7ff;
    }
    .form-card {
        border-radius: 10px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.15);
    }
    .form-title {
        background: linear-gradient(45deg, #007bff, #6610f2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
    }
    .section-title {
        color: #0d6efd;
        font-weight: 600;
        margin-top: 20px;
        margin-bottom: 10px;
        text-decoration: underline;
    }
</style>

<div class="container py-4">
    <div class="card p-4 form-card">
        <h2 class="text-center form-title mb-4">Add New Student</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Class Room</label>
                    <select name="class_id" class="form-select" required>
                        <option value="">Select Class Room</option>
                        @foreach($classRooms as $classRoom)
                            <option value="{{ $classRoom->id }}">{{ $classRoom->class_level }} - {{ $classRoom->room_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Student Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="student_phone" class="form-control">
                </div>

                <div class="col-md-8">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <!-- Guardian Info -->
            <h5 class="section-title">Guardian Information</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Guardian Name</label>
                    <input type="text" name="guardian_name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guardian Phone</label>
                    <input type="text" name="guardian_phone" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Guardian Email</label>
                    <input type="email" name="guardian_email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Relationship</label>
                    <input type="text" name="guardian_relationship" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Enrollment Date</label>
                    <input type="date" name="enrollment_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="graduated">Graduated</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Photo</label>
                    <input type="file" name="photo_path" class="form-control">
                </div>
            </div>

            <!-- Additional Info -->
            <h5 class="section-title">Additional Information</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Roll Number</label>
                    <input type="text" name="roll_number" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Admission Number</label>
                    <input type="text" name="admission_number" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Blood Group</label>
                    <input type="text" name="blood_group" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">National ID</label>
                    <input type="text" name="national_id" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Religion</label>
                    <input type="text" name="religion" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mother Tongue</label>
                    <input type="text" name="mother_tongue" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Previous School</label>
                    <input type="text" name="previous_school" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Medical Conditions</label>
                    <input type="text" name="medical_conditions" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Allergies</label>
                    <input type="text" name="allergies" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Emergency Contact Phone</label>
                    <input type="text" name="emergency_contact_phone" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Father Profession</label>
                    <input type="text" name="father_profession" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mother Profession</label>
                    <input type="text" name="mother_profession" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Transportation Mode</label>
                    <input type="text" name="transportation_mode" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dormitory</label>
                    <input type="text" name="dormitory" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Scholarship Details</label>
                    <input type="text" name="scholarship_details" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hobbies</label>
                    <input type="text" name="hobbies" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">Save Student</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
