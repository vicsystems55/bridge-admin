<?php

namespace App\Http\Controllers;

use Log;
use App\Models\YGSubmission;
use Illuminate\Http\Request;

class YGSubmissionController extends Controller
{
    //

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255|unique:y_g_submissions,full_name',
            'email' => 'required|email|max:255|unique:y_g_submissions,email',
            'phone' => 'required|string', // Or 'required|numeric' if you want to enforce numbers
            'address' => 'required|string',
            'facebook' => 'nullable|url|max:255|unique:y_g_submissions,facebook',
            'instagram' => 'nullable|url|max:255|unique:y_g_submissions,instagram',
            'tiktok' => 'nullable|url|max:255|unique:y_g_submissions,tiktok',
            'twitter' => 'nullable|url|max:255|unique:y_g_submissions,twitter',
            'other' => 'nullable|url',
            'file' => 'nullable|file|mimes:mp4,mov,avi,wmv,mkv|max:50480', // Accepts common video formats
            'user_id' => 'nullable|exists:users,id', // Foreign key validation
            'score' => 'integer|min:0', // Validate score, ensure it's not negative

            // Example of unique email validation (if needed):
            // 'email' => ['required', 'email', Rule::unique('membership_submissions', 'email')], // Check for uniqueness
        ]);

        // Handle file upload (if a file is submitted)
        $filePath = null; // Initialize
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads', 'public'); // Store and get the path
        }

        // Create and save the MembershipSubmission
        $submission = new YGSubmission();
        $submission->full_name = $validatedData['full_name'];
        $submission->email = $validatedData['email'];
        $submission->phone = $validatedData['phone'];
        $submission->address = $validatedData['address'];
        $submission->facebook = $validatedData['facebook'];
        $submission->instagram = $validatedData['instagram'];
        $submission->tiktok = $validatedData['tiktok'];
        $submission->twitter = $validatedData['twitter'];
        $submission->other = $validatedData['other'];
        $submission->file_path = $filePath; // Store the path, can be null
        $submission->user_id = $validatedData['user_id'] ?? auth()->id(); // Use provided, fallback to auth
        $submission->score = $validatedData['score'] ?? 0; // Use validated, fallback to 0
        $submission->save();

        return response()->json(['message' => 'Success', 'submission_id' => $submission->id], 201); // 201 Created status code
    }


    public function fetch(Request $request)
    {

            $submissions = YGSubmission::latest()->get(); // Get all submissions

            // Optionally, transform the data if needed (e.g., for API resources)
            // $submissions = SubmissionResource::collection($submissions); // If using API resources

            return $submissions; // Return as JSON


    }

    public function details(Request $request){
      $applicant = YGSubmission::find($request->id);

      return $applicant;
    }
}
