@extends('employees.app')

@section('content')

<h2>Edit Employee</h2>

<form action="{{ route('employees.updateroom', $room->room_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- EmpName -->
    <div class="mb-3">
        <label for="room_id" class="form-label">Room Id</label>
        <input type="text" class="form-control" id="room_id" name="room_id" value="{{ old('EmpName', $room->room_id) }}"
            required>
    </div>
    <div class="mb-3">
        <label for="room_name" class="form-label">Room Name</label>
        <input type="text" class="form-control" id="room_name" name="room_name"
            value="{{ old('EmpName', $room->room_name) }}" required>
    </div>

    <!-- Mobile Number -->
    <div class="mb-3">
        <label for="capacity" class="form-label">Capacity</label>
        <input type="text" class="form-control" id="capacity" name="capacity"
            value="{{ old('MobileNumber', $room->capacity) }}" required>
    </div>

    <!-- Image -->
    <div class="mb-3 row">
        <div class="col-7"><label for="image" class="form-label">Room Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="col-5">
            @if ($room->room_image)
            <img src="{{ asset('Employees_images/' . $room->room_image) }}" alt="Room Image" class="mt-2" width="100%" height="200px">
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Changes</button>
    <a class="btn btn-primary" href="{{ route('employees.Home') }}">back</a>

</form>

@endsection