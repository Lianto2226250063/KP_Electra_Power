<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    @php
    $subtotal = 0;
    @endphp
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            /* border: 1px solid #eee; */
        }

        .logo {
            width: 400px;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 5px;
            vertical-align: top;
        }

        .heading {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
            font-size: 25px;
            text-decoration: underline;
        }

        .bordered th, .bordered td {
            border: 1px solid #000;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .note {
            font-style: italic;
            margin-top: 30px;
            font-size: 12px;
        }

        .no-print {
            display: block;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

    </style>
</head>
<body>
@php
    $isPdf = request()->is('invoice/print/*') || request()->is('invoice/download/*');

    $logoSrc = $isPdf 
        ? public_path('images/ElectraPower.png') 
        : asset('images/ElectraPower.png');

    $ttdSrc = $isPdf 
        ? public_path('storage/' . $invoice->pegawai->ttd)
        : asset('storage/' . $invoice->pegawai->ttd);
@endphp
@if (!$isPdf)
<div class="no-print" style="text-align: right; margin-bottom: 20px;">
    <a href="{{ route('dashboard') }}" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px; margin-right: 10px;">Home</a>
    <button onclick="window.print()" style="padding: 10px 20px; background-color: #28a745; color: #fff; border: none; border-radius: 5px;">Print</button>
</div>
@endif
<div class="invoice-box">

    <img src="{{ $logoSrc }}" class="logo" alt="Logo">
    <div class="heading">INVOICE</div>

    <table>
        <tr>
            <td>Nomor: <strong>{{ $invoice->nomor }}</strong></td>
            <td class="text-right">Palembang, {{ \Carbon\Carbon::parse($invoice->tanggal)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Kepada: <strong>{{ $invoice->kepada }}</strong></td>
        </tr>
    </table>

    <br>

    <table class="bordered">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th>Keterangan</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td class="text-center">{{ $item->jumlah }} {{ $item->satuan }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</td>
                </tr>
                @php
                    $subtotal = $subtotal + $item->harga_satuan * $item->jumlah;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>SUB TOTAL</strong></td>
                <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>PPN 11%</strong></td>
                <td class="text-right">Rp {{ number_format($subtotal * 0.11, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($subtotal + $subtotal * 0.11, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

        <div class="note">
            Terbilang: <em>{{ ucwords($terbilang) }} Rupiah</em>
        </div>    

        <br><br>

        <table>
        <tr>
            <td class="text-right " colspan="5"><div style="padding-right: 20px">Hormat kami,</div></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <img src="{{ $ttdSrc }}" alt="TTD" style="height:100px; width:150px;">
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="5"><strong>{{ $invoice->pegawai->name }}</strong></td>
        </tr>
    </table>
</div>
</body>
</html>
