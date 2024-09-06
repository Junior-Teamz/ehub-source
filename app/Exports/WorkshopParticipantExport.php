<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WorkshopParticipantExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $list;
    protected $workshop;

    public function __construct($list, $workshop)
    {
        $this->list = $list;
        $this->workshop = $workshop;
    }

    public function view(): View
    {
        return view('dashboard.workshops.participant-download', [
            'participants' => $this->list,
            'workshop' => $this->workshop
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true, 
                    'size' => 16
                ]
            ],
        ];
    }
}
