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
            $query->where('recruiter_id', $user->id);
        } elseif ($user->hasRole('freelancer')) {
            // Fetch projects the authenticated freelancer has bidded for
            $query->whereHas('bids', function ($q) use ($user) {
                $q->where('freelancer_id', $user->id);
            });
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

        // Validate incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'min_budget' => 'required|numeric|min:0',
            'max_budget' => 'required|numeric|min:0|gte:min_budget', // Ensure max_budget is greater than or equal to min_budget
            'category' => 'required|string|max:255',
            'skills' => 'required|string|max:500',
        ]);

        // Create the project if validation passes
        $project = Project::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'min_budget' => $validatedData['min_budget'],
            'max_budget' => $validatedData['max_budget'],
            'category' => $validatedData['category'],
            'skills' => $validatedData['skills'],
        ]);

        // Return success response or redirect
        return response()->json(['message' => 'Project created successfully', 'project' => $project], 201);
    }

    public function updateProject() {}
}
