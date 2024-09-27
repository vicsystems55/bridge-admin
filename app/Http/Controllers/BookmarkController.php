<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        // Fetch bookmarks for JobPost
        $user = auth()->user();
        // return $user;
        $bookmarks = Bookmark::where('user_id', $user->id)
            ->where('bookmarkable_type', JobPosting::class) // Ensure JobPost::class is used
            ->with('bookmarkable')
            ->get();

        return response()->json($bookmarks);
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
        //
        $bookmark = Bookmark::create([
          'user_id' =>$request->user()->id,
          'bookmarkable_type' =>'App\\Models\\JobPost',
          'bookmarkable_id' =>$request->bookmarkable_id,
          'category' =>$request->category,
        ]);

        return $bookmark;
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
    public function destroy(Bookmark $bookmark)
    {
        //
    }
}
