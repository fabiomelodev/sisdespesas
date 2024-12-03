<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UberController extends Controller
{
    public function index()
    {
        // $uberUnnecessary = Expense::whereRelation('category', 'slug', 'uber')
        //     ->where('uber_status', 0)
        //     ->where('user_id', Auth::user()->id)
        //     ->orderBy('pay_day', 'desc')
        //     ->get();


        $expensesUnnecessary = Category::find(2)
            ->expenses()
            ->where('user_id', Auth::user()->id)
            ->where('uber_status', 0)
            ->orderBy('pay_day', 'desc')
            ->get();

        $expensesNecessary = Category::find(2)
            ->expenses()
            ->where('user_id', Auth::user()->id)
            ->where('uber_status', 1)
            ->orderBy('pay_day', 'desc')
            ->get();

        return view('pages.uber', [
            'expensesUnnecessary' => $expensesUnnecessary,
            'expensesNecessary'   => $expensesNecessary
        ]);
    }
}
