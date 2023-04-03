<button {{ $attributes->merge(['type' => 'button', 'class' => 'c']) }}>
    {{ $slot }}
</button>
