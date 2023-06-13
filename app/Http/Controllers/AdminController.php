<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MusicianController;
use App\Models\MusicFile;
use App\Mail\MusicianApproval;
use App\Models\Musician;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/admin/login')->with('error', 'Email does not exist.');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect('/admin/login')->with('error', 'Incorrect password.');
        }

        if ($user->role_id != 1) {
            return redirect('/admin/login')->with('error', 'You are not an admin.');
        }

        $pendingMusicians = MusicFile::with('musician')->get();
        $musicians = Musician::all(); 
        return view('admin.dashboard', compact('pendingMusicians', 'musicians'));
    }

    public function logout()
    {
        Session::forget('email');
        Session::flush(); 
        return redirect('/admin/login');
    }

    public function approveMusician($id)
    {
        // dd($id);
        $musician = Musician::findOrFail($id);
        $musician->approved = 1;
        $musician->save();
        $token = Str::random(32);
        Mail::to($musician->email)->send(new MusicianApproval($musician, $token));

       $pendingMusicians = MusicFile::with('musician')->get();
        $musicians = Musician::all();
        return view('admin.dashboard', compact('pendingMusicians', 'musicians'));
    }
    public function approveFile($id)
    {
         $file = MusicFile::find($id);
        if ($file) {
            $file->approved = true;
            $file->save();
        }
          $pendingMusicians = MusicFile::with('musician')->get();
        $musicians = Musician::all();
        return view('admin.dashboard', compact('pendingMusicians', 'musicians'));
    }

}
