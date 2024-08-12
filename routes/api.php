<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\v1\ApiAuthController;
use Illuminate\Support\Facades\Route;

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

Route::group([
  'prefix' => '/v1',
],
function () {

  // Route::get('test-route', [ApiAuthController::class,'register']);

  Route::post('/register', [ApiAuthController::class, 'register']);

  Route::post('/login', [ApiAuthController::class, 'login']);

  Route::post('/verify-otp', [ApiAuthController::class, 'verify_otp']);

  Route::post('/resend-otp', [ApiAuthController::class, 'resend_otp']);

});
