<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'manager','middleware' => ['isManager']], function() {

    Route::get('/dashboard', [App\Http\Controllers\Manager\ManagerController::class, 'index']);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile']);
    Route::post('/updateProfile', [App\Http\Controllers\ProfileController::class, 'updateProfile']);

    
});    
