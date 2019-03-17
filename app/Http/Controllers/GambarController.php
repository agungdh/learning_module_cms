<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Gambar;

use Storage;

class GambarController extends Controller
{

    public function index()
    {
        $gambars = Gambar::all();

        return view('gambar.index', compact(['gambars']));
    }

    public function create()
    {
        return view('gambar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'gambar' => 'required|image|max:10240',
        ]);

        $data = $request->only('deskripsi');

        $id_gambar = Gambar::insertGetId($data);

        $request->file('gambar')->storeAs(
            'public/files/gambar', $id_gambar
        );

        return redirect()->route('gambar.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        $gambar = Gambar::find($id);

        return view('gambar.edit', compact(['gambar']));
    }

    public function update(Request $request, $id)
    {
        $gambar = Gambar::find($id);

        $request->validate([
            'deskripsi' => 'required',
        ]);

        if ($request->gambar) {
            $request->validate([
                'gambar' => 'image|max:10240',
            ]);

            $request->file('gambar')->storeAs(
                'public/files/gambar', $id
            );
        }

        $data = $request->only('deskripsi');

        Gambar::where(['id' => $id])->update($data);


        return redirect()->route('gambar.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        try {
            Gambar::where(['id' => $id])->delete();
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => config('app.debug') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        Storage::delete('public/files/gambar/' . $id);

        return redirect()->route('gambar.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
