<?php

namespace App\Http\Controllers;

use App\Models\LanguageSpoken;
use Illuminate\Http\Request;

class LanguageSpokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $languages = LanguageSpoken::where('user_id', request()->user()->id)->get();

        return $languages;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $language = LanguageSpoken::updateOrCreate([
          'user_id' => $request->user()->id,
          'name' => $request->name,
        ],[
          'user_id' => $request->user()->id,
          'name' => $request->name,
          'proficiency' => $request->proficiency,
        ]);

        return $language;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LanguageSpoken $languageSpoken)
    {
        //
        $language = LanguageSpoken::find($languageSpoken->id);

        return $language->delete();
    }
}
