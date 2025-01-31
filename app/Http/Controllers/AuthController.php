<?php

namespace App\Http\Controllers;

use App\Models\Employee;  // Import the Employee model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('employees.login');
    }

    public function logout(){
        Session::forget(['employee_id', 'employee_name', 'employee_email','employee_role','employee_image']);
        Session::flush();
        return redirect()->route('login.templet');
    }
    public function create()
    {
        return view('employees.create');
    }


    public function ss(Request $request)
    {
        $validatedData = $request->validate([
            'EmpName' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'MobileNumber' => 'required|numeric|digits:10|unique:employees',
            'position' => 'required|string|max:255',
            'email' => 'required|email|regex:/@gmail\.com$/|unique:employees|max:255',
            'password' => 'required|string|min:8|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'joining_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],);

        $user = new Employee([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }




    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'EmpName' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'MobileNumber' => 'required|numeric|digits:10|unique:employees',
            'position' => 'required|string|max:255',
            'email' => 'required|email|regex:/@gmail\.com$/|unique:employees|max:255',
            'password' => 'required|string|min:8|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'joining_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ], [
            'EmpName.required' => 'Please enter the employee name.',
            'EmpName.string' => 'The employee name must be a string.',
            'EmpName.regex' => 'The employee name must only consist of alphabetic characters and spaces.',
            'EmpName.max' => 'The employee name may not be greater than 255 characters.',

            'MobileNumber.required' => 'Please enter the mobile number.',
            'MobileNumber.numeric' => 'The mobile number must be numeric.',
            'MobileNumber.digits' => 'The mobile number must consist of exactly 10 digits.',
            'MobileNumber.unique' => 'This mobile number is already taken.',

            'position.required' => 'Please select a position.',
            
            'email.required' => 'Please enter the email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',
            
            'password.required' => 'Please enter the password.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one letter, one number, and one special character.',
        ]);
        
        $employee = new Employee();
        $employee->EmpName = $validatedData['EmpName'];
        $employee->MobileNumber = $validatedData['MobileNumber'];
        $employee->position = $validatedData['position'];
        $employee->email = $validatedData['email'];
        $employee->password = Hash::make($request->password); 
        $employee->joining_date = $validatedData['joining_date'];
        $employee->image = 'default.jpg';
        $employee->save();

        // Redirect with success message
        return redirect()->route('employees.showallemployees')->with('success', 'Employee created successfully!');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ],[
            'email.required' => 'Please enter the email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already taken.',

            'password.required' => 'Please enter the password.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one letter, one number, and one special character.',
        ]);
        $email = trim($request->email);
        $user = Employee::where('email', $email)->first(); 
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('web')->login($user);
            Session::put('employee_id', $user->unique_id);
            Session::put('employee_name', $user->EmpName);
            Session::put('employee_email', $user->email);
            Session::put('employee_role', $user->position);
            Session::put('employee_image', $user->image);
            return redirect()->route('employees.Home');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials!']);
        }
    }
}