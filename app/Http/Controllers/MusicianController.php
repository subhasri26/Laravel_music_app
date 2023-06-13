<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Musician;
use App\Models\Role;
use App\Models\MusicFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
class MusicianController extends Controller
{
     public function showRegistrationForm()
    {
        return view('musician.register');
    }

  public function register(Request $request)
    {
        // dd($request->name);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $role = Role::where('name', 'musician')->first();
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_id = $role->id;
        if ($user->save()) {
            $musician = new Musician();
            $musician->name = $validatedData['name'];
            $musician->email = $validatedData['email'];
            $musician->password = Hash::make($validatedData['password']);
            $musician->user_id = $user->id;

            if ($musician->save()) {
                return redirect('/musician/login')->with('success', 'You have registered successfully');
            } else {
                $user->delete(); 
                return redirect()->back()->with('error', 'Failed to register as a musician. Please try again.');    
            }
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }

    public function showLoginForm()
    {
        return view('musician.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = Hash::make($request->password);
        $user = User::where('email', $email)->first();
        $musician = Musician::where('email', $email)->first();
        if ($user && $musician->approved == 1) {
            // if (Hash::check($password, $user->password)) {
                Auth::login($user);
                $user->password = $password;
                $musician->password = $password;
                $musician->save();
                $user->save();
                Session::put('email', $email);
                return redirect('/musician/upload');
            // }
        } 
        return redirect('/musician/login')->with('error', 'Invalid email or password');

    }
    public function showFileUploadForm()
    {
        return view('musician.file_upload');
    }
    public function logout()
    {
          Session::forget('email');
        Session::flush(); 
        return redirect('/musician/login');
    }

     public function store(Request $request)
     {
       $email = Session::get('email');
       $musician = Musician::where('email', $email)->first();
       if ($musician) {
             $this->validate($request, [
            'audio' => 'required|mimes:audio/mpeg,mpga,mp3,wav|max:2048',
             ]);
            if ($request->hasFile('audio')) 
            {
                $audio = $request->file('audio');
                $audioName = time() . '.' . $audio->getClientOriginalExtension();
                $audio->move(public_path('/audio'), $audioName);
                $upload = new MusicFile;
                $upload->filename = $audioName;
                $upload->musician_id = $musician->id;
                $upload->save();
                return redirect('/musician/upload')->with('success', 'Upload file successfully.');
            }
            else {
                return redirect('/musician/upload')->with('error', 'Failed to upload files.');
            }
        }
    }
}
