<?php

namespace App\Http\Controllers;

use Stripe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe.stripe');
    }

    public function stripePost(Request $request)
{
    // dd('hello');
    // dd($request->all());
    $stripe = new \Stripe\StripeClient(
        'sk_test_51Mm8liL1OEfcqFL96ZidPbIZTilElDjArFV9rRPk8Ah7KIe4T6OLHlHynBOmuwP6dLUmaONNtrpqvTxF0d7FjgLZ00QgGuULY3'
      );
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $customer = Stripe\Customer::create(array(
        "address" => [
            "line1" => "Ghazi Road",
            "postal_code" => "5400",
            "city" => "Lahore",
            "state" => "Punjab",
            "country" => "Pakistan",
        ],
        "email" => $request->email,
        "name" => $request->name,
        "phone" => $request->phone,
        "source" => $request->stripeToken,
        "metadata" => ["order_id" => "6735"],
    ));
   $charge = Stripe\Charge::create ([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment from Aamir shahzad.",
            "shipping" => [
            "name" => "Jenny Rosen",
            "address" => [
            "line1" => "510 Townsend St",
            "postal_code" => "98140",
            "city" => "San Francisco",
            "state" => "CA",
            "country" => "US",
              ],
            ]
    ]);
    Stripe\product ::create ([
        "active" => true,
        'name' => 'Gold Special',
        "metadata" => ['color' => 'Gold','weight' => '11.6 gram'],
    ]);
    // dd($payment->id);
    // $invoice = Stripe\Invoice ::create
    $invoice = $stripe->invoices->create ([
        'customer' => $customer->id,
        "amount"   => 100*100,
        "currency" => "USD",
        "auto_advance" => false,
    ]);

    // Stripe\invoice ::pay ($invoice->id,[]);
    
    $stripe->invoices->pay(
        $invoice->id,
        []
      );
    // Session::flash('success', 'Payment successful!');
    
    return back();
}
}
