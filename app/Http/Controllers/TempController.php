<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ADHhelper;

use App\Models\HakAkses;

class TempController extends Controller
{

    public function index()
    {
        abort(400);
        $result = ADHhelper::authCan('menu.index');

        // $result = HakAkses::where(['id_user' => 1, 'route' => 'menu.create'])->first();
        
        // $result = ADHhelper::checkRouteForMenu('menu.edit');

        if ($result) {
            return "yeah";
        } else {
            return "nope";
        }

        // return response()->download(storage_path('app/public/files/template/Template Import Barang.xlsx'));

        // return view('temp.index');
    }

    public function sendData(Request $request)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadsheet = $reader->load($request->data);
     
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = [];
        foreach ($worksheet->getRowIterator() AS $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            $cells = [];
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        $rows = array_slice($rows, 3);
        
        $datas = [];
        foreach ($rows as $row) {
            $datas[] = [
                'nama' => $row[0],
                'harga_beli' => $row[1],
                'harga_jual' => $row[2],
            ];
        }

        \DB::table('barang')->insert($datas);
    }

}