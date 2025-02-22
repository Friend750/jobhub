@push('styles')
    <link rel="stylesheet" href="{{ asset('css/enhanceProfile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enhanceProfile.css') }}">
@endpush

<div>


    <div x-data="{ userType: @js($userType) }">

        <!-- User Cards Form (Only renders if userType is 'user' or 'admin') -->
        <template x-if="userType === 'user' || userType === 'admin'">
            <form wire:submit.prevent="saveAllForms">
                <div x-data="sectionManager(@this)">
                    <div class="container mt-5">
                        <div class="row d-flex justify-content-center">

                            <!-- Sidebar (Heavy Component) -->
                            @include('livewire.includes.enhance-profile.sidebar')

                            <!-- Content Area (Heavy Component) -->
                            @include('livewire.includes.enhance-profile.content-area')


                        </div>
                    </div>
                </div>
            </form>
        </template>

        <!-- Company Card Form (Only renders if userType is 'company') -->
        <template x-if="userType === 'company'">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center vh-100">
                    <div class="col-md-6">
                        @include('livewire.includes.enhance-profile.company-card')
                    </div>
                </div>
            </div>
        </template>

    </div>
</div>

<script>
    // if we want to use $wire in alpine scope we need to pass wire to the component name 'sectionManager' then receive as '@this'
    document.addEventListener('alpine:init', () => {
        Alpine.data('sectionManager', (wire) => ({ // 'wire' important to access Livewire properties
            activeSections: [],
            toggleSection(section) {
                console.log("toggleSection");

                console.log("toggleSection");

                if (this.activeSections.includes(section)) {
                    this.activeSections = this.activeSections.filter(s => s !== section);
                } else {
                    this.activeSections.push(section);
                    console.log(this.activeSections);

                    console.log(this.activeSections);

                }
                wire.set('activeSections', this.activeSections, false);
                wire.set('activeSections', this.activeSections, false);
            }
        }));
    });
</script>
