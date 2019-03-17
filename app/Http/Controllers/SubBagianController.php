<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Modul;
use App\Models\User;
use App\Models\Bagian;

use ADHhelper;

class SubBagianController extends Controller
{
    private function move($id, $up)
    {
        $dari = Bagian::find($id);
        $ke = Bagian::where([
            'parent_id' => $dari->parent_id,
            'posisi' => $up ? $dari->posisi - 1 : $dari->posisi + 1,
        ])->first();

        $dariPosisi = $dari->posisi;
        $kePosisi = $ke->posisi;

        $dari->posisi = $kePosisi;
        $ke->posisi = $dariPosisi;

        $dari->save();
        $ke->save();

        return route('subbagian.index', $dari->parent_id);
    }
    
    public function up($id) 
    {
        return redirect($this->move($id, true));
    }

    public function down($id) 
    {
        return redirect($this->move($id, false));
    }

    private function authorCheckBagian($id)
    {
        $bagian = Bagian::find($id);

        if ($bagian && $bagian->modul->id_user == session('userID')) {
            return true;
        }
    }

    private function authorCheckSubBagian($id)
    {
        $subbagian = Bagian::find($id);

        if ($subbagian && $subbagian->parent->modul->id_user == session('userID')) {
            return true;
        }
    }

    public function index($id)
    {
        if (!$this->authorCheckBagian($id)) {
            abort(404);
        }

        $bagian = Bagian::find($id);
        $subbagians = $bagian->childs;
        $modul = $bagian->modul;

        return view('subbagian.index', compact(['bagian', 'subbagians', 'modul']));
    }

    public function create($id)
    {
        if (!$this->authorCheckBagian($id)) {
            abort(404);
        }

        $bagian = Bagian::find($id);
        $subbagians = $bagian->childs;
        $modul = $bagian->modul;

        return view('subbagian.create', compact(['bagian', 'subbagians', 'modul']));
    }

    public function store(Request $request, $id)
    {
        if (!$this->authorCheckBagian($id)) {
            abort(404);
        }

        $request->validate([
            'subbagian' => 'required',
        ]);

        $data['bagian'] = $request->subbagian;
        $data['parent_id'] = $id;

        $bagian = Bagian::find($id);
        if (count($bagian->childs) > 0) {
            $data['posisi'] = count($bagian->childs) + 1;
        } else {
            $data['posisi'] = 1;
        }

        Bagian::create($data);

        return redirect()->route('subbagian.index', $id)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!$this->authorCheckSubBagian($id)) {
            abort(404);
        }

        $subbagian = Bagian::find($id);
        $subbagian->subbagian = $subbagian->bagian;
        $bagian = $subbagian->parent;
        $modul = $bagian->modul;

        return view('subbagian.edit', compact(['subbagian', 'bagian', 'modul']));
    }

    public function update(Request $request, $id)
    {
        if (!$this->authorCheckSubBagian($id)) {
            abort(404);
        }
        
        $request->validate([
            'subbagian' => 'required',
        ]);

        $data['bagian'] = $request->subbagian;

        Bagian::where(['id' => $id])->update($data);

        $subbagian = Bagian::find($id);
        $parent_id = $subbagian->parent_id;

        return redirect()->route('subbagian.index', $parent_id)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        if (!$this->authorCheckSubBagian($id)) {
            abort(404);
        }
        
        $subbagian = Bagian::find($id);
        $parent_id = $subbagian->parent_id;
     
        try {
            $subbagian->delete();

            Bagian::where(['parent_id' => $parent_id])->where('posisi', '>', $subbagian->posisi)->decrement('posisi');
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => config('app.debug') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }     

        return redirect()->route('subbagian.index', $parent_id)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }

    public function document($id)
    {
        if (!$this->authorCheckSubBagian($id)) {
            abort(404);
        }

        $subbagian = Bagian::find($id);
        $subbagian->subbagian = $subbagian->bagian;
        $bagian = $subbagian->parent;
        $modul = $bagian->modul;

        return view('subbagian.document', compact(['subbagian', 'bagian', 'modul']));
    }

    public function saveDocument(Request $request, $id)
    {
        if (!$this->authorCheckSubBagian($id)) {
            abort(404);
        }        

        $subbagian = Bagian::find($id);
        $subbagian->text = $request->text;
        $subbagian->save();

        return redirect()->route('subbagian.document', $subbagian->id)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Simpan Data',
            'class' => 'success',
        ]); 
    }

}
