<div>
    <section class="mt-4">
        <div class="container-xl px-4">
            <div class="bg-white shadow-sm rounded overflow-hidden">
                <!-- 🔹 إشعارات الجلسة -->
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- 🔹 قسم البحث والفلاتر -->
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between p-3 gap-3">
                    <div class="flex-grow-1">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-search text-secondary"></i>
                            </span>
                            <input type="search" wire:model.debounce.400ms="search"
                                   class="form-control ps-2"
                                   placeholder="Search Jobs">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2 w-md-25">
                        <label class="form-label text-muted mb-0">Job Status:</label>
                        <select wire:model="status" class="form-select flex-grow-1">
                            <option value="">All</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- 🔹 جدول عرض الوظائف -->
                <div class="table-responsive">
                    <table class="table table-sm text-secondary m-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Job Title</th>
                                <th>Creator</th>
                                <th>Location</th>
                                <th>Timing</th>
                                <th>Tags</th>
                                <th>Status</th>
                                <th>Posted On</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobPosts as $jobPost)
                            <tr wire:key="{{ $jobPost->id }}">
                                <td>{{ $jobPost->job_title }}</td>
                                <td>{{ optional($jobPost->user)->user_name ?? 'N/A' }}</td>
                                <td>{{ $jobPost->job_location }}</td>
                                <td>{{ $jobPost->job_timing }}</td>
                                <td>
                                    @foreach ($jobPost->tags as $tag)
                                    <span class="badge bg-secondary me-1">{{ $tag }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ $jobPost->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $jobPost->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $jobPost->job_post ?? $jobPost->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <button class="btn btn-primary btn-sm" wire:click="view({{ $jobPost->id }})">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $jobPost->id }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                            @click="if(confirm('Are you sure?')) { $wire.delete({{ $jobPost->id }}) }">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $jobPosts->links('livewire::bootstrap') }}

            </div>
        </div>
    </section>

    <!-- 🔹 نافذة عرض تفاصيل الوظيفة -->
    <div x-data="{ showModal: false }"
         x-show="showModal"
         @show-view-modal.window="showModal = true"
         @hide-view-modal.window="showModal = false"
         x-cloak
         class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $selectedJob->job_title ?? 'Job Details' }}</h5>
                    <button type="button" class="btn-close" @click="showModal = false"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Location:</strong> {{ $selectedJob->job_location ?? 'N/A' }}</p>
                    <p><strong>About:</strong> {{ $selectedJob->about_job ?? 'N/A' }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="showModal = false">Close</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- 🔹 نافذة تعديل الوظيفة -->
    <div x-data="{ showEditModal: false }"
         x-show="showEditModal"
         @show-edit-modal.window="showEditModal = true"
         @hide-edit-modal.window="showEditModal = false"
         x-cloak
         class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Job</h5>
                    <button type="button" class="btn-close" @click="showEditModal = false"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateJob">
                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" wire:model="selectedJob.job_title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" wire:model="selectedJob.job_location" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="showEditModal = false">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
