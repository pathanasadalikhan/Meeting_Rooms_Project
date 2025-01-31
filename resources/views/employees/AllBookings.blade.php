@extends('employees.app')
<!-- Use a common layout if you have one -->

@section('content')
<div class="container mb-2 d-flex justify-content-between">
        <div><a class="border rounded-pill p-2" href="{{ route('employees.Home') }}"><i class="fa-solid fa-arrow-left"></i>   </a></div>
        <div><a href="{{ route('employees.booknow') }}" class="btn btn-primary">Book now</a></div>
    </div>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<div class="container bg-light p-4 rounded">
    <h1 class="text-center">All Meetings</h1>
    <div class="container">
        <table class="table table-hover mt-2 border">
            <thead>
                <tr>
                    <th class="col-1">slno</th>
                    <th class="col-2">Meeting Room Id</th>
                    <!-- <th class="col-3">Employee Id</th> -->
                    <th class="col-3">Date of booking</th>
                    <th class="col-2">Start Time</th>
                    <th class="col-2">End Time</th>
                    <th class="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $details)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $details->room_id }}</td>
                    <!-- <td>{{ $details->unique_id}}</td> -->
                    <td> {{\Carbon\Carbon::parse($details->booking_date)->format('Y-m-d') }}</td>

                    <td>{{ \Carbon\Carbon::parse($details->start_time)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($details->end_time)->format('H:i') }}</td>

                    <td>
                        <a href="{{ route('employees.view', $details->id) }}" class="btn btn-primary btn-sm">view</a>
                        @php
                        $employeeId = session('employee_id');
                        $prefix = substr($employeeId, 2, 2);
                        @endphp
                        @if ($prefix === 'AD')
                        <form action="{{ route('employees.destroyByAdmin', $details->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection