@extends('employees.app')

@section('content')
<div class="register-container">
    <div><a class="border rounded-pill p-2" href="{{ route('employees.showallemployees') }}"><i
                class="fa-solid fa-arrow-left"></i> </a></div>

    <div class="register-form">
        <div class="inner-form w-50 px-4 py-2">
            <h2 class="text-center mb-2">Edit Employee</h2>
            <form action="{{ route('employees.update', $employee->unique_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- EmpName -->
                    <div class="mb-3 col-6">
                        <label for="EmpName" class="form-label">Employee Name</label>
                        <div class="position-relative"><i class="fa-solid fa-user position-absolute"
                                style="left: 15px; top: 50%; transform: translateY(-50%);"></i><input type="text"
                                class="form-control px-5 py-2" id="EmpName" name="EmpName"
                                value="{{ old('EmpName', $employee->EmpName) }}" required></div>
                    </div>

                    <!-- Mobile Number -->
                    <div class="mb-3 col-6">
                        <label for="MobileNumber" class="form-label">Mobile Number</label>
                        <div class="position-relative">
                            <i class="fa-solid fa-phone position-absolute"
                                style="left: 15px; top: 50%; transform: translateY(-50%);"></i><input type="text"
                                class="form-control px-5 py-2" id="MobileNumber" name="MobileNumber"
                                value="{{ old('MobileNumber', $employee->MobileNumber) }}" required>
                        </div>
                    </div>

                    <!-- Position -->
                    <div class="mb-3 col-12">
                        <label for="position" class="form-label">Position</label>
                        <div class="position-relative"><i class="fa-solid fa-angle-down position-absolute"
                                style="right: 15px; top: 50%; transform: translateY(-50%);"></i><select
                                class="form-control" id="position" name="position"
                                {{ substr($employee->unique_id, 2, 2) === 'AD' ? '' : 'readonly' }} required>
                                <option value="{{ $employee->position}}">{{$employee->position}}</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="HR">HR</option>
                                <option value="TEAM LEAD">TEAM LEAD</option>
                                <option value="EMPLOYEE">EMPLOYEE</option>
                            </select></div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="position-relative"><i class="fa-solid fa-envelope position-absolute"
                                style="left: 15px; top: 50%; transform: translateY(-50%);"></i><input type="email"
                                class="form-control px-5 py-2" id="email" name="email"
                                value="{{ old('email', $employee->email) }}" required></div>
                    </div>

                    <!-- Joining Date -->
                    <div class="mb-3">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input type="date" class="form-control" id="joining_date" name="joining_date"
                            value="{{ old('joining_date', $employee->joining_date) }}"
                            {{ substr($employee->unique_id, 2, 2) === 'AD' ? '' : 'readonly' }} required>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if ($employee->image)
                        <img src="{{ asset('Employees_images/' . $employee->image) }}" alt="Employee Image" class="mt-2"
                            width="100">
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-outline-primary" href="{{ route('employees.Home') }}">back</a>

            </form>
        </div>
    </div>
</div>

@endsection