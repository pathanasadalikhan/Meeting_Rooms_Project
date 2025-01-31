<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Room;
use App\Models\BookingRooms_Table;

    class RoomController extends Controller
{

    public function showAllRooms()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('employees.AllRooms', compact('rooms'));
    }

    public function editroom($id)
    {
        $room = Room::findOrFail($id);

        return view('employees.EditRoom', compact('room'));
    }
    public function updateroom(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'room_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $room = Room::where('room_id', $id)->firstOrFail();

        if ($request->hasFile('room_image') && $request->file('room_image')->isValid()) {
            $validated['room_image'] = time() . '_' . $request->file('room_image')->getClientOriginalName();
            $request->room_image->move(public_path('Rooms_images'), $validated['room_image']);
        } else {
            $validated['room_image'] = $room->room_image; // Keep existing image if no new one is uploaded
        }

        $room->update($validated);

        return redirect()->route('employees.showAllRooms')->with('success', 'Room updated successfully');
    }


    public function destroyroom($id){
        $room = Room::findOrFail($id);

        $bookings = BookingRooms_Table::where('room_id', $id);
        $bookings->delete();
        $room->delete();

        // Redirect with success message
        return redirect()->route('employees.showAllRooms')->with('success', 'Room and related bookings deleted successfully');
    }

    public function addrooms()
    {
        return view('employees.AddNewRoom');
    }
    public function storeroom(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'room_id' => 'required|string|unique:Rooms_Table|max:255',
            'room_name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'room_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ], [
            'room_id.required' => 'Please provide a unique Room ID.',
            'room_id.string' => 'The Room ID must be a string.',
            'room_id.unique' => 'This Room ID is already taken.',
            'room_id.max' => 'The Room ID may not be greater than 255 characters.',
            
            'room_name.required' => 'Please provide the room name.',
            'room_name.string' => 'The room name must be a string.',
            'room_name.max' => 'The room name may not be greater than 255 characters.',

            'capacity.required' => 'Please specify the room capacity.',
            'capacity.integer' => 'The room capacity must be an integer.',
            'capacity.min' => 'The room capacity must be at least 1.',

            'room_image.image' => 'The room image must be an image file.',
            'room_image.mimes' => 'The room image must be a file of type: jpg, png, jpeg, gif.',
            'room_image.max' => 'The room image size may not exceed 2MB.',
        ]);

        // Create a new Room instance
        $room = new Room();
        $room->room_id = $validatedData['room_id'];
        $room->room_name = $validatedData['room_name'];
        $room->capacity = $validatedData['capacity'];

        // Handle room image upload if provided
        if ($request->hasFile('room_image') && $request->file('room_image')->isValid()) {
            $imageName = time() . '_' . $request->file('room_image')->getClientOriginalName();
            $request->room_image->move(public_path('Rooms_images'), $imageName);
            $room->room_image = $imageName;
        } else {
            $room->room_image = 'defaultroom.jpg'; // Use a default image if none is provided
        }

        $room->save();

        // Redirect with a success message
        return redirect()->route('employees.showAllRooms')->with('success', 'Room created successfully!');
    }

    public function bookpage($id){
        return view('employees.book',['room' => Room::findOrFail($id)]);
    }

    public function bookroom(){
        return view('employees.BookingRoom');
    }
    public function cancelmeeting($id) {
        $booking = BookingRooms_Table::findOrFail($id); // Find the booking
        $booking->delete(); // Delete the booking
        return redirect()->route('employees.mybookings')->with('success', 'Meeting canceled successfully.');
    }
    


    public function mybooking() 
{
    $currentDate = \Carbon\Carbon::now();
    $employeeUniqueId = session('employee_id');
    // $roomBookingData = $this->processBookings($bookings);

        
    if (substr($employeeUniqueId, 2, 2) === 'AD') {
        $bookings = BookingRooms_Table::whereDate('booking_date',$currentDate->toDateString())->get();
    } else {
        $bookings = BookingRooms_Table::whereDate('booking_date', $currentDate->toDateString())
            ->where('unique_id', $employeeUniqueId)
            ->get();
    }

    $roomBookingData = $this->processBookings($bookings);
    $bookingDetails = $bookings->map(function ($booking) {
        return [
            'id' => $booking->id,
            'unique_id' => $booking->unique_id,
            'room_id' => $booking->room_id,
            'capacity' => $booking->capacity,
            'booking_date' => $booking->booking_date->format('Y-m-d'),
            'start_time' => $booking->start_time->format('H:i:s'), 
            'end_time' => $booking->end_time->format('H:i:s'),
        ];
    });

    return view('employees.BookedByYou', [
        'roomBookingData' => $roomBookingData,
        'currentDate' => $currentDate,
        'bookingDetails' => $bookingDetails, // Include the full booking details
    ]);
}

