<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //]]$myName = "Didik";
        //return view('pasien_index', compact('myName')); //nama file view tanpa .blade.php
        
        $data['pasien'] = \App\Models\Pasien::latest()->paginate(10);
        return view('pasien_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*$data['nama'] = "budi";
        $data['umur'] = 20;
        $data['hobi'] = "makan";
        return view('pasien_create_index', $data); */
        return view('pasien_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien',
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $pasien = new \App\Models\Pasien(); //membuat objek kosong di variabel model
        $pasien->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData
        $pasien->foto = $request->file('foto')->store('public');
        $pasien->save(); //menyimpan data ke database
        flash('Data sudah disimpan')->success();
        return back()->with('pesan', 'Horee.. Data sudah disimpan');
            //mengarahkan user ke url sebelumnya yaitu /pasien/create dengan membawa variabel pesan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //]]$myName = "Didik";
        //return view('pasien_index', compact('myName')); //nama file view tanpa .blade.php
        $data['pasien'] = \App\Models\Pasien::findOrFail($id);
        return view('pasien_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien' . $id,
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $pasien = \App\Models\Pasien::findOrFail($id); 
        $pasien->fill($requestData);
        if ($request->hasFile('foto')) {
            Storage::delete($pasien->foto);
            $pasien->foto = $request->file('foto')->store('public');
        }
        $pasien->save(); //menyimpan data ke database
        flash('Data sudah disimpan')->success();
        return back()->with('pesan', 'Horee.. Data sudah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = \App\Models\Pasien::findOrFail($id);
        if ($pasien->daftar->count() > 0) {
        flash('Data tidak bisa dihapus karena sudah ada data pendaftaran')->error();
        return back();
        }
        if ($pasien->foto != null && Storage::exists($pasien->foto)) {
        Storage::delete($pasien->foto);
        }
        $pasien->delete();
        flash('Data sudah dihapus')->success();
        return back();
    }
}
