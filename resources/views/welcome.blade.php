<x-app-layout>
    <div class="w-full bg-ghooo-50 overflow-hidden">
        
        <!-- Hero Section: Sanctuary Introduction -->
        <section class="relative min-h-screen flex flex-col items-center justify-center text-center px-6 pt-20">
            <div class="max-w-4xl z-10 animate-fade-in-up">
                <span class="inline-block px-4 py-1.5 bg-ghooo-100 text-ghooo-600 text-[10px] font-black tracking-[0.3em] uppercase mb-10 rounded-full border border-ghooo-200">The Sanctuary of Wisdom</span>
                
                <h1 class="text-6xl sm:text-8xl lg:text-9xl text-ghooo-950 leading-[0.9] mb-12 tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">
                    Quiet your mind.<br>Open a <span class="italic text-ghooo-600 underline decoration-ghooo-200 decoration-8 underline-offset-8">Universe.</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-ghooo-800 font-medium mb-16 leading-relaxed max-w-2xl mx-auto font-outfit">
                    ReadNest is not just a library. It is a digital retreat designed for those who seek solace in the written word and growth in every page.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    <a href="{{ route('collections') }}" class="w-full sm:w-auto px-12 py-5 bg-ghooo-950 text-ghooo-50 rounded-2xl font-outfit font-black uppercase tracking-widest hover:bg-black transition-all shadow-2xl shadow-ghooo-900/30 hover:-translate-y-1">
                        Explore Collections
                    </a>
                    <a href="#vision" class="w-full sm:w-auto px-12 py-5 border-2 border-ghooo-200 text-ghooo-900 rounded-2xl font-outfit font-black uppercase tracking-widest hover:bg-ghooo-100 transition-all">
                        Our Vision
                    </a>
                </div>
            </div>

            <!-- Floating Decorative Elements -->
            <div class="absolute top-1/4 -left-20 w-80 h-80 bg-ghooo-200 rounded-full blur-[120px] opacity-40 animate-pulse"></div>
            <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-accent-light/20 rounded-full blur-[140px] opacity-30 animate-pulse animation-delay-2000"></div>
        </section>

        <!-- Inspirational Quote Section -->
        <section class="py-32 bg-ghooo-950 text-ghooo-50 relative overflow-hidden">
            <div class="max-w-[1400px] mx-auto px-6 relative z-10 text-center">
                <div class="mb-16">
                    <span class="material-symbols-outlined text-6xl text-ghooo-500 opacity-30">format_quote</span>
                </div>
                <blockquote class="text-3xl md:text-5xl lg:text-6xl font-medium italic tracking-tight leading-tight max-w-5xl mx-auto mb-12" style="font-family: 'Times New Roman', Times, serif;">
                    "A room without books is like a body without a soul. In this digital sanctuary, we give your soul a place to roam free and your mind a chance to ignite."
                </blockquote>
                <cite class="text-ghooo-400 font-outfit font-bold uppercase tracking-[0.3em] text-xs">— Ghooo Library Philosophy</cite>
            </div>
            
            <!-- Texture Overlay -->
            <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');"></div>
        </section>

        <!-- Features / Information Section -->
        <section id="vision" class="py-32 lg:py-52 max-w-[1400px] mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div class="space-y-12 animate-fade-in-up">
                    <div>
                        <h2 class="text-5xl md:text-7xl text-ghooo-950 mb-8 tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">Why we <span class="italic text-ghooo-600">curate.</span></h2>
                        <p class="text-lg text-ghooo-700 leading-relaxed font-outfit font-medium">
                            In an age of information overload, we believe in the power of focus. Every title in ReadNest is selected to inspire, challenge, and nurture your intellectual curiosity.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-ghooo-900 text-ghooo-50 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined">filter_vintage</span>
                            </div>
                            <h4 class="text-xl font-bold font-outfit text-ghooo-950">Pure Focus</h4>
                            <p class="text-sm text-ghooo-500 leading-relaxed">No ads, no distractions. Just you and the masterpieces that matter.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="w-12 h-12 bg-ghooo-200 text-ghooo-900 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined">auto_stories</span>
                            </div>
                            <h4 class="text-xl font-bold font-outfit text-ghooo-950">Curated Wisdom</h4>
                            <p class="text-sm text-ghooo-500 leading-relaxed">A growing collection of over 200+ handpicked books across 12 genres.</p>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div class="aspect-[4/5] bg-ghooo-200 rounded-[4rem] overflow-hidden rotate-2 group-hover:rotate-0 transition-all duration-700 shadow-2xl">
                        <img src="{{ asset('images/inspirational-read.png') }}" class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-1000">
                    </div>
                    <!-- Stats Card -->
                    <div class="absolute -bottom-10 -left-10 bg-white p-10 rounded-[2.5rem] shadow-2xl border border-ghooo-100 animate-float">
                        <div class="flex items-center gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-ghooo-950 font-outfit">200+</div>
                                <div class="text-[10px] text-ghooo-400 font-black uppercase tracking-widest">Masterpieces</div>
                            </div>
                            <div class="w-px h-12 bg-ghooo-100"></div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-ghooo-950 font-outfit">100%</div>
                                <div class="text-[10px] text-ghooo-400 font-black uppercase tracking-widest">Ad-Free</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-32 bg-ghooo-100 border-y border-ghooo-200 text-center">
            <div class="max-w-2xl mx-auto px-6">
                <h3 class="text-4xl md:text-5xl text-ghooo-950 mb-8 tracking-tighter" style="font-family: 'Times New Roman', Times, serif;">Ready to start your <span class="italic text-ghooo-600">adventure?</span></h3>
                <p class="text-ghooo-700 font-medium mb-12 font-outfit">Join our community of lifelong learners and book lovers today.</p>
                @guest
                    <a href="{{ route('register') }}" class="px-16 py-5 bg-ghooo-900 text-ghooo-50 rounded-full font-outfit font-black uppercase tracking-widest hover:bg-ghooo-950 shadow-xl transition-all">
                        Join ReadNest
                    </a>
                @else
                    <a href="{{ route('collections') }}" class="px-16 py-5 bg-ghooo-900 text-ghooo-50 rounded-full font-outfit font-black uppercase tracking-widest hover:bg-ghooo-950 shadow-xl transition-all">
                        Open the Library
                    </a>
                @endguest
            </div>
        </section>
    </div>
</x-app-layout>