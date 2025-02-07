<div>
    <section class="mt-4">
        <div class="container">
            <div class="bg-white shadow-sm rounded overflow-hidden p-4">
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <div class="flex-fill">
                        <div class="position-relative w-100">
                            <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                                <svg aria-hidden="true" class="me-2 text-secondary" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20" width="20" height="20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" wire:model.live.debounce.400ms="search" class="form-control ps-5"
                                placeholder="{{ __('general.search') }}" required>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <label
                            class="form-label me-2 mb-0 w-100 text-muted small">{{ __('general.user_type') }}:</label>
                        <select wire:model.live="role" class="form-select">
                            <option value="">{{ __('general.all') }}</option>
                            <option value="user">{{ __('general.user') }}</option>
                            <option value="admin">{{ __('general.admin') }}</option>
                            <option value="company">{{ __('general.company') }}</option>
                        </select>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-sm text-secondary">
                        <thead class="bg-light">
                            <tr>
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'user_name',
                                    'display_name' => __('general.name'),
                                ])
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'email',
                                    'display_name' => __('general.email'),
                                ])
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'type',
                                    'display_name' => __('general.account_type'),
                                ])
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'created_at',
                                    'display_name' => __('general.joined'),
                                ])
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'is_active',
                                    'display_name' => __('general.account'),
                                ])
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'is_connected',
                                    'display_name' => __('general.state'),
                                ])
                                <th scope="col" class="px-3 py-2">{{ __('general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr wire:key={{ $user->id }} class="border-bottom">
                                    <td scope="row" class="px-3 py-2">{{ $user->user_name }}</td>
                                    <td class="px-3 py-2">{{ $user->email }}</td>
                                    <td
                                        class="px-3 py-2 text-{{ $user->type === 'admin' ? 'success' : ($user->type === 'user' ? 'primary' : 'secondary') }}">
                                        {{ __('general.' . $user->type) }}
                                    </td>
                                    <td class="px-3 py-2">{{ $user->created_at }}</td>
                                    <td class="px-3 py-2 text-{{ $user->is_active ? 'success' : 'danger' }}">
                                        {{ $user->is_active ? __('general.activated') : __('general.not_activated') }}
                                    </td>
                                    <td class="px-3 py-2 text-{{ $user->is_connected ? 'success' : 'secondary' }}">
                                        {{ $user->is_connected ? __('general.connected') : __('general.offline') }}
                                    </td>
                                    <td class="px-3 py-2 text-end">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                wire:click='showUser({{ $user->id }})'><i
                                                    class="bi bi-file-text-fill"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm"><i
                                                    class="bi bi-pen-fill"></i></button>

                                            <div x-data="{ showOverlay: false }">
                                                <button type="button" x-on:click="showOverlay = !showOverlay"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>


                                                <div x-show="showOverlay" x-cloak>
                                                    <div style="z-index: 999"
                                                        class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50">
                                                        <div class="bg-white p-4 rounded shadow-lg text-center"
                                                            @click.outside="showOverlay = !showOverlay">
                                                            <h2 class="fs-5 fw-bold mb-3">
                                                                {{ __('general.confirm_delete') }} <span
                                                                    class="text-danger">{{ $user->user_name }}</span>?
                                                            </h2>
                                                            <p>{{ __('general.cannot_undo') }}</p>
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <button wire:click="delete(@js($user->id))"
                                                                    class="btn btn-danger">{{ __('general.yes_delete') }}</button>
                                                                <button @click="showOverlay = false"
                                                                    class="btn btn-secondary">{{ __('general.cancel') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links('livewire::bootstrap') }}
            </div>
        </div>
    </section>
</div>
