<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\LaporanRab;
use Illuminate\Http\Request;

class LaporanRabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('RAB/index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('RAB/create');
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
    public function show(LaporanRab $laporanRab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanRab $laporanRab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanRab $laporanRab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanRab $laporanRab)
    {
        //
    }
}
