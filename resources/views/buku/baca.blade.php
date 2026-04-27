<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Membaca: {{ $pinjaman->book->judul }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        /* Custom scrollbar for immersive feel */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background-color: #3f465c; border-radius: 10px; }
    </style>
</head>
<body class="bg-inverse-surface h-screen w-full overflow-hidden relative flex flex-col font-body-md text-body-md selection:bg-primary-container selection:text-on-primary-container" oncontextmenu="return false;">
    <!-- Serene Background Texture overlay -->
    <div class="absolute inset-0 pointer-events-none opacity-30 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-on-secondary-fixed-variant/20 via-transparent to-transparent z-0"></div>
    
    <!-- Floating Top Display -->
    <header class="absolute top-0 left-0 w-full z-50 flex justify-between items-center px-md py-sm bg-inverse-surface/80 backdrop-blur-md border-b border-on-secondary-fixed-variant/30 opacity-0 hover:opacity-100 focus-within:opacity-100 transition-opacity duration-300 group">
        <!-- Hover indicator for top bar -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-on-secondary-fixed-variant/50 rounded-b-lg group-hover:opacity-0 transition-opacity"></div>
        <a href="{{ route('dashboard') }}" aria-label="Back to Library" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-on-secondary-fixed-variant/50 text-inverse-on-surface transition-colors focus:outline-none focus:ring-2 focus:ring-primary-fixed">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div class="flex flex-col items-center text-center max-w-lg">
            <span class="font-label-caps text-label-caps text-outline-variant uppercase tracking-widest mb-1">{{ $pinjaman->book->genre ?? 'Katalog' }}</span>
            <span class="font-body-md text-body-md text-inverse-on-surface font-semibold truncate w-full">{{ $pinjaman->book->judul }}</span>
        </div>
        <div class="flex items-center gap-sm pr-4">
            <div class="flex flex-col items-end">
                <span class="font-label-caps text-label-caps text-primary-fixed">Sisa Waktu</span>
                <span class="font-label-caps text-label-caps text-inverse-on-surface">{{ \Carbon\Carbon::parse($pinjaman->tanggal_jatuh_tempo)->diffForHumans() }}</span>
            </div>
        </div>
    </header>

    <!-- Main Reading Canvas -->
    <main class="flex-1 overflow-y-auto w-full relative z-10 scroll-smooth">
        <iframe 
            src="{{ route('buku.stream', $pinjaman->book->id) }}#toolbar=0" 
            class="w-full h-full border-none"
            title="E-Book Reader">
        </iframe>
        <div class="absolute inset-0 z-20 pointer-events-none" style="box-shadow: inset 0 0 50px rgba(11,28,48,0.8);"></div>
    </main>

    <script>
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && (e.key === 'p' || e.key === 's' || e.key === 'u')) { e.preventDefault(); }
            if (e.key === 'F12') { e.preventDefault(); }
        });
    </script>
</body>
</html>