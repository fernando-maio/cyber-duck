<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'companies'], function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies');
        Route::get('/create', [CompanyController::class, 'getCreate'])->name('companies.create');
        Route::post('/create', [CompanyController::class, 'postCreate'])->name('companies.create');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::patch('/edit/{id}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/remove/{id}', [CompanyController::class, 'remove'])->name('companies.remove');
    });
    
    Route::group(['prefix' => 'employees'], function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees');
        Route::get('/create', [EmployeeController::class, 'getCreate'])->name('employees.create');
        Route::post('/create', [EmployeeController::class, 'postCreate'])->name('employees.create');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::patch('/edit/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/remove/{id}', [EmployeeController::class, 'remove'])->name('employees.remove');
    });
});

require __DIR__.'/auth.php';
