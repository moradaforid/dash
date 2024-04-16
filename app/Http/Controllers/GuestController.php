<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('guest.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $guests = Guest::paginate($per_page, ['id', 'email', 'ip']);

        return $guests->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'ip' => 'required',
        ]);

        // saving to database
        $guest = new Guest;
        $guest->ip = $request->ip;
        $guest->email = $request->email;
        $guest->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required',
            'ip' => 'required',
        ]);

        $guest = Guest::findOrFail($id);
        $guest->ip = $request->ip;
        $guest->email = $request->email;
        $guest->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return ['status' => 'deleted'];
    }
}
