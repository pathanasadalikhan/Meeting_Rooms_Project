@extends('employees.app')

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ session('success') }}.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container mb-2 d-flex justify-content-between">
    <div><a class="border rounded-pill p-2" href="{{ route('employees.Home') }}"><i class="fa-solid fa-arrow-left"></i>
        </a></div>
    <div><a href="{{ route('employees.create') }}" class="btn btn-primary float-right">Add Employee</a></div>
</div>
<div class="container mt-4">
    <div class="row">
        @foreach ($employees as $employee)
        <div class="col-md-2 mb-3">
            <div class="card-profile">
                <img src="{{ asset('Employees_images/' . ($employee->image ?? 'default.jpg')) }}"
                    class="card-img-top rounded-circle" alt="Employee Image">
                <div class="card-body">
                    <h6 class="card-title">{{ $employee->EmpName }}</h6>
                    <p class="card-text">{{ $employee->email ?? 'No description available.' }}</p>
                    <p class="card-text">{{ $employee->position ?? 'No description available.' }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('employees.editemployee', $employee->unique_id) }}"
                            class="btn btn-warning">Edit</a>
                        <form action="{{ route('employees.destroyemployee', $employee->unique_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
</div>
@endsection