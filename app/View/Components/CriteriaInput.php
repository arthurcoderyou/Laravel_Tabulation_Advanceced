<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CriteriaInput extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $criteriaName,
        public bool $checked,
        public int $criteriaId,
        public int $judgeId,
        public int $contestantId,
        public int $contestId,
        public string $link
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.criteria-input');
    }
}
