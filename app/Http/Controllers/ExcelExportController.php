<?php

namespace App\Http\Controllers;

use App\Exports\AttributeExport;
use App\Exports\DatapointExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    public function export()
    {
        return Excel::download(new AttributeExport, 'attribute.xlsx');
    }

    public function exportDatapoint()
    {
        return Excel::download(new DatapointExport, 'datapoint.xlsx');
    }
}
