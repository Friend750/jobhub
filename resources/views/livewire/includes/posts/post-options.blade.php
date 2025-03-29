@if($post->type == 'post')
    <div x-data="{ showOptions: false }" class="position-relative d-inline-block">
        <a href="#" @click.prevent="showOptions = !showOptions" class="text-muted">
            <i class="bi bi-three-dots-vertical p-1 btn"></i>
        </a>

        <div x-show="showOptions" @click.away="showOptions = false" x-cloak class="card overlay-card absolute" x-transition>
            <ul class="list-group list-group-flush">
                <li class="list-group-item hover_color">
                    <a href="#" class="text-decoration-none text-dark w-100 d-flex justify-content-between">
                        <small>إلغاء المتابعة</small>
                        <i class="bi bi-person-dash"></i>
                    </a>
                </li>
                <li class="list-group-item hover_color">
                    <a href="#" class="text-decoration-none text-dark d-flex justify-content-between">
                        <small>غير مهتم</small>
                        <i class="bi bi-emoji-expressionless"></i>
                    </a>
                </li>
                <li class="list-group-item hover_color">
                    <a href="#" class="text-decoration-none text-dark d-flex justify-content-between">
                        <small>نسخ الرابط</small>
                        <i class="bi bi-link-45deg"></i>
                    </a>
                </li>
                <li class="list-group-item hover_color">
                    <a href="#" class="text-decoration-none text-danger fw-bold d-flex justify-content-between">
                        <small>حذف المنشور</small>
                        <i class="bi bi-trash"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@else
    <a href="#" class="btn color-bg-blue-light text-primary mr-1 fw-bold d-flex align-items-center gap-1">
        <span> معرفة التفاصيل</span>
        <i class="fa-solid fa-square-arrow-up-right"></i>
    </a>
@endif
