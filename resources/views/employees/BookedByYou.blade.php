<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Employee</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/80bb468345.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('CssFiles/style.css') }}">
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
    <div class="container mb-2 d-flex justify-content-between">
        <div><a class="border rounded-pill p-2" href="{{ route('employees.Home') }}"><i class="fa-solid fa-arrow-left"></i>   </a></div>
        <div><a href="{{ route('employees.booknow') }}" class="btn btn-primary">Book now</a></div>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Booked</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div>
        <div class="calander-row">
            <div>
                <div class="calendar-container">
                    <header>
                        <div id="current-date-time">
                            <div id="current-date"></div>
                            <div id="current-time"></div>
                        </div>
                    </header>

                    <div class="calendar-controls d-flex">
                        <button id="prev-month">&#60;</button>
                        <h2 id="calendar-month"></h2>
                        <button id="next-month">&#62;</button>
                    </div>
                    <div id="calendar" class="calendar"></div>
                </div>
                <!-- <pre>
                {{ print_r($roomBookingData) }}
                </pre> -->
            </div>


            <div class="timesheet-x">
                <div>
                    <div class="flex">
                        <h3 id="selected-date"></h3>
                        <h2>Room Booking Timesheet</h2>
                    </div>


                    <div class="container">
                        <h3>Bookings for: {{ $selectedDate ?? $currentDate }}</h3>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    @for ($hour = 0; $hour < 24; $hour++) <th>
                                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00</th>
                                        @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @if (empty($roomBookingData))
                                <tr>
                                    <td colspan="24" style="text-align: center; color: red; font-weight: bold;">
                                        No meetings today</td>
                                </tr>
                                @else
                                    @foreach ($roomBookingData as $roomData)
                                    <tr>

                                        <td>{{ $roomData['roomId'] }}</td>
                                        @for ($hour = 0; $hour < 24; $hour++) 
                                        @php
                                            $backgroundStyle='background-color: white;' ; 
                                            $displayText='' ;
                                            $hasBooking=false; 
                                            foreach ($roomData['bookings'] as $booking) {
                                                $startHour=(int) $booking['start_hour']; 
                                                $endHour=(int) $booking['end_hour'];
                                                $startMinutes=(int) explode(':', $booking['start'])[1]; 
                                                $endMinutes=(int)explode(':', $booking['end'])[1]; if ($hour>= $startHour && $hour <= $endHour) {
                                                $hasBooking=true; 
                                                    if ($hour> $startHour && $hour < $endHour) {
                                                        $backgroundStyle='background-color: lightgreen;' ;
                                                    } elseif($hour==$startHour) { 
                                                        $startPercent=($startMinutes / 60) * 100;
                                                        $backgroundStyle="background: linear-gradient(to right, white {$startPercent}%, lightgreen {$startPercent}%);"; 
                                                        $displayText="<span style='font-size: 10px; color: black;'>" .date('H:i', strtotime($booking['start'])) . "</span>" ; 
                                                    } elseif($hour==$endHour) { 
                                                        $endPercent=($endMinutes / 60) * 100;
                                                        $backgroundStyle="background: linear-gradient(to right, lightgreen {$endPercent}%, white {$endPercent}%);"; 
                                                        $displayText="<span style='font-size: 10px; color: black;'>" .date('H:i', strtotime($booking['end'])) . "</span>" ; 
                                                    } 
                                                } 
                                            } 
                                        @endphp 
                                            <td style="{{ $backgroundStyle }}; text-align: center; font-weight: bold;">
                                                {!! $hasBooking ? $displayText : '' !!}
                                            </td>
                                        @endfor
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="timestable">
            <h2 class="text-center mb-4">Booking Details</h2>
            
            @if (!empty($bookingDetails) && count($bookingDetails) > 0)
                <table class="table table-bordered table-striped">
                    <thead class="table-head">
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Room ID</th>
                            <th>Capacity</th>
                            <th>Booking Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingDetails as $booking)
                        <tr>
                            <td>{{ $booking['id'] }}</td>
                            <td>{{ $booking['unique_id'] }}</td>
                            <td>{{ $booking['room_id'] }}</td>
                            <td>{{ $booking['capacity'] }}</td>
                            <td>{{ $booking['booking_date'] }}</td>
                            <td>{{ $booking['start_time'] }}</td>
                            <td>{{ $booking['end_time'] }}</td>
                            <td><form action="{{ route('employees.cancelmeeting', $booking['id']) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-muted">No bookings found for the selected date.</p>
            @endif
        </div>
    </div>
    


    <script src="{{ asset('JavaScriptFiles/script.js') }}"></script>

    <script>
    function toggleProfileBox() {
        const profileBox = document.getElementById('profileBox');
        const isVisible = profileBox.style.display === 'block';
        profileBox.style.display = isVisible ? 'none' : 'block';
    }
    </script>
</body>

</html>
