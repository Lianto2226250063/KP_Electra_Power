<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', now()->year);

        $totalInvoice = Invoice::count();

        $totalOmzet = InvoiceDetail::selectRaw('SUM(harga_satuan * jumlah) as total')->value('total');

        $monthlyInvoice = Invoice::whereYear('tanggal', now()->year)
                                ->whereMonth('tanggal', now()->month)
                                ->count();

        $topEmployee = Invoice::select('id_pegawai', DB::raw('count(*) as total'))
            ->groupBy('id_pegawai')
            ->orderByDesc('total')
            ->with('pegawai')
            ->first();

        $salesData = Invoice::selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
            ->whereYear('tanggal', $selectedYear)
            ->groupByRaw('MONTH(tanggal)')
            ->pluck('count', 'month');

        $salesChartLabels = [];
        $salesChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesChartLabels[] = Carbon::create()->month($i)->translatedFormat('F');
            $salesChartData[] = $salesData[$i] ?? 0;
        }

        $availableYears = Invoice::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        $salesChartOmzetDataRaw = InvoiceDetail::selectRaw('MONTH(invoices.tanggal) as bulan, SUM(jumlah * harga_satuan) as omzet')
            ->join('invoices', 'invoice_details.id_invoice', '=', 'invoices.id')
            ->whereYear('invoices.tanggal', $selectedYear)
            ->groupBy(DB::raw('MONTH(invoices.tanggal)'))
            ->pluck('omzet', 'bulan')
            ->toArray();

        $salesChartOmzetData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesChartOmzetData[] = $salesChartOmzetDataRaw[$i] ?? 0;
        }

        $rawCustomerData = Invoice::select(
                DB::raw('MONTH(tanggal) as month'),
                'kepada',
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('kepada', DB::raw('MONTH(tanggal)'))
            ->get();

        $customerInvoiceFrequencyData = [];
        foreach ($rawCustomerData as $row) {
            $customer = $row->kepada;
            $monthIndex = $row->month - 1;
            if (!isset($customerInvoiceFrequencyData[$customer])) {
                $customerInvoiceFrequencyData[$customer] = array_fill(0, 12, 0);
            }
            $customerInvoiceFrequencyData[$customer][$monthIndex] = $row->total;
        }

        return view('dashboard', [
            'totalInvoice' => $totalInvoice,
            'totalOmzet' => $totalOmzet,
            'monthlyInvoice' => $monthlyInvoice,
            'topEmployee' => $topEmployee?->pegawai?->name,
            'salesChartLabels' => $salesChartLabels,
            'salesChartData' => $salesChartData,
            'salesChartOmzetData' => $salesChartOmzetData,
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
            'customerInvoiceFrequencyData' => $customerInvoiceFrequencyData,
        ]);
    }
}
