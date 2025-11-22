@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">All Students</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Class ID</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->class_id }}</td>
                <td>{{ $student->student_phone }}</td>
                <td>{{ $student->status }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
