<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserPermissionsController extends Controller
{
  //

  public function create(Request $request)
  {


    $role = Role::create(['name' => $request->role_name]);

    return $role;
  }

  public function user_roles(Request $request)
  {

    return $request->user()->id;

    return User::with('roles')->find(request()->id);
  }

  public function assign_role(Request $request)
  {

    $user = User::find($request->user()->id);
    $user->assignRole($request->role_name);

    return User::with('roles')->find($request->user()->id);
  }

  public function jobSeekers(Request $request)
  {

    $users = User::with([
      'profile',
      'work_experiences',
      'latest_education',
      'skills',
      'resume',
      'languages'
    ])->whereHas('roles', function ($query) {
      $query->where('name', 'job_seeker');
    })->whereHas('profile', function ($query) {
      // Ensures that only users with a profile are retrieved.
      $query->whereNotNull('id'); // Assuming 'id' is a required field in profile; adjust as needed.
    })->whereHas('latest_education', function ($query) {
      // Ensures that only users with a profile are retrieved.
      $query->whereNotNull('id'); // Assuming 'id' is a required field in profile; adjust as needed.
    })
      ->get();

    return $users;
  }

  public function jobSeeker(Request $request, $id)
  {

    $user = User::find($id)->with([
      'profile',
      'work_experiences',
      'latest_education',
      'skills',
      'resume',
      'languages'
    ])->whereHas('roles', function ($query) {
      $query->where('name', 'job_seeker');
    })->whereHas('profile', function ($query) {
      // Ensures that only users with a profile are retrieved.
      $query->whereNotNull('id'); // Assuming 'id' is a required field in profile; adjust as needed.
    })->whereHas('latest_education', function ($query) {
      // Ensures that only users with a profile are retrieved.
      $query->whereNotNull('id'); // Assuming 'id' is a required field in profile; adjust as needed.
    })
      ->first();

    return $user;
  }
}
