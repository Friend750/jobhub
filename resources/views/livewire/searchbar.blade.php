

<div style="display: inline-block">
  <form wire:submit.prevent="search" class="d-flex">
    @csrf
    <input wire:model="query" class="form-control" type="search" placeholder="Search" aria-label="Search">
</form>
</div>
