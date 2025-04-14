@php
    $user = $job->user ?? null;
    $userImage = $user->user_image ?? null;
    $userName = $user->user_name ?? 'Unknown';
    $details = $user->personal_details ?? null;
@endphp

<div class="container p-3 bg-light rounded mb-2 card-hover" style="height: fit-content;" wire:key="{{ $job->id }}"
    x-on:click="selectJob({{ $job->id }})">

    <div class="d-flex align-items-start p-3 bg-white rounded-1"
        :class="{ 'hover-sm-border': isSelected({{ $job->id }}) }">
        <div class="ms-2">
            @include('livewire.includes.jobs.user-image')
        </div>
        <div>
            <h5 class="mb-0 text-primary">
                {{ $job->job_title ?? 'null' }}
            </h5>

            <p class="mb-0 text-muted f-small">
                @if ($details && $details->page_name && $user->type == 'company')
                    {{ $details->page_name }}
                @elseif ($details && ($details->first_name || $details->last_name))
                    {{ $details->first_name }} {{ $details->last_name }}
                @else
                    {{ $user->user_name ?? 'Unknown' }}
                @endif
            </p>
            <p class="mb-0 text-muted f-small">
                <i class="bi bi-geo-alt-fill"></i>
                {{ $job->job_location ?? '' }} • {{ $job->created_at->diffForHumans() }}
            </p>
        </div>
    </div>
</div>
