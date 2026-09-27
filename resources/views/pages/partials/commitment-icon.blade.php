@switch($index % 3)
    @case(0)
        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="22" cy="24" r="8" stroke="#fff" stroke-width="2.5" fill="none" />
            <circle cx="42" cy="24" r="8" stroke="#fff" stroke-width="2.5" fill="none" />
            <path d="M12 46c0-8 6-12 10-12s10 4 10 12" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
            <path d="M32 46c0-8 6-12 10-12s10 4 10 12" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
        </svg>
        @break
    @case(1)
        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M32 10c-8 0-14 6-14 14 0 10 14 22 14 22s14-12 14-22c0-8-6-14-14-14z" stroke="#fff" stroke-width="2.5" fill="none" />
            <path d="M24 52h16" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
            <path d="M28 52v4h8v-4" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M32 18v8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
            <path d="M28 22h8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
        </svg>
        @break
    @default
        <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M32 8l6 12h14l-11 9 4 14-13-8-13 8 4-14-11-9h14z" stroke="#fff" stroke-width="2.5" stroke-linejoin="round" fill="none" />
            <circle cx="32" cy="44" r="10" stroke="#fff" stroke-width="2.5" fill="none" />
            <path d="M32 38v8M28 42h8" stroke="#fff" stroke-width="2.5" stroke-linecap="round" />
        </svg>
@endswitch
