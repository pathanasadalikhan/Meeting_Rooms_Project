@extends('employees.app')
<!-- Use a common layout if you have one -->

@section('content')
<div class="container mt-4">
<div class="text-left fs-4"><a class="border rounded-pill p-1" href="{{ route('employees.Home') }}"><i class="fa-solid fa-arrow-left"></i></a></div>
    <h2 class="text-center">All Meeting Rooms</h2>
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
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>
@endsection