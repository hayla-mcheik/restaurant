<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe\Token;
use Stripe\Customer;
use Stripe;
use Stripe\Charge;
use Stripe\PaymentMethod;
use App\Models\OrderModel;
use App\Models\OrderItems;

class StripeController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from your card"
        ]);

        return back()
            ->with('success', 'Payment successful!');
    }
}
