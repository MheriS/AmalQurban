<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kuponumum;

class KuponUmumController extends Controller
{
    public function index()
    {
        $data = KuponUmum::all(); // Atau sesuaikan query Anda
        return view('kupon-umum.semua', compact('data'));
    }

}
