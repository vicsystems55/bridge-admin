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
    public function show($id)
    {
        //

        // return 123;


        $profile = ProfileUpdate::with('user')->where('user_id', $id)->firstOrFail();

        return $profile;
    }

    public function update_avatar(Request $request){

      $request->validate([
        'avatar' => 'required|file|mimes:JPEG,JPG,PNG,jpg,jpeg,png', // Adjust validation rules as needed
    ]);

    // Get the uploaded file
    $file = $request->file('avatar');

    // Generate a unique filename
    $filename = time() . '_' . $file->getClientOriginalName(); //...

    // Store the file in the storage folder
    $file->storeAs('public/avatars', $filename);

   User::find($request->user()->id)->update([
      'avatar' => $filename
    ]);

    return User::find($request->user()->id);


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
