<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;

class SkillController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $skills = Skill::where('user_id', request()->user()->id)->get();

    return $skills;
  }


  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $user_profile = ProfileUpdate::where('user_id', $request->user()->id)->first();

      $skill = Skill::updateOrCreate([
        'user_id' => $request->user()->id,
        'name' => $request->name,
      ], [
        'profile_update_id' => $user_profile->id ?? '',
        'user_id' => $request->user()->id,
        'name' => $request->name,
      ]);



      Notification::create([

        'user_id' => $request->user()->id,
        'subject' => 'Skill Update',
        'body' => 'New Skill added successfully',
        'type' => 'skill-update',

      ]);

      return $skill;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Skill $skill)
  {
    //

    return Skill::find($skill->id)->delete();


  }
}
