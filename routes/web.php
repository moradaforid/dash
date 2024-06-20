<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ServiceProviderController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\BrandController;
use ArielMejiaDev\LarapexCharts\LarapexChart;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Adunit;
use App\Models\App;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/apps', [AppController::class, 'index'])->name('app.index');
    Route::get('/apps/create', [AppController::class, 'create_page'])->name('app.create_page');
    Route::get('/apps/{id}', [AppController::class, 'edit_page'])->name('app.edit_page');
    Route::post('/apps', [AppController::class, 'create'])->name('app.create');
    Route::patch('/apps/{id}', [AppController::class, 'update'])->name('app.update');
    Route::delete('/apps/{id}', [AppController::class, 'destroy'])->name('app.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/all', [CategoryController::class, 'getData'])->name('category.getData');
    Route::post('/categories', [CategoryController::class, 'create'])->name('category.create');
    Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/countries', [CountryController::class, 'index'])->name('country.index');
    Route::get('/countries/all', [CountryController::class, 'getData'])->name('country.getData');
    Route::post('/countries', [CountryController::class, 'create'])->name('country.create');
    Route::patch('/countries/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::delete('/countries/{id}', [CountryController::class, 'destroy'])->name('country.destroy');

    Route::get('/offers', [OfferController::class, 'index'])->name('offer.index');
    Route::get('/offers/all', [OfferController::class, 'getData'])->name('offer.getData');
    Route::post('/offers', [OfferController::class, 'create'])->name('offer.create');
    Route::patch('/offers/{id}', [OfferController::class, 'update'])->name('offer.update');
    Route::delete('/offers/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');

    Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsor.index');
    Route::get('/sponsors/all', [SponsorController::class, 'getData'])->name('sponsor.getData');
    Route::post('/sponsors', [SponsorController::class, 'create'])->name('sponsor.create');
    Route::patch('/sponsors/{id}', [SponsorController::class, 'update'])->name('sponsor.update');
    Route::delete('/sponsors/{id}', [SponsorController::class, 'destroy'])->name('sponsor.destroy');

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('/roles/all', [RoleController::class, 'getData'])->name('role.getData');
    Route::post('/roles', [RoleController::class, 'create'])->name('role.create');
    Route::patch('/roles/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    Route::get('/guests', [GuestController::class, 'index'])->name('guest.index');
    Route::get('/guests/all', [GuestController::class, 'getData'])->name('guest.getData');
    Route::post('/guests', [GuestController::class, 'create'])->name('guest.create');
    Route::patch('/guests/{id}', [GuestController::class, 'update'])->name('guest.update');
    Route::delete('/guests/{id}', [GuestController::class, 'destroy'])->name('guest.destroy');

    Route::get('/tests', [TestController::class, 'index'])->name('test.index');
    Route::get('/tests/all', [TestController::class, 'getData'])->name('test.getData');
    Route::post('/tests', [TestController::class, 'create'])->name('test.create');
    Route::patch('/tests/{id}', [TestController::class, 'update'])->name('test.update');
    Route::delete('/tests/{id}', [TestController::class, 'destroy'])->name('test.destroy');

    Route::get('/service-providers', [ServiceProviderController::class, 'index'])->name('service-provider.index');
    Route::get('/service-providers/all', [ServiceProviderController::class, 'getData'])->name('service-provider.getData');
    Route::post('/service-providers', [ServiceProviderController::class, 'create'])->name('service-provider.create');
    Route::patch('/service-providers/{id}', [ServiceProviderController::class, 'update'])->name('service-provider.update');
    Route::delete('/service-providers/{id}', [ServiceProviderController::class, 'destroy'])->name('service-provider.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/all', [OrderController::class, 'getData'])->name('order.getData');
    Route::post('/orders', [OrderController::class, 'create'])->name('order.create');
    Route::patch('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');

    Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brands/all', [BrandController::class, 'getData'])->name('brand.getData');
    Route::post('/brands', [BrandController::class, 'create'])->name('brand.create');
    Route::patch('/brands/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    Route::get('/payment-gateways', [PaymentGatewayController::class, 'index'])->name('payment-gateway.index');
    Route::get('/payment-gateways/all', [PaymentGatewayController::class, 'getData'])->name('payment-gateway.getData');
    Route::post('/payment-gateways', [PaymentGatewayController::class, 'create'])->name('payment-gateway.create');
    Route::patch('/payment-gateways/{id}', [PaymentGatewayController::class, 'update'])->name('payment-gateway.update');
    Route::delete('/payment-gateways/{id}', [PaymentGatewayController::class, 'destroy'])->name('payment-gateway.destroy');

    //Route::get('/roles', [RoleController::class, 'edit'])->name('role.edit');
    // Route::resource("/roles", RoleController::class);

    Route::resource("/users", UserController::class);


    Route::resource("/permissions", PermissionController::class);

    Route::get("/report", function () {
        return view('report');
    });

    // Route::get("/test", function () {
    //     $users = User::with('roles')->get();
    //     return view('test', compact('users'));
    // });

    Route::get("/forms", function () {
        return view('vue');
    });

    // Route::get("/report", function () {

    //     $start = request("start");
    //     $end = request("end");

    //     $startDate = Carbon::createFromFormat('Y-m-d', '2023-06-01')->startOfDay();
    //     $endDate = Carbon::createFromFormat('Y-m-d', '2023-06-05')->endOfDay();

    //     $period = CarbonPeriod::create($startDate, $endDate);
    //     $daysOfLastMonth = $period->toArray();

    //     $days = [];
    //     foreach ($daysOfLastMonth as $day) {
    //         array_push($days, $day->format('d/M/Y'));
    //     }


    //     $user_id = auth()->user()['id'];

    //     $adunits = Adunit::whereHas('app', function ($query) use ($user_id) {
    //         $query->where('user_id', $user_id);
    //     })
    //         ->with('reports', function ($query) use ($startDate, $endDate) {
    //             $query->whereBetween('created_at', [$startDate, $endDate]);
    //         })->get();

    //     $chart = (new LarapexChart)->lineChart()
    //         ->setTitle('Sales during 2021.')
    //         ->setSubtitle('Physical sales vs Digital sales.')
    //         ->addData('Revenue', [25, 9, 19, 5, 17, 3])
    //         ->addData('Impressions', [40, 93, 35, 42, 18, 82])
    //         ->addData('Clicks', [44, 29, 77, 28, 55, 45])
    //         //->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    //         ->setXAxis($days);

    //     //return view('report', compact('chart'));
    //     return view('report')->with('adunits', $adunits);
    // });



    Route::post("/report", function () {

        $start = request("startDate");
        $end = request("endDate");
        $group = request("group");


        // $startDate = Carbon::createFromFormat('Y-m-d', '2023-06-01')->startOfDay();
        // $endDate = Carbon::createFromFormat('Y-m-d', '2023-06-17')->endOfDay();

        $startDate = Carbon::createFromFormat('Y-m-d', $start)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $end)->endOfDay();

        $period = CarbonPeriod::create($startDate, $endDate);
        $daysOfLastMonth = $period->toArray();

        $days = [];
        foreach ($daysOfLastMonth as $day) {
            array_push($days, $day->format('d/M/Y'));
        }


        $user_id = auth()->user()['id'];

        // $apps = App::where('user_id', $user_id)
        //     ->with('adunits.reports', function ($query) use ($startDate, $endDate) {
        //         $query->whereBetween('created_at', [$startDate, $endDate]);
        //     });

        $apps = App::where('user_id', $user_id)
            ->with('adunits', function ($query) use ($startDate, $endDate) {
                $query->whereHas('reports', function ($subquery) use ($startDate, $endDate) {
                    $subquery->whereBetween('created_at', [$startDate, $endDate]);
                })
                    ->with('reports');
            })
            // ->with('adunits.reports', function ($subquery) use ($startDate, $endDate) {
            //     $subquery->whereBetween('created_at', [$startDate, $endDate]);
            // })
        ;


        $adunits = Adunit::whereHas('app', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
            ->with('reports', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            });

        $data = [];
        if ($group == 'apps') {
            $data = $apps->get();
        } else if ($group == 'adunits') {
            $data = $adunits->get();
        } else if ($group == 'days') {
            // $days->get();
            // return $adunits->toJson();
        }

        // $chart = (new LarapexChart)->lineChart()
        //     ->setTitle('Sales during 2021.')
        //     ->setSubtitle('Physical sales vs Digital sales.')
        //     ->addData('Revenue', [25, 9, 19, 5, 17, 3])
        //     ->addData('Impressions', [40, 93, 35, 42, 18, 82])
        //     ->addData('Clicks', [44, 29, 77, 28, 55, 45])
        //     //->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
        //     ->setXAxis($days);

        //return view('report', compact('chart'));
        return $data->toJson();
    });
});

require __DIR__ . '/auth.php';
