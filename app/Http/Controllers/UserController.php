<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicFile;

class UserController extends Controller
{
     public function index()
    {
        $files = MusicFile::where('approved', true)->get();
        return view('user.index', compact('files'));
    }
     public function showFiles()
    {
        $pendingMusicians = MusicFile::with('musician')->get();
        return view('welcome', compact('pendingMusicians'));
    }
}
