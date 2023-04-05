<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ParentComponent extends Component
{
    use WithPagination;
    protected $paginationTheme="bootstrap";
}
