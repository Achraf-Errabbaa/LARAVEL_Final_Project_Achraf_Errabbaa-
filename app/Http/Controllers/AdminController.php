<?php

namespace App\Http\Controllers;

use App\Mail\ApproveMailer;
use Closure;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    

    public function index()
    {
        // Fetch users who are not approved
        $pendingUsers = User::where('approved', false)->where('role', '!=', 'admin')->get();
        $approvedUsers = User::where('approved', true)->where('role', '!=', 'admin')->get();
    return view('admin.approve', compact('pendingUsers', 'approvedUsers'));
    }


    public function giveROle(Request $request, User $user)
    {
        $test = $request->user_id;
        $haja = User::where('id', $test)->first();
        $haja->update([
            'role'=> 'coach',
        ]);
        return back()->with('role_success', 'Role given Successfully');
    }

    public function approve(User $user)
    {
        $password = rand(10000000,99999999);

        $passwordHashed = bcrypt($password);
        $user->password = $passwordHashed;
        $user->approved = true;
        $user->save();

        Mail::to($user->email)->send(new ApproveMailer($password));

        // Auth::login($user);
        return back()->with('approve_success', 'User is accepted Successfully');
    }

    /**
     * Reject a user.
     */
    public function reject(User $user)
    {
        $user->delete(); // Remove user from the database

        return back()->with('reject_success', 'User rejected and removed successfully.');
    }

    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has an admin role
        if (auth()->check() && auth()->user()->role === 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

