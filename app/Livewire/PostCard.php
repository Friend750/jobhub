<?php

namespace App\Livewire;

use App\Livewire\Forms\ArticleForm;
use App\Livewire\Forms\CommentForm;
use App\Livewire\Forms\JobOfferForm;
use App\Models\Interest;
use App\Models\Post;
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
    public CommentForm $commentForm;
    public $showCard;
    public $selected;
    public $selectedInterests = [];
    public $interests;
    public $media; // For the uploaded file (image or video)

    public function updatedMedia()
    {
        $this->articleForm->updateMedia($this->media);
    }

    // removeMedia
    public function removeMedia()
    {
        $this->articleForm->removeMedia();
    }

    public function resetForm($selectedForm)
    {
        if ($selectedForm == 'content-article') {
            $this->articleForm->reset();
        } else {
            $this->JOForm->reset();
        }
    }
    
    public function resetAllForms()
    {
        $this->articleForm->reset();
        $this->JOForm->reset();
        $this->selectedInterests = [];
    }
    

    public function SubmitArticleForm()
    {
        $this->articleForm->submit($this->selectedInterests);

        $this->dispatch('article-posted', ['message' => 'Article posted successfully']);
    }
    public function SubmitJobOfferForm()
    {
        $this->JOForm->submit();

        $this->dispatch('job-offer-posted', ['message' => 'Job Offer posted successfully']);
    }

    public function mount()
    {
        $this->showCard = false;
        $this->selected = 'content-article';
        $this->interests = Interest::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.post-card',[
            'posts' => Post::all(),
        ]);
    }
}
