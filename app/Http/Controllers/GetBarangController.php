<?php

namespace App\Http\Controllers;

use App\Models\Mbarang;
use Illuminate\Http\Request;

class GetBarangController extends Controller
{
    public function index()
    {
        $data = Mbarang::all();
        return response()->json($data);
    }
}
