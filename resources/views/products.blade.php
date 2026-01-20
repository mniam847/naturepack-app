@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Katalog Kemasan Custom</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Pilih kemasan yang cocok untuk produk Anda.
            </p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-sm mb-8 flex flex-col md:flex-row justify-between items-center">
            
            <div class="w-full md:w-1/3 mb-4 md:mb-0 relative">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Ketik untuk mencari..." 
                    class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                >
                <div id="loading-icon" class="absolute left-3 top-3 hidden">
                    <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
                <div id="search-icon" class="absolute left-3 top-3 text-gray-400">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-gray-600 text-sm">Urutkan:</span>
                <select id="sort-select" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none cursor-pointer">
                    <option value="latest">Terbaru</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="price_high">Harga Tertinggi</option>
                </select>
            </div>
        </div>

        <div id="product-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('partials.products_grid')
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let timeout = null; // Variabel untuk delay

        // Fungsi utama pencarian
        function fetchProducts() {
            let search = $('#search-input').val();
            let sort = $('#sort-select').val();

            // Tampilkan loading, sembunyikan ikon search
            $('#loading-icon').removeClass('hidden');
            $('#search-icon').addClass('hidden');

            $.ajax({
                url: "{{ route('products.index') }}",
                method: "GET",
                data: { search: search, sort: sort },
                success: function(response) {
                    // Ganti isi container dengan HTML baru dari controller
                    $('#product-container').html(response);
                    
                    // Sembunyikan loading
                    $('#loading-icon').addClass('hidden');
                    $('#search-icon').removeClass('hidden');
                },
                error: function() {
                    alert('Terjadi kesalahan koneksi.');
                    $('#loading-icon').addClass('hidden');
                    $('#search-icon').removeClass('hidden');
                }
            });
        }

        // Event saat mengetik (pakai delay 500ms agar tidak spam server)
        $('#search-input').on('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                fetchProducts();
            }, 500); 
        });

        // Event saat ganti sorting (Langsung eksekusi)
        $('#sort-select').on('change', function() {
            fetchProducts();
        });
    });
</script>
@endsection