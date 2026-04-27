<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-8 py-3 bg-white border border-ghooo-200 rounded-2xl font-outfit font-black text-xs text-ghooo-700 uppercase tracking-widest shadow-sm hover:bg-ghooo-50 focus:outline-none focus:ring-2 focus:ring-ghooo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
