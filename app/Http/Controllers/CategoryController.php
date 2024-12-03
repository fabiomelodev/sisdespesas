<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $expenses = $category->expenses()
            ->where('user_id', Auth::user()->id)
            ->orderBy('pay_day', 'desc')
            ->get();

        return view('pages.single-category', [
            'category' => $category,
            'expenses' => $expenses
        ]);
    }
}
