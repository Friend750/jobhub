<div class="comments mt-3" x-show="showComments" x-transition x-cloak>
    <div class="d-flex align-items-start mb-3">
        <form class="comment-form">
            <div class="textarea-container">
                <textarea class="form-control comment-input comment-area" rows="1" placeholder="أضف تعليق..." required
                    oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, parseInt(getComputedStyle(this).lineHeight) * 6) + 'px';"></textarea>
                <button type="submit" class="btn send-button">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="comment">
        <div class="d-flex justify-content-between align-items-start">
            <a href="#" class="text-decoration-none text-dark">
                <div class="d-flex align-items-center">
                    <img src="{{ $post->user->user_image ? asset('storage/' . $post->user->user_image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->personal_details->first_name ?? 'User') }}"
                        alt="User" loading="lazy" class="rounded-circle ms-2"
                        style="width: 40px; height: 40px; object-fit: cover;">

                    <div class="d-flex flex-column gap-0">
                        <h5 class="mb-0">{{ $post->user->personal_details->first_name ?? 'مستخدم' }}
                            {{ $post->user->personal_details->last_name ?? 'مستخدم' }}
                        </h5>
                        <small
                            class="fw-bold text-muted">{{ $post->user->personal_details->specialist ?? 'null' }}</small>
                    </div>
                </div>
            </a>
            <small class="text-muted ml-1">منذ يوم واحد</small>
        </div>
        <div style="margin-left: 40px">
            <small class="mt-2 ms-3 mb-0">للتأكيد، هذه الأسئلة مخصصة لمطوري MERN المبتدئين؟</small>
            <div class="ml-3">

                <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1"
                    style="font-size: 13px;">اعجبني</a><span class="text-muted">|</span>
                <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1 disabled"
                    style="font-size: 13px;">رد (قريبا)</a>
            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-link text-decoration-none mt-3"><small class="text-muted">تحميل المزيد من التعليقات</small></button>
    </div>
</div>