public function newBooking(Request $request)
{
    $selectedDate = $request->input('selected_date') 
        ? \Carbon\Carbon::parse($request->input('selected_date'))->toDateString() 
        : \Carbon\Carbon::now()->toDateString();

    $selectedDate = \Carbon\Carbon::parse($selectedDate);  
    $employeeUniqueId = session('employee_id');
    if (substr($employeeUniqueId, 2, 2) === 'AD') {
        $bookings = BookingRooms_Table::whereDate('booking_date', $selectedDate->toDateString())->get();
    } else {
        $bookings = BookingRooms_Table::whereDate('booking_date', $selectedDate->toDateString())
            ->where('unique_id', $employeeUniqueId)
            ->get();
    }

    $roomBookingData = $this->processBookings($bookings);
    $bookingDetails = $bookings->map(function ($booking) {
        return [
            'id' => $booking->id,
            'unique_id' => $booking->unique_id,
            'room_id' => $booking->room_id,
            'capacity' => $booking->capacity,
            'booking_date' => $booking->booking_date->format('Y-m-d'),
            'start_time' => $booking->start_time->format('H:i:s'), 
            'end_time' => $booking->end_time->format('H:i:s'),
        ];
    });

    return view('employees.BookedByYou', [
        'roomBookingData' => $roomBookingData,
        'selectedDate' => $selectedDate->toDateString(),
        'bookingDetails' => $bookingDetails, // Include the full booking details
    ]);
}

