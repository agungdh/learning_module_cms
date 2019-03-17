<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Peran;
use App\Models\HakAksesPeran;

class HakAksesPeranController extends Controller
{
    public function index($id_peran)
    {
        $peran = Peran::with('hakAksesPerans')->findOrFail($id_peran);

        $hakAksesPerans = [];
        foreach ($peran->hakAksesPerans as $item) {
            $hakAksesPerans[] = $item->route;
        }

        $data = new \stdClass();
        $data->route_list = $hakAksesPerans;
        $data->last_active_route = session('last_active_route');
        
        return view('hakaksesperan.index', compact(['peran', 'data']));
    }

    public function update(Request $request, $id)
    {
        $datas = [];
        foreach ($request->route_list ?: [] as $item) {
            $datas[] = ['id_peran' => $id, 'route' => $item];
        }
        
        HakAksesPeran::where(['id_peran' => $id])->delete();

        HakAksesPeran::insert($datas);

        return redirect()->route('hakaksesperan.index', $id)->with('last_active_route', $request->last_active_route)
        ->with('alert', [
            'title' => 'BERHASIL !!!',
            'message' => 'Berhasil Ubah Data',
            'class' => 'success',
        ]);
    }
}
