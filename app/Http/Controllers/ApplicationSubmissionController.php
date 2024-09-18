<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;
use App\Models\ApplicationSubmission;

class ApplicationSubmissionController extends Controller
{
  public function submitApplication(Request $request){


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

       $application = ApplicationSubmission::updateOrCreate([
          'job_seeker_id' => $request->user()->id,
          'job_posting_id' => $request->job_posting_id,
          'cover_letter' => $request->cover_letter,
        ],[
          'job_seeker_id' => $request->user()->id,
          'job_posting_id' => $request->job_posting_id,
          'cover_letter' => $request->cover_letter,
          'uploaded_cv_path' => $filename,
        ]);

        return 123;

        }else{


          $resume = Resume::where('user_id', $request->user()->id)->first();

          ApplicationSubmission::updateOrCreate([
            'job_seeker_id' => $request->user()->id,
            'job_posting_id' => $request->job_posting_id,
            'cover_letter' => $request->cover_letter,
          ],[
            'job_seeker_id' => $request->user()->id,
            'job_posting_id' => $request->job_posting_id,
            'cover_letter' => $request->cover_letter,
            'uploaded_cv_path' => $resume->path,
          ]);


        }

        return $application;





        // Save the filename to the database (if needed)
        // ...

        return response()->json(['message' => 'Resume uploaded successfully']);



  }
}
