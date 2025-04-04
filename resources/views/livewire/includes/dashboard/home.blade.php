<div class="container">
    <div class="row">
        <div class="col-md-6">

            <a href="" class="text-decoration-none" wire:click.prevent="switchSection('users')">
                <div class="card shadow mb-2 rounded">
                    <div class="card-body text-center">
                        <h1 class="bi bi-people-fill p-3 bg-dark text-light rounded"></h1>
                        <div class="d-flex flex-wrap justify-content-evenly align-items-center rounded py-2">
                            <div class="text-muted" style="min-width: 80px;">
                                <strong>{{ __('general.admins') }}</strong>
                                <h6>{{ $adminCount }}</h6>
                            </div>
                            <div class="text-muted" style="min-width: 80px;">
                                <strong>{{ __('general.users') }}</strong>
                                <h6>{{ $userCount }}</h6>
                            </div>
                            <div class="text-muted" style="min-width: 80px;">
                                <strong>{{ __('general.activated') }}</strong>
                                <h6>{{ $activatedCount }}</h6>
                            </div>
                            <div class="text-muted" style="min-width: 80px;">
                                <strong>{{ __('general.connected') }}</strong>
                                <h6>{{ $connectedCount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-2 rounded">
                <div class="card-body text-center">
                    <h1 class="bi bi-chat-left-dots-fill p-3 bg-dark text-light rounded"></h1>
                    <div class="d-flex flex-wrap justify-content-evenly align-items-center rounded py-2">
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.messages') }}</strong>
                            <h6>xxx</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-2 rounded">
                <div class="card-body text-center">
                    <h1 class="bi bi-briefcase-fill p-3 bg-dark text-light rounded"></h1>
                    <div class="d-flex flex-wrap justify-content-evenly align-items-center rounded py-2">
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.active_jobs') }}</strong>
                            <h6>xxx</h6>
                        </div>
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.old_jobs') }}</strong>
                            <h6>xxx</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-2 rounded">
                <div class="card-body text-center">
                    <h1 class="bi bi-hand-thumbs-up-fill p-3 bg-dark text-light rounded"></h1>
                    <div class="d-flex flex-wrap justify-content-evenly align-items-center rounded py-2">
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.likes') }}</strong>
                            <h6>xxx</h6>
                        </div>
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.comments') }}</strong>
                            <h6>xxx</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow mb-2 rounded">
                <div class="card-body text-center">
                    <h1 class="bi bi-calendar3 p-3 bg-dark text-light rounded"></h1>
                    <div class="d-flex flex-wrap justify-content-evenly align-items-center rounded py-2">
                        <div class="text-muted" style="min-width: 80px;">
                            <strong>{{ __('general.posts') }}</strong>
                            <h6>xxx</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
