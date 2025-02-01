<div>
    <section class="mt-4">
        <div class="container-xl px-4">
            <div class="bg-white shadow-sm rounded overflow-hidden">
                <!-- Filters Section -->
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between p-3 gap-3">
                    <!-- Search Input -->
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <svg aria-hidden="true" class="text-secondary" width="20" height="20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                                </svg>
                            </span>
                            <input type="search" 
                                   wire:model.live.debounce.400ms="search"
                                   class="form-control ps-2"
                                   placeholder="Search Jobs"
                                   aria-label="Search jobs">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="d-flex align-items-center gap-2 w-md-25">
                        <label class="form-label text-muted mb-0">Job Status:</label>
                        <select wire:model.live="status" class="form-select flex-grow-1">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Jobs Table -->
                <div class="table-responsive">
                    <table class="table table-sm text-secondary m-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-3 py-2">Job Title</th>
                                <th class="px-3 py-2">Creator</th>
                                <th class="px-3 py-2">Location</th>
                                <th class="px-3 py-2">Timing</th>
                                <th class="px-3 py-2">Tags</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Posted On</th>
                                <th class="px-3 py-2 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobPosts as $jobPost)
                            <tr wire:key="{{ $jobPost->id }}" class="border-bottom">
                                <td class="px-3 py-2 align-middle">{{ $jobPost->job_title }}</td>
                                <td class="px-3 py-2 align-middle">{{ $jobPost->user->user_name ?? 'N/A' }}</td>
                                <td class="px-3 py-2 align-middle">{{ $jobPost->job_location }}</td>
                                <td class="px-3 py-2 align-middle">{{ $jobPost->job_timing }}</td>
                                <td class="px-3 py-2 align-middle">
                                    @foreach (json_decode($jobPost->tags) as $tag)
                                    <span class="badge bg-secondary me-1">{{ $tag }}</span>
                                    @endforeach
                                </td>
                                <td class="px-3 py-2 align-middle text-{{ $jobPost->is_active ? 'success' : 'danger' }}">
                                    {{ $jobPost->is_active ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-3 py-2 align-middle">
                                    {{ $jobPost->job_post ?? $jobPost->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-3 py-2 text-end align-middle">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button class="btn btn-primary btn-sm"
                                                wire:click="view({{ $jobPost->id }})"
                                                aria-label="View job details">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm"
                                                wire:click="edit({{ $jobPost->id }})"
                                                aria-label="Edit job">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                                wire:click="delete({{ $jobPost->id }})"
                                                aria-label="Delete job">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center p-3">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <label class="form-label text-muted me-2 mb-0">Per Page:</label>
                        <select wire:model.live="per_page" class="form-select" style="width: 80px;">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    {{ $jobPosts->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
    </section>

    <!-- View Modal -->
    <div x-data="{ showModal: false }"
         x-show="showModal"
         @show-view-modal.window="showModal = true"
         @hide-view-modal.window="showModal = false"
         x-cloak
         class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $job_title }}</h5>
                    <button type="button" class="btn-close" @click="showModal = false"></button>
                </div>
                <div class="modal-body text-start">
                    <dl class="row">
                        <dt class="col-sm-4">Location:</dt>
                        <dd class="col-sm-8">{{ $job_location }}</dd>

                        <dt class="col-sm-4">Timing:</dt>
                        <dd class="col-sm-8">{{ $job_timing }}</dd>

                        <dt class="col-sm-4">Creator:</dt>
                        <dd class="col-sm-8">{{ $creator_name }}</dd>

                        <dt class="col-sm-4">About Job:</dt>
                        <dd class="col-sm-8">{{ $about_job }}</dd>

                        <dt class="col-sm-4">Tasks:</dt>
                        <dd class="col-sm-8">{{ $job_tasks }}</dd>

                        <dt class="col-sm-4">Conditions:</dt>
                        <dd class="col-sm-8">{{ $job_conditions }}</dd>

                        <dt class="col-sm-4">Required Skills:</dt>
                        <dd class="col-sm-8">{{ $job_skills }}</dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>