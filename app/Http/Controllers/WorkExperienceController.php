<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;
use App\Models\WorkExperience;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $work_experiences = WorkExperience::where('user_id', request()->user()->id)->get();

        return $work_experiences;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // return 123;


        $user = User::find($request->user()->id);
        $profile = ProfileUpdate::where('user_id', $request->user()->id)->first();

        $work_experience = WorkExperience::updateOrCreate([
          'user_id' => $user->id,
          'profile_update_id' => $profile->id,
          'job_title' => $request->job_title,
          'company_name' => $request->company_name,

        ],[
          'user_id' => $user->id,
          'profile_update_id' => $profile->id,
          'job_title' => $request->job_title,
          'company_name' => $request->company_name,
          'location' => $request->location,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
        ]);

        Notification::create([

          'user_id' => $request->user()->id,
          'subject' => 'Work Experience Update',
          'body' => 'Your work experience as ' .$request->job_title.' has been updated successfully',
          'type' => 'work-experience',

        ]);


        return $work_experience;


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkExperience $workExperience)
    {
        //

        $workExperience = WorkExperience::find($workExperience->id)->update([
          'job_title' => $request->job_title,
          'company_name' => $request->company_name,
          'location' => $request->location,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date
        ]);

        return $workExperience;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkExperience $workExperience)
    {
        //
        return WorkExperience::find($workExperience->id)->delete();


    }
}
