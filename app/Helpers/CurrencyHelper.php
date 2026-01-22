<?php

use Illuminate\Support\Facades\App;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

if (!function_exists('formatCurrency')) {
    function formatCurrency($amountInIdr)
    {
        // 1. Ambil Kurs dari Cache/Database (Cache 60 menit biar website tidak berat)
        $rates = Cache::remember('exchange_rates', 60, function () {
            return ExchangeRate::pluck('rate_in_idr', 'currency_code');
        });

        // Ambil nilai kurs (Default jika error/kosong)
        $rateUSD = $rates['USD'] ?? 16000; 
        $rateCNY = $rates['CNY'] ?? 2200;

        // 2. Cek Bahasa
        $locale = App::getLocale();

        // 3. Logika Konversi
        if ($locale == 'en') {
            // Target: USD
            $converted = $amountInIdr / $rateUSD;
            return 'US$ ' . number_format($converted, 2, '.', ',');
        } 
        
        elseif ($locale == 'zh') {
            // Target: CNY (RMB)
            $converted = $amountInIdr / $rateCNY;
            return '¥ ' . number_format($converted, 2, '.', ',');
        }

        // Default: IDR
        return 'Rp ' . number_format($amountInIdr, 0, ',', '.');
    }
}