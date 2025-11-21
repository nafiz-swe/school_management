{{-- resources/views/classes/class.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="row mb-4">
        <div class="col-md-6">
            <h2>{{ isset($classRoom) ? 'Edit Class' : 'Add Class' }}</h2>

            <form action="{{ isset($classRoom) ? route('class_rooms.update', $classRoom->id) : route('class_rooms.store') }}" method="POST">
                @csrf
                @if(isset($classRoom))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="class_level" class="form-label">Class Level</label>
                    <input type="text" name="class_level" id="class_level" class="form-control" value="{{ $classRoom->class_level ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="room_number" class="form-label">Room Number</label>
                    <input type="text" name="room_number" id="room_number" class="form-control" value="{{ $classRoom->room_number ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="floor_number" class="form-label">Floor Number</label>
                    <input type="text" name="floor_number" id="floor_number" class="form-control" value="{{ $classRoom->floor_number ?? '' }}">
                </div>

                <div class="mb-3">
                    <label for="group_name" class="form-label">Group Name</label>
                    <input type="text" name="group_name" id="group_name" class="form-control" value="{{ $classRoom->group_name ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label for="section" class="form-label">Section</label>
                    <input type="text" name="section" id="section" class="form-control" value="{{ $classRoom->section ?? '' }}" required>
                </div>

                <button type="submit" class="btn btn-primary">{{ isset($classRoom) ? 'Update Class' : 'Add Class' }}</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2>Class List</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Class Level</th>
                        <th>Room</th>
                        <th>Floor</th>
                        <th>Group</th>
                        <th>Section</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->class_level }}</td>
                            <td>{{ $class->room_number }}</td>
                            <td>{{ $class->floor_number }}</td>
                            <td>{{ $class->group_name }}</td>
                            <td>{{ $class->section }}</td>
                            <td>
                                <a href="{{ route('class_rooms.edit', $class->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="{{ route('class_rooms.destroy', $class->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($classes->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No classes found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
