<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resume;
use App\Models\JobPosting;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ApplicationSubmission;

class ApplicationSubmissionController extends Controller
{
  public function submitApplication(Request $request)
  {


    // return $request->all();

    // Validate the request data
    $request->validate([
      'resume' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png', // Adjust validation rules as needed
    ]);


    $profile = ProfileUpdate::where('user_id', $request->user()->id)->first();

    if(!$profile){

      return [
        'message' => 'Kindly complete kyc'
      ];


    if ($request->file('resume')) {
      # code...
      // Get the uploaded file



      }
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
      $applications = ApplicationSubmission::with(['job_seeker.profile', 'job_seeker.latest_education','job_postings'])
      ->where('job_seeker_id', $request->user()->id)
      ->latest()
      ->get();
        return $applications;

    }
    if($user->hasRole('recruiter')){

      $applications = ApplicationSubmission::with(['job_seeker.profile','job_seeker.latest_education', 'job_postings'])
      ->whereHas('job_postings', function ($query) use ($request) {
          $query->where('user_id', $request->user()->id);
      })
      ->latest()
      ->get();

      return $applications;

    }

  }

  public function applicationDetails(Request $request){

    $application = ApplicationSubmission::with(['job_seeker.profile','job_seeker.latest_education', 'job_postings'])
    ->where('id', $request->jobId)
    ->whereHas('job_postings', function ($query) use ($request) {
        $query->where('user_id', $request->user()->id);
    })
    ->latest()
    ->first();

    return $application;

  }

  public function reviewApplication(Request $request){

    // return $request->all();

    $application = ApplicationSubmission::with('job_seeker')->find($request->id);
    $job_seeker = User::find($application->job_seeker_id);
    $jobPost = JobPosting::find($application->job_posting_id);

    // return $application;
    // return $job_seeker;
    // return $jobPost;

    $datax = [
      'jobTitle' => $jobPost->job_title,
      'jobSeekerName' => $job_seeker->name,
      'companyName' => $jobPost->company,
      'reviewNote' => $request->review_note,
    ];



    if($request->status == 'accept'){
      $application->update([
        'reviewed_by' => $request->user()->id,
        'interview_date' => $request->interview_date,
        'review_note' => $request->review_note,
        'status' => $request->status
      ]);

      Notification::create([
        'user_id' => $application->job_seeker->id,
        'subject' => 'Application Accepted',
        'body' => 'Congratulations! Your application has been accepted. Please log in to your account for more details and next steps.',
        'type' => 'application-status',
    ]);

    Notification::create([
      'user_id' => $request->user()->id,
      'subject' => 'Application Accepted',
      'body'    => 'An application for the position of "' . $jobPost->title . '" has been accepted. The interview is scheduled for ' . $request->interview_date . '.',
      'type'    => 'application-status',
  ]);




    Mail::to($job_seeker->email)
    ->send(new ApplicationStatusMail($datax));


    return $application;

    }
    if($request->status == 'reject'){

      $application->update([
        'reviewed_by' => $request->user()->id,
        'review_noted' => $request->review_noted,
        'status' => $request->status
      ]);

      Notification::create([
        'user_id' => $application->job_seeker->id,
        'subject' => 'Application Rejected',
        'body' => 'We regret to inform you that your application has been rejected. Please log in to your account for more information and explore other opportunities.',
        'type' => 'application-status',
    ]);

    Notification::create([
      'user_id' => $request->user()->id,
      'subject' => 'Application Rejected',
      'body'    => 'An application for the position of "' . $jobPost->title . '" has been rejected.',
      'type'    => 'application-status',
  ]);

    // Mail::to($job_seeker->email)
    // ->send(new ApplicationStatusMail($datax));

    return $application;


    }


  }
}
