<div class="">
    {{-- chat card --}}
    <div>
        <div class="card bg-white rounded border shadow-sm flex-grow-1">
            <!-- Header -->
            <h5 class="card-header pt-3 pl-3">Chats</h5>

            <!-- Chat List -->
            <div class="card-body">
                <a href="{{ route('chat') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center clickable-div py-1  justify-content-start">
                        <img src="https://ui-avatars.com/api/?name=Image"  alt="User"
                            class="rounded-circle ms-2 sm-img">
                        <div>
                            <strong>Company name</strong>
                            <p class="text-muted small mb-0 truncate-text">Hey, how is your project?</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('chat') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center mb-1 clickable-div py-1  justify-content-start">
                        <img src="https://ui-avatars.com/api/?name=Image" alt="User"
                            class="rounded-circle ms-2 sm-img">
                        <div>
                            <strong>Company name</strong>
                            <p class="text-muted small mb-0 truncate-text">Hey, how is your project?</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('chat') }}" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center mb-1 clickable-div py-1  justify-content-start">
                        <img src="https://ui-avatars.com/api/?name=Image" alt="User"
                            class="rounded-circle ms-2 sm-img">
                        <div>
                            <strong>Company name</strong>
                            <p class="text-muted small mb-0 truncate-text">Hey, how is your project?</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- feed card --}}
    <div class=" card bg-white rounded border shadow-sm mt-3">
        <!-- Header -->
        <h5 class="card-header pt-3">Add to feed</h5>

        <!-- Feed List -->
        <div class="card-body">

            <div class="d-flex align-items-start mb-3">
                <img src="https://ui-avatars.com/api/?name=Image" alt="Company Logo"
                    class="rounded-circle ms-2 mt-1 sm-img">
                <div class="d-flex flex-column">
                    <div class="flex-grow-1">
                        <a href="#" class="text-dark font-weight-bold text-decoration-none"><strong>Company
                                name</strong></a>
                        <p class="text-muted small mb-0 truncate-text">Lorem ipsum dolor sit amet. Lorem, ipsum.</p>
                    </div>
                    <button class="badge badge-light btn-outline-primary border btn mt-1" style="width: fit-content"
                        x-data ="{state: false}" x-text ="state === false? 'follow': 'following'"
                        @click="state = !state"></button>
                </div>
            </div>
            <div class="d-flex align-items-start mb-3">
                <img src="https://ui-avatars.com/api/?name=Image" alt="Company Logo"
                    class="rounded-circle ms-2 mt-1 sm-img">
                <div class="d-flex flex-column">
                    <div class="flex-grow-1">
                        <a href="#" class="text-dark font-weight-bold text-decoration-none"><strong>Company
                                name</strong></a>
                        <p class="text-muted small mb-0 truncate-text">Lorem ipsum dolor sit amet. Lorem, ipsum.</p>
                    </div>
                    <button class="badge badge-light btn-outline-primary border btn mt-1" style="width: fit-content"
                        x-data ="{state: false}" x-text ="state === false? 'follow': 'following'"
                        @click="state = !state"></button>
                </div>
            </div>

        </div>
    </div>
    <style>
        .truncate-text{
            font-size: .75rem;
        }
    </style>

</div>
<script>
    document.querySelectorAll(".truncate-text").forEach(element => {
        let text = element.textContent;
        element.textContent = text.length > 30 ? text.substring(0, 30) + "..." : text;
    });
</script>
