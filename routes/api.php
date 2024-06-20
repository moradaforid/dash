<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Guest;
use App\Models\Test;
use App\Models\App;
use Carbon\Carbon;
use App\Mail\TestMailable;
use App\Mail\VerificationCode;
use App\Mail\Trial;
use App\Mail\Buy;
use App\Mail\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\StripeController;
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


Route::get("/new-guest", function (Request $request) {
    $client_ip = $request->ip();
    $email = request("email");
    $lang = request("lang");

    // Validate inputs
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|max:255',
        'lang' => 'required|string|max:2',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        // If validation fails, return response with errors
        return response()->json(['result' => false]);
    }

    // If validation passes, retrieve sanitized data
    $sanitizedData = $validator->validated();

    // Now you can use sanitized data
    $email = $sanitizedData['email'];
    $lang = $sanitizedData['lang'];



    // Check the IP and Email
    $guest = Guest::where('email', 'like', $email)
        // ->where('created_at', '>=', now()->subWeeks(4))
        ->get();

    if ($guest->count() > 0) {
        // There are $guest records
        return response()->json(['result' => false]);
    } else {
        // There are no $guest records
        // Add it to Guests

        $guest = new Guest;
        $guest->ip = $client_ip;
        $guest->email = $email;
        $guest->lang = $lang;
        $guest->newsletter = '1';
        $code = Str::random(6);
        $guest->verification_code = $code;
        $guest->save();


        // Send code via Email
        Mail::to($email)->send(new VerificationCode([
            'from_name' => 'Martin From IPTVDemon',
            'from_email' => 'support@iptvdemon.com',
            'logo' => 'https://e.iptvfiesta.com/logo_mail_darkbg.png',
            'home_url' => 'https://google.com',
            'brand_name' => 'SuperTV',
            'primary_color' => '#000000',
            'secondary_color' => '#111111',
            'code' => $code,
            'email' => $email,
        ], $lang));

        return response()->json(['result' => true]);
    }
});


Route::get("/verify-email", function (Request $request) {
    $client_ip = $request->ip();

    $email = request("email");
    $code = request("code");

    // Validate inputs
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|max:255',
        'code' => 'required|string|size:6|regex:/^[a-zA-Z0-9]+$/',
        // 'code' => 'required|string|alpha|max:6',
    ]);


    // Check if validation fails
    if ($validator->fails()) {
        // If validation fails, return response with errors
        return response()->json(['result' => false]);
    }

    // If validation passes, retrieve sanitized data
    $sanitizedData = $validator->validated();

    // Now you can use sanitized data
    $email = $sanitizedData['email'];
    $code = $sanitizedData['code'];

    $guest = Guest::where('email', $email)
        ->where('verification_code', $code)
        // ->where('created_at', '>=', now()->subHours(24)) // Filter guests created within the last week
        ->first();

    if (!$guest) { // Wrong email or code or
        return response()->json(['result' => false]);
    }

    if ($guest->type == 'tester') { // guest already verified
        return response()->json(['result' => false]);
    }
    // dd($guest);

    // Set guest verification to verified
    $guest->type = 'tester';
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
    }

    // Set test's status to Given
    $test->status = '1';
    $test->save();


    // Send him an Email
    $trial = [
        'from_name' => 'Martin From PrimeroTV',
        'from_email' => 'support@iptvdemon.com',
        'logo' => 'https://e.iptvfiesta.com/logo_mail_darkbg.png',
        'home_url' => 'https://PrimeroTV.com',
        'brand_name' => 'PrimeroTV',
        'primary_color' => '#001e5a',
        'secondary_color' => '#2596be',

        'duration' => '48h',

        'username' => $test->username,
        'password' => $test->password,
        'smarters_url' => 'http://smartersapp.vip',
        'm3u' => 'http://live.mrapido.store/get.php?username=' . $test->username . '&password=' . $test->password . '&type=m3u_plus&output=mpegts',

        'tutorial_link' => 'https://mrapido.store/tutorial',
        'buy_link' => 'https://mrapido.store/buy',
    ];

    Mail::to($email)->send(new Trial($trial, $guest->lang));

    // Mail::to($email)->send(new Order($trial, $guest->lang));
    return response()->json($trial);

    // return response()->json(['result' => true]);
    // return $users->toJson();
});



Route::get('/create-invoice', [StripeController::class, 'createInvoice']);
Route::post('/webhook', [StripeController::class, 'handleWebhook']);
