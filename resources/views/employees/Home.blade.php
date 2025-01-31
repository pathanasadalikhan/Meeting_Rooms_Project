<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <!-- Bootstrap 5 CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/80bb468345.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('CssFiles/homestyle.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('employees.Home') }}">Infanion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('employees.Home') }}">Home</a>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <!-- Profile Picture with Click to Show Profile Box -->
                    <div class="dropdown">
                        <a href="#" class="nav-link" id="profileDropdown" role="button">
                            <img src="{{ asset('Employees_images/' . (session('employee_image') ?? 'default.jpg')) }}"
                                alt="Avatar Logo" style="width:40px;" class="rounded-pill" onclick="toggleProfileBox()">
                        </a>
                    </div>

                    <!-- Profile Info Box -->
                    <div id="profileBox" class="profile-box">
                        <h5><strong>{{ session('employee_name') }}</strong></h5>
                        <p>Email :{{ session('employee_email') }}</p>
                        <a href="{{ route('employees.editemployee', session('employee_id')) }}"
                            class="dropdown-item text-primary">Profile Settings</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Booked</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- cards for booking employees, show all, about rooms -->
    <div class="card-container mt-4">
        <div class="card-box">
            <div class="card p-2" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('calandertimeicon.png' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img1" alt="...">
                <div class="card-box-body  text-center">
                    <h5 class="card-title">Book Meeting</h5>
                    <p class="card-text">Schedule your meetings on time and date.</p>
                    <a href="{{ route('employees.booknow') }}" class="btn btn-outline-primary">Book now</a>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('bookedcalander.jpg' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img" alt="...">
                <div class="card-box-body  text-center">
                    <h5 class="card-title">Your Meetings</h5>
                    <p class="card-text">View and manage your timesheet easily.</p>
                    <a href="{{ route('employees.mybookings') }}" class="btn btn-outline-primary">show all</a>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card fix-img" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('officemeeting.png' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img" alt="...">
                <div class="card-box-body text-center">
                    <h5 class="card-title">Show All Rooms</h5>
                    <p class="card-text">All rooms in the office will be displayed here.</p>
                    <a href="{{ route('employees.allrooms') }}" class="btn btn-outline-primary">show all</a>
                </div>
            </div>
        </div>
        @php
        $employeeId = session('employee_id');
        $prefix = substr($employeeId, 2, 2);
        @endphp
        @if ($prefix === 'AD')
        <div class="card-box">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('meetingroomlogo.png' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img" alt="...">
                <div class="card-box-body text-center">
                    <h5 class="card-title">Add New Room</h5>
                    <p class="card-text">Create a new room for bookings with necessary details.</p>
                    <a href="{{ route('employees.showAllRooms') }}" class="btn btn-outline-primary">Add Room</a>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('meetingrooms.jpg' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img" alt="...">
                <div class="card-box-body text-center">
                    <h5 class="card-title">All Bookings</h5>
                    <p class="card-text">See and manage all your bookings in one place.</p>
                    <a href="{{ route('employees.allbookings') }}" class="btn btn-outline-primary">show all</a>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card" style="width: 22rem;">
                <img src="{{ asset('Employees_images/' . ('employee_logo.png' ?? 'default.jpg')) }}"
                    class="card-img-top fix-card-img" alt="...">
                <div class="card-box-body text-center">
                    <h5 class="card-title">Our Employees</h5>
                    <p class="card-text">View and manage all employees in the system.</p>
                    <a href="{{ route('employees.showallemployees') }}" class="btn btn-outline-primary">See all</a>
                </div>
            </div>
        </div>
        @endif

    </div>
    <script>
    // Function to toggle the profile box visibility
    function toggleProfileBox() {
        const profileBox = document.getElementById('profileBox');
        const isVisible = profileBox.style.display === 'block';
        profileBox.style.display = isVisible ? 'none' : 'block';
    }
    </script>
</body>

</html>