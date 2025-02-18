<div style="display: inline-block; width: 100%;">
  <form wire:submit.prevent="search" class="d-flex">
    @csrf
    <div class="input-group">
      <input wire:model="query" class="form-control text-end border-start-0" type="search"
             placeholder="{{ __('general.search_placeholder') }}"
             aria-label="{{ __('general.search') }}" dir="rtl">
             <span class="input-group-text rounded-0 rounded-start">
                <i class="bi bi-search text-primary"></i>
              </span>
    </div>
  </form>
</div>
