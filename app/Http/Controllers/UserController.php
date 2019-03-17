<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\HakAkses;
use App\Models\Peran;

use Hash;

class UserController extends Controller
{
    public function sync($id)
    {
        $peran = User::with('hakAksesPerans', 'users')->find($id);
        
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

        return redirect()->route('user.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Sinkronisasi Data',
            'class' => 'success',
        ]);
    }

    public function index()
    {
        $users = User::with('peran')->where('id', '!=', session('userID'))->get();

        return view('user.index', compact(['users']));
    }

    public function create()
    {
        $perans_raw = Peran::all();

        $perans = [];
        foreach ($perans_raw as $item) {
            $perans[$item->id] = $item->peran;
        }

        return view('user.create', compact(['perans']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user,username',
            'nama' => 'required',
            'id_peran' => 'required',
            'password' => 'required|confirmed',
        ]);

        $data = $request->only('username', 'nama', 'id_peran');
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Tambah Data',
            'class' => 'success',
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        $perans_raw = Peran::all();

        $perans = [];
        foreach ($perans_raw as $item) {
            $perans[$item->id] = $item->peran;
        }

        return view('user.edit', compact(['user', 'perans']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'id_peran' => 'required',
            'password' => 'confirmed',
        ]);

        $data = $request->only('nama', 'id_peran');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::where(['id' => $id])->update($data);

        return redirect()->route('user.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Ubah Data',
            'class' => 'success',
        ]);        
    }

    public function destroy($id)
    {
        try {
            User::where(['id' => $id])->delete();
        } catch (QueryException $exception) {
            return redirect()->back()->with('alert', [
                'title' => 'ERROR !!!',
                'message' => env('APP_DEBUG') ? $exception->getMessage() : 'Something Went Wrong !!!',
                'class' => 'error',
            ]);        
        }

        return redirect()->route('user.index')->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Hapus Data',
            'class' => 'success',
        ]);        
    }
}
