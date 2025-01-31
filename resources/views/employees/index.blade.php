<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
</head>
<body>
    <h1>Available Rooms</h1>
    <ul>
        @forelse($rooms as $room)
            <li>{{ $room->room_id }} - {{ $room->room_name }} (Capacity: {{ $room->capacity }})</li>
        @empty
            <p>No rooms available.</p>
        @endforelse
    </ul>
</body>
</html>






<h2 class="text-center mb-4">Booking Details</h2>
            @if (!empty($bookingDetails) && count($bookingDetails) > 0)
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Room ID</th>
                            <th>Capacity</th>
                            <th>Booking Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookingDetails as $booking)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $booking->unique_id }}</td>
                            <td>{{ $booking->room_id }}</td>
                            <td>{{ $booking->capacity }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            
                            <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-muted">No bookings found for the selected date.</p>
            @endif  




<!-- <i class="fa-solid fa-trash-can"></i> -->
 <!-- <td>{{ ($booking->unique_id) }}</td> -->