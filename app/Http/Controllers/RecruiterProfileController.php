<?php

namespace App\Http\Controllers;

use App\Models\RecruiterProfile;
use Illuminate\Http\Request;

class RecruiterProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $recruiter_profile = RecruiterProfile::where('user_id', request()->user()->id)->first();

        return $recruiter_profile;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $recruiter_profile = RecruiterProfile::updateOrCreate([
          'user_id' => $request->user()->id,
          'recruiter_name' => $request->recruiter_name,
          'position' => $request->position,
        ],[
          'user_id' => $request->user()->id,
          'recruiter_name' => $request->recruiter_name,
          'position' => $request->position,

        ]);

        return $recruiter_profile;

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecruiterProfile $recruiterProfile)
    {
        //
    }
}
