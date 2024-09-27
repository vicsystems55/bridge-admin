<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobPopping;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Assuming authenticated user

        $bookmarks = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', JobPosting::class)
            ->with('bookmarkable') // Load the associated job posting
            ->get();

        return response()->json(['bookmarks' => $bookmarks]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_posting_id' => 'required|exists:job_postings,id',
        ]);

        if($request->bookmarkable_type == 'JobPosting'){

          $bookmark = Bookmark::updateOrCreate([
            'user_id' => $request->user()->id,
            'bookmarkable_id' => $request->job_posting_id,
          ],[
            'user_id' => $request->user()->id,
            'bookmarkable_type' => JobPosting::class,
            'bookmarkable_id' => $request->job_posting_id,

          ]);

          return $bookmark;

        }
        if($request->bookmarkable_type == 'JobSeeker'){

          $bookmark = Bookmark::updateOrCreate([
            'user_id' => $request->user()->id,
            'bookmarkable_id' => $request->job_posting_id,
          ],[
            'user_id' => $request->user()->id,
            'bookmarkable_type' => User::class,
            'bookmarkable_id' => $request->job_posting_id,

          ]);

          return $bookmark;


        }






    }



    /**
     * Display the specified resource.
     */
    public function show(Bookmark $bookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function removeBookmarkedJob(Request $request)
    {
        //

        // return 123;

        $bookmark = Bookmark::where('bookmarkable_id', $request->job_posting_id)
        ->where('user_id', $request->user()->id)
        ->where('bookmarkable_type', JobPosting::class)
        ->first();

        return $bookmark->delete();
    }
}
