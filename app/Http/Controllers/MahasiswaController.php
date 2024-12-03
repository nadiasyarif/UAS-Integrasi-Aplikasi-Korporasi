<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if($request->has('search') && $request->search != ''){
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }
        $mahasiswas = $query->paginate(2);
        return view("master-data.mahasiswa-master.index-mahasiswa", compact('mahasiswas'));
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
        $mahasiswas = Mahasiswa::findOrFail($id);
        return view("master-data.mahasiswa-master.detail-mahasiswa", compact('mahasiswas'));
    
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
        $mahasiswas = Mahasiswa::find($id);
        if($mahasiswas){
            $mahasiswas->delete();
            return redirect()->back()->with('success','Mahasiswa Berhasil di Hapus');
        }
        return redirect()->back()->with('error','Mahasiswa TidaK Ditemukan');
    }
}