// Helper method to process bookings and return the formatted room data
private function processBookings($bookings)
{
    return $bookings->groupBy('room_id')->map(function ($roomBookings, $roomId) {
        \Log::info("Processing Room ID: {$roomId}, Bookings: ", $roomBookings->toArray());

        // Sort bookings by start_time
        $sortedBookings = $roomBookings->sortBy(function ($booking) {
            try {
                return \Carbon\Carbon::parse($booking->start_time);
            } catch (\Exception $e) {
                \Log::error('Error parsing start time: ' . $booking->start_time . ' for booking ID: ' . $booking->id);
                return null;
            }
        });

        $processedBookings = $sortedBookings->map(function ($booking) {
            try {
                // Format start and end times
                $start = \Carbon\Carbon::parse($booking->start_time);
                $end = \Carbon\Carbon::parse($booking->end_time);

                return [
                    'start_hour' => $start->hour,
                    'end_hour' => $end->hour,
                    'start' => $start->format('H:i'),
                    'end' => $end->format('H:i'),
                ];
            } catch (\Exception $e) {
                \Log::error('Error processing booking: ' . $e->getMessage() . ' for booking ID: ' . $booking->id);
                return null;
            }
        })->filter()->toArray(); // Remove invalid bookings

        return [
            'roomId' => $roomId,
            'bookings' => $processedBookings,
        ];
    })->values()->toArray();
}

    public function allbooking() {
        return view('employees.AllBookings',['bookings'=>BookingRooms_Table::get()]);
    }
    public function allrooms(){
        return view('employees.ShowAllRooms',['rooms'=>Room::get()]);
    }
    
    public function destroy($id) {
        $booking = BookingRooms_Table::findOrFail($id); // Find the booking
        $booking->delete(); // Delete the booking
        return redirect()->route('employees.mybookings')->with('success', 'Booking canceled successfully!');
    }
    public function destroyByAdmin($id) {
        $booking = BookingRooms_Table::findOrFail($id); // Find the booking
        $booking->delete(); // Delete the booking
        return view('employees.AllBookings',['bookings'=>BookingRooms_Table::get()])->with('success', 'Booking deleted by admin');;
    }
    public function view($id)
    {
        $booking = BookingRooms_Table::select(
            'BookingRooms_Table.*',
            'Rooms_Table.room_name',
            'Rooms_Table.capacity as room_capacity',
            'Rooms_Table.room_image',
            'employees.EmpName as employee_name',
            'employees.MobileNumber',
            'employees.position',
            'employees.email as employee_email'
        )
        ->join('Rooms_Table', 'Rooms_Table.room_id', '=', 'BookingRooms_Table.room_id') // Join with Rooms_Table
        ->join('employees', 'employees.unique_id', '=', 'BookingRooms_Table.unique_id') // Join with employees table
        ->where('BookingRooms_Table.id', $id) // Filter by booking ID
        ->firstOrFail(); // Fetch the record or throw 404 if not found

        return view('employees.ViewMeetingDetails', ['booking' => $booking]);
    }

    public function booked(Request $request){
            // Check if the employee (unique_id) has a conflicting booking
            $existingBooking = BookingRooms_Table::where('unique_id', $request->empid)
            ->where('booking_date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereTime('start_time', '<', $request->end)
                    ->whereTime('end_time', '>', $request->start);
            })
            ->first();

        // If a conflicting booking exists, return an error message
        if ($existingBooking) {
            return redirect()->back()->with('error', 'You already have a booking that overlaps with the selected time. Please choose a different time slot.');
        }
        $room = new BookingRooms_Table();
        $room->unique_id = $request->empid;
        $room->room_id = $request->roomid;
        $room->capacity = $request->empcount;
        $room->booking_date=$request->date;
        $room->booking_status='booked';
        $room->start_time=$request->start;
        $room->end_time=$request->end;
        $room->save();
        return redirect()->route('employees.Home')->with('success', 'Booked successfully');
    }

    
    public function searchRoom(Request $request)
{
    $validatedData = $request->validate([
        'start' => 'required|date_format:H:i',
        'end' => 'required|date_format:H:i|after:start',
        'date' => 'required|date|after_or_equal:today',
        'employeescount' => 'required|integer|min:1|max:100',
    ]);

    $empid = session('employee_id');
    $roleCode = substr($empid, 2, 2); // Extracting the 2nd and 3rd letters from the employee_id
    $bookdate = $request->date;

    // Initialize query builder
    $roomsQuery = DB::table('Rooms_Table');

    // Determine filters based on role and employee count
    if ($roleCode === 'EM') {
        // Employee role
        if ($request->employeescount > 5) {
            return redirect()->back()->with('error', 'Employee cannot book a meeting for more than 5 members.');
        }

        // Show rooms with capacity of exactly 5
        $roomsQuery->where('capacity', '=', 5);
    } elseif ($roleCode === 'TE') {
        // Team Lead role
        if ($request->employeescount > 10) {
            return redirect()->back()->with('error', 'Team Lead cannot book a meeting for more than 10 members.');
        }

        // Show rooms with capacity of 5 or 10
        if ($request->employeescount <= 5) {
            $roomsQuery->where('capacity', '=', 5);
        } elseif ($request->employeescount <= 10 && $request->employeescount > 5 ) {
            $roomsQuery->where('capacity', '=', 10);
        }
    } elseif (in_array($roleCode, ['HR', 'AD'])) {
        // HR or Admin roles
        if ($request->employeescount <= 5) {
            $roomsQuery->where('capacity', '=', 5);
        } elseif ($request->employeescount <= 10) {
            $roomsQuery->where('capacity','=', 10 );
        } else {
            $roomsQuery->where('capacity', '>', 10);
        }
    } else {
        // If role is not recognized, return an error
        return redirect()->back()->with('error', 'Unauthorized role.');
    }

    // Check for overlapping bookings
    $conflictingBooking = DB::table('BookingRooms_Table')
        ->whereDate('booking_date', '=', $bookdate)
        ->where(function ($query) use ($request) {
            // Check if the start and end time overlap
            $query->whereTime('start_time', '<', $request->end)
                ->whereTime('end_time', '>', $request->start);
        })
        ->exists(); // Check if any overlapping booking exists

    // If there is a conflicting booking, return an error message
    if ($conflictingBooking) {
        return redirect()->back()->with('error', 'You already have a meeting during that time. Please try changing the time.');
    }

    // Exclude already booked rooms
    $roomsQuery->whereNotIn('room_id', function ($query) use ($bookdate, $request) {
        $query->select('room_id')
            ->from('BookingRooms_Table')
            ->whereDate('booking_date', '=', $bookdate)
            ->where(function ($query) use ($request) {
                $query->whereTime('start_time', '<', $request->end)
                    ->whereTime('end_time', '>', $request->start);
            });
    });

    $rooms = $roomsQuery->get();

    Session::put('start', $request->start);
    Session::put('end', $request->end);
    Session::put('bookingdate', $bookdate);
    Session::put('employeescount', $request->employeescount);

    return view('employees.BookingRoom', ['rooms' => $rooms]);
}



}



























