<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\BookingRooms_Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function home()
    {
        return view('employees.Home');
    }
    public function showAllEmployees()
    {
        $employees = Employee::whereRaw("SUBSTRING(unique_id, 3, 2) != 'AD'")->get(); // Exclude admins
        return view('employees.AllEmployees', compact('employees'));
    }

    public function destroyemployee($id){
        $employee = Employee::findOrFail($id);

        $bookings = BookingRooms_Table::where('unique_id', $id);
        $bookings->delete();
        $employee->delete();

        // Redirect with success message
        return redirect()->route('employees.showallemployees')->with('success', 'Employee and related bookings deleted successfully');
    }


    public function editemployee($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.EditEmployee', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input data
        $validated = $request->validate([
            'EmpName' => 'required|string|max:255',
            'MobileNumber' => 'required|numeric',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id . ',unique_id',
            'password' => 'nullable|string|min:8',
            'joining_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        // Find the employee record
        $employee = Employee::where('unique_id', $id)->firstOrFail();
    
        // Update image if provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $validated['image'] = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('Employees_images'), $validated['image']);
            
            Session::put('employee_image', $validated['image']);
        } else {
            $validated['image'] = $employee->image; // Keep existing image if no new one is uploaded
        }
    
        // Hash password only if provided
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }
    
        $employee->update($validated);
        return substr(session('employee_id'), 2, 2) === 'AD'
            ? redirect()->route('employees.showallemployees')->with('success', 'Employee updated successfully')
            : redirect()->route('employees.Home')->with('success', 'Your profile updated successfully');
    }
    

 
}