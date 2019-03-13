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

    public function read($id_modul, $id_bagian, $id_subbagian)
    {
        $modul = Modul::findOrFail($id_modul);
        $bagian = Bagian::findOrFail($id_bagian);
        $subbagian = Bagian::findOrFail($id_subbagian);

        return view('read.read', compact(['modul', 'bagian', 'subbagian']));
    }
}
