<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MasterDataController extends Controller
{
    function dataBarang() {
        return Inertia::render('Data/dataBarang');
    }
    function dataPerusahaan() {
        return Inertia::render('Data/dataPerusahaan');
    }
}
