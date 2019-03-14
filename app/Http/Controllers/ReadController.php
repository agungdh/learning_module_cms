<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\Modul;
use App\Models\Bagian;

use ADHhelper;

class ReadController extends Controller
{

    public function index($id)
    {
        $modul = Modul::findOrFail($id);

        return view('read.index', compact(['modul']));
    }

    public function read($id_modul, $posisi_bagian, $posisi_subbagian)
    {
        $modul = Modul::findOrFail($id_modul);
        $bagian = Bagian::where(['id_modul' => $id_modul, 'posisi' => $posisi_bagian])->firstOrFail();
        $subbagian = Bagian::where(['parent_id' => $bagian->id, 'posisi' => $posisi_subbagian])->firstOrFail();

        return view('read.read', compact(['modul', 'bagian', 'subbagian']));
    }
}
