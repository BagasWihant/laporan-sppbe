<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Master/Barang/Index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }

    public function showAll(Request $request)
    {
        // $start = isset($request->originalEvent['first']) ? $request->originalEvent['first'] : $request->first;
        // $offset = isset($request->originalEvent['rows']) ? $request->originalEvent['rows'] : $request->rows;
        $totalData = 0;
        if($request->all() !== []){
            $start = $request->originalEvent['first'] ?? $request->first;
            $limit = $request->originalEvent['rows'] ?? $request->rows;
            $search = $request->filters['nama']['value'] ;
            $data = DB::table('barangs')->select(['id', 'nama', 'satuan', 'stok', 'harga'])->offset($start)->limit($limit)
            ->when($search !== null, function ($query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%');
            })->get();
            $totalData = DB::table('barangs')->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%'.$search.'%');
            })->count();
        }else{
            $data = DB::table('barangs')->select(['id', 'nama', 'satuan', 'stok', 'harga'])->get();
        }
        return response()->json([
            'totalRecords' => $totalData,
            'data' => $data
        ]);
    }
}
