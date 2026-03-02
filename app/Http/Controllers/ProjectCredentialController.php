<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\ProjectCredential;
use Illuminate\Http\Request;

class ProjectCredentialController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'type'       => 'required|string',
        'title'      => 'required|string',
        'email'      => 'required|string',
        'password'   => 'required|string',
    ]);

    $credential = ProjectCredential::create([
        'project_id' => $request->project_id,
        'type'       => $request->type,
        'title'      => $request->title,
        'login_url'  => $request->login_url,
        'email'      => $request->email,
        'password'   => Crypt::encryptString($request->password), // secure
        'notes'      => $request->notes,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Credential added successfully',
        'data' => $credential
    ]);
}

}