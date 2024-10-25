<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;
use App\Models\ApplicationSubmission;
use App\Models\JobPosting;
use App\Models\Notification;

class ApplicationSubmissionController extends Controller
{
  public function submitApplication(Request $request)
  {


    // return $request->all();

    // Validate the request data
    $request->validate([
      'resume' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png', // Adjust validation rules as needed
    ]);

    if ($request->file('resume')) {
      # code...
      // Get the uploaded file
      $file = $request->file('resume');

      // Generate a unique filename
      $filename = time() . '_' . $file->getClientOriginalName();

      // Store the file in the storage folder
      $file->storeAs('uploads', $filename);



      // $profile = ApplicationSubmission::where('user_id', $request->user()->id)->first();

      $application = ApplicationSubmission::create([
        'job_seeker_id' => $request->user()->id,
        'job_posting_id' => $request->job_posting_id,
        'cover_letter' => $request->cover_letter,
        'uploaded_cv_path' => $filename,
      ]);

      $jobPost = JobPosting::find($request->job_posting_id);


      Notification::create([

        'user_id' => $request->user()->id,
        'subject' => 'Application Status',
        'body' => 'Your application has been submitted successfully',
        'type' => 'job-application',

      ]);

      return 123;
    } else {


      $resume = Resume::where('user_id', $request->user()->id)->first();

      ApplicationSubmission::updateOrCreate([
        'job_seeker_id' => $request->user()->id,
        'job_posting_id' => $request->job_posting_id,
        'cover_letter' => $request->cover_letter,
      ], [
        'job_seeker_id' => $request->user()->id,
        'job_posting_id' => $request->job_posting_id,
        'cover_letter' => $request->cover_letter,
        'uploaded_cv_path' => $resume->path,
      ]);
    }

    // return $application;

    $jobPost = JobPosting::find($request->job_posting_id);


    Notification::create([

      'user_id' => $request->user()->id,
      'subject' => 'Application Status',
      'body' => 'Your application for ' .$jobPost->title.' has been submitted successfully',
      'type' => 'job-application',

    ]);




    // Save the filename to the database (if needed)
    // ...

    return response()->json(['message' => 'Resume uploaded successfully']);
  }

  public function getSubmissions(Request $request){
    $user = $request->user();
    if($user->hasRole('job_seeker')){
      $applications = ApplicationSubmission::with(['job_seeker.profile,latest_education', 'job_postings'])
      ->where('job_seeker_id', $request->user()->id)
      ->latest()
      ->get();
        return $applications;

    }
    if($user->hasRole('recruiter')){

      $applications = ApplicationSubmission::with(['job_seeker.profile,latest_education', 'job_postings'])
      ->whereHas('job_postings', function ($query) use ($request) {
          $query->where('user_id', $request->user()->id);
      })
      ->latest()
      ->get();

      return $applications;

    }

  }
}
