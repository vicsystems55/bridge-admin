<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\JobPosting;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $user = $request->user(); // Assuming authenticated user

        // return $user->id;

        $jobPostings = JobPosting::where('user_id', $user->id)->get();

        // return $jobPostings;

        $bookmarks = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', JobPosting::class)
            ->pluck('bookmarkable_id');

        $jobPostings = $jobPostings->map(function ($jobPosting) use ($bookmarks) {
            $jobPosting->bookmarked = $bookmarks->contains($jobPosting->id);
            return $jobPosting;
        });

        return $jobPostings;
    }

    public function allJobPostings()
    {
        //
        $user = auth()->user(); // Assuming authenticated user

        $jobPostings = JobPosting::latest()->get();

        $bookmarks = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', JobPosting::class)
            ->pluck('bookmarkable_id');

        $jobPostings = $jobPostings->map(function ($jobPosting) use ($bookmarks) {
            $jobPosting->bookmarked = $bookmarks->contains($jobPosting->id);
            return $jobPosting;
        });

        return $jobPostings;
    }

    public function searchJobs(Request $request){




      $employmentTypeString = $request->input('employment_type');

      $sideBarFiltersString = $request->input('sideBarFilters');


      $employmentTypes = [];

      $sideBarFilters = [];



    if (!empty($employmentTypeString)) {
        $employmentTypes = explode(',', $employmentTypeString);
    }



// Decode the JSON string into an associative array
$data = json_decode($sideBarFiltersString, true);

// Convert the renumerationRange to min and max
$renumerationRange = explode('-', $data['renumerationRange']);
$data['renumerationRange'] = [
    'min' => (int) $renumerationRange[0],
    'max' => (int) $renumerationRange[1]
];

// Wrap the data into a filters key
$output = [
    'filters' => [
        'latestUpdate' => $data['latestUpdate'],
        'employmentType' => $data['employmentType'],
        'renumerationRange' => $data['renumerationRange']
    ]
];

$qualifications = [];

if ($data['isMsc']) {
  array_push($qualifications, 'M.Sc');
}
if ($data['isBsc']) {
  array_push($qualifications, 'BSc.');
}
if ($data['isBEng']) {
  array_push($qualifications, 'BEng');
}
if ($data['isOND']) {
  array_push($qualifications, 'OND');
}

$renumerationRange = $output["filters"]['renumerationRange'];


// return $qualifications;


      $keyWord = $request->keyWord;

      $user = auth()->user(); // Assuming authenticated user

      if (!empty($employmentTypes)) {
        $jobPostings = JobPosting::latest()
            ->where('active', 1) // Filter active job postings
            ->whereIn('employment_type', $employmentTypes) // Filter by employment types
            ->where(function ($query) use ($keyWord) {
                // Apply keyword search across job_title, job_description, and company_name
                $query->where('job_title', 'like', '%' . $keyWord . '%')
                    ->orWhere('job_description', 'like', '%' . $keyWord . '%')
                    ->orWhere('company_name', 'like', '%' . $keyWord . '%');
            })
            ->where('min_qualification', $qualifications)
            ->whereBetween('renumeration_amount', [$renumerationRange['min'], $renumerationRange['max']]) // Filter by renumeration range
            ->get();
    }
    else{

        $jobPostings = JobPosting::latest()
        ->where('job_title', 'like', '%' . $keyWord . '%')
        ->orWhere('job_description', 'like', '%' . $keyWord . '%')
        ->orWhere('company_name', 'like', '%' . $keyWord . '%')
        ->orWhere('employment_type', 'like', '%' . $keyWord . '%')
        ->where('active', 1) // Optional: Filter for active job postings
        ->get();
      }





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

        $request->validate([
          'renumeration_amount' => 'required'
        ]);

        $company_profile = CompanyProfile::where('user_id', $request->user()->id)->first();

        $job_post = JobPosting::updateOrCreate([
          'user_id' => $request->user()->id,
          'job_title' => $request->job_title,
          'job_description' => $request->job_description,
        ],[
          'user_id' => $request->user()->id,
          'job_title' => $request->job_title,
          'company_profile_id' => $company_profile->id,
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



        Notification::create([

          'user_id' => $request->user()->id,
          'subject' => 'New Job Post Published',
          'body' => 'Your job post ' .$job_post->job_title .' has been published successfully',
          'type' => 'job-post',

        ]);

        // $this->sendToUser();

        return $job_post;
    }


    public function sendPushNotification($fcmToken, $title, $body)
    {


      $firebase = (new Factory)->withServiceAccount(storage_path('app/public/bridgepushnotifications-firebase-adminsdk-cyugc-95763c3edb.json'));


      $messaging = $firebase->createMessaging();

      // return $messaging;

      $message = CloudMessage::withTarget('token', $fcmToken)
        ->withNotification(['title' => $title, 'body' => $body]);

        // return $message;



      $messaging->send($message);
    }

    public function sendToUser()
    {

      // return $request->fcmToken;
      $fcmToken = 'eRxa9H64TdScokyTpOEDgR:APA91bGzQmaEZjfzQARrgeEAtKmKFtqdUi057enM2QXk0HjN5fQx8BOms6O1DUfh_PNNCQoKALmTnAgE0XUNOIBcXIR-tRoaV4RlHeJdYYUZgIbon4_hj_U';
      $title = "Hello User!";
      $body = "This is a test push notification.";

      $this->sendPushNotification($fcmToken, $title, $body);

      // return response()->json(['success' => true]);
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
