<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user(); // Assuming authenticated user

        $jobPostings = JobPosting::where('user_id', $user->id)->all();

        $bookmarks = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', JobPosting::class)
            ->pluck('bookmarkable_id');

        $jobPostings = $jobPostings->map(function ($jobPosting) use ($bookmarks) {
            $jobPosting->bookmarked = $bookmarks->contains($jobPosting->id);
            return $jobPosting;
        });

        return $jobPostings;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $company_profile = CompanyProfile::find($request->company_profile_id);

        $job_post = JobPosting::updateOrCreate([
          'user_id' => $request->user()->id,
          'job_title' => $request->job_title,
          'job_description' => $request->job_description,
        ],[
          'user_id' => $request->user()->id,
          'job_title' => $request->job_title,
          'company_profile_id' => $request->company_profile_id,
          'job_description' => $request->job_description,
          'employment_type' => $request->employment_type,
          'deadline' => $request->deadline,
          'min_qualification' => $request->min_qualification,
          'min_experience' => $request->min_experience,
          'renumeration_type' => $request->renumeration_type,
          'renumeration_amount' => $request->renumeration_amount,
          'company_name' => $request->company_name?? $company_profile->company_name,
          'company_industry' => $company_profile->industry_type??'',
          'website' => $request->website,
          'location' => $request->location?? $company_profile->address,
        ]);

        return $job_post;
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPosting $jobPosting)
    {
        //
        $job_post = JobPosting::find($jobPosting->id);
        return $job_post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPosting $jobPosting)
    {
        //
        $job_post = JobPosting::find($jobPosting->id)->update([
          'user_id' => $request->user()->id,
          'job_title' => $request->job_title,
          'company_profile_id' => $request->company_profile_id,
          'job_description' => $request->job_description,
          'employment_type' => $request->employment_type,
          'deadline' => $request->deadline,
          'min_qualification' => $request->min_qualification,
          'min_experience' => $request->min_experience,
          'renumeration_type' => $request->renumeration_type,
          'renumeration_amount' => $request->renumeration_amount,
          'company_name' => $request->company_name,
          'company_industry' => $request->company_industry,
          'website' => $request->website,
          'location' => $request->location,
        ]);

        return $job_post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPosting $jobPosting)
    {
        //
        $job_post = JobPosting::find($jobPosting->id)->delete();

        return $job_post;
    }
}
