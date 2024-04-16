<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('test.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        // $tests = Test::paginate($per_page, ['id', 'username', 'password', 'service_provider_id', 'status']);

        $tests = Test::with('provider')
            ->paginate($per_page, ['id', 'username', 'password', 'service_provider_id', 'status']);

        return $tests->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'service_provider_id' => 'required',
        ]);

        // saving to database
        $test = new Test;
        $test->username = $request->username;
        $test->password = $request->password;
        $test->service_provider_id = $request->service_provider_id;
        $test->status = $request->status;
        $test->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'service_provider_id' => 'required',
        ]);

        $test = Test::findOrFail($id);
        $test->username = $request->username;
        $test->password = $request->password;
        $test->service_provider_id = $request->service_provider_id;
        $test->status = $request->status;
        $test->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return ['status' => 'deleted'];
    }
}
