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
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string', // Or 'required|numeric' if you want to enforce numbers
            'address' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'twitter' => 'nullable|url',
            'other' => 'nullable|url',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // Example file validation
            'user_id' => 'nullable|exists:users,id', // Foreign key validation
            'score' => 'integer|min:0', // Validate score, ensure it's not negative

            // Example of unique email validation (if needed):
            // 'email' => ['required', 'email', Rule::unique('membership_submissions', 'email')], // Check for uniqueness
        ]);

        // Handle file upload (if a file is submitted)
        $filePath = null; // Initialize
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('uploads'); // Store and get the path
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
        try {
            $submissions = YGSubmission::latest()->all(); // Get all submissions

            // Optionally, transform the data if needed (e.g., for API resources)
            // $submissions = SubmissionResource::collection($submissions); // If using API resources

            return response()->json($submissions, 200); // Return as JSON

        } catch (\Exception $e) {
            // Log the error for debugging
            // Log::error($e);

            return response()->json(['message' => 'Error fetching submissions'], 500); // Return error response
        }
    }
}
