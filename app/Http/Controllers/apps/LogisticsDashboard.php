<?php

namespace App\Http\Controllers\apps;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationSubmission;
use App\Models\JobPosting;

class LogisticsDashboard extends Controller
{
  public function index()
  {
    return view('content.apps.app-logistics-dashboard');
  }

  public function user_accounts()
  {

    $users = User::with('roles')->get();

    // return $users[0]['roles'][0]['name'];

    // return $users;



    return view('content.pages.user-list', compact('users'));
  }

  public function all_job_postings()
  {
    $all_job_postings = JobPosting::latest()->get();
    return view('content.pages.all_job_postings', compact('all_job_postings'));
  }


  public function add_new_user()
  {

    $users = User::with('roles')->get();

    // return $users[0]['roles'][0]['name'];

    // return $users;



    return view('content.pages.add_new_user', compact('users'));
  }

  public function activity_log()
  {

    $users = User::with('roles')->get();

    // return $users[0]['roles'][0]['name'];

    // return $users;



    return view('content.pages.activity_log', compact('users'));
  }


  public function pending_approval()
  {
    $pending_approval = JobPosting::latest()->get();
    return view('content.pages.pending_approval', compact('pending_approval'));
  }
  public function active_postings()
  {
    $active_postings = JobPosting::latest()->get();
    return view('content.pages.active_postings', compact('active_postings'));
  }
  public function expired_postings()
  {
    $expired_postings = JobPosting::latest()->get();
    return view('content.pages.expired_postings', compact('expired_postings'));
  }

  public function all_applications(){
    $all_applications = ApplicationSubmission::latest()->get();

    return view('content.pages.all_applications', compact('all_applications'));



  }
}
