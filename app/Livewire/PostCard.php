<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Livewire\Forms\JobOfferForm;
use App\Models\Interest;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCard extends Component
{
    use WithFileUploads;
    #[Title('Feed')]

    public JobOfferForm $JOForm;
    public ArticleForm $articleForm;
    public $showCard;
    public $selected;
    public $selectedInterests = [];
    public $interests;

    public function mount()
    {
        $this->showCard = false;
        $this->selected = 'content-article';
        $this->interests = Interest::select('id', 'name')->get();
    }

    public function SubmitArticleForm()
    {
        $this->articleForm->submit();
    }
    public function SubmitJobOfferForm()
    {
        $this->JOForm->submit();
    }


    public function render()
    {
        return view('livewire.post-card');
    }
}
