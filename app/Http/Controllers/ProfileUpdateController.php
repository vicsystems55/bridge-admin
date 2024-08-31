<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProfileUpdate;

class ProfileUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return 123;
    }

        /**
     * Display a listing of the resource.
     */
    public function users()
    {
        //

        return User::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $profile = ProfileUpdate::updateOrCreate([
          'user_id' => $request->user()->id,
        ],[
          'address' => $request->address,
          'country' => $request->country,
          'state' => $request->state,
          'bio' => $request->bio,
        ]);

        return $profile;

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //


        $profile = ProfileUpdate::where('user_id', $request->user()->id)->with('user')->first();

        return $profile;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileUpdate $profileUpdate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileUpdate $profileUpdate)
    {
        //
    }
}
