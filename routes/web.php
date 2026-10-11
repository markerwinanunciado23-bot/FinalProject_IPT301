<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MaintenanceController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('laboratories', LaboratoryController::class);

Route::resource('equipment', EquipmentController::class)
    ->parameters(['equipment' => 'item']);

Route::resource('students', StudentController::class);

Route::resource('reservations', ReservationController::class);

Route::resource('maintenance', MaintenanceController::class)
    ->parameters(['maintenance' => 'record']);
