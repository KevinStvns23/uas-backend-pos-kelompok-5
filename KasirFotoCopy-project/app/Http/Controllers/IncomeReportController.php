<?php
namespace App\Http\Controllers;
use App\Models\IncomeReport;
use Illuminate\Http\Request;

class IncomeReportController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari database
        $incomes = IncomeReport::all();
        // Melempar data ke tampilan HTML (View)
        return view('reports.income', compact('incomes'));
    }
}