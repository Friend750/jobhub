
<div class="container" style="margin-top: 5.5rem !important;">
    <div class="row">
        <!-- قسم إدارة الشبكة -->
        @livewire('manage-network')
        <!-- قسم قائمة الشركات -->
        <div class="col-md-8 containerOfNetwork">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h4 class="mt-3">{{ __('general.companies') }}</h4>
            </div>
            @foreach($companies as $company)
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <div class="d-flex align-items-center">
                    <!-- صورة افتراضية للشركة -->
                    <img src="https://ui-avatars.com/api/?name=Image"
                         alt="Logo" class="rounded-circle" width="40">
                    <div class="ms-3">
                        <strong>{{ $company['user_name'] }}</strong>
                        <div class="text-muted">{{ $company['position'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

