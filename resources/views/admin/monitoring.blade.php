<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-16 relative z-10">
        
        <!-- Header -->
        <div class="mb-16 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold font-outfit text-ghooo-950 tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">Transaction Monitoring</h1>
            <p class="text-ghooo-600 font-medium mt-2">Track the journey of every masterpiece in our sanctuary.</p>
        </div>

        <!-- Monitoring Card -->
        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-ghooo-100 animate-fade-in-up animation-delay-200">
            <div class="p-10">
                <h3 class="text-2xl font-bold font-outfit text-ghooo-950 mb-8 flex items-center gap-4">
                    <span class="w-10 h-1 bg-ghooo-400"></span>
                    Transaction History
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-ghooo-50 text-ghooo-400 font-outfit text-[10px] uppercase tracking-[0.2em] border-b border-ghooo-100">
                                <th class="py-6 px-8 font-black">Reader</th>
                                <th class="py-6 px-8 font-black">Book Title</th>
                                <th class="py-6 px-8 font-black">Borrowed Date</th>
                                <th class="py-6 px-8 font-black">Due Date</th>
                                <th class="py-6 px-8 font-black text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-ghooo-50">
                            @forelse($semuaPeminjaman as $item)
                            <tr class="hover:bg-ghooo-50/50 transition-colors group">
                                <td class="py-6 px-8">
                                    <div class="flex flex-col">
                                        <span class="font-outfit font-bold text-ghooo-950">{{ $item->user->name }}</span>
                                        <span class="text-[11px] font-medium text-ghooo-400">{{ $item->user->email }}</span>
                                    </div>
                                </td>
                                <td class="py-6 px-8 text-sm font-bold text-ghooo-700 font-outfit">
                                    {{ $item->book->judul }}
                                </td>
                                <td class="py-6 px-8 text-sm font-medium text-ghooo-500 font-outfit">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>
                                <td class="py-6 px-8 text-sm font-medium text-ghooo-500 font-outfit">
                                    {{ \Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d M Y') }}
                                </td>
                                <td class="py-6 px-8 text-center">
                                    @if($item->status == 'Aktif')
                                        <span class="bg-ghooo-100 text-ghooo-600 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full border border-ghooo-200">Active</span>
                                    @elseif($item->status == 'Kedaluwarsa')
                                        <span class="bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full border border-red-100">Overdue</span>
                                    @else
                                        <span class="bg-ghooo-50 text-ghooo-300 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full border border-ghooo-100">Returned</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center text-ghooo-400 font-medium font-outfit italic">
                                    No transactions recorded yet.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>