<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mahasiswa::select('id', 'npm', 'nama', 'prodi')->get();
    
    }
     /**
     * Define the headings for the Excel sheet.
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'NPM',
            'Nama',
            'Program Studi',
        ];
    }
}
