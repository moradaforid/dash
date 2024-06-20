<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Invoice;
use Stripe\Customer;
use Stripe\InvoiceItem;
use Stripe\Product;
use Stripe\Price;
use Stripe\Exception\ApiErrorException;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Log;


class StripeController extends Controller
{
    public function createInvoice(Request $request)
    {
        try {

            // Validate the request input
            $request->validate([
                'email' => 'required|email',
                'description' => 'required|string',
                'amount' => 'required|numeric|min:0.50',
            ]);

            // Get stripe accounts
            $stripe = PaymentGateway::orderBy('created_at', 'asc')
                ->where('status', 'Active')
                // ->with('provider')
                ->first();

            // Stripe::setApiKey($stripe->secret_key);


            $stripe = new \Stripe\StripeClient($stripe->secret_key);

            // Create a product
            $product = $stripe->products->create(['name' => 'Gold Special']);

            // Create a price
            $price = $stripe->prices->create([
                'product' => $product->id,
                'unit_amount' => $request->amount * 100, // $10.00
                'currency' => 'eur',
            ]);

            // Create a customer
            $customer = $stripe->customers->create([
                // 'name' => 'Jenny Rosen',
                'email' => $request->email,
                'description' => $request->description,
            ]);

            // Create an invoice
            $invoice = $stripe->invoices->create([
                'customer' => $customer->id,
                'collection_method' => 'send_invoice',
                'days_until_due' => 30,
            ]);

            // Create an invoice item
            $invoiceItem = $stripe->invoiceItems->create([
                'customer' => $customer->id,
                'price' => $price->id,
                'invoice' => $invoice->id,
            ]);

            // Finalize the invoice (optional, if you set auto_advance to false)
            $finalizedInvoice = $stripe->invoices->finalizeInvoice($invoice->id, []);

            // Send the invoice
            // $stripe->invoices->sendInvoice($invoice->id, []);


            return response()->json(['hosted_invoice_url' => $finalizedInvoice->hosted_invoice_url]);
        } catch (ApiErrorException $e) {
            // Handle Stripe API error
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }





    public function createInvoice_old(Request $request)
    {

        // Get stripe accounts
        $stripe = PaymentGateway::orderBy('created_at', 'asc')
            ->where('status', 'Active')
            // ->with('provider')
            ->first();

        Stripe::setApiKey($stripe->secret_key);

        try {
            // Validate the request input
            $request->validate([
                'email' => 'required|email',
                'description' => 'required|string',
                'amount' => 'required|numeric|min:0.50',
            ]);

            // Log request details
            Log::info('Creating customer with email: ' . $request->email);

            // Create a new customer
            $customer = Customer::create([
                'email' => $request->email,
            ]);

            // Log customer creation
            Log::info('Customer created: ' . $customer->id);

            // Create an invoice item with a dynamic price
            InvoiceItem::create([
                'customer' => $customer->id,
                'amount' => $request->amount * 100, // Amount in cents
                'currency' => 'usd',
                'description' => $request->description,
            ]);

            // Log invoice item creation
            Log::info('Invoice item created for customer: ' . $customer->id . ' with amount: ' . $request->amount);

            // Create the invoice
            $invoice = Invoice::create([
                'customer' => $customer->id,
                'auto_advance' => true, // Auto-finalize the invoice
            ]);

            // Log invoice creation
            Log::info('Invoice created: ' . $invoice->id . ' and auto-finalized.');

            return response()->json(['invoice_url' => $invoice->hosted_invoice_url]);
        } catch (\Exception $e) {
            Log::error('Error creating invoice: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating invoice'], 500);
        }
    }


    public function handleWebhook(Request $request)
    {
        // Stripe::setApiKey(config('services.stripe.secret'));

        // Get stripe accounts
        $stripe = PaymentGateway::orderBy('created_at', 'asc')
            ->where('status', 'Active')
            // ->with('provider')
            ->first();

        // Retrieve the request's body and parse it as JSON
        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $invoice = $event->data->object; // contains a \Stripe\Invoice
                // Update your database and mark the order as paid
                $this->handlePaymentSucceeded($invoice);
                break;
                // Handle other event types
            default:
                return response()->json(['status' => 'Unhandled event type'], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

    protected function handlePaymentSucceeded($invoice)
    {
        // Example: Update order status in the database
        // Order::where('invoice_id', $invoice->id)->update(['status' => 'paid']);
    }
}
