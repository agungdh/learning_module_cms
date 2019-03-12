<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Modul;

use ADHhelper;

class ModulController extends Controller
{
 
    public function index()
    {
        $moduls = Modul::where(['id_user' => session('userID')])->get();

        return view('modul.index', compact(['moduls']));
    }

    public function create()
    {
        return view('modul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modul' => 'required',
        ]);

        $data = $request->only('modul');
        $data['id_user'] = session('userID');

        Modul::create($data);

        return redirect()->route('modul.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        $modul = Modul::find($id);

        return view('modul.edit', compact(['modul']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modul' => 'required',
        ]);

        $data = $request->only('modul');

        Modul::where(['id' => $id])->update($data);

        return redirect()->route('modul.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        Modul::where(['id' => $id])->delete();

        return redirect()->route('modul.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
