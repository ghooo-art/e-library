@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-ghooo-50 border-ghooo-200 text-ghooo-900 focus:border-ghooo-500 focus:ring-ghooo-500 rounded-2xl shadow-sm transition-all']) }}>
