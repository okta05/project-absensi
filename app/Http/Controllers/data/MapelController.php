<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    //
    public function mapelView() {
        $data['allDataMapel']=Mapel::all();
        return view("tampilan.data.mapel.view_mapel", $data);
    }

    public function mapelAdd() {
        return view("tampilan.data.mapel.add_mapel");
    }

    public function mapelStore(Request $request) {

        $validateData=$request->validate([
            'textNM_Mapel' => 'required',
            'text_id_guru' => 'required',
         
        ]); 

        $data = new Mapel();
        $data->nm_mapel=$request->textNM_Mapel;
        $data->id_guru=$request->text_id_guru;
        $data->id_th_pelajaran=$request->text_id_tahpel;
        $data->save();

        return redirect()->route('mapel.view');
    }

    public function mapeledit($id) {
        $editDataMapel = Mapel::find($id);
        return view("tampilan.data.mapel.edit_mapel", compact('editDataMapel'));
    }

    public function mapelUpdate(Request $request, $id) {

        $validateData=$request->validate([
            'textNM_Mapel' => 'required',
            'text_id_guru' => 'required',
         
        ]); 

        $data = Mapel::find($id);
        $data->nm_mapel=$request->textNM_Mapel;
        $data->id_guru=$request->text_id_guru;
        $data->id_th_pelajaran=$request->text_id_tahpel;
        $data->save();

        return redirect()->route('mapel.view');
    }

    public function mapelDelete ($id) {
        $deleteDataMapel = Mapel::find($id);
        $deleteDataMapel->delete();

        return redirect()->route('mapel.view');
    }
}
