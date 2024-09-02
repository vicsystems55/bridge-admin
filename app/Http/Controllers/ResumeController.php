<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{


  public function uploadResume(Request $request)
  {
      // Validate the request data
      $request->validate([
          'resume' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg', // Adjust validation rules as needed
      ]);

      // Get the uploaded file
      $file = $request->file('resume');

      // Generate a unique filename
      $filename = time() . '_' . $file->getClientOriginalName();

      // Store the file in the storage folder
      $file->storeAs('uploads', $filename);

      // Save the filename to the database (if needed)
      // ...

      return response()->json(['message' => 'Resume uploaded successfully']);
  }
}
