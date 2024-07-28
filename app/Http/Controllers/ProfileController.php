<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Kepsek;
use App\Models\Kurikulum;
use App\Models\Wakel;
use App\Models\Guru;


class ProfileController extends Controller
{
    //
    public function profileView() {

        $user = Auth::user();
        $profileData = null;
        $role = null;
        $foto = null;

        if ($user->is_admin) {
            $profileData = Admin::where('user_id', $user->id)->first();
            $role = 'admin';
            $foto = $profileData->foto_admin;
        } elseif ($user->is_kepsek) {
            $profileData = Kepsek::where('user_id', $user->id)->first();
            $role = 'kepsek';
            $foto = $profileData->foto_kepsek;
        } elseif ($user->is_kurikulum) {
            $profileData = Kurikulum::where('user_id', $user->id)->first();
            $role = 'kurikulum';
            $foto = $profileData->foto_kurikulum;
        } elseif ($user->is_wali_kelas) {
            $profileData = Wakel::where('user_id', $user->id)->first();
            $role = 'wakel';
            $foto = $profileData->foto_wakel;
        } elseif ($user->is_guru) {
            $profileData = Guru::where('user_id', $user->id)->first();
            $role = 'guru';
            $foto = $profileData->foto_guru;
        } else {
            $profileData = $user;
            $role = 'user';
        }
        return view("tampilan.profile.view_profile", compact('profileData', 'role', 'foto'));
    }
}
