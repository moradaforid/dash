<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Category;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-app')->only('index');
        $this->middleware('can:create-app')->only('create_page');
        $this->middleware('can:create-app')->only('create');
        $this->middleware('can:update-app')->only('update');
        $this->middleware('can:destroy-app')->only('destroy');
    }

    public function index()
    {

        $user_id = auth()->user()['id'];

        $apps = App::where('user_id', $user_id)->get();

        return view('app.index', compact('apps'));
    }

    public function create_page()
    {
        $categories = Category::all();

        return view('app.create', compact('categories'));
    }

    public function edit_page(string $id)
    {
        $app = App::findOrFail($id);
        $status = '';

        return view('app.edit', compact('app', 'status'));
    }


    public function create(Request $request)
    {
        $user_id = auth()->user()['id'];

        $request->validate([
            'name' => 'required',
            'category_ids' => 'required',
        ]);

        // saving to database
        $app = new App;

        $app->name = $request->name;
        $app->user_id = $user_id;

        $app->save();


        $categoryIds = $request->category_ids;
        $app->categories()->attach($categoryIds);

        // return redirect()->route('apps.index')->with('success', 'Company has been created successfully.');

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $user_id = auth()->user()['id'];

        // $app = App::findOrFail($id);
        $app = App::where('user_id', $user_id)->findOrFail($id);
        $app->name = $request->name;
        $app->category_id = $request->category_id;

        $app->save();

        $categoryIds = $request->category_ids;
        $app->categories()->sync($categoryIds);

        // return view('app.edit')->with('app', $app)->with('status', 'updated');
        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $user_id = auth()->user()['id'];

        $app = App::where('user_id', $user_id)->findOrFail($id);
        $app->delete();

        // App::destroy($id);

        // return redirect('apps')->with('status', 'deleted');
        return ['status' => 'deleted'];
    }
}
