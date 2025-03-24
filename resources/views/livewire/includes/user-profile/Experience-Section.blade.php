<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>الخبرات</h5>
        </div>

        <ul class="list-unstyled" x-data="experienceForm(@this)">
            @forelse ($experiences as $experience)
                <li class="py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $experience->job_title }} | {{ $experience->company_name }} |
                            {{ $experience->location }}</strong>
                        <div class="d-flex align-items-center">
                            <strong class="">
                                {{ $experience->start_date->format('M Y') }} –
                                {{ $experience->end_date->format('M Y') ?? 'Present' }}
                            </strong>
                            @if (auth()->user()->id === $user->id)
                                <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                                    data-bs-target="#EditExperience" x-on:click="oldData({{ $experience->id }})"></i>
                            @endif

                        </div>
                    </div>
                    <p class="text-muted mt-1">{{ $experience->description ?? 'No description provided' }}</p>
                </li>
                @if (!$loop->last)
                    <hr>
                @endif
                <!-- Modal EditExperience -->
                @include('livewire.includes.user-profile.modExperiance')
            @empty
                <li class="text-muted text-center py-3">لم يتم إضافة أي خبرة عمل بعد.</li>
            @endforelse
        </ul>
        {{-- message --}}
    </div>
</div>
@if (session('ExperienceMsg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('ExperienceMsg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditExperience');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });

    function experienceForm($wire) {
        return {
            experienceId: null,
            oldData(id) {
                this.experienceId = id; // Set the experienceId
                $wire.getOldExp(id); // Call Livewire method with the ID
            },
            removeExperience() {
                $wire.deleteExp(this.experienceId); // Call Livewire method with the ID
                // hide modal
                let modalElement = document.getElementById('EditExperience');
                if (modalElement) {
                    bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                }
            }
        }
    };
</script>
