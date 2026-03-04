<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\ProjectCredential;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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


    public function destroy(Project $project, ProjectCredential $credential)
    {
        // Ensure credential belongs to the project
        if ($credential->project_id !== $project->id) {
            return response()->json([
                'status' => false,
                'message' => 'Credential does not belong to this project.'
            ], 403);
        }

        $credential->delete();

        return response()->json([
            'status' => true,
            'message' => 'Credential deleted successfully.'
        ]);
    }











public function sendOtp(Request $request)
{
    $credential = ProjectCredential::find($request->credential_id);

    if (!$credential) {
        return response()->json(['status' => false]);
    }

    $otp = rand(1000, 9999);

    $credential->update([
        'otp' => Hash::make($otp),
        'otp_expires_at' => Carbon::now()->addMinutes(5)
    ]);

    Mail::raw("Your OTP is: $otp", function ($message) use ($credential) {
        $message->to($credential->email)
                ->subject('OTP Verification');
    });

    return response()->json(['status' => true]);
}


public function verifyOtp(Request $request)
{
    $credential = ProjectCredential::find($request->credential_id);

    if (!$credential) {
        return response()->json(['status' => false]);
    }

    if (
        $credential->otp &&
        Hash::check($request->otp, $credential->otp) &&
        now()->lessThan($credential->otp_expires_at)
    ) {
        return response()->json([
            'status' => true,
            'password' => $credential->password
        ]);
    }

    return response()->json(['status' => false]);
}
// Controller
public function getPassword(Request $request)
{
    // ✅ Only allow if user is authenticated
    $credential = ProjectCredential::find($request->credential_id);

    if (!$credential) {
        return response()->json(['status' => false]);
    }

    return response()->json([
        'status' => true,
        'password' => $credential->password  // Auto-decrypted if using cast
    ]);
}

}