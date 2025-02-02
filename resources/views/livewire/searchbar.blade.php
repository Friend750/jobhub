<div style="display: inline-block">
  <form wire:submit.prevent="search" class="d-flex">
    @csrf
    <input wire:model="query" class="form-control" type="search" 
        placeholder="{{ __('general.search_placeholder') }}" 
        aria-label="{{ __('general.search') }}">
  </form>
</div>
