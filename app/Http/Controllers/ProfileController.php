<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfileForm()
    {
        return view('profile');
    }

    public function showProfileAdminForm()
    {
        return view('profileadmin');
    }
}
