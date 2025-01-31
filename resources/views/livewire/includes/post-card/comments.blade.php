<div class="comments mt-3" x-show="showComments" x-transition x-cloak>
    <div class="d-flex align-items-start mb-3">
        <img src="https://ui-avatars.com/api/?name=user" loading="lazy" class="bg-secondary profile-picture-placeholder me-2"
            style="min-width: 40px;">
        </img>
        <form  method="post" class="d-flex flex-grow-1">

            <textarea class="form-control me-2 comment-input" rows="1" placeholder="Add a comment..." required
                oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, parseInt(getComputedStyle(this).lineHeight) * 4) + 'px';"></textarea>
            <button type="submit" class="btn btn-primary rounded">Comment</button>
        </form>
    </div>

    <div class="comment">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=user" loading="lazy"
                    class="bg-secondary profile-picture-placeholder"></img>
                <div class="ms-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Kapil Kasture</h6>
                    </div>
                    <small class="text-muted" style="font-size: 13px;">MERN Stack
                        Developer</small>
                </div>
            </div>
            <small class="text-muted ml-1">1 day ago</small>
        </div>
        <div style="margin-left: 40px">
            <p class="mt-2 ms-3 mb-0">Just to confirm these questions are for entry-level
                MERN
                dev?</p>
            <div class="ml-3">

                <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder pe-1"
                    style="font-size: 13px;">Like</a><span class="text-muted">|</span>
                <a class="btn btn-link text-decoration-none p-0 text-muted fw-bolder px-1 disabled"
                    style="font-size: 13px;">Reply (Soon)</a>
            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-link text-decoration-none mt-3 ">Load more comments</button>
    </div>
</div>
