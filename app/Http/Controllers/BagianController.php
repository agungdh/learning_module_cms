<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Modul;
use App\Models\User;
use App\Models\Bagian;

use ADHhelper;

class BagianController extends Controller
{
    private function move($id, $up)
    {
        $dari = Bagian::find($id);
        $ke = Bagian::where([
            'id_modul' => $dari->id_modul,
            'posisi' => $up ? $dari->posisi - 1 : $dari->posisi + 1,
        ])->first();

        $dariPosisi = $dari->posisi;
        $kePosisi = $ke->posisi;

        $dari->posisi = $kePosisi;
        $ke->posisi = $dariPosisi;

        $dari->save();
        $ke->save();

        return route('bagian.index', $dari->id_modul);
    }
    
    public function up($id) 
    {
        return redirect($this->move($id, true));
    }

    public function down($id) 
    {
        return redirect($this->move($id, false));
    }

    private function authorCheckModul($id)
    {
        $modul = Modul::find($id);

        if ($modul && $modul->id_user == session('userID')) {
            return true;
        }
    }

    private function authorCheckBagian($id)
    {
        $bagian = Bagian::find($id);

        if ($bagian && $bagian->modul->id_user == session('userID')) {
            return true;
        }
    }

    public function index($id)
    {
        if (!$this->authorCheckModul($id)) {
            return redirect()->route('main.index');
        }

        $modul = Modul::find($id);
        $bagians = $modul->bagians;

        return view('bagian.index', compact(['modul', 'bagians']));
    }

    public function create($id)
    {
        if (!$this->authorCheckModul($id)) {
            return redirect()->route('main.index');
        }

        $modul = Modul::find($id);
        $bagians = $modul->bagians;

        return view('bagian.create', compact(['modul', 'bagians']));
    }

    public function store(Request $request, $id)
    {
        if (!$this->authorCheckModul($id)) {
            return redirect()->route('main.index');
        }

        $request->validate([
            'bagian' => 'required',
        ]);

        $data = $request->only('bagian');
        $data['id_modul'] = $id;

        $modul = Modul::find($id);
        if (count($modul->bagians) > 0) {
            $data['posisi'] = count($modul->bagians) + 1;
        } else {
            $data['posisi'] = 1;
        }

        Bagian::create($data);

        return redirect()->route('bagian.index', $id)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        if (!$this->authorCheckBagian($id)) {
            return redirect()->route('main.index');
        }

        $bagian = Bagian::find($id);
        $modul = $bagian->modul;

        return view('bagian.edit', compact(['bagian', 'modul']));
    }

    public function update(Request $request, $id)
    {
        if (!$this->authorCheckBagian($id)) {
            return redirect()->route('main.index');
        }
        
        $request->validate([
            'bagian' => 'required',
        ]);

        $data = $request->only('bagian');

        Bagian::where(['id' => $id])->update($data);

        $bagian = Bagian::find($id);
        $id_modul = $bagian->id_modul;

        return redirect()->route('bagian.index', $id_modul)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Ubah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        if (!$this->authorCheckBagian($id)) {
            return redirect()->route('main.index');
        }
        
        $bagian = Bagian::find($id);
        $id_modul = $bagian->id_modul;
        
        try {
            $bagian->delete();

            Bagian::where(['id_modul' => $id_modul])->where('posisi', '>', $bagian->posisi)->decrement('posisi');
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => env('APP_DEBUG') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        return redirect()->route('bagian.index', $id_modul)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
