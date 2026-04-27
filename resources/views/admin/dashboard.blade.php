<x-app-layout>
    <div x-data="{}" class="w-full max-w-7xl mx-auto px-6 py-16 relative z-10">
        
        <!-- Header & Action Area -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8 animate-fade-in-up">
            <div class="max-w-2xl">
                <span class="inline-block px-3 py-1 bg-ghooo-100 text-ghooo-600 text-[10px] font-black tracking-widest uppercase mb-4 rounded-full border border-ghooo-200">Admin Sanctuary</span>
                <h1 class="text-5xl md:text-7xl font-bold font-outfit tracking-tighter text-ghooo-950 mb-4" style="font-family: 'Times New Roman', Times, serif;">
                    Manage the <span class="italic text-ghooo-700 underline decoration-ghooo-200 decoration-8 underline-offset-8">Wisdom</span>
                </h1>
                <p class="text-lg text-ghooo-700 font-medium font-outfit">Curate, update, and maintain the masterpieces within the ReadNest digital collection.</p>
            </div>
            
            <a href="{{ route('admin.buku.create') }}" class="group flex items-center gap-4 bg-ghooo-950 text-ghooo-50 px-10 py-5 rounded-2xl font-outfit font-bold hover:bg-black transition-all shadow-2xl shadow-ghooo-900/30 hover:-translate-y-1">
                <span class="material-symbols-outlined transition-transform group-hover:rotate-90">add</span>
                ADD NEW MASTERPIECE
            </a>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-[2.5rem] p-8 mb-12 shadow-sm border border-ghooo-100 animate-fade-in-up animation-delay-200">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                    <!-- Search Bar -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="relative group w-full sm:w-80">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search catalog..." 
                               class="w-full bg-ghooo-50 border-ghooo-100 rounded-2xl py-3.5 pl-12 pr-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-sm text-ghooo-900 placeholder-ghooo-400 transition-all">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-ghooo-400 group-focus-within:text-ghooo-600 transition-colors">search</span>
                    </form>

                    <!-- Category Dropdown -->
                    <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full sm:w-auto">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="category" onchange="this.form.submit()" 
                                class="w-full sm:w-auto bg-ghooo-50 border-ghooo-100 rounded-2xl py-3.5 px-8 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-sm text-ghooo-900 transition-all cursor-pointer">
                            <option value="">All Genres</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                
                <div class="text-ghooo-400 font-outfit font-bold text-[10px] uppercase tracking-[0.3em]">
                    Total: {{ $books->count() }} Books Found
                </div>
            </div>
        </div>

        <!-- Unified List Layout -->
        <div class="space-y-4 animate-fade-in-up animation-delay-400">
            @forelse($books as $book)
                <div class="bg-white rounded-3xl p-4 md:p-6 border border-ghooo-100 shadow-sm hover:shadow-xl transition-all duration-500 group flex items-center gap-6 relative overflow-hidden">
                    <!-- Number Index (Desktop) -->
                    <div class="hidden md:flex items-center justify-center w-12 h-12 rounded-full bg-ghooo-50 text-ghooo-300 font-black text-sm">
                        {{ $loop->iteration }}
                    </div>

                    <!-- Book Thumbnail -->
                    <div class="w-16 md:w-20 aspect-[2/3] flex-shrink-0 rounded-xl overflow-hidden bg-ghooo-50 shadow-sm">
                        @if($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-center p-2 bg-gradient-to-br from-ghooo-50 to-ghooo-100">
                                <span class="material-symbols-outlined text-ghooo-200 text-lg">menu_book</span>
                            </div>
                        @endif
                    </div>

                    <!-- Main Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2 md:gap-4 mb-1">
                            <h3 class="font-outfit font-bold text-lg md:text-xl text-ghooo-950 truncate group-hover:text-ghooo-700 transition-colors">{{ $book->judul }}</h3>
                            <span class="px-3 py-1 bg-ghooo-50 text-ghooo-600 text-[9px] font-black tracking-widest uppercase rounded-full border border-ghooo-100">{{ $book->genre ?? 'General' }}</span>
                        </div>
                        <p class="text-ghooo-500 text-xs md:text-sm font-bold font-outfit uppercase tracking-widest">{{ $book->penulis }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 md:gap-4 ml-auto">
                        <a href="{{ route('admin.buku.edit', $book->id) }}" class="w-10 h-10 md:w-14 md:h-14 flex items-center justify-center bg-ghooo-50 text-ghooo-900 rounded-2xl hover:bg-ghooo-950 hover:text-ghooo-50 transition-all border border-ghooo-100 shadow-sm">
                            <span class="material-symbols-outlined md:text-[24px]">edit_note</span>
                        </a>
                        
                        <form id="delete-form-list-{{ $book->id }}" action="{{ route('admin.buku.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                    @click="window.confirmAction({
                                        title: 'Discard Wisdom?',
                                        message: {{ json_encode('Are you sure you want to permanently remove \'' . $book->judul . '\' from the sanctuary?') }},
                                        confirmText: 'Yes, Remove',
                                        onConfirm: () => document.getElementById('delete-form-list-{{ $book->id }}').submit()
                                    })"
                                    class="w-10 h-10 md:w-14 md:h-14 flex items-center justify-center bg-red-50 text-red-600 rounded-2xl hover:bg-red-600 hover:text-white transition-all border border-red-100 shadow-sm">
                                <span class="material-symbols-outlined md:text-[24px]">delete_sweep</span>
                            </button>
                        </form>
                    </div>

                    <!-- Subtle ID Tag for Mobile -->
                    <div class="md:hidden absolute top-2 right-2 text-[8px] font-black text-ghooo-200">#{{ $loop->iteration }}</div>
                </div>
            @empty
                <div class="py-32 text-center bg-ghooo-50 rounded-[3rem] border-2 border-dashed border-ghooo-200">
                    <div class="w-24 h-24 bg-ghooo-100 rounded-full flex items-center justify-center mx-auto mb-8">
                        <span class="material-symbols-outlined text-5xl text-ghooo-300">library_add</span>
                    </div>
                    <h3 class="text-2xl font-bold font-outfit text-ghooo-900">The Sanctuary is Silent</h3>
                    <p class="text-ghooo-500 mt-2 font-medium">Start adding masterpieces to your collection.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>