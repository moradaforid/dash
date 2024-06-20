<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Brand;
use App\Models\ServiceProvider;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('brand.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $brands = Brand::paginate($per_page, ['id', 'name', 'domain', 'logo', 'primary_color', 'secondary_color']);

        return $brands->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'domain' => 'required',
            'logo' => 'required',
            'primary_color' => 'required',
            'secondary_color' => 'required',
        ]);

        // saving to database
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->domain = $request->domain;
        $brand->logo = $request->logo;
        $brand->primary_color = $request->primary_color;
        $brand->secondary_color = $request->secondary_color;
        $brand->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'domain' => 'required',
            'logo' => 'required',
            'primary_color' => 'required',
            'secondary_color' => 'required',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->domain = $request->domain;
        $brand->logo = $request->logo;
        $brand->primary_color = $request->primary_color;
        $brand->secondary_color = $request->secondary_color;
        $brand->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return ['status' => 'deleted'];
    }
}
