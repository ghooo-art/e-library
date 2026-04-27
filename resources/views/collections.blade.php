<x-app-layout>
    <div class="w-full bg-ghooo-50 pt-24">
        <!-- Catalog Section -->
        <div id="catalog" class="max-w-[1400px] mx-auto px-6 py-24 sm:py-32">
            <!-- Section Header -->
            <div class="mb-20 animate-fade-in-up">
                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10">
                    <div class="max-w-2xl">
                        <h2 class="text-5xl md:text-7xl text-ghooo-950 mb-6 tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">
                            @if(request('category'))
                                The <span class="italic text-ghooo-600">{{ request('category') }}</span> Shelf
                            @else
                                The <span class="italic text-ghooo-600">Curated</span> Library
                            @endif
                        </h2>
                        <p class="text-ghooo-500 font-outfit font-bold uppercase tracking-[0.3em] text-xs">Explore masterpieces by genre</p>
                    </div>

                    <!-- Filters & Search -->
                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
                        <!-- Search Bar -->
                        <form action="{{ route('collections') }}" method="GET" class="relative group w-full sm:w-80">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search masterpieces..." 
                                   class="w-full bg-ghooo-50 border-ghooo-100 rounded-2xl py-3.5 pl-12 pr-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-sm text-ghooo-900 placeholder-ghooo-400 transition-all">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-ghooo-400 group-focus-within:text-ghooo-600 transition-colors">search</span>
                        </form>

                        <!-- Category Dropdown -->
                        <form action="{{ route('collections') }}" method="GET" class="w-full sm:w-auto">
                            @if(request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <select name="category" onchange="this.form.submit()" 
                                    class="w-full sm:w-auto bg-ghooo-50 border-ghooo-100 rounded-2xl py-3.5 px-8 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-sm text-ghooo-900 transition-all cursor-pointer">
                                <option value="">All Collections</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Book Grid: Dense on Mobile -->
            <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-3 md:gap-x-8 gap-y-10 md:gap-y-16">
                @foreach($books as $book)
                    <a href="{{ route('buku.show', $book->id) }}" class="group block">
                        <div class="relative mb-6">
                            <div class="w-full aspect-[2/3] bg-ghooo-100 border border-ghooo-200 overflow-hidden shadow-sm group-hover:shadow-2xl transition-all duration-500 transform group-hover:-translate-y-2">
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-center p-6 bg-gradient-to-br from-ghooo-50 to-ghooo-100">
                                        <div class="w-12 h-12 bg-ghooo-200/50 rounded-full flex items-center justify-center mb-4">
                                            <span class="material-symbols-outlined text-ghooo-400">menu_book</span>
                                        </div>
                                        <span class="font-bold text-ghooo-900 font-outfit text-sm">{{ $book->judul }}</span>
                                        <span class="text-[10px] text-ghooo-500 mt-2 uppercase tracking-widest">{{ $book->genre }}</span>
                                    </div>
                                @endif
                                <!-- Hover Overlay -->
                                <div class="absolute inset-0 bg-ghooo-900/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-outfit font-bold text-ghooo-950 text-lg line-clamp-1 group-hover:text-ghooo-700 transition-colors">{{ $book->judul }}</h3>
                            <div class="flex items-center justify-between">
                                <p class="text-ghooo-500 text-sm font-medium">{{ $book->penulis }}</p>
                                <span class="text-[10px] font-bold text-ghooo-400 border border-ghooo-200 px-2 py-0.5 rounded-sm">{{ $book->genre }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            @if($books->isEmpty())
                <div class="py-20 text-center">
                    <div class="w-20 h-20 bg-ghooo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-4xl text-ghooo-300">library_books</span>
                    </div>
                    <h3 class="text-xl font-outfit font-bold text-ghooo-900">No books found</h3>
                    <p class="text-ghooo-500 mt-2">Check back later for new arrivals.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
