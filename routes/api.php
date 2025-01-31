<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






// Route::group(['prefix' => 'auth'], function () {
//     Route::post('login', [AuthController::class, 'login'])->name('login'); 

//     Route::group(['middleware' => 'auth:sanctum'], function() {

//         Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.templet');
//         Route::get('/employees/create', [AuthController::class, 'create'])->name('employees.create');
//         Route::post('/employees/store', [AuthController::class, 'store'])->name('employees.store');
//         Route::get('home', [EmployeeController::class, 'home'])->name('employees.Home');
//         Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//         Route::get('booknow', [RoomController::class, 'bookroom'])->name('employees.booknow');
//         Route::post('searchroom', [RoomController::class, 'searchRoom'])->name('employees.searchRoom');

//         Route::get('employees/{id}/book', [RoomController::class, 'bookpage'])->name('employees.book');
//         Route::post('booked',[RoomController::class,'booked'])->name('employees.booked');
//         Route::get('mybookings', [RoomController::class, 'mybooking'])->name('employees.mybookings');
//         Route::delete('cancel/{id}', [RoomController::class, 'destroy'])->name('employees.destroy');
//         Route::delete('delete-admin/{id}', [RoomController::class, 'destroyByAdmin'])->name('employees.destroyByAdmin');
//         Route::get('allbookings', [RoomController::class, 'allbooking'])->name('employees.allbookings');
//         Route::get('meeting/{id}/view', [RoomController::class, 'view'])->name('employees.view');
//         Route::get('allrooms', [RoomController::class, 'allrooms'])->name('employees.allrooms');
//     //   Route::get('logout', [AuthController::class, 'logout']);
//     //   Route::get('user', [AuthController::class, 'user']);
//     });
// });