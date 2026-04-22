<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PolyclinicController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\QueueController;
use App\Http\Controllers\Api\ExaminationController;

// Rute khusus untuk Restore Data
Route::post('users/{id}/restore', [UserController::class, 'restore']);
Route::post('polyclinics/{id}/restore', [PolyclinicController::class, 'restore']);
Route::post('doctors/{id}/restore', [DoctorController::class, 'restore']);
Route::post('patients/{id}/restore', [PatientController::class, 'restore']);
Route::post('queues/{id}/restore', [QueueController::class, 'restore']);
Route::post('examinations/{id}/restore', [ExaminationController::class, 'restore']);

// Rute CRUD
Route::apiResource('users', UserController::class);
Route::apiResource('polyclinics', PolyclinicController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('queues', QueueController::class);
Route::apiResource('examinations', ExaminationController::class);
