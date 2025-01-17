<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    private $page;

    public function __construct() {
        $this->page = 20;
    }
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
        DB::beginTransaction();
        try {
            foreach ($content as $line) {
                $data = str_getcsv($line);
                if ($i !== 1) {
                    // INSERT
                    barang::create([
                        'nama' => $data[0],
                        'satuan' => $data[1],
                        'stok' => $data[2],
                        'harga' => $data[3],
                        'hisHarga' => json_encode(isset($data[4]) ?? ''),
                    ]);
                }
                $i++;
            }
            DB::commit();
            return json_encode(['status' => 'success', 'message' => 'Data Berhasilimpan']);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return json_encode(['status' => 'error', 'message' => 'Data Tidak Berhasil disimpan','detail'=>$th->getMessage()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $req)
    {
        $key = $req->key;

        $data = DB::table('barangs')->select(['id', 'nama','satuan', 'stok', 'harga'])->where('nama', 'like', "%$key%")->paginate($this->page);
        return json_encode($data);
    }

    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        $data = DB::table('barangs')->select(['id', 'nama', 'satuan', 'stok', 'harga'])->paginate($this->page);
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
    public function update(Request $request)
    {
        $nama = $request->nama;
        $stok = $request->stok;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $id = $request->idn;

        $barang = barang::find($id);

        $barang->update([
            'nama' => $nama,
            'stok' => $stok,
            'satuan' => $satuan,
            'harga' => $harga,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bulkDelete()
    {
        $data = barang::whereIn('id', request('ids'))->delete();
        // dd($data);
    }
}
