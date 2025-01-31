<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meetings</title>
    <script src="https://kit.fontawesome.com/80bb468345.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('CssFiles/basicstyle.css') }}">
    
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light -light">
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
                        <img src="{{ asset('Employees_images/' . (session('employee_image') ?? 'default.jpg')) }}" alt="Avatar Logo" style="width:40px;" class="rounded-pill" onclick="toggleProfileBox()">
                    </a>
                </div>

                <!-- Profile Info Box -->
                <div id="profileBox" class="profile-box">
                    <p><strong>{{ session('employee_name') }}</strong></p>
                    <p>Email :{{ session('employee_email') }}</p>
                    <a href="{{ route('employees.editemployee', session('employee_id')) }}" class="dropdown-item text-primary">Profile Settings</a><br>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    @yield('content')
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
