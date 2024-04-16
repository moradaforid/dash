<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Guest;
use App\Models\Test;
use App\Models\App;
use Carbon\Carbon;
use App\Mail\TestMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::get("/dashboard/users", function () {
        $users = User::with('roles')->get();
        return $users->toJson();
    });
});


Route::get("/client", function (Request $request) {
    $client_ip = $request->ip();


    $name = request("name");
    $email = request("email");
    $area = request("area");
    // $phone = request("phone");



    // Validate inputs
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|alpha|max:255',
        'email' => 'required|email|max:255',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        // If validation fails, return response with errors
        return response()->json(['result' => false]);
    }

    // If validation passes, retrieve sanitized data
    $sanitizedData = $validator->validated();

    // Now you can use sanitized data
    $name = $sanitizedData['name'];
    // $phone = $sanitizedData['phone'];
    $email = $sanitizedData['email'];



    // Check the IP and Email
    $guest = Guest::where('ip', $client_ip)
        ->orWhere('email', 'like', $email)
        ->where('created_at', '>=', now()->subWeeks(1)) // Filter guests created within the last week
        ->get();

    if ($guest->count() > 0) {
        // There are $guest records
        return response()->json(['result' => false]);
    } else {
        // There are no $guest records
        // Add it to Guests

        $guest = new Guest;
        $guest->ip = $client_ip;
        $guest->name = $name;
        $guest->email = $email;
        // $guest->phone = $phone;
        $guest->save();

        // Get Tests (New)
        $test = Test::orderBy('created_at', 'asc')
            ->where('status', '0')
            ->with('provider')
            ->first();

        // Check if the result set is empty
        if ($test == null) { // No result found
            // Send a notification to admin's Telegram
            return response()->json(['result' => 'Tests List is Empty']);
        } else { // Process the results if they exist
            // Set test's status to Given
            $test->status = '1';
            $test->save();
        }



        // Send him an Email

        // Mail::to($email)->send(new TestMailable([
        //     'name' => 'IPTV Demon',
        //     'username' => $test->username,
        //     'password' => $test->password,
        //     'url' => 'http://smartersapp.vip',
        // ]));

        return response()->json(['result' => true]);
    }

    // return response()->json(['client_ip' => $guest]);
    // return $users->toJson();
});
