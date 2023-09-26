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
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'jwt.auth'], function () {

//////// Auth
//Route::post('/update_profile', [AuthController::class, 'update']);
Route::patch('/users/{user}',[AuthController::class, 'update']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user-profile', [AuthController::class, 'userProfile']);

///// Emergency
Route::get('/emergencys',[EmergencyController::class,'index']);
Route::post('/emergencys',[EmergencyController::class,'store']);
Route::post('/emergencys/{emergency}',[EmergencyController::class,'update']);
Route::get('/emergencys/{emergency}',[EmergencyController::class,'show']);
Route::delete('/emergencys/{emergency}',[EmergencyController::class,'destroy']);
Route::post('/search',[EmergencyController::class,'search']);


///// CallTechnician

Route::get('/calls',[CallTechnicianController::class,'index']);
Route::post('/calls',[CallTechnicianController::class,'store']);
Route::post('/calls/{call}',[CallTechnicianController::class,'update']);
Route::get('/calls/{call}',[CallTechnicianController::class,'show']);
Route::delete('/calls/{call}',[CallTechnicianController::class,'destroy']);


/////// MaintenanceTechnician

Route::get('/maintenance',[MaintenanceTechnicianController::class,'index']);
Route::post('/maintenance',[MaintenanceTechnicianController::class,'store']);


//// Post

Route::get('/posts',[PostController::class,'index']);
Route::post('/posts',[PostController::class,'store']);

//// Hosts

Route::get('/hosts',[HostController::class,'index']);
Route::post('/hosts',[HostController::class,'store']);

///// History

Route::get('/history',[MaintenanceTechnicianController::class,'getHistory']);

});


    //dashboard
Route::group(['prefix' => 'dashboard'],function ($router) {
Route::get('/homes',[HomeController::class, 'index']);
Route::post('/homes',[HomeController::class, 'store']);
Route::post('/homes/{home}',[HomeController::class, 'update']);
Route::get('/homes/{home}',[HomeController::class, 'show']);
Route::delete('/homes/{home}',[HomeController::class, 'destroy']);

Route::get('/maintenances',[MaintenanceTechnicianController::class, 'index']);
Route::post('/maintenances',[MaintenanceTechnicianController::class, 'store']);
Route::post('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'update']);
Route::get('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'show']);
Route::delete('/maintenances/{maintenance}',[MaintenanceTechnicianController::class, 'destroy']);
});

Route::post('/email-verification',[EmailVerifyController::class,'emailVerification']);
Route::post('forget-password',[ForgetPasswordController::class,'forgetPassword']);
Route::post('reset-password',[ResetPasswordController::class,'resetPassword']);


Route::get('/chat/{user_id}', [ChatController::class, 'chat']);
Route::post('/chat/{user_id}', [ChatController::class, 'sendMessage']);
