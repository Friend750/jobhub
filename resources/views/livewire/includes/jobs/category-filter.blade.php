<div class="position-relative d-inline-block custom-select-container">
    <select wire:model.live="category"
        class="filter form-select m-0 py-2 border-2 border-primary border-opacity-10 rounded-3 text-right custom-select">
        <option value="">كل الفئات</option>
        @foreach ($categories as $cat)
        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <span class="position-absolute top-50 start-0 translate-middle-y ps-2 custom-select-icon">
        <i class="bi bi-chevron-down text-primary"></i>
    </span>
</div>
