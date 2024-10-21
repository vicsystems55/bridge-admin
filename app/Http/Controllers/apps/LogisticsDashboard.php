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

  public function privacyPolicy(){


    
    return view('content.pages.privacy_policy');
  }

  public function user_accounts()
  {

    $users = User::with('roles')->get();

    // return $users[0]['roles'][0]['name'];

    // return $users;



    return view('content.pages.user-list', compact('users'));
  }

  public function user_details(){

    $user ='j';

    return view('content.pages.user_details', compact('user'));

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

  public function freelancers_bids(){
    $all_applications = ApplicationSubmission::latest()->get();

    return view('content.pages.freelancers_bids', compact('all_applications'));
  }

  public function shortlisted(){
    $all_applications = ApplicationSubmission::latest()->get();

    return view('content.pages.shortlisted', compact('all_applications'));
  }

  public function scheduled_interviews(){
    $all_applications = ApplicationSubmission::latest()->get();

    return view('content.pages.scheduled_interviews', compact('all_applications'));
  }

  public function job_seekers_applications(){
    $job_seekers_applications = ApplicationSubmission::latest()->get();
    return view('content.pages.job_seekers_applications', compact('job_seekers_applications'));
  }

  public function transactions(){

    $subscriptions = 'null';
    return view('content.pages.transactions');
  }
  public function subscription_analytics(){

    $subscriptions = 'null';
    return view('content.pages.subscription_analytics');
  }
  public function user_subscriptions(){

    $subscriptions = 'null';
    return view('content.pages.user_subscriptions');
  }
  public function manage_subscriptions(){

    $subscriptions = 'null';
    return view('content.pages.manage_subscriptions');
  }





}
