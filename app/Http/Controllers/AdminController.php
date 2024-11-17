<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApproved; // Make sure to create a Mailable class for the approval email.

class AdminController extends Controller
{
    // Show the admin dashboard with user list
    public function dashboard()
    {
        $users = User::all(); // Get all users or filter for pending approval
        return view('admin.dashboard', compact('users'));
    }

    // Approve a user by changing their status
    public function approveUser($id)
    {
        $user = User::find($id);
        if ($user && !$user->approved) {
            // Mark the user as approved
            $user->approved = true;
            $user->save();

            // Send email to the user with their password or approval notification
            $password = 'secure_password'; // Or generate a password dynamically
            Mail::to($user->email)->send(new UserApproved($user, $password)); // You need to create the UserApproved mailable.

            return redirect()->route('admin.dashboard')->with('success', 'User approved and email sent.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'User not found or already approved.');
    }

    // Upgrade user to coach
    public function upgradeToCoach($id)
    {
        $user = User::find($id);
        if ($user && $user->approved) {
            // Upgrade the user to coach
            $user->role_id = 2; // Assuming 2 is the role ID for coach
            $user->save();

            return redirect()->route('admin.dashboard')->with('success', 'User upgraded to Coach.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'User not approved or not found.');
    }
}
