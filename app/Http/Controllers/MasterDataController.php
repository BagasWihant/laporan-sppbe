<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class MasterDataController extends Controller
{
    
    function dataPerusahaan()
    {
        return Inertia::render('Data/dataPerusahaan');
    }
}
