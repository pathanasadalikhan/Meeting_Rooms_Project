@extends('employees.app')

@section('content')
<div class="container bg-light p-4 rounded">
    <h1 class="text-center">Meeting Details</h1>

    <div class="row">
        <div class="col-md-8">
            <h3>Room Details</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Room Name:</strong> {{ $booking->room_name }}</li>
                <li class="list-group-item"><strong>Room Capacity:</strong> {{ $booking->room_capacity }}</li>
                <li class="list-group-item">
                    <strong>Room Image:</strong><br>
                    <img src="{{ asset('Employees_images/' . ($booking->room_image ?? 'default.jpg')) }}"
                        alt="Room Image" class="circle" style="max-width: 100%;max-height: 400px;">
                </li>
            </ul>
        </div>

        <div class="col-md-4">
            <h3>Employee Details</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> {{ $booking->employee_name }}</li>
                <li class="list-group-item"><strong>Mobile:</strong> {{ $booking->MobileNumber }}</li>
                <li class="list-group-item"><strong>Position:</strong> {{ $booking->position }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $booking->employee_email }}</li>
            </ul>
            <h3 class="mt-4">Booking Details</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Attendies :</strong> {{ $booking->capacity }}</li>
                <li class="list-group-item"><strong>date of booking :</strong> {{ $booking->booking_date }}</li>
                <li class="list-group-item"><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</li>
                <li class="list-group-item"><strong>End Time:</strong> {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</li>
                <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($booking->booking_status) }}</li>
            </ul>
        </div>
    </div>
    <div class="my-3 text-center">
        <a class="btn btn-primary" href="{{ route('employees.mybookings') }}">Back</a>
    </div>
</div>
@endsection
