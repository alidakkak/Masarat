<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallTechnicianController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\MaintenanceTechnicianController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Emergency;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/loginmaint', [MaintenanceTechnicianController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/email-verification',[EmailVerifyController::class,'emailVerification']);
Route::post('forget-password',[ForgetPasswordController::class,'forgetPassword']);
Route::post('reset-password',[ResetPasswordController::class,'resetPassword']);
//-----------------------------------------------------------------------------------
Route::group(['middleware' => 'check_user:normal'], function () {
//////// Auth
Route::post('/users/{user}',[AuthController::class, 'update']);
/////// MaintenanceTechnician
Route::get('/maintenances',[MaintenanceTechnicianController::class, 'index']);
Route::post('/search',[EmergencyController::class,'search']);

Route::get('/calls',[CallTechnicianController::class,'index']);
Route::post('/calls',[CallTechnicianController::class,'store']);
//// Post
Route::get('/posts',[PostController::class,'index']);
//// Hosts
Route::post('/hosts',[HostController::class,'store']);
///// History
Route::get('/history',[HistoryController::class,'getHistory']);

});
//   ----------------------------------------------------------------
Route::group(['middleware' => 'check_user:admin'], function () {
    /////////dashboard/////Home
    Route::get('/homes',[HomeController::class, 'index']);
    Route::post('/homes',[HomeController::class, 'store']);
    Route::post('/homes/{home}',[HomeController::class, 'update']);
    Route::get('/homes/{home}',[HomeController::class, 'show']);
    Route::delete('/homes/{home}',[HomeController::class, 'destroy']);
    Route::post('/maintenances',[MaintenanceTechnicianController::class, 'store']);
    Route::post('/posts',[PostController::class,'store']);
    Route::post('/emergencys',[EmergencyController::class,'store']);


    //Route::post('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'update']);
    Route::get('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'show']);
    Route::delete('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'destroy']);
    Route::get('/hosts',[HostController::class,'index']);
    Route::post('/emergencys/{emergency}',[EmergencyController::class,'update']);
    Route::get('/emergencys/{emergency}',[EmergencyController::class,'show']);
    Route::delete('/emergencys/{emergency}',[EmergencyController::class,'destroy']);
    Route::post('/calls/{call}',[CallTechnicianController::class,'update']);
    Route::get('/calls/{call}',[CallTechnicianController::class,'show']);
    Route::delete('/calls/{call}',[CallTechnicianController::class,'destroy']);
    //------------------
    Route::get('/recently',[HistoryController::class,'recentlyAdd']);
    Route::post('/filter',[HistoryController::class,'filter']);
});
// ----------------------------------------------------------------
Route::group(['middleware' => 'check_user:admin,normal'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/emergencys',[EmergencyController::class,'index']);

});
