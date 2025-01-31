@extends('employees.app')
<!-- Use a common layout if you have one -->

@section('content')
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Sorry</strong> {{ session('error') }}.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container bg-light p-4 rounded">
    <h1 class="text-center">Book Your Meeting Room</h1>

    <!-- Input Form -->
    <form method="POST" action="{{ route('employees.searchRoom') }}">
        @csrf
        <div class="row mb-3">
            <!-- Start Time Field -->
            <div class="col-md-3">
                <label for="start" class="form-label">Start Time</label>
                <input type="time" name="start" class="form-control @error('start') is-invalid @enderror"
                    value="{{ old('start') }}">
                @error('start')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- End Time Field -->
            <div class="col-md-3">
                <label for="end" class="form-label">End Time</label>
                <input type="time" name="end" class="form-control @error('end') is-invalid @enderror"
                    value="{{ old('end') }}">
                @error('end')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date Field -->
            <div class="col-md-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                    value="{{ old('date') }}">
                @error('date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Capacity Field -->
            <div class="col-md-3">
                <label for="employeescount" class="form-label">Capacity</label>
                <input type="number" name="employeescount"
                    class="form-control @error('employeescount') is-invalid @enderror"
                    value="{{ old('employeescount') }}">
                @error('employeescount')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary">Search Rooms</button>
        </div>
    </form>

</div>

<!-- Available Rooms -->
@if (isset($rooms) && $rooms->isNotEmpty())
<div class="container mt-4 bg-light p-2 rounded">
    <h2 class="text-center">Available Rooms</h2>
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('Employees_images/' . $room->room_image) }}" class="card-img-top"
                    alt="{{ $room->room_name }}" style="width: 100%; height: 300px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->room_name }}</h5>
                    <p class="card-text">Capacity: {{ $room->capacity }}</p>
                    <p class="card-text">Room Id: {{ $room->room_id }}</p>
                    <a href="{{ route('employees.book', $room->room_id) }}" class="btn btn-outline-primary">Book Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@elseif (isset($rooms))
<div class="container mt-4">
    <h2 class="text-center text-danger">No Rooms Available</h2>
</div>
@endif
@endsection