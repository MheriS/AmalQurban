<?php

namespace App\Http\Controllers;

use App\Models\Kuponumum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KuponumumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kuponumums = Kuponumum::paginate(10); //nyambung ke model
        // dd($kupons); // <--- debug: tampilkan isi data
        // dd(Kuponumum::first());
        return view('kuponumum.kuponumum', compact('kuponumums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kuponumum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wilayah' => 'required',
            'jatah' => 'required',
            'jenis_daging' => 'required',
            'jumlah_kupon' => 'required|integer|min:1',
        ]);

        function generateNoKupon($length = 12) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $kupon = '';
            for ($i = 0; $i < $length; $i++) {
                $kupon .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $kupon;
        }

        for ($i = 0; $i < $request->jumlah_kupon; $i++) {
            // Pastikan no_kupon unik
            do {
                $no_kupon = generateNoKupon();
            } while (Kuponumum::where('no_kupon', $no_kupon)->exists());

            Kuponumum::create([
                'no_kupon' => $no_kupon,
                'wilayah' => $request->wilayah,
                'jatah' => $request->jatah,
                'jenis_daging' => $request->jenis_daging,
                'status' => 'Belum Scan',
            ]);
        }

        return redirect()->route('kuponumum.index')->with('success', $request->jumlah_kupon . ' kupon berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kuponumum $kuponumum)
    {
        return view('kuponumum.show', compact('kuponumum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kuponumum $kuponumum)
    {
        return view('kuponumum.edit', compact('kuponumum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kuponumum $kuponumum)
    {
        $request->validate([
            // 'no_kupon' tidak divalidasi karena tidak bisa diubah
            'wilayah' => 'required',
            'jatah' => 'required',
            'jenis_daging' => 'required',
        ]);

        // Ambil hanya field yang boleh diupdate
        $data = $request->only(['wilayah', 'jatah', 'jenis_daging']);

        $kuponumum->update($data);

        return redirect()->route('kuponumum.index')->with('success', 'Kupon berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kuponumum $kuponumum)
    {
        $kuponumum->delete();
        return redirect()->route('kuponumum.index')->with('success', 'Kupon berhasil dihapus');
    }

    public function belumScan()
    {
        $kuponumums = Kuponumum::where('status', 'Belum Scan')->paginate(10);
        return view('kuponumum.kuponumum', compact('kuponumums'));
    }

    public function sudahScan()
    {
        $kuponumums = Kuponumum::where('status', 'Sudah Scan')->paginate(10);
        return view('kuponumum.kuponumum', compact('kuponumums'));
    }

}