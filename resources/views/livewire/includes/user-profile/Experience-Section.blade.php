<div class="card mb-3 rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Experience</h5>
        </div>

        <ul class="list-unstyled">
            @forelse ($experiences as $experience)
                <li class="border-bottom py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $experience->job_title }} | {{ $experience->company_name }} |
                            {{ $experience->location }}</strong>
                        <div class="d-flex align-items-center">
                            <strong class="">
                                {{ $experience->start_date->format('M Y') }} –
                                {{ $experience->end_date->format('M Y') ?? 'Present' }}
                            </strong>
                            <i class="bi bi-pencil-square py-0 px-1 ms-3 btn" data-bs-toggle="modal"
                                data-bs-target="#EditExperience"></i>
                        </div>
                    </div>
                    <p class="text-muted mt-1">{{ $experience->description ?? 'No description provided' }}</p>
                </li>

                <!-- Modal EditExperience -->
                @include('livewire.includes.user-profile.modExperiance')
            @empty
                <li class="text-muted text-center py-3">No job experience added yet.</li>
            @endforelse
        </ul>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('close-modal', () => {
            let modalElement = document.getElementById('EditExperience');
            if (modalElement) {
                bootstrap.Modal.getOrCreateInstance(modalElement).hide();
            }
        });
    });
</script>
