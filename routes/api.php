<?php

use Illuminate\Http\Request;
use App\Models\ProfileUpdate;
use App\Models\LanguageSpoken;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ProfileUpdateController;
use App\Http\Controllers\API\v1\ApiAuthController;
use App\Http\Controllers\LanguageSpokenController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\UserPermissionsController;

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


Route::get('/testp', [ApiAuthController::class, 'test']);
  // Route::get('test-route', [ApiAuthController::class,'register']);

  Route::post('/registerp', [ApiAuthController::class, 'register']);

  Route::post('/loginp', [ApiAuthController::class, 'login']);

  Route::post('/verify-otp', [ApiAuthController::class, 'verify_otp']);

  Route::post('/resend-otp', [ApiAuthController::class, 'resend_otp']);

  Route::apiResource('/profile', ProfileUpdateController::class)->middleware('auth:sanctum');

  Route::apiResource('/work-experience', WorkExperienceController::class)->middleware('auth:sanctum');

  Route::apiResource('/education', EducationController::class)->middleware('auth:sanctum');

  Route::apiResource('/language', LanguageSpokenController::class)->middleware('auth:sanctum');

  Route::apiResource('/skills', SkillController::class)->middleware('auth:sanctum');

  Route::apiResource('/resume', ResumeController::class)->middleware('auth:sanctum');

   Route::get('/users', [ProfileUpdateController::class, 'users']);

  Route::get('/user-roles', [UserPermissionsController::class, 'user_roles'])->middleware('auth:sanctum');

  Route::post('/create-roles', [UserPermissionsController::class, 'create']);

  Route::post('/assign-role', [UserPermissionsController::class, 'assign_role'])->middleware('auth:sanctum');
