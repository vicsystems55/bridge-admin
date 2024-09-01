<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserPermissionsController extends Controller
{
    //

    public function create(Request $request){


      $role = Role::create(['name' =>$request->role_name]);

      return $role;


    }

    public function user_roles(Request $request){

      return $request->user()->id;

      return User::with('roles')->find(request()->id);

    }

    public function assign_role(Request $request){

      $user = User::find($request->user()->id);



      return $user->assignRole($request->role_name);



    }
}
