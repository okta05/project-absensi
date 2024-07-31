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
use Illuminate\Support\Facades\Storage;


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
            $foto = $profileData->foto;
        } elseif ($user->is_kepsek) {
            $profileData = $user->kepsek;
            $role = 'kepsek';
            $foto = $profileData->foto;
        } elseif ($user->is_kurikulum) {
            $profileData = $user->kurikulum;
            $role = 'kurikulum';
            $foto = $profileData->foto;
        } elseif ($user->is_bk) {
            $profileData = $user->bk;
            $role = 'bk';
            $foto = $profileData->foto;
        } elseif ($user->is_wakel) {
            $profileData = $user->wakel;
            $role = 'wakel';
            $foto = $profileData->foto;
        } elseif ($user->is_guru) {
            $profileData = $user->guru;
            $role = 'guru';
            $foto = $profileData->foto;
        } else {
            $profileData = $user;
            $role = 'user';
            $foto = null; // atau foto default jika ada
        }
        
        return view("tampilan.profile.view_profile", compact('profileData', 'role', 'foto'));
    }

    public function profileEdit() {
        $user = Auth::user();
        $profileData = null;
        $fotoColumn = 'foto'; // Default column name
        $foto = null;
        $role = null;
    
        // Determine the correct profile model and photo column
        if ($user->is_admin) {
            $profileData = $user->admin;
            $fotoColumn = 'foto';
            $role = 'admin';
        } elseif ($user->is_kepsek) {
            $profileData = $user->kepsek;
            $fotoColumn = 'foto';
            $role = 'kepsek';
        } elseif ($user->is_kurikulum) {
            $profileData = $user->kurikulum;
            $fotoColumn = 'foto';
            $role = 'kurikulum';
        } elseif ($user->is_bk) {
            $profileData = $user->bk;
            $fotoColumn = 'foto';
            $role = 'bk';
        } elseif ($user->is_wakel) {
            $profileData = $user->wakel;
            $fotoColumn = 'foto';
            $role = 'wakel';
        } elseif ($user->is_guru) {
            $profileData = $user->guru;
            $fotoColumn = 'foto';
            $role = 'guru';
        } else {
            $profileData = $user;
        }
    
        // Get the existing photo path
        $foto_profile = $profileData ? $profileData->$fotoColumn : null;
    
        return view('tampilan.profile.edit_profile', compact('profileData', 'fotoColumn', 'role'));
    }
    

    public function profileUpdate(Request $request) {
        $user = Auth::user();
        $profileData = null;
        $fotoColumn = 'foto'; // Default column name
    
        // Determine the correct profile model and photo column
        if ($user->is_admin) {
            $profileData = $user->admin;
            $fotoColumn = 'foto';
        } elseif ($user->is_kepsek) {
            $profileData = $user->kepsek;
            $fotoColumn = 'foto';
        } elseif ($user->is_kurikulum) {
            $profileData = $user->kurikulum;
            $fotoColumn = 'foto';
        } elseif ($user->is_bk) {
            $profileData = $user->bk;
            $fotoColumn = 'foto';
        } elseif ($user->is_wakel) {
            $profileData = $user->wakel;
            $fotoColumn = 'foto';
        } elseif ($user->is_guru) {
            $profileData = $user->guru;
            $fotoColumn = 'foto';
        } else {
            $profileData = $user;
        }
    
        // Validate input
        $request->validate([
            'textNama' => 'required|string|max:255',
            'textNIP' => 'required|string|max:255',
            'text_jns_kelamin' => 'required|string|max:10',
            'textAlamat' => 'required|string|max:255',
            'text_no_telp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Update profile data
        $profileData->nama = $request->input('textNama');
        $profileData->nip = $request->input('textNIP');
        $profileData->jns_kelamin = $request->input('text_jns_kelamin');
        $profileData->alamat = $request->input('textAlamat');
        $profileData->no_telp = $request->input('text_no_telp');
        $profileData->email = $request->input('email');
    
        if ($request->filled('password')) {
            $profileData->password = bcrypt($request->input('password'));
        }
        
        // Handle file upload and update foto column
        if ($request->hasFile('foto_profile')) {
            // Delete the old photo if exists
            if ($profileData->$fotoColumn && Storage::disk('public')->exists($profileData->$fotoColumn)) {
                Storage::disk('public')->delete($profileData->$fotoColumn);
            }
    
            // Store the new photo
            $fotoFile = $request->file('foto_profile')->store($fotoColumn, 'public');
            $profileData->$fotoColumn = $fotoFile;
        }
    
        // Save updated profile
        $profileData->save();
    
        return redirect()->route('profile.view')->with('success', 'Profile updated successfully');
    }
    
    
}