<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class ServiceProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('service-provider.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $providers = ServiceProvider::paginate($per_page, ['id', 'name', 'm3u_schema']);

        return $providers->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'm3u_schema' => 'required',
        ]);

        // saving to database
        $provider = new ServiceProvider;
        $provider->name = $request->name;
        $provider->m3u_schema = $request->m3u_schema;
        $provider->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'm3u_schema' => 'required',
        ]);

        $provider = ServiceProvider::findOrFail($id);
        $provider->name = $request->name;
        $provider->m3u_schema = $request->m3u_schema;
        $provider->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $provider = ServiceProvider::findOrFail($id);
        $provider->delete();

        return ['status' => 'deleted'];
    }
}
