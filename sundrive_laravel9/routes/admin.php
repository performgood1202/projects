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
Route::group(['prefix' => 'admin','middleware' => ['isAdmin']], function() {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::post('/updateProfile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('updateProfile');

    /*Managers*/
    Route::group(['prefix' => 'managers'], function() {
        Route::get('/', [App\Http\Controllers\Admin\ManagerController::class, 'index'])->name('managers');
        Route::get('/add', [App\Http\Controllers\Admin\ManagerController::class, 'addManager'])->name('addManager');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\ManagerController::class, 'editManager'])->name('editManager');

        Route::post('/postAddManager', [App\Http\Controllers\Admin\ManagerController::class, 'postAddManager'])->name('postAddManager');
        Route::post('/updateManager/{id}', [App\Http\Controllers\Admin\ManagerController::class, 'updateManager'])->name('updateManager');

        Route::delete('/deleteManager/{id}', [App\Http\Controllers\Admin\ManagerController::class, 'deleteManager'])->name('deleteManager');
    });

    /*Technicians*/
    Route::group(['prefix' => 'technicians'], function() {
        Route::get('/', [App\Http\Controllers\Admin\TechniciansController::class, 'index'])->name('technicians');
        Route::get('/add', [App\Http\Controllers\Admin\TechniciansController::class, 'addTechnician'])->name('addTechnician');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\TechniciansController::class, 'editTechnician'])->name('editTechnician');
        

        Route::post('/postAddTechnician', [App\Http\Controllers\Admin\TechniciansController::class, 'postAddTechnician'])->name('postAddTechnician');
        Route::post('/updateTechnician/{id}', [App\Http\Controllers\Admin\TechniciansController::class, 'updateTechnician'])->name('updateTechnician');

        Route::delete('/deleteTechnician/{id}', [App\Http\Controllers\Admin\TechniciansController::class, 'deleteTechnician'])->name('deleteTechnician');

        Route::get('/assignManager/{id}', [App\Http\Controllers\Admin\TechniciansController::class, 'assignManager'])->name('assignManager');
        Route::post('/postAssignManager/{user_id}', [App\Http\Controllers\Admin\TechniciansController::class, 'postAssignManager'])->name('postAssignManager');
    });

    /*Technicians*/
    Route::group(['prefix' => 'forms'], function() {
        Route::get('/', [App\Http\Controllers\Admin\FormsController::class, 'index'])->name('forms');
        Route::get('/add', [App\Http\Controllers\Admin\FormsController::class, 'addForm'])->name('addForm');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\FormsController::class, 'editForm'])->name('editForm');
        

        Route::post('/postAddForm', [App\Http\Controllers\Admin\FormsController::class, 'postAddForm'])->name('postAddForm');
        Route::post('/updateForm/{id}', [App\Http\Controllers\Admin\FormsController::class, 'updateForm'])->name('updateForm');

        Route::delete('/deleteForm/{id}', [App\Http\Controllers\Admin\FormsController::class, 'deleteForm'])->name('deleteForm');

        Route::get('/formEditor/{id}', [App\Http\Controllers\Admin\FormsController::class, 'formEditor'])->name('formEditor');

        Route::post('/postFormEditor/{id}', [App\Http\Controllers\Admin\FormsController::class, 'postFormEditor'])->name('postFormEditor');

        Route::get('/formPdfPreview/{id}', [App\Http\Controllers\Admin\FormsController::class, 'formPdfPreview'])->name('formPdfPreview');


        /* Fields */
        Route::group(['prefix' => 'fields'], function() {
            Route::get('/', [App\Http\Controllers\Admin\FormsController::class, 'index'])->name('fields');
            Route::get('/add', [App\Http\Controllers\Admin\FormsController::class, 'addField'])->name('addField');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\FormsController::class, 'editField'])->name('editField');
            

            Route::post('/postAddField/{form_id}', [App\Http\Controllers\Admin\FormsController::class, 'postAddField'])->name('postAddField');
            Route::post('/updateField/{form_id}/{id}', [App\Http\Controllers\Admin\FormsController::class, 'updateField'])->name('updateField');

            Route::delete('/deleteField/{id}', [App\Http\Controllers\Admin\FormsController::class, 'deleteField'])->name('deleteField');


            /* Fields */
        });
    });
    
});    
