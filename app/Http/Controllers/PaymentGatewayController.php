<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use App\Models\Brand;
use App\Models\ServiceProvider;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('payment-gateway.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $payments = PaymentGateway::paginate($per_page, ['id', 'name', 'api_key', 'payment_company', 'status']);

        return $payments->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'api_key' => 'required',
            'payment_company' => 'required',
        ]);

        // saving to database
        $payment = new PaymentGateway;
        $payment->name = $request->name;
        $payment->api_key = $request->api_key;
        $payment->payment_company = $request->payment_company;
        $payment->status = $request->status;
        $payment->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'api_key' => 'required',
            'payment_company' => 'required',
        ]);

        $payment = PaymentGateway::findOrFail($id);
        $payment->name = $request->name;
        $payment->api_key = $request->api_key;
        $payment->payment_company = $request->payment_company;
        $payment->status = $request->status;
        $payment->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $payment = PaymentGateway::findOrFail($id);
        $payment->delete();

        return ['status' => 'deleted'];
    }
}
