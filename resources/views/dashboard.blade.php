<x-app-layout>
    <div x-data="{}" class="w-full max-w-7xl mx-auto px-6 py-16 relative z-10">
        
        <!-- Greeting Area -->
        <section class="mb-20 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl font-bold font-outfit tracking-tighter text-ghooo-950 mb-4" style="font-family: 'Times New Roman', Times, serif;">
                Welcome home, <span class="text-ghooo-600 italic underline decoration-ghooo-200 decoration-8 underline-offset-8">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-lg md:text-xl text-ghooo-700 font-medium font-outfit max-w-2xl">Your personal sanctuary is ready. Continue where you left off or discover something new.</p>
        </section>

        <!-- Currently Reading Section -->
        <section class="space-y-12 animate-fade-in-up animation-delay-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h2 class="text-3xl font-bold font-outfit text-ghooo-900 flex items-center gap-3">
                    <span class="w-10 h-1 bg-ghooo-500"></span>
                    My Personal Shelf
                </h2>
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Search Shelf -->
                    <form action="{{ route('dashboard') }}" method="GET" class="relative group w-full sm:w-64">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search your shelf..." 
                               class="w-full bg-ghooo-50 border-ghooo-100 rounded-2xl py-3 pl-12 pr-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-sm text-ghooo-900 placeholder-ghooo-400 transition-all">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-ghooo-400 group-focus-within:text-ghooo-600 transition-colors">search</span>
                    </form>
                    <div class="flex gap-4">
                        <span class="px-4 py-2 bg-ghooo-100 text-ghooo-700 rounded-full text-xs font-bold uppercase tracking-widest">{{ $peminjamans->where('status', 'Aktif')->count() }} Active</span>
                        <span class="px-4 py-2 bg-ghooo-50 border border-ghooo-200 text-ghooo-500 rounded-full text-xs font-bold uppercase tracking-widest">{{ $peminjamans->where('status', '!=', 'Aktif')->count() }} Finished</span>
                    </div>
                </div>
            </div>
            
            @if($peminjamans->isEmpty())
                 <div class="bg-ghooo-100/50 border-2 border-dashed border-ghooo-200 rounded-[3rem] p-16 text-center flex flex-col items-center justify-center min-h-[500px]">
                    <div class="w-32 h-32 rounded-full bg-ghooo-200 flex items-center justify-center text-ghooo-400 mb-8 animate-float">
                        <span class="material-symbols-outlined text-6xl">book_2</span>
                    </div>
                    <h3 class="text-3xl font-bold font-outfit text-ghooo-900 mb-4">Your shelf is waiting</h3>
                    <p class="text-ghooo-600 font-medium mb-10 max-w-md text-lg">Pick up a story and let your imagination roam free in our curated library.</p>
                    <a href="{{ route('home') }}" class="px-12 py-5 bg-ghooo-900 text-ghooo-50 rounded-full font-outfit font-bold hover:bg-ghooo-950 transition-all shadow-2xl shadow-ghooo-900/20 hover:-translate-y-1">
                        Browse the Catalog
                    </a>
                </div>
            @else
                <!-- My Shelf: Dense Grid -->
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-3 sm:gap-10">
                    @foreach($peminjamans as $pinjam)
                        <div class="bg-white border border-ghooo-200 rounded-2xl p-4 sm:p-8 flex flex-col group hover:shadow-2xl transition-all duration-700 animate-fade-in-up relative overflow-hidden h-full">
                            
                            <div class="flex flex-col sm:flex-row gap-4 mb-4">
                                <!-- Cover Image -->
                                <div class="w-full sm:w-32 aspect-[2/3] flex-shrink-0 rounded-xl overflow-hidden shadow-sm bg-ghooo-50 relative">
                                    @php
                                        $cover = $pinjam->book->cover_image ?? $pinjam->book->cover ?? null;
                                    @endphp
                                    @if($cover)
                                        <img src="{{ Storage::url($cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-ghooo-100 to-ghooo-200 flex flex-col items-center justify-center text-center p-3">
                                            <span class="material-symbols-outlined text-ghooo-200 text-xl mb-1">menu_book</span>
                                            <span class="font-outfit font-bold text-ghooo-800 text-[8px] uppercase tracking-tighter line-clamp-2">{{ $pinjam->book->judul }}</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Info -->
                                <div class="flex flex-col justify-start flex-1 min-w-0">
                                    <div class="mb-2">
                                        @if($pinjam->status == 'Aktif')
                                            @php
                                                $diff = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($pinjam->tanggal_jatuh_tempo), false);
                                            @endphp
                                            <span class="text-[8px] font-black uppercase tracking-wider {{ $diff < 0 ? 'text-red-500 bg-red-50' : 'text-ghooo-600 bg-ghooo-50' }} px-2 py-1 rounded-md">
                                                {{ $diff < 0 ? 'Overdue' : $diff . 'd Left' }}
                                            </span>
                                        @else
                                            <span class="text-[8px] font-black uppercase tracking-wider text-ghooo-400 bg-ghooo-50 px-2 py-1 rounded-md">{{ $pinjam->status }}</span>
                                        @endif
                                    </div>
                                    <h3 class="font-outfit font-bold text-xs sm:text-xl text-ghooo-950 leading-tight mb-1 line-clamp-2">{{ $pinjam->book->judul }}</h3>
                                    <p class="text-ghooo-400 text-[9px] font-bold font-outfit uppercase tracking-tighter truncate">{{ $pinjam->book->penulis }}</p>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-auto pt-4 border-t border-ghooo-50 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @if($pinjam->status == 'Aktif')
                                    <a href="{{ route('buku.baca', $pinjam->book->id) }}" class="flex-1 bg-ghooo-900 text-ghooo-50 py-2.5 rounded-xl font-outfit font-bold text-[9px] text-center hover:bg-ghooo-950 transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-[14px]">auto_stories</span>
                                        READ
                                    </a>
                                    <form id="return-form-{{ $pinjam->id }}" action="{{ route('peminjaman.kembalikan', $pinjam->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="button" 
                                                @click="window.confirmAction({
                                                    title: 'Return Masterpiece?',
                                                    message: {{ json_encode('Are you sure you want to return \'' . $pinjam->book->judul . '\' to the sanctuary?') }},
                                                    confirmText: 'Return Now',
                                                    onConfirm: () => document.getElementById('return-form-{{ $pinjam->id }}').submit()
                                                })"
                                                class="w-full bg-ghooo-50 text-ghooo-900 py-2.5 rounded-xl font-outfit font-bold text-[9px] border border-ghooo-200 hover:bg-ghooo-100 transition-all flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-[14px]">assignment_return</span>
                                            RETURN
                                        </button>
                                    </form>
                                @else
                                    <div class="col-span-1 sm:col-span-2 py-2 bg-ghooo-50 rounded-xl text-center">
                                        <span class="text-[8px] font-bold text-ghooo-400 uppercase tracking-widest italic">
                                            Finished on {{ $pinjam->updated_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</x-app-layout>