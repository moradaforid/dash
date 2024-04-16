<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('sponsor.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $sponsors = Sponsor::paginate($per_page, ['id', 'name', 'api_link', 'api_token', 'created_at']);

        return $sponsors->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // saving to database
        $sponsor = new Sponsor;
        $sponsor->name = $request->name;
        $sponsor->api_link = $request->api_link;
        $sponsor->api_token = $request->api_token;
        $sponsor->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sponsor = Sponsor::findOrFail($id);
        $sponsor->name = $request->name;
        $sponsor->api_link = $request->api_link;
        $sponsor->api_token = $request->api_token;
        $sponsor->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->delete();

        return ['status' => 'deleted'];
    }
}
