<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{



      public function showLoginForm()
    {
        return view('login');
    }


public function login(Request $request)
{
    $request->validate([
        'password' => 'required|string'
    ]);

    $admin = Admin::first();

    if ($admin && Hash::check($request->password, $admin->password)) {

        // ✅ Proper login for auth:admin middleware
        Auth::guard('admin')->login($admin);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'password' => 'Incorrect password. Please try again.'
    ]);
}


public function dashboard()
{
    // 'project_name' should match the column name in your database table
    // $project = Project::orderBy('project_name', 'asc')->paginate(10);
    // $project = Project::latest()->paginate(10);
       $project = Project::with('credentials')  // 👈 ADD THIS
                ->latest()
                ->paginate(10);
    return view('dashboard', compact('project'));
}


public function logout(Request $request)
{
    $request->session()->forget('admin_logged_in');
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6'
    ]);

    $admin = Admin::first(); // or use auth if multiple admins

    if (!Hash::check($request->current_password, $admin->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Current password incorrect'
        ], 401);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    return response()->json([
        'success' => true,
        'message' => 'Password updated successfully'
    ]);
}





}
