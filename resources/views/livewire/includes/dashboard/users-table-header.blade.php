<th scope="col" class="px-3 py-2" wire:click="SetSortBy('{{ $name }}')">
    <div class="d-flex align-items-center text-decoration-none p-0 text-muted" style="cursor: pointer">
        {{ $display_name }}
        @if ($sortBy !== $name)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ms-2" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
            </svg>
        @elseif($sortDirection === 'desc')
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ms-2" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ms-2" style="width: 16px; height: 16px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
        @endif
    </div>
</th>
