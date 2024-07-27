<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function profileView() {
        return view("tampilan.profile.view_profile");
    }
}
