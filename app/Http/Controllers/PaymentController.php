<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{

    function create()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        // Set your Stripe secret key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            // Use the Stripe API to make a charge
           $stripeCharge = Charge::create([
                'amount' => $request->input('amount') || 10,  // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Example Charge',
            ]);

            Payment::create([
                'amount' => $request->input('amount') || 10,
                'method' => $request->input('payment_method'),
                'status' => "completed",
                'transaction_id' => $stripeCharge->id,
                'transaction_data' => $stripeCharge
            ]);

            // Payment successful, you can store data or redirect to a success page
            return view('payment.success',['message', 'Payment processed successfully.', 'transactionId' => $stripeCharge->id , 'transactionData' => $stripeCharge]);
        } catch (\Exception $e) {
            // Payment failed, handle the error
            return redirect()->route('payment.form')->withErrors(['stripeError' => $e->getMessage()]);
        }
    }


}
