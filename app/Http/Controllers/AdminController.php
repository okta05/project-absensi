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
            $data->foto = $foto_admin;
        } else {
            $data->foto = '';
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

        // Cek apakah ada file foto yang diupload
        if ($request->file('foto_admin')) {
            // Hapus foto lama jika ada
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }
    
            // Store the new photo
            $foto_admin = $request->file('foto_admin')->store('admin/foto_admin', 'public');
            $data->foto = $foto_admin;
        }

        $data->email=$request->email;

        // Cek apakah field password diisi
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        $data->save();

        return redirect()->route('admin.view');
    }

    public function adminDelete($id) {

        $deleteDataAdmin = Admin::find($id);
        if ($deleteDataAdmin) {
            // hapus foto dari penyimpanan
            if ($deleteDataAdmin->foto && Storage::disk('public')->exists($deleteDataAdmin->foto)) {
                Storage::disk('public')->delete($deleteDataAdmin->foto);
            }
    
            // hapus data dari database
            $deleteDataAdmin->delete();
    
            return redirect()->route('admin.view');
        } 
        }

}