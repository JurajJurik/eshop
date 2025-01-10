@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 bg-transparent text-gray-700 focus:border-gray-900 dark:focus:border-gray-900 focus:ring-gray-900 dark:focus:ring-gray-900 rounded-md shadow-sm']) }}>

