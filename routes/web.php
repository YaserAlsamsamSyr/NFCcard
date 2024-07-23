<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EmpProfileController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//
Route::get('/empProfile/openLogin',[EmpProfileController::class, 'openLogin'])->name('empLogin');
Route::post('/empProfile/login',[EmpProfileController::class, 'login'])->name('empProfile');
Route::get('/empProfile',[EmpProfileController::class, 'openProfile'])->name('profile');
Route::get('/empProfile/logout',[EmpProfileController::class, 'logout'])->name('empLogout');
//

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employee', EmployeeController::class);
    Route::post('/employees/searchWithPhone',[SearchController::class, 'searchForEmpWithPhone'])->name('searchPhone');
    // Route::post('/employee/searchWithAddress',[SearchController::class, 'searchForEmpWithAddress'])->name('searchAddress');
    
});

require __DIR__.'/auth.php';
