<?php

namespace App\Http\Controllers;

use PDF;
use iio\libmergepdf\Merger;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function attributePDF()
    {
        $data = [
            'title' => 'Data Attributes',
            'current_date_time' => now()->format('Y-m-d H:i:s') // Menambahkan tanggal dan waktu saat ini
        ];
        $attributes = \App\Models\Attribute::all();
        // Mengganti spasi dan karakter tidak valid dengan underscore
        $formatted_date_time = str_replace([' ', ':'], '_', $data['current_date_time']);
        // Membuat nama file
        $file_name = 'attribute_' . $formatted_date_time . '.pdf';
        $pdf = PDF::loadView('pdf.attribute', compact('data', 'attributes'));
        return $pdf->download($file_name);
    }

    public function datapointPDF()
    {
        $data = [
            'title' => 'Data Datapoint',
            'current_date_time' => now()->format('Y-m-d H:i:s') // Menambahkan tanggal dan waktu saat ini
        ];
        $datapoints  = \App\Models\Datapoint::all();
        $attributes = \App\Models\Attribute::all();
        // Mengganti spasi dan karakter tidak valid dengan underscore
        $formatted_date_time = str_replace([' ', ':'], '_', $data['current_date_time']);
        // Membuat nama file
        $file_name = 'datapoint_' . $formatted_date_time . '.pdf';
        $pdf = PDF::loadView('pdf.datapoint', compact('data', 'datapoints', 'attributes'));
        return $pdf->download($file_name);
    }

    public function lanscapePdfTest()
    {
        $data = [
            'title' => 'Data Datapoint',
            'current_date_time' => now()->format('Y-m-d H:i:s')
        ];
        $datapoints  = \App\Models\Datapoint::all();
        $attributes = \App\Models\Attribute::all();

        $m = new Merger();

        // PDF dengan orientasi landscape
        $pdf2 = PDF::loadView('pdf.datapoint', compact('data', 'datapoints', 'attributes'))->setPaper('a4', 'landscape');
        $m->addRaw($pdf2->output());

        // Membuat nama file
        $formatted_date_time = str_replace([' ', ':'], '_', $data['current_date_time']);
        $file_name = 'datapoint_' . $formatted_date_time . '.pdf';

        return response($m->merge())
            ->withHeaders([
                'Content-Type' => 'application/pdf',
                'Cache-Control' => 'no-store, no-cache',
                'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
            ]);
    }
}
