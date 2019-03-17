<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\HakAkses;

class HakAksesController extends Controller
{
    public function index($id_user)
    {
        $user = User::with('hakAkses')->findOrFail($id_user);

        $hakAkses = [];
        foreach ($user->hakAkses as $item) {
            $hakAkses[] = $item->route;
        }

        $data = new \stdClass();
        $data->route_list = $hakAkses;
        $data->last_active_route = session('last_active_route');
        
        return view('hakakses.index', compact(['user', 'data']));
    }

    public function update(Request $request, $id)
    {
        $datas = [];
        foreach ($request->route_list ?: [] as $item) {
            $datas[] = ['id_user' => $id, 'route' => $item];
        }
        
        HakAkses::where(['id_user' => $id])->delete();

        HakAkses::insert($datas);

        return redirect()->route('hakakses.index', $id)->with('last_active_route', $request->last_active_route)
        ->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Ubah Data',
            'class' => 'success',
        ]);
    }
}
