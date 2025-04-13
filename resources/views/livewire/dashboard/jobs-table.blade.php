<div>
    <!-- Main Section -->
    <section class="mt-4">
        <div class="container-xl px-4">
            <div class="bg-white shadow-sm rounded-3 overflow-hidden">
                
                <!-- Header Section -->
                <div class="border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0 text-primary">
                            <i class="bi bi-briefcase me-2"></i> إدارة الوظائف
                        </h2>
                    </div>
                </div>
                
                <!-- Session Notifications -->
                <div class="notifications-wrapper px-4 pt-3">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                </div>

                <!-- Search and Filters Section -->
                <div class="filters-section bg-light p-4 border-bottom">
                    <div class="row g-3 align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-5">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="search" 
                                       wire:model.live.debounce.500ms="search" 
                                       class="form-control ps-2 border-start-0" 
                                       placeholder="ابحث بالوظائف...">
                                <span class="input-group-text bg-white border-start-0">
                                    <div wire:loading wire:target="search">
                                        <span class="spinner-border spinner-border-sm text-primary" role="status"></span>
                                    </div>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="form-label text-muted mb-0 d-none d-md-block">الحالة:</label>
                                <select wire:model.live="status" class="form-select shadow-sm">
                                    <option value="">الكل</option>
                                    <option value="active">نشطة</option>
                                    <option value="inactive">غير نشطة</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Pagination Filter -->
                        <div class="col-md-2">
                            <div class="d-flex align-items-center gap-2">
                                <label class="form-label text-muted mb-0 d-none d-md-block">عرض:</label>
                                <select wire:model.live="per_page" class="form-select shadow-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Reset Filters -->
                        <div class="col-md-2">
                            <button wire:click="resetFilters" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-counterclockwise"></i> إعادة تعيين
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Jobs Table Section -->
                <div class="table-section">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm m-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">الوظيفة</th>
                                    <th>الموقع</th>
                                    <th>الحالة</th>
                                    <th>المشاهدات</th>
                                    <th class="text-end pe-4">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobPosts as $jobPost)
                                    <tr>
                                        <td class="ps-4 fw-medium">{{ $jobPost->job_title }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-geo-alt text-muted"></i>
                                                {{ $jobPost->job_location }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch d-inline-block">
                                                <input 
                                                    wire:change="updateStatus({{ $jobPost->id }}, $event.target.checked ? 1 : 0)"
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    id="status-{{ $jobPost->id }}" 
                                                    {{ $jobPost->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status-{{ $jobPost->id }}">
                                                    <span class="badge {{ $jobPost->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                                        {{ $jobPost->is_active ? 'نشطة' : 'غير نشطة' }}
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-eye text-muted"></i>
                                                {{ $jobPost->views }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button wire:click="view({{ $jobPost->id }})" 
                                                        wire:loading.attr="disabled"
                                                        class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                    <span class="d-none d-md-inline">عرض</span>
                                                </button>
                                                <button wire:click="edit({{ $jobPost->id }})" 
                                                        wire:loading.attr="disabled"
                                                        class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                    <span class="d-none d-md-inline">تعديل</span>
                                                </button>
                                                <button wire:click="confirmDelete({{ $jobPost->id }})" 
                                                        wire:loading.attr="disabled"
                                                        class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                    <span class="d-none d-md-inline">حذف</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-0">لا توجد وظائف متاحة</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Loading Indicator -->
                    <div wire:loading.class.remove="d-none" class="d-none text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">جاري التحميل...</span>
                        </div>
                        <p class="mt-2 text-muted">جاري تحميل البيانات...</p>
                    </div>

                    <!-- Pagination -->
                    @if($jobPosts->hasPages())
                    <div class="pagination-wrapper px-4 py-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                عرض <span class="fw-medium">{{ $jobPosts->firstItem() }}</span>
                                إلى <span class="fw-medium">{{ $jobPosts->lastItem() }}</span>
                                من <span class="fw-medium">{{ $jobPosts->total() }}</span> نتائج
                            </div>
                            {{ $jobPosts->onEachSide(1)->links('livewire::bootstrap') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- View/Edit Job Modal -->
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" wire:key="job-modal-{{ $modalType }}">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-light border-0">
                        <h5 class="modal-title" id="modalLabel">
                            <i class="bi {{ $modalType === 'view' ? 'bi-eye' : 'bi-pencil-square' }} me-2"></i>
                            {{ $modalType === 'view' ? 'عرض تفاصيل الوظيفة' : 'تعديل الوظيفة' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body py-4">
                        @if ($modalType === 'view')
                            <!-- View Mode Content -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">عنوان الوظيفة:</label>
                                        <p class="fw-medium">{{ $selectedJob['job_title'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الموقع:</label>
                                        <p class="fw-medium">{{ $selectedJob['job_location'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">حول الوظيفة:</label>
                                        <p class="fw-medium">{{ $selectedJob['about_job'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">المهام:</label>
                                        <p class="fw-medium">{{ $selectedJob['job_tasks'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الشروط:</label>
                                        <p class="fw-medium">{{ $selectedJob['job_conditions'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">المهارات المطلوبة:</label>
                                        <p class="fw-medium">{{ $selectedJob['job_skills'] ?? 'غير محدد' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الوسوم:</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if(!empty($selectedJob['tags']))
                                                @foreach($selectedJob['tags'] as $tag)
                                                    <span class="badge bg-primary">{{ $tag }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">لا توجد وسوم</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الحالة:</label>
                                        <span class="badge {{ $selectedJob['is_active'] ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                            {{ $selectedJob['is_active'] ? 'نشطة' : 'غير نشطة' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                                    <i class="bi bi-x-lg me-1"></i> إغلاق
                                </button>
                            </div>
                        @else
                            <!-- Edit Mode Form -->
                            <form wire:submit.prevent="updateJob">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_title" class="form-label">عنوان الوظيفة <span class="text-danger">*</span></label>
                                            <input type="text" wire:model="selectedJob.job_title" class="form-control" id="job_title" required>
                                            @error('selectedJob.job_title') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                            <input type="text" wire:model="selectedJob.job_location" class="form-control" id="job_location" required>
                                            @error('selectedJob.job_location') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="about_job" class="form-label">حول الوظيفة</label>
                                            <textarea wire:model="selectedJob.about_job" class="form-control" id="about_job" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_tasks" class="form-label">المهام</label>
                                            <textarea wire:model="selectedJob.job_tasks" class="form-control" id="job_tasks" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_conditions" class="form-label">الشروط</label>
                                            <textarea wire:model="selectedJob.job_conditions" class="form-control" id="job_conditions" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="job_skills" class="form-label">المهارات المطلوبة</label>
                                            <textarea wire:model="selectedJob.job_skills" class="form-control" id="job_skills" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">الوسوم (مفصولة بفواصل)</label>
                                            <input type="text" wire:model="selectedJob.tags" class="form-control" id="tags">
                                            <small class="text-muted">مثال: وسم1, وسم2, وسم3</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" wire:model="selectedJob.is_active" class="form-check-input" id="is_active">
                                                <label class="form-check-label" for="is_active">الوظيفة نشطة</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-footer border-top-0">
                                    <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                                        <i class="bi bi-x-lg me-1"></i> إغلاق
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-1"></i> حفظ التغييرات
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Backdrop -->
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" aria-hidden="true" wire:key="delete-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> تأكيد الحذف
                        </h5>
                        <button type="button" class="btn-close" wire:click="$set('showDeleteModal', false)"></button>
                    </div>
                    <div class="modal-body py-4">
                        <p>هل أنت متأكد من رغبتك في حذف هذه الوظيفة؟</p>
                        <p class="fw-medium">{{ $deleteJobTitle }}</p>
                        <p class="small text-muted">هذا الإجراء لا يمكن التراجع عنه.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" wire:click="$set('showDeleteModal', false)">
                            <i class="bi bi-x-lg me-1"></i> إلغاء
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="delete">
                            <i class="bi bi-trash me-1"></i> حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Backdrop -->
        <div class="modal-backdrop fade show"></div>
    @endif
</div>