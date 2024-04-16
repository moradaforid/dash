<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Category;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $categories = Category::paginate($per_page, ['id', 'name', 'created_at']);

        return $categories->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // saving to database
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return ['status' => 'deleted'];
    }
}
