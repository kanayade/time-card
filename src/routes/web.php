<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BreakTimeController;
use App\Http\Controllers\CorrectionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminAttendanceController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth')->group(function () {
Route::get('/attendance',[AttendanceController::class, 'index']);
Route::post('/attendance/start',[AttendanceController::class, 'start']);
Route::post('/attendance/break/start',[BreakTimeController::class, 'breakStart']);
Route::post('/attendance/break/end',[BreakTimeController::class, 'breakEnd']);
Route::post('/attendance/done',[AttendanceController::class, 'done']);
Route::get('/attendance/list', [AttendanceController::class, 'list']);
Route::get('/attendance/detail/{id}', [AttendanceController::class, 'detail']);
Route::get('/stamp_correction_request/list', [CorrectionController::class, 'request']);
Route::post('/attendance/correction/{id}', [CorrectionController::class, 'store']);
Route::get('/stamp_correction_request/detail/{id}',[ApprovalController::class, 'detail']);
});

Route::get('/admin/login', [AdminLoginController::class, 'index']);
Route::post('/admin/login', [AdminLoginController::class, 'store']);

Route::middleware('admin')->group(function () {
Route::get('/admin/attendance/list', [AdminAttendanceController::class, 'index']);
Route::get('/admin/staff/list', [AdminAttendanceController::class, 'list']);
Route::get('/admin/attendance/staff/{id}', [AdminAttendanceController::class, 'staff']);
Route::get('/admin/attendance/staff/{id}/export', [AdminAttendanceController::class, 'export']);
Route::get('/admin/attendance/{id}', [AdminAttendanceController::class, 'detail']);
Route::put('/admin/attendance/{id}', [AdminAttendanceController::class, 'update']);
Route::get('/stamp_correction_request/approve/{id}', [ApprovalController::class, 'detail']);
Route::post('/stamp_correction_request/approve/{id}', [ApprovalController::class, 'approve']);
});