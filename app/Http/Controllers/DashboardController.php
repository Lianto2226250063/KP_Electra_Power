<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

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

        // Pegawai teraktif
        $topEmployee = Invoice::select('id_pegawai', \DB::raw('count(*) as total'))
            ->groupBy('id_pegawai')
            ->orderByDesc('total')
            ->with('pegawai')
            ->first();

        // Data grafik berdasarkan tahun terpilih
        $salesData = Invoice::selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
            ->whereYear('tanggal', $selectedYear)
            ->groupByRaw('MONTH(tanggal)')
            ->pluck('count', 'month');

        $salesChartLabels = [];
        $salesChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesChartLabels[] = \Carbon\Carbon::create()->month($i)->translatedFormat('F');
            $salesChartData[] = $salesData[$i] ?? 0;
        }

        // Ambil daftar tahun yang tersedia dari data invoice
        $availableYears = Invoice::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->toArray();

        // Omzet per bulan (tahun terpilih)
        $salesChartOmzetDataRaw = InvoiceDetail::selectRaw('MONTH(invoices.tanggal) as bulan, SUM(jumlah * harga_satuan) as omzet')
            ->join('invoices', 'invoice_details.id_invoice', '=', 'invoices.id')
            ->whereYear('invoices.tanggal', $selectedYear)
            ->groupBy(\DB::raw('MONTH(invoices.tanggal)'))
            ->pluck('omzet', 'bulan')
            ->toArray();

        // Normalisasi omzet per bulan (isi 0 jika bulan tidak ada data)
        $salesChartOmzetData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesChartOmzetData[] = $salesChartOmzetDataRaw[$i] ?? 0;
        }

        return view('dashboard', [
            'totalInvoice' => $totalInvoice,
            'totalOmzet' => $totalOmzet,
            'monthlyInvoice' => $monthlyInvoice,
            'topEmployee' => $topEmployee?->pegawai?->name,
            'salesChartLabels' => $salesChartLabels,
            'salesChartData' => $salesChartData,
            'salesChartOmzetData' => $salesChartOmzetData, // <- Tambahan ini
            'availableYears' => $availableYears,
            'selectedYear' => $selectedYear,
        ]);
    }
}
