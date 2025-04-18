<div>
    <!-- Main Section -->
    <section class="mt-4" aria-labelledby="jobs-management-heading">
        <div class="container-xl px-4">
            <div class="bg-white shadow-sm rounded-3 overflow-hidden">

                <!-- Header Section -->
                <div class="border-bottom p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 id="jobs-management-heading" class="h5 mb-0 text-primary">
                            <i class="bi bi-briefcase me-2" aria-hidden="true"></i> إدارة الوظائف
                        </h2>
                    </div>
                </div>

                <!-- Session Notifications -->
                <div class="notifications-wrapper px-4 pt-3" aria-live="polite">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
                        </div>
                    @endif
                </div>

                <!-- Search and Filters Section -->
                <div class="filters-section bg-light p-4 border-bottom">
                    <div class="row g-3 align-items-center">
                        <!-- Search Input -->
                        <div class="col-md-5">
                            <label for="job-search" class="visually-hidden">ابحث بالوظائف</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted" aria-hidden="true"></i>
                                </span>
                                <input id="job-search" type="search" wire:model.live.debounce.500ms="search"
                                    class="form-control ps-2 border-start-0" placeholder="ابحث بالوظائف..." aria-label="ابحث بالوظائف">
                                <span class="input-group-text bg-white border-start-0">
                                    <div wire:loading wire:target="search">
                                        <span class="spinner-border spinner-border-sm text-primary"
                                            role="status" aria-hidden="true"></span>
                                        <span class="visually-hidden">جاري البحث...</span>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-2">
                                <label for="status-filter" class="form-label text-muted mb-0 d-none d-md-block">الحالة:</label>
                                <select id="status-filter" wire:model.live="status" class="form-select shadow-sm" aria-label="تصفية حسب الحالة">
                                    <option value="">الكل</option>
                                    <option value="active">نشطة</option>
                                    <option value="inactive">غير نشطة</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pagination Filter -->
                        <div class="col-md-2">
                            <div class="d-flex align-items-center gap-2">
                                <label for="per-page-filter" class="form-label text-muted mb-0 d-none d-md-block">عرض:</label>
                                <select id="per-page-filter" wire:model.live="per_page" class="form-select shadow-sm" aria-label="عدد العناصر لكل صفحة">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>

                        <!-- Reset Filters -->
                        <div class="col-md-2">
                            <button wire:click="resetFilters" class="btn btn-outline-secondary w-100" aria-label="إعادة تعيين الفلاتر">
                                <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i> إعادة تعيين
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Jobs Table Section -->
                <div class="table-section">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm m-0" aria-describedby="jobs-management-heading">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="ps-4">الوظيفة</th>
                                    <th scope="col">الموقع</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">المشاهدات</th>
                                    <th scope="col" class="text-start ps-5">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobPosts as $jobPost)
                                    <tr wire:key="job-row-{{ $jobPost->id }}">
                                        <td class="ps-4 fw-medium">{{ $jobPost->job_title }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-geo-alt text-muted" aria-hidden="true"></i>
                                                {{ $jobPost->job_location }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch d-inline-block">
                                                <input
                                                    wire:change="updateStatus({{ $jobPost->id }}, $event.target.checked ? 1 : 0)"
                                                    class="form-check-input" type="checkbox"
                                                    id="status-{{ $jobPost->id }}"
                                                    {{ $jobPost->is_active ? 'checked' : '' }}
                                                    aria-label="تبديل حالة الوظيفة">
                                                <label class="form-check-label" for="status-{{ $jobPost->id }}">
                                                    <span
                                                        class="badge {{ $jobPost->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                                        {{ $jobPost->is_active ? 'نشطة' : 'غير نشطة' }}
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-eye text-muted" aria-hidden="true"></i>
                                                {{ $jobPost->views }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ Route('jobList', $jobPost->id) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   wire:loading.attr="disabled"
                                                   aria-label="عرض الوظيفة {{ $jobPost->job_title }}">
                                                    <i class="bi bi-eye" aria-hidden="true"></i>
                                                    <span class="d-none d-md-inline">عرض</span>
                                                </a>
                                                <button wire:click="confirmDelete({{ $jobPost->id }})"
                                                    wire:loading.attr="disabled" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    aria-label="حذف الوظيفة {{ $jobPost->job_title }}">
                                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                                    <span class="d-none d-md-inline">حذف</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-4" aria-hidden="true"></i>
                                            <p class="mb-0">لا توجد وظائف متاحة</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Loading Indicator -->
                    <div wire:loading.class.remove="d-none" class="d-none text-center py-4" aria-live="polite">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">جاري التحميل...</span>
                        </div>
                        <p class="mt-2 text-muted">جاري تحميل البيانات...</p>
                    </div>

                    <!-- Pagination -->
                    @if ($jobPosts->hasPages())
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
        <div class="modal fade show d-block" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
            wire:key="job-modal-{{ $modalType }}" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-light border-0">
                        <h5 class="modal-title" id="modalLabel">
                            <i class="bi {{ $modalType === 'view' ? 'bi-eye' : 'bi-pencil-square' }} me-2" aria-hidden="true"></i>
                            {{ $modalType === 'view' ? 'عرض تفاصيل الوظيفة' : 'تعديل الوظيفة' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"
                            aria-label="إغلاق"></button>
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
                                        <div class="fw-medium" style="white-space: pre-line;">{{ $selectedJob['about_job'] ?? 'غير محدد' }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">المهام:</label>
                                        <div class="fw-medium" style="white-space: pre-line;">{{ $selectedJob['job_tasks'] ?? 'غير محدد' }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الشروط:</label>
                                        <div class="fw-medium" style="white-space: pre-line;">{{ $selectedJob['job_conditions'] ?? 'غير محدد' }}</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">المهارات المطلوبة:</label>
                                        <div class="fw-medium" style="white-space: pre-line;">{{ $selectedJob['job_skills'] ?? 'غير محدد' }}</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label class="form-label text-muted">الوسوم:</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if (!empty($selectedJob['tags']))
                                                @foreach ($selectedJob['tags'] as $tag)
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
                                        <span
                                            class="badge {{ $selectedJob['is_active'] ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                            {{ $selectedJob['is_active'] ? 'نشطة' : 'غير نشطة' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                                    <i class="bi bi-x-lg me-1" aria-hidden="true"></i> إغلاق
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Backdrop -->
        <div class="modal-backdrop fade show"></div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" aria-hidden="true" wire:key="delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i> تأكيد الحذف
                        </h5>
                        <button type="button" class="btn-close"
                            wire:click="$set('showDeleteModal', false)" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body py-4">
                        <p>هل أنت متأكد من رغبتك في حذف هذه الوظيفة؟</p>
                        <p class="fw-medium">{{ $deleteJobTitle }}</p>
                        <p class="small text-muted">هذا الإجراء لا يمكن التراجع عنه.</p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary"
                            wire:click="$set('showDeleteModal', false)">
                            <i class="bi bi-x-lg me-1" aria-hidden="true"></i> إلغاء
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="delete">
                            <i class="bi bi-trash me-1" aria-hidden="true"></i> حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Backdrop -->
        <div class="modal-backdrop fade show"></div>
    @endif
</div>