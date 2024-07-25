<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Wakel;

class KelasController extends Controller
{
    //
    public function kelasView() {
        $data['allDataKelas']=Kelas::all();
        return view("tampilan.data.kelas.view_kelas", $data);
    }

    public function kelasAdd() {
        $wakels = Wakel::all();

        return view("tampilan.data.kelas.add_kelas", compact('wakels'));
    }

    public function wakelStore(Request $request) {

        $validateData=$request->validate([
            'textNM_kelas' => 'required',
            'textWakel' => 'required',
         
        ]); 

        $data = new Kelas();
        $data->nm_kelas=$request->textNM_kelas;
        $data->tingkat=$request->textTingkat;
        $data->id_wakel=$request->textWakel;
        $data->save();

        return redirect()->route('kelas.view');
    }

    public function kelasEdit($id) {
        $wakels = Wakel::all();
        $editDataKelas = Kelas::find($id);
        return view("tampilan.data.kelas.edit_kelas", compact('editDataKelas', 'wakels'));
    }

    public function wakelUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNM_kelas' => 'required',
            'textWakel' => 'required',
         
        ]); 

        $data = Kelas::find($id);
        $data->nm_kelas=$request->textNM_kelas;
        $data->tingkat=$request->textTingkat;
        $data->id_wakel=$request->textWakel;
        $data->save();

        return redirect()->route('kelas.view');
    }
}