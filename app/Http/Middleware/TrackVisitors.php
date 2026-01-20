<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor; // Jangan lupa import model ini
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah IP ini sudah berkunjung HARI INI
        $ip = $request->ip();
        $today = now()->format('Y-m-d');

        // Jika belum ada data IP ini di hari ini, simpan database
        Visitor::firstOrCreate([
            'ip_address' => $ip,
            'visit_date' => $today
        ]);

        return $next($request);
    }
}