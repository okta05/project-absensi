<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Kepsek;
use App\Models\Bk;
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
            $profileData = $user->admin;
            $role = 'admin';
            $foto = $profileData->foto_admin;
        } elseif ($user->is_kepsek) {
            $profileData = $user->kepsek;
            $role = 'kepsek';
            $foto = $profileData->foto_kepsek;
        } elseif ($user->is_kurikulum) {
            $profileData = $user->kurikulum;
            $role = 'kurikulum';
            $foto = $profileData->foto_kurikulum;
        } elseif ($user->is_bk) {
            $profileData = $user->bk;
            $role = 'bk';
            $foto = $profileData->foto_bk;
        } elseif ($user->is_wakel) {
            $profileData = $user->wakel;
            $role = 'wakel';
            $foto = $profileData->foto_wakel;
        } elseif ($user->is_guru) {
            $profileData = $user->guru;
            $role = 'guru';
            $foto = $profileData->foto_guru;
        } else {
            $profileData = $user;
            $role = 'user';
            $foto = null; // atau foto default jika ada
        }
        
        return view("tampilan.profile.view_profile", compact('profileData', 'role', 'foto'));
    }
}