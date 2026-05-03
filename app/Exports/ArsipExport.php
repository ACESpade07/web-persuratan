<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArsipExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item, $index) {
            return [
                'No'             => $index + 1,
                'Nomor Surat'    => $item->nomor_surat,
                'Jenis'          => $item->jenis,
                'Pengirim/Tujuan'=> $item->kontak,
                'Perihal'        => $item->perihal,
                'Tanggal'        => $item->tanggal_surat,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nomor Surat', 'Jenis', 'Pengirim / Tujuan', 'Perihal', 'Tanggal'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}