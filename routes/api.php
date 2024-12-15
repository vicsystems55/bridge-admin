<?php

use Illuminate\Http\Request;

use App\Models\ApplicationSubmission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\BurconnRegController;
use App\Http\Controllers\JobPostingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileUpdateController;
use App\Http\Controllers\API\v1\ApiAuthController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\LanguageSpokenController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\UserPermissionsController;
use App\Http\Controllers\RecruiterProfileController;
use App\Http\Controllers\ApplicationSubmissionController;

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

Route::post('/update-password', [ApiAuthController::class, 'updatePassword'])->middleware('auth:sanctum');


// Route::get('/profile/{id}', [ProfileUpdateController::class, 'showProfile'])->middleware('auth:sanctum');


Route::apiResource('/work-experience', WorkExperienceController::class)->middleware('auth:sanctum');

Route::apiResource('/education', EducationController::class)->middleware('auth:sanctum');

Route::apiResource('/language', LanguageSpokenController::class)->middleware('auth:sanctum');

Route::apiResource('/skills', SkillController::class)->middleware('auth:sanctum');

Route::apiResource('/resume', ResumeController::class)->middleware('auth:sanctum');

// projects

Route::post('/create-project', [ProjectController::class, 'createProject'])->middleware('auth:sanctum');

Route::put('/update-project', [ProjectController::class, 'updateProject'])->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'allProjects'])->middleware('auth:sanctum');

//contracts

Route::post('/create-contract', [ContractController::class, 'createContract'])->middleware('auth:sanctum');

Route::get('/contracts', [ContractController::class, 'allContracts'])->middleware('auth:sanctum');



Route::post('/application-submssion', [ApplicationSubmissionController::class, 'submitApplication'])->middleware('auth:sanctum');

Route::get('/application-submssion', [ApplicationSubmissionController::class, 'getSubmissions'])->middleware('auth:sanctum');

Route::post('/application-details', [ApplicationSubmissionController::class, 'applicationDetails'])->middleware('auth:sanctum');

Route::post('/application-review', [ApplicationSubmissionController::class, 'reviewApplication'])->middleware('auth:sanctum');


Route::apiResource('/company-profile', CompanyProfileController::class)->middleware('auth:sanctum');

Route::apiResource('/recruiter-profile', RecruiterProfileController::class)->middleware('auth:sanctum');

Route::apiResource('/job-postings', JobPostingController::class)->middleware('auth:sanctum');

Route::get('/search-job-postings', [JobPostingController::class, 'searchJobs'])->middleware('auth:sanctum');

Route::get('/all-job-postings', [JobPostingController::class, 'allJobPostings'])->middleware('auth:sanctum');




Route::get('/users', [ProfileUpdateController::class, 'users']);

Route::get('/user-roles', [UserPermissionsController::class, 'user_roles'])->middleware('auth:sanctum');

Route::get('/job-seeker', [UserPermissionsController::class, 'jobSeekers'])->middleware('auth:sanctum');

Route::get('/job-seeker/{id}', [UserPermissionsController::class, 'jobSeeker'])->middleware('auth:sanctum');

Route::post('/create-roles', [UserPermissionsController::class, 'create']);

Route::post('/assign-role', [UserPermissionsController::class, 'assign_role'])->middleware('auth:sanctum');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth:sanctum');

Route::post('/update-avatar', [ProfileUpdateController::class, 'update_avatar'])->middleware('auth:sanctum');

Route::post('/update-company-logo', [CompanyProfileController::class, 'update_company_logo'])->middleware('auth:sanctum');

Route::apiResource('bookmarks', BookmarkController::class)->middleware('auth:sanctum');

Route::post('/remove-bookmarked-job', [BookmarkController::class, 'removeBookmarkedJob'])->middleware('auth:sanctum');


Route::post('/bursconn/register-member', [BurconnRegController::class, 'regMember']);

Route::get('/bursconn/members', [BurconnRegController::class, 'members']);



// test push notifications
Route::get('/push-notification', [FirebaseController::class, 'sendToUser']);
