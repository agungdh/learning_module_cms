<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Modul;
use App\Models\User;
use App\Models\Bagian;

use ADHhelper;

class BagianController extends Controller
{

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
            'message' => 'Berhasil Tambah Data',
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
        $bagian->delete();

        return redirect()->route('bagian.index', $id_modul)->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}