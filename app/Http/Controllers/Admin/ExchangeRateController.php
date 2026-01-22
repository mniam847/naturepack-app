<?php

namespace App\Http\Controllers\Admin; // <--- PASTIKAN ADA KATA "Admin" DISINI

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

class ExchangeRateController extends Controller
{
    public function index()
    {
        // Ambil semua data kurs
        $rates = ExchangeRate::all();
        return view('admin.settings.rates', compact('rates'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'rates' => 'required|array',
            'rates.*' => 'required|numeric|min:1'
        ]);

        foreach ($request->rates as $code => $value) {
            // Update data ke database
            ExchangeRate::where('currency_code', $code)->update(['rate_in_idr' => $value]);
        }

        // Hapus cache agar harga di web langsung berubah
        Cache::forget('exchange_rates');

        return back()->with('success', 'Nilai tukar mata uang berhasil diperbarui!');
    }
}