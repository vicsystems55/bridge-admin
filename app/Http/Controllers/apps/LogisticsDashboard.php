<?php

namespace App\Http\Controllers\apps;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogisticsDashboard extends Controller
{
  public function index()
  {
    return view('content.apps.app-logistics-dashboard');
  }

  public function user_accounts(){

    $users = User::with('roles')->get();

    // return $users[0]['roles'][0]['name'];



    return view('content.pages.user-list', compact('users'));

  }
}
