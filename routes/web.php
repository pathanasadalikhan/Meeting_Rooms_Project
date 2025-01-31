<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;


    Route::post('login', [AuthController::class, 'login'])->name('login'); 


        Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.templet');
        Route::get('/employees/create', [AuthController::class, 'create'])->name('employees.create');
        Route::post('/employees/store', [AuthController::class, 'store'])->name('employees.store');
        Route::get('home', [EmployeeController::class, 'home'])->name('employees.Home');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('booknow', [RoomController::class, 'bookroom'])->name('employees.booknow');
        Route::post('searchroom', [RoomController::class, 'searchRoom'])->name('employees.searchRoom');

        Route::get('employees/{id}/book', [RoomController::class, 'bookpage'])->name('employees.book');
        Route::post('booked',[RoomController::class,'booked'])->name('employees.booked');
        Route::get('mybookings', [RoomController::class, 'mybooking'])->name('employees.mybookings');
        Route::delete('cancel/{id}', [RoomController::class, 'destroy'])->name('employees.destroy');
        Route::delete('delete-admin/{id}', [RoomController::class, 'destroyByAdmin'])->name('employees.destroyByAdmin');
        Route::get('allbookings', [RoomController::class, 'allbooking'])->name('employees.allbookings');
        Route::get('meeting/{id}/view', [RoomController::class, 'view'])->name('employees.view');
        Route::get('allrooms', [RoomController::class, 'allrooms'])->name('employees.allrooms');
        Route::get('/employees', [EmployeeController::class, 'showAllEmployees'])->name('employees.showallemployees');

        Route::post('new-booking', [RoomController::class, 'newBooking'])->name('employees.newBooking');

        Route::get('/employees/{id}/edit', [EmployeeController::class, 'editemployee'])->name('employees.editemployee');
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroyemployee'])->name('employees.destroyemployee');
        Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');

        Route::get('/rooms', [RoomController::class, 'showAllRooms'])->name('employees.showAllRooms');
        Route::get('/room/{id}/edit', [RoomController::class, 'editroom'])->name('employees.editroom');
        Route::delete('/room/{id}', [RoomController::class, 'destroyroom'])->name('employees.destroyroom');
        Route::put('/room/{id}', [RoomController::class, 'updateroom'])->name('employees.updateroom');
        Route::get('/room/add', [RoomController::class, 'addrooms'])->name('employees.addrooms');
        Route::post('/room/new-room', [RoomController::class, 'storeroom'])->name('employees.storeroom');
        Route::delete('cancel-meeting/{id}', [RoomController::class, 'cancelmeeting'])->name('employees.cancelmeeting');



