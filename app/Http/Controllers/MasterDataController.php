<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class MasterDataController extends Controller
{
    function dataBarang()
    {
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
        foreach ($content as $line) {
            $data = str_getcsv($line);
            // INSERT
        }
    }
    function dataPerusahaan()
    {
        return Inertia::render('Data/dataPerusahaan');
    }
}
