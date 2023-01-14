<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class DownloadService
{
    public $data;

    public $fileName = 'file';

    public function download(Request $request, $data, $fileName)
    {
        $this->data = $data;
        $this->fileName = $fileName;

        try {
            if ($request->type === 'pdf') {
                return $this->downloadPdf($request->date);
            }

            if ($request->type === 'csv') {
                return $this->downloadCsv();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function downloadPdf($date)
    {
        $pdf = PDF::setOptions([
            'dpi' => 150,
            'defaultFont' => 'Inter',
            'fontHeightRatio' => 1,
            'isHtml5ParserEnabled' => true,
            'Attachment' => false,
        ]);

        if ($this->fileName === 'manifest') {
            $pdf->loadView('pdf.manifest', ['data' => $this->data->toArray(), 'date' => $date]);
        } else {
            return back()->with('error', 'No template for this data');
        }

        return $pdf->download($this->fileName.'.pdf');
    }

    public function downloadCsv()
    {
        if ($this->fileName === 'manifest') {
            $sheets = new SheetCollection();

            foreach ($this->data as $sheet) {
                $sheets->push($sheet);
            }

            return (new FastExcel($sheets))->download($this->fileName.'.xlsx');
        } else {
            return (new FastExcel($this->data))->download($this->fileName.'.csv');
        }
    }
}
