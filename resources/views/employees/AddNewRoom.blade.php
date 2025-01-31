@extends('employees.app')
<!-- Use a common layout if you have one -->

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>success</strong> {{ session('success') }}.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container mt-5">
<div class="text-left"><a class="border rounded-pill p-2" href="{{ route('employees.showAllRooms') }}"><i class="fa-solid fa-arrow-left"></i>   </a></div>
    <h2 class="text-center">Add New Room</h2>
    <form method="POST" action="{{ route('employees.storeroom') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="room_id" class="form-label">Room Id</label>
            <input type="text" name="room_id" id="room_id" class="form-control" value="{{ old('room_id') }}">
            @if($errors->has('room_id'))
            <span class="text-danger">{{$errors->first('EmpName')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="room_name" class="form-label">Room Name</label>
            <input type="text" name="room_name" id="room_name" class="form-control"
                value="{{ old('room_name') }}">
            @if($errors->has('room_name'))
            <span class="text-danger">{{$errors->first('room_name')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="capacity" class="form-label">capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity') }}">
            @if($errors->has('capacity'))
            <span class="text-danger">{{$errors->first('capacity')}}</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="room_image" class="form-label">Room Image</label>
            <input type="file" name="room_image" id="room_image" class="form-control" value="{{ old('room_image') }}">
            @if($errors->has('room_image'))
            <span class="text-danger">{{$errors->first('room_image')}}</span>
            @endif
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection