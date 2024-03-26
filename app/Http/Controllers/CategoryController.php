<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('pages.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required'
        ]);

        Category::create($fields);

        return redirect(route('categories.index'));
    }

    public function edit(Category $category)
    {
        $expenses = Expense::whereRelation('category', 'title', $category->title)
                        ->whereYear('pay_day', Carbon::now()->year)
                        ->whereMonth('pay_day', Carbon::now()->month)
                        ->get();

        $expenses_values = [];

        foreach($expenses as $expense) {
            array_push($expenses_values, $expense->value);
        }

        $expenses_sum_values = array_sum($expenses_values);

        return view('pages.categories.edit', [
            'category'            => $category,
            'expenses'            => $expenses,
            'expenses_sum_values' => $expenses_sum_values
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::findOrFail($id);

        $category->title = $request->get('title');
        $category->slug = Str::slug($request->get('title'));
        $category->update();

        return redirect(route('categories.edit', $category));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect(route('categories.index'));
    }
}
