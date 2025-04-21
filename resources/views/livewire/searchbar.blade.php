<div style="display: inline-block; width: 100%;" x-data="{ open: false }" @click.away="open = false" x-init="$watch('open', value => $wire.set('showDropdown', value))">
    <form wire:submit.prevent="search" class="d-flex">

        <div class="input-group">
            <div class="search-container position-relative" x-data="{ isOpen: false, hasInput: false }">
                <!-- Search Input with Integrated Icon -->
                <div class="search-input-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input
                        wire:model.live.debounce.400ms="query"
                        x-on:input="hasInput = $event.target.value.length > 0"
                        @focus="isOpen = true"
                        @click.away="isOpen = false"
                        x-ref="searchInput"
                        class="search-input"
                        type="search"
                        placeholder="{{ __('general.search_placeholder') }}"
                        dir="rtl"
                    >

                </div>

                <!-- Dropdown Results -->
                @if ($showDropdown)
                    <div x-show="isOpen"
                         x-transition
                         class="search-results-dropdown">
                        @if (count($results) > 0)
                            <div class="search-results-list">
                                @foreach ($results as $user)
                                    <a href="#" class="search-result-item"
                                        x-data @click="fetch(`/users/{{ $user->id }}/ping`, { method: 'GET' })"
                                        wire:click='showUser({{ $user->id }})'
                                        wire:key="{{ $user->id }}">
                                        <img src="{{ $user->user_image_url }}"
                                            class="search-result-avatar"
                                            alt="{{ $user->user_name }}">
                                        <div class="search-result-info text-end">
                                            <h6 class="search-result-name">{{ $user->fullName() ?? $user->page_name }}</h6>
                                            <p class="search-result-specialty">{{ $user->personal_details->specialist ?? '' }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="search-no-results">
                                <i class="bi bi-search-x"></i>
                                <span>@lang('No results found')</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <style>
        .search-container {
            max-width: 500px;
            width: 100%;
        }

        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            color: #6c757d;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .search-input:focus {
            outline: none;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
            background-color: white;
        }

        .search-clear-btn {
            position: absolute;
            left: 12px;
            background: none;
            border: none;
            color: #6c757d;
            cursor: pointer;
            padding: 0;
        }

        .search-results-dropdown {
            position: absolute;
            width: 100%;
            max-height: 400px;
            overflow-y: auto;
            margin-top: 8px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            text-decoration: none;
            color: #212529;
            transition: background-color 0.2s;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .search-result-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 12px;
        }

        .search-result-info {
            flex: 1;
            min-width: 0;
        }

        .search-result-name {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-result-specialty {
            margin: 0;
            font-size: 12px;
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-no-results {
            padding: 20px;
            text-align: center;
            color: #6c757d;
        }

        .search-no-results i {
            font-size: 24px;
            margin-bottom: 8px;
            display: block;
        }
        </style>

    </form>
</div>
