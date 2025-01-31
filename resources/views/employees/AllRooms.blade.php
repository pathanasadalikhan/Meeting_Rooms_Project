@extends('employees.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container mb-2 d-flex justify-content-between">
<div><a class="border rounded-pill p-2" href="{{ route('employees.Home') }}"><i class="fa-solid fa-arrow-left"></i>   </a></div>
<div><a href="{{ route('employees.addrooms') }}" class="btn btn-primary float-right">Add Rooms</a></div>
</div>
<div class="row">
    @foreach ($rooms as $room)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('Employees_images/' . ($room->room_image ?? 'defaultroom.jpg')) }}" class="card-img-top" alt="Room Image" height="200px">
                <div class="card-body">
                    <h6 class="card-title">{{ $room->room_name }}</h6>
                    <p class="card-text">Room Id :{{ $room->room_id ?? 'No description available.' }}</p>
                    <p class="card-text">Capacity :{{ $room->capacity ?? 'No description available.' }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('employees.editroom', $room->room_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('employees.destroyroom', $room->room_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Room?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
