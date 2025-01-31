@extends('employees.app')

@section('content')
<div class="register-container">
    <div>
        <div><a class="border rounded-pill p-2" href="{{ route('employees.showallemployees') }}"><i
                    class="fa-solid fa-arrow-left"></i> </a></div>

        <div class="register-form">
            <div class="inner-form">
            <h2 class="text-center mb-2">Create Employee</h2>
                <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data" class="rounded-pill p-3">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="EmpName" class="form-label">Employee Name</label>
                            <div class="position-relative"><i class="fa-solid fa-user position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i><input type="text"
                                    name="EmpName" id="EmpName" class="form-control ps-5 py-2"
                                    value="{{ old('EmpName') }}">
                            </div>
                            @if($errors->has('EmpName'))
                            <span class="text-danger">{{$errors->first('EmpName')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6 com-sm-12 mb-3">
                            <label for="MobileNumber" class="form-label">Mobile Number</label>
                            <div class="position-relative">
                                <i class="fa-solid fa-phone position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="number" class="form-control ps-5 py-2" id="MobileNumber"
                                    name="MobileNumber" value="{{ old('MobileNumber') }}">
                            </div>
                            @if($errors->has('MobileNumber'))
                            <span class="text-danger">{{$errors->first('MobileNumber')}}</span>
                            @endif
                        </div>

                        <div class="col-md-12 col-sm-12 mb-3">
                            <label for="position" class="form-label">Position</label>
                            <div class="position-relative"><i class="fa-solid fa-angle-down position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%);"></i><select
                                    name="position" id="position" class="form-control" value="{{ old('position') }}">
                                    <option value="" disabled selected>Select Position</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="HR">HR</option>
                                    <option value="TEAM LEAD">TEAM LEAD</option>
                                    <option value="EMPLOYEE">EMPLOYEE</option>
                                </select></div>
                            @if($errors->has('position'))
                            <span class="text-danger">{{$errors->first('position')}}</span>
                            @endif
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" class="form-control"
                                value="{{ old('joining_date', date('Y-m-d')) }}">
                            @if($errors->has('joining_date'))
                            <span class="text-dangser">{{$errors->first('joining_date')}}</span>
                            @endif
                        </div>

                        <div class="col-md-6 col-sm-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="position-relative"><i class="fa-solid fa-envelope position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="email" name="email" id="email" class="form-control px-5 py-2"
                                    value="{{ old('email') }}">
                            </div>
                            @if($errors->has('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative"><i class="fa-solid fa-lock position-absolute"
                                    style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                                <input type="password" name="password" id="password" class="form-control px-5 py-2"
                                    value="{{ old('password') }}">
                                <i id="eye-icon" class="fa-solid fa-eye-slash position-absolute"
                                    style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>
                            @if($errors->has('password'))
                            <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                    </div>


                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-outline-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="{{ asset('JavaScriptFiles/javascript.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection





<!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif -->


<!-- @csrf
                        <div class="form-group mt-2">
                            <label>Product Name</label>
                            <input type="text" name="pname" class="form-control" value="{{ old('pname') }}">
                            @if($errors->has('pname'))
                                <span class="text-danger">{{$errors->first('pname')}}</span>
                            @endif
                        </div> -->
<!-- Employee Form -->