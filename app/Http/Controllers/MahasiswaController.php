<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.mahasiswa-master.create-mahasiswa");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // validasi input data
         $validasi_data = $request->validate([
            'npm'=> 'required|string|max:55',
            'nama'=> 'required|string|max:255',
            'prodi'=> 'required|string|max:50',
        ]);

        // proses simpan data kedalam database
        Mahasiswa::create($validasi_data);

        return redirect()->back()->with('success', 'Mahasiswa created successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
