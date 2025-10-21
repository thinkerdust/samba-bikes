<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PesertaExport implements ShouldAutoSize, FromCollection, WithHeadings, WithMapping
{
    protected $event;
    private $no = 0;

    public function __construct($event)
    {
        $this->event     = $event;
    }

    public function collection()
    {
        return Peserta::select(
                'peserta.nama',
                DB::raw("IFNULL(peserta.nama_komunitas, komunitas.nama) as komunitas"),
                'peserta.gender',
                'peserta.size_jersey'
            )
            ->leftJoin('komunitas', 'komunitas.id', '=', 'peserta.id_komunitas')
            ->join('event', 'event.id', '=', 'peserta.id_event')
            ->join('order', 'order.id_event', '=', 'event.id')
            ->join('order_detail', function($join) {
                $join->on('order_detail.nomor_order', '=', 'order.nomor')
                    ->on('order_detail.id_peserta', '=', 'peserta.id');
            })
            ->where('order.status', 2)
            ->where('peserta.status', 1)
            ->where('peserta.id_event', $this->event)
            ->get();
    }

    public function headings(): array
    {
        return ['NO', 'NAMA', 'KOMUNITAS', 'GENDER', 'JERSEY'];
    }

    public function map($row): array
    {
        return [
            ++$this->no,
            Str::upper($row->nama),
            Str::upper($row->komunitas) ?? '',
            $row->gender == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN',
            $row->size_jersey,
        ];
    }
}