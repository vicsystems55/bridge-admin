<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  //

  public function allProjects(Request $request)
  {
    $user = $request->user(); // Assuming the user is authenticated
    $filter = $request->get('filter', 'all'); // Default to 'all' if no filter is provided

    // Query builder for projects
    $query = Project::query();

    if ($user->hasRole('recruiter')) {
      // Fetch projects created by the authenticated recruiter
      $query->where('created_by', $user->id);
    } elseif ($user->hasRole('freelancer')) {
      // Fetch projects the authenticated freelancer has bidded for
      // $query->whereHas('bids', function ($q) use ($user) {
      //     $q->where('freelancer_id', $user->id);
      // });
      $query->latest();
    } elseif ($filter === 'admin') {
      // Fetch all projects if the user is an admin
      if ($user->role === 'admin') {
        // No additional filters needed for admin
      } else {
        return response()->json(['message' => 'Unauthorized'], 403);
      }
    } else {
      return response()->json(['message' => 'Invalid filter provided'], 400);
    }

    // Get the filtered projects with any necessary relationships
    // $projects = $query->with(['recruiter', 'bids.freelancer'])->get();
    $projects = $query->get();


    return $projects;
  }


  public function createProject(Request $request)
  {

    // return $request->all();

    // Validate incoming data
    // $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string|max:1000',
    //         'min_budget' => 'required|numeric|min:0',
    //         'max_budget' => 'required|numeric|min:0|gte:min_budget', // Ensure max_budget is greater than or equal to min_budget
    //         'category' => 'required|string|max:255',
    //         'skills' => 'required|string|max:500',
    //     ]);

    // Create the project if validation passes

    $budgetParts = explode('-', $request->budgetRange);
    $minBudget = trim($budgetParts[0]);
    $maxBudget = trim($budgetParts[1]);
    $project = Project::create([
      'title' => $request->title,
      'created_by' => $request->user()->id,
      'description' => $request->description,
      'min_budget' => (float) $minBudget, // Convert to float for decimal handling
      'max_budget' => (float) $maxBudget,
      'category' => $request->category,
      'skills' => json_encode($request->skills),

    ]);

    // Return success response or redirect
    return $project;
  }

  public function searchProjects(Request $request)
  {
      $keyWord = $request->input('keyWord');
      $selectedExperience = $request->input('selectedExperience') ? explode(',', $request->input('selectedExperience')) : [];
      $selectedIndustry = $request->input('selectedIndustry') ? explode(',', $request->input('selectedIndustry')) : [];
      $selectedSkills = $request->input('selectedSkills') ? explode(',', $request->input('selectedSkills')) : [];

      $renumerationRangeArray = explode('-', $request->input('budgetRange'));
      $renumerationRange = [
          'min' => (int) $renumerationRangeArray[0],
          'max' => (int) $renumerationRangeArray[1]
      ];

      $projects = Project::latest()
          ->where(function ($query) use ($keyWord) {
              $query->where('title', 'like', "%$keyWord%")
                  ->orWhere('description', 'like', "%$keyWord%");
          })
          ->where('status', 'active')->get();

          return $selectedIndustry;

      // Apply industry filter if selected
      if (!empty($selectedIndustry)) {
          $projects->whereIn('category', $selectedIndustry);
      }


      if (!empty($renumerationRangeArray)) {
        $projects->whereBetween('min_budget', [$renumerationRange['min'] - 1000, $renumerationRange['min'] + 1000])
        ->whereBetween('max_budget', [$renumerationRange['max']  - 1000, $renumerationRange['max'] + 1000]);

    }

      // Apply skills filter if selected
      if (!empty($selectedSkills)) {
          $projects->where(function ($query) use ($selectedSkills) {
              foreach ($selectedSkills as $skill) {
                  $query->orWhereJsonContains('skills', $skill);
              }
          });
      }

      return $projects->get();
  }

  public function updateProject() {}
}
