<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ServiceProvider;
use App\Http\Controllers\View;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-offers');
    }

    public function index()
    {
        return view('order.index');
    }

    public function getData(Request $request)
    {
        $per_page = $request->per_page ?? 10;
        $orders = Order::paginate($per_page, ['id', 'email', 'guest_id', 'amount', 'payment_gateway_id', 'payment_order_id', 'status']);

        return $orders->toJson();
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'guest_id' => 'required',
            'amount' => 'required',
            'payment_gateway_id' => 'required',
            'payment_order_id' => 'required',
            'status' => 'required',
        ]);

        // saving to database
        $order = new Order;
        $order->email = $request->email;
        $order->guest_id = $request->guest_id;
        $order->amount = $request->amount;
        $order->payment_gateway_id = $request->payment_gateway_id;
        $order->payment_order_id = $request->payment_order_id;
        $order->status = $request->status;
        $order->save();

        return ['status' => 'created'];
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required',
            'guest_id' => 'required',
            'amount' => 'required',
            'payment_gateway_id' => 'required',
            'payment_order_id' => 'required',
            'status' => 'required',
        ]);

        $order = Order::findOrFail($id);
        $order->email = $request->email;
        $order->guest_id = $request->guest_id;
        $order->amount = $request->amount;
        $order->payment_gateway_id = $request->payment_gateway_id;
        $order->payment_order_id = $request->payment_order_id;
        $order->status = $request->status;
        $order->save();

        return ['status' => 'updated'];
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return ['status' => 'deleted'];
    }
}
