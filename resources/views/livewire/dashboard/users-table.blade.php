<div>
    <section class="mt-4">
        <div class="container-xl px-4">
            <!-- Start coding here -->
            <div class="bg-white shadow-sm rounded overflow-hidden">
                <div class="d-flex align-items-center justify-content-between p-3">
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
                                placeholder="Search" required>
                        </div>
                    </div>
                    <div class="d-flex ms-3">
                        <div class="d-flex align-items-center">
                            <label class="form-label me-2 mb-0 w-40 text-muted small">User Type:</label>
                            <select wire:model.live="role" class="form-select">
                                <option value="">All</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm text-secondary">
                        <thead class=" bg-light">
                            <tr>
                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'user_name',
                                    'display_name' => 'Name',
                                ])

                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'email',
                                    'display_name' => 'Email',
                                ])

                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'is_admin',
                                    'display_name' => 'Role',
                                ])

                                @include('livewire.includes.dashboard.users-table-header', [
                                    'name' => 'created_at',
                                    'display_name' => 'Joined',
                                ])

                                <th scope="col" class="px-3 py-2" wire:click="SetSortBy('updated_at')">Last Update
                                </th>
                                <th scope="col" class="px-3 py-2">
                                    <span class="visually-hidden">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr wire:key={{ $user->id }} class="border-bottom">
                                    <th scope="row" class="px-3 py-2 text-dark fw-bold">
                                        {{ $user->user_name }}
                                    </th>
                                    <td class="px-3 py-2">{{ $user->email }}</td>
                                    <td class="px-3 py-2 text-{{ $user->is_admin ? 'success' : 'primary' }}">
                                        {{ $user->is_admin ? 'Admin' : 'Member' }}
                                    </td>
                                    <td class="px-3 py-2">{{ $user->created_at }}</td>
                                    <td class="px-3 py-2">{{ $user->updated_at }}</td>
                                    <td class="px-3 py-2 text-end">
                                        <div class="d-flex">
                                            {{-- update method --}}
                                            <button class="btn btn-primary btn-sm me-2">
                                                <i class="bi bi-file-text-fill"></i>
                                            </button>

                                            {{-- read method --}}
                                            <button class="btn btn-primary btn-sm me-2">
                                                <i class="bi bi-pen-fill"></i>
                                            </button>

                                            {{-- delete method --}}
                                            <div x-data="{ showOverlay: false }">
                                                <!-- Button to show the overlay -->
                                                <button @click="showOverlay = !showOverlay"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>

                                                <div x-show="showOverlay" x-cloak>
                                                    <!-- Overlay -->
                                                    <div style="z-index: 999"
                                                        class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50">
                                                        <div class="bg-white p-4 rounded shadow-lg text-center"
                                                            @click.outside="showOverlay = !showOverlay" role="dialog"
                                                            aria-labelledby="modalTitle" aria-describedby="modalDesc">
                                                            <h2 id="modalTitle" class="fs-5 fw-bold mb-3">
                                                                Are you sure you want to delete <span
                                                                    class="text-danger">{{ $user->user_name }}</span>?
                                                            </h2>
                                                            <p id="modalDesc">This action cannot be undone.</p>
                                                            <div class="d-flex justify-content-center gap-3">
                                                                <!-- Confirm Deletion -->
                                                                <button wire:click="delete(@js($user->id))"
                                                                    class="btn btn-danger">
                                                                    Yes, Delete
                                                                </button>
                                                                <!-- Cancel -->
                                                                <button @click="showOverlay = false"
                                                                    class="btn btn-secondary">Cancel</button>
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

                <div class="p-3">
                    <div class="d-flex">
                        <div class="d-flex align-items-center mb-3">
                            <label class="form-label me-2 mb-0 text-muted small">Per Page:</label>
                            <select wire:model.live="per_page" class="form-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>

                    {{ $users->links('livewire::bootstrap') }}

                </div>


            </div>
        </div>
    </section>
</div>
