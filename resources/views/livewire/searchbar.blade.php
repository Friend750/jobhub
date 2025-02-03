<div style="display: inline-block; width: 100%;">
  <form wire:submit.prevent="search" class="d-flex">
    @csrf
    <div class="input-group">
      <span class="input-group-text">
        <i class="bi bi-search text-primary"></i>
      </span>
      <input wire:model="query" class="form-control text-end border-start-0" type="search"
             placeholder="{{ __('general.search_placeholder') }}" 
             aria-label="{{ __('general.search') }}" dir="rtl">
    </div>
  </form>
</div>
