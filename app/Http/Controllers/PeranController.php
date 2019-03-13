<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Peran;
use App\Models\HakAkses;

class PeranController extends Controller
{
    public function sync($id)
    {
        $peran = Peran::with('hakAksesPerans', 'users')->find($id);
        
        $datas = [];
        $userId = [];
        foreach ($peran->users as $user) {
            $userId[] = $user->id;
            foreach ($peran->hakAksesPerans as $hakAksesPeran) {
                $datas[] = ['id_user' => $user->id, 'route' => $hakAksesPeran->route];
            }   
        }

        HakAkses::whereIn('id_user', $userId)->delete();
        HakAkses::insert($datas);

        return redirect()->route('peran.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Sinkronisasi Data',
            'class' => 'success',
        ]);
    }

    public function index()
    {
        $perans = Peran::all();

        return view('peran.index', compact(['perans']));
    }

    public function create()
    {
        return view('peran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'peran' => 'required|unique:peran,peran',
        ]);

        $data = $request->only('peran');

        Peran::create($data);

        return redirect()->route('peran.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        $peran = Peran::find($id);

        return view('peran.edit', compact(['peran']));
    }

    public function update(Request $request, $id)
    {
        $peran = Peran::find($id);

        $request->validate([
            'peran' => 'required',
        ]);

        if ($peran->peran != $request->peran) {
            $request->validate([
                'peran' => 'unique:peran,peran',
            ]);
        }

        $data = $request->only('peran');

        Peran::where(['id' => $id])->update($data);

        return redirect()->route('peran.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        try {
            Peran::where(['id' => $id])->delete();
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => env('APP_DEBUG') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        return redirect()->route('peran.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
