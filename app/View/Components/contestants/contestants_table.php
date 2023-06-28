<?php

namespace App\View\Components\contestants;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class contestants_table extends Component
{
    public $contestants;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->contestants = User::where('role','contestant')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.contestants.contestants_table');
    }
}
