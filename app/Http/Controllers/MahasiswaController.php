<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportExcel ()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function exportToPDF()
    {
        // Ambil data dari kelas export
        $export = new MahasiswaExport();
        $mahasiswas = $export->collection(); // Mengambil koleksi data produk

        // Buat HTML langsung dari data
        $html = '<h1>Mahasiswa List</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>
                    <tr>
                        <th>ID</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';
        foreach ($mahasiswas as $mahasiswa) {
            $html .= '<tr>
                        <td>' . $mahasiswa->id . '</td>
                        <td>' . $mahasiswa->npm . '</td>
                        <td>' . $mahasiswa->nama . '</td>
                        <td>' . $mahasiswa->prodi . '</td>
                      </tr>';
        }
        $html .= '</tbody></table>';

        // Buat PDF dari HTML
        $pdf = Pdf::loadHTML($html);

        // Download PDF
        return $pdf->download('mahasiswa.pdf');
    }
}
