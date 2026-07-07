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

// 一般ユーザーの登録
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
// 一般ユーザーのログイン
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);
// 一般ユーザーの勤怠画面表示
Route::get('/attendance',[AttendanceController::class, 'index']);
// 一般ユーザーの勤怠開始
Route::post('/attendance/start',[AttendanceController::class, 'start']);
// 一般ユーザーの休憩開始
Route::post('/attendance/break/start',[BreakTimeController::class, 'breakStart']);
// 一般ユーザーの休憩終了
Route::post('/attendance/break/end',[BreakTimeController::class, 'breakEnd']);
// 一般ユーザーの勤怠終了
Route::post('/attendance/done',[AttendanceController::class, 'done']);
// 一般ユーザーの勤怠一覧
Route::get('/attendance/list', [AttendanceController::class, 'list']);
// 一般ユーザーの勤怠詳細
Route::get('/attendance/detail/{id}', [AttendanceController::class, 'detail']);
// 一般ユーザーの勤怠修正申請一覧
Route::get('/stamp_correction_request/list', [CorrectionController::class, 'request']);
// 一般ユーザーの勤怠修正申請
Route::post('/attendance/correction/{id}', [CorrectionController::class, 'store']);
Route::get(
    '/stamp_correction_request/detail/{id}',
    [ApprovalController::class, 'detail']
);

// 管理者のログイン画面表示
Route::get('/admin/login', [AdminLoginController::class, 'index']);
// 管理者のログイン
Route::post('/admin/login', [AdminLoginController::class, 'store']);
// 管理者の勤怠一覧
Route::get('/admin/attendance/list', [AdminAttendanceController::class, 'index']);
// 管理者のスタッフ一覧
Route::get('/admin/staff/list', [AdminAttendanceController::class, 'list']);
// 管理者のスタッフ別勤怠一覧
Route::get('/admin/attendance/staff/{id}', [AdminAttendanceController::class, 'staff']);
// 管理者の勤怠詳細
Route::get('/admin/attendance/{id}', [AdminAttendanceController::class, 'detail']);
// 管理者の勤怠修正
Route::put('/admin/attendance/{id}', [AdminAttendanceController::class, 'update']);
// 管理者の勤怠修正申請詳細
Route::get('/stamp_correction_request/approve/{id}', [ApprovalController::class, 'detail']);
// 管理者の勤怠修正申請承認
Route::post('/stamp_correction_request/approve/{id}', [ApprovalController::class, 'approve']);