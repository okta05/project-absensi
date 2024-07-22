<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
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

    public function adminStore(Request $request) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = new Admin();
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_admin')) {
            $foto_admin = $request->file('foto_admin')->store('admin/foto_admin', 'public');
            $data->foto_admin = $foto_admin;
        } else {
            $data->foto_admin = '';
        }
        
        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('admin.view');
    }

    public function adminEdit($id) {
        $editDataAdmin = Admin::find($id);
        return view('tampilan.admin.edit_admin', compact('editDataAdmin'));
    }

    public function adminUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNama' => 'required',
            'foto_admin' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // menambahkan validasi untuk file image
         
        ]); 

        $data = Admin::find($id);
        $data->nama=$request->textNama;
        $data->nip=$request->textNIP;
        $data->jns_kelamin=$request->text_jns_kelamin;
        $data->alamat=$request->textAlamat;
        $data->no_telp=$request->text_no_telp;

        if ($request->file('foto_admin')) {
            // Delete the old photo if exists
            if ($data->foto_admin && Storage::disk('public')->exists($data->foto_admin)) {
                Storage::disk('public')->delete($data->foto_admin);
            }
    
            // Store the new photo
            $foto_admin = $request->file('foto_admin')->store('admin/foto_admin', 'public');
            $data->foto_admin = $foto_admin;
        }

        $data->email=$request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        return redirect()->route('admin.view');
    }

    public function adminDelete($id) {

        $deleteDataAdmin = Admin::find($id);
        if ($deleteDataAdmin) {
            // Delete the photo from storage if exists
            if ($deleteDataAdmin->foto_admin && Storage::disk('public')->exists($deleteDataAdmin->foto_admin)) {
                Storage::disk('public')->delete($deleteDataAdmin->foto_admin);
            }
    
            // Delete the siswa data from database
            $deleteDataAdmin->delete();
    
            return redirect()->route('admin.view');
        } 
        }

}