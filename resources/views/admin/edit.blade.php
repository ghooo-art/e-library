<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-20 relative z-10">
        
        <!-- Header -->
        <div class="mb-16 animate-fade-in-up">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-ghooo-400 hover:text-ghooo-900 transition-colors font-outfit text-sm font-bold uppercase tracking-widest mb-6">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Back to Catalog
            </a>
            <h1 class="text-5xl md:text-7xl font-bold text-ghooo-950 leading-[0.95] tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">
                Edit<br><span class="italic text-ghooo-600">Masterpiece</span>
            </h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[3rem] shadow-2xl p-10 md:p-16 border border-ghooo-100 animate-fade-in-up animation-delay-200">
            <form action="{{ route('admin.buku.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Judul -->
                    <div class="space-y-3">
                        <label class="block text-ghooo-900 text-xs font-black uppercase tracking-[0.2em]">Book Title</label>
                        <input type="text" name="judul" value="{{ old('judul', $book->judul) }}" required 
                               class="w-full bg-ghooo-50 border-ghooo-200 rounded-2xl py-4 px-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-ghooo-900 placeholder-ghooo-300 transition-all border-2"
                               placeholder="Enter the title...">
                    </div>

                    <!-- Penulis -->
                    <div class="space-y-3">
                        <label class="block text-ghooo-900 text-xs font-black uppercase tracking-[0.2em]">Author Name</label>
                        <input type="text" name="penulis" value="{{ old('penulis', $book->penulis) }}" required 
                               class="w-full bg-ghooo-50 border-ghooo-200 rounded-2xl py-4 px-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-ghooo-900 placeholder-ghooo-300 transition-all border-2"
                               placeholder="Who wrote this?">
                    </div>

                    <!-- Genre -->
                    <div class="space-y-3">
                        <label class="block text-ghooo-900 text-xs font-black uppercase tracking-[0.2em]">Genre / Category</label>
                        <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" required 
                               class="w-full bg-ghooo-50 border-ghooo-200 rounded-2xl py-4 px-6 focus:ring-ghooo-500 focus:border-ghooo-500 font-outfit text-ghooo-900 placeholder-ghooo-300 transition-all border-2"
                               placeholder="e.g. Technology, Fiction...">
                    </div>

                    <!-- File Upload -->
                    <div class="space-y-3">
                        <label class="block text-ghooo-900 text-xs font-black uppercase tracking-[0.2em]">Update E-Book File (Optional)</label>
                        <div class="relative group">
                            <input type="file" name="file_ebook" accept="application/pdf" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="w-full bg-ghooo-50 border-2 border-dashed border-ghooo-200 rounded-2xl py-4 px-6 flex items-center gap-4 group-hover:border-ghooo-400 transition-all">
                                <div class="w-10 h-10 rounded-full bg-ghooo-200 flex items-center justify-center text-ghooo-600">
                                    <span class="material-symbols-outlined text-[20px]">upload_file</span>
                                </div>
                                <span class="text-sm font-bold text-ghooo-500 font-outfit truncate">Leave empty to keep current file</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-10 flex flex-col sm:flex-row items-center gap-6 border-t border-ghooo-50">
                    <button type="submit" class="w-full sm:w-auto px-12 py-5 bg-ghooo-900 text-ghooo-50 rounded-2xl font-outfit font-black uppercase tracking-widest hover:bg-ghooo-950 shadow-2xl shadow-ghooo-900/20 hover:-translate-y-1 transition-all">
                        Update Masterpiece
                    </button>
                    <p class="text-xs text-ghooo-400 font-medium italic">All changes will be reflected immediately in the public catalog.</p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>