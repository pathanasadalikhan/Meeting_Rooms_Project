@extends('employees.app')
<!-- Use a common layout if you have one -->

@section('content')
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry</strong> {{ session('error') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<h1 class="text-center">Book Your {{ $room->room_name }}</h1>
<div class="container bg-light p-4 rounded mt-3 row">
    <div class="container col-6">
        <form method="POST" action="{{ route('employees.booked', $room->room_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <div class="col-6"><label>Employee Id</label>
                    <input type="text" name='empid' class="form-control" id="exampleInputEmail1"
                        value="{{ session('employee_id') }}" readonly>
                </div>
                <div class="col-6"><label>Employee Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                        value="{{ session('employee_name') }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6"><label>Room Id</label>
                    <input type="text" class="form-control" name="roomid" id="exampleInputEmail1"
                        value="{{ $room->room_id }}" readonly>
                </div>
                <div class="col-6"><label>Room Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1"
                        value="{{ $room->room_name }}" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label>Booking Date</label>
                <input type="date" class="form-control" name="date" id="exampleInputPassword1" value="{{ session('bookingdate') }}" readonly>
            </div>
            <div class="mb-3 row">
                <div class="col-5"><label>Start Time</label>
                    <input type="time" class="form-control" name="start" id="exampleInputEmail1"
                        value="{{ session('start') }}" readonly>
                </div>
                <div class="col-5"><label>End Time</label>
                    <input type="time" class="form-control" name="end" id="exampleInputEmail1"
                        value="{{ session('end') }}" readonly>
                </div>
                <div class="col-2"><label>Count</label>
                    <input type="number" class="form-control" name="empcount" id="exampleInputEmail1"
                        value="{{ session('employeescount') }}" readonly>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Confirm</button>
                <a class="btn btn-primary" href="{{ route('employees.booknow') }}">Back</a>
            </div>
        </form>
    </div>
    <div class="container col-4">
        <div id="demo" class="carousel slide fix-h" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner fix-h">
                <div class="carousel-item active" style="width: 100%; height: 300px;">
                    <img src="{{ asset('Employees_images/' . $room->room_image) }}" alt="Los Angeles"
                        class="d-block fix-img" style="width:100%;height:300px">
                    <div class="carousel-caption">
                        <h4>{{ $room->room_name }}</h4>
                        <p>We had such a great comfort in {{ $room->room_name }}</p>
                    </div>
                </div>
                <div class="carousel-item" style="width: 100%; height: 300px;">
                    <img src="{{ asset('Employees_images/' . ('New_york.jpg' ?? 'default.jpg')) }}" alt="Chicago"
                        class="d-block fix-img" style="width:100%;height:300px">
                    <div class="carousel-caption">
                        <h4>New York</h4>
                        <p>Thank you, New York!</p>
                    </div>
                </div>
                <div class="carousel-item" style="width: 100%; height: 300px;">
                    <img src="{{ asset('Employees_images/' . ('Saudi_Meeting_Room.jpg' ?? 'default.jpg')) }}"
                        alt="New York" class="d-block fix-img" style="width:100%;height:300px">
                    <div class="carousel-caption">
                        <h4>Saudi Arabia</h4>
                        <p>We love the Big Apple!</p>
                    </div>
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</div>
@endsection