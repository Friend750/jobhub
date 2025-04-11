<?php
// app/Http/Livewire/Questionnaire.php
namespace App\Livewire\CareerAI;

use Livewire\Component;

class Questionnaire extends Component
{
    public $questions;
    public $currentQuestionIndex = 0;
    public $currentCategory = 'technical';
    public $answer = '';

    public function mount()
    {
        $this->questions = session()->get('questions', [
            'technical' => [],
            'soft' => []
        ]);
    }

    public function nextQuestion()
    {
        // Store the user's answer (You might want to save this in DB)
        session()->push('userAnswers', [
            'question' => $this->questions[$this->currentCategory][$this->currentQuestionIndex],
            'answer' => $this->answer
        ]);

        $this->answer = ''; // Reset input

        // Move to the next question
        if ($this->currentQuestionIndex < count($this->questions[$this->currentCategory]) - 1) {
            $this->currentQuestionIndex++;
        } else {
            $this->currentCategory = $this->currentCategory === 'technical' ? 'soft' : null;
            $this->currentQuestionIndex = 0;
        }
    }
    public function render()
    {

        return view('livewire.careerAI.questionnaire', [
            'currentQuestion' => $this->questions[$this->currentCategory][$this->currentQuestionIndex] ?? null
        ]);
    }
}
