<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class TodoList extends Component
{
    use WithPagination;
    
    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;

    public function create() {
        $validated = $this->validateOnly('name');

        Todo::create($validated);
        $this->reset('name');
        session()->flash('success', 'Todo Save successfully');
    }

    public function render()
    {
        $todos  = Todo::latest()->paginate(5);
        return view('livewire.todo-list', [
            'todos' => $todos
        ]);
    }

}
