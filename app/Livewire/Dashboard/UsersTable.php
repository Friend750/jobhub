<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $role = '';
    public $per_page = 5;

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function SetSortBy($fieldName)
    {

        if ($this->sortBy === $fieldName) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }

        $this->sortBy = $fieldName;
        $this->sortDirection = 'desc';
    }
    public function delete(User $user)
    {
        $user->delete();
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view(
            'livewire.dashboard.users-table',
            [
                'users' => User::search($this->search)
                    ->when($this->role !== '', function ($query) {
                        $query->where('type', $this->role);
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->per_page)
            ]
        );
    }
}
