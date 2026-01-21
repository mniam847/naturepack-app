<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Visitor; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // KEMBALI MENGGUNAKAN NAMA 'dashboard' (Agar cocok dengan Route Anda)
    public function dashboard()
    {
        // 1. INI PERBAIKANNYA: Ambil data orders agar tidak 'Undefined variable'
        $orders = Order::with('product')->latest()->get();

        // 2. LOGIKA STATISTIK (Tetap seperti semula)
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Menunggu Konfirmasi')->count();
        $completedOrders = Order::where('status', 'Selesai')->count();

        // 3. LOGIKA PENGUNJUNG
        $todayVisitors = 0;
        $totalVisitors = 0;
        try {
            $todayVisitors = Visitor::where('visit_date', now()->format('Y-m-d'))->count();
            $totalVisitors = Visitor::count();
        } catch (\Exception $e) {
            // Abaikan error visitor jika tabel belum ada
        }

        // 4. KIRIM DATA KE VIEW
        // Pastikan 'orders' ada di dalam kurung compact!
        return view('admin.dashboard', compact(
            'orders', 
            'totalOrders', 
            'pendingOrders', 
            'completedOrders',
            'todayVisitors', 
            'totalVisitors'
        ));
    }

    // --- FUNCTION LAINNYA BIARKAN TETAP SAMA ---

    public function products()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    public function orders()
    {
        $orders = Order::with('product')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', 
        ]);

        return redirect()->back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah!']);
        }

        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function exportOrders()
    {
        // Nama file dengan timestamp
        $fileName = 'full-data-pesanan-' . date('Y-m-d_H-i') . '.xls';
        
        // Ambil semua data, urutkan dari yang terbaru
        $orders = Order::with('product')->orderBy('created_at', 'desc')->get();

        // Header agar browser mendownload sebagai file Excel
        $headers = [
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($orders) {
            $file = fopen('php://output', 'w');

            // --- BAGIAN STYLE & HTML ---
            $html = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
            $html .= '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
            $html .= '<body>';
            // CSS agar tabel bergaris hitam tipis
            $html .= '<style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #000000; padding: 8px; vertical-align: top; }
                        th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
                      </style>';
            
            $html .= '<table>';
            
            // --- JUDUL KOLOM (HEADER) ---
            // Sesuai urutan kolom di Database Anda
            $html .= '<tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>Tanggal Dibuat</th>
                        <th>Terakhir Diupdate</th>
                        <th>Produk</th>
                        <th>Nama Pelanggan</th>
                        <th>WhatsApp</th>
                        <th>Email</th>
                        <th>Qty</th>
                        <th>Panjang (cm)</th>
                        <th>Lebar (cm)</th>
                        <th>Tinggi (cm)</th>
                        <th>Bahan (Material)</th>
                        <th>Catatan (Notes)</th>
                        <th>File Desain</th>
                        <th>Status</th>
                      </tr>';

            // --- ISI DATA (LOOPING) ---
            $no = 1;
            foreach ($orders as $order) {
                // Format Tanggal
                $createdAt = $order->created_at ? $order->created_at->format('d/m/Y H:i:s') : '-';
                $updatedAt = $order->updated_at ? $order->updated_at->format('d/m/Y H:i:s') : '-';

                // Trik agar Nomor WA dibaca Teks (0 tidak hilang)
                $wa = $order->customer_whatsapp;

                // Warna Status (Opsional, biar cantik)
                $bgStatus = '#ffffff';
                if($order->status == 'Menunggu Konfirmasi') $bgStatus = '#fff3cd'; // Kuning
                if($order->status == 'Diproses') $bgStatus = '#cff4fc'; // Biru Muda
                if($order->status == 'Selesai') $bgStatus = '#d1e7dd'; // Hijau
                if($order->status == 'Dibatalkan') $bgStatus = '#f8d7da'; // Merah

                $html .= '<tr>';
                $html .= '<td style="text-align:center;">' . $no++ . '</td>';
                $html .= '<td style="text-align:center;">' . $order->id . '</td>';
                $html .= '<td>' . $createdAt . '</td>';
                $html .= '<td>' . $updatedAt . '</td>';
                
                // Produk
                $productName = $order->product ? $order->product->name : 'Produk Terhapus (ID: '.$order->product_id.')';
                $html .= '<td>' . $productName . '</td>';

                $html .= '<td>' . $order->customer_name . '</td>';
                
                // Kolom WA dengan format text
                $html .= '<td style="mso-number-format:\'\@\'">' . $wa . '</td>'; 
                
                $html .= '<td>' . ($order->email ?? '-') . '</td>';
                $html .= '<td style="text-align:center;">' . $order->quantity . '</td>';
                $html .= '<td style="text-align:center;">' . $order->length . '</td>';
                $html .= '<td style="text-align:center;">' . $order->width . '</td>';
                $html .= '<td style="text-align:center;">' . $order->height . '</td>';
                $html .= '<td>' . $order->material . '</td>';
                $html .= '<td>' . ($order->notes ?? '-') . '</td>';
                $html .= '<td>' . ($order->design_file ?? 'Tidak ada file') . '</td>';
                
                // Status dengan warna
                $html .= '<td style="background-color:'.$bgStatus.'; font-weight:bold;">' . $order->status . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table></body></html>';

            fwrite($file, $html);
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}