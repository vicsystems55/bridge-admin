<?php

namespace App\Http\Controllers;

use App\Models\BurconnReg;
use Illuminate\Http\Request;

class BurconnRegController extends Controller
{
  //

  public function regMember(Request $request)
  {

    $request->validate([
      'email' => 'required',
      'surname' => 'required',
      'firstname' => 'required',
      'othername' => 'required',
      'gender' => 'required',
      'schoolName' => 'required'

    ]);

    $member = BurconnReg::create([
      'email' => $request->email,
      'surname' => ucfirst(strtolower($request->surname)),
      'firstname' => ucfirst(strtolower($request->firstname)),
      'othernames' => ucfirst(strtolower($request->othername)),
      'gender' => ucfirst(strtolower($request->gender)),
      'schoolName' => ucfirst(strtolower($request->schoolName)),
      'state' => ucfirst(strtolower($request->selectedState)),


    ]);

    return $member;
  }


  public function members()
  {
    return BurconnReg::latest()->get();
  }
}
