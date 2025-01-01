<?php

namespace App\Exports;

use App\Models\Datapoint;
use App\Models\Attribute;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\FromCollection;

class DatapointExport implements FromView
{
    public function view(): View
    {
        $data = [
            'title' => 'Data Datapoint',
            'current_date_time' => now()->format('Y-m-d H:i:s')
        ];
        $datapoints = Datapoint::with('attributes')->get();
        $attributes = Attribute::all();

        return view('excel.datapoint', compact('data', 'datapoints', 'attributes'));
    }
}
