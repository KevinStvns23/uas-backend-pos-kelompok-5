<?php
namespace App\Http\Controllers;
use App\Models\StockReport;
use Illuminate\Http\Request;

class StockReportController extends Controller
{
    public function index()
    {
        $stocks = StockReport::all();
        return view('reports.stock', compact('stocks'));
    }
}