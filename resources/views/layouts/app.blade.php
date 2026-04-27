<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ghooo Library') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-ghooo-50 text-ghooo-950 font-sans min-h-screen flex flex-col relative overflow-x-hidden antialiased">
    
    <div class="relative z-40 w-full">
        @include('layouts.navigation')
    </div>

    @if (isset($header))
        <header class="bg-ghooo-50/80 backdrop-blur-md border-b border-ghooo-200 z-30 relative mt-[72px]">
            <div class="max-w-7xl mx-auto py-6 px-6 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="flex-grow flex flex-col items-center w-full relative z-20 @if(!isset($header)) pt-[88px] @endif">
        {{ $slot }}
    </main>

    <!-- Minimalist Footer -->
    <footer class="w-full py-12 mt-auto border-t border-ghooo-200 bg-ghooo-100/50 relative z-40">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex flex-col gap-2">
                <div class="text-2xl font-bold font-outfit text-ghooo-900">Ghooo Library</div>
                <p class="text-sm text-ghooo-600 max-w-xs">Your sanctuary for digital reading. Aesthetic, warm, and simple.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-8 text-sm font-medium text-ghooo-700">
                <a class="hover:text-ghooo-900 transition-colors" href="{{ route('home') }}">Home</a>
                @auth
                    <a class="hover:text-ghooo-900 transition-colors" href="{{ route('dashboard') }}">My Shelf</a>
                @endauth
                <a class="hover:text-ghooo-900 transition-colors" href="#">Collections</a>
                <a class="hover:text-ghooo-900 transition-colors" href="#">About</a>
            </div>
            <div class="flex flex-col items-center md:items-end gap-2">
                <span class="text-sm text-ghooo-400">&copy; {{ date('Y') }} Ghooo Library.</span>
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-ghooo-200 flex items-center justify-center text-ghooo-600 hover:bg-ghooo-300 transition-colors cursor-pointer">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-ghooo-200 flex items-center justify-center text-ghooo-600 hover:bg-ghooo-300 transition-colors cursor-pointer">
                        <i class="fab fa-twitter"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Global Notification System (Toasts) -->
    <div x-data="{ 
            notifications: [],
            add(message, type = 'success') {
                const id = Date.now();
                this.notifications.push({ id, message, type });
                setTimeout(() => this.remove(id), 5000);
            },
            remove(id) {
                this.notifications = this.notifications.filter(n => n.id !== id);
            }
         }"
         @notify.window="add($event.detail.message, $event.detail.type)"
         class="fixed top-24 right-6 z-[100] flex flex-col gap-4 w-full max-w-sm pointer-events-none">
        
        <template x-for="n in notifications" :key="n.id">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-12"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 translate-x-12"
                 class="pointer-events-auto bg-white border-l-4 p-5 rounded-2xl shadow-2xl flex items-start gap-4"
                 :class="{ 'border-ghooo-600': n.type === 'success', 'border-red-500': n.type === 'error' }">
                
                <div class="flex-shrink-0">
                    <span x-show="n.type === 'success'" class="material-symbols-outlined text-ghooo-600">check_circle</span>
                    <span x-show="n.type === 'error'" class="material-symbols-outlined text-red-500">error</span>
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-bold font-outfit text-ghooo-950 uppercase tracking-wider" x-text="n.type === 'success' ? 'Success' : 'Attention'"></p>
                    <p class="text-sm text-ghooo-600 mt-1 font-medium" x-text="n.message"></p>
                </div>
                <button @click="remove(n.id)" class="text-ghooo-300 hover:text-ghooo-600 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </template>
    </div>

    <!-- Global Confirmation Modal -->
    <div x-data="{ 
            show: false, 
            title: '', 
            message: '', 
            confirmText: 'Confirm', 
            cancelText: 'Cancel',
            onConfirm: null,
            open(data) {
                this.title = data.title || 'Are you sure?';
                this.message = data.message || 'This action cannot be undone.';
                this.confirmText = data.confirmText || 'Confirm';
                this.cancelText = data.cancelText || 'Cancel';
                this.onConfirm = data.onConfirm;
                this.show = true;
            },
            confirm() {
                if (this.onConfirm) this.onConfirm();
                this.show = false;
            }
         }"
         @confirm-modal.window="open($event.detail)"
         x-show="show"
         class="fixed inset-0 z-[110] flex items-center justify-center p-6"
         x-cloak>
        
        <!-- Backdrop -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-ghooo-950/40 backdrop-blur-sm"
             @click="show = false"></div>

        <!-- Modal Content -->
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-8"
             class="relative bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl p-10 text-center border border-ghooo-100">
            
            <div class="w-20 h-20 bg-ghooo-50 rounded-full flex items-center justify-center mx-auto mb-8 text-ghooo-600 border border-ghooo-100">
                <span class="material-symbols-outlined text-4xl">help_center</span>
            </div>

            <h2 class="text-3xl font-bold font-outfit text-ghooo-950 mb-4" x-text="title"></h2>
            <p class="text-ghooo-600 font-medium mb-10 leading-relaxed" x-text="message"></p>

            <div class="flex flex-col sm:flex-row gap-4">
                <button @click="show = false" 
                        class="flex-1 py-4 px-6 border border-ghooo-200 rounded-2xl text-ghooo-700 font-bold hover:bg-ghooo-50 transition-all"
                        x-text="cancelText"></button>
                <button @click="confirm()" 
                        class="flex-1 py-4 px-6 bg-ghooo-900 text-ghooo-50 rounded-2xl font-bold hover:bg-ghooo-950 shadow-xl shadow-ghooo-900/20 transition-all"
                        x-text="confirmText"></button>
            </div>
        </div>
    </div>

    <!-- Session Auto-Notify -->
    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('success') }}", type: 'success' } }));
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('error') }}", type: 'error' } }));
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                @foreach($errors->all() as $error)
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ addslashes($error) }}", type: 'error' } }));
                @endforeach
            });
        </script>
    @endif

    <script>
        // Helper to trigger confirmation modal easily
        window.confirmAction = (options) => {
            window.dispatchEvent(new CustomEvent('confirm-modal', { detail: options }));
        }
    </script>
</body>
</html>