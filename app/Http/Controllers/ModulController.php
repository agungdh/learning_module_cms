<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Modul;
use App\Models\User;

use ADHhelper;

class ModulController extends Controller
{

    private function authorCheck($id)
    {
        $modul = Modul::find($id);

        if ($modul && $modul->id_user == session('userID')) {
            return true;
        }
    }

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
        if (!$this->authorCheck($id)) {
            abort(404);
        }

        $modul = Modul::find($id);

        return view('modul.edit', compact(['modul']));
    }

    public function update(Request $request, $id)
    {
        if (!$this->authorCheck($id)) {
            abort(404);
        }
        
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
        if (!$this->authorCheck($id)) {
            abort(404);
        }
     
        try {
            Modul::where(['id' => $id])->delete();   
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => env('APP_DEBUG') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        return redirect()->route('modul.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
