<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\App;
use App\Models\Country;
use App\Http\Controllers\View;
use App\Models;
use Illuminate\Support\Facades\Log;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {

        return view('country.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $countries = Country::paginate($per_page, ['id', 'name', 'created_at']);

        return $countries->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // saving to database
        $country = new Country;
        $country->name = $request->name;
        $country->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return ['status' => 'deleted'];
    }
}
