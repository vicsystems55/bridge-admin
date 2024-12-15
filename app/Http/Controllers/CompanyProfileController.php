<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
    $company_profile = CompanyProfile::where('user_id', request()->user()->id)->latest()->first();

    return $company_profile;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    $company_profile = CompanyProfile::updateOrCreate([
      'user_id' => $request->user()->id,
      'company_name' => $request->company_name,

    ], [
      'user_id' => $request->user()->id,
      'company_name' => $request->company_name,
      'industry_type' => $request->industry_type,
      'about' => $request->about,
      'address' => $request->address,
      'company_size' => $request->company_size,
      'website' => $request->website,
      'facebook_url' => $request->facebook_url,
      'twitter_url' => $request->twitter_url,
      'instagram_url' => $request->instagram_url,
      'linkedIn_url' => $request->linkedIn_url,
      'otherlinks_1' => $request->otherlinks_1,
      'otherlinks_2' => $request->otherlinks_2,
      'otherlinks_3' => $request->otherlinks_3,
      'otherlinks_4' => $request->otherlinks_4,
    ]);


    return $company_profile;
  }

  /**
   * Display the specified resource.
   */
  public function show(CompanyProfile $companyProfile)
  {
    //
  }

  public function update_company_logo(Request $request)
  {

    $request->validate([
      'company_logo' => 'required|file|mimes:JPEG,JPG,PNG,jpg,jpeg,png', // Adjust validation rules as needed
    ]);

    // Get the uploaded file
    $file = $request->file('company_logo');

    // Generate a unique filename
    $filename = time() . '_' . $file->getClientOriginalName(); //...

    // Store the file in the storage folder
    $file->storeAs('public/company_logos', $filename);

    CompanyProfile::where('user_id',$request->user()->id)->update([
    'company_logo' => $filename,
    ]);

    // User::find($request->user()->id)->update([
    //   'avatar' => $filename
    // ]);

    return CompanyProfile::where('user_id' ,$request->user()->id)->first();
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, CompanyProfile $companyProfile)
  {
    //

    return $request->all();

    $company_profile = CompanyProfile::where('user_id', $request->user()->id)->update([
      'user_id' => $request->user()->id,
      'company_name' => $request->company_name,

    ], [
      'user_id' => $request->user()->id,
      'company_name' => $request->company_name,
      'industry_type' => $request->industry_type,
      'about' => $request->about,
      'address' => $request->address,
      'company_size' => $request->company_size,
      'website' => $request->website,
      'facebook_url' => $request->facebook_url,
      'twitter_url' => $request->twitter_url,
      'instagram_url' => $request->instagram_url,
      'linkedIn_url' => $request->linkedIn_url,
      'otherlinks_1' => $request->otherlinks_1,
      'otherlinks_2' => $request->otherlinks_2,
      'otherlinks_3' => $request->otherlinks_3,
      'otherlinks_4' => $request->otherlinks_4,
    ]);

    return $company_profile;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(CompanyProfile $companyProfile)
  {
    //
  }
}
