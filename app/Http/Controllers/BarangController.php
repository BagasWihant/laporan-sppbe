<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = barang::onl()->paginate(10);
        // $data = $this->showAll();
        // $data = DB::table('barangs')->paginate(10);
        
        return Inertia::render('Data/dataBarang');
    }

    function uploadDataBarang(Request $req)
    {
        $req->validate([
            'file' => [
                'required', 'mimes:csv,txt',
            ]
        ]);

        $csv = $req->file('file');
        $content = file($csv->getPathname());
        $i = 1;
        foreach ($content as $line) {
            $data = str_getcsv($line);
            if ($i !== 1) {
                // INSERT
                barang::create([
                    'nama' => $data[0],
                    'satuan' => $data[1],
                    'stok' => $data[2],
                    'harga' => $data[3],
                    'hisHarga' => json_encode($data[4]),
                ]);
            }
            $i++;
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $req)
    {
        $key = $req->key;
        $data = DB::table('barangs')->select(['nama','satuan','stok','harga'])->where('nama','like',$key)->paginate(10);
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        $data = DB::table('barangs')->select(['nama','satuan','stok','harga'])->paginate(15);
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(barang $barang)
    {
        //
    }
}
