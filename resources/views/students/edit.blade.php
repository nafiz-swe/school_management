@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Student</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Class Room ID</label>
                <input type="number" name="class_id" class="form-control" value="{{ $student->class_id }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Student Name</label>
                <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Phone</label>
                <input type="text" name="student_phone" class="form-control" value="{{ $student->student_phone }}">
            </div>

            <div class="col-md-8">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $student->address }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option value="">Select</option>
                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Guardian Info -->
            <h5 class="mt-4">Guardian Information</h5>

            <div class="col-md-4">
                <label class="form-label">Guardian Name</label>
                <input type="text" name="guardian_name" class="form-control" value="{{ $student->guardian_name }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Guardian Phone</label>
                <input type="text" name="guardian_phone" class="form-control" value="{{ $student->guardian_phone }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Guardian Email</label>
                <input type="email" name="guardian_email" class="form-control" value="{{ $student->guardian_email }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Relationship</label>
                <input type="text" name="guardian_relationship" class="form-control" value="{{ $student->guardian_relationship }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Enrollment Date</label>
                <input type="date" name="enrollment_date" class="form-control" value="{{ $student->enrollment_date }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="graduated" {{ $student->status == 'graduated' ? 'selected' : '' }}>Graduated</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Photo</label>
                <input type="file" name="photo_path" class="form-control">
                @if($student->photo_path)
                    <img src="{{ asset('storage/'.$student->photo_path) }}" width="80" class="mt-1">
                @endif
            </div>

        </div>

        <div class="text-center mt-4">
            <button class="btn btn-success btn-lg px-5">Update Student</button>
        </div>
    </form>
</div>
@endsection
