<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-20 relative z-10">
        <!-- Breadcrumbs -->
        <nav class="mb-16 flex items-center gap-4 font-outfit text-sm font-bold tracking-[0.2em] uppercase text-ghooo-400 animate-fade-in-up">
            <a class="hover:text-ghooo-900 transition-colors flex items-center gap-2" href="{{ route('home') }}">
                <span class="material-symbols-outlined text-[18px]">home</span> LIBRARY
            </a>
            <span class="text-ghooo-200">/</span>
            <span class="text-ghooo-800 bg-ghooo-100 px-4 py-1.5 rounded-full border border-ghooo-200">{{ $book->genre ?? 'General' }}</span>
        </nav>

        <!-- Book Detail Hero -->
        <div class="flex flex-col lg:flex-row gap-20 mb-32">
            <!-- Left Column: Book Cover -->
            <div class="w-full lg:w-1/3 flex flex-col items-center lg:items-start relative animate-fade-in-up">
                <!-- Decorative background behind cover -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[140%] aspect-square bg-ghooo-100 rounded-full blur-[100px] opacity-60 -z-10"></div>
                
                <div class="relative w-full max-w-sm group">
                    <div class="relative transition-all duration-700 transform group-hover:rotate-1">
                        @php
                            $cover = $book->cover_image ?? $book->cover ?? null;
                        @endphp
                        @if($cover)
                            <img alt="{{ $book->judul }}" class="w-full h-auto rounded-xl shadow-2xl object-cover aspect-[2/3] ring-8 ring-white" src="{{ Storage::url($cover) }}"/>
                        @else
                            <div class="w-full aspect-[2/3] rounded-xl shadow-2xl bg-gradient-to-br from-ghooo-900 to-ghooo-800 flex flex-col items-center justify-center p-8 text-center ring-8 ring-white">
                                <span class="material-symbols-outlined text-ghooo-400 text-5xl mb-4">menu_book</span>
                                <span class="font-outfit font-black text-ghooo-50 text-2xl uppercase tracking-tighter">{{ $book->judul }}</span>
                            </div>
                        @endif

                        <!-- Reflection effect -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/0 via-white/10 to-white/0 opacity-0 group-hover:opacity-100 transition-opacity duration-1000 rounded-xl pointer-events-none"></div>
                    </div>

                    <!-- Floating Badge -->
                    <div class="absolute -top-6 -right-6 bg-ghooo-950 text-ghooo-50 font-outfit font-bold text-[10px] uppercase tracking-[0.2em] px-6 py-3 rounded-full shadow-2xl flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-accent-light animate-pulse"></span>
                        PREMIUM DIGITAL
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="w-full max-w-sm mt-16 flex flex-col gap-6">
                    @auth
                        @php
                            $peminjamanAktif = App\Models\Peminjaman::where('user_id', Auth::id())
                                ->where('book_id', $book->id)
                                ->where('status', 'Aktif')
                                ->first();
                        @endphp
                        
                        @if($peminjamanAktif)
                            <a href="{{ route('buku.baca', $book->id) }}" class="w-full bg-ghooo-900 text-ghooo-50 font-outfit font-bold text-lg py-5 rounded-2xl flex items-center justify-center gap-4 shadow-2xl hover:bg-ghooo-950 hover:-translate-y-1 transition-all duration-300">
                                <span class="material-symbols-outlined text-2xl">auto_stories</span>
                                Continue Reading
                            </a>
                        @else
                            <form action="{{ route('buku.pinjam', $book->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full bg-ghooo-900 text-ghooo-50 font-outfit font-bold text-lg py-5 rounded-2xl flex items-center justify-center gap-4 shadow-2xl hover:bg-ghooo-950 hover:-translate-y-1 transition-all duration-300 group">
                                    <span class="material-symbols-outlined text-2xl group-hover:rotate-12 transition-transform">book</span>
                                    Add to My Shelf
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="w-full bg-ghooo-900 text-ghooo-50 font-outfit font-bold text-lg py-5 rounded-2xl flex items-center justify-center gap-4 shadow-2xl hover:bg-ghooo-950 transition-all">
                            <span class="material-symbols-outlined text-2xl">login</span>
                            Sign in to Read
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right Column: Details & Content -->
            <div class="w-full lg:w-2/3 flex flex-col pt-6">
                <!-- Title & Meta -->
                <div class="mb-16 animate-fade-in-up">
                    <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold text-ghooo-950 mb-8 leading-[0.95] tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">
                        {{ $book->judul }}
                    </h1>
                    
                    <div class="flex items-center gap-6 mb-12">
                        <div class="w-16 h-16 rounded-full bg-ghooo-100 flex items-center justify-center text-ghooo-600 border border-ghooo-200">
                            <span class="material-symbols-outlined text-3xl">person_edit</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-ghooo-400 uppercase tracking-[0.3em] mb-1">Author</p>
                            <p class="text-2xl font-bold font-outfit text-ghooo-800">{{ $book->penulis }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-10 text-ghooo-600 font-bold font-outfit py-8 border-y border-ghooo-200">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-accent" data-weight="fill">star</span>
                            <span class="text-ghooo-950">4.9 Rating</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-ghooo-400">history_edu</span>
                            <span>{{ $book->genre }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-ghooo-400">event_note</span>
                            <span>{{ $book->created_at->format('Y') }} Edition</span>
                        </div>
                    </div>
                </div>

                <!-- Synopsis -->
                <section class="mb-16 animate-fade-in-up">
                    <h2 class="text-2xl font-bold font-outfit text-ghooo-900 mb-8 flex items-center gap-4">
                        <span class="w-10 h-1 bg-ghooo-400"></span>
                        The Synopsis
                    </h2>
                    <div class="text-xl text-ghooo-700 leading-relaxed font-medium bg-ghooo-100/30 p-10 rounded-[2.5rem] border border-ghooo-200 relative">
                        <span class="absolute top-4 left-4 text-6xl text-ghooo-200 font-serif opacity-50 italic">"</span>
                        @if($book->deskripsi)
                            <p class="relative z-10">{{ $book->deskripsi }}</p>
                        @else
                            <p class="italic text-ghooo-400 relative z-10">No description available for this masterpiece yet.</p>
                        @endif
                    </div>
                </section>
                
                <!-- Information Cards -->
                <section class="animate-fade-in-up">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white border border-ghooo-200 p-8 rounded-[2rem] flex gap-6 items-start hover:shadow-xl transition-all duration-500">
                            <div class="bg-ghooo-50 p-4 rounded-2xl text-ghooo-600 border border-ghooo-100">
                                <span class="material-symbols-outlined text-3xl">devices</span>
                            </div>
                            <div>
                                <h3 class="font-outfit font-bold text-ghooo-950 text-lg mb-2">Universal Access</h3>
                                <p class="text-sm text-ghooo-500 font-medium leading-relaxed">Read on any device, anywhere. Your progress is synced instantly across your sanctuary.</p>
                            </div>
                        </div>
                        
                        <div class="bg-white border border-ghooo-200 p-8 rounded-[2rem] flex gap-6 items-start hover:shadow-xl transition-all duration-500">
                            <div class="bg-ghooo-50 p-4 rounded-2xl text-ghooo-600 border border-ghooo-100">
                                <span class="material-symbols-outlined text-3xl">auto_awesome</span>
                            </div>
                            <div>
                                <h3 class="font-outfit font-bold text-ghooo-950 text-lg mb-2">Immersive Mode</h3>
                                <p class="text-sm text-ghooo-500 font-medium leading-relaxed">Experience our distraction-free reader designed for long reading sessions.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>