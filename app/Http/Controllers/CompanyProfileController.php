<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $company_profile = CompanyProfile::where('user_id', request()->user()->id)->first();

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

        ],[
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyProfile $companyProfile)
    {
        //

        $company_profile = CompanyProfile::where('user_id', $request->user()->id)->update([
          'user_id' => $request->user()->id,
          'company_name' => $request->company_name,

        ],[
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
