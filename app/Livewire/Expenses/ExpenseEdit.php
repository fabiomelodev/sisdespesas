<?php

namespace App\Livewire\Expenses;

use App\Models\{Bank, Category, Expense as ExpenseModel};
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class ExpenseEdit extends Component
{
    public $expense;

    public $title;

    public $type;

    public $status;

    public $due_date;

    public $pay_day;

    public $value;

    public $category_id;

    public $bank_id;

    public string $searchCategory = '';

    public string $searchBank = '';

    protected $listeners = ['updateCategory'];

    // public $category;

    // public $bank;

    public function mount($id)
    {
        $this->expense = ExpenseModel::findOrFail($id);
    }

    public function update(ExpenseModel $expense)
    {
        $status = match($this->status) {
            false => 'pendente',
            true  => 'pago',
            default => null
        };

        $data = [
            'title'       => $this->title,
            'type'        => $this->type,
            'status'      => $status,
            'due_date'    => $this->due_date,
            'pay_day'     => $this->pay_day,
            'value'       => $this->value,
            'category_id' => $this->category_id,
            'bank_id'     => $this->bank_id
        ];

        $expense->update($data);

        $this->reset();
    }

    public function createCategory()
    {
        Category::create([
            'title' => $this->category
        ]);
    }

    public function createBank()
    {
        Bank::create([
            'title' => $this->bank
        ]);
    }

    public function render()
    {
        $categories = Category::when($this->searchCategory, fn (Builder $query) => $query->where('title', 'like', '%'. $this->searchCategory .'%'))
                        ->orderBy('title', 'asc')
                        ->get();

        $categoryCurrent = Category::when($this->category_id != null, fn (Builder $query) => $query->where('id', $this->category_id))->first();

        $banks = Bank::when($this->searchBank, fn (Builder $query) => $query->where('title', 'like', '%'. $this->searchBank .'%'))
                        ->orderBy('title', 'asc')
                        ->get();

        $bankCurrent = Bank::when($this->bank_id != null, fn (Builder $query) => $query->where('id', $this->bank_id))->first();

        return view('livewire.expenses.expense-edit', [
            'categories'      => $categories,
            'categoryCurrent' => $categoryCurrent,
            'banks'           => $banks,
            'bankCurrent'     => $bankCurrent
        ])->layout('layouts.app');
    }
}
