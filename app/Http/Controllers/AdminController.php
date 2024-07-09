<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminView() {
        
        $data['allDataAdmin']=Admin::all();
        return view('tampilan.admin.view_admin', $data); 
        
    }

    public function adminDetail() {
        return view('tampilan.admin.detail_admin');
    }

    public function adminAdd() {
        return view('tampilan.admin.add_admin');
    }

    public function adminEdit() {
        return view('tampilan.admin.edit_admin');
    }
}
