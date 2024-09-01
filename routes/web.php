<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/create', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/show/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/edit/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/delete/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
