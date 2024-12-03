<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Expense, Uber};

class RegisterUbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-ubers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expenses = Expense::whereRelation('category', 'slug', 'uber')->orderBy('pay_day', 'asc')->get();

        $expenses->each(function($item) {
            Uber::create([
                'value'         => $item->value,
                'means_payment' => $item->means_payment,
                'pay_day'       => $item->pay_day,
                'bank_id'       => $item->bank_id
            ]);
        });
    }
}
