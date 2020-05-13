<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AgendaExport implements FromView, WithCustomStartCell, WithColumnFormatting
{

    protected $agendas;

    public function __construct($agendas)
    {
        $this->agendas = $agendas;
    }

    public function view(): View
    {
        return view('excel.agenda', [
            'agenda' => $this->agendas,
        ]);
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
