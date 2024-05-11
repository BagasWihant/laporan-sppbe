<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
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
        return Inertia::render('Data/dataPerusahaan');
    }
    public function showAll()
    {
        $data = DB::table('perusahaans')->select(['id', 'nama', 'alamat', 'pemilik'])->paginate($this->page);
        return json_encode($data);
    }

    public function search(Request $req)
    {
        $key = $req->key;

        $data = DB::table('perusahaans')->select(['id', 'nama', 'alamat', 'pemilik'])->where('nama', 'like', "%$key%")->paginate($this->page);
        return json_encode($data);
    }
   
    public function bulkDelete()
    {
        $data = perusahaan::whereIn('id', request('ids'))->delete();
        // dd($data);
    }
    /**
     * Display the specified resource.
     */
    public function show(perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, perusahaan $perusahaan)
    {
        $nama = $request->nama;
        $pemilik = $request->pemilik;
        $alamat = $request->alamat;
        $id = $request->idn;

        DB::table('perusahaans')->where('id', $id)->update([
            'nama' => $nama,
            'pemilik' => $pemilik,
            'alamat' => $alamat
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(perusahaan $perusahaan)
    {
        //
    }
}
