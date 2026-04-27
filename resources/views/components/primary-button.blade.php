<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-8 py-3 bg-ghooo-900 border border-transparent rounded-2xl font-outfit font-black text-xs text-ghooo-50 uppercase tracking-widest hover:bg-ghooo-950 focus:bg-ghooo-950 active:bg-ghooo-950 focus:outline-none focus:ring-2 focus:ring-ghooo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-ghooo-900/20']) }}>
    {{ $slot }}
</button>
