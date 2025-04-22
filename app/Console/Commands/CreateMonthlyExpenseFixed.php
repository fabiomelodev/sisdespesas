<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\Fixed;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CreateMonthlyExpenseFixed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expense:create-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria uma despesa fixa automaticamente todo mês';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expensesFixed = Fixed::where('status', 'ativo')->where('type', 'fixo')->get();

        foreach ($expensesFixed as $expenseFixed) {
            $due_date = Carbon::now()->setDay($expenseFixed->due_date)->format('Y-m-d');

            Expense::updateOrCreate(
                [
                    'title' => $expenseFixed->title,
                    'due_date' => $due_date
                ],
                [
                    'title'               => $expenseFixed->title,
                    'value'               => $expenseFixed->value,
                    'pay_day'             => NULL,
                    'type'                => $expenseFixed->type,
                    'status'              => 'pendente',
                    'due_date'            => $due_date,
                    'bank_id'             => NULL,
                    'category_id'         => $expenseFixed->category_id,
                    'mean_payment_id'     => $expenseFixed->mean_payment_id,
                    'created_at'          => date('Y-m-d h:i:s'),
                    'updated_at'          => date('Y-m-d h:i:s'),
                ]
            );
        }
    }
}
