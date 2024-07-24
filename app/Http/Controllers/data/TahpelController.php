<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tahpel;

class TahpelController extends Controller
{
    //
       public function tahpelView() {
        $data['allDataTahpel']=Tahpel::all();
        return view("tampilan.data.tahun_pelajaran.view_tahpel", $data);
    }

    public function tahpelAdd() {
        return view("tampilan.data.tahun_pelajaran.add_tahpel");
    }

    public function tahpelStore(Request $request) {
        $validateData=$request->validate([
            'text_thn_pelajaran' => 'required',
        ]); 

        $data = new Tahpel();
        $data->th_pelajaran=$request->text_thn_pelajaran;
        $data->save();

        return redirect()->route('tahpel.view');
    }

    public function tahpelEdit() {
        return view("tampilan.data.tahun_pelajaran.edit_tahpel");
    }
}
