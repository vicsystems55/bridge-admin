<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;

class ResumeController extends Controller
{

  public function index(){


    $resume = Resume::where('user_id', request()->user()->id)->first();

    return $resume;
  }


  public function store(Request $request)
  {
      // Validate the request data
      $request->validate([
          'resume' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png', // Adjust validation rules as needed
      ]);

      // Get the uploaded file
      $file = $request->file('resume');

      // Generate a unique filename
      $filename = time() . '_' . $file->getClientOriginalName();

      // Store the file in the storage folder
      $file->storeAs('public/uploads', $filename);

      $profile = ProfileUpdate::where('user_id', $request->user()->id)->first();

      Resume::create([
        'user_id' => $request->user()->id,
        'profile_update_id' => $profile->id??'',
        'path' => $filename
      ]);



      // Save the filename to the database (if needed)
      // ...

      return response()->json(['message' => 'Resume uploaded successfully']);
  }
}
