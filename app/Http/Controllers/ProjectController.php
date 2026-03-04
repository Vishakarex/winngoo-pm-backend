<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
// {
//         public function store(Request $request)
//     {
//         $request->validate([
//             'project_name' => 'required|string|max:255',
//             'website_url' => 'nullable|url',
//             'android_url' => 'nullable|url',
//             'ios_url' => 'nullable|url',
//         ]);

//         $project = Project::create([
//             'project_name'  => $request->project_name,
//             'description'   => $request->description,
//             'logo_url'      => $request->logo_url,
//             'country'       => $request->country,
//             'phone_number'  => $request->phone_number,
//             'company_name'  => $request->company_name,
//             'address'       => $request->address,
//             'website_url'   => $request->website_url,
//             'android_url'   => $request->android_url,
//             'ios_url'       => $request->ios_url,
//             'icon_letter'   => $request->icon_letter,
//             'color'         => $request->color ?? 'Black',
//             'notes'         => $request->notes,
//             'is_favorite'   => $request->has('is_favorite'),
//         ]);

//         // return response()->json([
//         //     'status' => true,
//         //     'message' => 'Project created successfully',
//         //     'data' => $project
//         // ]);

//         return redirect()->route('dashboard')
//         ->with('success', 'Project created successfully');
//     }





{

public function store(Request $request)
{
    // Validation will automatically return JSON if 'Accept: application/json' is sent in headers
    $validated = $request->validate([
        'project_name' => 'required|string|max:255',
        'website_url'  => 'nullable|url',
        'android_url'  => 'nullable|url',
        'ios_url'      => 'nullable|url',
         'logo_url'      => 'nullable|url',
    ]);

    $project = Project::create([
        'project_name'  => $request->project_name,
        'description'   => $request->description,
        'logo_url'      => $request->logo_url,
        'country'       => $request->country,
        'phone_number'  => $request->phone_number,
        'company_name'  => $request->company_name,
        'address'       => $request->address,
        'website_url'   => $request->website_url,
        'android_url'   => $request->android_url,
        'ios_url'       => $request->ios_url,
        'icon_letter'   => $request->icon_letter,
        'color'         => $request->color ?? 'Black',
        'notes'         => $request->notes,
        'is_favorite'   => $request->has('is_favorite'),
    ]);

    // NEW: Check for AJAX request
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully',
            'project' => $project
        ], 201);
    }

    // Fallback for normal form submission
    return redirect()->route('dashboard')->with('success', 'Project created successfully');
}

public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'project_name' => 'required|string|max:255',
        'website_url'  => 'nullable|url',
        'android_url'  => 'nullable|url',
        'ios_url'      => 'nullable|url',
    ]);

    $project->update([
        'project_name'  => $request->project_name,
        'description'   => $request->description,
        'logo_url'      => $request->logo_url,
        'country'       => $request->country,
        'phone_number'  => $request->phone_number,
        'company_name'  => $request->company_name,
        'address'       => $request->address,
        'website_url'   => $request->website_url,
        'android_url'   => $request->android_url,
        'ios_url'       => $request->ios_url,
        'icon_letter'   => $request->icon_letter,
        'color'         => $request->color ?? 'Black',
        'notes'         => $request->notes,
        'is_favorite'   => $request->has('is_favorite'),
    ]);

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    return redirect()->route('dashboard')->with('success', 'Project updated successfully');
}

public function getProjects()
{
    $projects = Project::all();

    return response()->json($projects);
}


public function destroy(Request $request, $id)
{
    $project = Project::findOrFail($id);
    $project->delete();

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Project deleted successfully'
        ]);
    }

    return redirect()->route('dashboard')->with('success', 'Project deleted successfully');
}



public function bulkDelete(Request $request)
{
    $ids = $request->project_ids;

    if (!empty($ids)) {
        Project::whereIn('id', $ids)->delete();
    }

    return redirect()->back()->with('success', 'Selected projects deleted successfully.');
}







}
