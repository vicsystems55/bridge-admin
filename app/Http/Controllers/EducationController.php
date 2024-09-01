<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\ProfileUpdate;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $education_qualifications = Education::where('user_id', request()->user()->id)->get();

        return $education_qualifications;


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $user_profile = ProfileUpdate::where('user_id', $request->user()->id)->first();

        $education = Education::updateOrCreate([
          'user_id' => $request->user()->id,
          'profile_update_id' => $request->user_profile_id,
          'award' => $request->award,
          'institution_name' => $request->institution_name,
        ],[
          'user_id' => $request->user()->id,
          'profile_update_id' => $request->user_profile_id,
          'award' => $request->award,
          'institution_name' => $request->institution_name,
          'location' => $request->location,
          'graduation_date' => $request->graduation_date,
          'field_of_study' => $request->field_of_study,
        ]);

        return $education;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        //

        $educational_qualification = Education::find($education->id)->update(
          [
            'user_id' => $request->user()->id,
            'profile_update_id' => $request->user_profile_id,
            'award' => $request->award,
            'institution_name' => $request->institution_name,
            'location' => $request->location,
            'graduation_date' => $request->graduation_date,
            'field_of_study' => $request->field_of_study,
          ]
        );

        return $educational_qualification;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        //

        $education =  Education::find($education->id);

        return $education->delete();
    }
}
